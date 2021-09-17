@extends('custom-layouts.cetak')

@section('judul_halaman',$transaksi->invoice)
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="invoice-title">
                <div class="mb-4">
                    <img src="{{asset('veltrix/assets/images/logo-sm.png')}}" alt="logo" height="25"/>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <address>
                        <strong>Info Kami</strong><br>
                        <hr style="width: 50%;margin-right: 50%">
                        Nama Perusahaan<br>
                        Alamat<br>
                        Nomor Telepon
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <address>
                        <strong>Tagih Untuk:</strong><br>
                        <hr style="width: 50%;margin-left: 50%">
                        {{$transaksi->nama_klien}}<br>
                        {{$transaksi->ponsel_klien}}<br>
                        {{$transaksi->alamat_klien}}
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-6 m-t-30">
                    <address>
                        <table>
                            <tr>
                                <td>No. Invoice</td>
                                <td> : </td>
                                <td>{{$transaksi->invoice}}</td>
                            </tr>
                            <tr>
                                <td>Pembayaran</td>
                                <td> : </td>
                                <td>{{$status->va_numbers[0]->bank}}</td>
                            </tr>
                            <tr>
                                <td>Kode Pembayaran</td>
                                <td> : </td>
                                <td>{{$status->va_numbers[0]->va_number}}</td>
                            </tr>
                        </table>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div>
                <div class="p-2">
                    <h5 class="font-16"><strong>Ringkasan Pesanan</strong></h5>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <td><strong>No</strong></td>
                                <td class="text-center"><strong>Nama Produk</strong></td>
                                <td class="text-center"><strong>Kuantitas</strong>
                                </td><td class="text-center"><strong>Harga</strong>
                                </td>
                                <td class="text-right"><strong>Subtotal</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($detail as $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="text-center">{{$value->produk->nama_produk}}</td>
                                <td class="text-center">{{$value->jumlah}}</td>
                                <td class="text-center">{{$value->harga}}</td>
                                <td class="text-right">{{$value->subtotal_harga}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center">
                                    <strong>Total</strong></td>
                                <td class="no-line text-right"><strong>{{number_format($status->gross_amount)}}</strong></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-9">
            <address>
                Pesan : <br>
                <br>
                @php
                    $stop_date = new DateTime($status->transaction_time);
                    $stop_date->modify('+1 day');
                    echo 'Waktu Kadaluarsa ' . $stop_date->format('Y-m-d H:i:s');
                @endphp
                <hr style="margin-right: 20%">
            </address>
        </div>
        <div class="col-3 text-center float-right pl-5">
            <address>
                @php
                    $trans_date = new DateTime($status->transaction_time);
                    echo $trans_date->format('Y-m-d');
                @endphp<br>
                <br>
                <br>
                Finance
            </address>
        </div>
    </div>

@endsection
