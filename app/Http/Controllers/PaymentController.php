<?php

namespace App\Http\Controllers;

use App\Models\ChargingSession;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // ==========================================
    // 19. PILIH METODE PEMBAYARAN
    // ==========================================

    public function create(ChargingSession $session)
    {
        // Cek apakah sesi milik user yang sedang login
        $this->checkSessionOwner($session);

        // Pembayaran hanya untuk charging yang sudah selesai
        if ($session->status !== 'selesai') {
            return back()->with(
                'error',
                'Pembayaran hanya dapat dilakukan setelah charging selesai.'
            );
        }

        // Cek apakah sudah pernah dibuat pembayaran
        if ($session->payment) {
            return redirect()->route(
                'payment.status',
                $session->payment->id_payment
            );
        }

        // Load data yang dibutuhkan
        $session->load([
            'charger',
            'vehicle',
            'tariff'
        ]);

        return view(
            'user.payment.create',
            compact('session')
        );
    }


    // ==========================================
    // 20. PROSES PEMBAYARAN
    // ==========================================

    public function process(
        Request $request,
        ChargingSession $session
    ) {
        // Cek kepemilikan sesi
        $this->checkSessionOwner($session);

        // Pastikan charging sudah selesai
        if ($session->status !== 'selesai') {
            return back()->with(
                'error',
                'Sesi charging belum selesai.'
            );
        }

        // Validasi metode pembayaran
        $validated = $request->validate([
            'metode' => [
                'required',
                'in:ewallet,card,qr,saldo'
            ],
        ]);

        // Cegah pembayaran ganda
        if ($session->payment) {
            return redirect()->route(
                'payment.status',
                $session->payment->id_payment
            );
        }

        // Buat pembayaran
        $payment = Payment::create([
            'id_session' => $session->id_session,
            'metode' => $validated['metode'],
            'jumlah' => $session->total_biaya,
            'status' => 'pending',
            'waktu_pembayaran' => null,
            'referensi_gateway' => 'SIM-' . strtoupper(uniqid()),
        ]);

        // Arahkan ke halaman verifikasi
        return redirect()
            ->route(
                'payment.verify',
                $payment->id_payment
            )
            ->with(
                'success',
                'Pembayaran berhasil dibuat dan menunggu verifikasi.'
            );
    }


    // ==========================================
    // 21. VERIFIKASI PEMBAYARAN
    // ==========================================

    public function verify(Payment $payment)
    {
        // Cek kepemilikan pembayaran
        $this->checkPaymentOwner($payment);

        // Jika bukan pending, langsung ke status
        if ($payment->status !== 'pending') {
            return redirect()->route(
                'payment.status',
                $payment->id_payment
            );
        }

        return view(
            'user.payment.verify',
            compact('payment')
        );
    }


    // ==========================================
    // KONFIRMASI PEMBAYARAN
    // ==========================================

    public function confirm(Payment $payment)
    {
        // Cek kepemilikan pembayaran
        $this->checkPaymentOwner($payment);

        // Hanya pembayaran pending yang bisa dikonfirmasi
        if ($payment->status !== 'pending') {
            return redirect()->route(
                'payment.status',
                $payment->id_payment
            );
        }

        // Simulasi pembayaran berhasil
        $payment->update([
            'status' => 'berhasil',
            'waktu_pembayaran' => now(),
        ]);

        return redirect()
            ->route(
                'payment.status',
                $payment->id_payment
            )
            ->with(
                'success',
                'Pembayaran berhasil diverifikasi.'
            );
    }


    // ==========================================
    // 22. LIHAT STATUS PEMBAYARAN
    // ==========================================

    public function status(Payment $payment)
    {
        // Cek kepemilikan pembayaran
        $this->checkPaymentOwner($payment);

        // Load relasi
        $payment->load([
            'session.charger',
            'session.vehicle',
            'session.user',
        ]);

        return view(
            'user.payment.status',
            compact('payment')
        );
    }


    // ==========================================
    // 23. GENERATE INVOICE / STRUK
    // ==========================================

    public function invoice(Payment $payment)
    {
        // Cek kepemilikan pembayaran
        $this->checkPaymentOwner($payment);

        // Invoice hanya untuk pembayaran berhasil
        if ($payment->status !== 'berhasil') {
            return back()->with(
                'error',
                'Invoice hanya dapat dibuat setelah pembayaran berhasil.'
            );
        }

        // Load data
        $payment->load([
            'session.charger',
            'session.vehicle',
            'session.user',
        ]);

        return view(
            'user.payment.invoice',
            compact('payment')
        );
    }


    // ==========================================
    // CEK PEMILIK SESSION
    // ==========================================

    private function checkSessionOwner(
        ChargingSession $session
    ) {
        if (
            $session->id_user !==
            Auth::user()->id_user
        ) {
            abort(
                403,
                'Anda tidak memiliki akses ke sesi ini.'
            );
        }
    }


    // ==========================================
    // CEK PEMILIK PAYMENT
    // ==========================================

    private function checkPaymentOwner(
        Payment $payment
    ) {
        // Load session jika belum ada
        $payment->loadMissing('session');

        if (
            $payment->session->id_user !==
            Auth::user()->id_user
        ) {
            abort(
                403,
                'Anda tidak memiliki akses ke pembayaran ini.'
            );
        }
    }
}