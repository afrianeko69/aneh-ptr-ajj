<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    protected $view = 'pintaria3.news';

    public function index(){
        $newses = News::where('status', News::STATUS_PUBLISHED)->orderBy('id','desc')->paginate(4);
        return view($this->view.'.index', compact('newses'));
    }

    public function show($slug){
        $news = News::where('slug', $slug)->firstOrFail();
        return view($this->view.'.show', compact('news'));
    }
}
