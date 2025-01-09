<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
        }

        /* Menyembunyikan link menu ketika belum dibuka */
        .sidenav a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: none; /* Menyembunyikan menu hingga side nav dibuka */
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

        h1, h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            background-color: #f9f9f9;
        }

        /* Menambahkan Flexbox untuk menyusun tombol secara horisontal */
        td.actions {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            align-items: center;
        }

        td a.edit, td button.delete {
            padding: 8px 12px;
            border-radius: 5px;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }

        td a.edit {
            background-color: #28A745;
        }

        td button.delete {
            background-color: #DC3545;
        }

        td a:hover, td button.delete:hover {
            opacity: 0.9;
        }

        .form-container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container div {
            margin-bottom: 15px;
        }

        .form-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .alert-success {
            color: green;
            text-align: center;
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

    <h1>Daftar Buku</h1>

    @if(session('success'))
        <p class="alert-success">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>ISBN</th>
                <th>Tahun Terbit</th>
                <th>Genre</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buku as $item)
                <tr>
                    <td>{{ $item->JudulBuku }}</td>
                    <td>{{ $item->Penulis }}</td>
                    <td>{{ $item->Penerbit }}</td>
                    <td>{{ $item->ISBN }}</td>
                    <td>{{ $item->TahunTerbit }}</td>
                    <td>{{ $item->Genre }}</td>
                    <td>{{ $item->Stok }}</td>
                    <td>{{ $item->Deskripsi }}</td>
                    <td class="actions">
                        <a href="{{ route('katalog.edit', $item->BukuID) }}" class="edit">Edit</a>
                        <form action="{{ route('katalog.hapus', $item->BukuID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="form-container">
        <h1>Tambah Buku</h1>
        <form action="/katalog/store" method="POST">
            @csrf
            <div>
                <label for="JudulBuku">Judul Buku:</label>
                <input type="text" name="JudulBuku" id="JudulBuku" required>
            </div>
            <div>
                <label for="Penulis">Penulis:</label>
                <input type="text" name="Penulis" id="Penulis" required>
            </div>
            <div>
                <label for="Penerbit">Penerbit:</label>
                <input type="text" name="Penerbit" id="Penerbit" required>
            </div>
            <div>
                <label for="ISBN">ISBN:</label>
                <input type="number" name="ISBN" id="ISBN" required>
            </div>
            <div>
                <label for="TahunTerbit">Tahun Terbit:</label>
                <input type="number" name="TahunTerbit" id="TahunTerbit" min="1000" max="9999" required>
            </div>
            <div>
                <label for="Genre">Genre:</label>
                <input type="text" name="Genre" id="Genre" required>
            </div>
            <div>
                <label for="Stok">Stok:</label>
                <input type="number" name="Stok" id="Stok" min="1" required>
            </div>
            <div>
                <label for="Deskripsi">Deskripsi:</label>
                <textarea name="Deskripsi" id="Deskripsi" rows="4" required></textarea>
            </div>
            <button type="submit">Tambah Buku</button>
        </form>
    </div>

    <script>
        // Fungsi untuk membuka side navigation
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            // Menampilkan menu saat side nav dibuka
            var links = document.querySelectorAll(".sidenav a");
            links.forEach(link => {
                link.style.display = "block";
            });
        }

        // Fungsi untuk menutup side navigation
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            // Menyembunyikan menu saat side nav ditutup
            var links = document.querySelectorAll(".sidenav a");
            links.forEach(link => {
                link.style.display = "none";
            });
        }
    </script>

</body>
</html>
