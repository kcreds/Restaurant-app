<?php
namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'order_number' => $this->faker->randomNumber(5),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'phone_number' => $this->faker->phoneNumber(),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'post_code' => $this->faker->postcode(),
            'order_price' => $this->faker->randomNumber(2),
            'status' => $this->faker->randomElement(['Active', 'Done']),
        ];
    }
}
