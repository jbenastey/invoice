<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->nullable(true);
            $table->string('nama_klien');
            $table->string('alamat_klien');
            $table->string('ponsel_klien');
            $table->string('email_klien');
            $table->enum('status_pembayaran',['Menunggu','Sudah','Kadaluarsa','Bayar'])->default('Menunggu');
            $table->bigInteger('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
