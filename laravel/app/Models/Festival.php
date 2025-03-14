<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
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
}
