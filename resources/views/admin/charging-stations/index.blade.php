
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charging Station - EVChargeHub</title>

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

        /* SIDEBAR: disamakan dengan Dashboard Admin */
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
            transition: .2s;
            font-family: inherit;
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

        /* KONTEN */
        .content {
            padding: 30px 32px 50px;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 27px;
            color: #07594d;
            margin-bottom: 8px;
        }

        .muted {
            color: #718681;
            font-size: 13px;
            line-height: 1.6;
        }

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

        .btn-primary {
            background: #00896e;
            color: white;
        }

        .btn-primary:hover {
            background: #00695c;
        }

        .btn-light {
            background: white;
            color: #36534d;
            border: 1px solid #dce4e1;
        }

        .btn-light:hover {
            background: #f0f8f5;
        }

        .filters,
        .station-card,
        .empty {
            background: white;
            border: 1px solid #e4eeeb;
            border-radius: 17px;
            box-shadow: 0 5px 18px rgba(0,0,0,.04);
        }

        .filters {
            padding: 20px;
            margin-bottom: 24px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(150px, 1fr) auto auto;
            gap: 12px;
            align-items: end;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 7px;
            min-width: 0;
        }

        .field label {
            font-size: 12px;
            font-weight: bold;
            color: #4f625d;
        }

        .control {
            width: 100%;
            height: 42px;
            border: 1px solid #d9e3df;
            border-radius: 9px;
            padding: 0 12px;
            background: white;
            color: #263b37;
            font-family: inherit;
            font-size: 13px;
            outline: none;
        }

        .control:focus {
            border-color: #10aa79;
            box-shadow: 0 0 0 3px rgba(16,170,121,.10);
        }

        .alert {
            padding: 13px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            background: #e8f5e9;
            color: #256b32;
            border: 1px solid #c8e6c9;
            font-size: 13px;
        }

        .station-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .station-card {
            padding: 22px;
            min-width: 0;
        }

        .station-title {
            display: flex;
            gap: 13px;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .pin {
            width: 46px;
            height: 46px;
            flex-shrink: 0;
            background: #e1f8ef;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .station-title h3 {
            font-size: 17px;
            color: #16483f;
            margin: 3px 0 7px;
            overflow-wrap: anywhere;
        }

        .address {
            font-size: 13px;
            color: #73817d;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 17px 0;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #f2f7f5;
            border: 1px solid #e6efeb;
            border-radius: 20px;
            padding: 7px 10px;
            font-size: 12px;
            color: #465b55;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .aktif {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .tutup {
            background: #fff4e5;
            color: #9a5b00;
        }

        .maintenance {
            background: #ffebee;
            color: #b42318;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            border-top: 1px solid #edf0ef;
            padding-top: 17px;
            margin-top: 17px;
        }

        .empty {
            padding: 50px 20px;
            text-align: center;
        }

        .empty-icon {
            font-size: 42px;
            margin-bottom: 14px;
        }

        .empty h3 {
            color: #16483f;
            margin-bottom: 9px;
            font-size: 19px;
        }

        .empty p {
            color: #718681;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .pagination {
            margin-top: 22px;
            overflow-x: auto;
        }

        .pagination nav p {
            font-size: 13px;
            color: #718681;
        }

        .menu-item:focus-visible,
        .btn:focus-visible {
            outline: 3px solid #20d890;
            outline-offset: 3px;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .station-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding-left: 24px;
                padding-right: 24px;
            }

            .filter-form {
                grid-template-columns: minmax(0, 2fr) minmax(150px, 1fr);
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .topbar {
                padding-left: 20px;
                padding-right: 20px;
            }

            .content {
                padding: 24px 20px 35px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
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
                max-height: 360px;
            }

            .sidebar-content {
                padding-top: 12px;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                min-height: 68px;
                padding: 14px 18px;
            }

            .content {
                padding: 20px 16px 35px;
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

            .page-heading h1 {
                font-size: 24px;
            }

            .station-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

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
               class="menu-item active"
               aria-current="page">
                <span class="menu-icon">📍</span>
                <span>Charging Station</span>
            </a>

            <a href="{{ route('admin.chargers.index') }}" class="menu-item">
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

    <main class="main">
        <header class="topbar">
            <div class="page-title">Charging Station</div>

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
                    {{ session('success') }}
                </div>
            @endif

            <div class="page-heading">
                <div>
                    <h1>📍 Charging Station</h1>
                    <p class="muted">
                        Kelola lokasi, status station, perangkat charger,
                        dan tarif charging EVChargeHub.
                    </p>
                </div>

                <a class="btn btn-primary"
                   href="{{ route('admin.charging-stations.create') }}">
                    ＋ Tambah Station
                </a>
            </div>

            <div class="filters">
                <form class="filter-form"
                      method="GET"
                      action="{{ route('admin.charging-stations.index') }}">

                    <div class="field">
                        <label for="search">Cari Station</label>
                        <input
                            class="control"
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama atau alamat station..."
                        >
                    </div>

                    <div class="field">
                        <label for="status">Status Station</label>
                        <select class="control" id="status" name="status">
                            <option value="">Semua Status</option>

                            @foreach([
                                'aktif' => 'Aktif',
                                'tutup' => 'Tutup',
                                'maintenance' => 'Maintenance'
                            ] as $value => $label)
                                <option
                                    value="{{ $value }}"
                                    @selected(request('status') === $value)
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit">
                        🔍 Filter
                    </button>

                    <a class="btn btn-light"
                       href="{{ route('admin.charging-stations.index') }}">
                        Reset
                    </a>
                </form>
            </div>

            @if($locations->count())
                <div class="station-grid">

                    @foreach($locations as $station)
                        @php($tariff = $station->tariffs->first())

                        <article class="station-card">
                            <div class="station-title">
                                <div class="pin">📍</div>

                                <div>
                                    <h3>{{ $station->nama_lokasi }}</h3>
                                    <p class="address">{{ $station->alamat }}</p>
                                </div>
                            </div>

                            <div class="chips">
                                <span class="status {{ $station->status }}">
                                    @if($station->status === 'aktif')
                                        ●
                                    @elseif($station->status === 'tutup')
                                        ●
                                    @else
                                        ●
                                    @endif
                                    {{ ucfirst($station->status) }}
                                </span>

                                <span class="chip">
                                    🕐
                                    @if(
                                        substr((string) $station->jam_buka, 0, 5) === '00:00'
                                        && in_array(substr((string) $station->jam_tutup, 0, 8), ['23:59:59', '23:59'])
                                    )
                                        Buka 24 jam
                                    @elseif($station->jam_buka && $station->jam_tutup)
                                        {{ substr($station->jam_buka, 0, 5) }}
                                        –
                                        {{ substr($station->jam_tutup, 0, 5) }}
                                    @else
                                        Jam belum diatur
                                    @endif
                                </span>

                                <span class="chip">
                                    🔌 {{ $station->chargers_count }} Charger
                                </span>

                                <span class="chip">
                                    💰
                                    @if($tariff)
                                        Rp{{ number_format((float) $tariff->harga_per_kwh, 0, ',', '.') }}
                                    @else
                                        Tarif belum diatur
                                    @endif
                                    / kWh
                                </span>
                            </div>

                            @if($station->fasilitas)
                                <p class="muted" style="margin-top:12px;">
                                    <strong>Fasilitas:</strong>
                                    {{ $station->fasilitas }}
                                </p>
                            @endif

                            <div class="actions">
                                <a class="btn btn-primary"
                                   href="{{ route('admin.charging-stations.show', $station->id_location) }}">
                                    Lihat Detail →
                                </a>

                                <a class="btn btn-light"
                                   href="{{ route('admin.charging-stations.edit', $station->id_location) }}">
                                    ✏️ Edit
                                </a>
                            </div>
                        </article>
                    @endforeach

                </div>

                <div class="pagination">
                    {{ $locations->links() }}
                </div>

            @else
                <div class="empty">
                    <div class="empty-icon">📍</div>

                    <h3>Belum ada charging station</h3>

                    <p>
                        Data station belum tersedia atau tidak ditemukan
                        berdasarkan pencarian dan filter yang dipilih.
                    </p>

                    <a class="btn btn-primary"
                       href="{{ route('admin.charging-stations.create') }}">
                        ＋ Tambah Station
                    </a>
                </div>
            @endif

        </section>
    </main>
</div>
</body>
</html>
