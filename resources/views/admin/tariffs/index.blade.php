<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tarif Charging - EVChargeHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f7fa;
            color: #333;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #198754;
            color: white;
            padding: 25px 18px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 35px;
            padding-left: 10px;
        }

        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            opacity: 0.7;
            margin: 22px 10px 10px;
            letter-spacing: 1px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            margin-bottom: 5px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu-item:hover,
        .menu-item.active {
            background: rgba(255,255,255,0.18);
        }

        .menu-icon {
            width: 22px;
            text-align: center;
        }

        /* ================= MAIN ================= */

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 75px;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 35px;
            border-bottom: 1px solid #e5e7eb;
        }

        .topbar h2 {
            font-size: 20px;
            color: #222;
        }

        .admin-info {
            font-size: 14px;
            color: #666;
        }

        .content {
            padding: 30px 35px;
        }

        /* ================= HEADER ================= */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 26px;
            margin-bottom: 6px;
        }

        .page-title p {
            color: #777;
            font-size: 14px;
        }

        .btn-add {
            background: #198754;
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-add:hover {
            background: #157347;
        }

        /* ================= FILTER ================= */

        .filter-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }

        .filter-form {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 7px;
            font-size: 14px;
            background: white;
        }

        .btn-filter {
            padding: 10px 18px;
            border: none;
            border-radius: 7px;
            background: #198754;
            color: white;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-reset {
            padding: 10px 18px;
            border-radius: 7px;
            background: #f1f3f5;
            color: #555;
            text-decoration: none;
            font-size: 14px;
        }

        /* ================= TABLE ================= */

        .table-card {
            background: white;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            overflow: hidden;
        }

        .table-header {
            padding: 18px 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .table-header h3 {
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8f9fa;
            padding: 14px 15px;
            text-align: left;
            font-size: 13px;
            color: #555;
            border-bottom: 1px solid #e9ecef;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fafafa;
        }

        /* ================= BADGE ================= */

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-active {
            background: #d1e7dd;
            color: #146c43;
        }

        .badge-inactive {
            background: #f8d7da;
            color: #842029;
        }

        /* ================= ACTION ================= */

        .action-group {
            display: flex;
            gap: 7px;
        }

        .btn-action {
            padding: 7px 10px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
        }

        .btn-edit {
            background: #e7f1ff;
            color: #0d6efd;
        }

        .btn-delete {
            background: #f8d7da;
            color: #dc3545;
            border: none;
            cursor: pointer;
        }

        /* ================= EMPTY ================= */

        .empty {
            text-align: center;
            padding: 45px 20px;
            color: #888;
        }

        .empty-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar">

        <div class="logo">
            ⚡ EVChargeHub
        </div>

        <div class="menu-title">
            Menu Utama
        </div>

        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <span class="menu-icon">📊</span>
            <span>Dashboard</span>
        </a>

        <div class="menu-title">
            Manajemen
        </div>

        <a href="#" class="menu-item">
            <span class="menu-icon">👥</span>
            <span>Kelola Pengguna</span>
        </a>

        <a href="#" class="menu-item">
            <span class="menu-icon">🏢</span>
            <span>Kelola Operator</span>
        </a>

        <a href="#" class="menu-item">
            <span class="menu-icon">📍</span>
            <span>Charging Station</span>
        </a>

        <a href="{{ route('admin.chargers.index') }}" class="menu-item">
            <span class="menu-icon">⚡</span>
            <span>Kelola Charger</span>
        </a>

        <div class="menu-title">
            Operasional
        </div>

        <a href="#" class="menu-item">
            <span class="menu-icon">🔋</span>
            <span>Monitoring Charging</span>
        </a>

        <div class="menu-title">
            Laporan & Transaksi
        </div>

        <a href="#" class="menu-item">
            <span class="menu-icon">📈</span>
            <span>Laporan</span>
        </a>

        <a href="#" class="menu-item active">
            <span class="menu-icon">💰</span>
            <span>Tarif Charging</span>
        </a>

        <a href="#" class="menu-item">
            <span class="menu-icon">↩️</span>
            <span>Refund Pembayaran</span>
        </a>

        <div class="menu-title">
            Komunikasi
        </div>

        <a href="#" class="menu-item">
            <span class="menu-icon">💬</span>
            <span>Ulasan & Feedback</span>
        </a>

        <a href="#" class="menu-item">
            <span class="menu-icon">🎁</span>
            <span>Promosi</span>
        </a>

        <div class="menu-title">
            Sistem
        </div>

        <a href="#" class="menu-item">
            <span class="menu-icon">🔐</span>
            <span>Hak Akses</span>
        </a>

        <a href="#" class="menu-item">
            <span class="menu-icon">📋</span>
            <span>Audit Log</span>
        </a>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
            @csrf

            <button type="submit"
                    class="menu-item"
                    style="width: 100%; border: none; background: transparent; cursor: pointer; text-align: left;">
                <span class="menu-icon">🚪</span>
                <span>Logout</span>
            </button>
        </form>

    </aside>


    <!-- ================= MAIN ================= -->

    <main class="main">

        <div class="topbar">
            <h2>Tarif Charging</h2>

            <div class="admin-info">
                Admin EVChargeHub
            </div>
        </div>


        <div class="content">

            <!-- HEADER -->

            <div class="page-header">

                <div class="page-title">
                    <h1>Tarif Charging</h1>

                    <p>
                        Kelola tarif pengisian daya kendaraan listrik
                    </p>
                </div>

                <a href="#" class="btn-add">
                    + Tambah Tarif
                </a>

            </div>


            <!-- FILTER -->

            <div class="filter-card">

                <form method="GET"
                      action="#"
                      class="filter-form">

                    <div class="search-box">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari charging station..."
                            value="{{ request('search') }}"
                        >
                    </div>

                    <select name="status" class="form-select" style="max-width: 180px;">
                        <option value="">Semua Status</option>

                        <option value="aktif"
                            {{ request('status') == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif"
                            {{ request('status') == 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>

                    <button type="submit" class="btn-filter">
                        Filter
                    </button>

                    <a href="#" class="btn-reset">
                        Reset
                    </a>

                </form>

            </div>


            <!-- TABLE -->

            <div class="table-card">

                <div class="table-header">
                    <h3>Daftar Tarif Charging</h3>
                </div>

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Charging Station</th>
                            <th>Harga / kWh</th>
                            <th>Biaya Minimum</th>
                            <th>Biaya Parkir</th>
                            <th>Berlaku Mulai</th>
                            <th>Berlaku Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($tariffs ?? [] as $tariff)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $tariff->location->nama_lokasi ?? '-' }}
                                    </strong>
                                </td>

                                <td>
                                    Rp {{ number_format($tariff->harga_per_kwh, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($tariff->biaya_minimum, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($tariff->biaya_parkir, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $tariff->berlaku_mulai ?? '-' }}
                                </td>

                                <td>
                                    {{ $tariff->berlaku_selesai ?? '-' }}
                                </td>

                                <td>

                                    @if($tariff->status == 'aktif')

                                        <span class="badge badge-active">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge badge-inactive">
                                            Nonaktif
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="action-group">

                                        <a href="#"
                                           class="btn-action btn-edit">
                                            Edit
                                        </a>

                                        <form action="#"
                                              method="POST"
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn-action btn-delete"
                                                    onclick="return confirm('Yakin ingin menghapus tarif ini?')">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9">

                                    <div class="empty">

                                        <div class="empty-icon">
                                            💰
                                        </div>

                                        <p>
                                            Belum ada data tarif charging.
                                        </p>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</body>
</html>