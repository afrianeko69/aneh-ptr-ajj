<?php

namespace App\Http\Controllers;

use App\Video;
use App\Content;

class VideoController extends Controller
{
    protected $view = 'pintaria3.videos';

    public function index(){
        $videos = Video::orderBy('id','desc')->paginate(8);
        $tambahPintar = Content::where('key',Content::TAMBAH_PINTAR)->first();
        return view($this->view.'.index', compact('videos','tambahPintar'));
    }

    public function detail($title){
        $video = Video::where('title',urldecode($title))->first();
        if (empty($video)){
            return abort(404);
        }
        $latest = Video::orderBy('id','DESC')->limit(3)->get();
        return view($this->view.'.detail', compact('video', 'latest'));
    }
}
