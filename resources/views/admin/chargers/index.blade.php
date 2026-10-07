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
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f6;
            color: #333;
        }

        /* =========================
           SIDEBAR
        ========================= */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #00695c;
            color: white;
            padding: 25px 18px;
            overflow-y: auto;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 35px;
            padding: 0 12px;
        }

        .menu-title {
            font-size: 11px;
            font-weight: bold;
            color: #b2dfdb;
            margin: 22px 12px 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255, 255, 255, 0.15);
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* =========================
           MAIN CONTENT
        ========================= */
        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .topbar h2 {
            font-size: 20px;
            color: #333;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #555;
        }

        .profile-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e0f2f1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #00695c;
            font-weight: bold;
        }

        /* CONTENT */
        .content {
            padding: 35px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 27px;
            color: #222;
            margin-bottom: 7px;
        }

        .page-header p {
            color: #777;
            font-size: 14px;
        }

        /* BUTTON */
        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #00695c;
            color: white;
            text-decoration: none;
            padding: 11px 17px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-add:hover {
            background: #00564d;
        }

        /* FILTER CARD */
        .filter-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 22px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .filter-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group label {
            font-size: 12px;
            font-weight: bold;
            color: #555;
        }

        .form-control {
            height: 42px;
            padding: 0 12px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-size: 13px;
            outline: none;
            background: white;
        }

        .form-control:focus {
            border-color: #00695c;
        }

        .btn-filter {
            height: 42px;
            padding: 0 18px;
            border: none;
            border-radius: 7px;
            background: #00695c;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-reset {
            height: 42px;
            padding: 0 18px;
            border: 1px solid #ddd;
            border-radius: 7px;
            background: white;
            color: #555;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        /* TABLE */
        .table-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .table-header {
            padding: 20px 22px;
            border-bottom: 1px solid #eee;
        }

        .table-header h3 {
            font-size: 17px;
            color: #333;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8faf9;
        }

        th {
            padding: 14px 18px;
            text-align: left;
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            white-space: nowrap;
        }

        td {
            padding: 16px 18px;
            border-top: 1px solid #eee;
            font-size: 14px;
            color: #444;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #fafdfc;
        }

        .charger-code {
            font-weight: bold;
            color: #00695c;
        }

        .station-name {
            font-weight: 600;
            color: #333;
        }

        /* STATUS */
        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
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
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-tersedia .status-dot {
            background: #43a047;
        }

        .status-digunakan {
            background: #e3f2fd;
            color: #1565c0;
        }

        .status-digunakan .status-dot {
            background: #1e88e5;
        }

        .status-offline {
            background: #f5f5f5;
            color: #616161;
        }

        .status-offline .status-dot {
            background: #757575;
        }

        .status-rusak {
            background: #ffebee;
            color: #c62828;
        }

        .status-rusak .status-dot {
            background: #e53935;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 55px 20px;
            color: #888;
        }

        .empty-icon {
            font-size: 40px;
            margin-bottom: 12px;
        }

        .empty-state h3 {
            color: #555;
            margin-bottom: 7px;
        }

        .empty-state p {
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
            }

            .filter-form {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
            }

            .content {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 0 20px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         SIDEBAR
    ========================== -->
    <aside class="sidebar">

        <div class="brand">
            ⚡ EVChargeHub
        </div>

        <div class="menu-title">
            Menu Utama
        </div>

        <ul class="menu">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <span class="menu-icon">▦</span>
                    Dashboard
                </a>
            </li>
        </ul>

        <div class="menu-title">
            Manajemen
        </div>

        <ul class="menu">
            <li>
                <a href="#">
                    <span class="menu-icon">👥</span>
                    Kelola Pengguna
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">🧑‍💼</span>
                    Kelola Operator
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">📍</span>
                    Charging Station
                </a>
            </li>

            <li>
                <a href="{{ route('admin.chargers.index') }}" class="active">
                    <span class="menu-icon">⚡</span>
                    Kelola Charger
                </a>
            </li>
        </ul>

        <div class="menu-title">
            Operasional
        </div>

        <ul class="menu">
            <li>
                <a href="#">
                    <span class="menu-icon">📊</span>
                    Monitoring Charging
                </a>
            </li>
        </ul>

        <div class="menu-title">
            Laporan & Transaksi
        </div>

        <ul class="menu">
            <li>
                <a href="#">
                    <span class="menu-icon">📄</span>
                    Laporan
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">💰</span>
                    Tarif Charging
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">↩️</span>
                    Refund Pembayaran
                </a>
            </li>
        </ul>

        <div class="menu-title">
            Komunikasi
        </div>

        <ul class="menu">
            <li>
                <a href="#">
                    <span class="menu-icon">💬</span>
                    Ulasan & Feedback
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">📢</span>
                    Promosi
                </a>
            </li>
        </ul>

        <div class="menu-title">
            Sistem
        </div>

        <ul class="menu">
            <li>
                <a href="#">
                    <span class="menu-icon">🔐</span>
                    Hak Akses
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="menu-icon">📝</span>
                    Audit Log
                </a>
            </li>

            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                            style="
                                width: 100%;
                                border: none;
                                background: transparent;
                                color: white;
                                display: flex;
                                align-items: center;
                                gap: 12px;
                                padding: 11px 12px;
                                border-radius: 8px;
                                font-size: 14px;
                                cursor: pointer;
                                text-align: left;
                            ">
                        <span class="menu-icon">🚪</span>
                        Logout
                    </button>
                </form>
            </li>
        </ul>

    </aside>


    <!-- =========================
         MAIN
    ========================== -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <h2>Kelola Charger</h2>

            <div class="admin-profile">
                <div class="profile-icon">
                    A
                </div>

                <span>
                    {{ auth()->user()->nama ?? 'Administrator' }}
                </span>
            </div>

        </header>


        <!-- CONTENT -->
        <section class="content">

            <!-- PAGE HEADER -->
            <div class="page-header">

                <div>
                    <h1>Kelola Charger</h1>

                    <p>
                        Kelola dan pantau seluruh perangkat charger pada charging station.
                    </p>
                </div>

                <a href="#" class="btn-add">
                    ＋ Tambah Charger
                </a>

            </div>


            <!-- FILTER -->
            <div class="filter-card">

                <form action="{{ route('admin.chargers.index') }}"
                      method="GET"
                      class="filter-form">

                    <!-- SEARCH -->
                    <div class="form-group">

                        <label for="search">
                            Cari Charger
                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            class="form-control"
                            placeholder="Cari berdasarkan kode charger..."
                            value="{{ request('search') }}"
                        >

                    </div>


                    <!-- LOCATION -->
                    <div class="form-group">

                        <label for="location">
                            Charging Station
                        </label>

                        <select
                            id="location"
                            name="location"
                            class="form-control"
                        >

                            <option value="">
                                Semua Station
                            </option>

                            @foreach ($locations as $location)

                                <option
                                    value="{{ $location->id_location }}"
                                    {{ request('location') == $location->id_location ? 'selected' : '' }}
                                >
                                    {{ $location->nama_lokasi }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- STATUS -->
                    <div class="form-group">

                        <label for="status">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-control"
                        >

                            <option value="">
                                Semua Status
                            </option>

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


                    <!-- BUTTON -->
                    <div style="display: flex; gap: 8px;">

                        <button type="submit" class="btn-filter">
                            Filter
                        </button>

                        <a
                            href="{{ route('admin.chargers.index') }}"
                            class="btn-reset"
                        >
                            Reset
                        </a>

                    </div>

                </form>

            </div>


            <!-- TABLE -->
            <div class="table-card">

                <div class="table-header">

                    <h3>
                        Daftar Charger
                        <span style="
                            color: #888;
                            font-size: 13px;
                            font-weight: normal;
                        ">
                            ({{ $chargers->count() }} charger)
                        </span>
                    </h3>

                </div>


                <div class="table-wrapper">

                    @if ($chargers->count() > 0)

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

                                @foreach ($chargers as $index => $charger)

                                    <tr>

                                        <td>
                                            {{ $index + 1 }}
                                        </td>

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

                                        <td>
                                            {{ $charger->tipe_konektor }}
                                        </td>

                                        <td>
                                            {{ $charger->daya_kw }} kW
                                        </td>

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

                                            <span style="
                                                color: #999;
                                                font-size: 12px;
                                            ">
                                                Segera tersedia
                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    @else

                        <div class="empty-state">

                            <div class="empty-icon">
                                ⚡
                            </div>

                            <h3>
                                Belum ada charger
                            </h3>

                            <p>
                                Data charger belum tersedia atau tidak sesuai dengan filter.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </section>

    </main>

</body>
</html>