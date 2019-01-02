<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;

class Affiliate extends Model
{
    protected $fillable = [
        'name',
        'domain_url',
        'logo',
        'logged_in_domain_url',
        'oauth_client_id',
        'oauth_secret'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function getFullDomainUrlAttribute()
    {
        return Request::getScheme() . '://' . $this->domain_url;
    }

    public function getTerimaKasihPageUrlAttribute() {
        return $this->fullDomainUrl . '/terima-kasih';
    }

    public function getMasukAttribute() {
        return $this->fullDomainUrl . '/masuk';
    }

    public function getFullLoggedInDomainUrlAttribute()
    {
        return Request::getScheme() . '://' . $this->logged_in_domain_url . '/';
    }
}
