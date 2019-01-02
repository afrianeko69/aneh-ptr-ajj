<?php

namespace Tests\Unit;

use Tests\TestCase;
use App;
use App\Category;

class CategoryTest extends TestCase
{
    private $category;
    public function setUp()
    {
        parent::setUp();
        $this->category = factory(App\Category::class)->create();
    }

    public function testIndex()
    {
        $this->visit('/kategori')
            ->see('kategori program')
            ->assertResponseStatus(200);
    }
}
