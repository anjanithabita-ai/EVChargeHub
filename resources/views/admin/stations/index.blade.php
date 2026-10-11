<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Charging Station - EVChargeHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f6;
            color: #263238;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #198754;
            color: white;
            padding: 25px 16px;
            overflow-y: auto;
        }

        .brand {
            padding: 0 12px 28px;
            border-bottom: 1px solid rgba(255,255,255,.2);
            margin-bottom: 25px;
        }

        .brand h2 {
            font-size: 23px;
            margin-bottom: 7px;
        }

        .brand p {
            font-size: 12px;
            opacity: .85;
        }

        .menu-title {
            padding: 0 12px;
            margin: 20px 0 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: .75;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 12px;
            margin-bottom: 5px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: .2s;
        }

        .menu-item:hover,
        .menu-item.active {
            background: rgba(255,255,255,.2);
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .main {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .topbar h1 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #718078;
            font-size: 14px;
        }

        .admin-label {
            background: white;
            border: 1px solid #e2e8e5;
            padding: 11px 16px;
            border-radius: 9px;
            font-size: 13px;
        }

        .panel {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
            margin-bottom: 24px;
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .panel-heading h2 {
            font-size: 18px;
            margin-bottom: 6px;
        }

        .panel-heading p {
            color: #718078;
            font-size: 13px;
        }

        .btn {
            display: inline-block;
            padding: 11px 15px;
            border: none;
            border-radius: 7px;
            background: #198754;
            color: white;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn:hover {
            background: #146c43;
        }

        .btn-secondary {
            background: #e9f5ee;
            color: #198754;
        }

        .btn-secondary:hover {
            background: #d8eee1;
        }

        .filters {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .filters input,
        .filters select {
            min-width: 180px;
            padding: 11px 12px;
            border: 1px solid #dce5e0;
            border-radius: 7px;
            outline: none;
            background: white;
            font-size: 13px;
        }

        .filters input:focus,
        .filters select:focus {
            border-color: #198754;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        thead {
            background: #f5f8f6;
        }

        th {
            padding: 14px 12px;
            text-align: left;
            font-size: 12px;
            color: #68776f;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #edf1ee;
            font-size: 13px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fafcfb;
        }

        .station-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .muted {
            color: #7c8982;
            font-size: 12px;
            line-height: 1.5;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status-aktif {
            background: #e1f6e9;
            color: #198754;
        }

        .status-tutup {
            background: #fff0d9;
            color: #a56700;
        }

        .status-maintenance {
            background: #fde8e7;
            color: #c0392b;
        }

        .actions {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .action-link {
            color: #198754;
            text-decoration: none;
            font-weight: bold;
            font-size: 12px;
        }

        .action-link:hover {
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 35px 15px;
            color: #718078;
        }

        .pagination-wrap {
            margin-top: 20px;
        }

        .footer-note {
            color: #89958e;
            font-size: 12px;
            text-align: center;
            padding: 15px 0;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                padding: 22px;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .topbar h1 {
                font-size: 23px;
            }

            .panel {
                padding: 17px;
            }

            .filters input,
            .filters select {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand">
            <h2>⚡ EVChargeHub</h2>
            <p>Admin Management Panel</p>
        </div>

        <div class="menu-title">Menu Utama</div>

        <a href="{{ route('admin.dashboard') }}" class="menu-item">
            <span class="menu-icon">📊</span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.stations.index') }}" class="menu-item active">
            <span class="menu-icon">📍</span>
            <span>Charging Station</span>
        </a>

        <a href="{{ route('admin.chargers.index') }}" class="menu-item">
            <span class="menu-icon">🔌</span>
            <span>Kelola Charger</span>
        </a>

        <a href="#" class="menu-item"
            onclick="alert('Fitur Tarif Charging belum tersedia.'); return false;">
            <span class="menu-icon">💰</span>
            <span>Tarif Charging</span>
        </a>

        <div class="menu-title">Akun</div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="menu-item"
                style="width:100%;border:0;background:transparent;color:white;text-align:left;cursor:pointer;font-size:14px;">
                <span class="menu-icon">🚪</span>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1>Kelola Charging Station</h1>
                <p class="subtitle">
                    Kelola informasi lokasi dan status charging station EVChargeHub.
                </p>
            </div>

            <div class="admin-label">
                👤 Administrator
            </div>
        </header>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2>Daftar Charging Station</h2>
                    <p>Informasi lokasi, status operasional, dan charger yang tersedia.</p>
                </div>

                <a href="{{ route('admin.stations.create') }}" class="btn">
                    + Tambah Station
                </a>
            </div>

            <div class="filters">
                <input
                    type="text"
                    id="searchStation"
                    placeholder="Cari nama atau alamat station..."
                    aria-label="Cari charging station">

                <select id="filterStatus" aria-label="Filter status station">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="tutup">Tutup</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>

            <div class="table-wrap">
                <table id="stationTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Station</th>
                            <th>Alamat</th>
                            <th>Tipe Konektor</th>
                            <th>Jumlah Charger</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($stations as $station)
                            @php
                                $status = strtolower($station->status ?? '');
                                $chargers = $station->chargers ?? collect();
                                $connectors = $chargers
                                    ->pluck('tipe_konektor')
                                    ->filter()
                                    ->unique()
                                    ->implode(', ');
                            @endphp

                            <tr class="station-row"
                                data-search="{{ strtolower(($station->nama_lokasi ?? '') . ' ' . ($station->alamat ?? '')) }}"
                                data-status="{{ $status }}">

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <div class="station-name">
                                        {{ $station->nama_lokasi }}
                                    </div>
                                    <div class="muted">
                                        ID: {{ $station->id_location }}
                                    </div>
                                </td>

                                <td>{{ $station->alamat ?: 'Alamat belum diisi' }}</td>

                                <td>
                                    {{ $connectors !== '' ? $connectors : 'Belum ada charger' }}
                                </td>

                                <td>{{ $chargers->count() }} unit</td>

                                <td>
                                    <span class="status status-{{ in_array($status, ['aktif', 'tutup', 'maintenance']) ? $status : 'tutup' }}">
                                        {{ ucfirst($station->status ?? 'Tidak diketahui') }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="{{ route('admin.stations.show', $station->id_location) }}"
                                            class="action-link">
                                            Detail
                                        </a>

                                        <a
                                            href="{{ route('admin.stations.edit', $station->id_location) }}"
                                            class="action-link">
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    Belum ada data charging station.
                                </td>
                            </tr>
                        @endforelse

                        <tr id="noSearchResult" style="display:none;">
                            <td colspan="7" class="empty-state">
                                Tidak ada charging station yang sesuai dengan pencarian.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if (method_exists($stations, 'links'))
                <div class="pagination-wrap">
                    {{ $stations->links('pagination::simple-default') }}
                </div>
            @endif
        </section>

        <div class="footer-note">
            EVChargeHub Admin Panel &copy; {{ date('Y') }}
        </div>
    </main>

    <script>
        const searchInput = document.getElementById('searchStation');
        const statusFilter = document.getElementById('filterStatus');
        const rows = document.querySelectorAll('.station-row');
        const noResult = document.getElementById('noSearchResult');

        function filterStations() {
            const keyword = searchInput.value.toLowerCase().trim();
            const selectedStatus = statusFilter.value;
            let visibleCount = 0;

            rows.forEach(function(row) {
                const searchText = row.dataset.search || '';
                const status = row.dataset.status || '';

                const matchesKeyword = searchText.includes(keyword);
                const matchesStatus = selectedStatus === '' || status === selectedStatus;
                const isVisible = matchesKeyword && matchesStatus;

                row.style.display = isVisible ? '' : 'none';

                if (isVisible) {
                    visibleCount++;
                }
            });

            if (noResult) {
                noResult.style.display = visibleCount === 0 ? '' : 'none';
            }
        }

        searchInput.addEventListener('input', filterStations);
        statusFilter.addEventListener('change', filterStations);
    </script>
</body>
</html>
