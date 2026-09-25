<?php

namespace App\Http\Controllers;

use App\Models\ChargingSession;
use App\Models\Payment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // ==========================================
    // 19. PILIH METODE PEMBAYARAN
    // ==========================================

    public function create(ChargingSession $session)
    {
        // Cek apakah session milik user yang login
        $this->checkSessionOwner($session);

        // Pembayaran hanya bisa dilakukan setelah charging selesai
        if ($session->status !== 'selesai') {
            return back()->with(
                'error',
                'Pembayaran hanya dapat dilakukan setelah charging selesai.'
            );
        }

        // Cek apakah pembayaran sudah pernah dibuat
        $session->load('payment');

        if ($session->payment) {

            // Jika sudah berhasil
            if ($session->payment->status === 'berhasil') {
                return redirect()->route(
                    'payment.invoice',
                    $session->payment->id_payment
                );
            }

            // Jika masih pending
            if ($session->payment->status === 'pending') {
                return redirect()->route(
                    'payment.waiting',
                    $session->payment->id_payment
                );
            }

            // Jika gagal, user dapat membuat pembayaran baru
        }

        // Load data yang dibutuhkan halaman pembayaran
        $session->load([
            'charger',
            'vehicle',
            'tariff',
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
        // Cek kepemilikan session
        $this->checkSessionOwner($session);

        // Pastikan charging sudah selesai
        if ($session->status !== 'selesai') {
            return back()->with(
                'error',
                'Sesi charging belum selesai.'
            );
        }

        // ==========================================
        // VALIDASI
        // ==========================================

        $validated = $request->validate([

            'metode' => [
                'required',
                'in:ewallet,card,qr,saldo',
            ],

            // E-Wallet
            'ewallet' => [
                'nullable',
                'required_if:metode,ewallet',
                'in:gopay,ovo,dana,shopeepay',
            ],

            // Kartu
            'card_type' => [
                'nullable',
                'required_if:metode,card',
                'in:visa,mastercard,debit',
            ],
        ]);


        // ==========================================
        // CEK PEMBAYARAN YANG SUDAH ADA
        // ==========================================

        $session->load('payment');

        if ($session->payment) {

            // Jika sudah berhasil
            if ($session->payment->status === 'berhasil') {
                return redirect()->route(
                    'payment.invoice',
                    $session->payment->id_payment
                );
            }

            // Jika masih pending
            if ($session->payment->status === 'pending') {
                return redirect()->route(
                    'payment.waiting',
                    $session->payment->id_payment
                );
            }

            // Jika gagal, lanjut membuat pembayaran baru
        }


        // ==========================================
        // REFERENSI PEMBAYARAN
        // ==========================================

        $referensi = 'SIM-' . strtoupper(
            substr(md5(uniqid()), 0, 13)
        );


        // ==========================================
        // BUAT PAYMENT
        // ==========================================

        $payment = Payment::create([

            'id_session' => $session->id_session,

            'metode' => $validated['metode'],

            'jumlah' => $session->total_biaya,

            'status' => 'pending',

            'waktu_pembayaran' => null,

            'referensi_gateway' => $referensi,

        ]);


        // ==========================================
        // KE HALAMAN WAITING
        // ==========================================

        return redirect()
            ->route(
                'payment.waiting',
                $payment->id_payment
            )
            ->with(
                'success',
                'Pembayaran berhasil dibuat. Silakan selesaikan pembayaran dalam waktu 15 menit.'
            );
    }


    // ==========================================
    // 21. HALAMAN MENUNGGU PEMBAYARAN
    // ==========================================

    public function waiting(Payment $payment)
    {
        // Cek pemilik payment
        $this->checkPaymentOwner($payment);


        // ==========================================
        // JIKA SUDAH BERHASIL
        // ==========================================

        if ($payment->status === 'berhasil') {
            return redirect()->route(
                'payment.invoice',
                $payment->id_payment
            );
        }


        // ==========================================
        // JIKA SUDAH GAGAL
        // ==========================================

        if ($payment->status === 'gagal') {
            return redirect()
                ->route(
                    'payment.create',
                    $payment->id_session
                )
                ->with(
                    'error',
                    'Pembayaran sudah gagal. Silakan buat pembayaran kembali.'
                );
        }


        // ==========================================
        // CEK BATAS 15 MENIT
        // ==========================================

        if ($payment->created_at) {

            $batasWaktu = $payment->created_at
                ->copy()
                ->addMinutes(15);

            if (now()->greaterThanOrEqualTo($batasWaktu)) {

                // Ubah status pembayaran
                $payment->update([
                    'status' => 'gagal',
                ]);

                // Buat notifikasi pembayaran kadaluarsa
                $this->createNotification(
                    $payment,
                    'Pembayaran Kadaluarsa',
                    'Pembayaran untuk sesi charging #' .
                    $payment->id_session .
                    ' telah melewati batas waktu 15 menit dan dinyatakan gagal.',
                    'payment'
                );

                return redirect()
                    ->route(
                        'payment.create',
                        $payment->id_session
                    )
                    ->with(
                        'error',
                        'Waktu pembayaran 15 menit telah habis. Pembayaran dinyatakan gagal.'
                    );
            }
        }


        // ==========================================
        // LOAD DATA
        // ==========================================

        $payment->load([
            'session.charger',
            'session.vehicle',
            'session.tariff',
        ]);


        // ==========================================
        // TAMPILKAN WAITING
        // ==========================================

        return view(
            'user.payment.waiting',
            compact('payment')
        );
    }


    // ==========================================
    // 22. SELESAIKAN PEMBAYARAN
    // ==========================================

    public function complete(Payment $payment)
    {
        // Cek kepemilikan pembayaran
        $this->checkPaymentOwner($payment);


        // ==========================================
        // CEK STATUS
        // ==========================================

        if ($payment->status === 'berhasil') {
            return redirect()->route(
                'payment.invoice',
                $payment->id_payment
            );
        }


        if ($payment->status !== 'pending') {
            return back()->with(
                'error',
                'Pembayaran tidak dapat diproses.'
            );
        }


        // ==========================================
        // CEK BATAS WAKTU 15 MENIT
        // ==========================================

        if ($payment->created_at) {

            $waktuKadaluarsa = $payment->created_at
                ->copy()
                ->addMinutes(15);

            if (now()->greaterThanOrEqualTo($waktuKadaluarsa)) {

                $payment->update([
                    'status' => 'gagal',
                ]);

                // Buat notifikasi
                $this->createNotification(
                    $payment,
                    'Pembayaran Kadaluarsa',
                    'Pembayaran untuk sesi charging #' .
                    $payment->id_session .
                    ' telah melewati batas waktu 15 menit.',
                    'payment'
                );

                return redirect()
                    ->route(
                        'payment.create',
                        $payment->id_session
                    )
                    ->with(
                        'error',
                        'Waktu pembayaran sudah habis. Pembayaran dinyatakan gagal.'
                    );
            }
        }


        // ==========================================
        // SIMULASI PEMBAYARAN BERHASIL
        // ==========================================

        $payment->update([
            'status' => 'berhasil',
            'waktu_pembayaran' => now(),
        ]);


        // ==========================================
        // NOTIFIKASI PEMBAYARAN BERHASIL
        // ==========================================

        $this->createNotification(
            $payment,
            'Pembayaran Berhasil',
            'Pembayaran untuk sesi charging #' .
            $payment->id_session .
            ' telah berhasil diproses.',
            'payment'
        );


        // ==========================================
        // LANGSUNG KE INVOICE
        // ==========================================

        return redirect()
            ->route(
                'payment.invoice',
                $payment->id_payment
            )
            ->with(
                'success',
                'Pembayaran berhasil. Invoice telah dibuat.'
            );
    }


    // ==========================================
    // SIMULASI PEMBAYARAN GAGAL
    // ==========================================

    public function fail(Payment $payment)
    {
        // Cek kepemilikan pembayaran
        $this->checkPaymentOwner($payment);


        // ==========================================
        // PEMBAYARAN HARUS PENDING
        // ==========================================

        if ($payment->status !== 'pending') {

            return back()->with(
                'error',
                'Pembayaran ini sudah tidak dapat diproses.'
            );
        }


        // ==========================================
        // UBAH STATUS MENJADI GAGAL
        // ==========================================

        $payment->update([
            'status' => 'gagal',
        ]);


        // ==========================================
        // BUAT NOTIFIKASI GAGAL
        // ==========================================

        $this->createNotification(
        $payment,
        'Pembayaran Gagal',
        'Pembayaran untuk sesi charging #' .
        $payment->id_session .
        ' gagal diproses. Silakan coba metode pembayaran kembali.',
        'payment'
    );


        // ==========================================
        // KEMBALI KE HALAMAN NOTIFIKASI
        // ==========================================

        return redirect()
            ->route('notifications.index')
            ->with(
                'error',
                'Pembayaran gagal. Silakan cek notifikasi Anda.'
            );
    }


    // ==========================================
    // 23. CEK STATUS PEMBAYARAN
    // ==========================================

    public function status(Payment $payment)
    {
        // Cek pemilik payment
        $this->checkPaymentOwner($payment);


        // ==========================================
        // JIKA PEMBAYARAN BERHASIL
        // ==========================================

        if ($payment->status === 'berhasil') {

            return redirect()->route(
                'payment.invoice',
                $payment->id_payment
            );
        }


        // ==========================================
        // JIKA MASIH MENUNGGU
        // ==========================================

        if ($payment->status === 'pending') {

            return redirect()->route(
                'payment.waiting',
                $payment->id_payment
            );
        }


        // ==========================================
        // JIKA GAGAL
        // ==========================================

        return redirect()
            ->route(
                'payment.create',
                $payment->id_session
            )
            ->with(
                'error',
                'Pembayaran gagal atau sudah kadaluarsa. Silakan buat pembayaran kembali.'
            );
    }


    // ==========================================
    // 24. INVOICE / STRUK
    // ==========================================

    public function invoice(Payment $payment)
    {
        // Cek pemilik payment
        $this->checkPaymentOwner($payment);


        // ==========================================
        // HARUS SUDAH BERHASIL
        // ==========================================

        if ($payment->status !== 'berhasil') {

            return back()->with(
                'error',
                'Invoice hanya dapat dilihat setelah pembayaran berhasil.'
            );
        }


        // ==========================================
        // LOAD RELASI
        // ==========================================

        $payment->load([
            'session.charger',
            'session.vehicle',
            'session.user',
            'session.tariff',
        ]);


        // ==========================================
        // AMBIL SESSION
        // ==========================================

        $session = $payment->session;


        // ==========================================
        // TAMPILKAN INVOICE
        // ==========================================

        return view(
            'user.payment.invoice',
            compact(
                'payment',
                'session'
            )
        );
    }


    // ==========================================
    // MEMBUAT NOTIFIKASI
    // ==========================================

    private function createNotification(
        Payment $payment,
        string $title,
        string $message,
        string $type = 'payment'
    ) {
        // Ambil user dari charging session
        $payment->loadMissing('session');

        if (!$payment->session) {
            return;
        }

        Notification::create([
            'user_id' => $payment->session->id_user,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'is_read' => false,
        ]);
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
            !$payment->session ||
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