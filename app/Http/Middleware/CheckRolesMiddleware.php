<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $names = [];       
        if (isset($user)) {
            $roles = $user->roles()->get();
            foreach ($roles as $role) {
                $names[] = $role->name;
            }
            if (empty($names)) {
                $names = ['User'];
            }
        }
        $request->attributes->add(['roles' => $names]);
        return $next($request);
    }
}
