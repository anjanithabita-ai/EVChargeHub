<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monitoring Charging - EVChargeHub</title>

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

        /* LAYOUT */

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 250px;
            background: #00695c;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 100;
        }

        .brand {
            min-height: 86px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #20d890;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            color: white;
        }

        .brand-name {
            font-size: 20px;
            font-weight: bold;
        }

        .sidebar-content {
            padding: 22px 10px;
        }

        .menu-title {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            color: #9bd4c9;
            margin: 18px 10px 10px;
            text-transform: uppercase;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 13px;
            color: white;
            text-decoration: none;
            padding: 13px 14px;
            margin-bottom: 4px;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.12);
        }

        .menu-item.active {
            background: #10aa79;
            font-weight: bold;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255,255,255,0.15);
            margin: 20px 8px;
        }

        .logout {
            color: #ffd5d5;
        }

        /* MAIN */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        /* TOPBAR */

        .topbar {
            min-height: 76px;
            background: white;
            border-bottom: 1px solid #e4ebe8;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            gap: 10px;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #dff7ed;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #00695c;
            font-weight: bold;
        }

        .admin-name {
            font-size: 13px;
            font-weight: bold;
            color: #16483f;
        }

        /* CONTENT */

        .content {
            padding: 30px 32px 50px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .page-heading h2 {
            font-size: 23px;
            margin-bottom: 8px;
            color: #16483f;
        }

        .page-heading p {
            font-size: 14px;
            color: #78908a;
        }

        /* BUTTON */

        .btn {
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .btn-refresh {
            background: #00695c;
            color: white;
        }

        .btn-refresh:hover {
            background: #00564b;
        }

        .btn-detail {
            background: #e5f5ef;
            color: #08765d;
            padding: 7px 11px;
            font-size: 12px;
        }

        .btn-detail:hover {
            background: #ccefe1;
        }

        /* AUTO REFRESH */

        .refresh-area {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .auto-refresh {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: #668078;
            background: white;
            padding: 10px 12px;
            border: 1px solid #e3ece8;
            border-radius: 8px;
        }

        .auto-refresh input {
            accent-color: #008b6c;
            cursor: pointer;
        }

        /* SUMMARY */

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: white;
            border-radius: 12px;
            padding: 22px;
            border: 1px solid #e8efec;
            box-shadow: 0 2px 8px rgba(0,0,0,0.025);
        }

        .summary-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 17px;
        }

        .summary-label {
            font-size: 13px;
            color: #78908a;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .icon-total {
            background: #e7f1ff;
        }

        .icon-active {
            background: #e0f8ed;
        }

        .icon-completed {
            background: #e5f3ff;
        }

        .icon-failed {
            background: #fff0e9;
        }

        .summary-value {
            font-size: 28px;
            font-weight: bold;
            color: #16483f;
        }

        /* PANEL */

        .panel {
            background: white;
            border-radius: 12px;
            border: 1px solid #e8efec;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.025);
            overflow: hidden;
        }

        .panel-header {
            padding: 20px 23px;
            border-bottom: 1px solid #edf1ef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .panel-header h3 {
            font-size: 16px;
            color: #16483f;
        }

        .panel-header p {
            font-size: 12px;
            color: #8a9d97;
            margin-top: 5px;
        }

        .live-label {
            background: #e1f8ed;
            color: #07875f;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        /* TABLE */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th {
            background: #f8fbfa;
            padding: 14px 18px;
            text-align: left;
            color: #718780;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        td {
            padding: 15px 18px;
            border-bottom: 1px solid #edf1ef;
            font-size: 13px;
            color: #425f57;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #fbfefd;
        }

        .main-text {
            font-weight: bold;
            color: #16483f;
        }

        .sub-text {
            font-size: 11px;
            color: #8a9d97;
            margin-top: 4px;
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
        }

        .status-active {
            background: #e1f8ed;
            color: #07875f;
        }

        .status-completed {
            background: #e5f1ff;
            color: #2671bb;
        }

        .status-failed {
            background: #fff0ed;
            color: #d35a49;
        }

        .status-cancelled {
            background: #fff5df;
            color: #ad7818;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        /* EMPTY */

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: #91a39d;
        }

        .empty-icon {
            font-size: 35px;
            margin-bottom: 12px;
        }

        .empty-state h4 {
            color: #527068;
            font-size: 15px;
            margin-bottom: 7px;
        }

        .empty-state p {
            font-size: 12px;
        }

        /* PAGINATION */

        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            padding: 17px 22px;
        }

        .pagination-info {
            font-size: 12px;
            color: #83968f;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pagination nav {
            display: flex;
            align-items: center;
        }

        .pagination nav > div:first-child {
            display: none;
        }

        .pagination nav > div:last-child {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pagination span,
        .pagination a {
            min-width: 30px !important;
            height: 30px !important;
            padding: 0 8px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 6px !important;
            font-size: 12px !important;
            line-height: 1 !important;
            text-decoration: none !important;
            border: 1px solid #e4ece8 !important;
            color: #527068 !important;
            background: white !important;
        }

        .pagination a:hover {
            background: #e8f7f1 !important;
            color: #00695c !important;
        }

        .pagination [aria-current="page"] span {
            background: #00695c !important;
            color: white !important;
            border-color: #00695c !important;
        }

        .pagination svg {
            width: 13px !important;
            height: 13px !important;
        }

        .pagination a[aria-disabled="true"],
        .pagination span[aria-disabled="true"] {
            opacity: 0.45;
            cursor: not-allowed;
        }

        /* MODAL */

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 40, 34, 0.55);
            z-index: 999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal {
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 35px rgba(0,0,0,0.15);
        }

        .modal-header {
            padding: 20px 23px;
            background: #00695c;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 16px;
        }

        .modal-close {
            background: transparent;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .modal-body {
            padding: 22px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #edf1ef;
            font-size: 13px;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #80938c;
        }

        .detail-value {
            color: #16483f;
            font-weight: bold;
            text-align: right;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {
            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                width: calc(100% - 210px);
            }

            .content {
                padding: 22px 15px;
            }

            .topbar {
                padding: 15px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">⚡</div>
            <div class="brand-name">EVChargeHub</div>
        </div>

        <div class="sidebar-content">

            <div class="menu-title">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <span class="menu-icon">▦</span>
                Dashboard
            </a>

            <div class="menu-title">Manajemen</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">👥</span>
                Kelola Pengguna
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">👨‍💼</span>
                Kelola Operator
            </a>

            <a href="{{ route('admin.charging-stations.index') }}"
                class="menu-item">
                <span class="menu-icon">📍</span>
                Charging Station
            </a>

            <a href="{{ route('admin.chargers.index') }}"
                class="menu-item">
                <span class="menu-icon">🔌</span>
                Kelola Charger
            </a>

            <div class="menu-title">Operasional</div>

            <a href="{{ route('admin.monitoring.index') }}"
                class="menu-item active">
                <span class="menu-icon">📊</span>
                Monitoring Charging
            </a>

            <div class="menu-title">Laporan & Transaksi</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">📄</span>
                Laporan
            </a>

            <a href="{{ route('admin.tariffs.index') }}"
                class="menu-item">
                <span class="menu-icon">💰</span>
                Tarif per Station
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">💳</span>
                Refund Pembayaran
            </a>

            <div class="menu-title">Komunikasi</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">⭐</span>
                Ulasan & Feedback
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">🎁</span>
                Promosi
            </a>

            <div class="menu-title">Sistem</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">🔐</span>
                Hak Akses
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">📋</span>
                Audit Log
            </a>

            <div class="sidebar-divider"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                    class="menu-item logout"
                    style="width:100%; background:none; border:none; cursor:pointer; text-align:left;">

                    <span class="menu-icon">↪</span>
                    Logout

                </button>
            </form>

        </div>
    </aside>


    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="page-title">
                Monitoring Charging
            </div>

            <div class="admin-profile">

                <div class="profile-icon">
                    {{ strtoupper(substr(auth()->user()->nama ?? 'A', 0, 1)) }}
                </div>

                <div class="admin-name">
                    {{ auth()->user()->nama ?? 'Administrator' }}
                </div>

            </div>

        </header>


        <!-- CONTENT -->
        <section class="content">

            <div class="page-heading">

                <div>
                    <h2>Monitoring Charging</h2>

                    <p>
                        Pantau aktivitas dan kondisi sesi pengisian kendaraan listrik.
                    </p>
                </div>

                <div class="refresh-area">

                    <label class="auto-refresh">
                        <input type="checkbox" id="autoRefresh">
                        Auto Refresh (30 detik)
                    </label>

                    <button class="btn btn-refresh" onclick="refreshPage()">
                        ↻ Refresh
                    </button>

                </div>

            </div>


            <!-- SUMMARY -->
            <div class="summary-grid">

                <div class="summary-card">

                    <div class="summary-top">
                        <div class="summary-label">Total Sesi Charging</div>
                        <div class="summary-icon icon-total">📊</div>
                    </div>

                    <div class="summary-value">
                        {{ $totalSessions }}
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-top">
                        <div class="summary-label">Sedang Berlangsung</div>
                        <div class="summary-icon icon-active">⚡</div>
                    </div>

                    <div class="summary-value">
                        {{ $totalActive }}
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-top">
                        <div class="summary-label">Sesi Selesai</div>
                        <div class="summary-icon icon-completed">✓</div>
                    </div>

                    <div class="summary-value">
                        {{ $totalCompleted }}
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-top">
                        <div class="summary-label">Gagal / Dibatalkan</div>
                        <div class="summary-icon icon-failed">!</div>
                    </div>

                    <div class="summary-value">
                        {{ $totalFailed }}
                    </div>

                </div>

            </div>


            <!-- ACTIVE SESSIONS -->
            <div class="panel">

                <div class="panel-header">

                    <div>
                        <h3>Sesi Charging Aktif</h3>

                        <p>
                            Daftar kendaraan yang sedang melakukan pengisian daya.
                        </p>
                    </div>

                    <span class="live-label">
                        ● LIVE MONITORING
                    </span>

                </div>


                @if($activeSessions->count() > 0)

                    <div class="table-wrapper">

                        <table>

                            <thead>
                                <tr>
                                    <th>Pengguna</th>
                                    <th>Charging Station</th>
                                    <th>Charger</th>
                                    <th>Durasi</th>
                                    <th>Energi</th>
                                    <th>Waktu Mulai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($activeSessions as $session)

                                    <tr>

                                        <td>
                                            <div class="main-text">
                                                {{ $session->user->nama ?? 'Pengguna' }}
                                            </div>

                                            <div class="sub-text">
                                                {{ $session->vehicle->nama_kendaraan ?? $session->vehicle->model_kendaraan ?? 'Kendaraan' }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="main-text">
                                                {{ $session->charger->location->nama_lokasi ?? '-' }}
                                            </div>

                                            <div class="sub-text">
                                                {{ $session->charger->location->alamat ?? '' }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="main-text">
                                                {{ $session->charger->kode_perangkat ?? '-' }}
                                            </div>

                                            <div class="sub-text">
                                                {{ $session->charger->tipe_konektor ?? '-' }}
                                            </div>
                                        </td>

                                        <td>
                                            {{ $session->durasi_monitoring }} menit
                                        </td>

                                        <td>
                                            {{ number_format((float) $session->energi_kwh, 2, ',', '.') }}
                                            kWh
                                        </td>

                                        <td>
                                            {{ $session->waktu_mulai
                                                ? $session->waktu_mulai->format('d/m/Y H:i')
                                                : '-' }}
                                        </td>

                                        <td>
                                            <span class="status status-active">
                                                <span class="status-dot"></span>
                                                Sedang Mengisi
                                            </span>
                                        </td>

                                        <td>

                                            <button
                                                class="btn btn-detail"
                                                onclick="showDetail(this)"

                                                data-user="{{ $session->user->nama ?? 'Pengguna' }}"

                                                data-vehicle="{{ $session->vehicle->nama_kendaraan ?? $session->vehicle->model_kendaraan ?? '-' }}"

                                                data-station="{{ $session->charger->location->nama_lokasi ?? '-' }}"

                                                data-charger="{{ $session->charger->kode_perangkat ?? '-' }}"

                                                data-connector="{{ $session->charger->tipe_konektor ?? '-' }}"

                                                data-duration="{{ $session->durasi_monitoring }} menit"

                                                data-energy="{{ number_format((float) $session->energi_kwh, 2, ',', '.') }} kWh"

                                                data-start="{{ $session->waktu_mulai ? $session->waktu_mulai->format('d/m/Y H:i') : '-' }}"

                                                data-cost="Rp {{ number_format((float) $session->total_biaya, 0, ',', '.') }}">

                                                Detail

                                            </button>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty-state">

                        <div class="empty-icon">🔌</div>

                        <h4>Belum Ada Sesi Charging Aktif</h4>

                        <p>
                            Saat ini tidak ada kendaraan yang sedang melakukan pengisian daya.
                        </p>

                    </div>

                @endif

            </div>


            <!-- HISTORY -->
            <div class="panel">

                <div class="panel-header">

                    <div>
                        <h3>Riwayat Sesi Charging Terbaru</h3>

                        <p>
                            Informasi sesi charging yang telah selesai atau tidak dilanjutkan.
                        </p>
                    </div>

                </div>


                @if($historySessions->count() > 0)

                    <div class="table-wrapper">

                        <table>

                            <thead>
                                <tr>
                                    <th>Pengguna</th>
                                    <th>Charging Station</th>
                                    <th>Charger</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Energi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($historySessions as $session)

                                    <tr>

                                        <td>
                                            <div class="main-text">
                                                {{ $session->user->nama ?? 'Pengguna' }}
                                            </div>
                                        </td>

                                        <td>
                                            {{ $session->charger->location->nama_lokasi ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $session->charger->kode_perangkat ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $session->waktu_mulai
                                                ? $session->waktu_mulai->format('d/m/Y H:i')
                                                : '-' }}
                                        </td>

                                        <td>
                                            {{ $session->waktu_selesai
                                                ? $session->waktu_selesai->format('d/m/Y H:i')
                                                : '-' }}
                                        </td>

                                        <td>
                                            {{ number_format((float) $session->energi_kwh, 2, ',', '.') }}
                                            kWh
                                        </td>

                                        <td>

                                            @if($session->status === 'selesai')

                                                <span class="status status-completed">
                                                    <span class="status-dot"></span>
                                                    Selesai
                                                </span>

                                            @elseif($session->status === 'gagal')

                                                <span class="status status-failed">
                                                    <span class="status-dot"></span>
                                                    Gagal
                                                </span>

                                            @else

                                                <span class="status status-cancelled">
                                                    <span class="status-dot"></span>
                                                    Dibatalkan
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    <!-- PAGINATION -->
                    <div class="pagination-wrapper">

                        <div class="pagination-info">

                            Menampilkan
                            {{ $historySessions->firstItem() ?? 0 }}
                            -
                            {{ $historySessions->lastItem() ?? 0 }}
                            dari
                            {{ $historySessions->total() }}
                            data

                        </div>

                        <div class="pagination">

                            {{ $historySessions->links() }}

                        </div>

                    </div>

                @else

                    <div class="empty-state">

                        <div class="empty-icon">📋</div>

                        <h4>Belum Ada Riwayat Charging</h4>

                        <p>
                            Riwayat sesi charging akan muncul di sini.
                        </p>

                    </div>

                @endif

            </div>

        </section>

    </main>

</div>


<!-- MODAL DETAIL -->
<div class="modal-overlay" id="detailModal">

    <div class="modal">

        <div class="modal-header">

            <h3>Detail Sesi Charging</h3>

            <button class="modal-close" onclick="closeDetail()">
                &times;
            </button>

        </div>

        <div class="modal-body">

            <div class="detail-row">
                <span class="detail-label">Nama Pengguna</span>
                <span class="detail-value" id="detailUser">-</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Kendaraan</span>
                <span class="detail-value" id="detailVehicle">-</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Charging Station</span>
                <span class="detail-value" id="detailStation">-</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Kode Charger</span>
                <span class="detail-value" id="detailCharger">-</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Tipe Konektor</span>
                <span class="detail-value" id="detailConnector">-</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Durasi Charging</span>
                <span class="detail-value" id="detailDuration">-</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Energi Digunakan</span>
                <span class="detail-value" id="detailEnergy">-</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Waktu Mulai</span>
                <span class="detail-value" id="detailStart">-</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Total Biaya Sementara</span>
                <span class="detail-value" id="detailCost">-</span>
            </div>

        </div>

    </div>

</div>


<script>

    // Refresh manual
    function refreshPage() {
        window.location.reload();
    }


    // Auto refresh setiap 30 detik
    const autoRefresh = document.getElementById('autoRefresh');

    if (localStorage.getItem('monitoringAutoRefresh') === 'true') {
        autoRefresh.checked = true;
    }

    let refreshInterval = null;

    function startAutoRefresh() {

        if (refreshInterval) {
            clearInterval(refreshInterval);
        }

        refreshInterval = setInterval(function() {
            window.location.reload();
        }, 30000);

    }

    function stopAutoRefresh() {

        if (refreshInterval) {
            clearInterval(refreshInterval);
            refreshInterval = null;
        }

    }

    if (autoRefresh.checked) {
        startAutoRefresh();
    }

    autoRefresh.addEventListener('change', function() {

        localStorage.setItem(
            'monitoringAutoRefresh',
            this.checked
        );

        if (this.checked) {
            startAutoRefresh();
        } else {
            stopAutoRefresh();
        }

    });


    // Menampilkan detail sesi
    function showDetail(button) {

        document.getElementById('detailUser').textContent =
            button.dataset.user;

        document.getElementById('detailVehicle').textContent =
            button.dataset.vehicle;

        document.getElementById('detailStation').textContent =
            button.dataset.station;

        document.getElementById('detailCharger').textContent =
            button.dataset.charger;

        document.getElementById('detailConnector').textContent =
            button.dataset.connector;

        document.getElementById('detailDuration').textContent =
            button.dataset.duration;

        document.getElementById('detailEnergy').textContent =
            button.dataset.energy;

        document.getElementById('detailStart').textContent =
            button.dataset.start;

        document.getElementById('detailCost').textContent =
            button.dataset.cost;

        document.getElementById('detailModal').classList.add('show');

    }


    // Menutup modal
    function closeDetail() {

        document.getElementById('detailModal').classList.remove('show');

    }


    // Menutup modal ketika klik area luar
    document.getElementById('detailModal').addEventListener('click', function(event) {

        if (event.target === this) {
            closeDetail();
        }

    });


    // Menutup modal dengan tombol ESC
    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {
            closeDetail();
        }

    });

</script>

</body>
</html>