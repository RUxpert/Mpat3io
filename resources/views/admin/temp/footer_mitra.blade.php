<nav class="bottom-nav">
        <div class="container">
            <div class="d-flex justify-content-around">

                <a href="{{ url('admin/dashboard') }}" class="nav-item-custom">
                    <img src="{{ asset('asset/icon/ic_home.png') }}" height="25">
                    <span>Beranda</span>
                </a>
                <a href="{{ url('admin/dashboard/tambah_fasilitas') }}" class="nav-item-custom">
                    <img src="{{ asset('asset/icon/ic_plus.png') }}"  height="25">
                    <span>Tambah Fasilitas</span>
                </a>
                <a href="{{ url('admin/dashboard/pesanan') }}" class="nav-item-custom">
                    <img src="{{ asset('asset/icon/ic_history.png') }}"  height="25">
                    <span>Pesanan</span>
                </a>
                <a href="{{ url('admin/dashboard/akun') }}" class="nav-item-custom">
                    <img src="{{ asset('asset/icon/ic_user.png') }}"  height="25">
                    <span>Akun</span>
                </a>
            </div>
        </div>
    </nav>
