<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\KatalogBuku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{

    public function index()
    {
       $peminjaman = Peminjaman::with('katalogBuku')->get();  // Mengambil relasi katalogBuku
        $buku = KatalogBuku::all();  // Ambil semua data buku dari KatalogBuku
       

        // Kembalikan view dengan membawa data peminjaman dan buku
        return view('peminjaman.index', compact('peminjaman', 'buku'));
    }

 // Fungsi untuk mengupdate status peminjaman dan menambah stok buku saat dikembalikan
 public function updateStatus(Request $request, $id)
{
    // Menentukan nilai status peminjaman yang valid
    $validStatuses = ['Dipinjam', 'Kembali', 'Terlambat'];

    // Mencari peminjaman berdasarkan ID
    $peminjaman = Peminjaman::findOrFail($id);

    // Mencari buku yang dipinjam berdasarkan BukuID
    $buku = KatalogBuku::findOrFail($peminjaman->BukuID);

    // Cek jika status peminjaman sudah "Kembali"
    if ($peminjaman->StatusPeminjaman == 'Kembali') {
        return redirect()->route('peminjaman.index')->with('error', 'Buku sudah dikembalikan sebelumnya.');
    }

    // Jika status yang diterima adalah "Kembali"
    if ($request->StatusPeminjaman == 'Kembali') {
        // Mengubah status peminjaman menjadi "Kembali"
        $peminjaman->StatusPeminjaman = 'Kembali';

        // Menambah stok buku
        $buku->increment('stok', 1);
        $buku->save(); // Simpan perubahan stok buku

        // Simpan perubahan status peminjaman
        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman diperbarui dan stok buku diperbarui.');
    }

    return redirect()->route('peminjaman.index')->with('error', 'Status peminjaman tidak valid untuk pembaruan.');
}

//


    // Menampilkan daftar peminjaman
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        // Validasi JudulBuku berdasarkan tabel KatalogBuku
      'BukuID' => 'required|string|max:255|exists:katalogbuku,BukuID',  
       'NamaPeminjam' => 'required|string|max:255',
        'TanggalDipinjam' => 'required|date',
        'TanggalKembali' => 'nullable|date|after_or_equal:TanggalDipinjam',
        'StatusPeminjaman' => 'required|in:Dipinjam,Dikembalikan,Terlambat',
    ]);

    // Ambil BukuID berdasarkan JudulBuku
    $buku = KatalogBuku::where('JudulBuku', $request->JudulBuku)->first();


  // Ambil BukuID berdasarkan BukuID yang dipilih
    $buku = KatalogBuku::find($request->BukuID);

  // Cek apakah buku ada dan stok tersedia
  if (!$buku || $buku->Stok <= 0) {
      // Jika stok habis, kembalikan error dan jangan simpan peminjaman
      return redirect()->back()->with('error', 'Stok buku tidak mencukupi untuk dipinjam.');
  }

  
    // Menyimpan peminjaman baru
    Peminjaman::create([
       'BukuID' => $request->BukuID,
        'NamaPeminjam' =>$request->NamaPeminjam,
       'TanggalDipinjam' => $request->TanggalDipinjam,
        'TanggalKembali' => $request->TanggalKembali,
        'StatusPeminjaman' => $request->StatusPeminjaman,
    ]);



         // Kurangi stok buku setelah peminjaman berhasil disimpan
         if ($buku->Stok > 0) {
            $buku->decrement('Stok');
        } else {
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi!');
        }        


         
    // Redirect ke halaman daftar peminjaman dengan pesan sukses
    return redirect()->route('peminjaman.index')->with('success', 'Peminjaman buku berhasil disimpan.');
  

    
}

}
