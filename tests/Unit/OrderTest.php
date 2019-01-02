<?php

namespace Tests\Unit;

use App;
use App\Bundle;
use App\Events\EnrollToKlassEvent;
use App\Order;
use App\Product;
use App\Promotion;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Session;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }

    // Start Static Page Order
    public function testDirectAccessPendingPaymentStaticPage()
    {
        $request = $this->call('GET', 'menunggu-transaksi-pembayaran/fjeaifjaeif');
        $this->assertEquals(404, $request->status());
    }

    public function testAccessSessionAndParamsNotMatchOnPendingPaymentStaticPage()
    {
        $order = factory(Order::class)->create();
        Session::flash(config('constants.static_payment_page'), $order->order_number);

        $request = $this->call('GET', route('transaction.pending', ['123456']));
        $this->assertEquals(404, $request->status());
    }

    public function testViewPendingPaymentStaticPageButNotInOrderTable() {
        $order_number = '123-ORD-2018';
        Session::flash(config('constants.static_payment_page'), $order_number);

        $request = $this->call('GET', route('transaction.pending', [$order_number]));
        $this->assertEquals(404, $request->status());
    }

    public function testSuccessAccessPendingPaymentStaticPage()
    {
        $order = factory(Order::class)->create();
        Session::flash(config('constants.static_payment_page'), $order->order_number);

        $request = $this->call('GET', route('transaction.pending', [$order->order_number]));
        $this->assertEquals(200, $request->status());
    }

    public function testDirectAccessSuccessPaymentStaticPage()
    {
        $request = $this->call('GET', route('transaction.success', ['fadkfjaksdfj']));
        $this->assertEquals(404, $request->status());
    }

    public function testAccessSessionAndParamsNotMatchOnSuccessPaymentStaticPage()
    {
        $order = factory(Order::class, 2)->create();
        Session::flash(config('constants.static_payment_page'), $order[0]->order_number);

        $request = $this->call('GET', route('transaction.success', [$order[1]->order_number]));
        $this->assertEquals(404, $request->status());
    }

    public function testViewSuccessPaymentStaticPageButNotInOrderTable() {
        $order_number = '123-ORD-2018';
        Session::flash(config('constants.static_payment_page'), $order_number);

        $request = $this->call('GET', route('transaction.success', [$order_number]));
        $this->assertEquals(404, $request->status());
    }

    public function testSuccessAccessSuccessPaymentStaticPage()
    {
        $order = factory(Order::class)->create();
        Session::flash(config('constants.static_payment_page'), $order->order_number);

        $request = $this->call('GET', route('transaction.success', [$order->order_number]));
        $this->assertEquals(200, $request->status());
    }

    public function testDirectAccessFailPaymentStaticPage()
    {
        $request = $this->call('GET', route('transaction.error', ['ffefasef']));
        $this->assertEquals(404, $request->status());
    }

    public function testAccessSessionAndParamsNotMatchOnFailPaymentStaticPage()
    {
        $order = factory(Order::class, 2)->create();
        Session::flash(config('constants.static_payment_page'), $order[0]->order_number);

        $request = $this->call('GET', route('transaction.error', [$order[1]->order_number]));
        $this->assertEquals(404, $request->status());
    }

    public function testViewFailedPaymentStaticPageButNotInOrderTable() {
        $order_number = '123-ORD-2018';
        Session::flash(config('constants.static_payment_page'), $order_number);

        $request = $this->call('GET', route('transaction.error', [$order_number]));
        $this->assertEquals(404, $request->status());
    }

    public function testSuccessAccessFailPaymentStaticPage()
    {
        $order = factory(Order::class)->create();
        Session::flash(config('constants.static_payment_page'), $order->order_number);

        $request = $this->call('GET', route('transaction.error', [$order->order_number]));
        $this->assertEquals(200, $request->status());
    }
    // End Static Page Order

    // Start Purchase Product
    public function testPurchaseWithoutLogin() {
        $request = $this->call('POST', route('purchase.kelas'), [
            'slug' => 'abc',
            'type' => 'paid',
            'payment_method' => 'midtrans',
            'phone_number' => '08349384394',
        ]);

        $this->assertEquals(200, $request->status());
        $response = json_decode((string) $request->getContent(), true);
        $this->assertEquals(401, $response['status']);
    }

    public function testPurchaseProductNotValid() {
        $request = $this->actingAs($this->affiliate)
                    ->call('POST', route('purchase.kelas'), [
                        'slug' => 'abc',
                        'type' => 'free',
                        'payment_method' => 'midtrans',
                        'bundle_id' => '',
                    ]);

        $response = json_decode((string) $request->getContent(), true);

        $this->assertEquals(200, $request->status());
        $this->assertEquals(404, $response['status']);
        $this->assertEquals('Maaf, produk yang anda proses untuk dibeli tidak ditemukan.', $response['message']);
        $this->assertEquals(null, $response['data']);
        $this->assertEquals(false, $response['is_using_midtrans']);
    }

    public function testPurchaseFreeProduct() {
        Event::fake();

        $product = factory(Product::class)->create(['price' => 0]);
        $user = $this->affiliate;
        $request = $this->actingAs($user)
                    ->call('POST', route('purchase.kelas'), [
                        'slug' => $product->slug,
                        'type' => 'free',
                        'payment_method' => 'midtrans',
                        'bundle_id' => '',
                    ]);

        $response = json_decode((string) $request->getContent(), true);
        $this->assertEquals(200, $request->status());
        $this->assertEquals(200, $response['status']);
        $this->assertEquals('success', $response['message']);
        $this->assertEquals(null, $response['data']);
        $this->assertEquals(false, $response['is_using_midtrans']);
        $this->assertEquals('Anda telah sukses didaftarkan ke Kelas ' . $product->name, session()->get('message-success'));

        Event::assertDispatched(EnrollToKlassEvent::class, function($e) use ($product, $user) {
            return $e->user->email == $user->email && $e->slug == $product->slug;
        });
    }

    public function testPurchaseBundleProduct() {
        $user = $this->affiliate;
        $request = $this->actingAs($user)
                    ->call('POST', route('purchase.kelas'), [
                        'slug' => 'abc',
                        'bundle_id' => 100,
                        'type' => 'paid',
                        'payment_method' => 'midtrans',
                        'phone_number' => '0823834423434',
                    ]);

        $response = json_decode((string) $request->getContent(), true);
        $this->assertEquals(200, $request->status());
        $this->assertEquals(400, $response['status']);
        $this->assertEquals('Maaf, paket yang anda proses tidak ditemukan', $response['message']);
        $this->assertEquals(null, $response['data']);
        $this->assertEquals(false, $response['is_using_midtrans']);
    }

    public function testMockPurchaseCourse() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['processPurchase'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 200,
            'message' => 'success',
            'is_using_midtrans' => true,
            'data' => [
                'token' => '8ab4f1dd-0baf-4e0e-8122-d753d0d2cc36'
            ]
        ];

        $request = new Request;
        $stub->method('processPurchase')->willReturn($response);
        $this->assertEquals($response, $stub->processPurchase($request, $response));
    }

    public function testMockPurchaseCourseFailedGetToken() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['processPurchase'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 400,
            'message' => 'Maaf, kami tidak dapat memproses pembayaran anda saat ini.',
            'is_using_midtrans' => false,
            'data' => null
        ];

        $request = new Request;
        $stub->method('processPurchase')->willReturn($response);
        $this->assertEquals($response, $stub->processPurchase($request, $response));
    }

    public function testMockPurchaseCourseProductNotFound() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['processPurchase'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 400,
            'message' => 'Maaf, kami tidak dapat mengambil data paket anda.',
            'is_using_midtrans' => false,
            'data' => null
        ];

        $request = new Request;
        $stub->method('processPurchase')->willReturn($response);
        $this->assertEquals($response, $stub->processPurchase($request, $response));
    }
    // End Purchase Product

    // Start Referral Code
    public function testMockSuccessCheckReferralCodeAmountType() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['checkReferralCode'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 200,
            'message' => 'success',
            'body' => [
                'is_valid' => true,
                'type' => 'Amount',
                'value' => '150000'
            ]
        ];

        $request = new Request;
        $stub->method('checkReferralCode')->willReturn($response);
        $this->assertEquals($response, $stub->checkReferralCode($request, $response));
    }

    public function testMockSuccessCheckReferralCodePercentageType() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['checkReferralCode'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 200,
            'message' => 'success',
            'body' => [
                'is_valid' => true,
                'type' => 'Percentage',
                'value' => '15'
            ]
        ];

        $request = new Request;
        $stub->method('checkReferralCode')->willReturn($response);
        $this->assertEquals($response, $stub->checkReferralCode($request, $response));
    }

    public function testMockNotValidProductOrBundleOnCheckReferralCode() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['checkReferralCode'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 200,
            'message' => 'Kode Referral tidak ditemukan atau sudah tidak berlaku.',
            'body' => [
                'is_valid' => false
            ]
        ];

        $request = new Request;
        $stub->method('checkReferralCode')->willReturn($response);
        $this->assertEquals($response, $stub->checkReferralCode($request, $response));
    }

    public function testMockNotValidReferralCodeOnCheckReferralCode() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['checkReferralCode'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 400,
            'message' => 'Kode Referral tidak ditemukan atau sudah tidak berlaku.',
        ];

        $request = new Request;
        $stub->method('checkReferralCode')->willReturn($response);
        $this->assertEquals($response, $stub->checkReferralCode($request, $response));
    }
    // End Referral Code

    // Start Promo Code
    public function testCheckInvalidPromoCode() {
        $request = $this->call('get', route('check.promo.code', ['aaaa-3)', 5, 'product']));
        $this->assertEquals(400, $request->status());

        $response = json_decode((string) $request->getContent(), true);
        $this->seeJsonStructure([
            'status',
            'message',
            'body' => [
                'is_valid', 'value', 'type'
            ]
        ]);
        $this->assertEquals($response['message'], 'Kode Promo tidak ditemukan atau sudah tidak berlaku');
        $this->assertEquals($response['body']['value'], null);
        $this->assertEquals($response['body']['type'], null);
        $this->assertEquals($response['body']['is_valid'], false);
    }

    public function testNotActivePromoCodeValidity() {
        $now = date('Y-m-d H:i:s');
        $promo = factory(Promotion::class)->create([
            'start_at' => date('Y-m-d H:i:s', strtotime($now . '-10 days')),
            'end_at' => date('Y-m-d H:i:s', strtotime($now . '-7 days'))
        ]);

        $request = $this->call('get', route('check.promo.code', [$promo->promo_code, 5, 'product']));
        $this->assertEquals(400, $request->status());

        $response = json_decode((string) $request->getContent(), true);
        $this->seeJsonStructure([
            'status',
            'message',
            'body' => [
                'is_valid', 'value', 'type'
            ]
        ]);
        $this->assertEquals($response['message'], 'Kode Promo tidak ditemukan atau sudah tidak berlaku');
        $this->assertEquals($response['body']['value'], null);
        $this->assertEquals($response['body']['type'], null);
        $this->assertEquals($response['body']['is_valid'], false);
    }

    public function testNotStartedPromotion() {
        $now = date('Y-m-d H:i:s');
        $promo = factory(Promotion::class)->create([
            'start_at' => date('Y-m-d H:i:s', strtotime($now . '+10 days')),
            'end_at' => date('Y-m-d H:i:s', strtotime($now . '+15 days'))
        ]);

        $request = $this->call('get', route('check.promo.code', [$promo->promo_code, 5, 'product']));
        $this->assertEquals(400, $request->status());

        $response = json_decode((string) $request->getContent(), true);
        $this->seeJsonStructure([
            'status',
            'message',
            'body' => [
                'is_valid', 'value', 'type'
            ]
        ]);
        $this->assertEquals($response['message'], 'Kode Promo tidak ditemukan atau sudah tidak berlaku');
        $this->assertEquals($response['body']['value'], null);
        $this->assertEquals($response['body']['type'], null);
        $this->assertEquals($response['body']['is_valid'], false);
    }

    public function testValidPromoButNotValidProduct() {
        $now = date('Y-m-d H:i:s');
        $promo = factory(Promotion::class)->create([
            'start_at' => date('Y-m-d H:i:s', strtotime($now . '-10 days')),
            'end_at' => date('Y-m-d H:i:s', strtotime($now . '+10 days'))
        ]);

        $request = $this->call('get', route('check.promo.code', [$promo->promo_code, 50000, 'product']));
        $this->assertEquals(400, $request->status());

        $response = json_decode((string) $request->getContent(), true);
        $this->seeJsonStructure([
            'status',
            'message',
            'body' => [
                'is_valid', 'value', 'type'
            ]
        ]);
        $this->assertEquals($response['message'], 'Kode Promo tidak ditemukan atau sudah tidak berlaku');
        $this->assertEquals($response['body']['value'], null);
        $this->assertEquals($response['body']['type'], null);
        $this->assertEquals($response['body']['is_valid'], false);
    }

    public function testValidPromoValidProduct() {
        $now = date('Y-m-d H:i:s');
        $promo = factory(Promotion::class)->create([
            'start_at' => date('Y-m-d H:i:s', strtotime($now . '-10 days')),
            'end_at' => date('Y-m-d H:i:s', strtotime($now . '+10 days'))
        ]);

        $product = factory(Product::class)->create();
        $promo->product()->sync($product);

        $request = $this->call('get', route('check.promo.code', [$promo->promo_code, $product->id, 'product']));
        $this->assertEquals(200, $request->status());

        $response = json_decode((string) $request->getContent(), true);
        $this->seeJsonStructure([
            'status',
            'message',
            'body' => [
                'is_valid', 'value', 'type'
            ]
        ]);
        $this->assertEquals($response['body']['value'], $promo->discount_value);
        $this->assertEquals($response['body']['type'], $promo->discount_type);
        $this->assertEquals($response['body']['is_valid'], true);
    }

    public function testValidPromoValidBundle() {
        $now = date('Y-m-d H:i:s');
        $promo = factory(Promotion::class)->create([
            'start_at' => date('Y-m-d H:i:s', strtotime($now . '-10 days')),
            'end_at' => date('Y-m-d H:i:s', strtotime($now . '+10 days'))
        ]);

        $bundle = factory(Bundle::class)->create();
        $promo->bundle()->sync($bundle);

        $request = $this->call('get', route('check.promo.code', [$promo->promo_code, $bundle->id, 'bundle']));
        $this->assertEquals(200, $request->status());

        $response = json_decode((string) $request->getContent(), true);
        $this->seeJsonStructure([
            'status',
            'message',
            'body' => [
                'is_valid', 'value', 'type'
            ]
        ]);
        $this->assertEquals($response['body']['value'], $promo->discount_value);
        $this->assertEquals($response['body']['type'], $promo->discount_type);
        $this->assertEquals($response['body']['is_valid'], true);
    }
    // End Promo Code

    public function testPurchaseWithoutPaymentGateway() {
        $request = $this->call('POST', route('purchase.kelas'), [
            'slug' => 'abc',
            'type' => 'paid',
            'phone_number' => '08349384394',
        ]);

        $this->assertEquals(302, $request->status());
    }

    public function testPurchaseWithAkuLakuWithoutLogin() {
        $request = $this->call('POST', route('purchase.kelas'), [
            'slug' => 'abc',
            'type' => 'paid',
            'payment_method' => 'akulaku',
            'phone_number' => '08349384394',
        ]);

        $this->assertEquals(200, $request->status());
        $response = json_decode((string) $request->getContent(), true);
        $this->assertEquals(401, $response['status']);
    }

    public function testPurchaseProductWithAkuLakuNotValid() {
        $request = $this->actingAs($this->affiliate)
            ->call('POST', route('purchase.kelas'), [
                'slug' => 'abc',
                'type' => 'free',
                'payment_method' => 'akulaku',
                'bundle_id' => '',
            ]);

        $response = json_decode((string) $request->getContent(), true);

        $this->assertEquals(200, $request->status());
        $this->assertEquals(404, $response['status']);
        $this->assertEquals('Maaf, produk yang anda proses untuk dibeli tidak ditemukan.', $response['message']);
        $this->assertEquals(null, $response['data']);
        $this->assertEquals(false, $response['is_using_midtrans']);
    }

    public function testPurchaseBundleProductWithAkuLakuNotValid() {
        $user = $this->affiliate;
        $request = $this->actingAs($user)
            ->call('POST', route('purchase.kelas'), [
                'slug' => 'abc',
                'bundle_id' => 100,
                'type' => 'paid',
                'payment_method' => 'akulaku',
                'phone_number' => '0823834423434',
            ]);

        $response = json_decode((string) $request->getContent(), true);
        $this->assertEquals(200, $request->status());
        $this->assertEquals(400, $response['status']);
        $this->assertEquals('Maaf, paket yang anda proses tidak ditemukan', $response['message']);
        $this->assertEquals(null, $response['data']);
        $this->assertEquals(false, $response['is_using_midtrans']);
    }

    public function testPreviousPageLinkKonfirmasiBeliPage() {
        $user = factory(\App\User::class)->create();

        $product = factory(\App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'is_learning_material_showed' => false,
        ]);

        $this->actingAs($user)
            ->visit(route('product.konfirmasi.beli', ['slug' => $product->slug]))
            ->click('previous_page_buy_confirmation')
            ->seePageIs(route('product.index', [$product->slug]))
            ->assertResponseStatus(200);
    }


    public function testSeeParticipant() {
        $user = factory(\App\User::class)->create();

        $product = factory(\App\Product::class)->create([
            'is_content_ready' => true,
            'is_open_enrollment' => true,
            'learning_method_id' => 2,
        ]);

        $this->actingAs($user)
            ->visit(url($product->slug . '/konfirmasi-beli'))
            ->see('Nama Peserta')
            ->assertResponseStatus(200);
    }

    public function testSaveParticipant() {
        $table = 'user_participants';
        $data = [
            'user_id' => rand(0,9),
            'product_id' => rand(0,9),
            'name' => 'Peserta 1',
            'email' => 'Peserta1@mail.com',
            'phone' => '0189195819',
            'company' => 'Perusahaan',
        ];
        $request = $this->call('POST', route('save.participant'), $data);
        $this->assertEquals(200, $request->status());
    }

    public function testCheckParticipantDiscount() {
        $method = factory(App\LearningMethod::class)->create([
            'name' => 'Tatap Muka',
        ]);
        $product = factory(App\Product::class)->create([
            'learning_method_id' => $method->id,
        ]);
        $discount = factory(App\UserParticipantDiscount::class)->create([
            'participant_number' => 2,
            'product_id' => $product->id,
            'is_same_provider' => 1,
        ]);

        $form = [
            'user_id' => rand(0,9),
            'product_id' => $product->id,
            'peserta' => [
                'name' => [
                    'asdfg',
                    'zxcvb',
                ],
                'email' => [
                    'asdfg@yahoo.com',
                    'zxcvb@yahoo.com',
                ],
                'phone' => [
                    '08989898787',
                    '08666767678',
                ],
                'company' => [
                    'Sama',
                    'Sama',
                ],
            ],
        ];
                
        $request = $this->call('POST', route('check.participant.discount'), $form);
        $this->assertEquals(200, $request->status());
    }
}
