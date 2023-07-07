<?php
namespace Database\Factories;

use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'guest_number' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['Pending', 'Avaliable', 'Unavaliable']),
            'location' => $this->faker->randomElement(['Front', 'Inside', 'Outside']),
        ];
    }
}
