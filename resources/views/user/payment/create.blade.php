<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Pembayaran - EVChargeHub</title>

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

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
            color: #0f5132;
        }

        .subtitle {
            color: #666;
            margin-bottom: 25px;
        }

        .info {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            line-height: 1.5;
        }

        .label {
            font-weight: bold;
        }

        .total {
            margin-top: 20px;
            padding: 18px;
            background: #e8f8ef;
            border-radius: 10px;
        }

        .total-label {
            font-weight: bold;
            color: #0f5132;
        }

        .total-price {
            font-size: 28px;
            font-weight: bold;
            margin-top: 8px;
            color: #0f5132;
        }

        .payment-title {
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .method {
            display: block;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .method:hover {
            background: #f8f9fa;
        }

        .method input {
            margin-right: 10px;
        }

        .method-name {
            font-weight: bold;
        }

        .method-description {
            display: block;
            margin-left: 25px;
            margin-top: 5px;
            color: #777;
            font-size: 14px;
        }

        /* ========================= */
        /* QRIS */
        /* ========================= */

        .qris-container {
            display: none;
            margin-top: 20px;
            padding: 25px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 12px;
            text-align: center;
        }

        .qris-title {
            font-size: 20px;
            font-weight: bold;
            color: #0f5132;
            margin-bottom: 10px;
        }

        .qris-description {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .qris-box {
            display: inline-block;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.10);
        }

        .qris-box img {
            width: 250px;
            height: 250px;
            display: block;
        }

        .qris-amount {
            margin-top: 15px;
            font-size: 22px;
            font-weight: bold;
            color: #0f5132;
        }

        .qris-id {
            margin-top: 5px;
            color: #777;
            font-size: 13px;
        }

        .qris-warning {
            margin-top: 15px;
            padding: 10px;
            background: #fff3cd;
            color: #664d03;
            border-radius: 8px;
            font-size: 13px;
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
            border: none;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
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

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 10px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>
            Pembayaran
        </h1>

        <div class="subtitle">
            Pilih metode pembayaran untuk menyelesaikan transaksi charging.
        </div>


        {{-- Pesan error --}}
        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
            </div>

        @endif


        {{-- ========================================= --}}
        {{-- INFORMASI CHARGING --}}
        {{-- ========================================= --}}

        <div class="info">

            <span class="label">
                Kode Charger:
            </span>

            {{ $session->charger->kode_perangkat }}

        </div>


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


        <div class="info">

            <span class="label">
                Energi:
            </span>

            {{ $session->energi_kwh }} kWh

        </div>


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
        {{-- TOTAL --}}
        {{-- ========================================= --}}

        <div class="total">

            <div class="total-label">
                Total Pembayaran
            </div>

            <div class="total-price">

                Rp {{ number_format(
                    $session->total_biaya,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

        </div>


        {{-- ========================================= --}}
        {{-- METODE PEMBAYARAN --}}
        {{-- ========================================= --}}

        <div class="payment-title">
            Pilih Metode Pembayaran
        </div>


        <form
            action="{{ route(
                'payment.process',
                $session->id_session
            ) }}"
            method="POST"
        >

            @csrf


            {{-- E-Wallet --}}
            <label class="method">

                <input
                    type="radio"
                    name="metode"
                    value="ewallet"
                    required
                    onchange="toggleQRIS()"
                >

                <span class="method-name">
                    E-Wallet
                </span>

                <span class="method-description">
                    Pembayaran menggunakan dompet digital.
                </span>

            </label>


            {{-- Card --}}
            <label class="method">

                <input
                    type="radio"
                    name="metode"
                    value="card"
                    onchange="toggleQRIS()"
                >

                <span class="method-name">
                    Kartu
                </span>

                <span class="method-description">
                    Pembayaran menggunakan kartu.
                </span>

            </label>


            {{-- QRIS --}}
            <label class="method">

                <input
                    type="radio"
                    name="metode"
                    value="qr"
                    onchange="toggleQRIS()"
                >

                <span class="method-name">
                    QRIS
                </span>

                <span class="method-description">
                    Pembayaran menggunakan QRIS.
                </span>

            </label>


            {{-- ========================================= --}}
            {{-- QR CODE QRIS --}}
            {{-- ========================================= --}}

            <div
                id="qris-container"
                class="qris-container"
            >

                <div class="qris-title">
                    Scan QRIS
                </div>

                <div class="qris-description">
                    Silakan scan QR Code berikut menggunakan
                    aplikasi pembayaran yang mendukung QRIS.
                </div>


                <div class="qris-box">

                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=EVChargeHub-Payment-{{ $session->id_session }}-Rp{{ $session->total_biaya }}"
                        alt="QRIS EVChargeHub"
                    >

                </div>


                <div class="qris-amount">

                    Rp {{ number_format(
                        $session->total_biaya,
                        0,
                        ',',
                        '.'
                    ) }}

                </div>


                <div class="qris-id">

                    ID Sesi:
                    #{{ $session->id_session }}

                </div>


                <div class="qris-warning">

                    QR Code ini merupakan QR Code simulasi
                    untuk kebutuhan sistem EVChargeHub.

                </div>

            </div>


            {{-- Saldo --}}
            <label class="method">

                <input
                    type="radio"
                    name="metode"
                    value="saldo"
                    onchange="toggleQRIS()"
                >

                <span class="method-name">
                    Saldo
                </span>

                <span class="method-description">
                    Pembayaran menggunakan saldo akun.
                </span>

            </label>


            @error('metode')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror


            {{-- ========================================= --}}
            {{-- TOMBOL --}}
            {{-- ========================================= --}}

            <div class="buttons">

                <a
                    href="{{ route(
                        'charging.monitor',
                        $session->id_session
                    ) }}"
                    class="btn btn-back"
                >
                    ← Kembali
                </a>


                <button
                    type="submit"
                    class="btn btn-payment"
                >
                    💳 Proses Pembayaran
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ========================================= --}}
{{-- JAVASCRIPT QRIS --}}
{{-- ========================================= --}}

<script>

function toggleQRIS() {

    const selectedMethod =
        document.querySelector(
            'input[name="metode"]:checked'
        );

    const qrisContainer =
        document.getElementById('qris-container');


    if (
        selectedMethod &&
        selectedMethod.value === 'qr'
    ) {

        qrisContainer.style.display = 'block';

    } else {

        qrisContainer.style.display = 'none';

    }

}

</script>

</body>

</html>