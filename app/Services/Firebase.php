<?php
namespace App\Services;

use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\RequestException;
use Config;

class Firebase {
    CONST FORGOT_PASSWORD_ENDPOINT = 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/getOobConfirmationCode?key=[API_KEY]';
    CONST REGISTER_ENDPOINT = "https://www.googleapis.com/identitytoolkit/v3/relyingparty/signupNewUser?key=[API_KEY]";
    CONST UPDATE_PASSWORD_ENDPOINT = 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/setAccountInfo?key=[API_KEY]';
    CONST SIGN_IN_ENDPOINT = 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/verifyPassword?key=[API_KEY]';

    private $client;
    private $response;

    public function __construct() {
        $this->response['status'] = 400;
        $this->response['message'] = 'Maaf, saat ini kami sedang kesulitan untuk memproses data anda. Silakan mencoba kembali nanti.';
        $this->response['error_code'] = null;
        $this->client = new Client();
    }

    public function login($email, $password, $check = true)
    {
        try {
            $endpoint = self::prepareEndpoint(self::SIGN_IN_ENDPOINT);
            $request = $this->client->post($endpoint, [
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'returnSecureToken' => true,
                ]
            ]);

            $this->response['status'] = $request->getStatusCode();
            $this->response['body'] = json_decode((string) $request->getBody());
            $this->response['message'] = 'success';
        } catch (RequestException $e) {
            $body_response = json_decode((string) $e->getResponse()->getBody());
            $message = $body_response->error->message;
            $this->response['status'] = $check ? 200 : $e->getResponse()->getStatusCode();
            $this->response['error_code'] = $message;
            switch ($message) {
                case 'INVALID_PASSWORD':
                    $this->response['message'] = 'Password yang Anda masukkan salah.';
                    break;
                case 'EMAIL_NOT_FOUND':
                    $this->response['message'] = 'Maaf, email tidak ditemukan atau sudah di hapus.';
                    break;
                case 'USER_DISABLED':
                    $this->response['message'] = 'Maaf, Akun anda telah dinonaktifkan.';
                    break;
            }
            return $this->response;
        }

        return $this->response;
    }

    public function register($email, $password) {
        try {
            $endpoint = self::prepareEndpoint(self::REGISTER_ENDPOINT);
            $request = $this->client->post($endpoint, [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'returnSecureToken' => true
                ]
            ]);

            $this->response['status'] = $request->getStatusCode();
            $this->response['body'] = json_decode((string) $request->getBody());
            $this->response['message'] = 'success';
        } catch (RequestException $e) {
            $body_response = json_decode((string) $e->getResponse()->getBody());
            $message = $body_response->error->message;
            $this->response['status'] = $e->getResponse()->getStatusCode();

            $this->response['error_code'] = $message;
            switch ($message) {
                case 'EMAIL_EXISTS':
                    $this->response['message'] = 'Maaf, email anda sudah terdaftar di sistem kami.';
                    break;
                case 'OPERATION_NOT_ALLOWED':
                    $this->response['message'] = 'Maaf, register dengan menggunakan password sedang tidak berlaku';
                    break;
                case 'TOO_MANY_ATTEMPTS_TRY_LATER':
                    $this->response['message'] = 'Maaf, saat ini kami mendeteksi kegiatan yang tidak biasa. Silakan mencoba kembali nanti.';
                    break;
            }
        } catch (Exception $e) {
        }
        return $this->response;
    }

    public function forgotPassword($email) {
        try {
            $request = $this->client->post(self::prepareEndpoint(self::FORGOT_PASSWORD_ENDPOINT), [
                'json' => [
                    'requestType' => 'PASSWORD_RESET',
                    'email' => $email
                ]
            ]);

            $this->response['status'] = $request->getStatusCode();
            $this->response['body'] = json_decode((string) $request->getBody());
            $this->response['message'] = 'success';
        } catch (RequestException $e) {
            $body_response = json_decode((string) $e->getResponse()->getBody());
            $message = $body_response->error->message;
            $this->response['status'] = $e->getResponse()->getStatusCode();

            if($message == 'EMAIL_NOT_FOUND') {
                $this->response['status'] = 404;
                $this->response['message'] = 'Maaf, email tidak ditemukan atau sudah di hapus.';
            }
        } catch (Exception $e) {
        }
        return $this->response;
    }

    public function updatePassword($email, $current_password, $new_password) {
        try {
            $request = $this->client->post(self::prepareEndpoint(self::SIGN_IN_ENDPOINT), [
                'json' => [
                    'email' => $email,
                    'password' => $current_password,
                    'returnSecureToken' => true
                ]
            ]);
        } catch (Exception $e) {
            $body_response = json_decode((string) $e->getResponse()->getBody());
            $message = $body_response->error->message;
            $this->response['status'] = $e->getResponse()->getStatusCode();
            switch ($message) {
                case 'INVALID_PASSWORD':
                    $this->response['message'] = 'Password yang Anda masukkan salah.';
                    break;
                case 'EMAIL_NOT_FOUND':
                    $this->response['message'] = 'Maaf, email tidak ditemukan atau sudah di hapus.';
                    break;
                case 'USER_DISABLED':
                    $this->response['message'] = 'Maaf, Akun anda telah dinonaktifkan.';
                    break;
            }
            return $this->response;
        }
        $response = json_decode((string) $request->getBody());

        try {
            $request = $this->client->post(self::prepareEndpoint(self::UPDATE_PASSWORD_ENDPOINT), [
                'json' => [
                    'idToken' => $response->idToken,
                    'password' => $new_password,
                    'returnSecureToken' => true
                ]
            ]);

            $this->response['status'] = $request->getStatusCode();
            $this->response['body'] = json_decode((string) $request->getBody());
            $this->response['message'] = 'success';
        } catch (Exception $e) {
            $body_response = json_decode((string) $e->getResponse()->getBody());
            $message = $body_response->error->message;
            $this->response['status'] = $e->getResponse()->getStatusCode();
            if($message == 'INVALID_ID_TOKEN') {
                $this->response['message'] = 'Maaf, token yang diberikan tidak valid.';
            } else if ($message == 'WEAK_PASSWORD : Password should be at least 6 characters') {
                $this->response['message'] = 'Maaf, password yang dipasang terlalu lemah.';
            }
        }
        return $this->response;
    }

    private function prepareEndpoint($endpoint) {
        return str_replace("[API_KEY]", Config::get('services.firebase.firebase_api_key'), $endpoint);
    }
}