@extends('client.master')

@section('style')
@endsection

{{-- content --}}
@section('main-content')
<!--================ confirmation part start =================-->
<section class="confirmation_part padding_top">
        <h2 class="text-center text-capitalize">Chi tiết đơn hàng ID: {{ $order->id }}</h2>

        <div class="container-fluid">
            <div class="row mx-auto">
                <div class="col-lg-6 col-lx-12">
                    <div class="single_confirmation_details px-0">
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
                                <p class="pr-5">Phương thức thanh toán</p>
                                @if ($order->payment_type == 0)
                                    <span>: Thanh toán khi nhận hàng</span>
                                @else
                                    <span>: Thanh toán online</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-lx-12">
                    <div class="single_confirmation_details px-0">
                        <h4>Thông tin nhận hàng</h4>
                        <ul>
                            <li>
                                <p>Tên người nhận</p><span>: {{ $order->customer_name }}</span>
                            </li>
                            <li>
                                <p>Email người nhận</p><span class="text-break">: {{ $order->customer_email }}</span>
                            </li>
                            <li>
                                <p>Số máy nhận hàng</p><span>: {{ $order->customer_phone_number }}</span>
                            </li>
                            <li>
                                <p>Địa chỉ</p><span>: {{ $order->customer_address }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @if ($order->note)
                    <div class="col-lg-6 col-lx-12">
                        <div class="single_confirmation_details px-0">
                            <h4>Ghi chú</h4>
                            <ul>
                                <li>
                                    <p>Ghi chú</p><span>: {{ $order->note }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="col-lg-6 col-lx-12">
                    <div class="single_confirmation_details px-0">
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
                            <li>
                                <p>Ngày nhận hàng</p>
                                @if (is_null($order->date_receive))
                                    <span>: Không rõ</span>
                                @else
                                    <span>: {{ $order->date_receive }}</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- {{ $order->orderdetails[0] }} --}}
            <div class="row mx-auto">
                <div class="col-lg-12">
                    <div class="order_details_iner px-0 px-lg-5 mx-0 mx-lg-5">
                        <h3>Chi tiết đơn hàng</h3>
                        <table class="table table-borderless px-0 table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2" class="px-0">Sản phẩm</th>
                                    <th scope="col" style="min-width: 200px;">Số lượng</th>
                                    <th scope="col3">Giá tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderdetails as $odeta)
                                    <tr class="border-bottom">
                                        <td class="px-0 pr-lg-5" colspan="2"><span
                                                style="white-space: normal;
                                            overflow: hidden;
                                            text-overflow: hidden;
                                            max-width: 15px;">{{ $odeta->product_detail }}</span>
                                        </td>
                                        <td>{{ $odeta->quantity }}</td>
                                        <td>{{ number_format($odeta->price, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr class="border-top">
                                    <th colspan="2"></th>
                                    <th colspan="2">Tạm tính:
                                        <span>{{ number_format($order->total_cost - $order->shipping_fee + $order->discount_value, 0, ',', '.') }}
                                            VNĐ</span>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2"></th>
                                    <th colspan="2">Phí ship:
                                        <span> +{{ number_format($order->shipping_fee, 0, ',', '.') }} VNĐ</span>
                                    </th>
                                </tr>
                                @if ($order->discount_value)
                                    <tr>
                                        <th colspan="2"></th>

                                        <th colspan="2">Mã giảm giá:
                                            <span> -{{ number_format($order->discount_value, 0, ',', '.') }} VNĐ</span>
                                        </th>
                                    </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col" colspan="4" class="text-right">
                                        Tổng thanh toán:
                                        <span class="font-weight-bold fa-2x">
                                            {{ number_format($order->total_cost, 0, ',', '.') }}
                                            VNĐ
                                        </span>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ confirmation part end =================-->

    <script>
        localStorage.clear();
        document.cookie = 'productOptions=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'
    </script>
@endsection
