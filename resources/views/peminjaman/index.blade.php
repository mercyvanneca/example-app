<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 70%;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            font-size: 2em;
            margin-bottom: 20px;
        }
        .form-container {
            margin-bottom: 30px;
        }
        .form-container div {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus, input[type="date"]:focus, select:focus {
            border-color: #4CAF50;
            outline: none;
        }
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: #f9f9f9;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background-color: #45a049;
            transform: scale(1.02);
        }
        button:active {
            background-color: #3e8e41;
            transform: scale(1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        .alert-success {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .alert-error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        
        /* Style untuk Side Navigation */
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 60px;
            transition: 0.3s;
            z-index: 1000;
            visibility: hidden; /* Ganti display: none dengan visibility: hidden */
            opacity: 0; /* Sembunyikan dengan opacity */
        }

        .sidenav.open {
            width: 250px;
            visibility: visible;
            opacity: 1;
        }

        .sidenav a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            background-color: #575757;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 36px;
            color: white;
            cursor: pointer;
        }

        /* Style untuk tombol garis 3 */
        .menu {
            font-size: 30px;
            color: black;
            cursor: pointer;
            padding: 10px;
            display: block;
            margin: 10px;
        }

    </style>
</head>
<body>

<!-- Garis 3 menu untuk membuka side nav -->
<span class="menu" onclick="openNav()">&#9776; Menu</span>

<!-- Side Navigation -->
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="/katalog" class="active">Katalog Buku</a>
    <a href="/peminjaman">Peminjaman</a>
    <a href="/login">Logout</a>
</div>


    <div class="container">
        <h1>Form Peminjaman Buku</h1>

        @if(session('success'))
            <p class="alert-success">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p class="alert-error">{{ session('error') }}</p>
        @endif

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            <div class="form-container">
                <label for="BukuID">Pilih Buku:</label>
                <select name="BukuID" id="BukuID" required>
                    <option value="">-- Pilih Buku --</option>
                    @foreach($buku as $item)
                        <option value="{{ $item->BukuID }}">{{ $item->JudulBuku }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-container">
                <label for="NamaPeminjam">Nama Peminjam:</label>
                <input type="text" name="NamaPeminjam" id="NamaPeminjam" required placeholder="Nama Peminjam">
            </div>

            <div class="form-container">
                <label for="TanggalDipinjam">Tanggal Dipinjam:</label>
                <input type="date" name="TanggalDipinjam" id="TanggalDipinjam" required onchange="updateTanggalKembali()">
            </div>

            <div class="form-container">
                <label for="TanggalKembali">Tanggal Kembali:</label>
                <input type="date" name="TanggalKembali" id="TanggalKembali" readonly>
            </div>

            <div class="form-container">
                <label for="StatusPeminjaman">Status Peminjaman:</label>
                <select name="StatusPeminjaman" id="StatusPeminjaman" required>
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Kembali">Kembali</option>
                    <option value="Terlambat">Terlambat</option>
                </select>
            </div>

            <button type="submit">Simpan Peminjaman</button>
        </form>
   

        <h2>Daftar Peminjaman Buku</h2>
        <table>
            <thead>
                <tr>
                    <th>Peminjaman ID</th>
                    <th>Buku</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Dipinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status Peminjaman</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $pinjam)
                    <tr>
                        <td>{{ $pinjam->PeminjamanID }}</td>
                        <td>{{ $pinjam->katalogBuku->JudulBuku ?? 'Buku Tidak Ditemukan' }}</td>
                        <td>{{ $pinjam->NamaPeminjam }}</td>
                        <td>{{ $pinjam->TanggalDipinjam }}</td>
                        <td>{{ $pinjam->TanggalKembali }}</td>
                        <td>
                            <form action="{{ route('peminjaman.updateStatus', $pinjam->PeminjamanID) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="StatusPeminjaman" class="form-control" required>
                                    <option value="Dipinjam" {{ $pinjam->StatusPeminjaman == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                    <option value="Kembali" {{ $pinjam->StatusPeminjaman == 'Kembali' ? 'selected' : '' }}>Kembali</option>
                                    <option value="Terlambat" {{ $pinjam->StatusPeminjaman == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
     // Fungsi untuk membuka side navigation
function openNav() {
    document.getElementById("mySidenav").classList.add("open");
}

// Fungsi untuk menutup side navigation
function closeNav() {
    document.getElementById("mySidenav").classList.remove("open");


        
}
        // Menambahkan code JS untuk menghitung tgl kembali
        function updateTanggalKembali() {
            var tanggalDipinjam = document.getElementById('TanggalDipinjam').value;
            if (tanggalDipinjam) {
                var tanggal = new Date(tanggalDipinjam);
                tanggal.setDate(tanggal.getDate() + 7); // Menambahkan 7 hari
                var dd = String(tanggal.getDate()).padStart(2, '0');
                var mm = String(tanggal.getMonth() + 1).padStart(2, '0');
                var yyyy = tanggal.getFullYear();
                var tanggalKembali = yyyy + '-' + mm + '-' + dd;
                document.getElementById('TanggalKembali').value = tanggalKembali;
            }
        }
    </script>

</body>
</html>
