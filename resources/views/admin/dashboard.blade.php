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
            font-family: Arial, sans-serif;
            background: #f4f8f7;
            color: #163b35;
        }

        /* =========================
           LAYOUT UTAMA
        ========================= */

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #00695c;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,.3) transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,.3);
            border-radius: 10px;
        }

        .brand {
            min-height: 82px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255,255,255,.12);
            flex-shrink: 0;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            border-radius: 50%;
            background: #20d890;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            flex-shrink: 0;
        }

        .brand-name {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: .2px;
        }

        .sidebar-content {
            padding: 18px 10px 25px;
        }

        .menu-title {
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.2px;
            color: #a9d9cf;
            margin: 20px 12px 9px;
            text-transform: uppercase;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 13px;
            text-decoration: none;
            color: white;
            padding: 12px 14px;
            margin-bottom: 4px;
            border-radius: 9px;
            font-size: 13.5px;
            min-height: 44px;
            transition: background .2s ease, color .2s ease;
            cursor: pointer;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.13);
            color: white;
        }

        .menu-item.active {
            background: #10aa79;
            color: white;
            font-weight: bold;
            box-shadow: inset 3px 0 0 #20d890;
        }

        .menu-item-disabled {
            display: flex;
            align-items: center;
            gap: 13px;
            color: white;
            padding: 12px 14px;
            margin-bottom: 4px;
            border-radius: 9px;
            font-size: 13.5px;
            min-height: 44px;
            cursor: default;
            user-select: none;
        }

        .menu-icon {
            width: 22px;
            min-width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255,255,255,.15);
            margin: 20px 8px;
        }

        .logout {
            color: #ffe4e4;
            font-family: Arial, sans-serif;
            font-size: 13.5px;
        }

        .logout:hover {
            background: rgba(255,255,255,.13);
        }

        .menu-item:focus-visible,
        .logout:focus-visible {
            outline: 2px solid #20d890;
            outline-offset: 2px;
        }

        /* =========================
           KONTEN UTAMA
        ========================= */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        /* =========================
           TOPBAR
        ========================= */

        .topbar {
            min-height: 76px;
            background: white;
            border-bottom: 1px solid #e4ebe8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 15px 32px;
        }

        .page-title {
            font-size: 21px;
            font-weight: bold;
            color: #123f37;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .notification,
        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .notification {
            background: #e9faf4;
        }

        .profile-icon {
            background: #dff7ed;
        }

        .admin-name {
            font-size: 13px;
            font-weight: bold;
            color: #16483f;
        }

        /* =========================
           ISI DASHBOARD
        ========================= */

        .content {
            padding: 30px 32px 50px;
        }

        .welcome {
            background: linear-gradient(120deg, #e7fff5, #d4f7e9);
            border: 1px solid #bdebd9;
            border-radius: 20px;
            padding: 30px 34px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }

        .welcome::after {
            content: "⚡";
            position: absolute;
            right: 55px;
            bottom: -20px;
            font-size: 130px;
            opacity: .07;
            pointer-events: none;
        }

        .welcome-label {
            display: inline-block;
            background: #a9efd5;
            color: #075c4e;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 12px;
        }

        .welcome h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #07594d;
            position: relative;
            z-index: 1;
        }

        .welcome p {
            max-width: 700px;
            color: #315f57;
            font-size: 14px;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            color: #124d43;
            margin-bottom: 16px;
        }

        /* =========================
           RINGKASAN SISTEM
        ========================= */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .summary-card {
            background: white;
            border-radius: 15px;
            padding: 19px;
            border: 1px solid #e4eeeb;
            box-shadow: 0 4px 15px rgba(0,0,0,.035);
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .summary-icon {
            width: 50px;
            height: 50px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .icon-user {
            background: #e0f7ef;
        }

        .icon-station {
            background: #e1efff;
        }

        .icon-charger {
            background: #fff2d7;
        }

        .icon-charging {
            background: #f0e5ff;
        }

        .summary-info {
            min-width: 0;
        }

        .summary-info small {
            display: block;
            color: #6d8580;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .summary-info strong {
            font-size: 24px;
            color: #00896e;
        }

        /* =========================
           AKSES CEPAT
        ========================= */

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .quick-card {
            background: white;
            border: 1px solid #e4eeeb;
            border-radius: 15px;
            padding: 19px;
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 4px 15px rgba(0,0,0,.035);
            transition: transform .2s ease, box-shadow .2s ease;
            min-width: 0;
        }

        .quick-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,.07);
            border-color: #bdebd9;
        }

        .quick-card-disabled {
            cursor: default;
        }

        .quick-card-disabled:hover {
            transform: none;
            box-shadow: 0 4px 15px rgba(0,0,0,.035);
            border-color: #e4eeeb;
        }

        .quick-icon {
            width: 49px;
            height: 49px;
            border-radius: 13px;
            background: #e1f8ef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            flex-shrink: 0;
        }

        .quick-info {
            flex: 1;
            min-width: 0;
        }

        .quick-info strong {
            display: block;
            color: #00896e;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .quick-info span {
            color: #718681;
            font-size: 12px;
            line-height: 1.5;
        }

        .arrow {
            color: #00896e;
            font-size: 22px;
            flex-shrink: 0;
        }

        /* =========================
           INFORMASI SISTEM
        ========================= */

        .info-card {
            background: white;
            border: 1px solid #e4eeeb;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(0,0,0,.035);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
        }

        .info-item {
            background: #f7fbfa;
            border-radius: 11px;
            padding: 15px;
            min-width: 0;
        }

        .info-item small {
            display: block;
            color: #738782;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .info-item strong {
            color: #126052;
            font-size: 14px;
            line-height: 1.5;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1200px) {
            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .info-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .content {
                padding-left: 24px;
                padding-right: 24px;
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

            .quick-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding-left: 20px;
                padding-right: 20px;
            }

            .welcome {
                padding: 25px;
            }

            .welcome h1 {
                font-size: 25px;
            }
        }

        @media (max-width: 600px) {
            .layout {
                display: block;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                min-height: auto;
                max-height: none;
            }

            .sidebar-content {
                padding-top: 12px;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .summary-grid,
            .info-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 15px 18px;
            }

            .content {
                padding: 20px 16px 35px;
            }

            .welcome {
                padding: 23px 20px;
            }

            .welcome h1 {
                font-size: 23px;
            }

            .welcome::after {
                right: 10px;
                font-size: 90px;
            }

            .admin-name {
                display: none;
            }

            .page-title {
                font-size: 19px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    {{-- =========================
         SIDEBAR NAVIGASI
    ========================== --}}

    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">⚡</div>
            <div class="brand-name">EVChargeHub</div>
        </div>

        <div class="sidebar-content">

            {{-- MENU UTAMA --}}

            <div class="menu-title">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}"
               class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="menu-icon">🏠</span>
                <span>Dashboard</span>
            </a>


            {{-- MANAJEMEN --}}

            <div class="menu-title">Manajemen</div>

            <div class="menu-item-disabled">
                <span class="menu-icon">👥</span>
                <span>Kelola Pengguna</span>
            </div>

            <div class="menu-item-disabled">
                <span class="menu-icon">👨‍💼</span>
                <span>Kelola Operator</span>
            </div>

            <a href="{{ route('admin.charging-stations.index') }}"
               class="menu-item {{ request()->routeIs('admin.charging-stations.*') ? 'active' : '' }}">
                <span class="menu-icon">📍</span>
                <span>Charging Station</span>
            </a>

            <a href="{{ route('admin.chargers.index') }}"
               class="menu-item {{ request()->routeIs('admin.chargers.*') ? 'active' : '' }}">
                <span class="menu-icon">🔌</span>
                <span>Kelola Charger</span>
            </a>


            {{-- OPERASIONAL --}}

            <div class="menu-title">Operasional</div>

            <a href="{{ route('admin.monitoring.index') }}"
               class="menu-item {{ request()->routeIs('admin.monitoring.*') ? 'active' : '' }}">
                <span class="menu-icon">⚡</span>
                <span>Monitoring Charging</span>
            </a>


            {{-- LAPORAN DAN TRANSAKSI --}}

            <div class="menu-title">Laporan & Transaksi</div>

            <a href="{{ route('admin.reports.index') }}"
                class="menu-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <span class="menu-icon">📊</span>
            <span>Laporan</span>
            </a>
            <a href="{{ route('admin.tariffs.index') }}"
               class="menu-item {{ request()->routeIs('admin.tariffs.*') ? 'active' : '' }}">
                <span class="menu-icon">💰</span>
                <span>Tarif per Station</span>
            </a>

            <a href="{{ route('admin.payments.index') }}"
                class="menu-item {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                <span class="menu-icon">💳</span>
                <span>Pembayaran</span>
            </a>


            {{-- KOMUNIKASI --}}

            <div class="menu-title">Komunikasi</div>

            <div class="menu-item-disabled">
                <span class="menu-icon">⭐</span>
                <span>Ulasan & Feedback</span>
            </div>

            <div class="menu-item-disabled">
                <span class="menu-icon">🎁</span>
                <span>Promosi</span>
            </div>


            {{-- SISTEM --}}

            <div class="menu-title">Sistem</div>

            <div class="menu-item-disabled">
                <span class="menu-icon">🔐</span>
                <span>Hak Akses</span>
            </div>

            <div class="menu-item-disabled">
                <span class="menu-icon">🛡️</span>
                <span>Audit Log</span>
            </div>


            {{-- LOGOUT --}}

            <div class="sidebar-divider"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                        class="menu-item logout"
                        style="width:100%; background:transparent; border:none; cursor:pointer; text-align:left;">

                    <span class="menu-icon">🚪</span>
                    <span>Logout</span>

                </button>
            </form>

        </div>
    </aside>


    {{-- =========================
         KONTEN DASHBOARD
    ========================== --}}

    <main class="main">

        {{-- TOPBAR --}}

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

                <div class="admin-name">
                    {{ auth()->user()->nama ?? auth()->user()->name ?? 'Admin' }}
                </div>

            </div>

        </header>


        <div class="content">

            {{-- WELCOME --}}

            <section class="welcome">

                <div class="welcome-label">
                    ⚡ Admin Panel
                </div>

                <h1>
                    Halo, {{ auth()->user()->nama ?? auth()->user()->name ?? 'Admin' }}!
                </h1>

                <p>
                    Selamat datang di dashboard admin EVChargeHub.
                    Kelola pengguna, charging station, perangkat charger,
                    dan aktivitas charging melalui satu halaman.
                </p>

            </section>


            {{-- RINGKASAN SISTEM --}}

            <h2 class="section-title">
                📊 Ringkasan Sistem
            </h2>

            <div class="summary-grid">

                <div class="summary-card">

                    <div class="summary-icon icon-user">
                        👥
                    </div>

                    <div class="summary-info">
                        <small>Total Pengguna</small>
                        <strong>{{ $totalUsers }}</strong>
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon icon-station">
                        📍
                    </div>

                    <div class="summary-info">
                        <small>Charging Station</small>
                        <strong>{{ $totalLocations }}</strong>
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon icon-charger">
                        🔌
                    </div>

                    <div class="summary-info">
                        <small>Total Charger</small>
                        <strong>{{ $totalChargers }}</strong>
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-icon icon-charging">
                        ⚡
                    </div>

                    <div class="summary-info">
                        <small>Sesi Charging</small>
                        <strong>{{ $totalSessions }}</strong>
                    </div>

                </div>

            </div>


            {{-- AKSES CEPAT --}}

            <h2 class="section-title">
                🚀 Akses Cepat
            </h2>

            <div class="quick-grid">

                <div class="quick-card quick-card-disabled">

                    <div class="quick-icon">
                        👥
                    </div>

                    <div class="quick-info">
                        <strong>Kelola Pengguna</strong>
                        <span>Kelola data pengguna EVChargeHub</span>
                    </div>

                    <div class="arrow">
                        →
                    </div>

                </div>


                <a href="{{ route('admin.charging-stations.index') }}"
                   class="quick-card">

                    <div class="quick-icon">
                        📍
                    </div>

                    <div class="quick-info">
                        <strong>Charging Station</strong>
                        <span>Kelola lokasi, status station, charger, dan tarif charging</span>
                    </div>

                    <div class="arrow">
                        →
                    </div>

                </a>


                <a href="{{ route('admin.chargers.index') }}"
                   class="quick-card">

                    <div class="quick-icon">
                        🔌
                    </div>

                    <div class="quick-info">
                        <strong>Kelola Charger</strong>
                        <span>Kelola perangkat charger dan statusnya</span>
                    </div>

                    <div class="arrow">
                        →
                    </div>

                </a>


                <a href="{{ route('admin.monitoring.index') }}"
                   class="quick-card">

                    <div class="quick-icon">
                        ⚡
                    </div>

                    <div class="quick-info">
                        <strong>Monitoring Charging</strong>
                        <span>Pantau aktivitas dan sesi charging</span>
                    </div>

                    <div class="arrow">
                        →
                    </div>

                </a>

            </div>


            {{-- INFORMASI SISTEM --}}

            <h2 class="section-title">
                📌 Informasi Sistem
            </h2>

            <div class="info-card">

                <div class="info-grid">

                    <div class="info-item">
                        <small>Status Sistem</small>
                        <strong>🟢 Sistem Berjalan Normal</strong>
                    </div>

                    <div class="info-item">
                        <small>Status Charging</small>
                        <strong>⚡ Siap Digunakan</strong>
                    </div>

                    <div class="info-item">
                        <small>Role Saat Ini</small>
                        <strong>👑 Administrator</strong>
                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>