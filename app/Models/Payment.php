<?php

namespace App\Models;
use App\Models\ChargingSession;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $primaryKey = 'id_payment';

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