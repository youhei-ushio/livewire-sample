<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterProduct>
 */
class MasterProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word;
        return [
            'name' => $name,
            'price' => $this->faker->numberBetween(10, 50000),
            'description' => $this->faker->realText,
        ];
    }

    public function withImage(): self
    {
        return $this->state(fn (array $attributes) => [
            'image_name' => $this->faker->image(
                storage_path('app/public/images/products'),
                320,
                240,
                '',
                false,
                false,
                $attributes['name'],
                true
            ),
        ]);
    }
}
