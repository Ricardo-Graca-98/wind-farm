<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Inspection;
use App\Models\Grade;

/**
 * InspectionGradeControllerTest
 *
 * @group unit
 * @group http
 * @group inspection-grade
 * @group controllers
 */
class InspectionGradeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_grades_for_inspection()
    {
        $inspection = Inspection::factory()->create();

        Grade::factory(3)->create(['inspection_id' => $inspection->id]);

        $response = $this->getJson(route('inspections.grades.index', $inspection));

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
    public function it_can_show_a_grade_for_inspection()
    {
        $inspection = Inspection::factory()->create();
        $grade = Grade::factory()->create(['inspection_id' => $inspection->id]);

        $response = $this->getJson(route('inspections.grades.show', [$inspection, $grade]));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $grade->id,
                    'inspection_id' => $grade->inspection_id,
                    'component_id' => $grade->component_id,
                    'grade_type_id' => $grade->grade_type_id
                ]
            ]);
    }

    /** @test */
    public function it_returns_empty_list_when_no_grades_exist_for_inspection()
    {
        $inspection = Inspection::factory()->create();

        $response = $this->getJson(route('inspections.grades.index', $inspection));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_grade_for_inspection()
    {
        $inspection = Inspection::factory()->create();
        $nonexistentGradeId = 999;

        $response = $this->getJson(route('inspections.grades.show', [$inspection, $nonexistentGradeId]));

        $response->assertStatus(404);
    }
}
