<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class AdminMiddleware
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
        if ($request->user()->is_admin != 1) {
            return redirect()->back()->withErrors('权限不足');
        }
        return $next($request);
    }
}
