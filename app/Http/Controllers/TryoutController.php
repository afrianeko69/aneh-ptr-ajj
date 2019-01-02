<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductTryout;
use DB;
use Illuminate\Http\Request;

class TryoutController extends Controller
{
    private $view = 'pintaria3.tryout';

    public function instruction($slug) {
        $product = Product::join('product_tryouts as pt', function($query) {
                        $query->on('pt.product_id', '=', 'products.id');
                    })
                    ->whereSlug($slug)
                    ->whereIsTryout(true)
                    ->select([
                        'products.instruction', 'pt.button_name', 'pt.id',
                        'products.name'
                    ])
                    ->orderBy('pt.sort', 'asc')
                    ->firstOrFail();

        $product->quiz_url = route('tryout.quiz', [$slug, $product->id]);

        return view($this->view . '.instruction', compact('product'));
    }

    public function tryoutQuiz($slug, $product_tryout_id) {
        $product = Product::join('product_tryouts as pt', function($query) use ($product_tryout_id) {
                        $query->on('pt.product_id', '=', 'products.id')
                            ->where('pt.id', '=', $product_tryout_id);
                    })
                    ->whereSlug($slug)
                    ->whereIsTryout(true)
                    ->select([
                        'pt.button_name', 'pt.id as product_tryout_id', 'pt.embed_link',
                        'products.name', 'products.id as product_id', 'pt.sort',
                    ])
                    ->firstOrFail();

        $tryout = ProductTryout::where('product_id', $product->product_id)
                                ->select([
                                    DB::raw('MAX(sort) as max_sort'),
                                ])
                                ->selectRaw('(
                                    SELECT id FROM product_tryouts
                                    WHERE product_id = ? AND sort > ?
                                    ORDER BY sort ASC
                                    LIMIT 1
                                ) as next_tryout_id,
                                (
                                    SELECT button_name FROM product_tryouts
                                    WHERE product_id = ? AND sort > ?
                                    ORDER BY sort ASC
                                    LIMIT 1
                                ) as next_button_name
                                ', [$product->product_id, $product->sort, $product->product_id, $product->sort])
                                ->first();

        $product->is_last_quiz = ($product->sort == $tryout->max_sort)?: false;
        if(!$product->is_last_quiz) {
            $product->quiz_url = route('tryout.quiz', [$slug, $tryout->next_tryout_id]);
            $product->button_name = $tryout->next_button_name;
        }
        return view($this->view . '.quiz', compact('product'));
    }
}
