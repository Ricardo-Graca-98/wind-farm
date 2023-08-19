<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Component;
use App\Models\GradeType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gradeTypes = GradeType::all();

        Component::all()->each(function ($component) use ($gradeTypes) {
            $component->turbine->inspections->each(function ($inspection) use ($component, $gradeTypes) {
                $gradeTypeId = $gradeTypes->random()->id;

                $inspection->grades()->save(
                    Grade::factory()->create([
                        'inspection_id' => $inspection->id,
                        'component_id' => $component->id,
                        'grade_type_id' => $gradeTypeId,
                    ])
                );
            });
        });
    }
}
