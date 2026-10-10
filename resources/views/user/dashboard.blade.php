<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - EVChargeHub</title>

    <style>

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f8f7;
            color: #1f2937;
        }

        a {
            text-decoration: none;
        }

        button,
        input {
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
            color: rgba(255,255,255,0.72);
            font-size: 9px;
            letter-spacing: 0.2px;
        }

        /* =====================================================
           MENU
        ===================================================== */

        .menu {
            padding: 16px 14px 30px;
            height: calc(100vh - 110px);
            overflow-y: auto;
            scrollbar-width: none;
        }

        .menu::-webkit-scrollbar {
            display: none;
        }

        .menu-title {
            padding: 16px 14px 10px;

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

            padding: 14px 15px;
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

        .menu-divider {
            margin: 22px 9px;

            border-top:
                1px solid
                rgba(255,255,255,0.20);
        }

        .menu form {
            position: relative;
            z-index: 6;
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
           SIDEBAR PROFILE
        ===================================================== */

        .sidebar-profile-box {
            display: none;

            margin: 5px 5px 12px;
            padding: 18px 15px;

            background:
                rgba(0,0,0,0.25);

            border-radius: 14px;

            text-align: center;

            border:
                1px solid
                rgba(255,255,255,0.12);

            position: relative;
            z-index: 8;
        }

        .sidebar-profile-box.show {
            display: block;
        }

        .sidebar-profile-photo {
            width: 62px;
            height: 62px;

            margin: 0 auto 10px;

            border-radius: 50%;

            background: #d1fae5;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 28px;

            overflow: hidden;
        }

        .sidebar-profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sidebar-profile-name {
            color: white;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .sidebar-profile-label {
            color: #b7e9d5;
            font-size: 10px;
            margin-bottom: 12px;
        }

        .sidebar-change-photo {
            display: inline-block;

            padding: 7px 10px;

            background: #10a875;
            color: white;

            border-radius: 7px;

            font-size: 10px;
            font-weight: 700;

            cursor: pointer;
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

            padding: 0 38px;

            position: sticky;
            top: 0;

            z-index: 500;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .mobile-menu {
            display: none;

            width: 42px;
            height: 42px;

            border: none;
            background: transparent;

            font-size: 25px;

            cursor: pointer;

            color: #075b4d;
        }

        .page-title {
            font-size: 25px;
            font-weight: 700;

            color: #064e3b;

            letter-spacing: -0.5px;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        /* =====================================================
           NOTIFICATION
        ===================================================== */

        .notification-wrapper {
            position: relative;
        }

        .notification {
            width: 45px;
            height: 45px;

            border-radius: 50%;

            background: #ecfdf5;

            border:
                1px solid #d1fae5;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 20px;

            cursor: pointer;

            transition: 0.2s;

            position: relative;
        }

        .notification:hover {
            background: #d1fae5;

            transform:
                translateY(-1px);
        }

        .notification-dot {
            position: absolute;

            top: -2px;
            right: -1px;

            min-width: 20px;
            height: 20px;

            padding: 0 4px;

            background: #ef4444;
            color: white;

            border:
                2px solid white;

            border-radius: 50%;

            font-size: 9px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: 700;
        }

        /* =====================================================
           NOTIFICATION BOX
        ===================================================== */

        .notification-box {
            display: none;

            position: absolute;

            right: 0;
            top: 55px;

            width: 360px;
            max-height: 450px;

            overflow-y: auto;

            background: white;

            border-radius: 16px;

            border:
                1px solid #e5e7eb;

            box-shadow:
                0 15px 40px
                rgba(0,0,0,0.15);

            z-index: 2000;
        }

        .notification-box.show {
            display: block;

            animation:
                fadeDown 0.2s ease;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notification-header {
            padding: 16px 18px;

            background: #f0fdf4;
            color: #065f46;

            font-weight: 700;

            border-bottom:
                1px solid #e5e7eb;
        }

        .notification-item {
            padding: 15px 18px;

            border-bottom:
                1px solid #f1f5f9;
        }

        .notification-item:hover {
            background: #f8fafc;
        }

        .notification-unread {
            background: #ecfdf5;

            border-left:
                4px solid #10b981;
        }

        .notification-item strong {
            display: block;

            color: #064e3b;

            font-size: 13px;

            margin-bottom: 5px;
        }

        .notification-message {
            color: #64748b;

            font-size: 12px;

            line-height: 1.5;
        }

        .notification-item small {
            display: block;

            margin-top: 7px;

            color: #94a3b8;

            font-size: 10px;
        }

        .notification-empty {
            padding: 35px 20px;

            text-align: center;

            color: #64748b;

            font-size: 13px;
        }

        .new-label {
            display: inline-block;

            margin-left: 6px;

            padding: 3px 6px;

            background: #ef4444;
            color: white;

            border-radius: 7px;

            font-size: 8px;
            font-weight: 700;
        }

        /* =====================================================
           PROFILE TOPBAR
        ===================================================== */

        .profile-wrapper {
            position: relative;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;

            padding: 5px 8px;

            border-radius: 12px;

            border: none;
            background: transparent;

            cursor: pointer;

            transition: 0.2s;
        }

        .user-profile:hover {
            background: #f0fdf4;
        }

        .user-avatar {
            width: 45px;
            height: 45px;

            border-radius: 50%;

            background: #d1fae5;

            border:
                2px solid #a7f3d0;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 20px;

            overflow: hidden;
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

        .profile-arrow {
            font-size: 16px;
            color: #075b4d;
        }

        /* =====================================================
           PROFILE BOX
        ===================================================== */

        .profile-box {
            display: none;

            position: absolute;

            right: 0;
            top: 58px;

            width: 285px;

            background: white;

            border-radius: 17px;

            padding: 22px;

            box-shadow:
                0 15px 40px
                rgba(0,0,0,0.15);

            border:
                1px solid #e5e7eb;

            z-index: 3000;

            text-align: center;
        }

        .profile-box.show {
            display: block;
        }

        .profile-photo-large {
            width: 85px;
            height: 85px;

            margin: 0 auto 12px;

            border-radius: 50%;

            background: #d1fae5;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 38px;

            overflow: hidden;

            border:
                3px solid #a7f3d0;
        }

        .profile-photo-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 17px;
            font-weight: 700;

            color: #064e3b;

            margin-bottom: 5px;
        }

        .profile-label {
            font-size: 12px;

            color: #64748b;

            margin-bottom: 18px;
        }

        .change-photo-button {
            display: inline-flex;

            align-items: center;
            gap: 6px;

            padding: 9px 14px;

            background: #07895f;
            color: white;

            border-radius: 8px;

            font-size: 12px;
            font-weight: 700;

            cursor: pointer;
        }

        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            padding: 38px 38px 55px;

            max-width: 1500px;

            margin: auto;
        }

        /* =====================================================
           WELCOME
        ===================================================== */

        .welcome {
            min-height: 305px;

            position: relative;
            overflow: hidden;

            display: flex;
            align-items: center;

            border-radius: 24px;

            border:
                1px solid #ccebdd;

            background:
                linear-gradient(
                    90deg,
                    rgba(234, 255, 242, 0.96) 0%,
                    rgba(223, 248, 236, 0.82) 45%,
                    rgba(223, 248, 236, 0.30) 100%
                ),
                url('{{ asset("images/evchargehub-dashboard.png") }}');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            box-shadow:
                0 10px 30px rgba(0,0,0,0.05);

            margin-bottom: 35px;
        }

        .welcome-content {
            position: relative;

            z-index: 2;

            padding: 42px;

            max-width: 700px;
        }

        .welcome-label {
            display: inline-block;

            background: #a7f3d0;
            color: #065f46;

            padding: 9px 18px;

            border-radius: 25px;

            font-size: 13px;
            font-weight: 700;

            margin-bottom: 14px;
        }

        .welcome h1 {
            margin: 0;

            color: #064e3b;

            font-size: 35px;

            letter-spacing: -1px;
        }

        .welcome p {
            margin: 12px 0 0;

            max-width: 600px;

            color: #41666a;

            font-size: 15px;

            line-height: 1.7;
        }

        /* =====================================================
           SECTION
        ===================================================== */

        .section-heading {
            display: flex;

            align-items: center;
            justify-content: space-between;

            margin: 0 0 17px;
        }

        .section-title {
            margin: 0;

            color: #064e3b;

            font-size: 22px;
            font-weight: 700;

            display: flex;

            align-items: center;

            gap: 8px;
        }

        .section-title-icon {
            font-size: 25px;
        }

        .section-link {
            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 9px 17px;

            border:
                1px solid #ccebdd;

            border-radius: 22px;

            color: #087f5b;

            background: white;

            font-size: 12px;
            font-weight: 700;

            transition: 0.2s;
        }

        .section-link:hover {
            background: #ecfdf5;

            transform:
                translateY(-1px);
        }

        /* =====================================================
           QUICK ACCESS
        ===================================================== */

        .stat-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 22px;

            margin-bottom: 40px;
        }

        .stat-card {
            display: flex;

            align-items: center;

            gap: 22px;

            padding: 24px;

            min-height: 145px;

            background: white;

            border:
                1px solid #dcebe5;

            border-radius: 18px;

            box-shadow:
                0 8px 24px
                rgba(0,0,0,0.055);

            transition:
                all 0.2s ease;

            position: relative;

            overflow: hidden;
        }

        .stat-card::after {
            content: "";

            position: absolute;

            width: 150px;
            height: 150px;

            border-radius: 50%;

            right: -45px;
            bottom: -75px;

            background:
                rgba(16,185,129,0.07);

            pointer-events: none;
        }

        .stat-card:hover {
            transform:
                translateY(-4px);

            box-shadow:
                0 14px 30px
                rgba(0,0,0,0.09);

            border-color:
                #b7e8d3;
        }

        .stat-icon {
            width: 76px;
            height: 76px;

            min-width: 76px;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 32px;

            position: relative;
            z-index: 2;
        }

        .stat-info {
            position: relative;
            z-index: 2;
        }

        .stat-info h3 {
            margin: 0;

            color: #087f5b;

            font-size: 19px;
        }

        .stat-info p {
            margin: 8px 0 0;

            color: #64748b;

            font-size: 13px;

            line-height: 1.5;
        }

        .stat-arrow {
            margin-left: auto;

            width: 42px;
            height: 42px;

            min-width: 42px;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            color: white;

            font-size: 21px;

            position: relative;
            z-index: 3;
        }

        /* =====================================================
           INFORMATION
        ===================================================== */

        .info-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 20px;
        }

        .info-card {
            background: white;

            padding: 24px;

            min-height: 165px;

            border-radius: 18px;

            border:
                1px solid #e5ebe8;

            box-shadow:
                0 7px 22px
                rgba(0,0,0,0.045);

            transition:
                all 0.2s ease;

            display: flex;

            flex-direction: column;

            position: relative;
        }

        .info-card:hover {
            transform:
                translateY(-3px);

            box-shadow:
                0 12px 27px
                rgba(0,0,0,0.08);
        }

        .info-card-header {
            display: flex;

            align-items: center;

            gap: 15px;
        }

        .info-card-icon {
            width: 58px;
            height: 58px;

            min-width: 58px;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 25px;
        }

        .info-card-title {
            margin: 0;

            color: #087f5b;

            font-size: 16px;

            font-weight: 700;
        }

        .info-card p {
            margin: 13px 0 0;

            color: #64748b;

            font-size: 13px;

            line-height: 1.65;

            max-width: 430px;
        }

        .info-card-bottom {
            margin-top: auto;

            display: flex;

            justify-content: flex-end;

            padding-top: 15px;
        }

        .info-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            width: 40px;
            height: 40px;

            background: #07895f;

            color: white;

            border-radius: 50%;

            font-size: 18px;

            font-weight: 700;

            transition: 0.2s;

            border: none;

            cursor: pointer;
        }

        .info-button:hover {
            background: #056c4c;

            transform:
                translateX(3px);
        }

        /* =====================================================
           ABOUT
        ===================================================== */

        .about-card {
            margin-top: 38px;

            min-height: 150px;

            border-radius: 20px;

            border:
                1px solid #ccebdd;

            background:
                linear-gradient(
                    100deg,
                    #edfff5,
                    #f5fffb
                );

            display: flex;

            align-items: center;
            justify-content: space-between;

            padding: 25px 35px;

            overflow: hidden;

            position: relative;
        }

        .about-content {
            display: flex;

            align-items: center;

            gap: 18px;

            position: relative;
            z-index: 2;
        }

        .about-icon {
            width: 55px;
            height: 55px;

            min-width: 55px;

            border-radius: 50%;

            background: #d1fae5;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 25px;
        }

        .about-text h2 {
            margin: 0 0 8px;

            color: #064e3b;

            font-size: 20px;
        }

        .about-text p {
            margin: 0;

            max-width: 650px;

            color: #64748b;

            font-size: 13px;

            line-height: 1.6;
        }

        .about-decoration {
            color: #087f5b;

            font-size: 17px;

            font-weight: 700;

            font-style: italic;

            line-height: 1.5;

            text-align: right;

            position: relative;
            z-index: 2;
        }

        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {
            text-align: center;

            margin-top: 50px;

            padding-top: 25px;

            border-top:
                1px solid #e2e8e5;

            color: #94a3b8;

            font-size: 12px;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media(max-width: 1200px) {

            .sidebar {
                width: 260px;
            }

            .main {
                margin-left: 260px;
            }

            .content {
                padding:
                    30px 28px 45px;
            }

            .info-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }
        }

        @media(max-width: 900px) {

            .sidebar {
                width: 235px;
            }

            .main {
                margin-left: 235px;
            }

            .stat-grid {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .welcome h1 {
                font-size: 30px;
            }

            .topbar {
                padding:
                    0 25px;
            }

            .content {
                padding:
                    25px 20px 40px;
            }

            .about-card {
                padding: 22px;
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

                background:
                    rgba(0, 91, 75, 0.90);
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
            .profile-arrow {
                display: none;
            }

            .content {
                padding:
                    20px 15px 40px;
            }

            .welcome {
                min-height: 320px;
            }

            .welcome-content {
                padding: 25px;
            }

            .welcome h1 {
                font-size: 25px;
            }

            .welcome p {
                font-size: 13px;
            }

            .section-title {
                font-size: 19px;
            }

            .section-link {
                display: none;
            }

            .stat-card {
                padding: 18px;
                min-height: 125px;
            }

            .stat-icon {
                width: 60px;
                height: 60px;

                min-width: 60px;

                font-size: 26px;
            }

            .stat-info h3 {
                font-size: 16px;
            }

            .info-card {
                min-height: 150px;
            }

            .about-card {
                align-items: flex-start;

                flex-direction: column;

                gap: 15px;
            }

            .about-decoration {
                text-align: left;

                margin-left: 73px;
            }

            .notification-box {
                width: 285px;
                right: -80px;
            }

            .profile-box {
                right: -20px;
            }
        }

    </style>

</head>


<body>

@php

    /*
    |--------------------------------------------------------------------------
    | DATA DASHBOARD
    |--------------------------------------------------------------------------
    | Dashboard TIDAK menggunakan $session.
    | Data yang digunakan hanya:
    | - user
    | - notifications
    | - unreadNotifications
    */

    $user = auth()->user();

    $notifications = $notifications ?? collect();

    $unreadNotifications =
        $unreadNotifications
        ?? $unreadCount
        ?? 0;

@endphp


<!-- =========================================================
     SIDEBAR
========================================================= -->

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


        <!-- MENU UTAMA -->

        <div class="menu-title">
            Menu Utama
        </div>


        <a
            href="{{ route('user.dashboard') }}"
            class="menu-item active"
        >

            <span class="menu-icon">

                <svg
                    width="21"
                    height="21"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M3 10.5L12 3L21 10.5V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V10.5Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M9 21V13H15V21"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
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


                <!-- AKUN -->

                <div class="menu-title">
                    Akun
                </div>


                <a
            href="{{ route('profile') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                <svg
                    width="21"
                    height="21"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <circle
                        cx="12"
                        cy="8"
                        r="3.5"
                        stroke="currentColor"
                        stroke-width="2"
                    />

                    <path
                        d="M5 20C5 16.6863 8.13401 14 12 14C15.866 14 19 16.6863 19 20"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />
                </svg>
            </span>

            <span>
                Kelola Profil
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
                width="21"
                height="21"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M5 17L6.5 10.5C6.7 9.6 7.5 9 8.4 9H15.6C16.5 9 17.3 9.6 17.5 10.5L19 17"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

                <path
                    d="M4 17H20V20H4V17Z"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linejoin="round"
                />

                <circle
                    cx="7"
                    cy="18"
                    r="1"
                    fill="currentColor"
                />

                <circle
                    cx="17"
                    cy="18"
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


        <!-- FITUR UTAMA -->

        <div class="menu-title">
            Fitur Utama
        </div>


        <a
            href="{{ route('stations.index') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                <svg
                    width="21"
                    height="21"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M12 21C12 21 19 14.8 19 9.5C19 5.91 15.866 3 12 3C8.13401 3 5 5.91 5 9.5C5 14.8 12 21 12 21Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linejoin="round"
                    />

                    <circle
                        cx="12"
                        cy="9.5"
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


        <a
            href="{{ route('charging.history') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                <svg
                    width="21"
                    height="21"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <circle
                        cx="12"
                        cy="12"
                        r="8.5"
                        stroke="currentColor"
                        stroke-width="2"
                    />

                    <path
                        d="M12 7V12L15 14"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
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


        <a
            href="{{ route('notifications.index') }}"
            class="menu-item"
        >

            <span class="menu-icon">
                <svg
                    width="21"
                    height="21"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M18 9C18 5.68629 15.3137 3 12 3C8.68629 3 6 5.68629 6 9C6 13 4 15 4 16H20C20 15 18 13 18 9Z"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linejoin="round"
                    />

                    <path
                        d="M10 20H14"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    />
                </svg>
            </span>

            <span>
                Notifikasi
            </span>
            
             <span class="menu-arrow">
                ›
            </span>

            @if($unreadNotifications > 0)

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
                    {{ $unreadNotifications }}
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
                        width="21"
                        height="21"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M10 5H5C4.44772 5 4 5.44772 4 6V18C4 18.5523 4 19 5 19H10"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                        />

                        <path
                            d="M14 8L18 12L14 16"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />

                        <path
                            d="M9 12H18"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
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


<!-- =========================================================
     MAIN
========================================================= -->

<div class="main">


    <!-- =====================================================
         TOPBAR
    ====================================================== -->

    <header class="topbar">


        <div class="topbar-left">

            <button
                type="button"
                class="mobile-menu"
            >
                ☰
            </button>

            <a
                href="{{ route('user.dashboard') }}"
                class="page-title"
            >
                Dashboard
            </a>

        </div>


        <div class="user-area">


            <!-- NOTIFICATION -->

            <div class="notification-wrapper">

                <button
                    type="button"
                    class="notification"
                    onclick="toggleNotifications()"
                >

                    🔔

                    @if($unreadNotifications > 0)

                        <span
                            class="notification-dot"
                            id="notificationDot"
                        >
                            {{ $unreadNotifications > 9 ? '9+' : $unreadNotifications }}
                        </span>

                    @endif

                </button>


                <div
                    id="notificationBox"
                    class="notification-box"
                >

                    <div class="notification-header">

                        🔔 Notifikasi

                    </div>


                    @if($notifications->count() > 0)

                        @foreach($notifications as $notification)

                            <div
                                class="
                                    notification-item
                                    {{ !$notification->is_read
                                        ? 'notification-unread'
                                        : '' }}
                                "
                            >

                                <strong>

                                    @if($notification->type === 'payment')

                                        💳

                                    @elseif($notification->type === 'charging')

                                        ⚡

                                    @elseif($notification->type === 'vehicle')

                                        🚗

                                    @elseif($notification->type === 'system')

                                        🔔

                                    @else

                                        🔔

                                    @endif

                                    {{ $notification->title }}


                                    @if(!$notification->is_read)

                                        <span class="new-label">
                                            BARU
                                        </span>

                                    @endif

                                </strong>


                                <span class="notification-message">

                                    {{ $notification->message }}

                                </span>


                                @if($notification->created_at)

                                    <small>

                                        {{ $notification->created_at->format('d/m/Y H:i') }}

                                    </small>

                                @endif

                            </div>

                        @endforeach


                    @else

                        <div class="notification-empty">

                            🔔 Belum ada notifikasi.

                        </div>

                    @endif

                </div>

            </div>


            <!-- PROFILE -->

            <div class="profile-wrapper">


                <button
                    type="button"
                    class="user-profile"
                    onclick="toggleProfileMenu()"
                >

                    <div class="user-avatar">

                        @if($user && $user->foto)

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

                </button>


                <!-- PROFILE BOX -->

                <div
                    id="profileBox"
                    class="profile-box"
                >

                    <div class="profile-photo-large">

                        @if($user && $user->foto)

                            <img
                                src="{{ asset('storage/' . $user->foto) }}"
                                alt="Foto Profil"
                            >

                        @else

                            👤

                        @endif

                    </div>


                    <div class="profile-name">

                        {{ $user->nama ?? 'Pengguna' }}

                    </div>


                    <div class="profile-label">

                        Pengguna EVChargeHub

                    </div>


                    <form
                        action="{{ route('profile.photo.update') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <label
                            for="profile-photo-input"
                            class="change-photo-button"
                        >

                            📷

                            {{ $user && $user->foto
                                ? 'Ganti Foto'
                                : 'Tambah Foto' }}

                        </label>


                        <input
                            type="file"
                            name="foto"
                            id="profile-photo-input"
                            accept=".jpg,.jpeg,.png,.webp"
                            hidden
                            onchange="this.form.submit()"
                        >

                    </form>

                </div>

            </div>

        </div>

    </header>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <main class="content">


        <!-- =================================================
             WELCOME
        ================================================== -->

        <section class="welcome">


            <div class="welcome-content">


                <div class="welcome-label">

                    Selamat Datang 👋

                </div>


                <h1>

                    Halo,
                    {{ $user->nama ?? 'Pengguna' }}!

                </h1>


                <p>

                    Kelola kendaraan dan lakukan pengisian
                    kendaraan listrik melalui EVChargeHub
                    dengan lebih mudah, cepat, dan aman.

                </p>


            </div>

        </section>


        <!-- =================================================
             AKSES CEPAT
        ================================================== -->

        <div class="section-heading">

            <h2 class="section-title">

                <span class="section-title-icon">
                    ⚡
                </span>

                Akses Cepat

            </h2>


            <a
                href="{{ route('stations.index') }}"
                class="section-link"
            >

                Lihat Semua

                <span>
                    →
                </span>

            </a>

        </div>


        <div class="stat-grid">


            <!-- STATION -->

            <a
                href="{{ route('stations.index') }}"
                class="stat-card"
            >

             <div
                class="stat-icon"
                style="background:#d8fae8;"
            >
                <svg
                    width="32"
                    height="32"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M12 21C12 21 19 14.8 19 9.5C19 5.91 15.866 3 12 3C8.13401 3 5 5.91 5 9.5C5 14.8 12 21 12 21Z"
                        stroke="white"
                        stroke-width="2"
                        stroke-linejoin="round"
                    />
                    <circle
                        cx="12"
                        cy="9.5"
                        r="2.5"
                        stroke="white"
                        stroke-width="2"
                    />
                </svg>
            </div>


                <div class="stat-info">

                    <h3>
                        Charging Station
                    </h3>

                    <p>
                        Cari station dan lihat charger
                        yang tersedia.
                    </p>

                </div>


                <div
                    class="stat-arrow"
                    style="background:#07895f;"
                >
                    →
                </div>

            </a>


            <!-- VEHICLE -->

        <a
            href="{{ route('vehicles.index') }}"
            class="stat-card"
        >

            <div
                class="stat-icon"
                style="background:#d8fae8;"
            >
            <svg
                width="32"
                height="32"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M5 17H4C3.44772 17 3 16.5523 3 16V12C3 11.4477 3.44772 3 4 11H5L6.8 6.5C7.103 5.742 7.836 5.25 8.65 5.25H15.35C16.164 5.25 16.897 5.742 17.2 6.5L19 11H20C20.5523 11 21 11.4477 21 12V16C21 16.5523 20.5523 17 20 17H19"
                    stroke="white"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

                <path
                    d="M6 17V19C6 19.5523 6.44772 20 7 20H8C8.55228 20 9 19.5523 9 19V17H15V19C15 19.5523 15.4477 20 16 20H17C17.5523 20 18 19.5523 18 19V17"
                    stroke="white"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

                <path
                    d="M6 11H18"
                    stroke="white"
                    stroke-width="2"
                    stroke-linecap="round"
                />

                <circle
                    cx="7"
                    cy="15"
                    r="1"
                    fill="white"
                />

                <circle
                    cx="17"
                    cy="15"
                    r="1"
                    fill="white"
                />
            </svg>
            </div>

            <div class="stat-info">

                <h3>
                    Kendaraan Saya
                </h3>

                <p>
                    Kelola kendaraan listrik Anda.
                </p>

            </div>

            <div
                class="stat-arrow"
                style="background:#1677d2;"
            >
                →
            </div>

        </a>


        </div>


        <!-- =================================================
             INFORMASI
        ================================================== -->

        <div class="section-heading">

            <h2 class="section-title">

                <span class="section-title-icon">
                    📌
                </span>

                Informasi

            </h2>


        </div>


        <div class="info-grid">


            <!-- STATION -->

            <div class="info-card">

                <div class="info-card-header">

                    <div
                        class="info-card-icon"
                        style="background:#fce7ef;"
                    >
                        📍
                    </div>


                    <h3 class="info-card-title">

                        Charging Station

                    </h3>

                </div>


                <p>

                    Cari charging station,
                    lihat lokasi, charger,
                    dan tarif.

                </p>


                <div class="info-card-bottom">

                    <a
                        href="{{ route('stations.index') }}"
                        class="info-button"
                        style="background:#ec4899;"
                    >

                        →

                    </a>

                </div>

            </div>


            <!-- VEHICLE -->

            <div class="info-card">

                <div class="info-card-header">

                    <div
                        class="info-card-icon"
                        style="background:#dbeafe;"
                    >
                        🚗
                    </div>


                    <h3 class="info-card-title">

                        Kendaraan Saya

                    </h3>

                </div>


                <p>

                    Tambahkan dan kelola
                    kendaraan listrik
                    yang digunakan.

                </p>


                <div class="info-card-bottom">

                    <a
                        href="{{ route('vehicles.index') }}"
                        class="info-button"
                        style="background:#1682dc;"
                    >

                        →

                    </a>

                </div>

            </div>


            <!-- HISTORY -->

            <div class="info-card">

                <div class="info-card-header">

                    <div
                        class="info-card-icon"
                        style="background:#ede9fe;"
                    >
                        🕐
                    </div>


                    <h3 class="info-card-title">

                        Riwayat Charging

                    </h3>

                </div>


                <p>

                    Lihat riwayat pengisian
                    kendaraan dan transaksi
                    pembayaran.

                </p>


                <div class="info-card-bottom">

                    <a
                        href="{{ route('charging.history') }}"
                        class="info-button"
                        style="background:#8b5cf6;"
                    >

                        →

                    </a>

                </div>

            </div>


            <!-- NOTIFICATION -->

            <div class="info-card">

                <div class="info-card-header">

                    <div
                        class="info-card-icon"
                        style="background:#fef3c7;"
                    >
                        🔔
                    </div>


                    <h3 class="info-card-title">

                        Notifikasi

                    </h3>

                </div>


                <p>

                    Lihat pemberitahuan
                    mengenai charging,
                    pembayaran, dan informasi akun.

                </p>


                <div class="info-card-bottom">

                    <a
                        href="{{ route('notifications.index') }}"
                        class="info-button"
                        style="background:#f59e0b;"
                    >

                        →

                    </a>

                </div>

            </div>


            <!-- PROFILE -->

            <div class="info-card">

                <div class="info-card-header">

                    <div
                        class="info-card-icon"
                        style="background:#ede9fe;"
                    >
                        👤
                    </div>


                    <h3 class="info-card-title">

                        Profil Saya

                    </h3>

                </div>


                <p>

                    Lihat dan kelola
                    informasi profil
                    akun EVChargeHub.

                </p>


                <div class="info-card-bottom">

                    <a
                        href="{{ route('profile') }}"
                        class="info-button"
                        style="background:#7c3aed;"
                    >

                        →

                    </a>

                </div>

            </div>


            <!-- CHARGING -->

            <div class="info-card">

                <div class="info-card-header">

                    <div
                        class="info-card-icon"
                        style="background:#dcfce7;"
                    >
                        ⚡
                    </div>


                    <h3 class="info-card-title">

                        Charging

                    </h3>

                </div>


                <p>

                    Mulai proses charging
                    kendaraan melalui
                    charging station.

                </p>


                <div class="info-card-bottom">

                    <a
                        href="{{ route('stations.index') }}"
                        class="info-button"
                        style="background:#07895f;"
                    >

                        →

                    </a>

                </div>

            </div>


        </div>


        <!-- =================================================
             ABOUT EVCHARGEHUB
        ================================================== -->

        <div class="about-card">

            <div class="about-content">

                <div class="about-icon">
                    🌱
                </div>


                <div class="about-text">

                    <h2>
                        Tentang EVChargeHub
                    </h2>

                    <p>

                        EVChargeHub hadir untuk mendukung
                        mobilitas listrik yang lebih mudah,
                        aman, dan ramah lingkungan.

                    </p>

                </div>

            </div>


            <div class="about-decoration">

                Small steps<br>
                Big impact 🌱

            </div>

        </div>


        <!-- =================================================
             FOOTER
        ================================================== -->

        <div class="footer">

            © {{ date('Y') }}
            EVChargeHub
            —
            Sistem Manajemen Charging Kendaraan Listrik

        </div>


    </main>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

/* =========================================================
   NOTIFICATION
========================================================= */

function toggleNotifications() {

    const box =
        document.getElementById('notificationBox');

    if (!box) {
        return;
    }


    const profileBox =
        document.getElementById('profileBox');

    if (profileBox) {
        profileBox.classList.remove('show');
    }


    const sidebarProfileBox =
        document.getElementById('sidebarProfileBox');

    if (sidebarProfileBox) {
        sidebarProfileBox.classList.remove('show');
    }


    box.classList.toggle('show');


    /*
    |--------------------------------------------------------------------------
    | Tandai notifikasi sebagai sudah dibaca
    |--------------------------------------------------------------------------
    */

    if (box.classList.contains('show')) {

        fetch(
            "{{ route('notifications.read') }}",
            {
                method: "POST",

                headers: {
                    "X-CSRF-TOKEN":
                        "{{ csrf_token() }}",

                    "Accept":
                        "application/json",

                    "Content-Type":
                        "application/json"
                },

                body:
                    JSON.stringify({})
            }
        )

        .then(response => {

            if (!response.ok) {

                throw new Error(
                    'Gagal menghubungi server'
                );

            }

            return response.json();

        })

        .then(data => {

            if (data.success) {

                const dot =
                    document.getElementById(
                        'notificationDot'
                    );

                if (dot) {
                    dot.remove();
                }


                document
                    .querySelectorAll('.new-label')
                    .forEach(function(label) {

                        label.remove();

                    });


                document
                    .querySelectorAll(
                        '.notification-unread'
                    )
                    .forEach(function(item) {

                        item.classList.remove(
                            'notification-unread'
                        );

                    });

            }

        })

        .catch(error => {

            console.error(
                'Gagal menandai notifikasi:',
                error
            );

        });

    }

}


/* =========================================================
   PROFILE
========================================================= */

function toggleProfileMenu() {

    const profileBox =
        document.getElementById('profileBox');

    if (!profileBox) {
        return;
    }


    const notificationBox =
        document.getElementById('notificationBox');

    if (notificationBox) {

        notificationBox.classList.remove(
            'show'
        );

    }


    const sidebarProfileBox =
        document.getElementById(
            'sidebarProfileBox'
        );

    if (sidebarProfileBox) {

        sidebarProfileBox.classList.remove(
            'show'
        );

    }


    profileBox.classList.toggle('show');

}


/* =========================================================
   SIDEBAR PROFILE
========================================================= */

function toggleSidebarProfile() {

    const box =
        document.getElementById(
            'sidebarProfileBox'
        );

    if (!box) {
        return;
    }


    const notificationBox =
        document.getElementById(
            'notificationBox'
        );

    if (notificationBox) {

        notificationBox.classList.remove(
            'show'
        );

    }


    const profileBox =
        document.getElementById(
            'profileBox'
        );

    if (profileBox) {

        profileBox.classList.remove(
            'show'
        );

    }


    box.classList.toggle('show');

}


/* =========================================================
   CLICK OUTSIDE
========================================================= */

document.addEventListener(
    'click',
    function(event) {

        const notificationBox =
            document.getElementById(
                'notificationBox'
            );

        const notificationWrapper =
            document.querySelector(
                '.notification-wrapper'
            );


        if (
            notificationBox &&
            notificationWrapper &&
            !notificationWrapper.contains(
                event.target
            )
        ) {

            notificationBox.classList.remove(
                'show'
            );

        }


        const profileBox =
            document.getElementById(
                'profileBox'
            );

        const profileWrapper =
            document.querySelector(
                '.profile-wrapper'
            );


        if (
            profileBox &&
            profileWrapper &&
            !profileWrapper.contains(
                event.target
            )
        ) {

            profileBox.classList.remove(
                'show'
            );

        }


        const sidebarProfileBox =
            document.getElementById(
                'sidebarProfileBox'
            );

        const sidebar =
            document.querySelector(
                '.sidebar'
            );


        if (
            sidebarProfileBox &&
            sidebar &&
            !sidebar.contains(
                event.target
            )
        ) {

            sidebarProfileBox.classList.remove(
                'show'
            );

        }

    }
);

</script>


</body>

</html>