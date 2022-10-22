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
            'name' => 'admin',
            'email' => 'admin@championcourses.loc',
            'password' => Hash::make('admin'),
            'role' => 'ADMINISTRATOR',
        ]);

        //TEACHERS
        DB::table('users')->insert([
            'name' => 'Mariano Fuchilieri',
            'email' => 'mfuchilieri@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'TEACHER',
        ]);
        DB::table('users')->insert([
            'name' => 'Marco Cajeao',
            'email' => 'mcajeao@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'TEACHER',
        ]);
        DB::table('users')->insert([
            'name' => 'Jeremías Puerta',
            'email' => 'jpuerta@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'TEACHER',
        ]);
        DB::table('users')->insert([
            'name' => 'José Campos',
            'email' => 'jcampos@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'TEACHER',
        ]);
        DB::table('users')->insert([
            'name' => 'Franco Amicantonio',
            'email' =>'famicantonio@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'TEACHER',
        ]);


        //STUDENTS
        DB::table('users')->insert([
            'name' => 'Samuel Fontes',
            'email' => 'sfontes@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Emiliano Las Heras',
            'email' => 'elasheras@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Cristian Zurita',
            'email' => 'czurita@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'José Antonio',
            'email' => 'jantonio@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Karina Rodriguez',
            'email' => 'krodriguez@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Leandro Robert',
            'email' => 'lrobert@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Mariano Rodriguez',
            'email' =>'mariano@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Andrés Ortega',
            'email' => 'aortega@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Juan Alvarez',
            'email' => 'jalvarez@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Jorge Salazar',
            'email' => 'jsalazar@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);
        DB::table('users')->insert([
            'name' => 'Martín García',
            'email' =>'mgarcia@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'STUDENT',
        ]);

    }
}
