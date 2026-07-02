<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Riwayat - {{ $detail->villa->nama_villa ?? 'Pesanan' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg-color: #ffe9d6; --card-radius: 15px; }
        body { background-color: var(--bg-color); font-family: 'Poppins', sans-serif; padding-bottom: 80px; }
        .header-image-container { position: relative; height: 250px; width: 100%; overflow: hidden; background-color: #333; }
        .header-bg { width: 100%; height: 100%; object-fit: cover; opacity: 0.8; }
        .header-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.6)); display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-align: center; }
        .header-title-script { font-family: 'Dancing Script', cursive; font-size: 2.5rem; margin-bottom: 0; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); }
        .header-subtitle { font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase; opacity: 0.9; }
        .custom-card { border: none; border-radius: var(--card-radius); box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 1rem; }
        .badge-status { font-weight: 500; padding: 5px 15px; border-radius: 5px; font-size: 0.85rem; }
        .detail-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.8rem; }
        .detail-label { color: #6c757d; display: flex; align-items: center; gap: 8px; }
        .detail-value { font-weight: 500; text-align: right; }
        .btn-bayar { background-color: #FF6B35; color: #fff; border: none; font-weight: 600; }
        .btn-bayar:hover { background-color: #e55a2b; color: #fff; }
        .btn-bayar:disabled { background-color: #aaa; }
    </style>
</head>
<body>

    @php
        $tglIn  = \Carbon\Carbon::parse($detail->tgl_check_in);
        $tglOut = \Carbon\Carbon::parse($detail->tgl_check_out);
        $hari   = max(1, $tglIn->diffInDays($tglOut));
        $hargaPerMalam  = $detail->villa->harga ?? 0;
        $subtotalSewa   = $hargaPerMalam * $hari;
        $totalLayanan   = $subtotalSewa * 0.15;
        $totalHargaAkhir = $subtotalSewa + $totalLayanan;
        $isPending = $detail->status_pesanan === 'pending';
    @endphp

    <header class="header-image-container">
        <img src="{{ $detail->villa && $detail->villa->gambar ? asset('storage/' . $detail->villa->gambar) : asset('asset/background/gambarvilla.png') }}"
            alt="{{ $detail->villa->nama_villa ?? 'Villa' }}" class="header-bg">
        <div class="header-overlay">
            <h1 class="header-title-script">{{ $detail->villa->nama_villa ?? 'Villa' }}</h1>
            <p class="header-subtitle">Detail Pesanan</p>
        </div>
    </header>

    <main class="container py-5" style="margin-top:-20px;position:relative;z-index:2;">

        @if(session('pesan'))
            <div class="alert alert-success alert-dismissible fade show mt-3">
                {{ session('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('pesan_error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3">
                {{ session('pesan_error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card custom-card p-4">
            <h5 class="fw-bold mb-1">{{ $detail->villa->nama_villa ?? '-' }}</h5>

            <div class="detail-row mt-3">
                <span class="detail-label"><i class="bi bi-calendar-check"></i> Check-In</span>
                <span class="detail-value">{{ $tglIn->format('d M Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="bi bi-calendar-x"></i> Check-Out</span>
                <span class="detail-value">{{ $tglOut->format('d M Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="bi bi-moon-fill"></i> Durasi</span>
                <span class="detail-value">{{ $hari }} malam</span>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="detail-label text-dark fw-bold"><i class="bi bi-info-circle-fill"></i> Status Pesanan</span>
                @php
                    $badgeColor = match($detail->status_pesanan) {
                        'confirm', 'checkin', 'checkout' => 'bg-success text-white',
                        'cancelled', 'expired', 'refunded' => 'bg-danger text-white',
                        'refund requested' => 'bg-warning text-dark',
                        default => 'bg-warning text-dark',
                    };
                @endphp
                <span class="badge {{ $badgeColor }} badge-status">{{ ucwords($detail->status_pesanan) }}</span>
            </div>
        </div>

        <div class="card custom-card p-4">
            <h6 class="fw-bold mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-person-fill fs-5"></i> Informasi Penyewa
            </h6>
            <div class="detail-row">
                <span class="detail-label text-muted">Nama Penyewa</span>
                <span class="detail-value">{{ $detail->tenant->name ?? '-' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label text-muted">Email</span>
                <span class="detail-value">{{ $detail->tenant->email ?? '-' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label text-muted">Telepon</span>
                <span class="detail-value">{{ $detail->tenant->no_telp ?? '-' }}</span>
            </div>
        </div>

        <div class="card custom-card p-4 mb-3">
            <h6 class="fw-bold mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-credit-card-fill fs-5"></i> Rincian Pembayaran
            </h6>
            <div class="detail-row">
                <span class="detail-label text-muted">
                    Rp {{ number_format($hargaPerMalam, 0, ',', '.') }} × {{ $hari }} malam
                </span>
                <span class="detail-value">Rp {{ number_format($subtotalSewa, 0, ',', '.') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label text-muted">Biaya Layanan (15%)</span>
                <span class="detail-value">Rp {{ number_format($totalLayanan, 0, ',', '.') }}</span>
            </div>
            <hr>
            <div class="detail-row">
                <span class="detail-label text-dark fw-bold">Total Bayar</span>
                <span class="detail-value fw-bold text-success fs-5">Rp {{ number_format($totalHargaAkhir, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 mb-5 pb-5">
            <form id="formBatal" action="{{ route('user.batalkan') }}" method="POST">
                @csrf
                <input type="hidden" name="id_pesanan" value="{{ $detail->id }}">
                <button type="button" class="btn btn-outline-danger rounded-pill px-4" onclick="konfirmasiBatal()" {{ !$isPending ? 'disabled' : '' }}>
                    Batalkan Pesanan
                </button>
            </form>

            <button type="button" class="btn btn-bayar rounded-pill px-4" id="btnBayar" {{ !$isPending ? 'disabled' : '' }}>
                Bayar Sekarang
            </button>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const GROSS_AMOUNT = {{ (int) $totalHargaAkhir }};
        const ORDER_ID     = {{ $detail->id }};

        function konfirmasiBatal() {
            Swal.fire({
                title: 'Batalkan Pesanan?',
                text: 'Status akan berubah menjadi Cancelled.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Batalkan',
                cancelButtonText: 'Tidak'
            }).then(result => { if (result.isConfirmed) document.getElementById('formBatal').submit(); });
        }

        @if($isPending)
        document.getElementById('btnBayar').addEventListener('click', function() {
            this.disabled = true;
            this.innerText = 'Memuat...';

            fetch('{{ route("snap_token") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order_id: ORDER_ID, gross_amount: GROSS_AMOUNT })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.snap_token) throw new Error(data.message || 'Gagal mendapat token');
                snap.pay(data.snap_token, {
                    onSuccess: () => { window.location.href = '{{ route("user.finish", $detail->id) }}'; },
                    onPending: () => { Swal.fire('Menunggu Pembayaran', 'Silakan selesaikan pembayaran Anda.', 'info'); },
                    onError:   () => { Swal.fire('Gagal', 'Terjadi kesalahan pembayaran.', 'error'); },
                    onClose:   () => { Swal.fire('Dibatalkan', 'Pembayaran dibatalkan.', 'warning'); }
                });
            })
            .catch(err => {
                Swal.fire('Error', err.message, 'error');
            })
            .finally(() => {
                this.disabled = false;
                this.innerText = 'Bayar Sekarang';
            });
        });
        @endif
    </script>
</body>
</html>
