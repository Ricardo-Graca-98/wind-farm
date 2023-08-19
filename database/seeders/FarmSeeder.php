<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\Turbine;
use App\Models\Component;
use App\Models\ComponentType;
use App\Models\ComponentTypes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $componentTypes = ComponentType::all();

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
    }
}
