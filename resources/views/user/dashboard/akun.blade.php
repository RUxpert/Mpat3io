<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun & Bantuan</title>
    
    <!-- Load Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Load Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Load Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #FFFFFF;
            font-family: 'Inter', sans-serif;
        }
        .header-orange {
            background-color: #FF6B35;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            height: 90px; 
        }

        .text-center-header {
            color: #FFFFFF; 
            font-weight: bold;
            text-decoration: none;
            text-align: left; 
        }

        .text-primary-orange {
            color: #FF6B35;
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
            padding-bottom: 120px; 
            padding-top: 1rem;
        }
        .card-profile {
            margin-top: -40px; 
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 1.5rem;
            display: flex; 
            align-items: center; 
            background-color: white;
        }
        
        .profile-icon {
            width: 70px;
            height: 70px;
            background-color: #f0f0f0;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .profile-icon i {
            font-size: 2.5rem;
            color: #777;
        }

        .profile-details {
            margin-left: 1rem;
        }
        .profile-details h5 {
            font-weight: bold;
            margin-bottom: 0.2rem;
        }
        .profile-details a {
            font-size: 0.8rem;
            font-weight: bold;
            color: #4a90e2; 
            text-decoration: none;
        }

        /* Bagian Pusat Bantuan */
        .help-menu {
            margin-top: 2rem;
        }
        .help-menu h3 {
            font-weight: bold;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            color: #333;
        }
        
        .list-group-item-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 10px;
            background-color: white;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            font-weight: 500;
        }
        .list-group-item-custom i {
            font-size: 1.25rem;
            margin-right: 1rem;
            color: #FF6B35; 
        }
        
        .btn-logout {
            width: 100%;
            border-radius: 0.5rem;
            font-weight: bold;
            background-color: #FF6B35; 
            color: white;
            transition: background-color 0.2s;
            margin-top: 2rem;
            padding: 0.75rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-logout:hover {
            background-color: #E75907; 
            color: white;
        }
    </style>
</head>
<body>
    
    <div class="header-orange">
        <div class="container d-flex justify-content-start align-items-center" style="height: 100%;">
            <h2 class="text-center-header m-0">Akun Saya</h2>
        </div>
    </div>
    <main class="container-md pt-5"> 
        
        <div class="card-profile shadow-sm">
            <div class="profile-icon">
                <i class="bi bi-camera"></i>
            </div>
            <div class="profile-details">
                <h5>{{ $username = $penyewa->nama_penyewa; }}</h5>
                <a href="{{ url('user/dashboard/detail_akun') }}">LIHAT PROFIL SAYA</a>
            </div>
        </div>

        <div class="help-menu">
            <h3>Pusat Bantuan</h3>
            
            <div class="list-group">
                
                <a href="{{ url('user/dashboard/faq') }}" class="list-group-item-custom text-decoration-none text-dark">
                <img src="{{ asset('asset/icon/ic_ask.png') }}" class="icon pe-3">
                    <span>FAQ (Pertanyaan Umum)</span>
                </a>
                
                <a href="{{ url('user/dashboard/contact') }}" class="list-group-item-custom text-decoration-none text-dark">
                <img src="{{ asset('asset/icon/ic_msg.png') }}" class="icon pe-3">
                    <span>Hubungi Kami</span>
                </a>
                
                <a href="{{ url('user/dashboard/sk') }}" class="list-group-item-custom text-decoration-none text-dark">
                <img src="{{ asset('asset/icon/ic_list.png') }}" class="icon pe-3">
                    <span>Syarat & Ketentuan</span>
                </a>
                
                <a href="{{ url('user/dashboard/kebijakan') }}" class="list-group-item-custom text-decoration-none text-dark">
                <img src="{{ asset('asset/icon/ic_pass.png') }}" class="icon pe-3">
                    <span>Kebijakan Privasi</span>
                </a>
            </div>
        </div>
        
        <a href="{{ url('user/login/logout_penyewa') }}" class="btn btn-logout btn-lg mb-4">
            Keluar (Logout)
        </a>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>