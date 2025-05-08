<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Grade;
use App\Models\Stage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Stage::create([
        //     'name' => 'المرحلة الإبتدائية',
        //     'tag' => 'p',
        // ]);
        // Stage::create([
        //     'name' => 'المرحلة الإعدادية',
        //     'tag' => 'm',
        // ]);
        // Stage::create([
        //     'name' => 'المرحلة الثانوية',
        //     'tag' => 'h',
        // ]);

        // $stagep = Stage::getIdByTag('p');
        // Grade::create([
        //     'name' => 'الصف الأول',
        //     'stage_id' => $stagep,
        //     'tag' => '1',
        // ]);
    }
}
