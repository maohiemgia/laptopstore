@extends('client.master')

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
                                <th scope="col" style="min-width: 100px;">Giá (vnđ)</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col" style="min-width: 100px;">Tổng tiền (vnđ)</th>
                            </tr>
                        </thead>
                        <tbody id="cart-detail-display">
                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right mb-5 mb-lg-0" id="gocheckout-section"></div>
                </div>
            </div>
    </section>

    <!--================End Cart Area =================-->
    <script src="{{ asset('/js/cart/detail.js') }}"></script>
@endsection
