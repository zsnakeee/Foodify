<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        session()->has('locale') ?
            app()->setLocale(session('locale')) :
            app()->setLocale(config('app.locale'));

        session()->has('currency') ?
            config(['app.currency' => session('currency')]) :
            config(['app.currency' => config('app.currency')]);

        Number::useLocale(app()->getLocale());
        return $next($request);
    }
}
