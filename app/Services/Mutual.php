<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class Mutual {
    private $client;
    private $response;

    CONST VALUE_TYPE_PERCENTAGE = 'Percentage';
    CONST VALUE_TYPE_AMOUNT = 'Amount';

    public function __construct() {
        $this->response['status'] = 400;
        $this->response['message'] = 'Kode Referral tidak ditemukan atau sudah tidak berlaku.';
        $this->client = new Client();
    }

    /**
    * This function receive
    * 1. $referral_code => the referral code being used
    * 2. $id => the product id or bundle id
    * 3. $type => define which type of $id is passed to this function
    *    $type only receive:
    *       3.1 product (default)
    *       3.2 bundle
    * 4. user email => This will be used to prevent the user that own the code use it's own referral code
    */
    public function checkReferralCode($referral_code, $id, $type, $user_email) {
        try {
            $query_params = [
                'promo_code' => $referral_code,
                'email' => $user_email,
            ];

            switch ($type) {
                case 'bundle':
                    $query_params += ['bundle_id' => $id];
                    break;
                default:
                    $query_params += ['product_id' => $id];
                    break;
            }

            $endpoint = config('services.mutual.check_promo_url');
            $request = $this->client->get($endpoint, [
                'query' => $query_params
            ]);

            $this->response['status'] = $request->getStatusCode();
            if($this->response['status'] == 200) {

                $body = json_decode((string) $request->getBody(), true);
                if($body['is_valid']) {
                    $value = null;
                    switch ($body['type']) {
                        case self::VALUE_TYPE_PERCENTAGE:
                            $value = $body['value'] . '%';
                            break;
                        
                        case self::VALUE_TYPE_AMOUNT:
                            $value = rupiah_number_format($body['value']);
                            break;
                    }
                    $body['formatted_value'] = $value;
                }
                $this->response['message'] = $body['message'];
                $this->response['body'] = $body;
            }
        } catch (Exception $e) {
        }
        return $this->response;
    }

    public function checkUserReferralCode($referral_code, $email) {
        try {
            $query_params = [
                'promo_code' => $referral_code,
                'email' => $email,
            ];

            $endpoint = config('services.mutual.check_user_promo_url');
            $request = $this->client->get($endpoint, [
                'query' => $query_params
            ]);

            $this->response['status'] = $request->getStatusCode();
            if($this->response['status'] == 200) {

                $body = json_decode((string) $request->getBody(), true);
                if($body['is_valid']) {
                    $value = null;
                    switch ($body['type']) {
                        case self::VALUE_TYPE_PERCENTAGE:
                            $value = $body['value'] . '%';
                            break;
                        
                        case self::VALUE_TYPE_AMOUNT:
                            $value = rupiah_number_format($body['value']);
                            break;
                    }
                    $body['formatted_value'] = $value;
                }
                $this->response['message'] = $body['message'];
                $this->response['body'] = $body;
                return $this->response;
            } else {
                return false;
            }
        } catch (Exception $e) {
        }
    }

    public function referrerReward($order_number) {
        try {
            $endpoint = config('services.mutual.referrer_reward_url');
            $request = $this->client->post($endpoint, [
                'json' => [
                    'order_number' => $order_number
                ]
            ]);

            $this->response['status'] = $request->getStatusCode();
            if($this->response['status'] == 201) {
                $this->response['message'] = 'success';
            }
        } catch (Exception $e) {
        }
        return $this->response;
    }

    /**
    * This function receive $data parameter with
    * 1. name (required)
    * 2. email (required)
    * 3. phone_number (optional)
    * 4. flag (required)
    */
    public function generateReferralCode($data) {
        $data['flag'] = 'pintaria';
        try {
            $endpoint = config('services.mutual.generate_referral_code_url');
            $request = $this->client->post($endpoint, [
                'json' => $data
            ]);

            $this->response['status'] = $request->getStatusCode();
            if($this->response['status'] == 201) {
                $body = json_decode($request->getBody(), true);
                $this->response['message'] = 'success';
                $this->response['body'] = $body['data'];
            }
        } catch (Exception $e) {
        }
        return $this->response;
    }
}
