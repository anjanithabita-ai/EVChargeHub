<?php

namespace App\Http\Controllers;

use App\Models\Charger;
use App\Models\ChargingSession;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChargingController extends Controller
{
    public function create(Charger $charger)
    {
        if ($charger->status !== 'tersedia') {
            return back()->with('error', 'Charger tidak tersedia.');
        }

        $vehicles = Auth::user()->vehicles;

        if ($vehicles->isEmpty()) {
            return redirect()
                ->route('vehicles.create')
                ->with('error', 'Silakan tambahkan kendaraan terlebih dahulu.');
        }

        return view('user.charging.create', compact(
            'charger',
            'vehicles'
        ));
    }

    public function start(Request $request, Charger $charger)
    {
        $validated = $request->validate([
            'id_vehicle' => ['required', 'integer'],
        ]);

        if ($charger->status !== 'tersedia') {
            return back()->with('error', 'Charger tidak tersedia.');
        }

        $vehicle = Auth::user()
            ->vehicles()
            ->where('id_vehicle', $validated['id_vehicle'])
            ->first();

        if (!$vehicle) {
            return back()->with(
                'error',
                'Kendaraan tidak ditemukan.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK TIPE KONEKTOR
        |--------------------------------------------------------------------------
        */

        if (
            strtolower(trim($vehicle->tipe_konektor))
            !==
            strtolower(trim($charger->tipe_konektor))
        ) {
            return back()->with(
                'error',
                'Tipe konektor kendaraan tidak sesuai dengan charger.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK TARIF
        |--------------------------------------------------------------------------
        */

        $tariff = Tariff::where(
                'id_location',
                $charger->id_location
            )
            ->where('status', 'aktif')
            ->first();

        if (!$tariff) {
            return back()->with(
                'error',
                'Tarif charging untuk station ini belum tersedia.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | BUAT SESI
        |--------------------------------------------------------------------------
        */

        $session = ChargingSession::create([
            'id_user' => Auth::user()->id_user,
            'id_vehicle' => $vehicle->id_vehicle,
            'id_charger' => $charger->id_charger,
            'id_tariff' => $tariff->id_tariff,
            'waktu_mulai' => now(),
            'energi_kwh' => 0,
            'durasi_menit' => 0,
            'total_biaya' => 0,
            'status' => 'berlangsung',
        ]);

        $charger->update([
            'status' => 'digunakan',
        ]);

        return redirect()
            ->route(
                'charging.monitor',
                $session->id_session
            )
            ->with(
                'success',
                'Sesi charging berhasil dimulai.'
            );
    }

    public function monitor(ChargingSession $session)
    {
        // Cek apakah sesi milik user yang sedang login
        if ($session->id_user !== Auth::user()->id_user) {
            abort(
                403,
                'Anda tidak memiliki akses ke sesi charging ini.'
            );
        }

        // Load data yang diperlukan
        $session->load([
            'charger',
            'vehicle',
            'tariff',
        ]);

        return view(
            'user.charging.monitor',
            compact('session')
        );
    }

    // ==========================================
// BATALKAN SESI CHARGING
// ==========================================

    public function cancel(ChargingSession $session)
    {
        // Cek apakah session milik user yang login
        if (
            $session->id_user !==
            Auth::user()->id_user
        ) {
            abort(
                403,
                'Anda tidak memiliki akses ke sesi ini.'
            );
        }


        // ==========================================
        // CEK STATUS SESSION
        // ==========================================

        if ($session->status !== 'berlangsung') {

            return back()->with(
                'error',
                'Sesi charging sudah tidak berlangsung.'
            );
        }


        // ==========================================
        // UBAH STATUS SESSION
        // ==========================================

        $session->update([
            'waktu_selesai' => now(),
            'status' => 'dibatalkan',
            'energi_kwh' => 0,
            'durasi_menit' => 0,
            'total_biaya' => 0,
        ]);


        // ==========================================
        // KEMBALIKAN CHARGER
        // ==========================================

        $session->load('charger');

        if ($session->charger) {

            $session->charger->update([
                'status' => 'tersedia',
            ]);
        }


        // ==========================================
        // KEMBALI KE MONITOR
        // ==========================================

        return redirect()
            ->route(
                'charging.monitor',
                $session->id_session
            )
            ->with(
                'success',
                'Sesi charging berhasil dibatalkan.'
            );
    }

    public function stop(ChargingSession $session)
    {
        // ==========================================
        // CEK KEPEMILIKAN SESSION
        // ==========================================

        if (
            $session->id_user !==
            Auth::user()->id_user
        ) {
            abort(
                403,
                'Anda tidak memiliki akses ke sesi ini.'
            );
        }


        // ==========================================
        // CEK STATUS
        // ==========================================

        if ($session->status !== 'berlangsung') {
            return back()->with(
                'error',
                'Sesi charging sudah tidak berlangsung.'
            );
        }


        // ==========================================
        // LOAD DATA
        // ==========================================

        $session->load([
            'charger',
            'tariff',
        ]);


        // ==========================================
        // WAKTU SELESAI
        // ==========================================

        $waktuSelesai = now();


        // ==========================================
        // HITUNG DURASI
        // ==========================================

        $elapsedSeconds = max(
            0,
            $session->waktu_mulai->diffInSeconds(
                $waktuSelesai
            )
        );


        $durasiMenit = max(
            1,
            (int) ceil($elapsedSeconds / 60)
        );


        // ==========================================
        // HITUNG ENERGI
        // ==========================================

        $dayaKw = (float) $session->charger->daya_kw;


        $energiKwh = (
            $dayaKw
            * $elapsedSeconds
            / 3600
        );


        // ==========================================
        // HITUNG BIAYA
        // ==========================================

        $hargaPerKwh = (float)
            $session->tariff->harga_per_kwh;


        $biayaEnergi =
            $energiKwh
            * $hargaPerKwh;


        $biayaParkir = (float)
            $session->tariff->biaya_parkir;


        $biayaMinimum = (float)
            $session->tariff->biaya_minimum;


        $totalBiaya = max(
            $biayaMinimum,
            $biayaEnergi + $biayaParkir
        );


        // ==========================================
        // SIMPAN HASIL
        // ==========================================

        $session->update([
            'waktu_selesai' => $waktuSelesai,

            // Simpan energi setelah perhitungan biaya
            'energi_kwh' => round($energiKwh, 2),

            'durasi_menit' => $durasiMenit,

            'total_biaya' => round(
                $totalBiaya,
                2
            ),

            'status' => 'selesai',
        ]);


        // ==========================================
        // CHARGER KEMBALI TERSEDIA
        // ==========================================

        $session->charger->update([
            'status' => 'tersedia',
        ]);


        // ==========================================
        // KEMBALI KE MONITOR
        // ==========================================

        return redirect()
            ->route(
                'charging.monitor',
                $session->id_session
            )
            ->with(
                'success',
                'Charging selesai. Silakan lanjut ke pembayaran.'
            );
    }

    public function history()
    {
        $sessions = ChargingSession::with([
            'charger',
            'vehicle',
            'tariff',
            'payment',
        ])
        ->where('id_user', Auth::user()->id_user)
        ->orderByDesc('waktu_mulai')
        ->get();

        return view(
            'user.charging.history',
            compact('sessions')
        );
    }
}