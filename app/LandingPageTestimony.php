<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingPageTestimony extends Model
{
    protected $fillable = [
        'id',
        'person_name',
        'person_title',
        'person_image',
        'description',
    ];
}
