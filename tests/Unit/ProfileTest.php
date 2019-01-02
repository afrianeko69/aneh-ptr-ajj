<?php

namespace Tests\Unit;

use App;
use App\Events\ListKelasSayaEvent;
use App\Events\UpdateLmsUserDataEvent;
use App\Events\ReferralEmailEvent;
use App\Traits\AttendeeCard;
use Cache;
use Session;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    private $new_user;
    public function setUp()
    {
        parent::setUp();
        $this->new_user = factory(App\User::class)->create();
        Cache::flush();
    }

    public function testKelasSayaEmptyCourses()
    {
        Event::fake();
        $user = $this->new_user;
        $this->actingAs($user)
            ->visit(route('kelas.saya'))
            ->see('Belum ada kelas. Silakan cari kelas di')
            ->assertResponseStatus(200);

        Event::assertDispatched(ListKelasSayaEvent::class, function($e) use ($user) {
            return $e->user->id = $user->id;
        });
    }

    public function testKelasSayaWithCourses()
    {
        Event::fake();
        $user = $this->new_user;
        $product = factory(App\Product::class)->create();

        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $this->actingAs($user)
            ->visit(route('kelas.saya'))
            ->see($class_attendee->lms_course_name)
            ->see('Masuk Kelas')
            ->see('Tulis Ulasan')
            ->dontSee('Mulai Tes')
            ->dontSee('Lihat E-Certificate')
            ->assertResponseStatus(200);

        Event::assertDispatched(ListKelasSayaEvent::class, function($e) use ($user) {
            return $e->user->id = $user->id;
        });
    }

    public function testKelasSayaWithTryoutCourse()
    {
        Event::fake();
        $user = $this->new_user;
        $product = factory(App\Product::class)->create([
            'is_tryout' => 1
        ]);

        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $this->actingAs($this->new_user)
            ->visit(route('kelas.saya'))
            ->see($class_attendee->lms_course_name)
            ->dontSee('Masuk Kelas')
            ->see('Mulai Tes')
            ->see('Tulis Ulasan')
            ->dontSee('Lihat E-Certificate')
            ->assertResponseStatus(200);

        Event::assertDispatched(ListKelasSayaEvent::class, function($e) use ($user) {
            return $e->user->id = $user->id;
        });
    }

    public function testKelasSayaCantReviewWithTryoutCourse()
    {
        Event::fake();
        $user = $this->new_user;
        $product = factory(App\Product::class)->create([
            'is_tryout' => 1
        ]);

        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $review = factory(App\RatingReview::class)->create([
            'product_id' => $product->id,
            'status' => App\RatingReview::STATUS_APPROVED,
            'reviewer_email' => $this->new_user->email,
        ]);

        $this->actingAs($this->new_user)
            ->visit(route('kelas.saya'))
            ->see($class_attendee->lms_course_name)
            ->dontSee('Masuk Kelas')
            ->see('Mulai Tes')
            ->dontSee('Tulis Ulasan')
            ->dontSee('Lihat E-Certificate')
            ->assertResponseStatus(200);

        Event::assertDispatched(ListKelasSayaEvent::class, function($e) use ($user) {
            return $e->user->id = $user->id;
        });
    }

    public function testKelasSayaSeeCourseCantReviewCourse()
    {
        Event::fake();
        $user = $this->new_user;
        $product = factory(App\Product::class)->create();

        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
            'certificate_published_at' => date('Y-m-d H:i:s'),
        ]);

        $review = factory(App\RatingReview::class)->create([
            'product_id' => $product->id,
            'status' => App\RatingReview::STATUS_PENDING,
            'reviewer_email' => $this->new_user->email,
        ]);

        $this->actingAs($this->new_user)
            ->visit(route('kelas.saya'))
            ->see($class_attendee->lms_course_name)
            ->see('Masuk Kelas')
            ->dontSee('Tulis Ulasan')
            ->see('Lihat E-Certificate')
            ->dontSee('Mulai Tes')
            ->assertResponseStatus(200);

        Event::assertDispatched(ListKelasSayaEvent::class, function($e) use ($user) {
            return $e->user->id = $user->id;
        });
    }

    public function testAkunSaya()
    {
        $this->actingAs($this->new_user)
            ->visit(route('akun.saya'))
            ->see('Akun Saya')
            ->see('Perbarui Akun Saya')
            ->assertResponseStatus(200);
    }

    public function testAkunSayaSeeReferralCode() {
        $referral_code = factory(App\UserReferralCode::class)->create([
            'user_id' => $this->new_user->id
        ]);

        $this->actingAs($this->new_user)
            ->visit(route('akun.saya'))
            ->see('Akun Saya')
            ->see('Kode referral saya')
            ->see($referral_code->referral_code)
            ->assertResponseStatus(200);
    }

    public function testUbahAkunSaya()
    {
        $this->actingAs($this->new_user)
            ->visit(route('ubah.akun.saya'))
            ->see('Perbarui Akun Saya')
            ->see('Submit')
            ->assertResponseStatus(200);
    }

    public function testViewEditPasswordPage()
    {
        $this->actingAs($this->new_user)
            ->visit(route('ubah.password.saya'))
            ->see('Perbarui Password Saya')
            ->see('Simpan')
            ->assertResponseStatus(200);
    }

    public function testSubmitUpdatePassword() {
        $request = $this->actingAs($this->new_user)
                        ->call('POST', route('update.password.saya'), [
            'password' => 'password',
        ]);

        $this->assertEquals(302, $request->status());
        $this->assertSessionHasErrors('new_password');
    }
    
    public function testNotPassValidationUpdateAkunSaya()
    {
        $request = $this->actingAs($this->new_user)->call('post', route('update.akun.saya'));

        $this->assertEquals(302, $request->status());
    }

    public function testSuccessUpdateAkunSaya()
    {
        Event::fake();
        Storage::fake('lmsums_gcs');

        $user = $this->new_user;
        $request = $this->actingAs($user)
                        ->call('post', route('update.akun.saya'), [
                            'name' => 'Test',
                            'profile_picture' => UploadedFile::fake()->image('profile_picture.png'),
                            'phone_number' => '',
                            'address' => '',
                            'home_number' => '',
                        ]);

        $this->assertEquals(204, $request->status());
        Event::assertDispatched(UpdateLmsUserDataEvent::class, function($e) use($user) {
            return $e->data['user_id'] == $user->provider_id &&
                $e->data['name'] == 'Test';
        });

        Storage::disk('lmsums_gcs')->assertExists('users/' . $user->provider_id . '/profile_picture_object_profile_picture.png');
    }

    public function testNotLoginUserAccessKelasSaya()
    {
        $request = $this->call('get', route('kelas.saya'));
        $this->assertEquals(302, $request->status());
    }

    public function testNotLoginAccessAkunSaya()
    {
        $request = $this->call('get', route('akun.saya'));
        $this->assertEquals(302, $request->status());
    }

    public function testNotLoginAccessPerbaruiAkunSaya()
    {
        $request = $this->call('get', route('ubah.akun.saya'));
        $this->assertEquals(302, $request->status());
    }

    public function testNotLoginAccessMasukKelas()
    {
        $request = $this->call('get', route('masuk.kelas'));
        $this->assertEquals(302, $request->status());
    }

    public function testNotLoginAccessMyTransaction()
    {
        $request = $this->call('get', route('my.transaction'));
        $this->assertEquals(302, $request->status());
    }

    public function testAccessTransaksiSaya()
    {
        $this->actingAs($this->new_user)
            ->visit(route('my.transaction'))
            ->see('TRANSAKSI SAYA')
            ->assertResponseStatus(200);
    }

    public function testAccessTransaksiSayaWithFilterSuccess()
    {
        $this->actingAs($this->new_user)
            ->visit(route('my.transaction') . '?filter=' . App\Order::CONVERTED_STATUS_SUCCESS)
            ->see('TRANSAKSI SAYA')
            ->assertResponseStatus(200);
    }

    public function testAccessTransaksiSayaWithFilterFailed()
    {
        $this->actingAs($this->new_user)
            ->visit(route('my.transaction') . '?filter=' . App\Order::CONVERTED_STATUS_FAILED)
            ->see('TRANSAKSI SAYA')
            ->assertResponseStatus(200);
    }

    public function testAccessTransaksiSayaWithFilterPending()
    {
        $this->actingAs($this->new_user)
            ->visit(route('my.transaction') . '?filter=' . App\Order::CONVERTED_STATUS_PENDING)
            ->see('TRANSAKSI SAYA')
            ->assertResponseStatus(200);
    }

    public function testNoOrderOnMyTransaction()
    {
        $this->actingAs($this->new_user)
            ->visit(route('my.transaction'))
            ->see('Belum ada transaksi yang ditemukan.')
            ->assertResponseStatus(200);
    }

    public function testSeeOrderHistoryOfOneProductOnMyTransaction()
    {
        $product = factory(App\Product::class)->create();

        $order = factory(App\Order::class)->create([
            'user_id' => $this->new_user->id,
            'product_slug' => $product->slug,
        ]);

        factory(App\PaymentNotification::class)->create([
            'order_id' => $order->order_number
        ]);

        $this->actingAs($this->new_user)
            ->visit(route('my.transaction'))
            ->see($product->name)
            ->assertResponseStatus(200);
    }

    public function testSeeOrderHistoryOfBundleOnMyTransaction()
    {
        $user = factory(App\User::class)->create();
        $products = factory(App\Product::class, 3)->create();

        $bundle = factory(App\Bundle::class)->create([
            'price' => 70000
        ]);

        $bundle->products()->sync($products);

        $order = factory(App\Order::class)->create([
            'user_id' => $user->id,
            'amount' => $bundle->price,
            'bundle_id' => $bundle->id
        ]);

        factory(App\PaymentNotification::class)->create([
            'order_id' => $order->order_number
        ]);

        $order_details = [];
        foreach($products as $product) {
            $order_details[] = factory(App\OrderDetail::class)->create([
                        'order_id' => $order->id,
                        'product_slug' => $product->slug
                    ]);
        }

        $this->actingAs($user)
            ->visit(route('my.transaction'))
            ->see($bundle->name)
            ->see($order->order_number)
            ->see($products[0]->name)
            ->see($products[1]->name)
            ->see($products[2]->name)
            ->see(rupiah_number_format($order->amount))
            ->assertResponseStatus(200);
    }

    public function testSeeNewProductPurchaseSystemOnMyTransaction()
    {
        $user = factory(App\User::class)->create();
        $product = factory(App\Product::class)->create();

        $order = factory(App\Order::class)->create([
            'user_id' => $user->id,
            'amount' => $product->price,
        ]);

        factory(App\PaymentNotification::class)->create([
            'order_id' => $order->order_number
        ]);

        $order_detail = factory(App\OrderDetail::class)->create([
                    'order_id' => $order->id,
                    'product_slug' => $product->slug
                ]);

        $this->actingAs($user)
            ->visit(route('my.transaction'))
            ->see($order->order_number)
            ->see(rupiah_number_format($order->amount))
            ->see($product->name)
            ->assertResponseStatus(200);
    }

    public function testSeeReviewPage() {
        $product = factory(App\Product::class)->create();

        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $this->actingAs($this->new_user)
            ->visit(route('user.product.review', [$product->slug]))
            ->see($product->name)
            ->see('Berikan penilaian mengenai kelas ini secara keseluruhan')
            ->see('Berikan ulasan untuk kelas ini')
            ->assertResponseStatus(200);
    }

    public function testCantSeeReviewPageCauseAlreadyReview() {
        $product = factory(App\Product::class)->create();

        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $review = factory(App\RatingReview::class)->create([
            'product_id' => $product->id,
            'status' => App\RatingReview::STATUS_PENDING,
            'reviewer_email' => $this->new_user->email,
        ]);

        $request = $this->actingAs($this->new_user)
            ->call('GET', route('user.product.review', [$product->slug]));

        $this->assertEquals(404, $request->status());
    }

    public function testCantSeeReviewPageCauseNotEnrolledToClass() {
        $product = factory(App\Product::class)->create();

        $request = $this->actingAs($this->new_user)
            ->call('GET', route('user.product.review', [$product->slug]));

        $this->assertEquals(404, $request->status());
    }

    public function testFailedSeeReviewPage() {
        $request = $this->actingAs($this->new_user)
            ->call('GET', route('user.product.review', ['fjafeiEf9r328r']));

        $this->assertEquals(404, $request->status());
    }

    public function testSubmitReviewWrongProductSlug() {
        $request = $this->actingAs($this->new_user)
                    ->call('POST', route('user.product.review.submit', ['faefaef']), [
                        'review' => 'oke',
                        'rating' => 4
                    ]);

        $response = json_decode((string) $request->getContent(), true);

        $this->assertEquals(200, $request->status());
        $this->assertEquals(400, $response['status']);
        $this->assertEquals('Produk yang akan Anda ulas tidak tersedia', $response['message']);
        $this->seeJsonStructure([
            'status', 'message'
        ]);
    }

    public function testSubmitReviewToSameProduct() {
        $product = factory(App\Product::class)->create();

        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $review = factory(App\RatingReview::class)->create([
            'product_id' => $product->id,
            'status' => App\RatingReview::STATUS_PENDING,
            'reviewer_email' => $this->new_user->email,
        ]);

        $request = $this->actingAs($this->new_user)
            ->call('POST', route('user.product.review.submit', [$product->slug]), [
                'review' => 'oke',
                'rating' => 4
            ]);

        $response = json_decode((string) $request->getContent(), true);

        $this->assertEquals(200, $request->status());
        $this->assertEquals(400, $response['status']);
        $this->assertEquals('Maaf, anda belum dapat mengirim ulasan untuk produk ini.', $response['message']);
        $this->seeJsonStructure([
            'status', 'message'
        ]);
    }

    public function testSuccessSubmitReview() {
        $product = factory(App\Product::class)->create();

        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $request = $this->actingAs($this->new_user)
            ->call('POST', route('user.product.review.submit', [$product->slug]), [
                'review' => 'oke',
                'rating' => 4
            ]);

        $response = json_decode((string) $request->getContent(), true);

        $this->assertEquals(200, $request->status());
        $this->assertEquals(200, $response['status']);
        $this->assertEquals('Terima kasih untuk ulasan Anda. Ulasan Anda akan melalui proses moderasi oleh Administrator kami.', $response['message']);
        $this->seeJsonStructure([
            'status', 'message'
        ]);
    }

    public function testSeeReviewInKelasSaya() {
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'is_review_shown' => true,
        ]);
        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $this->actingAs($this->new_user)
            ->visit('/kelas-saya')
            ->see('<div class="rating">')
            ->assertResponseStatus(200);
    }

    public function testNotSeeReviewInKelasSaya() {
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'is_review_shown' => false,
        ]);
        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $this->actingAs($this->new_user)
            ->visit('/kelas-saya')
            ->dontSee('<div class="rating">')
            ->assertResponseStatus(200);
    }

    public function testVisitTulisUlasanPageIfReviewIsShown() {
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'is_review_shown' => true,
        ]);
        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $this->actingAs($this->new_user)
            ->get('/ulasan/' . $product->slug)
            ->assertResponseStatus(200);
    }
    
    public function testCannotVisitTulisUlasanPageIfReviewIsNotShown() {
        $product = factory(App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'is_review_shown' => false,
        ]);
        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $this->actingAs($this->new_user)
            ->get('/ulasan/' . $product->slug)
            ->assertResponseStatus(404);
    }

    public function testFailedSubmitReviewToProductIfReviewIsNotShown() {
        $product = factory(App\Product::class)->create([
            'is_review_shown' => false,
        ]);

        $class_attendee = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $request = $this->actingAs($this->new_user)
            ->call('POST', route('user.product.review.submit', [$product->slug]), [
                'review' => 'oke',
                'rating' => 4
            ]);

        $response = json_decode((string) $request->getContent(), true);

        $this->assertEquals(200, $request->status());
        $this->assertEquals(400, $response['status']);
        $this->assertEquals('Maaf, anda belum dapat mengirim ulasan untuk produk ini.', $response['message']);
        $this->seeJsonStructure([
            'status', 'message'
        ]);
    }

    public function testRekomendasikanTemanmuPage()
    {
        $user_referral = factory(App\UserReferralCode::class)->create([
            'user_id' => $this->new_user->id,
        ]);
        $this->actingAs($this->new_user)
            ->visit(route('akun.saya'))
            ->see('BAGIKAN KODE REFERRAL')
            ->click('BAGIKAN KODE REFERRAL')
            ->seePageIs(route('akun.saya.rekomendasi'))
            ->see('Rekomendasikan temanmu!')
            ->see('Salin kode referral kamu')
            ->see($user_referral->referral_code)
            ->assertResponseStatus(200);
    }

    public function testSendReferralEmail()
    {
        Event::fake();
        
        $user_referral = factory(App\UserReferralCode::class)->create([
            'user_id' => $this->new_user->id,
        ]);

        $response = $this->actingAs($this->new_user)
            ->call('post', route('akun.saya.rekomendasi.email'), [
                'name' => 'tes',
                'email' => 'boho@yahoo.com',
                'redirect_to' => route('landing.kuliah'),
            ]);
        $this->assertEquals(200, $response->status());
        
        Event::assertDispatched(ReferralEmailEvent::class, function ($e) {
            return $e->referral['email'] === 'boho@yahoo.com';
        });
    }

    public function testSeeCorrectReferralList()
    {
        $user_referral = factory(App\UserReferralCode::class)->create([
            'user_id' => $this->new_user->id,
            'is_default' => 1,
        ]);

        $lead = factory(App\StudentLead::class)->create([
            'referral_code' => $user_referral->referral_code,
            'user_referral_code_id' => $user_referral->id,
            'Departement' => 'S1 UAI',
        ]);

        $this->actingAs($this->new_user)
            ->visit(route('akun.saya.rekomendasi'))
            ->see($lead->name)
            ->see($lead->email)
            ->see($lead->departement)
            ->assertResponseOk();
    }

    public function testGenerateAttendeeCardId()
    {
        $provider = factory(App\Provider::class)->create([
            'provider_code' => 'AT',
        ]);
        $product = factory(App\Product::class)->create([
            'learning_method_id' => 2,
            'course_start_at' => '2020-08-21 14:00:00',
            'course_end_at' => '2020-08-21 19:00:00',
            'training_code' => 'EX',
        ]);
        $product->providers()->attach($provider, [
            'sort' => 1,
        ]);

        $class = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $participant = factory(App\UserParticipant::class)->create([
            'user_id' => $this->new_user->id,
            'product_id' => $product->id,
        ]);

        $this->assertEquals(AttendeeCard::setAttendeeCardId($class)[0]->card_id, '001EX0820-AT');
    }

    public function testSeeOfflineCourseLabelInKelasSaya()
    {
        $method = factory(App\LearningMethod::class)->create([
            'name' => 'Tatap Muka',
        ]);
        $product = factory(App\Product::class)->create([
            'learning_method_id' => $method->id,
        ]);
        $class = factory(App\ClassAttendee::class)->create([
            'slug' => $product->slug,
            'user_id' => $this->new_user->id,
        ]);

        $this->actingAs($this->new_user)
            ->visit(route('kelas.saya'))
            ->see('Tatap Muka')
            ->see('Info Kelas')
            ->assertResponseOk();
    }

    public function testNotSeeKartuPesertaPage()
    {
        $this->get('stream.public.kartu.peserta', ['ident' => '123xzc'])
            ->assertResponseStatus(404);
    }
}
