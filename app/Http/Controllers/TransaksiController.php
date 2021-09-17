<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Transaction;

class TransaksiController extends Controller
{
    //
    public function index()
    {
        $data = [
            'transaksi' => Transaksi::all()
        ];
        return view('transaksi.index',$data);
    }

    public function create()
    {
        $data = [
            'produk' => Produk::all(),
            'detail' => TransaksiDetail::where('id_transaksi', null)->get()
        ];
        return view('transaksi.create', $data);
    }

    public function storeDetail(Request $request)
    {
        $harga = $request->input('harga');
        $jumlah = $request->input('jumlah');
        $simpan = TransaksiDetail::create([
            'id_produk' => $request->input('id_produk'),
            'harga' => $harga,
            'jumlah' => $jumlah,
            'subtotal_harga' => $harga * $jumlah,
        ]);
        if ($simpan) {
            return redirect('transaksi/create');
        }
    }

    public function deleteDetail($id)
    {
        TransaksiDetail::findOrFail($id)->delete();

        return redirect('transaksi/create');
    }

    public function store(Request $request)
    {
        $simpan = Transaksi::create([
            'nama_klien' => $request->input('nama_klien'),
            'alamat_klien' => $request->input('alamat_klien'),
            'ponsel_klien' => $request->input('ponsel_klien'),
            'email_klien' => $request->input('email_klien'),
            'total_harga' => $request->input('total_harga'),
        ]);

        if ($simpan){
            TransaksiDetail::where('id_transaksi',null)->update([
                'id_transaksi' => $simpan->id
            ]);

            return redirect('transaksi');
        }
    }

    public function show($id){
        $this->configMidtrans();
//        $notif = new Notification();

        $data = [
            'transaksi' => Transaksi::findOrFail($id),
            'detail' => TransaksiDetail::where('id_transaksi', $id)->get()
        ];

        $invoice = 'INV-'.substr($data['transaksi']->ponsel_klien,-10).strtotime(now());

        $params = [
            'transaction_details' => [
                'order_id' => $invoice,
                'gross_amount' => $data['transaksi']->total_harga,
            ],
            'item_details' => [],
            'customer_details' => [
                'first_name' => $data['transaksi']->nama_klien,
                'email' => $data['transaksi']->email_klien,
                'phone' => $data['transaksi']->ponsel_klien,
                'address' => $data['transaksi']->alamat_klien,
            ]
        ];

        foreach ($data['detail'] as $value) {
            array_push($params['item_details'],[
                'id' => $value->id,
                'price' => $value->harga,
                'quantity' => $value->jumlah,
                'name' => $value->produk->nama_produk
            ]);
        }

        $data['snapToken'] = Snap::getSnapToken($params);
        if ($data['transaksi']->invoice != null){
            try {
                $data['status'] = Transaction::status($data['transaksi']->invoice);
            } catch (\Exception $e) {
                echo $e->getMessage();
                die();
            }
        }

        return view('transaksi.show', $data);
    }

    public function invoice(Request $request){
        Transaksi::where('id',$request->input('id_transaksi'))
            ->update([
               'invoice' => $request->input('invoice'),
            ]);
    }

    public function cetak($id){
        $this->configMidtrans();

        $data['transaksi'] = Transaksi::where('invoice',$id)->firstOrFail();
        $data['detail'] = TransaksiDetail::where('id_transaksi', $data['transaksi']->id)->get();
        try {
            $data['status'] = Transaction::status($data['transaksi']->invoice);
//            dd($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'portrait');
        $pdf->loadView('transaksi.cetak',$data);
        return $pdf->stream('invoice.pdf');

//        return view('transaksi.cetak',$data);
    }

    public function configMidtrans(){
        Config::$clientKey = config('midtrans.client_key');
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
