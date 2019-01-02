<?php

namespace App;

use App\Affiliate;
use Illuminate\Database\Eloquent\Model;

use \TCG\Voyager\Models\Page as VoyagerPage;


class Page extends VoyagerPage
{
    protected $fillable = [
        'affiliate_id',
        'title',
        'slug',
        'author_id',
        'status',
        'body'
    ];

    public function affiliateId()
    {
    	return $this->belongsTo(Affiliate::class, 'affiliate_id');
    }
}
