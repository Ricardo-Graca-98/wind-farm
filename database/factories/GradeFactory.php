<?php

namespace Database\Factories;

use App\Models\Component;
use App\Models\GradeType;
use App\Models\Inspection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'inspection_id' => Inspection::factory(),
            'component_id' => Component::factory(),
            'grade_type_id' => GradeType::factory()
        ];
    }
}
