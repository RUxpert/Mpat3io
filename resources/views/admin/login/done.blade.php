<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sip, Selesai!</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Mengatur BODY sebagai container utama untuk penengahan penuh */
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            min-height: 100vh; /* Memastikan tinggi penuh viewport */
            display: flex;
            justify-content: center; /* Menengahkan konten secara horizontal */
            align-items: center; /* Menengahkan konten secara vertikal */
            margin: 0; /* Hapus margin bawaan */
            padding: 0;
        }
        
        /* Container untuk membatasi lebar konten dan mengatur tata letak internal */
        .container {
            max-width: 450px;
            width: 100%;
            padding: 30px; 
            text-align: center; /* PENTING: Menengahkan semua elemen inline/inline-block (termasuk gambar dan teks) */
        }

        /* --- Pengaturan Elemen --- */
        
        /* Ikon/Gambar */
        .success-image {
            /* Pastikan gambar adalah block agar bisa ditengahkan oleh text-align: center pada container */
            display: block; 
            margin: 0 auto; /* Menengahkan gambar secara horizontal jika perlu, meskipun text-align sudah bekerja */
            width: 280px; /* Atur lebar gambar sesuai kebutuhan */
            height: auto;
            margin-bottom: 25px;
        }
        
        /* Judul */
        h2 {
            margin-top: 0; 
            margin-bottom: 10px; 
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }
        
        /* Paragraf */
        p {
            margin-bottom: 30px; 
            color: #555;
            font-size: 1.1rem;
        }
        /* Tombol */
        .btn-primary {
            background-color: #FF6B35;
            border-color: #FF6B35;
            color: white;
            padding: 12px 0;
            border-radius: .5rem;
            width: 100%;
            max-width: 300px; /* Batasi lebar tombol agar tidak terlalu lebar */
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.4);
            display: block; /* Tombol harus block untuk width 100% dan margin auto */
            margin: 0 auto; /* Menengahkan tombol */
        }
        a {
            text-decoration: none;
        }
        .btn-primary:hover {
            background-color: #e65c2f;
            border-color: #e65c2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Menggunakan class baru untuk gambar agar lebih mudah diatur -->
        <img src="{{ asset('asset/icon/done.png') }}" class="success-image" alt="Done Icon">
        
        <h2>Sip, Selesai!</h2>
        <p>Akunmu sudah bisa digunakan</p>
        
        <!-- Tombol dibungkus di anchor, pastikan tombol memiliki display: block untuk margin auto -->
        <a href="{{ url('admin/dashboard') }}">
            <button type="button" class="btn btn-primary">Menu Utama</button>
        </a>
    </div>

    <!-- Optional Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>