<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Charging - EVChargeHub</title>

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
            background: linear-gradient(180deg, #006b59 0%, #005747 55%, #00453b 100%);
            color: white;
            position: fixed;
            inset: 0 auto 0 0;
            overflow-y: auto;
            z-index: 10;
        }

        .sidebar-header {
            min-height: 120px;
            display: flex;
            align-items: center;
            padding: 25px 22px;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .logo-circle {
            width: 58px;
            height: 58px;
            min-width: 58px;
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
            line-height: 1.4;
            opacity: .85;
        }

        .menu-title {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            padding: 25px 26px 10px;
            color: rgba(255,255,255,.6);
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 22px;
            margin: 4px 12px;
            width: calc(100% - 24px);
            border-radius: 9px;
            color: white;
            text-decoration: none;
            font-family: inherit;
            font-size: 14px;
            transition: .2s;
        }

        .menu-item:hover,
        .menu-item.active {
            background: rgba(255,255,255,.16);
        }

        .menu-item.active {
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

        .logout-form {
            margin-bottom: 20px;
        }

        .logout-button {
            background: transparent;
            border: 0;
            cursor: pointer;
            text-align: left;
        }

        /* MAIN AND TOPBAR */
        .main {
            margin-left: 285px;
            width: calc(100% - 285px);
            min-height: 100vh;
        }

        .topbar {
            min-height: 92px;
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
            margin-bottom: 5px;
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
            width: 46px;
            height: 46px;
            min-width: 46px;
            border-radius: 50%;
            background: #007967;
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
            margin-bottom: 4px;
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
            line-height: 1.6;
            opacity: .92;
        }

        /* STATISTICS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            border: 1px solid #e5e9e8;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 15px;
        }

        .stat-label {
            color: #7a8884;
            font-size: 13px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 11px;
            background: #e8f5f1;
            color: #006b59;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            color: #263b36;
        }

        /* TABLE CARD */
        .card {
            background: white;
            border-radius: 14px;
            border: 1px solid #e5e9e8;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #edf0ef;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            min-width: 850px;
        }

        th {
            text-align: left;
            font-size: 11px;
            color: #7a8884;
            padding: 14px 20px;
            background: #fafbfb;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        td {
            padding: 17px 20px;
            border-top: 1px solid #edf0ef;
            font-size: 13px;
            color: #42514d;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #fbfdfc;
        }

        td strong {
            color: #263b36;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
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

        .status-active {
            color: #d17b00;
            background: #fff4df;
        }

        .status-completed {
            color: #16865d;
            background: #e8f7ef;
        }

        .status-failed {
            color: #c43e3e;
            background: #fdecec;
        }

        .status-pending {
            color: #66727a;
            background: #eef1f2;
        }

        .empty {
            text-align: center;
            padding: 45px 20px;
            color: #82908c;
            font-size: 13px;
        }

        .empty-icon {
            font-size: 32px;
            margin-bottom: 12px;
        }

        .empty strong {
            display: block;
            color: #263b36;
            margin-bottom: 7px;
        }

        /* PAGINATION */
        .pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 5px;
            list-style: none;
            padding: 18px 20px;
            margin: 0;
            border-top: 1px solid #edf0ef;
        }

        .pagination a,
        .pagination span {
            display: block;
            padding: 8px 12px;
            border: 1px solid #e5e9e8;
            border-radius: 7px;
            text-decoration: none;
            color: #006b59;
            font-size: 13px;
        }

        .pagination .active span {
            background: #006b59;
            border-color: #006b59;
            color: white;
        }

        .pagination .disabled span {
            color: #aab3b0;
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

        @media (max-width: 750px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .sidebar-header {
                padding: 18px 14px;
            }

            .logo-circle {
                width: 44px;
                height: 44px;
                min-width: 44px;
                font-size: 15px;
            }

            .logo-text h2 {
                font-size: 15px;
            }

            .topbar {
                align-items: flex-start;
                padding: 18px;
            }

            .topbar-title h1 {
                font-size: 18px;
            }

            .user-info {
                display: none;
            }

            .content {
                padding: 20px 15px 30px;
            }

            .welcome {
                padding: 20px;
            }

            .welcome h2 {
                font-size: 18px;
            }

            .stats-grid {
                gap: 12px;
            }

            .stat-card {
                padding: 15px;
            }
        }

        @media (max-width: 520px) {
            .sidebar {
                width: 72px;
            }

            .sidebar-header {
                justify-content: center;
                padding: 15px 5px;
            }

            .logo-circle {
                margin-right: 0;
            }

            .logo-text,
            .menu-title,
            .menu-item > span + span,
            .menu-item .menu-label,
            .logout-button .menu-label {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 10px 5px;
                margin: 5px 6px;
                width: calc(100% - 12px);
            }

            .menu-icon {
                min-width: 30px;
            }

            .main {
                margin-left: 72px;
                width: calc(100% - 72px);
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .card-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 17px;
            }

            .topbar {
                padding: 15px 12px;
            }

            .topbar-title p {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

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
                    <path d="M3 10.5L12 3l9 7.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 9.5V21h14V9.5" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M9 21v-7h6v7" stroke-width="2"/>
                </svg>
            </span>
            <span class="menu-label">Dashboard</span>
        </a>

        <div class="menu-title">OPERASIONAL</div>

        <a href="{{ route('operator.stations') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 21s7-6.1 7-12A7 7 0 0 0 5 9c0 5.9 7 12 7 12z" stroke-width="2"/>
                    <circle cx="12" cy="9" r="2.5" stroke-width="2"/>
                </svg>
            </span>
            <span class="menu-label">Charging Station</span>
        </a>

        <a href="{{ route('operator.chargers') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M13 2L4 14h6l-1 8 9-12h-6l1-8z" stroke-width="2" stroke-linejoin="round"/>
                </svg>
            </span>
            <span class="menu-label">Charger</span>
        </a>

        <a href="{{ route('operator.charger-status') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="8" stroke-width="2"/>
                    <path d="M12 8v4l3 2" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            <span class="menu-label">Monitoring Charging</span>
        </a>

        <a href="{{ route('operator.sessions') }}" class="menu-item active">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M6 3h12v18H6z" stroke-width="2"/>
                    <path d="M9 7h6M9 11h6M9 15h4" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            <span class="menu-label">Sesi Charging</span>
        </a>


        <a href="{{ route('operator.history') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="8" stroke-width="2"/>
                    <path d="M12 7v5l3 2"
                        stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            Riwayat Charging
        </a>

        <a href="{{ route('operator.charger-reports.index') }}" class="menu-item">
            <span class="menu-icon">🔧</span>
            <span class="menu-label">Laporan Kerusakan</span>
        </a>


        <div class="menu-title">LAPORAN</div>

        <a href="{{ route('operator.report') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M4 19V5M4 19h17" stroke-width="2" stroke-linecap="round"/>
                    <path d="M7 15l4-4 3 2 5-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <span class="menu-label">Laporan</span>
        </a>

        <div class="menu-title">AKUN</div>

        <a href="{{ route('operator.profile') }}" class="menu-item">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="8" r="4" stroke-width="2"/>
                    <path d="M4 21c0-4 3.6-7 8-7s8 3 8 7" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            <span class="menu-label">Profil</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="menu-item logout-button">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M10 17l5-5-5-5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15 12H3" stroke-width="2" stroke-linecap="round"/>
                        <path d="M21 3v18" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="menu-label">Logout</span>
            </button>
        </form>
    </aside>

    <main class="main">
        <header class="topbar">
            <div class="topbar-title">
                <h1>Dashboard Operator</h1>
                <p>Pantau aktivitas charging station secara real-time</p>
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

        <section class="content">
            <div class="welcome">
                <h2>Monitoring Sesi Charging</h2>
                <p>Pantau seluruh sesi charging pengemudi, kendaraan, charger, waktu mulai, dan status pengisian daya.</p>
            </div>

            @php
                $allSessions = $sessions->getCollection();

                $totalSessions = $sessions->total();

                $activeCount = $allSessions->filter(
                    fn ($session) => strtolower($session->status ?? '') === 'berlangsung'
                )->count();

                $completedCount = $allSessions->filter(
                    fn ($session) => strtolower($session->status ?? '') === 'selesai'
                )->count();

                $otherCount = $allSessions->count() - $activeCount - $completedCount;
            @endphp

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Total Sesi</span>
                        <div class="stat-icon">⚡</div>
                    </div>
                    <div class="stat-number">{{ $totalSessions }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Charging Berlangsung</span>
                        <div class="stat-icon">🔋</div>
                    </div>
                    <div class="stat-number">{{ $activeCount }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Charging Selesai</span>
                        <div class="stat-icon">✓</div>
                    </div>
                    <div class="stat-number">{{ $completedCount }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <span class="stat-label">Status Lainnya</span>
                        <div class="stat-icon">◷</div>
                    </div>
                    <div class="stat-number">{{ $otherCount }}</div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Daftar Sesi Charging</h3>
                    <span>{{ $totalSessions }} sesi tercatat</span>
                </div>

                @if($sessions->count())
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID Sesi</th>
                                    <th>Pengemudi</th>
                                    <th>Kendaraan</th>
                                    <th>Charger</th>
                                    <th>Waktu Mulai</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sessions as $session)
                                    @php
                                        $status = strtolower($session->status ?? '');

                                        $statusClass = match ($status) {
                                            'berlangsung', 'aktif' => 'status-active',
                                            'selesai' => 'status-completed',
                                            'gagal', 'dibatalkan' => 'status-failed',
                                            default => 'status-pending',
                                        };
                                    @endphp

                                    <tr>
                                        <td><strong>#{{ $session->id_session }}</strong></td>

                                        <td>
                                            <strong>{{ $session->user->nama ?? '-' }}</strong>
                                        </td>

                                        <td>
                                            {{ $session->vehicle->merek ?? '-' }}
                                            {{ $session->vehicle->model ?? '' }}
                                        </td>

                                        <td>
                                            <strong>{{ $session->charger->kode_perangkat ?? '-' }}</strong>
                                        </td>

                                        <td>
                                            {{ $session->waktu_mulai
                                                ? \Illuminate\Support\Carbon::parse($session->waktu_mulai)->format('d/m/Y H:i')
                                                : '-' }}
                                        </td>

                                        <td>{{ $session->durasi_menit ?? 0 }} menit</td>

                                        <td>
                                            <span class="status {{ $statusClass }}">
                                                <span class="status-dot"></span>
                                                {{ ucfirst($session->status ?? 'Belum diketahui') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $sessions->links() }}
                @else
                    <div class="empty">
                        <div class="empty-icon">⚡</div>
                        <strong>Belum ada sesi charging</strong>
                        Data sesi charging akan muncul di sini setelah tersedia.
                    </div>
                @endif
            </div>
        </section>
    </main>
</div>
</body>
</html>
