<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App;

class ProfessionTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function testSeeProfessionMenu()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Professions')
            ->click('Professions')
            ->seePageIs('/admin/professions')
            ->assertResponseStatus(200);
    }

    public function testSeeProfessionFields()
    {
        $this->actingAs($this->user)
            ->visit('/admin/professions/create')
            ->see('Profession')
            ->see('Sort')
            ->see('Profession Icon')
            ->see('Banner Image')
            ->see('Description')
            ->see('Image')
            ->see('Jooble')
            ->see('Excerpt')
            ->see('YouTube Video ID')
            ->see('Gaji')
            ->see('Tugas')
            ->see('Pengetahuan')
            ->see('Keterampilan dan Kemampuan')
            ->see('Is Content Ready (Content not ready will cause the profession can not be accessed)')
            ->see('Content Ready')
            ->see('Not Ready')
            ->assertResponseStatus(200);
    }
}
