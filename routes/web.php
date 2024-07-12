<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
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


Route::get('/buatbarang', function () {
    return view('buatbarang');
})->middleware('auth');
Route::get('/buatpembeli', function () {
    return view('buatpembeli');
})->middleware('auth');


Route::get('/', [AuthController::class, 'kelogin'])->middleware('auth');
Route::get('/login', [AuthController::class, 'loginin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/july-purchases', [PageController::class, 'getJulyPurchases'])->name('july.purchases');

Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware('auth');
Route::get('/barang', [PageController::class, 'daftarbarang'])->middleware('auth');
Route::get('/pembeli', [PageController::class, 'daftarpembeli'])->middleware('auth');
Route::get('/bond', [PageController::class, 'daftarbond'])->middleware('auth');
Route::get('/pembelian', [PageController::class, 'daftarpembelian'])->middleware('auth');
Route::get('/perkiraan', [PageController::class, 'perkiraan'])->middleware('auth');
Route::get('/buatbond', [PageController::class, 'buatbond'])->middleware('auth');
Route::get('/buatpembelian', [PageController::class, 'buatpembelian'])->middleware('auth');
Route::post('/simpanbarang', [PageController::class, 'simpanbarang'])->middleware('auth');
Route::post('/simpanpembeli', [PageController::class, 'simpanpembeli'])->middleware('auth');
Route::post('/simpanpembelian', [PageController::class, 'simpanpembelian'])->middleware('auth');
Route::post('/simpanbond', [PageController::class, 'simpanbond'])->middleware('auth');
Route::get('/editbarang/{id}', [PageController::class, 'editbarang'])->middleware('auth');
Route::get('/editpembeli/{id}', [PageController::class, 'editpembeli'])->middleware('auth');
Route::get('/saveeditbarang/{id}', [PageController::class, 'saveeditbarang'])->middleware('auth');
Route::get('/saveeditpembeli/{id}', [PageController::class, 'saveeditpembeli'])->middleware('auth');
Route::delete('/hapusbarang/{id}', [PageController::class, 'barangdestroy'])->name('barang.destroy')->middleware('auth');
Route::delete('/hapuspembeli/{id}', [PageController::class, 'pembelidestroy'])->name('pembeli.destroy')->middleware('auth');
Route::delete('/hapusbond/{id}', [PageController::class, 'bonddestroy'])->name('bond.destroy')->middleware('auth');
Route::delete('/hapuspembelian/{id}', [PageController::class, 'pembeliandestroy'])->name('pembelian.destroy')->middleware('auth');

Route::get('/lunasibond/{id}', [PageController::class, 'lunasibond'])->middleware('auth');
