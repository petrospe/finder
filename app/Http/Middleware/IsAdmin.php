<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()->role == 'admin') {
         return $next($request);
       } else {
         // return response()->json('Unauthorized', 401);
         return response()->json('Forbidden', 403);
         // return abort(403, 'Forbidden');
       }
    }
}
