<?php

namespace Database\Seeders;

use App\Models\Roadmap;
use Illuminate\Database\Seeder;

class RoadmapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roadmap = new Roadmap();
        $roadmap->name = 'Flutter';
        $roadmap->description = 'This roadmap is aspirational; it represents some of what our most active contributors to Flutter and Dart have told us they plan to work on this year';
        $roadmap->rate = 3;
        $roadmap->category()->associate(1);
        $roadmap->save();
        Roadmap::factory()->count(5)->create();
    }
}
