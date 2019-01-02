<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::group(['namespace' => 'App\Http\Controllers\Voyager'], function() {
        Route::post('rating-reviews/bulk-approve-reject', 'RatingReviewController@approveRejectAction')->name('admin.rating-review.bulk.update');
        Route::get('products/e-certificate/{slug}/preview', 'ProductController@certificatePreview')->name('admin.product.e-certificate.preview');
        Route::get('products/kartu-peserta/{slug}/preview', 'ProductController@attendeeCardPreview')->name('admin.product.kartupeserta.preview');
        Route::get('landing-pages/{slug}/preview', 'LandingPageController@slugPreview')->name('admin.landing-page.preview');
    });
});

Route::group(['prefix' => 'administration'], function(){
    
    Route::get('/', '\App\Http\Controllers\Affiliate\AffiliateController@index')->name('affiliate.index')->middleware('affiliateWeb');
    Route::post('/login', '\App\Http\Controllers\Affiliate\AffiliateController@login')->name('affiliate.login');
    
    Route::group(['middleware' => ['affiliateAdmin'], 'namespace' => 'App\Http\Controllers\Affiliate'], function () {
        Route::get('/settings', 'AffiliateController@settings')->name('affiliate.settings');
        Route::resource('/pages','PagesController',['only' => ['index','edit','update']]);
        Route::get('/import-settings','AffiliateController@import')->name('settings.import');
        Route::resource('/content','ContentController',['only' => ['index','edit','update']]);
        
        Route::post('/update-settings', 'AffiliateController@updateSettings')->name('affiliate.updateSettings');
        Route::resource('/affiliate-product','ProductController',['only' => ['index']]);
        Route::post('/affiliate-product-update','ProductController@update')->name('affiliate-product.update');
        Route::get('/logout','AffiliateController@logout')->name('affiliate.logout');
    });
});

Route::group(['middleware' =>  ['affiliateWeb', 'web','trackerWeb'], 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/blog', 'PostController@index')->name('blog');
    Route::get('/berita', 'NewsController@index')->name('berita');
    Route::get('/blog/video', 'VideoController@index')->name('video');
    Route::get('/blog/video/{title}', 'VideoController@detail')->name('video.detail');
    Route::get('/blog/tag/{slug}', 'PostController@tag')->name('tag');
    Route::get('/blog/{slug}', 'PostController@show')->name('blog.detail');
    Route::get('/berita/{slug}', 'NewsController@show')->name('news.detail');
    Route::get('/kategori', 'CategoryController@index')->name('category.index');
    Route::get('/hubungi-kami', 'PageController@hubungiKami')->name('hubungi.kami');
    Route::post('hubungi-kami', 'HomeController@submitHubungiKami')->name('submit.hubungi.kami');
    Route::get('/tentang-kami', 'PageController@tentangKami')->name('tentang.kami');
    Route::get('/perjanjian-pengguna', 'PageController@perjanjianPengguna')->name('perjanjian.pengguna');
    Route::get('/kebijakan-privasi', 'PageController@kebijakanPrivasi')->name('kebijakan.privasi');
    Route::resource('newsletter', 'NewsletterController', ['only' => ['store']]);

    Route::get('transaksi-pembayaran-berhasil/{order_number}', 'OrderController@success')->name('transaction.success');
    Route::get('transaksi-pembayaran-gagal/{order_number}', 'OrderController@error')->name('transaction.error');
    Route::get('menunggu-transaksi-pembayaran/{order_number}', 'OrderController@pending')->name('transaction.pending');

    Route::get('kartu-peserta/{ident}', 'ParticipantController@streamCard')->name('stream.public.kartu.peserta');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('akun-saya', 'ProfileController@index')->name('akun.saya');
        Route::get('akun-saya/rekomendasikan-temanmu', 'ProfileController@recommendFriends')->name('akun.saya.rekomendasi');
        Route::get('perbarui-akun-saya', 'ProfileController@edit')->name('ubah.akun.saya');
        Route::get('perbarui-password-saya', 'ProfileController@editPassword')->name('ubah.password.saya');
        Route::post('ubah-akun-saya', 'ProfileController@update')->name('update.akun.saya');
        Route::post('ubah-password-saya', 'ProfileController@updatePassword')->name('update.password.saya');
        Route::get('kelas-saya', 'ProfileController@kelasSaya')->name('kelas.saya');
        Route::get('masuk-kelas', 'ProviderAuthController@masukKelas')->name('masuk.kelas');
        Route::get('transaksi-saya', 'ProfileController@myTransaction')->name('my.transaction');
        Route::get('ulasan/{slug}', 'ProfileController@review')->name('user.product.review');
        Route::post('ulasan/{slug}/kirim', 'ProfileController@submitReview')->name('user.product.review.submit');
        Route::post('akun-saya/rekomendasikan-temanmu/send-email', 'ProfileController@sendReferralEmail')->name('akun.saya.rekomendasi.email');
        Route::get('kelas-saya/kartu-peserta/{slug}', 'ProfileController@streamAttendeeCard')->name('stream.kartu.peserta');

        Route::group(['prefix' => 'tryout', 'middleware' => ['course_permission'], 'as' => 'tryout.'], function() {
            Route::get('{slug}/instruksi', 'TryoutController@instruction')->name('instruction');
            Route::get('{slug}/{product_tryout_id}', 'TryoutController@tryoutQuiz')->name('quiz');
        });

        Route::get('storage-pintaria-files/{gcs_path?}', ['as' => 'pintaria.asset', 'uses' => 'GCSController@getPintariaPrivateFile'])->where('gcs_path', '(.*)');

        Route::group(['prefix' => 'sertifikat', 'as' => 'certificate.', 'middleware' => ['course_permission']], function() {
            Route::get('{slug}', 'CertificateController@streamCertificate')->name('stream');
        });
    });

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/daftar', 'AuthController@daftar')->name('daftar');
        Route::get('/lupa-password', 'AuthController@forgotPassword')->name('lupa.password');
        Route::post('/lupa-password', 'AuthController@submitForgotPassword')->name('submit.lupa.password');
        Route::get('/lupa-password-cek-email', 'AuthController@forgotPasswordCheckEmail')->name('lupa.password.cek.email');
    });

    Route::group(['prefix' => 'kuliah/online/', 'as' => 'landing.',], function () {
        Route::group(['prefix' => 'kelas-karyawan/'], function () {
            Route::get('terima-kasih', 'LandingPageController@terimaKasihKuliah')->name('kuliah.terimakasih');
            Route::get('{slug}', 'LandingPageController@slugIndex')->name('kuliah.index');
            Route::get('{slug}/terima-kasih', 'LandingPageController@terimaKasihKuliah')->name('kuliah.index.terimakasih');
            Route::get('s1-pintaria', 'LandingPageController@kuliahS1Pintaria')->name('kuliah.s1.pintaria');
            Route::get('s1-ithb', 'LandingPageController@kuliahS1Ithb')->name('kuliah.s1.ithb');
            Route::get('/', 'LandingPageController@kuliah')->name('kuliah');
        });
        Route::get('kelas-karyawan-pintaria', 'LandingPageController@kuliahPintaria')->name('kuliah.pintaria');
        Route::get('kelas-karyawan-pintaria/terima-kasih', 'LandingPageController@terimaKasihKuliah')->name('kuliah.pintaria.terimakasih');
    });

    Route::get('/konfirmasi-beli', 'HomeController@konfirmasiBeli')->name('konfirmasi.beli');
    Route::get('/pembayaran', 'HomeController@pembayaran')->name('pembayaran');
    Route::get('masuk', 'ProviderAuthController@login')->name('masuk');
    Route::get('oauth/callback', 'ProviderAuthController@callback')->name('sso.callback');
    Route::get('daftar/callback', 'ProviderAuthController@callbackRegister')->name('daftar.callback');
    Route::get('keluar', 'AuthController@logout')->name('keluar');

    Route::get('storage-files/{gcs_path?}', ['as' => 'asset', 'uses' => 'GCSController@getFile'])->where('gcs_path', '(.*)');

    Route::post('/save-participant', 'OrderController@saveParticipant')->name('save.participant');
    Route::post('/participant-discount', 'OrderController@checkParticipantDiscount')->name('check.participant.discount');
    Route::post('/beli-kelas', 'OrderController@processPurchase')->name('purchase.kelas');
    Route::get('konfirmasi-akun', 'HomeController@konfirmasiAkun')->name('konfirmasi.akun');
    Route::get('terima-kasih', 'HomeController@terimaKasih')->name('terimakasih');
    Route::post('daftar-saya-berminat', 'HomeController@daftarSayaBerminat')->name('submit.saya.berminat');
    Route::post('/api/midtrans/payment-notification', 'PaymentController@notification')->name('midtrans.notification');
    Route::post('/api/akulaku/payment-notification', 'PaymentController@akuLakuNotification')->name('akulaku.notification');
    Route::get('/akulaku/callback', 'PaymentController@akuLakuCallbackPage')->name('akulaku.callback.page');
    Route::get('/referral-codes/{referral_code}/{id}/{type}', 'OrderController@checkReferralCode')->name('check.referral.code');
    Route::get('/promo-codes/{promo_code}/{id}/{type}', 'OrderController@checkPromoCode')->name('check.promo.code');
    Route::get('search-autocomplete','ProductController@autoComplete')->name('product.autocomplete');
    Route::get('cari','HomeController@searchGlobal')->name('home.global.search');
    Route::get('mohon-info/terima-kasih','HomeController@terimaKasihMohonInfo')->name('mohon.info.thankyou');
    Route::get('program', 'ProductController@search')->name('product.search');
    Route::get('profesi', 'ProfessionController@index')->name('profession.index');
    Route::get('profesi/{slug}', 'ProfessionController@detail')->name('profession.detail');
    Route::get('promo/kursus-online/data-science', 'LandingPageController@dataScience');
    Route::get('promo/kursus-online/data-science-paket-promo', 'LandingPageController@dataSciencePaketPromo');
    Route::get('robots.txt', 'HomeController@robotTxt')->name('robots');
    Route::get('promo/kursus-online/bahasa-korea', 'LandingPageController@korean')->name('landing.korea');
    Route::get('promo/kursus-online/digital-marketing-practitioner', 'LandingPageController@digitalMarketing')->name('landing.digital_marketing');
    Route::post('/js-track', 'HomeController@tracker')->name('home.tracker');
    Route::get('/{slug}', 'ProductController@index')->name('product.index');
    Route::post('hubungi-kami-kuliah', 'LandingPageController@submitHubungiKamiKuliah')->name('submit.hubungi.kami.kuliah');
    Route::post('hubungi-kami-kuliah-pintaria', 'LandingPageController@submitHubungiKamiKuliahPintaria')->name('submit.hubungi.kami.kuliah.pintaria');
    Route::post('hubungi-kami-kuliah-s1-pintaria', 'LandingPageController@submitHubungiKamiKuliahS1Pintaria')->name('submit.hubungi.kami.kuliah.s1.pintaria');
    Route::post('hubungi-kami-kuliah-s1-ithb', 'LandingPageController@submitHubungiKamiKuliahS1Ithb')->name('submit.hubungi.kami.kuliah.s1.ithb');
    Route::get('/{slug}/konfirmasi-beli', 'ProductController@konfirmasiBeli')->name('product.konfirmasi.beli');
});
