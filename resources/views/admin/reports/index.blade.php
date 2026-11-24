<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan - EVChargeHub</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f6;
            color: #263b37;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 250px;
            height: 100vh;
            background: #00695c;
            color: white;
            padding: 25px 16px;
            overflow-y: auto;
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 21px;
            font-weight: bold;
            margin: 0 10px 34px;
        }

        .brand-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #20d890;
            display: grid;
            place-items: center;
        }

        .menu-title {
            font-size: 11px;
            color: #b2dfdb;
            font-weight: bold;
            margin: 22px 10px 10px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px;
            margin: 4px 0;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            transition: background .2s ease;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.13);
        }

        .menu-item.active {
            background: #10aa79;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
        }

        .menu-item-disabled {
            cursor: default;
        }

        .sidebar-divider {
            border-top: 1px solid rgba(255,255,255,.16);
            margin: 20px 5px;
        }

        .logout {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: white;
            font-size: 13px;
            text-align: left;
            cursor: pointer;
        }

        .logout:hover {
            background: rgba(255,255,255,.13);
        }

        /* MAIN */
        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 64px;
            background: white;
            border-bottom: 1px solid #e5e9e7;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .topbar h2 {
            font-size: 18px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #e0f2f1;
            color: #00695c;
            display: grid;
            place-items: center;
            font-weight: bold;
        }

        .content {
            padding: 30px;
        }

        .breadcrumb {
            font-size: 13px;
            color: #71807c;
            margin-bottom: 20px;
        }

        .breadcrumb a {
            color: #00796b;
            text-decoration: none;
        }

        .page-heading {
            margin-bottom: 24px;
        }

        .page-heading h1 {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .muted {
            color: #71807c;
            font-size: 13px;
            line-height: 1.6;
        }

        /* TAB NAVIGATION */
        .tab-navigation {
            display: flex;
            gap: 8px;
            background: white;
            padding: 8px;
            border-radius: 10px;
            box-shadow: 0 2px 8px #163b3510;
            margin-bottom: 22px;
            overflow-x: auto;
        }

        .tab-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            border-radius: 7px;
            color: #536760;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
            transition: .2s;
        }

        .tab-link:hover {
            background: #edf7f4;
            color: #00695c;
        }

        .tab-link.active {
            background: #00695c;
            color: white;
        }

        /* PANEL */
        .panel {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px #163b3510;
            margin-bottom: 22px;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .panel-heading h2 {
            font-size: 17px;
        }

        .period-form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .period-form label {
            font-size: 12px;
            font-weight: bold;
            color: #536760;
        }

        .period-select {
            min-width: 155px;
            padding: 10px 12px;
            border: 1px solid #d9e0de;
            border-radius: 7px;
            background: white;
            color: #263b37;
            font-size: 13px;
        }

        /* SUMMARY CARDS */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .summary-card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 2px 8px #163b3510;
            border-left: 4px solid #10aa79;
        }

        .summary-label {
            font-size: 12px;
            color: #71807c;
            margin-bottom: 12px;
        }

        .summary-value {
            font-size: 23px;
            font-weight: bold;
            color: #00695c;
        }

        .summary-note {
            margin-top: 8px;
            color: #899792;
            font-size: 11px;
        }

        .icon-box {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            background: #e8f5f2;
            display: grid;
            place-items: center;
            font-size: 19px;
            margin-bottom: 15px;
        }

        /* CHART */
        .chart-container {
            position: relative;
            height: 320px;
            width: 100%;
        }

        /* USAGE */
        .usage-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 22px;
        }

        .usage-box {
            background: #f4f8f7;
            padding: 17px;
            border-radius: 9px;
        }

        .usage-box small {
            display: block;
            font-size: 12px;
            color: #71807c;
            margin-bottom: 9px;
        }

        .usage-box strong {
            font-size: 20px;
            color: #00695c;
        }

        .top-charger {
            padding: 17px;
            background: #e8f5f2;
            border-radius: 9px;
            margin-bottom: 22px;
            color: #27675b;
            font-size: 13px;
            line-height: 1.7;
        }

        .usage-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .usage-item {
            width: 100%;
        }

        .usage-info {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .usage-info strong {
            color: #304a43;
        }

        .usage-info span {
            color: #71807c;
        }

        .progress-track {
            width: 100%;
            height: 11px;
            border-radius: 20px;
            background: #edf1ef;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            border-radius: 20px;
            background: #10aa79;
        }

        /* TABLE */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            padding: 14px 15px;
            background: #f4f8f7;
            color: #536760;
            font-size: 12px;
            text-align: left;
            white-space: nowrap;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #edf0ef;
            font-size: 13px;
            color: #405650;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .badge-danger {
            background: #ffebee;
            color: #c62828;
        }

        .badge-warning {
            background: #fff4dc;
            color: #a66b00;
        }

        .badge-success {
            background: #e5f5ed;
            color: #16804b;
        }

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: #71807c;
        }

        .empty-icon {
            font-size: 35px;
            margin-bottom: 12px;
        }

        .empty-state strong {
            display: block;
            color: #405650;
            margin-bottom: 7px;
        }

        .empty-state p {
            font-size: 12px;
            line-height: 1.6;
        }

        .section-description {
            color: #71807c;
            font-size: 12px;
            margin-top: 7px;
        }

        /* RESPONSIVE */
        @media (max-width: 1050px) {
            .summary-grid,
            .usage-summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 750px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
            }

            .content {
                padding: 20px;
            }

            .summary-grid,
            .usage-summary {
                grid-template-columns: 1fr;
            }

            .panel-heading {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 500px) {
            .topbar {
                padding: 0 18px;
            }

            .topbar h2 {
                font-size: 15px;
            }

            .profile span {
                display: none;
            }

            .content {
                padding: 15px;
            }

            .panel {
                padding: 18px;
            }

            .period-form {
                width: 100%;
                align-items: flex-start;
                flex-direction: column;
            }

            .period-select {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">

    <div class="brand">
        <div class="brand-icon">⚡</div>
        <div>EVChargeHub</div>
    </div>

    <div class="menu-title">Menu Utama</div>

    <a href="{{ route('admin.dashboard') }}" class="menu-item">
        <span class="menu-icon">🏠</span>
        <span>Dashboard</span>
    </a>

    <div class="menu-title">Manajemen</div>

    <div class="menu-item menu-item-disabled">
        <span class="menu-icon">👥</span>
        <span>Kelola Pengguna</span>
    </div>

    <div class="menu-item menu-item-disabled">
        <span class="menu-icon">👨‍💼</span>
        <span>Kelola Operator</span>
    </div>

    <a href="{{ route('admin.charging-stations.index') }}" class="menu-item">
        <span class="menu-icon">📍</span>
        <span>Charging Station</span>
    </a>

    <a href="{{ route('admin.chargers.index') }}" class="menu-item">
        <span class="menu-icon">🔌</span>
        <span>Kelola Charger</span>
    </a>

    <div class="menu-title">Operasional</div>

    <a href="{{ route('admin.monitoring.index') }}" class="menu-item">
        <span class="menu-icon">⚡</span>
        <span>Monitoring Charging</span>
    </a>

    <div class="menu-title">Laporan & Transaksi</div>

    <a href="{{ route('admin.reports.index') }}"
       class="menu-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
        <span class="menu-icon">📊</span>
        <span>Laporan</span>
    </a>

    <a href="{{ route('admin.tariffs.index') }}" class="menu-item">
        <span class="menu-icon">💰</span>
        <span>Tarif per Station</span>
    </a>

    <div class="menu-item menu-item-disabled">
        <span class="menu-icon">💳</span>
        <span>Refund Pembayaran</span>
    </div>

    <div class="menu-title">Komunikasi</div>

    <div class="menu-item menu-item-disabled">
        <span class="menu-icon">⭐</span>
        <span>Ulasan & Feedback</span>
    </div>

    <div class="menu-item menu-item-disabled">
        <span class="menu-icon">🎁</span>
        <span>Promosi</span>
    </div>

    <div class="menu-title">Sistem</div>

    <div class="menu-item menu-item-disabled">
        <span class="menu-icon">🔐</span>
        <span>Hak Akses</span>
    </div>

    <div class="menu-item menu-item-disabled">
        <span class="menu-icon">🛡️</span>
        <span>Audit Log</span>
    </div>

    <div class="sidebar-divider"></div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit" class="logout">
            <span class="menu-icon">🚪</span>
            <span>Logout</span>
        </button>
    </form>

</aside>


<main class="main">

    <header class="topbar">

        <h2>Laporan</h2>

        <div class="profile">
            <div class="avatar">A</div>

            <span>
                {{ auth()->user()->nama ?? auth()->user()->name ?? 'Admin' }}
            </span>
        </div>

    </header>


    <section class="content">

        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            / Laporan
        </div>


        <div class="page-heading">
            <h1>📊 Laporan EVChargeHub</h1>

            <p class="muted">
                Pantau pendapatan, penggunaan charger, dan kondisi perangkat
                charging melalui laporan sistem.
            </p>
        </div>


        {{-- TAB NAVIGATION --}}

        <div class="tab-navigation">

            <a href="{{ route('admin.reports.index', ['tab' => 'pendapatan', 'periode' => $periode]) }}"
               class="tab-link {{ $tab === 'pendapatan' ? 'active' : '' }}">
                💰 Pendapatan
            </a>

            <a href="{{ route('admin.reports.index', ['tab' => 'penggunaan', 'periode' => $periode]) }}"
               class="tab-link {{ $tab === 'penggunaan' ? 'active' : '' }}">
                ⚡ Penggunaan Charger
            </a>

            <a href="{{ route('admin.reports.index', ['tab' => 'gangguan', 'periode' => $periode]) }}"
               class="tab-link {{ $tab === 'gangguan' ? 'active' : '' }}">
                🔧 Gangguan Charger
            </a>

        </div>


        {{-- ====================================== --}}
        {{-- TAB 1: PENDAPATAN --}}
        {{-- ====================================== --}}

        @if($tab === 'pendapatan')

            <section class="panel">

                <div class="panel-heading">

                    <div>
                        <h2>💰 Laporan Pendapatan</h2>

                        <p class="section-description">
                            Ringkasan transaksi pembayaran yang berhasil.
                        </p>
                    </div>

                    <form method="GET"
                          action="{{ route('admin.reports.index') }}"
                          class="period-form">

                        <input type="hidden" name="tab" value="pendapatan">

                        <label for="periode">Periode Laporan</label>

                        <select name="periode"
                                id="periode"
                                class="period-select"
                                onchange="this.form.submit()">

                            @foreach($daftarPeriode as $item)

                                <option value="{{ $item['value'] }}"
                                    @selected($periode === $item['value'])>

                                    {{ $item['label'] }}

                                </option>

                            @endforeach

                        </select>

                    </form>

                </div>

            </section>


            <div class="summary-grid">

                <div class="summary-card">

                    <div class="icon-box">💰</div>

                    <div class="summary-label">
                        Total Pendapatan
                    </div>

                    <div class="summary-value">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </div>

                    <div class="summary-note">
                        Pendapatan dari pembayaran berhasil
                    </div>

                </div>


                <div class="summary-card">

                    <div class="icon-box">🧾</div>

                    <div class="summary-label">
                        Total Transaksi
                    </div>

                    <div class="summary-value">
                        {{ number_format($totalTransaksi, 0, ',', '.') }}
                    </div>

                    <div class="summary-note">
                        Jumlah pembayaran berhasil
                    </div>

                </div>


                <div class="summary-card">

                    <div class="icon-box">📈</div>

                    <div class="summary-label">
                        Rata-rata Transaksi
                    </div>

                    <div class="summary-value">
                        Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}
                    </div>

                    <div class="summary-note">
                        Rata-rata nilai setiap transaksi
                    </div>

                </div>

            </div>


            <section class="panel">

                <div class="panel-heading">

                    <div>
                        <h2>Grafik Pendapatan</h2>

                        <p class="section-description">
                            Perkembangan pendapatan harian pada
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $periode)->translatedFormat('F Y') }}.
                        </p>
                    </div>

                </div>

                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>

            </section>


        {{-- ====================================== --}}
        {{-- TAB 2: PENGGUNAAN CHARGER --}}
        {{-- ====================================== --}}

        @elseif($tab === 'penggunaan')

            <section class="panel">

                <div class="panel-heading">

                    <div>
                        <h2>⚡ Laporan Penggunaan Charger</h2>

                        <p class="section-description">
                            Rekap penggunaan setiap charger berdasarkan sesi
                            charging yang selesai.
                        </p>
                    </div>

                    <form method="GET"
                          action="{{ route('admin.reports.index') }}"
                          class="period-form">

                        <input type="hidden" name="tab" value="penggunaan">

                        <label for="periode">Periode Laporan</label>

                        <select name="periode"
                                id="periode"
                                class="period-select"
                                onchange="this.form.submit()">

                            @foreach($daftarPeriode as $item)

                                <option value="{{ $item['value'] }}"
                                    @selected($periode === $item['value'])>

                                    {{ $item['label'] }}

                                </option>

                            @endforeach

                        </select>

                    </form>

                </div>


                <div class="usage-summary">

                    <div class="usage-box">
                        <small>Total Sesi Charging</small>

                        <strong>
                            {{ number_format($totalSesiPenggunaan, 0, ',', '.') }}
                        </strong>
                    </div>

                    <div class="usage-box">
                        <small>Total Energi Digunakan</small>

                        <strong>
                            {{ number_format((float) $totalKwh, 2, ',', '.') }} kWh
                        </strong>
                    </div>

                    <div class="usage-box">
                        <small>Total Durasi Penggunaan</small>

                        <strong>
                            {{ number_format($totalDurasi / 60, 1, ',', '.') }} jam
                        </strong>
                    </div>

                </div>


                @if($chargerTeratas)

                    <div class="top-charger">

                        🏆 <strong>Charger Paling Sering Digunakan</strong>

                        <br>

                        {{ $chargerTeratas->kode_perangkat }}

                        — {{ $chargerTeratas->nama_lokasi ?? 'Station tidak diketahui' }}

                        <br>

                        Digunakan sebanyak
                        <strong>{{ $chargerTeratas->total_sesi }} sesi</strong>
                        pada periode ini.

                    </div>

                @endif


                <h3 style="font-size:15px;margin-bottom:20px;">
                    Statistik Penggunaan Setiap Charger
                </h3>


                @if($penggunaanCharger->count() > 0)

                    @php
                        $sesiMaksimum = max(
                            (int) $penggunaanCharger->max('total_sesi'),
                            1
                        );
                    @endphp

                    <div class="usage-list">

                        @foreach($penggunaanCharger as $charger)

                            <div class="usage-item">

                                <div class="usage-info">

                                    <strong>
                                        {{ $charger->kode_perangkat ?? 'Charger' }}

                                        <span style="font-weight:normal;">
                                            — {{ $charger->nama_lokasi ?? 'Station tidak diketahui' }}
                                        </span>
                                    </strong>

                                    <span>
                                        {{ $charger->total_sesi }} sesi
                                    </span>

                                </div>

                                <div class="progress-track">

                                    <div class="progress-bar"
                                         style="width: {{ ($charger->total_sesi / $sesiMaksimum) * 100 }}%">
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-state">

                        <div class="empty-icon">🔌</div>

                        <strong>Belum Ada Data Penggunaan</strong>

                        <p>
                            Belum terdapat sesi charging yang selesai
                            pada periode ini.
                        </p>

                    </div>

                @endif

            </section>


            <section class="panel">

                <div class="panel-heading">

                    <div>
                        <h2>Detail Penggunaan Charger</h2>

                        <p class="section-description">
                            Rincian jumlah sesi, energi, dan durasi setiap charger.
                        </p>
                    </div>

                </div>


                @if($penggunaanCharger->count() > 0)

                    <div class="table-wrapper">

                        <table>

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Charger</th>
                                    <th>Station</th>
                                    <th>Konektor</th>
                                    <th>Jumlah Sesi</th>
                                    <th>Total Energi</th>
                                    <th>Durasi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($penggunaanCharger as $index => $charger)

                                    <tr>

                                        <td>{{ $index + 1 }}</td>

                                        <td>
                                            <strong>
                                                {{ $charger->kode_perangkat }}
                                            </strong>
                                        </td>

                                        <td>
                                            {{ $charger->nama_lokasi ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $charger->tipe_konektor ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $charger->total_sesi }} sesi
                                        </td>

                                        <td>
                                            {{ number_format((float) $charger->total_kwh, 2, ',', '.') }}
                                            kWh
                                        </td>

                                        <td>
                                            {{ number_format($charger->total_durasi / 60, 1, ',', '.') }}
                                            jam
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty-state">
                        <div class="empty-icon">📊</div>
                        <strong>Belum Ada Data</strong>
                        <p>Data penggunaan charger belum tersedia.</p>
                    </div>

                @endif

            </section>


        {{-- ====================================== --}}
        {{-- TAB 3: GANGGUAN CHARGER --}}
        {{-- ====================================== --}}

        @elseif($tab === 'gangguan')

            <section class="panel">

                <div class="panel-heading">

                    <div>
                        <h2>🔧 Laporan Gangguan Charger</h2>

                        <p class="section-description">
                            Daftar charger yang sedang Offline, Error,
                            atau Maintenance.
                        </p>
                    </div>

                </div>


                <div class="summary-grid">

                    <div class="summary-card">

                        <div class="icon-box">🔧</div>

                        <div class="summary-label">
                            Total Charger Bermasalah
                        </div>

                        <div class="summary-value">
                            {{ $gangguanCharger->count() }}
                        </div>

                        <div class="summary-note">
                            Charger dengan status gangguan
                        </div>

                    </div>


                    <div class="summary-card">

                        <div class="icon-box">🔴</div>

                        <div class="summary-label">
                            Charger Offline
                        </div>

                        <div class="summary-value">
                            {{ $gangguanCharger->where('status', 'offline')->count() }}
                        </div>

                        <div class="summary-note">
                            Charger dalam kondisi offline
                        </div>

                    </div>


                    <div class="summary-card">

                        <div class="icon-box">🟡</div>

                        <div class="summary-label">
                            Charger Maintenance / Error
                        </div>

                        <div class="summary-value">
                            {{ $gangguanCharger->filter(function ($item) {
                                return in_array(strtolower($item->status), ['maintenance', 'error']);
                            })->count() }}
                        </div>

                        <div class="summary-note">
                            Charger yang perlu pemeriksaan
                        </div>

                    </div>

                </div>


                <div class="panel-heading" style="margin-top:10px;">

                    <div>
                        <h2>Daftar Gangguan Charger</h2>

                        <p class="section-description">
                            Kondisi perangkat berdasarkan status terakhir di sistem.
                        </p>
                    </div>

                </div>


                @if($gangguanCharger->count() > 0)

                    <div class="table-wrapper">

                        <table>

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Charger</th>
                                    <th>Station</th>
                                    <th>Jenis Gangguan</th>
                                    <th>Status Penanganan</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($gangguanCharger as $index => $gangguan)

                                    <tr>

                                        <td>{{ $index + 1 }}</td>

                                        <td>
                                            <strong>
                                                {{ $gangguan->kode_perangkat }}
                                            </strong>
                                        </td>

                                        <td>
                                            {{ $gangguan->nama_lokasi ?? '-' }}
                                        </td>

                                        <td>
                                            @if(strtolower($gangguan->status) === 'offline')
                                                <span class="badge badge-danger">
                                                    Offline
                                                </span>
                                            @elseif(strtolower($gangguan->status) === 'maintenance')
                                                <span class="badge badge-warning">
                                                    Maintenance
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    Error
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="badge badge-{{ $gangguan->warna_status }}">
                                                {{ $gangguan->status_penanganan }}
                                            </span>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty-state">

                        <div class="empty-icon">✅</div>

                        <strong>Tidak Ada Gangguan Charger</strong>

                        <p>
                            Saat ini tidak ditemukan charger dengan status
                            Offline, Error, atau Maintenance.
                        </p>

                    </div>

                @endif

            </section>

        @endif

    </section>

</main>


{{-- ========================================== --}}
{{-- GRAFIK PENDAPATAN --}}
{{-- ========================================== --}}

@if($tab === 'pendapatan')

<script>
    const chartLabels = @json($labelGrafik);
    const chartValues = @json($dataGrafik);

    const chartCanvas = document.getElementById('revenueChart');

    new Chart(chartCanvas, {
        type: 'line',

        data: {
            labels: chartLabels,

            datasets: [{
                label: 'Pendapatan (Rp)',

                data: chartValues,

                borderColor: '#009879',

                backgroundColor: 'rgba(16, 170, 121, 0.12)',

                borderWidth: 3,

                fill: true,

                tension: 0.35,

                pointRadius: 3,

                pointHoverRadius: 6
            }]
        },

        options: {
            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index'
            },

            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Pendapatan: Rp ' +
                                new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            },

            scales: {
                y: {
                    beginAtZero: true,

                    ticks: {
                        callback: function(value) {
                            return 'Rp ' +
                                new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                },

                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                }
            }
        }
    });
</script>

@endif

</body>
</html>