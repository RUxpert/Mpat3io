<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Villa - MTB Kambunong</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
        }

        /* HEADER */
        .header-orange {
            background-color: #FF6B35;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .text-center-header {
            color: #FFFFFF; 
            font-weight: bold;
            text-decoration: none;
            text-align: center; 
            font-family: 'Inter', sans-serif;
        }

        /* HERO SECTION */
        .hero-container {
            position: relative;
            height: 200px;
            width: 100%;
            overflow: hidden;
        }
        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .hero-overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.6));
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            text-align: center;
        }
        .hero-title-script {
            font-family: 'Dancing Script', cursive;
            color: #fff; font-size: 2.2rem;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
        }

        /* INFO BOX */
        .info-box {
            background-color: #ffe6d1;
            padding: 30px 20px 50px; 
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }
        .info-img-detail {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        /* ORDER BAR */
        .floating-footer {
            background: white;
            padding: 15px 20px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 20px 30px; 
            position: relative;
            z-index: 5;
        }

        .btn-pesan {
            background-color: #FF6B35;
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 10px 35px;
            border-radius: 10px;
            transition: 0.3s;
            text-decoration: none; /* Agar tag A tidak ada garis bawah */
        }
        
        .btn-pesan:hover {
            background-color: #e05520;
            color: #fff;
        }

        /* Style khusus saat button disabled */
        .btn-pesan:disabled,
        .btn-pesan.disabled {
            background-color: #6c757d !important;
            cursor: not-allowed;
            opacity: 0.8;
            color: white;
        }

        /* CARD VILLA LAINNYA */
        .card-villa {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background-color: #FFE8D6;
        }
        .card-villa img {
            height: 140px;
            object-fit: cover;
        }

        @media (min-width: 768px) {
            .hero-container { height: 250px; }
            .info-box { padding: 50px; }
            .floating-footer {
                max-width: 900px;
                margin: 30px auto 40px;
            }
        }
    </style>
</head>
<body>

    <div class="header-orange">
        <div class="container d-flex justify-content-start align-items-center" style="height: 90px;">
            <h2 class="text-center-header m-0">Pesan Villa</h2>
        </div>
    </div>

    <main>
        <div class="hero-container">
            <img src="{{ asset('asset/background/GambarVilla.png') }}" class="hero-img">
            <div class="hero-overlay">
                <h1 class="hero-title-script">Villa & Camping Ground</h1>
                <div class="text-white small text-uppercase" style="letter-spacing: 1px;">MATABARA'NA PULAU KAMBUNONG</div>
            </div>
        </div>

        <div class="info-box">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-md-5 col-lg-4">
                        <img src="{{ url($villa['gambar']) }}" class="info-img-detail" alt="{{ $villa['nama_villa'] }}">
                    </div>

                    <div class="col-md-7 col-lg-8 text-center text-md-start">
                        <h2 class="fw-bold mb-1 text-dark">{{ $villa['nama_villa'] }}</h2>
                        <div class="mb-3 text-muted">
                            <i class="bi bi-geo-alt-fill text-danger"></i> {{ $villa['alamat'] }}
                        </div>
                        <div class="mb-4 text-dark" style="line-height: 1.6; text-align: justify;">
                            {{ $villa['deskripsi'] }}
                        </div>
                        
                        <?php 
                            // Logika Cek Status
                            $is_reparasi = (strtolower($villa['status_villa']) == 'reparasi');
                            $badge_class = $is_reparasi ? 'bg-danger' : 'bg-success';
                        ?>
                        <div class="d-inline-block p-2 bg-white rounded-3 shadow-sm">
                            <span class="badge {{ $badge_class }} px-3 py-2">Status: {{ $villa['status_villa'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container px-0">
            <div class="floating-footer">
                <div>
                    <div class="fw-bold fs-4 text-dark">Rp {{ number_format($villa['harga'], 0, ',', '.') }}</div>
                    <div class="text-muted" style="font-size:0.75rem;">*biaya sewa per malam</div>
                </div>
                
                @if($is_reparasi)
                    <button class="btn btn-pesan shadow-sm" disabled>
                        Tidak Tersedia
                    </button>
                <?php else : ?>
                    <a class="btn btn-pesan shadow-sm" href="{{ url('user/dashboard/form_pesan/') . $villa['id_villa'] ?>">
                        Pesan Sekarang
                    </a>
                @endif
                </div>
        </div>

        <div class="container p-3 mb-5">
            <div class="text-center mb-4">
                <hr class="w-25 mx-auto">
                <span class="text-muted small text-uppercase fw-bold">Rekomendasi Serupa</span><br>
                <span style="font-weight: 700; font-size: 1.2rem; color: #333;">Berdasarkan Fitur & Suasana</span>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                @if(!empty($rekomendasi_villa))
                    @foreach($rekomendasi_villa as $rek)
                        <div class="col">
                            <a href="{{ url('user/dashboard/detail/') . $rek['id_villa'] ?>" class="text-decoration-none text-dark">
                                <div class="card card-villa h-100 shadow-sm border-0">
                                    <img src="{{ url($rek['gambar']) }}" class="card-img-top">
                                    <div class="p-3">
                                        <div class="fw-bold text-truncate small mb-1">{{ $rek['nama_villa'] }}</div>
                                        <div class="fw-bold" style="color: #FF6B35;">Rp {{ number_format($rek['harga'], 0, ',', '.') }}</div>
                                        
                                        </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                <?php else : ?>
                    <div class="col-12 text-center text-muted">
                        <small>Belum ada rekomendasi serupa saat ini.</small>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>