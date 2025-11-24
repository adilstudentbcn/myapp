<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployerProfileController;
use App\Http\Controllers\EmployerJobController;


Route::get('/', [JobController::class, 'home'])->name('home');

Route::get('/jobs', [JobController::class, 'browse'])->name('jobs.browse');

Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
  return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
  Route::get('/employer/profile', [EmployerProfileController::class, 'edit'])
    ->name('employer.profile.edit');

  Route::post('/employer/profile', [EmployerProfileController::class, 'update'])
    ->name('employer.profile.update');

  Route::get('/employer/jobs/create', [EmployerJobController::class, 'create'])
    ->name('employer.jobs.create');

  Route::post('/employer/jobs', [EmployerJobController::class, 'store'])
    ->name('employer.jobs.store');

  Route::get('/employer/jobs', [EmployerJobController::class, 'index'])
    ->name('employer.jobs.index');

  Route::delete('/employer/jobs/{job}', [EmployerJobController::class, 'destroy'])
    ->name('employer.jobs.destroy');

  Route::get('/employer/jobs/{job}/edit', [EmployerJobController::class, 'edit'])
    ->name('employer.jobs.edit');

  Route::put('/employer/jobs/{job}', [EmployerJobController::class, 'update'])
    ->name('employer.jobs.update');

});



