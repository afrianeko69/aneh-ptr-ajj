<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Order;
use App\Promotion;
use App\Product;
use App\Services\Mutual;
use App\Tracker;
use App\UserParticipant;
use Auth;
use Illuminate\Http\Request;
use Session;


class OrderController extends Controller
{
    protected $newView = 'pintaria3';

    /**
     * Display a page after payment is success
     *
     * @return Response
     */
    public function success($order_number)
    {
        $key = config('constants.static_payment_page');
        $session_order_number = Session::get($key);
        if($session_order_number) {
            if($session_order_number != $order_number) {
                abort(404);
            }

            Session::forget($key);
            $order = Order::where('order_number', $order_number)->select(['id'])->first();
            if(!$order) {
                abort(404);
            }

            Tracker::updateTracker('order_payment_success');

            $data = [
                'title' => 'Transaksi Pembayaran Berhasil',
                'description' => '<p>Selamat, Anda dapat langsung mengikuti kelas</p>'
            ];
            return view( $this->newView . '.orders.success', $data);
        }
        return abort(404);
    }

    /**
     * Display a page after payment is error
     *
     * @return Response
     */
    public function error(Request $request, $order_number)
    {
        $key = config('constants.static_payment_page');
        $session_order_number = Session::get($key);
        if($session_order_number) {
            if($session_order_number != $order_number) {
                abort(404);
            }

            Tracker::updateTracker('order_payment_error');

            Session::forget($key);
            $order = Order::where('order_number', $order_number)->select(['id'])->first();
            if(!$order) {
                abort(404);
            }

            $data = [
                'title' => 'Transaksi Pembayaran Gagal',
                'description' => '<p>Silahkan lakukan pembayaran ulang.<br>Jika masih bermasalah, silahkan hubungi customer service kami.</p>',
                'do_payment' => $request->get('link_pembayaran'),
            ];
            return view( $this->newView . '.orders.error', $data);
        }
        return abort(404);
    }

    /**
     * Display a page after payment is error
     *
     * @return Response
     */
    public function pending($order_number)
    {
        $key = config('constants.static_payment_page');
        $session_order_number = Session::get($key);
        if($session_order_number) {
            if($session_order_number != $order_number) {
                abort(404);
            }

            Session::forget($key);
            $order = Order::where('order_number', $order_number)->select(['id'])->first();
            if(!$order) {
                abort(404);
            }

            Tracker::updateTracker('order_payment_pending');

            $data = [
                'title' => 'Menunggu Transaksi Pembayaran',
                'description' => '<p>Detail pembayaran telah dikirim ke email Anda.<br> Mohon selesaikan pembayaran sebelum batas waktu yang diberikan.<br> Apabila melewati batas waktu, pesanan Anda akan otomatis dibatalkan.</p>'
            ];
            return view( $this->newView . '.orders.pending', $data);
        }
        return abort(404);
    }

    public function processPurchase(Requests\PurchaseRequest $request) {
        $data = $request->all();
        
        if(!Auth::check()) {
            return response()->json(['status' => 401]);
        }
        $purchase = Order::purchase($data, Auth::user());
        return $purchase;
    }

    public function checkReferralCode($referral_code, $id, $type) {
        if(auth()->guest()) {
            return response()->json(['status' => 400, 'message' => 'no auth given'], 400);
        }

        $mutual = new Mutual();
        $check_referral = $mutual->checkReferralCode($referral_code, $id, $type, auth()->user()->email);
        return $check_referral;
    }

    public function checkPromoCode($promo_code, $id, $type) {
        $check_promo_code = Promotion::checkPromoCode($promo_code, $id, $type);
        return response()->json($check_promo_code, $check_promo_code['status']);
    }

    public function saveParticipant(Request $request) {
        $post = $request->all();
        if (!empty($post)){
            UserParticipant::where('user_id',$post['user_id'])->where('product_id', $post['product_id'])->delete();
            if (!empty($post['peserta'])){
                foreach ($post['peserta']['name'] as $k => $name) {
                    $data = [
                        'user_id' => $post['user_id'],
                        'product_id' => $post['product_id'],
                        'name' => $post['peserta']['name'][$k],
                        'email' => $post['peserta']['email'][$k],
                        'phone' => $post['peserta']['phone'][$k],
                        'company' => $post['peserta']['company'][$k],
                    ];
                    UserParticipant::create($data);
                }
            }
            return response()->json(['status' => 200]);
        }
        return response()->json(['status' => 401]);
    }

    public function checkParticipantDiscount(Request $request) {
        $post = $request->all();
        if (!empty($post)) {
            $product = Product::select([
                    'id', 'price', 'discount_percentage', 'name',
                    'learning_method_id',
                ])
                ->findOrFail($post['product_id']);

            if (!$product->isOfflineCourse()) {
                return response()->json(['status' => 204]);
            }

            $same_company = true;
            $_company = $post['peserta']['company'][0];
            $quantity = 0;
            foreach ($post['peserta']['company'] as $k => $company) {
                $participants[] = [
                    'name' => $post['peserta']['name'][$k],
                    'email' => $post['peserta']['email'][$k],
                    'phone' => $post['peserta']['phone'][$k],
                    'company' => $post['peserta']['company'][$k],
                ];

                if ($same_company && ($company != $_company)) {
                    $same_company = false;
                }

                $quantity++;
            }

            $product->has_multiple_participant_discount = null;
            Product::productDiscountMultipleParticipants($product, $quantity, $same_company);

            if (!isset($product->has_multiple_participant_discount)) {
                return response()->json(['status' => 204]);
            }

            $data = [
                'nominal_discount' => $product->nominal_discount,
                'formatted_nominal_discount' => $product->formatted_nominal_discount,
                'price_after_discount' => $product->price_after_discount,
                'formatted_price_after_discount' => $product->formatted_price_after_discount,
            ];

            return response()->json(['body' => $data, 'status' => 200]);
        }
        return response()->json(['status' => 401]);
    }
}
