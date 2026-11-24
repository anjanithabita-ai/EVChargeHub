
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penggunaan Charger - EVChargeHub</title>

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

        /* =========================
           LAYOUT
        ========================= */
        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR - SAMA DENGAN DASHBOARD
        ========================= */
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
            flex-shrink: 0;
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
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.10);
            color: white;
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

        .sidebar form {
            margin: 0;
        }

        .sidebar button.menu-item {
            width: calc(100% - 24px);
            border: none;
            background: transparent;
            cursor: pointer;
            text-align: left;
            font-family: inherit;
        }

        .sidebar button.menu-item:hover {
            background: rgba(255,255,255,0.10);
        }

        /* =========================
           MAIN DAN TOPBAR
        ========================= */
        .main {
            margin-left: 285px;
            width: calc(100% - 285px);
            min-height: 100vh;
        }

        .topbar {
            min-height: 84px;
            background: white;
            border-bottom: 1px solid #e5e9e8;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 15px 32px;
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
            flex-shrink: 0;
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

        /* =========================
           CONTENT
        ========================= */
        .content {
            padding: 30px 32px 50px;
        }

        .report-heading {
            margin-bottom: 25px;
        }

        .report-heading h2 {
            color: #263b36;
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .report-heading p {
            color: #82908c;
            font-size: 13px;
            line-height: 1.6;
        }

        /* =========================
           STATISTIK LAPORAN
        ========================= */
        .report-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .report-stat-card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            border: 1px solid #e5e9e8;
            box-shadow: 0 3px 12px rgba(0,0,0,0.04);
            min-width: 0;
        }

        .report-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 15px;
        }

        .report-stat-label {
            color: #7a8884;
            font-size: 13px;
        }

        .report-stat-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 10px;
            background: #e8f5f1;
            color: #006b59;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .report-stat-number {
            color: #263b36;
            font-size: clamp(20px, 2vw, 28px);
            line-height: 1.3;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .report-stat-number small {
            font-size: 14px;
            font-weight: 600;
        }

        /* =========================
           TABEL LAPORAN
        ========================= */
        .report-card {
            background: white;
            border-radius: 14px;
            border: 1px solid #e5e9e8;
            box-shadow: 0 3px 12px rgba(0,0,0,0.04);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .report-card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #edf0ef;
        }

        .report-card-header h3 {
            font-size: 16px;
            color: #263b36;
            margin-bottom: 5px;
        }

        .report-card-header p {
            font-size: 12px;
            color: #82908c;
        }

        .report-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .report-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .report-table th {
            text-align: left;
            font-size: 11px;
            color: #7a8884;
            padding: 13px 20px;
            background: #fafbfb;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        .report-table td {
            padding: 15px 20px;
            border-top: 1px solid #edf0ef;
            font-size: 13px;
            color: #42514d;
            vertical-align: middle;
        }

        .report-table tbody tr:hover {
            background: #f8fbfa;
        }

        .report-table td strong {
            color: #263b36;
        }

        .report-charger-code {
            font-weight: bold;
            color: #263b36;
            white-space: nowrap;
        }

        /* =========================
           STATUS CHARGER
        ========================= */
        .report-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .report-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .report-status-tersedia {
            color: #16865d;
            background: #e8f7ef;
        }

        .report-status-digunakan {
            color: #d17b00;
            background: #fff4df;
        }

        .report-status-offline {
            color: #66727a;
            background: #eef1f2;
        }

        .report-status-rusak {
            color: #c43e3e;
            background: #fdecec;
        }

        .report-status-default {
            color: #006b59;
            background: #e8f5f1;
        }

        .report-empty {
            text-align: center;
            padding: 40px 20px !important;
            color: #82908c !important;
        }

        .report-card-footer {
            padding: 16px 20px;
            border-top: 1px solid #edf0ef;
        }

        .report-card-footer nav p {
            margin-bottom: 0;
        }

        .report-card-footer nav {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* =========================
           TOMBOL RIWAYAT
        ========================= */
        .report-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 5px;
        }

        .report-history-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 17px;
            border: 1px solid #006b59;
            border-radius: 9px;
            color: #006b59;
            background: white;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            transition: .2s ease;
        }

        .report-history-btn:hover {
            color: white;
            background: #006b59;
        }

        /* =========================
           RESPONSIVE
        ========================= */
        @media (max-width: 1100px) {
            .report-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 750px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .topbar {
                padding: 15px 20px;
                align-items: flex-start;
            }

            .topbar-title h1 {
                font-size: 18px;
            }

            .profile {
                gap: 8px;
            }

            .user-info {
                display: none;
            }

            .content {
                padding: 20px;
            }
        }

        @media (max-width: 600px) {
            .report-heading h2 {
                font-size: 21px;
            }

            .report-stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .report-stat-card {
                padding: 17px;
            }

            .report-card-header {
                padding: 17px;
            }

            .report-actions {
                justify-content: stretch;
            }

            .report-history-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
<div class="layout">

    <!-- SIDEBAR: SAMA DENGAN DASHBOARD.BLADE.PHP -->
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

        <a href="{{ route('operator.stations') }}" class="menu-item">
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
                    <path d="M12 8v4l3 2"
                        stroke-width="2" stroke-linecap="round"/>
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

        <a href="{{ route('operator.history') }}"
           class="menu-item {{ request()->routeIs('operator.history') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="8" stroke-width="2"/>
                    <path d="M12 7v5l3 2"
                        stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            <span>Riwayat Charging</span>
        </a>

        <a href="{{ route('operator.charger-reports.index') }}" class="menu-item">
            <span class="menu-icon">🔧</span>
            <span class="menu-label">Laporan Kerusakan</span>
        </a>

        <div class="menu-title">LAPORAN</div>

        <a href="{{ route('operator.report') }}"
           class="menu-item {{ request()->routeIs('operator.report') ? 'active' : '' }}">
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
            Profil
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-item">
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
                Logout
            </button>
        </form>

    </aside>

    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <div class="topbar-title">
                <h1>Laporan Penggunaan Charger</h1>
                <p>Ringkasan penggunaan charging station</p>
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

        <!-- CONTENT LAPORAN -->
        <section class="content">

            <div class="report-heading">
                <h2>Laporan Penggunaan Charger</h2>
                <p>
                    Ringkasan penggunaan charger berdasarkan data sesi charging
                    yang tersimpan di database.
                </p>
            </div>

            <!-- KARTU RINGKASAN -->
            <div class="report-stats">

                <div class="report-stat-card">
                    <div class="report-stat-top">
                        <span class="report-stat-label">Total Sesi</span>
                        <div class="report-stat-icon">▤</div>
                    </div>
                    <div class="report-stat-number">
                        {{ number_format($totalSesi ?? 0) }}
                    </div>
                </div>

                <div class="report-stat-card">
                    <div class="report-stat-top">
                        <span class="report-stat-label">Sesi Selesai</span>
                        <div class="report-stat-icon">✓</div>
                    </div>
                    <div class="report-stat-number">
                        {{ number_format($totalSesiSelesai ?? 0) }}
                    </div>
                </div>

                <div class="report-stat-card">
                    <div class="report-stat-top">
                        <span class="report-stat-label">Total Energi</span>
                        <div class="report-stat-icon">⚡</div>
                    </div>
                    <div class="report-stat-number">
                        {{ number_format($totalEnergi ?? 0, 2, ',', '.') }}
                        <small>kWh</small>
                    </div>
                </div>

                <div class="report-stat-card">
                    <div class="report-stat-top">
                        <span class="report-stat-label">Total Biaya Tercatat</span>
                        <div class="report-stat-icon">Rp</div>
                    </div>
                    <div class="report-stat-number">
                        Rp {{ number_format($totalBiaya ?? 0, 0, ',', '.') }}
                    </div>
                </div>

            </div>

            <!-- TABEL PENGGUNAAN CHARGER -->
            <div class="report-card">

                <div class="report-card-header">
                    <h3>Penggunaan per Charger</h3>
                    <p>Ringkasan sesi, energi, dan biaya setiap charger.</p>
                </div>

                <div class="report-table-wrapper">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Kode Charger</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Total Sesi</th>
                                <th>Sesi Selesai</th>
                                <th>Total Energi</th>
                                <th>Total Biaya</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse(($summary ?? []) as $charger)
                                @php
                                    $status = strtolower($charger->status ?? '');

                                    $statusClass = match ($status) {
                                        'tersedia' => 'report-status-tersedia',
                                        'digunakan' => 'report-status-digunakan',
                                        'offline' => 'report-status-offline',
                                        'rusak' => 'report-status-rusak',
                                        default => 'report-status-default',
                                    };
                                @endphp

                                <tr>
                                    <td>
                                        <span class="report-charger-code">
                                            {{ $charger->kode_perangkat ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $charger->location->nama_lokasi ?? '-' }}
                                    </td>

                                    <td>
                                        <span class="report-status {{ $statusClass }}">
                                            <span class="report-status-dot"></span>
                                            {{ ucfirst($charger->status ?? 'Tidak diketahui') }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ number_format($charger->charging_sessions_count ?? 0) }}
                                    </td>

                                    <td>
                                        {{ number_format($charger->sesi_selesai ?? 0) }}
                                    </td>

                                    <td>
                                        {{ number_format((float) ($charger->total_energi_kwh ?? 0), 2, ',', '.') }}
                                        kWh
                                    </td>

                                    <td>
                                        Rp {{ number_format((float) ($charger->total_biaya ?? 0), 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="report-empty">
                                        Belum ada data charger yang dapat ditampilkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(isset($summary) && is_callable([$summary, 'links']))
                    <div class="report-card-footer">
                        {{ $summary->links() }}
                    </div>
                @endif

            </div>

            <!-- TOMBOL RIWAYAT -->
            <div class="report-actions">
                <a href="{{ route('operator.history') }}" class="report-history-btn">
                    <span>◷</span>
                    Buka Riwayat Sesi
                </a>
            </div>

        </section>
    </main>
</div>
</body>
</html>
