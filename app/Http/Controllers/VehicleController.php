<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where(
            'id_user',
            auth()->user()->id_user
        )->get();

        return view('user.vehicles.index', compact('vehicles'));
    }


    public function create()
    {
        return view('user.vehicles.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'merek' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:50'],
            'nomor_polisi' => ['required', 'string', 'max:20'],
            'tipe_konektor' => ['required', 'string', 'max:30'],
        ]);

        Vehicle::create([
            'id_user' => auth()->user()->id_user,
            'merek' => $validated['merek'],
            'model' => $validated['model'],
            'nomor_polisi' => $validated['nomor_polisi'],
            'tipe_konektor' => $validated['tipe_konektor'],
        ]);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }


    public function edit(Vehicle $vehicle)
    {
        if ($vehicle->id_user !== auth()->user()->id_user) {
            abort(403);
        }

        return view('user.vehicles.edit', compact('vehicle'));
    }


    public function update(Request $request, Vehicle $vehicle)
    {
        if ($vehicle->id_user !== auth()->user()->id_user) {
            abort(403);
        }

        $validated = $request->validate([
            'merek' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:50'],
            'nomor_polisi' => ['required', 'string', 'max:20'],
            'tipe_konektor' => ['required', 'string', 'max:30'],
        ]);

        $vehicle->update($validated);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }


    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->id_user !== auth()->user()->id_user) {
            abort(403);
        }

        $vehicle->delete();

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Data kendaraan berhasil dihapus.');
    }
}