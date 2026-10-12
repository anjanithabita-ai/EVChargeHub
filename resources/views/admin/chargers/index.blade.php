
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Charger - EVChargeHub</title>

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

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR - SAMA DENGAN DASHBOARD */
        .sidebar {
            width: 250px;
            background: #00695c;
            color: white;
            min-height: 100vh;
            position: fixed;
            inset: 0 auto 0 0;
            overflow-y: auto;
            z-index: 100;
        }

        .brand {
            min-height: 86px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 20px;
            border-bottom: 1px solid rgba(255,255,255,.12);
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
            flex-shrink: 0;
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
            margin: 14px 12px 10px;
            text-transform: uppercase;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 13px;
            text-decoration: none;
            color: white;
            padding: 13px 14px;
            margin-bottom: 4px;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            transition: .2s;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.12);
        }

        .menu-item.active {
            background: #10aa79;
            font-weight: bold;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255,255,255,.15);
            margin: 20px 8px;
        }

        .logout {
            color: #ffe4e4;
            font-family: inherit;
            font-size: 14px;
        }

        .menu-item:focus-visible {
            outline: 3px solid #20d890;
            outline-offset: 3px;
        }

        /* MAIN DAN TOPBAR */
        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

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

        .content {
            padding: 30px 32px 50px;
        }

        /* HEADER HALAMAN */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 28px;
            color: #07594d;
            margin-bottom: 9px;
        }

        .page-header p {
            color: #718681;
            font-size: 14px;
            line-height: 1.7;
        }

        .page-label {
            display: inline-block;
            background: #a9efd5;
            color: #075c4e;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 12px;
        }

        /* TOMBOL */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border: 0;
            border-radius: 9px;
            padding: 11px 15px;
            text-decoration: none;
            font-family: inherit;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: .2s;
            white-space: nowrap;
        }

        .btn-primary,
        .btn-add {
            background: #00896e;
            color: white;
        }

        .btn-primary:hover,
        .btn-add:hover {
            background: #00695c;
        }

        .btn-light {
            background: white;
            color: #36534d;
            border: 1px solid #dce4e1;
        }

        .btn-light:hover {
            background: #f0faf6;
            border-color: #bdebd9;
        }

        /* FILTER */
        .filter-card {
            background: white;
            border: 1px solid #e4eeeb;
            border-radius: 17px;
            padding: 21px;
            margin-bottom: 25px;
            box-shadow: 0 5px 18px rgba(0,0,0,.04);
        }

        .filter-heading {
            font-size: 16px;
            font-weight: bold;
            color: #124d43;
            margin-bottom: 17px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: minmax(160px, 2fr) minmax(140px, 1fr) minmax(130px, 1fr) auto;
            gap: 12px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 0;
        }

        .form-group label {
            font-size: 12px;
            font-weight: bold;
            color: #4f625d;
        }

        .form-control {
            width: 100%;
            height: 43px;
            padding: 0 12px;
            border: 1px solid #d9e4e0;
            border-radius: 9px;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            background: white;
            color: #163b35;
        }

        .form-control:focus {
            border-color: #10aa79;
            box-shadow: 0 0 0 3px rgba(16,170,121,.12);
        }

        .filter-actions {
            display: flex;
            gap: 8px;
        }

        /* TABEL */
        .table-card {
            background: white;
            border: 1px solid #e4eeeb;
            border-radius: 17px;
            overflow: hidden;
            box-shadow: 0 5px 18px rgba(0,0,0,.04);
        }

        .table-header {
            padding: 21px 22px;
            border-bottom: 1px solid #edf0ef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .table-header h3 {
            font-size: 17px;
            color: #124d43;
        }

        .table-count {
            font-size: 12px;
            color: #718681;
            font-weight: normal;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f7fbfa;
        }

        th {
            padding: 14px 18px;
            text-align: left;
            font-size: 12px;
            color: #6d8580;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        td {
            padding: 16px 18px;
            border-top: 1px solid #edf0ef;
            font-size: 13px;
            color: #465b55;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #fafdfc;
        }

        .charger-code {
            font-weight: bold;
            color: #00896e;
        }

        .station-name {
            font-weight: bold;
            color: #16483f;
        }

        /* STATUS CHARGER */
        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
        }

        .status-tersedia {
            background: #e1f8ed;
            color: #18794e;
        }

        .status-tersedia .status-dot {
            background: #20a464;
        }

        .status-digunakan {
            background: #e1efff;
            color: #1565c0;
        }

        .status-digunakan .status-dot {
            background: #1e88e5;
        }

        .status-offline {
            background: #f1f4f3;
            color: #616e69;
        }

        .status-offline .status-dot {
            background: #757575;
        }

        .status-rusak {
            background: #ffebee;
            color: #b42318;
        }

        .status-rusak .status-dot {
            background: #e53935;
        }

        /* DATA KOSONG */
        .empty-state {
            text-align: center;
            padding: 55px 20px;
            color: #718681;
        }

        .empty-icon {
            font-size: 44px;
            margin-bottom: 13px;
        }

        .empty-state h3 {
            color: #124d43;
            margin-bottom: 9px;
            font-size: 19px;
        }

        .empty-state p {
            font-size: 13px;
            line-height: 1.7;
        }

        .alert {
            padding: 14px 17px;
            border-radius: 10px;
            margin-bottom: 20px;
            background: #e8f5e9;
            color: #256b32;
            border: 1px solid #c8e6c9;
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .filter-form {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .content {
                padding-left: 24px;
                padding-right: 24px;
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .topbar {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media (max-width: 600px) {
            .layout {
                display: block;
            }

            .sidebar {
                position: relative;
                width: 100%;
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

            .content {
                padding: 20px 16px 35px;
            }

            .topbar {
                min-height: 68px;
                padding: 14px 18px;
            }

            .page-title {
                font-size: 19px;
            }

            .admin-name {
                display: none;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                width: 100%;
            }

            .filter-actions .btn {
                flex: 1;
            }

            .filter-card {
                padding: 17px;
            }

            .page-header h1 {
                font-size: 24px;
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
                <span class="menu-icon">🏠</span>
                <span>Dashboard</span>
            </a>

            <div class="menu-title">Manajemen</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">👥</span>
                <span>Kelola Pengguna</span>
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">👨‍💼</span>
                <span>Kelola Operator</span>
            </a>

            <a href="{{ route('admin.charging-stations.index') }}"
               class="menu-item">
                <span class="menu-icon">📍</span>
                <span>Charging Station</span>
            </a>

            <a href="{{ route('admin.chargers.index') }}"
               class="menu-item active"
               aria-current="page">
                <span class="menu-icon">🔌</span>
                <span>Kelola Charger</span>
            </a>

            <div class="menu-title">Operasional</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">⚡</span>
                <span>Monitoring Charging</span>
            </a>

            <div class="menu-title">Laporan & Transaksi</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">📊</span>
                <span>Laporan</span>
            </a>

            <a href="{{ route('admin.charging-stations.index') }}"
               class="menu-item">
                <span class="menu-icon">💰</span>
                <span>Tarif per Station</span>
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">💳</span>
                <span>Refund Pembayaran</span>
            </a>

            <div class="menu-title">Komunikasi</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">⭐</span>
                <span>Ulasan & Feedback</span>
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">🎁</span>
                <span>Promosi</span>
            </a>

            <div class="menu-title">Sistem</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">🔐</span>
                <span>Hak Akses</span>
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">🛡️</span>
                <span>Audit Log</span>
            </a>

            <div class="sidebar-divider"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="menu-item logout"
                    style="width:100%;background:transparent;border:none;cursor:pointer;text-align:left;"
                >
                    <span class="menu-icon">🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="main">
        <header class="topbar">
            <div class="page-title">Kelola Charger</div>

            <div class="admin-profile">
                <div class="notification">🔔</div>
                <div class="profile-icon">👤</div>
                <div class="admin-name">
                    {{ auth()->user()->nama ?? auth()->user()->name ?? 'Admin' }}
                </div>
            </div>
        </header>

        <section class="content">

            @if(session('success'))
                <div class="alert">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="page-header">
                <div>
                    <span class="page-label">🔌 Manajemen Perangkat</span>
                    <h1>Kelola Charger</h1>
                    <p>
                        Kelola dan pantau seluruh perangkat charger
                        yang terhubung ke charging station.
                    </p>
                </div>

                <a href="#" class="btn btn-add">
                    ＋ Tambah Charger
                </a>
            </div>

            <!-- FILTER CHARGER -->
            <div class="filter-card">
                <div class="filter-heading">🔎 Cari dan Filter Charger</div>

                <form action="{{ route('admin.chargers.index') }}"
                      method="GET"
                      class="filter-form">

                    <div class="form-group">
                        <label for="search">Cari Charger</label>
                        <input
                            type="text"
                            id="search"
                            name="search"
                            class="form-control"
                            placeholder="Cari berdasarkan kode charger..."
                            value="{{ request('search') }}"
                        >
                    </div>

                    <div class="form-group">
                        <label for="location">Charging Station</label>
                        <select id="location" name="location" class="form-control">
                            <option value="">Semua Station</option>

                            @foreach($locations as $location)
                                <option
                                    value="{{ $location->id_location }}"
                                    {{ request('location') == $location->id_location ? 'selected' : '' }}
                                >
                                    {{ $location->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status Charger</label>
                        <select id="status" name="status" class="form-control">
                            <option value="">Semua Status</option>

                            <option value="tersedia"
                                {{ request('status') == 'tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>

                            <option value="digunakan"
                                {{ request('status') == 'digunakan' ? 'selected' : '' }}>
                                Digunakan
                            </option>

                            <option value="offline"
                                {{ request('status') == 'offline' ? 'selected' : '' }}>
                                Offline
                            </option>

                            <option value="rusak"
                                {{ request('status') == 'rusak' ? 'selected' : '' }}>
                                Rusak
                            </option>
                        </select>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">
                            Filter
                        </button>

                        <a href="{{ route('admin.chargers.index') }}"
                           class="btn btn-light">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- TABEL CHARGER -->
            <div class="table-card">
                <div class="table-header">
                    <h3>
                        Daftar Charger
                        <span class="table-count">
                            ({{ $chargers->count() }} charger)
                        </span>
                    </h3>
                </div>

                <div class="table-wrapper">
                    @if($chargers->count() > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Charger</th>
                                    <th>Charging Station</th>
                                    <th>Tipe Konektor</th>
                                    <th>Daya</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($chargers as $index => $charger)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td>
                                            <span class="charger-code">
                                                {{ $charger->kode_perangkat }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="station-name">
                                                {{ $charger->location->nama_lokasi ?? 'Tidak diketahui' }}
                                            </span>
                                        </td>

                                        <td>{{ $charger->tipe_konektor }}</td>
                                        <td>{{ $charger->daya_kw }} kW</td>

                                        <td>
                                            @php
                                                $statusClass = match ($charger->status) {
                                                    'tersedia' => 'status-tersedia',
                                                    'digunakan' => 'status-digunakan',
                                                    'offline' => 'status-offline',
                                                    'rusak' => 'status-rusak',
                                                    default => 'status-offline',
                                                };
                                            @endphp

                                            <span class="status {{ $statusClass }}">
                                                <span class="status-dot"></span>
                                                {{ ucfirst($charger->status) }}
                                            </span>
                                        </td>

                                        <td>
                                            <span style="color:#718681;font-size:12px;">
                                                Segera tersedia
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">🔌</div>
                            <h3>Belum Ada Charger</h3>
                            <p>
                                Data charger belum tersedia atau tidak sesuai
                                dengan filter pencarian.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

        </section>
    </main>
</div>
</body>
</html>
