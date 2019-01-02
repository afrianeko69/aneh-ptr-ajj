<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class InstructorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeeInstructureMenu()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Instructors')
            ->click('Instructors')
            ->seePageIs('/admin/instructors');
    }
}
