<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Location;
use App\Models\Charger;
use App\Models\ChargingSession;

class OperatorController extends Controller
{
    // PROFIL OPERATOR
    public function profile()
    {
        $operator = auth()->user();

        return view('operator.profile', compact('operator'));
    }

    // UPDATE PROFIL OPERATOR
    public function updateProfile(Request $request)
    {
        $operator = auth()->user();

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,'
                . $operator->id_user . ',id_user',
            'email' => 'required|email|max:100|unique:users,email,'
                . $operator->id_user . ',id_user',
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

        return redirect()
            ->route('operator.profile')
            ->with('success', 'Profil operator berhasil diperbarui.');
    }

    // LIHAT CHARGING STATION
    public function stations()
    {
        $stations = Location::with('chargers')
            ->orderBy('nama_lokasi')
            ->paginate(10);

        return view('operator.stations', compact('stations'));
    }



    // LIHAT DATA CHARGER
    public function chargers()
    {
        $chargers = Charger::with('location')
            ->orderBy('id_charger')
            ->paginate(10);

        return view('operator.chargers', compact('chargers'));
    }

    // MONITOR STATUS CHARGER
    public function chargerStatus()
    {
        $chargers = Charger::with('location')
            ->orderBy('id_charger')
            ->paginate(10);

        return view('operator.charger-status', compact('chargers'));
    }

    // MONITOR SESI CHARGING
    public function sessions()
    {
        $sessions = ChargingSession::with([
            'user',
            'vehicle',
            'charger.location',
        ])
            ->orderByDesc('waktu_mulai')
            ->paginate(10);

        return view('operator.sessions', compact('sessions'));
    }
}
