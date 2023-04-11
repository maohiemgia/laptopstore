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
            <div class="cupon_area">
                <div class="check_title">
                    <h2>
                        Có mã giảm giá?
                        <a href="#" onclick="displayCouponField()">Bấm để nhập mã giảm giá</a>
                    </h2>
                </div>
                <div class="row mx-0 flex-column justify-content-start align-items-start" id="enterCouponField">
                    <input type="text" placeholder="Nhập mã giảm giá" />
                    <a class="tp_btn" href="#">Áp dụng</a>
                </div>
            </div>
            <div class="billing_details">
                <form class="contact_form" action="/order/store" method="post" novalidate="novalidate">
                    @method('post')
                    @csrf

                    <div class="row mx-auto">
                        <div class="col-lg-8">
                            <h3>Chi tiết hóa đơn</h3>
                            <div class="row mx-0 contact_form" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                                        placeholder="Tên người nhận" />
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="customer_email" name="customer_email"
                                        placeholder="Email theo dõi đơn hàng" />
                                </div>
                                <div class="col-md-6 form-group p_star">
                                    <input type="text" class="form-control" id="customer_phone_number"
                                        name="customer_phone_number" placeholder="Số điện thoại nhận hàng" />
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="customer_address" name="customer_address"
                                        placeholder="Địa chỉ nhận hàng" />
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
                                            <span>30.000</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Tổng thanh toán
                                            <span id="totalCost">$2210.00</span>
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
                                        <img src="img/product/single-product/card.jpg" alt="" />
                                        <div class="check"></div>
                                    </div>

                                </div>
                                <button class="btn_3 w-100 mt-5" id="submitBtn" type="submit">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="total_cost" class="d-none" id="total_cost">
                    <input type="text" name="shipping_fee" value="30000" class="d-none" id="shipping_fee">
                </form>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->


    <script src="{{ asset('/js/cart/checkout.js') }}"></script>
@endsection
