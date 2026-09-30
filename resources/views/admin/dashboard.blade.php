<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - EVChargeHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f8f7;
            color: #173b35;
        }

        /* ================================
           LAYOUT
        ================================= */

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* ================================
           SIDEBAR
        ================================= */

        .sidebar {
            width: 255px;
            min-height: 100vh;
            background: #006b5d;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .logo {
            height: 86px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            background: #25d39a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: bold;
        }

        .sidebar-section {
            padding: 26px 10px 0;
        }

        .sidebar-title {
            color: #8dd3c7;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 0 14px 10px;
            text-transform: uppercase;
        }

        .menu-item {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 13px;

            text-decoration: none;
            color: rgba(255,255,255,0.9);

            padding: 13px 16px;
            border-radius: 10px;

            margin-bottom: 5px;

            font-size: 14px;

            transition: 0.2s;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.10);
            color: white;
        }

        .menu-item.active {
            background: #0ca878;
            color: white;
            font-weight: bold;
        }

        .menu-icon {
            width: 25px;
            text-align: center;
            font-size: 18px;
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255,255,255,0.12);
            margin: 20px 18px;
        }

        .logout-button {
            color: #ffd6d6 !important;
            background: transparent;
            border: none;
            cursor: pointer;
            text-align: left;
            font-family: inherit;
        }

        .logout-button:hover {
            background: rgba(220,53,69,0.15);
        }

        /* ================================
           MAIN
        ================================= */

        .main {
            margin-left: 255px;
            width: calc(100% - 255px);
            min-height: 100vh;
        }

        /* ================================
           TOPBAR
        ================================= */

        .topbar {
            height: 76px;
            background: white;
            border-bottom: 1px solid #e5ecea;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 35px;
        }

        .page-title {
            font-size: 21px;
            font-weight: bold;
            color: #064f46;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .notification {
            width: 40px;
            height: 40px;

            background: #ecfaf5;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
        }

        .profile-icon {
            width: 42px;
            height: 42px;

            background: #d9f7ec;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 19px;
        }

        .admin-info {
            display: flex;
            flex-direction: column;
        }

        .admin-name {
            font-size: 14px;
            font-weight: bold;
            color: #064f46;
        }

        .admin-role {
            font-size: 11px;
            color: #78908a;
            margin-top: 3px;
        }

        /* ================================
           CONTENT
        ================================= */

        .content-wrapper {
            padding: 32px 38px 45px;
        }

        /* ================================
           WELCOME
        ================================= */

        .welcome {
            background: linear-gradient(
                110deg,
                #e8fff5,
                #d5f7e9
            );

            border: 1px solid #c7ecdf;

            border-radius: 22px;

            padding: 30px 35px;

            min-height: 180px;

            margin-bottom: 30px;

            position: relative;
            overflow: hidden;
        }

        .welcome::after {
            content: "⚡";

            position: absolute;

            right: 55px;
            bottom: -30px;

            font-size: 150px;

            opacity: 0.07;
        }

        .welcome-label {
            display: inline-block;

            background: #9cefd0;
            color: #006b5d;

            padding: 9px 17px;

            border-radius: 30px;

            font-size: 13px;
            font-weight: bold;

            margin-bottom: 13px;
        }

        .welcome h1 {
            color: #064f46;
            font-size: 29px;
            margin-bottom: 9px;
        }

        .welcome p {
            color: #456c65;
            font-size: 14px;
            line-height: 1.6;

            max-width: 650px;
        }

        /* ================================
           SECTION TITLE
        ================================= */

        .section-title {
            display: flex;
            align-items: center;
            gap: 9px;

            margin-bottom: 16px;
        }

        .section-title h2 {
            color: #064f46;
            font-size: 20px;
        }

        .section-icon {
            font-size: 21px;
        }

        /* ================================
           STATISTIC CARD
        ================================= */

        .stats {
            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 18px;

            margin-bottom: 32px;
        }

        .stat-card {
            background: white;

            border: 1px solid #e8eeec;

            border-radius: 17px;

            padding: 21px;

            display: flex;
            align-items: center;

            gap: 15px;

            box-shadow: 0 5px 18px rgba(0,0,0,0.045);

            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.07);
        }

        .stat-icon {
            width: 54px;
            height: 54px;

            border-radius: 14px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 23px;

            flex-shrink: 0;
        }

        .user-icon {
            background: #e3f7ef;
        }

        .station-icon {
            background: #e2f2ff;
        }

        .charger-icon {
            background: #fff3d8;
        }

        .charging-icon {
            background: #f0e7ff;
        }

        .stat-info h3 {
            color: #70827e;
            font-size: 12px;
            font-weight: normal;
            margin-bottom: 5px;
        }

        .number {
            color: #087f6d;
            font-size: 27px;
            font-weight: bold;
        }

        /* ================================
           QUICK MENU
        ================================= */

        .quick-menu {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 17px;

            margin-bottom: 30px;
        }

        .quick-card {
            background: white;

            border: 1px solid #e8eeec;

            border-radius: 17px;

            padding: 20px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            text-decoration: none;

            box-shadow: 0 5px 18px rgba(0,0,0,0.04);

            transition: 0.2s;
        }

        .quick-card:hover {
            transform: translateY(-3px);

            border-color: #a9dfcf;

            box-shadow: 0 10px 25px rgba(0,0,0,0.07);
        }

        .quick-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quick-icon {
            width: 52px;
            height: 52px;

            border-radius: 14px;

            background: #e1f8ef;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 22px;
        }

        .quick-text h3 {
            color: #087f6d;
            font-size: 15px;
            margin-bottom: 5px;
        }

        .quick-text p {
            color: #82918e;
            font-size: 12px;
        }

        .arrow {
            color: #0b9875;
            font-size: 22px;
        }

        /* ================================
           SYSTEM INFORMATION
        ================================= */

        .system-card {
            background: white;

            border: 1px solid #e8eeec;

            border-radius: 17px;

            padding: 23px;

            box-shadow: 0 5px 18px rgba(0,0,0,0.04);
        }

        .system-row {
            display: flex;
            justify-content: space-between;

            padding: 13px 0;

            border-bottom: 1px solid #edf1f0;

            font-size: 13px;
        }

        .system-row:last-child {
            border-bottom: none;
        }

        .system-label {
            color: #71827e;
        }

        .system-value {
            color: #087f6d;
            font-weight: bold;
        }

        .status {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            background: #e1f8ef;

            color: #087f6d;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 11px;
        }

        .status-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: #14a875;
        }

        /* ================================
           RESPONSIVE
        ================================= */

        @media (max-width: 1100px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 800px) {

            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .content-wrapper {
                padding: 25px;
            }

        }

        @media (max-width: 650px) {

            .dashboard {
                display: block;
            }

            .sidebar {
                position: relative;

                width: 100%;
                min-height: auto;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                padding: 18px 20px;
                height: auto;
            }

            .admin-info {
                display: none;
            }

            .content-wrapper {
                padding: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .quick-menu {
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

<div class="dashboard">


    <!-- ==================================
         SIDEBAR
    =================================== -->

    <aside class="sidebar">

        <div class="logo">

            <div class="logo-icon">
                ⚡
            </div>

            <div class="logo-text">
                EVChargeHub
            </div>

        </div>


        <!-- MENU UTAMA -->

        <div class="sidebar-section">

            <div class="sidebar-title">
                Menu Utama
            </div>

            <a href="#" class="menu-item active">

                <span class="menu-icon">
                    🏠
                </span>

                <span>
                    Dashboard
                </span>

            </a>

        </div>


        <!-- MANAJEMEN -->

        <div class="sidebar-section">

            <div class="sidebar-title">
                Manajemen
            </div>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    👥
                </span>

                <span>
                    Kelola Pengguna
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    📍
                </span>

                <span>
                    Charging Station
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    🔌
                </span>

                <span>
                    Kelola Charger
                </span>

            </a>

        </div>


        <!-- DATA -->

        <div class="sidebar-section">

            <div class="sidebar-title">
                Data Sistem
            </div>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    ⚡
                </span>

                <span>
                    Data Charging
                </span>

            </a>


            <a href="#" class="menu-item">

                <span class="menu-icon">
                    📊
                </span>

                <span>
                    Laporan
                </span>

            </a>

        </div>


        <div class="sidebar-divider"></div>


        <!-- LOGOUT -->

        <div class="sidebar-section" style="padding-top: 0;">

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="menu-item logout-button"
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



    <!-- ==================================
         MAIN CONTENT
    =================================== -->

    <main class="main">


        <!-- TOPBAR -->

        <header class="topbar">

            <div class="page-title">
                Dashboard
            </div>


            <div class="admin-profile">

                <div class="notification">
                    🔔
                </div>


                <div class="profile-icon">
                    👤
                </div>


                <div class="admin-info">

                    <div class="admin-name">
                        {{ auth()->user()->nama }}
                    </div>

                    <div class="admin-role">
                        Administrator EVChargeHub
                    </div>

                </div>

            </div>

        </header>



        <!-- CONTENT -->

        <div class="content-wrapper">


            <!-- WELCOME -->

            <section class="welcome">

                <div class="welcome-label">
                    ⚡ Admin Panel
                </div>


                <h1>
                    Halo, {{ auth()->user()->nama }}!
                </h1>


                <p>
                    Selamat datang di dashboard admin EVChargeHub.
                    Kelola pengguna, charging station, charger,
                    dan aktivitas charging dengan lebih mudah.
                </p>

            </section>



            <!-- RINGKASAN -->

            <div class="section-title">

                <span class="section-icon">
                    📊
                </span>

                <h2>
                    Ringkasan Sistem
                </h2>

            </div>


            <section class="stats">


                <!-- PENGGUNA -->

                <div class="stat-card">

                    <div class="stat-icon user-icon">
                        👥
                    </div>

                    <div class="stat-info">

                        <h3>
                            Total Pengguna
                        </h3>

                        <div class="number">
                            -
                        </div>

                    </div>

                </div>


                <!-- STATION -->

                <div class="stat-card">

                    <div class="stat-icon station-icon">
                        📍
                    </div>

                    <div class="stat-info">

                        <h3>
                            Charging Station
                        </h3>

                        <div class="number">
                            -
                        </div>

                    </div>

                </div>


                <!-- CHARGER -->

                <div class="stat-card">

                    <div class="stat-icon charger-icon">
                        🔌
                    </div>

                    <div class="stat-info">

                        <h3>
                            Total Charger
                        </h3>

                        <div class="number">
                            -
                        </div>

                    </div>

                </div>


                <!-- CHARGING -->

                <div class="stat-card">

                    <div class="stat-icon charging-icon">
                        ⚡
                    </div>

                    <div class="stat-info">

                        <h3>
                            Sesi Charging
                        </h3>

                        <div class="number">
                            -
                        </div>

                    </div>

                </div>

            </section>



            <!-- AKSES CEPAT -->

            <div class="section-title">

                <span class="section-icon">
                    🚀
                </span>

                <h2>
                    Akses Cepat
                </h2>

            </div>


            <section class="quick-menu">


                <!-- PENGGUNA -->

                <a href="#" class="quick-card">

                    <div class="quick-left">

                        <div class="quick-icon">
                            👥
                        </div>

                        <div class="quick-text">

                            <h3>
                                Kelola Pengguna
                            </h3>

                            <p>
                                Kelola data pengguna EVChargeHub
                            </p>

                        </div>

                    </div>


                    <div class="arrow">
                        →
                    </div>

                </a>



                <!-- STATION -->

                <a href="#" class="quick-card">

                    <div class="quick-left">

                        <div class="quick-icon">
                            📍
                        </div>

                        <div class="quick-text">

                            <h3>
                                Charging Station
                            </h3>

                            <p>
                                Kelola lokasi charging station
                            </p>

                        </div>

                    </div>


                    <div class="arrow">
                        →
                    </div>

                </a>



                <!-- CHARGER -->

                <a href="#" class="quick-card">

                    <div class="quick-left">

                        <div class="quick-icon">
                            🔌
                        </div>

                        <div class="quick-text">

                            <h3>
                                Kelola Charger
                            </h3>

                            <p>
                                Kelola perangkat charger
                            </p>

                        </div>

                    </div>


                    <div class="arrow">
                        →
                    </div>

                </a>



                <!-- DATA CHARGING -->

                <a href="#" class="quick-card">

                    <div class="quick-left">

                        <div class="quick-icon">
                            ⚡
                        </div>

                        <div class="quick-text">

                            <h3>
                                Data Charging
                            </h3>

                            <p>
                                Lihat aktivitas pengisian kendaraan
                            </p>

                        </div>

                    </div>


                    <div class="arrow">
                        →
                    </div>

                </a>

            </section>



            <!-- INFORMASI SISTEM -->

            <div class="section-title">

                <span class="section-icon">
                    📌
                </span>

                <h2>
                    Informasi Sistem
                </h2>

            </div>


            <section class="system-card">


                <div class="system-row">

                    <span class="system-label">
                        Sistem
                    </span>

                    <span class="system-value">
                        EVChargeHub
                    </span>

                </div>


                <div class="system-row">

                    <span class="system-label">
                        Login sebagai
                    </span>

                    <span class="system-value">
                        Administrator
                    </span>

                </div>


                <div class="system-row">

                    <span class="system-label">
                        Status Sistem
                    </span>

                    <span class="status">

                        <span class="status-dot"></span>

                        Aktif

                    </span>

                </div>


            </section>


        </div>

    </main>

</div>

</body>
</html>