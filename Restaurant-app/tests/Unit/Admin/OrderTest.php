<?php

use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderTest extends TestCase
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
        Order::factory()->count(5)->create();

        $response = $this->get(route('admin.orders.index'));

        $response->assertStatus(200);
        $response->assertViewHas('orders');
    }

    public function testChangeOrderStatus()
    {
        $order = Order::factory()->create(['status' => 'Active']);

        $response = $this->get(route('admin.orders.edit', $order));

        $response->assertRedirect(route('admin.orders.index'));
        $this->assertEquals('Done', $order->fresh()->status);
        $this->assertTrue(session()->has('success'));
    }

    public function testChangeOrderStatusChanged()
    {
        $order = Order::factory()->create(['status' => 'Done']);

        $response = $this->get(route('admin.orders.edit', $order));

        $response->assertRedirect(route('admin.orders.index'));
        $this->assertEquals('Done', $order->fresh()->status);
        $this->assertTrue(session()->has('warning'));
    }

    public function testDestroy()
    {
        $order = Order::factory()->create(['status' => 'Done']);

        $response = $this->delete(route('admin.orders.destroy', $order));

        $response->assertRedirect(route('admin.orders.index'));
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
        $this->assertTrue(session()->has('danger'));
    }

    public function testDestroyOrderStatusActive()
    {
        $order = Order::factory()->create(['status' => 'Active']);

        $response = $this->delete(route('admin.orders.destroy', $order));

        $response->assertRedirect(route('admin.orders.index'));
        $this->assertDatabaseHas('orders', ['id' => $order->id]);
        $this->assertTrue(session()->has('warning'));
    }
}
