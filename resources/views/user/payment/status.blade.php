<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Status Pembayaran - EVChargeHub</title>

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

        .status-box {
            text-align: center;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .status-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-pending {
            background: #fff3cd;
            color: #664d03;
        }

        .status-failed {
            background: #f8d7da;
            color: #842029;
        }

        .status-icon {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .status-title {
            font-size: 22px;
            font-weight: bold;
        }

        .status-description {
            margin-top: 8px;
        }

        .info {
            padding: 13px 0;
            border-bottom: 1px solid #eee;
            line-height: 1.5;
        }

        .label {
            font-weight: bold;
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

        .btn-invoice {
            background: #198754;
        }

        .btn-invoice:hover {
            background: #157347;
        }

        .btn-back {
            background: #6c757d;
        }

        .btn-back:hover {
            background: #5c636a;
        }

        .btn-monitor {
            background: #0d6efd;
        }

        .btn-monitor:hover {
            background: #0b5ed7;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>
            Status Pembayaran
        </h1>

        <div class="subtitle">
            Informasi status pembayaran charging Anda.
        </div>


        {{-- ========================================= --}}
        {{-- STATUS PEMBAYARAN --}}
        {{-- ========================================= --}}

        @if($payment->status === 'berhasil')

            <div class="status-box status-success">

                <div class="status-icon">
                    ✓
                </div>

                <div class="status-title">
                    Pembayaran Berhasil
                </div>

                <div class="status-description">
                    Pembayaran charging Anda telah berhasil diverifikasi.
                </div>

            </div>

        @elseif($payment->status === 'pending')

            <div class="status-box status-pending">

                <div class="status-icon">
                    ⏳
                </div>

                <div class="status-title">
                    Pembayaran Menunggu
                </div>

                <div class="status-description">
                    Pembayaran masih menunggu proses verifikasi.
                </div>

            </div>

        @elseif($payment->status === 'gagal')

            <div class="status-box status-failed">

                <div class="status-icon">
                    ✕
                </div>

                <div class="status-title">
                    Pembayaran Gagal
                </div>

                <div class="status-description">
                    Pembayaran tidak berhasil diproses.
                </div>

            </div>

        @elseif($payment->status === 'refund')

            <div class="status-box status-failed">

                <div class="status-icon">
                    ↩
                </div>

                <div class="status-title">
                    Pembayaran Refund
                </div>

                <div class="status-description">
                    Pembayaran telah dikembalikan.
                </div>

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


        @if($payment->waktu_pembayaran)

            <div class="info">

                <span class="label">
                    Waktu Pembayaran:
                </span>

                {{ \Carbon\Carbon::parse(
                    $payment->waktu_pembayaran
                )->format('d-m-Y H:i:s') }}

            </div>

        @endif


        {{-- ========================================= --}}
        {{-- REFERENSI --}}
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


            {{-- Jika pembayaran berhasil --}}
            @if($payment->status === 'berhasil')

                <a
                    href="{{ route(
                        'payment.invoice',
                        $payment->id_payment
                    ) }}"
                    class="btn btn-invoice"
                >
                    🧾 Lihat Invoice / Struk
                </a>

            @endif


            {{-- Kembali ke monitor --}}
            <a
                href="{{ route(
                    'charging.monitor',
                    $payment->id_session
                ) }}"
                class="btn btn-monitor"
            >
                ← Monitor Charging
            </a>


            {{-- Kembali ke station --}}
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