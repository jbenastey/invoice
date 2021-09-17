@extends('custom-layouts.cetak')

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
                        Nama Client<br>
                        Alamat<br>
                        Nomor Telepon
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
                                <td>asddasad</td>
                            </tr>
                            <tr>
                                <td>Pembayaran</td>
                                <td> : </td>
                                <td>asddasad</td>
                            </tr>
                            <tr>
                                <td>Kode Pembayaran</td>
                                <td> : </td>
                                <td>asddasad</td>
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
                                </td>
                                <td class="text-right"><strong>Harga</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <tr>
                                <td>BS-200</td>
                                <td class="text-center">$10.99</td>
                                <td class="text-center">1</td>
                                <td class="text-right">$10.99</td>
                            </tr>
                            <tr>
                                <td>BS-400</td>
                                <td class="text-center">$20.00</td>
                                <td class="text-center">3</td>
                                <td class="text-right">$60.00</td>
                            </tr>
                            <tr>
                                <td>BS-1000</td>
                                <td class="text-center">$600.00</td>
                                <td class="text-center">1</td>
                                <td class="text-right">$600.00</td>
                            </tr>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center">
                                    <strong>Subtotal</strong></td>
                                <td class="thick-line text-right">$670.99</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center">
                                    <strong>Total</strong></td>
                                <td class="no-line text-right"><strong>$685.99</strong></td>
                            </tr>
                            </tbody>
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
                Waktu Kadaluarsa
                <hr style="margin-right: 20%">
            </address>
        </div>
        <div class="col-3 text-center float-right pl-5">
            <address>
                09 September 1998<br>
                <br>
                <br>
                Finance
            </address>
        </div>
    </div>

@endsection
