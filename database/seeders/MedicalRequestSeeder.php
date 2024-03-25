<?php

namespace Database\Seeders;

use App\Models\MedicalRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicalRequest::factory()->count(1)->create();
    }
}
