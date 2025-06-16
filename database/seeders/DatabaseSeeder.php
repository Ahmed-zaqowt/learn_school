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

        /*   \App\Models\User::create([
             'email' => 'admin@admin.com',
             'password' => Hash::make('123456789'),
         ]);

        Stage::create([
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
        ]);
*/

        $stagep = Stage::getIdByTag('p');

        /* Section::create([
            'name' => '7' ,
        ]);*/


/*
        Grade::create([
            'name' => 'الصف الاول',
            'stage_id' => $stagep,
            'tag' => '1',
        ]);

        Grade::create([
            'name' => 'الصف الثاني',
            'stage_id' => $stagep,
            'tag' => '2',
        ]);
        Grade::create([
            'name' => 'الصف الثالث',
            'stage_id' => $stagep,
            'tag' => '3',
        ]);
        Grade::create([
            'name' => 'الصف الرابع',
            'stage_id' => $stagep,
            'tag' => '4',
        ]);
        Grade::create([
            'name' => 'الصف الخامس',
            'stage_id' => $stagep,
            'tag' => '5',
        ]);
        Grade::create([
            'name' => 'الصف السادس',
            'stage_id' => $stagep,
            'tag' => '6',
        ]);*/


        
    }
}
