<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $activeOrders = Order::where('status', 'Active')->count();

        $today = Carbon::today()->toDateString();
        $activeReservations= Reservation::whereDate('reservation_date', '>=', $today)->count();

        return view('admin.index', compact('activeOrders', 'activeReservations'));
    }
}
