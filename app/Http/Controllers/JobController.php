<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class JobController extends Controller
{
    /**
     * Home page: hero + search + featured + recent jobs.
     */
    public function home(Request $request)
    {
        $search = $request->input('q');

        // If the user is searching, DO NOT CACHE
        if ($search) {
            $featuredJobs = Job::with(['employer', 'tags'])
                ->where('featured', true)
                ->take(4)
                ->get();

            $recentJobs = Job::with(['employer', 'tags'])
                ->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                })
                ->latest()
                ->take(10)
                ->get();

            $tags = Tag::all();

            return view('welcome', [
                'featuredJobs' => $featuredJobs,
                'recentJobs' => $recentJobs,
                'tags' => $tags,
            ]);
        }

        /**

        * Cache key automatically updates whenever a job is added/updated/deleted
         */
        $cacheKey = 'home_page_data_' . Job::max('updated_at');

        [$featuredJobs, $recentJobs, $tags] = Cache::remember(
            $cacheKey,
            now()->addMinutes(10),
            function () {
                $featuredJobs = Job::with(['employer', 'tags'])
                    ->where('featured', true)
                    ->take(4)
                    ->get();

                $recentJobs = Job::with(['employer', 'tags'])
                    ->latest()
                    ->take(10)
                    ->get();

                $tags = Tag::all();

                return [$featuredJobs, $recentJobs, $tags];
            }
        );

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

