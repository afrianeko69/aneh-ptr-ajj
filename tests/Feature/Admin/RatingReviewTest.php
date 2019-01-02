<?php

namespace Tests\Feature\Admin;

use App;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\Feature\Admin\TestCase;

class RatingReviewTest extends TestCase
{
    use WithoutMiddleware;
    public function setUp() {
        parent::setUp();
    }
    public function testSeeReviewMenu() {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Review')
            ->assertResponseStatus(200);
    }

    public function testVisitReviewPage() {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Review')
            ->click('Review')
            ->seePageIs('/admin/rating-reviews')
            ->assertResponseStatus(200);
    }

    public function testSeeButtonAcceptAndRejectOnRatingReviewPage() {
        $this->actingAs($this->user)
            ->visit('/admin/rating-reviews')
            ->see('Accept')
            ->see('Reject')
            ->assertResponseStatus(200);
    }

    public function testNotLoggedInAccessBulkApproveRejectOnRatingReview() {
        $request = $this->call('POST', route('admin.rating-review.bulk.update'));
        $this->assertEquals(302, $request->status());
    }

    public function testNotPassedValidationBulkApproveRejectOnRatingReview() {
        $request = $this->actingAs($this->user)->call('POST', route('admin.rating-review.bulk.update'));
        $this->assertEquals(302, $request->status());
    }

    public function testSuccessBulkApproveOnRatingReview() {
        $rating_reviews = factory(App\RatingReview::class, 5)->create([
            'status' => 'Pending'
        ]);

        $rating_review_ids = [];
        foreach($rating_reviews as $review) {
            $rating_review_ids[] = $review->id;
        }

        $request = $this->actingAs($this->user)->call('POST', route('admin.rating-review.bulk.update'), [
            'type' => 'approve',
            'rating_review_id' => $rating_review_ids
        ]);
        $this->assertEquals(200, $request->status());
    }

    public function testSuccessBulkRejectOnRatingReview() {
        $rating_reviews = factory(App\RatingReview::class, 5)->create([
            'status' => 'Pending'
        ]);

        $rating_review_ids = [];
        foreach($rating_reviews as $review) {
            $rating_review_ids[] = $review->id;
        }

        $request = $this->actingAs($this->user)->call('POST', route('admin.rating-review.bulk.update'), [
            'type' => 'reject',
            'rating_review_id' => $rating_review_ids
        ]);
        $this->assertEquals(200, $request->status());
    }

    public function testNotAuthorizedUserToBulkApproveRejectOnRatingReview() {
        $user_2 = factory(App\User::class)->create();

        $rating_reviews = factory(App\RatingReview::class, 5)->create([
            'status' => 'Pending'
        ]);

        $rating_review_ids = [];
        foreach($rating_reviews as $review) {
            $rating_review_ids[] = $review->id;
        }

        $request = $this->actingAs($user_2)->call('POST', route('admin.rating-review.bulk.update'), [
            'type' => 'approve',
            'rating_review_id' => $rating_review_ids
        ]);
        $this->assertEquals(401, $request->status());
    }

    public function testNotValidDataToBulkApproveRejectOnRatingReview() {
        $rating_review_ids = ['a', 'b', 'c'];

        $request = $this->actingAs($this->user)->call('POST', route('admin.rating-review.bulk.update'), [
            'type' => 'approve',
            'rating_review_id' => $rating_review_ids
        ]);
        $this->assertEquals(400, $request->status());
    }
}
