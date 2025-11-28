<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
  // List all jobs for the admin
  public function index(Request $request)
  {
    $jobs = Job::with('employer')
      ->latest()
      ->get();

    return view('admin.jobs.index', [
      'jobs' => $jobs,
    ]);
  }

  // Delete a job 
  public function destroy(Request $request, Job $job)
  {
    $job->delete();

    return redirect()
      ->route('admin.jobs.index')
      ->with('status', 'Job deleted.');
  }
}
