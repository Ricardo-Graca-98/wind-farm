<?php

namespace Database\Seeders;

use App\Models\ComponentType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComponentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ComponentType::factory(4)
            ->state(new Sequence(
                ['name' => 'Blade'],
                ['name' => 'Rotor'],
                ['name' => 'Hub'],
                ['name' => 'Generator']
            ))
            ->create();
    }
}
