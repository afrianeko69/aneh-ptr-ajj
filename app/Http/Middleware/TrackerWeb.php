<?php

namespace App\Http\Middleware;

use App\Tracker;
use Closure;
use Cookie;
use URL;
use Request;

class TrackerWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    CONST NOT_ALLOWED_AGENT = ['Googlebot', 'AdsBot', 'TelegramBot', 'Veritrans', 'Postman', 'Yahoo! Slurp' ,'bingbot'];
    public function handle($request, Closure $next)
    {
        if (empty(Cookie::get('source_id')) && !strposa(Request::header('User-Agent'), self::NOT_ALLOWED_AGENT)){

            $source_id = sha1(time());
            Cookie::queue('source_id', $source_id);
            Cookie::queue('initial_url', URL::current() . Request::getPathInfo() . (Request::getQueryString() ? ('?' . Request::getQueryString()) : ''));
            Tracker::updateTracker('landing_page', '', $source_id );

            if (!empty($request->get('utm_source'))){
                Cookie::queue('utm_source', $request->get('utm_source'));
            }
            if (!empty($request->get('utm_campaign'))){
                Cookie::queue('utm_campaign', $request->get('utm_campaign'));
            }
            if (!empty($request->get('utm_term'))){
                Cookie::queue('utm_term', $request->get('utm_term'));
            }
            if (!empty($request->get('utm_medium'))){
                Cookie::queue('utm_medium', $request->get('utm_medium'));
            }
            if (!empty($request->get('utm_content'))){
                Cookie::queue('utm_content', $request->get('utm_content'));
            }
        }
        return $next($request);
    }
}
