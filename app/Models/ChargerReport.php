<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargerReport extends Model
{
    protected $table = 'charger_reports';
    protected $primaryKey = 'id_report';

    public function getRouteKeyName(): string
    {
        return 'id_report';
    }

    protected $fillable = [
        'id_user',
        'id_charger',
        'kategori',
        'deskripsi',
        'status',
        'catatan_operator',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function charger()
    {
        return $this->belongsTo(Charger::class, 'id_charger', 'id_charger');
    }
}
