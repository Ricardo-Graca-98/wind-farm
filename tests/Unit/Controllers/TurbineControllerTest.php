<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Turbine;

/**
 * TurbineControllerTest
 *
 * @group unit
 * @group http
 * @group turbine
 * @group controllers
 */
class TurbineControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_turbines()
    {
        Turbine::factory(3)->create();

        $response = $this->getJson(route('turbines.index'));

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
    public function it_can_show_a_turbine()
    {
        $turbine = Turbine::factory()->create();

        $response = $this->getJson(route('turbines.show', $turbine));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $turbine->id,
                    'name' => $turbine->name,
                    'farm_id' => $turbine->farm_id,
                    'lat' => $turbine->lat,
                    'lng' => $turbine->lng,
                ]
            ]);
    }

    /** @test */
    public function it_returns_empty_list_when_no_turbines_exist()
    {
        $response = $this->getJson(route('turbines.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_turbine()
    {
        $nonexistentTurbineId = 999;

        $response = $this->getJson(route('turbines.show', $nonexistentTurbineId));

        $response->assertStatus(404);
    }
}
