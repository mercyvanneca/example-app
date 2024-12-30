<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogBukuController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AuthController;

/*
|---------------------------------------------------------------------- 
| Web Routes
|---------------------------------------------------------------------- 
*/

// Route untuk halaman login (menampilkan form login)
Route::get('/', function () {
    // Cek apakah pengguna sudah login atau belum
    if (auth()->check()) {
        return redirect()->route('welcome'); // Jika sudah login, redirect ke halaman welcome
    }
    return view('auth.login'); // Jika belum login, tampilkan form login
});

// Route untuk menampilkan halaman welcome setelah login berhasil
Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth')->name('welcome');


// Route untuk login (GET untuk menampilkan form login)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk login (POST untuk menangani login)
Route::post('/login', [AuthController::class, 'login']);

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk halaman signup dan menangani proses signup
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

// Route untuk menampilkan katalog buku
Route::get('/katalog', [KatalogBukuController::class, 'index'])->middleware('auth');


Route::resource('peminjaman', PeminjamanController::class)->middleware('auth');

//narik data peminjaman
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

//untuk menambahkan di peminajaman 
Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');


// Route untuk menambahkan katalog
Route::post('/katalog/store', [KatalogBukuController::class, 'store'])->name('katalog.store')->middleware('auth');

// Route untuk mengedit buku
Route::get('/katalog/edit/{id}', [KatalogBukuController::class, 'edit'])->name('katalog.edit')->middleware('auth');

// Route untuk menyimpan perubahan (update)
Route::put('/katalog/update/{id}', [KatalogBukuController::class, 'update'])->name('katalog.update')->middleware('auth');

// Route untuk menghapus katalog
Route::delete('/katalog/hapus/{id}', [KatalogBukuController::class, 'hapus'])->name('katalog.hapus')->middleware('auth');

//post untuk mengurangi stok di tampilan katalog
Route::post('/kurangi-stok/{id}', [KatalogBukuController::class, 'kurangiStok'])->name('kurangiStok');


//update
Route::patch('peminjaman/updateStatus/{id}', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
//

// Route untuk menguji koneksi database
Route::get('/test-database', function () {
    try {
        DB::connection()->getPdo();
        return "Koneksi ke database berhasil!";
    } catch (\Exception $e) {
        return "Koneksi gagal: " . $e->getMessage();
    }



    
});
