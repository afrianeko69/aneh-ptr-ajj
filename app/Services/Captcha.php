<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;

class Captcha {
    private $captcha_key;

    public function __construct($captcha_key) {
        $this->setCaptchaKey($captcha_key);
    }

    public function setCaptchaKey($captcha_key) {
        $this->captcha_key = $captcha_key;
    }

    public function getCaptchaKey(){
        return $this->captcha_key;
    }

    public function validate(){
        try{
            $client = new Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => env('RECAPTCHA_SERVER_KEY'),
                    'response' => $this->getCaptchaKey()
                ]
            ]);
            return $response;
        } catch (Exception $e) {
            return null;
        }
    }
}