@extends('client.master')

@section('main-content')
    {{-- notification if success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="text-capitalize text-center d-flex flex-column align-items-center">
        <h3>hello this is page for client</h3>

        <p>
            vui lòng đăng nhập tài khoản admin để có thể quản trị web
        </p>
    </div>
@endsection
