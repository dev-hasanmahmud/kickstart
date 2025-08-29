<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Traits\RedisCachable;

class EnsureUserAccessIsValid
{
    use RedisCachable;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::check() ? Auth::user() : null;
        $roleId = $user ? $user->role_id : 1;
        $cacheKey = "role_permissions:{$roleId}";
        $permissions = $this->redisGet($cacheKey, []);
        $currentRouteName = $request->route()?->getName();

        if (!$currentRouteName) {
            abort(403, "Unauthorized: You do not have permission to access this resource.");
        }

        if (!in_array($currentRouteName, $permissions)) {
            abort(403, "Unauthorized: You do not have permission to access this resource.");
        }

        return $next($request);
    }
}
