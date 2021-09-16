<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
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
        Config::$clientKey = config('midtrans.client_key');
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

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

//        $transaction = $notif->transaction_status;
//        $type = $notif->payment_type;
//        $order_id = $notif->order_id;
//        $fraud = $notif->fraud_status;

//        if ($transaction == 'capture') {
//            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
//            if ($type == 'credit_card') {
//                if ($fraud == 'challenge') {
//                    // TODO set payment status in merchant's database to 'Challenge by FDS'
//                    // TODO merchant should decide whether this transaction is authorized or not in MAP
//                    echo "Transaction order_id: " . $order_id ." is challenged by FDS";
//                } else {
//                    // TODO set payment status in merchant's database to 'Success'
//                    echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
//                }
//            }
//        } else if ($transaction == 'settlement') {
//            // TODO set payment status in merchant's database to 'Settlement'
//            echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
//        } else if ($transaction == 'pending') {
//            // TODO set payment status in merchant's database to 'Pending'
//            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
//        } else if ($transaction == 'deny') {
//            // TODO set payment status in merchant's database to 'Denied'
//            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
//        } else if ($transaction == 'expire') {
//            // TODO set payment status in merchant's database to 'expire'
//            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
//        } else if ($transaction == 'cancel') {
//            // TODO set payment status in merchant's database to 'Denied'
//            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
//        }

        return view('transaksi.show', $data);
    }

    public function invoice(Request $request){
        Transaksi::where('id',$request->input('id_transaksi'))
            ->update([
               'invoice' => $request->input('invoice'),
            ]);
    }
}
