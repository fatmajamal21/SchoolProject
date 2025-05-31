<?php

namespace App\Http\Middleware;

use App\Models\Teacher;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user || !Teacher::where('user_id', $user->id)->exits()) {
            abort(403, 'غير مسموح بدخولك');
        }
        // افترض أن المستخدم مسجل دخول ويوجد عمود role في جدول users
        if (auth()->check() && auth()->user()->role === 'teacher') {
            return $next($request);
        }

        abort(403, 'غير مصرح بالدخول');
    }
}
