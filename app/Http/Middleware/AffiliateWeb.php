<?php

namespace App\Http\Middleware;

use App\Affiliate;
use Cache;
use Closure;

class AffiliateWeb
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
        $host = $request->server->get('HTTP_HOST');
        $affiliate = Affiliate::where(function($query) use ($host) {
            $query->where('domain_url', '=', $host)
                ->orWhere('logged_in_domain_url', '=', $host);
        })
        ->select([
                'id', 'name', 'domain_url','logo', 'logged_in_domain_url'
                , 'oauth_client_id', 'oauth_secret', 'favicon', 'site_title'
            ])
        ->first();

        if( $affiliate && (!in_array($request->url(), [route('sso.callback'), route('daftar.callback')])) && ($request->server->get('HTTP_HOST') === $affiliate->logged_in_domain_url) && (\Auth::guest())) {
            return redirect($affiliate->full_domain_url);
        }

        if (!empty($affiliate)){
            $request->attributes->add(['app_affiliate_id' => $affiliate->id]);
            $request->attributes->add(['app_affiliate_domain_url' => $affiliate->domain_url]);
            $request->attributes->add(['app_affiliate_name' => $affiliate->name]);
            $request->attributes->add(['app_affiliate_logo' => asset_cdn($affiliate->logo)]);
            $request->attributes->add(['app_affiliate_logged_in_domain_url' => $affiliate->logged_in_domain_url]);
            $request->attributes->add(['app_affiliate_oauth_client_id' => $affiliate->oauth_client_id]);
            $request->attributes->add(['app_affiliate_oauth_secret' => $affiliate->oauth_secret]);
            $request->attributes->add(['app_affiliate_full_logged_in_domain_url' => $affiliate->full_logged_in_domain_url]);
            $request->attributes->add(['app_affiliate_full_domain_url' => $affiliate->full_domain_url]);
            $request->attributes->add(['app_affiliate_favicon' => asset_cdn($affiliate->favicon)]);
            $request->attributes->add(['app_affiliate_site_title' => $affiliate->site_title]);
        }

        return $next($request);
    }
}
