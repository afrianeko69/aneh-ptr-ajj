<?php

namespace Tests\Unit\Api;

use App;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RatingReviewTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function testNoProductSlug()
    {
        $response = $this->call('get', route('api.more.review'));

        $body_response = json_decode((string) $response->getContent(), true);

        $this->assertEquals(400, $body_response['status']);
        $this->assertEquals('Maaf, kami kesulitan memproses data anda.', $body_response['message']);
        $this->seeJsonStructure([
            'status', 'message',
            'data' => [
                'total', 'total_pagination', 'per_page', 'current_page',
                'reviews'
            ]
        ], $body_response);
    }

    public function testWithInvalidProductSlug() {
        $response = $this->call('get', route('api.more.review'), [
            'slug' => 'abc'
        ]);

        $body_response = json_decode((string) $response->getContent(), true);

        $this->assertEquals(400, $body_response['status']);
        $this->assertEquals('Maaf, kami kesulitan memproses data anda.', $body_response['message']);
        $this->seeJsonStructure([
            'status', 'message',
            'data' => [
                'total', 'total_pagination', 'per_page', 'current_page',
                'reviews'
            ]
        ], $body_response);
    }

    public function testWithValidProductSlugButNoReviews() {
        $product = factory(App\Product::class)->create();

        $response = $this->call('get', route('api.more.review'), [
            'slug' => $product->slug
        ]);

        $body_response = json_decode((string) $response->getContent(), true);

        $this->assertEquals(200, $body_response['status']);
        $this->assertEquals('success', $body_response['message']);

        $data = $body_response['data'];
        $this->assertEquals(5, $data['per_page']);
        $this->assertEquals(1, $data['current_page']);
        $this->assertEquals(0, $data['total']);
        $this->assertEquals(0, $data['total_pagination']);
        $this->assertEquals([], $data['reviews']);

        $this->seeJsonStructure([
            'status', 'message',
            'data' => [
                'total', 'total_pagination', 'per_page', 'current_page',
                'reviews'
            ]
        ], $body_response);
    }

    public function testWithValidProductSlugWithReviews() {
        $product = factory(App\Product::class)->create();

        $approved_review = factory(App\RatingReview::class, 10)->create([
            'product_id' => $product->id,
            'status' => App\RatingReview::STATUS_APPROVED,
        ]);

        $pending_review = factory(App\RatingReview::class, 3)->create([
            'product_id' => $product->id,
            'status' => App\RatingReview::STATUS_PENDING,
        ]);

        $response = $this->call('get', route('api.more.review'), [
            'slug' => $product->slug
        ]);

        $take = 5;
        $body_response = json_decode((string) $response->getContent(), true);
        $data = $body_response['data'];

        $this->assertEquals(200, $body_response['status']);
        $this->assertEquals('success', $body_response['message']);
        $this->assertEquals($take, $data['per_page']);
        $this->assertEquals(1, $data['current_page']);
        $this->assertEquals(count($approved_review), $data['total']);
        $this->assertEquals((int) ceil(count($approved_review) / $take), $data['total_pagination']);

        $this->seeJsonStructure([
            'status', 'message',
            'data' => [
                'total', 'total_pagination', 'per_page', 'current_page',
                'reviews'
            ]
        ], $body_response);
    }
}
