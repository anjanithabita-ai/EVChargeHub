<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $primaryKey = 'id_location';

    public $timestamps = false;

    protected $fillable = [
        'nama_station',
        'alamat',
        'latitude',
        'longitude',
    ];

    public function chargers()
    {
        return $this->hasMany(
            Charger::class,
            'id_location',
            'id_location'
        );
    }

    public function reviews()
    {
        return $this->hasMany(
            StationReview::class,
            'id_station',
            'id_location'
        );
    }
}