<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\TestimonialsRepository;
use Breadcrumb;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TestimonialsController extends Controller
{
    protected $testimonials;

    public function __construct(TestimonialsRepository $testimonials)
    {
        parent::__construct();
        $this->testimonials = $testimonials;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_testimonials.title'));
        return view('admin.testimonials.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_testimonials.create'));

        return view('admin.testimonials.create_edit');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['active'] = !empty($input['active']) ? 1 : 0;

        $model = $this->testimonials->create($input);

        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_testimonials.testimonials')]));
        return redirect()->route('admin.testimonials.index');
    }

    public function datatable()
    {
        $data = $this->testimonials->datatable();

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
                        'link_edit' => route('admin.testimonials.edit', $data->id),
                        'link_delete' => route('admin.testimonials.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);

    }

    public function edit($id)
    {
        \App\Helper\Breadcrumb::title(trans('admin_testimonials.edit'));
        $testimonials = $this->testimonials->find($id);
        return view('admin.testimonials.create_edit', compact('testimonials'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $model = $this->testimonials->find($id);

        $model->update($input);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_testimonials.testimonials')]));
        return back();
    }

    public function destroy($id)
    {
        $this->testimonials->find($id)->delete();
        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_testimonials.testimonials')]));
        return redirect()->back();
    }
}
