<div style="text-align: center; margin: 30px 0;font-family: 'Poppins', sans-serif;">
    <a href="{{ url('/') }}"
        style="font-weight: 700; font-size: 2rem; text-transform: uppercase; padding: 7px 15px; text-decoration: none; background-color: #dc3545; color: #fff;">
        TYPHOON
    </a>
    <h1 style="text-transform: capitalize">Xin chào {{ $orderdata['customer_name'] }}</h1>
    <p>
        Cảm ơn bạn đã tin tưởng và mua hàng, bên dưới là thông tin đơn hàng của bạn!
    </p>
</div>
<section
    style="max-width: 100%; padding: 30px 30px; display:flex;justify-content: center; font-family: 'Poppins', sans-serif;">
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; flex-wrap: wrap">
        <div>
            <div class="col-lg-6 col-lx-12" style="display:flex; justify-content: space-between">
                <div class="single_confirmation_details px-0">
                    <h4>Thông tin đơn hàng</h4>
                    <ul style="list-style: none; padding:0">
                        <li>
                            <span>Mã đơn</span><span>: {{ $orderdata['id'] }}</span>
                        </li>
                        <li>
                            <span>Ngày tạo</span><span>: {{ date('d/m/Y', strtotime($orderdata['created_at'])) }}</span>
                        </li>
                        <li>

                            <span>Tổng tiền</span>
                            <span>:
                                {{ number_format($orderdata['total_cost'], 0, ',', '.') }} VNĐ
                            </span>
                        </li>
                        <li>
                            <span class="pr-5">Phương thức thanh toán</span>
                            @if ($orderdata['payment_type'] == 0)
                                <span>: Thanh toán khi nhận hàng</span>
                            @else
                                <span>: Thanh toán online</span>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="single_confirmation_details px-0">
                    <h4>Thông tin nhận hàng</h4>
                    <ul style="list-style: none; padding:0">
                        <li>
                            <span>Tên người nhận</span><span>: {{ $orderdata['customer_name'] }}</span>
                        </li>
                        <li>
                            <span>Email người nhận</span><span class="text-break">:
                                {{ $orderdata['customer_email'] }}</span>
                        </li>
                        <li>
                            <span>Số máy nhận hàng</span><span>: {{ $orderdata['customer_phone_number'] }}</span>
                        </li>
                        <li>
                            <span>Địa chỉ</span><span>: {{ $orderdata['customer_address'] }}</span>
                        </li>
                    </ul>
                </div>
                <div class="single_confirmation_details px-0">
                    <h4>Trạng thái đơn</h4>
                    <ul style="list-style: none; padding:0">
                        <li>
                            <span>Trạng thái</span>
                            @if ($orderdata['status'] == 0)
                                <span>: Đã hủy</span>
                            @elseif ($orderdata['status'] == 1)
                                <span>: Đang gửi hàng</span>
                            @else
                                <span>: Đơn hàng đã hoàn thành</span>
                            @endif
                        </li>
                        <li>
                            <span>Ngày nhận hàng</span>
                            @if (is_null($orderdata['date_receive']))
                                <span>: Không rõ</span>
                            @else
                                <span>: {{ $orderdata['date_receive'] }}</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            @if ($orderdata['note'])
                <div class="col-lg-6 col-lx-12">
                    <div class="single_confirmation_details px-0">
                        <h4>Ghi chú</h4>
                        <ul style="list-style: none; padding:0">
                            <li>
                                <span>Ghi chú</span><span>: {{ $orderdata['note'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
        <div>
            <div style="max-width: 80vw">
                <h3>Chi tiết đơn hàng</h3>
                <table style="max-width: 70vw;">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th style="text-align: center;">Số lượng</th>
                            <th style="text-align: center;">Giá tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderdata['orderdetails'] as $odeta)
                            <tr>
                                <td
                                    style="border-bottom: 1px solid #96D4D4;
                                border-collapse: collapse; padding: 5px 0 12px 0">
                                    <span style="display:block;max-width: 50vw;">
                                        {{ $odeta['product_detail'] }}
                                    </span>
                                </td>
                                <td
                                    style="text-align: center; border-bottom: 1px solid #96D4D4;
                                border-collapse: collapse; padding: 5px 0 12px 0">
                                    {{ $odeta['quantity'] }}
                                </td>
                                <td
                                    style="text-align: center; border-bottom: 1px solid #96D4D4;
                                border-collapse: collapse; padding: 5px 0 12px 0">
                                    {{ number_format($odeta['price'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="border-top">
                            <th colspan="1"></th>
                            <th colspan="2" style="text-align: end;padding-top: 15px;">Tạm tính:
                                <span>{{ number_format($orderdata['total_cost'] - $orderdata['shipping_fee'] + $orderdata['discount_value'], 0, ',', '.') }}
                                    VNĐ</span>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="1"></th>
                            <th colspan="2" style="text-align: end;padding-top: 15px;">Phí ship:
                                <span> +{{ number_format($orderdata['shipping_fee'], 0, ',', '.') }} VNĐ</span>
                            </th>
                        </tr>
                        @if ($orderdata['discount_value'])
                            <tr>
                                <th colspan="1"></th>
                                <th colspan="2" style="text-align: end;padding-top: 15px;">Mã giảm giá:
                                    <span> -{{ number_format($orderdata['discount_value'], 0, ',', '.') }}
                                        VNĐ</span>
                                </th>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col" colspan="3"
                                style="text-align: end; font-size: 1.5rem; padding-top: 20px">
                                Tổng thanh toán:
                                <span style="color: #dc3545">
                                    {{ number_format($orderdata['total_cost'], 0, ',', '.') }}
                                    VNĐ
                                </span>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

<p style="text-align: center;font-family: 'Poppins', sans-serif;">Số điện thoại hỗ trợ: 0342.737.862</p>
