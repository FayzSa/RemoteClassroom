<?php

namespace App\Http\Middleware;

use App\Http\Controllers\FirebaseController;
use Closure;

class TeacherAuth
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
        if(session()->has('uid') && $student->isTeacher(session('uid')))
        return $next($request);
    else
        return redirect('/login');
    }
}
