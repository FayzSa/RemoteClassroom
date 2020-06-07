<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FirebaseController;
use Closure;

class StudentAuth
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
        $student =new FirebaseController();
        if(session()->has('uid') && $student->isStudent(session('uid')))
        return $next($request);
    else
        return redirect('/login');
    }
}
