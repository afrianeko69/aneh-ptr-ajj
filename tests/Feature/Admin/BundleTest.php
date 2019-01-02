<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BundleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testSeeBundleAdminPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Bundle')
            ->click('Bundle')
            ->seePageIs('/admin/bundles')
            ->assertResponseStatus(200);
    }

    public function testSeeCreateBundleAdminPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin/bundles')
            ->see('Add New')
            ->click('Add New')
            ->seePageIs('/admin/bundles/create')
            ->see('Select Product')
            ->see('Sort')
            ->see('Remove')
            ->assertResponseStatus(200);
    }
}
