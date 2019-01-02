<?php

namespace App\Http\Controllers;

use App\Bundle;
use App\Events\HubungiKamiKuliahEvent;
use App\Events\MoreInfoEmailEvent;
use App\Http\Requests\ContactCollegeRequest;
use App\Product;
use App\Services\Departement;
use App\StudentLead;
use App\UserReferralCode;
use App\Services\Captcha;
use App\LandingPage;
use Cookie;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Request;

class LandingPageController extends Controller
{
    private $view = 'pintaria3.landingpage';
    public function dataScience() {
        $product = Product::getProductBySlug('data-science-technology-series');
        if (!$product) {
            return abort(404);
        }
        return view($this->view.'.data_science', compact('product'));
    }

    public function dataSciencePaketPromo() {
        $product = Product::getProductBySlug('data-science-analitik-data-untuk-bisnis-dengan-excel');
        if (!$product) {
            return abort(404);
        }
        $bundles = Bundle::getRelatedBundle($product->id);

        return view($this->view.'.data_science_paket_promo', compact('product','bundles'));
    }

    public function korean() {
        $product = Product::getProductBySlug('kursus-online-bahasa-korea-basic-1');
        if (!$product) {
            return abort(404);
        }

        return view($this->view.'.korean', compact('product'));
    }

    public function digitalMarketing() {
        $product = Product::getProductBySlug('digital-marketing-practitioner');
        if (!$product) {
            return abort(404);
        }

        return view($this->view.'.digital_marketing', compact('product'));
    }

    public function kuliah(Request $request) {
        $get = $request::all();
        $departement = new Departement();
        $departements = $departement::getDepartements();
        $levelOfEducations = $departement::getLevelOfEducations();
        $locations = $departement::getLocations();

        return view($this->view.'.kuliah', compact('departements', 'levelOfEducations', 'locations', 'get'));
    }

    public function kuliahPintaria(Request $request) {
        $get = $request::all();
        $departement = new Departement();
        $departements = $departement::getDepartementsPintaria();
        $levelOfEducations = $departement::getLevelOfEducations();
        $locations = $departement::getLocations();

        return view($this->view.'.kuliah-pintaria', compact('departements', 'levelOfEducations', 'locations', 'get'));
    }

    public function kuliahS1Pintaria(Request $request) {
        $get = $request::all();
        $departement = new Departement();
        $departements = $departement::getDepartementsS1Pintaria();
        $levelOfEducations = $departement::getLevelOfEducations();
        $locations = $departement::getLocations();

        return view($this->view.'.kuliah-s1-pintaria', compact('departements', 'levelOfEducations', 'locations', 'get'));
    }

    public function kuliahS1Ithb(Request $request) {
        $get = $request::all();
        $departement = new Departement();
        $levelOfEducations = $departement::getLevelOfEducations();
        $locations = [
            'Kab. Bandung',
            'Kota Bandung',
            'Lainnya',
        ];
        $departements = [
            'S1 Sistem Informasi - ITHB',
            'S1 Manajemen - ITHB',
        ];

        return view($this->view.'.kuliah-s1-ithb', compact('departements', 'levelOfEducations', 'locations', 'get'));
    }

    public function submitHubungiKamiKuliah(ContactCollegeRequest $request)
    {
        $data = $request->except(['_token']);
        
        validateCaptcha($data['g-recaptcha-response'], false);
        
        $data['url'] = url()->previous();
        $data['product_category'] = ucfirst(Product::CATEGORY_KULIAH_NAME);

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

        $source = !empty($data['source']) ? $data['source'] : '';

        event(new HubungiKamiKuliahEvent($information, $source));
        event(new MoreInfoEmailEvent($data));

        if (empty($data['redirect_to'])) {
            $data['redirect_to'] = route('landing.kuliah.terimakasih');
        }
        
        return redirect($data['redirect_to']);
    }

    public function submitHubungiKamiKuliahPintaria(ContactCollegeRequest $request)
    {
        $data = $request->except(['_token']);
        
        validateCaptcha($data['g-recaptcha-response'], false);

        $data['url'] = url()->previous();
        $data['product_category'] = ucfirst(Product::CATEGORY_KULIAH_NAME);

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

        $source = !empty($data['source']) ? $data['source'] : '';
        event(new HubungiKamiKuliahEvent($information, $source));
        event(new MoreInfoEmailEvent($data));
        return redirect(route('landing.kuliah.pintaria.terimakasih'));
    }

    public function submitHubungiKamiKuliahS1Pintaria(ContactCollegeRequest $request)
    {
        $data = $request->except(['_token']);

        validateCaptcha($data['g-recaptcha-response'], false);
        
        $data['url'] = url()->previous();
        $data['product_category'] = ucfirst(Product::CATEGORY_KULIAH_NAME);

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

        $source = !empty($data['source']) ? $data['source'] : '';
        event(new HubungiKamiKuliahEvent($information, $source));
        event(new MoreInfoEmailEvent($data));
        return redirect(route('landing.kuliah.pintaria.terimakasih'));
    }

    public function terimaKasihKuliah()
    {
        return view($this->view.'.terima-kasih-kuliah');
    }

    public function slugIndex(Request $request, $slug)
    {
        $get = $request::all();

        $lp = LandingPage::whereSlug($slug)->first();
        if (!$lp || !$lp->is_content_ready) {
            # Try to get 'static' landing page
            if (isset(LandingPage::STATIC_SLUGS[$slug])) {
                return $this->{LandingPage::STATIC_SLUGS[$slug]}($request);
            } else {
                return abort(404);
            }
        }

        $interests = $lp->landing_page_interests()->sort()->get();
        $icons = $lp->landing_page_icons()->get();
        $testimonies = $lp->landing_page_testimonies()->get();
        $universities = $lp->landing_page_universities()->sort()->get();
        $levelOfEducations = Departement::getLevelOfEducations();
        $locations = Departement::getLocations();
        
        return view($this->view . '.slug-index', compact(
            'get', 'lp', 'interests', 'icons', 'testimonies', 'universities',
            'levelOfEducations', 'locations'
        ));
    }
}
