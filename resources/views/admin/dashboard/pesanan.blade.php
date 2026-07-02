<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk</title>
    
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

        .text-center-header {
            color: #FFFFFF; 
            font-weight: bold;
            text-decoration: none;
            /* Tambahkan text-align: center; di sini meskipun sudah dihandle oleh flexbox, untuk keamanan */
            text-align: center; 
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
            height: 140px; /* Tinggi gambar agar seragam */
            object-fit: cover;
        }
        .text-primary-orange {
            color: #FF6B35;
        }
        .search-input-bg {
            background-color: #FCE6C2;
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
        
        main {
            padding-bottom: 80px; 
            padding-top: 1rem;
        }
        /* Penyesuaian kustom untuk card riwayat agar konten tidak terlalu menumpuk */
        .history-card-body {
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
    </style>
</head>
<body>
    <div class="header-orange">
        <div class="container d-flex justify-content-start align-items-center" style="height: 90px;">
            <h2 class="text-center-header m-0">Pesanan Masuk</h2>
        </div>
    </div>
    
    <main class="container-md">
        <div id="history-list" class="mt-3">
            @if(!empty($pesanan))
                @foreach($pesanan as $p)
                    <div class="card card-villa" style="background-color:#FFFCFA;">
                        <div class="row g-0">
                            <div class="col-4 col-md-2">
                                <img src="{{ url($p->gambar) }}"  class="img-fluid rounded-start"  style="height:100%; object-fit: cover; border-radius: 15px 0 0 15px;" alt="Villa">
                            </div>
                            <div class="col-8 col-md-10">
                                <div class="card-body history-card-body" style="background-color:#FFFCFA;">
                                    <h5 class="card-title fw-bold mb-1 text-primary-orange" style="font-size: 1.1rem;">{{ $p->nama_villa }}</h5>
                                    <p class="card-text mb-1"><small class="text-muted">Status: <span class="badge bg-success">{{ $p->status_pesanan }}</span></small></p>
                                    <p class="card-text mb-1"><small>Total Bayar: <span class="fw-bolder"> Rp{{ number_format($p->total_harga, 0, ',', '.') }}</span></small></p>
                                    <p class="card-text mb-1"><small class="text-muted">Tanggal Pesanan: {{ $p->tgl_pesanan }}</small></p>
                                    <a class="btn btn-sm text-center-header" href="{{ route('admin.pesanan') }}" style="background-color:#FF6B35; margin-top: 5px; font-size: 0.8rem; padding: .25rem .5rem;">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info" role="alert">
                    Riwayat pesanan akan ditampilkan di sini.
                </div>
            @endif
        </div>
    </main>

    <nav class="navbar fixed-bottom bg-white border-top py-2 shadow-sm" style="z-index: 1050;">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('admin.dashboard') }}" class="nav-item-custom">
                <i class="bi bi-house-fill"></i><span>Beranda</span>
            </a>
            <a href="{{ route('admin.pesanan') }}" class="nav-item-custom active-nav">
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