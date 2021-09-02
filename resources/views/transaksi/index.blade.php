@extends('custom-layouts.app')
@section('header')
    Data Transaksi

    <a href="{{ route('transaksi.create') }}">
        <i class="fas fa-plus-circle"></i>
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Nama Klien</th>
                            <th>Nomor HP</th>
                            <th>Total Harga</th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transaksi as $key=>$value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if($value->invoice == null)
                                        <span class="badge badge-pill badge-warning">Belum ada invoice</span>
                                    @else
                                        {{$value->invoice}}
                                    @endif
                                </td>
                                <td>{{$value->nama_klien}}</td>
                                <td>{{$value->ponsel_klien}}</td>
                                <td>{{$value->total_harga}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-success waves-effect waves-light">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
