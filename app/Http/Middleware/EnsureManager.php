<?php

namespace App\Http\Middleware;

use App\Models\Invuser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $username = '';
        if(session()->has("username")){
            $username = session()->get("username");
        } else {
            return redirect('/login')->with("error","Invalid Authentication");
        }

        $user = Invuser::where("username", $username)->first();

        if($user->role != 3){
            return redirect('/')->with("error","Authorization not high enough");
        }

        return $next($request);
    }
}
