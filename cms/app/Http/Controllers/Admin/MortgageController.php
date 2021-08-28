<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\MortgageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use Yajra\DataTables\Facades\DataTables;

class MortgageController extends Controller
{
    protected $mortgage;

    public function __construct(MortgageRepository $mortgage)
    {
        parent::__construct();
        $this->mortgage = $mortgage;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_class.title'));
        return view('admin.mortgage.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_class.create'));

        return view('admin.mortgage.create_edit');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $this->mortgage->create($input);
        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_mortgage.mortgage')]));
        return redirect()->route('admin.mortgage.index');
    }

    public function datatable()
    {
        $data = $this->mortgage->datatable();

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
                        'link_edit' => route('admin.mortgage.edit', $data->id),
                        'link_delete' => route('admin.mortgage.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);

    }

    public function edit($id)
    {
        \App\Helper\Breadcrumb::title(trans('admin_subject.edit'));

        $mortgage = $this->mortgage->find($id);

        return view('admin.mortgage.create_edit', compact('mortgage'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $this->mortgage->update($input, $id);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_mortgage.mortgage')]));

        return back();
    }

    public function destroy($id)
    {
        $this->mortgage->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_mortgage.mortgage')]));

        return redirect()->back();
    }
}
