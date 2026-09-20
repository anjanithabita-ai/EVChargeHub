<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pembayaran - EVChargeHub</title>


    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            color: #212529;
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
            box-shadow: 0 3px 12px rgba(0,0,0,.08);
        }

        h1 {
            margin-top: 0;
            color: #0f5132;
        }

        .subtitle {
            color: #666;
            margin-bottom: 25px;
        }


        /* =========================
           INFORMASI TRANSAKSI
        ========================= */

        .info {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            line-height: 1.5;
        }

        .label {
            font-weight: bold;
        }


        /* =========================
           TOTAL
        ========================= */

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


        /* =========================
           METODE PEMBAYARAN
        ========================= */

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
            transition: .2s;
        }

        .method:hover {
            background: #f8f9fa;
        }

        .method:has(input:checked) {
            border-color: #198754;
            background: #f0fff6;
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


        /* =========================
           SUB OPTIONS
        ========================= */

        .sub-options {
            display: none;
            margin: 10px 0 18px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .sub-options select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            margin-top: 8px;
            background: white;
            font-size: 14px;
        }


        /* =========================
           QRIS
        ========================= */

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
            box-shadow: 0 3px 10px rgba(0,0,0,.1);
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

        .qris-warning {
            margin-top: 15px;
            padding: 10px;
            background: #fff3cd;
            color: #664d03;
            border-radius: 8px;
            font-size: 13px;
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

        .btn-payment {
            background: #0d6efd;
        }

        .btn-payment:hover {
            background: #0b5ed7;
        }

        .btn-payment:disabled {
            background: #9bbcf5;
            cursor: not-allowed;
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

        .alert-error {
            background: #f8d7da;
            color: #842029;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 10px;
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

            .buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

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


        {{-- =========================================
             ERROR
        ========================================== --}}

        @if(session('error'))

            <div class="alert alert-error">
                {{ session('error') }}
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


        {{-- =========================================
             KENDARAAN
        ========================================== --}}

        <div class="info">

            <span class="label">
                Kendaraan:
            </span>

            {{ $session->vehicle->merek }}
            {{ $session->vehicle->model }}

        </div>


        {{-- =========================================
             NOMOR POLISI
        ========================================== --}}

        <div class="info">

            <span class="label">
                Nomor Polisi:
            </span>

            {{ $session->vehicle->nomor_polisi }}

        </div>


        {{-- =========================================
             ENERGI
        ========================================== --}}

        <div class="info">

            <span class="label">
                Energi:
            </span>

            {{ number_format(
                (float) $session->energi_kwh,
                2,
                ',',
                '.'
            ) }}

            kWh

        </div>


        {{-- =========================================
             DURASI
        ========================================== --}}

        <div class="info">

            <span class="label">
                Durasi Charging:
            </span>

            {{ $session->durasi_menit }}
            menit

        </div>


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
             TOTAL
        ========================================== --}}

        <div class="total">

            <div class="total-label">
                Total Pembayaran
            </div>

            <div class="total-price">

                Rp

                {{ number_format(
                    (float) $session->total_biaya,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

        </div>


        {{-- =========================================
             PILIH METODE
        ========================================== --}}

        <div class="payment-title">
            Pilih Metode Pembayaran
        </div>


        <form
            id="payment-form"
            action="{{ route(
                'payment.process',
                $session->id_session
            ) }}"
            method="POST"
        >

            @csrf


            {{-- =====================================
                 E-WALLET
            ====================================== --}}

            <label class="method">

                <input
                    type="radio"
                    name="metode"
                    value="ewallet"
                    required
                >

                <span class="method-name">
                    📱 E-Wallet
                </span>

                <span class="method-description">
                    GoPay, OVO, DANA, atau ShopeePay
                </span>

            </label>


            <div
                class="sub-options"
                id="ewallet-options"
            >

                <strong>
                    Pilih E-Wallet
                </strong>

                <select
                    name="ewallet"
                    id="ewallet"
                    disabled
                >

                    <option value="">
                        -- Pilih E-Wallet --
                    </option>

                    <option value="gopay">
                        GoPay
                    </option>

                    <option value="ovo">
                        OVO
                    </option>

                    <option value="dana">
                        DANA
                    </option>

                    <option value="shopeepay">
                        ShopeePay
                    </option>

                </select>

            </div>


            {{-- =====================================
                 KARTU
            ====================================== --}}

            <label class="method">

                <input
                    type="radio"
                    name="metode"
                    value="card"
                >

                <span class="method-name">
                    💳 Kartu Debit / Kredit
                </span>

                <span class="method-description">
                    Pembayaran menggunakan kartu debit atau kredit
                </span>

            </label>


            <div
                class="sub-options"
                id="card-options"
            >

                <strong>
                    Jenis Kartu
                </strong>

                <select
                    name="card_type"
                    id="card_type"
                    disabled
                >

                    <option value="">
                        -- Pilih Jenis Kartu --
                    </option>

                    <option value="visa">
                        Visa
                    </option>

                    <option value="mastercard">
                        Mastercard
                    </option>

                    <option value="debit">
                        Kartu Debit
                    </option>

                </select>


                <p style="font-size:13px;color:#777;margin-bottom:0;">

                    Ini merupakan simulasi pembayaran.
                    Pembayaran kartu sungguhan memerlukan payment gateway.

                </p>

            </div>


            {{-- =====================================
                 QRIS
            ====================================== --}}

            <label class="method">

                <input
                    type="radio"
                    name="metode"
                    value="qr"
                >

                <span class="method-name">
                    ▦ QRIS
                </span>

                <span class="method-description">
                    Pembayaran menggunakan QRIS
                </span>

            </label>


            <div
                id="qris-container"
                class="qris-container"
            >

                <div class="qris-title">
                    Scan QRIS
                </div>


                <div class="qris-description">

                    QR Code simulasi untuk kebutuhan
                    sistem EVChargeHub.

                </div>


                <div class="qris-box">

                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=EVChargeHub-Payment-{{ $session->id_session }}-Rp{{ $session->total_biaya }}"
                        alt="QRIS EVChargeHub"
                    >

                </div>


                <div class="qris-amount">

                    Rp

                    {{ number_format(
                        (float) $session->total_biaya,
                        0,
                        ',',
                        '.'
                    ) }}

                </div>


                <div style="margin-top:5px;color:#777;font-size:13px;">

                    ID Sesi:
                    #{{ $session->id_session }}

                </div>


                <div class="qris-warning">

                    QR Code ini bukan QRIS pembayaran aktif.

                </div>

            </div>


            {{-- =====================================
                 SALDO
            ====================================== --}}

            <label class="method">

                <input
                    type="radio"
                    name="metode"
                    value="saldo"
                >

                <span class="method-name">
                    💰 Saldo
                </span>

                <span class="method-description">
                    Pembayaran menggunakan saldo akun.
                </span>

            </label>


            {{-- =====================================
                 ERROR E-WALLET
            ====================================== --}}

            @error('ewallet')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror


            {{-- =====================================
                 ERROR KARTU
            ====================================== --}}

            @error('card_type')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror


            {{-- =====================================
                 ERROR METODE
            ====================================== --}}

            @error('metode')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror


            {{-- =====================================
                 BUTTON
            ====================================== --}}

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
                    id="payment-button"
                    class="btn btn-payment"
                >
                    💳 Proses Pembayaran
                </button>


            </div>


        </form>


    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /*
        |--------------------------------------------------------------------------
        | ELEMENT
        |--------------------------------------------------------------------------
        */

        const radios =
            document.querySelectorAll(
                'input[name="metode"]'
            );


        const ewalletBox =
            document.getElementById(
                'ewallet-options'
            );


        const cardBox =
            document.getElementById(
                'card-options'
            );


        const qrisBox =
            document.getElementById(
                'qris-container'
            );


        const ewalletSelect =
            document.getElementById(
                'ewallet'
            );


        const cardSelect =
            document.getElementById(
                'card_type'
            );


        const paymentButton =
            document.getElementById(
                'payment-button'
            );


        /*
        |--------------------------------------------------------------------------
        | UBAH METODE PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        function togglePayment() {


            const selected =
                document.querySelector(
                    'input[name="metode"]:checked'
                );


            const method =
                selected
                    ? selected.value
                    : '';


            /*
            | E-Wallet
            */

            ewalletBox.style.display =
                method === 'ewallet'
                    ? 'block'
                    : 'none';


            /*
            | Kartu
            */

            cardBox.style.display =
                method === 'card'
                    ? 'block'
                    : 'none';


            /*
            | QRIS
            */

            qrisBox.style.display =
                method === 'qr'
                    ? 'block'
                    : 'none';


            /*
            | Aktifkan E-Wallet
            */

            ewalletSelect.disabled =
                method !== 'ewallet';


            ewalletSelect.required =
                method === 'ewallet';


            /*
            | Aktifkan Kartu
            */

            cardSelect.disabled =
                method !== 'card';


            cardSelect.required =
                method === 'card';


            /*
            | Reset pilihan yang tidak digunakan
            */

            if (method !== 'ewallet') {

                ewalletSelect.value = '';

            }


            if (method !== 'card') {

                cardSelect.value = '';

            }


            /*
            | Tombol pembayaran selalu aktif
            | setelah metode dipilih.
            */

            paymentButton.disabled =
                method === '';

        }


        /*
        |--------------------------------------------------------------------------
        | EVENT RADIO
        |--------------------------------------------------------------------------
        */

        radios.forEach(
            function (radio) {

                radio.addEventListener(
                    'change',
                    togglePayment
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | CEK SEBELUM SUBMIT
        |--------------------------------------------------------------------------
        */

        document
            .getElementById('payment-form')
            .addEventListener(
                'submit',
                function (event) {


                    const selected =
                        document.querySelector(
                            'input[name="metode"]:checked'
                        );


                    if (!selected) {

                        event.preventDefault();

                        alert(
                            'Silakan pilih metode pembayaran terlebih dahulu.'
                        );

                        return;

                    }


                    /*
                    | Validasi E-Wallet
                    */

                    if (
                        selected.value === 'ewallet'
                        &&
                        !ewalletSelect.value
                    ) {

                        event.preventDefault();

                        alert(
                            'Silakan pilih E-Wallet terlebih dahulu.'
                        );

                        ewalletSelect.focus();

                        return;

                    }


                    /*
                    | Validasi kartu
                    */

                    if (
                        selected.value === 'card'
                        &&
                        !cardSelect.value
                    ) {

                        event.preventDefault();

                        alert(
                            'Silakan pilih jenis kartu terlebih dahulu.'
                        );

                        cardSelect.focus();

                        return;

                    }


                    /*
                    | Ubah tulisan tombol
                    */

                    paymentButton.disabled = true;

                    paymentButton.innerText =
                        '⏳ Memproses Pembayaran...';

                }
            );


        /*
        |--------------------------------------------------------------------------
        | JALANKAN SAAT HALAMAN DIBUKA
        |--------------------------------------------------------------------------
        */

        togglePayment();

    }
);

</script>


</body>

</html>