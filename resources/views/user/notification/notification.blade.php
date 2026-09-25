<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifikasi - EVChargeHub</title>


    <style>

        * {
            box-sizing: border-box;
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


        /* =========================================
           SIDEBAR
        ========================================= */

        .sidebar {

            position: fixed;

            left: 0;
            top: 0;

            width: 270px;
            height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #006b57 0%,
                    #004d40 55%,
                    #003b34 100%
                );

            color: white;

            overflow-y: auto;

            z-index: 1000;

            box-shadow:
                5px 0 20px rgba(0, 0, 0, 0.12);
        }


        .sidebar-header {

            height: 78px;

            padding: 18px 22px;

            display: flex;

            align-items: center;

            gap: 12px;

            border-bottom:
                1px solid rgba(255,255,255,0.10);
        }


        .logo-icon {

            width: 42px;
            height: 42px;

            border-radius: 50%;

            background: #28d486;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;
        }


        .logo-text {

            font-size: 21px;

            font-weight: bold;
        }


        .menu {

            padding:
                15px 12px 30px;
        }


        .menu-title {

            padding:
                15px 14px 8px;

            color: #9de5ca;

            font-size: 11px;

            text-transform: uppercase;

            letter-spacing: 1.2px;

            font-weight: bold;
        }


        .menu-item {

            display: flex;

            align-items: center;

            gap: 12px;

            width: 100%;

            padding:
                12px 14px;

            margin-bottom: 4px;

            border-radius: 10px;

            color: #e7f8f3;

            text-decoration: none;

            font-size: 14px;

            transition:
                all 0.2s ease;
        }


        .menu-item:hover {

            background:
                rgba(255,255,255,0.10);

            color: white;

            transform:
                translateX(3px);
        }


        .menu-item.active {

            background:
                linear-gradient(
                    90deg,
                    #11a875,
                    #079567
                );

            color: white;

            font-weight: bold;

            box-shadow:
                0 5px 12px rgba(0,0,0,0.14);
        }


        .menu-icon {

            width: 27px;

            min-width: 27px;

            text-align: center;

            font-size: 18px;
        }


        .menu-divider {

            margin:
                18px 8px;

            border-top:
                1px solid rgba(255,255,255,0.12);
        }


        /* =========================================
           MAIN
        ========================================= */

        .main {

            margin-left: 270px;

            min-height: 100vh;
        }


        /* =========================================
           TOPBAR
        ========================================= */

        .topbar {

            height: 70px;

            background: white;

            border-bottom:
                1px solid #e5e7eb;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding:
                0 35px;

            position: sticky;

            top: 0;

            z-index: 500;

            box-shadow:
                0 2px 8px rgba(0,0,0,0.03);
        }


        .page-title {

            font-size: 18px;

            font-weight: bold;

            color: #064e3b;
        }


        .user-area {

            display: flex;

            align-items: center;

            gap: 12px;
        }


        /* =========================================
           NOTIFICATION BUTTON
        ========================================= */

        .notification-button {

            width: 42px;

            height: 42px;

            border-radius: 50%;

            background: #ecfdf5;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 20px;

            text-decoration: none;

            position: relative;

            transition: 0.2s;
        }


        .notification-button:hover {

            background: #d1fae5;

            transform:
                scale(1.05);
        }


        .notification-badge {

            position: absolute;

            top: -2px;

            right: -2px;

            background: #ef4444;

            color: white;

            width: 18px;

            height: 18px;

            border-radius: 50%;

            font-size: 10px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: bold;
        }


        .user-avatar {

            width: 40px;

            height: 40px;

            border-radius: 50%;

            background: #d1fae5;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 20px;
        }


        .user-name {

            font-size: 13px;

            font-weight: bold;

            color: #374151;
        }


        /* =========================================
           CONTENT
        ========================================= */

        .content {

            padding:
                30px 35px 50px;

            max-width: 1200px;
        }


        /* =========================================
           HEADER
        ========================================= */

        .page-header {

            background:
                linear-gradient(
                    120deg,
                    #eafff1,
                    #e5f8f7
                );

            border:
                1px solid #d3eee1;

            border-radius: 20px;

            padding: 30px;

            margin-bottom: 25px;

            box-shadow:
                0 8px 25px rgba(0,0,0,0.05);
        }


        .page-header h1 {

            margin: 0;

            color: #064e3b;

            font-size: 28px;
        }


        .page-header p {

            margin:
                10px 0 0;

            color: #52706d;

            font-size: 14px;
        }


        /* =========================================
           NOTIFICATION CARD
        ========================================= */

        .notification-card {

            background: white;

            border-radius: 16px;

            padding: 22px;

            margin-bottom: 15px;

            border:
                1px solid #e5ece9;

            box-shadow:
                0 5px 15px rgba(0,0,0,0.05);

            display: flex;

            align-items: flex-start;

            gap: 18px;

            transition:
                all 0.2s ease;
        }


        .notification-card:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 20px rgba(0,0,0,0.08);
        }


        .notification-card.unread {

            border-left:
                4px solid #10b981;

            background:
                #fafffc;
        }


        .notification-icon {

            width: 55px;

            height: 55px;

            min-width: 55px;

            border-radius: 14px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 25px;
        }


        .notification-content {

            flex: 1;
        }


        .notification-content h3 {

            margin:
                0 0 7px;

            color: #087f5b;

            font-size: 16px;
        }


        .notification-content p {

            margin: 0;

            color: #64748b;

            font-size: 13px;

            line-height: 1.6;
        }


        .notification-time {

            margin-top: 8px;

            color: #94a3b8;

            font-size: 11px;
        }


        .notification-action {

            display: inline-block;

            margin-top: 12px;

            padding:
                8px 13px;

            background: #07895f;

            color: white;

            text-decoration: none;

            border-radius: 8px;

            font-size: 12px;

            font-weight: bold;

            transition: 0.2s;
        }


        .notification-action:hover {

            background: #056c4c;
        }


        /* =========================================
           EMPTY NOTIFICATION
        ========================================= */

        .notification-empty {

            background: white;

            border-radius: 16px;

            padding: 45px 25px;

            text-align: center;

            border:
                1px solid #e5ece9;

            box-shadow:
                0 5px 15px rgba(0,0,0,0.05);

            color: #64748b;
        }


        .notification-empty-icon {

            font-size: 45px;

            margin-bottom: 15px;
        }


        .notification-empty h3 {

            margin:
                0 0 8px;

            color: #064e3b;
        }


        .notification-empty p {

            margin: 0;

            font-size: 13px;
        }


        /* =========================================
           FOOTER
        ========================================= */

        .footer {

            text-align: center;

            margin-top: 40px;

            color: #94a3b8;

            font-size: 12px;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media(max-width: 800px) {

            .sidebar {

                width: 220px;
            }


            .main {

                margin-left: 220px;
            }


            .content {

                padding:
                    25px 20px;
            }

        }


        @media(max-width: 600px) {

            .sidebar {

                width: 70px;
            }


            .main {

                margin-left: 70px;
            }


            .sidebar-header {

                justify-content: center;

                padding: 15px;
            }


            .logo-text,
            .menu-title,
            .menu-item span:not(.menu-icon) {

                display: none;
            }


            .menu-item {

                justify-content: center;

                padding:
                    13px 8px;
            }


            .menu-icon {

                width: 100%;
            }


            .topbar {

                padding:
                    0 15px;
            }


            .user-name {

                display: none;
            }


            .content {

                padding:
                    20px 15px;
            }


            .notification-card {

                padding: 16px;

                gap: 12px;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<aside class="sidebar">


    <div class="sidebar-header">

        <div class="logo-icon">
            ⚡
        </div>

        <div class="logo-text">
            EVChargeHub
        </div>

    </div>


    <div class="menu">


        <!-- MENU UTAMA -->

        <div class="menu-title">
            Menu Utama
        </div>


        <a
            href="{{ route('user.dashboard') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                🏠
            </span>

            <span>
                Dashboard
            </span>

        </a>


        <!-- AKUN -->

        <div class="menu-title">
            Akun
        </div>


        <a
            href="{{ route('profile.edit') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                👤
            </span>

            <span>
                Profil Saya
            </span>

        </a>


        <a
            href="{{ route('vehicles.index') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                🚗
            </span>

            <span>
                Kendaraan Saya
            </span>

        </a>


        <!-- FITUR UTAMA -->

        <div class="menu-title">
            Fitur Utama
        </div>


        <a
            href="{{ route('stations.index') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                📍
            </span>

            <span>
                Charging Station
            </span>

        </a>


        <a
            href="{{ route('stations.index') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                ⚡
            </span>

            <span>
                Charging
            </span>

        </a>


        <!-- NOTIFIKASI -->

        <a
            href="{{ route('notifications.index') }}"
            class="menu-item active"
        >

            <span class="menu-icon">
                🔔
            </span>

            <span>
                Notifikasi
            </span>

        </a>


        <!-- LOGOUT -->

        <div class="menu-divider"></div>


        <form
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="menu-item"
                style="background: transparent; border: none; cursor: pointer;"
            >

                <span class="menu-icon">
                    🚪
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


    <!-- TOPBAR -->

    <header class="topbar">


        <div class="page-title">
            Notifikasi
        </div>


        <div class="user-area">


            <!-- LONCENG -->

            <a
                href="{{ route('notifications.index') }}"
                class="notification-button"
            >

                🔔

                @php
                    $unreadNotifications = $notifications
                        ->where('is_read', false)
                        ->count();
                @endphp

                @if($unreadNotifications > 0)

                    <span class="notification-badge">

                        {{ $unreadNotifications > 9 ? '9+' : $unreadNotifications }}

                    </span>

                @endif

            </a>


            <!-- AVATAR -->

            <div class="user-avatar">
                👤
            </div>


            <!-- USER -->

            <div class="user-name">

                {{ auth()->user()->nama }}

            </div>


        </div>

    </header>



    <!-- CONTENT -->

    <main class="content">


        <!-- HEADER -->

        <section class="page-header">

            <h1>
                🔔 Notifikasi
            </h1>

            <p>
                Berikut informasi dan pemberitahuan
                mengenai aktivitas akun EVChargeHub Anda.
            </p>

        </section>



        <!-- =================================================
             NOTIFIKASI DINAMIS DARI DATABASE
        ================================================= -->

        @if($notifications->count() > 0)


            @foreach($notifications as $notification)


                <div
                    class="notification-card {{ !$notification->is_read ? 'unread' : '' }}"
                >


                    <!-- ICON -->

                    <div
                        class="notification-icon"
                        @if($notification->type === 'payment')
                            style="background:#fef3c7;"
                        @elseif($notification->type === 'charging')
                            style="background:#dcfce7;"
                        @elseif($notification->type === 'vehicle')
                            style="background:#dbeafe;"
                        @else
                            style="background:#ede9fe;"
                        @endif
                    >

                        @if($notification->type === 'payment')

                            💳

                        @elseif($notification->type === 'charging')

                            ⚡

                        @elseif($notification->type === 'vehicle')

                            🚗

                        @else

                            🔔

                        @endif

                    </div>


                    <!-- CONTENT -->

                    <div class="notification-content">


                        <h3>

                            {{ $notification->title }}

                        </h3>


                        <p>

                            {{ $notification->message }}

                        </p>


                        <!-- WAKTU -->

                        <div class="notification-time">

                            @if($notification->created_at)

                                {{ $notification->created_at->format('d/m/Y H:i') }}

                            @else

                                -

                            @endif

                        </div>


                        <!-- ACTION -->

                        @if($notification->type === 'vehicle')

                            <a
                                href="{{ route('vehicles.index') }}"
                                class="notification-action"
                            >
                                Kelola Kendaraan →
                            </a>

                        @elseif(
                            $notification->type === 'charging'
                            && str_contains(
                                strtolower($notification->title),
                                'siap'
                            )
                        )

                            <a
                                href="{{ route('stations.index') }}"
                                class="notification-action"
                            >
                                Cari Charging Station →
                            </a>

                        @elseif(
                            $notification->type === 'payment'
                            && str_contains(
                                strtolower($notification->title),
                                'berhasil'
                            )
                        )

                            <a
                                href="{{ route('charging.history') }}"
                                class="notification-action"
                            >
                                Lihat Riwayat →
                            </a>

                        @endif


                    </div>


                </div>


            @endforeach


        @else


            <!-- TIDAK ADA NOTIFIKASI -->

            <div class="notification-empty">

                <div class="notification-empty-icon">
                    🔔
                </div>

                <h3>
                    Belum ada notifikasi
                </h3>

                <p>
                    Saat ini belum ada pemberitahuan
                    untuk akun Anda.
                </p>

            </div>


        @endif



        <!-- FOOTER -->

        <div class="footer">

            © {{ date('Y') }} EVChargeHub
            — Sistem Manajemen Charging Kendaraan Listrik

        </div>


    </main>

</div>


</body>

</html>