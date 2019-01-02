<?php

namespace App\Http\Controllers;

use App\Page;
use App\Post;
use App\PostTag;

class PostController extends Controller
{
    protected $view = 'pintaria3.post';

    public function index(){
        $posts = Post::where('status', Post::STATUS_PUBLISHED)->orderBy('id','desc')->paginate(4);
        return view($this->view.'.index', compact('posts'));
    }

    public function show($slug){
        $post = Post::where('slug', $slug)->firstOrFail();
        return view($this->view.'.show', compact('post'));
    }

    public function tag($tag){
        
        $stringTag = str_replace('-',' ',$tag);
        $tag = PostTag::select('id')->where('name',$stringTag)->first();
        
        if (!$tag){
            abort(404);
        }

        $tagId = $tag->id;
        $posts = Post::whereHas('post_tag', function($q) use ($tagId) {
            $q->where('post_tags.id', $tagId);
        })->paginate(10);

        return view($this->view.'.tag', compact('posts', 'stringTag'));
    }
}
