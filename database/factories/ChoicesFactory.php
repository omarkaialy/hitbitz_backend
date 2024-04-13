<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChoicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'correct' => $this->faker->boolean(),
            'order' => $this->faker->randomDigit(),
//            'question_id' => Question::query()->get()->random()->id,
        ];
    }
}
