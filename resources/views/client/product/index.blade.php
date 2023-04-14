@extends('client.master')

{{-- content --}}
@section('main-content')
    <!--================Category Product Area =================-->
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <form method="GET" action="{{ route('product.filter') }}">
                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Hãng</h3>
                                </div>
                                <div class="widgets_inner">
                                    <ul class="list">
                                        @foreach ($categories as $c)
                                            <li class="d-flex flex-column">
                                                <label>
                                                    <input type="checkbox" name="category_ids[]" value="{{ $c->id }}"
                                                        {{ in_array($c->id, request('category_ids', [])) ? 'checked' : '' }}>
                                                    {{ $c->name }}
                                                    <span class="badge badge-primary badge-pill">
                                                        ({{ $c->subcategories_count }})
                                                    </span>
                                                    <span class="badge badge-primary badge-pill">
                                                        ({{ $c->products_count }})
                                                    </span>
                                                </label>
                                                <ul>
                                                    @foreach ($c->subcategories as $s)
                                                        <li class="m-0 pl-5 py-1">
                                                            <label>
                                                                <input type="checkbox" name="subcategory_ids[]"
                                                                    value="{{ $s->id }}"
                                                                    {{ in_array($s->id, request('subcategory_ids', [])) ? 'checked' : '' }}>
                                                                {{ $s->name }}
                                                                <span class="badge badge-primary badge-pill">
                                                                    ({{ $s->sub_products_count }})
                                                                </span>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </aside>
                            <aside class="left_widgets p_filter_widgets">
                                <div class="l_w_title">
                                    <h3>Giá</h3>
                                </div>
                                <div class="widgets_inner">
                                    <ul class="list">
                                        <li>
                                            <label>
                                                <input type="radio" name="price_order" value="desc"
                                                    {{ request('price_order') === 'desc' ? 'checked' : '' }} checked>
                                                Giá giảm dần
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input type="radio" name="price_order" value="asc"
                                                    {{ request('price_order') === 'asc' ? 'checked' : '' }}>
                                                Giá tăng dần
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                            <button class="btn btn-info text-white px-5 py-2 ml-4" type="submit">Lọc</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">
                                <div class="single_product_menu">
                                    <p><span>{{ $newproducts->total() }} </span> sản phẩm tìm được</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center latest_product_inner">
                        @foreach ($newproducts as $product)
                            <div class="col-lg-4 col-sm-6">
                                <div class="single_product_item"
                                    onclick="location.href='/product-detail/{{ $product->id }}'">
                                    @if (!is_null($product->productoptions->first()) && $product->productoptions->first()->discount_value > 0)
                                        <span class="bg-danger p-2 px-3 text-white position-absolute" style="right: 20px;">
                                            Giảm
                                            {{ number_format($product->productoptions->first()->discount_value, 0, ',', '.') }}
                                            đ
                                        </span>
                                    @endif
                                    <img src="{{ $product->image }}" alt="product">
                                    <div class="single_product_text">
                                        <h4>
                                            {{ $product->name }}</h4>
                                        <h3>
                                            Giá:
                                            @if (is_null($product->productoptions->first()))
                                                Liên hệ 0342737862
                                            @else
                                                @if (!is_null($product->productoptions->first()) && $product->productoptions->first()->discount_value > 0)
                                                    {{ number_format($product->productoptions->first()->price - $product->productoptions->first()->discount_value, 0, ',', '.') }}
                                                    đ
                                                @else
                                                    {{ number_format($product->productoptions->first()->price, 0, ',', '.') }}
                                                    đ
                                                @endif
                                            @endif
                                        </h3>
                                        <a class="add_cart btn">
                                            <i class="fas fa-search fa-lg" style="color: #e40d0d;"></i>
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($newproducts->lastPage() > 1)
                            <div class="col-lg-12">
                                <div class="pageination">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $newproducts->previousPageUrl() . (isset(request()->price_order) ? '&price_order=' . request()->price_order : '') . (isset(request()->category_ids) ? '&category_ids[]=' . implode('&category_ids[]=', request()->category_ids) : '') . (isset(request()->subcategory_ids) ? '&subcategory_ids[]=' . implode('&subcategory_ids[]=', request()->subcategory_ids) : '') }}"
                                                    aria-label="Previous">
                                                    <i class="ti-angle-double-left"></i>
                                                </a>
                                            </li>
                                            @for ($i = 0; $i < $newproducts->lastPage(); $i++)
                                                <li
                                                    class="page-item {{ $newproducts->currentPage() == $i + 1 ? 'active' : '' }}">
                                                    <a class="page-link px-3"
                                                        href="/filter?page={{ $i + 1 }}{{ isset(request()->price_order) ? '&price_order=' . request()->price_order : '' }}{{ isset(request()->category_ids) ? '&category_ids[]=' . implode('&category_ids[]=', request()->category_ids) : '' }}{{ isset(request()->subcategory_ids) ? '&subcategory_ids[]=' . implode('&subcategory_ids[]=', request()->subcategory_ids) : '' }}">
                                                        {{ $i + 1 }}
                                                    </a>
                                                </li>
                                            @endfor
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $newproducts->nextPageUrl() . (isset(request()->price_order) ? '&price_order=' . request()->price_order : '') . (isset(request()->category_ids) ? '&category_ids[]=' . implode('&category_ids[]=', request()->category_ids) : '') . (isset(request()->subcategory_ids) ? '&subcategory_ids[]=' . implode('&subcategory_ids[]=', request()->subcategory_ids) : '') }}"
                                                    aria-label="Next">
                                                    <i class="ti-angle-double-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->

    <!-- product_list part start-->
    <section class="product_list best_seller">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Sản phẩm Bán chạy</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class="best_product_slider owl-carousel">
                        @foreach ($bestseller as $item)
                            <div class="single_product_item" onclick="location.href='/product-detail/{{ $item->id }}'">
                                <img src="{{ asset($item->image) }}" alt="product">
                                <div class="single_product_text">
                                    <h4>{{ $item->name }}</h4>
                                    <h3>
                                        <span class="badge badge-success">
                                            Đã bán {{ $item->total_sales }}
                                        </span>
                                    </h3>
                                    <h3>{{ number_format($item->price, 0, ',', '.') }} đ</h3>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_list part end-->
@endsection
