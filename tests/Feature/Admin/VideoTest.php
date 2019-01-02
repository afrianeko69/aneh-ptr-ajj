<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class VideoTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testSeeVideoAdminPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Video')
            ->click('Video')
            ->seePageIs('/admin/videos')
            ->assertResponseStatus(200);
    }
}
