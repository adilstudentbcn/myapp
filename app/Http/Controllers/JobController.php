<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Home page: hero + search + featured + recent jobs.
     */
    public function home(Request $request)
    {
        $search = $request->input('q');

        $featuredJobs = Job::with(['employer', 'tags'])
            ->where('featured', true)
            ->take(3)
            ->get();

        $recentJobsQuery = Job::with(['employer', 'tags'])->latest();

        if ($search) {
            $recentJobsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $recentJobs = $recentJobsQuery->take(10)->get();
        $tags = Tag::all();

        return view('welcome', [
            'featuredJobs' => $featuredJobs,
            'recentJobs' => $recentJobs,
            'tags' => $tags,
        ]);
    }

    /**
     * Browse page: list of jobs with pagination + search + tags.
     */
    public function browse(Request $request)
    {
        $search = $request->input('q');
        $tag = $request->input('tag');

        $jobsQuery = Job::with(['employer', 'tags'])->latest();

        if ($search) {
            $jobsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($tag) {
            $jobsQuery->whereHas('tags', function ($q) use ($tag) {
                $q->where('name', $tag);
            });
        }

        $jobs = $jobsQuery->paginate(10)->withQueryString();
        $tags = Tag::all();

        return view('jobs.browse', [
            'jobs' => $jobs,
            'tags' => $tags,
        ]);
    }

    /**
     * Single job page.
     */
    public function show(Job $job)
    {
        $job->load(['employer', 'tags']);

        return view('jobs.show', [
            'job' => $job,
        ]);
    }
}
