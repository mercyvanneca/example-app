<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            background-image: url('{{ asset('assets/Bg_library.jpg') }}'); /* Path ke file gambar */
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style-type: none;
            padding: 0;
            margin-top: 30px;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: rgba(0, 123, 255, 0.8);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        nav ul li a:hover {
            background-color: rgba(0, 123, 255, 1);
            transform: scale(1.1);
        }
    </style>
</head>
<body class="antialiased">
    <h1>Selamat Datang di Perpustakaan Digital</h1>
    <nav>
        <ul>
            <li><a href="/katalog">Katalog</a></li>
            <li><a href="/peminjaman">Peminjaman</a></li>
        </ul>
    </nav>
</body>
</html>
