<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    CONST STATUS_PUBLISHED = 'PUBLISHED';

    public function getMediumImageAttribute() {
        $image = $this->image;
        $explode = explode('.', $image);
        $length = count($explode);

        $medium_image = null;
        foreach($explode as $index => $val) {
            if($index == ($length - 1)) {
                $medium_image .= '-medium.';
            }
            $medium_image .= $val;
        }
        return $medium_image;
    }

    public function getMediumImageFullUrlAttribute() {
        return asset_cdn($this->medium_image);
    }

    public function getSmallImageAttribute() {
        $image = $this->image;
        $explode = explode('.', $image);
        $length = count($explode);

        $small_image = null;
        foreach($explode as $index => $val) {
            if($index == ($length - 1)) {
                $small_image .= '-small.';
            }
            $small_image .= $val;
        }
        return $small_image;
    }

    public function getSmallImageFullUrlAttribute() {
        return asset_cdn($this->small_image);
    }
}
