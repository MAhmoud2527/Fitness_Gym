<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkLoginTrainee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('gym')->check() && auth('gym')->user()->usertype_id == 4) {
            return $next($request);
        } else {
            return redirect(url('/login'));
        }
    }
}
