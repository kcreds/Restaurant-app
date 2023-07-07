<?php
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => str_repeat($this->faker->sentence(1), 5),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
