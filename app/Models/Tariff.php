<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class Tariff extends Model
{
    protected $table = 'tariffs';

    protected $primaryKey = 'id_tariff';

    public $timestamps = false;

    protected $fillable = [
        'id_location',
        'harga_per_kwh',
        'biaya_minimum',
        'biaya_parkir',
        'berlaku_mulai',
        'berlaku_selesai',
        'status',
    ];

    protected $casts = [
        'harga_per_kwh' => 'decimal:2',
        'biaya_minimum' => 'decimal:2',
        'biaya_parkir' => 'decimal:2',
        'berlaku_mulai' => 'date',
        'berlaku_selesai' => 'date',
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