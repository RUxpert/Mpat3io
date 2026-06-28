<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Sekarang - Villa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .header-orange {
            background-color: #FF6B35;
        }

        .text-center-header {
            color: #fff;
            font-weight: bold;
        }

        .section-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-weight: 700;
            border-left: 5px solid #FF6B35;
            padding-left: 15px;
            margin-bottom: 15px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #6c757d;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: 800;
            color: #FF6B35;
            font-size: 1.2rem;
            border-top: 2px dashed #eee;
            padding-top: 15px;
            margin-top: 10px;
        }

        .btn-bayar {
            background-color: #FF6B35;
            color: #fff;
            border-radius: 12px;
            width: 100%;
            padding: 15px;
            border: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-bayar:hover {
            background-color: #e55a2b;
            color: #fff;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <div class="header-orange p-4">
        <h2 class="text-center-header">Konfirmasi Pesanan</h2>
    </div>

    <main class="container py-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <form id="formPemesanan" action="{{ url('user/dashboard/proses_bayar') }}" method="POST">
                    <input type="hidden" name="id_villa" value="{{ $villa['id_villa'] }}">
                    <input type="hidden" name="harga_villa" id="hargaDasar" value="{{ $villa['harga'] }}">

                    <div class="section-card">
                        <div class="section-title">Data Penyewa</div>
                        <div class="mb-2">
                            <label class="small text-muted">Nama Penyewa</label>
                            <input class="form-control" value="{{ $user['nama_penyewa'] }}" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="small text-muted">Email</label>
                            <input class="form-control" value="{{ $user['email_penyewa'] }}" readonly>
                        </div>
                        <div>
                            <label class="small text-muted">No. Telepon</label>
                            <input class="form-control" value="{{ $user['no_telp'] }}" readonly>
                        </div>
                    </div>

                    <div class="section-card">
                        <div class="section-title">Detail Waktu Inap</div>
                        <div class="row">
                            <div class="col-6">
                                <label class="small text-muted">Check-In</label>
                                <input type="date" name="tgl_check_in" id="checkin" class="form-control mb-2" required>
                            </div>
                            <div class="col-6">
                                <label class="small text-muted">Check-Out</label>
                                <input type="date" name="tgl_check_out" id="checkout" class="form-control" required>
                            </div>
                        </div>
                        <small class="text-primary fw-bold">Total Durasi: <span id="totalHari">0</span> malam</small>
                    </div>

                    <div class="section-card">
                        <div class="section-title">Rincian Biaya</div>

                        <div class="price-row">
                            <span>Harga Sewa</span>
                            <span id="displaySubtotal">Rp 0</span>
                        </div>

                        <div class="price-row">
                            <span>Biaya Layanan (15%)</span>
                            <span id="displayLayanan">Rp 0</span>
                        </div>

                        <div class="total-row">
                            <span>Total Bayar</span>
                            <span id="grandTotal">Rp 0</span>
                        </div>
                    </div>

                    <button type="button" id="btnLanjut" class="btn btn-bayar">Pesan Sekarang</button>
                </form>

            </div>
        </div>
    </main>

    <script>
        const form = document.getElementById('formPemesanan');
        const checkin = document.getElementById('checkin');
        const checkout = document.getElementById('checkout');
        const totalHariSpan = document.getElementById('totalHari');

        // Element Display Harga
        const displaySubtotal = document.getElementById('displaySubtotal');
        const displayLayanan = document.getElementById('displayLayanan');
        const grandTotal = document.getElementById('grandTotal');
        const btnLanjut = document.getElementById('btnLanjut');

        // Ambil Harga Dasar dari PHP
        const hargaPerMalam = parseInt(document.getElementById('hargaDasar').value);

        // Format Rupiah
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }

        // --- FUNGSI UTAMA HITUNG TOTAL (Sesuai Rumus 15%) ---
        function hitungTotal() {
            if (checkin.value && checkout.value) {
                const inDate = new Date(checkin.value);
                const outDate = new Date(checkout.value);

                // Validasi Tanggal
                if (outDate <= inDate) {
                    Swal.fire('Error', 'Tanggal Checkout harus setelah Check-in', 'error');
                    checkout.value = '';
                    resetDisplay();
                    return;
                }

                // 1. Hitung Hari
                const diffTime = Math.abs(outDate - inDate);
                const hari = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // 2. Hitung Subtotal (Harga * Hari)
                const subtotal = hargaPerMalam * hari;

                // 3. Hitung Biaya Layanan (15% dari Subtotal)
                const biayaLayanan = subtotal * 0.15;

                // 4. Hitung Total Akhir
                const totalAkhir = subtotal + biayaLayanan;

                // --- Update Tampilan ---
                totalHariSpan.innerText = hari;
                displaySubtotal.innerText = formatRupiah(subtotal);
                displayLayanan.innerText = formatRupiah(biayaLayanan);
                grandTotal.innerText = formatRupiah(totalAkhir);
            } else {
                resetDisplay();
            }
        }

        function resetDisplay() {
            totalHariSpan.innerText = '0';
            displaySubtotal.innerText = 'Rp 0';
            displayLayanan.innerText = 'Rp 0';
            grandTotal.innerText = 'Rp 0';
        }

        checkin.addEventListener('change', hitungTotal);
        checkout.addEventListener('change', hitungTotal);

        // LOGIKA TOMBOL & SWEETALERT
        btnLanjut.addEventListener('click', function () {
            // Validasi Input Kosong
            if (!checkin.value || !checkout.value) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tanggal Belum Lengkap',
                    text: 'Silakan isi tanggal check-in dan check-out terlebih dahulu.'
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Pesanan',
                text: "Apakah data tanggal sudah benar?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#FF6B35',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Pesan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
        </script>
        <?php if (session('swal_error')):
            $swal = session('swal_error');
            ?>
                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ addslashes($swal['title']); }}',
                        text: '{{ addslashes($swal['text']); }}',
                        confirmButtonColor: '#FF6B35'
                    });
                });
                </script>
    @endif
</body>

</html>