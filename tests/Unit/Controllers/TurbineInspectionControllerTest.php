<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Turbine;
use App\Models\Inspection;

/**
 * TurbineInspectionControllerTest
 *
 * @group unit
 * @group http
 * @group turbine-inspection
 * @group controllers
 */
class TurbineInspectionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_inspections_for_turbine()
    {
        $turbine = Turbine::factory()->create();
        $inspections = Inspection::factory(3)->create(['turbine_id' => $turbine->id]);

        $response = $this->getJson(route('turbines.inspections.index', $turbine));

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
    public function it_can_show_an_inspection_for_turbine()
    {
        $turbine = Turbine::factory()->create();
        $inspection = Inspection::factory()->create(['turbine_id' => $turbine->id]);

        $response = $this->getJson(route('turbines.inspections.show', [$turbine, $inspection]));

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
    public function it_returns_empty_list_when_no_inspections_exist_for_turbine()
    {
        $turbine = Turbine::factory()->create();

        $response = $this->getJson(route('turbines.inspections.index', $turbine));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_inspection_for_turbine()
    {
        $turbine = Turbine::factory()->create();
        $nonexistentInspectionId = 999;

        $response = $this->getJson(route('turbines.inspections.show', [$turbine, $nonexistentInspectionId]));

        $response->assertStatus(404);
    }
}
