<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use App\Models\Charger;
use App\Models\ChargingSession;
use App\Models\Payment;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();

        $totalLocations = Location::count();

        $totalChargers = Charger::count();

        $totalSessions = ChargingSession::count();

        $totalPayments = Payment::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalLocations',
            'totalChargers',
            'totalSessions',
            'totalPayments'
        ));
    }
}