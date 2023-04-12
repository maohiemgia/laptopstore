@extends('client.master')

@section('style')
    <style>
        .product-options {
            cursor: pointer;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
        }

        .product-options>span>b {
            color: #000;
        }

        .product-options.active::after {
            content: '\f00c';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 40px;
            color: #f02135;
            padding: 10px;
            width: fit-content;
            position: absolute;
            top: -40px;
            right: -25px;
        }

        .product-options:hover,
        .product-options.active {
            background: #28ac00;
            color: #fff;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
        }

        .product-options span {
            pointer-events: none;
        }
    </style>
@endsection

{{-- content --}}
@section('main-content')
    <!-- breadcrumb start-->
    <section class="breadcrumb mt-5 pt-5"
        style="background-image: url({{ asset($product->image) }});
  background-position: center;
  background-repeat: no-repeat;
  background-size: auto;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->
    <!--================End Home Banner Area =================-->

    <!--================Single Product Area =================-->
    <div class="product_image_area section_padding">
        <div class="container">
            <div class="row s_product_inner justify-content-between">
                <div class="col-lg-7 col-xl-7">
                    <div class="product_slider_img">
                        <div id="vertical">
                            <div data-thumb="{{ asset($product->image) }}">
                                <img src="{{ asset($product->image) }}" />
                            </div>
                            @foreach ($product->productgalleries as $p)
                                <div data-thumb="{{ asset($p->image) }}">
                                    <img src="{{ asset($p->image) }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4">
                    <div class="s_product_text">
                        <h3>
                            {{ $product->name }}
                        </h3>
                        @if (!is_null($product->productoptions->first()) && $product->productoptions->first()->discount_value > 0)
                            <span class="font-weight-lighter bg-danger text-white py-2 px-3 mb-3" id="optionsale"
                                style="display: block">
                                Đang Giảm
                                {{ number_format($product->productoptions->first()->discount_value, 0, ',', '.') }}
                                đ
                            </span>
                        @endif
                        <h2 id="pricedisplay">
                            @if (is_null($product->productoptions->first()))
                                Liên hệ 0342737862 lấy giá
                            @else
                                @if (!is_null($product->productoptions->first()) && $product->productoptions->first()->discount_value > 0)
                                    <span id="pricenow" class="pr-3">
                                        {{ number_format($product->productoptions->first()->price - $product->productoptions->first()->discount_value, 0, ',', '.') }}
                                        đ
                                    </span>
                                    <span id="optionprice" style="text-decoration: line-through">
                                        {{ number_format($product->productoptions->first()->price, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span id="optionprice">
                                        {{ number_format($product->productoptions->first()->price, 0, ',', '.') }}
                                    </span>
                                @endif
                                đ
                            @endif
                        </h2>
                        <ul class="list">
                            <li>
                                <a class="active" href="#">
                                    <span>Danh mục:</span> {{ $productcate->category->name }}/{{ $productcate->name }}</a>
                            </li>
                            @if (!is_null($product->productoptions->first()))
                                <li>
                                    <a href="#"> <span>Có sẵn:</span>
                                        <span id="optionquantity" class="w-auto pr-2">
                                            {{ $product->productoptions->first()->quantity }}
                                        </span>cái
                                    </a>
                                </li>
                            @endif
                        </ul>

                        @if (!is_null($product->productoptions->first()))
                            <div class="product-option-section my-3">
                                <span>Chọn cấu hình: </span>
                                <ul class="list">
                                    @foreach ($product->productoptions as $option)
                                        <li class="btn p-3 my-2 product-options" data-productid="{{ $product->id }}"
                                            data-optionid="{{ $option->id }}">
                                            <span class="d-inline-block">
                                                <b>CPU:</b>
                                                {{ $option->cpu }}
                                            </span>
                                            <span class="d-inline-block">
                                                <b>GPU:</b>
                                                {{ $option->gpu }}
                                            </span>
                                            <span class="d-inline-block">
                                                <b>RAM:</b>
                                                {{ $option->ram }}
                                            </span>
                                            <span class="d-inline-block">
                                                <b>Bộ Nhớ:</b>
                                                {{ $option->memory }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <p>
                                ✅Bảo hành chính hãng 12 tháng
                                <br>
                                ✅Giá ở trên đã bao gồm 10% VAT
                                <br>
                                ✅ MIỄN PHÍ GIAO HÀNG TẬN NHÀ
                            </p>
                            <div class="card_area d-flex justify-content-between align-items-center">
                                <div class="product_count">
                                    <span class="inumber-decrement" style="cursor: pointer;"><i class="ti-minus"></i></span>
                                    <input class="input-number" id="itemQuantity" type="text" value="1"
                                        min="1">
                                    <span class="number-increment" style="cursor: pointer;"> <i class="ti-plus"></i></span>
                                </div>
                                <button class="btn_3" id="addtocartbtn" data-toggle="popover" data-placement="right">
                                    Thêm vào giỏ
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Mô tả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Cấu hình chi tiết</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>
                        {{ $product->description }}
                    </p>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody id="optioninfo">
                                <tr>
                                    <td>
                                        Đang cập nhật...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->


    <script src="{{ asset('/js/product/detail.js') }}"></script>
@endsection
