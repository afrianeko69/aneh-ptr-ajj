<?php

namespace App\Http\Controllers;

use App;
use App\Affiliate;
use App\Banner;
use App\Category;
use App\Content;
use App\Events\DaftarSayaBerminatEvent;
use App\Events\MoreInfoEmailEvent;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\MoreInfoRequest;
use App\Post;
use App\Product;
use App\Role;
use App\Services\Captcha;
use App\StudentLead;
use App\UserReferralCode;
use App\Testimony;
use App\Tracker;
use App\User;
use App\Services\Departement;
use Auth;
use Cookie;
use Request;
use Response;
use Robots;
use Session;
use App\Industry;
use App\CategoryClassification;
use App\Services\Ahmeng;


class HomeController extends Controller
{
    protected $view = 'pintaria3';

    public function index(){
        if(Request::get('logout')) {
            Session::flash('message-success', 'Anda berhasil keluar dari akun Anda.');
            return redirect(route('home'));
        }

        $affiliate_id = Request::get('app_affiliate_id');
        $banner = Banner::where('product_id',0);
        $apaItuPintaria =  Content::where('key',Content::APA_ITU_PINTARIA);
        $punyaWaktu = Content::where('key',Content::PUNYA_WAKTU);
        $partnerKami = Content::where('key',Content::PARTNER_KAMI);
        $newsletter = Content::where('key',Content::NEWSLETTER);
        $information = Content::where('key',Content::INFORMASI);
        $seoDescription = Content::where('key',Content::SEO_DESCRIPTION);
        $categories = Category::orderBy('category_sort','asc')->limit(6)->get()->map(function($category) {
            $category['total_product'] = $category->products()->ready()->count();
            return $category;
        });

        $affiliate_product = [];
        if (!empty($affiliate_id)){
            $affiliate_product = Affiliate::find($affiliate_id)->products()->pluck('id')->toArray();
            if (!empty($affiliate_product)) {
                $banner = Banner::whereIn('product_id', $affiliate_product );
            }
            $apaItuPintaria = $apaItuPintaria->where('affiliate_id', $affiliate_id);
            $punyaWaktu = $punyaWaktu->where('affiliate_id', $affiliate_id);
            $newsletter = $newsletter->where('affiliate_id', $affiliate_id);
            $information = $information->where('affiliate_id', $affiliate_id);
            $seoDescription = $seoDescription->where('affiliate_id', $affiliate_id);

            if (!$apaItuPintaria->first() || !$punyaWaktu->first() || !$newsletter->first() || !$information->first() || !$seoDescription->first() ){
                Session::flash('message-error', 'Silahkan Login dan Import Data terlebih dahulu.');
                return redirect(route('affiliate.index'));
            }
        }
        $data = [
            'banners' => $banner->orWhereHas('productId', function($q) {
                    $q->where('is_content_ready', 1);
            })->orderBy('sort','ASC')->get(),
            'tentang_pintaria' => $apaItuPintaria->first(),
            'punya_waktu' => $punyaWaktu->first(),
            'partner_kami' => $partnerKami->first(),
            'newsletter' => $newsletter->first(),
            'informasi' => $information->first(),
            'seo_description' => $seoDescription->first(),
            'products' => Product::getAllProduct($affiliate_product,true, ['order' => 'asc','order_by' => 'p.sort'], false),
            'categories' => $categories,
            'mohon_info_products' => Product::getProductListMoreInfo($affiliate_product),
            'blog_posts' => Post::where('status', Post::STATUS_PUBLISHED)->orderBy('id', 'desc')->limit(4)->get(),
            'testimonies' => Testimony::whereNotNull('sort')->orderBy('id', 'ASC')->take(5)->get(),
            'applicant_categories' => Departement::getApplicantCategories(),
        ];
        return view($this->view.'.index', $data);
    }

    public function daftarSayaBerminat(MoreInfoRequest $request)
    {
        $data = $request->except(['_token']);
        
        validateCaptcha($data['g-recaptcha-response'], true);

        if (Cookie::get('source_id')) {
            $data['source_id'] = Cookie::get('source_id');
        }
        if (Cookie::get('utm_source')) {
            $data['source_from'] = Cookie::get('utm_source');
        }
        if (Cookie::get('utm_campaign')) {
            $data['source_name'] = Cookie::get('utm_campaign');
        }
        if (Cookie::get('utm_medium')) {
            $data['source_medium'] = Cookie::get('utm_medium');
        }
        if (Cookie::get('utm_term')) {
            $data['source_term'] = Cookie::get('utm_term');
        }
        if (Cookie::get('utm_content')) {
            $data['source_content'] = Cookie::get('utm_content');
        }

        $information = StudentLead::create($data);
        if ($information->isValidReferral()) {
           $referral_code = UserReferralCode::where('referral_code', $information->referral_code)
               ->where('is_default', 1)
               ->first();
           $referral_code->studentLeads()->save($information);
        }
        event(new DaftarSayaBerminatEvent($information));
        event(new MoreInfoEmailEvent($data));
        return response()->json(['status' => 200]);
    }

    public function terimaKasih()
    {
        if (Request::get('email') && $token = Request::get('register_token', false)) {
            Auth::login(User::whereRegisterToken($token)->first());
            $user = User::whereRegisterToken($token)->first();
            $user->register_token = '';
            $user->token = Request::get('token');
            $user->save();
        }

        if ($email = Request::get('email')) {
            $user = User::hasNotAccessThankYouPage($email)->first();
            if ($user) {
                $user->has_access_thank_you_page = 1;
                $user->save();
                return view('shared.pintaria3.thank-you');
            }
        }

        return redirect(route('home'));
    }

    public function terimaKasihMohonInfo()
    {
        return view('shared.pintaria3.thank-you-mohon-info');
    }

    public function konfirmasiAkun()
    {
        return view('shared.account-confirmation');
    }

    public function robotTxt()
    {
        if (env('APP_ROBOTS', false)) {
            // If on the live server, serve a nice, welcoming robots.txt.
            Robots::addUserAgent('*');
            Robots::addDisallow('/transaksi');
            Robots::addDisallow('/menunggu');
            Robots::addDisallow('/program?');
            Robots::addDisallow('/*search');
            Robots::addDisallow('/cari?');

            // if on production and is an affiliate domain
            if (!empty(Request::get('app_affiliate_id'))){
                Robots::addDisallow('/');    
            }
        } else {
            // If you're on any other server, tell everyone to go away.
            Robots::addUserAgent('*');
            Robots::addDisallow('/');
        }
    
        return Response::make(Robots::generate(), 200, ['Content-Type' => 'text/plain']);
    }

    public function searchGlobal(Request $request){
        $get = Request::all();
        $product_categories = [];
        $industry = [];

        $products = Product::getAllProduct([], false, ['keyword' => !empty($get['keyword']) ? $get['keyword'] : null] );
        $categories = Category::all();

        $product_categories = CategoryClassification::all();
        $product_industries = Industry::all();
        return view($this->view . '.products.search', compact('products', 'product_categories', 'categories', 'industry', 'product_industries', 'get'));
    }

    public function submitHubungiKami(ContactRequest $request)
    {
        $post = Request::except(['_token']);
        $captcha_response = $post['g-recaptcha-response'];

        if (!isCaptchaStillValid($captcha_response)) {
            $captcha = new Captcha($captcha_response);
            $captcha_validation = $captcha->validate();

            $is_success_captcha = false;
            if ($captcha_validation && $captcha_validation->getStatusCode() == 200) {
                $body = json_decode((string)$captcha_validation->getBody());
                if ($body->success) {
                    $is_success_captcha = true;
                    setCaptchaValidInSession($captcha_response);
                }
            }

            if (!$is_success_captcha) {
                return response()->json(['status' => 422, 'message' => 'Silahkan mengulangi captcha kembali.']);
            }
        }
        
        $sendInfo = [
            'contact_info' => [
                'email' => $post['email_contact'],
                'name' => $post['first_name_contact'] . ' ' . $post['last_name_contact'],
                'phone' => $post['phone_contact']
            ],
            'message' => $post['message_contact'],
            'contacted_at' => date('d/m/Y H:i')
        ];
        $ahmeng = new Ahmeng;
        $ahmeng = $ahmeng->sendContactEmail($sendInfo);

        return response()->json(['status' => $ahmeng['status']]);
    }

    public function tracker(Request $request) {
        $post = Request::all();
        switch ($post['object_name']) {
            case "product":
                Tracker::updateTracker('click_buy_product', $post['object_id']);
                break;
            case "bundle":
                Tracker::updateTracker('click_buy_bundle', $post['object_id']);
                break;
            default:
                Tracker::updateTracker($post['object_name'], $post['object_id']);
        }
    }

    public function konfirmasiBeli()
    {
        return view('pintaria3.pages.konfirmasi-beli');
    }

    public function pembayaran()
    {
        return view('pintaria3.pages.pembayaran');
    }
}
