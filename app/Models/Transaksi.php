<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice',
        'nama_klien',
        'alamat_klien',
        'ponsel_klien',
        'total_harga',
        'email_klien',
        'status_pembayaran',
    ];
}
