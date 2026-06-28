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
            background-color: #E16316; 
            font-family: 'Inter', sans-serif;
            color: #FFFFFF;
        }

        /* --- LAYOUT UTAMA --- */
        .landing-section {
            background-color: #F26932;
            background-image: url({{ asset('asset/background/bg_lp.jpg') }});
            background-repeat: no-repeat; 
            background-position: bottom center; 
            background-size: 100% auto; 
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column; 
            align-items: center;
            justify-content: flex-start; 
            padding-top: 10vh; 
            box-sizing: border-box; 
        }
        
        .content {
            max-width: 800px; 
            padding: 0 20px; 
            width: 100%;
            height: 100%; 
            display: flex;
            flex-direction: column; 
            align-items: center;
        }
        
        .text-content {
            text-align: center;
            color: #FFFFFF; 
            width: 100%;
        }
        
        .landing-section h1 {
            font-size: 2.5rem; 
            font-weight: bold;
        }
        
        .landing-section p {
            font-size: 1.25rem;
            margin-bottom: 20px;
        }
        
        /* --- GROUP BAGIAN BAWAH --- */
        .bottom-group {
            margin-top: auto; 
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Mobile Default: 10vh sesuai permintaan */
            padding-top: 10vh; 
            padding-bottom: 5vh; 
        }
        
        .content-wrapper {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .mitra {
            margin-bottom: 5px;
            font-size: 1rem;
            opacity: 0.9;
        }
        
        h6 {
            font-weight: bold;
            font-size: 1.2rem;
            margin: 0;
        }
        
        .cta-button-container {
            display: flex;
            flex-direction: column; 
            align-items: center; 
            justify-content: center;
            gap: 15px; 
            width: 100%;
        }

        /* --- BUTTON STYLE --- */
        .btn-primary {
            color: #E75907;
            background-color: #FCE6C2;
            border-color: #FCE6C2;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: .5rem;
            transition: background-color 0.3s, border-color 0.3s;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            min-width: 200px; 
        }
        
        .btn-primary:hover {
            background-color: #f79c42;
            border-color: #f79c42;
            color: #FFFFFF;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); 
            transform: translateY(-2px);
        }

        /* --- MEDIA QUERIES (DESKTOP) --- */
        /* Digabung untuk kerapian */
        @media (min-width: 768px) {
            .landing-section h1 {
                font-size: 3rem;
            }
            .cta-button-container {
                flex-direction: row; /* Tombol sejajar di desktop */
            }
            .bottom-group {
                padding-top: 25vh; /* Desktop: 25vh sesuai permintaan */
            }
        }
        
        @media (min-width: 992px) {
            .landing-section {
                background-size: auto 30%; 
                padding-top: 15vh;
            }
        }
    </style>
</head>
<body>
    <section class="landing-section">
        <div class="content">   
            <div class="text-content">
                <h1>Selamat Datang di Mpat3io</h1>
                <p>Silakan Pilih metode Login</p>
            </div>
            
            <!-- Bagian Bawah: Mitra & Tombol -->
            <div class="bottom-group">
                <div class="content-wrapper">
                    <p class="mitra">Dipercaya oleh:</p>
                    <h6>Villa MTB</h6>
                </div>
                
                <div class="cta-button-container">
                    <a href="{{ url('index/daftar') }}" class="btn btn-primary btn-lg">Daftar</a>
                    <a href="{{ url('index/masuk') }}" class="btn btn-primary btn-lg">Masuk</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>