
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Charging Station - EVChargeHub</title>

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

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 225px;
            background: #00695c;
            color: white;
            padding: 25px 16px;
        }

        .brand {
            font-size: 21px;
            font-weight: bold;
            margin: 0 10px 34px;
        }

        .menu-title {
            font-size: 11px;
            color: #b2dfdb;
            font-weight: bold;
            margin: 22px 10px 10px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin: 4px 0;
        }

        .menu a, .logout {
            display: block;
            padding: 11px 12px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
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
            justify-content: space-between;
            align-items: center;
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
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #e0f2f1;
            color: #00695c;
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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 22px;
        }

        h1 {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .muted {
            font-size: 13px;
            color: #71807c;
            line-height: 1.6;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 14px;
            border-radius: 7px;
            border: 0;
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
            border: 1px solid #dce4e1;
            color: #36534d;
        }

        .panel {
            background: white;
            padding: 23px;
            border-radius: 12px;
            box-shadow: 0 2px 8px #163b3510;
            margin-bottom: 22px;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .panel-heading h2 {
            font-size: 18px;
        }

        .station-summary {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 25px;
        }

        .station-name {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 22px;
        }

        .station-icon {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            background: #e4f4f0;
            border-radius: 12px;
            font-size: 25px;
            flex-shrink: 0;
        }

        .station-name h2 {
            font-size: 20px;
            margin: 4px 0 8px;
        }

        .status {
            display: inline-block;
            border-radius: 20px;
            padding: 6px 10px;
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

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-item label {
            display: block;
            color: #71807c;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .info-item p {
            font-size: 14px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .map-placeholder {
            min-height: 180px;
            height: 100%;
            border-radius: 10px;
            background: #edf5f1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            color: #45645a;
        }

        .map-placeholder .pin {
            font-size: 35px;
            margin-bottom: 12px;
        }

        .charger-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .charger-card {
            border: 1px solid #e2e9e6;
            border-radius: 10px;
            padding: 17px;
        }

        .charger-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 15px;
        }

        .charger-top h3 {
            font-size: 15px;
            margin-bottom: 6px;
        }

        .charger-icon {
            font-size: 23px;
            margin-bottom: 8px;
        }

        .charger-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .charger-info label {
            display: block;
            font-size: 11px;
            color: #71807c;
            margin-bottom: 5px;
        }

        .charger-info p {
            font-size: 13px;
            font-weight: bold;
        }

        .tersedia {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .digunakan {
            background: #e3f2fd;
            color: #1565c0;
        }

        .offline, .rusak {
            background: #ffebee;
            color: #b42318;
        }

        .tariff-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
        }

        .tariff-item {
            background: #f5f8f7;
            border-radius: 9px;
            padding: 17px;
        }

        .tariff-item label {
            display: block;
            font-size: 12px;
            color: #71807c;
            margin-bottom: 10px;
        }

        .tariff-item strong {
            font-size: 19px;
            color: #00695c;
        }

        .empty {
            text-align: center;
            padding: 30px 15px;
            background: #f7faf9;
            border-radius: 9px;
            color: #71807c;
            font-size: 13px;
            line-height: 1.8;
        }

        .footer-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 10px;
        }

        @media (max-width: 950px) {
            .station-summary {
                grid-template-columns: 1fr;
            }

            .charger-grid {
                grid-template-columns: 1fr;
            }

            .tariff-grid {
                grid-template-columns: 1fr;
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
                padding: 18px;
            }

            .page-header {
                flex-direction: column;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 0 18px;
            }
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
                        style="width:100%;background:transparent;border:0;text-align:left;cursor:pointer">
                    🚪 Logout
                </button>
            </form>
        </li>
    </ul>
</aside>

<main class="main">
    <header class="topbar">
        <h2>Detail Charging Station</h2>

        <div class="profile">
            <div class="avatar">A</div>
            <span>{{ auth()->user()->nama ?? 'Administrator' }}</span>
        </div>
    </header>

    <section class="content">

        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            /
            <a href="{{ route('admin.charging-stations.index') }}">
                Charging Station
            </a>
            / Detail
        </div>

        <div class="page-header">
            <div>
                <h1>{{ $station->nama_lokasi }}</h1>
                <p class="muted">
                    Detail lokasi, perangkat charger, dan tarif charging.
                </p>
            </div>

            <a class="btn btn-light"
               href="{{ route('admin.charging-stations.index') }}">
                ← Kembali
            </a>
        </div>

        {{-- INFORMASI STATION --}}
        <section class="panel">
            <div class="panel-heading">
                <h2>Informasi Station</h2>

                <a class="btn btn-primary"
                   href="{{ route('admin.charging-stations.edit', $station->id_location) }}">
                    ✎ Edit Station
                </a>
            </div>

            <div class="station-summary">
                <div>
                    <div class="station-name">
                        <div class="station-icon">📍</div>

                        <div>
                            <h2>{{ $station->nama_lokasi }}</h2>

                            <span class="status {{ $station->status }}">
                                {{ ucfirst($station->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <label>Alamat</label>
                            <p>{{ $station->alamat }}</p>
                        </div>

                        <div class="info-item">
                            <label>Jam Operasional</label>
                            <p>
                                @if($station->jam_buka === '00:00:00'
                                    && $station->jam_tutup === '23:59:59')
                                    Buka 24 jam
                                @elseif($station->jam_buka && $station->jam_tutup)
                                    {{ substr($station->jam_buka, 0, 5) }}
                                    –
                                    {{ substr($station->jam_tutup, 0, 5) }}
                                @else
                                    Belum diatur
                                @endif
                            </p>
                        </div>

                        <div class="info-item">
                            <label>Latitude</label>
                            <p>{{ $station->latitude ?? '-' }}</p>
                        </div>

                        <div class="info-item">
                            <label>Longitude</label>
                            <p>{{ $station->longitude ?? '-' }}</p>
                        </div>

                        <div class="info-item">
                            <label>Total Charger</label>
                            <p>{{ $station->chargers->count() }} perangkat</p>
                        </div>

                        <div class="info-item">
                            <label>Fasilitas</label>
                            <p>{{ $station->fasilitas ?: 'Belum ada informasi fasilitas.' }}</p>
                        </div>
                    </div>
                </div>

                <div class="map-placeholder">
                    <div class="pin">📍</div>

                    <strong>Lokasi Charging Station</strong>

                    <p class="muted" style="margin-top:10px">
                        {{ $station->alamat }}
                    </p>

                    @if($station->latitude && $station->longitude)
                        <a class="btn btn-primary"
                           style="margin-top:15px"
                           target="_blank"
                           rel="noopener noreferrer"
                           href="https://www.google.com/maps?q={{ $station->latitude }},{{ $station->longitude }}">
                            Buka Google Maps
                        </a>
                    @endif
                </div>
            </div>
        </section>

        {{-- DATA CHARGER --}}
        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2>Data Charger</h2>
                    <p class="muted" style="margin-top:7px">
                        Daftar perangkat charger pada station ini.
                    </p>
                </div>

                <a class="btn btn-light"
                   href="{{ route('admin.chargers.index') }}">
                    Kelola Charger
                </a>
            </div>

            @if($station->chargers->count())
                <div class="charger-grid">
                    @foreach($station->chargers as $charger)
                        <article class="charger-card">
                            <div class="charger-top">
                                <div>
                                    <div class="charger-icon">⚡</div>

                                    <h3>{{ $charger->kode_perangkat }}</h3>

                                    <p class="muted">
                                        {{ $charger->tipe_konektor }}
                                    </p>
                                </div>

                                <span class="status {{ $charger->status }}">
                                    {{ ucfirst($charger->status) }}
                                </span>
                            </div>

                            <div class="charger-info">
                                <div>
                                    <label>Tipe Konektor</label>
                                    <p>{{ $charger->tipe_konektor }}</p>
                                </div>

                                <div>
                                    <label>Daya Charger</label>
                                    <p>{{ $charger->daya_kw }} kW</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty">
                    <strong>Belum ada charger di station ini.</strong>
                    <p>Tambahkan perangkat melalui menu Kelola Charger.</p>
                    <a class="btn btn-primary"
                       style="margin-top:12px"
                       href="{{ route('admin.chargers.index') }}">
                        Buka Kelola Charger
                    </a>
                </div>
            @endif
        </section>

        {{-- INFORMASI TARIF --}}
        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2>Tarif Charging</h2>
                    <p class="muted" style="margin-top:7px">
                        Informasi tarif yang tersimpan untuk station ini.
                    </p>
                </div>
            </div>

            @php
                $activeTariff = $station->tariffs
                    ->where('status', 'aktif')
                    ->sortByDesc('berlaku_mulai')
                    ->first();
            @endphp

            @if($activeTariff)
                <div class="tariff-grid">
                    <div class="tariff-item">
                        <label>Harga per kWh</label>
                        <strong>
                            Rp{{ number_format((float) $activeTariff->harga_per_kwh, 0, ',', '.') }}
                        </strong>
                    </div>

                    <div class="tariff-item">
                        <label>Biaya Minimum</label>
                        <strong>
                            Rp{{ number_format((float) $activeTariff->biaya_minimum, 0, ',', '.') }}
                        </strong>
                    </div>

                    <div class="tariff-item">
                        <label>Biaya Parkir</label>
                        <strong>
                            Rp{{ number_format((float) $activeTariff->biaya_parkir, 0, ',', '.') }}
                        </strong>
                    </div>
                </div>

                <p class="muted" style="margin-top:17px">
                    Berlaku mulai:
                    {{ $activeTariff->berlaku_mulai ?: '-' }}
                </p>
            @else
                <div class="empty">
                    <strong>Belum ada tarif aktif.</strong>
                    <p>Periksa pengaturan tarif untuk station ini.</p>
                </div>
            @endif
        </section>

        <div class="footer-actions">
            <a class="btn btn-light"
               href="{{ route('admin.charging-stations.index') }}">
                Kembali ke Daftar
            </a>

            <a class="btn btn-primary"
               href="{{ route('admin.charging-stations.edit', $station->id_location) }}">
                Edit Station
            </a>
        </div>

    </section>
</main>

</body>
</html>
