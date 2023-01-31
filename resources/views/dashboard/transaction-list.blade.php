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
                        Transaction List
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
                                <th>Document Code</th>
                                <th>Document Number</th>
                                <th>Product Code</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Sub Total</th>
                                <th>Currency</th>
                                <th>Product Name</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($transaction as $data)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->document_code }}</td>
                                <td>{{ $data->document_number }}</td>
                                <td>{{ $data->product_code }}</td>
                                <td>{{ $data->price }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>{{ $data->unit }}</td>
                                <td>{{ $data->sub_total }}</td>
                                <td>{{ $data->currency }}</td>
                                <td>{{ $data->product->product_name }}</td>

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
