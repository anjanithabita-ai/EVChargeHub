<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifikasi - EVChargeHub</title>

    <style>

        * {
            box-sizing: border-box;
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


        /* =========================
           SIDEBAR
        ========================= */

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
                5px 0 20px rgba(0,0,0,0.12);
        }


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
        }


        .logo-text {

            font-size: 21px;

            font-weight: bold;
        }


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

            transition: 0.2s;

            border: none;

            background: transparent;

            cursor: pointer;
        }


        .menu-item:hover {

            background:
                rgba(255,255,255,0.10);

            color: white;
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


        /* =========================
           MAIN
        ========================= */

        .main {

            margin-left: 270px;

            min-height: 100vh;
        }


        /* =========================
           TOPBAR
        ========================= */

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

            box-shadow:
                0 2px 8px rgba(0,0,0,0.03);
        }


        .page-title {

            font-size: 20px;

            font-weight: bold;

            color: #064e3b;
        }


        .user-area {

            display: flex;

            align-items: center;

            gap: 12px;
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


        /* =========================
           CONTENT
        ========================= */

        .content {

            padding:
                30px 35px 50px;

            max-width: 1200px;
        }


        .header-card {

            background:
                linear-gradient(
                    120deg,
                    #eafff1,
                    #e5f8f7
                );

            border:
                1px solid #d3eee1;

            border-radius: 18px;

            padding: 25px;

            margin-bottom: 25px;
        }


        .header-card h1 {

            margin: 0;

            color: #064e3b;

            font-size: 25px;
        }


        .header-card p {

            margin:
                8px 0 0;

            color: #64748b;

            font-size: 14px;
        }


        /* =========================
           NOTIFICATION CARD
        ========================= */

        .notification-card {

            background: white;

            border:
                1px solid #e5e7eb;

            border-radius: 15px;

            padding: 20px;

            margin-bottom: 15px;

            display: flex;

            align-items: center;

            gap: 15px;

            box-shadow:
                0 5px 15px rgba(0,0,0,0.05);

            transition: 0.2s;
        }


        .notification-card:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 20px rgba(0,0,0,0.08);
        }


        .notification-icon {

            width: 50px;
            height: 50px;

            min-width: 50px;

            border-radius: 50%;

            background: #dcfce7;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 23px;
        }


        .notification-content {

            flex: 1;
        }


        .notification-content h3 {

            margin:
                0 0 6px;

            font-size: 15px;

            color: #064e3b;
        }


        .notification-content p {

            margin: 0;

            font-size: 13px;

            color: #64748b;

            line-height: 1.5;
        }


        .notification-time {

            font-size: 11px;

            color: #94a3b8;

            white-space: nowrap;
        }


        /* =========================
           BACK BUTTON
        ========================= */

        .back-button {

            display: inline-block;

            margin-top: 15px;

            padding:
                10px 16px;

            background: #07895f;

            color: white;

            text-decoration: none;

            border-radius: 8px;

            font-size: 13px;

            font-weight: bold;
        }


        .back-button:hover {

            background: #056c4c;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media(max-width: 600px) {

            .sidebar {

                width: 70px;
            }

            .main {

                margin-left: 70px;
            }

            .logo-text,
            .menu-title,
            .menu-item span:not(.menu-icon) {

                display: none;
            }

            .sidebar-header {

                justify-content: center;

                padding: 15px;
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

            .content {

                padding:
                    20px 15px;
            }

            .notification-card {

                align-items: flex-start;
            }

            .notification-time {

                display: none;
            }
        }

    </style>

</head>


<body>


<!-- =========================
     SIDEBAR
========================= -->

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


        <a
            href="{{ route('user.dashboard') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                🏠
            </span>

            <span>
                Dashboard
            </span>

        </a>


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


        <div class="menu-title">
            Fitur Utama
        </div>


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


        <a
            href="{{ route('notifications.index') }}"
            class="menu-item active"
        >

            <span class="menu-icon">
                🔔
            </span>

            <span>
                Notifikasi
            </span>

        </a>


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


<!-- =========================
     MAIN
========================= -->

<div class="main">


    <!-- TOPBAR -->

    <header class="topbar">


        <div class="page-title">
            Notifikasi
        </div>


        <div class="user-area">

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


        <!-- HEADER -->

        <div class="header-card">

            <h1>
                🔔 Notifikasi
            </h1>

            <p>
                Informasi dan pemberitahuan terbaru dari EVChargeHub.
            </p>

            <a
                href="{{ route('user.dashboard') }}"
                class="back-button"
            >
                ← Kembali ke Dashboard
            </a>

        </div>


        <!-- NOTIFIKASI 1 -->

        <div class="notification-card">


            <div class="notification-icon">
                👋
            </div>


            <div class="notification-content">

                <h3>
                    Selamat datang di EVChargeHub
                </h3>

                <p>
                    Akun Anda berhasil masuk ke sistem EVChargeHub.
                    Selamat menggunakan layanan kami.
                </p>

            </div>


            <div class="notification-time">
                Baru saja
            </div>


        </div>


        <!-- NOTIFIKASI 2 -->

        <div class="notification-card">


            <div class="notification-icon">
                🚗
            </div>


            <div class="notification-content">

                <h3>
                    Tambahkan kendaraan
                </h3>

                <p>
                    Silakan tambahkan kendaraan listrik Anda
                    sebelum melakukan charging.
                </p>

            </div>


            <div class="notification-time">
                Hari ini
            </div>


        </div>


        <!-- NOTIFIKASI 3 -->

        <div class="notification-card">


            <div class="notification-icon">
                📍
            </div>


            <div class="notification-content">

                <h3>
                    Charging Station tersedia
                </h3>

                <p>
                    Anda dapat melihat lokasi charging station
                    dan charger yang tersedia.
                </p>

            </div>


            <div class="notification-time">
                Hari ini
            </div>


        </div>


        <!-- NOTIFIKASI 4 -->

        <div class="notification-card">


            <div class="notification-icon">
                ⚡
            </div>


            <div class="notification-content">

                <h3>
                    Siap melakukan charging
                </h3>

                <p>
                    Pilih charging station dan charger yang tersedia
                    untuk memulai sesi charging.
                </p>

            </div>


            <div class="notification-time">
                Hari ini
            </div>


        </div>


    </main>

</div>


</body>

</html>
