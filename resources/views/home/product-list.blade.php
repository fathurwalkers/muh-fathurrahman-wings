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

    <div class="row mb-4">
        <div class="col-sm-12 col-md-12 col-lg-12 mt-2 d-flex justify-content-end border border-1 py-2">
            <form action="{{ route('checkout-product') }}" method="post">
                @csrf
                <input type="hidden" name="id_product" value="">
                <button class="btn btn-info btn-md ml-2" id="sendrequest">
                    Total Keranjang Belanja :
                    <span class="badge badge-light py-auto counterbadges" id="counterbadges">0</span>
                </button>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mb-4">

        @foreach ($product as $item)
            <div class="col-sm-4 col-md-4 col-lg-4 mb-2 mb-4">
                <div class="card mb-2" style="width: 12rem;">
                    <img class="card-img-top" style="" src="{{ asset('assets') }}/{{ $item->product_name }}.jpg"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->product_name }}</h5>
                        <p class="card-text">Rp. <strike>{{ number_format($item->price, 2, ',', '.') }}</strike></p>
                        @php
                            $harga_diskon = ($item->discount / 100) * $item->price;
                        @endphp
                        <p class="card-text">Rp. {{ number_format($harga_diskon, 2, ',', '.') }}</p>
                        <button type="button" class="btn btn-primary counters bukuid" value="{{ $item->id }}"">
                            Buy
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <br />
    <br />
    <br />
    <br />
@endsection

@push('js')

<script>
    let array_pinjaman = [];
    var token = $('meta[name="csrf-token"]').attr('content');
    var count = 0;
    var counterbadges = document.getElementById("counterbadges");
    $('.counters').click(function(){
        count++;
        counterbadges.innerHTML = count;
    });
    $("button").click(function() {
        var pinjaman = $(this).val();
        array_pinjaman.push(pinjaman);
        console.log(array_pinjaman);
        console.log(pinjaman);
    });
    $('#sendrequest').click(function() {
        $('input:hidden[name=id_product]').val(array_pinjaman);
    });
</script>

@endpush
