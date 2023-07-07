<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;

class WelcomController extends Controller
{
    public function index()
    {
        $specials = Category::where('name', 'specials')->first();
        return view('welcome', compact('specials'));
        
    }

    public function reservationSuccess()
    {
        $reservation = Reservation::latest()->first();
        return view('success', compact('reservation'));
    }

    public function orderSuccess()
    {
        $order = Order::latest()->first();
        return view('success', compact('order'));
    }
}
