@extends('admin.master')

{{-- page title --}}
@section('page-title', 'Quản lý danh mục')

@section('page-name', 'Quản lý danh mục')

{{-- style --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/category.css') }}">
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

        <h2>Danh sách danh mục sản phẩm &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <p class="w-auto">
                Đây là danh sách tất cả
                <b>
                    danh mục sản phẩm!
                </b>
            </p>
            <a href="/categories/create" class="d-block btn btn-success text-white w-auto">&#43; Thêm mới</a>
        </div>

        <div class="row mx-auto my-3" id="category-detail">

            <form id="delete-form" action="" method="POST" class="d-none">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>


            <!-- Modal -->
            <div class="modal fade" id="detailmodal" tabindex="-1" aria-labelledby="detailmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-capitalize" id="exampleModalLabel">
                                Danh sách danh mục con
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive px-lg-5">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên</th>
                                            <th>Danh mục cha</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-display-detail"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="table-responsive px-lg-5">
            <h3>Danh sách danh mục cha</h3>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Số danh mục con</th>
                        <th>Số sản phẩm</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                        @if (is_null($category->deleted_at))
                            <tr class="text-bold">
                                <td>{{ ++$index }}</td>
                                <td class="text-success">{{ $category->name }}</td>
                                <td>{{ $category->subcat_count }}</td>
                                <td>{{ $category->prod_count }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info classviewdetail" data-toggle="modal"
                                        data-target="#detailmodal" data-catename="{{ $category->name }}"
                                        id="viewid{{ $category->id }}">
                                        Xem chi tiết
                                    </button>
                                    <a href="/categories/{{ $category->id }}" class="btn btn-warning text-white">Sửa</a>

                                    @if (!is_null($category->deleted_at))
                                        <form action="/categories/{{ $category->id }}/restore" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-danger" type="submit">Phục hồi</button>
                                        </form>
                                    @else
                                        <form action="api/categories/{{ $category->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Xóa</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <h3 class="mt-4">Danh sách danh mục cha đã xóa</h3>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Số danh mục con</th>
                        <th>Số sản phẩm</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                        @if (!is_null($category->deleted_at))
                            <tr class="bg-secondary text-bold">
                                <td>{{ ++$index }}</td>
                                <td class="text-success">{{ $category->name }}</td>
                                <td>{{ $category->subcat_count }}</td>
                                <td>{{ $category->prod_count }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info classviewdetail" data-toggle="modal"
                                        data-target="#detailmodal" data-catename="{{ $category->name }}"
                                        id="viewid{{ $category->id }}">
                                        Xem chi tiết
                                    </button>
                                    <a href="/categories/{{ $category->id }}" class="btn btn-warning text-white">Sửa</a>

                                    @if (!is_null($category->deleted_at))
                                        <form action="/categories/{{ $category->id }}/restore" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-danger" type="submit">Phục hồi</button>
                                        </form>
                                    @else
                                        <form action="api/categories/{{ $category->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Xóa</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="/" class="d-inline-block btn btn-primary text-white w-auto mt-2 mb-3">&larr; Trang chủ</a>
    </div>

    <script src="{{ asset('js/category/index.js') }}"></script>

@endsection
