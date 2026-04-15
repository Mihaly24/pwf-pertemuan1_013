<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    // 1. Menampilkan daftar produk
    public function index()
    {
        $products = Product::all();
        return view('produk.index', compact('products'));
    }

    // 2. Menampilkan form tambah produk baru
    public function create()
    {
        return view('produk.create');
    }

    // 3. Menyimpan data produk baru ke database
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        Product::create([
            'name' => $validated['name'],
            'qty' => $validated['qty'],
            'price' => $validated['price'],
            'user_id' => Auth::id(), 
        ]);
        
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit produk
    public function edit(Product $produk)
    {
        // Pastikan hanya pemilik produk atau admin yang bisa melihat form edit (Tugas Poin 5)
        if (Gate::denies('update', $produk)) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit produk ini.');
        }

        return view('produk.edit', compact('produk'));
    }

    // 5. Menyimpan perubahan data produk ke database
    public function update(UpdateProductRequest $request, Product $produk)
    {
        // Pastikan hanya pemilik produk atau admin yang bisa update (Tugas Poin 5)
        if (Gate::denies('update', $produk)) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah produk ini.');
        }

        $validated = $request->validated();

        $produk->update([
            'name' => $validated['name'],
            'qty' => $validated['qty'],
            'price' => $validated['price'],
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diubah!');
    }

    // 6. Menghapus data produk dari database
    public function destroy(Product $produk)
    {
        // Pastikan hanya pemilik produk atau admin yang bisa menghapus (Tugas Poin 5)
        if (Gate::denies('delete', $produk)) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus produk ini.');
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}