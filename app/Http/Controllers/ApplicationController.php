<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
  public function store(Request $request, Job $job)
  {
    $user = $request->user();

    // Candidate shouldn't apply to own job (if they also are an employer)
    if ($job->employer && $job->employer->user_id === $user->id) {
      return back()->with('status', 'You cannot apply to your own job.');
    }

    $data = $request->validate([
      'message' => ['required', 'string', 'max:5000'],
      'cv_url' => ['nullable', 'url', 'max:255'],
    ]);

    // Prevent duplicate applications for same job
    $alreadyApplied = JobApplication::where('job_id', $job->id)
      ->where('user_id', $user->id)
      ->exists();

    if ($alreadyApplied) {
      return redirect()
        ->route('applications.index')
        ->with('status', 'You already applied to this job.');
    }

    JobApplication::create([
      'job_id' => $job->id,
      'user_id' => $user->id,
      'message' => $data['message'],
      'cv_url' => $data['cv_url'] ?? null,
    ]);

    return redirect()
      ->route('applications.index')
      ->with('status', 'Application sent successfully!');
  }

  public function index(Request $request)
  {
    $applications = JobApplication::with('job.employer')
      ->where('user_id', $request->user()->id)
      ->latest()
      ->get();

    return view('applications.index', [
      'applications' => $applications,
    ]);
  }
}
