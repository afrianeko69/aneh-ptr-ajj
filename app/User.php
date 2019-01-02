<?php

namespace App;

use App\Affiliate;
use App\Services\Ahmeng;
use App\Services\Firebase;
use App\Services\Lms;
use App\UserAccountProvider;
use App\Events\GenerateReferralCodeEvent;
use Auth;
use Session;
use Exception;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Intervention\Image\Facades\Image;
use Storage;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'affiliate_id',
        'name', 
        'email', 
        'avatar',
        'password', 
        'provider', 
        'provider_id', 
        'token',
        'register_token',
        'home_number',
        'phone_number',
        'address',
        'profile_picture',
        'join_at',
        'registered_from',
        'has_access_thank_you_page',
        'last_login_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function affiliateId()
    {
        return $this->belongsTo(Affiliate::class, 'affiliate_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role','role_id');
    }

    public function account_providers() {
        return $this->hasMany('App\UserAccountProvider', 'user_id');
    }

    public function courses() {
        return $this->hasMany('App\ClassAttendee');
    }

    public function referral_codes() {
        return $this->hasMany('App\UserReferralCode');
    }

    public function default_referral_code() {
        return $this->referral_codes()->where('is_default', 1);
    }

    public function studentLeads() {
        return $this->hasManyThrough('App\StudentLead', 'App\UserReferralCode');
    }

    public function scopeHasNotAccessThankYouPage($query, $email) {
        return $query->where('email', $email)
                    ->where('has_access_thank_you_page', 0);
    }

    public function scopeCheckRole($query){
        if ( !empty(Auth::user()) && empty(Auth::user()->affiliate_id))  {
            $role = $query->where('id',Auth::user()->id)->first()->role->name;
            if ($role == 'affiliate') {
                return 'affiliate_admin';
            }
        }        
        return 'affiliate';
    }

    public static function register($data) {
        $response = [
            'status' => 400,
            'message' => 'Maaf, kami kesulitan memproses data anda.',
            'data' => null
        ];

        $account_provider = $data['register_using'];
        $is_valid_provider = UserAccountProvider::isValidProvider($account_provider);
        if(!$is_valid_provider) {
            $response['message'] = 'Mohon maaf, harap menghubungi admin kami mengenai masalah ini.';
            return $response;
        }

        $is_no_password = UserAccountProvider::isNoPasswordProvider($account_provider);
        if($is_no_password) {
            $data['password'] = $data['name'] . $data['email'] . uniqid();
        }

        $data['registered_from'] = url('/');

        if(isset($data['user_from']) && !empty($data['user_from'])){
            $redirect_to =  buildQueryParameter($data['user_from'] . '/terima-kasih', [
                'email' => $data['email']
            ]);
        }else{
            $redirect_to = route('terimakasih', ['email' => $data['email']]);
        }

        if(Session::has(config('constants.register_domain_page'))) {
            $redirect_to = Session::get(config('constants.register_domain_page')) . '/daftar/callback';
            Session::forget(config('constants.register_domain_page'));
        }

        $redirect_masuk = route('masuk');
        if(isset($data['user_from'])) {

            $affiliate = Affiliate::where('domain_url', removeHttp($data['user_from']))
                        ->select(['domain_url', 'logged_in_domain_url'])
                        ->first();

            if($affiliate) {
                $data['registered_from'] = $affiliate->fullDomainUrl;
                $redirect_to = $affiliate->fullLoggedInDomainUrl . 'daftar/callback';
                Session::put(config('constants.register_previous_page', $data['user_from']));
                $redirect_masuk = $affiliate->masuk;
            }
        }

        if(Session::has(config('constants.register_previous_page'))) {
            $redirect_to = buildQueryParameter($redirect_to, [
                "previous_url" => Session::get(config('constants.register_previous_page'))
            ]);
            Session::forget(config('constants.register_previous_page'));
        }

        $firebase = new Firebase();
        $register_new_user = $firebase->login($data['email'], $data['password']);

        if($register_new_user['error_code'] === 'EMAIL_NOT_FOUND') {
            $register_new_user = $firebase->register($data['email'], $data['password']);
        } else {
            $register_new_user['error_code'] = 'EMAIL_EXISTS';
        }

        if($register_new_user['error_code'] == 'EMAIL_EXISTS'){

            //check if user already register with email & password or just social media
            $user = self::where('email', $data['email'])->first();
            if(!$user) {
                return $register_new_user;
            }

            $user_account_providers = $user->account_providers()->get();
            if($user_account_providers->isEmpty()) {
                $user->account_providers()->create([
                    'account_provider' => UserAccountProvider::SSO_PROVIDER
                ]);
                if($account_provider == UserAccountProvider::SSO_PROVIDER) {
                    return $register_new_user;
                }
            }

            $is_possible_to_create = true;
            $is_any_match_provider = false;
            foreach($user_account_providers as $prov) {
                $prov_account_provider = $prov->account_provider;
                if($prov_account_provider == UserAccountProvider::SSO_PROVIDER && $account_provider == $prov_account_provider) {
                    $is_possible_to_create = false;
                }

                if($prov_account_provider == $account_provider) {
                    $is_any_match_provider = true;
                }
            }

            if(!$is_possible_to_create) {
                return $register_new_user;
            } else {
                if(!$is_any_match_provider) {
                    if($account_provider == UserAccountProvider::SSO_PROVIDER) {
                        //update firebase password
                        $firebase = new Firebase();
                        $update_password = $firebase->updatePassword($user->email, base64_decode($user->password), $data['password']);
                        if($update_password['status'] != 200) {
                            return $update_password;
                        }

                        // Update user password
                        $user->password = bcrypt($data['password']);
                        $user->has_access_thank_you_page = 0;
                        $user->save();

                        //send confirmation email
                        $sendInfo = [
                            "recipient" => ["email" => $user->email, "name" => $user->name],
                            "activation_url" => route('konfirmasi.akun')
                        ];
                        $ahmeng = new Ahmeng;
                        $ahmeng->sendAccountConfirmationEmail($sendInfo);

                        // Save to user account provider
                        $user->account_providers()->create([
                            'account_provider' => $account_provider
                        ]);

                        $response['status'] = 201;
                        $response['message'] = 'success';
                        $response['data']['type'] = 'redirection';
                        $response['data']['redirect_to'] = buildQueryParameter($redirect_to, [
                            "email" => $data['email']
                        ]);

                        return $response;
                    }

                    // Save to user account provider
                    $user->account_providers()->create([
                        'account_provider' => $account_provider
                    ]);
                }

                $response['status'] = 201;
                $response['message'] = 'success';
                $response['data']['type'] = 'redirection';
                $response['data']['redirect_to'] = $redirect_masuk;
                return $response;
            }
        } else if($register_new_user['status'] != 200) {
            return $register_new_user;
        }

        $is_send_email = ($is_no_password ? false : true);
        $lms = new Lms();
        $lms_create_user = $lms->createUserPintaria($register_new_user['body']->localId, $data['email'], $data['name'], $is_send_email);
        if($lms_create_user['status'] != 201) {
            return $lms_create_user;
        }

        $lms_user_id = $lms_create_user['body']['user_id'];
        $data['provider_id'] = $lms_user_id;
        $data['join_at'] = date('Y-m-d H:i:s');
        if(!$is_no_password) {
            $data['has_access_thank_you_page'] = 0;
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = base64_encode($data['password']);
        }

        $data['register_token'] = str_random(64);
        $new_user = User::create($data);
        if($new_user) {
            $new_user->account_providers()->create([
                'account_provider' => $account_provider
            ]);

            $is_upload_image = false;
            try {
                $profile_picture_object = $filename = null;
                if(!empty($data['profile_picture_url'])) {
                    if(!is_dir(public_path('storage/image/'))) {
                        mkdir(public_path('storage/image/'));
                    }

                    $basename = parse_url(basename($data['profile_picture_url']))['path'];
                    $filename = 'users/'. $lms_user_id . '/profile_picture_object_' . $basename;
                    $profile_picture_object = Image::make($data['profile_picture_url'])->save(public_path('storage/image/' . $basename));

                    Storage::disk('lmsums_gcs')->put($filename, (string) $profile_picture_object);
                    $is_upload_image = true;
                    $new_user->profile_picture = $filename;
                    $new_user->save();

                    unlink(public_path('storage/image/' . $basename));
                }
            } catch (Exception $e) {
            }

            if($is_upload_image) {
                $lms = new Lms;
                $lms_data = [
                    'user_id' => $lms_user_id,
                    'name' => $data['name'],
                    'profile_picture_object' => $filename
                ];
                $update_user_data = $lms->updateUserDetail($lms_data);
            }

            # Generate refferal code for this user
            $event_data = [
                'name' => $new_user->name,
                'email' => $new_user->email,
                'phone_number' => $new_user->phone_number,
            ];
            event(new GenerateReferralCodeEvent($event_data));

            $response['status'] = 201;
            $response['message'] = 'success';
            $response['data']['type'] = 'redirection';
            if($is_no_password) {
                $redirect_to = buildQueryParameter($redirect_to, [
                    "register_token" => $data['register_token']
                ]);

                $response['data']['redirect_to'] = $redirect_to;
            } else {
                $redirect_to = buildQueryParameter($redirect_to, [
                    "register_token" => $data['register_token']
                ]);

                $response['data']['redirect_to'] = $redirect_to;
            }
        }

        return $response;
    }
}
