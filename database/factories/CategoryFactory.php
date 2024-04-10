<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
        ];
    }

    /**
     * Define the model's state for a category with type.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withType()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => $this->faker->randomElement([1, 2]),
            ];
        });
    }

    /**
     * Define the model's state for a category with parent.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withParent()
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => Category::query()->whereNotNull('type')->get()->random()->id,
            ];
        });
    }
}
