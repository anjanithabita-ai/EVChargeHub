<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // ==========================================
        // PERIODE LAPORAN
        // ==========================================

        $periode = $request->input('periode', now()->format('Y-m'));

        if (!preg_match('/^\d{4}-\d{2}$/', $periode)) {
            $periode = now()->format('Y-m');
        }

        try {
            $tanggalAwal = Carbon::createFromFormat('Y-m', $periode)
                ->startOfMonth();

            $tanggalAkhir = $tanggalAwal->copy()->endOfMonth();
        } catch (\Exception $e) {
            $periode = now()->format('Y-m');

            $tanggalAwal = now()->startOfMonth();
            $tanggalAkhir = now()->endOfMonth();
        }

        $tab = $request->input('tab', 'pendapatan');

        if (!in_array($tab, ['pendapatan', 'penggunaan', 'gangguan'])) {
            $tab = 'pendapatan';
        }


        // ==========================================
        // DAFTAR PILIHAN PERIODE
        // ==========================================

        $daftarPeriode = collect();

        for ($i = 0; $i < 12; $i++) {
            $tanggal = now()->subMonths($i);

            $daftarPeriode->push([
                'value' => $tanggal->format('Y-m'),
                'label' => $tanggal->translatedFormat('F Y'),
            ]);
        }


        // ==========================================
        // 1. LAPORAN PENDAPATAN
        // ==========================================

        $pembayaran = DB::table('payments')
            ->where('status', 'berhasil')
            ->whereBetween('waktu_pembayaran', [
                $tanggalAwal,
                $tanggalAkhir,
            ]);

        $totalPendapatan = (clone $pembayaran)->sum('jumlah');

        $totalTransaksi = (clone $pembayaran)->count();

        $rataRataTransaksi = $totalTransaksi > 0
            ? $totalPendapatan / $totalTransaksi
            : 0;


        // Grafik pendapatan harian

        $pendapatanHarian = DB::table('payments')
            ->selectRaw('DATE(waktu_pembayaran) as tanggal')
            ->selectRaw('SUM(jumlah) as total')
            ->where('status', 'berhasil')
            ->whereBetween('waktu_pembayaran', [
                $tanggalAwal,
                $tanggalAkhir,
            ])
            ->groupByRaw('DATE(waktu_pembayaran)')
            ->orderBy('tanggal')
            ->get()
            ->keyBy('tanggal');

        $labelGrafik = [];
        $dataGrafik = [];

        $jumlahHari = $tanggalAwal->daysInMonth;

        for ($hari = 1; $hari <= $jumlahHari; $hari++) {
            $tanggal = $tanggalAwal->copy()->day($hari);
            $key = $tanggal->format('Y-m-d');

            $labelGrafik[] = $tanggal->format('d');

            $dataGrafik[] = (float) (
                $pendapatanHarian[$key]->total ?? 0
            );
        }


        // ==========================================
        // 2. LAPORAN PENGGUNAAN CHARGER
        // ==========================================

        $penggunaanCharger = DB::table('charging_sessions as cs')
            ->leftJoin(
                'chargers as c',
                'cs.id_charger',
                '=',
                'c.id_charger'
            )
            ->leftJoin(
                'locations as l',
                'c.id_location',
                '=',
                'l.id_location'
            )
            ->select(
                'c.id_charger',
                'c.kode_perangkat',
                'c.tipe_konektor',
                'c.daya_kw',
                'l.nama_lokasi'
            )
            ->selectRaw('COUNT(cs.id_session) as total_sesi')
            ->selectRaw('COALESCE(SUM(cs.energi_kwh), 0) as total_kwh')
            ->selectRaw('COALESCE(SUM(cs.durasi_menit), 0) as total_durasi')
            ->where('cs.status', 'selesai')
            ->whereBetween('cs.waktu_mulai', [
                $tanggalAwal,
                $tanggalAkhir,
            ])
            ->groupBy(
                'c.id_charger',
                'c.kode_perangkat',
                'c.tipe_konektor',
                'c.daya_kw',
                'l.nama_lokasi'
            )
            ->orderByDesc('total_sesi')
            ->get();

        $totalSesiPenggunaan = $penggunaanCharger->sum('total_sesi');

        $totalKwh = $penggunaanCharger->sum('total_kwh');

        $totalDurasi = $penggunaanCharger->sum('total_durasi');

        $chargerTeratas = $penggunaanCharger->first();


        // ==========================================
        // 3. LAPORAN GANGGUAN CHARGER
        // ==========================================

        $gangguanCharger = DB::table('chargers as c')
            ->leftJoin(
                'locations as l',
                'c.id_location',
                '=',
                'l.id_location'
            )
            ->select(
                'c.id_charger',
                'c.kode_perangkat',
                'c.tipe_konektor',
                'c.status',
                'l.nama_lokasi'
            )
            ->whereRaw(
                "LOWER(c.status) IN (?, ?, ?)",
                ['offline', 'maintenance', 'error']
            )
            ->orderBy('c.kode_perangkat')
            ->get();


        // ==========================================
        // STATUS PENANGANAN
        // ==========================================

        foreach ($gangguanCharger as $gangguan) {

            $status = strtolower($gangguan->status);

            if ($status === 'maintenance') {
                $gangguan->status_penanganan = 'Dalam Perbaikan';
                $gangguan->warna_status = 'warning';
            } elseif ($status === 'offline') {
                $gangguan->status_penanganan = 'Perlu Ditangani';
                $gangguan->warna_status = 'danger';
            } else {
                $gangguan->status_penanganan = 'Perlu Diperiksa';
                $gangguan->warna_status = 'danger';
            }
        }


        // ==========================================
        // KIRIM DATA KE VIEW
        // ==========================================

        return view('admin.reports.index', compact(
            'tab',
            'periode',
            'daftarPeriode',
            'totalPendapatan',
            'totalTransaksi',
            'rataRataTransaksi',
            'labelGrafik',
            'dataGrafik',
            'penggunaanCharger',
            'totalSesiPenggunaan',
            'totalKwh',
            'totalDurasi',
            'chargerTeratas',
            'gangguanCharger'
        ));
    }
}