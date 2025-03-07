<?php

namespace Database\Factories;

use App\Models\Roadmap;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $order = 1;
        return [
            'name' => $this->faker->name(),
            'roadmap_id' => Roadmap::query()->get()->random()->id,
            'order' => $order++,
        ];
    }
}
