<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function stepOne(Request $request)
    {
        $order = $request->session()->get('order');
        return view('orders.step-one', compact('order'));
    }

    public function stepTwo(Request $request)
    {
        if (empty($request->session()->get('order'))) {
            return redirect()->route('orders.step.one');
        }

        $products = Menu::all();
        $order = $request->session()->get('order');
        return view('orders.step-two', compact('order', 'products'));
    }

    public function storeStepOne(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['required'],
            'street' => ['required'],
            'city' => ['required'],
            'post_code' => ['required'],
        ]);

        if (empty($request->session()->get('order'))) {
            $order = new Order();
            $order->fill($validated);
            $request->session()->put('order', $order);
        } else {
            $order = $request->session()->get('order');
            $order->fill($validated);
            $request->session()->put('order', $order);
        }

        return to_route('orders.step.two');
    }

    public function storeStepTwo(Request $request)
    {

        $validated = $request->validate([
            'selected_products' => ['required', 'array'],
            'order_price' => ['required'],
            'selected_products.*' => ['exists:menus,id'],
            'product_quantity' => ['required', 'array'],
            'product_quantity.*' => ['required', 'integer', 'min:1'],
        ]);

        if (empty($request->session()->get('order'))) {
            return redirect()->route('orders.step.one');
        } else {
            $order = $request->session()->get('order');
            $order->fill($validated);
            $request->session()->put('order', $order);
        }

        $order_number = now()->format('YmdHis');
        $order->order_number = $order_number;
        $order->status = 'Active';

        $order->save();

        if ($request->has('selected_products')) {
            $products = $request->selected_products;
            $productQuantities = $request->product_quantity;

            foreach ($products as $productId) {
                $menu_id = $productId;
                $quantity = $productQuantities[$productId];

                $order->menu()->attach($menu_id, ['quantity' => $quantity]);
            }
        }

        $order->fill($validated);
        $order->save();

        $request->session()->forget('order');

        return to_route('order.success');
    }
}
