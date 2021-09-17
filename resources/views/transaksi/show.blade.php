@extends('custom-layouts.app')

@section('header','Lihat Data Transaksi')

@section('content')
    {{-- dynamic content--}}
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                        <label for="email_klien" class="col-2">Email</label>
                        <div class="col-9">
                            <input name="email_klien" id="email_klien"  value="{{$transaksi->email_klien}}" class="form-control" type="email" readonly placeholder="Isikan nomor hp"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ponsel_klien" class="col-2">Nomor Invoice</label>
                            @if($transaksi->invoice != null)
                            <div class="col-7">
                                <input name="ponsel_klien" id="ponsel_klien"  value="{{$transaksi->invoice}}" class="form-control" type="text" readonly placeholder="Isikan nomor hp"/>
                            </div>
                            <div class="col-2">
                                <a href="{{route('transaksi.cetak',$transaksi->invoice)}}" target="_blank" class="btn btn-primary btn-block">Lihat Invoice</a>
                            @else
                            <div class="col-9">
                                <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
                            @endif
                        </div>
                    </div>
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
@section('script')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#pay-button').click(function (e) {
            e.preventDefault();
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function (result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log('success')
                    console.log(result)
                },
                // Optional
                onPending: function (result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log('pending')
                    console.log(result)
                    $.ajax({
                        url : "{{route('transaksi.invoice')}}",
                        type : "POST",
                        data : {
                            "_token" : "{{ csrf_token() }}",
                            invoice : result.order_id,
                            id_transaksi : "{{$transaksi->id}}"
                        },
                        success:function (response) {
                            location.reload();
                        },
                        error:function (response){
                            console.log(response);
                        }
                    })
                },
                // Optional
                onError: function (result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log('error')
                    console.log(result)
                }
            });
        });
    })
</script>
@endsection

