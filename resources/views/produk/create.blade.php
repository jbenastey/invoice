@extends('custom-layouts.app')

@section('header','Tambah Data Produk')

@section('content')
    {{-- dynamic content--}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('produk.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label for="nama_produk" class="col-2">Nama Produk</label>
                            <div class="col-9">
                                <input name="nama_produk" id="nama_produk" class="form-control" type="text" required placeholder="Isikan nama produk"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-2">Harga</label>
                            <div class="col-9">
                                <input name="harga" id="harga" class="form-control" type="number" required placeholder="Isikan harga"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stok" class="col-2">Stok</label>
                            <div class="col-9">
                                <input name="stok" id="stok" class="form-control" type="number" required placeholder="Isikan stok"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gambar" class="col-2">Gambar</label>
                            <div class="col-9">
                                <input name="gambar" type="file" class="dropify" data-allowed-file-extensions="jpg jpeg png"  required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-2">Deskripsi</label>
                            <div class="col-9">
                                <textarea id="deskripsi" name="deskripsi" rows="2" class="form-control" required placeholder="Isikan deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-2"></div>
                            <div class="col-2 d-flex justify-content-start">
                                <div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                <a href="{{route('produk.index')}}" class="btn btn-light">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
