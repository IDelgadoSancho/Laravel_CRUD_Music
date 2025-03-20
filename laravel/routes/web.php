<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DefaultController;
use Illuminate\Support\Facades\Route;

if (!function_exists('redirectToHome')) {
    function redirectToHome()
    {
        return redirect()->intended(route('home', [], false));
    }
}

// Route::get('dashboard', function () {
//     return view('default.home');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [DefaultController::class, 'home'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/festivals_db.php';

