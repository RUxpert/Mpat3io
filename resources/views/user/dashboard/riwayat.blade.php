<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { background-color: #FFFFFF; font-family: 'Inter', sans-serif; color: #333; }
        .header-orange { background-color: #FF6B35; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .text-center-header { color: #FFFFFF; font-weight: bold; text-align: center; }
        .card-villa { border: none; border-radius: 15px; overflow: hidden; margin-bottom: 1rem; box-shadow: 0 4px 8px rgba(0,0,0,0.08); transition: transform 0.2s; background-color: #FFFCFA; }
        .card-villa:hover { transform: translateY(-3px); box-shadow: 0 6px 12px rgba(0,0,0,0.15); }
        .img-history { width: 100%; height: 140px; object-fit: cover; object-position: center; border-radius: 15px 0 0 15px; display: block; }
        .history-card-body { padding: 1rem; display: flex; flex-direction: column; justify-content: center; height: 100%; }
        .text-primary-orange { color: #FF6B35; }
        .btn-detail { background-color: #FF6B35; color: white; font-size: 0.8rem; padding: 0.4rem 0.8rem; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; margin-top: 5px; border: none; }
        .btn-detail:hover { background-color: #e05520; color: white; }
        .bottom-nav { background-color: white; position: fixed; bottom: 0; left: 0; right: 0; border-top: 1px solid #ddd; padding: 0.5rem 0; z-index: 1000; }
        .nav-item-custom { display: flex; flex-direction: column; align-items: center; text-decoration: none; color: #777; font-size: 0.75rem; font-weight: 500; }
        .nav-item-custom.active-nav, .nav-item-custom:hover { color: #FF6B35; }
        .nav-item-custom i { font-size: 1.5rem; margin-bottom: 3px; }
        main { padding-bottom: 80px; padding-top: 1.5rem; }
    </style>
</head>
<body>

    <div class="header-orange">
        <div class="container d-flex justify-content-start align-items-center" style="height: 90px;">
            <h2 class="text-center-header m-0">Riwayat Pesanan</h2>
        </div>
    </div>

    <main class="container-md">

        @if(session('pesan'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div id="history-list">

            @forelse($pesanan as $p)
                <div class="card card-villa">
                    <div class="row g-0 align-items-center">

                        <div class="col-4 col-sm-3 col-md-2">
                            <img
                                src="{{ $p->villa ? $p->villa->gambar_url : asset('asset/background/gambarvilla.png') }}"
                                class="img-history"
                                alt="{{ $p->villa->nama_villa ?? 'Villa' }}"
                            >
                        </div>

                        <div class="col-8 col-sm-9 col-md-10">
                            <div class="card-body history-card-body">

                                <h5 class="card-title fw-bold mb-1 text-primary-orange text-truncate">
                                    {{ $p->villa->nama_villa ?? '-' }}
                                </h5>

                                <div class="mb-1">
                                    @php
                                        $badgeColor = match($p->status_pesanan) {
                                            'confirm', 'checkin', 'checkout' => 'bg-success',
                                            'cancelled', 'expired', 'refunded' => 'bg-danger',
                                            'refund requested' => 'bg-warning text-dark',
                                            default => 'bg-warning text-dark',
                                        };
                                    @endphp
                                    <small class="text-muted">Status:
                                        <span class="badge {{ $badgeColor }}">{{ ucwords($p->status_pesanan) }}</span>
                                    </small>
                                </div>

                                <p class="card-text mb-0 small">
                                    Total: <span class="fw-bold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</span>
                                </p>
                                <p class="card-text mb-1 small text-muted">
                                    Check-in: {{ \Carbon\Carbon::parse($p->tgl_check_in)->format('d M Y') }}
                                </p>

                                <div>
                                    <a href="{{ route('user.detail_pesanan', $p->id) }}" class="btn-detail">
                                        Lihat Detail
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="alert alert-light text-center border shadow-sm mt-3" role="alert">
                    <i class="bi bi-clock-history display-4 text-muted mb-3 d-block"></i>
                    Belum ada riwayat pesanan.
                </div>
            @endforelse

        </div>
    </main>

    <nav class="bottom-nav">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('user.dashboard') }}" class="nav-item-custom">
                <i class="bi bi-house-fill"></i><span>Beranda</span>
            </a>
            <a href="{{ route('user.riwayat') }}" class="nav-item-custom active-nav">
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
