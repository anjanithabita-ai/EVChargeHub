<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Menunggu Pembayaran - EVChargeHub</title>

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
            max-width: 650px;
            margin: 50px auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #fff3cd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
        }

        h1 {
            margin: 0;
            color: #0f5132;
            font-size: 28px;
        }

        .subtitle {
            color: #666;
            margin-top: 10px;
            line-height: 1.5;
        }

        /* =========================
           TIMER
        ========================= */

        .timer-box {
            margin: 30px 0;
            padding: 25px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 12px;
        }

        .timer-title {
            color: #555;
            font-size: 15px;
            margin-bottom: 10px;
        }

        #timer {
            font-size: 42px;
            font-weight: bold;
            color: #dc3545;
            letter-spacing: 2px;
        }

        #timer.expired {
            font-size: 25px;
            color: #842029;
            letter-spacing: 0;
        }

        /* =========================
           PAYMENT INFO
        ========================= */

        .payment-info {
            text-align: left;
            margin-top: 25px;
            border-top: 1px solid #eee;
        }

        .info {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .label {
            color: #666;
        }

        .value {
            font-weight: bold;
            text-align: right;
        }

        /* =========================
           TOTAL
        ========================= */

        .total {
            margin-top: 20px;
            padding: 18px;
            background: #e8f8ef;
            border-radius: 10px;
            text-align: center;
        }

        .total-label {
            color: #0f5132;
            font-weight: bold;
        }

        .total-price {
            margin-top: 8px;
            font-size: 27px;
            font-weight: bold;
            color: #0f5132;
        }

        /* =========================
           QRIS
        ========================= */

        .qris {
            margin-top: 25px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            border: 1px solid #ddd;
        }

        .qris-title {
            font-weight: bold;
            color: #0f5132;
            margin-bottom: 15px;
        }

        .qris img {
            width: 220px;
            height: 220px;
            background: white;
            padding: 10px;
            border-radius: 8px;
        }

        .qris-text {
            margin-top: 12px;
            color: #666;
            font-size: 13px;
            line-height: 1.5;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            margin-top: 20px;
            padding: 12px;
            background: #fff3cd;
            color: #664d03;
            border-radius: 8px;
            font-size: 14px;
        }

        .status.expired {
            background: #f8d7da;
            color: #842029;
        }

        /* =========================
           BUTTON
        ========================= */

        .buttons {
            margin-top: 30px;
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 13px 20px;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            font-family: Arial, sans-serif;
            display: inline-block;
        }

        .btn-pay {
            background: #0d6efd;
            color: white;
        }

        .btn-pay:hover {
            background: #0b5ed7;
        }

        .btn-fail {
            background: #dc3545;
            color: white;
        }

        .btn-fail:hover {
            background: #bb2d3b;
        }

        .btn-back {
            background: #6c757d;
            color: white;
        }

        .btn-back:hover {
            background: #5c636a;
        }

        .btn-pay:disabled {
            background: #adb5bd;
            cursor: not-allowed;
        }

        .btn-fail:disabled {
            background: #adb5bd;
            cursor: not-allowed;
        }

        .warning {
            margin-top: 20px;
            color: #777;
            font-size: 13px;
            line-height: 1.5;
        }

        .simulation {
            margin-top: 20px;
            padding: 15px;
            background: #fff5f5;
            border: 1px dashed #dc3545;
            border-radius: 10px;
        }

        .simulation-title {
            color: #842029;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .simulation-text {
            color: #666;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 12px;
        }

    </style>

</head>


<body>

<div class="container">

    <div class="card">

        {{-- ICON --}}
        <div class="icon">
            ⏳
        </div>


        {{-- JUDUL --}}
        <h1>
            Menunggu Pembayaran
        </h1>


        <div class="subtitle">

            Silakan selesaikan pembayaran Anda.
            Waktu pembayaran tersedia selama 15 menit.

        </div>


        {{-- =========================
             TIMER
        ========================= --}}

        <div class="timer-box">

            <div class="timer-title">
                Waktu Pembayaran Tersisa
            </div>

            <div id="timer">
                15:00
            </div>

        </div>


        {{-- =========================
             INFORMASI PEMBAYARAN
        ========================= --}}

        <div class="payment-info">

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
                    ID Sesi
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

                    @if($payment->metode === 'ewallet')

                        E-Wallet

                    @elseif($payment->metode === 'card')

                        Kartu

                    @elseif($payment->metode === 'qr')

                        QRIS

                    @elseif($payment->metode === 'saldo')

                        Saldo

                    @else

                        {{ strtoupper($payment->metode) }}

                    @endif

                </span>

            </div>

        </div>


        {{-- =========================
             QRIS
        ========================= --}}

        @if($payment->metode === 'qr')

            <div class="qris">

                <div class="qris-title">
                    Scan QRIS untuk Membayar
                </div>

                <img
                    src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=EVChargeHub-Payment-{{ $payment->id_payment }}-Rp{{ $payment->jumlah }}"
                    alt="QRIS EVChargeHub"
                >

                <div class="qris-text">

                    Scan QR Code menggunakan aplikasi
                    pembayaran yang mendukung QRIS.

                    <br>

                    QR Code ini merupakan QR Code
                    <strong>simulasi</strong> untuk sistem EVChargeHub.

                </div>

            </div>

        @endif


        {{-- =========================
             TOTAL
        ========================= --}}

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


        {{-- =========================
             STATUS
        ========================= --}}

        <div
            id="status-message"
            class="status"
        >

            Menunggu pembayaran...

        </div>


        {{-- =========================
             BUTTON
        ========================= --}}

        <div class="buttons">

            {{-- PEMBAYARAN BERHASIL --}}

            <form
                action="{{ route(
                    'payment.complete',
                    $payment->id_payment
                ) }}"
                method="POST"
                id="complete-payment-form"
            >

                @csrf

                <button
                    type="submit"
                    class="btn btn-pay"
                    id="pay-button"
                >

                    ✓ Saya Sudah Membayar

                </button>

            </form>


            {{-- KEMBALI --}}

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


        {{-- =========================
             SIMULASI PEMBAYARAN GAGAL
        ========================= --}}

        <div class="simulation">

            <div class="simulation-title">
                Simulasi Pembayaran Gagal
            </div>

            <div class="simulation-text">

                Gunakan tombol di bawah untuk menguji
                kondisi pembayaran gagal dan notifikasi
                pembayaran gagal.

            </div>

            <form
                action="{{ route(
                    'payment.fail',
                    $payment->id_payment
                ) }}"
                method="POST"
                id="fail-payment-form"
            >

                @csrf

                <button
                    type="submit"
                    class="btn btn-fail"
                    id="fail-button"
                >

                    ✕ Simulasikan Pembayaran Gagal

                </button>

            </form>

        </div>


        <div class="warning">

            Jangan menutup halaman sebelum pembayaran
            selesai diproses.

        </div>

    </div>

</div>


{{-- =========================
     JAVASCRIPT TIMER
========================= --}}

<script>

    const remainingFromServer = {{ max(
        0,
        (int) now()->diffInSeconds(
            $payment->created_at->copy()->addMinutes(15),
            false
        )
    ) }};

    let remainingSeconds = Math.floor(remainingFromServer);

    const timerElement =
        document.getElementById('timer');

    const statusMessage =
        document.getElementById('status-message');

    const payButton =
        document.getElementById('pay-button');

    const failButton =
        document.getElementById('fail-button');

    let timer = null;


    function updateTimer() {

        if (remainingSeconds <= 0) {

            timerElement.textContent = '00:00';

            timerElement.classList.add('expired');

            if (statusMessage) {

                statusMessage.textContent =
                    'Waktu pembayaran telah habis. Pembayaran akan dinyatakan gagal.';

                statusMessage.classList.add('expired');

            }

            if (payButton) {
                payButton.disabled = true;
            }

            if (failButton) {
                failButton.disabled = true;
            }

            clearInterval(timer);

            return;
        }


        const minutes =
            Math.floor(remainingSeconds / 60);

        const seconds =
            Math.floor(remainingSeconds % 60);


        timerElement.textContent =
            String(minutes).padStart(2, '0')
            + ':'
            + String(seconds).padStart(2, '0');


        remainingSeconds--;

    }


    updateTimer();

    timer = setInterval(updateTimer, 1000);

</script>


</body>

</html>