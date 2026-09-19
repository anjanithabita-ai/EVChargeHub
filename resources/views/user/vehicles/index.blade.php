<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Kendaraan - EVChargeHub</title>

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
            max-width: 1000px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            color: #198754;
        }

        .button {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .add-button {
            background: #198754;
            color: white;
        }

        .back-button {
            background: #6c757d;
            color: white;
        }

        .success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.07);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #198754;
            color: white;
        }

        .edit {
            background: #ffc107;
            color: #212529;
        }

        .delete {
            background: #dc3545;
            color: white;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #777;
        }

        .actions {
            display: flex;
            gap: 7px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <h1>Kelola Data Kendaraan</h1>

        <a href="{{ route('vehicles.create') }}"
           class="button add-button">
            + Tambah Kendaraan
        </a>

    </div>


    @if (session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    <div class="card">

        @if ($vehicles->count() > 0)

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Merek</th>
                        <th>Model</th>
                        <th>Nomor Polisi</th>
                        <th>Tipe Konektor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($vehicles as $vehicle)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $vehicle->merek }}
                            </td>

                            <td>
                                {{ $vehicle->model }}
                            </td>

                            <td>
                                {{ $vehicle->nomor_polisi }}
                            </td>

                            <td>
                                {{ $vehicle->tipe_konektor }}
                            </td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="{{ route('vehicles.edit', $vehicle->id_vehicle) }}"
                                        class="button edit">
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('vehicles.destroy', $vehicle->id_vehicle) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="button delete">
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">

                <p>
                    Belum ada data kendaraan.
                </p>

                <br>

                <a href="{{ route('vehicles.create') }}"
                   class="button add-button">
                    Tambah Kendaraan
                </a>

            </div>

        @endif

    </div>

    <br>

    <a href="{{ route('user.dashboard') }}"
       class="button back-button">
        ← Kembali ke Dashboard
    </a>

</div>

</body>

</html>