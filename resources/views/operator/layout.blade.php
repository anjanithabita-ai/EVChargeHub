<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Operator') - EVChargeHub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7f7;
            color: #183b3b;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 252px;
            min-height: 100vh;
            background: linear-gradient(180deg, #006b59 0%, #005747 55%, #00453b 100%);
            color: #fff;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,.35) transparent;
        }

        .sidebar-header {
            min-height: 110px;
            display: flex;
            align-items: center;
            padding: 22px;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .logo-circle {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 50%;
            background: #fff;
            color: #006b59;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 17px;
            font-weight: 700;
        }

        .logo-text h4 {
            margin: 0 0 4px;
            font-size: 18px;
            font-weight: 700;
            white-space: nowrap;
        }

        .logo-text small {
            color: rgba(255,255,255,.8);
            font-size: 12px;
        }

        .menu-title {
            padding: 25px 22px 10px;
            color: rgba(255,255,255,.62);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 48px;
            margin: 4px 9px;
            padding: 10px 15px;
            border: 0;
            border-radius: 9px;
            background: transparent;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            line-height: 1.4;
            transition: background .2s ease;
            cursor: pointer;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.10);
            color: #fff;
        }

        .menu-item.active {
            background: rgba(255,255,255,.16);
            color: #fff;
            font-weight: 700;
        }

        .menu-item i {
            width: 25px;
            min-width: 25px;
            font-size: 20px;
            text-align: center;
        }

        .menu-icon {
            width: 25px;
            min-width: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-icon svg {
            width: 21px;
            height: 21px;
            stroke: currentColor;
        }

        .logout-form {
            margin: 4px 0 18px;
        }

        .logout-button {
            width: calc(100% - 18px);
            text-align: left;
            font-family: inherit;
        }

        /* KONTEN UTAMA */
        .main-content {
            min-height: 100vh;
            margin-left: 252px;
        }

        /* HEADER ATAS */
        .topbar {
            min-height: 85px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 15px 30px;
            background: #fff;
            border-bottom: 1px solid #e5eaea;
        }

        .topbar-title h3 {
            margin: 0;
            color: #183b3b;
            font-size: 24px;
            font-weight: 700;
        }

        .topbar-title p {
            margin: 4px 0 0;
            color: #788787;
            font-size: 14px;
        }

        .operator-info {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .operator-avatar {
            width: 45px;
            height: 45px;
            min-width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #008577;
            color: #fff;
            font-size: 17px;
            font-weight: 700;
        }

        .operator-name {
            color: #183b3b;
            font-size: 14px;
            font-weight: 700;
        }

        .operator-role {
            margin-top: 2px;
            color: #788787;
            font-size: 12px;
        }

        /* AREA HALAMAN */
        .content {
            padding: 30px;
            min-width: 0;
        }

        .content .container-fluid {
            padding-right: 0;
            padding-left: 0;
        }

        .content h2 {
            color: #183b3b;
        }

        .content .card {
            border-radius: 10px;
        }

        .content .table-responsive {
            width: 100%;
        }

        .content .table {
            margin-bottom: 0;
            white-space: nowrap;
        }

        .content .table thead th {
            color: #183b3b;
            font-size: 13px;
            font-weight: 700;
            background: #f3f6f6;
        }

        .content .table tbody td {
            font-size: 13px;
            vertical-align: middle;
        }

        .content .btn-outline-success {
            color: #00796b;
            border-color: #00796b;
        }

        .content .btn-outline-success:hover {
            background: #00796b;
            color: #fff;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 225px;
            }

            .main-content {
                margin-left: 225px;
            }

            .topbar {
                padding: 15px 20px;
            }

            .content {
                padding: 22px 20px;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 76px;
            }

            .sidebar-header {
                min-height: 85px;
                justify-content: center;
                padding: 12px 5px;
            }

            .logo-circle {
                width: 42px;
                height: 42px;
                min-width: 42px;
                margin: 0;
            }

            .logo-text,
            .menu-title,
            .menu-item span:not(.menu-icon) {
                display: none;
            }

            .menu-item {
                justify-content: center;
                gap: 0;
                margin: 5px 7px;
                padding: 12px 5px;
            }

            .menu-item i,
            .menu-icon {
                width: 25px;
                min-width: 25px;
            }

            .logout-button {
                width: calc(100% - 14px);
            }

            .main-content {
                margin-left: 76px;
            }

            .topbar {
                align-items: flex-start;
                padding: 15px;
            }

            .topbar-title h3 {
                font-size: 18px;
            }

            .topbar-title p {
                font-size: 12px;
            }

            .operator-info {
                gap: 7px;
            }

            .operator-avatar {
                width: 35px;
                height: 35px;
                min-width: 35px;
                font-size: 14px;
            }

            .operator-name {
                max-width: 90px;
                overflow-wrap: anywhere;
                font-size: 11px;
            }

            .operator-role {
                font-size: 10px;
            }

            .content {
                padding: 15px 12px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="sidebar-header">
            <div class="logo-circle">EV</div>
            <div class="logo-text">
                <h4>EVChargeHub</h4>
                <small>Operator Dashboard</small>
            </div>
        </div>

        {{-- MENU UTAMA --}}
        <div class="menu-title">Menu Utama</div>

        <a href="{{ route('operator.dashboard') }}"
           class="menu-item {{ request()->routeIs('operator.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>Dashboard</span>
        </a>

        {{-- OPERASIONAL --}}
        <div class="menu-title">Operasional</div>

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
            <i class="bi bi-clock-history"></i>
            <span>Monitoring Charging</span>
        </a>

        <a href="{{ route('operator.sessions') }}"
           class="menu-item {{ request()->routeIs('operator.sessions') && !request()->routeIs('operator.history') ? 'active' : '' }}">
            <i class="bi bi-ev-front"></i>
            <span>Sesi Charging</span>
        </a>

        <a href="{{ route('operator.history') }}"
           class="menu-item {{ request()->routeIs('operator.history') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i>
            <span>Riwayat Charging</span>
        </a>

        {{-- LAPORAN --}}
        <a href="{{ route('operator.report') }}"
        class="menu-item {{ request()->routeIs('operator.report') ? 'active' : '' }}">

            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M4 19V5M4 19h17"
                        stroke-width="2"
                        stroke-linecap="round"/>

                    <path d="M7 15l4-4 3 2 5-6"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"/>
                </svg>
            </span>

            <span class="menu-label">Laporan</span>
        </a>

        {{-- AKUN --}}
        <div class="menu-title">Akun</div>

        <a href="{{ route('operator.profile') }}"
           class="menu-item {{ request()->routeIs('operator.profile') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i>
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

        {{-- HEADER ATAS --}}
        <header class="topbar">
            <div class="topbar-title">
                <h3>@yield('page-title', 'Dashboard Operator')</h3>
                <p>@yield('page-description', 'Kelola aktivitas charging station')</p>
            </div>

            @auth
                @php
                    $operatorName = auth()->user()->nama
                        ?? auth()->user()->username
                        ?? 'Operator';
                @endphp

                <div class="operator-info">
                    <div class="operator-avatar">
                        {{ strtoupper(substr($operatorName, 0, 1)) }}
                    </div>

                    <div>
                        <div class="operator-name">{{ $operatorName }}</div>
                        <div class="operator-role">Operator</div>
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