<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserParticipant extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'email',
        'phone',
        'company',
        'card_id',
        'identifier',
        'card_published_at',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function scopeProductUserParticipant($query, $user_id, $product_id) {
        return $query->whereUserId($user_id)
            ->whereProductId($product_id);
    }

    public function scopeIdentifier($query, $ident)
    {
        return $query->where('identifier', $ident);
    }

    public static function generateIdentifier()
    {
        do {
            $ident = strtolower(str_random(16));
        } while (self::identifier($ident)->first());

        return $ident;
    }
}
