<?php

use Illuminate\Database\Seeder;
use App\Content;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach(range(1, 300) as $index){
            Content::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph(4),
                'images' => '[]',
                'thumb_images' => '[]',
                'category_id' => '1',
                'visitor_count' => '0',
                'created_by' => '2',
                'updated_by' => '2',
                'status' => '1'
            ]);    
        }
    }
}
