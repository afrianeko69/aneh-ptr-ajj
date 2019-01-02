<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CategoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeeCategoryInMenu()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Categories')
            ->click('Categories')
            ->seePageIs('/admin/categories')
            ->assertResponseStatus(200);
    }
}
