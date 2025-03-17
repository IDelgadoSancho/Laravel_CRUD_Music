<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{

    protected $casts = [
        'data_hora' => 'datetime:Y-m-d'
    ];

    // cada concierto pertenece a un festival
    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    // many to many artistas
    public function artistas()
    {
        return $this->belongsToMany(Artista::class)->withPivot('sou');
    }

}
