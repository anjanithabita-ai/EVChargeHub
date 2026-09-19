<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class StationController extends Controller
{
    // 7. Cari Charging Station
    // 10. Filter Charging Station
    public function index(Request $request)
    {
        $query = Location::with('chargers');

        // Pencarian berdasarkan nama atau alamat
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_lokasi', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%');
            });
        }

        // Filter status station
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tipe konektor
        if ($request->filled('tipe_konektor')) {

            $query->whereHas('chargers', function ($q) use ($request) {
                $q->where(
                    'tipe_konektor',
                    $request->tipe_konektor
                );
            });
        }

        $stations = $query
            ->orderBy('nama_lokasi')
            ->get();

        return view(
            'user.stations.index',
            compact('stations')
        );
    }


    // 8. Lihat Detail Charging Station
    // 9. Lihat Ketersediaan Charger
    // 11. Lihat Lokasi
    // 12. Navigasi
    public function show($id)
    {
        $station = Location::with('chargers')
            ->where('id_location', $id)
            ->firstOrFail();

        // Menghitung jumlah charger
        $totalCharger = $station->chargers->count();

        $chargerTersedia = $station->chargers
            ->where('status', 'tersedia')
            ->count();

        $chargerDigunakan = $station->chargers
            ->where('status', 'digunakan')
            ->count();

        $chargerOffline = $station->chargers
            ->where('status', 'offline')
            ->count();

        $chargerRusak = $station->chargers
            ->where('status', 'rusak')
            ->count();

        return view(
            'user.stations.show',
            compact(
                'station',
                'totalCharger',
                'chargerTersedia',
                'chargerDigunakan',
                'chargerOffline',
                'chargerRusak'
            )
        );
    }
}