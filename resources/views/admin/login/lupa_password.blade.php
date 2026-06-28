<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            height: 100vh; /* Full screen height */
            display: flex;
            justify-content: center; /* Menjaga konten tetap di tengah secara horizontal */
            align-items: center; /* Menjaga konten tetap di atas secara vertikal */
            padding-top: 30px; /* Memberikan sedikit ruang di bagian atas */
        }
        
        .container {
            max-width: 450px;
            width: 100%;
            padding: 30px; /* Menjaga jarak di dalam kontainer */
        }
        
        h2 {
            margin-top: 0; /* Menghilangkan margin atas */
            margin-bottom: 20px; /* Menambahkan margin bawah agar tidak terlalu rapat */
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            text-align: left; /* Menjaga teks rata kiri */
        }

        .form-control {
            border-radius: .5rem;
            margin-bottom: 15px; /* Menambahkan margin bawah untuk konsistensi */
            padding-left: 40px; /* Memberikan ruang untuk ikon */
        }

        /* Menambahkan ikon ke dalam input sebagai background */
        .input-icon {
            position: relative;
        }

        .input-icon input {
            padding-left: 40px; /* Memberikan ruang di kiri untuk ikon */
            font-size: 1rem;
        }

        .input-icon .icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
        }
        .btn-primary {
            background-color: #FF6B35;
            border-color: #FF6B35;
            color: white;
            padding: 12px 0;
            border-radius: .5rem;
            width: 100%;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            background-color: #e65c2f;
            border-color: #e65c2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verifikasi Akun</h2>
        <div class="form">
        <form action="{{ url('admin/login/lupa_pass') }}" method="POST">
            <p>Verifikasi akun yang ingin kamu reset password</p>
            <div class="mb-3 input-icon">
                <img src="{{ asset('asset/icon/ic_email.png') }}" class="icon" alt="Email Icon">
                <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Verifikasi</button>
        </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error'); }}',
                confirmButtonText: 'Tutup'
            });
        @endif
    </script>
</body>
</html>
