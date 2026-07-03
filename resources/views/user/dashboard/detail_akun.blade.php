<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #FFFFFF;
            font-family: 'Inter', sans-serif;
            color: #000;
        }
        
        .header-orange {
            background-color: #FF6B35;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .text-center-header {
            color: #FFFFFF; 
            font-weight: bold;
            text-decoration: none;
            text-align: center; 
        }

        .profile-item {
            padding: 0.8rem 0; 
            border-bottom: 2px solid #EEEEEE; 
            display: flex;
            justify-content: space-between;
            align-items: center; 
        }
        
        .profile-label {
            font-weight: 700;
            font-size: 1rem;
            color: #000;
            width: 35%; /* Lebar label fix agar input rapi */
        }

        /* CSS Kustom untuk Input agar terlihat menyatu */
        .form-control-custom {
            border: 1px solid transparent; /* Border transparan agar terlihat bersih */
            background-color: transparent;
            text-align: right;
            font-weight: 400;
            color: #333;
            width: 65%;
            padding: 0.375rem 0;
        }
        
        /* Saat input diklik, beri border bawah oranye */
        .form-control-custom:focus {
            box-shadow: none;
            border-bottom: 2px solid #FF6B35;
            background-color: #fff;
        }

        .link-ubah {
            color: #FF6B35;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        main {
            padding-bottom: 80px; 
            padding-top: 1rem;
        }

        .btn-simpan {
            width: 100%;
            border-radius: 0.5rem;
            font-weight: bold;
            background-color: #FF6B35; 
            color: white;
            border: none;
            padding: 0.75rem;
            margin-top: 1.5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-simpan:hover {
            background-color: #E75907;
            color: white; 
        }

        .btn-logout {
            width: 100%;
            border-radius: 0.5rem;
            font-weight: bold;
            background-color: #6c757d; /* Ganti warna logout jadi abu agar tombol Simpan lebih menonjol */
            color: white;
            padding: 0.75rem;
            margin-top: 1rem;
            border: none;
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
    </style>
</head>
<body>
    
    <div class="header-orange">
        <div class="container d-flex justify-content-start align-items-center" style="height: 90px;">
            <h2 class="text-center-header m-0">Akun Saya</h2>
        </div>
    </div>
    
    <main class="container">
        
        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show mt-3">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-3">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('user.update_profil') }}" method="POST">
            @csrf
            
            <div class="profile-item">
                <span class="profile-label">Profil Saya</span>
            </div>

            <div class="profile-item">
                <label for="email" class="profile-label">Email</label>
                <input type="email" name="email" id="email" class="form-control form-control-custom" value="{{ $penyewa->email }}" required>
            </div>

            <div class="profile-item">
                <label for="nama" class="profile-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control form-control-custom" value="{{ $penyewa->name }}" required pattern="[A-Za-zÀ-ÿ\s]+" title="Nama hanya boleh huruf dan spasi">
            </div>

            <div class="profile-item" style="border-bottom: none;"> 
                <label for="telp" class="profile-label">Nomor Telepon</label>
                <input type="tel" name="telp" pattern="^08[0-9]{8,11}$" title="Masukkan nomor HP Indonesia (contoh: 081234567890)" id="telp" class="form-control form-control-custom" value="{{ $penyewa->no_telp }}">
            </div>


            <button type="submit" class="btn-simpan mt-3">Simpan Perubahan</button>

        </form>
        
        <form action="{{ route('logout') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-logout">
                Keluar (Logout)
            </button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>