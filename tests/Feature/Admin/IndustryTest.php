<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IndustryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testSeeIndustryAdminPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Industry')
            ->click('Industry')
            ->seePageIs('/admin/industries')
            ->assertResponseStatus(200);
    }
}
