<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $fillable = [
        'name',
        'title',
        'photo',
        'testimony',
        'sort',
        'youtube_video_id',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
