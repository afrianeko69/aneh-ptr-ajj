<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReferralCode extends Model
{
    protected $fillable = [
        'user_id',
        'referral_code',
        'is_default',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function studentLeads()
    {
        return $this->hasMany('App\StudentLead');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
