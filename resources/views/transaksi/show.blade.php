@extends('custom-layouts.app')

@section('header','Lihar Data Transaksi')

@section('content')
    {{-- dynamic content--}}
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('transaksi.store')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label for="nama_klien" class="col-2">Nama Klien</label>
                            <div class="col-9">
                                <input name="nama_klien" id="nama_klien" value="{{$transaksi->nama_klien}}" class="form-control" type="text" readonly placeholder="Isikan nama klien"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat_klien" class="col-2">Alamat Klien</label>
                            <div class="col-9">
                                <input name="alamat_klien" id="alamat_klien" value="{{$transaksi->alamat_klien}}"  class="form-control" type="text" readonly placeholder="Isikan alamat"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ponsel_klien" class="col-2">Nomor HP</label>
                            <div class="col-9">
                                <input name="ponsel_klien" id="ponsel_klien"  value="{{$transaksi->ponsel_klien}}" class="form-control" type="number" readonly placeholder="Isikan nomor hp"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ponsel_klien" class="col-2">Nomor Invoice</label>
                            <div class="col-9">
                                @if($transaksi->invoice != null)
                                <input name="ponsel_klien" id="ponsel_klien"  value="{{$transaksi->invoice}}" class="form-control" type="number" readonly placeholder="Isikan nomor hp"/>
                                @else
                                    
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($total = 0)
                        @foreach($detail as $key=>$value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$value->produk->nama_produk}}</td>
                                <td>{{$value->harga}}</td>
                                <td>{{$value->jumlah}}</td>
                                <td>{{$value->subtotal_harga}}</td>
                            </tr>
                            @php($total+=$value->subtotal_harga)
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td>{{$total}}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
