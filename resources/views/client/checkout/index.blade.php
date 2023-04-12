@extends('client.master')

@section('style')
    <style>

    </style>
@endsection

{{-- content --}}
@section('main-content')
    <!--================Checkout Area =================-->
    <section class="checkout_area padding_top">
        <div class="container-fluid px-2 px-lg-5">
            <div class="returning_customer">
                <div class="check_title">
                    <h2>
                        Đăng nhập để lưu đơn hàng vào tài khoản
                        <a href="/login">Bấm để đăng nhập</a>
                    </h2>
                </div>
                <p>
                    Vui lòng điền thông tin người nhận
                </p>
            </div>
            {{-- notification apply success voucher --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                <button class="btn d-block btn-warning text-white" onclick="location.reload()">Bỏ dùng mã giảm giá?</button>
            @else
                <div class="cupon_area">
                    <div class="check_title">
                        <h2>
                            Có mã giảm giá?
                            <a href="#" onclick="displayCouponField()">Bấm để nhập mã giảm giá</a>
                        </h2>
                    </div>
                    <div class="row mx-0 mb-3 flex-column justify-content-start align-items-start" id="enterCouponField">
                        <form action="/checkvoucher" method="POST">
                            @method('post')
                            @csrf
                            <input type="text" name="name" placeholder="Nhập mã giảm giá" />
                            <button class="tp_btn" type="submit">Áp dụng</button>
                        </form>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger" style="max-width: 400px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endif
            <div class="billing_details">
                <form class="contact_form" action="/order/store" method="post" novalidate="novalidate">
                    @method('post')
                    @csrf

                    <div class="row mx-auto mt-3">
                        <div class="col-lg-8">
                            <h3>Chi tiết hóa đơn</h3>
                            <div class="row mx-0 contact_form" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                                        placeholder="Tên người nhận" />
                                    <span class="font-weight-lighter">*Bắt buộc nhập</span>
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="customer_email" name="customer_email"
                                        placeholder="Email theo dõi đơn hàng" />
                                    <span class="font-weight-lighter">*Bắt buộc nhập</span>
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="customer_phone_number"
                                        name="customer_phone_number" placeholder="Số điện thoại nhận hàng" />
                                    <span class="font-weight-lighter">*Bắt buộc nhập</span>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="customer_address" name="customer_address"
                                        placeholder="Địa chỉ nhận hàng" />
                                    <span class="font-weight-lighter">*Bắt buộc nhập</span>
                                </div>
                                <div class="col-md-12 form-group">
                                    <textarea class="form-control" name="note" id="note" rows="1" placeholder="Ghi chú"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Đơn hàng của bạn</h2>
                                <ul class="list" id="product-cart-detail-display">
                                    <li>
                                        <a href="#">Sản phẩm
                                            <span>Tổng</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="list list_2">
                                    <li>
                                        <a href="#">Tạm tính
                                            <span id="totalTemp">$2160.00</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Phí ship
                                            <span>+30.000</span>
                                        </a>
                                    </li>
                                    @if (session('voucher_return'))
                                        <li>
                                            <a href="#">Mã giảm giá
                                                @foreach (session('voucher_return') as $key => $value)
                                                    @if ($key == 'value')
                                                        <span id="valuevoucher">{{ $value }}</span>
                                                    @endif
                                                @endforeach
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="#">Tổng thanh toán
                                            <span class="font-weight-bolder" id="totalCost">$2210.00</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="payment_item mt-3 active">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option5" value="0" name="payment_type" checked />
                                        <label for="f-option5">Thanh toán khi nhận hàng</label>
                                        <div class="check"></div>
                                    </div>

                                </div>
                                <div class="payment_item mb-3">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option6" value="1" name="payment_type" disabled />
                                        <label for="f-option6">Thanh toán online(Đang bảo trì)</label>
                                        <div class="check"></div>
                                    </div>

                                </div>
                                <button class="btn_3 w-100 mt-5" id="submitBtn" type="submit">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="total_cost" class="d-none" id="total_cost">
                    <input type="text" name="shipping_fee" value="30000" class="d-none" id="shipping_fee">
                    <input type="text" name="discount_value" class="d-none" id="discount_value">
                </form>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->


    <script src="{{ asset('/js/cart/checkout.js') }}"></script>
@endsection
