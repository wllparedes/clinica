<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\StaffFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->count(45)->create();

        User::factory()->count(45)->create();
    }
}
