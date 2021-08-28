<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\GuidesCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Breadcrumb;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class GuidesCategoryController extends Controller
{
    protected $guidesCategory;

    public function __construct(
        GuidesCategoryRepository $guidesCategory
    )
    {
        parent::__construct();
        $this->guidesCategory = $guidesCategory;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_guides_category.title'));
        return view('admin.guides_category.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_guides_category.create'));
        return view('admin.guides_category.create_edit');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $guidesCategory = $this->guidesCategory->create($input);
        session()->flash(
            'success', 
            trans('admin_message.created_successful', [
                'attr' => trans('admin_guides_category.guides')
            ])
        );
        return redirect()->route('admin.guides.category.index');
    }

    public function datatable()
    {
        $data = $this->guidesCategory->datatable([
            'translations'
        ]);
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
                        'link_edit' => route('admin.guides.category.edit', $data->id),
                        'link_delete' => route('admin.guides.category.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function edit($id)
    {
        Breadcrumb::title(trans('admin_guides_category.edit'));
        $guidesCategory = $this->guidesCategory->find($id);
        $metadata = $guidesCategory->meta;
        return view('admin.guides_category.create_edit', compact(
            'guidesCategory', 
            'metadata'
        ));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->guidesCategory->update($input, $id);
        session()->flash(
            'success', 
            trans('admin_message.updated_successful', [
                'attr' => trans('admin_guides_category.guides')
            ])
        );
        return back();
    }

    public function destroy($id)
    {
        $this->guidesCategory->delete($id);
        session()->flash(
            'success', 
            trans('admin_message.deleted_successful', [
                'attr' => trans('admin_guides_category.guides')
            ]));
        return redirect()->back();
    }
}
