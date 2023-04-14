@extends('client.master')

@section('style')
@endsection

{{-- content --}}
@section('main-content')
    <!--================Tracking Box Area =================-->
    <section class="tracking_box_area padding_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="tracking_box_inner">
                        <h2>Theo dõi đơn hàng</h2>
                        <p>Để theo dõi đơn hàng của bạn, vui lòng nhập ID đơn hàng của bạn vào ô bên dưới và nhấn nút "Theo
                            dõi". Chúng tôi sẽ kiểm tra email khớp với đơn hàng.</p>
                        <form class="row tracking_form" action="/matchorder" method="post" novalidate="novalidate">
                            @method('post')
                            @csrf

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="order" name="order_id" value="{{ old('order_id') }}"
                                    placeholder="ID đơn hàng">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="customer_email" value="{{ old('customer_email') }}"
                                    placeholder="Địa chỉ email">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="btn_3">Theo dõi</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- Display any validation errors -->
            @if ($errors->any())
                <div class="mt-5 alert bg-danger text-white">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>
    <!--================End Tracking Box Area =================-->
@endsection
