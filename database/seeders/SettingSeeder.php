<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'percentage_remuneration_of_the_teacher',
            'slug' => '',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'name' => '',
            'slug' => '',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'name' => '',
            'slug' => '',
            'value' => '',
        ]);
    }
}
