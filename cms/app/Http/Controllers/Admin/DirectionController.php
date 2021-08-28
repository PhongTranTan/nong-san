<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Repositories\DirectionRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class DirectionController extends Controller
{
    protected $direction;

    public function __construct(DirectionRepository $direction)
    {
        $this->direction = $direction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumb::title(trans('direction.title'));
        return view('admin.direction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumb::title(trans('direction.create'));

        return view('admin.direction.create_edit');
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

        $this->direction->create($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_direction.direction')]));

        return redirect()->route('admin.direction.index');
    }

    public function datatable()
    {
        $data = $this->direction->datatable();

        return Datatables::of($data)
            ->editColumn(
                'active',
                function ($data) {
                    if ($data->active)
                        return '<span class="label label-success">'. trans('label.active') .'</span>';
                    return '<span class="label label-warning">'. trans('label.inactive') .'</span>';
                })
            ->addColumn(
                'action', function ($data) {
                return view('admin.layouts.partials.table_button')->with(
                    [
                        'link_edit' => route('admin.direction.edit', $data->id),
                        'link_delete' => route('admin.direction.destroy', $data->id),
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
        Breadcrumb::title(trans('admin_direction.edit'));

        $direction = $this->direction->find($id);

        return view('admin.direction.create_edit', compact('direction'));
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

        $this->direction->update($input, $id);

        if($request->ajax()){
            return ['success'=>true, 'message'=>'Cập nhật trạng thái thành công','notify_class'=>'success'];
        }

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_tenure.direction')]));

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
        $this->direction->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_direction.direction')]));

        return redirect()->back();
    }
}