<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $list=['Academic','Professional'];
        foreach ( $list as $item){

        $type= new Type();
        $type->name=$item;
        $type->save();

    }
    }
}
