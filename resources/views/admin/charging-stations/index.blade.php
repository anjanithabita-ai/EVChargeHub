
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Charging Station - EVChargeHub</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f6;
            color: #263b37;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 225px;
            background: #00695c;
            color: white;
            padding: 25px 16px;
            overflow-y: auto;
        }

        .brand {
            font-size: 21px;
            font-weight: bold;
            padding: 0 10px;
            margin-bottom: 34px;
        }

        .menu-title {
            font-size: 11px;
            font-weight: bold;
            color: #b2dfdb;
            margin: 22px 10px 10px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .menu { list-style: none; }

        .menu li { margin: 4px 0; }

        .menu a, .logout {
            display: flex;
            gap: 11px;
            align-items: center;
            padding: 11px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            font-size: 13px;
        }

        .menu a:hover, .menu a.active {
            background: rgba(255,255,255,.16);
        }

        .main {
            margin-left: 225px;
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

        .topbar h2 { font-size: 18px; }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .avatar {
            border-radius: 50%;
            background: #e0f2f1;
            color: #00695c;
            width: 35px;
            height: 35px;
            display: grid;
            place-items: center;
            font-weight: bold;
        }

        .content { padding: 30px; }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
        }

        .header h1 {
            font-size: 26px;
            margin-bottom: 7px;
        }

        .muted {
            color: #71807c;
            font-size: 13px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 7px;
            padding: 11px 15px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-primary {
            background: #00695c;
            color: white;
        }

        .btn-light {
            background: white;
            color: #36534d;
            border: 1px solid #dce4e1;
        }

        .filters, .panel, .station-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px #163b3510;
            margin-bottom: 20px;
        }

        .filters { padding: 18px; }

        .filter-form {
            display: grid;
            grid-template-columns: 2fr 1fr auto auto;
            gap: 12px;
            align-items: end;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .field label {
            font-size: 12px;
            font-weight: bold;
            color: #4f625d;
        }

        .control {
            width: 100%;
            height: 41px;
            border: 1px solid #d9e0de;
            border-radius: 7px;
            padding: 0 11px;
            background: white;
            font-size: 13px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 18px;
            background: #e8f5e9;
            color: #256b32;
            font-size: 13px;
        }

        .station-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .station-card {
            padding: 21px;
            margin: 0;
        }

        .station-title {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 14px;
        }

        .pin {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            background: #e4f4f0;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 21px;
        }

        .station-title h3 {
            font-size: 17px;
            margin: 2px 0 6px;
        }

        .address {
            font-size: 13px;
            color: #73817d;
            line-height: 1.5;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 16px 0;
        }

        .chip {
            background: #f2f6f4;
            border-radius: 20px;
            padding: 7px 10px;
            font-size: 12px;
            color: #465b55;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
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
            gap: 8px;
            border-top: 1px solid #edf0ef;
            padding-top: 15px;
            margin-top: 15px;
        }

        .empty {
            padding: 45px 20px;
            text-align: center;
            color: #74817d;
            background: white;
            border-radius: 12px;
        }

        .pagination { padding: 15px; }

        @media (max-width: 1000px) {
            .station-grid { grid-template-columns: 1fr; }
            .filter-form { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 650px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .content { padding: 18px; }
            .header {
                align-items: flex-start;
                flex-direction: column;
            }
            .filter-form { grid-template-columns: 1fr; }
            .topbar { padding: 0 18px; }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">⚡ EVChargeHub</div>

    <div class="menu-title">Menu Utama</div>
    <ul class="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">▦ Dashboard</a>
        </li>
    </ul>

    <div class="menu-title">Manajemen</div>
    <ul class="menu">
        <li><a href="#">👥 Kelola Pengguna</a></li>
        <li><a href="#">🧑‍💼 Kelola Operator</a></li>
        <li>
            <a class="active"
               href="{{ route('admin.charging-stations.index') }}">
                📍 Charging Station
            </a>
        </li>
        <li>
            <a href="{{ route('admin.chargers.index') }}">⚡ Kelola Charger</a>
        </li>
    </ul>

    <div class="menu-title">Operasional</div>
    <ul class="menu">
        <li><a href="#">📊 Monitoring Charging</a></li>
    </ul>

    <div class="menu-title">Laporan & Transaksi</div>
    <ul class="menu">
        <li><a href="#">📄 Laporan</a></li>
        <li>
            <a href="{{ route('admin.charging-stations.index') }}">
                💰 Tarif Charging
            </a>
        </li>
        <li><a href="#">↩️ Refund Pembayaran</a></li>
    </ul>

    <div class="menu-title">Sistem</div>
    <ul class="menu">
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout" type="submit"
                        style="width:100%;background:transparent;border:0;cursor:pointer">
                    🚪 Logout
                </button>
            </form>
        </li>
    </ul>
</aside>

<main class="main">
    <header class="topbar">
        <h2>Charging Station</h2>

        <div class="profile">
            <div class="avatar">A</div>
            <span>{{ auth()->user()->nama ?? 'Administrator' }}</span>
        </div>
    </header>

    <section class="content">

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="header">
            <div>
                <h1>Charging Station</h1>
                <p class="muted">
                    Kelola lokasi dan perangkat charging EVChargeHub.
                </p>
            </div>

            <a class="btn btn-primary"
               href="{{ route('admin.charging-stations.create') }}">
                ＋ Tambah Station
            </a>
        </div>

        <div class="filters">
            <form class="filter-form" method="GET"
                  action="{{ route('admin.charging-stations.index') }}">

                <div class="field">
                    <label for="search">Cari Station</label>
                    <input class="control"
                           id="search"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama atau alamat station...">
                </div>

                <div class="field">
                    <label for="status">Status</label>
                    <select class="control" id="status" name="status">
                        <option value="">Semua Status</option>

                        @foreach([
                            'aktif' => 'Aktif',
                            'tutup' => 'Tutup',
                            'maintenance' => 'Maintenance'
                        ] as $value => $label)
                            <option value="{{ $value }}"
                                @selected(request('status') === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary" type="submit">
                    Filter
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
                                {{ ucfirst($station->status) }}
                            </span>

                            <span class="chip">
                                🕐
                                @if($station->jam_buka === '00:00:00'
                                    && $station->jam_tutup === '23:59:59')
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

                        <div class="actions">
                            <a class="btn btn-primary"
                               href="{{ route('admin.charging-stations.show', $station->id_location) }}">
                                Detail
                            </a>

                            <a class="btn btn-light"
                               href="{{ route('admin.charging-stations.edit', $station->id_location) }}">
                                Edit
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
                <h3>Belum ada charging station</h3>

                <p style="margin:8px 0 17px">
                    Tambahkan station untuk mulai mengelola charger dan tarif.
                </p>

                <a class="btn btn-primary"
                   href="{{ route('admin.charging-stations.create') }}">
                    ＋ Tambah Station
                </a>
            </div>
        @endif

    </section>
</main>

</body>
</html>
