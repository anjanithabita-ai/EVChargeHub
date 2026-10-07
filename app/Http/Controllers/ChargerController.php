<?php

namespace App\Http\Controllers;

use App\Models\Charger;
use App\Models\Location;
use Illuminate\Http\Request;

class ChargerController extends Controller
{
    /**
     * Menampilkan daftar charger untuk admin
     */
    public function index(Request $request)
    {
        $query = Charger::with('location');

        // Pencarian berdasarkan kode charger
        if ($request->filled('search')) {
            $query->where(
                'kode_perangkat',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Filter berdasarkan charging station
        if ($request->filled('location')) {
            $query->where(
                'id_location',
                $request->location
            );
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        $chargers = $query
            ->orderBy('id_charger', 'desc')
            ->get();

        $locations = Location::orderBy('nama_lokasi')->get();

        return view(
            'admin.chargers.index',
            compact(
                'chargers',
                'locations'
            )
        );
    }
}