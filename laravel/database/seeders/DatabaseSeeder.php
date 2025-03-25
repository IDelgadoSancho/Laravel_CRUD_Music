<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Festival;
use App\Models\Concert;
use App\Models\Artista;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'rol' => 'admin'
        ]);

        User::create([
            'name' => 'Organizador',
            'email' => 'organizador@organizador.com',
            'password' => '12345678',
            'rol' => 'organitzador'
        ]);

        User::create([
            'name' => 'Normal',
            'email' => 'usuario@usuario.com',
            'password' => '12345678',
            'rol' => 'usuari'
        ]);

        Festival::create([
            'nom' => 'Rock Fest',
            'ubicacio' => 'Barcelona',
            'data_inici' => '2025-07-10',
            'data_fi' => '2025-07-12',
            'cartell' => null,
            'user_id' => 2 // Organizador
        ]);

        Festival::create([
            'nom' => 'Jazz Nights',
            'ubicacio' => 'Madrid',
            'data_inici' => '2025-08-15',
            'data_fi' => '2025-08-17',
            'cartell' => null,
            'user_id' => 2 // Organizador
        ]);

        // Conciertos para Rock Fest
        Concert::create([
            'nom' => 'Metallica Live',
            'festival_id' => 1,
            'data_hora' => '2025-07-10 20:00:00',
            'aforament' => 5000,
            'entrades_disponibles' => 5000
        ]);

        Concert::create([
            'nom' => 'Iron Maiden Night',
            'festival_id' => 1,
            'data_hora' => '2025-07-11 21:00:00',
            'aforament' => 4500,
            'entrades_disponibles' => 4500
        ]);

        Concert::create([
            'nom' => 'AC/DC Thunder',
            'festival_id' => 1,
            'data_hora' => '2025-07-12 22:00:00',
            'aforament' => 6000,
            'entrades_disponibles' => 6000
        ]);

        // Conciertos para Jazz Nights
        Concert::create([
            'nom' => 'Smooth Jazz Evening',
            'festival_id' => 2,
            'data_hora' => '2025-08-15 19:00:00',
            'aforament' => 3000,
            'entrades_disponibles' => 3000
        ]);

        Concert::create([
            'nom' => 'Sax & Wine',
            'festival_id' => 2,
            'data_hora' => '2025-08-16 20:30:00',
            'aforament' => 3500,
            'entrades_disponibles' => 3500
        ]);

        Concert::create([
            'nom' => 'Blues Night',
            'festival_id' => 2,
            'data_hora' => '2025-08-17 21:00:00',
            'aforament' => 4000,
            'entrades_disponibles' => 4000
        ]);

        $metallica = Artista::create([
            'nom' => 'Metallica',
            'genere_musical' => 'Heavy Metal',
            'pais_origen' => 'EEUU',
            'foto_artista' => null
        ]);

        $ironMaiden = Artista::create([
            'nom' => 'Iron Maiden',
            'genere_musical' => 'Heavy Metal',
            'pais_origen' => 'Reino Unido',
            'foto_artista' => null
        ]);

        $acdc = Artista::create([
            'nom' => 'AC/DC',
            'genere_musical' => 'Rock',
            'pais_origen' => 'Australia',
            'foto_artista' => null
        ]);

        $jazzBand = Artista::create([
            'nom' => 'The Jazz Band',
            'genere_musical' => 'Jazz',
            'pais_origen' => 'Francia',
            'foto_artista' => null
        ]);

        $bluesKing = Artista::create([
            'nom' => 'Blues King',
            'genere_musical' => 'Blues',
            'pais_origen' => 'EEUU',
            'foto_artista' => null
        ]);

        // Asignar artistas a conciertos (ManyToMany)
        Concert::find(1)->artistas()->attach([$metallica->id => ['sou' => 100000]]);
        Concert::find(2)->artistas()->attach([$ironMaiden->id => ['sou' => 90000]]);
        Concert::find(3)->artistas()->attach([$acdc->id => ['sou' => 120000]]);
        Concert::find(4)->artistas()->attach([$jazzBand->id => ['sou' => 50000]]);
        Concert::find(5)->artistas()->attach([$jazzBand->id => ['sou' => 45000]]);
        Concert::find(6)->artistas()->attach([$bluesKing->id => ['sou' => 55000]]);

    }
}
