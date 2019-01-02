<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Voyager;

class PostController
{
    public function index(){

        $posts = Post::select('title','excerpt','slug','image')->where('status', Post::STATUS_PUBLISHED)->orderBy('id','DESC')->limit(2)->get();
        $posts = $posts->map(function ($post) {
            return [
                'title' => $post['title'],
                'excerpt' => $post['excerpt'],
                'image' => asset_cdn($post['image']),
                'slug'  => url('blog/'.$post['slug'])
            ];
        });
        return $posts;
    }
}