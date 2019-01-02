<?php

namespace Tests\Unit;

use App;
use Session;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testDaftar() {
        $request = $this->call('GET', route('daftar'));

        $this->assertEquals(302, $request->status());
    }

    public function testLogout() {
        $affiliate = factory(App\Affiliate::class)->create([
            'domain_url' => 'pintaria.dev',
            'logged_in_domain_url' => 'pintaria.dev'
        ]);

        $request = $this->actingAs($this->affiliate)
                        ->call('get', route('keluar'));

        $this->assertEquals(302, $request->status());
    }

    public function testViewForgotPasswordPage() {
        $this->visit(route('lupa.password'))
            ->assertResponseStatus(200);
    }

    public function testViewSuccessSubmitForgotPassword() {
        Session::flash(config('constants.success_forgot_password'), true);

        $this->visit(route('lupa.password.cek.email'))
            ->assertResponseStatus(200);
    }

    public function testNoValidSessionForSuccessSubmitForgotPassword() {
        $this->visit(route('lupa.password.cek.email'))
            ->assertResponseStatus(200);
    }
}
