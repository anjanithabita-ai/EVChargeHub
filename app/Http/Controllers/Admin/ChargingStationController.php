<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChargingStationController extends Controller
{
    /**
     * Menampilkan daftar charging station.
     */
    public function index(Request $request)
    {
        $query = Location::with(['chargers', 'tariffs']);

        // Pencarian berdasarkan nama lokasi atau alamat
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_lokasi', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Filter status lokasi
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $stations = $query
            ->orderBy('nama_lokasi')
            ->paginate(9)
            ->withQueryString();

        return view('admin.stations.index', compact('stations'));
    }

    /**
     * Menampilkan formulir tambah station.
     */
    public function create()
    {
        return view('admin.stations.create');
    }

    /**
     * Menyimpan station baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lokasi' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'jam_buka' => ['required', 'date_format:H:i'],
            'jam_tutup' => ['required', 'date_format:H:i'],
            'fasilitas' => ['nullable', 'string'],
            'foto' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in([
                'aktif',
                'tutup',
                'maintenance',
            ])],
        ]);

        Location::create($validated);

        return redirect()
            ->route('admin.stations.index')
            ->with('success', 'Charging station berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail station beserta charger dan tarif.
     */
    public function show($id)
    {
        $station = Location::with([
            'chargers',
            'tariffs',
        ])->findOrFail($id);

        $tariff = $station->tariffs
            ->where('status', 'aktif')
            ->sortByDesc('berlaku_mulai')
            ->first();

        return view('admin.stations.show', compact(
            'station',
            'tariff'
        ));
    }

    /**
     * Menampilkan formulir edit station.
     */
    public function edit($id)
    {
        $station = Location::findOrFail($id);

        return view('admin.stations.edit', compact('station'));
    }

    /**
     * Memperbarui data station.
     */
    public function update(Request $request, $id)
    {
        $station = Location::findOrFail($id);

        $validated = $request->validate([
            'nama_lokasi' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'jam_buka' => ['required', 'date_format:H:i'],
            'jam_tutup' => ['required', 'date_format:H:i'],
            'fasilitas' => ['nullable', 'string'],
            'foto' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in([
                'aktif',
                'tutup',
                'maintenance',
            ])],
        ]);

        $station->update($validated);

        return redirect()
            ->route('admin.stations.index')
            ->with('success', 'Charging station berhasil diperbarui.');
    }
}
