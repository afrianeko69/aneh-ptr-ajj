<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BannerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testSeeBannerAdminPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Banner')
            ->click('Banner')
            ->seePageIs('/admin/banners')
            ->assertResponseStatus(200);
    }
}
