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
        $level = new Level();
        $level->name = 'Junior Level';
        $level->order = 1;
        $level->roadmap()->associate(1);
        $step = new LevelDetail();
        $step->name = 'Bascis';
        $step->order = 1;
        $step->duration = random_int(2, 10);
        $level->save();
        $step->level()->associate(1);
        $step->save();
        Level::factory()->count(10)->create();
        LevelDetail::factory()->count(10)->create();
    }
}
