<?php

namespace Tests\Unit;

use App;
use App\Events\ListKelasSayaEvent;
use Cache;
use Illuminate\Support\Facades\Event;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Session;
use Tests\TestCase;

class ProviderTest extends TestCase
{
    public function setUp() {
        parent::setUp();
        Cache::flush();
    }

    public function testLogin() {
        $request = $this->call('GET', route('masuk') . '?previous_url=' . route('konfirmasi.akun'));

        $this->assertEquals(302, $request->status());
        $this->assertContains('lms-sso.dev/oauth/authorize', $request->getTargetUrl());
    }

    public function testCallbackLoginFailed() {
        $request = $this->call('GET', route('sso.callback'));

        $this->assertEquals(302, $request->status());
        $this->assertSessionHas('message-danger', 'Maaf, terdapat kendala ketika mengakses Akun Anda. Mohon mencoba dalam beberapa saat lagi.');
    }

    private function mockSocialiteFacade($data) {
        $socialiteUser = $this->createMock('Laravel\Socialite\Two\User');
        $socialiteUser->token = $data['token'];
        $socialiteUser->id = $data['id'];
        $socialiteUser->email = $data['email'];
        $socialiteUser->name = $data['name'];
        $socialiteUser->remember = $data['remember'];
        $socialiteUser->user = [
            'created_at' => $data['created_at'],
        ];

        $userProvider = $this->createMock(\App\Providers\PintariaAuthProvider::class);
        $userProvider->expects($this->any())
                ->method('user')
                ->willReturn($socialiteUser);

        $provider = $this->createMock(\App\Providers\PintariaAuthProvider::class);
        $provider->expects($this->any())
                ->method('stateless')
                ->willReturn($userProvider);

        $stub = $this->createMock(Socialite::class);
        $stub->expects($this->any())
            ->method('driver')
            ->willReturn($provider);

        $this->app->instance(Socialite::class, $stub);
    }

    public function testAlreadyRegisteredInPintaria() {
        Event::fake();

        Session::flash(config('constants.previous_page'), 'http://pintaria.dev');
        $user = factory(App\User::class)->create();

        $data = [
            'token' => uniqid(),
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'created_at' => $user->created_at,
            'remember' => uniqid(),
        ];

        $this->mockSocialiteFacade($data);

        $this->visit(route('sso.callback'))
            ->seePageIs(route('home'));

        Event::assertDispatched(ListKelasSayaEvent::class, function($e) use($user) {
            return $e->user->email == $user->email;
        });
    }

    public function testAlreadyRegisteredInPintariaWithChangeRedirection() {
        Event::fake();

        Session::flash(config('constants.previous_page'), 'facebook.com');
        $user = factory(App\User::class)->create();

        $data = [
            'token' => uniqid(),
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'created_at' => $user->created_at,
            'remember' => uniqid(),
        ];

        $this->mockSocialiteFacade($data);

        $this->visit(route('sso.callback'))
            ->seePageIs(route('home'));

        Event::assertDispatched(ListKelasSayaEvent::class, function($e) use($user) {
            return $e->user->email == $user->email;
        });
    }

    public function testNewRegisteredInPintaria() {
        Event::fake();

        Session::flash(config('constants.previous_page'), 'http://pintaria.dev');

        $data = [
            'token' => uniqid(),
            'id' => 10,
            'email' => 'zuckerberg@gmail.com',
            'name' => 'Zuckerberg',
            'created_at' => date('Y-m-d H:i:s'),
            'remember' => uniqid(),
        ];

        $this->mockSocialiteFacade($data);

        $this->visit(route('sso.callback'))
            ->seePageIs(route('home'));

        Event::assertDispatched(ListKelasSayaEvent::class, function($e) use($data) {
            return $e->user->email == $data['email'];
        });
    }

    public function testNoGenerateReferralCode() {
        Event::fake();

        Session::flash(config('constants.previous_page'), 'facebook.com');
        $user = factory(App\User::class)->create();

        $data = [
            'token' => uniqid(),
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'created_at' => $user->created_at,
            'remember' => uniqid(),
        ];

        $this->mockSocialiteFacade($data);

        $this->visit(route('sso.callback'))
            ->seePageIs(route('home'));

        Event::assertDispatched(ListKelasSayaEvent::class, function($e) use($user) {
            return $e->user->email == $user->email;
        });
    }

    public function testMasukKelasWithNoMasukKelasLink() {
        $this->actingAs($this->affiliate)
            ->visit(route('masuk.kelas'))
            ->assertResponseStatus(200);
    }

    public function testMasukKelasWithMasukKelasLink() {
        $user = factory(App\User::class)->create([
            'token' => uniqid(),
        ]);

        $socialiteUser = $this->createMock('Laravel\Socialite\Two\User');
        $socialiteUser->token = uniqid();

        $provider = $this->createMock(\App\Providers\PintariaAuthProvider::class);
        $provider->expects($this->any())
                ->method('tokenLink')
                ->willReturn($socialiteUser);

        $stub = $this->createMock(Socialite::class);
        $stub->expects($this->any())
            ->method('driver')
            ->willReturn($provider);

        $this->app->instance(Socialite::class, $stub);

        $request = $this->actingAs($user)
            ->call('GET', route('masuk.kelas') . '?masuk_kelas=http://pintaria.dev');

        $this->assertEquals(302, $request->status());
    }
}
