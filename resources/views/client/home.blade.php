@extends('client.master')

@section('style')
    <style>
        .owl-nav {
            display: none;
        }
    </style>
@endsection

{{-- content --}}
@section('main-content')
    <!-- banner part start-->
    <section class="banner_part mt-5">
        <div class="container mt-5 mx-auto">
            <div class="row mx-auto align-items-center">
                <div class="col-lg-12">
                    <div class="banner_slider owl-carousel" style="cursor: pointer">
                        @foreach ($headerbanners as $headerbanner)
                            <div class="single_banner_slider">
                                <div class="row mx-auto">
                                    <img src="{{ asset($headerbanner->image) }}" alt="banner">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- feature_part start-->
    <section class="feature_part padding_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center text-capitalize">
                        <h2>Sản phẩm nổi bật</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                @foreach ($featureproducts as $index => $item)
                    @if ($index == 0 || $index == 3)
                        <div class="col-lg-7 col-sm-6">
                        @else
                            <div class="col-lg-5 col-sm-6">
                    @endif
                    <div class="single_feature_post_text" style="cursor: pointer"
                        onclick="location.href='/product-detail/{{ $item->product->id }}'">
                        {{-- <p>Premium Quality</p> --}}
                        <h3 class="bg-light p-1 text-wrap position-absolute" style="z-index: 3;top:20%">
                            {{ $item->product->name }}</h3>
                        <a href="#" class="feature_btn text-uppercase bg-danger text-white p-2"
                            style="bottom: 40%;left:40%">
                            Xem ngay
                            <i class="fas fa-play text-white"></i>
                        </a>
                        <img src="{{ asset($item->product->image) }}" alt="product">
                    </div>
            </div>
            @endforeach
        </div>
        </div>
    </section>
    <!-- upcoming_event part start-->

    <!-- product_list start-->
    <section class="product_list section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center d-flex justify-content-between align-items-start">
                        <h2 class="text-capitalize m-0">Sản phẩm mới</h2>
                        <a href="/product-list" class="d-block btn btn-outline-secondary">
                            Xem thêm >>>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mx-auto align-items-center justify-content-between">
                        @foreach ($newproducts as $product)
                            <div class="col-lg-3 col-sm-6">
                                <div class="single_product_item"
                                    onclick="location.href='/product-detail/{{ $product->id }}'">
                                    <img src="{{ asset($product->image) }}" alt="product">
                                    <div class="single_product_text">
                                        <h4>{{ $product->name }}</h4>
                                        @if (is_null($product->productoptions->first()))
                                            <h3>Giá liên hệ</h3>
                                        @else
                                            <h3>
                                                {{ number_format($product->productoptions->first()->price, 0, ',', '.') }}
                                                đ
                                            </h3>
                                        @endif
                                        <a class="add_cart text-center btn">
                                           <i class="fas fa-search fa-lg" style="color: #e40d0d;"></i>
                                            Xem chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_list part start-->

    <!-- awesome_shop start-->
    {{-- <section class="our_offer section_padding">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-md-6">
                    <div class="offer_img">
                        <img src="img/offer_img.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="offer_text">
                        <h2>Weekly Sale on
                            60% Off All Products</h2>
                        <div class="date_countdown">
                            <div id="timer">
                                <div id="days" class="date"></div>
                                <div id="hours" class="date"></div>
                                <div id="minutes" class="date"></div>
                                <div id="seconds" class="date"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="enter email address"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <a href="#" class="input-group-text btn_2" id="basic-addon2">book now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- awesome_shop part start-->

    <!-- product_list part start-->
    {{-- <section class="product_list best_seller section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Best Sellers <span>shop</span></h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class="best_product_slider owl-carousel">
                        <div class="single_product_item">
                            <img src="img/product/product_1.png" alt="">
                            <div class="single_product_text">
                                <h4>Quartz Belt Watch</h4>
                                <h3>$150.00</h3>
                            </div>
                        </div>
                        <div class="single_product_item">
                            <img src="img/product/product_2.png" alt="">
                            <div class="single_product_text">
                                <h4>Quartz Belt Watch</h4>
                                <h3>$150.00</h3>
                            </div>
                        </div>
                        <div class="single_product_item">
                            <img src="img/product/product_3.png" alt="">
                            <div class="single_product_text">
                                <h4>Quartz Belt Watch</h4>
                                <h3>$150.00</h3>
                            </div>
                        </div>
                        <div class="single_product_item">
                            <img src="img/product/product_4.png" alt="">
                            <div class="single_product_text">
                                <h4>Quartz Belt Watch</h4>
                                <h3>$150.00</h3>
                            </div>
                        </div>
                        <div class="single_product_item">
                            <img src="img/product/product_5.png" alt="">
                            <div class="single_product_text">
                                <h4>Quartz Belt Watch</h4>
                                <h3>$150.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- product_list part end-->

    <!-- subscribe_area part start-->
    {{-- <section class="subscribe_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="subscribe_area_text text-center">
                        <h5>Join Our Newsletter</h5>
                        <h2>Subscribe to get Updated
                            with new offers</h2>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="enter email address"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <a href="#" class="input-group-text btn_2" id="basic-addon2">subscribe now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--::subscribe_area part end::-->

    <!-- subscribe_area part start-->
    {{-- <section class="client_logo padding_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_1.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_2.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_3.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_4.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_5.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_3.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_1.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_2.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_3.png" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="img/client_logo/client_logo_4.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--::subscribe_area part end::-->
@endsection
