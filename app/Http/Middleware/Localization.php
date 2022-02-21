<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        if (session()->has('locale')) {
//        //     // set laravel localization
//            App::setLocale(session()->get('locale'));
//        }

        LaravelLocalization::setLocale('ar');
        if(isset($request->lang)&&$request->lang=='en')
            LaravelLocalization::setLocale('en');

        return $next($request);

    }
}
