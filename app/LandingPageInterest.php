<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingPageInterest extends Model
{
    protected $fillable = [
        'id',
        'name',
        'sort',
    ];

    public function scopeSort($query, $method = 'ASC')
    {
        return $query->orderByRaw('sort is null, sort ' . $method);
    }
}
