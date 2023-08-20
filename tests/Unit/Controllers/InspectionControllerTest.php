<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Inspection;

/**
 * InspectionControllerTest
 *
 * @group unit
 * @group http
 * @group inspection
 * @group controllers
 */
class InspectionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_inspections()
    {
        Inspection::factory(3)->create();

        $response = $this->getJson(route('inspections.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'turbine_id',
                        'inspected_at',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_show_an_inspection()
    {
        $inspection = Inspection::factory()->create();

        $response = $this->getJson(route('inspections.show', $inspection));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $inspection->id,
                    'turbine_id' => $inspection->turbine_id,
                    'inspected_at' => $inspection->inspected_at->format('Y-m-d H:i:s'),
                ]
            ]);
    }

    /** @test */
    public function it_returns_empty_list_when_no_inspections_exist()
    {
        $response = $this->getJson(route('inspections.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_inspection()
    {
        $nonexistentId = 999;

        $response = $this->getJson(route('inspections.show', $nonexistentId));

        $response->assertStatus(404);
    }
}
