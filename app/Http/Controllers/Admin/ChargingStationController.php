<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ChargingStationController extends Controller
{
    // Menampilkan daftar station
    public function index(Request $request)
    {
        $query = Location::withCount('chargers')
            ->with(['tariffs' => function ($q) {
                $q->where('status', 'aktif')
                    ->orderByDesc('berlaku_mulai');
            }]);

        // Pencarian nama dan alamat station
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('nama_lokasi', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Filter status station
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $locations = $query
            ->orderBy('nama_lokasi')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.charging-stations.index',
            compact('locations')
        );
    }

    // Form tambah station
    public function create()
    {
        return view('admin.charging-stations.create', [
            'location' => new Location(),
            'tariff' => new Tariff(),
        ]);
    }

    // Menyimpan station baru
    public function store(Request $request)
    {
        $validated = $this->validateStation($request);

        DB::transaction(function () use ($validated) {
            $location = Location::create(
                $validated['station']
            );

            if ($validated['tariff']['harga_per_kwh'] !== null) {
                Tariff::create([
                    'id_location' => $location->id_location,
                    'harga_per_kwh' =>
                        $validated['tariff']['harga_per_kwh'],
                    'biaya_minimum' =>
                        $validated['tariff']['biaya_minimum'],
                    'biaya_parkir' =>
                        $validated['tariff']['biaya_parkir'],
                    'berlaku_mulai' =>
                        $validated['tariff']['berlaku_mulai'],
                    'berlaku_selesai' =>
                        $validated['tariff']['berlaku_selesai'],
                    'status' => 'aktif',
                ]);
            }
        });

        return redirect()
            ->route('admin.charging-stations.index')
            ->with('success', 'Charging station berhasil ditambahkan.');
    }

    // Detail station dan semua charger di dalamnya
    public function show(Location $station)
    {
        $station->load([
            'chargers' => function ($q) {
                $q->orderBy('kode_perangkat');
            },
            'tariffs' => function ($q) {
                $q->orderByDesc('berlaku_mulai');
            },
        ]);

        $activeTariff = $station->tariffs
            ->first(function ($tariff) {
                return $tariff->status === 'aktif';
            });

        return view(
            'admin.charging-stations.show',
            compact('station', 'activeTariff')
        );
    }

    // Form edit station
    public function edit(Location $station)
    {
        $station->load([
            'tariffs' => function ($q) {
                $q->orderByDesc('berlaku_mulai');
            },
        ]);

        $tariff = $station->tariffs
            ->first(function ($item) {
                return $item->status === 'aktif';
            }) ?? new Tariff();

        return view(
            'admin.charging-stations.edit',
            compact('station', 'tariff')
        );
    }

    // Memperbarui station dan tarif
    public function update(Request $request, Location $station)
    {
        $validated = $this->validateStation($request);

        DB::transaction(function () use ($validated, $station) {
            $station->update($validated['station']);

            if ($validated['tariff']['harga_per_kwh'] !== null) {
                // Nonaktifkan tarif lama
                Tariff::where(
                    'id_location',
                    $station->id_location
                )
                    ->where('status', 'aktif')
                    ->update(['status' => 'nonaktif']);

                // Simpan tarif baru
                Tariff::create([
                    'id_location' => $station->id_location,
                    'harga_per_kwh' =>
                        $validated['tariff']['harga_per_kwh'],
                    'biaya_minimum' =>
                        $validated['tariff']['biaya_minimum'],
                    'biaya_parkir' =>
                        $validated['tariff']['biaya_parkir'],
                    'berlaku_mulai' =>
                        $validated['tariff']['berlaku_mulai'],
                    'berlaku_selesai' =>
                        $validated['tariff']['berlaku_selesai'],
                    'status' => 'aktif',
                ]);
            }
        });

        return redirect()
            ->route(
                'admin.charging-stations.show',
                $station->id_location
            )
            ->with('success', 'Data station berhasil diperbarui.');
    }

    // Validasi form station
    private function validateStation(Request $request): array
    {
        $data = $request->validate([
            'nama_lokasi' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string'],
            'latitude' => [
                'required', 'numeric', 'between:-90,90'
            ],
            'longitude' => [
                'required', 'numeric', 'between:-180,180'
            ],
            'jam_buka' => [
                'nullable', 'date_format:H:i'
            ],
            'jam_tutup' => [
                'nullable', 'date_format:H:i'
            ],
            'fasilitas' => ['nullable', 'string'],
            'foto' => ['nullable', 'string', 'max:255'],
            'status' => [
                'required',
                Rule::in(['aktif', 'tutup', 'maintenance']),
            ],
            'harga_per_kwh' => [
                'nullable', 'numeric', 'min:0'
            ],
            'biaya_minimum' => [
                'nullable', 'numeric', 'min:0'
            ],
            'biaya_parkir' => [
                'nullable', 'numeric', 'min:0'
            ],
            'berlaku_mulai' => [
                'required_with:harga_per_kwh',
                'nullable',
                'date',
            ],
            'berlaku_selesai' => [
                'nullable',
                'date',
                'after_or_equal:berlaku_mulai',
            ],
        ]);

        return [
            'station' => [
                'nama_lokasi' => $data['nama_lokasi'],
                'alamat' => $data['alamat'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'jam_buka' => $data['jam_buka'] ?? null,
                'jam_tutup' => $data['jam_tutup'] ?? null,
                'fasilitas' => $data['fasilitas'] ?? null,
                'foto' => $data['foto'] ?? null,
                'status' => $data['status'],
            ],
            'tariff' => [
                'harga_per_kwh' => $data['harga_per_kwh'] ?? null,
                'biaya_minimum' => $data['biaya_minimum'] ?? 0,
                'biaya_parkir' => $data['biaya_parkir'] ?? 0,
                'berlaku_mulai' => $data['berlaku_mulai'] ?? null,
                'berlaku_selesai' => $data['berlaku_selesai'] ?? null,
            ],
        ];
    }
}
