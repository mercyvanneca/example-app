<?php

namespace App\Http\Controllers;

use App\Models\KatalogBuku;
use Illuminate\Http\Request;

class KatalogBukuController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $buku = KatalogBuku::select(
            'BukuID', 'JudulBuku', 'Penulis', 'Penerbit', 
            'ISBN', 'TahunTerbit', 'Genre', 'Stok', 'Deskripsi'
        )->get();

        return view('index', compact('buku'));
    }

    // Menambahkan buku baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'JudulBuku' => 'required|string|max:255',
            'Penulis' => 'required|string|max:255',
            'Penerbit' => 'required|string|max:255',
           //'ISBN' => 'required|string|max:255',
           'ISBN' => 'required|numeric|digits_between:10,13',
            'TahunTerbit' => 'required|integer|min:1000|max:' . date('Y'),
            'Genre' => 'required|string|max:100',
            'Stok' => 'required|integer|min:1',
            'Deskripsi' => 'required|string',
        ]);

        // Simpan data ke database
        KatalogBuku::create($request->only([
            'JudulBuku', 'Penulis', 'Penerbit', 'ISBN', 
            'TahunTerbit', 'Genre', 'Stok', 'Deskripsi'
        ]));

        return redirect('/katalog')->with('success', 'Buku berhasil ditambahkan!');
    }

    // Menghapus buku dengan soft delete
    public function hapus($id)
    {
        $buku = KatalogBuku::find($id);

        if ($buku) {
            $buku->delete();
            return redirect('/katalog')->with('success', 'Buku berhasil dihapus!');
        }

        return redirect('/katalog')->with('error', 'Buku tidak ditemukan!');
    }

    // Menampilkan form edit buku
    public function edit($id)
    {
        $buku = KatalogBuku::findOrFail($id);
        return view('edit', compact('buku'));
    }

    // Memperbarui data buku
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'JudulBuku' => 'required|string|max:255',
            'Penulis' => 'required|string|max:255',
            'Penerbit' => 'required|string|max:255',
            //'ISBN' => 'required|string|max:255',
            'ISBN' => 'required|numeric|digits_between:10,13',
            'TahunTerbit' => 'required|integer|min:1000|max:' . date('Y'),
            'Genre' => 'required|string|max:100',
            'Stok' => 'required|integer|min:1',
            'Deskripsi' => 'required|string',
        ]);

        // Cari buku dan update
        $buku = KatalogBuku::findOrFail($id);
        $buku->update($request->only([
            'JudulBuku', 'Penulis', 'Penerbit', 'ISBN', 
            'TahunTerbit', 'Genre', 'Stok', 'Deskripsi'
        ]));

        return redirect('/katalog')->with('success', 'Buku berhasil diperbarui!');
    }

    // Fungsi untuk mengurangi stok buku setelah peminjaman 
    public function kurangiStok($id)
    {
        // Cari buku berdasarkan ID
        $buku = KatalogBuku::findOrFail($id);

        // Pastikan stok buku lebih dari 0
        if ($buku->Stok > 0) {
            $buku->decrement('Stok'); // Mengurangi stok sebanyak 1
            return redirect()->back()->with('success', 'Stok buku berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi!');
        }
    }

}

