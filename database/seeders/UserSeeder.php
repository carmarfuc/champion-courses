<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        //ADMINISTRATOR
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@championcourses.loc',
            'password' => Hash::make('1234'),
            'role' => 'ADMINISTRATOR',
        ]);

        //TEACHERS
        DB::table('users')->insert([
            'name' => 'Mariano Fuchilieri',
            'email' => 'mfuchilieri@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'TEACHER',
        ]);
        DB::table('users')->insert([
            'name' => 'Marco Cajeao',
            'email' => 'mcajeao@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'TEACHER',
        ]);
        DB::table('users')->insert([
            'name' => 'Jeremías Puerta',
            'email' => 'jpuerta@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'TEACHER',
        ]);
        DB::table('users')->insert([
            'name' => 'Franco Amicantonio',
            'email' =>'famicantonio@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'TEACHER',
        ]);


        //STUDENTS
        DB::table('users')->insert([
            'name' => 'Samuel Fontes',
            'email' => 'sfontes@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Emiliano Las Heras',
            'email' => 'elasheras@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Cristian Zurita',
            'email' => 'czurita@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Karina Rodriguez',
            'email' => 'krodriguez@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Leandro Robert',
            'email' => 'lrobert@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Mariano Rodriguez',
            'email' =>'mariano@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Andrés Ortega',
            'email' => 'aortega@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Juan Alvarez',
            'email' => 'jalvarez@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Jorge Salazar',
            'email' => 'jsalazar@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'STUDENT',
        ]);

    }
}
