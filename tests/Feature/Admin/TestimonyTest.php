<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;

class TestimonyTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function testAccessTestimonyMenu() {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Testimonial')
            ->click('Testimonial')
            ->assertResponseStatus(200)
            ->seePageIs('/admin/testimonies');
    }
}
