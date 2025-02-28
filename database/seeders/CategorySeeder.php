<?php

namespace Database\Seeders;

use App\Enums\CategoryTypeEnum;
use App\Helpers\ApiResponse;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [

            ['name' => 'Programming', 'type' => 2, 'image' => '1717416330_363844950.png'],
            ['name' => 'Business & Management', 'type' => 2, 'image' => '1717416330_363844940.png'],
            ['name' => 'Language Learning', 'type' => 2, 'image' => '1717416330_363844946.png'],
            ['name' => 'Faculty Of IT', 'type' => 1, 'image' => '1717416330_363844945.png'],
            ['name' => 'Faculty Of Maths', 'type' => 1, 'image' => '1717416330_363844948.png'],
            ['name' => 'Programming Languages', 'parentId' => 1, 'image' => '1717416330_363844949.png'],
            ['name' => 'FrameWorks', 'parentId' => 1, 'image' => '1717416330_363844944.png'],
            ['name' => 'Data Science', 'parentId' => 1, 'image' => '1717416330_363844941.png'],
            ['name' => 'Marketing', 'parentId' => 2, 'image' => '1717416330_363844947.png'],
            ['name' => 'Finance', 'parentId' => 2, 'image' => '1717416330_363844943.png'],
            ['name' => 'African Languages', 'parentId' => 3, 'image' => '1717416330_363844938.png'],
            ['name' => 'Asian Languages', 'parentId' => 3, 'image' => '1717416330_363844939.png'],
            ['name' => 'Euro Languages', 'parentId' => 3, 'image' => '1717416330_363844942.png'],
            ['name' => 'السنة الأولى', 'parentId' => 4, 'image' => '1717416330_363844942.png'],
            ['name' => 'السنة الثانية', 'parentId' => 4, 'image' => '1717416330_363844942.png'],
            ['name' => 'السنة الثالثة', 'parentId' => 4, 'image' => '1717416330_363844942.png'],
            ['name' => 'السنة الرابعة', 'parentId' => 4, 'image' => '1717416330_363844942.png'],
            ['name' => 'السنة الخامسة', 'parentId' => 4, 'image' => '1717416330_363844942.png'],
        ];

        foreach ($categories as $category) {
            $category1 = new Category();
            $category1->name = $category['name'];

            if (isset($category['parentId'])) {
                $parent = Category::findOrFail($category['parentId']);
                $category1->parent()->associate($parent);
            }

            if (isset($category['type'])) {
                $category1->type = CategoryTypeEnum::from($category['type']);
            }

            $category1->save();

            $imageService = new ImageService();
            $imageService->storeImage($category1, $category['image'], 'categories');
        }


    }
}
