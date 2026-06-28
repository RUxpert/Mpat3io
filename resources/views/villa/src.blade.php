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
    <!-- Load Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* Base Styling */
        body {
            background-color: #FFFFFF;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }
        .header-orange {
            background-color: #FF6B35;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Card Villa Styling */
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
        /* Tambahkan kelas link kustom untuk menghilangkan underline default */
        .card-link {
            text-decoration: none;
            color: inherit; /* Mewarisi warna teks dari parent */
            display: block; /* Memastikan link menutupi seluruh kolom */
        }
        .card-link:hover {
            color: inherit;
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
            color: #333; /* Pastikan teks input terbaca */
        }
        .search-icon-color {
            color: #FF6B35;
            font-size: 1.25rem;
        }
        
        /* Konten utama agar tidak tertutup bottom nav */
        main {
            padding-bottom: 80px; 
            padding-top: 1rem;
        }

        /* --- RESPONSIVE LAYOUT (Mobile-First) --- */

        /* Container Pembatas Mobile: Default max-width 450px */
        .container-responsive {
            max-width: 450px;
            margin: 0 auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Header Search Input Adjustment */
        .header-search-container {
            height: 90px;
            padding-top: 20px;
        }
        
        /* --- Desktop Optimization (Lebar Penuh Header, Konten Melebar dan Terpusat) --- */
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
    </style>
</head>
<body>
    
    <!-- 1. Header Oranye (Full-Width di Desktop) -->
    <div class="header-orange">
    <div class="container-responsive header-search-container">
        <div class="main-content-wrapper">
            <form action="{{ site_url('villa/villa/search') }}" method="GET">
                <div class="input-group shadow-sm">
                    <input 
                        type="text" 
                        name="keyword" 
                        class="form-control py-3 rounded-3 border-0 focus-ring search-input-bg"
                        placeholder="Temukan villa nyamanmu..."
                        aria-label="Temukan villa nyamanmu"
                    >

                    <span class="input-group-text border-0 search-input-bg rounded-3 ms-n5"style="z-index: 5; margin-left: -50px;">
                        <button type="submit" style="background:none;border:none;">
                            <img src="{{ asset('asset/icon/ic_src.png') }}">
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

    
    <!-- 3. Konten Utama (Grid Villa) -->
    <main class="container-responsive">
        <div class="main-content-wrapper">
            <h3>Hasil pencarian: "{{ $keyword }}"</h3>
            <div id="villa-grid" class="row row-cols-2 g-3 mt-1">
            @if(empty($results))
                <p>Tidak ada villa yang ditemukan.</p>
            @else
                @foreach($results as $villa_detail)
                    <div class="col">
                        <a href="{{ url('user/dashboard/detail/' . $villa_detail->id_villa) }}" class="card-link">
                            <div class="card card-villa p-1" style="background-color:#FFE8D6;">
                                <img src="{{ url($villa_detail->gambar) }}" class="card-img-top" alt="{{ $villa_detail->nama_villa; }}">
                                <div class="card-body p-3">
                                    <h5 class="card-title fw-bold mb-1 text-truncate">{{ $villa_detail->nama_villa; }}</h5>
                                    <p class="card-text fw-bolder text-primary-orange">Rp.{{ number_format($villa_detail->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
            @endforeach
            @endif
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

