<?php

use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReservationFrontendTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function testStepOne()
    {
        $response = $this->get(route('reservations.step.one'));

        $response->assertStatus(200);
        $response->assertViewIs('reservations.step-one');
        $response->assertViewHas(['reservation', 'min_date', 'max_date']);
    }

    public function testStepTwoWithoutReservation()
    {
        $response = $this->get(route('reservations.step.two'));

        $response->assertRedirect(route('reservations.step.one'));
    }


    public function testStepTwoWithReservation()
    {
        $reservation_date = Carbon::createFromFormat('Y-m-d H:i', '2023-07-09 11:00');

        $table1 = Table::factory()->create(['status' => 'Available', 'guest_number' => 8]);

        $reservation = Reservation::factory()->create(['reservation_date' => $reservation_date, 'table_id' => $table1->id]);

        $this->withSession([
            'reservation' => $reservation,
        ]);

        $response = $this->get(route('reservations.step.two'));

        $response->assertStatus(200);
        $response->assertViewIs('reservations.step-two');
        $response->assertViewHas(['reservation', 'tables']);
        $response->assertViewHas('reservation', function ($value) use ($reservation_date) {
            return $value->reservation_date->equalTo($reservation_date);
        }); 
    }

    public function testStoreStepTwo()
    {
        $reservation = Reservation::create([
            'first_name' => 'first',
            'last_name' => 'last',
            'email' => '123@123.com',
            'reservation_date' => '2023-07-08',
            'phone_number' => '123456789',
            'table_id' => 4,
            'guest_number' => 4,
        ]);

        $this->session(['reservation' => $reservation]);

        $table = Table::factory()->create();

        $data = [
            'table_id' => $table->id,
        ];

        $response = $this->post(route('reservations.store.step.two'), $data);

        $response->assertRedirect(route('reservation.success'));

        $this->assertDatabaseHas('reservations', [
            'id' => $reservation->id,
            'table_id' => $table->id,
        ]);

        $this->assertDatabaseMissing('reservations', [
            'id' => $reservation->id,
            'table_id' => null,
        ]);

        $this->assertFalse(session()->has('reservation'));
    }
}
