<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class NewsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeeNewsPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('News')
            ->click('News')
            ->seePageIs('/admin/news')
            ->assertResponseStatus(200);
    }

}
