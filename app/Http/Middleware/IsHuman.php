<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class IsHuman
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
        if ($request->getPathInfo() === '/logout' || ! auth('web')->check()) {
            return $next($request);
        }

        if (auth('web')->user()->isRobot() && ! preg_match('/\brobot\b/', $request->getPathInfo())) {
            return redirect(route('view.register.robot'));
        }

        return $next($request);
    }
}
