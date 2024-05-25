<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subbudget>
 */
class SubbudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'budget_id'=> $this->faker->numberBetween(2,6),
            'name'=> $this->faker->name(), 
            'amount'=> $this->faker->randomFloat(2, 10, 250),
            'user_id'=> 1
        ];
    }
}
