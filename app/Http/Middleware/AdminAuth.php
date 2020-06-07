<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FirebaseController;
use Closure;
use Session;
class AdminAuth
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
        $admin =new FirebaseController();
        if(session()->has('uid') && $admin->isAdmin(session('uid')))
        return $next($request);
    else
        return redirect('/login');


       
    }
}
