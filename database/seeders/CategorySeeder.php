<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Tech', 'Travel', 'Food', 'Lifestyle', 'Education'];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat, 'slug' => Str::slug($cat)]);
        }
    }
}
