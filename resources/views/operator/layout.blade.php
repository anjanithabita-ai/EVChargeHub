<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Operator') - EVChargeHub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7f7;
            color: #183b3b;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 270px;
            height: 100vh;
            background: #00695c;
            color: white;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 25px 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .sidebar-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .sidebar-header small {
            color: rgba(255,255,255,0.75);
        }

        .menu-title {
            padding: 25px 25px 10px;
            font-size: 12px;
            font-weight: bold;
            color: rgba(255,255,255,0.55);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 5px 12px;
            padding: 13px 18px;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: 0.2s;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.12);
            color: white;
        }

        .menu-item.active {
            background: rgba(255,255,255,0.15);
            font-weight: bold;
        }

        .menu-item i {
            font-size: 19px;
            width: 22px;
        }

        .main-content {
            margin-left: 270px;
            min-height: 100vh;
        }

        .topbar {
            height: 85px;
            background: white;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
        }

        .topbar-title h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .topbar-title p {
            margin: 3px 0 0;
            color: #7a8585;
            font-size: 14px;
        }

        .operator-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .operator-avatar {
            width: 45px;
            height: 45px;
            background: #00796b;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .operator-name {
            font-weight: bold;
        }

        .operator-role {
            font-size: 13px;
            color: #7a8585;
        }

        .content {
            padding: 30px 40px;
        }

        .logout-form {
            margin: 0;
        }

        .logout-button {
            width: 100%;
            border: none;
            background: transparent;
            color: white;
            text-align: left;
            cursor: pointer;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;
            }

            .topbar {
                padding: 0 20px;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="sidebar-header">
            <h4>EVChargeHub</h4>
            <small>Operator Dashboard</small>
        </div>

        {{-- MENU UTAMA --}}
        <div class="menu-title">
            Menu Utama
        </div>

        <a href="{{ route('operator.dashboard') }}"
           class="menu-item {{ request()->routeIs('operator.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>Dashboard</span>
        </a>


        {{-- OPERASIONAL --}}
        <div class="menu-title">
            Operasional
        </div>

        <a href="{{ route('operator.stations') }}"
           class="menu-item {{ request()->routeIs('operator.stations') ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i>
            <span>Charging Station</span>
        </a>

        <a href="{{ route('operator.chargers') }}"
           class="menu-item {{ request()->routeIs('operator.chargers') ? 'active' : '' }}">
            <i class="bi bi-lightning-charge"></i>
            <span>Charger</span>
        </a>

        <a href="{{ route('operator.sessions') }}"
           class="menu-item {{ request()->routeIs('operator.sessions') ? 'active' : '' }}">
            <i class="bi bi-clock"></i>
            <span>Monitoring Charging</span>
        </a>

        <a href="{{ route('operator.history') }}"
           class="menu-item {{ request()->routeIs('operator.history') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i>
            <span>Sesi Charging</span>
        </a>


        {{-- LAPORAN --}}
        <div class="menu-title">
            Laporan
        </div>

        <a href="{{ route('operator.report') }}"
           class="menu-item {{ request()->routeIs('operator.report') ? 'active' : '' }}">
            <i class="bi bi-graph-up"></i>
            <span>Laporan</span>
        </a>


        {{-- AKUN --}}
        <div class="menu-title">
            Akun
        </div>

        <a href="{{ route('operator.profile') }}"
           class="menu-item {{ request()->routeIs('operator.profile') ? 'active' : '' }}">
            <i class="bi bi-person"></i>
            <span>Profil</span>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf

            <button type="submit" class="menu-item logout-button">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>

    </aside>


    {{-- KONTEN UTAMA --}}
    <main class="main-content">

        {{-- TOPBAR --}}
        <header class="topbar">

            <div class="topbar-title">
                <h3>@yield('page-title', 'Dashboard Operator')</h3>

                <p>
                    Kelola aktivitas charging station
                </p>
            </div>


            {{-- INFO OPERATOR --}}
            @auth
                <div class="operator-info">

                    <div class="operator-avatar">
                        {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                    </div>

                    <div>
                        <div class="operator-name">
                            {{ auth()->user()->nama }}
                        </div>

                        <div class="operator-role">
                            Operator
                        </div>
                    </div>

                </div>
            @endauth

        </header>


        {{-- ISI HALAMAN --}}
        <section class="content">

            @yield('content')

        </section>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>