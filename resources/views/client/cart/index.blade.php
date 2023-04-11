@extends('client.master')

@section('style')
    <style>
        .input-number-minus,
        .input-number-plus {
            position: absolute;
            right: 0;
            padding: 7px;
            border-left: 1px solid #dddddd;
            display: inline-block;
            cursor: pointer;
        }

        .input-number-minus {
            bottom: -9px;
        }

        .input-number-plus {
            top: -7px;
        }
    </style>
@endsection

{{-- content --}}
@section('main-content')
    <!--================Cart Area =================-->
    <section class="cart_area padding_top">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Giá (vnđ)</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng tiền (vnđ)</th>
                            </tr>
                        </thead>
                        <tbody id="cart-detail-display">
                            <tr class="bottom_button">
                                <td>
                                    <a class="btn_1" href="#">Cập nhật giỏ hàng</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="cupon_text float-right">
                                        <a class="btn_1" style="opacity: 0" href="#">Close Coupon</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Tổng tiền (vnđ)</h5>
                                </td>
                                <td class="px-0">
                                    <h5 id="totalcostnotship">$2160.00</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        <a class="btn_1" href="/product-list">Tiếp tục mua sắm</a>
                        <a class="btn_1 bg-success text-white checkout_btn_1" href="/checkout">Tiếp tục thanh toán</a>
                    </div>
                </div>
            </div>
    </section>
    <!--================End Cart Area =================-->
    <script src="{{ asset('/js/cart/detail.js') }}"></script>
@endsection
