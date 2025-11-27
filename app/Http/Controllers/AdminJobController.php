<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
  protected function ensureAdmin(Request $request): void
  {
    $user = $request->user();

    if (!$user || $user->role !== 'admin') {
      abort(403);
    }
  }

  public function index(Request $request)
  {
    $this->ensureAdmin($request);

    // Load all jobs with employer for display
    $jobs = Job::with('employer')
      ->orderBy('created_at', 'desc')
      ->get();

    return view('admin.jobs.index', [
      'jobs' => $jobs,
    ]);
  }

  public function destroy(Request $request, Job $job)
  {
    $this->ensureAdmin($request);

    $job->delete();

    return redirect()
      ->route('admin.jobs.index')
      ->with('status', 'Job deleted.');
  }
}
