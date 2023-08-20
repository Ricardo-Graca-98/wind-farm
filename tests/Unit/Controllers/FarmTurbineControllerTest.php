<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Farm;
use App\Models\Turbine;

/**
 * FarmTurbineControllerTest
 *
 * @group unit
 * @group http
 * @group farm-turbine
 * @group controllers
 */
class FarmTurbineControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_turbines_for_farm()
    {
        $farm = Farm::factory()->create();
        Turbine::factory(3)->create(['farm_id' => $farm->id]);

        $response = $this->getJson(route('farms.turbines.index', $farm));

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'farm_id',
                        'lat',
                        'lng',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_show_a_turbine_for_farm()
    {
        $farm = Farm::factory()->create();
        $turbine = Turbine::factory()->create(['farm_id' => $farm->id]);

        $response = $this->getJson(route('farms.turbines.show', [$farm, $turbine]));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $turbine->id,
                    'name' => $turbine->name,
                    'farm_id' => $turbine->farm_id,
                    'lat' => $turbine->lat,
                    'lng' => $turbine->lng
                ]
            ]);
    }

    /** @test */
    public function it_returns_empty_list_when_no_turbines_exist_for_farm()
    {
        $farm = Farm::factory()->create();

        $response = $this->getJson(route('farms.turbines.index', $farm));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_turbine_for_farm()
    {
        $farm = Farm::factory()->create();
        $nonexistentTurbineId = 999;

        $response = $this->getJson(route('farms.turbines.show', [$farm, $nonexistentTurbineId]));

        $response->assertStatus(404);
    }
}
