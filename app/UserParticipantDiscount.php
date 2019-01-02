<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserParticipantDiscount extends Model
{
    protected $fillable = [
        'participant_number',
        'discounted_price',
        'start_at',
        'end_at',
        'is_same_provider',
    ];
}
