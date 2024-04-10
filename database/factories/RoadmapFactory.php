<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Roadmap>
 */
class RoadmapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->unique()->text(10),
            'rate'=>$this->faker->numberBetween(0,5),
            'description'=>$this->faker->paragraph(2),
            'category_id'=>Category::query()->whereNotNull('parent_id')->get()->random()->id,

        ];
    }
}
