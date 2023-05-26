@extends('client.master')

{{-- content --}}
@section('main-content')
    <div class="container-fluid mt-5 px-2 pt-5">
        <h2>Quản lý đơn hàng &#127808;</h2>

        <div class="table-responsive px-lg-5">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn</th>
                        <th>Trạng thái đơn</th>
                        <th>Tên Khách</th>
                        <th>Email</th>
                        <th>Nơi nhận</th>
                        <th>Số điện thoại</th>
                        <th>Ghi chú</th>
                        <th>Tiền ship</th>
                        <th>Tiền thuế</th>
                        <th>Giảm giá</th>
                        <th>Tổng tiền</th>
                        <th>Kiểu thanh toán</th>
                        <th>Ngày mua</th>
                        <th>Ngày nhận</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orders) < 1)
                        <tr class="text-bold">
                            <td colspan="999" class="text-center"> Bạn chưa mua sắm lần nào :(( </td>
                        </tr>
                    @else
                        @foreach ($orders as $index => $order)
                            <tr class="text-bold">
                                <td>{{ ++$index }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->status == 0 ? 'Đã hủy' : ($order->status == 1 ? 'Đang giao hàng' : 'Đã nhận hàng') }}</td>
                                <td class="text-success">{{ $order->customer_name ?? 'Không rõ' }}</td>
                                <td>{{ $order->customer_email ?? 'Không rõ' }}</td>
                                <td>{{ $order->customer_address ?? 'Không rõ' }}</td>
                                <td>{{ $order->customer_phone_number ?? 'Không rõ' }}</td>
                                <td>{{ $order->note ?? 'Không rõ' }}</td>
                                <td>{{ number_format($order->shipping_fee, 0, ',', '.') }}Đ</td>
                                <td>{{ number_format($order->tax_fee, 0, ',', '.') }}Đ</td>
                                <td>{{ number_format($order->discount_value, 0, ',', '.') }}Đ</td>
                                <td>{{ number_format($order->total_cost, 0, ',', '.') }}Đ</td>
                                <td>{{ $order->payment_type == false ? 'Khi nhận hàng' : 'Online' }}</td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($order->created_at)) ?? 'Không rõ' }}</td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($order->date_receive)) ?? 'Chưa nhận hàng' }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
