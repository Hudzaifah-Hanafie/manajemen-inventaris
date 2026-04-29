<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with('category')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(5);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'stock' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'category_id' => 'nullable|exists:categories,id'
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect('/products')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'stock' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect('/products')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', 'Barang berhasil dihapus!');
    }
}
