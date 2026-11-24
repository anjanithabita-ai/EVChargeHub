<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tarif | EVChargeHub</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7f5;
            color: #26352d;
        }

        .container {
            max-width: 850px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .back {
            color: #176b45;
            text-decoration: none;
            font-size: 14px;
        }

        h1 { margin: 22px 0 8px; }

        .subtitle {
            color: #738078;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .field { margin-bottom: 20px; }

        .field.full { grid-column: 1 / -1; }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #dce5df;
            border-radius: 7px;
            font-size: 14px;
            background: white;
        }

        .hint {
            font-size: 12px;
            color: #738078;
            margin-top: 6px;
        }

        .error {
            color: #b42318;
            font-size: 12px;
            margin-top: 6px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid #edf1ee;
            padding-top: 20px;
            margin-top: 5px;
        }

        .button {
            border: none;
            border-radius: 7px;
            padding: 12px 17px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .primary {
            background: #176b45;
            color: white;
        }

        .secondary {
            background: #edf2ee;
            color: #34483b;
        }

        @media(max-width: 600px) {
            .grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .field.full { grid-column: auto; }

            .card { padding: 20px; }
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('admin.tariffs.index') }}" class="back">
        ← Kembali ke Tarif per Station
    </a>

    <h1>Edit Tarif Charging</h1>

    <p class="subtitle">
        Perbarui informasi tarif untuk charging station yang dipilih.
    </p>

    @if ($errors->any())
        <div style="background:#fde8e8;color:#a52828;padding:15px;border-radius:8px;margin-bottom:20px;">
            <strong>Periksa kembali data berikut:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">

        <form
            action="{{ route('admin.tariffs.update', $tariff->id_tariff) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="grid">

                <div class="field full">
                    <label for="id_location">Charging Station *</label>

                    <select id="id_location" name="id_location" required>
                        <option value="">-- Pilih Charging Station --</option>

                        @foreach ($locations as $location)
                            <option
                                value="{{ $location->id_location }}"
                                {{ old('id_location', $tariff->id_location) == $location->id_location ? 'selected' : '' }}
                            >
                                {{ $location->nama_lokasi }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_location')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="harga_per_kwh">Harga per kWh (Rp) *</label>

                    <input
                        type="number"
                        id="harga_per_kwh"
                        name="harga_per_kwh"
                        min="0"
                        step="0.01"
                        value="{{ old('harga_per_kwh', $tariff->harga_per_kwh) }}"
                        required
                    >

                    @error('harga_per_kwh')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="biaya_minimum">Biaya Minimum (Rp) *</label>

                    <input
                        type="number"
                        id="biaya_minimum"
                        name="biaya_minimum"
                        min="0"
                        step="0.01"
                        value="{{ old('biaya_minimum', $tariff->biaya_minimum) }}"
                        required
                    >

                    @error('biaya_minimum')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="biaya_parkir">Biaya Parkir (Rp) *</label>

                    <input
                        type="number"
                        id="biaya_parkir"
                        name="biaya_parkir"
                        min="0"
                        step="0.01"
                        value="{{ old('biaya_parkir', $tariff->biaya_parkir) }}"
                        required
                    >

                    @error('biaya_parkir')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="status">Status Tarif *</label>

                    <select id="status" name="status" required>
                        <option value="aktif"
                            {{ old('status', $tariff->status) === 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif"
                            {{ old('status', $tariff->status) === 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>

                    @error('status')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="berlaku_mulai">Berlaku Mulai *</label>

                    <input
                        type="date"
                        id="berlaku_mulai"
                        name="berlaku_mulai"
                        value="{{ old(
                            'berlaku_mulai',
                            $tariff->berlaku_mulai
                                ? \Illuminate\Support\Carbon::parse($tariff->berlaku_mulai)->format('Y-m-d')
                                : ''
                        ) }}"
                        required
                    >

                    @error('berlaku_mulai')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="berlaku_selesai">Berlaku Sampai</label>

                    <input
                        type="date"
                        id="berlaku_selesai"
                        name="berlaku_selesai"
                        value="{{ old(
                            'berlaku_selesai',
                            $tariff->berlaku_selesai
                                ? \Illuminate\Support\Carbon::parse($tariff->berlaku_selesai)->format('Y-m-d')
                                : ''
                        ) }}"
                    >

                    <div class="hint">
                        Kosongkan jika tidak ada tanggal akhir.
                    </div>

                    @error('berlaku_selesai')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="actions">
                <a href="{{ route('admin.tariffs.index') }}"
                   class="button secondary">
                    Batal
                </a>

                <button type="submit" class="button primary">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>

</body>
</html>