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
        $category = new Category();
        $category->type = 1;
        $category->name = 'Programming';
        $category->save();
        $category = new Category();
        $category->name = 'Mobile Development';
        $category->parent()->associate(1);
        $category->save();

        Category::factory()->withType()->count(5)->create();
        Category::factory()->withParent()->count(5)->create();
    }
}
