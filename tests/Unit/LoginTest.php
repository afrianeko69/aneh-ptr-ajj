<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App;
use Illuminate\Http\Request;
use Session, Config;

class LoginTest extends TestCase
{
    private $new_user;
    public function setUp()
    {
        parent::setUp();
        $this->new_user = factory(App\User::class)->create();
    }

    public function testViewForgotPasswordPage()
    {
        $this->visit(route('lupa.password'))
            ->see('Lupa Password?')
            ->see('Ganti Password')
            ->assertResponseStatus(200);
    }

    public function testFailedSubmitForgotPassword()
    {
        $response = $this->call('post', route('submit.lupa.password'), [
            'email' => ''
        ]);
        $this->assertEquals(302, $response->status());
    }

    public function testSuccessSubmitForgotPassword()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\AuthController')
                    ->setMethods(['submitForgotPassword'])
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->getMock();
        $response = ['status' => 200];

        $request = new Request;
        $stub->method('submitForgotPassword')->willReturn($response);
        $this->assertEquals($response, $stub->submitForgotPassword($request, $response));
    }

    public function testRedirectToSuccessPageAfterForgotPassword()
    {
        Session::put(Config::get('constants.success_forgot_password'), true);
        $this->visit(route('lupa.password.cek.email'))
            ->see('Password Anda Akan Diubah')
            ->see('Kembali Ke Beranda')
            ->assertResponseStatus(200);
        Session::forget(Config::get('constants.success_forgot_password'));
    }

    public function testNoAccessToSuccessPageAfterForgotPassword()
    {
        $this->visit(route('lupa.password.cek.email'))
            ->seePageIs(route('home'))
            ->assertResponseStatus(200);
    }

    public function testLoginUserAccessDaftarPage()
    {
        $this->actingAs($this->new_user)
             ->visit(route('daftar'))
             ->seePageIs(route('home'))
             ->assertResponseStatus(200);
    }

    public function testLoginUserAccessLupaPassword()
    {
        $this->actingAs($this->new_user)
             ->visit(route('lupa.password'))
             ->seePageIs(route('home'))
             ->assertResponseStatus(200);
    }
}
