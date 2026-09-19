<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        // Default guard agar empty ho
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard === "student") {
                    return redirect()->route('student.dashboard.index');
                } elseif ($guard === "web") {
                    return redirect()->route('admin.dashboard.index');
                } else {
                    return redirect()->route('admin.dashboard.index');
                }
            }
        }

        return $next($request);
    }
}
