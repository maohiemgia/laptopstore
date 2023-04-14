@extends('admin.master')

{{-- page title --}}
@section('page_title', 'Quản lý đơn hàng')

{{-- style --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/order.css') }}">
@endsection

{{-- content --}}
@section('main-content')
    <div class="container-fluid mt-5 px-2 px-lg-5">
        {{-- notification if success --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2>Danh sách đơn hàng &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
        </div>

        <table class="table">
            <thead>
                <tr class=" text-center">
                    <th  scope="col">STT</th>
                    <th  scope="col">Họ và tên</th>
                    <th  scope="col">Địa chỉ</th>
                    <th  scope="col">Số điện thoại</th>
                    <th  scope="col">Tổng hóa đơn</th>
                    <th  scope="col">Giảm giá</th>
                    <th  scope="col">Trạng thái</th>
                    <th  scope="col" colspan="3">Hành động</th>
                </tr>
            </thead>
            <tbody id="table">
                
            </tbody>
          </table>
        <a href="/dashboard" class="d-inline-block btn btn-primary text-white w-auto mt-2 mb-3">&larr; Trang chủ</a>
        <div id="detail" class="row">
        </div>
    </div>

    <script src="{{ asset('js/order/index.js') }}"></script>
@endsection
