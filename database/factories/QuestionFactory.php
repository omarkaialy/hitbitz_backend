<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data = [
            'quiz_id' => Quiz::query()->whereNot('id','=',1)->get()->random()->id,
            'type' => random_int(1, 6),
            'title' => fake()->text(30),

            ];
        if ($data['type'] == 1) {
            $data['isTrue'] = $this->faker->boolean();
        }
        return $data;
    }
}
