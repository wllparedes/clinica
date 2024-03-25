<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } else {
            if (is_array($roles)) {
                foreach ($roles as $role) {
                    if (Auth::user()->role == $role) {
                        return $next($request);
                    }
                }
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
