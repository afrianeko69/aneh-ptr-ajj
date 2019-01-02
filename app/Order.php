<?php

namespace App;

use App\Bundle;
use App\Events\EnrollToKlassEvent;
use App\Events\UpdateLmsUserDataEvent;
use App\OrderDetail;
use App\Product;
use App\Promotion;
use App\Services\AkuLaku;
use App\Services\Lms;
use App\Services\Midtrans\Midtrans;
use App\Services\Mutual;
use App\User;
use Auth;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Session;

class Order extends Model
{
    CONST STATUS_PENDING = 'pending';
    CONST STATUS_SUCCESS = 'success';
    CONST STATUS_FAILED = 'failed';

    CONST CONVERTED_STATUS_PENDING = 'Menunggu Pembayaran';
    CONST CONVERTED_STATUS_SUCCESS = 'Berhasil';
    CONST CONVERTED_STATUS_FAILED = 'Gagal';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'user_id',
        'course_id',
        'product_slug',
        'order_number',
        'invoice_number',
        'amount',
        'quantity',
        'currency',
        'tax_type',
        'account_code',
        'bundle_id',
        'purchase_url',
        'referral_code',
        'referral_reward_value',
        'referral_reward_value_type',
        'referral_reward_nominal',
        'product_discount_nominal',
        'price_after_discount',
        'total_product_price',
        'price_after_referral_reward',
        'promo_code',
        'promo_reward_value',
        'promo_reward_value_type',
        'promo_reward_nominal',
        'price_after_promo_reward',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public static function getOrderStatusList()
    {
        return [
            self::STATUS_PENDING => self::CONVERTED_STATUS_PENDING,
            self::STATUS_SUCCESS => self::CONVERTED_STATUS_SUCCESS,
            self::STATUS_FAILED => self::CONVERTED_STATUS_FAILED,
        ];
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product() {
        return $this->belongsTo('App\Product', 'product_slug', 'slug');
    }

    public function order_details() {
        return $this->hasMany('App\OrderDetail');
    }

    public static function convertOrderStatus($status) {
        switch($status) {
            case self::STATUS_SUCCESS:
                return self::CONVERTED_STATUS_SUCCESS;
                break;
            case self::STATUS_FAILED:
                return self::CONVERTED_STATUS_FAILED;
                break;
            case self::STATUS_PENDING:
                return self::CONVERTED_STATUS_PENDING;
                break;
        }
    }

    public static function convertOrderTextToOrderStatus($text) {
        switch ($text) {
            case self::CONVERTED_STATUS_SUCCESS:
                return self::STATUS_SUCCESS;
                break;
            case self::CONVERTED_STATUS_FAILED:
                return self::STATUS_FAILED;
                break;
            case self::CONVERTED_STATUS_PENDING:
                return self::STATUS_PENDING;
                break;

            default:
                return null;
                break;
        }
    }

    public static function purchase($data, $user) {
        $response = [
            'status' => 400,
            'message' => 'Maaf, saat ini kami kesulitan memproses data anda.',
            'is_using_midtrans' => false,
            'data' => null
        ];
        if($data['bundle_id']) {
            self::handleBundlePurchase($response, $data, $user);
            return $response;
        } else {
            $slug = $data['slug'];
            $product = Product::where('slug', $slug)
                        ->where('is_open_enrollment', true)
                        ->where('is_content_ready', true)
                        ->select([
                            'id', 'price', 'discount_percentage', 'name',
                            'learning_method_id', 'discount_start_at', 'discount_end_at'
                        ])
                        ->first();
            if(!$product) {
                $response['status'] = 404;
                $response['message'] = 'Maaf, produk yang anda proses untuk dibeli tidak ditemukan.';
                return $response;
            }

            # Parse participant data so it is usable
            if (isset($data['participants'])) {
                parse_str($data['participants'], $members);
                $same_company = true;
                $_company = $members['peserta']['company'][0];
                foreach ($members['peserta']['company'] as $k => $company) {
                    $participants[] = [
                        'name' => $members['peserta']['name'][$k],
                        'email' => $members['peserta']['email'][$k],
                        'phone' => $members['peserta']['phone'][$k],
                        'company' => $members['peserta']['company'][$k],
                    ];

                    # Determine if all participants are from same company (related to discount)
                    if ($same_company && ($company != $_company)) {
                        $same_company = false;
                    }
                }
            }

            Product::productDiscount($product);

            if (isset($data['participants']) && $product->isOfflineCourse()) {
                $product->has_multiple_participant_discount = null;
                Product::productDiscountMultipleParticipants($product, $data['quantity'], $same_company);
            }

            $is_product_free = false;
            if (!empty($data['quantity'])) {
                $product_price = $data['quantity'] * $product->price;
            } else {
                $product_price = $product->price;
            }
            
            self::isProductFreeOrGetPrice($product, $is_product_free, $product_price);

            if($is_product_free) {
                event(new EnrollToKlassEvent($user, $slug));
                Session::flash('message-success', 'Anda telah sukses didaftarkan ke Kelas '. $product->name);
                $response['status'] = 200;
                $response['message'] = 'success';
                return $response;
            } else {
                // Get the course detail first
                $klass_info = self::getKlassInfo($slug, $user->provider_id);
                if(!$klass_info) {
                    $response['message'] = 'Maaf, kami tidak dapat mengambil detil kelas anda.';
                    return $response;
                }

                $product_discount_nominal = $price_after_discount = null;
                if($product->is_discount) {
                    if (!empty($data['quantity'])) {
                        $product_discount_nominal = ($product->price_after_discount - ($data['quantity'] * $product->price));
                    } else {
                        $product_discount_nominal = ($product->price_after_discount - $product->price);
                    }
                    $price_after_discount = $product->price_after_discount;
                }

                $promo = self::calculatePromoReward($data['promo_code'], $product->id, 'product', $product_price);
                $reward = self::calculateReferralReward($data['referral_code'], $product->id, 'product', $product_price);
                DB::beginTransaction();
                try {
                    // Paid Course, save to orders table
                    $order_number = self::convertOrderNumber();
                    $save_order = self::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $data['phone_number'],
                        'user_id' => $user->id,
                        'course_id' => null,
                        'product_slug' => null,
                        'order_number' => $order_number,
                        'invoice_number' => self::convertInvoiceNumber(),
                        'amount' => $product_price,
                        'quantity' => !empty($data['quantity']) ? $data['quantity'] : 1,
                        'currency' => 'IDR',
                        'tax_type' => 'Tax Exempt',
                        'account_code' => 111111111,
                        'purchase_url' => url(''),
                        'total_product_price' => !empty($data['quantity']) ? $data['quantity'] * $product->price : $product->price,
                        'product_discount_nominal' => $product_discount_nominal,
                        'price_after_discount' => $price_after_discount,
                        'referral_code' => $reward['referral_code'],
                        'referral_reward_value' => $reward['referral_reward_value'],
                        'referral_reward_value_type' => $reward['referral_reward_value_type'],
                        'referral_reward_nominal' => $reward['referral_reward_nominal'],
                        'price_after_referral_reward' => $reward['price_after_referral_reward'],
                        'promo_code' => $promo['promo_code'],
                        'promo_reward_value' => $promo['promo_reward_value'],
                        'promo_reward_value_type' => $promo['promo_reward_value_type'],
                        'promo_reward_nominal' => $promo['promo_reward_nominal'],
                        'price_after_promo_reward' => $promo['price_after_promo_reward'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                    // Save to order details table
                    OrderDetail::create([
                        'course_id' => $klass_info->course_id,
                        'product_slug' => $slug,
                        'quantity' => !empty($data['quantity']) ? $data['quantity'] : 1,
                        'order_id' => $save_order->id,
                        'price' => !empty($data['quantity']) ? $data['quantity'] * $product->price : $product->price,
                        'discounted_price' => ($product->is_discount ? $product->price_after_discount : null),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                    return $response;
                }

                if ($data['payment_method'] === 'akulaku') {
                    $purchase_item[] = [
                        'skuId' => 'PRODUCT-' . $product->id,
                        'skuName' => $product->name,
                        'unitPrice' => $product_price,
                        'qty' => 1,
                        'img' =>asset_cdn($product->image),
                        'vendorName' => \Request::get('app_affiliate_id') ? \Request::get('app_affiliate_id') : 'Pintaria',
                        'vendorId' => \Request::get('app_affiliate_name') ? \Request::get('app_affiliate_name') : 1
                    ];

                    $response['data']['payment_method'] = 'akulaku';
                    $snap_token = self::getTokenAkuLaku($order_number, $product_price, $user->name, $user->email, $data['phone_number'], $purchase_item, $user->join_at);
                } else {
                    $purchase_item = [[
                        'id' => $klass_info->course_code,
                        'price' => $product->price,
                        'quantity' => !empty($data['quantity']) ? $data['quantity'] : 1,
                        'name' => $product->name
                    ]];

                    if ($product_discount_nominal) {
                        if (isset($product->has_multiple_participant_discount)) {
                            $purchase_item[] = [
                                'id' => 'MPD-1',
                                'quantity' => 1,
                                'name' => 'Diskon Produk Peserta',
                                'price' => $product_discount_nominal
                            ];
                        } else {
                            $purchase_item[] = [
                                'id' => 'DPR-1',
                                'quantity' => 1,
                                'name' => 'Diskon Produk',
                                'price' => $product_discount_nominal
                            ];
                        }
                    }

                    if ($promo['promo_reward_nominal']) {
                        $purchase_item[] = [
                            'id' => 'PC-' . $promo['promo_code'],
                            'quantity' => 1,
                            'name' => 'Diskon Promo',
                            'price' => $promo['promo_reward_nominal']
                        ];
                    }

                    if ($reward['referral_reward_nominal']) {
                        $purchase_item[] = [
                            'id' => 'RC-' . $reward['referral_code'],
                            'quantity' => 1,
                            'name' => 'Diskon Referral',
                            'price' => $reward['referral_reward_nominal']
                        ];
                    }

                    $response['data']['payment_method'] = 'midtrans';
                    $snap_token = self::getTokenSnap($order_number, $product_price, $user->name, $user->email, $data['phone_number'], $purchase_item, $user->join_at);

                }

                if (!$snap_token) {
                    $response['message'] = 'Maaf, kami tidak dapat memproses pembayaran anda saat ini.';
                    return $response;
                }

                if($response['data']['payment_method'] == 'akulaku'){
                    $response['data']['token'] = "No Token";
                    $response['data']['redirect_url'] = $snap_token['data']['redirect_url'];
                    $response['data']['order_number'] = $order_number;

                    self::where('order_number', $order_number)->update(['transaction_id' => $snap_token['data']['orderId']]);
                }else{
                    $response['data']['token'] = $snap_token;
                    $response['data']['order_number'] = $order_number;

                    self::where('order_number', $order_number)->update(['transaction_id' => $snap_token]);
                }

                event(new UpdateLmsUserDataEvent($user->provider_id, $user->name, $data['phone_number']));
                User::where('id', $user->id)->update(['phone_number' => $data['phone_number']]);

                $response['status'] = 200;
                $response['message'] = 'success';
                $response['is_using_midtrans'] = true;
                Session::put(config('constants.static_payment_page'), $order_number);
            }
        }

        return $response;
    }

    public static function alreadyPurchaseBundleInOrder(&$bundles) {
        if(Auth::guest()) {
            return;
        }

        $bundle_ids = [];
        foreach($bundles as $bundle) {
            $bundle_ids[] = $bundle['bundle']->id;
        }

        if(!$bundle_ids) {
            return;
        }

        $orders = self::where('status', self::STATUS_SUCCESS)
                    ->whereIn('bundle_id', $bundle_ids)
                    ->where('user_id', Auth::user()->id)
                    ->select(['bundle_id'])
                    ->get();

        foreach($bundles as $key => $bundle) {
            if($bundle['bundle']->is_purchased == true) {
                continue;
            }

            foreach($orders as $order) {
                if($order->bundle_id == $bundle['bundle']->id) {
                    $bundles[$key]['bundle']->is_purchased = true;
                    break;
                }
            }
        }
    }

    public static function getMyTransaction($user, $filter_type = null) {
        $orders = DB::table('orders as o')
                    ->join('payment_notifications as pn', function($query) {
                        $query->on('o.order_number', '=', 'pn.order_id');
                    })
                    ->leftJoin('bundles as b', function($query) {
                        $query->on('b.id', '=', 'o.bundle_id');
                    })
                    ->leftJoin('order_details as od', function($query) {
                        $query->on('od.order_id', '=', 'o.id');
                    })
                    ->leftJoin('products as p', function($query) {
                        $query->on('p.slug', '=', 'o.product_slug');
                    })
                    ->leftJoin('products as p2', function($query) {
                        $query->on('p2.slug', '=', 'od.product_slug');
                    })
                    ->where('user_id', $user->id)
                    ->select([
                        'o.product_slug', 'o.order_number', 'o.updated_at',
                        'o.amount', 'o.status', 'o.created_at as order_created_at',
                        'b.name as bundle_name', 'od.product_slug as order_detail_product_slug',
                        'p.name as product_name', 'p2.name as order_detail_product_name',
                    ])
                    ->orderBy('o.id', 'desc');

        if(!$filter_type) {
            $orders = $orders->where('o.status', self::STATUS_PENDING);
        } else {
            $converted_status = self::convertOrderTextToOrderStatus($filter_type);
            if($converted_status) {
                $orders = $orders->where('o.status', $converted_status);
            }
        }

        $structured_orders = [];

        foreach($orders->get() as $order) {
            if(!isset($structured_orders[$order->order_number])) {
                $order_created_at = date('d ', strtotime($order->order_created_at))
                                    . convertMonthDate(date("n", strtotime($order->order_created_at)))
                                    . date(' Y', strtotime($order->order_created_at));

                $order_expired_at = date('Y-m-d H:i:s', strtotime($order->order_created_at . '+30 days'));
                $formatted_order_expired_at = date('d ', strtotime($order_expired_at))
                                    . convertMonthDate(date("n", strtotime($order_expired_at)))
                                    . date(' Y', strtotime($order_expired_at));

                $order_paid_at = '-';
                $order_paid_time = '';
                if($order->status == self::STATUS_SUCCESS) {
                    $order_paid_at = date('d ', strtotime($order->updated_at))
                                    . convertMonthDate(date("n", strtotime($order->updated_at)))
                                    . date(' Y', strtotime($order->updated_at));
                    $order_paid_time = date('H:i:s', strtotime($order->updated_at));
                }

                $structured_orders[$order->order_number] = [
                    'order_number' => $order->order_number,
                    'display_amount' => rupiah_number_format($order->amount),
                    'order_status' => self::convertOrderStatus($order->status),
                    'order_created_date' => $order_created_at,
                    'order_created_time' => date('H:i:s', strtotime($order->order_created_at)),
                    'bundle_name' => $order->bundle_name,
                    'order_expired_date' => $formatted_order_expired_at,
                    'order_expired_time' => date('H:i:s', strtotime($order_expired_at)),
                    'order_paid_date' => $order_paid_at,
                    'order_paid_time' => $order_paid_time,
                ];
            }

            $order_detail = [
                'product_slug' => ($order->product_slug ?: $order->order_detail_product_slug),
                'product_name' => ($order->product_name ?: $order->order_detail_product_name),
            ];

            $order_detail['product_route'] = route('product.index', [$order_detail['product_slug']]);
            $structured_orders[$order->order_number]['order_details'][] = $order_detail;
        }

        return array_values($structured_orders);
    }

    private static function getKlassInfo($slug, $lms_user_id) {
        $lms = new Lms();
        $request = $lms->checkStudentKlassStatus($lms_user_id, $slug);
        if($request['status'] == 200) {
            return $request['body'];
        }
        return null;
    }

    private static function isProductFreeOrGetPrice($product, &$is_product_free, &$product_price){
        if($product->price == 0) {
            $is_product_free = true;
        } else {
            if($product->is_discount) {
                if($product->price_after_discount == 0) {
                    $is_product_free = true;
                } else {
                    $product_price = $product->price_after_discount;
                }
            }
        }
    }

    private static function convertOrderNumber() {
        $order_number = date('Y').date('m');
        $padded = sprintf("%06d", 1);
        $find = self::select('order_number')->where('order_number', 'like', $order_number . '%')->orderBy('order_number','DESC')->first();
        if ($find){
            $order_number .= sprintf("%06d", (intval(substr($find->order_number,-6)) + 1) );
        }
        else {
            $order_number .= $padded;
        }
        return $order_number;
    }

    private static function convertInvoiceNumber() {
        $invoice_number = 'INV/'.date('Y').'/'.date('m').'/T/';
        $padded = sprintf("%06d", 1);
        $find = self::select('invoice_number')->where('invoice_number', 'like', $invoice_number . '%')->orderBy('invoice_number','DESC')->first();
        if ($find){
            $invoice_number .= sprintf("%06d", (intval(substr($find->invoice_number,-6)) + 1) );
        }
        else {
            $invoice_number .= $padded;
        }
        return $invoice_number;
    }

    private static function getTokenSnap($order_number, $price, $name, $email, $phone, $purchase_items, $date_join = null) {
        $is_production = (env('APP_DEBUG') === true) ? false : true;
        $midtrans = new Midtrans(config('services.midtrans.server_key'), $is_production);
        $transaction_details = array(
            'order_id'      => $order_number,
            'gross_amount'  => $price
        );
        
        // Populate items
        $items = $purchase_items;

        // Populate customer's Info
        $customer_details = array(
            'first_name'    => $name,
            'email'         => $email,
            'phone'         => $phone
        );

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit'       => 'day',
            'duration'   => 2
        );

        $transformed_date_join = null;
        if($date_join) {
            $transformed_date_join = date('d/m/Y H:i A', strtotime($date_join));
        }

        // Data yang akan dikirim untuk request redirect_url.
        // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
        $credit_card_option = [
            'secure' => true,
            'channel' => 'migs'
        ];

        $transaction_data = array(
            'transaction_details'   => $transaction_details,
            'item_details'          => $items,
            'customer_details'      => $customer_details,
            'expiry'                => $custom_expiry,
            'credit_card'           => $credit_card_option,
            'custom_field1'         => $transformed_date_join,
            'custom_field2'         => url(''),
        );
        try {
            $snap_token = $midtrans->getSnapToken($transaction_data);
            return $snap_token;
        } catch (Exception $e) {
            return null;
        }
    }

    private static function getTokenAkuLaku($order_number, $price, $name, $email, $phone, $purchase_items, $date_join = null)
    {
        $transaction_data = [
            "refNo" => $order_number,
            "userAccount" => $name,
            "receiverName" => $name,
            "receiverPhone" => $phone,
            "province" => 'undefined',
            "city" => 'undefined',
            "street" => 'undefined',
            "postcode" => 'undefined',
            "callbackPageUrl" => route('akulaku.callback.page'),
            "details" => $purchase_items,
            "virtualDetails" => [],
            "extraInfo" => [
                'refNo' => $order_number,
                'userAccount' => $name
            ]
        ];

        try {
            $akulaku = new AkuLaku();
            $response = $akulaku->setCredentials(config('services.akulaku.app_id'), config('services.akulaku.secret_key'))
                ->generateOrder($transaction_data);

            if($response){
                $payment = $akulaku->setCredentials(config('services.akulaku.app_id'), config('services.akulaku.secret_key'))
                    ->paymentEntry($order_number);
                $response['data']['redirect_url'] = $payment;
                return $response;
            }
        } catch (Exception $e) {
        }

        return null;
    }

    private static function handleBundlePurchase(&$response, $data, $user)
    {
        $bundle_id = $data['bundle_id'];

        $bundle = Bundle::where('id', $bundle_id)
                        ->active()
                        ->select([
                            'id', 'name', 'price'
                        ])
                        ->first();

        if(!$bundle) {
            $response['message'] = 'Maaf, paket yang anda proses tidak ditemukan';
            return;
        }

        $any_failed_product = false;
        $total_product_price = 0;
        $bundle_product_names = '';
        $grand_total = $bundle->price;
        $purchased_products = $to_midtrans_items = $to_akulaku_items = [];
        $total_bundle_products = $bundle->products()->count();

        foreach($bundle->products()->get() as $key => $product) {
            $class_info = self::getKlassInfo($product->slug, $user->provider_id);
            if(!$class_info) {
                $any_failed_product = true;
                break;
            }

            $purchased_products[] = [
                'course_id' => $class_info->course_id,
                'product_slug' => $product->slug,
                'price' => $product->price,
                'quantity' => 1,
                'order_id' => '',
            ];

            $to_midtrans_items[] = [
                'id' => $class_info->course_code,
                'quantity' => 1,
                'name' => $product->name,
                'price' => $product->price
            ];

            $bundle_product_names .= getProductsName($product->name, $key, $total_bundle_products);

            $total_product_price += $product->price;
        }

        if($any_failed_product) {
            $response['message'] = 'Maaf, kami tidak dapat mengambil data paket anda.';
            return;
        }

        $product_discount_nominal = null;
        if($total_product_price != $grand_total) {
            $product_discount_nominal = $grand_total - $total_product_price;
            $to_midtrans_items[] = [
                'id' => 'DP-1',
                'quantity' => 1,
                'name' => 'Diskon Paket',
                'price' => $product_discount_nominal
            ];
        }

        $promo = self::calculatePromoReward($data['promo_code'], $bundle->id, 'bundle', $grand_total);
        $reward = self::calculateReferralReward($data['referral_code'], $bundle->id, 'bundle', $grand_total);
        if($reward['referral_reward_nominal']) {
            $to_midtrans_items[] = [
                'id' => 'RC-' . $reward['referral_code'],
                'quantity' => 1,
                'name' => 'Diskon Referral',
                'price' => $reward['referral_reward_nominal']
            ];
        }

        if($promo['promo_reward_nominal']) {
            $to_midtrans_items[] = [
                'id' => 'PC-' . $promo['promo_code'],
                'quantity' => 1,
                'name' => 'Diskon Promo',
                'price' => $promo['promo_reward_nominal']
            ];
        }

        $to_akulaku_items[] = [
            'skuId' => 'BUNDLE-' . $bundle->id,
            'skuName' => !empty($bundle_product_names) ? $bundle->name . ' ' . $bundle_product_names : $bundle->name,
            'unitPrice' => $grand_total,
            'qty' => 1,
            'img' => '',
            'vendorName' => \Request::get('app_affiliate_id') ? \Request::get('app_affiliate_id') : 'Pintaria',
            'vendorId' => \Request::get('app_affiliate_name') ? \Request::get('app_affiliate_name') : 1
        ];

        DB::beginTransaction();
        try {
            // Create order
            $order_number = self::convertOrderNumber();
            $save_order = self::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $data['phone_number'],
                'user_id' => $user->id,
                'course_id' => null,
                'product_slug' => null,
                'order_number' => $order_number,
                'invoice_number' => self::convertInvoiceNumber(),
                'amount' => $grand_total,
                'quantity' => 1,
                'currency' => 'IDR',
                'tax_type' => 'Tax Exempt',
                'account_code' => 111111111,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'bundle_id' => $bundle->id,
                'purchase_url' => url(''),
                'total_product_price' => $total_product_price,
                'product_discount_nominal' => $product_discount_nominal,
                'price_after_discount' => ($total_product_price && $product_discount_nominal ? ($total_product_price + $product_discount_nominal) : null),
                'referral_code' => $reward['referral_code'],
                'referral_reward_value' => $reward['referral_reward_value'],
                'referral_reward_value_type' => $reward['referral_reward_value_type'],
                'referral_reward_nominal' => $reward['referral_reward_nominal'],
                'price_after_referral_reward' => $reward['price_after_referral_reward'],
                'promo_code' => $promo['promo_code'],
                'promo_reward_value' => $promo['promo_reward_value'],
                'promo_reward_value_type' => $promo['promo_reward_value_type'],
                'promo_reward_nominal' => $promo['promo_reward_nominal'],
                'price_after_promo_reward' => $promo['price_after_promo_reward'],
            ]);

            // Save to Order Details
            $order_id = $save_order->id;
            foreach($purchased_products as $key => $product) {
                $product['order_id'] = $order_id;
                $product['created_at'] = date('Y-m-d H:i:s');
                $product['updated_at'] = date('Y-m-d H:i:s');
                OrderDetail::create($product);
            }
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return;
        }

        if ($data['payment_method'] === 'akulaku') {
            $response['data']['payment_method'] = 'akulaku';
            $snap_token = self::getTokenAkuLaku($order_number, $grand_total, $user->name, $user->email, $data['phone_number'], $to_akulaku_items, $user->join_at);
        } else {
            $response['data']['payment_method'] = 'midtrans';
            $snap_token = self::getTokenSnap($order_number, $grand_total, $user->name, $user->email, $data['phone_number'], $to_midtrans_items, $user->join_at);
        }

        if (!$snap_token) {
            $response['message'] = 'Maaf, kami tidak dapat memproses pembayaran anda saat ini.';
            return;
        }

        if($response['data']['payment_method'] == 'akulaku'){
            $response['data']['token'] = "No Token";
            $response['data']['redirect_url'] = $snap_token['data']['redirect_url'];
            $response['data']['order_number'] = $order_number;

            self::where('order_number', $order_number)->update(['transaction_id' => $snap_token['data']['orderId']]);
        }else{
            $response['data']['token'] = $snap_token;
            $response['data']['order_number'] = $order_number;

            self::where('order_number', $order_number)->update(['transaction_id' => $snap_token]);
        }

        event(new UpdateLmsUserDataEvent($user->provider_id, $user->name, $data['phone_number']));
        User::where('id', $user->id)->update(['phone_number' => $data['phone_number']]);

        $response['status'] = 200;
        $response['message'] = 'success';
        $response['is_using_midtrans'] = true;
        Session::put(config('constants.static_payment_page'), $order_number);
    }

    private static function calculateReferralReward($referral_code, $id, $type, &$product_price) {
        $reward = [
            'referral_code' => null,
            'referral_reward_value' => null,
            'referral_reward_value_type' => null,
            'referral_reward_nominal' => null,
            'price_after_referral_reward' => null
        ];

        if(!$referral_code) {
            return $reward;
        }

        $mutual = new Mutual();
        $check_referral_code = $mutual->checkReferralCode($referral_code, $id, $type, auth()->user()->email);
        if($check_referral_code['status'] == 200 && $check_referral_code['body']['is_valid']) {
            $referral_reward = $check_referral_code['body'];

            $reward['referral_code'] = $referral_code;
            $reward['referral_reward_value'] = $referral_reward['value'];
            $reward['referral_reward_value_type'] = $referral_reward['type'];
            $reward['referral_reward_nominal'] = 0;

            switch ($referral_reward['type']) {
                case Mutual::VALUE_TYPE_PERCENTAGE:
                    $reward['referral_reward_nominal'] = (int) ($product_price * ($referral_reward['value'] / 100.0));
                    break;
                case Mutual::VALUE_TYPE_AMOUNT:
                    $reward['referral_reward_nominal'] = (int) $referral_reward['value'];
                    break;
            }

            $reward['referral_reward_nominal'] = '-' . $reward['referral_reward_nominal'];
            $product_price += $reward['referral_reward_nominal'];
            $reward['price_after_referral_reward'] = $product_price;
        }
        return $reward;
    }

    private static function calculatePromoReward($promo_code, $id, $type, &$product_price) {
        $reward = [
            'promo_code' => null,
            'promo_reward_value' => null,
            'promo_reward_value_type' => null,
            'promo_reward_nominal' => null,
            'price_after_promo_reward' => null
        ];

        if(!$promo_code) {
            return $reward;
        }

        $promotion = Promotion::checkPromoCode($promo_code, $id, $type);
        if($promotion['status'] == 200 && $promotion['body']['is_valid'] == true) {
            $promotion = $promotion['body'];

            $reward['promo_code'] = $promo_code;
            $reward['promo_reward_value'] = $promotion['value'];
            $reward['promo_reward_value_type'] = $promotion['type'];
            $reward['promo_reward_nominal'] = 0;

            switch ($promotion['type']) {
                case Promotion::DISCOUNT_TYPE_PERCENTAGE:
                    $reward['promo_reward_nominal'] = (int) ($product_price * ($promotion['value'] / 100.0));
                    break;

                case Promotion::DISCOUNT_TYPE_AMOUNT:
                    $reward['promo_reward_nominal'] = (int) $promotion['value'];
                    break;
            }
            $reward['promo_reward_nominal'] = '-' . $reward['promo_reward_nominal'];
            $product_price += $reward['promo_reward_nominal'];
            $reward['price_after_promo_reward'] = $product_price;
        }
        return $reward;
    }
}
