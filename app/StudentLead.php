<?php

namespace App;

use App\Traits\UserTimezone;
use Illuminate\Database\Eloquent\Model;
use App\UserReferralCode;
use App\Services\Mutual;

class StudentLead extends Model
{
    use UserTimezone;

    protected $fillable = [
        'name',
        'email',
        'url',
        'reference_name',
        'reference_email',
        'phone',
        'product',
        'location',
        'departement',
        'education',
        'applicant_category',
        'number_of_applicants',
        'interest',
        'referral_code',
        'created_at',
        'updated_at',
        'source_id',
        'source_from',
        'source_name',
        'source_medium',
        'source_term',
        'source_content'
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function userReferralCode()
    {
        return $this->belongsTo('App\UserReferralCode');
    }

    /**
     * Add user_referal_code relationship if referral code is valid
     *
     * @param -
     * @return bool
     */
    public function isValidReferral()
    {
       if (empty($this->referral_code)) return false;

       # Check validity in local db
       $referral_code = UserReferralCode::where('referral_code', $this->referral_code)
           ->where('is_default', 1)
           ->first();
       if (!$referral_code) return false;

       # Check in Mutual DB
       $mutual = new Mutual;
       if (!$mutual->checkUserReferralCode($referral_code->referral_code, $this->email)) return false;

       # Check if this email has used this code before
       if ($referral_code->studentLeads()->where('email', $this->email)->first()) return false;

       return true;
    }

    public function setUrlAttribute($value){
        $this->attributes['url'] = preg_replace('{/$}', '', $value);
    }
}
