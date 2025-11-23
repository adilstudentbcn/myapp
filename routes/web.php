<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'home'])->name('home');

Route::get('/jobs', [JobController::class, 'browse'])->name('jobs.browse');

Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

require __DIR__ . '/auth.php';
