<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Roles::factory()->create([
            'role_name' => 'Administrator',
        ]);
        Roles::factory()->create([
            'role_name' => 'Normal User',
        ]);
        User::factory(10)->create();
        Task::factory(15)->create();
    }
}
