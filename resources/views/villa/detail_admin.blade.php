<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Riwayat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

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

        .custom-card {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        .detail-label {
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Bottom Navbar */
        .bottom-nav {
            background: white;
            border-top: 1px solid #eee;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 70px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            z-index: 1000;
            padding-bottom: 5px;
        }

        .nav-item-custom {
            text-decoration: none;
            color: #212529;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .nav-item-custom i {
            font-size: 1.5rem;
            margin-bottom: 2px;
        }

        .nav-item-custom.active {
            color: #000;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <header class="header-image-container">
        <img src="{{ asset('asset/background/gambarvilla.png') }}" alt="Header" class="header-bg">
        <div class="header-overlay">
            <h1 class="header-title-script">Villa & Camping Ground</h1>
            <p class="header-subtitle">MATABARA'NA PULAU KAMBUNONG</p>
        </div>
    </header>

    <main class="container py-5" style="margin-top: -20px; position: relative; z-index: 2;">

        <form action="{{ url('admin/dashboard/update_action') }}" method="POST" id="formUpdate">
            <input type="hidden" name="id_pesanan" value="{{ $detail->id_pesanan }}">
            
            <input type="hidden" id="harga_per_malam" value="{{ $detail->harga }}">

            <div class="card custom-card p-4">
                <h5 class="fw-bold mb-1">{{ $detail->nama_villa }}</h5>
                <p class="text-muted small mb-4">{{ $detail->alamat }}</p>

                <div class="detail-row">
                    <span class="detail-label"><i class="bi bi-calendar-check"></i> Check-In</span>
                    <input type="date" name="tgl_check_in" id="checkin" class="form-control form-control-sm w-50"
                        value="{{ $detail->tgl_check_in }}">
                </div>
                <div class="detail-row">
                    <span class="detail-label"><i class="bi bi-calendar-x"></i> Check-Out</span>
                    <input type="date" name="tgl_check_out" id="checkout" class="form-control form-control-sm w-50"
                        value="{{ $detail->tgl_check_out }}">
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="detail-label text-dark fw-bold"><i class="bi bi-people-fill"></i> Status Pesanan</span>
                    <select name="status_pesanan" class="form-select form-select-sm w-50">
                        <option value="{{ $detail->status_pesanan }}" selected>{{ $detail->status_pesanan }}</option>
                        <option value="pending">pending</option>
                        <option value="confirm">confirm</option>
                        <option value="checkin">checkin</option>
                        <option value="checkout">checkout</option>
                        <option value="cancelled">cancelled</option>
                        <option value="expired">expired</option>
                        <option value="refund requested">refund requested</option>
                        <option value="refunded">refunded</option>
                        <option value="no show">no show</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-4 shadow-sm">Simpan Perubahan</button>
            </div>

            <div class="card custom-card p-4">
                <h6 class="fw-bold mb-4 d-flex align-items-center gap-2"><i class="bi bi-person-fill fs-5"></i> Infomasi
                    Penyewa</h6>
                <div class="detail-row"><span class="detail-label text-muted">Nama Penyewa</span><span
                        class="detail-value">{{ $detail->nama_penyewa }}</span></div>
                <div class="detail-row"><span class="detail-label text-muted">Email</span><span
                        class="detail-value">{{ $detail->email_penyewa }}</span></div>
                <div class="detail-row"><span class="detail-label text-muted">Telepon</span><span
                        class="detail-value">{{ $detail->no_telp }}</span></div>
            </div>

            <div class="card custom-card p-4 mb-3">
                <h6 class="fw-bold mb-4 d-flex align-items-center gap-2"><i class="bi bi-credit-card-fill fs-5"></i>
                    Rincian Pembayaran</h6>
                
                <div class="detail-row">
                    <span class="detail-label text-muted" id="label_subtotal">
                        Rp.{{ number_format($detail->harga, 0, ',', '.') }} × 0 malam
                    </span>
                    <span class="detail-value" id="val_subtotal">Rp.0</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label text-muted">Biaya Layanan (15%)</span>
                    <span class="detail-value" id="val_layanan">Rp.0</span>
                </div>

                <hr>

                <div class="detail-row">
                    <span class="detail-label text-dark fw-bold">Total Bayar</span>
                    <span class="detail-value fw-bold text-success fs-5" id="val_total">Rp.0</span>
                </div>
            </div>
        </form>
    </main>

    <script>
        // Ambil Elemen
        const cin = document.getElementById('checkin');
        const cout = document.getElementById('checkout');
        const hargaPerMalam = parseFloat(document.getElementById('harga_per_malam').value);
        
        // Elemen untuk ditampilkan
        const labelSubtotal = document.getElementById('label_subtotal');
        const valSubtotal = document.getElementById('val_subtotal');
        const valLayanan = document.getElementById('val_layanan');
        const valTotal = document.getElementById('val_total');

        // Formatter Rupiah
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }

        function hitungOtomatis() {
            if (cin.value && cout.value) {
                const dateIn = new Date(cin.value);
                const dateOut = new Date(cout.value);

                // Validasi Tanggal
                if (dateOut <= dateIn) {
                    Swal.fire('Peringatan', 'Tanggal Check-out tidak boleh sebelum Check-in!', 'error');
                    cout.value = ''; // Reset tanggal out
                    return;
                }

                // 1. Hitung Selisih Hari
                const diffTime = Math.abs(dateOut - dateIn);
                const hari = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

                // 2. Rumus: Subtotal = Harga Villa * Hari
                const subtotal = hargaPerMalam * hari;

                // 3. Rumus: Layanan = 15% dari Subtotal
                const biayaLayanan = subtotal * 0.15;

                // 4. Rumus: Total Akhir
                const totalAkhir = subtotal + biayaLayanan;

                // Update Tampilan HTML
                labelSubtotal.innerText = `Rp.${new Intl.NumberFormat('id-ID').format(hargaPerMalam)} × ${hari} malam`;
                valSubtotal.innerText = formatRupiah(subtotal);
                valLayanan.innerText = formatRupiah(biayaLayanan);
                valTotal.innerText = formatRupiah(totalAkhir);

            } else {
                // Jika tanggal kosong
                labelSubtotal.innerText = `Rp.${new Intl.NumberFormat('id-ID').format(hargaPerMalam)} × 0 malam`;
                valSubtotal.innerText = formatRupiah(0);
                valLayanan.innerText = formatRupiah(0);
                valTotal.innerText = formatRupiah(0);
            }
        }

        // Jalankan saat input berubah
        cin.addEventListener('change', hitungOtomatis);
        cout.addEventListener('change', hitungOtomatis);

        // Jalankan sekali saat halaman pertama kali dimuat (agar terisi data awal)
        document.addEventListener("DOMContentLoaded", hitungOtomatis);

        // Alert Notifikasi Flashdata
        @if(session('success'))
            Swal.fire('Berhasil', '{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            Swal.fire('Gagal', '{{ session('error') }}', 'error');
        @endif
    </script>
</body>

</html>