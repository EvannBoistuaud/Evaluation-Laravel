<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Config;
use Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (session::has('locale')) { Au choix
        if (session('locale') !== null) {
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale(Config::get('app.locale'));
        }

        return $next($request);
    }
}
