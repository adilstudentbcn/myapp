<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployerProfileController;
use App\Http\Controllers\EmployerJobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminJobController;
use App\Http\Controllers\AdminTagController;

// Public pages
Route::get('/', [JobController::class, 'home'])->name('home');
Route::get('/jobs', [JobController::class, 'browse'])->name('jobs.browse');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

require __DIR__ . '/auth.php';

// Default Breeze dashboard – we just redirect to home
Route::get('/dashboard', function () {
  return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// -----------------------------
// Authenticated (applicant + employer) area
// -----------------------------
Route::middleware('auth')->group(function () {

  // Employer profile
  Route::get('/employer/profile', [EmployerProfileController::class, 'edit'])
    ->name('employer.profile.edit');
  Route::post('/employer/profile', [EmployerProfileController::class, 'update'])
    ->name('employer.profile.update');

  // Employer job management
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

  // Employer views applications for a specific job
  Route::get(
    '/employer/jobs/{job}/applications',
    [EmployerJobController::class, 'applications']
  )->name('employer.jobs.applications');

  // Candidate applies to a job
  Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
    ->name('jobs.apply');

  // Candidate: My applications
  Route::get('/applications', [ApplicationController::class, 'index'])
    ->name('applications.index');
});

// -----------------------------
// ADMIN AREA (auth + admin middleware)
// -----------------------------
Route::middleware(['auth', 'admin'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {

    // Admin dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
      ->name('dashboard');

    // Admin — manage users
    Route::get('/users', [AdminUserController::class, 'index'])
      ->name('users.index');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
      ->name('users.destroy');

    // Admin — manage jobs
    Route::get('/jobs', [AdminJobController::class, 'index'])
      ->name('jobs.index');
    Route::delete('/jobs/{job}', [AdminJobController::class, 'destroy'])
      ->name('jobs.destroy');

    // Admin — manage tags
    Route::get('/tags', [AdminTagController::class, 'index'])
      ->name('tags.index');
    Route::post('/tags', [AdminTagController::class, 'store'])
      ->name('tags.store');
    Route::delete('/tags/{tag}', [AdminTagController::class, 'destroy'])
      ->name('tags.destroy');
  });
