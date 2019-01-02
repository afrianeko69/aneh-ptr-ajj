<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Instructor extends Model
{
    public static function profilePictureFullURL(&$instructor)
    {
        $instructor->profile_picture_full_url = asset_cdn($instructor->profile_picture);
    }
}
