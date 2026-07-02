<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Fasilitas - Mitra</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* CSS TETAP SAMA SEPERTI SEBELUMNYA */
        body {
            background-color: #f5f5f5;
            font-family: 'Inter', sans-serif;
            margin: 0;
            overflow-x: hidden;
            padding-bottom: 80px;
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
            margin: 0;
        }

        .form-wrapper {
            background-color: #FFFFFF;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .form-wrapper {
                max-width: 720px;
                margin-top: 2rem;
                padding: 2rem;
                border-radius: 16px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            }
        }

        @media (max-width: 767.98px) {
            .form-wrapper {
                max-width: 100%;
                padding: 1.5rem;
                border-radius: 0;
                box-shadow: none;
            }

            body {
                background-color: #FFFFFF;
            }
        }

        .custom-input {
            background-color: #FBEDDD;
            border: 1px solid #000000;
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 1rem;
            color: #333;
            transition: all 0.2s;
        }

        select.custom-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px 12px;
            cursor: pointer;
        }

        .custom-input:focus {
            background-color: #fff8f0;
            border-color: #FF6B35;
            box-shadow: none;
            outline: none;
        }

        h4 {
            font-weight: 600;
            color: #000;
        }

        .btn-custom-orange {
            background-color: #FF6B35;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 40px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-custom-orange:hover {
            background-color: #e55a2b;
            color: white;
        }

        .invalid-feedback {
            font-size: 0.85rem;
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
            <h2 class="text-center-header m-0">Tambah Fasilitas</h2>
        </div>
    </div>

    <div class="container">
        <div class="form-wrapper">
            <h4 class="mb-4">Tambah Fasilitas</h4>

            @if(session('pesan_error'))
                <div class="alert alert-danger">{{ session('pesan_error'); }}</div>
            @endif

            <form id="formFasilitas" method="post" action="{{ url('admin/dashboard/simpan') }}"
                enctype="multipart/form-data" novalidate>

                <div class="mb-3">
                    <input type="text" class="form-control custom-input" id="nama" name="nama" placeholder="Nama"
                        required>
                    <div class="invalid-feedback" id="namaError">Nama fasilitas wajib diisi.</div>
                </div>

                <div class="mb-3">
                    <input type="number" class="form-control custom-input" id="harga" name="harga" placeholder="Harga"
                        min="0" step="any" required>
                    <div class="invalid-feedback">Harga wajib diisi dan tidak boleh minus.</div>
                </div>

                <div class="mb-3">
                    <select class="form-select custom-input" id="status" name="status" aria-label="Pilih Status"
                        required>
                        <option value="" selected disabled>Pilih Status</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Booked">Booked</option>
                        <option value="Reparasi">Reparasi</option>
                    </select>
                    <div class="invalid-feedback">Silakan pilih salah satu status.</div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <input class="form-control custom-input" type="file" id="gambar" name="gambar"
                            accept=".jpg, .jpeg, .png" required>
                    </div>
                    <div class="invalid-feedback" id="gambarError">Wajib upload gambar (JPG/PNG).</div>
                    <div class="form-text text-muted" style="font-size: 0.8rem;">
                        *Format JPG/PNG, maks 2MB.
                    </div>
                </div>

                <div class="mb-4">
                    <textarea class="form-control custom-input" id="deskripsi" name="deskripsi" rows="5"
                        placeholder="Rincian" required></textarea>
                    <div class="invalid-feedback" id="deskripsiError">Rincian/deskripsi wajib diisi.</div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-custom-orange">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('formFasilitas');

            // Element Input
            const gambarInput = document.getElementById('gambar');
            const namaInput = document.getElementById('nama');
            const deskripsiInput = document.getElementById('deskripsi');

            // Element Pesan Error
            const gambarError = document.getElementById('gambarError');
            const namaError = document.getElementById('namaError');
            const deskripsiError = document.getElementById('deskripsiError');

            // Regex: Hanya Huruf, Angka, dan Spasi (termasuk enter/newline untuk textarea)
            // ^ = awal string
            // [a-zA-Z0-9\s] = boleh huruf besar/kecil, angka, dan spasi
            // + = minimal satu karakter
            // $ = akhir string
            const noSymbolRegex = /^[a-zA-Z0-9\s]+$/;

            form.addEventListener('submit', function (event) {
                let isValid = true;

                // 1. VALIDASI GAMBAR (Size)
                if (gambarInput.files.length > 0) {
                    const fileSize = gambarInput.files[0].size / 1024 / 1024;
                    if (fileSize > 2) {
                        gambarInput.setCustomValidity('Ukuran file terlalu besar');
                        gambarError.textContent = 'Ukuran file terlalu besar! Maksimal 2MB.';
                        isValid = false;
                    } else {
                        gambarInput.setCustomValidity('');
                        gambarError.textContent = 'Wajib upload gambar (JPG/PNG).';
                    }
                }

                // 2. VALIDASI NAMA (Tidak boleh simbol)
                if (namaInput.value.trim() !== "") {
                    if (!noSymbolRegex.test(namaInput.value)) {
                        namaInput.setCustomValidity('Invalid format');
                        namaError.textContent = 'Nama tidak boleh mengandung simbol (hanya huruf, angka, dan spasi).';
                        isValid = false;
                    } else {
                        namaInput.setCustomValidity('');
                        namaError.textContent = 'Nama fasilitas wajib diisi.'; // Reset pesan default
                    }
                }

                // 3. VALIDASI DESKRIPSI (Tidak boleh simbol)
                if (deskripsiInput.value.trim() !== "") {
                    if (!noSymbolRegex.test(deskripsiInput.value)) {
                        deskripsiInput.setCustomValidity('Invalid format');
                        deskripsiError.textContent = 'Deskripsi tidak boleh mengandung simbol (hanya huruf, angka, dan spasi).';
                        isValid = false;
                    } else {
                        deskripsiInput.setCustomValidity('');
                        deskripsiError.textContent = 'Rincian/deskripsi wajib diisi.'; // Reset pesan default
                    }
                }

                // Cek Validitas Akhir
                if (!form.checkValidity() || !isValid) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);

            // Reset Custom Validity saat user mengetik ulang
            gambarInput.addEventListener('change', function () { this.setCustomValidity(''); });

            namaInput.addEventListener('input', function () {
                this.setCustomValidity('');
                // Opsional: Jika ingin menghapus simbol secara otomatis saat mengetik, hilangkan komentar di bawah:
                // this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '');
            });

            deskripsiInput.addEventListener('input', function () {
                this.setCustomValidity('');
            });
        });
    </script>

    <nav class="navbar fixed-bottom bg-white border-top py-2 shadow-sm" style="z-index: 1050;">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('admin.dashboard') }}" class="nav-item-custom">
                <i class="bi bi-house-fill"></i><span>Beranda</span>
            </a>
            <a href="{{ route('admin.pesanan') }}" class="nav-item-custom">
                <i class="bi bi-clock-history"></i><span>Pesanan</span>
            </a>
            <a href="{{ route('admin.tambah') }}" class="nav-item-custom active-nav">
                <i class="bi bi-plus-square-fill"></i><span>Tambah</span>
            </a>
            <a href="{{ route('admin.akun') }}" class="nav-item-custom">
                <i class="bi bi-person-fill"></i><span>Akun</span>
            </a>
        </div>
    </nav>

</body>
</html>