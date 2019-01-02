<?php

namespace App\Http\Middleware;

use App\Affiliate;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class AffiliateAdmin
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
        if (Auth::guard()->guest()) {
            return redirect()->guest('/administration');
        }

        $host = $request->server->get('HTTP_HOST');
        $affiliate = Affiliate::where(function($query) use ($host) {
            $query->where('domain_url', '=', $host)
                ->orWhere('logged_in_domain_url', '=', $host);
        })
        ->select([
                'id', 'name', 'domain_url','logo','favicon', 'site_title'
            ])
        ->first();

        if (!empty($affiliate) && ( empty(Auth::user()->affiliate_id) || (Auth::user()->affiliate_id != $affiliate->id) ) ){
            Session::flash('message-error', 'You are not authorized to access this Affiliate domain. Check your Affiliate domain to confirm');
            return redirect()->guest('/administration');
        }
        
        if (!empty($affiliate)){
            $request->attributes->add(['app_affiliate_id' => $affiliate->id]);
            $request->attributes->add(['app_affiliate_domain_url' => $affiliate->domain_url]);
            $request->attributes->add(['app_affiliate_name' => $affiliate->name]);
            $request->attributes->add(['app_affiliate_logo' => asset_cdn($affiliate->logo)]);
            $request->attributes->add(['app_affiliate_site_title' => $affiliate->site_title]);
            $request->attributes->add(['app_affiliate_favicon' => asset_cdn($affiliate->favicon)]);
        }

        return $next($request);
    }
}
