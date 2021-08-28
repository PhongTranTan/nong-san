<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\SiborRatesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Breadcrumb;
use Yajra\DataTables\Facades\DataTables;

class SiborRatesController extends Controller
{
	protected $sibor_rates;

    public function __construct(SiborRatesRepository $sibor_rates)
    {
        parent::__construct();
        $this->sibor_rates = $sibor_rates;
    }

    public function index()
    {
        Breadcrumb::title(trans('admin_contact.title'));
        return view('admin.sibor_rates.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('admin_sibor_rates.create'));

        return view('admin.sibor_rates.create_edit');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['date'] = \Carbon\Carbon::createFromFormat("d/m/Y", $input['date'])->format("Y-m-d");
        if(isset($input['month_sibor'])){
            $input['month_sibor'] = json_encode($input['month_sibor'], true);
        }else{
            $input['month_sibor'] = null;
        }
        if(isset($input['percent_sibor'])){
            $input['percent_sibor'] = json_encode($input['percent_sibor'], true);
        }else{
            $input['percent_sibor'] = null;
        }
        $this->sibor_rates->create($input);
        session()->flash('success', trans('admin_message.created_successful', ['attr' => trans('admin_sibor_rates.sibor_rates')]));
        return redirect()->route('admin.siborrates.index');
    }

    public function datatable()
    {
        $data = $this->sibor_rates->datatable();

        return Datatables::of($data)
            ->editColumn(
                'type',
                function ($data) {
                    if ($data->type)
                        return 'SOR Rates';
                    return 'SIBOR Rates';
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
                        'link_edit' => route('admin.siborrates.edit', $data->id),
                        'link_delete' => route('admin.siborrates.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);

    }

    public function edit($id)
    {
        \App\Helper\Breadcrumb::title(trans('admin_sibor_rates.edit'));

        $sibor_rates = $this->sibor_rates->find($id);

        return view('admin.sibor_rates.create_edit', compact('sibor_rates'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $input['date'] = \Carbon\Carbon::createFromFormat("d/m/Y", $input['date'])->format("Y-m-d");
        if(isset($input['month_sibor'])){
            $input['month_sibor'] = json_encode($input['month_sibor'], true);
        }else{
            $input['month_sibor'] = null;
        }
        if(isset($input['percent_sibor'])){
            $input['percent_sibor'] = json_encode($input['percent_sibor'], true);
        }else{
            $input['percent_sibor'] = null;
        }
        $this->sibor_rates->update($input, $id);

        session()->flash('success', trans('admin_message.updated_successful', ['attr' => trans('admin_product_category.sibor_rates')]));

        return back();
    }

    public function destroy($id)
    {
        $this->sibor_rates->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_product_category.sibor_rates')]));

        return redirect()->back();
    }
}
