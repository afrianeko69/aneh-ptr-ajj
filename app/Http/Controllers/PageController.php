<?php

namespace App\Http\Controllers;

use Request;
use App\Affiliate;
use App\Page;

class PageController extends Controller
{
    protected $view = 'pintaria3';

    public function hubungiKami(){
        $affiliate_id = Request::get('app_affiliate_id');
        $hubungiKami = Page::where('slug','hubungi-kami');
        $affiliate = [];
        if (!empty($affiliate_id)){
            $hubungiKami = $hubungiKami->where('affiliate_id', $affiliate_id);
            $affiliate = Affiliate::where('id',$affiliate_id)->first();
        }
        $data = [
            'pages' => $hubungiKami->first(),
            'affiliate_contact' => $affiliate
        ];
        return view($this->view.'.pages.hubungi-kami', $data);
    }

    public function tentangKami(){
        $affiliate_id = Request::get('app_affiliate_id');
        $tentangKami = Page::where('slug','tentang-kami');
        if (!empty($affiliate_id)){
            $tentangKami = $tentangKami->where('affiliate_id', $affiliate_id);
        }
        $data = [
            'pages' => $tentangKami->first(),
            'page_type' => 'about'
        ];
        return view($this->view.'.pages.index', $data);
    }
    
    public function perjanjianPengguna(){
        $affiliate_id = Request::get('app_affiliate_id');
        $perjanjian = Page::where('slug','perjanjian-pengguna');
        if (!empty($affiliate_id)){
            $perjanjian = $perjanjian->where('affiliate_id', $affiliate_id);
        }
        $data = [
            'pages' => $perjanjian->first(),
            'page_type' => 'agreement'
        ];
        return view($this->view.'.pages.index', $data);
    }

    public function kebijakanPrivasi(){
        $affiliate_id = Request::get('app_affiliate_id');
        $kebijakan = Page::where('slug','kebijakan-privasi');
        if (!empty($affiliate_id)){
            $kebijakan = $kebijakan->where('affiliate_id', $affiliate_id);
        }
        $data = [
            'pages' => $kebijakan->first(),
            'page_type' => 'policy'
        ];
        return view($this->view.'.pages.index', $data);
    }
}
