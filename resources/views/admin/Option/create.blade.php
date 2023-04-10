@extends('admin.master')

{{-- page title --}}
@section('page_title', 'Tạo mới phiên bản')

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
        <h2>Thêm mới phiên bản&#127808;</h2>
        <div class="row mx-auto my-3 d-flex justify-content-between">
            <p class="w-auto">
                Vui lòng nhập theo biểu mẫu bên dưới để thêm mới phiên bản.
            </p>
            <a href="/option/create?id={{$id}}" class="d-block btn btn-success text-white w-auto">Làm mới</a>
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
        <form action="{{ route('option.store') }}" method="POST" class='row' enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$id}}">
            <div class="form-group col-6">
                <label for="id">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                    placeholder="Tên sản phẩm" readonly>
            </div>
            <div class="form-group col-6">
                <label for="id">CPU:</label>
                <input type="text" id="cpu" name="cpu" class="form-control" placeholder="CPU" value="{{ old('cpu') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">GPU:</label>
                <input type="text" id="gpu" name="gpu" class="form-control" placeholder="GPU" value="{{ old('gpu') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">RAM:</label>
                <input type="text" id="ram" name="ram" class="form-control" placeholder="RAM" value="{{ old('ram') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">Memory: </label>
                <input type="text" id="memory" name="memory" class="form-control" placeholder="memory" value="{{ old('memory') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">Quantity: </label>
                <input type="number" id="quantity" name="quantity" class="form-control" placeholder="quantity" value="{{ old('quantity') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">Price: </label>
                <input type="text" id="price" name="price" class="form-control" placeholder="price" value="{{ old('price') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">Status: </label>
                <select name="status" id="status" class="form-control">
                    <option value="" hidden></option>
                    <option value="0">Ngừng kinh doanh</option>
                    <option value="1">Đang kinh doanh</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="id">Battery: </label>
                <input type="text" id="battery" name="battery" class="form-control" placeholder="battery" value="{{ old('battery') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">Size: </label>
                <input type="text" id="size" name="size" class="form-control" placeholder="size" value="{{ old('size') }}">
            </div>
            <div class="form-group col-6">
                <label for="id">Weight: </label>
                <input type="text" id="weight" name="weight" class="form-control" placeholder="weight" value="{{ old('weight') }}">
            </div>
            <div class="col-12">
                <button id="submit" class="btn btn-danger my-3">Lưu</button>
            </div>
        </form>


        <a href="/option?id={{$id}}" class="d-inline-block btn btn-primary text-white w-auto mt-4 mb-3">&larr; Quản lý phiên bản</a>
    </div>

    <script src="{{ asset('js/option/create.js') }}"></script>
@endsection

