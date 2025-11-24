<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;

class EmployerJobController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user();

        // If user has no employer profile yet, send them to fill it
        if (!$user->employer) {
            return redirect()
                ->route('employer.profile.edit')
                ->with('status', 'Please create your employer profile before posting jobs.');
        }

        return view('employer.jobs.create', [
            'employer' => $user->employer,
            'tags' => Tag::all(),
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user->employer) {
            return redirect()
                ->route('employer.profile.edit')
                ->with('status', 'Please create your employer profile before posting jobs.');
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'salary' => ['required', 'string', 'max:255'], // "EUR 60k"
            'description' => ['required', 'string'],
            'apply_url' => ['nullable', 'url', 'max:255'],
            'featured' => ['nullable', 'boolean'],
            'tags' => ['array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

        $data['featured'] = $request->boolean('featured');

        // Create the job attached to this employer
        $job = $user->employer->jobs()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'location' => $data['location'],
            'salary' => $data['salary'],
            'url' => $data['apply_url'] ?? null,
            'featured' => $data['featured'],
        ]);

        // Attach selected tags
        $job->tags()->sync($data['tags'] ?? []);

        return redirect()
            ->route('jobs.show', $job)
            ->with('status', 'Job posted successfully!');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        // Make sure employer profile exists
        $employer = $user->employer;

        if (!$employer) {
            return redirect()
                ->route('employer.profile.edit')
                ->with('status', 'Please create your employer profile first.');
        }

        $jobs = $employer->jobs()
            ->with('tags')
            ->latest()
            ->get();

        return view('employer.jobs.index', [
            'jobs' => $jobs,
        ]);
    }


    public function destroy(Request $request, Job $job)
    {
        $user = $request->user();

        // Make sure the job belongs to the logged-in employer
        if (!$user->employer || $job->employer_id !== $user->employer->id) {
            abort(403);
        }

        $job->delete(); // simple delete; later you can change to "closed_at" or "is_active"

        return redirect()
            ->route('employer.jobs.index')
            ->with('status', 'Job removed.');
    }

    public function edit(Request $request, Job $job)
    {
        $user = $request->user();

        if (!$user->employer || $job->employer_id !== $user->employer->id) {
            abort(403);
        }

        return view('employer.jobs.edit', [
            'job' => $job->load('tags'),
            'tags' => Tag::all(),
        ]);
    }

    public function update(Request $request, Job $job)
    {
        $user = $request->user();

        if (!$user->employer || $job->employer_id !== $user->employer->id) {
            abort(403);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'salary' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'apply_url' => ['nullable', 'url', 'max:255'],
            'featured' => ['nullable', 'boolean'],
            'tags' => ['array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

        $job->update([
            'title' => $data['title'],
            'location' => $data['location'],
            'salary' => $data['salary'],
            'description' => $data['description'],
            'url' => $data['apply_url'] ?? null,
            'featured' => $request->boolean('featured'),
        ]);

        $job->tags()->sync($data['tags'] ?? []);

        return redirect()
            ->route('employer.jobs.index')
            ->with('status', 'Job updated.');
    }

}
