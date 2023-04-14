@extends('admin.master')

{{-- page title --}}
@section('page_title', 'Tạo mới mã giảm giá')

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
        <h2>Thêm mới mã giảm giá &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <p class="w-auto">
                Vui lòng nhập theo biểu mẫu bên dưới để thêm mới mã giảm giá.
            </p>
            <a href="/vouchers/create" class="d-block btn btn-success text-white w-auto">Làm mới</a>
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
        <form action="{{ route('vouchers.store') }}" method="POST" class='row' enctype="multipart/form-data">
            @csrf
            <div class="form-group col-6">
                <label for="id">Mã giảm giá:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                    placeholder="Mã giảm giá">
            </div>
            <div class="form-group col-6">
                <label for="id">Giá trị:</label>
                <input type="text" id="value" name="value" class="form-control" placeholder="Giá trị mã giảm giá" value="{{ old('value') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">Điều kiện áp dụng:</label>
                <input type="text" id="require_money" name="require_money" class="form-control" placeholder="Ex: Giá trị đơn hàng từ 10.000.000 VND" value="{{ old('require_money') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">Số lượng:</label>
                <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Số lượng mã giảm giá" value="{{ old('quantity') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">Ngày hết hạn: </label>
                <input type="date" id="date_expired" name="date_expired" class="form-control" placeholder="Ngày hết hạn" value="{{ old('date_expired') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">Status: </label>
                <select name="status" id="status" class="form-control">
                    <option value="" hidden></option>
                    <option value="1">Áp dụng</option>
                    <option value="0">Không áp dụng</option>
                </select>
            </div>
            <div class="form-group col-12">
                <label for="id">Mô tả: </label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="col-12">
                <button id="submit" class="btn btn-danger my-3">Lưu</button>
            </div>
        </form>


        <a href="/vouchers" class="d-inline-block btn btn-primary text-white w-auto mt-4 mb-3">&larr; Quản lý mã giảm giá</a>
    </div>

    <script src="{{ asset('js/voucher/create.js') }}"></script>
@endsection

