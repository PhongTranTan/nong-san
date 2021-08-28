<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\BannerRepository;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    protected $banner;
    protected $page;

    public function __construct(BannerRepository $banner, PageRepository $page)
    {
        $this->banner = $banner;
        $this->page = $page;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_contact.title'));
        return view('admin.banner.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_banner.create'));

        $pages =  $this->page->getAllPageActive();

        return view('admin.banner.create_edit', compact('pages'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $this->banner->create($input);
        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_banner.banner')]));
        return redirect()->route('admin.banner.index');
    }

    public function datatable()
    {
        $data = $this->banner->datatable();

        return Datatables::of($data)
            ->addColumn(
                'page',
                function ($data) {
                    return $data->page->title;
                }
            )
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
                        'link_edit' => route('admin.banner.edit', $data->id),
                        'link_delete' => route('admin.banner.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);

    }

    public function edit($id)
    {
        \App\Helper\Breadcrumb::title(trans('admin_banner.edit'));

        $banner = $this->banner->find($id);

        $pages =  $this->page->getAllPageActive();

        return view('admin.banner.create_edit', compact('banner', 'pages'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->banner->update($input, $id);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_banner.banner')]));

        return back();
    }

    public function destroy($id)
    {
        $this->banner->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_banner.banner')]));

        return redirect()->back();
    }
}
