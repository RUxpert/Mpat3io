<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Villa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #FFFFFF;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }
        .header-orange {
            background-color: #FF6B35;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px 0;
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
        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .card-villa img {
            height: 180px;
            object-fit: cover;
        }
        .text-primary-orange { color: #FF6B35; }
        .search-input-bg {
            background-color: #FCE6C2;
            color: #333;
        }
        .bottom-nav {
            background-color: white;
            position: fixed;
            bottom: 0; left: 0; right: 0;
            border-top: 1px solid #ddd;
            padding: 0.5rem 0;
            z-index: 1000;
            width: 100%;
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
        .nav-item-custom.active-nav, .nav-item-custom:hover { color: #FF6B35; }
        .nav-item-custom i { font-size: 1.5rem; margin-bottom: 3px; }
        main { padding-bottom: 80px; padding-top: 2rem; }

        @media (min-width: 768px) {
            .card-villa img { height: 220px; }
        }
    </style>
</head>
<body>

    <div class="header-orange">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    {{-- Search: belum ada route, form dinonaktifkan dulu --}}
                    <div class="input-group shadow-sm">
                        <input
                            type="text"
                            class="form-control py-3 rounded-start-3 border-0 search-input-bg"
                            placeholder="Temukan villa nyamanmu..."
                            aria-label="Cari villa"
                            disabled
                        >
                        <button class="btn search-input-bg rounded-end-3 border-0 px-4" type="button" disabled>
                            <i class="bi bi-search text-primary-orange fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Rekomendasi Villa</h3>
        </div>

        <div id="villa-grid" class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 g-md-4">
            @forelse($villas as $v)
                <div class="col">
                    <a href="{{ route('villa.detail', $v->id) }}" class="card-link">
                        <div class="card card-villa p-1" style="background-color:#FFE8D6;">
                            <img
                                src="{{ $v->gambar_url }}"
                                class="card-img-top"
                                alt="{{ $v->nama_villa }}"
                            >
                            <div class="card-body p-3">
                                <h5 class="card-title fw-bold mb-1 text-truncate" style="font-size: 1.1rem;">
                                    {{ $v->nama_villa }}
                                </h5>
                                <p class="card-text fw-bolder text-primary-orange mb-0">
                                    Rp {{ number_format($v->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-4">
                        <i class="bi bi-house-slash display-4 text-muted mb-3 d-block"></i>
                        Belum ada villa yang tersedia saat ini.
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <nav class="navbar fixed-bottom bg-white border-top py-2 shadow-sm" style="z-index: 1050;">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('user.dashboard') }}" class="nav-item-custom active-nav">
                <i class="bi bi-house-fill"></i><span>Beranda</span>
            </a>
            <a href="{{ route('user.riwayat') }}" class="nav-item-custom">
                <i class="bi bi-clock-history"></i><span>Riwayat</span>
            </a>
            <a href="{{ route('user.akun') }}" class="nav-item-custom">
                <i class="bi bi-person-fill"></i><span>Akun</span>
            </a>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
