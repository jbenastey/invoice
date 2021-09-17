<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class,'index'])->name('dashboard');;

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('produk',ProdukController::class);
    Route::get('transaksi',[TransaksiController::class,'index'])->name('transaksi.index');
    Route::get('transaksi/create',[TransaksiController::class,'create'])->name('transaksi.create');
    Route::post('transaksi-detail/store',[TransaksiController::class,'storeDetail'])->name('transaksi-detail.store');

    Route::get('get-product',[ProdukController::class,'getAllProduct']);
    Route::get('get-product/{id}',[ProdukController::class,'getProduct']);

    Route::get('transaksi-detail/destroy/{id}',[TransaksiController::class,'deleteDetail'])->name('transaksi-detail.destroy');
    Route::post('transaksi/store',[TransaksiController::class,'store'])->name('transaksi.store');
    Route::get('transaksi/{id}',[TransaksiController::class,'show'])->name('transaksi.show');
    Route::post('invoice',[TransaksiController::class,'invoice'])->name('transaksi.invoice');
    Route::get('cetak/{id}',[TransaksiController::class,'cetak'])->name('transaksi.cetak');

});


require __DIR__.'/auth.php';
