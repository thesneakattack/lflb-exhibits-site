<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        Tag::insert([
            ['name' => 'Biography', 'slug' => 'biography'],
            ['name' => 'Timeline', 'slug' => 'timeline'],
            ['name' => 'Location', 'slug' => 'location'],
            ['name' => 'Photos', 'slug' => 'photos'],
            ['name' => 'Primary Documents', 'slug' => 'primary-documents'],
            ['name' => 'Statistics', 'slug' => 'statistics'],
        ]);
    }
}
