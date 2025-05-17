<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Grade;
use App\Models\Section;
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
        //     'name' => 'المرحلة الثانوية',
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

        // $stagep = Stage::getIdByTag('m');
        // Grade::create([
        //     'name' => 'الصف الثامن',
        //     'stage_id' => $stagep,
        //     'tag' => '8',
        // ]);
        // Section::create([
        //     'name' => '3 ',
        //     'created_at' => '2025-04-30 07:13:49',
        //     'updated_at' => '2025-04-30 07:13:49',
        // ]);
    }
}
