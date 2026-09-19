<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kendaraan - EVChargeHub</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 25px;
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
            border: 1px solid #ccc;
            border-radius: 7px;
            box-sizing: border-box;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }

        .buttons {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        button,
        .btn-back {
            padding: 11px 18px;
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

        .btn-back {
            background: #6c757d;
            color: white;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Tambah Kendaraan</h2>

    <form action="{{ route('vehicles.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="merek">Merek Kendaraan</label>
            <input
                type="text"
                id="merek"
                name="merek"
                value="{{ old('merek') }}"
                placeholder="Contoh: Hyundai"
                required
            >

            @error('merek')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="model">Model Kendaraan</label>
            <input
                type="text"
                id="model"
                name="model"
                value="{{ old('model') }}"
                placeholder="Contoh: Ioniq 5"
                required
            >

            @error('model')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nomor_polisi">Nomor Polisi</label>
            <input
                type="text"
                id="nomor_polisi"
                name="nomor_polisi"
                value="{{ old('nomor_polisi') }}"
                placeholder="Contoh: AB 1234 CD"
                required
            >

            @error('nomor_polisi')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tipe_konektor">Tipe Konektor</label>

            <select id="tipe_konektor" name="tipe_konektor" required>
                <option value="">-- Pilih Tipe Konektor --</option>
                <option value="CCS2" {{ old('tipe_konektor') == 'CCS2' ? 'selected' : '' }}>
                    CCS2
                </option>
                <option value="CHAdeMO" {{ old('tipe_konektor') == 'CHAdeMO' ? 'selected' : '' }}>
                    CHAdeMO
                </option>
                <option value="Type 2" {{ old('tipe_konektor') == 'Type 2' ? 'selected' : '' }}>
                    Type 2
                </option>
                <option value="GB/T" {{ old('tipe_konektor') == 'GB/T' ? 'selected' : '' }}>
                    GB/T
                </option>
            </select>

            @error('tipe_konektor')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="buttons">
            <button type="submit">
                Simpan Kendaraan
            </button>

            <a href="{{ route('vehicles.index') }}" class="btn-back">
                Kembali
            </a>
        </div>

    </form>

</div>

</body>
</html>