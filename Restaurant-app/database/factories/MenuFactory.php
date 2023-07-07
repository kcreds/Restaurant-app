<?php
namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => str_repeat($this->faker->sentence(1), 5),
            'image' => $this->faker->image(),
            'price' => $this->faker->randomNumber(2),
        ];
    }
}
