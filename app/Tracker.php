<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;
use URL;
use Auth;
use Cookie;
use App\Tracker;

class Tracker extends Model
{
    protected $connection = 'mysql_tracker';

    protected $fillable = [
        'previous_url','current_url','source_id','source_from','source_name','object_name','object_id','user_id', 'user_agent', 'ip', 'initial_url', 'source_medium', 'source_term', 'source_content'
    ];
    CONST OBJECT_ALLOW = ['click_buy_product','click_buy_bundle','click_payment_bundle','click_payment_product','order_payment_success','order_payment_error','order_payment_pending'];

    public static function updateTracker($object_name = '', $object_id = 0, $source_id = ''){

        $args = [
            'previous_url' => URL::previous(),
            'current_url' => URL::current(),
            'source_id' => !empty(Request::cookie('source_id')) ? Request::cookie('source_id') : $source_id,
            'source_from' => !empty(Request::cookie('utm_source')) ? Request::cookie('utm_source') : (!empty(Request::get('utm_source'))) ? Request::get('utm_source') : 'Pintaria',
            'source_name' => !empty(Request::cookie('utm_campaign')) ? Request::cookie('utm_campaign') : (!empty(Request::get('utm_campaign'))) ? Request::get('utm_campaign') : 'Pintaria',
            'source_medium' => !empty(Request::cookie('utm_medium')) ? Request::cookie('utm_medium') : Request::get('utm_medium'),
            'source_term' => !empty(Request::cookie('utm_term')) ? Request::cookie('utm_term') : Request::get('utm_term'),
            'source_content' => !empty(Request::cookie('utm_content')) ? Request::cookie('utm_content') : Request::get('utm_content'),
            'initial_url' => !empty(Request::cookie('initial_url')) ? Request::cookie('initial_url') : URL::current() . Request::getPathInfo() . (Request::getQueryString() ? ('?' . Request::getQueryString()) : ''),
            'object_name' => $object_name,
            'object_id' => $object_id,
            'user_id' => !empty(Auth::user()->id) ? Auth::user()->id : 0,
            'user_agent' => Request::header('User-Agent'),
            'ip' => Request::ip()
        ];

        if ($object_name == 'landing_page' ) {
            self::create($args);
        }

        if (!empty(Cookie::get('source_id'))) {
            $track = self::where('source_id', Cookie::get('source_id'))->orderBy('created_at','ASC');
            if ($object_name == 'login_user' && !empty(Auth::user()->id) ) {
                $track->update(['user_id' => Auth::user()->id]);
            } else if ( !empty($args) && in_array($object_name, self::OBJECT_ALLOW) ) {
                $track->create($args);
            }
        }
    }
}
