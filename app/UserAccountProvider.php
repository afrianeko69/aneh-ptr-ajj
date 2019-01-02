<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccountProvider extends Model
{
    protected $fillable = [
        'user_id',
        'account_provider',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    CONST SSO_PROVIDER = 'SSO';
    CONST GOOGLE_PROVIDER = 'GOOGLE';
    CONST FACEBOOK_PROVIDER = 'FACEBOOK';
    CONST LINKEDIN_PROVIDER = 'LINKEDIN';

    CONST KNOWN_PROVIDER = [
        self::SSO_PROVIDER, self::GOOGLE_PROVIDER, self::FACEBOOK_PROVIDER, self::LINKEDIN_PROVIDER,
    ];

    CONST NO_PASSWORD_PROVIDER = [
        self::GOOGLE_PROVIDER, self::FACEBOOK_PROVIDER, self::LINKEDIN_PROVIDER,
    ];

    public function scopeProvider($query, $provider) {
        return $query->where('account_provider', $provider);
    }

    public static function isValidProvider($user_provider) {
        $is_valid = false;
        foreach(self::KNOWN_PROVIDER as $val) {
            if($val === $user_provider){
                $is_valid = true;
                break;
            }
        }
        return $is_valid;
    }

    public static function isNoPasswordProvider($provider) {
        $is_no_password = false;
        foreach(self::NO_PASSWORD_PROVIDER as $val) {
            if($val === $provider) {
                $is_no_password = true;
                break;
            }
        }

        return $is_no_password;
    }

    public static function isSocialMediaProvider($provider) {
        $is_social_media_provider = false;
        foreach(self::NO_PASSWORD_PROVIDER as $val) {
            if($val === $provider){
                $is_social_media_provider = true;
                break;
            }
        }
        return $is_social_media_provider;
    }
}
