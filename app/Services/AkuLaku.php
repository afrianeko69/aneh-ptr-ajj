<?php

namespace App\Services;

use Exception;
use Requests;

class AkuLaku
{
    private $id;
    private $key;
    private $environment = 'development';
    private $url;
    private $options = [
        'timeout' => 0
    ];
    private $parameters = [
        'appId',
        'content',
        'refNo',
        'userAccount',
        'receiverName',
        'receiverPhone',
        'province',
        'city',
        'street',
        'postcode',
        'callbackPageUrl',
        'details',
        'virtualDetails',
        'extraInfo',
        'status',
        'periods',
        'monthlyInstallmentPayment',
        'sign'
    ];

    CONST DEV_URL = 'https://test.app.akulaku.com';
    CONST PROD_URL = 'https://app.akulaku.com';
    CONST DEV_PAYMENT_URL = 'https://test.mall.akulaku.com/v2/openPay.html';
    CONST PROD_PAYMENT_URL = 'https://mall.akulaku.com/v2/openPay.html';

    public function __construct()
    {
        $this->url = self::DEV_URL;
        $environment = (env('APP_DEBUG') === true) ? 'development' : 'production';
        $this->setEnvironment($environment);
    }

    public function setCredentials($id, $key)
    {
        $this->id = $id;
        $this->key = $key;
        return $this;
    }

    public function setEnvironment($environment)
    {
        if ($environment == 'production') {
            $this->environment = $environment;
            $this->url = self::PROD_URL;
        } else {
            $this->options = [
                'verify' => FALSE
            ];
        }
    }

    private function _sign($content)
    {
        $string = $this->id . $this->key . $content;
        $string = base64_encode(hash('sha512', $string, TRUE));
        return str_replace(['+', '/', '='], ['-', '_', ''], $string);
    }

    // generate order
    public function generateOrder($params)
    {
        $params['appId'] = $this->id;
        $content = $this->generateContent($params, ['refNo', 'userAccount', 'receiverName', 'receiverPhone', 'province', 'city', 'street', 'postcode', 'callbackPageUrl', 'details', 'virtualDetails', 'extraInfo']);

        $params['sign'] = $this->_sign($content);
        $parameters = $this->generateParameters($params, [
            'appId',
            'refNo',
            'userAccount',
            'receiverName',
            'receiverPhone',
            'province',
            'city',
            'street',
            'postcode',
            'callbackPageUrl',
            'details',
            'virtualDetails',
            'extraInfo',
            'sign'
        ]);

        try {
            $request = Requests::post($this->url . '/api/json/public/openpay/new.do', [], $parameters, $this->options);
            $result = json_decode($request->body, true);

            if(isset($result['success']) && $result['success']){
                $response['status'] = $request->status_code;
                $response['message'] = 'success';
                $response['data'] = json_decode(json_encode(json_decode($request->body, true)['data'], true), true);

                return $response;
            }
        } catch (Exception $e) {
        }

        return null;
    }

    // payment entry
    public function paymentEntry($refNo)
    {
        return ($this->environment == 'production' ? self::PROD_PAYMENT_URL : self::DEV_PAYMENT_URL) . '?appId=' . $this->id . '&refNo=' . $refNo . '&sign=' . $this->_sign($refNo) . '&lang=id';
    }

    // inquiry status
    public function inquiryStatus($refNo)
    {
        try {
            $request = Requests::get($this->url . '/api/json/public/openpay/status.do?appId=' . $this->id . '&refNo=' . $refNo . '&sign=' . $this->_sign($refNo), [], $this->options);
            $result = json_decode($request->body, true);

            if(isset($result['success']) && $result['success']){
                $response['status'] = $request->status_code;
                $response['message'] = 'success';
                $response['data'] = json_decode(json_encode(json_decode($request->body, true)['data'], true), true);

                return $response;
            }
        } catch (Exception $e) {
        }

        return null;
    }

    public function verifyCallbackPage($params)
    {
        if ($params['sign'] == $this->_sign($params['refNo'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function verifyCallbackAPI($params)
    {
        $content = $this->generateContent($params, ['refNo', 'status']);

        if ($params['sign'] == $this->_sign($content)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function cancelSKU($params)
    {
        $params['appId'] = $this->id;
        $params['sign'] = $this->_sign($params['refNo'] . $params['skuId'] . $params['skuQty']);
        try {
            $request = Requests::post($this->url . '/api/json/public/openpay/cancel.do', [], $params, $this->options);
            $result = json_decode($request->body, true);

            if(isset($result['success']) && $result['success']){
                $response['status'] = $request->status_code;
                $response['message'] = 'success';
                $response['data'] = json_decode(json_encode(json_decode($request->body, true)['data'], true), true);

                return $response;
            }
        } catch (Exception $e) {
        }

        return null;
    }

    public function cancelPayment($params)
    {
        $params['appId'] = $this->id;
        $params['sign'] = $this->_sign($params['refNo']);
        try {
            $request = Requests::post($this->url . '/api/json/public/openpay/payment/cancel.do', [], $params, $this->options);
            $result = json_decode($request->body, true);

            if(isset($result['success']) && $result['success']){
                $response['status'] = $request->status_code;
                $response['message'] = 'success';
                $response['data'] = json_decode(json_encode(json_decode($request->body, true)['data'], true), true);

                return $response;
            }
        } catch (Exception $e) {
        }

        return null;
    }

    public function confirmReceipt($params)
    {
        $params['appId'] = $this->id;
        $params['sign'] = $this->_sign($params['refNo']);
        try {
            $request = Requests::post($this->url . '/api/json/public/openpay/order/receipt.do', [], $params, $this->options);
            $result = json_decode($request->body, true);

            if(isset($result['success']) && $result['success']){
                $response['status'] = $request->status_code;
                $response['message'] = 'success';
                $response['data'] = json_decode(json_encode(json_decode($request->body, true)['data'], true), true);

                return $response;
            }
        } catch (Exception $e) {
        }

        return null;
    }

    public function changeStatus($params)
    {
        $params['appId'] = $this->id;
        $params['sign'] = $this->_sign($params['refNo'] . $params['status']);

        try {
            $request = Requests::post($this->url . '/api/json/public/openpay/test/status/change.do', [], $params, $this->options);
            $result = json_decode($request->body, true);

            if(isset($result['success']) && $result['success']){
                $response['status'] = $request->status_code;
                $response['message'] = 'success';
                $response['data'] = json_decode(json_encode(json_decode($request->body, true)['data'], true), true);

                return $response;
            }
        } catch (Exception $e) {
        }

        return null;
    }

    public function getPaymentStatus($status)
    {
        switch ($status) {
            case 1 :
                return 'Pending';
                break;
            case 90 :
                return 'Failed';
                break;
            case 91 :
                return 'Refund';
                break;
            case 92 :
                return 'Cancelled';
                break;
            case 100 :
                return 'Success';
                break;
            case 101 :
                return 'Receipted';
                break;
            default :
                return 'Unknown';
                break;
        }
    }

    public function getErrorCode($code)
    {
        switch ($code) {
            Case 'SYSTEM.0001' :
                return "Unknow error.";
                break;
            Case 'SYSTEM.0002' :
                return "Illegal parameter(s).";
                break;
            Case 'openpay.0001' :
                return "invalid signature.";
                break;
            Case 'openpay.0002' :
                return "order exists.";
                break;
            Case 'openpay.0003' :
                return "error app id.";
                break;
            Case 'openpay.0004' :
                return "order not exists.";
                break;
            Case 'openpay.0006' :
                return "can’t refund, order has refunded.";
                break;
            Case 'openpay.0007' :
                return "can’t refund, order has not successful.";
                break;
            Case 'openpay.0008' :
                return "can't cancel, order has successful.";
                break;
            Case 'openpay.0009' :
                return "order has not paid.";
                break;
        }
    }
    
    private function generateContent($array, $params){
        $contents = '';
        foreach ($this->parameters as $parameter){
            if(in_array($parameter, $params)){
                if(is_array($array[$parameter]) && !empty($array[$parameter])){
                    $value = json_encode($array[$parameter]);
                }elseif(!is_array($array[$parameter]) && $array[$parameter] != ''){
                    $value = $array[$parameter];
                }else{
                    continue;
                }

                $contents .= $value;
            }
        }
        
        return $contents;
    }

    private function generateParameters($array, $params){
        $results = [];
        foreach ($this->parameters as $parameter){
            if(in_array($parameter, $params)){
                if(is_array($array[$parameter]) && !empty($array[$parameter])){
                    $value = json_encode($array[$parameter]);
                }elseif(!is_array($array[$parameter]) && $array[$parameter] != ''){
                    $value = $array[$parameter];
                }else{
                    continue;
                }

                $results[$parameter] = $value;
            }
        }

        return $results;
    }
}