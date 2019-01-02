<?php

namespace App\Http\Controllers\Affiliate;

use Illuminate\Http\Request;
use App\Affiliate;
use App\Http\Controllers\Controller;
use App\Product;
use Auth;
use Session;

class ProductController extends Controller
{
    protected $view = 'affiliate.product';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::getAllProduct();
        $data['affiliate'] = Affiliate::find(Auth::user()->affiliate_id)->products()->pluck('id')->toArray();
        return view($this->view.'.index', $data);
    }

    public function update(Request $request)
    {
        $post = $request->all();
        $affiliate = Affiliate::find(Auth::user()->affiliate_id);
        $affiliate->products()->detach();
        if (!empty($post['product_id'])){
            foreach ($post['product_id'] as $product) {
                $affiliteProduct = Product::find($product);
                $affiliteProduct->affiliates()->save($affiliate);
            }
        }
        
        Session::flash('message-success', 'Produk Anda telah tersimpan.');
        return redirect()->back();
    }
}
