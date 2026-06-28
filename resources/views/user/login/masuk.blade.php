<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            height: 100vh; /* Full screen height */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            max-width: 450px;
            width: 100%;
            padding: 30px;
        }
        
        h2 {
            text-align: left; /* Rata kiri */
            margin-bottom: 30px;
            font-size: 2rem;
            font-weight: bold;
            color: #333;
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

        .mb-3 {
            margin-bottom: 20px;
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

        .text-center a {
            color: #FF6B35; /* Mengubah warna link menjadi #FF6B35 */
            font-weight: bold;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .form-text {
            text-align: center;
            margin-top: 15px;
        }
        .link {
            color: #FF6B35 ;
            text-decoration: none ;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Masuk</h2>
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3 input-icon">
                <img src="{{ asset('asset/icon/ic_email.png') }}" class="icon" alt="Email Icon">
                <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
            </div>
            
            <div class="mb-3 input-icon">
                <img src="{{ asset('asset/icon/ic_pass.png') }}" class="icon" alt="password Icon">
                <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3">MASUK</button>
        </form>
        <a type="submit" href="{{ url('index/daftar') }}" class="btn btn-primary">DAFTAR</a>

        <div class="form-text">
        <span><a class="link" href="{{ url('index/lupa_password') }}">Lupa Password?</a></span>
        </div>
    </div>

    <!-- Optional Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'Tutup'
            });
        @endif
    </script>
</body>
</html>
