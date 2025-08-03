<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OnlyGuest
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Jika sudah login, redirect ke dashboard
            return redirect()->route('staf.index');
        }

        return $next($request);
    }
}
