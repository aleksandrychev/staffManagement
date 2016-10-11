<?php

namespace App\Http\Middleware;

use Closure;

class SetUserId
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
        $request->replace(array_merge(['user_id' => $request->user()->id],$request->all()));

        return $next($request);
    }
}
