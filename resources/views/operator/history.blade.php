
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Charging - EVChargeHub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7f7;
            color: #263238;
        }

        /* SIDEBAR */
        .sidebar {
            width: 285px;
            height: 100vh;
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
            overflow-x: hidden;
            z-index: 1000;
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
            margin: 0 0 4px;
            font-weight: bold;
            color: white;
        }

        .logo-text p {
            font-size: 11px;
            margin: 0;
            opacity: 0.85;
            color: white;
        }

        .menu-title {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            padding: 25px 24px 10px;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 13px;
            width: auto;
            padding: 13px 22px;
            margin: 4px 12px;
            border: none;
            border-radius: 9px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: left;
            background: transparent;
            transition: background 0.2s;
            cursor: pointer;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.10);
            color: white;
        }

        .menu-item.active {
            background: rgba(255,255,255,0.16);
            color: white;
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
            fill: none;
        }

        .menu-icon svg path,
        .menu-icon svg circle,
        .menu-icon svg rect {
            vector-effect: non-scaling-stroke;
        }

        .menu-label {
            flex: 1;
        }

        .logout-form {
            margin: 0;
            padding: 0;
        }

        .logout-button {
            width: calc(100% - 24px);
        }

        /* AREA UTAMA */
        .main {
            margin-left: 285px;
            width: calc(100% - 285px);
            min-height: 100vh;
        }

        /* HEADER */
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
            margin: 0 0 4px;
            font-weight: bold;
        }

        .topbar-title p {
            font-size: 13px;
            color: #82908c;
            margin: 0;
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

        /* KONTEN */
        .content {
            padding: 30px 32px 50px;
            min-width: 0;
        }

        .page-intro {
            margin-bottom: 24px;
        }

        .page-intro h2 {
            font-size: 21px;
            font-weight: bold;
            color: #263b36;
            margin-bottom: 7px;
        }

        .page-intro p {
            font-size: 13px;
            color: #82908c;
            margin: 0;
        }

        .summary-card {
            background: white;
            border: 1px solid #e7ecea;
            border-radius: 12px;
            padding: 22px 24px;
            margin-bottom: 24px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
        }

        .summary-label {
            font-size: 13px;
            color: #82908c;
            margin-bottom: 8px;
        }

        .summary-value {
            font-size: 28px;
            font-weight: bold;
            color: #006b59;
            margin: 0;
        }

        .history-card {
            background: white;
            border: 1px solid #e7ecea;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(0,0,0,0.03);
        }

        .history-card-header {
            padding: 22px 24px;
            border-bottom: 1px solid #edf0ef;
        }

        .history-card-header h3 {
            font-size: 17px;
            font-weight: bold;
            color: #263b36;
            margin: 0 0 6px;
        }

        .history-card-header p {
            color: #82908c;
            font-size: 13px;
            margin: 0;
        }

        .history-card-body {
            padding: 24px;
        }

        .table-responsive {
            width: 100%;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
            font-size: 13px;
            white-space: nowrap;
        }

        .history-table thead th {
            background: #f3f7f6;
            color: #52645e;
            font-weight: bold;
            padding: 15px 14px;
            border-bottom: 1px solid #e4eae8;
            text-align: left;
        }

        .history-table tbody td {
            padding: 15px 14px;
            border-bottom: 1px solid #edf0ef;
            color: #46544f;
            vertical-align: middle;
        }

        .history-table tbody tr:hover {
            background: #f8fbfa;
        }

        .history-table tbody tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .status-selesai {
            background: #d9f5e6;
            color: #16794b;
        }

        .status-dibatalkan {
            background: #e9ecef;
            color: #59636e;
        }

        .status-gagal {
            background: #fde2e2;
            color: #b42318;
        }

        .status-lainnya {
            background: #fff0c2;
            color: #805b00;
        }

        .empty-state {
            text-align: center;
            padding: 55px 20px;
        }

        .empty-state-icon {
            font-size: 42px;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            font-size: 18px;
            font-weight: bold;
            color: #263b36;
            margin-bottom: 9px;
        }

        .empty-state p {
            color: #82908c;
            font-size: 13px;
            margin: 0;
        }

        .pagination-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 24px;
        }

        .pagination-info {
            color: #82908c;
            font-size: 12px;
        }

        .pagination {
            margin: 0;
        }

        .pagination .page-link {
            color: #006b59;
        }

        .pagination .active .page-link {
            background: #006b59;
            border-color: #006b59;
            color: white;
        }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .sidebar {
                width: 250px;
            }

            .main {
                margin-left: 250px;
                width: calc(100% - 250px);
            }

            .topbar {
                padding-left: 24px;
                padding-right: 24px;
            }

            .content {
                padding: 24px;
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

            .sidebar-header {
                padding-left: 15px;
                padding-right: 10px;
            }

            .logo-circle {
                width: 45px;
                height: 45px;
                min-width: 45px;
            }

            .topbar {
                align-items: flex-start;
                padding: 18px 15px;
            }

            .topbar-title h1 {
                font-size: 18px;
            }

            .content {
                padding: 20px 15px;
            }

            .history-card-header,
            .history-card-body {
                padding: 18px;
            }

            .profile {
                gap: 8px;
            }

            .user-info strong {
                font-size: 12px;
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
                <h2>EVChargeHub</h2>
                <p>Charge Today, Greener Tomorrow</p>
            </div>
        </div>

        <div class="menu-title">MENU UTAMA</div>

        <a href="{{ route('operator.dashboard') }}"
           class="menu-item {{ request()->routeIs('operator.dashboard') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M3 10.5L12 3l9 7.5"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M5 9.5V21h14V9.5"
                          stroke-width="2"
                          stroke-linejoin="round"/>
                    <path d="M9 21v-7h6v7" stroke-width="2"/>
                </svg>
            </span>
            <span class="menu-label">Dashboard</span>
        </a>

        <div class="menu-title">OPERASIONAL</div>

        <a href="{{ route('operator.stations') }}"
           class="menu-item {{ request()->routeIs('operator.stations*') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 21s7-6.1 7-12A7 7 0 0 0 5 9c0 5.9 7 12 7 12z"
                          stroke-width="2"/>
                    <circle cx="12" cy="9" r="2.5" stroke-width="2"/>
                </svg>
            </span>
            <span class="menu-label">Charging Station</span>
        </a>

        <a href="{{ route('operator.chargers') }}"
           class="menu-item {{ request()->routeIs('operator.chargers*') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M13 2L4 14h6l-1 8 9-12h-6l1-8z"
                          stroke-width="2"
                          stroke-linejoin="round"/>
                </svg>
            </span>
            <span class="menu-label">Charger</span>
        </a>

        <a href="{{ route('operator.charger-status') }}"
           class="menu-item {{ request()->routeIs('operator.charger-status') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="8" stroke-width="2"/>
                    <path d="M12 8v4l3 2"
                          stroke-width="2"
                          stroke-linecap="round"/>
                </svg>
            </span>
            <span class="menu-label">Monitoring Charging</span>
        </a>

        <a href="{{ route('operator.sessions') }}"
           class="menu-item {{ request()->routeIs('operator.sessions') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M5 3h14v18H5z" stroke-width="2"/>
                    <path d="M8 7h8M8 11h8M8 15h5"
                          stroke-width="2"
                          stroke-linecap="round"/>
                </svg>
            </span>
            <span class="menu-label">Sesi Charging</span>
        </a>

        <a href="{{ route('operator.history') }}"
           class="menu-item {{ request()->routeIs('operator.history') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="8" stroke-width="2"/>
                    <path d="M12 7v5l3 2"
                          stroke-width="2"
                          stroke-linecap="round"/>
                </svg>
            </span>
            <span class="menu-label">Riwayat Charging</span>
        </a>

        <a href="{{ route('operator.charger-reports.index') }}"
           class="menu-item {{ request()->routeIs('operator.charger-reports.*') ? 'active' : '' }}">
            <span class="menu-icon">🔧</span>
            <span class="menu-label">Laporan Kerusakan</span>
        </a>

        <div class="menu-title">LAPORAN</div>

        <a href="{{ route('operator.report') }}"
           class="menu-item {{ request()->routeIs('operator.report') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
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

        <div class="menu-title">AKUN</div>

        <a href="{{ route('operator.profile') }}"
           class="menu-item {{ request()->routeIs('operator.profile') ? 'active' : '' }}">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" stroke-width="2"/>
                    <path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"
                          stroke-width="2"
                          stroke-linecap="round"/>
                </svg>
            </span>
            <span class="menu-label">Profil</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="menu-item logout-button">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M10 17l5-5-5-5"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M15 12H3"
                              stroke-width="2"
                              stroke-linecap="round"/>
                        <path d="M21 3v18"
                              stroke-width="2"
                              stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="menu-label">Logout</span>
            </button>
        </form>

    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="main">

        <header class="topbar">
            <div class="topbar-title">
                <h1>Riwayat Charging</h1>
                <p>Daftar riwayat sesi charging kendaraan listrik</p>
            </div>

            @auth
                @php
                    $operatorName = auth()->user()->nama
                        ?? auth()->user()->username
                        ?? 'Operator';
                @endphp

                <div class="profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr($operatorName, 0, 1)) }}
                    </div>

                    <div class="user-info">
                        <strong>{{ $operatorName }}</strong>
                        <span>Operator</span>
                    </div>
                </div>
            @endauth
        </header>

        <section class="content">

            {{-- JUDUL HALAMAN --}}
            <div class="page-intro">
                <h2>Riwayat Sesi Charging</h2>
                <p>
                    Pantau sesi charging yang sudah selesai, dibatalkan, atau gagal.
                </p>
            </div>

            {{-- RINGKASAN DATA --}}
            <div class="summary-card">
                <div class="summary-label">Total Riwayat Charging</div>
                <p class="summary-value">{{ $sessions->total() }}</p>
            </div>

            {{-- TABEL RIWAYAT --}}
            <div class="history-card">

                <div class="history-card-header">
                    <h3>Data Riwayat Charging</h3>
                    <p>Informasi aktivitas pengisian daya kendaraan listrik.</p>
                </div>

                <div class="history-card-body">

                    @if ($sessions->count() > 0)

                        <div class="table-responsive">
                            <table class="history-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Pengemudi</th>
                                        <th>Kendaraan</th>
                                        <th>Lokasi Charging</th>
                                        <th>Charger</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Energi (kWh)</th>
                                        <th>Total Biaya</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sessions as $session)
                                        <tr>
                                            <td>
                                                {{ $sessions->firstItem() + $loop->index }}
                                            </td>

                                            <td>
                                                {{ $session->user->nama
                                                    ?? $session->user->username
                                                    ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $session->vehicle->nama_kendaraan
                                                    ?? $session->vehicle->nomor_polisi
                                                    ?? $session->vehicle->plat_nomor
                                                    ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $session->charger->location->nama_lokasi
                                                    ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $session->charger->kode_perangkat
                                                    ?? $session->charger->id_charger
                                                    ?? '-' }}
                                            </td>

                                            <td>
                                                {{ $session->waktu_mulai
                                                    ? \Carbon\Carbon::parse($session->waktu_mulai)->format('d/m/Y H:i')
                                                    : '-' }}
                                            </td>

                                            <td>
                                                {{ $session->waktu_selesai
                                                    ? \Carbon\Carbon::parse($session->waktu_selesai)->format('d/m/Y H:i')
                                                    : '-' }}
                                            </td>

                                            <td>
                                                {{ number_format((float) ($session->energi_kwh ?? 0), 2, ',', '.') }}
                                            </td>

                                            <td>
                                                Rp {{ number_format((float) ($session->total_biaya ?? 0), 0, ',', '.') }}
                                            </td>

                                            <td>
                                                @php
                                                    $status = strtolower($session->status ?? '');

                                                    $badgeClass = match ($status) {
                                                        'selesai' => 'status-selesai',
                                                        'dibatalkan' => 'status-dibatalkan',
                                                        'gagal' => 'status-gagal',
                                                        default => 'status-lainnya',
                                                    };
                                                @endphp

                                                <span class="status-badge {{ $badgeClass }}">
                                                    {{ ucfirst($status ?: 'Tidak diketahui') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- PAGINATION --}}
                        <div class="pagination-wrapper">

                            <div class="pagination-info">
                                Menampilkan {{ $sessions->firstItem() ?? 0 }}
                                sampai {{ $sessions->lastItem() ?? 0 }}
                                dari {{ $sessions->total() }} data.
                            </div>

                            <div>
                                {{ $sessions->links('pagination::bootstrap-5') }}
                            </div>

                        </div>

                    @else

                        {{-- JIKA BELUM ADA DATA --}}
                        <div class="empty-state">
                            <div class="empty-state-icon">📋</div>

                            <h3>Belum Ada Riwayat Charging</h3>

                            <p>
                                Riwayat akan ditampilkan setelah sesi charging
                                selesai, dibatalkan, atau gagal.
                            </p>
                        </div>

                    @endif

                </div>
            </div>

        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
