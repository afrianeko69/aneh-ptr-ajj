<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bundle;
use App\Events\EnrollToKlassEvent;
use App\Industry;
use App\Location;
use App\Order;
use App\Product;
use App\Services\Departement;
use App\Services\Lms;
use Auth;
use Cache;
use Session;
use TCG\Voyager\Models\Category;
use App\CategoryClassification;
use App\Tracker;

class ProductController extends Controller
{
    private $new_view = 'pintaria3.products';
    public function index(Request $request, $slug)
    {
        $user = Auth::user();
        $purchase = $request->get('beli');
        if($purchase && !($user)) {
            return redirect(route('daftar') . '?previous_url='. route('product.konfirmasi.beli', [$slug]));
        }

        $product = Product::getProductBySlug($slug);
        if(!$product) {
            return abort(404);
        }

        $learning_materials = [];
        if($product->is_learning_material_showed) {
            $learning_materials = Cache::remember('section_and_section_unit_of_' . $slug, 1440, function() use ($slug) {
                $lms = new Lms;
                $learning_materials = $lms->getSectionAndSectionUnitDetailByCourseSlug($slug);
                if($learning_materials['status'] == 200) {
                    return $learning_materials['body'];
                }
                return [];
            });
        }

        $locations = Location::select(['name'])->get();
        $user_class = false;
        if($user) {
            $user_class = $user->courses()->courseSlug($slug)
                                    ->select(['lms_custom_url', 'lms_klass_id',])
                                    ->first();
        }

        if($purchase && $user) {
            if($user_class) {
                Session::flash('message-success', 'Anda telah sukses didaftarkan ke Kelas ' . $product->product_name);
                return redirect(route('kelas.saya'));
            } else {
                //check price first, if free then enroll user else, in view show payment confirmation modal
                if($product->type == 'free') {
                    event(new EnrollToKlassEvent($user, $slug));
                    Session::flash('message-success', 'Anda telah sukses didaftarkan ke Kelas ' . $product->product_name);
                    return redirect(route('kelas.saya'));
                }
            }
            Tracker::updateTracker('click_buy_product', $product->id);
        }

        // Get Bundle
        $bundles = Bundle::getRelatedBundle($product->id);

        Order::alreadyPurchaseBundleInOrder($bundles);

        // Get applicant categories for mohon info form
        $applicant_categories = Departement::getApplicantCategories(); 

        return view($this->new_view . '.index', compact('product', 'locations', 'user', 'user_class', 'bundles', 'learning_materials', 'applicant_categories'));
    }

    public function search(Request $request)
    {
        $get = $request->all();
        if (!empty($get['show']) && ($get['show'] == 'grid') ){
            $searchView = '.search_grid';
        } else {
            $searchView = '.search';
        }
        $products = Product::getAllProduct([], false, $get);

        $product_categories = CategoryClassification::all();

        $category = null;
        if (!empty($get[Product::CATEGORY_PROGRAM])) {
            $category = Category::where('name', urldecode($get[Product::CATEGORY_PROGRAM]))->first();
        }
        $industry = null;
        if (!empty($get[Product::INDUSTRY_PROGRAM])) {
            $industry = Industry::where('name', urldecode($get[Product::INDUSTRY_PROGRAM]))->first();
        }

        $categories = Category::all();
        $product_industries = Industry::all();
        return view('pintaria3.products' . $searchView, compact('products','product_categories','get','categories', 'category', 'product_industries', 'industry'));

    }

    public function autoComplete(Request $request){
        $get= $request->all();
        return Product::select('name')->where('name','like','%'.$get['q'].'%')->where('is_content_ready',true)->pluck('name')->toArray();
    }

    public function konfirmasiBeli(Request $request, $slug){
        $user = Auth::user();
        if(!($user)) {
            return redirect(route('daftar') . '?previous_url='. url()->full());
        }

        $product = Product::getProductBySlug($slug);
        if(!$product) {
            return abort(404);
        }

        if($request->has('paket')){
            $bundleID = $request->get('paket');
            return $this->handleBundlePurchase($user, $product, $bundleID);
        }else{
            return $this->handleProductPurchase($user, $product);
        }
    }

    private function handleProductPurchase($user, $product){
        $user_class = false;
        if($user) {
            $user_class = $user->courses()->courseSlug($product->slug)
                ->select(['lms_custom_url', 'lms_klass_id',])
                ->first();
        }

        if($user) {
            if($user_class) {
                Session::flash('message-success', 'Anda telah sukses didaftarkan ke Kelas ' . $product->product_name);
                return redirect(route('kelas.saya'));
            } else {
                //check price first, if free then enroll user else, in view show payment confirmation modal
                if($product->type == 'free') {
                    event(new EnrollToKlassEvent($user, $product->slug));
                    Session::flash('message-success', 'Anda telah sukses didaftarkan ke Kelas ' . $product->product_name);
                    return redirect(route('kelas.saya'));
                }
            }
            Tracker::updateTracker('click_buy_product', $product->id);
        }

        return view('pintaria3.products.konfirmasi-beli', compact('product', 'user'));
    }

    private function handleBundlePurchase($user, $product, $bundleID){
        $bundle = Bundle::active()->find($bundleID);

        if(!$bundle) {
            return abort(404);
        }

        Bundle::bundlePrice($bundle);
        if (!$bundle->price) {
            foreach ($bundle->products()->get() as $bundleProduct){
                $productsName[] = $bundleProduct->name;
                event(new EnrollToKlassEvent($user, $bundleProduct->slug));
            }
            Session::flash('message-success', 'Anda telah sukses didaftarkan ke Kelas ' . implode($productsName, ' , ' ));
            return redirect(route('kelas.saya'));
        }
        
        if($user) {
            Tracker::updateTracker('click_buy_product', $product->id);
        }

        return view('pintaria3.products.konfirmasi-beli', compact('product', 'user', 'bundle'));
    }
}
