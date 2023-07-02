<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        if ($order->status == "Active") {
            $order->status = "Done";
            $order->save();
            return to_route('admin.orders.index')->with('success', 'Order status changed');
        } else {
            return to_route('admin.orders.index')->with('warning', 'Order status has already been changed');
        } 
    }


    public function destroy(Order $order)
    {
        if ($order->status == "Active") {
            return to_route('admin.orders.index')->with('warning', 'Order status must be done');
        } else {
            $order->delete();
        }


        return to_route('admin.orders.index')->with('danger', 'Reservation deleted successfuly');
    }
}
