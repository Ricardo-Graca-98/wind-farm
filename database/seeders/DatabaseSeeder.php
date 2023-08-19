<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\Grade;
use App\Models\Turbine;
use App\Models\Component;
use App\Models\GradeType;
use App\Models\Inspection;
use App\Models\ComponentType;
use Illuminate\Database\Seeder;
use Database\Factories\FarmFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Farm::factory(20)->create();
    }
}
