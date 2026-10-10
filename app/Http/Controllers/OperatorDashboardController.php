<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Charger;
use App\Models\ChargingSession;

class OperatorDashboardController extends Controller
{
    public function index()
    {
        // =========================
        // DATA STATION
        // =========================
        $totalStations = Location::count();

        // =========================
        // DATA CHARGER
        // =========================
        $totalChargers = Charger::count();

        $availableChargers = Charger::where('status', 'tersedia')->count();

        $usedChargers = Charger::where('status', 'digunakan')->count();

        $offlineChargers = Charger::where('status', 'offline')->count();

        $damagedChargers = Charger::where('status', 'rusak')->count();

        // =========================
        // DATA CHARGING SESSION
        // =========================
        $activeCharging = ChargingSession::where('status', 'berlangsung')
            ->count();

        $completedCharging = ChargingSession::where('status', 'selesai')
            ->count();

        // =========================
        // CHARGING YANG SEDANG BERLANGSUNG
        // =========================
        $activeSessions = ChargingSession::where('status', 'berlangsung')
            ->with([
                'user',
                'vehicle',
                'charger',
                'charger.location'
            ])
            ->latest('waktu_mulai')
            ->get();

        // =========================
        // STATUS CHARGER
        // =========================
        $chargers = Charger::with('location')
            ->orderBy('id_charger')
            ->get();

        return view('operator.dashboard', compact(
            'totalStations',
            'totalChargers',
            'availableChargers',
            'usedChargers',
            'offlineChargers',
            'damagedChargers',
            'activeCharging',
            'completedCharging',
            'activeSessions',
            'chargers'
        ));
    }
}