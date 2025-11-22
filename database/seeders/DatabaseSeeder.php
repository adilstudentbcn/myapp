<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// ADD THESE:
use Database\Seeders\EmployerSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\JobSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            EmployerSeeder::class,
            TagSeeder::class,
            JobSeeder::class,
        ]);
    }
}
