<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}