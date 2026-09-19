<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Monitor Charging - EVChargeHub</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }

        .container {
            max-width: 750px;
            margin: 40px auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
        }

        .status {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            background: #d1e7dd;
            color: #0f5132;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .info {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            line-height: 1.5;
        }

        .info:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
        }

        .cost {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .buttons form {
            margin: 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        /* Hentikan Charging */
        .btn-stop {
            background: #198754;
        }

        .btn-stop:hover {
            background: #157347;
        }

        /* Batalkan Charging */
        .btn-cancel {
            background: #dc3545;
        }

        .btn-cancel:hover {
            background: #bb2d3b;
        }

        /* Bayar Sekarang */
        .btn-payment {
            background: #0d6efd;
        }

        .btn-payment:hover {
            background: #0b5ed7;
        }

        /* Kembali */
        .btn-back {
            background: #6c757d;
        }

        .btn-back:hover {
            background: #5c636a;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>
            Monitor Charging
        </h1>


        {{-- ========================================= --}}
        {{-- PESAN BERHASIL --}}
        {{-- ========================================= --}}

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- ========================================= --}}
        {{-- PESAN ERROR --}}
        {{-- ========================================= --}}

        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
            </div>

        @endif


        {{-- ========================================= --}}
        {{-- STATUS CHARGING --}}
        {{-- ========================================= --}}

        <div>

            @if($session->status === 'berlangsung')

                <span class="status">
                    Charging Berlangsung
                </span>

            @elseif($session->status === 'selesai')

                <span class="status">
                    Charging Selesai
                </span>

            @elseif($session->status === 'dibatalkan')

                <span class="status">
                    Charging Dibatalkan
                </span>

            @elseif($session->status === 'gagal')

                <span class="status">
                    Charging Gagal
                </span>

            @endif

        </div>


        {{-- ========================================= --}}
        {{-- INFORMASI CHARGER --}}
        {{-- ========================================= --}}

        <div class="info">

            <span class="label">
                Kode Charger:
            </span>

            {{ $session->charger->kode_perangkat }}

        </div>


        <div class="info">

            <span class="label">
                Tipe Konektor:
            </span>

            {{ $session->charger->tipe_konektor }}

        </div>


        <div class="info">

            <span class="label">
                Daya Charger:
            </span>

            {{ $session->charger->daya_kw }} kW

        </div>


        {{-- ========================================= --}}
        {{-- INFORMASI KENDARAAN --}}
        {{-- ========================================= --}}

        <div class="info">

            <span class="label">
                Kendaraan:
            </span>

            {{ $session->vehicle->merek }}
            {{ $session->vehicle->model }}

        </div>


        <div class="info">

            <span class="label">
                Nomor Polisi:
            </span>

            {{ $session->vehicle->nomor_polisi }}

        </div>


        {{-- ========================================= --}}
        {{-- WAKTU MULAI --}}
        {{-- ========================================= --}}

        <div class="info">

            <span class="label">
                Waktu Mulai:
            </span>

            {{ $session->waktu_mulai->format('d-m-Y H:i:s') }}

        </div>


        {{-- ========================================= --}}
        {{-- WAKTU SELESAI --}}
        {{-- ========================================= --}}

        @if($session->waktu_selesai)

            <div class="info">

                <span class="label">
                    Waktu Selesai:
                </span>

                {{ $session->waktu_selesai->format('d-m-Y H:i:s') }}

            </div>

        @endif


        {{-- ========================================= --}}
        {{-- DURASI --}}
        {{-- ========================================= --}}

        <div class="info">

            <span class="label">
                Durasi:
            </span>

            {{ $session->durasi_menit }} menit

        </div>


        {{-- ========================================= --}}
        {{-- ENERGI --}}
        {{-- ========================================= --}}

        <div class="info">

            <span class="label">
                Energi:
            </span>

            {{ $session->energi_kwh }} kWh

        </div>


        {{-- ========================================= --}}
        {{-- TARIF --}}
        {{-- ========================================= --}}

        <div class="info">

            <span class="label">
                Tarif:
            </span>

            Rp {{ number_format(
                $session->tariff->harga_per_kwh,
                0,
                ',',
                '.'
            ) }}/kWh

        </div>


        {{-- ========================================= --}}
        {{-- TOTAL BIAYA --}}
        {{-- ========================================= --}}

        <div class="info">

            <span class="label">
                Total Biaya:
            </span>

            <div class="cost">

                Rp {{ number_format(
                    $session->total_biaya,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

        </div>


        {{-- ========================================= --}}
        {{-- TOMBOL --}}
        {{-- ========================================= --}}

        <div class="buttons">


            {{-- ===================================== --}}
            {{-- JIKA CHARGING MASIH BERLANGSUNG --}}
            {{-- ===================================== --}}

            @if($session->status === 'berlangsung')


                {{-- Hentikan Charging --}}

                <form
                    action="{{ route(
                        'charging.stop',
                        $session->id_session
                    ) }}"
                    method="POST"
                    onsubmit="return confirm(
                        'Apakah Anda yakin ingin menghentikan charging?'
                    );"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-stop"
                    >
                        Hentikan Charging
                    </button>

                </form>


                {{-- Batalkan Charging --}}

                <form
                    action="{{ route(
                        'charging.cancel',
                        $session->id_session
                    ) }}"
                    method="POST"
                    onsubmit="return confirm(
                        'Apakah Anda yakin ingin membatalkan sesi charging?'
                    );"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-cancel"
                    >
                        Batalkan Charging
                    </button>

                </form>

            @endif


            {{-- ===================================== --}}
            {{-- JIKA CHARGING SUDAH SELESAI --}}
            {{-- ===================================== --}}

            @if($session->status === 'selesai')

                <a
                    href="{{ route(
                        'payment.create',
                        $session->id_session
                    ) }}"
                    class="btn btn-payment"
                >
                    💳 Bayar Sekarang
                </a>

            @endif


            {{-- ===================================== --}}
            {{-- KEMBALI KE STATION --}}
            {{-- ===================================== --}}

            <a
                href="{{ route('stations.index') }}"
                class="btn btn-back"
            >
                ← Kembali ke Station
            </a>


        </div>

    </div>

</div>

</body>

</html>