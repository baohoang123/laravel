<?php

namespace App\Modules\Backend\Middleware;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $guard;

    public function __construct()
    {
        $this->guard = Auth::guard('admin');
    }

    public function handle($request, Closure $next)
    {
         // $base_url = $request->Url();
         if($request->is('admin') || $request->is('admin/*'))
         {
            $this->guard->authenticate();
            return $next($request);
         }

        return $next($request);
    }
}
