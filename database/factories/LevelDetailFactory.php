<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LevelDetails>
 */
class LevelDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static  $order = 1;
        return [
            'name'=>$this->faker->name(),
            'description'=>$this->faker->paragraph(2),
            'level_id'=> Level::query()->get()->random()->id,
            'order'=>$order++,
            'duration'=>random_int(1,5),
         ];
    }
}
