<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\LogoPartnerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use Yajra\DataTables\Facades\DataTables;

class LogoPartnerController extends Controller
{
    protected $logopartner;

    public function __construct(LogoPartnerRepository $logopartner)
    {
        $this->logopartner = $logopartner;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_partner.title'));
        return view('admin.logopartner.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_partner.create'));

        return view('admin.logopartner.create_edit');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $input['type'] = (isset($input['type']) && $input['type'] != null) ? $input['type'] : 1;

        $input['active'] = (isset($input['active']) && $input['active'] != null) ? 1 : 0;

        $this->logopartner->create($input);
        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_partner.partner')]));
        return redirect()->route('admin.logopartner.index');
    }

    public function datatable()
    {
        $data = $this->logopartner->datatable();

        return Datatables::of($data)
            ->editColumn(
                'image',
                function ($data) {
                    return '<img src="'.$data->image.'" height="50px" width="150px"/>';
                })
            ->editColumn(
                'type',
                function ($data) {
                    if ($data->type == 1)
                        return 'Home Loan';
                    return 'Mortgage';
                })
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
                        'link_edit' => route('admin.logopartner.edit', $data->id),
                        'link_delete' => route('admin.logopartner.destroy', $data->id),
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

        $partner = $this->logopartner->find($id);

        return view('admin.logopartner.create_edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $input['type'] = (isset($input['type']) && $input['type'] != null) ? $input['type'] : 1;

        $input['active'] = (isset($input['active']) && $input['active'] != null) ? 1 : 0;

        $this->logopartner->update($input, $id);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_logopartner.logopartner')]));

        return back();
    }

    public function destroy($id)
    {
        $this->logopartner->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_logopartner.logopartner')]));

        return redirect()->back();
    }
}
