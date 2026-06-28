<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    
    <!-- Load Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Load Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Load Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS Kustom untuk menyesuaikan warna spesifik (Oranye dan Hijau) -->
    <style>
        /* Warna latar belakang putih */
        body {
            background-color: #FFFFFF;
            font-family: 'Inter', sans-serif;
        }
        .header-orange {
            background-color: #FF6B35;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            height: 90px; /* Diambil dari style inline */
        }

        .text-center-header {
            color: #FFFFFF; 
            font-weight: bold;
            text-decoration: none;
            text-align: left; /* Biarkan tetap left sesuai permintaan rata kiri */
        }

        .text-primary-orange {
            color: #FF6B35;
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
        
        main {
            padding-bottom: 120px; /* Diperbarui untuk memberi ruang tombol logout */
            padding-top: 1rem;
        }
        /* PERBAIKAN UTAMA: Mengurangi margin negatif agar tidak menimpa judul Akun Saya */
        .card-profile {
            margin-top: -40px; /* Dikurangi dari -60px menjadi -40px */
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 1.5rem;
            display: flex; 
            align-items: center; 
            background-color: white;
        }
        
        /* Gambar/Ikon Profil Bundar */
        .profile-icon {
            width: 70px;
            height: 70px;
            background-color: #f0f0f0;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .profile-icon i {
            font-size: 2.5rem;
            color: #777;
        }

        .profile-details {
            margin-left: 1rem;
        }
        .profile-details h5 {
            font-weight: bold;
            margin-bottom: 0.2rem;
        }
        .profile-details a {
            font-size: 0.8rem;
            font-weight: bold;
            color: #4a90e2; /* Warna link biru */
            text-decoration: none;
        }

        /* Bagian Pusat Bantuan */
        .help-menu {
            margin-top: 2rem;
        }
        .help-menu h3 {
            font-weight: bold;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            color: #333;
        }
        
        .list-group-item-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 10px;
            background-color: white;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            font-weight: 500;
        }
        .list-group-item-custom i {
            font-size: 1.25rem;
            margin-right: 1rem;
            color: #FF6B35; /* Ikon Oranye */
        }
        
        /* Gaya Tombol Logout BARU DITAMBAHKAN */
        .btn-logout {
            width: 100%;
            border-radius: 0.5rem;
            font-weight: bold;
            background-color: #FF6B35; 
            color: white;
            transition: background-color 0.2s;
            margin-top: 2rem;
            padding: 0.75rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn-logout:hover {
            background-color: #E75907; 
            color: white;
        }
    </style>
</head>
<body>
    
    <div class="header-orange">
        <div class="container d-flex justify-content-start align-items-center" style="height: 100%;">
            <h2 class="text-center-header m-0">FAQ</h2>
        </div>
    </div>
    <div class="container mt-4">
        <h2>Pertanyaan yang sering ditanyakan</h2>
    <!-- FAQ Pertanyaan 1 -->
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Bagaimana cara melakukan booking villa?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Untuk melakukan booking villa, 
                Anda dapat mengikuti langkah-langkah berikut ini: <br>
                <ol>
                    <li>Pilih villa dan tanggal check-in/check-out <br>
                    <img src="{{ asset('asset/dummy villa.png') }}" class="icon pe-3"></li>
                    <li> Masukkan Informasi data diri dan pembayaran</li>
                    <li>Konfirmasi dan selesaikan pembayaran</li>
                </ol> 
                </div>
            </div>
        </div>

        <!-- FAQ Pertanyaan 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Apa saja metode pembayaran yang tersedia?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Saat ini anda hanya dapat melakukan pembayaran menggunakan 
                metode Qris
                </div>
            </div>
        </div>
        
        <!-- FAQ Pertanyaan 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Bagaimana cara membatalkan pesanan?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Penyewa dapat melakukan pembatalan pemesanan villa pada website booking villa Mpat3io dengan mengikuti langkah-langkah dibawah ini:
                    <h6>Cara Membatalkan Pesanan Villa:</h6>
                    <ol>
                        <li>Login ke akun Anda di website/aplikasi booking villa Mpat3io.</li>
                        <li>Masuk ke menu Riwayat.</li>
                        <li>Pilih villa dan tanggal pemesanan yang ingin dibatalkan.</li>
                        <li>Klik tombol “Batalkan Pesanan”.</li>
                        <li>Baca dan setujui kebijakan pembatalan (refund/denda jika ada).</li>
                        <li>Konfirmasi pembatalan.</li>
                        <li>Anda akan menerima notifikasi atau email sebagai bukti pembatalan berhasil.</li>
                    </ol>
                    <h6>Catatan penting:</h6>
                    <ul>
                        <li>Proses pengembalian dana (refund) mengikuti kebijakan masing-masing villa.</li>
                        <li>Beberapa pesanan mungkin tidak dapat dibatalkan jika sudah melewati batas waktu tertentu (H-1 atau saat check-in).</li>
                        <li>Biaya administrasi dapat dikenakan sesuai ketentuan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
