<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarif per Station | EVChargeHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --sidebar: #00695c;
            --primary: #10aa79;
            --primary-dark: #00896e;
            --page-bg: #f4f8f7;
            --white: #ffffff;
            --text: #163b35;
            --muted: #718681;
            --border: #e4eeeb;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--page-bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* =========================================
           SIDEBAR
        ========================================= */

        .sidebar {
            width: 220px;
            min-width: 220px;
            height: 100vh;
            background: var(--sidebar);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 100;
        }

        .brand {
            min-height: 83px;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0 18px;
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .brand-logo {
            width: 44px;
            height: 44px;
            min-width: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #20d890;
            font-size: 23px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: bold;
            white-space: nowrap;
        }

        .sidebar-content {
            padding: 12px 0 20px;
        }

        .menu-section {
            padding: 20px 20px 8px;
            color: #9bd4c9;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 45px;
            margin: 3px 10px;
            padding: 12px 13px;
            border-radius: 10px;
            color: rgba(255,255,255,.96);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: background .2s, color .2s;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.12);
        }

        .menu-item.active {
            background: var(--primary);
            color: white;
            font-weight: bold;
        }

        .menu-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 22px;
            min-width: 22px;
            font-size: 17px;
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255,255,255,.15);
            margin: 18px 18px;
        }

        .logout {
            width: calc(100% - 20px);
            border: none;
            background: transparent;
            cursor: pointer;
            font-family: inherit;
            text-align: left;
        }

        .menu-item:focus-visible {
            outline: 3px solid #20d890;
            outline-offset: 2px;
        }

        /* =========================================
           MAIN CONTENT
           Lebar sidebar desktop konsisten 220px
        ========================================= */

        .main {
            margin-left: 220px;
            width: calc(100% - 220px);
            min-height: 100vh;
            min-width: 0;
        }

        .topbar {
            height: 76px;
            padding: 0 32px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .topbar-title {
            font-size: 20px;
            font-weight: bold;
            color: #123f37;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .top-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: #e6faf2;
            font-size: 18px;
        }

        .admin-label {
            font-size: 12px;
            font-weight: bold;
            color: #16483f;
            white-space: nowrap;
        }

        .page-content {
            padding: 28px 32px 45px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            margin-bottom: 24px;
        }

        .page-heading h1 {
            color: #07594d;
            font-size: 26px;
            margin-bottom: 8px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .page-label {
            display: inline-block;
            margin-bottom: 10px;
            padding: 7px 12px;
            border-radius: 20px;
            background: #d9f7e8;
            color: #08764e;
            font-size: 11px;
            font-weight: bold;
        }

        /* =========================================
           BUTTON
        ========================================= */

        .btn {
            border: none;
            border-radius: 9px;
            padding: 11px 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            text-decoration: none;
            font-family: inherit;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: background .2s, border-color .2s;
            white-space: nowrap;
        }

        .btn-primary {
            color: white;
            background: var(--primary-dark);
        }

        .btn-primary:hover {
            background: var(--sidebar);
        }

        .btn-light {
            color: #176b59;
            background: #e2f4eb;
            border: 1px solid #d4e9df;
        }

        .btn-light:hover {
            background: #d2eddf;
        }

        .btn-edit {
            display: inline-block;
            padding: 9px 13px;
            border-radius: 8px;
            color: #08765c;
            background: #e0f4e9;
            text-decoration: none;
            font-size: 11px;
            font-weight: bold;
            transition: background .2s;
        }

        .btn-edit:hover {
            background: #ccebd9;
        }

        /* =========================================
           ALERT
        ========================================= */

        .alert {
            padding: 14px 17px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
            line-height: 1.6;
        }

        .alert-success {
            background: #ddf8e9;
            color: #08764e;
            border: 1px solid #c4efd8;
        }

        .alert-error {
            background: #fff0ef;
            color: #a72d2d;
            border: 1px solid #f7d4d1;
        }

        /* =========================================
           CARD DAN FILTER
        ========================================= */

        .content-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 5px 18px rgba(0,0,0,.035);
        }

        .filter-title {
            color: #124d43;
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .filter-form {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .form-control,
        .filter-form select {
            height: 42px;
            padding: 0 12px;
            border: 1px solid #dce8e3;
            border-radius: 8px;
            background: white;
            color: var(--text);
            font-family: inherit;
            font-size: 12px;
            outline: none;
        }

        .form-control:focus,
        .filter-form select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(16,170,121,.10);
        }

        .search-input {
            flex: 1;
            min-width: 100px;
            width: 100%;
        }

        .filter-form select {
            min-width: 135px;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
        }

        /* =========================================
           TABLE
        ========================================= */

        .table-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 15px;
        }

        .table-heading h3 {
            color: #124d43;
            font-size: 16px;
        }

        .table-count {
            color: var(--muted);
            font-size: 12px;
            font-weight: normal;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        thead {
            background: #edf7f2;
        }

        th {
            padding: 14px 12px;
            color: #365d54;
            font-size: 11px;
            font-weight: bold;
            text-align: left;
            white-space: nowrap;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #e8efec;
            color: #203d37;
            font-size: 12px;
            vertical-align: middle;
        }

        tbody tr {
            transition: background .15s;
        }

        tbody tr:hover {
            background: #f7fbf9;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .station-name {
            display: block;
            color: #153d36;
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .station-address {
            color: #7a8e87;
            font-size: 11px;
            line-height: 1.5;
            max-width: 260px;
            white-space: normal;
        }

        .price {
            font-weight: 600;
            white-space: nowrap;
        }

        .period {
            white-space: nowrap;
            line-height: 1.6;
        }

        .period small {
            display: block;
            color: var(--muted);
            font-size: 10px;
        }

        .status {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status-active {
            color: #08764e;
            background: #d9f7e8;
        }

        .status-inactive {
            color: #9a5b16;
            background: #fff0d8;
        }

        .action-cell {
            white-space: nowrap;
        }

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: var(--muted);
            line-height: 1.8;
            font-size: 13px;
        }

        .empty-icon {
            display: block;
            font-size: 36px;
            margin-bottom: 12px;
        }

        .empty-state strong {
            display: inline-block;
            color: #124d43;
            margin-bottom: 5px;
            font-size: 15px;
        }

        /* =========================================
           PAGINATION
        ========================================= */

        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 20px;
            flex-wrap: wrap;
            font-size: 12px;
            color: var(--muted);
        }

        .pagination-wrapper nav p {
            margin-bottom: 8px;
        }

        .pagination-wrapper nav a,
        .pagination-wrapper nav span {
            font-size: 12px;
        }

        /* =========================================
           RESPONSIVE
           Sidebar tetap 220px sampai 650px
        ========================================= */

        @media (max-width: 1000px) {
            .sidebar {
                width: 220px;
                min-width: 220px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .page-content {
                padding: 24px 20px 35px;
            }

            .topbar {
                padding: 0 20px;
            }

            .content-card {
                padding: 17px;
            }

            .page-heading {
                align-items: flex-start;
            }

            .filter-form {
                flex-wrap: wrap;
            }

            .search-input {
                flex-basis: 100%;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                width: 72px;
                min-width: 72px;
            }

            .brand {
                justify-content: center;
                padding: 15px 5px;
            }

            .brand-logo {
                width: 42px;
                min-width: 42px;
                height: 42px;
            }

            .brand-name,
            .menu-section,
            .menu-item span:not(.menu-icon) {
                display: none;
            }

            .menu-item {
                justify-content: center;
                margin: 5px 7px;
                padding: 13px 5px;
            }

            .menu-icon {
                font-size: 19px;
            }

            .main {
                margin-left: 72px;
                width: calc(100% - 72px);
            }

            .topbar {
                height: 68px;
                padding: 0 14px;
            }

            .topbar-title {
                font-size: 16px;
            }

            .admin-info {
                gap: 7px;
            }

            .top-icon {
                width: 34px;
                min-width: 34px;
                height: 34px;
                font-size: 15px;
            }

            .admin-label {
                display: none;
            }

            .page-content {
                padding: 20px 12px 30px;
            }

            .page-heading {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .content-card {
                padding: 13px;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .search-input,
            .filter-form select {
                width: 100%;
                flex-basis: auto;
            }

            .filter-actions {
                display: flex;
            }

            .filter-actions .btn {
                flex: 1;
            }

            .table-heading h3 {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-logo">⚡</div>
            <div class="brand-name">EVChargeHub</div>
        </div>

        <nav class="sidebar-content">

            <div class="menu-section">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <span class="menu-icon">🏠</span>
                <span>Dashboard</span>
            </a>

            <div class="menu-section">Manajemen</div>

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
               class="menu-item">
                <span class="menu-icon">🔌</span>
                <span>Kelola Charger</span>
            </a>

            <div class="menu-section">Operasional</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">⚡</span>
                <span>Monitoring Charging</span>
            </a>

            <div class="menu-section">Laporan & Transaksi</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">📊</span>
                <span>Laporan</span>
            </a>

            {{-- MENU AKTIF UNTUK HALAMAN TARIF --}}
            <a href="{{ route('admin.tariffs.index') }}"
               class="menu-item active"
               aria-current="page">
                <span class="menu-icon">💰</span>
                <span>Tarif per Station</span>
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">💳</span>
                <span>Refund Pembayaran</span>
            </a>

            <div class="menu-section">Komunikasi</div>

            <a href="#" class="menu-item">
                <span class="menu-icon">⭐</span>
                <span>Ulasan & Feedback</span>
            </a>

            <a href="#" class="menu-item">
                <span class="menu-icon">🎁</span>
                <span>Promosi</span>
            </a>

            <div class="menu-section">Sistem</div>

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

                <button type="submit" class="menu-item logout">
                    <span class="menu-icon">🚪</span>
                    <span>Logout</span>
                </button>
            </form>

        </nav>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="main">

        <header class="topbar">

            <div class="topbar-title">
                Tarif per Station
            </div>

            <div class="admin-info">
                <div class="top-icon">🔔</div>
                <div class="top-icon">👤</div>

                <span class="admin-label">
                    {{ auth()->user()->nama ?? auth()->user()->name ?? 'Admin EVChargeHub' }}
                </span>
            </div>

        </header>

        <section class="page-content">

            {{-- HEADER HALAMAN --}}
            <div class="page-heading">

                <div>
                    <span class="page-label">💰 Manajemen Tarif</span>

                    <h1>Tarif per Station</h1>

                    <p>
                        Kelola harga charging berdasarkan lokasi station,
                        biaya minimum, dan biaya parkir.
                    </p>
                </div>

                <a href="{{ route('admin.tariffs.create') }}"
                   class="btn btn-primary">
                    <span>＋</span>
                    Tambah Tarif
                </a>

            </div>

            {{-- PESAN SUKSES --}}
            @if (session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            {{-- PESAN ERROR --}}
            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Terjadi kesalahan:</strong>

                    <ul style="margin: 8px 0 0 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- KARTU DATA TARIF --}}
            <div class="content-card">

                <div class="filter-title">
                    🔎 Cari dan Filter Tarif
                </div>

                {{-- FORM PENCARIAN DAN FILTER --}}
                <form action="{{ route('admin.tariffs.index') }}"
                      method="GET"
                      class="filter-form">

                    <input
                        type="text"
                        name="search"
                        class="form-control search-input"
                        placeholder="Cari nama charging station..."
                        value="{{ request('search') }}"
                        aria-label="Cari charging station"
                    >

                    <select name="status" aria-label="Filter status">
                        <option value="">Semua Status</option>

                        <option value="aktif"
                            {{ request('status') === 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif"
                            {{ request('status') === 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">
                            Cari
                        </button>

                        <a href="{{ route('admin.tariffs.index') }}"
                           class="btn btn-light">
                            Reset
                        </a>
                    </div>

                </form>

                {{-- JUDUL TABEL --}}
                <div class="table-heading">
                    <h3>
                        Daftar Tarif
                        @if (isset($tariffs))
                            <span class="table-count">
                                ({{ $tariffs->total() }} data)
                            </span>
                        @endif
                    </h3>
                </div>

                {{-- TABEL TARIF --}}
                <div class="table-wrapper">

                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Charging Station</th>
                                <th>Harga per kWh</th>
                                <th>Biaya Minimum</th>
                                <th>Biaya Parkir</th>
                                <th>Masa Berlaku</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($tariffs as $tariff)

                                <tr>
                                    <td>
                                        {{ $tariffs->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <span class="station-name">
                                            {{ $tariff->location->nama_lokasi ?? 'Lokasi tidak tersedia' }}
                                        </span>

                                        <div class="station-address">
                                            {{ $tariff->location->alamat ?? '-' }}
                                        </div>
                                    </td>

                                    <td class="price">
                                        Rp {{ number_format((float) $tariff->harga_per_kwh, 0, ',', '.') }}
                                    </td>

                                    <td class="price">
                                        Rp {{ number_format((float) $tariff->biaya_minimum, 0, ',', '.') }}
                                    </td>

                                    <td class="price">
                                        Rp {{ number_format((float) $tariff->biaya_parkir, 0, ',', '.') }}
                                    </td>

                                    <td class="period">
                                        {{ $tariff->berlaku_mulai
                                            ? \Illuminate\Support\Carbon::parse($tariff->berlaku_mulai)->format('d/m/Y')
                                            : '-' }}

                                        <small>
                                            s.d.
                                            {{ $tariff->berlaku_selesai
                                                ? \Illuminate\Support\Carbon::parse($tariff->berlaku_selesai)->format('d/m/Y')
                                                : 'Tidak ditentukan' }}
                                        </small>
                                    </td>

                                    <td>
                                        @if ($tariff->status === 'aktif')
                                            <span class="status status-active">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="status status-inactive">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>

                                    <td class="action-cell">
                                        <a
                                            href="{{ route('admin.tariffs.edit', $tariff->id_tariff) }}"
                                            class="btn-edit">
                                            Edit
                                        </a>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8">
                                        <div class="empty-state">
                                            <span class="empty-icon">📋</span>

                                            <strong>Belum ada data tarif</strong>

                                            <br>

                                            Data tarif tidak ditemukan.
                                            Coba ubah kata pencarian atau tambahkan tarif baru.

                                            <br><br>

                                            <a href="{{ route('admin.tariffs.create') }}"
                                               class="btn btn-primary">
                                                ＋ Tambah Tarif
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>

                {{-- PAGINATION --}}
                @if (method_exists($tariffs, 'links'))
                    <div class="pagination-wrapper">

                        <div>
                            @if ($tariffs->total() > 0)
                                Menampilkan {{ $tariffs->firstItem() }}
                                sampai {{ $tariffs->lastItem() }}
                                dari {{ $tariffs->total() }} data tarif
                            @else
                                Belum ada data tarif
                            @endif
                        </div>

                        <div>
                            {{ $tariffs->appends(request()->query())->links() }}
                        </div>

                    </div>
                @endif

            </div>

        </section>
    </main>

</body>
</html>