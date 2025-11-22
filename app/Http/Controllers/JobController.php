<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;

class JobController extends Controller
{
    public function index()
    {

        $featuredJobs = Job::with(['employer', 'tags'])
            ->take(3)
            ->get();


        $recentJobs = Job::with(['employer', 'tags'])
            ->latest()
            ->take(5)
            ->get();


        $tags = Tag::orderBy('name')->get();

        return view('welcome', [
            'featuredJobs' => $featuredJobs,
            'recentJobs' => $recentJobs,
            'tags' => $tags,
        ]);
    }
}
