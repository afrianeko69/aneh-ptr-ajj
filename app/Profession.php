<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Profession extends Model
{
    use Searchable;
    protected $fillable = [
        'name',
        'sort',
        'created_at',
        'updated_at',
        'icon',
        'banner',
        'description',
        'excerpt',
        'jooble',
        'youtube_video_id',
        'pay',
        'task',
        'knowledge',
        'skill',
        'is_content_ready',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function products() {
        return $this->belongsToMany('App\Product')->withTimestamps();
    }

    public function getFullPathIconUrlAttribute() {
        return asset_cdn($this->icon);
    }

    public static function getProfessionSearch($keyword)
    {
        $professions = Profession::search($keyword)->get();
        $result = array();
        if (!$professions->isEmpty()){
            foreach ($professions as $k => $profession) {
                $result[$k]['name'] = $profession->name;
                $result[$k]['url'] = url('profesi/'.str_slug($profession->name));
            }
        }
        return $result;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return array_only($this->toArray(), ['name']);
    }

    public function youtubeEmbedUrl()
    {
        return youtube_embed_url_generator($this->youtube_video_id);
    }
}
