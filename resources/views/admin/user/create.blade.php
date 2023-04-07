@extends('admin.master')

{{-- page title --}}
@section('page-title', 'Tạo mới user')
@section('page-name', 'Tạo mới user')

{{-- style --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/category.css') }}">
@endsection

{{-- content --}}
@section('main-content')
    <div class="container-fluid mt-5 px-2">
        <h2>Tạo mới user &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <p class="w-auto">
                Vui lòng nhập theo biểu mẫu bên dưới để tạo mới tài khoản.
            </p>
            <a href="/users/create" class="d-block btn btn-success text-white w-auto">Làm mới</a>
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
        <form action="/users/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mx-auto d-flex flex-wrap justify-content-start align-items-center">
                <div class="form-group flex-fill mx-0 mx-lg-3">
                    <label for="name">Tên hiển thị</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                        placeholder="Tên danh mục sản phẩm..." required>
                </div>
                <div class="form-group flex-fill mx-0 mx-lg-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                        placeholder="abcxyz@gmail.com" required>
                </div>
                <div class="form-group flex-fill mx-0 mx-lg-3">
                    <label for="password">Mật khẩu</label>
                    <input type="text" name="password" id="password" class="form-control" value="{{ old('password') }}"
                        placeholder="Nhập mật khẩu" required>
                </div>
                <div class="form-group flex-fill mx-0 mx-lg-3">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" name="phone_number" id="sdt" class="form-control"
                        value="{{ old('phone_number') }}" placeholder="0342737737">
                </div>
                <div class="form-group flex-fill mx-0 mx-lg-3" id="divParentCate">
                    <label>Chọn giới tính</label>
                    <select class="form-control text-capitalize" name="gender" id="selectParentCate">
                        <option selected disabled>Vui lòng chọn giới tính</option>
                        <option value="nam">nam</option>
                        <option value="nữ">nữ</option>
                    </select>
                </div>

                <!-- Date -->
                <div class="form-group flex-fill mx-0 mx-lg-3">
                    <label>Ngày sinh:</label>
                    <div class="input-group">
                        <input type="date" name="birthday" class="form-control" />
                    </div>
                </div>
                <div class="form-group flex-fill mx-0 mx-lg-3">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}"
                        placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group flex-fill mx-0 mx-lg-3">
                    <label>Avatar:</label>
                    <div class="input-group">
                        <input type="file" name="image" id="img-upload" class="d-block form-control"
                            accept="image/*" />
                    </div>
                </div>
                <div class="form-group w-100 d-flex justify-content-center">
                    <img src="{{ asset('/images/1680696159.jpg') }}" class="img-rounded img-fluid"
                        style="width:200px;height:200px" alt="img preview" id="img-preview">
                </div>
            </div>
            <button type="submit" class="btn btn-danger my-3 d-block">
                Lưu
            </button>
        </form>


        <a href="/users" class="d-inline-block btn btn-primary text-white w-auto mt-4 mb-3">&larr; Quản lý người dùng</a>
    </div>

    <script src="{{ asset('js/user/create.js') }}"></script>

@endsection
