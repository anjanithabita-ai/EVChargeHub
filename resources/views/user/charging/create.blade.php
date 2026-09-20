<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Pilih Charger - EVChargeHub</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
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
            margin-bottom: 25px;
        }

        .info {
            margin: 15px 0;
            line-height: 1.6;
        }

        .available {
            color: #198754;
            font-weight: bold;
        }

        .charger-info {
            padding: 18px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .charger-info .info {
            margin: 10px 0;
        }

        .vehicle-section {
            margin-top: 25px;
        }

        .vehicle-label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .vehicle-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 15px;
            box-sizing: border-box;
            background: white;
        }

        .vehicle-select:focus {
            outline: none;
            border-color: #0d6efd;
        }

        .vehicle-info {
            display: none;
            margin-top: 15px;
            padding: 15px;
            background: #e8f8ef;
            border-radius: 8px;
            color: #0f5132;
        }

        .vehicle-info strong {
            display: block;
            margin-bottom: 5px;
        }

        .connector-match {
            color: #198754;
            font-weight: bold;
        }

        .connector-not-match {
            color: #dc3545;
            font-weight: bold;
        }

        .connector-warning {
            display: none;
            margin-top: 15px;
            padding: 12px 15px;
            background: #f8d7da;
            color: #842029;
            border-radius: 8px;
            line-height: 1.5;
        }

        .connector-success {
            display: none;
            margin-top: 15px;
            padding: 12px 15px;
            background: #d1e7dd;
            color: #0f5132;
            border-radius: 8px;
            line-height: 1.5;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            display: inline-block;
            border: none;
            font-size: 15px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        .btn-back {
            background: #6c757d;
        }

        .btn-back:hover {
            background: #5c636a;
        }

        .btn-start {
            background: #0d6efd;
        }

        .btn-start:hover {
            background: #0b5ed7;
        }

        .btn-start:disabled {
            background: #adb5bd;
            cursor: not-allowed;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .required {
            color: #dc3545;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>
            Mulai Charging
        </h1>


        {{-- ========================================= --}}
        {{-- PESAN ERROR --}}
        {{-- ========================================= --}}

        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
            </div>

        @endif


        {{-- ========================================= --}}
        {{-- PESAN BERHASIL --}}
        {{-- ========================================= --}}

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- ========================================= --}}
        {{-- INFORMASI CHARGER --}}
        {{-- ========================================= --}}

        <div class="charger-info">

            <div class="info">

                <strong>
                    Kode Charger:
                </strong>

                {{ $charger->kode_perangkat }}

            </div>


            <div class="info">

                <strong>
                    Tipe Konektor Charger:
                </strong>

                <span class="available">
                    {{ $charger->tipe_konektor }}
                </span>

            </div>


            <div class="info">

                <strong>
                    Daya Charger:
                </strong>

                {{ $charger->daya_kw }} kW

            </div>


            <div class="info">

                <strong>
                    Status:
                </strong>

                <span class="available">
                    {{ ucfirst($charger->status) }}
                </span>

            </div>

        </div>


        {{-- ========================================= --}}
        {{-- FORM MULAI CHARGING --}}
        {{-- ========================================= --}}

        <form
            action="{{ route('charging.start', $charger->id_charger) }}"
            method="POST"
            id="charging-form"
        >

            @csrf


            {{-- ========================================= --}}
            {{-- PILIH KENDARAAN --}}
            {{-- ========================================= --}}

            <div class="vehicle-section">

                <label
                    for="id_vehicle"
                    class="vehicle-label"
                >
                    Pilih Kendaraan
                    <span class="required">*</span>
                </label>


                <select
                    name="id_vehicle"
                    id="id_vehicle"
                    class="vehicle-select"
                    required
                >

                    <option value="">
                        -- Pilih Kendaraan --
                    </option>


                    @foreach($vehicles as $vehicle)

                        <option
                            value="{{ $vehicle->id_vehicle }}"
                            data-konektor="{{ strtolower(trim($vehicle->tipe_konektor)) }}"
                            data-merek="{{ $vehicle->merek }}"
                            data-model="{{ $vehicle->model }}"
                            data-plat="{{ $vehicle->nomor_polisi }}"
                        >

                            {{ $vehicle->merek }}
                            {{ $vehicle->model }}

                            -

                            {{ $vehicle->nomor_polisi }}

                            -

                            {{ $vehicle->tipe_konektor }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- ========================================= --}}
            {{-- INFORMASI KENDARAAN YANG DIPILIH --}}
            {{-- ========================================= --}}

            <div
                id="vehicle-info"
                class="vehicle-info"
            >

                <strong>
                    Kendaraan yang dipilih:
                </strong>

                <span id="vehicle-name">
                    -
                </span>

                <br>

                <strong>
                    Tipe Konektor Kendaraan:
                </strong>

                <span id="vehicle-connector">
                    -
                </span>

            </div>


            {{-- ========================================= --}}
            {{-- KONEKTOR TIDAK SESUAI --}}
            {{-- ========================================= --}}

            <div
                id="connector-warning"
                class="connector-warning"
            >

                <strong>
                    ⚠ Konektor Tidak Sesuai
                </strong>

                <br>

                Tipe konektor kendaraan:

                <strong id="warning-vehicle-connector">
                    -
                </strong>

                <br>

                tidak sesuai dengan tipe konektor charger:

                <strong>
                    {{ $charger->tipe_konektor }}
                </strong>

                <br><br>

                Silakan pilih kendaraan dengan tipe konektor
                yang sesuai.

            </div>


            {{-- ========================================= --}}
            {{-- KONEKTOR SESUAI --}}
            {{-- ========================================= --}}

            <div
                id="connector-success"
                class="connector-success"
            >

                <strong>
                    ✓ Konektor Sesuai
                </strong>

                <br>

                Kendaraan dapat menggunakan charger ini.

            </div>


            {{-- ========================================= --}}
            {{-- TOMBOL --}}
            {{-- ========================================= --}}

            <div class="buttons">

                <a
                    href="{{ route('stations.index') }}"
                    class="btn btn-back"
                >
                    ← Kembali
                </a>


                <button
                    type="submit"
                    id="start-button"
                    class="btn btn-start"
                    disabled
                >
                    Mulai Charging
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ========================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================= --}}

<script>

    const vehicleSelect =
        document.getElementById('id_vehicle');

    const startButton =
        document.getElementById('start-button');

    const vehicleInfo =
        document.getElementById('vehicle-info');

    const vehicleName =
        document.getElementById('vehicle-name');

    const vehicleConnector =
        document.getElementById('vehicle-connector');

    const connectorWarning =
        document.getElementById('connector-warning');

    const connectorSuccess =
        document.getElementById('connector-success');

    const warningVehicleConnector =
        document.getElementById('warning-vehicle-connector');


    // Tipe konektor charger
    const chargerConnector =
        "{{ strtolower(trim($charger->tipe_konektor)) }}";


    vehicleSelect.addEventListener('change', function () {

        const selectedOption =
            this.options[this.selectedIndex];


        // Jika belum memilih kendaraan
        if (!selectedOption.value) {

            startButton.disabled = true;

            vehicleInfo.style.display = 'none';

            connectorWarning.style.display = 'none';

            connectorSuccess.style.display = 'none';

            return;
        }


        // Ambil data kendaraan
        const selectedConnector =
            selectedOption.dataset.konektor;

        const merek =
            selectedOption.dataset.merek;

        const model =
            selectedOption.dataset.model;

        const plat =
            selectedOption.dataset.plat;


        // Tampilkan informasi kendaraan
        vehicleInfo.style.display = 'block';

        vehicleName.textContent =
            merek + ' ' + model + ' - ' + plat;

        vehicleConnector.textContent =
            selectedConnector;


        // Bandingkan konektor
        if (
            selectedConnector === chargerConnector
        ) {

            // =========================
            // KONEKTOR SESUAI
            // =========================

            startButton.disabled = false;

            connectorWarning.style.display = 'none';

            connectorSuccess.style.display = 'block';

            vehicleConnector.className =
                'connector-match';

        } else {

            // =========================
            // KONEKTOR TIDAK SESUAI
            // =========================

            startButton.disabled = true;

            connectorWarning.style.display = 'block';

            connectorSuccess.style.display = 'none';

            warningVehicleConnector.textContent =
                selectedConnector;

            vehicleConnector.className =
                'connector-not-match';

        }

    });


    // Pengamanan tambahan sebelum submit
    document
        .getElementById('charging-form')
        .addEventListener('submit', function (event) {

            const selectedOption =
                vehicleSelect.options[
                    vehicleSelect.selectedIndex
                ];


            if (!selectedOption.value) {

                event.preventDefault();

                alert(
                    'Silakan pilih kendaraan terlebih dahulu.'
                );

                return;
            }


            const selectedConnector =
                selectedOption.dataset.konektor;


            if (
                selectedConnector !== chargerConnector
            ) {

                event.preventDefault();

                alert(
                    'Tipe konektor kendaraan tidak sesuai dengan charger.'
                );

                return;
            }

        });

</script>


</body>

</html>