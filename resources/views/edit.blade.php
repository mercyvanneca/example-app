<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        .form-container {
            width: 50%;
            margin: 30px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
        }

        .form-container input[type="text"], .form-container input[type="number"], .form-container textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .alert-success {
            color: green;
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 80%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <h1>Edit Buku</h1>

    @if(session('success'))
        <p class="alert-success">{{ session('success') }}</p>
    @endif

    <div class="form-container">
        <h2>Form Edit Buku</h2>
        <form action="{{ route('katalog.update', $buku->BukuID) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="JudulBuku">Judul Buku:</label>
                <input type="text" name="JudulBuku" id="JudulBuku" value="{{ old('JudulBuku', $buku->JudulBuku) }}" required>
            </div>

            <div>
                <label for="Penulis">Penulis:</label>
                <input type="text" name="Penulis" id="Penulis" value="{{ old('Penulis', $buku->Penulis) }}" required>
            </div>

            <div>
                <label for="Penerbit">Penerbit:</label>
                <input type="text" name="Penerbit" id="Penerbit" value="{{ old('Penerbit', $buku->Penerbit) }}" required>
            </div>

            <div>
                <label for="ISBN">ISBN:</label>
                <input type="text" name="ISBN" id="ISBN" value="{{ old('ISBN', $buku->ISBN) }}" required>
            </div>

            <div>
                <label for="TahunTerbit">Tahun Terbit:</label>
                <input type="number" name="TahunTerbit" id="TahunTerbit" min="1000" max="{{ date('Y') }}" value="{{ old('TahunTerbit', $buku->TahunTerbit) }}" required>
            </div>

            <div>
                <label for="Genre">Genre:</label>
                <input type="text" name="Genre" id="Genre" value="{{ old('Genre', $buku->Genre) }}" required>
            </div>

            <div>
                <label for="Stok">Stok:</label>
                <input type="number" name="Stok" id="Stok" min="1" value="{{ old('Stok', $buku->Stok) }}" required>
            </div>

            <div>
                <label for="Deskripsi">Deskripsi:</label>
                <textarea name="Deskripsi" id="Deskripsi" rows="5" required>{{ old('Deskripsi', $buku->Deskripsi) }}</textarea>
            </div>

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>

</body>
</html>
