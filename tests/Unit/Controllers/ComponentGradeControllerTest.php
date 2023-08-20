<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Component;
use App\Models\Grade;

/**
 * ComponentGradeControllerTest
 *
 * @group unit
 * @group http
 * @group component-grade
 * @group controllers
 */
class ComponentGradeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_grades_for_component()
    {
        $component = Component::factory()->create();
        Grade::factory(3)->create(['component_id' => $component->id]);

        $response = $this->getJson(route('components.grades.index', $component));

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'inspection_id',
                        'component_id',
                        'grade_type_id',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_show_a_grade_for_component()
    {
        $component = Component::factory()->create();
        $grade = Grade::factory()->create(['component_id' => $component->id]);

        $response = $this->getJson(route('components.grades.show', [$component, $grade]));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $grade->id,
                    'inspection_id' => $grade->inspection_id,
                    'component_id' => $grade->component_id,
                    'grade_type_id' => $grade->grade_type_id,
                ]
            ]);
    }

    /** @test */
    public function it_returns_empty_list_when_no_grades_exist_for_component()
    {
        $component = Component::factory()->create();

        $response = $this->getJson(route('components.grades.index', $component));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_grade_for_component()
    {
        $component = Component::factory()->create();
        $nonexistentGradeId = 999;

        $response = $this->getJson(route('components.grades.show', [$component, $nonexistentGradeId]));

        $response->assertStatus(404);
    }
}
