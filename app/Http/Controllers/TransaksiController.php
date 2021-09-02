<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

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
        Config::$serverKey = 'SB-Mid-server-1py3CMqwY98oJihRXSa0sn6x';
        Config::$isProduction = false;
        Config::$isSanitized = false;
        Config::$is3ds = false;
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
        return view('transaksi.show', $data);
    }

    public function invoice($id){

    }
}
