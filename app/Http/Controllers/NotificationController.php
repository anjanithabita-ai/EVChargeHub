<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function markAsRead()
    {
        Notification::where('id_user', auth()->user()->id_user)
            ->where('is_read', false)
            ->update([
                'is_read' => true
            ]);

        return response()->json([
            'success' => true
        ]);
    }
}