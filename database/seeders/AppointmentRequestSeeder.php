<?php

namespace Database\Seeders;

use App\Models\AppointmentRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppointmentRequest::factory()->count(24)->create();
    }
}
