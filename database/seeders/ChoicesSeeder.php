<?php

namespace Database\Seeders;

use App\Models\Choices;
use App\Models\Question;
use Illuminate\Database\Seeder;

class ChoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::query()->get();
        foreach ($questions as $question) {
            if ($question->quiz->id!=1)
                if ($question->type != 1) {
                    Choices::factory()->count(4)->create(['question_id' => $question->id]);
                }

        }
    }
}
