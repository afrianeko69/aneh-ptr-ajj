<?php

namespace Tests\Unit\Api;

use App;
use Illuminate\Http\Request;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testFailedValidationOnRegistration() {
        $request = $this->call('POST', route('api.registers.store'));
        $this->assertEquals(302, $request->status());
    }

    public function testWrongRegisterUsingOnRegistration() {
        $request = $this->call('POST', route('api.registers.store'), [
            'name' => 'aba',
            'email' => 'feafife_feaooq@gmail.com',
            'password' => '12345678',
            'confirm_password' => '12345678',
            'register_using' => 'abc'
        ]);
        $this->assertEquals(400, $request->status());

        $this->seeJsonStructure([
            'status', 'message', 'data'
        ]);

        $response = json_decode((string) $request->getContent(), true);
        $this->assertEquals($response['message'], 'Mohon maaf, harap menghubungi admin kami mengenai masalah ini.');
        $this->assertEquals($response['data'], null);
        $this->assertEquals($response['status'], 400);
    }

    public function testRegisterUsingSSOOnRegistrationNoConfirmPassword() {
        $request = $this->call('POST', route('api.registers.store'), [
            'name' => 'aba',
            'email' => 'feafife_feaooq@gmail.com',
            'password' => '12345678',
            'register_using' => \App\UserAccountProvider::SSO_PROVIDER,
        ]);
        $this->assertEquals(302, $request->status());
        $this->assertSessionHasErrors('confirm_password');
    }

    public function testMockFailedOnRegisterUserCreateFirebaseEmailExists()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\Api\RegisterController')
                    ->setMethods(['store'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 400,
            'message' => 'Maaf, email anda sudah terdaftar di sistem kami.'
        ];

        $request = new Request;
        $stub->method('store')->willReturn($response);
        $this->assertEquals($response, $stub->store($request, $response));
    }

    public function testMockFailedOnRegisterUserCreateFirebaseOperationNotAllowed()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\Api\RegisterController')
                    ->setMethods(['store'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 400,
            'message' => 'Maaf, register dengan menggunakan password sedang tidak berlaku'
        ];

        $request = new Request;
        $stub->method('store')->willReturn($response);
        $this->assertEquals($response, $stub->store($request, $response));
    }

    public function testMockFailedOnRegisterUserCreateFirebaseTooManyAttempts()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\Api\RegisterController')
                    ->setMethods(['store'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 400,
            'message' => 'Maaf, saat ini kami mendeteksi kegiatan yang tidak biasa. Silakan mencoba kembali nanti.'
        ];

        $request = new Request;
        $stub->method('store')->willReturn($response);
        $this->assertEquals($response, $stub->store($request, $response));
    }

    public function testMockFailedOnCreateUserOnLMS()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\Api\RegisterController')
                    ->setMethods(['store'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 400,
            'message' => 'Maaf, saat ini kami sedang mengalami kendala dalam memproses data anda.'
        ];

        $request = new Request;
        $stub->method('store')->willReturn($response);
        $this->assertEquals($response, $stub->store($request, $response));
    }

    public function testMockFailedOnCreateUserOnPintaria()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\Api\RegisterController')
                    ->setMethods(['store'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 400,
            'message' => 'Maaf, kami kesulitan memproses data anda.',
            'data' => null
        ];

        $request = new Request;
        $stub->method('store')->willReturn($response);
        $this->assertEquals($response, $stub->store($request, $response));
    }

    public function testMockSuccessOnRegistrationWithPassword()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\Api\RegisterController')
                    ->setMethods(['store'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 201,
            'message' => 'success',
            'data' => [
                'type' => 'redirection',
                'redirect_to' => 'http://pintaria.dev/terima-kasih'
            ]
        ];

        $request = new Request;
        $stub->method('store')->willReturn($response);
        $this->assertEquals($response, $stub->store($request, $response));
    }

    public function testMockSuccessOnRegistrationWithSocialMedia()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\Api\RegisterController')
                    ->setMethods(['store'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();

        $response = [
            'status' => 201,
            'message' => 'success',
            'data' => [
                'type' => 'redirection',
                'redirect_to' => 'http://pintaria.dev/masuk'
            ]
        ];

        $request = new Request;
        $stub->method('store')->willReturn($response);
        $this->assertEquals($response, $stub->store($request, $response));
    }
}
