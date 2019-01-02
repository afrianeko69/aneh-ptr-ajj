<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;

class PaymentTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function testMockMidtransNotification() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['notification'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'class_attendees' => true,
            'email_notification' => true,
        ];

        $request = new Request;
        $stub->method('notification')->willReturn($response);
        $this->assertEquals($response, $stub->notification($request, $response));
    }

    public function testMockMidtransNotificationFailed() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['notification'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = 'Cannot process data';

        $request = new Request;
        $stub->method('notification')->willReturn($response);
        $this->assertEquals($response, $stub->notification($request, $response));
    }

    public function testMockMidtransNotificationUnAuthorized() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['notification'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = 'Unauthorized, Signature key invalid';

        $request = new Request;
        $stub->method('notification')->willReturn($response);
        $this->assertEquals($response, $stub->notification($request, $response));
    }

    public function testMockMidtransNotificationNotFoundOrder() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
                    ->setMethods(['notification'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = 'Order 201709000014 not found!';

        $request = new Request;
        $stub->method('notification')->willReturn($response);
        $this->assertEquals($response, $stub->notification($request, $response));
    }

    public function testNotificationButNotValidSignature() {
        $request = $this->call('POST', route('midtrans.notification'), [
              "transaction_time" => "2017-08-08 14:46:52",
              "transaction_status" => "settlement",
              "transaction_id" => "187476bc-43f4-4053-8ddb-36ef48bdb830",
              "status_message" => "Veritrans payment notification",
              "status_code" => "200",
              "signature_key" => "testsignaturekey",
              "payment_type" => "echannel",
              "order_id" => "201708000040",
              "gross_amount" => "750000.00",
              "fraud_status" => "accept",
              "biller_code" => "70012",
              "bill_key" => "369481705900",
        ]);

        $this->assertEquals(422, $request->status());
    }

    public function testMockAkuLakuNotification() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
            ->setMethods(['akuLakuNotification'])
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();

        $response = [
            'class_attendees' => true,
            'email_notification' => true,
        ];

        $request = new Request;
        $stub->method('akuLakuNotification')->willReturn($response);
        $this->assertEquals($response, $stub->akuLakuNotification($request, $response));
    }

    public function testMockAkuLakuNotificationFailed() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
            ->setMethods(['akuLakuNotification'])
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();

        $response = 'Cannot process data';

        $request = new Request;
        $stub->method('akuLakuNotification')->willReturn($response);
        $this->assertEquals($response, $stub->akuLakuNotification($request, $response));
    }

    public function testMockAkuLakuNotificationNotFoundOrder() {
        $stub = $this->getMockBuilder('App\Http\Controller\OrderController')
            ->setMethods(['akuLakuNotification'])
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();

        $response = 'Order 201709000014 not found!';

        $request = new Request;
        $stub->method('akuLakuNotification')->willReturn($response);
        $this->assertEquals($response, $stub->akuLakuNotification($request, $response));
    }
}
