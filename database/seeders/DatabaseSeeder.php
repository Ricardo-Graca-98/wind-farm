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
use Database\Factories\TurbineFactory;
use Database\Factories\ComponentTypeFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        $this->call([
            GradeTypeSeeder::class,
            ComponentTypeSeeder::class,
            FarmSeeder::class,
            GradeSeeder::class,
        ]);
    }
}
