<?php

namespace Database\Factories;

use App\Models\LevelDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {static $order=1;
        return [
            'name' => $this->faker->realText(100),
            'level_detail_id' => LevelDetail::query()->get()->random()->id,
            'order'=>$order++,
            'description'=>$this->faker->paragraph,
            'required_degree'=>random_int(60,90)
        ];
    }
}
