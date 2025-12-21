<?php

namespace Database\Seeders;

use App\Models\CourseLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseLanguage::insert([
            [
                'name' => 'English',
                'slug' => Str::slug('English'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hindi',
                'slug' => Str::slug('Hindi'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bangla',
                'slug' => Str::slug('Bangla'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spanish',
                'slug' => Str::slug('Spanish'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
