@extends('layouts.dashboard-layouts')
@section('title', 'Ujian Kepolisian')
@section('content-prefix', 'Beranda')
@section('content-header', 'Dashboard - Beranda')

@push('css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables') }}/datatables.min.css"> --}}
    <link href="{{ asset('datatables') }}/datatables.min.css" rel="stylesheet">
@endpush

@section('main-content')

<div class="card mb-3">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <h4>
                    <b>
                        Product List
                    </b>
                </h4>
            </div>
            <hr />
            <div class="row">
                <div class="table-responsive">
                    <table id="example" class="display table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Price</th>
                                <th>Currency</th>
                                <th>Discount</th>
                                <th>Dimension</th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($product as $data)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->product_name }}</td>
                                <td>{{ $data->product_code }}</td>
                                <td>{{ $data->price }}</td>
                                <td>{{ $data->currency }}</td>
                                <td>{{ $data->discount }}</td>
                                <td>{{ $data->dimension }}</td>
                                <td>{{ $data->unit }}</td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
    <script src="{{ asset('datatables') }}/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
