@extends('admin.master')

{{-- page title --}}
@section('page-title', 'Tạo mới danh mục')
@section('page-name', 'Tạo mới danh mục')

{{-- style --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/category.css') }}">
@endsection

{{-- content --}}
@section('main-content')
    <div class="container-fluid mt-5 px-2">
        <h2>Thêm mới danh mục &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <p class="w-auto">
                Vui lòng nhập theo biểu mẫu bên dưới để thêm mới danh mục.
            </p>
            <a href="/categories/create" class="d-block btn btn-success text-white w-auto">Làm mới</a>
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
        <form action="/categories/store" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                    placeholder="Tên danh mục sản phẩm..." required>
            </div>

            <div class="form-group" id="divParentCate">
                <label>Chọn danh mục cha</label>
                <select class="form-control" name="category_id" id="selectParentCate">
                </select>
            </div>

            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="hascategoryparent" value="option1">
                <label for="hascategoryparent" class="custom-control-label">Có danh mục cha</label>
            </div>

            <button type="submit" class="btn btn-danger my-3">Lưu</button>
        </form>


        <a href="/categories" class="d-inline-block btn btn-primary text-white w-auto mt-4 mb-3">&larr; Quản lý danh mục</a>
    </div>

    <script src="{{ asset('js/category/create.js') }}"></script>

@endsection
