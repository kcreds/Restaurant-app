<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class TrackVisits
{
    public function handle($request, Closure $next)
    {
        $visits = Session::get('visits', 0);
        $lastVisitDate = Session::get('last_visit_date');

        if (!$lastVisitDate || now()->diffInDays($lastVisitDate) > 0) {
            $visits++;
            Session::put('visits', $visits);
            Session::put('last_visit_date', now());
        }

        return $next($request);
    }
}
