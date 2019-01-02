<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PromotionTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeePromotionMenu()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Promo')
            ->assertResponseStatus(200);
    }

    public function testSeePromotionPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Promo')
            ->click('Promo')
            ->seePageis('/admin/promo')
            ->assertResponseStatus(200);
    }
}
