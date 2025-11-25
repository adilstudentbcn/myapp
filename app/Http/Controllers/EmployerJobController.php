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
            'salary' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'apply_url' => ['nullable', 'url', 'max:255'],
            'featured' => ['nullable', 'boolean'],
            'tags' => ['array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

        $data['featured'] = $request->boolean('featured');

        $job = $user->employer->jobs()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'location' => $data['location'],
            'salary' => $data['salary'],
            'type' => $data['type'],
            'url' => $data['apply_url'] ?? null,
            'featured' => $data['featured'],
        ]);

        $job->tags()->sync($data['tags'] ?? []);

        return redirect()
            ->route('jobs.show', $job)
            ->with('status', 'Job posted successfully!');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $employer = $user->employer;

        if (!$employer) {
            return redirect()
                ->route('employer.profile.edit')
                ->with('status', 'Please create your employer profile first.');
        }

        $jobs = $employer->jobs()
            ->with('tags')
            ->withCount('applications')
            ->latest()
            ->get();

        return view('employer.jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function destroy(Request $request, Job $job)
    {
        $user = $request->user();

        if (!$user->employer || $job->employer_id !== $user->employer->id) {
            abort(403);
        }

        $job->delete();

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
            'type' => ['required', 'string', 'max:50'],
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
            'type' => $data['type'],
            'description' => $data['description'],
            'url' => $data['apply_url'] ?? null,
            'featured' => $request->boolean('featured'),
        ]);

        $job->tags()->sync($data['tags'] ?? []);

        return redirect()
            ->route('employer.jobs.index')
            ->with('status', 'Job updated.');
    }


    public function applications(Request $request, Job $job)
    {
        $user = $request->user();

        if (!$user->employer || $job->employer_id !== $user->employer->id) {
            abort(403);
        }

        $applications = $job->applications()
            ->with('user')
            ->latest()
            ->get();

        return view('employer.jobs.applications', [
            'job' => $job,
            'applications' => $applications,
        ]);
    }
}
