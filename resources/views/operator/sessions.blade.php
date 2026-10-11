
@extends('operator.layout')

@section('content')
<div class="container">
    <h2>Monitoring Sesi Charging</h2>
    <p>Pantau sesi charging pengemudi yang tersimpan di sistem.</p>

    @if($sessions->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Sesi</th>
                        <th>Pengemudi</th>
                        <th>Kendaraan</th>
                        <th>Charger</th>
                        <th>Waktu Mulai</th>
                        <th>Durasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $session)
                        <tr>
                            <td>{{ $session->id_session }}</td>
                            <td>{{ $session->user->nama ?? '-' }}</td>
                            <td>
                                {{ $session->vehicle->merek ?? '-' }}
                                {{ $session->vehicle->model ?? '' }}
                            </td>
                            <td>{{ $session->charger->kode_perangkat ?? '-' }}</td>
                            <td>
                                {{ $session->waktu_mulai
                                    ? \Illuminate\Support\Carbon::parse($session->waktu_mulai)->format('d/m/Y H:i')
                                    : '-' }}
                            </td>
                            <td>{{ $session->durasi_menit ?? 0 }} menit</td>
                            <td>{{ ucfirst($session->status ?? 'belum diketahui') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $sessions->links() }}
    @else
        <p>Belum ada sesi charging.</p>
    @endif
</div>
@endsection