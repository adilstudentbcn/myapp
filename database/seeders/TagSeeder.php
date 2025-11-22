<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = ['PHP', 'Laravel', 'Remote', 'Full-time', 'Part-time', 'Junior', 'Senior'];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
