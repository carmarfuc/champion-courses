<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'TEACHER_REMUNERATION_PERCENTAGE',
            'value' => '80',
        ]);

        DB::table('settings')->insert([
            'name' => 'MAXIMUM_CONCURRENT_COURSES_PER_STUDENT',
            'value' => '5',
        ]);

        DB::table('settings')->insert([
            'name' => 'MAXIMUM_COURSES_PER_TEACHER_WEEKLY',
            'value' => '5',
        ]);

        DB::table('settings')->insert([
            'name' => 'PAYMENT_DUE_DATE_NUMBER',
            'value' => '10',
        ]);
    }
}
