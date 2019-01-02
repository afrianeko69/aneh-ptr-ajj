<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingPageUniversity extends Model
{
    protected $fillable = [
        'id',
        'name',
        'location',
        'sort',
        'image',
    ];

    public function scopeSort($query, $method = 'ASC')
    {
        return $query->orderByRaw('sort is null, sort ' . $method);
    }
}
