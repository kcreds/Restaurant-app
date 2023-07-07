<?php
namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'phone_number' => $this->faker->phoneNumber(),
            'reservation_date' => $this->faker->date(),
            'table_id' => $this->faker->numberBetween(1, 10),
            'guest_number' => $this->faker->numberBetween(1, 10),
        ];
    }
}
