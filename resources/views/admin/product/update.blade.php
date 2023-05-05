@extends('admin.master')

{{-- page title --}}
@section('page_title', 'Cập nhật sản phẩm')

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
        <h2>Cập nhật sản phẩm &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <p class="w-auto">
                Vui lòng nhập theo biểu mẫu bên dưới để cập nhật sản phẩm.
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
                <label for="id">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" class="form-control"
                    placeholder="Tên sản phẩm">
            </div>
            <div class="form-group col-6">
                <label for="id">Tên danh mục</label>
                <select id="category" name="category_id" class="form-control">
                </select>
            </div>
            <div class="form-group col-6">
                <label for="id">Tên loại:</label>
                <select id="subCategories" name="sub_category_id" class="form-control">
                </select>
            </div>
            <div class="form-group col-6">
                <label for="id">Ảnh sản phẩm:</label>
                <input type="file" id="image" name="image" class="form-control"
                    placeholder="Ảnh sản phẩm" accept="image/*">
            </div>
            <div class="form-group col-12">
                <label for="id">Mô tả: </label>
                <textarea id="desc" name="description" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button id="submit" class="btn btn-danger my-3">Lưu</button>
        </form>
        <a href="/products" class="d-inline-block btn btn-primary text-white w-auto mt-4 mb-3">&larr; Quản lý sản phẩm</a>
    </div>

    <script type="module"  src="{{ asset('js/product/update.js') }}"></script>
@endsection
