<?php

namespace App\Http\Controllers;

use App\Events\EnrollToKlassEvent;
use App\Order;
use App\PaymentNotification;
use App\Product;
use App\Services\AkuLaku;
use App\Services\Lms;
use App\Services\Mutual;
use App\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Notification through HTTP(S) POST will be sent to the merchant’s server
     * when customer completes the payment process.
     * @param  Request $request Request
     * @return \Illuminate\Http\Response
     */
    public function notification(Request $request)
    {
        $str_notification = stripslashes(trim($request->getContent(), '"')); // Fix broken json

        $notification = json_decode($str_notification, true);

        $order_id = (isset($notification['order_id']))? $notification['order_id'] : '';
        $status_code = (isset($notification['status_code']))? $notification['status_code'] : '';
        $gross_amount = (isset($notification['gross_amount']))? $notification['gross_amount'] : '';

        if (json_last_error() === JSON_ERROR_NONE) {
            $signature_key = generate_notification_signature_key($order_id, $status_code, $gross_amount, config('services.midtrans.server_key'));
            if (!$signature_key || ($signature_key !== $notification['signature_key'])) {
                return \App::abort(401, "Unauthorized, Signature key invalid");
            }

            $notification['json'] = $str_notification;
            // Handle all possibilities
            $this->reformatData($notification);

            $saved_notification = PaymentNotification::create($notification);

            // If notification saved successfully
            if ($saved_notification instanceof PaymentNotification && $saved_notification->order instanceof Order) {
                // Update order status (200 success, 201 pending, 202 failed)
                $order = $this->updateOrderStatus($saved_notification->order, $saved_notification->status_code);

                $class_attendee = $email_notification = false;
                if($order->status == translate_midtrans_status_code(200)) {
                    //handle data product on order (the old one) and new one in order details table
                    if($order->product_slug) {
                        event(new EnrollToKlassEvent($order->user, $order->product_slug));
                        $class_attendee = true;

                        if ($status_code != 201) {
                            // 200 (success) or 202 (failed) Only
                            $email_notification = $this->notifyUserByEmail($order->user, $order->product, ($status_code=='200')? true : false, $request->getHttpHost());
                        } else {
                            // 201 (pending) only
                            // @TODO: Ahmeng should notify user for 'pending' payment
                        }
                        // Send 200 to Midtrans, it means notification has been saved
                    } else {
                        $user = $order->user;
                        $user_lms_id = $user->provider_id;
                        foreach($order->order_details as $detail) {
                            $class_attendee = $email_notification = false;

                            event(new EnrollToKlassEvent($user, $detail->product_slug));
                            $class_attendee = true;
                            if($status_code != 201) {
                                $email_notification = $this->notifyUserByEmail($user, $detail->product, ($status_code=='200')? true : false, $request->getHttpHost());
                            }
                        }
                    }

                    if($order->referral_code) {
                        //call referrer reward endpoint to save the data
                        $mutual = new Mutual();
                        $save_referrer_reward = $mutual->referrerReward($order->order_number);
                        if($save_referrer_reward['status'] != 201) {
                            return \App::abort(400, 'Failed in save referrer reward');
                        }
                    }
                }

                return response([
                    'class_attendees' => $class_attendee,
                    'email_notification' => $email_notification,
                ], 200)->header('Content-Type', 'application/json');

            } else {
                return \App::abort(404, "Order ". $order_id ." not found!");
            }
        }

        return \App::abort(422, "Cannot process data");
    }

    public function akuLakuNotification(Request $request)
    {
        $orderID = $request->get('refNo') ? $request->get('refNo') : '';
        $status = $request->get('status') ? $request->get('status') : '';
        $status_code = $status == 100 ? 200 : $status;

        try {
            $akulaku = new AkuLaku();
            $response = $akulaku->setCredentials(config('services.akulaku.app_id'), config('services.akulaku.secret_key'))
                ->verifyCallbackAPI($request->all());

            if ($response) {
                $order = Order::whereOrderNumber($orderID)
                    ->whereStatus('pending')
                    ->first();

                if ($order) {
                    $notification = [
                        'payment_type' => 'akulaku',
                        'gross_amount' => '',
                        'order_id' => $orderID,
                        'status_code' => $status_code,
                        'transaction_id' => $order->transaction_id,
                        'transaction_status' => $status
                    ];

                    $this->reformatData($notification);

                    $saved_notification = PaymentNotification::create($notification);

                    // If notification saved successfully
                    if ($saved_notification instanceof PaymentNotification && $saved_notification->order instanceof Order) {
                        // Update order status (200 success, 201 pending, 202 failed)
                        $order = $this->updateOrderStatus($saved_notification->order, $saved_notification->status_code);

                        $class_attendee = $email_notification = false;
                        if ($order->status == translate_midtrans_status_code(200)) {
                            //handle data product on order (the old one) and new one in order details table
                            if ($order->product_slug) {
                                event(new EnrollToKlassEvent($order->user, $order->product_slug));
                                $class_attendee = true;

                                if ($status_code != 201) {
                                    // 200 (success) or 202 (failed) Only
                                    $email_notification = $this->notifyUserByEmail($order->user, $order->product, ($status_code == '200') ? true : false, $request->getHttpHost());
                                } else {
                                    // 201 (pending) only
                                    // @TODO: Ahmeng should notify user for 'pending' payment
                                }
                                // Send 200 to Midtrans, it means notification has been saved
                            } else {
                                $user = $order->user;
                                $user_lms_id = $user->provider_id;
                                foreach ($order->order_details as $detail) {
                                    $class_attendee = $email_notification = false;

                                    event(new EnrollToKlassEvent($user, $detail->product_slug));
                                    $class_attendee = true;
                                    if ($status_code != 201) {
                                        $email_notification = $this->notifyUserByEmail($user, $detail->product, ($status_code == '200') ? true : false, $request->getHttpHost());
                                    }
                                }
                            }

                            if ($order->referral_code) {
                                //call referrer reward endpoint to save the data
                                $mutual = new Mutual();
                                $save_referrer_reward = $mutual->referrerReward($order->order_number);
                                if ($save_referrer_reward['status'] != 201) {
                                    return \App::abort(400, 'Failed in save referrer reward');
                                }
                            }
                        }

                        return response([
                            'class_attendees' => $class_attendee,
                            'email_notification' => $email_notification,
                        ], 200)->header('Content-Type', 'application/json');

                    }
                }

                return \App::abort(404, "Order " . $orderID . " not found!");
            }
        } catch (\Exception $e) {
        }

        return \App::abort(422, "Cannot process data");
    }

    public function akuLakuCallbackPage(Request $request)
    {
        try{
            $akulaku = new AkuLaku();
            $response = $akulaku->setCredentials(config('services.akulaku.app_id'), config('services.akulaku.secret_key'))
                ->verifyCallbackPage($request->all());

            if ($response) {
                try{
                    $response = $akulaku->setCredentials(config('services.akulaku.app_id'), config('services.akulaku.secret_key'))
                        ->inquiryStatus($request->input('refNo'));

                    if($response && isset($response['data']) && isset($response['data']['status']) && $response['data']['status'] == 100 ){
                        return redirect(route('transaction.success', ['order_number' => $request->input('refNo')]));
                    }
                }catch (Exception $e){
                }
            }
        }catch (\Exception $e){
        }

        return redirect(route('transaction.pending', ['order_number' => $request->input('refNo')]));
    }

    private function updateOrderStatus(Order $order, int $status_code)
    {
        if($order->status == 'success') {
            return $order;
        }

        $str_status = translate_midtrans_status_code($status_code);
        if ($order->status == $str_status) {
            $order->updated_at = date('Y-m-d H:i:s');
        } else {
            $order->status = $str_status;
        }

        $order->save();
        return $order;
    }

    private function notifyUserByEmail(User $user, Product $product, bool $success, $activation_url = '')
    {
        $client = new Client();

        if ($product->isOfflineCourse() && $success) {
            // Khusus offline course
            $provider = $product->firstProvider();

            $body = [
                'recipient' => ['name' => $user->name, 'email'  => $user->email],
                'product_name'  => ($product->name) ?: 'Unknown',
                'provider_name'  => ($provider && !empty($provider->name)) ? $provider->name : 'Unknown',
            ];

            $url = env('AHMENG_API_URL') . '/v1/emails/pintaria/payment/successful_offline';
        } else {
            $body = [
                'recipient' => ['name' => $user->name, 'email'  => $user->email],
                'course_name'  => ($product->name)?: 'Unknown',
                'activation_url'  => ($activation_url)?: 'https://www.pintaria.com'
            ];

            $url = env('AHMENG_API_URL') . '/v1/emails/pintaria/payment/' . ( ($success)? 'successful' : 'failed' );
        }
        $headers = ['Content-Type' => 'application/json'];
        $result = $client->post($url, [
            'headers' => $headers,
            'body' => json_encode($body)
        ]);

        if ($result->getStatusCode() == 200 || $result->getStatusCode() == 201) {
            return true;
        }

        return false;
    }

    private function reformatData(array &$notif)
    {
        $payment_type = (isset($notif['payment_type']))? trim($notif['payment_type']) : '';

        if (!isset($notif['transaction_time']) || empty($notif['transaction_time'])) {
            $notif['transaction_time'] = date('Y-m-d H:i:s');
        }

        switch ($payment_type) {
            case 'bank_transfer':
                $notif['bank'] = 'unknown';  // Banks name
                $notif['masked_card'] = 'unknown'; // Bank acoounts
                // Support multiple transfers for single payment
                if (isset($notif['va_numbers']) && is_array($notif['va_numbers'])) {
                    $banks = $accs = '';

                    foreach ($notif['va_numbers'] as $k => $va) {
                        $banks .= isset($va['bank'])? $va['bank'] . ($va['bank'] && isset($notif['va_numbers'][$k+1])? ', ':'') : '';
                        $accs .= isset($va['va_number'])? $va['va_number'] . ($va['va_number'] && isset($notif['va_numbers'][$k+1])? ', ':'') : '';
                    }

                    if (empty($banks)) {
                        $banks = 'unknown';
                    } else if (empty($accs)) {
                        $accs = 'unknown';
                    }

                    $notif['bank'] = $banks;  // Banks name
                    $notif['masked_card'] = $accs; // Bank acoounts
                    $notif['status_message'] .= (isset($notif['payment_amounts']) && $notif['payment_amounts'] )? ' (' . json_encode($notif['payment_amounts']) . ')' : '';

                    unset($notif['va_numbers']);
                    unset($notif['payment_amounts']);

                } elseif (isset($notif['permata_va_number']) && is_string($notif['permata_va_number'])) {
                    $notif['bank'] = 'permata';  // Banks name
                    $notif['masked_card'] = $notif['permata_va_number']; // Bank acoounts

                }
                break;

            case 'bca_klikpay':
                $notif['bank'] = 'bca';  // Banks name
                $notif['masked_card'] = 'unknown'; // Bank acoounts
                break;

            case 'echannel':
                $notif['bank'] = 'echannel';  // Banks name
                $notif['masked_card'] = ( isset($notif['bill_key'])? $notif['bill_key'] : '' ) . '/' . ( isset($notif['biller_code'])? $notif['biller_code'] : '' ); // bill_key/biller_code
                break;

            case 'cimb_clicks':
                $notif['bank'] = 'cimb';  // Banks name
                $notif['masked_card'] = 'unknown'; // Bank acoounts
                break;

            case 'credit_card':
                break;
            default:
                break;
        }
    }
}
