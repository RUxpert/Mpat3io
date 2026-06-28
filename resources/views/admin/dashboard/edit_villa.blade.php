<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Villa - Mitra</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Style tetap sama seperti sebelumnya */
        body {
            background-color: #FFFFFF;
            font-family: 'Inter', sans-serif;
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

        .form-label {
            color: #FF6B35;
            font-weight: bold;
        }

        .btn-orange {
            background-color: #FF6B35;
            color: white;
            border: none;
            font-weight: bold;
        }

        .btn-orange:hover {
            background-color: #e55a2b;
            color: white;
        }

        .img-preview {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #fff;
        }

        .card-form {
            border: none;
            border-radius: 15px;
            background-color: #FFE8D6;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        main {
            padding-bottom: 50px;
            padding-top: 2rem;
        }

        .container-responsive {
            width: 100%;
            padding-left: 15px;
            padding-right: 15px;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .container-responsive {
                max-width: 1000px;
            }

            .img-preview {
                height: 300px;
            }
        }

        @media (max-width: 767px) {
            .container-responsive {
                max-width: 100%;
            }
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
            <h2 class="text-center-header m-0">Edit Data Villa</h2>
        </div>
    </div>

    <main class="container container-responsive">
        <form id="formEdit" action="{{ url('admin/dashboard/update_villa') }}" method="post"
            enctype="multipart/form-data" novalidate>

            <input type="hidden" name="id_villa" value="{{ $villa['id_villa']; }}">
            <input type="hidden" name="old_gambar" value="{{ $villa['gambar']; }}">

            <div class="card-form">
                <div class="row g-4">

                    <div class="col-md-4">
                        <div class="mb-3 text-center">
                            <label class="form-label d-block text-start">Foto Saat Ini:</label>
                            <img src="{{ url($villa['gambar']) }}" alt="Foto Villa" class="img-preview">
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Ganti Gambar</label>
                            <input class="form-control" type="file" id="gambar" name="gambar">
                            <div class="form-text text-muted small">Kosongkan jika tidak ingin mengubah gambar.</div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="nama_villa" class="form-label">Nama Villa</label>
                                <input type="text" class="form-control form-control-lg" id="nama_villa"
                                    name="nama_villa" value="{{ $villa['nama_villa']; }}" required>
                                <div class="invalid-feedback">
                                    Nama Villa hanya boleh huruf, angka, dan spasi.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label">Harga (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-secondary">Rp</span>
                                    <input type="number" step="any" class="form-control" id="harga" name="harga"
                                        value="{{ number_format($villa['harga'], 0, '', ''); }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status_villa" class="form-label">Status Villa</label>
                                <select class="form-select" id="status_villa" name="status_villa">
                                    <option value="tersedia" {{ ($villa['status_villa'] == 'tersedia') ? 'selected' : ''; }}>Tersedia</option>
                                    <option value="booked" {{ ($villa['status_villa'] == 'booked') ? 'selected' : ''; }}>
                                        Booked</option>
                                    <option value="reparasi" {{ ($villa['status_villa'] == 'reparasi') ? 'selected' : ''; }}>Perbaikan</option>
                                </select>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"
                                    required>{{ $villa['deskripsi']; }}</textarea>
                                <div class="invalid-feedback">
                                    Deskripsi tidak boleh mengandung simbol aneh.
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ url('admin/dashboard/') }}"
                                class="btn btn-outline-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-orange px-5 shadow-sm">Simpan Perubahan</button>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ url('admin/dashboard/villa_delete/' . $villa['id_villa']) }}"
                            class="btn btn-danger px-4 btn-delete">Hapus</a>
                    </div>

                </div>
            </div>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // --- LOGIKA SWEETALERT UNTUK TOMBOL HAPUS ---
            const btnDelete = document.querySelector('.btn-delete');

            if (btnDelete) {
                btnDelete.addEventListener('click', function (e) {
                    e.preventDefault(); // Mencegah link langsung berjalan

                    const href = this.getAttribute('href'); // Ambil link dari atribut href

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data villa dan gambarnya akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33', // Merah untuk hapus
                        cancelButtonColor: '#3085d6', // Biru/Abu untuk batal
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika user klik Ya, arahkan ke link
                            window.location.href = href;
                        }
                    });
                });
            }
            // --- END SWEETALERT ---


            // --- LOGIKA VALIDASI FORM (KODE LAMA ANDA) ---
            const form = document.getElementById('formEdit');
            const regexNoSymbol = /^[a-zA-Z0-9\s]+$/;

            form.addEventListener('submit', function (event) {
                let isValid = true;
                const namaInput = document.getElementById('nama_villa');
                const deskripsiInput = document.getElementById('deskripsi');

                if (!regexNoSymbol.test(namaInput.value)) {
                    namaInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    namaInput.classList.remove('is-invalid');
                }

                if (!regexNoSymbol.test(deskripsiInput.value)) {
                    deskripsiInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    deskripsiInput.classList.remove('is-invalid');
                }

                if (!isValid) {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });

            const inputs = document.querySelectorAll('#nama_villa, #deskripsi');
            inputs.forEach(input => {
                input.addEventListener('input', function () {
                    if (this.classList.contains('is-invalid')) {
                        this.classList.remove('is-invalid');
                    }
                });
            });
        });
    </script>
</body>

</html>