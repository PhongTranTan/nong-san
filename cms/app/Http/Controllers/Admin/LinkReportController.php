<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Repositories\LinkReportRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\ProjectRepository;

class LinkReportController extends Controller
{
    protected $linkreport;
    protected $project;

    public function stripUnicode($str)
    {
        $str = str_replace(array(',', '<', '>', '&', '{', '}', '*', '?', '/', '"', ".", "|", "=", "(", ")", ",", "!", "@", "^", "_", "[", "]"), array(' '), $str);
        $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
        if(!$str) return false;
        $unicode = array
        (
         'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
         'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
         'd'=>'đ',
         'D'=>'Đ',
         'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
         'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
         'i'=>'í|ì|ỉ|ĩ|ị',
         'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
         'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
         'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
         'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
         'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
         'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
         'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        );

        foreach($unicode as $khongdau=>$codau)
        {
          $arr = explode("|",$codau);
          $str = str_replace($arr,$khongdau,$str);
          $str = trim(strip_tags($str));
          $str = preg_replace('/\s+/',' ',$str);
          $str = str_replace(" ","-",$str);
        }
        return $str;
    }

    public function __construct(LinkReportRepository $linkreport, ProjectRepository $project)
    {
        $this->linkreport = $linkreport;
        $this->project = $project;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumb::title(trans('linkreport.title'));
        return view('admin.linkreport.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumb::title(trans('linkreport.create'));

        $projects = $this->project->datatable()->get();

        return view('admin.linkreport.create_edit', compact('projects'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $input = $this->checkData($input);

        $this->linkreport->create($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_linkreport.linkreport')]));

        return redirect()->route('admin.linkreport.index');
    }

    public function datatable()
    {
        $data = $this->linkreport->datatable();

        return Datatables::of($data)
            ->editColumn(
                'url', function($data){
                    return route('frontend.link.report', ['link' => $data->url]);
                }
            )
            ->addColumn(
                'action', function ($data) {
                return view('admin.layouts.partials.table_button')->with(
                    [
                        'link_edit' => route('admin.linkreport.edit', $data->id),
                        'link_delete' => route('admin.linkreport.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Breadcrumb::title(trans('admin_linkreport.edit'));

        $linkreport = $this->linkreport->find($id);

        $projects = $this->project->datatable()->get();

        return view('admin.linkreport.create_edit', compact('linkreport', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return *
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $input =$this->checkData($input);

        $this->linkreport->update($input, $id);

        if($request->ajax()){
            return ['success'=>true, 'message'=>'Cập nhật trạng thái thành công','notify_class'=>'success'];
        }

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_linkreport.linkreport')]));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->linkreport->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_linkreport.linkreport')]));

        return redirect()->back();
    }

    public function checkData($input)
    {
        if(isset($input['project_choose']) && count($input['project_choose']) > 0){
            $input['project_choose'] = json_encode($input['project_choose']);
        } else {
            $input['project_choose'] = json_encode([]);
        }
        
        if(isset($input['estimated_rental']) && count($input['estimated_rental']) > 0){
            $input['estimate_rental'] = json_encode($input['estimated_rental']);
        }

        if(isset($input['estimated_capital']) && count($input['estimated_capital']) > 0){ 
            $input['estimate_capital'] = json_encode($input['estimated_capital']);
        }

        if(isset($input['banner_images']) && count($input['banner_images']) > 0){ 
            $input['banner_images'] = json_encode($input['banner_images']);
        } else {
            $input['banner_images'] = json_encode([]);
        }

        if(isset($input['banner_title']) && count($input['banner_title']) > 0){ 
            $input['banner_title'] = json_encode($input['banner_title']);
        }

        if(isset($input['banner_description']) && count($input['banner_description']) > 0){ 
            $input['banner_description'] = json_encode($input['banner_description']);
        } 

        if(isset($input['url'])){
            $input['url'] = self::stripUnicode($input['url']);
        }

        return $input;
    }
}
