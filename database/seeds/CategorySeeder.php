<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'category_name' => 'Yoga','description'=>'category', ],
            ['id' => 2, 'category_name' => 'Dietitian','description'=>'category', ],
            ['id' => 3, 'category_name' => 'Gym','description'=>'category', ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}