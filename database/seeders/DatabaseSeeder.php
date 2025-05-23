<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Stage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::create([
             'email' => 'ahmed@ahmed.com',
             'password' => Hash::make('123456789'),
         ]);

      /*  Stage::create([
            'name' => 'المرحلة الابتدائية' ,
            'tag' => 'p' ,
        ]);
        Stage::create([
            'name' => 'المرحلة الاعدادية' ,
            'tag' => 'm' ,
        ]);
        Stage::create([
            'name' => 'المرحلة الثانوية' ,
            'tag' => 'h' ,
        ]);*/


       // $stagep =Stage::getIdByTag('p');
/*
        Section::create([
            'name' => '7' ,
        ]);
*/







    }
}
