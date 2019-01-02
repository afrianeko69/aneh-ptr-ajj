<?php

namespace Tests\Unit;

use App;
use App\Events\DaftarSayaBerminatEvent;
use App\Events\MoreInfoEmailEvent;
use App\Events\EnrollToKlassEvent;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Session;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testNotFoundProduct()
    {
        $response = $this->call('GET', '/mencari-aaa');

        $this->assertEquals(404, $response->status());
    }

    public function testPurchaseAndNotLoggedIn() {
        $response = $this->call('GET', '/menari/konfirmasi-beli');
        $this->assertEquals(302, $response->status());
    }

    public function testNotPassValidationOnProductInfoForm()
    {
        $response = $this->call('post', route('submit.saya.berminat'), [
            'name' => 'tes'
        ]);
        $this->assertEquals(302, $response->status());
    }

    public function testNotPassRecaptchaValidationOnProductInfoForm()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\HomeController')
                    ->setMethods(['daftarSayaBerminat'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 422,
            'message' => 'Silahkan mengulangi captcha kembali.'
        ];

        $request = new Request;
        $stub->method('daftarSayaBerminat')->willReturn($response);
        $this->assertEquals($response, $stub->daftarSayaBerminat($request, $response));
    }

    public function testPassSubmitFormOnProductInfoForm()
    {
        Event::fake();

        $captcha = 'abcd';
        Session::flash($captcha . '_start_time', time());

        $response = $this->call('post', route('submit.saya.berminat'), [
            'name' => 'tes',
            'email' => 'zaza@gmail.com',
            'phone' => '082384938592',
            'location' => 'Jakarta Selatan',
            'product' => 'Mencari Kerja',
            'applicant_category' => 'Individu',
            'interest' => '3 bulan dari sekarang',
            'product_category' => 'Training',
            'g-recaptcha-response' => $captcha,
        ]);
        $this->assertEquals(200, $response->status());

        $response = json_decode((string) $response->getContent(), true);
        $this->seeJsonStructure(['status'], $response);
        $this->assertEquals(200, $response['status']);

        $student_lead = App\StudentLead::where('email', 'zaza@gmail.com')->first();

        Event::assertDispatched(DaftarSayaBerminatEvent::class, function($e) use ($student_lead) {
            return $e->student_lead->id == $student_lead->id;
        });

        Event::assertDispatched(MoreInfoEmailEvent::class, function($e) use ($student_lead) {
            return $e->data['email'] === $student_lead->email;
        });
    }

    public function testNotSeeNotReadyContentProduct()
    {
        $product = factory(App\Product::class)->create([
            'is_content_ready' => false
        ]);

        $response = $this->call('GET', route('product.index', [$product->slug]));
        $this->assertEquals(404, $response->status());
    }

    public function testSeeSayaBerminatProductNotLoggedIn()
    {
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => false,
        ]);

        $this->visit(route('product.index', [$product->slug]))
            ->see('Saya Berminat')
            ->see('Materi Belajar')
            ->dontSee('Beli Sekarang')
            ->see($product->name)
            ->assertResponseStatus(200);
    }

    public function testSeeBeliSekarangWithActiveDiscountProductNotLoggedInAndSeeReview()
    {
        $now = date('Y-m-d H:i:s');
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'price' => 1500000,
            'discount_percentage' => 5,
            'discount_start_at' => date('Y-m-d H:i:s', strtotime($now . '-2 days')),
            'discount_end_at' => date('Y-m-d H:i:s', strtotime($now . '+5 days')),
        ]);

        $price_after_discount = ((100 - 5) * $product->price) / 100;

        $reviews = factory(App\RatingReview::class, 5)->create([
            'product_id' => $product->id,
            'status' => App\RatingReview::STATUS_APPROVED
        ]);

        $total_rating = 0;
        foreach($reviews as $review) {
            $total_rating += (int) $review->rating;
        }

        $avg_rating = round(($total_rating / 5), 1);

        $this->visit(route('product.index', [$product->slug]))
            ->see('Beli Sekarang')
            ->see($product->name)
            ->see(rupiah_number_format($product->price))
            ->see(rupiah_number_format($price_after_discount))
            ->see('5 Ulasan')
            ->see($avg_rating)
            ->see($reviews[0]->reviewer_name)
            ->see($reviews[0]->review)
            ->assertResponseStatus(200);
    }

    public function testNotSeeBundleInProductInfoAndSeeNoReview()
    {
        $now = date('Y-m-d H:i:s');
        $products = factory(App\Product::class, 3)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'discount_percentage' => 5,
            'discount_start_at' => date('Y-m-d H:i:s', strtotime($now . '-10 days')),
            'discount_end_at' => date('Y-m-d H:i:s', strtotime($now . '-5 days')),
        ]);

        $bundle = factory(App\Bundle::class)->create([
            'start_at' => date('Y-m-d H:i:s', strtotime($now . '-10 days')),
            'end_at' => date('Y-m-d H:i:s', strtotime($now . '-5 days'))
        ]);

        $bundle->products()->sync($products);

        $price_after_discount = ((100 - 5) * $products[0]->price) / 100;

        $this->visit(route('product.index', [$products[0]->slug]))
            ->see('Beli Sekarang')
            ->dontSee('Lihat Paket')
            ->dontSee('Beli Paket')
            ->see($products[0]->name)
            ->dontSee($bundle->name)
            ->see(rupiah_number_format($products[0]->price))
            ->dontSee(rupiah_number_format($price_after_discount))
            ->see('Ulasan')
            ->see('Kami masih menunggu ulasan Anda untuk program ini')
            ->assertResponseStatus(200);
    }

    public function testSeeBundleInProductInfo()
    {
        $now = date('Y-m-d H:i:s');
        $products = factory(App\Product::class, 3)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'discount_percentage' => 5,
            'discount_start_at' => date('Y-m-d H:i:s', strtotime($now . '-10 days')),
            'discount_end_at' => date('Y-m-d H:i:s', strtotime($now . '-5 days')),
        ]);

        $bundle = factory(App\Bundle::class)->create();

        $bundle->products()->sync($products);

        $price_after_discount = ((100 - 5) * $products[0]->price) / 100;

        $this->visit(route('product.index', [$products[0]->slug]))
            ->see('Beli Sekarang')
            ->see('Lihat Paket')
            ->see('Beli Paket')
            ->see($products[0]->name)
            ->see($bundle->name)
            ->see(rupiah_number_format($bundle->price))
            ->see(rupiah_number_format($products[0]->price))
            ->dontSee(rupiah_number_format($price_after_discount))
            ->assertResponseStatus(200);
    }

    public function testSeeProductSearch(){
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $this->visit(route('product.search'))
        ->see("Mencari Kerja")
        ->assertResponseStatus(200);
    }

    public function testSeeProductSearchExcerpt(){
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $this->visit(route('product.search'))
        ->see("Mencari kerja excerpt")
        ->assertResponseStatus(200);
    }

    public function testSeeProductSearchMinMaxShowing(){
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $this->visit(route('product.search'))
        ->type('5000000', 'min')
        ->type('15000000', 'max')
        ->press('Cari')
        ->see("Mencari Kerja")
        ->assertResponseStatus(200);
    }

    public function testSeeProductSearchMinMaxNotShowing(){
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $this->visit(route('product.search'))
        ->type('30000000', 'min')
        ->type('40000000', 'max')
        ->press('Cari')
        ->see('Hasil pencarian kosong, silakan ubah filter pencarian atau lihat semua <b><a href="'.route('product.search').'">Produk</a></b>.')
        ->assertResponseStatus(200);
    }

    public function testSeeProductSearchCategoryClassification(){
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $this->visit(route('product.search'))
        ->select('Kuliah', \App\Product::CATEGORY)
        ->press('Cari')
        ->see("Mencari Kerja")
        ->assertResponseStatus(200);
    }

    public function testSeeProductSearchCategory(){
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $this->visit(route('product.search'))
        ->select('Category 1', \App\Product::CATEGORY_PROGRAM)
        ->press('Cari')
        ->see("Mencari Kerja")
        ->assertResponseStatus(200);
    }

    public function testSeeProductSearchIndustry(){
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $this->visit(route('product.search'))
        ->select('Business', \App\Product::INDUSTRY_PROGRAM)
        ->press('Cari')
        ->see("Mencari Kerja 3")
        ->assertResponseStatus(200);
    }
    // public function testSeeProductSearchCategoryNotShowing(){
    //     Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
    //     $this->visit(route('product.search'))
    //     ->select('Category 1', \App\Product::CATEGORY)
    //     ->press('Cari')
    //     ->see('Hasil pencarian kosong, silakan ubah filter pencarian atau lihat semua <b><a href="'.route('product.search').'">Produk</a></b>.')
    //     ->assertResponseStatus(200);
    // }
    
    // public function testSeeProductSearchKeywordShowing(){
    //     Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
    //     $this->visit(route('product.search'))
    //     ->type('kerja', \App\Product::NAME)
    //     ->press('Cari')
    //     ->see("Mencari Kerja 3")
    //     ->assertResponseStatus(200);
    // }

    // public function testSeeProductSearchIsDiscountShowing(){
    //     Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
    //     $this->visit(route('product.search'))
    //     ->check(\App\Product::DISCOUNT)
    //     ->press('Cari')
    //     ->see("Mencari Kerja 3")
    //     ->assertResponseStatus(200);
    // }

    public function testSeeProductSearchGrid(){
        Artisan::call('db:seed', ['--class' => 'ProductTableSeeder']);
        $this->visit(route('product.search', ['show' => 'grid']))
        ->see("Mencari Kerja")
        ->assertResponseStatus(200);
    }

    public function testSeeProgramPageWhenLoggedInAndHadPurchase() {
        $user = factory(App\User::class)->create();
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
        ]);
        $class_attendee = factory(App\ClassAttendee::class)->create([
            'user_id' => $user->id,
            'slug' => $product->slug
        ]);

        $this->actingAs($user)
            ->visit(route('product.konfirmasi.beli', [$product->slug]))
            ->see($product->name)
            ->assertResponseStatus(200);
    }

    public function testBuyFreeCourse() {
        Event::fake();

        $user = factory(App\User::class)->create();
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'price' => 0,
        ]);

        $this->actingAs($user)
            ->visit(route('product.index', [$product->slug]) . '?beli=1')
            ->see($product->name)
            ->assertResponseStatus(200);

        Event::assertDispatched(EnrollToKlassEvent::class, function($e) use ($user, $product) {
            return $e->user->email == $user->email && $e->slug == $product->slug;
        });
    }

    public function testNotSeeMateriBelajarInProgramDetailPage() {
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'is_learning_material_showed' => false,
        ]);

        $this->visit(route('product.index', [$product->slug]))
            ->dontSee('Materi Belajar')
            ->assertResponseStatus(200);
    }

    public function testProductAutoComplete() {
        $request = $this->call('GET', route('product.autocomplete') . '?q=mencari');

        $this->assertEquals(200, $request->status());
        $response = json_decode((string) $request->getContent(), true);
    }

    public function testBuyProductAndSeeKonfirmasiBeliPage() {
        $user = factory(App\User::class)->create();

        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'is_learning_material_showed' => false,
        ]);

        $this->actingAs($user)
            ->visit(route('product.index', [$product->slug]))
            ->click('Beli Sekarang')
            ->seePageIs(route('product.konfirmasi.beli', ['slug' => $product->slug]))
            ->assertResponseStatus(200);
    }

    public function testSeeKategoriPendaftarDiMohonInfo()
    {
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => false,
        ]);

        $this->visit(route('product.index', [$product->slug]))
            ->see('Kategori pendaftar')
            ->see('Individu')
            ->see('Perusahaan/Kolektif')
            ->see('Jumlah karyawan yang akan didaftarkan')
            ->assertResponseOk();
    }

    public function testSeeReviewInProductPage() {
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'is_review_shown' => true,
        ]);

        $this->visit(route('product.index', [$product->slug]))
            ->see('<a href="#reviews">Ulasan</a>')
            ->see('<h2>Ulasan</h2>')
            ->assertResponseStatus(200);
    }

    public function testNotSeeReviewInProductPage() {
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'is_review_shown' => false,
        ]);

        $this->visit(route('product.index', [$product->slug]))
            ->dontSee('<a href="#reviews">Ulasan</a>')
            ->dontSee('<h2>Ulasan</h2>')
            ->assertResponseStatus(200);
    }

    public function testSeeCTAButtonOfBundleEnrollmentProduct() {
        $user = factory(App\User::class)->create();
        $bundle = factory(App\Bundle::class)->create();
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => 3,
            'selected_bundle_id' => $bundle->id,
        ]);

        $this->actingAs($user)
            ->visit(route('product.index', [$product->slug]))
            ->see('Beli Paket')
            ->assertResponseStatus(200);
    }
    
    public function testSeeReferralCodeFieldInMohonInfo()
    {
        $cat = factory(App\CategoryClassification::class)->create([
            'name' => 'Kuliah',
        ]);
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => 1,
            'category_classification_id' => $cat->id,
        ]);

        $res = $this->visit(route('product.index', [$product->slug]))
            ->see('Kode Promo/Referral (Opsional)')
            ->assertResponseStatus(200);
    }

    public function testSeeReferralCodeFieldInMohonInfoKursusProduct()
    {
        $cat = factory(App\CategoryClassification::class)->create([
            'name' => 'Kursus',
        ]);
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => 1,
            'category_classification_id' => $cat->id,
        ]);

        $this->visit(route('product.index', [$product->slug]))
            ->see('Kode Promo/Referral (Opsional)')
            ->assertResponseStatus(200);
    }

    public function testNotSeeMohonInfo(){
        $product = factory(App\Product::class)->create([
            'is_lead_form_active' => false
        ]);

        $this->visit(route('product.index', [$product->slug]))
            ->dontSee('DATA MOHON INFO')
            ->dontSee('Kategori pendaftar')
            ->dontSee('Individu')
            ->dontSee('Perusahaan/Kolektif')
            ->dontSee('Jumlah karyawan yang akan didaftarkan')
            ->assertResponseOk();
    }

    public function testSeeKodeReferralFieldInMohonInfo()
    {
        $product = factory(App\Product::class)->create([
            'is_lead_form_active' => true
        ]);

        $this->visit(route('product.index', [$product->slug]))
            ->see('DATA MOHON INFO')
            ->see('Kode promo/referral (opsional)')
            ->assertResponseStatus(200);
    }

    public function testSeeRelatedReviewInProductPage() {
        $products = factory(App\Product::class, 2)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'is_review_shown' => true,
        ]);

        $review = factory(App\RatingReview::class)->create([
            'product_id' => $products[1]->id,
            'status' => \App\RatingReview::STATUS_APPROVED,
        ]);

        $products[0]->related_review_products()->attach($products[1]);

        $this->visit(route('product.index', [$products[0]->slug]))
            ->see('<a href="#reviews">Ulasan</a>')
            ->see('1 Ulasan')
            ->see($review->rating)
            ->see($review->review)
            ->assertResponseStatus(200);
    }

    public function testSeeAmbilPacketProduct() {
        $user = factory(App\User::class)->create();
        $bundle = factory(App\Bundle::class)->create(['price' => 0]);
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => 3,
            'selected_bundle_id' => $bundle->id,
        ]);
        $bundle->products()->sync($product);
        
        $this->actingAs($user)
            ->visit(route('product.index', [$product->slug]))
            ->see('Ambil Paket')
            ->click('Ambil Paket')
            ->seePageIs(route('kelas.saya'))
            ->assertResponseStatus(200);
    }
}
