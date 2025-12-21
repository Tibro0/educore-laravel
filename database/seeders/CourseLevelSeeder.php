<?php

namespace Database\Seeders;

use App\Models\CourseLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseLevel::insert([
            [
                'name' => 'Expert',
                'slug' => Str::slug('Expert'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Intermediate',
                'slug' => Str::slug('Intermediate'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beginner',
                'slug' => Str::slug('Beginner'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
