<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Verifikasi Pembayaran - EVChargeHub</title>

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
            padding: 13px 0;
            border-bottom: 1px solid #eee;
            line-height: 1.5;
        }

        .label {
            font-weight: bold;
        }

        .status {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin-top: 5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #664d03;
        }

        .status-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-failed {
            background: #f8d7da;
            color: #842029;
        }

        .total {
            margin-top: 25px;
            padding: 20px;
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

        .reference {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .reference-code {
            font-family: monospace;
            font-size: 16px;
            margin-top: 6px;
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
            border: none;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        .btn-confirm {
            background: #198754;
        }

        .btn-confirm:hover {
            background: #157347;
        }

        .btn-back {
            background: #6c757d;
        }

        .btn-back:hover {
            background: #5c636a;
        }

        .btn-status {
            background: #0d6efd;
        }

        .btn-status:hover {
            background: #0b5ed7;
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
            Verifikasi Pembayaran
        </h1>

        <div class="subtitle">
            Periksa kembali informasi pembayaran Anda sebelum melakukan verifikasi.
        </div>


        {{-- ========================================= --}}
        {{-- PESAN --}}
        {{-- ========================================= --}}

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
            </div>

        @endif


        {{-- ========================================= --}}
        {{-- INFORMASI PEMBAYARAN --}}
        {{-- ========================================= --}}

        <div class="info">

            <span class="label">
                ID Pembayaran:
            </span>

            #{{ $payment->id_payment }}

        </div>


        <div class="info">

            <span class="label">
                ID Sesi Charging:
            </span>

            #{{ $payment->id_session }}

        </div>


        <div class="info">

            <span class="label">
                Metode Pembayaran:
            </span>

            {{ strtoupper($payment->metode) }}

        </div>


        <div class="info">

            <span class="label">
                Status Pembayaran:
            </span>

            <br>

            @if($payment->status === 'pending')

                <span class="status status-pending">
                    Menunggu Pembayaran
                </span>

            @elseif($payment->status === 'berhasil')

                <span class="status status-success">
                    Pembayaran Berhasil
                </span>

            @elseif($payment->status === 'gagal')

                <span class="status status-failed">
                    Pembayaran Gagal
                </span>

            @elseif($payment->status === 'refund')

                <span class="status status-failed">
                    Pembayaran Refund
                </span>

            @endif

        </div>


        {{-- ========================================= --}}
        {{-- REFERENSI PEMBAYARAN --}}
        {{-- ========================================= --}}

        <div class="reference">

            <strong>
                Referensi Pembayaran
            </strong>

            <div class="reference-code">
                {{ $payment->referensi_gateway }}
            </div>

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
                    $payment->jumlah,
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


            {{-- Jika masih pending --}}
            @if($payment->status === 'pending')

                <form
                    action="{{ route(
                        'payment.confirm',
                        $payment->id_payment
                    ) }}"
                    method="POST"
                    onsubmit="return confirm(
                        'Apakah Anda yakin ingin melakukan verifikasi pembayaran?'
                    );"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-confirm"
                    >
                        ✓ Verifikasi Pembayaran
                    </button>

                </form>

            @endif


            {{-- Jika berhasil --}}
            @if($payment->status === 'berhasil')

                <a
                    href="{{ route(
                        'payment.status',
                        $payment->id_payment
                    ) }}"
                    class="btn btn-status"
                >
                    Lihat Status Pembayaran
                </a>

            @endif


            {{-- Kembali --}}
            <a
                href="{{ route(
                    'charging.monitor',
                    $payment->id_session
                ) }}"
                class="btn btn-back"
            >
                ← Kembali
            </a>

        </div>

    </div>

</div>

</body>

</html>