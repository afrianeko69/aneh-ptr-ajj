<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App;

class LandingPageTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeeLandingPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Landing Page')
            ->click('Landing Page')
            ->seePageIs('/admin/landing-pages')
            ->assertResponseStatus(200);
    }

    public function testSeeLandingPageCreatePage()
    {
        $this->actingAs($this->user)
            ->visit('/admin/landing-pages')
            ->see('Add New')
            ->click('Add New')
            ->seePageIs('/admin/landing-pages/create')
            ->see('New Landing Page')
            ->assertResponseStatus(200);
    }

    public function testVisitLandingPagePreviewPage()
    {
        $lp = factory(App\LandingPage::class)->create();

        $this->actingAs($this->user)
            ->visit('/admin/landing-pages')
            ->see($lp->slug)
            ->see('Preview')
            ->click('Preview')
            ->assertResponseOk()
            ->see($lp->main_title)
            ->seePageIs('/admin/landing-pages/' . $lp->slug . '/preview');
    }
}

