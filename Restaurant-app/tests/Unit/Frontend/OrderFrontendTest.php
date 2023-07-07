<?php

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class OrderFrontendTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function testStepOne()
    {
        $order = Order::factory()->make();
        Session::put('order', $order);

        $response = $this->get(route('orders.step.one'));

        $response->assertStatus(200);
        $response->assertViewHas('order', $order);
    }

    public function testStepTwoWithoutOrder()
    {
        $response = $this->get(route('orders.step.two'));

        $response->assertRedirect(route('orders.step.one'));
    }

    public function testStepTwoWithOrder()
    {
        $order = Order::factory()->make();
        Session::put('order', $order);
        $products = Menu::factory()->count(3)->create();

        $response = $this->get(route('orders.step.two'));

        $response->assertStatus(200);
        $response->assertViewHas('order', $order);
        $response->assertViewHas('products', $products);
    }

    public function testStoreStepOneWithoutOrder()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'post_code' => $this->faker->postcode,
        ];

        $response = $this->post(route('orders.store.step.one'), $data);

        $response->assertRedirect(route('orders.step.two'));
        $this->assertEquals(session('order')->first_name, $data['first_name']);
    }

    public function testStoreStepOneWithOrder()
    {
        $order = Order::factory()->make();
        Session::put('order', $order);
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'post_code' => $this->faker->postcode,
        ];

        $response = $this->post(route('orders.store.step.one'), $data);

        $response->assertRedirect(route('orders.step.two'));
        $this->assertEquals(session('order')->first_name, $data['first_name']);
    }

    public function testStoreStepTwoWithoutStepOne()
    {
        $response = $this->get(route('orders.store.step.two'), [
            'selected_products' => [],
            'order_price' => 0,
            'product_quantity' => [],
        ]);

        $response->assertRedirect(route('orders.step.one'));
    }

    public function testStoreStepTwoWithOrder()
    {
        $order = Order::factory()->create();
        $products = Menu::factory()->count(3)->create();

        $data = [
            'selected_products' => $products->pluck('id')->toArray(),
            'order_price' => 100,
            'product_quantity' => [
                $products[0]->id => 2,
                $products[1]->id => 1,
                $products[2]->id => 3,
            ],
        ];

        Session::put('order', $order);

        $response = $this->post(route('orders.store.step.two'), $data);

        $response->assertRedirect(route('order.success'));
        $this->assertDatabaseHas('orders', [
            'order_number' => $order->order_number,
            'status' => 'Active',
        ]);
        $this->assertDatabaseCount('order_product', count($data['selected_products']));
    }
}
