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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
Route::get('/buatbarang', function () {
    return view('buatbarang');
});
Route::get('/buatpembeli', function () {
    return view('buatpembeli');
});

Route::get('/', [AuthController::class, 'kelogin']);
Route::get('/login', [AuthController::class, 'loginin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/barang', [PageController::class, 'daftarbarang']);
Route::get('/pembeli', [PageController::class, 'daftarpembeli']);
Route::get('/bond', [PageController::class, 'daftarbond']);
Route::get('/pembelian', [PageController::class, 'daftarpembelian']);
Route::get('/perkiraan', [PageController::class, 'perkiraan']);
Route::get('/buatbond', [PageController::class, 'buatbond']);
Route::get('/buatpembelian', [PageController::class, 'buatpembelian']);
Route::post('/simpanbarang', [PageController::class, 'simpanbarang']);
Route::post('/simpanpembeli', [PageController::class, 'simpanpembeli']);
Route::post('/simpanpembelian', [PageController::class, 'simpanpembelian']);
Route::post('/simpanbond', [PageController::class, 'simpanbond']);
Route::get('/editbarang/{id}', [PageController::class, 'editbarang']);
Route::get('/editpembeli/{id}', [PageController::class, 'editpembeli']);
Route::get('/saveeditbarang/{id}', [PageController::class, 'saveeditbarang']);
Route::get('/saveeditpembeli/{id}', [PageController::class, 'saveeditpembeli']);
Route::delete('/hapusbarang/{id}', [PageController::class, 'barangdestroy'])->name('barang.destroy');
Route::delete('/hapuspembeli/{id}', [PageController::class, 'pembelidestroy'])->name('pembeli.destroy');
Route::delete('/hapusbond/{id}', [PageController::class, 'bonddestroy'])->name('bond.destroy');
Route::delete('/hapuspembelian/{id}', [PageController::class, 'pembeliandestroy'])->name('pembelian.destroy');

Route::get('/lunasibond/{id}', [PageController::class, 'lunasibond']);
