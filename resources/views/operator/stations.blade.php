<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Charging Station - EVChargeHub</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7f7;
            color: #263238;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 285px;
            min-height: 100vh;
            background: linear-gradient(
                180deg,
                #006b59 0%,
                #005747 55%,
                #00453b 100%
            );
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 10;
        }

        .sidebar-header {
            min-height: 110px;
            display: flex;
            align-items: center;
            padding: 25px 22px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .logo-circle {
            width: 54px;
            height: 54px;
            min-width: 54px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: #006b59;
            font-weight: bold;
            font-size: 18px;
        }

        .logo-text h2 {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .logo-text p {
            font-size: 11px;
            opacity: 0.85;
        }

        .menu-title {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            padding: 25px 24px 10px;
            color: rgba(255,255,255,0.6);
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 22px;
            margin: 4px 12px;
            border-radius: 9px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
            cursor: pointer;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.10);
        }

        .menu-item.active {
            background: rgba(255,255,255,0.18);
            font-weight: bold;
        }

        .menu-icon {
            width: 30px;
            min-width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-icon svg {
            width: 21px;
            height: 21px;
            stroke: white;
        }

        /* MAIN */
        .main {
            margin-left: 285px;
            width: calc(100% - 285px);
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            min-height: 84px;
            background: white;
            border-bottom: 1px solid #e5e9e8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 32px;
        }

        .topbar-title h1 {
            font-size: 22px;
            color: #263b36;
            margin-bottom: 4px;
        }

        .topbar-title p {
            font-size: 13px;
            color: #82908c;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 50%;
            background: #006b59;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .user-info strong {
            display: block;
            font-size: 14px;
            color: #263b36;
        }

        .user-info span {
            font-size: 12px;
            color: #82908c;
        }

        /* CONTENT */
        .content {
            padding: 30px 32px 50px;
        }

        .welcome {
            background: linear-gradient(135deg, #006b59, #00856f);
            border-radius: 16px;
            padding: 25px 28px;
            color: white;
            margin-bottom: 25px;
        }

        .welcome h2 {
            font-size: 21px;
            margin-bottom: 7px;
        }

        .welcome p {
            font-size: 13px;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* STAT CARD */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            border: 1px solid #e5e9e8;
            box-shadow: 0 3px 12px rgba(0,0,0,0.04);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 15px;
        }

        .stat-label {
            color: #7a8884;
            font-size: 13px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 10px;
            background: #e8f5f1;
            color: #006b59;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            color: #263b36;
        }

        /* CARD AND TABLE */
        .card {
            background: white;
            border-radius: 14px;
            border: 1px solid #e5e9e8;
            box-shadow: 0 3px 12px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #edf0ef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .card-header h3 {
            font-size: 16px;
            color: #263b36;
        }

        .card-header span {
            font-size: 12px;
            color: #82908c;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            color: #7a8884;
            padding: 15px 18px;
            background: #fafbfb;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        td {
            padding: 16px 18px;
            border-top: 1px solid #edf0ef;
            font-size: 13px;
            color: #42514d;
            vertical-align: middle;
        }

        td strong {
            color: #263b36;
        }

        tbody tr:hover {
            background: #f8fbfa;
        }

        .station-name {
            min-width: 150px;
        }

        .address {
            min-width: 190px;
            max-width: 280px;
            line-height: 1.6;
        }

        /* STATUS */
        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-aktif {
            color: #16865d;
            background: #e8f7ef;
        }

        .status-nonaktif {
            color: #66727a;
            background: #eef1f2;
        }

        .status-lain {
            color: #9a6700;
            background: #fff4df;
        }

        .charger-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            padding: 7px 10px;
            border-radius: 8px;
            background: #e8f5f1;
            color: #006b59;
            font-weight: bold;
        }

        /* PAGINATION */
        .pagination-wrapper {
            padding: 20px 22px;
            border-top: 1px solid #edf0ef;
        }

        .pagination-wrapper nav p {
            font-size: 12px;
            color: #82908c;
        }

        .pagination-wrapper nav div {
            flex-wrap: wrap;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            font-size: 13px;
        }

        /* EMPTY */
        .empty {
            text-align: center;
            padding: 45px 20px;
            color: #82908c;
            font-size: 13px;
            line-height: 1.7;
        }

        .empty-icon {
            font-size: 30px;
            margin-bottom: 12px;
        }

        /* LOGOUT */
        .logout-button {
            width: calc(100% - 24px);
            border: none;
            background: transparent;
            text-align: left;
            font-family: inherit;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .content {
                padding: 25px 22px 40px;
            }
        }

        @media (max-width: 850px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .topbar {
                padding: 18px 20px;
            }

            .topbar-title h1 {
                font-size: 19px;
            }

            .profile {
                gap: 8px;
            }

            .content {
                padding: 22px 18px 35px;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 72px;
            }

            .sidebar-header {
                justify-content: center;
                padding: 15px 5px;
            }

            .logo-circle {
                margin: 0;
                width: 44px;
                height: 44px;
                min-width: 44px;
            }

            .logo-text,
            .menu-title,
            .menu-item:not(.active),
            .sidebar .menu-item {
                font-size: 0;
            }

            .sidebar .menu-item {
                justify-content: center;
                padding: 10px 5px;
                margin: 7px 8px;
            }

            .sidebar .menu-icon {
                min-width: 30px;
            }

            .main {
                margin-left: 72px;
                width: calc(100% - 72px);
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .welcome {
                padding: 22px;
            }

            .card-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="sidebar-header">
            <div class="logo-circle">EV</div>

            <div class="logo-text">
                <h2>EVChargeHub</h2>
                <p>Charge Today, Greener Tomorrow</p>
            </div>
        </div>

        <div class="menu-title">MENU UTAMA</div>

        <a href="{{ route('operator.dashboard') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M3 10.5L12 3l9 7.5"
                        stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"/>
                    <path d="M5 9.5V21h14V9.5"
                        stroke-width="2" stroke-linejoin="round"/>
                    <path d="M9 21v-7h6v7" stroke-width="2"/>
                </svg>
            </span>
            Dashboard
        </a>

        <div class="menu-title">OPERASIONAL</div>

        <a href="{{ route('operator.stations') }}"
           class="menu-item active" aria-current="page">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 21s7-6.1 7-12A7 7 0 0 0 5 9c0 5.9 7 12 7 12z"
                        stroke-width="2"/>
                    <circle cx="12" cy="9" r="2.5" stroke-width="2"/>
                </svg>
            </span>
            Charging Station
        </a>

        <a href="{{ route('operator.chargers') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M13 2L4 14h6l-1 8 9-12h-6l1-8z"
                        stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </span>
            Charger
        </a>

        <a href="{{ route('operator.charger-status') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="8" stroke-width="2"/>
                    <path d="M12 8v4l3 2" stroke-width="2"
                        stroke-linecap="round"/>
                </svg>
            </span>
            Monitoring Charging
        </a>

        <a href="{{ route('operator.sessions') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M6 3h12v18H6z" stroke-width="2"/>
                    <path d="M9 7h6M9 11h6M9 15h4"
                        stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            Sesi Charging
        </a>

        <a href="{{ route('operator.history') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="8" stroke-width="2"/>
                    <path d="M12 7v5l3 2" stroke-width="2"
                        stroke-linecap="round"/>
                </svg>
            </span>
            Riwayat Charging
        </a>

        <div class="menu-title">LAPORAN</div>

        <a href="{{ route('operator.report') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M4 19V5M4 19h17"
                        stroke-width="2" stroke-linecap="round"/>
                    <path d="M7 15l4-4 3 2 5-6"
                        stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"/>
                </svg>
            </span>
            Laporan
        </a>

        <div class="menu-title">AKUN</div>

        <a href="{{ route('operator.profile') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="8" r="4" stroke-width="2"/>
                    <path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"
                        stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            Profil
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-item logout-button">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M10 17l5-5-5-5"
                            stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path d="M15 12H3" stroke-width="2"
                            stroke-linecap="round"/>
                        <path d="M21 3v18" stroke-width="2"
                            stroke-linecap="round"/>
                    </svg>
                </span>
                Logout
            </button>
        </form>

    </aside>

    {{-- MAIN --}}
    <main class="main">

        {{-- TOPBAR --}}
        <header class="topbar">
            <div class="topbar-title">
                <h1>Charging Station</h1>
                <p>Kelola dan pantau informasi charging station</p>
            </div>

            <div class="profile">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->nama ?? 'O', 0, 1)) }}
                </div>

                <div class="user-info">
                    <strong>{{ auth()->user()->nama }}</strong>
                    <span>Operator</span>
                </div>
            </div>
        </header>

        {{-- CONTENT --}}
        <section class="content">

            <div class="welcome">
                <h2>Data Charging Station</h2>
                <p>
                    Berikut daftar lokasi charging station yang terdaftar
                    dalam sistem EVChargeHub beserta status dan jumlah chargernya.
                </p>
            </div>

            {{-- STATISTIK --}}
            <div class="stats-grid">

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Total Station</span>
                        <div class="stat-icon">📍</div>
                    </div>
                    <div class="stat-number">{{ $stations->total() }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Station Aktif</span>
                        <div class="stat-icon">✓</div>
                    </div>
                    <div class="stat-number">
                        {{ $stations->getCollection()->where('status', 'aktif')->count() }}
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Charger di Halaman Ini</span>
                        <div class="stat-icon">⚡</div>
                    </div>
                    <div class="stat-number">
                        {{ $stations->getCollection()->sum(fn ($station) => $station->chargers->count()) }}
                    </div>
                </div>

            </div>

            {{-- TABEL STATION --}}
            <div class="card">

                <div class="card-header">
                    <h3>Daftar Charging Station</h3>
                    <span>{{ $stations->total() }} station terdaftar</span>
                </div>

                @if($stations->count())

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Station</th>
                                    <th>Alamat</th>
                                    <th>Jam Buka</th>
                                    <th>Jam Tutup</th>
                                    <th>Status</th>
                                    <th>Jumlah Charger</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($stations as $station)
                                    @php
                                        $status = strtolower($station->status ?? '');
                                    @endphp

                                    <tr>
                                        <td>
                                            {{ $stations->firstItem() + $loop->index }}
                                        </td>

                                        <td class="station-name">
                                            <strong>{{ $station->nama_lokasi }}</strong>
                                        </td>

                                        <td class="address">
                                            {{ $station->alamat ?: '-' }}
                                        </td>

                                        <td>
                                            {{ $station->jam_buka ?: '-' }}
                                        </td>

                                        <td>
                                            {{ $station->jam_tutup ?: '-' }}
                                        </td>

                                        <td>
                                            @if($status === 'aktif')
                                                <span class="status status-aktif">
                                                    <span class="status-dot"></span>
                                                    Aktif
                                                </span>
                                            @elseif($status === 'nonaktif')
                                                <span class="status status-nonaktif">
                                                    <span class="status-dot"></span>
                                                    Nonaktif
                                                </span>
                                            @else
                                                <span class="status status-lain">
                                                    <span class="status-dot"></span>
                                                    {{ $station->status ?: 'Belum diketahui' }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="charger-count">
                                                {{ $station->chargers->count() }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-wrapper">
                        {{ $stations->links() }}
                    </div>

                @else

                    <div class="empty">
                        <div class="empty-icon">📍</div>
                        <strong>Belum ada charging station</strong>
                        <p>Data charging station belum tersedia di dalam sistem.</p>
                    </div>

                @endif

            </div>

        </section>
    </main>
</div>
</body>
</html>
