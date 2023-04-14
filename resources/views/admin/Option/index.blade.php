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

        <h2>Danh sách phiên bản sản phẩm &#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <a href="/option/create?id={{$id}}" class="d-block btn btn-success text-white w-auto">&#43; Thêm mới</a>
        </div>

        <table class="table">
            <thead>
                <tr class=" text-center">
                    <th  scope="col">STT</th>
                    <th  scope="col">Tên sản phẩm</th>
                    <th  scope="col">CPU</th>
                    <th  scope="col">GPU</th>
                    <th  scope="col">RAM</th>
                    <th  scope="col">MEMORY</th>
                    <th  scope="col">Quantity</th>
                    <th  scope="col">Price</th>
                    <th  scope="col">Status</th>
                    <th  scope="col" colspan="3">Hành động</th>
                </tr>
            </thead>
            <tbody id="table">
                
            </tbody>
          </table>

            

        <a href="/products" class="d-inline-block btn btn-primary text-white w-auto mt-2 mb-3">&larr; Trang chủ</a>
    </div>

    <script src="{{ asset('js/option/index.js') }}"></script>
@endsection
