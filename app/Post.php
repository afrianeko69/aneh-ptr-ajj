<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    CONST STATUS_PUBLISHED = 'PUBLISHED';
    CONST ALL_CATEGORIES = ['Berita', 'Acara'];
    CONST BERITA_CATEGORY = 'Berita';
    CONST ACARA_CATEGORY = 'Acara';

    protected $fillable = [
        'title',
        'author_id',
        'excerpt',
        'body',
        'image',
        'slug',
        'meta_description',
        'meta_keywords',
        'post_tag',
        'created_at',
        'updated_at',
    ];

    public function post_tag()
    {
        return $this->belongsToMany('App\PostTag')->withTimestamps();
    }

    public function scopePublishedAndBeritaCategory($query) {
        return $query->where('status', self::STATUS_PUBLISHED)
                    ->where('category_name', self::BERITA_CATEGORY)
                    ->orderBy('id', 'desc');
    }

    public function scopePublishedAndAcaraCategory($query) {
        return $query->where('status', self::STATUS_PUBLISHED)
                    ->where('category_name', self::ACARA_CATEGORY)
                    ->orderBy('id', 'desc');
    }

    public function getFullImageUrlAttribute() {
        return asset_cdn($this->image);
    }

    public function getPostDetailUrlAttribute() {
        return route('blog.detail', [$this->slug]);
    }

    public function getHumanDateAttribute() {
        return date('d.m.Y', strtotime($this->created_at));
    }
    
    public function getShortDateAttribute() {
        return '<strong>'.date('d', strtotime($this->created_at)).'</strong> '.substr(convertMonthDate(date('n', strtotime($this->created_at))) , 0, 3 );
    }

    public function getAuthorNameAttribute() {
        return 'Pintaria';
    }

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
