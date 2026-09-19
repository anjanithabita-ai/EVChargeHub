<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $primaryKey = 'id_vehicle';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'merek',
        'model',
        'nomor_polisi',
        'tipe_konektor',
    ];
}