@extends('client.master')

@section('style')
@endsection

{{-- content --}}
@section('main-content')
    <!--================ confirmation part start =================-->
    <section class="confirmation_part padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="confirmation_tittle">
                        <span>Cảm ơn bạn. Đơn đặt hàng của bạn đã được chấp nhận.</span>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Thông tin đơn hàng</h4>
                        <ul>
                            <li>
                                <p>Mã đơn</p><span>: {{ $order->id }}</span>
                            </li>
                            <li>
                                <p>Ngày tạo</p><span>: {{ date('d-m-Y', strtotime($order->created_at)) }}</span>
                            </li>
                            <li>

                                <p>Tổng tiền</p>
                                <span>:
                                    {{ number_format($order->total_cost, 0, ',', '.') }} vnđ
                                </span>
                            </li>
                            <li>
                                <p>Phương thức thanh toán</p>
                                @if ($order->payment_type == 0)
                                    <span>: Thanh toán khi nhận hàng</span>
                                @else
                                    <span>: Thanh toán online</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Địa chỉ nhận hàng</h4>
                        <ul>
                            <li>
                                <p>Địa chỉ</p><span>: {{ $order->customer_address }}</span>
                            </li>
                            {{-- <li>
                                <p>city</p><span>: Los Angeles</span>
                            </li>
                            <li>
                                <p>country</p><span>: United States</span>
                            </li>
                            <li>
                                <p>postcode</p><span>: 36952</span>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Ghi chú</h4>
                        <ul>
                            <li>
                                <p>Ghi chú</p><span>: {{ $order->note }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-4">
                    <div class="single_confirmation_details">
                        <h4>Trạng thái đơn</h4>
                        <ul>
                            <li>
                                <p>Trạng thái</p>
                                @if ($order->status == 0)
                                    <span>: Đã hủy</span>
                                @elseif ($order->status == 1)
                                    <span>: Đang gửi hàng</span>
                                @else
                                    <span>: Đơn hàng đã hoàn thành</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- {{ $order->orderdetails[0] }} --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="order_details_iner">
                        <h3>Chi tiết đơn hàng</h3>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">Sản phẩm</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($order->orderdetails as $odeta)
                                    <tr>
                                        <th colspan="2"><span>{{ $odeta }}</span></th>
                                        <th>x02</th>
                                        <th> <span>$720.00</span></th>
                                    </tr>
                                @endforeach --}}
                                <tr>
                                    <th colspan="3">Tạm tính</th>
                                    <th> <span>{{ $order->total_cost }}</span></th>
                                </tr>
                                <tr>
                                    <th colspan="3">Phí ship</th>
                                    <th><span>{{ $order->shipping_fee }}</span></th>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col" colspan="3">Tổng tiền</th>
                                    <th scope="col">{{ $order->total_cost + $order->shipping_fee }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ confirmation part end =================-->

    <script>localStorage.clear();</script>
    
    <script src="{{ asset('/js/cart/detail.js') }}"></script>
@endsection
