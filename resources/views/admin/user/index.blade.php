@extends('admin.master')

{{-- page title --}}
@section('page-title', 'Quản lý user')

@section('page-name', 'Quản lý user')

{{-- style --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/category.css') }}">
@endsection

{{-- content --}}
@section('main-content')
    <div class="container-fluid mt-5 px-2">
        {{-- notification if success --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2>Danh sách user &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <p class="w-auto">
                Đây là danh sách tất cả
                <b>
                    user!
                </b>
            </p>
            <a href="/users/create" class="d-block btn btn-success text-white w-auto">&#43; Thêm mới</a>
        </div>
        {{-- show detail modal --}}
        <div class="row mx-auto my-3" id="category-detail">
            <!-- Modal -->
            <div class="modal fade" id="detailmodal" tabindex="-1" aria-labelledby="detailmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-capitalize" id="exampleModalLabel">
                                Chi tiết người dùng
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="table-display-detail">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive px-lg-5">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $u)
                    <tr class="text-bold">
                        <td>{{ ++$index }}</td>
                        <td class="text-success">{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->phone_number }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info classviewdetail" data-toggle="modal"
                                data-target="#detailmodal" data-attname="{{ $u->name }}"
                                id="viewid{{ $u->id }}">
                                Chi tiết
                            </button>
                            <a href="/users/{{ $u->id }}" class="btn btn-warning text-white">Sửa</a>

                            @if ($u->role != 1)
                                <button class="btn btn-danger" onclick="deleteConfirm('/users/{{ $u->id }}/delete')"
                                    data-toggle="modal" data-target="#deleteconfirmmodal">
                                    Xóa
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('admin.components.deleteconfirm')

    <a href="/" class="d-inline-block btn btn-primary text-white w-auto mt-2 mb-3">&larr; Trang chủ</a>
    </div>

    <script src="{{ asset('js/user/index.js') }}"></script>
    <script src="{{ asset('js/components/deleteconfirm.js') }}"></script>

@endsection
