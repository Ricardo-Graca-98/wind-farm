<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Grade;

/**
 * GradeControllerTest
 *
 * @group unit
 * @group http
 * @group grade
 * @group controllers
 */
class GradeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_grades()
    {
        $grades = Grade::factory(3)->create();

        $response = $this->getJson(route('grades.index'));

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
    public function it_can_show_a_grade()
    {
        $grade = Grade::factory()->create();

        $response = $this->getJson(route('grades.show', $grade));

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
    public function it_returns_empty_list_when_no_grades_exist()
    {
        $response = $this->getJson(route('grades.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_grade()
    {
        $nonexistentId = 999;

        $response = $this->getJson(route('grades.show', $nonexistentId));

        $response->assertStatus(404);
    }
}
