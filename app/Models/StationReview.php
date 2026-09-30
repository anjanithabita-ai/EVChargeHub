<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StationReview extends Model
{
    protected $table = 'station_reviews';

    protected $primaryKey = 'id_review';

    protected $fillable = [
        'id_station',
        'id_user',
        'rating',
        'ulasan',
    ];

    public function station()
    {
        return $this->belongsTo(
            Location::class,
            'id_station',
            'id_location'
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
}