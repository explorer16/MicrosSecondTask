<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'parent_id' => Category::count() > 0
                ? $this->faker->optional(0.2)->randomElement(Category::pluck('id')->toArray())
                : null,
            'created_by' => User::query()->inRandomOrder()->first()->id
        ];
    }
}
