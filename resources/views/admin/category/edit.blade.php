@extends('admin.master')

{{-- page title --}}
@section('page-title', 'Cập nhật danh mục')
@section('page-name', 'Cập nhật danh mục')

{{-- style --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/category.css') }}">
@endsection

{{-- content --}}
@section('main-content')
    <div class="container-fluid mt-5 px-2 px-lg-5">
        <h2>Cập nhật danh mục &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <p class="w-auto">
                Vui lòng nhập theo biểu mẫu bên dưới để cập nhật danh mục.
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

        @isset($subcategory)
            <!-- Display a form to add a new category -->
            <form action="/categories/sub/{{ $subcategory->id }}" method="POST">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $subcategory->name }}"
                        placeholder="Tên danh mục sản phẩm..." required>
                </div>

                <div class="form-group" id="divParentCate">
                    <label>Chọn danh mục cha</label>
                    <select class="form-control" name="category_id" id="selectParentCate" data-subcateid={{ $subcategory->category_id }}>
                    </select>
                </div>

                <button type="submit" class="btn btn-danger my-3">Cập nhật</button>
            </form>
        @endisset

        @isset($category)
            <!-- Display a form to add a new category -->
            <form action="/categories/{{ $category->id }}" method="POST">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}"
                        placeholder="Tên danh mục sản phẩm..." required>
                </div>

                <button type="submit" class="btn btn-danger my-3">Cập nhật</button>
            </form>
        @endisset


        <a href="/categories" class="d-inline-block btn btn-primary text-white w-auto mt-4 mb-3">&larr; Quản lý danh mục</a>
    </div>

    <script src="{{ asset('js/category/update.js') }}"></script>

@endsection
