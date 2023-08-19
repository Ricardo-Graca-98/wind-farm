<?php

namespace Database\Factories;

use App\Models\Turbine;
use App\Models\ComponentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component>
 */
class ComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'component_type_id' => ComponentType::factory(),
            'turbine_id' => Turbine::factory(),
        ];
    }
}
