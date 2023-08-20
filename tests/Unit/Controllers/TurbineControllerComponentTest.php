<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Turbine;
use App\Models\Component;

/**
 * TurbineComponentControllerTest
 *
 * @group unit
 * @group http
 * @group turbine-component
 * @group controllers
 */
class TurbineComponentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_components_for_turbine()
    {
        $turbine = Turbine::factory()->create();

        Component::factory(3)->create(['turbine_id' => $turbine->id]);

        $response = $this->getJson(route('turbines.components.index', $turbine));

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'component_type_id',
                        'turbine_id',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_show_a_component_for_turbine()
    {
        $turbine = Turbine::factory()->create();
        $component = Component::factory()->create(['turbine_id' => $turbine->id]);

        $response = $this->getJson(route('turbines.components.show', [$turbine, $component]));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $component->id,
                    'component_type_id' => $component->component_type_id,
                    'turbine_id' => $component->turbine_id,
                ]
            ]);
    }

    /** @test */
    public function it_returns_empty_list_when_no_components_exist_for_turbine()
    {
        $turbine = Turbine::factory()->create();

        $response = $this->getJson(route('turbines.components.index', $turbine));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_component_for_turbine()
    {
        $turbine = Turbine::factory()->create();
        $nonexistentComponentId = 999;

        $response = $this->getJson(route('turbines.components.show', [$turbine, $nonexistentComponentId]));

        $response->assertStatus(404);
    }
}
