<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Farm;

/**
 * FarmControllerTest
 *
 * @group unit
 * @group http
 * @group farm
 * @group controllers
 */
class FarmControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_farms()
    {
        Farm::factory(3)->create();

        $response = $this->getJson(route('farms.index'));

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
    public function it_can_show_a_farm()
    {
        $farm = Farm::factory()->create();

        $response = $this->getJson(route('farms.show', $farm));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $farm->id,
                    'name' => $farm->name,
                ]
            ]);
    }

    /** @test */
    public function it_returns_empty_list_when_no_farms_exist()
    {
        $response = $this->getJson(route('farms.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    /** @test */
    public function it_returns_404_when_showing_nonexistent_farm()
    {
        $nonexistentId = 999;

        $response = $this->getJson(route('farms.show', $nonexistentId));

        $response->assertStatus(404);
    }
}
