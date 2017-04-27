<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach(range(1,10) as $index){
            Category::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph(1),
                'parent_id' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'ordering' => 1,
                'status' => true
            ]);
        }
    }
}
