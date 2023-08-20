<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ComponentType;

/**
 * ComponentTypeControllerTest
 *
 * @group unit
 * @group http
 * @group component-type
 * @group controllers
 */
class ComponentTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_component_types()
    {
        ComponentType::factory(3)->create();

        $response = $this->getJson(route('component-types.index'));

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_show_a_component_type()
    {
        $componentType = ComponentType::factory()->create();

        $response = $this->getJson(route('component-types.show', $componentType));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $componentType->id,
                    'name' => $componentType->name,
                ]
            ]);
    }

    /** @test */
    public function it_returns_empty_list_when_no_component_types_exist()
    {
        $response = $this->getJson(route('component-types.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_component_type()
    {
        $nonexistentId = 999;

        $response = $this->getJson(route('component-types.show', $nonexistentId));

        $response->assertStatus(404);
    }
}
