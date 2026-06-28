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
            padding: 20px 0; /* Memberi ruang napas pada header */
        }

        /* Mengikuti gaya kode kedua: Menggunakan container standar Bootstrap agar lebih lebar */
        .main-wrapper {
            max-width: 1140px; /* Standar desktop yang nyaman */
            margin: 0 auto;
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
            height: 180px; /* Sedikit lebih tinggi agar proporsional dengan card yang lebar */
            object-fit: cover;
        }
        .text-primary-orange {
            color: #FF6B35;
        }
        .search-input-bg {
            background-color: #FCE6C2;
            color: #333;
        }
        
        /* Mengatur Grid agar tidak terlalu sempit di mobile, dan luas di desktop */
        @media (min-width: 768px) {
            .card-villa img {
                height: 220px;
            }
        }

        main {
            padding-bottom: 80px; 
            padding-top: 2rem;
        }
    </style>
</head>
<body>
    
    <div class="header-orange">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6"> <form action="{{ site_url('villa/villa/search') }}" method="GET">
                        <div class="input-group shadow-sm">
                            <input 
                                type="text" 
                                name="keyword" 
                                class="form-control py-3 rounded-start-3 border-0 search-input-bg"
                                placeholder="Temukan villa nyamanmu..."
                                aria-label="Temukan villa nyamanmu"
                            >
                            <button class="btn search-input-bg rounded-end-3 border-0 px-4" type="submit">
                                <i class="bi bi-search text-primary-orange fs-5"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <main class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Rekomendasi Villa</h3>
        </div>

        <div id="villa-grid" class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 g-md-4">
            @foreach($villa as $villa_detail)
                <div class="col">
                    <a href="{{ url('user/dashboard/detail/') . $villa_detail['id_villa']; ?>" class="card-link">
                        <div class="card card-villa p-1" style="background-color:#FFE8D6;">
                            <img src="{{ url($villa_detail['gambar']) }}" class="card-img-top" alt="{{ $villa_detail['nama_villa']; }}">
                            <div class="card-body p-3">
                                <h5 class="card-title fw-bold mb-1 text-truncate" style="font-size: 1.1rem;">
                                    {{ $villa_detail['nama_villa']; }}
                                </h5>
                                <p class="card-text fw-bolder text-primary-orange mb-0">
                                    Rp {{ number_format($villa_detail['harga'], 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>