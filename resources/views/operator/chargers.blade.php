<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Charger - EVChargeHub</title>

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

        /* LAYOUT */
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
        }

        .sidebar-header {
            height: 110px;
            display: flex;
            align-items: center;
            padding: 25px 22px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .logo-circle {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: #006b59;
            font-weight: bold;
            font-size: 18px;
            flex-shrink: 0;
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
            font-family: Arial, Helvetica, sans-serif;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.10);
        }

        .menu-item.active {
            background: rgba(255,255,255,0.16);
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
            padding: 15px 32px;
            gap: 20px;
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
            flex-shrink: 0;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
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

        /* STATISTICS */
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
            margin-bottom: 15px;
            gap: 10px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #e8f5f1;
            color: #006b59;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .stat-label {
            color: #7a8884;
            font-size: 13px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            color: #263b36;
        }

        /* CARD */
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
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .card-header h3 {
            font-size: 16px;
            color: #263b36;
            margin-bottom: 5px;
        }

        .card-header p {
            font-size: 12px;
            color: #82908c;
        }

        .total-label {
            font-size: 12px;
            color: #82908c;
            white-space: nowrap;
        }

        /* TABLE */
        .table-wrapper {
            overflow-x: auto;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            color: #7a8884;
            padding: 13px 20px;
            background: #fafbfb;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        td {
            padding: 15px 20px;
            border-top: 1px solid #edf0ef;
            font-size: 13px;
            color: #42514d;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f8fbfa;
        }

        td strong {
            color: #263b36;
        }

        .charger-code {
            color: #006b59;
            font-weight: bold;
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

        .status-tersedia {
            color: #16865d;
            background: #e8f7ef;
        }

        .status-digunakan {
            color: #d17b00;
            background: #fff4df;
        }

        .status-offline {
            color: #66727a;
            background: #eef1f2;
        }

        .status-rusak {
            color: #c43e3e;
            background: #fdecec;
        }

        .status-unknown {
            color: #8a6d1d;
            background: #fff4d6;
        }

        /* EMPTY STATE */
        .empty {
            text-align: center;
            padding: 40px 20px;
            color: #82908c;
            font-size: 13px;
        }

        /* PAGINATION */
        .pagination {
            padding: 20px;
            border-top: 1px solid #edf0ef;
            font-size: 13px;
        }

        .pagination nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination a,
        .pagination span {
            color: #006b59;
        }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 750px) {
            .sidebar {
                width: 220px;
            }

            .sidebar-header {
                padding: 20px 15px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .topbar {
                padding: 15px 20px;
                align-items: flex-start;
            }

            .content {
                padding: 20px;
            }
        }

        @media (max-width: 560px) {
            .sidebar {
                width: 70px;
            }

            .sidebar-header {
                justify-content: center;
                padding: 20px 5px;
            }

            .logo-text,
            .menu-title,
            .menu-item .menu-label {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 10px 5px;
                margin: 5px;
            }

            .menu-icon {
                min-width: 25px;
            }

            .main {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .topbar {
                flex-direction: column;
                gap: 12px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 15px;
            }

            .welcome {
                padding: 20px;
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

    <!-- SIDEBAR -->
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
            <span class="menu-label">Dashboard</span>
        </a>

        <div class="menu-title">OPERASIONAL</div>

        <a href="{{ route('operator.stations') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 21s7-6.1 7-12A7 7 0 0 0 5 9c0 5.9 7 12 7 12z"
                        stroke-width="2"/>
                    <circle cx="12" cy="9" r="2.5" stroke-width="2"/>
                </svg>
            </span>
            <span class="menu-label">Charging Station</span>
        </a>

        <a href="{{ route('operator.chargers') }}" class="menu-item active">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M13 2L4 14h6l-1 8 9-12h-6l1-8z"
                        stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </span>
            <span class="menu-label">Charger</span>
        </a>

        <a href="{{ route('operator.charger-status') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="8" stroke-width="2"/>
                    <path d="M12 8v4l3 2" stroke-width="2"
                        stroke-linecap="round"/>
                </svg>
            </span>
            <span class="menu-label">Monitoring Charging</span>
        </a>

        <a href="{{ route('operator.sessions') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M6 3h12v18H6z" stroke-width="2"/>
                    <path d="M9 7h6M9 11h6M9 15h4"
                        stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            <span class="menu-label">Sesi Charging</span>
        </a>

        <a href="#" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="8" stroke-width="2"/>
                    <path d="M12 7v5l3 2" stroke-width="2"
                        stroke-linecap="round"/>
                </svg>
            </span>
            <span class="menu-label">Riwayat Charging</span>
        </a>

        <div class="menu-title">LAPORAN</div>

        <a href="#" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M4 19V5M4 19h17"
                        stroke-width="2" stroke-linecap="round"/>
                    <path d="M7 15l4-4 3 2 5-6"
                        stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"/>
                </svg>
            </span>
            <span class="menu-label">Laporan</span>
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
            <span class="menu-label">Profil</span>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-item"
                style="border:none;background:none;width:calc(100% - 24px);cursor:pointer;text-align:left;">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M10 17l5-5-5-5"
                            stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path d="M15 12H3"
                            stroke-width="2" stroke-linecap="round"/>
                        <path d="M21 3v18"
                            stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="menu-label">Logout</span>
            </button>
        </form>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="topbar-title">
                <h1>Data Charger</h1>
                <p>Informasi perangkat charger EVChargeHub</p>
            </div>

            <div class="profile">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->nama ?? 'O', 0, 1)) }}
                </div>

                <div class="user-info">
                    <strong>{{ auth()->user()->nama ?? 'Operator' }}</strong>
                    <span>Operator</span>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <section class="content">

            <div class="welcome">
                <h2>Data Perangkat Charger</h2>
                <p>
                    Lihat informasi charger yang terdaftar pada setiap
                    charging station di EVChargeHub.
                </p>
            </div>

            <!-- STATISTICS -->
            <div class="stats-grid">

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Total Charger</span>
                        <div class="stat-icon">⚡</div>
                    </div>
                    <div class="stat-number">{{ $chargers->total() }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Charger Tersedia</span>
                        <div class="stat-icon">✓</div>
                    </div>
                    <div class="stat-number">
                        {{ \App\Models\Charger::where('status', 'tersedia')->count() }}
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Charger Digunakan</span>
                        <div class="stat-icon">🔋</div>
                    </div>
                    <div class="stat-number">
                        {{ \App\Models\Charger::where('status', 'digunakan')->count() }}
                    </div>
                </div>

            </div>

            <!-- CHARGER TABLE -->
            <div class="card">

                <div class="card-header">
                    <div>
                        <h3>Daftar Data Charger</h3>
                        <p>Informasi kode perangkat, station, konektor, daya, dan status.</p>
                    </div>

                    <span class="total-label">
                        Total: {{ $chargers->total() }} charger
                    </span>
                </div>

                @if($chargers->count())

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Charger</th>
                                    <th>Charging Station</th>
                                    <th>Tipe Konektor</th>
                                    <th>Daya (kW)</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($chargers as $charger)
                                    @php
                                        $status = strtolower($charger->status ?? '');
                                    @endphp

                                    <tr>
                                        <td>
                                            {{ $chargers->firstItem() + $loop->index }}
                                        </td>

                                        <td>
                                            <strong class="charger-code">
                                                {{ $charger->kode_perangkat }}
                                            </strong>
                                        </td>

                                        <td>
                                            {{ $charger->location->nama_lokasi ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $charger->tipe_konektor ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $charger->daya_kw !== null
                                                ? $charger->daya_kw . ' kW'
                                                : '-' }}
                                        </td>

                                        <td>
                                            @if($status === 'tersedia')
                                                <span class="status status-tersedia">
                                                    <span class="status-dot"></span>
                                                    Tersedia
                                                </span>
                                            @elseif($status === 'digunakan')
                                                <span class="status status-digunakan">
                                                    <span class="status-dot"></span>
                                                    Digunakan
                                                </span>
                                            @elseif($status === 'offline')
                                                <span class="status status-offline">
                                                    <span class="status-dot"></span>
                                                    Offline
                                                </span>
                                            @elseif($status === 'rusak')
                                                <span class="status status-rusak">
                                                    <span class="status-dot"></span>
                                                    Rusak
                                                </span>
                                            @else
                                                <span class="status status-unknown">
                                                    <span class="status-dot"></span>
                                                    {{ ucfirst($charger->status ?? 'Belum diketahui') }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        {{ $chargers->links() }}
                    </div>

                @else
                    <div class="empty">
                        Belum ada data charger yang terdaftar.
                    </div>
                @endif

            </div>
        </section>
    </main>
</div>
</body>
</html>

