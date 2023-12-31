<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckAdmine
{
   
    public function handle(Request $request, Closure $next)
    {
        $user=Auth::user();
        if($user==null){
            return redirect()->route('login');
        }
        else if ($user->role == 'admin')
        {
            return $next($request);
        }
        else{
            return redirect()->route('home');
        }
       
    }
}
