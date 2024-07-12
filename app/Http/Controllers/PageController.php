<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Bond;
use App\Models\Pembelian;

class PageController extends Controller
{
    public function dashboard()
    {
        $bond = Bond::where('status', 'belum dibayar')->paginate(10);
        $barang = Barang::where('stok', 0)->paginate(10);
        return view('/dashboard', ['key' => 'bond', 'bond' => $bond, 'barang' => $barang]);
    }
    
    public function getJulyPurchases()
{
    $julyPurchases = Pembelian::select(DB::raw('DATE(tanggal) as date'), DB::raw('SUM(total) as total'))
    ->whereMonth('tanggal', 7)
    ->groupBy(DB::raw('DATE(tanggal)'))
    ->get();

    return response()->json($julyPurchases);
}
    public function daftarbarang()
    {
        $barang = Barang::paginate(10);
        return view('/barang', ['key' => 'barang', 'barang' => $barang]);
    }
    public function daftarpembeli()
    {
        $pembeli = Pembeli::paginate(10);
        return view('/pembeli', ['key' => 'pembeli', 'pembeli' => $pembeli]);
    }
    public function daftarbond()
    {
        $bond = Bond::paginate(10);
        return view('/bond', ['key' => 'bond', 'bond' => $bond]);
    }
    public function daftarpembelian()
    {
        $pembelian = Pembelian::paginate(10);
        return view('/pembelian', ['key' => 'pembelian', 'pembelian' => $pembelian]);
    }
    public function perkiraan()
    {
        return view('/perkiraan');
    }
    public function buatbond()
    {
        $bond = Bond::paginate(10);
        $barang = Barang::all();
        $pembeli = Pembeli::all();
        return view('/buatbond', ['key' => 'bond', 'bond' => $bond, 'barang' => $barang, 'pembeli' => $pembeli]);
    }
    public function buatpembelian()
    {
        $barang = Barang::all();
        return view('/buatpembelian', ['key' => 'bond', 'barang' => $barang]);
    }
    public function simpanpembelian(Request $request)
    {
        $input = $request->all();
        
        $barang = Barang::where('namabarang', $request->namabarang)->first();
        if($barang->stok >= $request->jumlahbarang){
            Pembelian::create($input);
            if ($barang) {
                $barang->stok = $barang->stok - $request->jumlahbarang; 
                $barang->save();
            }
        }
        else{
            return redirect('/pembelian')->with('error', 'Stok barang kurang');
        }
        
        $pembelian = Pembelian::paginate(10);
        return redirect('/pembelian')->with('success', 'Data Pembelian berhasil disimpan.');
    }
    public function simpanbarang(Request $request)
    {
        $input = $request->all();


        Barang::create($input);

        $barang = Barang::paginate(10);

        return redirect('/barang')->with('success', 'Barang berhasil dibuat');
    }
    public function simpanpembeli(Request $request)
    {
        $input = $request->all();


        Pembeli::create($input);

        $pembeli = Pembeli::paginate(10);

        return redirect('/pembeli')->with('success', 'Pembeli berhasil dibuat');
    }
    public function simpanbond(Request $request)
    {
        $input = $request->all();
        
        $barang = Barang::where('namabarang', $request->namabarang)->first();
        if($barang->stok >= $request->jumlahbarang){
            $input = $request->all();
            $bond = Bond::create($input);
            if ($barang) {
                $barang->stok = $barang->stok - $request->jumlahbarang; 
                $barang->save();
            }
        }
        else {
            return redirect('/bond')->with('error', 'Stok Barang Tidak Cukup');
        }
        $pembeli = Pembeli::where('namapembeli', $request->namapembeli)->first();
        if ($pembeli) {
            $pembeli->bond = $pembeli->bond + $bond->bond; 
            $pembeli->save();
        }
        $bond = Bond::paginate(10);
        return redirect('/bond')->with('success', 'Data Bond berhasil disimpan.');
    }
    function editbarang($id, Request $request)
    {
        $barang = Barang::find($id);
        return view('/editbarang', ['key' => 'barang', 'barang' => $barang]);
    }
    function editbond($id, Request $request)
    {
        $bond = Bond::find($id);
        return view('/editbond', ['key' => 'bond', 'bond' => $bond]);
    }
    function editpembeli($id, Request $request)
    {
        $pembeli = Pembeli::find($id);
        return view('/editpembeli', ['key' => 'pembeli', 'pembeli' => $pembeli]);
    }
    function editpembelian($id, Request $request)
    {
        $pembelian = Pembelian::find($id);
        return view('/editpembelian', ['key' => 'pembelian', 'pembelian' => $pembelian]);
    }
    function saveeditbarang($id, Request $request)
    {
        $input = $request->all();
        $barang = Barang::find($id);
        $barang->update($input);
        return redirect('/barang');
    }
    function saveeditpembeli($id, Request $request)
    {
        $input = $request->all();
        $pembeli = Pembeli::find($id);
        $pembeli->update($input);
        return redirect('/pembeli');
    }
    public function barangdestroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect('/barang')->with('success', 'Barang berhasil dihapus');
    }
    public function pembelidestroy($id)
    {
        $pembeli = Pembeli::findOrFail($id);
        $pembeli->delete();

        return redirect('/pembeli')->with('success', 'Pembeli berhasil dihapus');
    }
    public function bonddestroy($id)
    {
        $bond = Bond::findOrFail($id);
        $bond->delete();

        return redirect('/bond')->with('success', 'Bond berhasil dihapus');
    }
    public function pembeliandestroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $pembelian->delete();

        return redirect('/pembelian')->with('success', 'Bond berhasil dihapus');
    }

    public function lunasibond($id)
    {
        $bond = Bond::findorFail($id);
        $bond->status = "DIBAYAR";
        $bond->save();

        $pembeli = Pembeli::where('namapembeli', $bond->namapembeli)->first();
        if ($pembeli) {
            $pembeli->bond = $pembeli->bond - $bond->bond; 
            $pembeli->save();
        }

        return redirect('/bond')->with('success', 'Berhasil dibayarkan');
    }
}
