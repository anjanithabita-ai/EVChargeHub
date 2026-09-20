<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ChargingSession;

class Payment extends Model
{
    protected $table = 'payments';

    protected $primaryKey = 'id_payment';

    // Tabel payments hanya memiliki created_at,
    // tidak memiliki updated_at
    public $timestamps = false;

    protected $fillable = [
        'id_session',
        'metode',
        'jumlah',
        'status',
        'waktu_pembayaran',
        'referensi_gateway',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'waktu_pembayaran' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function session()
    {
        return $this->belongsTo(
            ChargingSession::class,
            'id_session',
            'id_session'
        );
    }
}