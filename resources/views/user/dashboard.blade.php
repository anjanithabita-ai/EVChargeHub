<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard User - EVChargeHub</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f8f7;
            color: #1f2937;
        }

        a {
            text-decoration: none;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 270px;
            height: 100vh;
            background: linear-gradient(
                180deg,
                #006b57 0%,
                #004d40 55%,
                #003b34 100%
            );
            color: white;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 5px 0 20px rgba(0,0,0,0.12);
        }

        .sidebar-header {
            height: 78px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.10);
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #28d486;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .logo-text {
            font-size: 21px;
            font-weight: bold;
        }

        .menu {
            padding: 15px 12px 30px;
        }

        .menu-title {
            padding: 15px 14px 8px;
            color: #9de5ca;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: bold;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 4px;
            border-radius: 10px;
            color: #e7f8f3;
            font-size: 14px;
            cursor: pointer;
            border: none;
            background: transparent;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.10);
            color: white;
        }

        .menu-item.active {
            background: linear-gradient(
                90deg,
                #11a875,
                #079567
            );
            color: white;
            font-weight: bold;
        }

        .menu-icon {
            width: 27px;
            min-width: 27px;
            text-align: center;
            font-size: 18px;
        }

        .menu-divider {
            margin: 18px 8px;
            border-top: 1px solid rgba(255,255,255,0.12);
        }

        /* MAIN */
        .main {
            margin-left: 270px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
            position: sticky;
            top: 0;
            z-index: 500;
        }

        .page-title {
            font-size: 18px;
            font-weight: bold;
            color: #064e3b;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* NOTIFICATION */
        .notification {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ecfdf5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            position: relative;
            cursor: pointer;
            border: none;
            transition: 0.2s;
        }

        .notification:hover {
            background: #d1fae5;
            transform: scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ef4444;
            color: white;
            width: 17px;
            height: 17px;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* NOTIFICATION BOX */
        .notification-wrapper {
            position: relative;
        }

        .notification-box {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            width: 330px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            z-index: 2000;
        }

        .notification-box.show {
            display: block;
        }

        .notification-header {
            padding: 15px 18px;
            background: #f0fdf4;
            color: #065f46;
            font-weight: bold;
            border-bottom: 1px solid #e5e7eb;
        }

        .notification-item {
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
        }

        .notification-item:hover {
            background: #f8fafc;
        }

        .notification-item strong {
            display: block;
            color: #064e3b;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .notification-item span {
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .notification-empty {
            padding: 25px;
            text-align: center;
            color: #64748b;
            font-size: 13px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #d1fae5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .user-name {
            font-size: 13px;
            font-weight: bold;
            color: #374151;
        }

        /* CONTENT */
        .content {
            padding: 30px 35px 50px;
            max-width: 1500px;
        }

        /* WELCOME */
        .welcome {
            min-height: 210px;
            border-radius: 22px;
            padding: 35px;
            background: linear-gradient(
                120deg,
                #eafff1,
                #e5f8f7
            );
            border: 1px solid #d3eee1;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        }

        .welcome-content {
            position: relative;
            z-index: 2;
        }

        .welcome-label {
            display: inline-block;
            background: #a7f3d0;
            color: #065f46;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .welcome h1 {
            margin: 0;
            font-size: 30px;
            color: #064e3b;
        }

        .welcome p {
            margin-top: 10px;
            color: #41666a;
            font-size: 15px;
            line-height: 1.6;
            max-width: 650px;
        }

        .welcome-icon {
            font-size: 85px;
            margin-right: 40px;
        }

        /* SECTION */
        .section-title {
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 20px;
            color: #064e3b;
        }

        /* CARDS */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 16px;
            border: 1px solid #e7ecea;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 15px;
            color: inherit;
            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 22px rgba(0,0,0,0.08);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            flex-shrink: 0;
        }

        .stat-info h3 {
            margin: 0;
            font-size: 15px;
            color: #087f5b;
        }

        .stat-info p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #64748b;
        }

        /* INFORMATION */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 18px;
        }

        .info-card {
            background: white;
            border-radius: 16px;
            padding: 23px;
            border: 1px solid #e6ece9;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .info-card h3 {
            margin: 0 0 8px;
            color: #087f5b;
            font-size: 17px;
        }

        .info-card p {
            margin: 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .info-button {
            display: inline-block;
            margin-top: 16px;
            padding: 9px 15px;
            background: #07895f;
            color: white;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
        }

        .info-button:hover {
            background: #056c4c;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            margin-top: 45px;
            color: #94a3b8;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media(max-width: 1100px) {

            .sidebar {
                width: 240px;
            }

            .main {
                margin-left: 240px;
            }

            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 800px) {

            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
            }

            .content {
                padding: 25px 20px;
            }

            .welcome-icon {
                display: none;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .notification-box {
                right: -80px;
            }
        }

        @media(max-width: 600px) {

            .sidebar {
                width: 70px;
            }

            .main {
                margin-left: 70px;
            }

            .sidebar-header {
                justify-content: center;
                padding: 15px;
            }

            .logo-text,
            .menu-title,
            .menu-item span:not(.menu-icon) {
                display: none;
            }

            .menu-item {
                justify-content: center;
            }

            .menu-icon {
                width: 100%;
            }

            .topbar {
                padding: 0 15px;
            }

            .user-name {
                display: none;
            }

            .stat-grid {
                grid-template-columns: 1fr;
            }

            .welcome {
                padding: 25px;
            }

            .welcome h1 {
                font-size: 23px;
            }

            .notification-box {
                width: 280px;
                right: -100px;
            }
        }
    </style>

</head>

<body>

<!-- ================= SIDEBAR ================= -->

<aside class="sidebar">

    <div class="sidebar-header">

        <div class="logo-icon">
            ⚡
        </div>

        <div class="logo-text">
            EVChargeHub
        </div>

    </div>

    <div class="menu">

        <div class="menu-title">
            Menu Utama
        </div>

        <a href="{{ route('user.dashboard') }}" class="menu-item active">

            <span class="menu-icon">🏠</span>

            <span>Dashboard</span>

        </a>


        <div class="menu-title">
            Akun
        </div>

        <a href="{{ route('profile.edit') }}" class="menu-item">

            <span class="menu-icon">👤</span>

            <span>Profil Saya</span>

        </a>

        <a href="{{ route('vehicles.index') }}" class="menu-item">

            <span class="menu-icon">🚗</span>

            <span>Kendaraan Saya</span>

        </a>


        <div class="menu-title">
            Fitur Utama
        </div>

        <a href="{{ route('stations.index') }}" class="menu-item">

            <span class="menu-icon">📍</span>

            <span>Charging Station</span>

        </a>

        <a href="{{ route('stations.index') }}" class="menu-item">

            <span class="menu-icon">⚡</span>

            <span>Charging</span>

        </a>

        <!-- NOTIFIKASI SIDEBAR -->
        <button
            type="button"
            class="menu-item"
            onclick="toggleNotifications()"
        >

            <span class="menu-icon">🔔</span>

            <span>Notifikasi</span>

        </button>


        <div class="menu-divider"></div>

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button type="submit" class="menu-item">

                <span class="menu-icon">🚪</span>

                <span>Logout</span>

            </button>

        </form>

    </div>

</aside>


<!-- ================= MAIN ================= -->

<div class="main">

    <!-- TOPBAR -->

    <header class="topbar">

        <div class="page-title">
            Dashboard
        </div>


        <div class="user-area">

            <!-- NOTIFICATION -->

            <div class="notification-wrapper">

                <button
                    type="button"
                    class="notification"
                    onclick="toggleNotifications()"
                    title="Notifikasi"
                >

                    🔔

                    <span class="notification-badge">
                        3
                    </span>

                </button>


                <!-- NOTIFICATION DROPDOWN -->

                <div
                    id="notificationBox"
                    class="notification-box"
                >

                    <div class="notification-header">
                        🔔 Notifikasi
                    </div>


                    <div class="notification-item">

                        <strong>
                            Selamat datang di EVChargeHub
                        </strong>

                        <span>
                            Akun Anda berhasil dibuat.
                        </span>

                    </div>


                    <div class="notification-item">

                        <strong>
                            Kendaraan
                        </strong>

                        <span>
                            Silakan tambahkan kendaraan Anda
                            sebelum melakukan charging.
                        </span>

                    </div>


                    <div class="notification-item">

                        <strong>
                            Charging Station
                        </strong>

                        <span>
                            Cari charging station terdekat
                            untuk memulai pengisian.
                        </span>

                    </div>

                </div>

            </div>


            <div class="user-avatar">
                👤
            </div>


            <div class="user-name">

                {{ auth()->user()->nama }}

            </div>

        </div>

    </header>


    <!-- CONTENT -->

    <main class="content">

        <!-- WELCOME -->

        <section class="welcome">

            <div class="welcome-content">

                <div class="welcome-label">
                    Selamat Datang 👋
                </div>

                <h1>
                    Halo, {{ auth()->user()->nama }}!
                </h1>

                <p>
                    Kelola kendaraan dan lakukan pengisian
                    kendaraan listrik melalui EVChargeHub
                    dengan lebih mudah dan aman.
                </p>

            </div>


            <div class="welcome-icon">
                ⚡🚗
            </div>

        </section>


        <!-- AKSES CEPAT -->

        <h2 class="section-title">
            ⚡ Akses Cepat
        </h2>


        <div class="stat-grid">

            <a
                href="{{ route('stations.index') }}"
                class="stat-card"
            >

                <div
                    class="stat-icon"
                    style="background:#dcfce7;"
                >
                    📍
                </div>

                <div class="stat-info">

                    <h3>
                        Charging Station
                    </h3>

                    <p>
                        Cari station dan lihat charger tersedia.
                    </p>

                </div>

            </a>


            <a
                href="{{ route('vehicles.index') }}"
                class="stat-card"
            >

                <div
                    class="stat-icon"
                    style="background:#dbeafe;"
                >
                    🚗
                </div>

                <div class="stat-info">

                    <h3>
                        Kendaraan Saya
                    </h3>

                    <p>
                        Kelola kendaraan listrik Anda.
                    </p>

                </div>

            </a>


            <a
                href="{{ route('stations.index') }}"
                class="stat-card"
            >

                <div
                    class="stat-icon"
                    style="background:#ede9fe;"
                >
                    ⚡
                </div>

                <div class="stat-info">

                    <h3>
                        Charging
                    </h3>

                    <p>
                        Pilih charger dan mulai sesi charging.
                    </p>

                </div>

            </a>

        </div>


        <!-- INFORMASI -->

        <h2 class="section-title">
            📌 Informasi
        </h2>


        <div class="info-grid">


            <div class="info-card">

                <h3>
                    📍 Charging Station
                </h3>

                <p>
                    Cari charging station, lihat lokasi,
                    charger, dan tarif.
                </p>

                <a
                    href="{{ route('stations.index') }}"
                    class="info-button"
                >
                    Cari Station →
                </a>

            </div>


            <div class="info-card">

                <h3>
                    🚗 Kendaraan Saya
                </h3>

                <p>
                    Tambahkan dan kelola kendaraan listrik
                    yang akan digunakan.
                </p>

                <a
                    href="{{ route('vehicles.index') }}"
                    class="info-button"
                >
                    Kelola Kendaraan →
                </a>

            </div>


            <div class="info-card">

                <h3>
                    ⚡ Charging
                </h3>

                <p>
                    Pilih station kemudian pilih charger
                    yang tersedia.
                </p>

                <a
                    href="{{ route('stations.index') }}"
                    class="info-button"
                >
                    Pilih Station →
                </a>

            </div>


            <div class="info-card">

                <h3>
                    🕐 Riwayat Charging
                </h3>

                <p>
                    Lihat riwayat pengisian kendaraan dan
                    transaksi pembayaran.
                </p>

                <a
                    href="#"
                    class="info-button"
                >
                    Lihat Riwayat →
                </a>

            </div>


            <div class="info-card">

                <h3>
                    🔔 Notifikasi
                </h3>

                <p>
                    Lihat pemberitahuan mengenai charging,
                    pembayaran, dan informasi akun.
                </p>

                <button
                    type="button"
                    class="info-button"
                    onclick="toggleNotifications()"
                    style="border:none; cursor:pointer;"
                >
                    Lihat Notifikasi →
                </button>

            </div>


            <div class="info-card">

                <h3>
                    👤 Profil Saya
                </h3>

                <p>
                    Kelola nama, username, email, nomor
                    telepon, dan password akun.
                </p>

                <a
                    href="{{ route('profile.edit') }}"
                    class="info-button"
                >
                    Kelola Profil →
                </a>

            </div>

        </div>


        <div class="footer">

            © {{ date('Y') }} EVChargeHub
            — Sistem Manajemen Charging Kendaraan Listrik

        </div>

    </main>

</div>


<!-- ================= JAVASCRIPT ================= -->

<script>

function toggleNotifications() {

    const box = document.getElementById('notificationBox');

    box.classList.toggle('show');

}


// Klik di luar dropdown untuk menutup
document.addEventListener('click', function(event) {

    const box = document.getElementById('notificationBox');

    const wrapper = document.querySelector('.notification-wrapper');

    if (
        box &&
        wrapper &&
        !wrapper.contains(event.target)
    ) {

        box.classList.remove('show');

    }

});

</script>

</body>

</html>
