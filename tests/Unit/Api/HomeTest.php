<?php

namespace Tests\Unit\Api;

use App;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testProductSearchJson() {
        $product = factory(App\Product::class)->create();
        $keyword = explode(' ', $product->name);
        $response = $this->call('get', route('api.suggestion'), [
            'keyword' => $keyword[0]
        ]);
        $this->assertEquals(200, $response->status());
    }

}
