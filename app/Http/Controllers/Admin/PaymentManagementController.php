<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentManagementController extends Controller
{
    /**
     * Menampilkan seluruh pembayaran dan menandai
     * transaksi tambahan yang terindikasi pembayaran ganda.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filterStatus = $request->input('status');

        // Pembayaran utama adalah transaksi berhasil/refund
        // dengan ID paling awal pada sesi yang sama.
        // Transaksi berhasil berikutnya dianggap indikasi pembayaran ganda.
        $duplicateCondition = function ($query) {
            $query->select(DB::raw(1))
                ->from('payments as p2')
                ->whereColumn('p2.id_session', 'p.id_session')
                ->whereColumn('p2.id_payment', '<', 'p.id_payment')
                ->whereIn('p2.status', ['berhasil', 'refund']);
        };

        $paymentsQuery = DB::table('payments as p')
            ->leftJoin('charging_sessions as cs', 'p.id_session', '=', 'cs.id_session')
            ->leftJoin('users as u', 'cs.id_user', '=', 'u.id_user')
            ->select(
                'p.id_payment',
                'p.id_session',
                'p.metode',
                'p.jumlah',
                'p.status',
                'p.waktu_pembayaran',
                'p.referensi_gateway',
                'p.created_at',
                'u.nama as nama_user',
                'u.email as email_user'
            )
            ->selectRaw(
                'CASE WHEN EXISTS (
                    SELECT 1
                    FROM payments p2
                    WHERE p2.id_session = p.id_session
                    AND p2.id_payment < p.id_payment
                    AND p2.status IN (?, ?)
                ) THEN 1 ELSE 0 END AS indikasi_duplikat',
                ['berhasil', 'refund']
            );

        // Pencarian transaksi.
        if ($search) {
            $paymentsQuery->where(function ($query) use ($search) {
                $query->where('p.id_payment', 'like', "%{$search}%")
                    ->orWhere('p.referensi_gateway', 'like', "%{$search}%")
                    ->orWhere('u.nama', 'like', "%{$search}%")
                    ->orWhere('u.email', 'like', "%{$search}%");
            });
        }

        // Filter status.
        if ($filterStatus) {
            $paymentsQuery->where('p.status', $filterStatus);
        }

        // Urutkan transaksi terbaru.
        $payments = $paymentsQuery
            ->orderByDesc('p.id_payment')
            ->paginate(10)
            ->withQueryString();

        // Total nominal pembayaran yang berhasil.
        $totalNominal = DB::table('payments')
            ->where('status', 'berhasil')
            ->sum('jumlah');

        // Jumlah seluruh transaksi.
        $totalTransaksi = DB::table('payments')->count();

        // Jumlah transaksi tambahan yang masih berhasil.
        $totalPerluPemeriksaan = DB::table('payments as p')
            ->where('p.status', 'berhasil')
            ->whereExists($duplicateCondition)
            ->count();

        // Jumlah transaksi yang sudah direfund.
        $totalRefund = DB::table('payments')
            ->where('status', 'refund')
            ->count();

        // Total nominal yang sudah direfund.
        $nominalRefund = DB::table('payments')
            ->where('status', 'refund')
            ->sum('jumlah');

        return view('admin.payments.index', compact(
            'payments',
            'search',
            'filterStatus',
            'totalNominal',
            'totalTransaksi',
            'totalPerluPemeriksaan',
            'totalRefund',
            'nominalRefund'
        ));
    }

    /**
     * Memproses refund hanya untuk transaksi tambahan.
     */
    public function refund(Request $request, $id)
    {
        $request->validate([
            'konfirmasi' => 'required|accepted'
        ]);

        $hasil = DB::transaction(function () use ($id) {

            $payment = DB::table('payments')
                ->where('id_payment', $id)
                ->lockForUpdate()
                ->first();

            if (!$payment) {
                return 'not_found';
            }

            // Transaksi harus masih berstatus berhasil.
            if ($payment->status !== 'berhasil') {
                return 'invalid_status';
            }

            // Pastikan ada pembayaran berhasil/refund
            // dengan ID lebih awal pada sesi yang sama.
            $isDuplicate = DB::table('payments as p2')
                ->where('p2.id_session', $payment->id_session)
                ->where('p2.id_payment', '<', $payment->id_payment)
                ->whereIn('p2.status', ['berhasil', 'refund'])
                ->exists();

            // Pembayaran utama tidak boleh direfund.
            if (!$isDuplicate) {
                return 'not_duplicate';
            }

            // Ubah status transaksi tambahan menjadi refund.
            // Tidak menggunakan updated_at karena kolom tersebut
            // tidak tersedia pada tabel payments.
            DB::table('payments')
                ->where('id_payment', $id)
                ->update([
                    'status' => 'refund'
                ]);

            return 'success';
        });

        if ($hasil === 'not_found') {
            return back()->with('error', 'Transaksi pembayaran tidak ditemukan.');
        }

        if ($hasil === 'invalid_status') {
            return back()->with('error', 'Transaksi ini tidak dapat direfund karena statusnya bukan berhasil.');
        }

        if ($hasil === 'not_duplicate') {
            return back()->with('error', 'Refund ditolak. Transaksi ini bukan pembayaran tambahan atau duplikat.');
        }

        if ($hasil === 'success') {
            return back()->with('success', 'Status transaksi pembayaran ganda berhasil diubah menjadi refund.');
        }

        return back()->with('error', 'Refund gagal diproses.');
    }
}
