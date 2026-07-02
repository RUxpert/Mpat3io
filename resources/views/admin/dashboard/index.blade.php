<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Villa</title>
    
    <!-- Load Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Load Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Kustom untuk menyesuaikan warna spesifik (Oranye dan Hijau) -->
    <style>
        /* Warna latar belakang hijau muda */
        body {
            background-color: #FFFFFF;
            font-family: 'Inter', sans-serif;
        }
        .header-orange {
            background-color: #FF6B35;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-villa {
            border: none;
            border-radius: 15px;
            overflow: hidden; 
            margin-bottom: 1rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card-villa:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .card-villa img {
            height: 140px; 
            object-fit: cover;
        }
        .text-primary-orange {
            color: #FF6B35;
        }
        .bottom-nav {
            background-color: white;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px solid #ddd;
            padding: 0.5rem 0;
            z-index: 1000;
        }
        .nav-item-custom {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #777;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .nav-item-custom.active-nav, .nav-item-custom:hover {
            color: #FF6B35;
        }
        .nav-item-custom i {
            font-size: 1.5rem;
            margin-bottom: 3px;
        }
        .text-center-header {
            color: #FFFFFF; 
            font-weight: bold;
            text-decoration: none;
            /* Tambahkan text-align: center; di sini meskipun sudah dihandle oleh flexbox, untuk keamanan */
            text-align: center; 
        }
        .container-responsive {
            max-width: 450px;
            margin: 0 auto;
            padding-left: 15px;
            padding-right: 15px;
        }
        @media (min-width: 768px) {
            /* Container Terluar: Full-Width di Desktop */
            .container-responsive {
                max-width: 100%;
                padding-left: 0;
                padding-right: 0;
            }

            /* Wrapper Konten Utama (Memusatkan dan Melebarkan Konten) */
            .main-content-wrapper {
                max-width: 960px; /* Lebar Melebar untuk Desktop */
                margin: 0 auto;
                padding: 0 15px;
            }
            
            /* Grid Villa: Gunakan 3 kolom di Desktop */
            #villa-grid.row-cols-2 {
                --bs-gutter-x: 1.5rem;
                --bs-gutter-y: 1.5rem;
            }
            #villa-grid .col {
                flex: 0 0 auto;
                width: 33.333333%; /* 3 kolom */
            }

            .card-villa img {
                height: 200px; /* Naikkan tinggi gambar di desktop */
            }
        }
        h3{
            font-weight: bold;
            text-decoration: none;
            
        }
        /* Konten utama agar tidak tertutup bottom nav */
        main {
            padding-bottom: 80px; 
            padding-top: 1rem;
        }
    </style>
</head>
<body>
    
    <div class="header-orange">
        <div class="container d-flex justify-content-start align-items-center" style="height: 90px;">
            <h2 class="text-center-header m-0">Selamat Datang, Mitra!</h2>
        </div>
    </div>
    
    <main class="container">
    <h3>Akomodasi Anda:</h3>

    <div id="villa-grid" class="row row-cols-2 g-3 mt-1">
        @if(!empty($villa))
            @foreach($villa as $villa_detail)
                <div class="col">
                    <a href="{{ route('admin.edit', $villa_detail['id']) }}" class="card-link">
                        <div class="card card-villa p-1" style="background-color:#FFE8D6;">
                            <img src="{{ url($villa_detail['gambar']) }}" class="card-img-top">
                            <div class="card-body p-3">
                                <h5 class="card-title fw-bold mb-1 text-truncate">
                                    {{ $villa_detail['nama_villa']; }}
                                </h5>
                                <p class="card-text fw-bolder text-primary-orange">
                                    Rp {{ number_format($villa_detail['harga'], 0, ',', '.'); }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        
        @else
            <div class="col-12">
                <div class="alert alert-info text-center py-4" role="alert">
                    <i class="bi bi-info-circle me-2"></i> Akomodasi akan ditampilkan di sini setelah anda menambahkan fasilitas.
                </div>
            </div>
        @endif
    </div>
</main>

    <nav class="navbar fixed-bottom bg-white border-top py-2 shadow-sm" style="z-index: 1050;">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('admin.dashboard') }}" class="nav-item-custom active-nav">
                <i class="bi bi-house-fill"></i><span>Beranda</span>
            </a>
            <a href="{{ route('admin.pesanan') }}" class="nav-item-custom">
                <i class="bi bi-clock-history"></i><span>Pesanan</span>
            </a>
            <a href="{{ route('admin.tambah') }}" class="nav-item-custom">
                <i class="bi bi-plus-square-fill"></i><span>Tambah</span>
            </a>
            <a href="{{ route('admin.akun') }}" class="nav-item-custom">
                <i class="bi bi-person-fill"></i><span>Akun</span>
            </a>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>