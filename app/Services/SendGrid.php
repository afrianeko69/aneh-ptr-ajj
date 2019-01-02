<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class SendGrid {
    private $response;
    private $client;

    CONST WEB_PINTARIA_MARKETING_CAMPAIGN_ID = 2313881;
    CONST REGISTER_RECIPIENT_ENDPOINT = 'https://api.sendgrid.com/v3/contactdb/recipients';
    CONST REGISTER_RECIPIENT_TO_MARKETING_CAMPAIGN_ENDPOINT = 'https://api.sendgrid.com/v3/contactdb/lists/{list_id}/recipients/{recipient_id}';

    public function __construct() {
        $this->client = new Client();
        $this->response = [
            'status' => 400,
            'message' => 'Maaf, terdapat kesalahan dalam memproses request anda.'
        ];
    }

    private function getHeaders() {
        return [
            'Authorization' => 'Bearer ' . config('services.sendgrid.sendgrid_api_key')
        ];
    }

    /*
    * $data may consist of
    * 1. email
    * 2. last_name
    * 3. pet
    * 4. age
    * From the POST request to REGISTER_RECIPIENT_ENDPOINT you'll get id of user in sendgrid in
    * `persisted_recipients` key
    */
    public function subscribeUserToMarketingCampaign($data) {
        $user_sendgrid_id = null;
        $request = $this->client->post(self::REGISTER_RECIPIENT_ENDPOINT, [
            'headers' => self::getHeaders(),
            'json' => [$data]
        ]);

        if($request->getStatusCode() == 201) {
            $body = json_decode((string) $request->getBody(), true);
            $user_sendgrid_id = $body['persisted_recipients'][0];
        }

        if(!$user_sendgrid_id) {
            $this->response['message'] = 'Maaf, kami belum bisa mengambil data dari sendgrid';
            return $this->response;
        }

        $endpoint = str_replace('{list_id}', self::WEB_PINTARIA_MARKETING_CAMPAIGN_ID, self::REGISTER_RECIPIENT_TO_MARKETING_CAMPAIGN_ENDPOINT);
        $endpoint = str_replace('{recipient_id}', $user_sendgrid_id, $endpoint);
        $request = $this->client->post($endpoint, [
            'headers' => self::getHeaders(),
        ]);

        if($request->getStatusCode() == 201) {
            $this->response['status'] = $request->getStatusCode();
            $this->response['message'] = 'created';
        }
        return $this->response;
    }
}