<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\returnArgument;

class Artista extends Model
{
    // many to many conciertos
    public function concerts()
    {
        return $this->belongsToMany(Concert::class)->withPivot('sou');
    }

    static function cercaGenere($cadena)
    {
        $artistas = Artista::where('genere_musical', 'like', '%' . $cadena . '%')->get();
        return $artistas;
    }
}
