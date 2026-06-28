<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Mpat3io</title>
    <!-- Link ke Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Menggunakan font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">
    
    <style> 
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden; 
        }
        body {
            background-color: #E16316;
            font-family: 'Inter', sans-serif;
            color: #FFFFFF;
        }
        .mobile-container {
            height: 100vh;
            max-width: 450px; 
            margin: 0 auto; 
            position: relative;
            
            background-color: #E16316; 
            background-image: url('{{ asset('asset/background/bg_admin2.png') }}');
            background-repeat: no-repeat;
            background-position: bottom center; 
            background-size: 100% auto; 
            display: flex;
            flex-direction: column; 
        }
        
        .content-wrapper {
            flex-grow: 1; 
            padding: 2.5rem 1.5rem; 
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .text-content {
            width: 100%; 
            margin-bottom: 3rem; 
        }
        
        .cta-button-container {
            width: 100%; 
            text-align: center;
            display: flex;
            flex-direction: column; 
            gap: 15px; 
        }

        .mitra {
            padding-top: 5vh; 
            margin-top: auto; 
        }

        .mobile-container h1 {
            font-size: 2.5rem; 
            font-weight: 800;
        }
        
        .btn-kustom-primary {
            color: #E75907;
            background-color: #FCE6C2;
            border-color: #FCE6C2;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: .5rem;
            transition: background-color 0.3s, border-color 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        }
        
        h6 {
            font-weight: bold;
            text-decoration: none;
        }
        
        .btn-kustom-primary:hover {
            background-color: #f79c42;
            border-color: #f79c42;
            color: #FFFFFF;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); 
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="mobile-container">
        
        <div class="content-wrapper">
            <!-- Area Teks -->
            <div class="text-content mt-5">
                <h1>Selamat Datang di Mpat3io</h1>
                <p class="lead mt-3 fs-5">Platform terbaik untuk mengelola data dan proyek Anda dengan mudah dan cepat.</p>
            </div>
            
            <p class="mitra">Dipercaya oleh:</p>
            <h6>Villa MTB</h6>
            <div class="cta-button-container mt-2">
                <a href="{{ url('admin_index/daftar') }}" class="btn btn-kustom-primary btn-lg w-75 mx-auto">Daftar</a>
                <a href="{{ url('admin_index/masuk') }}" class="btn btn-kustom-primary btn-lg w-75 mx-auto">Masuk</a>
            </div>
        </div>
        
    </div>

    <!-- Optional Bootstrap JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>