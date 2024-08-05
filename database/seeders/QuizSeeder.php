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
        $quizzes = [
            // Quizzes for Level 1 steps
            ['name' => 'Introduction to Flutter Quiz', 'step_id' => 11, 'description' => 'Test your knowledge about the basics of Flutter', 'required_degree' => 70],
            ['name' => 'Flutter Widgets Quiz', 'step_id' => 11, 'description' => 'Check your knowledge about Flutter widgets and layout system', 'required_degree' => 75],
            ['name' => 'Stateless vs Stateful Widgets Quiz', 'step_id' => 11, 'description' => 'Quiz to distinguish between stateless and stateful widgets in Flutter', 'required_degree' => 80],

            // Quizzes for Level 2 steps
            ['name' => 'Navigation and Routing Quiz', 'step_id' => 12, 'description' => 'Test your understanding of navigation and routing in Flutter', 'required_degree' => 75],
            ['name' => 'State Management Quiz', 'step_id' => 12, 'description' => 'Quiz to assess your grasp on state management techniques in Flutter', 'required_degree' => 80],
            ['name' => 'Working with APIs Quiz', 'step_id' => 12, 'description' => 'Evaluate your ability to integrate APIs and handle asynchronous data in Flutter', 'required_degree' => 70],
            ['name' => 'Local Data Storage Quiz', 'step_id' => 12, 'description' => 'Assess your knowledge about storing and retrieving data locally in Flutter apps', 'required_degree' => 65],

            // Quizzes for Level 3 steps
            ['name' => 'Advanced UI Design Quiz', 'step_id' => 13, 'description' => 'Test your expertise in advanced UI design concepts and animations in Flutter', 'required_degree' => 85],
            ['name' => 'Platform-Specific Features Quiz', 'step_id' => 13, 'description' => 'Quiz to evaluate your understanding of implementing platform-specific features in Flutter', 'required_degree' => 80],
            ['name' => 'Testing and Debugging Quiz', 'step_id' => 13, 'description' => 'Assess your skills in writing tests and debugging Flutter applications', 'required_degree' => 75],
            ['name' => 'Deployment and Publishing Quiz', 'step_id' => 13, 'description' => 'Quiz to test your knowledge about deploying Flutter apps to app stores and publishing them', 'required_degree' => 70],

            // Quizzes for A1 level steps
            ['name' => 'A1 Vocabulary Quiz', 'step_id' => 24, 'description' => 'Test your vocabulary knowledge at the A1 level in Italian', 'required_degree' => 60],
            ['name' => 'A1 Grammar Quiz', 'step_id' => 25, 'description' => 'Quiz to assess your understanding of grammar at the A1 level in Italian', 'required_degree' => 65],

            // Quizzes for A2 level steps
            ['name' => 'A2 Vocabulary Quiz', 'step_id' => 26, 'description' => 'Test your vocabulary knowledge at the A2 level in Italian', 'required_degree' => 65],
            ['name' => 'A2 Grammar Quiz', 'step_id' => 27, 'description' => 'Quiz to assess your understanding of grammar at the A2 level in Italian', 'required_degree' => 70],

            // Quizzes for B1 level steps
            ['name' => 'B1 Vocabulary Quiz', 'step_id' => 28, 'description' => 'Test your vocabulary knowledge at the B1 level in Italian', 'required_degree' => 70],
            ['name' => 'B1 Grammar Quiz', 'step_id' => 29, 'description' => 'Quiz to assess your understanding of grammar at the B1 level in Italian', 'required_degree' => 75],

            // Quizzes for B2 level steps
            ['name' => 'B2 Vocabulary Quiz', 'step_id' => 30, 'description' => 'Test your vocabulary knowledge at the B2 level in Italian', 'required_degree' => 75],
            ['name' => 'B2 Grammar Quiz', 'step_id' => 31, 'description' => 'Quiz to assess your understanding of grammar at the B2 level in Italian', 'required_degree' => 80],
// Quizzes for capitolu 1
            ['name' => 'Quiz #1', 'step_id' => 32, 'description' => 'Test your vocabulary knowledge at the B2 level in Italian', 'required_degree' => 75],
            ['name' => 'Quiz #2', 'step_id' => 32, 'description' => 'Quiz to assess your understanding of grammar at the B2 level in Italian', 'required_degree' => 80],
// Quizzes for capitolu 2
            ['name' => 'Quiz #1', 'step_id' => 33, 'description' => 'Test your vocabulary knowledge at the B2 level in Italian', 'required_degree' => 75],
            ['name' => 'Quiz #2', 'step_id' => 33, 'description' => 'Quiz to assess your understanding of grammar at the B2 level in Italian', 'required_degree' => 80],
// Quizzes for capitolu 3
            ['name' => 'Quiz #1', 'step_id' => 34, 'description' => 'Test your vocabulary knowledge at the B2 level in Italian', 'required_degree' => 75],
            ['name' => 'Quiz #2', 'step_id' => 34, 'description' => 'Quiz to assess your understanding of grammar at the B2 level in Italian', 'required_degree' => 80],
// Quizzes for capitolu 1
            ['name' => 'Quiz #1', 'step_id' => 37, 'description' => 'Test your vocabulary knowledge at the B2 level in Italian', 'required_degree' => 75],
            ['name' => 'Quiz #2', 'step_id' => 37, 'description' => 'Quiz to assess your understanding of grammar at the B2 level in Italian', 'required_degree' => 80],
// Quizzes for capitolu 2
            ['name' => 'Quiz #1', 'step_id' => 38, 'description' => 'Test your vocabulary knowledge at the B2 level in Italian', 'required_degree' => 75],
            ['name' => 'Quiz #2', 'step_id' => 38, 'description' => 'Quiz to assess your understanding of grammar at the B2 level in Italian', 'required_degree' => 80],
// Quizzes for capitolu 3
            ['name' => 'Quiz #1', 'step_id' => 39, 'description' => 'Test your vocabulary knowledge at the B2 level in Italian', 'required_degree' => 75],
            ['name' => 'Quiz #2', 'step_id' => 39, 'description' => 'Quiz to assess your understanding of grammar at the B2 level in Italian', 'required_degree' => 80],



        ];

        foreach ($quizzes as $quiz) {
            $quiz1 = new Quiz();
            $quiz1->name = $quiz['name'];
            $quiz1->level_detail_id = $quiz['step_id'];
            $quiz1->description = $quiz['description'];
            $quiz1->required_degree = $quiz['required_degree'];
            $quiz1->save();
        }
    }
}
