<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\ChargingSession;

class Charger extends Model
{
    protected $table = 'chargers';

    protected $primaryKey = 'id_charger';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'id_location',
        'kode_perangkat',
        'tipe_konektor',
        'daya_kw',
        'status',
    ];

    // Relasi: satu charger berada di satu lokasi
    public function location()
    {
        return $this->belongsTo(
            Location::class,
            'id_location',
            'id_location'
        );
    }

    // Relasi: satu charger dapat memiliki banyak sesi charging
    public function chargingSessions()
    {
        return $this->hasMany(
            ChargingSession::class,
            'id_charger',
            'id_charger'
        );
    }
}

