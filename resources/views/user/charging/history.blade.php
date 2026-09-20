<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Charging - EVChargeHub</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f8f7;
            color: #1f2937;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 25px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            color: #064e3b;
            font-size: 28px;
        }

        .back {
            background: #07895f;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.06);
            margin-bottom: 18px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-header h3 {
            margin: 0;
            color: #087f5b;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .selesai {
            background: #dcfce7;
            color: #166534;
        }

        .berlangsung {
            background: #fef3c7;
            color: #92400e;
        }

        .dibatalkan,
        .gagal {
            background: #fee2e2;
            color: #991b1b;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .info {
            background: #f8fafc;
            padding: 13px;
            border-radius: 9px;
        }

        .label {
            display: block;
            color: #64748b;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .value {
            font-weight: bold;
            color: #1f2937;
            font-size: 14px;
        }

        .payment {
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .payment strong {
            color: #087f5b;
        }

        .empty {
            background: white;
            padding: 50px;
            border-radius: 15px;
            text-align: center;
            color: #64748b;
        }

        @media(max-width: 800px) {
            .info-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .header {
                gap: 15px;
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div>
            <h1>🕐 Riwayat Charging</h1>
            <p>
                Riwayat pengisian kendaraan dan pembayaran Anda.
            </p>
        </div>

        <a
            href="{{ route('user.dashboard') }}"
            class="back"
        >
            ← Kembali
        </a>

    </div>


    @forelse($sessions as $session)

        <div class="card">

            <div class="card-header">

                <h3>
                    ⚡ Sesi #{{ $session->id_session }}
                </h3>

                <span class="status {{ $session->status }}">
                    {{ ucfirst($session->status) }}
                </span>

            </div>


            <div class="info-grid">

                <div class="info">

                    <span class="label">
                        Kendaraan
                    </span>

                    <span class="value">

                        @if($session->vehicle)
                            {{ $session->vehicle->merek }}
                            {{ $session->vehicle->model }}
                        @else
                            -
                        @endif

                    </span>

                </div>


                <div class="info">

                    <span class="label">
                        Charger
                    </span>

                    <span class="value">

                        @if($session->charger)
                            {{ $session->charger->kode_perangkat }}
                        @else
                            -
                        @endif

                    </span>

                </div>


                <div class="info">

                    <span class="label">
                        Waktu Mulai
                    </span>

                    <span class="value">

                        {{ $session->waktu_mulai
                            ? $session->waktu_mulai->format('d-m-Y H:i')
                            : '-' }}

                    </span>

                </div>


                <div class="info">

                    <span class="label">
                        Waktu Selesai
                    </span>

                    <span class="value">

                        {{ $session->waktu_selesai
                            ? $session->waktu_selesai->format('d-m-Y H:i')
                            : '-' }}

                    </span>

                </div>


                <div class="info">

                    <span class="label">
                        Energi
                    </span>

                    <span class="value">
                        {{ number_format(
                            (float) $session->energi_kwh,
                            2,
                            ',',
                            '.'
                        ) }}
                        kWh
                    </span>

                </div>


                <div class="info">

                    <span class="label">
                        Durasi
                    </span>

                    <span class="value">
                        {{ $session->durasi_menit ?? 0 }} menit
                    </span>

                </div>

            </div>


            <div class="payment">

                <strong>
                    💳 Pembayaran:
                </strong>

                @if($session->payment)

                    {{ ucfirst($session->payment->status) }}

                    —
                    Rp {{ number_format(
                        (float) $session->payment->jumlah,
                        0,
                        ',',
                        '.'
                    ) }}

                @else

                    Belum ada pembayaran

                @endif

            </div>

        </div>

    @empty

        <div class="empty">

            <h3>🕐 Belum Ada Riwayat</h3>

            <p>
                Anda belum memiliki riwayat charging.
            </p>

        </div>

    @endforelse

</div>

</body>
</html>