<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bergabunglah dengan Jaringan Villa Kami</title>
    <!-- Memuat Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Memuat Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        html, body {
            height: 100%;
            background-color: #E06313; 
            font-family: 'Inter', sans-serif;
            color: white; 
            margin: 0;
            padding: 0;
            overflow-x: hidden; 
            background-image: url('{{ asset('asset/background/bg_admin1.jpg') }}');
            background-repeat: no-repeat; 
            background-position: bottom center;
            background-size: auto 40%; 
        }

        .mobile-container {
            min-height: 100vh; 
            max-width: 450px; 
            margin: 0 auto; 
            position: relative;
            display: flex;
            flex-direction: column;
        }

        a {
            text-decoration: none;
        }

        .cta-button {
            display: block;
            width: 90%; 
            padding: 1rem 0;
            font-size: 1.25rem;
            font-weight: 700;
            border-radius: 0.5rem;
            color: #E75907; 
            background-color: #FCE6C2; 
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none; 
            text-align: center;
        }

        .cta-button:hover {
            opacity: 0.9;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
            color: #E75907;
        }

        .content-wrapper {
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex-grow: 1; 
        }

        .hero-title {
            font-size: 2.25rem; 
            line-height: 1.2;
            font-weight: 800;
        }
        
        .content-text {
            width: 100%;
        }

        .bottom-action {
            margin-top: auto; 
            width: 100%;
            display: flex;
            justify-content: center;
            padding-bottom: 2rem; 
        }
    </style>
</head>
<body>
    <div class="mobile-container">
        <div class="content-wrapper">
            <!-- Bagian Teks Utama -->
            <div class="content-text mt-3 mb-4">
                <h1 class="hero-title">
                    Bersama Kami Tumbuh Lebih Besar
                </h1>
                
                <p class="fs-5 fw-medium mt-3">
                    Jadilah bagian dari jaringan penyedia villa nyaman.
                </p>

                <p class="text-start mt-4 opacity-75">
                    Kami bantu promosikan properti anda agar menjangkau lebih banyak tamu lokal maupun internasional.
                    Dapatkan visibilitas maksimal, pengolahan mudah, dan dukungan penuh dari tim kami.
                </p>
            </div>

            <!-- Tombol Aksi di Bawah -->
            <div class="bottom-action">
                <a href="{{ url('admin_index/landing_page') }}" class="cta-button">Gabung Sekarang!</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>