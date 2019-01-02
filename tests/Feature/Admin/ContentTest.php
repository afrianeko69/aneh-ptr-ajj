<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ContentTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeeContentInAsAdminMenu()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Content')
            ->click('Content')
            ->seePageIs('/admin/contents')
            ->see('Add New')
            ->assertResponseStatus(200);
    }

    public function testSeeContentInAsUserMenu()
    {
        $this->actingAs($this->normal_user)
            ->visit('/admin')
            ->see('Content')
            ->click('Content')
            ->seePageIs('/admin/contents')
            ->dontSee('Add New')
            ->assertResponseStatus(200);
    }
}
