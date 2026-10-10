<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Operator - EVChargeHub</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7f7;
            color: #263238;
        }

        /* =========================
           LAYOUT
        ========================== */

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR
        ========================== */

        .sidebar {
            width: 285px;
            min-height: 100vh;

            background: linear-gradient(
                180deg,
                #006b59 0%,
                #005747 55%,
                #00453b 100%
            );

            color: white;

            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;

            overflow-y: auto;
        }

        .sidebar-header {
            height: 110px;

            display: flex;
            align-items: center;

            padding: 25px 22px;

            border-bottom: 1px solid rgba(255,255,255,0.12);
        }

        .logo-circle {
            width: 54px;
            height: 54px;

            border-radius: 50%;

            background: white;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-right: 12px;

            color: #006b59;

            font-weight: bold;
            font-size: 18px;
        }

        .logo-text h2 {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .logo-text p {
            font-size: 11px;
            opacity: 0.85;
        }

        .menu-title {
            font-size: 11px;
            font-weight: bold;

            letter-spacing: 1px;

            padding: 25px 24px 10px;

            color: rgba(255,255,255,0.6);
        }

        .menu-item {
            display: flex;
            align-items: center;

            gap: 13px;

            padding: 13px 22px;

            margin: 4px 12px;

            border-radius: 9px;

            color: white;

            text-decoration: none;

            font-size: 14px;

            transition: 0.2s;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.10);
        }

        .menu-item.active {
            background: rgba(255,255,255,0.16);
            font-weight: bold;
        }

        .menu-icon {
            width: 30px;
            min-width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-icon svg {
            width: 21px;
            height: 21px;

            stroke: white;
        }

        /* =========================
           MAIN
        ========================== */

        .main {
            margin-left: 285px;

            width: calc(100% - 285px);

            min-height: 100vh;
        }

        /* =========================
           TOPBAR
        ========================== */

        .topbar {
            height: 84px;

            background: white;

            border-bottom: 1px solid #e5e9e8;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 32px;
        }

        .topbar-title h1 {
            font-size: 22px;

            color: #263b36;

            margin-bottom: 4px;
        }

        .topbar-title p {
            font-size: 13px;

            color: #82908c;
        }

        .profile {
            display: flex;
            align-items: center;

            gap: 12px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;

            border-radius: 50%;

            background: #006b59;

            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: bold;
        }

        .user-info strong {
            display: block;

            font-size: 14px;

            color: #263b36;
        }

        .user-info span {
            font-size: 12px;

            color: #82908c;
        }

        /* =========================
           CONTENT
        ========================== */

        .content {
            padding: 30px 32px 50px;
        }

        /* =========================
           PAGE HEADER
        ========================== */

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h2 {
            font-size: 21px;

            color: #263b36;

            margin-bottom: 7px;
        }

        .page-header p {
            font-size: 13px;

            color: #82908c;
        }

        /* =========================
           PROFILE CARD
        ========================== */

        .profile-card {
            background: white;

            border-radius: 14px;

            border: 1px solid #e5e9e8;

            box-shadow: 0 3px 12px rgba(0,0,0,0.04);

            padding: 25px;
        }

        .profile-section {
            margin-bottom: 25px;
        }

        .profile-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 16px;

            color: #263b36;

            margin-bottom: 6px;
        }

        .section-description {
            font-size: 12px;

            color: #82908c;

            margin-bottom: 20px;
        }

        /* =========================
           FORM
        ========================== */

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            font-size: 13px;

            color: #42514d;

            margin-bottom: 7px;

            font-weight: bold;
        }

        .form-control {
            width: 100%;

            padding: 11px 13px;

            border: 1px solid #dce3e1;

            border-radius: 8px;

            font-size: 14px;

            font-family: Arial, Helvetica, sans-serif;

            color: #263238;

            background: white;

            outline: none;

            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #006b59;

            box-shadow: 0 0 0 3px rgba(0,107,89,0.08);
        }

        .form-control::placeholder {
            color: #a0aaa7;
        }

        /* =========================
           DIVIDER
        ========================== */

        .divider {
            border: 0;

            border-top: 1px solid #edf0ef;

            margin: 25px 0;
        }

        /* =========================
           BUTTON
        ========================== */

        .button-wrapper {
            display: flex;

            justify-content: flex-start;

            margin-top: 25px;
        }

        .btn-save {
            border: none;

            background: #006b59;

            color: white;

            padding: 11px 20px;

            border-radius: 8px;

            font-size: 13px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.2s;
        }

        .btn-save:hover {
            background: #005747;
        }

        /* =========================
           ALERT
        ========================== */

        .alert {
            padding: 13px 16px;

            border-radius: 9px;

            margin-bottom: 20px;

            font-size: 13px;
        }

        .alert-success {
            background: #e8f7ef;

            color: #16865d;

            border: 1px solid #ccebdc;
        }

        .alert-danger {
            background: #fdecec;

            color: #c43e3e;

            border: 1px solid #f3cccc;
        }

        .alert-danger div {
            margin-bottom: 4px;
        }

        .alert-danger div:last-child {
            margin-bottom: 0;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 750px) {

            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;

                width: calc(100% - 220px);
            }

            .content {
                padding: 20px;
            }

            .topbar {
                padding: 0 20px;
            }

        }

    </style>

</head>


<body>

<div class="layout">

    <!-- =========================
         SIDEBAR
    ========================== -->

    <aside class="sidebar">

        <div class="sidebar-header">

            <div class="logo-circle">
                EV
            </div>

            <div class="logo-text">

                <h2>
                    EVChargeHub
                </h2>

                <p>
                    Charge Today, Greener Tomorrow
                </p>

            </div>

        </div>


        <!-- MENU UTAMA -->

        <div class="menu-title">
            MENU UTAMA
        </div>


        <a
            href="{{ route('operator.dashboard') }}"
            class="menu-item">

            <span class="menu-icon">

                <svg viewBox="0 0 24 24" fill="none">

                    <path
                        d="M3 10.5L12 3l9 7.5"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"/>

                    <path
                        d="M5 9.5V21h14V9.5"
                        stroke-width="2"
                        stroke-linejoin="round"/>

                    <path
                        d="M9 21v-7h6v7"
                        stroke-width="2"/>

                </svg>

            </span>

            Dashboard

        </a>


        <!-- OPERASIONAL -->

        <div class="menu-title">
            OPERASIONAL
        </div>


        <a
            href="{{ route('operator.stations') }}"
            class="menu-item">

            <span class="menu-icon">

                <svg viewBox="0 0 24 24" fill="none">

                    <path
                        d="M12 21s7-6.1 7-12A7 7 0 0 0 5 9c0 5.9 7 12 7 12z"
                        stroke-width="2"/>

                    <circle
                        cx="12"
                        cy="9"
                        r="2.5"
                        stroke-width="2"/>

                </svg>

            </span>

            Charging Station

        </a>


        <a
            href="{{ route('operator.chargers') }}"
            class="menu-item">

            <span class="menu-icon">

                <svg viewBox="0 0 24 24" fill="none">

                    <path
                        d="M13 2L4 14h6l-1 8 9-12h-6l1-8z"
                        stroke-width="2"
                        stroke-linejoin="round"/>

                </svg>

            </span>

            Charger

        </a>


        <a
            href="{{ route('operator.sessions') }}"
            class="menu-item">

            <span class="menu-icon">

                <svg viewBox="0 0 24 24" fill="none">

                    <circle
                        cx="12"
                        cy="12"
                        r="8"
                        stroke-width="2"/>

                    <path
                        d="M12 8v4l3 2"
                        stroke-width="2"
                        stroke-linecap="round"/>

                </svg>

            </span>

            Monitoring Charging

        </a>


        <a
            href="{{ route('operator.sessions') }}"
            class="menu-item">

            <span class="menu-icon">

                <svg viewBox="0 0 24 24" fill="none">

                    <path
                        d="M6 3h12v18H6z"
                        stroke-width="2"/>

                    <path
                        d="M9 7h6M9 11h6M9 15h4"
                        stroke-width="2"
                        stroke-linecap="round"/>

                </svg>

            </span>

            Sesi Charging

        </a>


        <a
            href="{{ route('operator.history') }}"
            class="menu-item">

            <span class="menu-icon">

                <svg viewBox="0 0 24 24" fill="none">

                    <circle
                        cx="12"
                        cy="12"
                        r="8"
                        stroke-width="2"/>

                    <path
                        d="M12 7v5l3 2"
                        stroke-width="2"
                        stroke-linecap="round"/>

                </svg>

            </span>

            Riwayat Charging

        </a>


        <!-- LAPORAN -->

        <div class="menu-title">
            LAPORAN
        </div>


        <a
            href="{{ route('operator.report') }}"
            class="menu-item">

            <span class="menu-icon">

                <svg viewBox="0 0 24 24" fill="none">

                    <path
                        d="M4 19V5M4 19h17"
                        stroke-width="2"
                        stroke-linecap="round"/>

                    <path
                        d="M7 15l4-4 3 2 5-6"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"/>

                </svg>

            </span>

            Laporan

        </a>


        <!-- AKUN -->

        <div class="menu-title">
            AKUN
        </div>


        <a
            href="{{ route('operator.profile') }}"
            class="menu-item active">

            <span class="menu-icon">

                <svg viewBox="0 0 24 24" fill="none">

                    <circle
                        cx="12"
                        cy="8"
                        r="4"
                        stroke-width="2"/>

                    <path
                        d="M4 21c0-4 3.6-7 8-7s8 3 8 7"
                        stroke-width="2"
                        stroke-linecap="round"/>

                </svg>

            </span>

            Profil

        </a>


        <!-- LOGOUT -->

        <form
            method="POST"
            action="{{ route('logout') }}">

            @csrf

            <button
                type="submit"
                class="menu-item"
                style="
                    border:none;
                    background:none;
                    width:calc(100% - 24px);
                    cursor:pointer;
                    text-align:left;
                ">

                <span class="menu-icon">

                    <svg viewBox="0 0 24 24" fill="none">

                        <path
                            d="M10 17l5-5-5-5"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>

                        <path
                            d="M15 12H3"
                            stroke-width="2"
                            stroke-linecap="round"/>

                        <path
                            d="M21 3v18"
                            stroke-width="2"
                            stroke-linecap="round"/>

                    </svg>

                </span>

                Logout

            </button>

        </form>

    </aside>


    <!-- =========================
         MAIN
    ========================== -->

    <main class="main">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="topbar-title">

                <h1>
                    Profil Operator
                </h1>

                <p>
                    Kelola informasi akun operator
                </p>

            </div>


            <div class="profile">

                <div class="user-avatar">

                    {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}

                </div>


                <div class="user-info">

                    <strong>
                        {{ auth()->user()->nama }}
                    </strong>

                    <span>
                        Operator
                    </span>

                </div>

            </div>

        </header>


        <!-- =========================
             CONTENT
        ========================== -->

        <section class="content">

            <!-- PAGE HEADER -->

            <div class="page-header">

                <h2>
                    Profil Operator
                </h2>

                <p>
                    Kelola informasi akun operator Anda.
                </p>

            </div>


            <!-- SUCCESS -->

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif


            <!-- ERROR -->

            @if($errors->any())

                <div class="alert alert-danger">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            <!-- PROFILE CARD -->

            <div class="profile-card">

                <form
                    action="{{ route('operator.profile.update') }}"
                    method="POST">

                    @csrf

                    @method('PUT')


                    <!-- INFORMASI AKUN -->

                    <div class="profile-section">

                        <h3 class="section-title">
                            Informasi Akun
                        </h3>

                        <p class="section-description">
                            Perbarui informasi dasar akun operator.
                        </p>


                        <!-- NAMA -->

                        <div class="form-group">

                            <label for="nama">
                                Nama
                            </label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                value="{{ old('nama', $operator->nama) }}"
                                class="form-control"
                                required>

                        </div>


                        <!-- USERNAME -->

                        <div class="form-group">

                            <label for="username">
                                Username
                            </label>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="{{ old('username', $operator->username) }}"
                                class="form-control"
                                required>

                        </div>


                        <!-- EMAIL -->

                        <div class="form-group">

                            <label for="email">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $operator->email) }}"
                                class="form-control"
                                required>

                        </div>


                        <!-- NOMOR TELEPON -->

                        <div class="form-group">

                            <label for="nomor_telepon">
                                Nomor Telepon
                            </label>

                            <input
                                type="text"
                                id="nomor_telepon"
                                name="nomor_telepon"
                                value="{{ old('nomor_telepon', $operator->nomor_telepon) }}"
                                placeholder="Contoh: 081234567890"
                                class="form-control"
                                autocomplete="tel">

                        </div>

                    </div>


                    <hr class="divider">


                    <!-- PASSWORD -->

                    <div class="profile-section">

                        <h3 class="section-title">
                            Ubah Password
                        </h3>

                        <p class="section-description">
                            Kosongkan kedua kolom jika tidak ingin mengubah password.
                        </p>


                        <!-- PASSWORD BARU -->

                        <div class="form-group">

                            <label for="password">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password baru"
                                class="form-control"
                                autocomplete="new-password">

                        </div>


                        <!-- KONFIRMASI PASSWORD -->

                        <div class="form-group">

                            <label for="password_confirmation">
                                Konfirmasi Password Baru
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Ulangi password baru"
                                class="form-control"
                                autocomplete="new-password">

                        </div>

                    </div>


                    <!-- BUTTON -->

                    <div class="button-wrapper">

                        <button
                            type="submit"
                            class="btn-save">

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </section>

    </main>

</div>

</body>

</html>