<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Riwayat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-color: #ffe9d6;
            --card-radius: 15px;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Poppins', sans-serif;
            padding-bottom: 80px;
        }

        /* Header Image Styles */
        .header-image-container {
            position: relative;
            height: 250px;
            width: 100%;
            overflow: hidden;
            background-color: #333;
        }

        .header-bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
        }

        .header-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.6));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .header-title-script {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            margin-bottom: 0;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .header-subtitle {
            font-size: 0.8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.9;
        }

        /* Card Styles */
        .custom-card {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
        }

        .badge-gray {
            background-color: #e9ecef;
            color: #6c757d;
            font-weight: 500;
            padding: 5px 15px;
            border-radius: 5px;
        }

        /* Detail Rows */
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.8rem;
        }

        .detail-label {
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-value {
            font-weight: 500;
            text-align: right;
        }

        .btn-bayar {
            background-color: #FF6B35;
            color: #fff;
            border: none;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <?php
    // --- LOGIKA PERHITUNGAN HARGA ---
    
    // 1. Hitung durasi hari (Check-out - Check-in)
    $tgl_in_obj  = new DateTime($detail->tgl_check_in);
    $tgl_out_obj = new DateTime($detail->tgl_check_out);
    $jarak_hari  = $tgl_in_obj->diff($tgl_out_obj);
    $hari        = $jarak_hari->days;

    // Pastikan minimal 1 hari jika tanggal sama
    if ($hari == 0) {
        $hari = 1;
    }

    // 2. Ambil harga dasar
    $harga_per_malam = $detail->harga;

    // 3. Hitung Subtotal (Harga x Hari)
    $subtotal_sewa = $harga_per_malam * $hari;

    // 4. Hitung Biaya Layanan (15%)
    $persen_layanan = 0.15;
    $total_layanan  = $subtotal_sewa * $persen_layanan;

    // 5. Hitung Total Akhir
    $total_harga_akhir = $subtotal_sewa + $total_layanan;
    ?>

    <header class="header-image-container">
        <img src="{{ asset('asset/background/gambarvilla.png') }}" alt="Camping Ground" class="header-bg">
        <div class="header-overlay">
            <h1 class="header-title-script">Villa & Camping Ground</h1>
            <p class="header-subtitle">MATABARA'NA PULAU KAMBUNONG</p>
        </div>
    </header>

    <main class="container py-5" style="margin-top: -20px; position: relative; z-index: 2;">

        <div class="card custom-card p-4">
            <h5 class="fw-bold mb-1">{{ $detail->nama_villa }}</h5>
            <p class="text-muted small mb-4">{{ $detail->alamat }}</p>

            <div class="detail-row">
                <span class="detail-label"><i class="bi bi-calendar-check"></i> Check-In</span>
                <span class="detail-value">{{ $detail->tgl_check_in }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="bi bi-calendar-x"></i> Check-Out</span>
                <span class="detail-value">{{ $detail->tgl_check_out }}</span>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="detail-label text-dark fw-bold"><i class="bi bi-people-fill"></i> Status Pesanan</span>
                <span class="badge-gray">{{ $detail->status_pesanan }}</span>
            </div>
        </div>

        <div class="card custom-card p-4">
            <h6 class="fw-bold mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-person-fill fs-5"></i> Infomasi Penyewa
            </h6>

            <div class="detail-row">
                <span class="detail-label text-muted">Nama Penyewa</span>
                <span class="detail-value">{{ $detail->nama_penyewa }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label text-muted">Email</span>
                <span class="detail-value">{{ $detail->email_penyewa }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label text-muted">Telepon</span>
                <span class="detail-value">{{ $detail->no_telp }}</span>
            </div>
        </div>

        <div class="card custom-card p-4 mb-3">
            <h6 class="fw-bold mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-credit-card-fill fs-5"></i> Rincian Pembayaran
            </h6>

            <div class="detail-row">
                <span class="detail-label text-muted">
                    Rp.{{ number_format($harga_per_malam, 0, ',', '.') }} × {{ $hari }} malam
                </span>
                <span class="detail-value">
                    Rp.{{ number_format($subtotal_sewa, 0, ',', '.') }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label text-muted">Biaya Layanan (15%)</span>
                <span class="detail-value">
                    Rp.{{ number_format($total_layanan, 0, ',', '.') }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label text-dark fw-bold">Total Bayar</span>
                <span class="detail-value fw-bold text-success">
                    Rp.{{ number_format($total_harga_akhir, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 mb-5 pb-5">

            <form id="formBatal" action="{{ url('user/dashboard/batalkan_pesanan') }}" method="POST">
                <input type="hidden" name="id_pesanan" value="{{ $detail->id_pesanan }}">
                <button type="button" class="btn btn-outline-danger rounded-pill px-4" onclick="konfirmasiBatal()">
                    Batalkan Pesanan
                </button>
            </form>

            <?php $isPending = $detail->status_pesanan === 'pending'; ?>

            <button type="button" class="btn btn-bayar rounded-pill px-4 {{ !$isPending ? 'disabled' : '' }}"
                id="btnBayar" {{ !$isPending ? 'disabled' : '' }}>
                Bayar Secara Online
            </button>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-mDmBC0zQYFUZsnrt"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // MENGGUNAKAN NILAI HASIL PERHITUNGAN PHP
        const GROSS_AMOUNT = {{ (int) $total_harga_akhir }};

        function konfirmasiBatal() {
            Swal.fire({
                title: 'Batalkan Pesanan?',
                text: "Apakah Anda yakin ingin membatalkan pesanan ini? Status akan berubah menjadi Cancelled.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Batalkan',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formBatal').submit();
                }
            })
        }

        document.getElementById('btnBayar').addEventListener('click', function (e) {
            e.preventDefault();

            // Kirim gross_amount hasil hitungan baru ke controller
            fetch("<?= site_url('user/dashboard/get_snap_token') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "gross_amount=" + GROSS_AMOUNT
            })
            .then(response => response.text())
            .then(snapToken => {
                snap.pay(snapToken, {
                    onSuccess: function () {
                        window.location.href = "{{ url('user/dashboard/finish_payment/') . $detail->id_pesanan ?>";
                    },
                    onPending: function () {
                        Swal.fire("Menunggu Pembayaran", "Silakan selesaikan pembayaran Anda", "info");
                    },
                    onError: function () {
                        Swal.fire("Gagal", "Terjadi kesalahan pembayaran", "error");
                    },
                    onClose: function () {
                        Swal.fire("Dibatalkan", "Pembayaran dibatalkan", "warning");
                    }
                });
            })
            .catch(() => {
                Swal.fire("Error", "Gagal mendapatkan Snap Token", "error");
            });
        });
    </script>
</body>
</html>