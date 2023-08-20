<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Component;

/**
 * ComponentControllerTest
 *
 * @group unit
 * @group http
 * @group component
 * @group controllers
 */
class ComponentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_components()
    {
        Component::factory(3)->create();

        $response = $this->getJson(route('components.index'));

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
    public function it_can_show_a_component()
    {
        $component = Component::factory()->create();

        $response = $this->getJson(route('components.show', $component));

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
    public function it_returns_empty_list_when_no_components_exist()
    {
        $response = $this->getJson(route('components.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_component()
    {
        $nonexistentId = 999;

        $response = $this->getJson(route('components.show', $nonexistentId));

        $response->assertStatus(404);
    }
}
