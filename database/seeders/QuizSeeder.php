<?php

namespace Database\Seeders;

use App\Models\Choices;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quiz = new Quiz();
        $quiz->name = 'Column Quiz';
        $quiz->order = 1;
        $quiz->levelDetail()->associate(1);
        $quiz->description = 'A "column widget" typically refers to a feature or component in a software application or website that organizes content into columns. This can be particularly useful for displaying information in a structured and visually appealing manner, especially when dealing with large amounts of data or varied types of content.';
        $quiz->required_degree = 60;
        $quiz->save();
        $titles = ["Which of the following is a benefit of using a column widget in a website or application?",
            "What is the purpose of responsive design in a column widget?",
            "How can a column widget improve user experience in navigating content?",
        ];
        $answers = [[
            ['title' => 'Improved content organization', 'correct' => false],
            ['title' => 'Enhanced user engagement', 'correct' => false],
            ['title' => 'Efficient use of screen space', 'correct' => false],
            ['title' => 'All of the above', 'correct' => true],
        ],
            [
                ['title' => 'To ensure compatibility with older browsers', 'correct' => false],
                ['title' => 'To adapt to different screen sizes and devices', 'correct' => true],
                ['title' => 'To increase server performance', 'correct' => false],
                ['title' => 'To provide additional security measures', 'correct' => false],
            ], [
                ['title' => 'By organizing content into distinct sections', 'correct' => true],
                ['title' => 'By displaying all content in a single column', 'correct' => false],
                ['title' => 'By removing all images and multimedia content', 'correct' => false],
                ['title' => 'By decreasing font size to fit more content', 'correct' => false],
            ],];
        $index = 0;
        foreach ($titles as $title) {
            $question = new Question();
            $question->title = $title;
            $question->quiz()->associate(1);
            $question->type = 2;
            $question->save();
            foreach ($answers[$index] as $answer) {
                Choices::create(['question_id' => $question->id,
                    'title' => $answer['title'],
                    'correct' => $answer['correct']
                ]);
            }
            $index = $index + 1;
        }
        $question = new Question();
        $question->title = "True or False: A column widget is only useful for displaying text content.";
        $question->type = 1;
        $question->isTrue = true;
        $question->quiz()->associate(1);
        $question->save();
        Quiz::factory()->count(10)->create();
        Question::factory()->count(50)->create();
    }
}
