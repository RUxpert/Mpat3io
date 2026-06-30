<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* --- RESET & GLOBAL --- */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        body {
            font-family: 'Inter', sans-serif; /* Pastikan font konsisten */
            background-color: #F26932; /* Warna fallback */
        }

        /* --- LAYOUT SECTION --- */
        .landing-section {
            background-color: #F26932;
            background-image: url('{{ asset('asset/background/bg_lp.jpg') }}');
            background-repeat: no-repeat; 
            background-position: bottom center; 
            background-size: 100% auto; /* Mobile: Gambar lebar penuh */
            min-height: 100vh; 
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding-top: 10vh; 
            box-sizing: border-box;
        }
        
        .content {
            max-width: 800px; 
            padding: 0 20px; 
            width: 100%;
        }

        .text-content {
            text-align: left;
            color: #FFFFFF; 
        }

        /* --- TYPOGRAPHY --- */
        .landing-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        
        .landing-section h2 {
            font-size: 2rem;
            margin-top: 10px;
        }
        
        .landing-section p {
            font-size: 1.25rem;
            margin-bottom: 30px;
        }

        /* --- CTA BUTTON CONTAINER --- */
        .cta-button-container {
            text-align: center; 
            margin-top: 6vh; 
        }

        /* --- BUTTON STYLE --- */
        .btn-primary {
            color: #E75907;
            background-color: #FCE6C2;
            border-color: #FCE6C2;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: .5rem;
            transition: all 0.3s ease;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary:hover {
            background-color: #f79c42;
            border-color: #f79c42;
            color: #FFFFFF;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        /* --- RESPONSIVE DESKTOP --- */
        @media (min-width: 992px) {
            .landing-section {
                background-size: auto 30%; 
                padding-top: 15vh;
            }
            
            .cta-button-container {
                margin-top: 30vh; 
            }
        }
    </style>
</head>
<body>
    <section class="landing-section">
        <div class="content">   
            <div class="text-content">
                <h1>Liburan Lebih Mudah</h1>
                <h2>Temukan Villa Terbaik dalam Hitungan Detik.</h2>
                <p>Ribuan pilihan villa dengan harga transparan, foto asli, dan ulasan jujur. Booking cepat, aman, dan tanpa biaya tersembunyi.</p>
            </div>
            
            <div class="cta-button-container">
                <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-lg">Mulai Cari Villa!</a>
            </div>
        </div>
    </section>

    <!-- Optional Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>