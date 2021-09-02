@extends('custom-layouts.app')

@section('header','Tambah Data Transaksi')

@section('content')
    {{-- dynamic content--}}
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('transaksi-detail.store')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label for="id_produk" class="col-2">Nama Produk</label>
                            <div class="col-9">
                                <select class="form-control select2 " name="id_produk" id="id_produk" data-placeholder="Pilih Produk">
                                    <option selected disabled>Pilih Produk</option>
                                    @foreach($produk as $key=>$value)
                                        <option value="{{$value->id}}">{{$value->nama_produk}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-2">Jumlah</label>
                            <div class="col-9">
                                <input type="hidden" class="form-control" id="harga" name="harga" required>
                                <input type="number" id="jumlah" class="form-control" name="jumlah" required placeholder="Jumlah Produk" maxlength="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2"></div>
                            <div class="col-2 d-flex justify-content-start">
                                <div>
                                    <button type="submit" class="btn btn-primary">Tambah Produk</button>
                                </div>
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
                                <td>{{$value->produk->nama_produk}} - <a href="{{route('transaksi-detail.destroy',$value->id)}}" class="text-danger" onclick="return confirm('Hapus? ')">Hapus</a></td>
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
        @if(count($detail)>0)
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('transaksi.store')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label for="nama_klien" class="col-2">Nama Klien</label>
                            <div class="col-9">
                                <input name="nama_klien" id="nama_klien" class="form-control" type="text" required placeholder="Isikan nama klien"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat_klien" class="col-2">Alamat Klien</label>
                            <div class="col-9">
                                <input name="alamat_klien" id="alamat_klien" class="form-control" type="text" required placeholder="Isikan alamat"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ponsel_klien" class="col-2">Nomor HP</label>
                            <div class="col-9">
                                <input name="ponsel_klien" id="ponsel_klien" class="form-control" type="number" required placeholder="Isikan nomor hp"/>
                                <input name="total_harga" id="total_harga" class="form-control" type="hidden" value="{{$total}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email_klien" class="col-2">Email</label>
                            <div class="col-9">
                                <input name="email_klien" id="email_klien" class="form-control" type="email" required placeholder="Isikan email"/>
                                <input name="total_harga" id="total_harga" class="form-control" type="hidden" value="{{$total}}"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2"></div>
                            <div class="col-2 d-flex justify-content-start">
                                <div>
                                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
