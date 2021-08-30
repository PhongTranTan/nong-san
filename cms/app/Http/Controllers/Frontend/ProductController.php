<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Repositories\ProductTypeRepository;

class ProductController extends Controller
{
    protected $product;
    protected $productTypes;

    public function __construct(
        ProductRepository $product,
        ProductTypeRepository $productTypes
    )
    {
        parent::__construct();
        $this->product = $product;
        $this->productTypes = $productTypes;
    }

    public function getProductDetail($slug)
    {
        $product = $this->product->findBySlug($slug);
        if (!$product) {
            return abort('404');
        }
        $metadata = $product->meta;
        $productRela = $this->product->getRelated($product->id);
        $productTypes = $this->productTypes
            ->datatable()
            ->active()
            ->get();
        return view('frontend.products.detail', compact(
            'product',
            'metadata',
            'productRela'
        ));
    }
}
