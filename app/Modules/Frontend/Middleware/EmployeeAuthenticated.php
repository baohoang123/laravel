<?php

namespace App\Modules\Frontend\Middleware;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class EmployeeAuthenticated
{
    protected $guard;

    public function __construct()
    {
        $this->guard = Auth::guard('employee'); 
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
           
         if(!$request->is('admin') || !$request->is('admin/*')){
                //return redirect()->guest('login');

                $this->guard->authenticate();
                
                return $next($request);
            }
        return $next($request);
    }
}
