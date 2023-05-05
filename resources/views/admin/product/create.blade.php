@extends('admin.master')

{{-- page title --}}
@section('page_title', 'Tạo mới sản phẩm')

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
        <h2>Thêm mới sản phẩm &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <p class="w-auto">
                Vui lòng nhập theo biểu mẫu bên dưới để thêm mới sản phẩm.
            </p>
            <a href="/products/create" class="d-block btn btn-success text-white w-auto">Làm mới</a>
        </div>
        {{-- notification if success --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Display any validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger" style="max-width: 400px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Display a form to add a new category -->
        <form action="{{ route('products.store') }}" method="POST" class='row' enctype="multipart/form-data">
            @csrf
            <div class="form-group col-6">
                <label for="id">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                    placeholder="Tên sản phẩm">
            </div>
            <div class="form-group col-6">
                <label for="id">Tên danh mục</label>
                <select id="category" name="category_id" class="form-control" value="{{ old('category_id') }}">
                </select>
            </div>
            <div class="form-group col-6">
                <label for="id">Tên loại:</label>
                <select id="subCategories" name="sub_category_id" class="form-control" value="{{ old('sub_category_id') }}">

                </select>
            </div>
            <div class="form-group col-6">
                <label for="id">Ảnh sản phẩm:</label>
                <input type="file" id="image" name="image" class="form-control" value="{{ old('image') }}"
                    placeholder="Ảnh sản phẩm" accept="image/*">
            </div>
            <div class="form-group col-6">
                <label for="id">Ảnh slide sản phẩm:</label>
                <input type="file" id="image" name="slide_image[]" class="form-control"
                    value="{{ old('slide_image') }}" placeholder="Ảnh sản phẩm" accept="image/*" multiple>
            </div>
            <div class="form-group col-12">
                <label for="id">Mô tả: </label>
                <textarea id="desc" name="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
            </div>
            <button id="submit" class="btn btn-danger my-3">Lưu</button>
        </form>


        <a href="/products" class="d-inline-block btn btn-primary text-white w-auto mt-4 mb-3">&larr; Quản lý sản phẩm</a>
    </div>

    <script  type="module" src="{{ asset('js/product/create.js') }}"></script>
@endsection
