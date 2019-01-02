<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingPageIcon extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
    ];
}
