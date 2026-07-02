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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            flex-wrap: wrap;
        }

        .profile-label {
            font-weight: 700;
            font-size: 1rem;
            color: #000;
            width: 35%;
        }

        .form-control-custom {
            border: 1px solid transparent;
            background-color: transparent;
            text-align: right;
            font-weight: 400;
            color: #333;
            width: 65%;
            padding: 0.375rem 0;
        }

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
            background: none;
            border: none;
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-simpan:hover {
            background-color: #E75907;
            color: white;
        }

        .btn-logout {
            width: 100%;
            border-radius: 0.5rem;
            font-weight: bold;
            background-color: #6c757d;
            color: white;
            padding: 0.75rem;
            margin-top: 1rem;
            border: none;
        }

        .invalid-feedback {
            font-size: 0.8rem;
            text-align: right;
            width: 100%;
            margin-top: 5px;
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

        .nav-item-custom.active-nav,
        .nav-item-custom:hover {
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
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form class="needs-validation" action="{{ route('admin.update_profil') }}" method="POST" novalidate>
            @csrf

            <div class="profile-item">
                <span class="profile-label">Profile Villa</span>
            </div>

            <div class="profile-item">
                <label for="username" class="profile-label">Username</label>
                <input type="text" name="username" id="username" class="form-control form-control-custom"
                    value="{{ $mitra->username }}" pattern="[a-zA-Z0-9]+" required>
                <div class="invalid-feedback">Username hanya boleh huruf dan angka (tanpa spasi/simbol).</div>
            </div>

            <div class="profile-item">
                <label for="nama_mitra" class="profile-label">Nama Mitra</label>
                <input type="text" name="nama_mitra" id="nama_mitra" class="form-control form-control-custom"
                    value="{{ $mitra->name }}" pattern="[a-zA-Z\s]+" required>
                <div class="invalid-feedback">Nama hanya boleh huruf dan spasi.</div>
            </div>

            <div class="profile-item">
                <label for="email_mitra" class="profile-label">Email</label>
                <input type="email" name="email" id="email_mitra" class="form-control form-control-custom"
                    value="{{ $mitra->email }}" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required>
                <div class="invalid-feedback">Format email salah atau mengandung spasi.</div>
            </div>

            <div class="profile-item" style="border-bottom: none;">
                <label for="alamat" class="profile-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control form-control-custom"
                    value="{{ $mitra->alamat }}" pattern="[a-zA-Z0-9\s\.,\-\/]+" required>
                <div class="invalid-feedback">Alamat mengandung karakter yang tidak diizinkan.</div>
            </div>

            <button type="submit" class="btn-simpan">Simpan Perubahan</button>
        </form>

        <form action="{{ route('logout') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-logout">
                Keluar (Logout)
            </button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

    <nav class="navbar fixed-bottom bg-white border-top py-2 shadow-sm" style="z-index: 1050;">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('admin.dashboard') }}" class="nav-item-custom">
                <i class="bi bi-house-fill"></i><span>Beranda</span>
            </a>
            <a href="{{ route('admin.pesanan') }}" class="nav-item-custom">
                <i class="bi bi-clock-history"></i><span>Pesanan</span>
            </a>
            <a href="{{ route('admin.tambah') }}" class="nav-item-custom">
                <i class="bi bi-plus-square-fill"></i><span>Tambah</span>
            </a>
            <a href="{{ route('admin.akun') }}" class="nav-item-custom active-nav">
                <i class="bi bi-person-fill"></i><span>Akun</span>
            </a>
        </div>
    </nav>

</body>
</html>