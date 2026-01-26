<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use App\Http\Requests\storeKategoriProdukRequest;
use App\Http\Requests\updateKategoriRequest;

use function Laravel\Prompts\search;

class KategoriProdukController extends Controller
{
    public  $pageTitle = 'Kategori Produk';
    public function index()
    {
        $pageTitle =$this->pageTitle;
        $PerPage = request()->query('perPage') ?? 10;
        $search = request()->query('search');
        $query = KategoriProduk:: query();

        if($search) {
            $query->where('nama_kategori', 'like', '%' . $search . '%'); // digunkan jika search mendekati kata yg ingin di cari 
            // $query->where('nama_kategori',$search); //digunkan jika ingin keyword sama persis nama barang yang ingin dicari
        }

        $kategori = $query->paginate($PerPage)->appends(request()->query());
        confirmDelete('Hapus data kategori produk tidak dapat dibatalkan, lanjutkan? ');
        return view('kategori-produk.index', compact('pageTitle','kategori'));
    }

    public function store( storeKategoriProdukRequest $request) {
        KategoriProduk::create([
            'nama_kategori' => $request->nama_kategori
        ]);
        toast()->success('Kategori Produk berhasil ditambahkan');
        return redirect()->route('master-data.kategori-produk.index');
    }
    public function update( updateKategoriRequest $request, KategoriProduk $kategoriProduk)
    {
        $kategoriProduk -> nama_kategori = $request->nama_kategori;
        $kategoriProduk ->save();
        toast()->success('Kategori produk berhasil diubah');
        return redirect()->route('master-data.kategori-produk.index');
    }
    
    public function destroy(KategoriProduk $kategoriProduk)
    {
        $kategoriProduk->delete();
        toast()->success('Kategori Produk berhasil dihapus');
        return redirect()->route('master-data.kategori-produk.index');
    }
}
