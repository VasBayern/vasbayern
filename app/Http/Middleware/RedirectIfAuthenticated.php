<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        Session::put('url.intended', URL::previous());
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    \Toastr::success('Xin chào');
                    return redirect()->route('admin.dashboard');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    \Toastr::success('Xin chào');
                    return Redirect::to(Session::get('url.intended'));
                }
                break;
        }
        return $next($request);
    }
}
