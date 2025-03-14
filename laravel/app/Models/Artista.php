<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    // many to many conciertos
    public function concerts()
{
    return $this->belongsToMany(Concert::class, 'artista_concert');
}

}
