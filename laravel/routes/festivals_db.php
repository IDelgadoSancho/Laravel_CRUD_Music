<?php

use App\Http\Controllers\ConcertController;
use App\Http\Controllers\ArtistaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\ProfileController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DefaultController::class, 'home'])->name('home');

//// festivals

Route::get('/festival/list', [FestivalController::class, 'list'])->name('festival_list');

Route::match(['get', 'post'], '/festival/new', [FestivalController::class, 'new'])->name('festival_new');

Route::match(['get', 'post'], '/festival/edit/{id}', [FestivalController::class, 'edit'])->name('festival_edit');

Route::get('/festival/delete/{id}', [FestivalController::class, 'delete'])->name('festival_delete');

//// concerts

Route::get('/concert/list', [ConcertController::class, 'list'])->name('concert_list');

Route::match(['get', 'post'], '/concert/new', [ConcertController::class, 'new'])->name('concert_new');

Route::match(['get', 'post'], '/concert/edit/{id}', [ConcertController::class, 'edit'])->name('concert_edit');

Route::get('/concert/delete/{id}', [ConcertController::class, 'delete'])->name('concert_delete');

//// artistas

Route::get('/artista/list', [ArtistaController::class, 'list'])->name('artista_list');

Route::match(['get', 'post'], '/artista/new', [ArtistaController::class, 'new'])->name('artista_new');

Route::match(['get', 'post'], '/artista/edit/{id}', [ArtistaController::class, 'edit'])->name('artista_edit');

Route::get('/artista/delete/{id}', [ArtistaController::class, 'delete'])->name('artista_delete');

//// cercar

Route::get('/concert_cerca', [ConcertController::class, 'concert_cerca'])->name('concert_cerca_artista');

Route::get('/artista_cerca', [ArtistaController::class, 'artista_cerca'])->name('artista_cerca_genere');

//// filtre

Route::get('/concert_filtra_data', [ConcertController::class, 'concer_filtre_data'])->name('concert_filtra_data');

Route::get('/concert_filtra_aforament', [ConcertController::class, 'concer_filtre_aforament'])->name('concert_filtra_aforament');

Route::get('/concert_filtra_entrades', [ConcertController::class, 'concer_filtre_entrades'])->name('concert_filtra_entrades');

//// comprar entrades

Route::post('/concert/{id}/comprar', [ConcertController::class, 'comprarEntrades'])->name('concerts_comprar');

//// users

Route::get('/user/list', [ProfileController::class, 'list'])->name('user_list');
