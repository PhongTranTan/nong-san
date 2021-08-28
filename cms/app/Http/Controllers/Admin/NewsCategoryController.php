<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\NewsCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Breadcrumb;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class NewsCategoryController extends Controller
{
    protected $newsCategory;

    public function __construct(
        NewsCategoryRepository $newsCategory
    )
    {
        parent::__construct();
        $this->newsCategory = $newsCategory;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_news_category.title'));
        return view('admin.news_category.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_news_category.create'));
        return view('admin.news_category.create_edit');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $newsCategory = $this->newsCategory->create($input);
        session()->flash(
            'success', 
            trans('admin_message.created_successful', [
                'attr' => trans('admin_news_category.news')
            ])
        );
        return redirect()->route('admin.news.category.index');
    }

    public function datatable()
    {
        $data = $this->newsCategory->datatable([
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
                        'link_edit' => route('admin.news.category.edit', $data->id),
                        'link_delete' => route('admin.news.category.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function edit($id)
    {
        Breadcrumb::title(trans('admin_news_category.edit'));
        $newsCategory = $this->newsCategory->find($id);
        $metadata = $newsCategory->meta;
        return view('admin.news_category.create_edit', compact(
            'newsCategory', 
            'metadata'
        ));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->newsCategory->update($input, $id);
        session()->flash(
            'success', 
            trans('admin_message.updated_successful', [
                'attr' => trans('admin_news_category.news')
            ])
        );
        return back();
    }

    public function destroy($id)
    {
        $this->newsCategory->delete($id);
        session()->flash(
            'success', 
            trans('admin_message.deleted_successful', [
                'attr' => trans('admin_news_category.news')
            ]));
        return redirect()->back();
    }
}
