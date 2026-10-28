<?php

namespace App\Http\Controllers;

use App\Models\Charger;
use App\Models\ChargerReport;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChargerReportController extends Controller
{
    // Halaman daftar laporan milik pengguna yang sedang login.
    public function index()
    {
        $reports = ChargerReport::with('charger.location')
            ->where('id_user', auth()->user()->id_user)
            ->latest()
            ->paginate(10);

        return view('user.charger-reports.index', compact('reports'));
    }

    // Form untuk membuat laporan.
    public function create()
    {
        $chargers = Charger::with('location')
            ->orderBy('kode_perangkat')
            ->get();

        return view('user.charger-reports.create', compact('chargers'));
    }

    // Simpan laporan baru.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_charger' => [
                'required',
                Rule::exists('chargers', 'id_charger'),
            ],
            'kategori' => [
                'required',
                Rule::in([
                    'Tidak dapat digunakan',
                    'Kabel atau konektor rusak',
                    'Layar atau sistem error',
                    'Pengisian tidak berjalan',
                    'Kerusakan fisik',
                    'Masalah lainnya',
                ]),
            ],
            'deskripsi' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'id_charger.required' => 'Pilih charger yang bermasalah.',
            'kategori.required' => 'Pilih kategori masalah.',
            'deskripsi.required' => 'Jelaskan masalah yang ditemukan.',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter.',
        ]);

        $report = ChargerReport::create([
            'id_user' => auth()->user()->id_user,
            'id_charger' => $validated['id_charger'],
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'],
            'status' => 'baru',
        ]);

        // Beri notifikasi ke pengguna sebagai tanda laporan berhasil disimpan.
        Notification::create([
            'user_id' => auth()->user()->id_user,
            'title' => 'Laporan charger berhasil dikirim',
            'message' => 'Laporan #' . $report->id_report .
                ' berhasil dikirim dan menunggu pemeriksaan operator.',
            'type' => 'system',
            'is_read' => false,
        ]);

        return redirect()
            ->route('charger-reports.index')
            ->with('success', 'Laporan berhasil dikirim. Operator akan memeriksanya.');
    }
}
