<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\TypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    protected $type;

    public function __construct(TypeRepository $type)
    {
        parent::__construct();
        $this->type = $type;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_type.title'));
        return view('admin.type.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_type.create'));

        return view('admin.type.create_edit');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->type->create($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_type.type')]));

        return redirect()->route('admin.type.index');
    }

    public function datatable()
    {
        $data = $this->type->datatable();

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
                        'link_edit' => route('admin.type.edit', $data->id),
                        'link_delete' => route('admin.type.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);

    }

    public function edit($id)
    {
        \App\Helper\Breadcrumb::title(trans('admin_type.edit'));

        $type = $this->type->find($id);

        return view('admin.type.create_edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->type->update($input, $id);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_type.type')]));

        return back();
    }

    public function destroy($id)
    {
        $this->type->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_type.type')]));

        return redirect()->back();
    }
}
