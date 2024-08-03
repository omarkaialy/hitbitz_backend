<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\LevelDetail;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                "name" => "Basics",
                "roadmapId" => 1,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Intermediate",
                "roadmapId" => 1,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Advanced",
                "roadmapId" => 1,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Beginner",
                "roadmapId" => 2,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Intermediate",
                "roadmapId" => 2,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Advanced",
                "roadmapId" => 2,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "A1",
                "roadmapId" => 9,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "A2",
                "roadmapId" => 9,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "B1",
                "roadmapId" => 9,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "B2",
                "roadmapId" => 9,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Beginner",
                "roadmapId" => 10,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Intermediate",
                "roadmapId" => 10,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Advanced",
                "roadmapId" => 10,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
                   [
                "name" => "Theoretical Section",
                "roadmapId" => 25,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Practical Section",
                "roadmapId" => 25,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],

            [
                "name" => "Courses Questions",
                "roadmapId" => 25,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Theoretical Section",
                "roadmapId" => 26,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
            [
                "name" => "Practical Section",
                "roadmapId" => 26,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],
           [
                "name" =>  "Courses Questions",
                "roadmapId" => 26,
                "description" => "level",
                "requirements" => ["requirements 1", "requirements 2"]
            ],

        ];
        foreach ($levels as $level){
            $level1 = new Level();
            $level1->name = $level['name'];
            $level1->description = $level['description'];
            $level1->requirements = $level['requirements'];
            $level1->roadmap()->associate($level['roadmapId']);
            $level1->save();

        }

        $steps = [
            ['name' => 'Syntax', 'description' => 'Learn Python syntax basics', 'level_id' => 1, 'duration' => random_int(1,50)],
            ['name' => 'Variables and Data Types', 'description' => 'Understand variables and different data types in Python', 'level_id' => 1, 'duration' => random_int(1,50)],
            ['name' => 'Control Flow - If Statements', 'description' => 'Learn about conditional statements (if, elif, else)', 'level_id' => 1, 'duration' => random_int(1,50)],
            ['name' => 'Loops - For and While', 'description' => 'Understand for and while loops in Python', 'level_id' => 1, 'duration' => random_int(1,50)],
            ['name' => 'Functions', 'description' => 'Learn how to define and use functions in Python', 'level_id' => 1, 'duration' => random_int(1,50)],
            ['name' => 'Lists and Tuples', 'description' => 'Understand lists and tuples in Python', 'level_id' => 2, 'duration' => random_int(1,50)],
            ['name' => 'Dictionaries and Sets', 'description' => 'Learn about dictionaries and sets in Python', 'level_id' => 2, 'duration' => random_int(1,50)],
            ['name' => 'List Comprehensions', 'description' => 'Understand list comprehensions for concise code', 'level_id' => 2, 'duration' => random_int(1,50)],
            ['name' => 'File Handling', 'description' => 'Learn how to read from and write to files in Python', 'level_id' => 3, 'duration' => random_int(1,50)],
            ['name' => 'Exception Handling', 'description' => 'Understand how to handle exceptions in Python', 'level_id' => 3, 'duration' => random_int(1,50)],
            ['name' => 'Introduction to Flutter', 'description' => 'Learn about Flutter framework and its advantages', 'level_id' => 11, 'duration' => random_int(1,50)],
            ['name' => 'Setting Up Flutter Development Environment', 'description' => 'Install and configure Flutter SDK and necessary tools', 'level_id' => 11, 'duration' => random_int(1,50)],
            ['name' => 'Flutter Widgets and Layouts', 'description' => 'Understand Flutter widgets and layout system', 'level_id' => 11, 'duration' => random_int(1,50)],
            ['name' => 'Stateless and Stateful Widgets', 'description' => 'Learn about stateless and stateful widgets in Flutter', 'level_id' => 11, 'duration' => random_int(1,50)],
            ['name' => 'Building UIs with Flutter', 'description' => 'Create beautiful user interfaces using Flutter widgets', 'level_id' => 11, 'duration' => random_int(1,50)],
            ['name' => 'Navigation and Routing', 'description' => 'Implement navigation and routing in Flutter apps', 'level_id' => 12, 'duration' => random_int(1,50)],
            ['name' => 'State Management', 'description' => 'Explore state management techniques in Flutter', 'level_id' => 12, 'duration' => random_int(1,50)],
            ['name' => 'Working with APIs', 'description' => 'Integrate RESTful APIs and handle asynchronous data in Flutter', 'level_id' => 12, 'duration' => random_int(1,50)],
            ['name' => 'Local Data Storage', 'description' => 'Store and retrieve data locally in Flutter apps', 'level_id' => 12, 'duration' => random_int(1,50)],
            ['name' => 'Advanced UI Design', 'description' => 'Master advanced UI design concepts and animations in Flutter', 'level_id' => 13, 'duration' => random_int(1,50)],
            ['name' => 'Platform-Specific Features', 'description' => 'Implement platform-specific features and functionalities in Flutter', 'level_id' => 13, 'duration' => random_int(1,50)],
            ['name' => 'Testing and Debugging', 'description' => 'Write tests and debug Flutter applications', 'level_id' => 13, 'duration' => random_int(1,50)],
            ['name' => 'Deployment and Publishing', 'description' => 'Deploy Flutter apps to app stores and publish them', 'level_id' => 13, 'duration' => random_int(1,50)],
            ['name' => 'A1 Vocabulary', 'description' => 'Learn basic Italian vocabulary at the A1 level', 'level_id' => 7, 'duration' => random_int(1,50)],
            ['name' => 'A1 Grammar', 'description' => 'Study Italian grammar fundamentals at the A1 level', 'level_id' => 7, 'duration' => random_int(1,50)],
            ['name' => 'A2 Vocabulary', 'description' => 'Expand Italian vocabulary knowledge at the A2 level', 'level_id' => 8, 'duration' => random_int(1,50)],
            ['name' => 'A2 Grammar', 'description' => 'Deepen understanding of Italian grammar at the A2 level', 'level_id' => 8, 'duration' => random_int(1,50)],
            ['name' => 'B1 Vocabulary', 'description' => 'Master advanced Italian vocabulary at the B1 level', 'level_id' => 9, 'duration' => random_int(1,50)],
            ['name' => 'B1 Grammar', 'description' => 'Refine Italian grammar skills at the B1 level', 'level_id' => 9, 'duration' => random_int(1,50)],
            ['name' => 'B2 Vocabulary', 'description' => 'Acquire advanced Italian vocabulary and idiomatic expressions at the B2 level', 'level_id' => 10, 'duration' => random_int(1,50)],
            ['name' => 'B2 Grammar', 'description' => 'Master complex Italian grammar structures and usage at the B2 level', 'level_id' => 10, 'duration' => random_int(1,50)],
           ['name' => 'Chapter #1', 'description' => 'الفصل الاول من مادة نظم الشتغيل 1', 'level_id' => 14, 'duration' => random_int(1,50)],
            ['name' => 'Chapter #2', 'description' => 'الفصل الثاني من مادة نظم الشتغيل 1', 'level_id' => 14, 'duration' => random_int(1,50)],
            ['name' => 'Chapter #3', 'description' => 'الفصل الثالث من مادة نظم الشتغيل 1', 'level_id' => 14, 'duration' => random_int(1,50)],
            ['name' => 'Chapter #4', 'description' => 'الفصل الرابع من مادة نظم الشتغيل 1', 'level_id' => 14, 'duration' => random_int(1,50)],
            ['name' => 'Chapter #5', 'description' => 'الفصل الخامس من مادة نظم الشتغيل 1', 'level_id' => 14, 'duration' => random_int(1,50)],
           ['name' => 'Chapter #12', 'description' => 'الفصل الثاني عشر من مادة نظم الشتغيل 1', 'level_id' => 17, 'duration' => random_int(1,50)],
            ['name' => 'Chapter #13', 'description' => 'الفصل الثالث عشر من مادة نظم الشتغيل 1', 'level_id' => 17, 'duration' => random_int(1,50)],
            ['name' => 'Chapter #14', 'description' => 'الفصل الرابع عشر من مادة نظم الشتغيل 1', 'level_id' => 17, 'duration' => random_int(1,50)],


            ];

        foreach ($steps as $step) {
            $step1 = new LevelDetail();
            $step1->name = $step['name'];
            $step1->description = $step['description'];
            $step1->level_id = $step['level_id'];
            $step1->duration = $step['duration'];
            $step1->save();
        }
    }
}
