<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Job::create([
            'employer_id' => 1,
            'title' => 'Full Stack Developer',
            'salary' => '€60k',
            'location' => 'Remote',
            'type' => 'Full-time',
            'description' => 'Build and maintain web applications.',
            'featured' => true,
        ]);

        Job::create([
            'employer_id' => 2,
            'title' => 'Data Analyst',
            'salary' => '€40k',
            'location' => 'Barcelona',
            'type' => 'Full-time',
            'description' => 'Analyze business data and create dashboards.',
            'featured' => false,
        ]);

        Job::create([
            'employer_id' => 1,
            'title' => 'Cloud Engineer',
            'salary' => '€75k',
            'location' => 'Remote',
            'type' => 'Full-time',
            'description' => 'Manage and optimize cloud infrastructure.',
            'featured' => true,
        ]);
    }

}
