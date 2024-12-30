<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'Peminjaman';

    // Nonaktifkan created_at dan updated_at
    public $timestamps = false;

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
       // 'PeminjamanID',
        'BukuID',           // ID buku yang dipinjam
        'NamaPeminjam',     // Nama peminjam
        'TanggalDipinjam',  // Tanggal buku dipinjam
        'TanggalKembali',   // Tanggal buku dikembalikan
        'StatusPeminjaman', // Status peminjaman
    ];

    // Kolom yang tidak boleh diubah (guarded)
    protected $primaryKey = 'PeminjamanID';
    public $incrementing = true;

    // Relasi dengan tabel KatalogBuku
    public function katalogBuku()
    {
        // Relasi belongsTo dengan tabel KatalogBuku
        return $this->belongsTo(KatalogBuku::class, 'BukuID', 'BukuID');
    }
}
