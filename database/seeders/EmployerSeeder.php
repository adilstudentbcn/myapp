<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employer;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employer::create([
            'name' => 'Google',
            'logo' => null,
            'website' => 'https://google.com',
        ]);

        Employer::create([
            'name' => 'Glovo',
            'logo' => null,
            'website' => 'https://glovoapp.com',
        ]);
    }
}
