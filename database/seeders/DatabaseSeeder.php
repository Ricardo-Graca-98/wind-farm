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
        // TODO: Refactor into different seeder files

        $gradeTypes = GradeType::factory(5)
            ->state(new Sequence(
                ['name' => '1'],
                ['name' => '2'],
                ['name' => '3'],
                ['name' => '4'],
                ['name' => '5']
            ))
            ->create();

        $componentTypes = ComponentType::factory(4)
            ->state(new Sequence(
                ['name' => 'Blade'],
                ['name' => 'Rotor'],
                ['name' => 'Hub'],
                ['name' => 'Generator']
            ))
            ->create();

        Farm::factory(5)
            ->has(
                Turbine::factory(2)
                    ->state(function (array $attributes, Farm $farm) {
                        return ['farm_id' => $farm->id];
                    })
                    ->afterCreating(function (Turbine $turbine) use ($componentTypes) {
                        $componentTypes->each(function ($componentType) use ($turbine) {
                            Component::factory()->create([
                                'component_type_id' => $componentType->id,
                                'turbine_id' => $turbine->id
                            ]);
                        });
                    })
                    ->hasInspections(5)
            )
            ->create();

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
