<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = [
        'email',
        'submitted_url',
        'is_registered_to_sendgrid',
    ];

    /**
    * The attributes for validation rules
    * @var array
    */
    public static $rules = [
        'email' => 'email|required'
    ];
}
