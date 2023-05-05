@extends('admin.master')

{{-- page title --}}
@section('page_title', 'Cập nhật đơn hàng')

{{-- style --}}

@push('style')
    <style>
        html {
            scroll-behavior: smooth;

        }

        * {
            cursor: pointer;
            user-select: none;
        }
    </style>
@endpush


{{-- content --}}
@section('main-content')
    <div class="container-fluid mt-5 px-2 px-lg-5">
        <h2>Cập nhật trạng thái đơn hàng &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <p class="w-auto">
                Vui lòng nhập theo biểu mẫu bên dưới để cập nhật trạng thái đơn hàng.
            </p>
        </div>
        <!-- Display any validation errors -->
        @if ($errors->any())
            <div class="alert bg-danger text-white">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Display a form to add a new category -->
        <form action="" method="POST" class='row' enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group col-6">
                <label for="id">Status: </label>
                <select name="status" id="status" class="form-control">
                    <option value="" hidden></option>
                    <option value="0">Canceled</option>
                    <option value="1">Shipping</option>
                    <option value="2">Completed</option>
                </select>
            </div>
            <div class="col-12">
                <button id="submit" class="btn btn-danger my-3">Lưu</button>
            </div>
        </form>
        {{-- <a href="/option?id={{$id}}">&larr; Quản lý phiên bản</a> --}}
        <button class="d-inline-block btn btn-primary w-auto mt-4 mb-3">
            <a href="/orders" class="text-white" >&larr; Quản lý đơn hàng</a>
        </button>
    </div>

    <script type="module"  src="{{ asset('js/order/update.js') }}"></script>
@endsection
