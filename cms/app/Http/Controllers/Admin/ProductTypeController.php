<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Repositories\ProductTypeRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductTypeController extends Controller
{
    protected $productType;

    public function __construct(
        ProductTypeRepository $productType
      )
    {
        $this->productType = $productType;
    }

    public function index()
    {
        Breadcrumb::title(trans('product_type.title'));

        return view('admin.product_type.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('product_type.create'));
        return view('admin.product_type.create_edit');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $this->productType->create($input);
        session()->flash(
            'success', 
            trans('admin_message.created_successful', [
                'attr' => trans('admin_product_type.product_type')
            ]));
        return redirect()->route('admin.product.types.index');
    }

    public function datatable()
    {
        $data = $this->productType->datatable();
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
                        'link_edit' => route('admin.product.types.edit', $data->id),
                        'link_delete' => route('admin.product.types.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function edit($id)
    {
        Breadcrumb::title(trans('admin_product_type.edit'));
        $data = $this->productType->find($id);
        $metadata = $data->meta;
        return view('admin.product_type.create_edit', compact (
            'data',
            'metadata'
        ));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->productType->update($input, $id);
        session()->flash(
            'success', 
            trans('admin_message.updated_successful', 
            ['attr' => trans('admin_product_type.product_type')]
        ));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->productType->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_product_type.product_type')]));

        return redirect()->back();
    }
}