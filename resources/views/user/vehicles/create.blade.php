<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Kendaraan - EVChargeHub</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family: Arial, sans-serif;

            background: #f5f7fa;

            color: #1f2937;
        }


        .container {
            max-width: 700px;

            margin: 50px auto;

            background: white;

            padding: 30px;

            border-radius: 12px;

            box-shadow:
                0 4px 15px
                rgba(0,0,0,0.08);
        }


        h2 {
            margin-top: 0;

            margin-bottom: 25px;

            color: #064e3b;
        }


        .form-group {
            margin-bottom: 18px;
        }


        label {
            display: block;

            margin-bottom: 7px;

            font-weight: bold;
        }


        input,
        select {
            width: 100%;

            padding: 11px;

            border:
                1px solid #ccc;

            border-radius: 7px;

            box-sizing: border-box;

            background: white;

            font-family: Arial, sans-serif;

            font-size: 14px;
        }


        input:focus,
        select:focus {
            outline: none;

            border-color: #198754;

            box-shadow:
                0 0 0 3px
                rgba(25,135,84,0.10);
        }


        select:disabled {
            background: #f1f5f9;

            color: #94a3b8;

            cursor: not-allowed;
        }


        .error {
            color: #dc3545;

            font-size: 14px;

            margin-top: 5px;
        }


        .required {
            color: #dc3545;
        }


        .buttons {
            margin-top: 25px;

            display: flex;

            gap: 10px;
        }


        button,
        .btn-back {
            padding:
                11px 18px;

            border: none;

            border-radius: 7px;

            text-decoration: none;

            cursor: pointer;

            font-size: 14px;
        }


        button {
            background: #198754;

            color: white;
        }


        button:hover {
            background: #157347;
        }


        .btn-back {
            background: #6c757d;

            color: white;
        }


        .btn-back:hover {
            background: #5c636a;
        }


        /* RESPONSIVE */

        @media(max-width: 750px) {

            .container {
                margin:
                    20px;

                padding:
                    25px 20px;
            }

        }

    </style>

</head>


<body>


<div class="container">

    <h2>
        Tambah Kendaraan
    </h2>


    <form
        action="{{ route('vehicles.store') }}"
        method="POST"
    >

        @csrf


        <!-- =================================================
             MEREK KENDARAAN
        ================================================== -->

        <div class="form-group">

            <label for="merek">

                Merek Kendaraan

                <span class="required">*</span>

            </label>


            <select
                id="merek"
                name="merek"
                required
            >

                <option value="">
                    -- Pilih Merek Kendaraan --
                </option>


                <option
                    value="Hyundai"
                    {{ old('merek') == 'Hyundai' ? 'selected' : '' }}
                >
                    Hyundai
                </option>


                <option
                    value="Wuling"
                    {{ old('merek') == 'Wuling' ? 'selected' : '' }}
                >
                    Wuling
                </option>


                <option
                    value="BYD"
                    {{ old('merek') == 'BYD' ? 'selected' : '' }}
                >
                    BYD
                </option>


                <option
                    value="MG"
                    {{ old('merek') == 'MG' ? 'selected' : '' }}
                >
                    MG
                </option>


                <option
                    value="Chery"
                    {{ old('merek') == 'Chery' ? 'selected' : '' }}
                >
                    Chery
                </option>


                <option
                    value="Neta"
                    {{ old('merek') == 'Neta' ? 'selected' : '' }}
                >
                    Neta
                </option>


                <option
                    value="Seres"
                    {{ old('merek') == 'Seres' ? 'selected' : '' }}
                >
                    Seres
                </option>


                <option
                    value="DFSK"
                    {{ old('merek') == 'DFSK' ? 'selected' : '' }}
                >
                    DFSK
                </option>


                <option
                    value="Kia"
                    {{ old('merek') == 'Kia' ? 'selected' : '' }}
                >
                    Kia
                </option>


                <option
                    value="Nissan"
                    {{ old('merek') == 'Nissan' ? 'selected' : '' }}
                >
                    Nissan
                </option>


                <option
                    value="Tesla"
                    {{ old('merek') == 'Tesla' ? 'selected' : '' }}
                >
                    Tesla
                </option>


                <option
                    value="BMW"
                    {{ old('merek') == 'BMW' ? 'selected' : '' }}
                >
                    BMW
                </option>


                <option
                    value="Mercedes-Benz"
                    {{ old('merek') == 'Mercedes-Benz' ? 'selected' : '' }}
                >
                    Mercedes-Benz
                </option>


                <option
                    value="Volvo"
                    {{ old('merek') == 'Volvo' ? 'selected' : '' }}
                >
                    Volvo
                </option>


                <option
                    value="Zeekr"
                    {{ old('merek') == 'Zeekr' ? 'selected' : '' }}
                >
                    Zeekr
                </option>


                <option
                    value="AION"
                    {{ old('merek') == 'AION' ? 'selected' : '' }}
                >
                    AION
                </option>


                <option
                    value="Porsche"
                    {{ old('merek') == 'Porsche' ? 'selected' : '' }}
                >
                    Porsche
                </option>


                <option
                    value="Audi"
                    {{ old('merek') == 'Audi' ? 'selected' : '' }}
                >
                    Audi
                </option>

            </select>


            @error('merek')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>


        <!-- =================================================
             MODEL KENDARAAN
        ================================================== -->

        <div class="form-group">

            <label for="model">

                Model Kendaraan

                <span class="required">*</span>

            </label>


            <select
                id="model"
                name="model"
                required
                disabled
            >

                <option value="">
                    -- Pilih Merek Terlebih Dahulu --
                </option>

            </select>


            @error('model')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>


        <!-- =================================================
             NOMOR POLISI
        ================================================== -->

        <div class="form-group">

            <label for="nomor_polisi">

                Nomor Polisi

                <span class="required">*</span>

            </label>


            <input
                type="text"
                id="nomor_polisi"
                name="nomor_polisi"
                value="{{ old('nomor_polisi') }}"
                placeholder="Contoh: AB 1234 CD"
                required
            >


            @error('nomor_polisi')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>


        <!-- =================================================
             TIPE KONEKTOR
        ================================================== -->

        <div class="form-group">

            <label for="tipe_konektor">

                Tipe Konektor

                <span class="required">*</span>

            </label>


            <select
                id="tipe_konektor"
                name="tipe_konektor"
                required
            >

                <option value="">
                    -- Pilih Tipe Konektor --
                </option>


                <option
                    value="CCS2"
                    {{ old('tipe_konektor') == 'CCS2' ? 'selected' : '' }}
                >
                    CCS2
                </option>


                <option
                    value="CHAdeMO"
                    {{ old('tipe_konektor') == 'CHAdeMO' ? 'selected' : '' }}
                >
                    CHAdeMO
                </option>


                <option
                    value="Type 2"
                    {{ old('tipe_konektor') == 'Type 2' ? 'selected' : '' }}
                >
                    Type 2
                </option>


                <option
                    value="GB/T"
                    {{ old('tipe_konektor') == 'GB/T' ? 'selected' : '' }}
                >
                    GB/T
                </option>

            </select>


            @error('tipe_konektor')

                <div class="error">
                    {{ $message }}
                </div>

            @enderror

        </div>


        <!-- =================================================
             BUTTON
        ================================================== -->

        <div class="buttons">

            <button type="submit">

                Simpan Kendaraan

            </button>


            <a
                href="{{ route('vehicles.index') }}"
                class="btn-back"
            >

                Kembali

            </a>

        </div>


    </form>

</div>



<!-- =====================================================
     JAVASCRIPT MODEL BERDASARKAN MEREK
====================================================== -->

<script>

    /*
     * Daftar model kendaraan berdasarkan merek
     */

    const models = {

        Hyundai: [
            "Ioniq 5",
            "Ioniq 6",
            "Kona Electric"
        ],

        Wuling: [
            "Air ev",
            "BinguoEV",
            "Cloud EV"
        ],

        BYD: [
            "Dolphin",
            "Atto 3",
            "Seal",
            "M6"
        ],

        MG: [
            "4 EV",
            "Zs EV",
            "Maxus 9"
        ],

        Chery: [
            "Omoda E5",
            "J6"
        ],

        Neta: [
            "V-II",
            "V"
        ],

        Seres: [
            "E1",
            "3"
        ],

        DFSK: [
            "Gelora E"
        ],

        Kia: [
            "EV6",
            "EV9",
            "Niro EV"
        ],

        Nissan: [
            "Leaf"
        ],

        Tesla: [
            "Model 3",
            "Model Y",
            "Model S",
            "Model X"
        ],

        BMW: [
            "i4",
            "i5",
            "i7",
            "iX",
            "iX1"
        ],

        "Mercedes-Benz": [
            "EQA",
            "EQB",
            "EQE",
            "EQS"
        ],

        Volvo: [
            "EX30",
            "EX40",
            "EC40",
            "EX90"
        ],

        Zeekr: [
            "X",
            "009"
        ],

        AION: [
            "Y Plus",
            "ES"
        ],

        Porsche: [
            "Taycan",
            "Macan Electric"
        ],

        Audi: [
            "Q4 e-tron",
            "Q8 e-tron",
            "e-tron GT"
        ]

    };


    /*
     * Ambil elemen dropdown
     */

    const merekSelect =
        document.getElementById('merek');

    const modelSelect =
        document.getElementById('model');


    /*
     * Model lama dari Laravel
     * digunakan jika validasi gagal
     */

    const oldModel =
        @json(old('model'));


    /*
     * Ketika merek dipilih
     */

    merekSelect.addEventListener(
        'change',
        function () {

            const merek =
                this.value;


            /*
             * Kosongkan model
             */

            modelSelect.innerHTML =
                '<option value="">-- Pilih Model Kendaraan --</option>';


            /*
             * Jika belum memilih merek
             */

            if (!merek) {

                modelSelect.disabled = true;

                return;

            }


            /*
             * Aktifkan dropdown model
             */

            modelSelect.disabled = false;


            /*
             * Ambil daftar model
             */

            const daftarModel =
                models[merek] || [];


            /*
             * Masukkan model ke dropdown
             */

            daftarModel.forEach(
                function (model) {

                    const option =
                        document.createElement('option');


                    option.value =
                        model;


                    option.textContent =
                        model;


                    /*
                     * Pertahankan pilihan
                     * jika validasi sebelumnya gagal
                     */

                    if (model === oldModel) {

                        option.selected = true;

                    }


                    modelSelect.appendChild(option);

                }
            );

        }
    );


    /*
     * Jika halaman dibuka kembali
     * setelah validasi gagal
     */

    if (merekSelect.value) {

        merekSelect.dispatchEvent(
            new Event('change')
        );

    }

</script>


</body>

</html>