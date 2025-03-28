<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // one to many festivales
    public function festivals()
    {
        return $this->hasMany(Festival::class);
    }

    public function concerts()
    {
        return $this->belongsToMany(Concert::class, 'concert_usuari')
            ->withPivot('entrades_comprades')
            ->withTimestamps();
    }

    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

    public function isOrganitzador()
    {
        return $this->rol === 'organitzador';
    }

    public function isUsuari()
    {
        return $this->rol === 'usuari';
    }

    public static function getOrganitzadors(){
        $users = User::where('rol', 'like', 'organitzador' )->get();
        return $users;
    }
}
