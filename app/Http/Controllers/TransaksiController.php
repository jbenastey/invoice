<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Midtrans\Config;
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
        Config::$clientKey = 'SB-Mid-client-Vpl5LKiW1D6U8pzl';
        Config::$serverKey = 'SB-Mid-server-1py3CMqwY98oJihRXSa0sn6x';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        $data = [
            'transaksi' => Transaksi::findOrFail($id),
            'detail' => TransaksiDetail::where('id_transaksi', $id)->get()
        ];
        $params = [
            'transaction_details' => [
                'order_id' => 'INV-'.strtotime(now()),
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
        try {
            $data['status'] = Transaction::status('INV-1630602549');
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
        return view('transaksi.show', $data);
    }

    public function invoice(Request $request){
        Transaksi::where('id',$request->input('id_transaksi'))
            ->update([
               'invoice' => $request->input('invoice'),
            ]);
    }
}
