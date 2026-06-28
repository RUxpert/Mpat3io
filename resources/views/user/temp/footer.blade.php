<style>

        /* Navigasi Bawah Styling */
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
</style>
<nav class="bottom-nav">
        <div class="container">
            <div class="d-flex justify-content-around">

                <a href="{{ url('user/dashboard') }}" class="nav-item-custom">
                    <img src="{{ asset('asset/icon/ic_home.png') }}" height="25">
                    <span>Beranda</span>
                </a>
                
                <a href="{{ url('user/dashboard/riwayat') }}" class="nav-item-custom">
                    <img src="{{ asset('asset/icon/ic_history.png') }}"  height="25">
                    <span>Riwayat</span>
                </a>
                <a href="{{ url('user/dashboard/akun') }}" class="nav-item-custom">
                    <img src="{{ asset('asset/icon/ic_user.png') }}"  height="25">
                    <span>Akun</span>
                </a>
            </div>
        </div>
    </nav>
