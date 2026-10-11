<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Charger;
use App\Models\StationReview;

class Location extends Model
{
    protected $table = 'locations';

    protected $primaryKey = 'id_location';

    protected $fillable = [
        'nama_lokasi',
        'alamat',
        'latitude',
        'longitude',
        'jam_buka',
        'jam_tutup',
        'fasilitas',
        'foto',
        'status',
    ];

    // Relasi: satu lokasi memiliki banyak charger
    public function chargers()
    {
        return $this->hasMany(
            Charger::class,
            'id_location',
            'id_location'
        );
    }

    // Relasi: satu lokasi memiliki banyak ulasan
    public function reviews()
    {
        return $this->hasMany(
            StationReview::class,
            'id_station',
            'id_location'
        );
    }
}
