<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CategoryClassificationTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }
    
    public function testSeeCategoryClassificationMenu()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Categories Classifications')
            ->click('Categories Classifications')
            ->seePageIs('/admin/categories-classification')
            ->assertResponseStatus(200);
    }
}
