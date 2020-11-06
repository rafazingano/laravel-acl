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
        if (in_array('auth', $request->route()->middleware())) {
            abort_unless($request->user()->hasPermission($request->route()->getName()), 403);
        }
        return $next($request);
    }
}
