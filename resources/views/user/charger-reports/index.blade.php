<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Charger Saya - EVChargeHub</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7f7;
            color: #263b36;
        }

        .page {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 32px 50px;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: linear-gradient(135deg, #006b59, #00856f);
            color: #fff;
            padding: 25px 28px;
            border-radius: 16px;
            margin-bottom: 25px;
        }

        .hero h1 {
            font-size: 23px;
            margin-bottom: 8px;
        }

        .hero p {
            font-size: 13px;
            line-height: 1.6;
            opacity: .93;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 12px 16px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .btn-back {
            background: rgba(255, 255, 255, .15);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .35);
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, .25);
            color: #fff;
        }

        .btn-primary {
            background: #fff;
            color: #006b59;
        }

        .btn-primary:hover {
            background: #e8f5f1;
            color: #00453b;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e9e8;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .04);
            overflow: hidden;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 20px 22px;
            border-bottom: 1px solid #edf0ef;
        }

        .card-header h2 {
            font-size: 16px;
            color: #263b36;
        }

        .muted {
            font-size: 12px;
            color: #82908c;
        }

        .alert {
            margin: 18px;
            padding: 13px 15px;
            border-radius: 9px;
            background: #e8f7ef;
            color: #16865d;
            font-size: 13px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        thead th {
            text-align: left;
            background: #fafbfb;
            color: #7a8884;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: .4px;
            text-transform: uppercase;
            padding: 15px 18px;
            white-space: nowrap;
        }

        tbody td {
            padding: 16px 18px;
            border-top: 1px solid #edf0ef;
            font-size: 13px;
            color: #42514d;
            vertical-align: top;
        }

        tbody tr:hover {
            background: #fbfdfc;
        }

        td strong {
            color: #263b36;
        }

        .description {
            min-width: 190px;
            max-width: 300px;
            white-space: normal;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .operator-note {
            min-width: 170px;
            max-width: 250px;
            white-space: normal;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status-baru {
            background: #fff4df;
            color: #b77900;
        }

        .status-diproses {
            background: #e8f1ff;
            color: #245fba;
        }

        .status-selesai {
            background: #e8f7ef;
            color: #16865d;
        }

        .status-ditolak {
            background: #fdecec;
            color: #c43e3e;
        }

        .status-lainnya {
            background: #eef1f2;
            color: #66727a;
        }

        .empty {
            text-align: center;
            padding: 50px 20px;
            color: #82908c;
            font-size: 13px;
        }

        .empty-icon {
            font-size: 38px;
            margin-bottom: 12px;
        }

        .empty strong {
            display: block;
            color: #263b36;
            font-size: 15px;
            margin-bottom: 8px;
        }

        .empty p {
            line-height: 1.6;
        }

        .empty .btn {
            margin-top: 20px;
            background: #006b59;
            color: #fff;
        }

        .empty .btn:hover {
            background: #005747;
        }

        .pagination {
            padding: 16px 20px;
            border-top: 1px solid #edf0ef;
        }

        .pagination nav {
            display: flex;
            justify-content: flex-end;
        }

        .pagination nav div:first-child {
            font-size: 12px;
            color: #82908c;
        }

        .pagination a,
        .pagination span {
            color: #006b59;
        }

        @media (max-width: 750px) {
            .page {
                padding: 20px 14px 35px;
            }

            .hero {
                align-items: flex-start;
                flex-direction: column;
                padding: 22px;
            }

            .hero h1 {
                font-size: 21px;
            }

            .hero-actions {
                width: 100%;
            }

            .hero-actions .btn {
                flex: 1;
            }

            .card-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px;
            }
        }
    </style>
</head>

<body>
<div class="page">

    <header class="hero">
        <div>
            <h1>Laporan Charger Saya</h1>
            <p>
                Lihat laporan kerusakan charger yang sudah dikirim
                dan pantau tindak lanjut dari operator.
            </p>
        </div>

        <div class="hero-actions">
            {{-- Ganti route ini jika nama route halaman sebelumnya berbeda --}}
            <a href="{{ url()->previous() }}" class="btn btn-back">
                ← Kembali
            </a>

            <a href="{{ route('charger-reports.create') }}" class="btn btn-primary">
                ＋ Buat Laporan
            </a>
        </div>
    </header>

    <section class="card">
        <div class="card-header">
            <h2>Riwayat Laporan</h2>
            <span class="muted">
                {{ $reports->total() }} laporan tercatat
            </span>
        </div>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @if($reports->count())
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID Laporan</th>
                            <th>Charger / Lokasi</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Catatan Operator</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($reports as $report)
                        @php
                            $status = strtolower($report->status ?? '');

                            $statusClass = match ($status) {
                                'baru' => 'status-baru',
                                'diproses' => 'status-diproses',
                                'selesai' => 'status-selesai',
                                'ditolak' => 'status-ditolak',
                                default => 'status-lainnya',
                            };
                        @endphp

                        <tr>
                            <td>
                                <strong>#{{ $report->id_report }}</strong>
                            </td>

                            <td>
                                <strong>
                                    {{ $report->charger->kode_perangkat ?? 'Charger dihapus' }}
                                </strong>
                                <br>
                                <span class="muted">
                                    {{ $report->charger->location->nama_lokasi ?? '-' }}
                                </span>
                            </td>

                            <td>{{ $report->kategori ?? '-' }}</td>

                            <td class="description">
                                {{ $report->deskripsi ?? '-' }}
                            </td>

                            <td>
                                {{ $report->created_at?->format('d/m/Y H:i') ?? '-' }}
                            </td>

                            <td>
                                <span class="badge {{ $statusClass }}">
                                    {{ ucfirst($report->status ?? 'Belum diketahui') }}
                                </span>
                            </td>

                            <td class="operator-note">
                                {{ $report->catatan_operator ?: 'Belum ada catatan' }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $reports->links() }}
            </div>
        @else
            <div class="empty">
                <div class="empty-icon">🔌</div>

                <strong>Belum ada laporan charger</strong>

                <p>
                    Kamu belum mengirim laporan charger bermasalah.
                    <br>
                    Tekan tombol di bawah untuk membuat laporan pertama.
                </p>

                <a href="{{ route('charger-reports.create') }}" class="btn">
                    ＋ Buat Laporan Pertama
                </a>
            </div>
        @endif
    </section>

</div>
</body>
</html>
