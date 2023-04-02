@extends('admin.master')

{{-- page title --}}
@section('page_title', 'Quản lý danh mục')

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
@push('before_scripts')
    <script>
        // When the user scrolls down Xpx from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                document.getElementById("myBtnUp").style.display = "block";
            } else {
                document.getElementById("myBtnUp").style.display = "none";
            }
            if (document.body.scrollTop > 1500 || document.documentElement.scrollTop > 1500) {
                document.getElementById("myBtnDown").style.display = "none";
            } else {
                document.getElementById("myBtnDown").style.display = "block";
            }

        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        function bottomFunction() {
            document.documentElement.scrollTop = document.documentElement.scrollHeight;
        }
    </script>
@endpush

{{-- content --}}
@section('main-content')
    <div class="container-fluid mt-5 px-2 px-lg-5">
        {{-- notification if success --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                {{dd( session('success'))}}
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

        <div class="table-responsive px-lg-5">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Số danh mục con</th>
                        <th>Số sản phẩm</th>
                        {{-- <th>Chức năng</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td class="text-success">{{ $category->name }}</td>
                            <td class="text-muted">{{ $category->subcat_count }}</td>
                            <td class="text-muted">{{ $category->prod_count }}</td>
                            {{-- <td class="bg-danger text-white w-25">
                                <a href="/categories/{{ $category->id }}/soft-delete">
                                    Xóa
                                </a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="/" class="d-inline-block btn btn-primary text-white w-auto mt-2 mb-3">&larr; Trang chủ</a>
    </div>

@endsection
