<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Charger;
use App\Models\ChargingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class OperatorController extends Controller
{
    public function profile()
    {
        $operator = auth()->user();
        return view('operator.profile', compact('operator'));
    }

    public function updateProfile(Request $request)
    {
        $operator = auth()->user();

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $operator->id_user . ',id_user',
            'email' => 'required|email|max:100|unique:users,email,' . $operator->id_user . ',id_user',
            'nomor_telepon' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $operator->nama = $request->nama;
        $operator->username = $request->username;
        $operator->email = $request->email;
        $operator->nomor_telepon = $request->nomor_telepon;

        if ($request->filled('password')) {
            $operator->password = Hash::make($request->password);
        }

        $operator->save();

        return redirect()->route('operator.profile')->with('success', 'Profil operator berhasil diperbarui.');
    }

    public function stations()
    {
        $stations = Location::with('chargers')->orderBy('nama_lokasi')->paginate(10);
        return view('operator.stations', compact('stations'));
    }

    public function chargers()
    {
        $chargers = Charger::with('location')->orderBy('id_charger')->paginate(10);
        return view('operator.chargers', compact('chargers'));
    }

    // Fitur 48: monitoring status charger
    public function chargerStatus()
    {
        $chargers = Charger::with('location')->orderBy('id_charger')->paginate(10);
        $totals = Charger::selectRaw("
            SUM(status = 'tersedia') as tersedia,
            SUM(status = 'digunakan') as digunakan,
            SUM(status = 'offline') as offline,
            SUM(status = 'rusak') as rusak
        ")->first();

        $totalTersedia = (int) ($totals->tersedia ?? 0);
        $totalDigunakan = (int) ($totals->digunakan ?? 0);
        $totalOffline = (int) ($totals->offline ?? 0);
        $totalRusak = (int) ($totals->rusak ?? 0);

        $statusClass = [
            'tersedia' => 'status-available',
            'digunakan' => 'status-used',
            'offline' => 'status-offline',
            'rusak' => 'status-broken',
        ];

        return view('operator.charger-status', compact(
            'chargers', 'totalTersedia', 'totalDigunakan',
            'totalOffline', 'totalRusak', 'statusClass'
        ));
    }

    // Fitur 48: simpan status baru ke database
    public function updateChargerStatus(Request $request, Charger $charger)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['tersedia', 'digunakan', 'offline', 'rusak'])],
        ]);

        // Jangan izinkan operator menandai charger sedang digunakan
        // jika tidak ada sesi yang berlangsung.
        if ($validated['status'] === 'digunakan' &&
            !$charger->chargingSessions()->where('status', 'berlangsung')->exists()) {
            return back()->withErrors([
                'status' => 'Status "digunakan" hanya dapat dipilih jika ada sesi charging yang berlangsung.'
            ])->withInput();
        }

        $charger->update(['status' => $validated['status']]);

        return redirect()->route('operator.charger-status')
            ->with('success', 'Status charger ' . $charger->kode_perangkat . ' berhasil diperbarui.');
    }

    public function sessions()
    {
        $sessions = ChargingSession::with(['user', 'vehicle', 'charger.location'])
            ->orderByDesc('waktu_mulai')->paginate(10);
        return view('operator.sessions', compact('sessions'));
    }

    // Fitur 50: riwayat sesi yang sudah berakhir

    public function history()
    {
        $sessions = ChargingSession::with(['user', 'vehicle', 'charger.location'])
            ->whereIn('status', ['selesai', 'dibatalkan', 'gagal'])
            ->orderByDesc('waktu_mulai')
            ->paginate(15);

        return view('operator.history', compact('sessions'));
    }

    // Fitur 51: ringkasan pemakaian per charger
    public function report()
    {
        $summary = Charger::with('location')
            ->withCount('chargingSessions')
            ->withSum('chargingSessions as total_energi_kwh', 'energi_kwh')
            ->withSum('chargingSessions as total_biaya', 'total_biaya')
            ->withCount(['chargingSessions as sesi_selesai' => function ($query) {
                $query->where('status', 'selesai');
            }])
            ->orderBy('id_charger')
            ->paginate(15);

        $totalSesi = ChargingSession::count();
        $totalSesiSelesai = ChargingSession::where('status', 'selesai')->count();
        $totalEnergi = (float) ChargingSession::where('status', 'selesai')->sum('energi_kwh');
        $totalBiaya = (float) ChargingSession::where('status', 'selesai')->sum('total_biaya');

        return view('operator.report', compact(
            'summary', 'totalSesi', 'totalSesiSelesai', 'totalEnergi', 'totalBiaya'
        ));
    }
}
