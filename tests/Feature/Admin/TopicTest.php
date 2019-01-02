<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TopicTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeeTopicInAdminPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Topic')
            ->click('Topic')
            ->seePageIs('/admin/topics')
            ->assertResponseStatus(200);
    }
}
