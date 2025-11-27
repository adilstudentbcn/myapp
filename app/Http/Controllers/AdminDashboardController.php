<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
  public function index(Request $request)
  {
    $user = $request->user();

    // Top stats
    $totalUsers = User::count();
    $totalApplicants = User::where('role', 'applicant')->count();
    $totalEmployers = User::where('role', 'employer')->count();
    $totalAdmins = User::where('role', 'admin')->count();

    $totalJobs = Job::count();
    $featuredJobs = Job::where('featured', true)->count();

    $totalApplications = JobApplication::count();

    // Recent lists
    $recentEmployers = User::where('role', 'employer')
      ->latest()
      ->take(5)
      ->get();

    $recentJobs = Job::with('employer')
      ->latest()
      ->take(5)
      ->get();

    $recentApplications = JobApplication::with(['user', 'job.employer'])
      ->latest()
      ->take(7)
      ->get();

    return view('admin.dashboard', [
      'user' => $user,
      'totalUsers' => $totalUsers,
      'totalApplicants' => $totalApplicants,
      'totalEmployers' => $totalEmployers,
      'totalAdmins' => $totalAdmins,
      'totalJobs' => $totalJobs,
      'featuredJobs' => $featuredJobs,
      'totalApplications' => $totalApplications,
      'recentEmployers' => $recentEmployers,
      'recentJobs' => $recentJobs,
      'recentApplications' => $recentApplications,
    ]);
  }
}
