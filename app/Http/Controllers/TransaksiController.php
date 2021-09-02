<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

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
}
