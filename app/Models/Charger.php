<?php

namespace App\Models;
use App\Models\Location;

use Illuminate\Database\Eloquent\Model;

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

    public function location()
    {
        return $this->belongsTo(
            Location::class,
            'id_location',
            'id_location'
        );
    }
}