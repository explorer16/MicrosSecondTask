<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(4, true),
            'description' => $this->faker->text(100),
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'supplier_id' => Supplier::query()->inRandomOrder()->first()->id,
            'price' => $this->faker->randomFloat(2, 10000, 1000000),
//            'file_url' => 'files/' . $this->faker->uuid() . '.' . $this->faker->randomElement(['jpg', 'png', 'jpeg']),
            'created_by' => User::query()->inRandomOrder()->first()->id,
        ];
    }
}
