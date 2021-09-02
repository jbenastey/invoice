<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'gambar',
        'deskripsi',
    ];

    public function transaksiDetail(){
        return $this->belongsTo(TransaksiDetail::class,'id','id_produk');
    }
}
