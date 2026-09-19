<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Invoice Pembayaran - EVChargeHub</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
        }

        .invoice {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #0d6efd;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
        }

        .subtitle {
            color: #666;
            margin-top: 5px;
        }

        .success {
            text-align: center;
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            color: #333;
        }

        .info {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .label {
            color: #666;
        }

        .value {
            font-weight: bold;
            text-align: right;
        }

        .total {
            margin-top: 25px;
            padding: 20px;
            background: #e8f8ef;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-size: 18px;
            font-weight: bold;
            color: #0f5132;
        }

        .total-price {
            font-size: 25px;
            font-weight: bold;
            color: #0f5132;
        }

        .reference {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .reference-code {
            margin-top: 7px;
            font-family: monospace;
            word-break: break-all;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            border: none;
            font-size: 15px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .btn-print {
            background: #0d6efd;
        }

        .btn-print:hover {
            background: #0b5ed7;
        }

        .btn-status {
            background: #198754;
        }

        .btn-status:hover {
            background: #157347;
        }

        .btn-back {
            background: #6c757d;
        }

        .btn-back:hover {
            background: #5c636a;
        }

        @media print {

            body {
                background: white;
            }

            .container {
                margin: 0;
                max-width: none;
            }

            .invoice {
                box-shadow: none;
                border-radius: 0;
            }

            .buttons {
                display: none;
            }

        }

    </style>

</head>

<body>

    @php
    $session = $payment->session;
    @endphp

<div class="container">

    <div class="invoice">

        {{-- HEADER --}}
        <div class="header">

            <div class="logo">
                EVChargeHub
            </div>

            <div class="title">
                INVOICE / STRUK PEMBAYARAN
            </div>

            <div class="subtitle">
                Bukti pembayaran charging kendaraan listrik
            </div>

        </div>


        {{-- STATUS --}}
        @if($payment->status === 'berhasil')

            <div class="success">
                ✓ PEMBAYARAN BERHASIL
            </div>

        @endif


        {{-- INFORMASI PEMBAYARAN --}}
        <div class="section-title">
            Informasi Pembayaran
        </div>

        <div class="info">

            <span class="label">
                ID Pembayaran
            </span>

            <span class="value">
                #{{ $payment->id_payment }}
            </span>

        </div>

        <div class="info">

            <span class="label">
                ID Sesi Charging
            </span>

            <span class="value">
                #{{ $payment->id_session }}
            </span>

        </div>

        <div class="info">

            <span class="label">
                Metode Pembayaran
            </span>

            <span class="value">
                {{ strtoupper($payment->metode) }}
            </span>

        </div>

        <div class="info">

            <span class="label">
                Waktu Pembayaran
            </span>

            <span class="value">

                @if($payment->waktu_pembayaran)

                    {{ \Carbon\Carbon::parse(
                        $payment->waktu_pembayaran
                    )->format('d-m-Y H:i:s') }}

                @else

                    -

                @endif

            </span>

        </div>


        {{-- INFORMASI CHARGING --}}
        <div class="section-title">
            Informasi Charging
        </div>

        <div class="info">

            <span class="label">
                Charger
            </span>

            <span class="value">
                {{ $session->charger->kode_perangkat }}
            </span>

        </div>

        <div class="info">

            <span class="label">
                Tipe Konektor
            </span>

            <span class="value">
                {{ $session->charger->tipe_konektor }}
            </span>

        </div>

        <div class="info">

            <span class="label">
                Daya Charger
            </span>

            <span class="value">
                {{ $session->charger->daya_kw }} kW
            </span>

        </div>

        <div class="info">

            <span class="label">
                Kendaraan
            </span>

            <span class="value">
                {{ $session->vehicle->merek }}
                {{ $session->vehicle->model }}
            </span>

        </div>

        <div class="info">

            <span class="label">
                Nomor Polisi
            </span>

            <span class="value">
                {{ $session->vehicle->nomor_polisi }}
            </span>

        </div>

        <div class="info">

            <span class="label">
                Waktu Mulai
            </span>

            <span class="value">

                {{ $session->waktu_mulai->format(
                    'd-m-Y H:i:s'
                ) }}

            </span>

        </div>

        <div class="info">

            <span class="label">
                Waktu Selesai
            </span>

            <span class="value">

                @if($session->waktu_selesai)

                    {{ $session->waktu_selesai->format(
                        'd-m-Y H:i:s'
                    ) }}

                @else

                    -

                @endif

            </span>

        </div>

        <div class="info">

            <span class="label">
                Energi Digunakan
            </span>

            <span class="value">
                {{ $session->energi_kwh }} kWh
            </span>

        </div>

        <div class="info">

            <span class="label">
                Durasi Charging
            </span>

            <span class="value">
                {{ $session->durasi_menit }} menit
            </span>

        </div>


        {{-- TOTAL --}}
        <div class="total">

            <div class="total-label">
                Total Pembayaran
            </div>

            <div class="total-price">

                Rp {{ number_format(
                    $payment->jumlah,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

        </div>


        {{-- REFERENSI --}}
        <div class="reference">

            <strong>
                Nomor Referensi
            </strong>

            <div class="reference-code">
                {{ $payment->referensi_gateway }}
            </div>

        </div>


        {{-- BUTTON --}}
        <div class="buttons">

            <button
                type="button"
                onclick="window.print()"
                class="btn btn-print"
            >
                🖨 Cetak Invoice
            </button>

            <a
                href="{{ route(
                    'payment.status',
                    $payment->id_payment
                ) }}"
                class="btn btn-status"
            >
                ← Status Pembayaran
            </a>

            <a
                href="{{ route('stations.index') }}"
                class="btn btn-back"
            >
                Kembali ke Station
            </a>

        </div>

    </div>

</div>

</body>

</html>