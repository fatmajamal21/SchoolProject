<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // افترض أن المستخدم مسجل دخول ويوجد عمود role في جدول users
        if (auth()->check() && auth()->user()->role === 'student') {
            return $next($request);
        }

        abort(403, 'غير مصرح بالدخول');
    }
}
