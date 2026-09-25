<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming',
            'color' => 'bg-red-100'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
            'color' => 'bg-blue-100'
        ]);

        Category::create([
            'name' => 'Artificial Intelligence',
            'slug' => 'artificial-intelligence',
            'color' => 'bg-green-100'
        ]);
    }
}
