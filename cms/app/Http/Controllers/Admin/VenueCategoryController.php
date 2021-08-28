<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Repositories\VenueCategoryRepository;
use App\Repositories\VenueRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class VenueCategoryController extends Controller
{
    protected $venue_category;

    public function __construct(VenueCategoryRepository $venue_category)
    {
        $this->venue_category = $venue_category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Breadcrumb::title(trans('admin_venue_category.title'));
        return view('admin.venue_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumb::title(trans('admin_venue_category.create'));

        return view('admin.venue_category.create_edit');
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

        $this->venue_category->create($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_venue_category.venue_category')]));

        return redirect()->route('admin.venue.category.index');
    }

    public function datatable()
    {
        $data = $this->venue_category->datatable();
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
                        'link_edit' => route('admin.venue.category.edit', $data->id),
                        'link_delete' => route('admin.venue.category.destroy', $data->id),
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
        Breadcrumb::title(trans('admin_venue_category.edit'));

        $venue_category = $this->venue_category->find($id);

        return view('admin.venue_category.create_edit', compact('venue_category'));
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

        $this->venue_category->update($input, $id);

        if($request->ajax()){
            return ['success'=>true, 'message'=>'Cập nhật trạng thái khách hàng thành công','notify_class'=>'success'];
        }

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_venue_category.venue_category')]));

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
        $this->venue_category->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_venue_category.venue_category')]));

        return redirect()->back();
    }
}