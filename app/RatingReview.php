<?php

namespace App;

use App\Product;
use App\Services\Lms;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;

class RatingReview extends Model
{
    CONST STATUS_APPROVED = 'Approved';
    CONST STATUS_REJECTED = 'Rejected';
    CONST STATUS_PENDING = 'Pending';
    // Temporarily changed from 50 to 0 cause need to change data from LMS
    CONST MINIMUM_COURSE_COMPLETION_TO_RATE = 0;

    CONST STATUS_CANNOT_REVIEW = [self::STATUS_APPROVED, self::STATUS_PENDING];

    public function productId() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $fillable = [
        'reviewer_name',
        'reviewer_email',
        'product_id',
        'review',
        'rating',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function scopeUserCannotReview($query, $product_id, $email) {
        return $query->where('product_id', $product_id)
                    ->where('reviewer_email', $email)
                    ->whereIn('status', self::STATUS_CANNOT_REVIEW);
    }

    public static function getRatingReviewSummary($product_id) {
        return DB::table('rating_reviews')
                ->where('status', self::STATUS_APPROVED)
                ->{(is_array($product_id) ? 'whereIn' : 'where')}('product_id', $product_id)
                ->select([
                    DB::raw('
                        COUNT(id) AS total_reviewer,
                        COALESCE(ROUND(AVG(rating), 1), 0) AS avg_rating,
                        COALESCE(SUM(rating), 0) as total_rating'),
                ])
                ->first();
    }

    public static function transformReviewerData(&$reviews) {
        foreach($reviews as $review) {
            $review->rating = (int) $review->rating;
            $convert_date_timezone = Carbon::parse($review->review_rating_at)->timezone('Asia/Jakarta');
            $review->human_review_rating_at = convertDateFormat($convert_date_timezone, 'd F Y, H:i T');

            $review->full_profile_picture_url = '';
            if($review->profile_picture) {
                $review->full_profile_picture_url = route('asset', [$review->profile_picture]);
            }

            $review->reviewer_initial = 'NN';
            $words = explode(' ', trim(ucwords($review->reviewer_name)));
            $words_count = count($words);
            if($words_count == 1) {
                $review->reviewer_initial = $words[0][0] . $words[0][0];
            } elseif ($words_count > 1) {
                $review->reviewer_initial = $words[0][0] . $words[$words_count - 1][0];
            }
        }
    }

    public static function getGroupedRatingSummary($product_id) {
        return DB::table('rating_reviews')
                ->where('status', self::STATUS_APPROVED)
                ->{(is_array($product_id) ? 'whereIn' : 'where')}('product_id', $product_id)
                ->select([
                    DB::raw('
                        COUNT(id) AS rating_count,
                        CAST(rating AS UNSIGNED) AS rating
                    '),
                ])
                ->groupBy('rating')
                ->get();
    }

    public static function getRatingReviewData($product_id, $take = 5, $page = 1) {
        $skip = ($page - 1) * $take;
        $reviews = DB::table('rating_reviews AS rr')
                    ->leftJoin('users AS u', function($query) {
                        $query->on('u.email', '=', 'rr.reviewer_email');
                    })
                    ->where('rr.status', self::STATUS_APPROVED)
                    ->{(is_array($product_id) ? 'whereIn' : 'where')}('rr.product_id', $product_id)
                    ->select([
                        'rr.rating', 'rr.review', 'rr.reviewer_name',
                        'u.profile_picture', 'rr.created_at as review_rating_at'
                    ])
                    ->orderBy('rr.id', 'desc')
                    ->take($take)
                    ->skip($skip)
                    ->get();

        self::transformReviewerData($reviews);
        return $reviews;
    }

    public static function getMoreReview($data) {
        $response = [
            'status' => 400,
            'message' => 'Maaf, kami kesulitan memproses data anda.',
            'data' => [
                'total' => 0,
                'total_pagination' => 0,
                'per_page' => 5,
                'current_page' => 1,
                'reviews' => []
            ]
        ];

        $page = isset($data['page']) && (is_numeric($data['page'])) ? (int) $data['page'] : 1;
        $take = isset($data['take']) && (is_numeric($data['take'])) ? (int) $data['take'] : 5;
        $product_slug = isset($data['slug']) ? $data['slug'] : null;

        if(!$product_slug) {
            return $response;
        }

        try {
            $product_id = DB::table('products')
                        ->whereSlug($product_slug)
                        ->first(['id'])
                        ->id;
        } catch (Exception $e) {
            return $response;
        }

        $response['data']['per_page'] = $take;
        $response['data']['current_page'] = $page;

        $related_ids = array_merge([$product_id], Product::getRelatedProductIds($product_id));
        $rating_summary = self::getRatingReviewSummary($related_ids);
        $response['data']['total'] = $rating_summary->total_reviewer;
        $response['data']['total_pagination'] = (int) ceil($rating_summary->total_reviewer / $take);
        $response['data']['reviews'] = self::getRatingReviewData($related_ids, $take, $page);
        $response['status'] = 200;
        $response['message'] = 'success';
        return $response;
    }
}
