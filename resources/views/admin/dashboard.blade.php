<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - EVChargeHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7f6;
            color: #263238;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: #198754;
            color: white;
            padding: 25px 16px;
            overflow-y: auto;
        }

        .brand {
            padding: 0 12px 28px;
            border-bottom: 1px solid rgba(255,255,255,.2);
            margin-bottom: 25px;
        }

        .brand h2 {
            font-size: 23px;
            margin-bottom: 7px;
        }

        .brand p {
            font-size: 12px;
            opacity: .85;
        }

        .menu-title {
            padding: 0 12px;
            margin: 20px 0 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: .75;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 12px;
            margin-bottom: 5px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: .2s;
        }

        .menu-item:hover,
        .menu-item.active {
            background: rgba(255,255,255,.2);
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .logout-button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 12px;
            margin-bottom: 5px;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            text-align: left;
            width: 100%;
            border: none;
            background: transparent;
        }

        .logout-button:hover {
            background: rgba(255,255,255,.2);
        }

        .main {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #718078;
            font-size: 14px;
            line-height: 1.6;
        }

        .admin-label {
            background: white;
            border: 1px solid #e2e8e5;
            padding: 11px 16px;
            border-radius: 9px;
            font-size: 13px;
        }

        .welcome-card {
            background: linear-gradient(120deg, #198754, #27ae60);
            color: white;
            padding: 28px;
            border-radius: 14px;
            margin-bottom: 28px;
        }

        .welcome-card h2 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .welcome-card p {
            font-size: 14px;
            line-height: 1.7;
            opacity: .95;
        }

        .section-title {
            font-size: 19px;
            margin-bottom: 17px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
            border: 1px solid #edf1ee;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            background: #e5f5eb;
            font-size: 22px;
            margin-bottom: 16px;
        }

        .stat-card p {
            color: #718078;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .stat-card h3 {
            font-size: 27px;
            color: #198754;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 30px;
        }

        .quick-card {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            border: 1px solid #e7ede9;
            padding: 20px;
            border-radius: 12px;
            text-decoration: none;
            color: #263238;
            transition: .2s;
        }

        .quick-card:hover {
            border-color: #198754;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25,135,84,.08);
        }

        .quick-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            background: #e5f5eb;
            font-size: 23px;
        }

        .quick-card h3 {
            font-size: 14px;
            margin-bottom: 6px;
        }

        .quick-card p {
            font-size: 12px;
            color: #718078;
            line-height: 1.5;
        }

        .info-card {
            background: white;
            border-radius: 12px;
            padding: 23px;
            border: 1px solid #edf1ee;
        }

        .info-card h2 {
            font-size: 17px;
            margin-bottom: 12px;
        }

        .info-card p {
            color: #718078;
            font-size: 13px;
            line-height: 1.8;
        }

        .footer-note {
            text-align: center;
            padding: 25px 0 10px;
            color: #89958e;
            font-size: 12px;
        }

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .quick-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                padding: 22px;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .stats-grid,
            .quick-grid {
                grid-template-columns: 1fr;
            }

            .topbar h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="brand">
            <h2>⚡ EVChargeHub</h2>
            <p>Admin Management Panel</p>
        </div>

        <div class="menu-title">Menu Utama</div>

        <a href="{{ route('admin.dashboard') }}"
           class="menu-item active">
            <span class="menu-icon">📊</span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.stations.index') }}"
           class="menu-item">
            <span class="menu-icon">📍</span>
            <span>Charging Station</span>
        </a>

        <a href="{{ route('admin.chargers.index') }}"
           class="menu-item">
            <span class="menu-icon">🔌</span>
            <span>Kelola Charger</span>
        </a>

        {{-- Menu Tarif Charging sudah terhubung ke route --}}
        <a href="{{ route('admin.tariffs.index') }}"
           class="menu-item">
            <span class="menu-icon">💰</span>
            <span>Tarif Charging</span>
        </a>

        <div class="menu-title">Akun</div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-button">
                <span class="menu-icon">🚪</span>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1>Dashboard Admin</h1>
                <p class="subtitle">
                    Selamat datang di panel pengelolaan EVChargeHub.
                </p>
            </div>

            <div class="admin-label">
                👤 Administrator
            </div>
        </header>

        <section class="welcome-card">
            <h2>Halo, Administrator! 👋</h2>
            <p>
                Kelola pengguna, charging station, charger, sesi charging,
                dan pembayaran EVChargeHub melalui satu halaman dashboard.
            </p>
        </section>

        <section>
            <h2 class="section-title">Ringkasan Sistem</h2>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <p>Total Pengguna</p>
                    <h3>{{ $totalUsers ?? 0 }}</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">📍</div>
                    <p>Total Charging Station</p>
                    <h3>{{ $totalLocations ?? 0 }}</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">🔌</div>
                    <p>Total Charger</p>
                    <h3>{{ $totalChargers ?? 0 }}</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">⚡</div>
                    <p>Total Sesi Charging</p>
                    <h3>{{ $totalSessions ?? 0 }}</h3>
                </div>
            </div>
        </section>

        <section>
            <h2 class="section-title">Akses Cepat</h2>

            <div class="quick-grid">
                <a href="{{ route('admin.stations.index') }}"
                   class="quick-card">
                    <div class="quick-icon">📍</div>
                    <div>
                        <h3>Charging Station</h3>
                        <p>Kelola lokasi dan informasi stasiun.</p>
                    </div>
                </a>

                <a href="{{ route('admin.chargers.index') }}"
                   class="quick-card">
                    <div class="quick-icon">🔌</div>
                    <div>
                        <h3>Kelola Charger</h3>
                        <p>Kelola perangkat dan status charger.</p>
                    </div>
                </a>

                <a href="{{ route('admin.tariffs.index') }}"
                   class="quick-card">
                    <div class="quick-icon">💰</div>
                    <div>
                        <h3>Tarif Charging</h3>
                        <p>Lihat dan kelola tarif charging.</p>
                    </div>
                </a>

                <a href="{{ route('admin.dashboard') }}"
                   class="quick-card">
                    <div class="quick-icon">💳</div>
                    <div>
                        <h3>Pembayaran</h3>
                        <p>Ringkasan pengelolaan pembayaran.</p>
                    </div>
                </a>

                <a href="{{ route('admin.dashboard') }}"
                   class="quick-card">
                    <div class="quick-icon">📈</div>
                    <div>
                        <h3>Laporan</h3>
                        <p>Lihat ringkasan data pada sistem.</p>
                    </div>
                </a>

                <a href="{{ route('admin.dashboard') }}"
                   class="quick-card">
                    <div class="quick-icon">⚙️</div>
                    <div>
                        <h3>Pengaturan Sistem</h3>
                        <p>Akses halaman utama administrasi.</p>
                    </div>
                </a>
            </div>
        </section>

        <section class="info-card">
            <h2>Informasi Sistem</h2>
            <p>
                Dashboard ini digunakan administrator untuk memantau
                data utama EVChargeHub dan mengakses fitur pengelolaan.
                Gunakan menu Charging Station untuk mengelola lokasi stasiun,
                menu Kelola Charger untuk mengelola perangkat charger,
                dan menu Tarif Charging untuk mengatur tarif pengisian daya.
            </p>
        </section>

        <footer class="footer-note">
            EVChargeHub Admin Panel &copy; {{ date('Y') }}
        </footer>
    </main>
</body>
</html>
