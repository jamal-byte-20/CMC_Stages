<?php

namespace Database\Factories;

use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Opportunity>
 */
class OpportunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // generate faker data
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
    
            'niveau' => $this->faker->word(),
            'profil_requis' => $this->faker->word(),
            'ville' => $this->faker->city(),
        ];
    }
}
