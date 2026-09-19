<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil User - EVChargeHub</title>

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
            max-width: 650px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #198754;
            margin-bottom: 8px;
        }

        .description {
            color: #777;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #198754;
        }

        .success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
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

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
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

        .password-title {
            color: #198754;
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .info {
            background: #f1f3f5;
            padding: 12px;
            border-radius: 7px;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Kelola Profil User</h1>

        <p class="description">
            Ubah informasi akun Anda di bawah ini.
        </p>


        @if (session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        @if ($errors->any())

            <div class="error">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form method="POST" action="{{ route('profile.update') }}">

            @csrf
            @method('PUT')


            <div class="form-group">

                <label for="nama">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama', $user->nama) }}"
                    required
                >

            </div>


            <div class="form-group">

                <label for="username">
                    Username
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username', $user->username) }}"
                    required
                >

            </div>


            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required
                >

            </div>


            <div class="form-group">

                <label for="nomor_telepon">
                    Nomor Telepon
                </label>

                <input
                    type="text"
                    id="nomor_telepon"
                    name="nomor_telepon"
                    value="{{ old('nomor_telepon', $user->nomor_telepon) }}"
                    placeholder="Masukkan nomor telepon"
                >

            </div>


            <h2 class="password-title">
                Ubah Password
            </h2>


            <div class="info">
                Kosongkan password jika tidak ingin mengubah password.
            </div>


            <div class="form-group">

                <label for="password">
                    Password Baru
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                >

            </div>


            <div class="form-group">

                <label for="password_confirmation">
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password baru"
                >

            </div>


            <div class="buttons">

                <button
                    type="submit"
                    class="save">
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('user.dashboard') }}"
                    class="back">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>