<?php

namespace App\Http\Controllers;

use App\Models\ChargingSession;
use App\Models\Payment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // =========================================================
    // 19. HALAMAN PILIH METODE PEMBAYARAN
    // =========================================================

    public function create(ChargingSession $session)
    {
        // Cek apakah session milik user yang login
        $this->checkSessionOwner($session);

        // Pembayaran hanya dapat dilakukan setelah charging selesai
        if ($session->status !== 'selesai') {
            return back()->with(
                'error',
                'Pembayaran hanya dapat dilakukan setelah charging selesai.'
            );
        }

        // Ambil payment yang sudah ada
        $session->load('payment');

        if ($session->payment) {

            // Jika pembayaran sudah berhasil
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

            // Jika gagal:
            // tetap tampilkan halaman pilih metode
            // dan payment akan digunakan kembali saat proses.
        }

        // Load data transaksi
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


    // =========================================================
    // 20. PROSES PEMBAYARAN
    // =========================================================

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

        // =====================================================
        // VALIDASI
        // =====================================================

        $validated = $request->validate([
            'metode' => [
                'required',
                'in:virtual_account,card,qr,saldo',
            ],

            'bank_va' => [
                'nullable',
                'required_if:metode,virtual_account',
                'in:bca,bni,bri,mandiri,cimb,permata,bsi,danamon',
            ],

            'card_type' => [
                'nullable',
                'required_if:metode,card',
                'in:visa,mastercard,debit',
            ],
        ]);

        // =====================================================
        // CEK PAYMENT YANG SUDAH ADA
        // =====================================================

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
        }

        // =====================================================
        // DATA BANK
        // =====================================================

        $bankNames = [
            'bca' => 'BCA',
            'bni' => 'BNI',
            'bri' => 'BRI',
            'mandiri' => 'Bank Mandiri',
            'cimb' => 'CIMB Niaga',
            'permata' => 'PermataBank',
            'bsi' => 'Bank Syariah Indonesia',
            'danamon' => 'Bank Danamon',
        ];

        $bankCodes = [
            'bca' => '014',
            'bni' => '009',
            'bri' => '002',
            'mandiri' => '008',
            'cimb' => '022',
            'permata' => '013',
            'bsi' => '451',
            'danamon' => '011',
        ];

        // =====================================================
        // REFERENSI PEMBAYARAN
        // =====================================================

        $referensi = 'SIM-' . strtoupper(
            substr(md5(uniqid()), 0, 13)
        );

        // =====================================================
        // JIKA VIRTUAL ACCOUNT
        // =====================================================

        if ($validated['metode'] === 'virtual_account') {

            $bank = $validated['bank_va'];

            $bankCode = $bankCodes[$bank];

            /*
             * Nomor VA simulasi:
             *
             * 8808 + kode bank + ID session 6 digit
             *
             * Contoh:
             * 8808 + 014 + 000054
             *
             * = 8808014000054
             */

            $nomorVA =
                '8808' .
                $bankCode .
                str_pad(
                    $session->id_session,
                    6,
                    '0',
                    STR_PAD_LEFT
                );

            /*
             * Nomor VA disimpan sementara
             * di referensi gateway.
             *
             * Contoh:
             *
             * VA|bca|BCA|8808014000054
             */

            $referensi =
                'VA|' .
                $bank .
                '|' .
                $bankNames[$bank] .
                '|' .
                $nomorVA;
        }

        // =====================================================
        // JIKA KARTU
        // =====================================================

        if ($validated['metode'] === 'card') {

            $referensi =
                'CARD|' .
                strtoupper($validated['card_type']) .
                '|' .
                'SIM-' .
                strtoupper(substr(md5(uniqid()), 0, 10));
        }

        // =====================================================
        // JIKA QRIS
        // =====================================================

        if ($validated['metode'] === 'qr') {

            $referensi =
                'QRIS|SIM-' .
                strtoupper(substr(md5(uniqid()), 0, 10));
        }

        // =====================================================
        // JIKA SALDO
        // =====================================================

        if ($validated['metode'] === 'saldo') {

            $referensi =
                'SALDO|SIM-' .
                strtoupper(substr(md5(uniqid()), 0, 10));
        }

        // =====================================================
        // PAYMENT
        // =====================================================

        /*
         * Jika sebelumnya ada payment dengan status gagal,
         * gunakan kembali payment tersebut.
         *
         * Ini penting karena id_session pada tabel payments
         * bersifat UNIQUE.
         */

        if ($session->payment) {

            $payment = $session->payment;

            $payment->update([
                'metode' => $validated['metode'],
                'jumlah' => $session->total_biaya,
                'status' => 'pending',
                'waktu_pembayaran' => null,
                'referensi_gateway' => $referensi,
            ]);

        } else {

            $payment = Payment::create([
                'id_session' => $session->id_session,
                'metode' => $validated['metode'],
                'jumlah' => $session->total_biaya,
                'status' => 'pending',
                'waktu_pembayaran' => null,
                'referensi_gateway' => $referensi,
            ]);
        }

        // =====================================================
        // KE HALAMAN MENUNGGU PEMBAYARAN
        // =====================================================

        return redirect()
            ->route(
                'payment.waiting',
                $payment->id_payment
            )
            ->with(
                'success',
                'Pembayaran berhasil dibuat. Silakan selesaikan pembayaran.'
            );
    }


    // =========================================================
    // 21. HALAMAN MENUNGGU PEMBAYARAN
    // =========================================================

    public function waiting(Payment $payment)
    {
        // Cek pemilik payment
        $this->checkPaymentOwner($payment);

        // =====================================================
        // JIKA BERHASIL
        // =====================================================

        if ($payment->status === 'berhasil') {
            return redirect()->route(
                'payment.invoice',
                $payment->id_payment
            );
        }

        // =====================================================
        // JIKA GAGAL
        // =====================================================

        if ($payment->status === 'gagal') {

            return redirect()
                ->route(
                    'payment.create',
                    $payment->id_session
                )
                ->with(
                    'error',
                    'Pembayaran gagal. Silakan pilih metode pembayaran kembali.'
                );
        }

        // =====================================================
        // CEK BATAS 15 MENIT
        // =====================================================

        if ($payment->created_at) {

            $batasWaktu = $payment->created_at
                ->copy()
                ->addMinutes(15);

            if (now()->greaterThanOrEqualTo($batasWaktu)) {

                $payment->update([
                    'status' => 'gagal',
                ]);

                // Buat notifikasi
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

        // =====================================================
        // LOAD DATA
        // =====================================================

        $payment->load([
            'session.charger',
            'session.vehicle',
            'session.tariff',
        ]);

        // =====================================================
        // AMBIL DATA VA DARI REFERENSI
        // =====================================================

        $vaBank = null;
        $vaBankName = null;
        $vaNumber = null;

        if (
            $payment->metode === 'virtual_account' &&
            str_starts_with(
                $payment->referensi_gateway ?? '',
                'VA|'
            )
        ) {

            $vaData = explode(
                '|',
                $payment->referensi_gateway
            );

            if (count($vaData) >= 4) {

                $vaBank = $vaData[1];

                $vaBankName = $vaData[2];

                $vaNumber = $vaData[3];
            }
        }

        // =====================================================
        // TAMPILKAN HALAMAN WAITING
        // =====================================================

        return view(
            'user.payment.waiting',
            compact(
                'payment',
                'vaBank',
                'vaBankName',
                'vaNumber'
            )
        );
    }


    // =========================================================
    // 22. SELESAIKAN PEMBAYARAN
    // =========================================================

    public function complete(Payment $payment)
    {
        // Cek pemilik
        $this->checkPaymentOwner($payment);

        // =====================================================
        // SUDAH BERHASIL
        // =====================================================

        if ($payment->status === 'berhasil') {

            return redirect()->route(
                'payment.invoice',
                $payment->id_payment
            );
        }

        // =====================================================
        // HARUS PENDING
        // =====================================================

        if ($payment->status !== 'pending') {

            return back()->with(
                'error',
                'Pembayaran tidak dapat diproses.'
            );
        }

        // =====================================================
        // CEK 15 MENIT
        // =====================================================

        if ($payment->created_at) {

            $waktuKadaluarsa = $payment->created_at
                ->copy()
                ->addMinutes(15);

            if (now()->greaterThanOrEqualTo($waktuKadaluarsa)) {

                $payment->update([
                    'status' => 'gagal',
                ]);

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

        // =====================================================
        // SIMULASI BERHASIL
        // =====================================================

        $payment->update([
            'status' => 'berhasil',
            'waktu_pembayaran' => now(),
        ]);

        // =====================================================
        // NOTIFIKASI BERHASIL
        // =====================================================

        $this->createNotification(
            $payment,
            'Pembayaran Berhasil',
            'Pembayaran untuk sesi charging #' .
            $payment->id_session .
            ' telah berhasil diproses.',
            'payment'
        );

        // =====================================================
        // KE INVOICE
        // =====================================================

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


    // =========================================================
    // SIMULASI PEMBAYARAN GAGAL
    // =========================================================

    public function fail(Payment $payment)
    {
        // Cek pemilik
        $this->checkPaymentOwner($payment);

        // Pembayaran harus pending
        if ($payment->status !== 'pending') {

            return back()->with(
                'error',
                'Pembayaran ini sudah tidak dapat diproses.'
            );
        }

        // Ubah status
        $payment->update([
            'status' => 'gagal',
        ]);

        // Buat notifikasi
        $this->createNotification(
            $payment,
            'Pembayaran Gagal',
            'Pembayaran untuk sesi charging #' .
            $payment->id_session .
            ' gagal diproses. Silakan coba metode pembayaran kembali.',
            'payment'
        );

        // Kembali ke halaman pembayaran
        return redirect()
            ->route(
                'payment.create',
                $payment->id_session
            )
            ->with(
                'error',
                'Pembayaran gagal. Silakan pilih metode pembayaran kembali.'
            );
    }


    // =========================================================
    // 23. CEK STATUS PEMBAYARAN
    // =========================================================

    public function status(Payment $payment)
    {
        // Cek pemilik
        $this->checkPaymentOwner($payment);

        // Berhasil
        if ($payment->status === 'berhasil') {

            return redirect()->route(
                'payment.invoice',
                $payment->id_payment
            );
        }

        // Pending
        if ($payment->status === 'pending') {

            return redirect()->route(
                'payment.waiting',
                $payment->id_payment
            );
        }

        // Gagal
        return redirect()
            ->route(
                'payment.create',
                $payment->id_session
            )
            ->with(
                'error',
                'Pembayaran gagal atau sudah kadaluarsa. Silakan pilih metode pembayaran kembali.'
            );
    }


    // =========================================================
    // 24. INVOICE / STRUK
    // =========================================================

    public function invoice(Payment $payment)
    {
        // Cek pemilik
        $this->checkPaymentOwner($payment);

        // Harus berhasil
        if ($payment->status !== 'berhasil') {

            return back()->with(
                'error',
                'Invoice hanya dapat dilihat setelah pembayaran berhasil.'
            );
        }

        // Load relasi
        $payment->load([
            'session.charger',
            'session.vehicle',
            'session.user',
            'session.tariff',
        ]);

        $session = $payment->session;

        return view(
            'user.payment.invoice',
            compact(
                'payment',
                'session'
            )
        );
    }


    // =========================================================
    // MEMBUAT NOTIFIKASI
    // =========================================================

    private function createNotification(
        Payment $payment,
        string $title,
        string $message,
        string $type = 'payment'
    ) {
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


    // =========================================================
    // CEK PEMILIK SESSION
    // =========================================================

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


    // =========================================================
    // CEK PEMILIK PAYMENT
    // =========================================================

    private function checkPaymentOwner(
        Payment $payment
    ) {
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