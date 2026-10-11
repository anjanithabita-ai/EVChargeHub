<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Station - EVChargeHub</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f6;
            color: #263b37;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 225px;
            background: #00695c;
            color: white;
            padding: 25px 16px;
        }

        .brand {
            font-size: 21px;
            font-weight: bold;
            margin: 0 10px 34px;
        }

        .menu-title {
            font-size: 11px;
            color: #b2dfdb;
            font-weight: bold;
            margin: 22px 10px 10px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .menu { list-style: none; }
        .menu li { margin: 4px 0; }

        .menu a, .logout {
            display: block;
            padding: 11px 12px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 13px;
        }

        .menu a:hover, .menu a.active {
            background: rgba(255,255,255,.16);
        }

        .main { margin-left: 225px; min-height: 100vh; }

        .topbar {
            height: 64px;
            background: white;
            border-bottom: 1px solid #e5e9e7;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .topbar h2 { font-size: 18px; }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #e0f2f1;
            color: #00695c;
            display: grid;
            place-items: center;
            font-weight: bold;
        }

        .content { padding: 30px; }

        .breadcrumb {
            font-size: 13px;
            color: #71807c;
            margin-bottom: 20px;
        }

        .breadcrumb a {
            color: #00796b;
            text-decoration: none;
        }

        h1 { font-size: 26px; margin-bottom: 8px; }

        .muted {
            font-size: 13px;
            color: #71807c;
            line-height: 1.6;
        }

        .panel {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px #163b3510;
            margin-top: 22px;
        }

        .section-title {
            font-size: 17px;
            margin-bottom: 20px;
            padding-bottom: 13px;
            border-bottom: 1px solid #edf0ef;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .full { grid-column: 1 / -1; }

        label {
            font-size: 13px;
            font-weight: bold;
            color: #405650;
        }

        .required { color: #d32f2f; }

        .control {
            width: 100%;
            min-height: 43px;
            border: 1px solid #d9e0de;
            border-radius: 7px;
            padding: 11px 12px;
            background: white;
            color: #263b37;
            font-size: 13px;
            font-family: inherit;
        }

        textarea.control {
            min-height: 90px;
            resize: vertical;
        }

        .control:focus {
            outline: none;
            border-color: #008577;
            box-shadow: 0 0 0 3px #00857715;
        }

        .hint {
            font-size: 11px;
            color: #71807c;
        }

        .error {
            color: #c62828;
            font-size: 12px;
        }

        .alert {
            padding: 15px;
            background: #ffebee;
            color: #b42318;
            border-radius: 8px;
            margin-top: 18px;
            font-size: 13px;
        }

        .info-box {
            padding: 13px 15px;
            background: #e8f5f2;
            color: #27675b;
            border-radius: 8px;
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 16px;
            border-radius: 7px;
            border: 0;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-primary { background: #00695c; color: white; }

        .btn-light {
            background: white;
            border: 1px solid #dce4e1;
            color: #36534d;
        }

        @media (max-width: 850px) {
            .form-grid { grid-template-columns: 1fr; }
            .full { grid-column: auto; }
        }

        @media (max-width: 650px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .content { padding: 18px; }
            .topbar { padding: 0 18px; }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">⚡ EVChargeHub</div>

    <div class="menu-title">Menu Utama</div>
    <ul class="menu">
        <li><a href="{{ route('admin.dashboard') }}">▦ Dashboard</a></li>
    </ul>

    <div class="menu-title">Manajemen</div>
    <ul class="menu">
        <li><a href="#">👥 Kelola Pengguna</a></li>
        <li><a href="#">🧑‍💼 Kelola Operator</a></li>
        <li>
            <a class="active" href="{{ route('admin.charging-stations.index') }}">
                📍 Charging Station
            </a>
        </li>
        <li><a href="{{ route('admin.chargers.index') }}">⚡ Kelola Charger</a></li>
    </ul>

    <div class="menu-title">Operasional</div>
    <ul class="menu">
        <li><a href="#">📊 Monitoring Charging</a></li>
    </ul>

    <div class="menu-title">Laporan & Transaksi</div>
    <ul class="menu">
        <li><a href="#">📄 Laporan</a></li>
        <li>
            <a href="{{ route('admin.charging-stations.index') }}">
                💰 Tarif Charging
            </a>
        </li>
        <li><a href="#">↩️ Refund Pembayaran</a></li>
    </ul>

    <div class="menu-title">Sistem</div>
    <ul class="menu">
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout" type="submit"
                        style="width:100%;background:transparent;border:0;text-align:left;cursor:pointer">
                    🚪 Logout
                </button>
            </form>
        </li>
    </ul>
</aside>

<main class="main">
    <header class="topbar">
        <h2>Tambah Charging Station</h2>

        <div class="profile">
            <div class="avatar">A</div>
            <span>{{ auth()->user()->nama ?? 'Administrator' }}</span>
        </div>
    </header>

    <section class="content">
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            /
            <a href="{{ route('admin.charging-stations.index') }}">Charging Station</a>
            / Tambah Station
        </div>

        <h1>Tambah Charging Station</h1>
        <p class="muted">Tambahkan lokasi charging kendaraan listrik baru.</p>

        @if($errors->any())
            <div class="alert">
                <strong>Data belum berhasil disimpan.</strong>
                <ul style="margin:8px 0 0 20px">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.charging-stations.store') }}">
            @csrf

            <section class="panel">
                <h2 class="section-title">Informasi Station</h2>

                <div class="form-grid">
                    <div class="field full">
                        <label for="nama_lokasi">
                            Nama Station <span class="required">*</span>
                        </label>

                        <input class="control"
                               id="nama_lokasi"
                               name="nama_lokasi"
                               value="{{ old('nama_lokasi') }}"
                               placeholder="Contoh: EVChargeHub Malioboro"
                               required>

                        @error('nama_lokasi')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field full">
                        <label for="alamat">
                            Alamat Lengkap <span class="required">*</span>
                        </label>

                        <textarea class="control"
                                  id="alamat"
                                  name="alamat"
                                  placeholder="Masukkan alamat lengkap station"
                                  required>{{ old('alamat') }}</textarea>

                        @error('alamat')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="latitude">Latitude</label>

                        <input class="control"
                               type="number"
                               step="any"
                               id="latitude"
                               name="latitude"
                               value="{{ old('latitude') }}"
                               placeholder="-7.7956">

                        @error('latitude')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="longitude">Longitude</label>

                        <input class="control"
                               type="number"
                               step="any"
                               id="longitude"
                               name="longitude"
                               value="{{ old('longitude') }}"
                               placeholder="110.3695">

                        @error('longitude')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="jam_buka">Jam Buka <span class="required">*</span></label>

                        <input class="control"
                               type="time"
                               id="jam_buka"
                               name="jam_buka"
                               value="{{ old('jam_buka', '00:00') }}"
                               required>

                        @error('jam_buka')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="jam_tutup">Jam Tutup <span class="required">*</span></label>

                        <input class="control"
                               type="time"
                               id="jam_tutup"
                               name="jam_tutup"
                               value="{{ old('jam_tutup', '23:59') }}"
                               required>

                        @error('jam_tutup')
                            <span class="error">{{ $message }}</span>
                        @enderror

                        <span class="hint">
                            Untuk station 24 jam, gunakan 00:00 sampai 23:59.
                        </span>
                    </div>

                    <div class="field full">
                        <label for="fasilitas">Fasilitas</label>

                        <textarea class="control"
                                  id="fasilitas"
                                  name="fasilitas"
                                  placeholder="Contoh: toilet, minimarket, area parkir">{{ old('fasilitas') }}</textarea>

                        @error('fasilitas')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="status">Status Station <span class="required">*</span></label>

                        <select class="control" id="status" name="status" required>
                            <option value="aktif" @selected(old('status', 'aktif') === 'aktif')>
                                Aktif
                            </option>
                            <option value="tutup" @selected(old('status') === 'tutup')>
                                Tutup
                            </option>
                            <option value="maintenance" @selected(old('status') === 'maintenance')>
                                Maintenance
                            </option>
                        </select>

                        @error('status')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="panel">
                <h2 class="section-title">Tarif Charging Awal</h2>

                <div class="info-box">
                    Tarif bersifat opsional. Jika belum memiliki tarif, kamu bisa
                    mengosongkan bagian ini dan mengaturnya kemudian.
                </div>

                <div class="form-grid">
                    <div class="field">
                        <label for="harga_per_kwh">Harga per kWh (Rp)</label>

                        <input class="control"
                               type="number"
                               min="0"
                               step="any"
                               id="harga_per_kwh"
                               name="harga_per_kwh"
                               value="{{ old('harga_per_kwh') }}"
                               placeholder="Contoh: 2500">

                        @error('harga_per_kwh')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="biaya_minimum">Biaya Minimum (Rp)</label>

                        <input class="control"
                               type="number"
                               min="0"
                               step="any"
                               id="biaya_minimum"
                               name="biaya_minimum"
                               value="{{ old('biaya_minimum', 0) }}"
                               placeholder="0">

                        @error('biaya_minimum')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="biaya_parkir">Biaya Parkir (Rp)</label>

                        <input class="control"
                               type="number"
                               min="0"
                               step="any"
                               id="biaya_parkir"
                               name="biaya_parkir"
                               value="{{ old('biaya_parkir', 0) }}"
                               placeholder="0">

                        @error('biaya_parkir')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="berlaku_mulai">Berlaku Mulai</label>

                        <input class="control"
                               type="date"
                               id="berlaku_mulai"
                               name="berlaku_mulai"
                               value="{{ old('berlaku_mulai', now()->toDateString()) }}">

                        @error('berlaku_mulai')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </section>

            <div class="actions">
                <a class="btn btn-light"
                   href="{{ route('admin.charging-stations.index') }}">
                    Batal
                </a>

                <button class="btn btn-primary" type="submit">
                    Simpan Station
                </button>
            </div>
        </form>
    </section>
</main>

</body>
</html>
