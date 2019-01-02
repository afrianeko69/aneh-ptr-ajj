<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ProviderTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testLoginAdmin()
    {
        $response = $this->call('post', '/admin/login', [
            'email' => $this->user->email,
            'password' => 123456
        ]);
        $this->assertResponseStatus(302, $response->status());
    }

    public function testSeeProviderMenu()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Providers')
            ->assertResponseStatus(200);
    }

    public function testVisitProviderPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Providers')
            ->click('Providers')
            ->seePageIs('/admin/providers');
    }

    public function testSeeProviderCode()
    {
        $this->actingAs($this->user)
            ->visit('/admin/providers/create')
            ->see('Provider Code')
            ->assertResponseStatus(200);
    }
}
