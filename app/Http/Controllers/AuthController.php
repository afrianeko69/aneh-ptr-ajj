<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\Captcha;
use App\Services\Firebase;
use Auth;
use Config;
use Request;
use Session;
use URL;

class AuthController extends Controller
{
    public function daftar()
    {
        $previous_url = URL::previous();
        if(Request::get('previous_url')) {
            $previous_url = Request::get('previous_url');
        }

        $redirect_to = config('services.pintaria_auth_provider.register_url');
        if(Request::get('app_affiliate_domain_url')) {
            $encoded_domain = base64_encode(Request::get('app_affiliate_domain_url'));

            // Change samatoredu.dev to samatoredu.pintaria.dev
            $previous_url = str_replace(Request::get('app_affiliate_domain_url'), Request::get('app_affiliate_logged_in_domain_url'), $previous_url);
            $encoded_previous_url = base64_encode($previous_url);

            $redirect_to .= '?url=' . $encoded_domain . '&domain=' . $encoded_domain . '&previous_url= ' . $encoded_previous_url;
        }else{
            $encoded_domain = base64_encode(Request::getScheme() . '://' . Request::getHttpHost());
            $encoded_previous_url = base64_encode($previous_url);

            $redirect_to .= '?domain=' . $encoded_domain . '&previous_url=' . $encoded_previous_url;
        }

        return redirect($redirect_to)->withCookie(cookie(config('constants.previous_page'), $previous_url, 2));
    }

    public function logout()
    {
        Auth::logout();

        $redirection_url = url('');
        if(Request::get('app_affiliate_domain_url')) {
            $redirection_url = Request::get('app_affiliate_full_domain_url');
        }
        $ssoAuthLogoutUrl = config('services.pintaria_auth_provider.url') . '/logout?redirection_url=' . $redirection_url;

        return redirect($ssoAuthLogoutUrl);
    }

    public function forgotPassword()
    {
        return view('shared.pintaria3.forgot-password');
    }

    public function submitForgotPassword(Requests\ForgotPasswordRequest $request)
    {
        $data = $request->all();
        $captcha_response = $data['g-recaptcha-response'];

        if(!isCaptchaStillValid($captcha_response)) {
            $captcha = new Captcha($captcha_response);
            $captcha_validation = $captcha->validate();

            $is_success_captcha = false;
            if($captcha_validation && $captcha_validation->getStatusCode() == 200) {
                $body = json_decode((string)$captcha_validation->getBody());
                if($body->success) {
                    $is_success_captcha = true;
                    setCaptchaValidInSession($captcha_response);
                }
            }

            if(!$is_success_captcha) {
                return response()->json(['status' => 422, 'message' => 'Silahkan mengulangi captcha kembali.']);
            }
        }

        $firebase = new Firebase();
        $request_forgot_password = $firebase->forgotPassword($data['email']);
        if($request_forgot_password['status'] == 200) {
            Session::put(Config::get('constants.success_forgot_password'), true);
        }
        return response()->json($request_forgot_password);
    }

    public function forgotPasswordCheckEmail()
    {
        if(Session::has(Config::get('constants.success_forgot_password'))) {
            Session::forget(Config::get('constants.success_forgot_password'));
            return view('shared.pintaria3.success-forgot-password');
        }
        return redirect(route('home'));
    }

}
