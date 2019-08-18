<?php

namespace App\Http\Middleware;

use Closure;

class Cek_session
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
        if(!$request->session()->get('success'))
            return redirect()->route('login')->with('status', 'Unathorized');
        return $next($request);
    }
}
