<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionPlan>
 */
class SubscriptionPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Test Plan',
            'slug' => 'test-plan-' . fake()->unique()->word(),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 100, 500),
            'period' => fake()->randomElement(['monthly', 'quarterly', 'annual']),
            'property_limit' => fake()->numberBetween(5, 20),
            'highlight_limit' => fake()->numberBetween(0, 3),
            'features' => ['feature1', 'feature2'],
            'active' => true,
        ];
    }
}
