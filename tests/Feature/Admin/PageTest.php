<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PageTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeePageMenu()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Pages')
            ->click('Pages')
            ->seePageIs('/admin/pages')
            ->assertResponseStatus(200);
    }
}
