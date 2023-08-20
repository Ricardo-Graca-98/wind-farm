<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\GradeType;

/**
 * GradeTypeControllerTest
 *
 * @group unit
 * @group http
 * @group grade-type
 * @group controllers
 */
class GradeTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_grade_types()
    {
        GradeType::factory(3)->create();

        $response = $this->getJson(route('grade-types.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_show_a_grade_type()
    {
        $gradeType = GradeType::factory()->create();

        $response = $this->getJson(route('grade-types.show', $gradeType));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $gradeType->id,
                    'name' => $gradeType->name
                ]
            ]);
    }

    /** @test */
    public function it_returns_empty_list_when_no_grade_types_exist()
    {
        $response = $this->getJson(route('grade-types.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_grade_type()
    {
        $nonexistentId = 999;

        $response = $this->getJson(route('grade-types.show', $nonexistentId));

        $response->assertStatus(404);
    }
}
