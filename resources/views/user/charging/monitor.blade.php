<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Monitor Charging - EVChargeHub</title>

    <style>

        * {
            box-sizing: border-box;
        }

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
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 25px;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            background: #d1e7dd;
            color: #0f5132;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .status-selesai {
            background: #cff4fc;
            color: #055160;
        }

        .status-batal {
            background: #f8d7da;
            color: #842029;
        }

        /* =========================
           MONITORING
        ========================= */

        .monitor-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .monitor-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .monitor-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .monitor-item {
            background: white;
            border-radius: 10px;
            padding: 18px;
            border: 1px solid #eee;
        }

        .monitor-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .monitor-value {
            font-size: 23px;
            font-weight: bold;
            color: #0f5132;
        }

        .monitor-unit {
            font-size: 14px;
            color: #666;
            font-weight: normal;
        }

        /* =========================
           PROGRESS
        ========================= */

        .progress-section {
            margin-top: 20px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .progress-bar {
            width: 100%;
            height: 18px;
            background: #e9ecef;
            border-radius: 20px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 0%;
            background: #198754;
            border-radius: 20px;
            transition: width 0.5s ease;
        }

        /* =========================
           INFO
        ========================= */

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

        /* =========================
           COST
        ========================= */

        .cost-box {
            margin-top: 20px;
            padding: 20px;
            background: #e8f8ef;
            border-radius: 10px;
        }

        .cost-label {
            color: #0f5132;
            font-weight: bold;
        }

        .cost {
            font-size: 28px;
            font-weight: bold;
            margin-top: 8px;
            color: #0f5132;
        }

        /* =========================
           BUTTON
        ========================= */

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
        }

        .btn-stop {
            background: #198754;
        }

        .btn-stop:hover {
            background: #157347;
        }

        .btn-cancel {
            background: #dc3545;
        }

        .btn-cancel:hover {
            background: #bb2d3b;
        }

        .btn-payment {
            background: #0d6efd;
        }

        .btn-payment:hover {
            background: #0b5ed7;
        }

        .btn-back {
            background: #6c757d;
        }

        .btn-back:hover {
            background: #5c636a;
        }

        /* =========================
           ALERT
        ========================= */

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

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 600px) {

            .container {
                margin: 20px auto;
                padding: 15px;
            }

            .card {
                padding: 20px;
            }

            .monitor-grid {
                grid-template-columns: 1fr;
            }

            .buttons {
                flex-direction: column;
            }

            .btn,
            .buttons form {
                width: 100%;
            }

        }

    </style>

</head>


<body>

<div class="container">

    <div class="card">

        <h1>
            Monitor Charging
        </h1>

        <div class="subtitle">
            Pantau proses pengisian kendaraan listrik Anda.
        </div>


        {{-- =========================================
             PESAN BERHASIL
        ========================================== --}}

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- =========================================
             PESAN ERROR
        ========================================== --}}

        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
            </div>

        @endif


        {{-- =========================================
             STATUS
        ========================================== --}}

        <div>

            @if($session->status === 'berlangsung')

                <span class="status">
                    ⚡ Charging Berlangsung
                </span>

            @elseif($session->status === 'selesai')

                <span class="status status-selesai">
                    ✓ Charging Selesai
                </span>

            @elseif($session->status === 'dibatalkan')

                <span class="status status-batal">
                    ✕ Charging Dibatalkan
                </span>

            @elseif($session->status === 'gagal')

                <span class="status status-batal">
                    ⚠ Charging Gagal
                </span>

            @endif

        </div>


        {{-- =========================================
             MONITORING
        ========================================== --}}

        @if($session->status === 'berlangsung')

            <div class="monitor-box">

                <div class="monitor-title">
                    Monitoring Charging
                </div>


                <div class="monitor-grid">


                    {{-- Daya Charger --}}

                    <div class="monitor-item">

                        <div class="monitor-label">
                            Daya Charger
                        </div>

                        <div class="monitor-value">

                            {{ number_format(
                                (float) $session->charger->daya_kw,
                                2,
                                ',',
                                '.'
                            ) }}

                            <span class="monitor-unit">
                                kW
                            </span>

                        </div>

                    </div>


                    {{-- Daya Saat Ini --}}

                    <div class="monitor-item">

                        <div class="monitor-label">
                            Daya Saat Ini
                        </div>

                        <div class="monitor-value">

                            <span id="current-power">
                                {{ number_format(
                                    (float) $session->charger->daya_kw,
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </span>

                            <span class="monitor-unit">
                                kW
                            </span>

                        </div>

                    </div>


                    {{-- Energi --}}

                    <div class="monitor-item">

                        <div class="monitor-label">
                            Energi Terisi
                        </div>

                        <div class="monitor-value">

                            <span id="energy">
                                {{ number_format(
                                    (float) ($session->energi_kwh ?? 0),
                                    2,
                                    ',',
                                    '.'
                                ) }}
                            </span>

                            <span class="monitor-unit">
                                kWh
                            </span>

                        </div>

                    </div>


                    {{-- Durasi --}}

                    <div class="monitor-item">

                        <div class="monitor-label">
                            Durasi Charging
                        </div>

                        <div class="monitor-value">

                            <span id="duration">
                                {{ $session->durasi_menit ?? 0 }}
                            </span>

                            <span class="monitor-unit">
                                menit
                            </span>

                        </div>

                    </div>

                </div>


                {{-- =================================
                     PROGRESS
                ================================== --}}

                <div class="progress-section">

                    <div class="progress-header">

                        <span>
                            Proses Pengisian
                        </span>

                        <span>
                            <span id="progress-text">
                                0
                            </span>%
                        </span>

                    </div>

                    <div class="progress-bar">

                        <div
                            id="progress-fill"
                            class="progress-fill"
                        ></div>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================
             INFORMASI CHARGER
        ========================================== --}}

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

            {{ number_format(
                (float) $session->charger->daya_kw,
                2,
                ',',
                '.'
            ) }}

            kW

        </div>


        {{-- =========================================
             INFORMASI KENDARAAN
        ========================================== --}}

        <div class="info">

            <span class="label">
                Kendaraan:
            </span>

            {{ $session->vehicle->merek }}
            {{ $session->vehicle->model }}

        </div>


        <div class="info">

            <span class="label">
                Tipe Konektor Kendaraan:
            </span>

            {{ $session->vehicle->tipe_konektor }}

        </div>


        <div class="info">

            <span class="label">
                Nomor Polisi:
            </span>

            {{ $session->vehicle->nomor_polisi }}

        </div>


        {{-- =========================================
             WAKTU MULAI
        ========================================== --}}

        <div class="info">

            <span class="label">
                Waktu Mulai:
            </span>

            {{ $session->waktu_mulai->format('d-m-Y H:i:s') }}

        </div>


        {{-- =========================================
             WAKTU SELESAI
        ========================================== --}}

        @if($session->waktu_selesai)

            <div class="info">

                <span class="label">
                    Waktu Selesai:
                </span>

                {{ $session->waktu_selesai->format('d-m-Y H:i:s') }}

            </div>

        @endif


        {{-- =========================================
             DURASI JIKA SUDAH SELESAI
        ========================================== --}}

        @if($session->status !== 'berlangsung')

            <div class="info">

                <span class="label">
                    Durasi Charging:
                </span>

                {{ $session->durasi_menit ?? 0 }}
                menit

            </div>

        @endif


        {{-- =========================================
             ENERGI JIKA SUDAH SELESAI
        ========================================== --}}

        @if($session->status !== 'berlangsung')

            <div class="info">

                <span class="label">
                    Energi Terisi:
                </span>

                {{ number_format(
                    (float) ($session->energi_kwh ?? 0),
                    2,
                    ',',
                    '.'
                ) }}

                kWh

            </div>

        @endif


        {{-- =========================================
             TARIF
        ========================================== --}}

        <div class="info">

            <span class="label">
                Tarif:
            </span>

            Rp

            {{ number_format(
                (float) $session->tariff->harga_per_kwh,
                0,
                ',',
                '.'
            ) }}

            /kWh

        </div>


        {{-- =========================================
             TOTAL BIAYA
        ========================================== --}}

        <div class="cost-box">

            <div class="cost-label">
                Total Biaya Charging
            </div>

            <div class="cost">

                Rp

                <span id="cost">

                    {{ number_format(
                        (float) ($session->total_biaya ?? 0),
                        0,
                        ',',
                        '.'
                    ) }}

                </span>

            </div>

        </div>


        {{-- =========================================
             TOMBOL
        ========================================== --}}

        <div class="buttons">


            {{-- =====================================
                 CHARGING BERLANGSUNG
            ====================================== --}}

            @if($session->status === 'berlangsung')


                {{-- HENTIKAN CHARGING --}}

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
                        ⏹ Hentikan Charging
                    </button>

                </form>


                {{-- BATALKAN CHARGING --}}

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
                        ✕ Batalkan Charging
                    </button>

                </form>

            @endif


            {{-- =====================================
                 CHARGING SELESAI
            ====================================== --}}

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


            {{-- =====================================
                 KEMBALI
            ====================================== --}}

            <a
                href="{{ route('stations.index') }}"
                class="btn btn-back"
            >
                ← Kembali ke Station
            </a>

        </div>

    </div>

</div>


{{-- =============================================
     JAVASCRIPT MONITORING
============================================= --}}

@if($session->status === 'berlangsung')

<script>

    /*
    |--------------------------------------------------------------------------
    | DATA CHARGING
    |--------------------------------------------------------------------------
    */

    const startTime = new Date(
        "{{ $session->waktu_mulai->toIso8601String() }}"
    );

    const chargerPower =
        {{ (float) $session->charger->daya_kw }};

    const pricePerKwh =
        {{ (float) $session->tariff->harga_per_kwh }};

    const initialEnergy =
        {{ (float) ($session->energi_kwh ?? 0) }};

    /*
    |--------------------------------------------------------------------------
    | ELEMENT
    |--------------------------------------------------------------------------
    */

    const powerElement =
        document.getElementById('current-power');

    const energyElement =
        document.getElementById('energy');

    const durationElement =
        document.getElementById('duration');

    const costElement =
        document.getElementById('cost');

    const progressElement =
        document.getElementById('progress-fill');

    const progressText =
        document.getElementById('progress-text');


    /*
    |--------------------------------------------------------------------------
    | FORMAT ANGKA
    |--------------------------------------------------------------------------
    */

    function formatNumber(number, decimal = 2) {

        return Number(number).toLocaleString(
            'id-ID',
            {
                minimumFractionDigits: decimal,
                maximumFractionDigits: decimal
            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE MONITORING
    |--------------------------------------------------------------------------
    */

    function updateChargingData() {

        const now = new Date();


        /*
        | Hitung durasi
        */

        const elapsedSeconds =
            Math.max(
                0,
                (now - startTime) / 1000
            );


        /*
        | Durasi dalam menit
        */

        const durationMinutes =
            Math.floor(elapsedSeconds / 60);


        /*
        | Daya aktual
        |
        | Simulasi perubahan kecil
        | dari daya charger.
        */

        const variation =
            Math.sin(elapsedSeconds / 10) * 0.5;


        const currentPower =
            Math.max(
                0,
                chargerPower + variation
            );


        /*
        | Hitung energi
        */

        const calculatedEnergy =
            (
                currentPower
                * elapsedSeconds
            ) / 3600;


        const energy =
            initialEnergy + calculatedEnergy;


        /*
        | Hitung biaya
        */

        const calculatedCost =
            energy * pricePerKwh;


        /*
        | Update daya
        */

        powerElement.textContent =
            formatNumber(
                currentPower,
                2
            );


        /*
        | Update energi
        */

        energyElement.textContent =
            formatNumber(
                energy,
                2
            );


        /*
        | Update durasi
        */

        durationElement.textContent =
            durationMinutes;


        /*
        | Update biaya
        */

        costElement.textContent =
            Math.round(
                calculatedCost
            ).toLocaleString('id-ID');


        /*
        |--------------------------------------------------------------------------
        | PROGRESS BAR
        |--------------------------------------------------------------------------
        |
        | Progress menggunakan target simulasi
        | 100 kWh.
        |
        */

        let progress =
            (energy / 100) * 100;


        progress =
            Math.min(
                100,
                Math.max(
                    0,
                    progress
                )
            );


        progressElement.style.width =
            progress + '%';


        progressText.textContent =
            progress.toFixed(1);

    }


    /*
    |--------------------------------------------------------------------------
    | JALANKAN
    |--------------------------------------------------------------------------
    */

    updateChargingData();


    /*
    |--------------------------------------------------------------------------
    | UPDATE SETIAP 1 DETIK
    |--------------------------------------------------------------------------
    */

    setInterval(
        updateChargingData,
        1000
    );

</script>

@endif


</body>

</html>