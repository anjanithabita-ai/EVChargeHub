<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class ChargingSession extends Model
{
    protected $table = 'charging_sessions';

    protected $primaryKey = 'id_session';

    protected $fillable = [
        'id_user',
        'id_vehicle',
        'id_charger',
        'id_tariff',
        'waktu_mulai',
        'waktu_selesai',
        'energi_kwh',
        'durasi_menit',
        'total_biaya',
        'status',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
        'energi_kwh' => 'decimal:2',
        'total_biaya' => 'decimal:2',
    ];


    public function charger()
    {
        return $this->belongsTo(
            Charger::class,
            'id_charger',
            'id_charger'
        );
    }


    public function vehicle()
    {
        return $this->belongsTo(
            Vehicle::class,
            'id_vehicle',
            'id_vehicle'
        );
    }


    public function tariff()
    {
        return $this->belongsTo(
            Tariff::class,
            'id_tariff',
            'id_tariff'
        );
    }


    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }

    public function payment()
    {
        return $this->hasOne(
            Payment::class,
            'id_session',
            'id_session'
        );
    }

    
}