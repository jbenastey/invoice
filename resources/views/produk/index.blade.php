@extends('custom-layouts.app')
@section('header')
    Data Produk

    <a href="{{ route('produk.create') }}">
        <i class="fas fa-plus-circle"></i>
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table " id="datatable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Foto</th>
                            <th>Deskripsi</th>
                            <th>
                                Aksi
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produk as $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$value->nama_produk}}</td>
                                <td>{{$value->harga}}</td>
                                <td>{{$value->stok}}</td>
                                <td>
                                    <a class="image-popup-no-margins" href="{{asset($value->gambar)}}">
                                        <img class="img-fluid" alt="" src="{{asset($value->gambar)}}" width="75">
                                    </a>
                                </td>
                                <td>{{$value->deskripsi}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
