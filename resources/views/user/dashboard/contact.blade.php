<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami</title>
    
    <!-- Load Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Load FontAwesome (Untuk Icon fa-solid/fa-brands) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Load Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* --- GLOBAL STYLES --- */
        body {
            background-color: #FDF4E7; /* Warna Cream Global */
            font-family: 'Inter', sans-serif;
            color: #333;
            min-height: 100vh;
        }

        /* --- HEADER STYLE (Sesuai Permintaan Sebelumnya) --- */
        .header-orange {
            background-color: #FF6B35;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            height: 90px;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .text-header {
            color: #FFFFFF; 
            font-weight: bold;
            margin: 0;
            text-decoration: none;
        }

        /* --- LAYOUT CONTAINER BODY --- */
        /* Mengatur agar konten form di tengah, tidak terlalu lebar (desktop) & pas di mobile */
        .main-container {
            max-width: 720px; /* Lebar maksimal yang ideal untuk form */
            margin: 0 auto;   /* Posisi tengah */
            padding: 30px 20px;  /* Padding atas-bawah kiri-kanan */
        }

        /* --- CARDS & INFO BOXES --- */
        .info-box {
            background-color: #FFFFFF;
            border-radius: 16px;
            padding: 25px 20px;
            text-align: center;
            height: 100%;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: transform 0.2s;
        }

        .info-box:hover {
            transform: translateY(-3px);
        }
        
        .info-box i {
            font-size: 32px;
            margin-bottom: 15px;
            color: #333;
        }

        .highlight-text {
            font-weight: 700;
            color: #000;
            display: block;
            margin-top: 5px;
        }

        /* --- FORM STYLES --- */
        .form-card {
            background-color: #FFFFFF;
            border-radius: 16px;
            padding: 30px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .form-control {
            background-color: #FAFAFA;
            border: 1px solid #E0E0E0;
            padding: 12px 15px;
            font-size: 14px;
            border-radius: 8px;
        }
        
        .form-control:focus {
            background-color: #fff;
            border-color: #FF6B35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
        }

        .btn-orange {
            background-color: #FF6B35;
            color: white;
            width: 100%;
            padding: 14px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        } 
        
        .btn-orange:hover {
            background-color: #e65c2f;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(230, 92, 47, 0.3);
        }

        /* Utilitas Teks Kecil */
        .text-small { font-size: 0.85rem; color: #666; }
    </style>
</head>
<body>
    
    <!-- Header Oranye (Style Asli Anda) -->
    <div class="header-orange">
        <div class="container">
            <h2 class="text-header">Hubungi Kami</h2>
        </div>
    </div>

    <!-- Container Utama (Tengah) -->
    <div class="main-container">
        
        <!-- Grid Menu Informasi (2 Kolom) -->
        <div class="row g-3 mb-4">
            <!-- Item 1 -->
            <div class="col-6 col-md-6">
                <div class="info-box">
                    <img src="{{ asset('asset/icon/ic_headset.png') }}" class="mb-3">
                    <h3 class="h6 fw-bold">Layanan Pelanggan</h3>
                    <p class="text-small mb-0">Bantuan langsung untuk pemesanan villa, pertanyaan reservasi, dan dukungan pelanggan 24/7</p>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="col-6 col-md-6">
                <div class="info-box">
                <img src="{{ asset('asset/icon/ic_email2.png') }}" class="mb-3">
                    <h3 class="h6 fw-bold">Email Kami</h3>
                    <p class="text-small mb-0">
                        <span class="highlight-text">mpat3io@gmail.com</span>
                        Kirim Pertanyaan atau keluhan anda melalui email dan tim kami akan merespon secepat mungkin
                    </p>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="col-6 col-md-6">
                <div class="info-box">
                <img src="{{ asset('asset/icon/ic_wa.png') }}" class="mb-3">
                    <h3 class="h6 fw-bold">WhatsApp</h3>
                    <p class="text-small mb-0">
                        <span class="highlight-text">+62 8234-9843</span>
                        Hubungi kami melalui nomor ini untuk respon yang lebih cepat, mudah, dan praktis
                    </p>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="col-6 col-md-6">
                <div class="info-box">
                <img src="{{ asset('asset/icon/ic_maps2.png') }}" class="mb-3">
                    <h3 class="h6 fw-bold">Kantor Kami</h3>
                    <p class="text-small mb-0">Jl. Pulau Kambunong Indah 
                    No. 45, Sulawesi Barat, Indonesia</p>
                </div>
            </div>
        </div>

        <!-- Formulir Kontak -->
        <div class="form-card mb-5">
            <h3 class="h5 fw-bold text-center mb-4">Formulir Kontak</h3>
            
            <form action="" method="POST">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" placeholder="Alamat Email">
                    </div>
                </div>

                <div class="mb-3">
                    <input type="text" name="subjek" class="form-control" placeholder="Subjek Pesan">
                </div>

                <div class="mb-4">
                    <textarea name="pesan" rows="4" class="form-control" placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>

                <button type="submit" class="btn btn-orange">Kirim Pesan</button>
            </form>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>