<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function productReport()
    {
        // Mengambil semua data produk beserta kategorinya
        $products = Product::with('category')->get();

        // Menghitung total nilai aset untuk ditampilkan di laporan
        $totalValue = $products->sum(function ($product) {
            return $product->stock * $product->price;
        });

        // load view khusus laporan dan masukkan datanya
        $pdf = Pdf::loadView('reports.products', compact('products', 'totalValue'));

        // Download file pdf nya
        return $pdf->download('laporan-produk-'.date('Y-m-d').'.pdf');
    }

    public function productExcel()
    {
        // 1. Ambil data
        $products = Product::with('category')->get();
        $fileName = 'laporan-produk-'.date('Y-m-d').'.csv';

        // 2. Header untuk browser agar mendownload file sebagai CSV
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        // 3. Logika pembuatan file CSV
        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');

            // Header Kolom di Excel
            fputcsv($file, ['ID', 'Nama Produk', 'Kategori', 'Stok', 'Harga', 'Total Nilai']);

            // Isi Data
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->category->name ?? 'Tanpa Kategori',
                    $product->stock,
                    $product->price,
                    $product->stock * $product->price,
                ]);
            }

            fclose($file);
        };

        // 4. Kirim sebagai stream response (sangat hemat RAM)
        return response()->stream($callback, 200, $headers);
    }
}
