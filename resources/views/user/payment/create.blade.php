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
            box-shadow: 0 3px 12px rgba(0, 0, 0, .08);
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
           VIRTUAL ACCOUNT
        ========================= */

        .va-detail {
            display: none;
            margin-top: 20px;
            padding: 20px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 12px;
        }

        .va-title {
            font-size: 20px;
            font-weight: bold;
            color: #0f5132;
            margin-bottom: 15px;
        }

        .va-bank {
            margin-bottom: 15px;
            color: #555;
        }

        .va-label {
            font-size: 13px;
            color: #777;
            margin-bottom: 6px;
        }

        .va-number {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .copy-va {
            margin-left: auto;
            border: none;
            background: #0d6efd;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            white-space: nowrap;
        }

        .copy-va:hover {
            background: #0b5ed7;
        }

        .va-amount {
            margin-top: 15px;
            font-size: 15px;
        }

        .va-amount strong {
            color: #0f5132;
            font-size: 18px;
        }

        .va-warning {
            margin-top: 15px;
            padding: 10px;
            background: #fff3cd;
            color: #664d03;
            border-radius: 8px;
            font-size: 13px;
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
            box-shadow: 0 3px 10px rgba(0, 0, 0, .1);
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

            .va-number {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            .copy-va {
                margin-left: 0;
                width: 100%;
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
            VIRTUAL ACCOUNT
        ====================================== --}}

        <label class="method">

            <input
                type="radio"
                name="metode"
                value="virtual_account"
                required
            >

            <span class="method-name">
                🏦 Transfer Virtual Account
            </span>

            <span class="method-description">
                Transfer melalui Virtual Account bank
            </span>

        </label>

        <div
            class="sub-options"
            id="va-options"
        >

            <strong>
                Pilih Bank
            </strong>

            <select
                name="bank_va"
                id="bank_va"
            >
                <option value="">
                    -- Pilih Bank --
                </option>

                <option value="bca">
                    BCA
                </option>

                <option value="bni">
                    BNI
                </option>

                <option value="bri">
                    BRI
                </option>

                <option value="mandiri">
                    Bank Mandiri
                </option>

                <option value="cimb">
                    CIMB Niaga
                </option>

                <option value="permata">
                    PermataBank
                </option>

                <option value="bsi">
                    Bank Syariah Indonesia
                </option>

                <option value="danamon">
                    Bank Danamon
                </option>

                <option value="btn">
                    Bank BTN
                </option>

                <option value="ocbc">
                    OCBC
                </option>

                <option value="mega">
                    Bank Mega
                </option>

                <option value="panin">
                    PaninBank
                </option>

                <option value="maybank">
                    Maybank Indonesia
                </option>

                <option value="uob">
                    UOB Indonesia
                </option>

                <option value="dbs">
                    DBS Indonesia
                </option>

                <option value="jago">
                    Bank Jago
                </option>

                <option value="seabank">
                    SeaBank
                </option>

                <option value="neo">
                    Bank Neo Commerce
                </option>

                <option value="btpn">
                    SMBC Indonesia
                </option>
            </select>

            <p style="font-size:13px;color:#777;margin-bottom:0;margin-top:10px;">
                Pilih bank yang akan digunakan untuk melakukan transfer
                Virtual Account.
            </p>

        </div>


            {{-- 

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


            {{-- <div
                id="qris-container"
                class="qris-container"
            >

                <div class="qris-title">
                    Scan QRIS
                </div>

                <div class="qris-description">

                    QR Code simulasi untuk kebutuhan
                    sistem EVChargeHub.

                </div> --}}

                {{-- <div class="qris-box">

                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode('EVChargeHub-Payment-' . $session->id_session . '-Rp' . $session->total_biaya) }}"
                        alt="QRIS EVChargeHub"
                    >

                </div> --}}

                {{-- <div class="qris-amount">

                    Rp

                    {{ number_format(
                        (float) $session->total_biaya,
                        0,
                        ',',
                        '.'
                    ) }}

                </div> --}}

                {{-- <div style="margin-top:5px;color:#777;font-size:13px;">

                    ID Sesi:
                    #{{ $session->id_session }}

                </div>

                <div class="qris-warning">

                    QR Code ini bukan QRIS pembayaran aktif.

                </div>

            </div> --}}


         


            {{-- =====================================
                 ERROR VIRTUAL ACCOUNT
            ====================================== --}}

            @error('bank_va')

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

document.addEventListener('DOMContentLoaded', function () {

    /* =========================
       ELEMENT
    ========================= */

    const radios =
        document.querySelectorAll(
            'input[name="metode"]'
        );

    const vaBox =
        document.getElementById(
            'va-options'
        );

    const vaSelect =
        document.getElementById(
            'bank_va'
        );

    const vaDetail =
        document.getElementById(
            'va-detail'
        );

    const vaBankName =
        document.getElementById(
            'va-bank-name'
        );

    const vaNumber =
        document.getElementById(
            'va-number'
        );

    const cardBox =
        document.getElementById(
            'card-options'
        );

    const qrisBox =
        document.getElementById(
            'qris-container'
        );

    const cardSelect =
        document.getElementById(
            'card_type'
        );

    const paymentButton =
        document.getElementById(
            'payment-button'
        );


    /* =========================
       DATA BANK
    ========================= */

    const bankNames = {

        bca: 'BCA',

        bni: 'BNI',

        bri: 'BRI',

        mandiri: 'Bank Mandiri',

        cimb: 'CIMB Niaga',

        permata: 'PermataBank',

        bsi: 'Bank Syariah Indonesia',

        danamon: 'Bank Danamon'

    };


    const bankCodes = {

        bca: '014',

        bni: '009',

        bri: '002',

        mandiri: '008',

        cimb: '022',

        permata: '013',

        bsi: '451',

        danamon: '011'

    };


    /* =========================
       UBAH METODE PEMBAYARAN
    ========================= */

    function togglePayment() {

        const selected =
            document.querySelector(
                'input[name="metode"]:checked'
            );

        const method =
            selected
                ? selected.value
                : '';


        /* =========================
           VIRTUAL ACCOUNT
        ========================= */

        vaBox.style.display =
            method === 'virtual_account'
                ? 'block'
                : 'none';

        vaSelect.disabled =
            method !== 'virtual_account';

        vaSelect.required =
            method === 'virtual_account';


        /* =========================
           KARTU
        ========================= */

        cardBox.style.display =
            method === 'card'
                ? 'block'
                : 'none';

        cardSelect.disabled =
            method !== 'card';

        cardSelect.required =
            method === 'card';


        /* =========================
           QRIS
        ========================= */

        qrisBox.style.display =
            method === 'qr'
                ? 'block'
                : 'none';


        /* =========================
           RESET PILIHAN
        ========================= */

        if (method !== 'virtual_account') {

            vaSelect.value = '';

            vaDetail.style.display = 'none';

            vaBankName.innerText = '-';

            vaNumber.innerText = '-';

        }


        if (method !== 'card') {

            cardSelect.value = '';

        }


        /* =========================
           TOMBOL
        ========================= */

        paymentButton.disabled =
            method === '';

    }


    /* =========================
       EVENT RADIO
    ========================= */

    radios.forEach(function (radio) {

        radio.addEventListener(
            'change',
            togglePayment
        );

    });


    /* =========================
       PILIH BANK VA
    ========================= */

    vaSelect.addEventListener(
        'change',
        function () {

            const bank =
                this.value;


            if (!bank) {

                vaDetail.style.display =
                    'none';

                vaBankName.innerText =
                    '-';

                vaNumber.innerText =
                    '-';

                return;

            }


            const bankCode =
                bankCodes[bank];


            const sessionId =
                String(
                    {{ $session->id_session }}
                ).padStart(6, '0');


            /*
             * Nomor VA simulasi.
             *
             * Format:
             * 8808 + kode bank + ID sesi
             */

            const va =
                '8808' +
                bankCode +
                sessionId;


            vaBankName.innerText =
                bankNames[bank];


            vaNumber.innerText =
                va;


            vaDetail.style.display =
                'block';

        }
    );


    /* =========================
       SUBMIT FORM
    ========================= */

    document
        .getElementById('payment-form')
        .addEventListener(
            'submit',
            function (event) {

                const selected =
                    document.querySelector(
                        'input[name="metode"]:checked'
                    );


                /* =========================
                   CEK METODE
                ========================= */

                if (!selected) {

                    event.preventDefault();

                    alert(
                        'Silakan pilih metode pembayaran terlebih dahulu.'
                    );

                    return;

                }


                /* =========================
                   VALIDASI VIRTUAL ACCOUNT
                ========================= */

                if (
                    selected.value === 'virtual_account'
                    &&
                    !vaSelect.value
                ) {

                    event.preventDefault();

                    alert(
                        'Silakan pilih bank terlebih dahulu.'
                    );

                    vaSelect.focus();

                    return;

                }


                /* =========================
                   VALIDASI KARTU
                ========================= */

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


                /* =========================
                   PROSES
                ========================= */

                paymentButton.disabled =
                    true;

                paymentButton.innerText =
                    '⏳ Memproses Pembayaran...';

            }
        );


    /* =========================
       JALANKAN SAAT HALAMAN DIBUKA
    ========================= */

    togglePayment();

});


/* =========================
   COPY NOMOR VA
========================= */

function copyVA() {

    const number =
        document.getElementById(
            'va-number'
        ).innerText;


    if (
        !number ||
        number === '-'
    ) {

        alert(
            'Nomor Virtual Account belum tersedia.'
        );

        return;

    }


    if (
        navigator.clipboard &&
        window.isSecureContext
    ) {

        navigator.clipboard
            .writeText(number)
            .then(function () {

                alert(
                    'Nomor Virtual Account berhasil disalin.'
                );

            })
            .catch(function () {

                alert(
                    'Nomor Virtual Account: ' +
                    number
                );

            });

    } else {

        alert(
            'Nomor Virtual Account: ' +
            number
        );

    }

}

</script>


</body>

</html>