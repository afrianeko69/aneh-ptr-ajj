<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeePostPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Posts')
            ->click('Posts')
            ->seePageIs('/admin/posts')
            ->assertResponseStatus(200);
    }

    public function testSeeCreatePostPage() {
        $this->actingAs($this->user)
            ->visit('/admin/posts/create')
            ->see('New Post')
            ->see('Post Details')
            ->see('Post Content')
            ->see('Post Image')
            ->see('SEO Content')
            ->assertResponseStatus(200);
    }
}
