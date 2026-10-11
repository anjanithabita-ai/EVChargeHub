<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TariffController extends Controller
{
    // Menampilkan daftar tarif
    public function index(Request $request)
    {
        $query = Tariff::with('location');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('location', function ($q) use ($search) {
                $q->where('nama_lokasi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tariffs = $query
            ->orderByDesc('berlaku_mulai')
            ->paginate(10)
            ->withQueryString();

        return view('admin.tariffs.index', compact('tariffs'));
    }

    // Form tambah tarif
    public function create()
    {
        $locations = Location::orderBy('nama_lokasi')->get();

        return view('admin.tariffs.create', compact('locations'));
    }

    // Simpan tarif baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_location' => 'required|exists:locations,id_location',
            'harga_per_kwh' => 'required|numeric|min:0',
            'biaya_minimum' => 'required|numeric|min:0',
            'biaya_parkir' => 'required|numeric|min:0',
            'berlaku_mulai' => 'required|date',
            'berlaku_selesai' => 'nullable|date|after_or_equal:berlaku_mulai',
            'status' => [
                'required',
                Rule::in(['aktif', 'nonaktif']),
            ],
        ]);

        Tariff::create($validated);

        return redirect()
            ->route('admin.tariffs.index')
            ->with('success', 'Tarif berhasil ditambahkan.');
    }

    // Form edit tarif
    public function edit($id)
    {
        $tariff = Tariff::findOrFail($id);
        $locations = Location::orderBy('nama_lokasi')->get();

        return view(
            'admin.tariffs.edit',
            compact('tariff', 'locations')
        );
    }

    // Simpan perubahan tarif
    public function update(Request $request, $id)
    {
        $tariff = Tariff::findOrFail($id);

        $validated = $request->validate([
            'id_location' => 'required|exists:locations,id_location',
            'harga_per_kwh' => 'required|numeric|min:0',
            'biaya_minimum' => 'required|numeric|min:0',
            'biaya_parkir' => 'required|numeric|min:0',
            'berlaku_mulai' => 'required|date',
            'berlaku_selesai' => 'nullable|date|after_or_equal:berlaku_mulai',
            'status' => [
                'required',
                Rule::in(['aktif', 'nonaktif']),
            ],
        ]);

        $tariff->update($validated);

        return redirect()
            ->route('admin.tariffs.index')
            ->with('success', 'Tarif berhasil diperbarui.');
    }
}
