<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Charging Station - EVChargeHub</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h2 {
            margin: 0;
        }

        .back {
            text-decoration: none;
            background: #6c757d;
            color: white;
            padding: 10px 16px;
            border-radius: 7px;
        }

        .search-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .form-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        input,
        select {
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 7px;
        }

        input {
            flex: 1;
            min-width: 250px;
        }

        button {
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            background: #198754;
            color: white;
            cursor: pointer;
        }

        .reset {
            padding: 11px 18px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .station-card {
            background: white;
            border-radius: 10px;
            padding: 22px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.07);
        }

        .station-card h3 {
            margin-top: 0;
        }

        .info {
            margin: 8px 0;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 13px;
            background: #e9ecef;
        }

        .charger-info {
            margin-top: 15px;
        }

        .btn-detail {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 7px;
        }

        .empty {
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>Charging Station</h2>

        <a href="{{ route('user.dashboard') }}" class="back">
            Kembali
        </a>
    </div>

    {{-- Pencarian dan Filter --}}
    <div class="search-box">

        <form method="GET" action="{{ route('stations.index') }}">

            <div class="form-row">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau alamat station..."
                >

                <select name="status">
                    <option value="">Semua Status</option>

                    <option value="aktif"
                        {{ request('status') == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="tutup"
                        {{ request('status') == 'tutup' ? 'selected' : '' }}>
                        Tutup
                    </option>

                    <option value="maintenance"
                        {{ request('status') == 'maintenance' ? 'selected' : '' }}>
                        Maintenance
                    </option>
                </select>

                <select name="tipe_konektor">

                    <option value="">Semua Konektor</option>

                    <option value="CCS2"
                        {{ request('tipe_konektor') == 'CCS2' ? 'selected' : '' }}>
                        CCS2
                    </option>

                    <option value="CHAdeMO"
                        {{ request('tipe_konektor') == 'CHAdeMO' ? 'selected' : '' }}>
                        CHAdeMO
                    </option>

                    <option value="Type 2"
                        {{ request('tipe_konektor') == 'Type 2' ? 'selected' : '' }}>
                        Type 2
                    </option>

                    <option value="GB/T"
                        {{ request('tipe_konektor') == 'GB/T' ? 'selected' : '' }}>
                        GB/T
                    </option>

                </select>

                <button type="submit">
                    Cari / Filter
                </button>

                <a href="{{ route('stations.index') }}" class="reset">
                    Reset
                </a>

            </div>

        </form>

    </div>

    {{-- Daftar Station --}}
    @forelse($stations as $station)

        <div class="station-card">

            <h3>{{ $station->nama_lokasi }}</h3>

            <div class="info">
                📍 {{ $station->alamat }}
            </div>

            <div class="info">
                🕐
                {{ $station->jam_buka ?? '-' }}
                -
                {{ $station->jam_tutup ?? '-' }}
            </div>

            <div class="info">
                Status:
                <span class="status">
                    {{ ucfirst($station->status) }}
                </span>
            </div>

            <div class="charger-info">

                <strong>Ketersediaan Charger:</strong>

                @php
                    $total = $station->chargers->count();
                    $tersedia = $station->chargers
                        ->where('status', 'tersedia')
                        ->count();
                @endphp

                {{ $tersedia }} tersedia dari {{ $total }} charger

            </div>

            <a
                href="{{ route('stations.show', $station->id_location) }}"
                class="btn-detail"
            >
                Lihat Detail
            </a>

        </div>

    @empty

        <div class="empty">
            <h3>Charging Station tidak ditemukan</h3>
            <p>Coba ubah kata pencarian atau filter.</p>
        </div>

    @endforelse

</div>

</body>
</html>