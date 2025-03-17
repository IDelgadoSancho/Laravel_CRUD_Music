<?php

use App\Http\Controllers\ConcertController;
use App\Http\Controllers\ArtistaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\DefaultController;

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