<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifikasi - EVChargeHub</title>

    <style>

        /* =====================================================
           GLOBAL
        ===================================================== */

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f4f8f7;

            color: #1f2937;
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            position: fixed;

            left: 0;
            top: 0;

            width: 285px;
            height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #006b59 0%,
                    #005747 52%,
                    #00453b 100%
                );

            color: white;

            z-index: 1000;

            overflow: hidden;

            box-shadow:
                5px 0 25px rgba(0, 0, 0, 0.08);
        }


        /* =====================================================
           SIDEBAR HEADER
        ===================================================== */

        .sidebar-header {
            height: 110px;

            padding: 20px 28px;

            display: flex;

            align-items: center;

            gap: 14px;

            border-bottom:
                1px solid rgba(255,255,255,0.12);

            background:
                rgba(0, 91, 75, 0.72);
        }


        .logo-icon {
            width: 54px;
            height: 54px;

            min-width: 54px;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #27e091,
                    #16c982
                );

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 28px;

            box-shadow:
                0 7px 18px
                rgba(37,217,138,0.28);
        }


        .logo-area {
            display: flex;

            flex-direction: column;

            gap: 3px;
        }


        .logo-text {
            font-size: 22px;

            font-weight: 700;

            color: white;

            letter-spacing: -0.5px;
        }


        .logo-subtitle {
            color:
                rgba(255,255,255,0.72);

            font-size: 9px;

            letter-spacing: 0.2px;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .menu {
            padding:
                16px 14px 30px;

            height:
                calc(100vh - 110px);

            overflow-y: auto;

            scrollbar-width: none;
        }


        .menu::-webkit-scrollbar {
            display: none;
        }


        .menu-title {
            padding:
                16px 14px 10px;

            color: #9fe3cc;

            font-size: 11px;

            text-transform: uppercase;

            letter-spacing: 1.5px;

            font-weight: 700;

            text-shadow:
                0 1px 3px rgba(0,0,0,0.35);
        }


        .menu-item {
            display: flex;

            align-items: center;

            gap: 15px;

            width: 100%;

            padding:
                14px 15px;

            margin-bottom: 5px;

            border-radius: 12px;

            color: #e5f7f2;

            font-size: 14px;

            font-weight: 500;

            border: none;

            background: transparent;

            text-align: left;

            cursor: pointer;

            transition: all 0.2s ease;

            position: relative;

            z-index: 6;

            text-shadow:
                0 1px 3px rgba(0,0,0,0.55);
        }


        .menu-item:hover {
            background:
                rgba(255,255,255,0.10);

            color: white;

            transform:
                translateX(2px);
        }


        .menu-item.active {
            background:
                linear-gradient(
                    90deg,
                    #15bd7d,
                    #0ba46e
                );

            color: white;

            font-weight: 700;

            box-shadow:
                0 7px 18px
                rgba(0,0,0,0.10);

            text-shadow: none;
        }


        /* =====================================================
           IKON SIDEBAR
        ===================================================== */

        .menu-icon {
            width: 30px;

            min-width: 30px;

            height: 30px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #ffffff !important;

            line-height: 1;
        }


        .menu-icon svg {
            width: 21px;

            height: 21px;

            display: block;

            color: #ffffff !important;

            stroke: #ffffff !important;
        }


        .menu-icon svg path,
        .menu-icon svg circle,
        .menu-icon svg rect,
        .menu-icon svg line,
        .menu-icon svg polyline,
        .menu-icon svg polygon {
            stroke: #ffffff !important;
        }


        .menu-icon svg circle[fill],
        .menu-icon svg path[fill] {
            fill: #ffffff;
        }


        .menu-arrow {
            margin-left: auto;

            font-size: 18px;

            opacity: 0.9;
        }


        /* =====================================================
           DIVIDER
        ===================================================== */

        .menu-divider {
            margin:
                22px 9px;

            border-top:
                1px solid
                rgba(255,255,255,0.20);
        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .menu form {
            position: relative;

            z-index: 6;

            width: 100%;
        }


        .menu form .menu-item {
            margin-top: 0;

            background:
                rgba(255,255,255,0.07);
        }


        .menu form .menu-item:hover {
            background:
                rgba(255,255,255,0.14);
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            margin-left: 285px;

            min-height: 100vh;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            height: 84px;

            background: white;

            border-bottom:
                1px solid #e5e7eb;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding:
                0 38px;

            position: sticky;

            top: 0;

            z-index: 500;
        }


        .topbar-left {
            display: flex;

            align-items: center;

            gap: 18px;
        }


        .page-title {
            font-size: 25px;

            font-weight: 700;

            color: #064e3b;

            letter-spacing: -0.5px;
        }


        /* =====================================================
           PROFIL KANAN ATAS
        ===================================================== */

        .user-area {
            display: flex;

            align-items: center;

            gap: 14px;

            margin-left: auto;
        }


        .user-profile {
            display: flex;

            align-items: center;

            gap: 10px;

            cursor: pointer;
        }


        .user-avatar {
            width: 45px;
            height: 45px;

            border-radius: 50%;

            background: #d1fae5;

            border:
                2px solid #8ee8c3;

            display: flex;

            align-items: center;

            justify-content: center;

            overflow: hidden;

            font-size: 20px;
        }


        .user-avatar img {
            width: 100%;
            height: 100%;

            object-fit: cover;
        }


        .user-name {
            font-size: 13px;

            font-weight: 700;

            color: #374151;
        }


        .user-arrow {
            color: #64748b;

            font-size: 16px;

            margin-left: 2px;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            padding:
                38px;

            width: 100%;

            max-width: 1200px;

            margin: 0 auto;
        }


        /* =====================================================
           HEADER CARD
        ===================================================== */

        .header-card {
            background:
                linear-gradient(
                    120deg,
                    #eafff1,
                    #e5f8f7
                );

            border:
                1px solid #d3eee1;

            border-radius: 22px;

            padding:
                28px 30px;

            margin-bottom: 25px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;
        }


        .header-card-left {
            display: flex;

            align-items: center;

            gap: 18px;
        }


        .header-icon {
            width: 60px;
            height: 60px;

            min-width: 60px;

            border-radius: 50%;

            background: #d1fae5;

            display: flex;

            align-items: center;

            justify-content: center;
        }


        .header-icon svg {
            width: 30px;

            height: 30px;

            stroke: #07895f;

            fill: none;
        }


        .header-card h1 {
            margin: 0;

            color: #064e3b;

            font-size: 25px;
        }


        .header-card p {
            margin:
                7px 0 0;

            color: #64748b;

            font-size: 13px;

            line-height: 1.5;
        }


        .back-button {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding:
                10px 15px;

            background: #d1fae5;

            color: #07895f;

            border-radius: 9px;

            font-size: 11px;

            font-weight: 700;

            white-space: nowrap;

            transition: 0.2s;
        }


        .back-button:hover {
            background: #baf3d7;

            transform:
                translateY(-1px);
        }


        /* =====================================================
           TOOLBAR
        ===================================================== */

        .notification-toolbar {
            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 15px;
        }


        .notification-toolbar h2 {
            margin: 0;

            color: #064e3b;

            font-size: 18px;
        }


        .unread-badge {
            background: #ef4444;

            color: white;

            padding:
                7px 12px;

            border-radius: 20px;

            font-size: 10px;

            font-weight: 700;
        }


        /* =====================================================
           NOTIFICATION LIST
        ===================================================== */

        .notification-list {
            width: 100%;

            display: flex;

            flex-direction: column;

            gap: 12px;
        }


        /* =====================================================
           NOTIFICATION CARD
        ===================================================== */

        .notification-card {
            width: 100%;

            background: white;

            border:
                1px solid #e5e7eb;

            border-radius: 16px;

            padding:
                18px 20px;

            display: flex;

            align-items: center;

            gap: 15px;

            box-shadow:
                0 5px 15px
                rgba(0,0,0,0.04);

            transition:
                all 0.2s ease;
        }


        .notification-card:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 8px 20px
                rgba(0,0,0,0.07);
        }


        /* BELUM DIBACA */

        .notification-card.unread {
            background: #f0fdf7;

            border-left:
                4px solid #10b981;
        }


        /* =====================================================
           NOTIFICATION ICON
        ===================================================== */

        .notification-icon {
            width: 50px;
            height: 50px;

            min-width: 50px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;
        }


        .notification-icon svg {
            width: 24px;

            height: 24px;

            fill: none;
        }


        .notification-icon.payment {
            background: #fef3c7;
        }


        .notification-icon.payment svg {
            stroke: #b77900;
        }


        .notification-icon.charging {
            background: #dcfce7;
        }


        .notification-icon.charging svg {
            stroke: #07895f;
        }


        .notification-icon.vehicle {
            background: #dbeafe;
        }


        .notification-icon.vehicle svg {
            stroke: #1769aa;
        }


        .notification-icon.system {
            background: #ede9fe;
        }


        .notification-icon.system svg {
            stroke: #6d28d9;
        }


        /* =====================================================
           NOTIFICATION CONTENT
        ===================================================== */

        .notification-content {
            flex: 1;

            min-width: 0;
        }


        .notification-title {
            display: flex;

            align-items: center;

            gap: 8px;

            flex-wrap: wrap;
        }


        .notification-content h3 {
            margin: 0;

            font-size: 14px;

            color: #064e3b;
        }


        .notification-content p {
            margin:
                6px 0 0;

            font-size: 12px;

            color: #64748b;

            line-height: 1.6;
        }


        .new-badge {
            background: #ef4444;

            color: white;

            padding:
                3px 7px;

            border-radius: 6px;

            font-size: 8px;

            font-weight: 700;
        }


        .notification-time {
            margin-top: 7px;

            font-size: 10px;

            color: #94a3b8;
        }


        /* =====================================================
           NOTIFICATION ACTION
        ===================================================== */

        .notification-action {
            display: flex;

            align-items: center;
        }


        .read-button {
            border: none;

            background: #ecfdf5;

            color: #07895f;

            padding:
                7px 10px;

            border-radius: 7px;

            font-size: 9px;

            font-weight: 700;

            cursor: pointer;
        }


        .read-button:hover {
            background: #d1fae5;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .notification-empty {
            width: 100%;

            background: white;

            border:
                1px solid #e5e7eb;

            border-radius: 17px;

            padding:
                55px 20px;

            text-align: center;

            box-shadow:
                0 5px 15px
                rgba(0,0,0,0.04);
        }


        .notification-empty-icon {
            width: 70px;
            height: 70px;

            margin:
                0 auto 15px;

            border-radius: 50%;

            background: #ecfdf5;

            display: flex;

            align-items: center;

            justify-content: center;
        }


        .notification-empty-icon svg {
            width: 32px;

            height: 32px;

            stroke: #07895f;
        }


        .notification-empty h3 {
            margin:
                0 0 7px;

            color: #064e3b;

            font-size: 17px;
        }


        .notification-empty p {
            margin: 0;

            color: #64748b;

            font-size: 12px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {
            text-align: center;

            margin-top: 40px;

            padding-top: 22px;

            border-top:
                1px solid #e2e8e5;

            color: #94a3b8;

            font-size: 11px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 900px) {

            .sidebar {
                width: 235px;
            }

            .main {
                margin-left: 235px;
            }

            .content {
                padding:
                    28px 25px;
            }

        }


        @media(max-width: 650px) {

            .sidebar {
                width: 72px;
            }

            .main {
                margin-left: 72px;
            }

            .sidebar-header {
                height: 80px;

                justify-content: center;

                padding: 15px;
            }

            .logo-icon {
                width: 45px;
                height: 45px;

                min-width: 45px;

                font-size: 23px;
            }

            .logo-area,
            .logo-text,
            .logo-subtitle,
            .menu-title,
            .menu-item span:not(.menu-icon),
            .menu-arrow {
                display: none;
            }

            .menu {
                height:
                    calc(100vh - 80px);

                padding:
                    12px 8px;
            }

            .menu-item {
                justify-content: center;

                padding:
                    13px 5px;
            }

            .topbar {
                height: 70px;

                padding:
                    0 15px;
            }

            .page-title {
                font-size: 19px;
            }

            .user-name,
            .user-arrow {
                display: none;
            }

            .content {
                padding:
                    20px 15px 40px;
            }

            .header-card {
                flex-direction: column;

                align-items: flex-start;

                padding: 22px;
            }

            .notification-card {
                align-items: flex-start;

                padding: 15px;
            }

            .notification-time {
                display: none;
            }

            .notification-action {
                display: none;
            }

        }

    </style>

</head>


<body>


@php

    $user = auth()->user();

    $unreadCount = $notifications
        ->where('is_read', false)
        ->count();

@endphp


<!-- =====================================================
     SIDEBAR
===================================================== -->

<aside class="sidebar">


    <!-- LOGO -->

    <div class="sidebar-header">

        <div class="logo-icon">
            ⚡
        </div>


        <div class="logo-area">

            <div class="logo-text">
                EVChargeHub
            </div>

            <div class="logo-subtitle">
                Charge Today, Greener Tomorrow
            </div>

        </div>

    </div>


    <!-- MENU -->

    <div class="menu">


        <!-- =====================
             MENU UTAMA
        ====================== -->

        <div class="menu-title">
            Menu Utama
        </div>


        <!-- DASHBOARD -->

        <a
            href="{{ route('user.dashboard') }}"
            class="menu-item"
        >

            <span class="menu-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                >

                    <path
                        d="M3 10.5L12 3l9 7.5V21H3V10.5Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M9 21v-6h6v6"
                        stroke="currentColor"
                        stroke-width="2"
                    />

                </svg>

            </span>


            <span>
                Dashboard
            </span>


            <span class="menu-arrow">
                ›
            </span>

        </a>


        <!-- =====================
             AKUN
        ====================== -->

        <div class="menu-title">
            Akun
        </div>


        <!-- PROFIL -->

        <a
            href="{{ route('profile.edit') }}"
            class="menu-item"
        >

            <span class="menu-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                >

                    <circle
                        cx="12"
                        cy="8"
                        r="4"
                        stroke="currentColor"
                        stroke-width="2"
                    />

                    <path
                        d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />

                </svg>

            </span>


            <span>
                Profil Saya
            </span>


            <span class="menu-arrow">
                ›
            </span>

        </a>


        <!-- KENDARAAN -->

        <a
            href="{{ route('vehicles.index') }}"
            class="menu-item"
        >

            <span class="menu-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                >

                    <path
                        d="M5 16l1.5-5h11L19 16"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M4 16h16v4H4z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linejoin="round"
                    />

                    <circle
                        cx="7"
                        cy="20"
                        r="1"
                        fill="currentColor"
                    />

                    <circle
                        cx="17"
                        cy="20"
                        r="1"
                        fill="currentColor"
                    />

                </svg>

            </span>


            <span>
                Kendaraan Saya
            </span>


            <span class="menu-arrow">
                ›
            </span>

        </a>


        <!-- =====================
             FITUR UTAMA
        ====================== -->

        <div class="menu-title">
            Fitur Utama
        </div>


        <!-- CHARGING STATION -->

        <a
            href="{{ route('stations.index') }}"
            class="menu-item"
        >

            <span class="menu-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                >

                    <path
                        d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"
                        stroke="currentColor"
                        stroke-width="2"
                    />

                    <circle
                        cx="12"
                        cy="9"
                        r="2.5"
                        stroke="currentColor"
                        stroke-width="2"
                    />

                </svg>

            </span>


            <span>
                Charging Station
            </span>


            <span class="menu-arrow">
                ›
            </span>

        </a>


    

        <!-- RIWAYAT -->

        <a
            href="{{ route('charging.history') }}"
            class="menu-item"
        >

            <span class="menu-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                >

                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                        stroke="currentColor"
                        stroke-width="2"
                    />

                    <path
                        d="M12 7v5l3 2"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />

                </svg>

            </span>


            <span>
                Riwayat Charging
            </span>


            <span class="menu-arrow">
                ›
            </span>

        </a>


        <!-- NOTIFIKASI AKTIF -->

        <a
            href="{{ route('notifications.index') }}"
            class="menu-item active"
        >

            <span class="menu-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                >

                    <path
                        d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M10 21h4"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />

                </svg>

            </span>


            <span>
                Notifikasi
            </span>


            @if($unreadCount > 0)

                <span
                    style="
                        margin-left:auto;
                        background:#ef4444;
                        color:white;
                        width:22px;
                        height:22px;
                        border-radius:50%;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:10px;
                        font-weight:700;
                    "
                >
                    {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                </span>

            @else

                <span class="menu-arrow">
                    ›
                </span>

            @endif

        </a>


        <!-- DIVIDER -->

        <div class="menu-divider"></div>


        <!-- LOGOUT -->

        <form
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf


            <button
                type="submit"
                class="menu-item"
            >

                <span class="menu-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                    >

                        <path
                            d="M10 17l5-5-5-5"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M15 12H3"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                        />

                        <path
                            d="M14 4h5v16h-5"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                    </svg>

                </span>


                <span>
                    Logout
                </span>

            </button>

        </form>


    </div>

</aside>


<!-- =====================================================
     MAIN
===================================================== -->

<div class="main">


    <!-- =================================================
         TOPBAR
    ================================================= -->

    <header class="topbar">


        <div class="topbar-left">

            <div class="page-title">
                Notifikasi
            </div>

        </div>


        <!-- PROFIL KANAN -->

        <div class="user-area">

            <div class="user-profile">


                <div class="user-avatar">

                    @if($user && !empty($user->foto))

                        <img
                            src="{{ asset('storage/' . $user->foto) }}"
                            alt="Foto Profil"
                        >

                    @else

                        👤

                    @endif

                </div>


                <div class="user-name">

                    {{ $user->nama ?? 'Pengguna' }}

                </div>



            </div>

        </div>


    </header>


    <!-- =================================================
         CONTENT
    ================================================= -->

    <main class="content">


        <!-- HEADER CARD -->

        <section class="header-card">


            <div class="header-card-left">


                <div class="header-icon">

                    <svg
                        viewBox="0 0 24 24"
                    >

                        <path
                            d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Z"
                            stroke-width="2"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M10 21h4"
                            stroke-width="2"
                            stroke-linecap="round"
                        />

                    </svg>

                </div>


                <div>

                    <h1>
                        Notifikasi
                    </h1>


                    <p>
                        Informasi dan pemberitahuan terbaru dari EVChargeHub.
                    </p>

                </div>


            </div>


            <a
                href="{{ route('user.dashboard') }}"
                class="back-button"
            >

                ← Kembali ke Dashboard

            </a>


        </section>


        <!-- =================================================
             TOOLBAR
        ================================================= -->

        <div class="notification-toolbar">


            <h2>
                Semua Notifikasi
            </h2>


            @if($unreadCount > 0)

                <div class="unread-badge">

                    {{ $unreadCount }}

                    belum dibaca

                </div>

            @endif


        </div>


        <!-- =================================================
             NOTIFICATION LIST
        ================================================= -->

        <div class="notification-list">


            @forelse($notifications as $notification)


                @php

                    $type = $notification->type ?? 'system';

                @endphp


                <div
                    class="
                        notification-card
                        {{ !$notification->is_read ? 'unread' : '' }}
                    "
                >


                    <!-- ICON -->

                    <div
                        class="
                            notification-icon
                            {{ $type }}
                        "
                    >


                        @if($type === 'payment')

                            <!-- PAYMENT -->

                            <svg
                                viewBox="0 0 24 24"
                            >

                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"
                                    stroke-width="2"
                                />

                                <path
                                    d="M3 10h18"
                                    stroke-width="2"
                                />

                                <path
                                    d="M7 15h4"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                />

                            </svg>


                        @elseif($type === 'charging')

                            <!-- CHARGING -->

                            <svg
                                viewBox="0 0 24 24"
                            >

                                <path
                                    d="M13 2L5 13h6l-1 9 8-11h-6l1-9Z"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />

                            </svg>


                        @elseif($type === 'vehicle')

                            <!-- VEHICLE -->

                            <svg
                                viewBox="0 0 24 24"
                            >

                                <path
                                    d="M5 16l1.5-5h11L19 16"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />

                                <path
                                    d="M4 16h16v4H4z"
                                    stroke-width="2"
                                />

                                <circle
                                    cx="7"
                                    cy="20"
                                    r="1"
                                    fill="currentColor"
                                    stroke="none"
                                />

                                <circle
                                    cx="17"
                                    cy="20"
                                    r="1"
                                    fill="currentColor"
                                    stroke="none"
                                />

                            </svg>


                        @else

                            <!-- SYSTEM -->

                            <svg
                                viewBox="0 0 24 24"
                            >

                                <path
                                    d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Z"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />

                                <path
                                    d="M10 21h4"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                />

                            </svg>

                        @endif


                    </div>


                    <!-- CONTENT -->

                    <div class="notification-content">


                        <div class="notification-title">

                            <h3>
                                {{ $notification->title }}
                            </h3>


                            @if(!$notification->is_read)

                                <span class="new-badge">
                                    BARU
                                </span>

                            @endif

                        </div>


                        <p>
                            {{ $notification->message }}
                        </p>


                        <div class="notification-time">

                            🕐

                            @if($notification->created_at)

                                {{ $notification->created_at->format('d/m/Y H:i') }}

                            @else

                                -

                            @endif

                        </div>


                    </div>


                    <!-- MARK AS READ -->

                    @if(!$notification->is_read)

                        <div class="notification-action">

                            <form
                                action="{{ route(
                                    'notifications.read.one',
                                    $notification->id
                                ) }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="read-button"
                                >

                                    ✓ Dibaca

                                </button>

                            </form>

                        </div>

                    @endif


                </div>


            @empty


                <!-- EMPTY -->

                <div class="notification-empty">


                    <div class="notification-empty-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                        >

                            <path
                                d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Z"
                                stroke-width="2"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M10 21h4"
                                stroke-width="2"
                                stroke-linecap="round"
                            />

                        </svg>

                    </div>


                    <h3>
                        Belum Ada Notifikasi
                    </h3>


                    <p>
                        Saat ini belum ada pemberitahuan untuk akun Anda.
                    </p>


                </div>


            @endforelse


        </div>


        <!-- =================================================
             FOOTER
        ================================================= -->

        <div class="footer">

            © {{ date('Y') }}

            EVChargeHub

            —

            Sistem Manajemen Charging Kendaraan Listrik

        </div>


    </main>


</div>


</body>

</html>