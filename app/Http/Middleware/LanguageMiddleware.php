<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;
use App;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     * Set EN locale for admin panel or selected locale for Website
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->is('admin*')
            ? 'en'
            : Session::get('locale', Config::get('app.locale'));

        App::setLocale($locale);

        return $next($request);
    }
}
