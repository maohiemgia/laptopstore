<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    //  xử lý phân quyền
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        // 1 la role cua admin
        if ($user->role == 1) {

            return $next($request);
        }

        redirect(route('logout'));
    }
}
