<?php

namespace App\Http\Controllers;

use App\Models\Charger;
use App\Models\ChargingSession;
use App\Models\Tariff;
use Illuminate\Support\Facades\Auth;

class ChargingController extends Controller
{
    // ==========================================
    // 13. PILIH CHARGER
    // ==========================================

    public function create(Charger $charger)
    {
        if ($charger->status !== 'tersedia') {
            return back()->with(
                'error',
                'Charger tidak tersedia.'
            );
        }

        return view(
            'user.charging.create',
            compact('charger')
        );
    }


    // ==========================================
    // 14. MULAI SESI CHARGING
    // ==========================================

    public function start(Charger $charger)
    {
        if ($charger->status !== 'tersedia') {
            return back()->with(
                'error',
                'Charger tidak tersedia.'
            );
        }

        // Cari tarif aktif
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

        // Ambil kendaraan pertama milik user
        $vehicle = Auth::user()
            ->vehicles()
            ->first();

        if (!$vehicle) {
            return redirect()
                ->route('vehicles.create')
                ->with(
                    'error',
                    'Silakan tambahkan kendaraan terlebih dahulu.'
                );
        }

        // Buat sesi charging
        $session = ChargingSession::create([
            'id_user' => Auth::user()->id_user,
            'id_vehicle' => $vehicle->id_vehicle,
            'id_charger' => $charger->id_charger,
            'id_tariff' => $tariff->id_tariff,
            'waktu_mulai' => now(),
            'waktu_selesai' => null,
            'energi_kwh' => 0,
            'durasi_menit' => 0,
            'total_biaya' => 0,
            'status' => 'berlangsung',
        ]);

        // Ubah status charger
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


    // ==========================================
    // 15. MONITOR SESI CHARGING
    // ==========================================

    public function monitor(ChargingSession $session)
    {
        // Pastikan sesi milik user yang sedang login
        if (
            $session->id_user !==
            Auth::user()->id_user
        ) {
            abort(
                403,
                'Anda tidak memiliki akses ke sesi ini.'
            );
        }

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
    // 16. HENTIKAN SESI CHARGING
    // ==========================================

    public function stop(ChargingSession $session)
    {
        // Pastikan sesi milik user
        if (
            $session->id_user !==
            Auth::user()->id_user
        ) {
            abort(
                403,
                'Anda tidak memiliki akses ke sesi ini.'
            );
        }

        // Pastikan sesi masih berlangsung
        if ($session->status !== 'berlangsung') {
            return back()->with(
                'error',
                'Sesi charging sudah tidak berlangsung.'
            );
        }

        // Hitung waktu selesai
        $waktuSelesai = now();

        // Hitung durasi
        $durasiMenit = $session
            ->waktu_mulai
            ->diffInMinutes($waktuSelesai);

        // Untuk sementara energi dibuat berdasarkan
        // durasi dan daya charger
        $energiKwh =
            ($durasiMenit / 60)
            * $session->charger->daya_kw;

        // Hitung biaya
        $totalBiaya =
            $energiKwh
            * $session->tariff->harga_per_kwh;

        // Simpan hasil sesi
        $session->update([
            'waktu_selesai' => $waktuSelesai,
            'durasi_menit' => $durasiMenit,
            'energi_kwh' => round($energiKwh, 2),
            'total_biaya' => round($totalBiaya, 2),
            'status' => 'selesai',
        ]);

        // Charger kembali tersedia
        $session->charger->update([
            'status' => 'tersedia',
        ]);

        return redirect()
            ->route(
                'charging.monitor',
                $session->id_session
            )
            ->with(
                'success',
                'Sesi charging berhasil dihentikan.'
            );
    }


    // ==========================================
    // 17. BATALKAN SESI CHARGING
    // ==========================================

    public function cancel(ChargingSession $session)
    {
        // Pastikan sesi milik user
        if (
            $session->id_user !==
            Auth::user()->id_user
        ) {
            abort(
                403,
                'Anda tidak memiliki akses ke sesi ini.'
            );
        }

        // Hanya sesi berlangsung yang bisa dibatalkan
        if ($session->status !== 'berlangsung') {
            return back()->with(
                'error',
                'Sesi charging sudah tidak dapat dibatalkan.'
            );
        }

        // Ubah status sesi
        $session->update([
            'waktu_selesai' => now(),
            'status' => 'dibatalkan',
            'total_biaya' => 0,
        ]);

        // Charger kembali tersedia
        $session->charger->update([
            'status' => 'tersedia',
        ]);

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
}