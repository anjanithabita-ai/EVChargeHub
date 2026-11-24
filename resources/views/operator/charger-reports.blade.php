<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Charger - Operator EVChargeHub</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7f7;
            color: #263b36;
        }

        .main {
            margin-left: 285px;
            padding: 30px 32px 50px;
        }

        .navigation {
            margin-bottom: 20px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 16px;
            background: #fff;
            color: #006b59;
            border: 1px solid #d9e2df;
            border-radius: 9px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            transition: .2s;
        }

        .back-btn:hover {
            background: #e8f7ef;
            border-color: #00856f;
        }

        .top {
            background: linear-gradient(135deg, #006b59, #00856f);
            padding: 25px 28px;
            border-radius: 16px;
            color: #fff;
            margin-bottom: 24px;
        }

        .top h1 {
            font-size: 22px;
            margin: 0 0 8px;
        }

        .top p {
            font-size: 13px;
            margin: 0;
            line-height: 1.5;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e9e8;
            border-radius: 14px;
            box-shadow: 0 3px 12px #00000008;
            overflow: hidden;
        }

        .card-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 20px 22px;
            border-bottom: 1px solid #edf0ef;
        }

        .card-head h2 {
            font-size: 16px;
            margin: 0;
        }

        .muted {
            font-size: 12px;
            color: #82908c;
        }

        .alert {
            padding: 12px 14px;
            margin: 16px;
            background: #e8f7ef;
            color: #16865d;
            border-radius: 9px;
            font-size: 13px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
        }

        th {
            text-align: left;
            background: #fafbfb;
            color: #7a8884;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .4px;
            padding: 14px;
        }

        td {
            padding: 15px 14px;
            border-top: 1px solid #edf0ef;
            font-size: 12px;
            color: #42514d;
            vertical-align: top;
        }

        td strong {
            color: #263b36;
        }

        .badge {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .baru {
            background: #fff4df;
            color: #b77900;
        }

        .diproses {
            background: #e8f1ff;
            color: #245fba;
        }

        .selesai {
            background: #e8f7ef;
            color: #16865d;
        }

        .ditolak {
            background: #fdecec;
            color: #c43e3e;
        }

        .update-form {
            min-width: 220px;
        }

        .update-form select,
        .update-form textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #d9e2df;
            border-radius: 7px;
            margin-bottom: 7px;
            font: 12px Arial, Helvetica, sans-serif;
        }

        .update-form textarea {
            min-height: 60px;
            resize: vertical;
        }

        .btn {
            padding: 9px 12px;
            background: #006b59;
            color: #fff;
            border: 0;
            border-radius: 7px;
            font-weight: bold;
            cursor: pointer;
            font-size: 12px;
        }

        .btn:hover {
            background: #005747;
        }

        .error {
            font-size: 11px;
            color: #c43e3e;
            margin-bottom: 10px;
        }

        .pagination {
            padding: 16px 20px;
            border-top: 1px solid #edf0ef;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #82908c;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .main {
                margin-left: 0;
                padding: 20px 12px;
            }
        }

        @media (max-width: 600px) {
            .top {
                padding: 21px;
            }

            .card-head {
                padding: 16px;
            }
        }
    </style>
</head>

<body>
<main class="main">

    <!-- Tombol kembali ke dashboard operator -->
    <nav class="navigation">
        <a href="{{ route('operator.dashboard') }}" class="back-btn">
            ← Kembali ke Dashboard 
        </a>
    </nav>

    <header class="top">
        <h1>Pelaporan Charger Bermasalah</h1>
        <p>
            Periksa laporan dari pengemudi dan perbarui status penanganannya.
        </p>
    </header>

    <section class="card">

        <div class="card-head">
            <h2>Daftar Laporan</h2>
            <span class="muted">
                {{ $reports->total() }} laporan
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
                        <th>ID / Tanggal</th>
                        <th>Pelapor</th>
                        <th>Charger / Lokasi</th>
                        <th>Masalah</th>
                        <th>Status</th>
                        <th>Tindak Lanjut</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>
                                <strong>#{{ $report->id_report }}</strong><br>
                                <span class="muted">
                                    {{ $report->created_at?->format('d/m/Y H:i') }}
                                </span>
                            </td>

                            <td>
                                <strong>
                                    {{ $report->user->nama ?? 'Pengguna dihapus' }}
                                </strong><br>
                                <span class="muted">
                                    {{ $report->user->email ?? '' }}
                                </span>
                            </td>

                            <td>
                                <strong>
                                    {{ $report->charger->kode_perangkat ?? 'Charger dihapus' }}
                                </strong><br>
                                <span class="muted">
                                    {{ $report->charger->location->nama_lokasi ?? '-' }}
                                </span>
                            </td>

                            <td style="min-width:190px">
                                <strong>{{ $report->kategori }}</strong><br>
                                {{ $report->deskripsi }}
                            </td>

                            <td>
                                @php
                                    $statusClass = in_array(
                                        $report->status,
                                        ['baru', 'diproses', 'selesai', 'ditolak']
                                    ) ? $report->status : 'baru';
                                @endphp

                                <span class="badge {{ $statusClass }}">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </td>

                            <td>
                                <form
                                    class="update-form"
                                    method="POST"
                                    action="{{ route('operator.charger-reports.update', $report->id_report) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <select name="status" required>
                                        <option value="baru"
                                            @selected($report->status === 'baru')>
                                            Baru
                                        </option>

                                        <option value="diproses"
                                            @selected($report->status === 'diproses')>
                                            Diproses
                                        </option>

                                        <option value="selesai"
                                            @selected($report->status === 'selesai')>
                                            Selesai
                                        </option>

                                        <option value="ditolak"
                                            @selected($report->status === 'ditolak')>
                                            Ditolak
                                        </option>
                                    </select>

                                    <textarea
                                        name="catatan_operator"
                                        maxlength="2000"
                                        placeholder="Catatan untuk pengguna (opsional)"
                                    >{{ old('catatan_operator', $report->catatan_operator) }}</textarea>

                                    @error('status')
                                        <div class="error">{{ $message }}</div>
                                    @enderror

                                    @error('catatan_operator')
                                        <div class="error">{{ $message }}</div>
                                    @enderror

                                    <button type="submit" class="btn">
                                        Simpan Perubahan
                                    </button>
                                </form>
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
                Belum ada laporan charger bermasalah.
            </div>
        @endif

    </section>
</main>
</body>
</html>
