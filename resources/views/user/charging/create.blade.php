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

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
            align-items: center;
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

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>
            Mulai Charging
        </h1>

        {{-- Pesan error --}}
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- Pesan berhasil --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Informasi Charger --}}
        <div class="info">

            <strong>Kode Charger:</strong>

            <br>

            {{ $charger->kode_perangkat }}

        </div>

        <div class="info">

            <strong>Tipe Konektor:</strong>

            <br>

            {{ $charger->tipe_konektor }}

        </div>

        <div class="info">

            <strong>Daya Charger:</strong>

            <br>

            {{ $charger->daya_kw }} kW

        </div>

        <div class="info">

            <strong>Status:</strong>

            <br>

            <span class="available">
                {{ ucfirst($charger->status) }}
            </span>

        </div>

        {{-- Tombol --}}
        <div class="buttons">

        <a
            href="{{ route('stations.index') }}"
            class="btn btn-back"
        >
            ← Kembali
        </a>

            <form
                action="{{ route('charging.start', $charger->id_charger) }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="btn btn-start"
                >
                    Mulai Charging
                </button>

            </form>

        </div>

    </div>

</div>

</body>

</html> 