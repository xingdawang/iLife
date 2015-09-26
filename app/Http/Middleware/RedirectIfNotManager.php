<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotManager
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
        $user_state = $request->user()->isManager();
        if ($user_state == 0)
            return redirect('articles');
        if ($user_state == 1)
            return $next($request);
    }
}
