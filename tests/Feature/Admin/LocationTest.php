<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LocationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeeLocationMenu()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Locations')
            ->click('Locations')
            ->seePageIs('/admin/locations')
            ->assertResponseStatus(200);
    }
}
