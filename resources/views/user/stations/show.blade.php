<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        {{ $station->nama_lokasi }} - EVChargeHub
    </title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        h2 {
            margin-top: 0;
        }

        .info {
            margin: 12px 0;
            line-height: 1.6;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #e9ecef;
            font-size: 14px;
        }

        .availability {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .availability-box {
            padding: 18px;
            border-radius: 10px;
            text-align: center;
            background: #f8f9fa;
        }

        .availability-box .number {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .charger {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 18px;
            margin-top: 15px;
        }

        .charger-title {
            font-size: 18px;
            font-weight: bold;
        }

        .charger-info {
            margin-top: 8px;
        }

        .available {
            color: #198754;
            font-weight: bold;
        }

        .used {
            color: #dc3545;
            font-weight: bold;
        }

        .offline {
            color: #6c757d;
            font-weight: bold;
        }

        .broken {
            color: #dc3545;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            display: inline-block;
        }

        .btn-back {
            background: #6c757d;
        }

        .btn-map {
            background: #198754;
        }

        .btn-select {
            background: #0d6efd;
            margin-top: 12px;
        }

        .map-container {
            margin-top: 15px;
        }

        .map-container iframe {
            width: 100%;
            height: 300px;
            border: 0;
            border-radius: 10px;
        }

        @media (max-width: 700px) {

            .availability {
                grid-template-columns: repeat(2, 1fr);
            }

        }

    </style>

</head>


<body>

<div class="container">


    {{-- ========================================= --}}
    {{-- 8. DETAIL CHARGING STATION --}}
    {{-- ========================================= --}}

    <div class="card">

        <h1>
            {{ $station->nama_lokasi }}
        </h1>

        <div class="info">

            <strong>Status Station:</strong>

            <span class="status">
                {{ ucfirst($station->status) }}
            </span>

        </div>


        <div class="info">

            <strong>Alamat:</strong>

            <br>

            {{ $station->alamat }}

        </div>


        <div class="info">

            <strong>Jam Operasional:</strong>

            <br>

            {{ $station->jam_buka ?? '-' }}

            -

            {{ $station->jam_tutup ?? '-' }}

        </div>


        <div class="info">

            <strong>Fasilitas:</strong>

            <br>

            {{ $station->fasilitas ?? 'Tidak ada informasi fasilitas.' }}

        </div>

    </div>



    {{-- ========================================= --}}
    {{-- 9. KETERSEDIAAN CHARGER --}}
    {{-- ========================================= --}}

    <div class="card">

        <h2>
            Ketersediaan Charger
        </h2>


        <div class="availability">


            <div class="availability-box">

                <div class="number">
                    {{ $totalCharger }}
                </div>

                Total Charger

            </div>


            <div class="availability-box">

                <div class="number available">
                    {{ $chargerTersedia }}
                </div>

                Tersedia

            </div>


            <div class="availability-box">

                <div class="number used">
                    {{ $chargerDigunakan }}
                </div>

                Digunakan

            </div>


            <div class="availability-box">

                <div class="number offline">
                    {{ $chargerOffline + $chargerRusak }}
                </div>

                Gangguan

            </div>

        </div>

    </div>



    {{-- ========================================= --}}
    {{-- DAFTAR CHARGER --}}
    {{-- ========================================= --}}

    <div class="card">

        <h2>
            Daftar Charger
        </h2>


        @forelse($station->chargers as $charger)

            <div class="charger">

                <div class="charger-title">

                    {{ $charger->kode_perangkat }}

                </div>


                <div class="charger-info">

                    <strong>
                        Tipe Konektor:
                    </strong>

                    {{ $charger->tipe_konektor }}

                </div>


                <div class="charger-info">

                    <strong>
                        Daya:
                    </strong>

                    {{ $charger->daya_kw }} kW

                </div>


                <div class="charger-info">

                    <strong>
                        Status:
                    </strong>

                    @if($charger->status === 'tersedia')

                        <span class="available">
                            Tersedia
                        </span>

                    @elseif($charger->status === 'digunakan')

                        <span class="used">
                            Sedang Digunakan
                        </span>

                    @elseif($charger->status === 'offline')

                        <span class="offline">
                            Offline
                        </span>

                    @else

                        <span class="broken">
                            Rusak
                        </span>

                    @endif

                </div>


            
               @if($charger->status === 'tersedia')

                <a
                    href="{{ route('charging.create', $charger->id_charger) }}"
                    class="btn btn-select"
                >
                    Pilih Charger
                </a>

                @endif

            </div>

        @empty

            <p>
                Belum ada charger di station ini.
            </p>

        @endforelse

    </div>



    {{-- ========================================= --}}
    {{-- 11. LOKASI CHARGING STATION --}}
    {{-- ========================================= --}}

    <div class="card">

        <h2>
            Lokasi Charging Station
        </h2>


        <div class="info">

            <strong>
                Alamat:
            </strong>

            <br>

            {{ $station->alamat }}

        </div>


        <div class="info">

            <strong>
                Latitude:
            </strong>

            {{ $station->latitude }}

        </div>


        <div class="info">

            <strong>
                Longitude:
            </strong>

            {{ $station->longitude }}

        </div>


        {{-- Tampilan peta --}}
        <div class="map-container">

            <iframe
                src="https://www.google.com/maps?q={{ $station->latitude }},{{ $station->longitude }}&output=embed"
                loading="lazy">
            </iframe>

        </div>

    </div>



    {{-- ========================================= --}}
    {{-- 12. NAVIGASI --}}
    {{-- ========================================= --}}

    <div class="card">

        <h2>
            Navigasi
        </h2>

        <p>
            Gunakan tombol berikut untuk mendapatkan
            petunjuk arah menuju charging station.
        </p>


        <div class="buttons">

            <a
                href="{{ route('stations.index') }}"
                class="btn btn-back"
            >
                ← Kembali
            </a>


            <a
                href="https://www.google.com/maps/dir/?api=1&destination={{ $station->latitude }},{{ $station->longitude }}"
                target="_blank"
                class="btn btn-map"
            >
                📍 Navigasi ke Station
            </a>

        </div>

    </div>


</div>

</body>

</html>