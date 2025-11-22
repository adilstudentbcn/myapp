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
            'location' => 'Barcelona',
            'salary' => '€60k',
            'type' => 'Full-Time',
            'description' => 'Join our team as a Full Stack Developer.',
        ]);

        Job::create([
            'employer_id' => 2,
            'title' => 'Data Analyst',
            'location' => 'Madrid',
            'salary' => '€40k',
            'type' => 'Full-Time',
            'description' => 'Analyze data to generate actionable insights.',
        ]);

        Job::create([
            'employer_id' => 1,
            'title' => 'Cloud Engineer',
            'location' => 'Remote',
            'salary' => '€75k',
            'type' => 'Remote',
            'description' => 'Work with cloud infrastructure and deployment.',
        ]);
    }
}
