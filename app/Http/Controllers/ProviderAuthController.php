<?php

namespace App\Http\Controllers;


use App\Events\ListKelasSayaEvent;
use App\Events\GenerateReferralCodeEvent;
use App\User;
use Auth;
use Cache;
use Exception;
use Illuminate\Http\Request;
use Session;
use Socialite;
use TCG\Voyager\Models\Role;
use URL;
use App\Tracker;

class ProviderAuthController extends Controller
{

    private $provider = 'pintaria-auth';

    public function login(Request $request) {
        $previous_url = URL::previous();
        if($request->get('previous_url')) {
            $previous_url = $request->get('previous_url');
        }

        $no_redirection_lists = [
            route('konfirmasi.akun'),
            config('services.pintaria_auth_provider.url'),
        ];

        foreach($no_redirection_lists as $list) {
            if(strpos($previous_url, $list) !== false) {
                $previous_url = url('');
                break;
            }
        }

        // This will handle the affiliate domain if exists in request
        $affiliate_logged_in_domain = url('');
        if($request->get('app_affiliate_logged_in_domain_url')) {
            $affiliate_logged_in_domain = $request->get('app_affiliate_full_logged_in_domain_url');
            $previous_url = getRequestPath($affiliate_logged_in_domain, $previous_url);
        }

        /** Date: Tue, Apr 17th 2018
        * This is used to handle the redirection after login using social media
        * Because when the user login using social media, the user already logged in on sso
        * but not logged in in pintaria then from sso we redirect the user to /login in pintaria
        * that cause the user last session to homepage and when login success, the user will be redirected to homepage.
        * This is used to prevent the previous page of expected redirection change when social media login.
        **/
        if(!\Cookie::has(config('constants.previous_page'))) {;
            \Cookie::queue(\Cookie::make(config('constants.previous_page'), $previous_url, 2));
        }

        return Socialite::driver($this->provider)->redirect();
    }

    public function callback() {
        try {
            $userProvider = Socialite::driver($this->provider)->stateless()->user();
        } catch (Exception $e) {
            Session::flash('message-danger', 'Maaf, terdapat kendala ketika mengakses Akun Anda. Mohon mencoba dalam beberapa saat lagi.');
            return redirect(route('home'));
        }

        $authUser = $this->findOrRegister($userProvider, $this->provider);
        if ($authUser) {
            $authUser->update(['last_login_at' => date('Y-m-d H:i:s')]);
        }
        Auth::login($authUser, $userProvider->remember);
        Tracker::updateTracker('login_user');

        $user = auth()->user();
        $cache_key = 'event_list_kelas_saya_user_'.$user->id;
        $event_triggered = cache($cache_key, 0);
        if($event_triggered < 3) {
            if($event_triggered == 0) {
                Cache::forever($cache_key, 1);
            }
            Cache::increment($cache_key, 1);
            event(new ListKelasSayaEvent($user));
        }

        if(!$authUser->default_referral_code->first()) {
            $event_data = [
                'name' => $authUser->name,
                'email' => $authUser->email,
                'phone_number' => $authUser->phone_number,
            ];
            event(new GenerateReferralCodeEvent($event_data));
        }

        Session::flash('message-success', 'Anda berhasil masuk ke akun Anda.');
        if(\Cookie::has(config('constants.previous_page'))) {
            $redirect = \Cookie::get(config('constants.previous_page'));
            \Cookie::queue(\Cookie::forget(config('constants.previous_page')));

            $change_redirection = ['facebook.com', 'storage-files', 'accounts.google', 'linkedin'];
            $is_change_redirection = false;
            foreach($change_redirection as $url) {
                if(strpos($redirect, $url) !== false) {
                    $is_change_redirection = true;
                    break;
                }
            }

            if(!$is_change_redirection) {
                return redirect($redirect);
            }
        }

        return redirect('/');
    }

    private function findOrRegister($userProvider) {
        $user = User::where([
            'email' => $userProvider->email,
        ])->first();

        if($user) {
            $user->provider_id = $userProvider->id;
            $user->provider = $this->provider;
            $user->token = $userProvider->token;
            $user->join_at = $userProvider->user['created_at'];
            $user->save();

            return $user;
        }

        config(['voyager.user.default_role' => 'student']);

        return User::create([
            'name' => $userProvider->name,
            'provider_id' => $userProvider->id,
            'provider' => $this->provider,
            'email' => $userProvider->email,
            'avatar' => $userProvider->getAvatar(),
            'token' => $userProvider->token,
            'role_id' => Role::firstOrCreate(['name' => 'student'], ['name' => 'student', 'display_name' => 'Student'])->id,
            'password' => bcrypt('secret'),
            'join_at' => $userProvider->user['created_at'],
        ]);
    }

    public function masukKelas(Request $request)
    {
        $link = $request->get('masuk_kelas');
        if(!$link) {
            return redirect()->back();
        }

        $user = $request->user();

        $response = Socialite::driver($this->provider)->tokenLink($user->token);

        $query = http_build_query([
            'redirect_back' => $link . '?kelas_saya=' . route('kelas.saya'),
        ]);

        $magicLink = config('services.lms.url') . '/sso-login/' . $response['token'] . '?' .  $query;

        return redirect($magicLink);
    }

    public function callbackRegister(Request $request)
    {
        if ($token = $request->get('register_token', false)) {
            Auth::login(User::whereRegisterToken($token)->first());
            $user = User::whereRegisterToken($token)->first();
            $user->register_token = '';
            $user->token = $request->get('token');
            $user->save();
        }

        if($request->has('previous_url')){
            return redirect($request->get('previous_url'));
        }

        return redirect('/');
    }
}
