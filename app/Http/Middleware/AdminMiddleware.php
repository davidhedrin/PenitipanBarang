<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->user_type === 'ADM' && Auth::user()->flag_active === 'Y'){
            return $next($request);
        }
        else{
            session()->flush();
            session()->flash('msgExcLogin', 'Ops... Anda tidak diijinkan untuk mengakses halaman tersebut. Maaf, kami harus mengeluarkan anda. Terimakasih!');
            return redirect()->route('login');
        }
        return $next($request);
    }
}
