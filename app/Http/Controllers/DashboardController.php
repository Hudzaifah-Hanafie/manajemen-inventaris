<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $totalKategori = Category::count();
        $totalStok = Product::sum('stock');

        // Menghitung total nilai asset (stok * harga)
        // Menggunakan DB raw agar perhitungan dilakukan oleh database (lebih cepat)
        $totalAset = Product::selectRaw('SUM(stock * price) as total')->first()->total;

        // Ambil 5 barang dengan stok terendah
        $stokMenipis = Product::where('stock', '<=', 5)->orderBy('stock', 'asc')->take(5)->get();

        return view('dashboard', compact(
            'totalProduk',
            'totalKategori',
            'totalStok',
            'totalAset',
            'stokMenipis'
        ));
    }
}
