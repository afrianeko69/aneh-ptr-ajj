<?php

namespace Tests\Unit;

use App;
use App\Events\DaftarSayaBerminatEvent;
use App\Events\MoreInfoEmailEvent;
use Artisan;
use Session;
use Request;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Admin\TestCase;

class HomeTest extends TestCase
{

    public function testIndex()
    {
        $testimony = factory(App\Testimony::class)->create();
        $this->visit('/')
             ->see('HUBUNGI KAMI')
             ->see('TENTANG KAMI')
             ->see('BLOG')
             ->see('Powered by HarukaEDU')
             ->see('Masuk')
             ->see('Daftar')
             ->see('Simak beragam artikel menarik dari Pintaria')
             ->see('Testimoni')
             ->see('Lihat kesan mereka mengikuti program di Pintaria')
             ->see($testimony->testimony)
             ->see('Blog')
            ->assertResponseStatus(200);
    }

    public function testIndexAffiliate() {
        $affiliate = factory(App\Affiliate::class)->create([
            'domain_url' => 'pintaria.dev',
            'logged_in_domain_url' => 'pintaria.dev',
        ]);

        $products = factory(App\Product::class, 3)->create()->each(function($u) use ($affiliate) {
            $u->affiliates()->save($affiliate);
        });

        $user = factory(App\User::class)->create([
            'affiliate_id' => $affiliate->id
        ]);

        $this->actingAs($this->user)
            ->visit(route('home'))
            ->assertResponseStatus(200);
    }

    public function testIndexWithRedirectOfLogout() {
        $request = $this->call('GET', route('home') . '?logout=1');

        $this->assertEquals(302, $request->status());
        $this->assertEquals('Anda berhasil keluar dari akun Anda.', session()->get('message-success'));
    }

    public function testSeeProductInHomePage()
    {
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $this->visit('/')
            ->see('Mencari Kerja')
            ->see('BELI!')
            ->see('INFO')
            ->assertResponseStatus(200);
    }

    public function testRobotTxt() {
        $this->visit(route('robots'))
            ->assertResponseStatus(200);
    }

    public function testNotSeeTerimaKasihPage()
    {
        $this->visit(route('terimakasih'))
            ->assertResponseStatus(200);
    }

    public function testSeeTerimaKasihPageWithEmail() {
        $user = factory(App\User::class)->create([
            'has_access_thank_you_page' => 0
        ]);

        $this->visit(route('terimakasih') . '?email=' . $user->email)
            ->see('Terima Kasih')
            ->see('Kami senang Anda telah bergabung bersama Pintaria.')
            ->see('Untuk mengikuti semua kelas di Pintaria, Anda diharuskan untuk melakukan verifikasi email.')
            ->assertResponseStatus(200);
    }

    public function testViewKonfirmasiAkunPage()
    {
        $this->visit(route('konfirmasi.akun'))
            ->see('Konfirmasi Akun')
            ->see('Terima kasih. Verifikasi email Anda berhasil!')
            ->assertResponseStatus(200);
    }

    public function testSeeGlobalSearch(){
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $request = $this->call('get', route('home.global.search'), [
            'keyword' => 'kerja'
        ]);
        $this->assertResponseOk(); 
    }

    public function testSeeThankYouMohonInfo(){
        $this->visit(route('mohon.info.thankyou'))
            ->see('Terima kasih telah mengisi form Mohon Info')
            ->assertResponseOk();
    }

    public function testSeeGlobalSearchWithOnlyReadyContent(){
        $kuliah_category = factory(App\CategoryClassification::class)->create([
            'name' => 'Kuliah'
        ]);
        $industry = factory(App\Industry::class)->create([
            'name' => 'Business'
        ]);
        $location = factory(App\Location::class)->create([
            'name' => 'Jakarta'
        ]);
        $learning_method = factory(App\LearningMethod::class)->create([
            'name' => 'Online'
        ]);
        $topic = factory(App\Topic::class)->create([
            'name' => 'Teknik'
        ]);
        $provider = factory(App\Provider::class)->create([
            'name' => 'Samator'
        ]);
        $profession = factory(App\Profession::class)->create([
            'name' => 'Akuntan',
            'sort' => 1
        ]);
        $instructor = factory(App\Instructor::class)->create([
            'name' => 'Testing',
            'title' => 'CEO',
            'email' => 'testing@gmail.com',
            'description' => 'Ini description',
            'profile_picture' => 'tmp/fff.png'
        ]);

        $product = factory(App\Product::class)->create([
            'slug' => 'mencari-kerja-5',
            'name' => 'Mencari Kerja 5',
            // is_content_ready = false maka tidak ditampilkan di search page
            'is_content_ready' => false,
            'description' => 'Mencari Kerja adalah 5',
            'price' => 20000000,
            'seo' => 'Mencari kerja merupakan',
            'category_classification_id' => $kuliah_category->id,
            'learning_method_id' => $learning_method->id,
            'location_id' => $location->id,
            'quota' => 2000,
            'image' => 'image/fff.png',
            'youtube_video_id' => '8WuhXsJfXHM',
            'is_open_enrollment' => 0,
            'discount_percentage' => 25,
            'sort' => 2
        ]);

        \DB::table('industry_product')->insert([
            'industry_id' => $industry->id,
            'product_id' => $product->id
        ]);

        \DB::table('product_topic')->insert([
            'product_id' => $product->id,
            'topic_id' => $topic->id
        ]);

        \DB::table('product_provider')->insert([
            'product_id' => $product->id,
            'provider_id' => $provider->id
        ]);

        \DB::table('instructor_product')->insert([
            'instructor_id' => $instructor->id,
            'product_id' => $product->id
        ]);

        $product->professions()->attach([$profession]);

        $this->visit(route('home.global.search', [
            'keyword' => 'kerja'
        ]))->dontSee($product->name)
            ->dontSee($product->description)
            ->assertResponseStatus(200);
    }

    public function testSeeKuliahKursusKategoriProgramSubtitle(){
        $this->visit('/')
            ->dontSee('Temukan universitas mitra kami dan jurusan yang kamu minati dengan metode blended learning.')
            ->see('Temukan universitas mitra kami dan jurusan yang kamu minati dengan metode blended learning')
            ->see('Pelajari keterampilan yang kamu butuhkan untuk pengembangan diri dan kariermu')
            ->see('Temukan kategori program kami berdasarkan subjek yang kamu minati')
            ->assertResponseOk();
    }

    public function testSeeSilakanHubungiKami(){
        $this->visit('/')
            ->see('contact_menu')
            ->see('fa-whatsapp')
            ->assertResponseOk();
    }

    public function testLinkSelengkapnyaKuliah(){
        $this->visit('/')
            ->see('/program?nama=&kategori_program=&kategori=Kuliah&industri_program=&min=&max=')
            ->assertResponseOk();
    }

    public function testLinkSelengkapnyaKursus(){
        $this->visit('/')
            ->see('/program?nama=&kategori_program=&kategori=Training&industri_program=&min=&max=')
            ->assertResponseOk();
    }

    public function testSeePlaceholderGlobalSearch(){
        Artisan::call('db:seed', ['--class' => 'ContentsTableSeeder']);

        $this->visit('/')
            ->see('Coba ketik "Data Science"')
            ->assertResponseStatus(200);
    }

    public function testSuccessSubmitContact()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\HomeController')
                    ->setMethods(['submitHubungiKami'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();
        $response = ['status' => 200];

        $request = new Request;
        $stub->method('submitHubungiKami')->willReturn($response);
        $this->assertEquals($response, $stub->submitHubungiKami($request, $response));
    }

    public function testKategoriProgramPage()
    {
        $this->visit('/')
            ->see('KATEGORI PROGRAM')
            ->click('KATEGORI PROGRAM')
            ->seePageIs('/kategori')
            ->assertResponseStatus(200);
    }

    public function testInfoProfesiPage()
    {
        $this->visit('/')
            ->see('INFO PROFESI')
            ->click('INFO PROFESI')
            ->seePageIs('/profesi')
            ->assertResponseStatus(200);
    }

    public function testBlogPage()
    {
        $this->visit('/')
            ->see('BLOG')
            ->click('BLOG')
            ->seePageIs('/blog')
            ->assertResponseStatus(200);
    }

    public function testSeeKategoriPendaftarDiMohonInfo()
    {
        $this->visit('/')
            ->see('Kategori pendaftar')
            ->see('Individu')
            ->see('Perusahaan/Kolektif')
            ->see('Jumlah karyawan yang akan didaftarkan')
            ->assertResponseOk();
    }

    public function testSendSayaBerminat()
    {
        Event::fake();

        $captcha = 'abcd';
        Session::flash($captcha . '_start_time', time());
        
        $response = $this->call('post', route('submit.saya.berminat'), [
            'name' => 'tes',
            'email' => 'boho@yahoo.com',
            'phone' => '082384938592',
            'location' => 'Jakarta Selatan',
            'product' => 'Mencari Kerja',
            'departement' => 'S1 Sistem Informasi - UPJ',
            'education' => 'S1',
            'applicant_category' => 'Perusahaan/Kolektif',
            'number_of_applicants' => '500',
            'interest' => '3 Bulan dari sekarang',
            'product_category' => 'Training',
            'g-recaptcha-response' => $captcha,
        ]);
        $this->assertEquals(200, $response->status());
        
        $student_lead = App\StudentLead::where('email', 'boho@yahoo.com')->first();
        Event::assertDispatched(DaftarSayaBerminatEvent::class, function ($e) use ($student_lead) {
            return $e->student_lead->email === $student_lead->email;
        });
        Event::assertDispatched(MoreInfoEmailEvent::class, function ($e) use ($student_lead) {
            return $e->data['email'] === $student_lead->email;
        });
    }

    public function testSeeCorrectProductListInMohonInfo()
    {

        $lead_active_product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_lead_form_active' => true
        ]);

        $lead_non_active_product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_lead_form_active' => false
        ]);

        $this->visit('/')
            ->see('Kuliah')
            ->see('Kursus')
            ->see($lead_active_product->crm_interest_name)
            ->dontSee($lead_non_active_product->crm_interest_name)
            ->assertResponseStatus(200);
    }

    public function testNotSeeCorrectProductListInMohonInfo()
    {
        $product = factory(App\Product::class)->create([
            'is_lead_form_active' => false
        ]);

        $this->visit('/')
            ->see('Kuliah')
            ->see('Kursus')
            ->dontSee($product->crm_interest_name)
            ->assertResponseStatus(200);
    }

    public function testNotSeeCarouselControlArrowInHomePage()
    {
        factory(App\Banner::class)->create([
            'product_id' => 0
        ]);

        $this->visit('/')
            ->dontSee('href="#full-slider-wrapper"')
            ->assertResponseStatus(200);
    }

    public function testSeeKodeReferralFieldInMohonInfo()
    {
        $this->visit('/')
            ->see('Kuliah')
            ->see('Kursus')
            ->see('Kode promo/referral (opsional)')
            ->assertResponseStatus(200);
    }

    public function testSeeCorrectBundleProductBuyUrl()
    {
        $bundle = factory(App\Bundle::class)->create();
        $product = factory(App\Product::class)->create([
            'is_open_enrollment' => 3,
            'selected_bundle_id' => $bundle->id,
            'is_content_ready' => 1,
            'sort' => 1,
        ]);
        $product->bundles()->attach($bundle);

        $this->visit('/')
            ->see($product->name)
            ->see(route('product.konfirmasi.beli', [$product->slug]) . '?paket=' . $bundle->id)
            ->assertResponseOk();
    }
}
