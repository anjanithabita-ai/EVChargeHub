<?php

namespace App\Http\Controllers;

use App\Models\ChargerReport;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OperatorChargerReportController extends Controller
{
    public function index()
    {
        $reports = ChargerReport::with(['user', 'charger.location'])
            ->latest()
            ->paginate(15);

        return view('operator.charger-reports', compact('reports'));
    }

    public function update(Request $request, ChargerReport $report)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['diproses', 'selesai', 'ditolak']),
            ],
            'catatan_operator' => ['nullable', 'string', 'max:2000'],
        ]);

        $report->update($validated);

        $statusLabel = [
            'diproses' => 'sedang diproses',
            'selesai' => 'telah diselesaikan',
            'ditolak' => 'ditolak',
        ][$validated['status']];

        Notification::create([
            'user_id' => $report->id_user,
            'title' => 'Pembaruan laporan charger',
            'message' => 'Status laporan #' . $report->id_report .
                ' ' . $statusLabel .
                ($validated['catatan_operator'] ? '. Catatan operator: ' . $validated['catatan_operator'] : '.'),
            'type' => 'system',
            'is_read' => false,
        ]);

        return redirect()
            ->route('operator.charger-reports.index')
            ->with('success', 'Status laporan berhasil diperbarui.');
    }
}
