@extends('admin.master')

{{-- page title --}}
@section('page_title', 'Quản lý phiên bản')

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

        table th {
            vertical-align: middle !important;
            text-align: center;
        }

        table td {
            word-wrap: break-word;
            text-align: center;
        }

        .mybtn_func {
            position: fixed;
            right: 3%;
            top: 90%;
            transform: translateY(-50%);
            background-color: #ffca2c;
            color: white;
            border: none;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.25);
        }

        #myBtnUp:hover,
        #myBtnDown:hover {
            background-color: #3e8e41;
        }
    </style>
@endpush

{{-- content --}}
@section('main-content')
    <div class="container-fluid mt-5 px-2 px-lg-5">
        {{-- notification if success --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2>Danh sách mã giảm giá &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <a href="/vouchers/create" class="d-block btn btn-success text-white w-auto">&#43; Thêm mới</a>
        </div>

        <table class="table">
            <thead>
                <tr class=" text-center">
                    <th  scope="col">STT</th>
                    <th  scope="col">Mã giảm giá</th>
                    <th  scope="col">Giá trị</th>
                    <th  scope="col">Điều kiện áp dụng</th>
                    <th  scope="col">Số lượng</th>
                    <th  scope="col">Đã sử dụng</th>
                    <th  scope="col">Ngày hết hạn</th>
                    <th  scope="col">Mô tả</th>
                    <th  scope="col">Trạng thái</th>
                    <th  scope="col" colspan="3">Hành động</th>
                </tr>
            </thead>
            <tbody id="table">
                
            </tbody>
          </table>
          <nav aria-label="Page navigation example" class="d-flex justify-content-center">
            <ul  id="paginate" class="pagination">

            </ul>
        </nav>
        <a href="/dashboard" class="d-inline-block btn btn-primary text-white w-auto mt-2 mb-3">&larr; Trang chủ</a>
    </div>

    <script type="module"  src="{{ asset('js/voucher/index.js') }}"></script>
@endsection
