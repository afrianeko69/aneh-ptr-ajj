<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profession;
use App\Product;
class ProfessionController extends Controller
{
    protected $view = 'pintaria3.profession';

    public function index(){
        $professions = Profession::where('is_content_ready', 1)
            ->orderBy('sort','DESC')->simplePaginate(9);
        return view($this->view.'.index', compact('professions'));
    }

    public function detail($slug){
        $slug = str_replace('-',' ',$slug);
        $profession = Profession::where('name', $slug)->first();
        if(!$profession) {
            return abort(404);
        }
        if(!$profession->is_content_ready) {
            return abort(404);
        }
        $products = [];
        $related = Product::whereHas('professions', function($q) use($profession) {
            $q->where('profession_id', $profession->id);
        })->pluck('id')->toArray();
        if ($related){
            $products = Product::getAllProduct($related, false, [], false);
        }
        return view($this->view.'.detail', compact('profession','products'));
    }
}
