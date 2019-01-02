<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostTagTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeePostTagPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Post Tags')
            ->click('Post Tags')
            ->seePageIs('/admin/post-tags')
            ->assertResponseStatus(200);
    }
}
