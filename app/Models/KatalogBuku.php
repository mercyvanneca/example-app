<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes

class KatalogBuku extends Model


{
 
    use HasFactory, SoftDeletes; // Tambahkan SoftDeletes di sini

    protected $table = 'KatalogBuku'; // Nama tabel di database
    protected $fillable = [
        'BukuID',
        'JudulBuku',
        'Penulis',
        'Penerbit',
        'ISBN', // Tambahkan ISBN ke dalam $fillable
        'TahunTerbit',
        'Genre',
        'Stok',
        'Deskripsi',
        'TanggalDitambahkan',
    ];

       
    // Relasi ke peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'BukuID', 'BukuID');
    }

    protected $primaryKey = 'BukuID';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = true; // Aktifkan timestamps

    const CREATED_AT = 'TanggalDitambahkan'; // Kolom untuk created_at
    const UPDATED_AT = null; // Tidak menggunakan kolom updated_at

    // Optional: Jika ingin menggunakan custom nama untuk kolom deleted_at
    protected $dates = ['deleted_at']; // Menambahkan kolom deleted_at ke dalam array dates


     /**
     * Relasi ke tabel Peminjaman
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     /*
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'BukuID', 'BukuID');
    }
    */
}
