<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Menampilkan halaman notifikasi.
     */
    public function index()
    {
        $user = auth()->user();

        $notifications = Notification::where('user_id', $user->id_user)
            ->latest()
            ->get();

        $unreadCount = Notification::where('user_id', $user->id_user)
            ->where('is_read', false)
            ->count();

        return view('user.notifications.index', compact(
            'notifications',
            'unreadCount'
        ));
    }

    /**
     * Menandai semua notifikasi sebagai sudah dibaca.
     */
    public function markAsRead()
    {
        Notification::where('user_id', auth()->user()->id_user)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi telah dibaca.',
        ]);
    }

    /**
     * Menandai satu notifikasi sebagai sudah dibaca.
     */
    public function read(Notification $notification)
    {
        if ($notification->user_id != auth()->user()->id_user) {
            abort(403);
        }

        $notification->update([
            'is_read' => true,
        ]);

        return back();
    }
}