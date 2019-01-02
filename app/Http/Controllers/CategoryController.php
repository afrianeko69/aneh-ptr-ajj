<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $view = 'pintaria3.categories';

    public function index(){
        $categories = Category::orderBy('category_sort','ASC')->simplePaginate(9);
        $categories->map(function($category){
            $category['total_product'] = $category->products()->ready()->count();
            return $category;
        });
        return view($this->view.'.index', compact('categories'));
    }
}