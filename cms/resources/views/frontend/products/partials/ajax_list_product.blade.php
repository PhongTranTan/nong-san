@if (isset($products))
    @foreach ( $products as $key => $product)
        @if ($key % 2 == 0)
            <div class="col-lg-3 col-md-6 special-grid best-seller">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <div class="type-lb">
                            <p class="sale">Giảm Giá</p>
                        </div>
                        <img src="{{ $product->images ?? 'images/img-pro-01.jpg'}}" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li>
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>{{ $product->name }}</h4>
                        <h5>{{ number_format($product->price) }} đ</h5>
                    </div>
                </div>
            </div>
        @else
            <div class="col-lg-3 col-md-6 special-grid top-featured">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        <div class="type-lb">
                            <p class="new">Mới</p>
                        </div>
                        <img src="{{ $product->images ?? 'images/img-pro-02.jpg'}}" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li>
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>{{ $product->name }}</h4>
                        <h5>{{ number_format($product->price) }} đ</h5>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif
{{ $products->links('paginations.index') }}