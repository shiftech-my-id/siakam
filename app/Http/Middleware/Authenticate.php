<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // ignore access to login page
        if ($request->path() == route('auth.login') && $user) {
            if (
                $user->role == User::ADMINISTRATOR
                || $user->role == User::OPERATOR
                || $user->role == User::TEACHER
            ) {
                return redirect('/admin');
            }
            return redirect('/');
        } else if (!$user) {
            return redirect(route('auth.login'));
        }

        return $next($request);
    }
}
