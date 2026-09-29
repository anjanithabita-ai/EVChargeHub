<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index(Request $request)
    {
        $query = Location::with('chargers')
            ->orderBy('nama_lokasi', 'asc');

        // Pencarian nama/alamat
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_lokasi', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Filter status station
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter tipe konektor charger
        if ($request->filled('tipe_konektor')) {
            $tipeKonektor = $request->tipe_konektor;

            $query->whereHas('chargers', function ($q) use ($tipeKonektor) {
                $q->where('tipe_konektor', $tipeKonektor);
            });
        }

        $locations = $query->get();

        return view('user.stations.index', compact('locations'));
    }

    public function show($id_location)
    {
        $location = Location::with([
            'chargers',
            'reviews.user'
        ])->findOrFail($id_location);

        // Hitung jumlah charger
        $totalCharger = $location->chargers->count();

        // Charger tersedia
        $chargerTersedia = $location->chargers
            ->where('status', 'tersedia')
            ->count();

        // Charger sedang digunakan
        $chargerDigunakan = $location->chargers
            ->where('status', 'digunakan')
            ->count();

        // Charger offline
        $chargerOffline = $location->chargers
            ->where('status', 'offline')
            ->count();

        // Charger rusak
        $chargerRusak = $location->chargers
            ->where('status', 'rusak')
            ->count();

        return view('user.stations.show', compact(
            'location',
            'totalCharger',
            'chargerTersedia',
            'chargerDigunakan',
            'chargerOffline',
            'chargerRusak'
        ));
    }
}