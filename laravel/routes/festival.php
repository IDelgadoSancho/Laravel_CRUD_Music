<?php

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