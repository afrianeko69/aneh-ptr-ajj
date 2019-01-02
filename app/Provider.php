<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public static function logoFullURL(&$provider)
    {
        $provider->logo_full_url = asset_cdn($provider->logo);
    }
}
