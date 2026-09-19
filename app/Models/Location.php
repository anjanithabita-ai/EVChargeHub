<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $primaryKey = 'id_location';

    public $incrementing = true;

    protected $keyType = 'int';

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

    public function chargers()
    {
        return $this->hasMany(Charger::class, 'id_location', 'id_location');
    }
}