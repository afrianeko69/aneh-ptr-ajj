<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LearningMethodTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testLearningMethodPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Learning Method')
            ->click('Learning Method')
            ->seePageIs('/admin/learning-methods')
            ->assertResponseStatus(200);
    }
}
