<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    protected $casts = [
        'data_inici' => 'datetime:Y-m-d',
        'data_fi' => 'datetime:Y-m-d',
    ];

    // relacion one to many
    public function concerts()
    {
        return $this->hasMany(Concert::class);
    }

    // relacion con organizador
    public function organitzador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getEntradesPerConcert()
    {
        return $this->concerts()->with([
            'users' => function ($query) {
                $query->withPivot('entrades_comprades');
            }
        ])->get();
    }

}
