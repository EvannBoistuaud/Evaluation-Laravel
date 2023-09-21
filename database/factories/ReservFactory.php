<?php

namespace Database\Factories;

use App\Models\Salle;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero'=>fake()->numberBetween(1,300),
            'date_reservation'=>fake()->date(),
            'heure_reservation'=>fake()->time(),
            'prix'=>fake()->randomFloat(2, 1, 999),
            'nombre_place'=>fake()->numberBetween(1,300),
            'salle_id' => Salle::factory()->create(),
            'client_id' => Client::factory()->create(),
        ];
    }
}


