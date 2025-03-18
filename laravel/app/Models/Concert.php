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

    static function cercaArtista($cadena)
    {
        $concert = Concert::whereHas('artistas', function ($query) use ($cadena) {
            $query->where('nom', 'like', '%' . $cadena . '%');
        })->get();

        return $concert;
    }

    static function filtreData($order)
    {
        switch ($order) {
            case 'asc':
                return Concert::orderBy('data_hora', 'asc')->get();
            case 'des':
                return Concert::orderBy('data_hora', 'desc')->get();
            default:
                return Concert::all();
        }
    }

    static function filtreAforament($order)
    {
        switch ($order) {
            case 'asc':
                return Concert::orderBy('aforament', 'asc')->get();
            case 'des':
                return Concert::orderBy('aforament', 'desc')->get();
            default:
                return Concert::all();
        }
    }

    static function filtreEntrades($order)
    {
        switch ($order) {
            case 'asc':
                return Concert::orderBy('entrades_disponibles', 'asc')->get();
            case 'des':
                return Concert::orderBy('entrades_disponibles', 'desc')->get();
            default:
                return Concert::all();
        }
    }
}
