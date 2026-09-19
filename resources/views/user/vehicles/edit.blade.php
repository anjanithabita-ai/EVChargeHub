<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Kendaraan - EVChargeHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7f6;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #198754;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #198754;
        }

        .error {
            background: #f8d7da;
            color: #842029;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error ul {
            margin-left: 20px;
        }

        button,
        a {
            padding: 11px 18px;
            border-radius: 7px;
            border: none;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .save {
            background: #198754;
            color: white;
        }

        .back {
            background: #6c757d;
            color: white;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Kendaraan</h1>


    @if ($errors->any())

        <div class="error">

            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('vehicles.update', $vehicle->id_vehicle) }}"
    >

        @csrf
        @method('PUT')


        <div class="form-group">

            <label for="merek">
                Merek Kendaraan
            </label>

            <input
                type="text"
                id="merek"
                name="merek"
                value="{{ old('merek', $vehicle->merek) }}"
                required
            >

        </div>


        <div class="form-group">

            <label for="model">
                Model Kendaraan
            </label>

            <input
                type="text"
                id="model"
                name="model"
                value="{{ old('model', $vehicle->model) }}"
                required
            >

        </div>


        <div class="form-group">

            <label for="nomor_polisi">
                Nomor Polisi
            </label>

            <input
                type="text"
                id="nomor_polisi"
                name="nomor_polisi"
                value="{{ old('nomor_polisi', $vehicle->nomor_polisi) }}"
                required
            >

        </div>


        <div class="form-group">

            <label for="tipe_konektor">
                Tipe Konektor
            </label>

            <select
                id="tipe_konektor"
                name="tipe_konektor"
                required
            >

                <option value="CCS2"
                    {{ old('tipe_konektor', $vehicle->tipe_konektor) == 'CCS2' ? 'selected' : '' }}>
                    CCS2
                </option>

                <option value="CHAdeMO"
                    {{ old('tipe_konektor', $vehicle->tipe_konektor) == 'CHAdeMO' ? 'selected' : '' }}>
                    CHAdeMO
                </option>

                <option value="Type 2"
                    {{ old('tipe_konektor', $vehicle->tipe_konektor) == 'Type 2' ? 'selected' : '' }}>
                    Type 2
                </option>

            </select>

        </div>


        <div class="buttons">

            <button type="submit" class="save">
                Simpan Perubahan
            </button>

            <a
                href="{{ route('vehicles.index') }}"
                class="back">
                Kembali
            </a>

        </div>

    </form>

</div>

</body>

</html>