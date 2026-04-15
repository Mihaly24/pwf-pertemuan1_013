<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Product::create([
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
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
    public function update(Request $request, Product $produk)
    {
        // Pastikan hanya pemilik produk atau admin yang bisa update (Tugas Poin 5)
        if (Gate::denies('update', $produk)) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah produk ini.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $produk->update([
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
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