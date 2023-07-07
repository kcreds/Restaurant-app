<?php

use App\Models\User;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Carbon\Carbon;

class ReservationTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($admin);
    }

    public function testIndex()
    {
        $response = $this->get(route('admin.reservations.index'));

        $response->assertStatus(200);
        $response->assertViewHas('reservations');
    }

    public function testCreate()
    {
        $response = $this->get(route('admin.reservations.create'));

        $response->assertStatus(200);
        $response->assertViewHas('tables');
    }

    public function testStore()
    {
        $table = Table::factory()->create([
            'guest_number' => 4,
        ]);

        //Your Date, please custom
        $datetime = Carbon::parse('2023-07-09 11:00');

        $reservationData = Reservation::factory()->raw([
            'table_id' => $table->id,
            'guest_number' => 3,
            'reservation_date' => $datetime->format('Y-m-d H:i'),
        ]);

        $response = $this->post(route('admin.reservations.store'), $reservationData);

        $response->assertRedirect(route('admin.reservations.index'));
        $this->assertDatabaseHas('reservations', $reservationData);
    }

    public function testStoreWithInvalidGuestNumber()
    {
        $table = Table::factory()->create([
            'guest_number' => 4,
        ]);

        //Your Date, please custom
        $datetime = Carbon::parse('2023-07-09 11:00');

        $reservationData = Reservation::factory()->raw([
            'table_id' => $table->id,
            'guest_number' => 6,
            'reservation_date' => $datetime->format('Y-m-d H:i'),
        ]);

        $response = $this->post(route('admin.reservations.store'), $reservationData);

        $response->assertRedirect();
        $response->assertSessionHas('warning');
        $this->assertDatabaseMissing('reservations', $reservationData);
    }
}
