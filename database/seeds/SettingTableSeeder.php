<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'company_name' => 'GREEN ARCHITECTURE DESIGN',
            'company_logo' => '',
            'copyright' =>'COPYRIGHT 2015',
            'meta_title' => 'GREEN ARCHITECTURE DESIGN',
            'meta_content' => 'GREEN ARCHITECTURE DESIGN',
            'meta_description' => 'GREEN ARCHITECTURE DESIGN',
            'meta_keyword' => 'GREEN ARCHITECTURE DESIGN',
            'created_by' => 1,
            'updated_by' => 1,
            'status' => 1
        ]);
    }
}
