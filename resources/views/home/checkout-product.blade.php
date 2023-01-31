@extends('layouts.client-layout')

@push('css')
    <style>
        /* .container {
                                height: 800px!important;
                            } */
    </style>
@endpush

@section('tombol-keluar')
@endsection

@section('main-content')
    <div class="row mt-1 mb-1">
        <div class="col-sm-12 col-md-12 col-lg-12">
            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-center mb-4">

        <div class="row">
            <div class="card">
                <div class="card-body">
                    {{-- @dd($product) --}}
                    @foreach ($product as $item)
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                <img src="{{ asset('assets') }}/{{$item->product_name}}.jpg" width="80px" alt="">
                                            </div>
                                            <div class="col-sm-8 col-md-8 col-lg-8">
                                                {{ $item['product_name'] }} <br>
                                                <p class="card-text">Rp. <strike>{{ number_format($item->price, 2, ',', '.') }}</strike></p>
                                                @php
                                                    $harga_diskon = ($item->discount / 100) * $item->price;
                                                @endphp
                                                <p class="card-text">Rp. {{ number_format($harga_diskon, 2, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            @php
                                $array_product2 = [];
                            @endphp
                            @foreach ($product as $item2)
                                @php
                                    $product2 = array_push($array_product2, $item2->id);
                                @endphp
                            @endforeach
                            @php
                                $implode_array_product = implode(",", $array_product2);
                            @endphp
                            <form action="{{ route('proses-checkout', $implode_array_product) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_request">
                                <button type="submit" class="btn btn-success shadow">
                                    CHECKOUT
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <br />
    <br />
    <br />
    <br />
@endsection

@push('js')
@endpush
