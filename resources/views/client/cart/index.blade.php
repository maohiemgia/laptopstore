@extends('client.master')

{{-- page title --}}
@section('page-title', 'Laptop TT')

{{-- style --}}
@section('style')
@endsection

{{-- content --}}
@section('main-content')
    <div style="padding: 100px 0 70px;">
        <div class="container">
            <div>
                <button class="btn btn-primary d-block">
                    &larr; Trở về
                </button>
                <h2 class="text-center fa-2x">Giỏ hàng</h2>
            </div>
            <div class="text-center">
                @php
                    $totalMoney = 0;
                @endphp
                @foreach ($cart as $item)
                    <p>{{ $item->item->product->name }}</p>
                    <p>{{ $item->item->cpu }}, {{ $item->item->gpu }}, {{ $item->item->ram }}, {{ $item->item->memory }}</p>
                    <p>{{ $item->item->price - $item->item->discount_value }}</p>
                    <p>{{ $item->quantity }}</p>
                    @php
                        $totalMoney += ($item->item->price - $item->item->discount_value) * $item->quantity;
                    @endphp
                @endforeach

                <p>Tổng tiền: {{ $totalMoney }}</p>

                <a href="" class="btn btn-primary">Thanh toán</a>
                {{-- <div class="section-header">
                    <div class="sale bg-2">
                        <p>sale</p>
                    </div>
                    <img src="assets/images/collection/arrivals7.png" alt="new-arrivals images">
                </div> --}}
            </div>
        </div>
    </div>
@endsection
