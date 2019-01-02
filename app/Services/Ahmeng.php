<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class Ahmeng {
    private $client;
    private $response;

    public function __construct() {
        $this->response['status'] = 400;
        $this->response['message'] = 'Maaf, kami sedang kesulitan mengirim anda email.';
        $this->client = new Client();
    }

   
    public function sendAccountConfirmationEmail($data) {
        try {
            $endpoint = env('AHMENG_API_URL') . '/v1/emails/pintaria/account/activation';
            $request = $this->client->post($endpoint, [
                'json' => $data
            ]);

            $this->response['status'] = $request->getStatusCode();
        } catch (Exception $e) {
        }
        return $this->response;
    }


    public function sendContactEmail($data) {
        try {
            $endpoint = config('services.pintaria.contact');
            $request = $this->client->post($endpoint, [
                'json' => $data
            ]);

            $this->response['status'] = $request->getStatusCode();
        } catch (Exception $e) {
        }
        return $this->response;
    }

    public function sendWelcomeEmail($data) {
        try {
            $endpoint = config('services.pintaria.welcome');
            $request = $this->client->post($endpoint, [
                'json' => $data
            ]);

            $this->response['status'] = $request->getStatusCode();
        } catch (Exception $e) {
        }
        return $this->response;
    }

    public function sendReferralEmail($data) {
        try {
            $endpoint = config('services.pintaria.referral');
            $request = $this->client->post($endpoint, [
                'json' => $data
            ]);

            $this->response['status'] = $request->getStatusCode();
        } catch (Exception $e) {
        }
        return $this->response;
    }

    public function sendParticipantCardEmail($data) {
        try {
            $endpoint = env('AHMENG_API_URL') . '/v1/emails/pintaria/payment/send_offline_participant_card';
            $request = $this->client->post($endpoint, [
                'json' => $data
            ]);

            $this->response['status'] = $request->getStatusCode();
        } catch (Exception $e) {
        }
        return $this->response;
    }

    public function sendMoreInfoEmail($data) {
        try {
            $endpoint = env('AHMENG_API_URL') . '/v1/emails/pintaria/admin/thanking_for_information_request';
            $request = $this->client->post($endpoint, [
                'json' => $data
            ]);

            $this->response['status'] = $request->getStatusCode();
        } catch (Exception $e) {
        }
        return $this->response;
    }
}
