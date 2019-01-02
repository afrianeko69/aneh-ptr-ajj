<?php

namespace Tests\Unit\Api;

use App;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function testGetPost() {
        $request = $this->call('GET', route('api.blogs'));

        $this->assertEquals(200, $request->status());
        $response = json_decode((string) $request->getContent(), true);

        $this->seeJsonStructure([
            0 => [
                'title', 'excerpt', 'image', 'slug'
            ]
        ], $response);
    }
}
