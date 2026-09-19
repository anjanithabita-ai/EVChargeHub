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


        html {
            scroll-behavior: smooth;
        }


        body {
            margin: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f4f8f7;

            color: #1f2937;
        }


        /* =========================================
           SIDEBAR
        ========================================= */

        .sidebar {

            position: fixed;

            left: 0;
            top: 0;

            width: 270px;
            height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #006b57 0%,
                    #004d40 55%,
                    #003b34 100%
                );

            color: white;

            overflow-y: auto;

            z-index: 1000;

            box-shadow:
                5px 0 20px rgba(0, 0, 0, 0.12);
        }


        .sidebar::-webkit-scrollbar {
            width: 5px;
        }


        .sidebar::-webkit-scrollbar-thumb {

            background:
                rgba(255,255,255,0.25);

            border-radius: 10px;
        }


        /* =========================================
           LOGO
        ========================================= */

        .sidebar-header {

            height: 78px;

            padding: 18px 22px;

            display: flex;

            align-items: center;

            gap: 12px;

            border-bottom:
                1px solid rgba(255,255,255,0.10);
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

            box-shadow:
                0 5px 15px rgba(0,0,0,0.15);
        }


        .logo-text {

            font-size: 21px;

            font-weight: bold;

            letter-spacing: -0.3px;
        }


        /* =========================================
           MENU
        ========================================= */

        .menu {

            padding:
                15px 12px 30px;
        }


        .menu-title {

            padding:
                15px 14px 8px;

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

            padding:
                12px 14px;

            margin-bottom: 4px;

            border-radius: 10px;

            color: #e7f8f3;

            text-decoration: none;

            font-size: 14px;

            line-height: 1.2;

            transition:
                all 0.2s ease;

            border: none;

            background: transparent;

            cursor: pointer;
        }


        .menu-item:hover {

            background:
                rgba(255,255,255,0.10);

            color: white;

            transform:
                translateX(3px);
        }


        .menu-item.active {

            background:
                linear-gradient(
                    90deg,
                    #11a875,
                    #079567
                );

            color: white;

            font-weight: bold;

            box-shadow:
                0 5px 12px rgba(0,0,0,0.14);
        }


        .menu-icon {

            width: 27px;

            min-width: 27px;

            text-align: center;

            font-size: 18px;
        }


        .menu-divider {

            margin:
                18px 8px;

            border-top:
                1px solid rgba(255,255,255,0.12);
        }


        /* =========================================
           MAIN
        ========================================= */

        .main {

            margin-left: 270px;

            min-height: 100vh;
        }


        /* =========================================
           TOPBAR
        ========================================= */

        .topbar {

            height: 70px;

            background: white;

            border-bottom:
                1px solid #e5e7eb;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding:
                0 35px;

            position: sticky;

            top: 0;

            z-index: 500;

            box-shadow:
                0 2px 8px rgba(0,0,0,0.03);
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


        .notification {

            width: 38px;
            height: 38px;

            border-radius: 50%;

            background: #ecfdf5;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;

            position: relative;
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


        /* =========================================
           CONTENT
        ========================================= */

        .content {

            padding:
                30px 35px 50px;

            max-width: 1500px;
        }


        /* =========================================
           WELCOME
        ========================================= */

        .welcome {

            min-height: 210px;

            border-radius: 22px;

            padding: 35px;

            background:
                linear-gradient(
                    120deg,
                    #eafff1,
                    #e5f8f7
                );

            border:
                1px solid #d3eee1;

            position: relative;

            overflow: hidden;

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 28px;

            box-shadow:
                0 8px 25px rgba(0,0,0,0.05);
        }


        .welcome::after {

            content: "";

            position: absolute;

            width: 350px;
            height: 350px;

            border-radius: 50%;

            background:
                rgba(38,208,124,0.08);

            right: -100px;
            top: -130px;
        }


        .welcome-content {

            position: relative;

            z-index: 2;
        }


        .welcome-label {

            display: inline-block;

            background: #a7f3d0;

            color: #065f46;

            padding:
                8px 16px;

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

            position: relative;

            z-index: 2;

            font-size: 85px;

            margin-right: 40px;

            opacity: 0.9;
        }


        /* =========================================
           SECTION TITLE
        ========================================= */

        .section-title {

            margin-top: 30px;

            margin-bottom: 15px;

            font-size: 20px;

            color: #064e3b;
        }


        /* =========================================
           QUICK ACCESS
        ========================================= */

        .stat-grid {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 18px;
        }


        .stat-card {

            background: white;

            padding: 20px;

            border-radius: 16px;

            border:
                1px solid #e7ecea;

            box-shadow:
                0 5px 15px rgba(0,0,0,0.05);

            display: flex;

            align-items: center;

            gap: 15px;

            text-decoration: none;

            color: inherit;

            transition:
                all 0.2s ease;
        }


        .stat-card:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 10px 22px rgba(0,0,0,0.08);
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

            margin:
                5px 0 0;

            font-size: 12px;

            color: #64748b;
        }


        /* =========================================
           INFORMATION
        ========================================= */

        .info-grid {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 20px;

            margin-top: 18px;
        }


        .info-card {

            background: white;

            border-radius: 16px;

            padding: 23px;

            border:
                1px solid #e6ece9;

            box-shadow:
                0 5px 15px rgba(0,0,0,0.05);
        }


        .info-card h3 {

            margin:
                0 0 8px;

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

            padding:
                9px 15px;

            background: #07895f;

            color: white;

            text-decoration: none;

            border-radius: 8px;

            font-size: 12px;

            font-weight: bold;

            transition: 0.2s;
        }


        .info-button:hover {

            background: #056c4c;
        }


        /* =========================================
           FOOTER
        ========================================= */

        .footer {

            text-align: center;

            margin-top: 45px;

            color: #94a3b8;

            font-size: 12px;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media(max-width: 1100px) {

            .sidebar {

                width: 240px;
            }


            .main {

                margin-left: 240px;
            }


            .stat-grid {

                grid-template-columns:
                    repeat(2, 1fr);
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

                padding:
                    25px 20px;
            }


            .welcome-icon {

                display: none;
            }


            .info-grid {

                grid-template-columns: 1fr;
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

                padding:
                    13px 8px;
            }


            .menu-icon {

                width: 100%;
            }


            .topbar {

                padding:
                    0 15px;
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

        }

    </style>

</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<aside class="sidebar">


    <!-- LOGO -->

    <div class="sidebar-header">

        <div class="logo-icon">
            ⚡
        </div>

        <div class="logo-text">
            EVChargeHub
        </div>

    </div>


    <div class="menu">


        <!-- MENU UTAMA -->

        <div class="menu-title">
            Menu Utama
        </div>


        <a
            href="{{ route('user.dashboard') }}"
            class="menu-item active"
        >

            <span class="menu-icon">
                🏠
            </span>

            <span>
                Dashboard
            </span>

        </a>


        <!-- AKUN -->

        <div class="menu-title">
            Akun
        </div>


        <a
            href="{{ route('profile.edit') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                👤
            </span>

            <span>
                Profil Saya
            </span>

        </a>


        <a
            href="{{ route('vehicles.index') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                🚗
            </span>

            <span>
                Kendaraan Saya
            </span>

        </a>


        <!-- FITUR UTAMA -->

        <div class="menu-title">
            Fitur Utama
        </div>


        <!-- CHARGING STATION -->

        <a
            href="{{ route('stations.index') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                📍
            </span>

            <span>
                Charging Station
            </span>

        </a>


        <!-- CHARGING -->

        <a
            href="{{ route('stations.index') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                ⚡
            </span>

            <span>
                Charging
            </span>

        </a>


        <!-- RIWAYAT -->

        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                🕐
            </span>

            <span>
                Riwayat
            </span>

        </a>


        <!-- NOTIFIKASI -->

        <a
            href="#"
            class="menu-item"
        >

            <span class="menu-icon">
                🔔
            </span>

            <span>
                Notifikasi
            </span>

        </a>


        <!-- LOGOUT -->

        <div class="menu-divider"></div>


        <form
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="menu-item"
            >

                <span class="menu-icon">
                    🚪
                </span>

                <span>
                    Logout
                </span>

            </button>

        </form>


    </div>

</aside>



<!-- =====================================================
     MAIN
===================================================== -->

<div class="main">


    <!-- TOPBAR -->

    <header class="topbar">


        <div class="page-title">
            Dashboard
        </div>


        <div class="user-area">


            <div class="notification">

                🔔

                <span class="notification-badge">
                    3
                </span>

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


            <!-- STATION -->

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



            <!-- VEHICLE -->

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



            <!-- CHARGING -->

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


            <!-- CHARGING STATION -->

            <div class="info-card">

                <h3>
                    📍 Charging Station
                </h3>


                <p>
                    Cari charging station, lihat detail
                    lokasi, ketersediaan charger, tarif,
                    dan informasi station.
                </p>


                <a
                    href="{{ route('stations.index') }}"
                    class="info-button"
                >
                    Cari Station →
                </a>

            </div>



            <!-- KENDARAAN -->

            <div class="info-card">

                <h3>
                    🚗 Kendaraan Saya
                </h3>


                <p>
                    Tambahkan dan kelola data kendaraan
                    listrik yang akan digunakan untuk
                    melakukan charging.
                </p>


                <a
                    href="{{ route('vehicles.index') }}"
                    class="info-button"
                >
                    Kelola Kendaraan →
                </a>

            </div>



            <!-- CHARGING -->

            <div class="info-card">

                <h3>
                    ⚡ Charging
                </h3>


                <p>
                    Untuk melakukan charging, pilih
                    charging station terlebih dahulu,
                    kemudian pilih charger yang tersedia.
                </p>


                <a
                    href="{{ route('stations.index') }}"
                    class="info-button"
                >
                    Pilih Station →
                </a>

            </div>



            <!-- RIWAYAT -->

            <div class="info-card">

                <h3>
                    🕐 Riwayat Charging
                </h3>


                <p>
                    Lihat riwayat pengisian kendaraan,
                    detail transaksi, status pembayaran,
                    dan invoice atau struk.
                </p>


                <a
                    href="#"
                    class="info-button"
                >
                    Lihat Riwayat →
                </a>

            </div>



            <!-- NOTIFIKASI -->

            <div class="info-card">

                <h3>
                    🔔 Notifikasi
                </h3>


                <p>
                    Lihat pemberitahuan mengenai proses
                    charging, status pembayaran, dan
                    informasi lainnya.
                </p>


                <a
                    href="#"
                    class="info-button"
                >
                    Lihat Notifikasi →
                </a>

            </div>



            <!-- PROFIL -->

            <div class="info-card">

                <h3>
                    👤 Profil Saya
                </h3>


                <p>
                    Kelola nama, username, email,
                    nomor telepon, dan password akun
                    EVChargeHub Anda.
                </p>


                <a
                    href="{{ route('profile.edit') }}"
                    class="info-button"
                >
                    Kelola Profil →
                </a>

            </div>


        </div>



        <!-- FOOTER -->

        <div class="footer">

            © {{ date('Y') }} EVChargeHub
            — Sistem Manajemen Charging Kendaraan Listrik

        </div>


    </main>

</div>


</body>

</html>