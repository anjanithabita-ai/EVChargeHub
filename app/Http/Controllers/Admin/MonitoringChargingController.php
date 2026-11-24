<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChargingSession;

class MonitoringChargingController extends Controller
{
    public function index()
    {
        // Sesi charging yang sedang berlangsung
        $activeSessions = ChargingSession::with([
            'user',
            'charger.location',
            'vehicle',
        ])
            ->where('status', 'berlangsung')
            ->orderBy('waktu_mulai', 'desc')
            ->get();

        // Menghitung durasi sesi yang sedang berjalan
        foreach ($activeSessions as $session) {
            $session->durasi_monitoring = $session->waktu_mulai
                ? (int) $session->waktu_mulai->diffInMinutes(now())
                : 0;
        }

        // Riwayat sesi terbaru
        $historySessions = ChargingSession::with([
            'user',
            'charger.location',
            'vehicle',
        ])
            ->whereIn('status', [
                'selesai',
                'dibatalkan',
                'gagal'
            ])
            ->orderBy('waktu_mulai', 'desc')
            ->paginate(10);

        // Ringkasan monitoring
        $totalSessions = ChargingSession::count();

        $totalActive = ChargingSession::where(
            'status',
            'berlangsung'
        )->count();

        $totalCompleted = ChargingSession::where(
            'status',
            'selesai'
        )->count();

        $totalFailed = ChargingSession::whereIn(
            'status',
            ['gagal', 'dibatalkan']
        )->count();

        return view('admin.monitoring.index', compact(
            'activeSessions',
            'historySessions',
            'totalSessions',
            'totalActive',
            'totalCompleted',
            'totalFailed'
        ));
    }
}