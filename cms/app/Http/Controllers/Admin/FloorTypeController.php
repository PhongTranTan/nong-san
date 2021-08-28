<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\FloorTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use Yajra\DataTables\Facades\DataTables;

class FloorTypeController extends Controller
{
    protected $type;

    public function __construct(FloorTypeRepository $type)
    {
        parent::__construct();
        $this->type = $type;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_type.title'));
        return view('admin.floortype.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_type.create'));

        $floor_parents = $this->type->datatable()->where('parent_id', 0)->get();

        return view('admin.floortype.create_edit', compact('floor_parents'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->type->create($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_floor.type')]));

        return redirect()->route('admin.floortype.index');
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
                        'link_edit' => route('admin.floortype.edit', $data->id),
                        'link_delete' => route('admin.floortype.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);

    }

    public function edit($id)
    {
        \App\Helper\Breadcrumb::title(trans('admin_floortype.edit'));

        $type = $this->type->find($id);

        $floor_parents = $this->type->datatable()->where(function($query) use($type){

            $query->where('parent_id', 0)->orWhere('parent_id', $type->parent_id);

        })->whereNotIn('id', [$id])->get();

        return view('admin.floortype.create_edit', compact('type', 'floor_parents'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->type->update($input, $id);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_floor.type')]));

        return back();
    }

    public function destroy($id)
    {
        $this->type->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_floor.type')]));

        return redirect()->back();
    }
}
