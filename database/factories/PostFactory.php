<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake();

        // $name = $this->faker->name();
        $name = $this->faker->sentence;
        
        return [
            'title' => $name,
            'slug' => Str($name)->slug(),
            'content' => fake()->paragraph(3,true),
            'description' => $this->faker->paragraph(20,true),
            'category_id' => $this->faker->randomElement([1,4,5,6,2,10]),
            'posted' => $this->faker->randomElement(['yes','not']),
            'image' =>$this->faker->imageUrl(),
            'user_id' => $this->faker->randomElement([1,2]),
        ];
    }
}
 