<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\FloorCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use Yajra\DataTables\Facades\DataTables;

class FloorCategoryController extends Controller
{
    protected $category;

    public function __construct(FloorCategoryRepository $category)
    {
        parent::__construct();
        $this->category = $category;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_type.title'));
        return view('admin.floorcategory.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_type.create'));

        return view('admin.floorcategory.create_edit');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->category->create($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_floor.category')]));

        return redirect()->route('admin.floorcategory.index');
    }

    public function datatable()
    {
        $data = $this->category->datatable();

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
                        'link_edit' => route('admin.floorcategory.edit', $data->id),
                        'link_delete' => route('admin.floorcategory.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);

    }

    public function edit($id)
    {
        \App\Helper\Breadcrumb::title(trans('admin_floorcategory.edit'));

        $category = $this->category->find($id);

        return view('admin.floorcategory.create_edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->category->update($input, $id);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_floor.category')]));

        return back();
    }

    public function destroy($id)
    {
        $this->category->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_floor.category')]));

        return redirect()->back();
    }
}
