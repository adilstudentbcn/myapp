<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    // POST /jobs/{job}/apply
    public function store(Request $request, Job $job)
    {
        $user = $request->user();

        // Only applicant accounts can apply
        if (!$user || $user->role !== 'applicant') {
            return back()->with('status', 'Only applicant accounts can apply for jobs. Please create an applicant account.');
        }

        // prevent employers from applying to their own job
        if ($job->employer && $user->employer && $job->employer_id === $user->employer->id) {
            abort(403);
        }

        $data = $request->validate([
            'message' => ['nullable', 'string'],
            'cv_url' => ['nullable', 'url', 'max:255'],
        ]);

        // avoid duplicate applications (unique in DB too)
        if ($user->jobApplications()->where('job_id', $job->id)->exists()) {
            return back()->with('status', 'You already applied to this job.');
        }

        JobApplication::create([
            'user_id' => $user->id,
            'job_id' => $job->id,
            'message' => $data['message'] ?? null,
            'cv_url' => $data['cv_url'] ?? null,
        ]);

        return back()->with('status', 'Application sent!');
    }

    // GET /applications (candidate "My applications")
    public function index(Request $request)
    {
        $user = $request->user();

        $applications = $user->jobApplications()
            ->with('job.employer')
            ->latest()
            ->get();

        return view('applications.index', [
            'applications' => $applications,
        ]);
    }
}
