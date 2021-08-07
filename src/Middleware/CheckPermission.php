<?php

namespace ConfrariaWeb\Acl\Middleware;

use Closure;

class CheckPermission
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
        $routeMiddleware = $request->route()->middleware();
        $getRouteName = $request->route()->getName();
        if (
            in_array('auth', $routeMiddleware) &&
            !in_array($getRouteName, ['logout'])
        ) {
            abort_unless($request->user()->hasPermission($getRouteName), 403);
        }
        return $next($request);
    }
}
