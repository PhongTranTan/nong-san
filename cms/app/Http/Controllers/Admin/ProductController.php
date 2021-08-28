<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTypeRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    protected $product;
    protected $productTypes;

    public function __construct(
        ProductRepository $product,
        ProductTypeRepository $productTypes
    )
    {
        $this->product = $product;
        $this->productTypes = $productTypes;
    }

    public function index()
    {
        Breadcrumb::title(trans('product.title'));
        return view('admin.product.index');
    }

    public function create()
    {
        Breadcrumb::title(trans('product.create'));
        $productTypes =  $this->productTypes->all();
        return view('admin.product.create_edit', compact(
            'productTypes'
        ));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $this->product->create($input);
        session()->flash(
            'success', 
            trans('admin_message.created_successful', [
                'attr' => trans('admin_product.product_type')
            ]));
        return redirect()->route('admin.product.index');
    }

    public function datatable()
    {
        $data = $this->product->datatable();
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
                        'link_edit' => route('admin.product.edit', $data->id),
                        'link_delete' => route('admin.product.destroy', $data->id),
                        'id_delete' => $data->id
                    ]
                )->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function edit($id)
    {
        Breadcrumb::title(trans('admin_product.edit'));
        $data = $this->product->find($id);
        $productTypes =  $this->productTypes->all();
        $metadata = $data->meta;
        return view('admin.product.create_edit', compact (
            'data',
            'metadata',
            'productTypes'
        ));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->product->update($input, $id);
        session()->flash(
            'success', 
            trans('admin_message.updated_successful', 
            ['attr' => trans('admin_product.product_type')]
        ));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->product->delete($id);

        session()->flash('success', trans('admin_message.deleted_successful', ['attr' => trans('admin_product.product_type')]));

        return redirect()->back();
    }
}