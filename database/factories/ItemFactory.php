<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->text,
            'quantity' => $this->faker->numberBetween(1, 100),
            'supplier_id' => Supplier::inRandomOrder()->first()->id,
            'date_received' => $this->faker->date(),
            'transaction_number' => $this->faker->uuid,
        ];
    }
}
