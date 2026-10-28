```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan Charger - EVChargeHub</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f8f7;
            color: #263b36;
        }

        .page {
            max-width: 900px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .back {
            display: inline-block;
            color: #006b59;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .back:hover {
            color: #004d40;
            text-decoration: underline;
        }

        .top {
            background: linear-gradient(135deg, #006b59, #00856f);
            color: #fff;
            padding: 25px 28px;
            border-radius: 16px;
            margin-bottom: 22px;
        }

        .top h1 {
            font-size: 23px;
            margin: 0 0 8px;
        }

        .top p {
            font-size: 13px;
            line-height: 1.6;
            margin: 0;
            opacity: .93;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e9e8;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 3px 12px #00000008;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin: 18px 0 8px;
            color: #334741;
        }

        select,
        textarea {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d9e2df;
            border-radius: 9px;
            background: #fff;
            font: 14px Arial, Helvetica, sans-serif;
            outline: none;
        }

        select:focus,
        textarea:focus {
            border-color: #00856f;
            box-shadow: 0 0 0 3px #00856f18;
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        .help {
            font-size: 12px;
            color: #82908c;
            margin-top: 7px;
            line-height: 1.5;
        }

        .error {
            color: #b42318;
            background: #fef3f2;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 13px;
            margin-top: 7px;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 9px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .alert-success {
            background: #e8f7ef;
            color: #16865d;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .btn {
            display: inline-block;
            border: 0;
            border-radius: 9px;
            padding: 12px 18px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
        }

        .btn-primary {
            background: #006b59;
            color: #fff;
        }

        .btn-primary:hover {
            background: #005747;
        }

        .btn-secondary {
            background: #eef3f1;
            color: #42514d;
        }

        .btn-secondary:hover {
            background: #e0e9e5;
        }

        @media (max-width: 600px) {
            .page {
                margin: 20px auto;
                padding: 0 12px;
            }

            .card {
                padding: 18px;
            }

            .top {
                padding: 21px;
            }

            .top h1 {
                font-size: 20px;
            }

            .navigation {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
<div class="page">

    <!-- Navigasi halaman -->
    <nav class="navigation">
        <a class="back" href="{{ route('user.dashboard') }}">
            ← Kembali ke Dashboard
        </a>

        <a class="back" href="{{ route('charger-reports.index') }}">
            ← Kembali ke laporan saya
        </a>
    </nav>

    <header class="top">
        <h1>Laporkan Charger Bermasalah</h1>
        <p>
            Bantu kami menjaga kualitas layanan EVChargeHub.
            Pilih charger dan jelaskan masalah yang kamu temukan.
        </p>
    </header>

    <section class="card">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error">
                Periksa kembali data laporan yang kamu isi.
            </div>
        @endif

        <form method="POST" action="{{ route('charger-reports.store') }}">
            @csrf

            <label for="id_charger">Charger yang bermasalah *</label>

            <select id="id_charger" name="id_charger" required>
                <option value="">-- Pilih charger --</option>

                @foreach($chargers as $charger)
                    <option
                        value="{{ $charger->id_charger }}"
                        @selected(old('id_charger') == $charger->id_charger)
                    >
                        {{ $charger->kode_perangkat }}
                        — {{ $charger->location->nama_lokasi ?? 'Lokasi tidak tersedia' }}
                        ({{ ucfirst($charger->status) }})
                    </option>
                @endforeach
            </select>

            @error('id_charger')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="kategori">Kategori masalah *</label>

            <select id="kategori" name="kategori" required>
                <option value="">-- Pilih kategori --</option>

                @foreach([
                    'Tidak dapat digunakan',
                    'Kabel atau konektor rusak',
                    'Layar atau sistem error',
                    'Pengisian tidak berjalan',
                    'Kerusakan fisik',
                    'Masalah lainnya'
                ] as $kategori)
                    <option
                        value="{{ $kategori }}"
                        @selected(old('kategori') === $kategori)
                    >
                        {{ $kategori }}
                    </option>
                @endforeach
            </select>

            @error('kategori')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="deskripsi">Deskripsi masalah *</label>

            <textarea
                id="deskripsi"
                name="deskripsi"
                minlength="10"
                maxlength="2000"
                required
                placeholder="Contoh: Charger menampilkan pesan error dan proses pengisian tidak dimulai."
            >{{ old('deskripsi') }}</textarea>

            <div class="help">
                Jelaskan gejala yang terjadi, kapan masalah ditemukan,
                dan informasi lain yang membantu operator.
            </div>

            @error('deskripsi')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="actions">
                <button type="submit" class="btn btn-primary">
                    Kirim Laporan
                </button>

                <a
                    href="{{ route('charger-reports.index') }}"
                    class="btn btn-secondary"
                >
                    Batal
                </a>
            </div>
        </form>
    </section>
</div>
</body>
</html>
```