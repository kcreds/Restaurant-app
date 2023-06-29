<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomController extends Controller
{
    public function index()
    {
        $specials = Category::where('name', 'specials')->first();

        return view('welcome', compact('specials'));
    }

    public function success()
    {
        return view('success');
    }
}
