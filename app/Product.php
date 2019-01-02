<?php

namespace App;

use App\Banner;
use App\ClassAttendee;
use App\Industry;
use App\Instructor;
use App\LearningMethod;
use App\Location;
use App\Profession;
use App\Provider;
use App\RatingReview;
use App\Services\Lms;
use App\Topic;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use TCG\Voyager\Models\Category;

class Product extends Model
{
    use Searchable;

    CONST CATEGORY_KULIAH_NAME = 'kuliah';
    CONST CATEGORY_KURSUS = 'kursus';
    CONST CATEGORY_SERTIFIKASI = 'sertifikasi';
    CONST FREE_PRODUCT = 'Gratis!';
    CONST PEOPLE_TEXT = ' Orang';
    CONST CATEGORY = 'kategori';
    CONST NAME = 'nama';
    CONST DISCOUNT = 'diskon';
    CONST CATEGORY_PROGRAM = 'kategori_program';
    CONST INDUSTRY_PROGRAM = 'industri_program';
    CONST KEYWORD = 'keyword';
    CONST OFFLINE_COURSE = 'Tatap Muka';

    protected $fillable = [
        'slug',
        'name',
        'description',
        'created_at',
        'updated_at',
        'price',
        'discount_percentage',
        'discount_start_at',
        'discount_end_at',
        'seo',
        'learning_method_id',
        'location_id',
        'location_detail',
        'map',
        'quota',
        'image',
        'youtube_video_id',
        'show_start_at',
        'show_end_at',
        'course_start_at',
        'course_end_at',
        'is_open_enrollment',
        'is_content_ready',
        'jobs',
        'career',
        'seo_title',
        'meta_description',
        'sort',
        'category_classification_id',
        'banner',
        'crm_interest_name',
        'is_learning_material_showed',
        'is_tryout',
        'instruction',
        'module_number',
        'is_review_shown',
        'selected_bundle_id',
        'is_lead_form_active'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'discount_start_at',
        'discount_end_at',
        'show_start_at',
        'show_end_at',
        'course_start_at',
        'course_end_at',
    ];

    /**
     * The columns of the full text index
     */
    protected $searchable = [
        'name',
        'description'
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function learningMethodId()
    {
    	return $this->belongsTo(LearningMethod::class, 'learning_method_id');
    }

    public function locationId()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function industries()
    {
        return $this->belongsToMany(Industry::class)->withTimestamps();
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class)
                ->withPivot('sort')
                ->withTimestamps();
    }

    public function firstProvider()
    {
        return $this->providers()
            ->orderByRaw('sort is null, sort ASC')
            ->first();
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class)
                ->withPivot('sort', 'is_showed')
                ->withTimestamps();
    }

    public function affiliates()
    {
        return $this->belongsToMany(Affiliate::class)->withTimestamps();
    }

    public function bundles()
    {
        return $this->belongsToMany('App\Bundle', 'bundle_product')->withTimestamps();
    }

    public function professions() {
        return $this->belongsToMany('App\Profession')->withTimestamps();
    }

    public function categoryClassificationId() {
        return $this->belongsTo(CategoryClassification::class, 'category_classification_id');
    }

    public function tryouts() {
        return $this->hasMany('App\ProductTryout');
    }

    public function user_participant_discounts() {
        return $this->hasMany('App\UserParticipantDiscount');
    }

    public function getReviewUrlAttribute() {
        return route('user.product.review', $this->slug);
    }

    public function getFullImageUrlAttribute() {
        return image_full_path($this->image);
    }

    public function isOfflineCourse() {
        return isset($this->learningMethodId)
            ? $this->learningMethodId->name == self::OFFLINE_COURSE
            : false;
    }

    public function scopeReady($query) {
        return $query->where('is_content_ready', 1);
    }

    public function scopeActiveReview($query) {
        return $query->where('is_review_shown', 1);
    }

    public function related_review_products() {
        return $this->belongsToMany('App\Product', 'related_products', 'product_id', 'related_product_id')
            ->withTimestamps();
    }

    public static function getAllProduct($productIds = [], $categorized = true, $get = [], $paginate = true)
    {
        $product_categories = [
            self::CATEGORY_KULIAH_NAME => [],
            self::CATEGORY_KURSUS => []
        ];
        $products = '';
        try {
            $products = DB::table('products as p')
                            ->leftJoin('category_classifications as c', function ($query) {
                                $query->on('c.id', '=', 'p.category_classification_id');
                            })
                            ->leftJoin('locations as l', function ($query) {
                                $query->on('l.id', '=', 'p.location_id');
                            })
                            ->leftJoin('learning_methods as lm', function ($query) {
                                $query->on('lm.id', '=', 'p.learning_method_id');
                            })
                            ->leftJoin('industry_product as i', function ($query) {
                                $query->on('i.product_id', '=', 'p.id');
                            })
                            ->leftJoin('industries as in', function ($query) {
                                $query->on('in.id', '=', 'i.industry_id');
                            })
                            ->leftJoin('product_topic as pt', function ($query) {
                                $query->on('pt.product_id', '=', 'p.id');
                            })
                            ->leftJoin('topics as t', function ($query) {
                                $query->on('t.id', '=', 'pt.topic_id');
                            })
                            ->leftJoin('product_provider as pp', function ($query) {
                                $query->on('pp.product_id', '=', 'p.id');
                            })
                            ->leftJoin('providers as pr', function ($query) {
                                $query->on('pr.id', '=', 'pp.provider_id');
                            })
                            ->leftJoin('instructor_product as ip', function ($query) {
                                $query->on('ip.product_id', '=', 'p.id');
                            })
                            ->leftJoin('instructors as is', function ($query) {
                                $query->on('is.id', '=', 'ip.instructor_id');
                            })
                            ->leftJoin('category_product', function ($query) {
                                $query->on('category_product.product_id', '=', 'p.id');
                            })
                            ->leftJoin('categories', function ($query) {
                                $query->on('categories.id', '=', 'category_product.category_id');
                            })
                            ->leftJoin('bundles as b', function($query) {
                                $query->on('b.id', '=', 'p.selected_bundle_id');
                            })
                            ->select([
                                'p.id','p.slug', 'p.name', 'p.description', 'p.price', 'p.discount_percentage', 'p.image',
                                'p.discount_start_at', 'p.discount_end_at', 'c.name as category_name',
                                'p.is_open_enrollment' , 'p.seo', 'p.jobs', 'p.career', 'in.name as industry_name', 'p.sort', 'p.excerpt', 
                                DB::raw('CASE WHEN p.discount_percentage IS NULL THEN p.price ELSE p.price - (p.discount_percentage * p.price) / 100 END AS calculated_price'),
                                'p.crm_interest_name', 'p.direct_link_url', 'p.selected_bundle_id',
                            ])
                            ->where('p.is_content_ready', true);

            if (!empty($get[self::CATEGORY_PROGRAM])){
                $products = $products->where('categories.name',$get[self::CATEGORY_PROGRAM]);
            }
            if (!empty($get[self::INDUSTRY_PROGRAM])){
                $products = $products->where('in.name',$get[self::INDUSTRY_PROGRAM]);
            }
            if (!empty($productIds)){
                $products = $products->whereIn('p.id', $productIds);
            }
            if (!empty($get[self::CATEGORY])) {
                $products = $products->where('c.name', $get[self::CATEGORY]);
            }
            if (!empty($get[self::DISCOUNT])) {
                $now = date('Y-m-d H:i:s');
                $products = $products->where('p.discount_percentage', '<>', '');
                $products = $products->where('p.discount_start_at', '<=', $now);
                $products = $products->where('p.discount_end_at', '>=', $now);

            }
            if (!empty($get['min'])) {
                $products = $products->having('calculated_price', '>=', $get['min']);
            }
            if (!empty($get['max'])) {
                $products = $products->having('calculated_price', '<=', $get['max']);
            }
            if (!empty($get[self::NAME])) {
                $products = $products->where('p.name','like','%'. $get[self::NAME] .'%');
            }

            if (!empty($get[self::KEYWORD])) {
                $products->where(function ($q) use ($get) {
                    $q->where('c.name', 'LIKE', '%' . $get[self::KEYWORD] . '%')
                        ->orWhere('p.seo', 'LIKE', '%' . $get[self::KEYWORD] . '%')
                        ->orWhere('p.description', 'LIKE', '%' . $get[self::KEYWORD] . '%')
                        ->orWhere('l.name', 'LIKE', '%' . $get[self::KEYWORD] . '%')
                        ->orWhere('p.jobs', 'LIKE', '%' . $get[self::KEYWORD] . '%')
                        ->orWhere('p.career', 'LIKE', '%' . $get[self::KEYWORD] . '%')
                        ->orWhere('in.name', 'LIKE', '%' . $get[self::KEYWORD] . '%')
                        ->orWhere('lm.name', 'LIKE', '%' . $get[self::KEYWORD] . '%')
                        ->orWhere('t.name', 'LIKE', '%' . $get[self::KEYWORD] . '%')
                        ->orWhere('pr.name', 'LIKE', '%' . $get[self::KEYWORD] . '%')
                        ->orWhere('is.name', 'LIKE', '%' . $get[self::KEYWORD] . '%');
                });
            }

            if (!empty($get['limit'])) {
                $products = $products->limit($get['limit']);
            }
            if ( !empty($get['order']) && !empty($get['order_by']) ) {
                if (!empty($get['order']) && ($get['order_by'] == 'p.sort') ) {
                    $products = $products->whereNotNull('p.sort');
                    $products = $products->where('p.sort', '!=', '0');
                }
                $products = $products->orderBy($get['order_by'], $get['order']);
            }

            $products = $products->groupBy('p.id');
            if (!$categorized){
                if ($paginate) {
                    $products = $products->simplePaginate(6)->appends($get);
                } else {
                    $products = $products->get();
                }
            } else {
                $products = $products->get();
            }
            foreach($products as $key => $product) {
                $field_key = (strtolower($product->category_name) === self::CATEGORY_KULIAH_NAME) ? self::CATEGORY_KULIAH_NAME : self::CATEGORY_KURSUS;
                self::modifyProduct($product);

                $product_categories[$field_key][$key] = $product;

                // append new categories
                $categories = DB::table('categories as c')
                            ->join('category_product as cp', function($query) {
                                $query->on('cp.category_id', '=', 'c.id');
                            })
                            ->where('cp.product_id', $product->id)
                            ->select(['c.name'])
                            ->get();
                $product->category_lists = [];
                foreach($categories as $category) {
                    $product->category_lists[] = $category->name;
                }

                $product->category_lists = implode(', ', $product->category_lists);
            }
            $product_categories[self::CATEGORY_KULIAH_NAME] = array_slice(array_values($product_categories[self::CATEGORY_KULIAH_NAME]), 0, 5);
            $product_categories[self::CATEGORY_KURSUS] = array_slice(array_values($product_categories[self::CATEGORY_KURSUS]), 0, 5);

        } catch (Exception $e) {
        }

        return ($categorized) ? $product_categories : $products;
    }

    public static function getProductListMoreInfo($product_ids = [])
    {
        $product_categories = [
            self::CATEGORY_KULIAH_NAME => [],
            self::CATEGORY_KURSUS => []
        ];

        try {
            $products = DB::table('products as p')
                ->leftJoin('category_classifications as c', function ($query) {
                    $query->on('c.id', '=', 'p.category_classification_id');
                })
                ->select('p.crm_interest_name', 'c.name as category_name', 'is_open_enrollment')
                ->where('p.is_content_ready', true)
                ->where('p.is_lead_form_active', true)
                ->orderBy('c.name', 'ASC')
                ->orderBy('p.crm_interest_name', 'ASC');

            if (!empty($product_ids)) {
                $products = $products->whereIn('p.id', $product_ids);
            }

            $products = $products->distinct()->get();

            foreach($products as $key => $product) {
                $field_key = (strtolower($product->category_name) === self::CATEGORY_KULIAH_NAME) ? self::CATEGORY_KULIAH_NAME : self::CATEGORY_KURSUS;
                $product_categories[$field_key][$key] = $product;
            }

            $product_categories[self::CATEGORY_KULIAH_NAME] = array_values($product_categories[self::CATEGORY_KULIAH_NAME]);
            $product_categories[self::CATEGORY_KURSUS] = array_values($product_categories[self::CATEGORY_KURSUS]);
        } catch (Exception $e) {
        }

        return $product_categories;
    }

    public static function productDiscount(&$product)
    {
        $product->is_discount = false;
        if ($product->price != 0 && $product->discount_percentage && $product->discount_start_at && $product->discount_end_at) {
            $now = date('Y-m-d H:i:s');
            if ($product->discount_start_at <= $now && $product->discount_end_at >= $now) {
                $product->is_discount = true;
                $product->nominal_discount = calculateNominalDiscount($product->price, $product->discount_percentage);
                $product->formatted_nominal_discount = '- ' . rupiah_number_format($product->nominal_discount);
                $product->price_after_discount = calculateDiscount($product->price, $product->discount_percentage);
                $product->formatted_price_after_discount = rupiah_number_format($product->price_after_discount);
            }
        }
    }

    public static function productDiscountMultipleParticipants(&$product, $quantity, $is_same_company)
    {
        if ($product->has('user_participant_discounts')) {
            $now = date('Y-m-d H:i:s');
            foreach ($product->user_participant_discounts()->get() as $discount) {
                if (
                    $discount->participant_number == $quantity && 
                    $discount->start_at && $discount->start_at <= $now &&
                    $discount->end_at && $discount->end_at >= $now &&
                    $discount->discounted_price
                ) {
                    if ($discount->is_same_provider && !$is_same_company) {
                        return;
                    }
                    $product->is_discount = true;
                    $product->nominal_discount = $discount->discounted_price - ($quantity * $product->price);
                    $product->formatted_nominal_discount = '- ' . rupiah_number_format(abs($product->nominal_discount));
                    $product->price_after_discount = $discount->discounted_price;
                    $product->formatted_price_after_discount = rupiah_number_format($product->price_after_discount);
                    $product->has_multiple_participant_discount = true;
                }
            }
        }
    }

    private static function productPrice(&$product, $category_key = 'category_name')
    {
        $product->formatted_price = ($product->price && $product->price != 0) ? rupiah_number_format($product->price) :
                                    ( (($product->price == 0) && strtolower($product->{$category_key}) != self::CATEGORY_KULIAH_NAME ) ? self::FREE_PRODUCT : '');
    }

    public static function productSlugURL(&$product, $key = 'slug')
    {
        $product->route_url = route('product.index', [$product->{$key}]);
    }

    private static function reviewURL(&$product, $key = 'slug') {
        $product->review_url = route('user.product.review', $product->{$key});
    }

    private static function productPurchase(&$product)
    {
        $product->route_purchase_url = route('product.konfirmasi.beli', [$product->slug]);
    }

    public static function productImage(&$product)
    {
        $product->image_full_url = image_full_path($product->image);
    }

    public static function productBannerImage(&$product) {
        $product->banner_full_url = asset_cdn('pintaria/background/image-header-class.jpg');
        if(!empty($product->banner)) {
            $product->banner_full_url = asset_cdn($product->banner);
        }
    }

    private static function youtubeURL(&$product)
    {
        $product->youtube_url = youtube_url_generator($product->youtube_video_id);
    }

    private static function quotaText(&$product)
    {
        $product->quota_text = $product->quota . self::PEOPLE_TEXT;
    }

    private static function modifyProduct(&$product)
    {
        self::productPrice($product);
        self::productSlugURL($product);
        self::productDiscount($product);
        self::productImage($product);
        self::productPurchase($product);
    }

    private static function setProductType(&$product)
    {
        $type = 'paid';
        if($product->price == 0) {
            $type = 'free';
        } else {
            if($product->is_discount) {
                if($product->price_after_discount == 0) {
                    $is_free_product = 'free';
                }
            }
        }
        $product->type = $type;
    }

    private static function ratingReview($product_id) {
        $take = 5;
        $rating_reviews = [
            'total_reviewer' => 0,
            'total_rating' => 0,
            'avg_rating' => 0,
            'review' => [
                'total_pagination' => 0,
                'per_page' => $take,
                'current_page' => 1,
                'reviews' => [],
            ],
            'ratings' => [
                1 => [
                    'count' => 0,
                    'avg' => 0,
                ],
                2 => [
                    'count' => 0,
                    'avg' => 0,
                ],
                3 => [
                    'count' => 0,
                    'avg' => 0,
                ],
                4 => [
                    'count' => 0,
                    'avg' => 0,
                ],
                5 => [
                    'count' => 0,
                    'avg' => 0,
                ]
            ]
        ];

        $related_ids = array_merge([$product_id], self::getRelatedProductIds($product_id));
        $summary_rating_review = RatingReview::getRatingReviewSummary($related_ids);
        $rating_reviews['total_reviewer'] = $summary_rating_review->total_reviewer;
        $rating_reviews['avg_rating'] = $summary_rating_review->avg_rating;
        $rating_reviews['total_rating'] = $summary_rating_review->total_rating;
        $rating_reviews['review']['reviews'] = RatingReview::getRatingReviewData($related_ids);
        $rating_reviews['review']['total_pagination'] = (int) ceil($summary_rating_review->total_reviewer / $take);

        $grouped_rating = RatingReview::getGroupedRatingSummary($related_ids);
        foreach($grouped_rating as $rate) {
            $rating_reviews['ratings'][$rate->rating]['count'] = $rate->rating_count;
            try {
                $avg = round(($rate->rating_count / $rating_reviews['total_reviewer']) * 100);
                $rating_reviews['ratings'][$rate->rating]['avg'] = $avg;
            } catch (Exception $e) {
                continue;
            }
        }

        return $rating_reviews;
    }

    public static function getProductBySlug($slug)
    {
        try {
            $product = DB::table('products as p')
                        ->leftjoin('category_classifications as c', function ($query) {
                                $query->on('c.id', '=', 'p.category_classification_id');
                        })
                        ->leftJoin('learning_methods as lm', function ($query) {
                            $query->on('lm.id', '=', 'p.learning_method_id');
                        })
                        ->leftJoin('locations as l', function ($query) {
                            $query->on('l.id', '=', 'p.location_id');
                        })
                        ->leftJoin('bundles as b', function($query) {
                            $query->on('b.id', '=', 'p.selected_bundle_id');
                        })
                        ->where('p.slug', $slug)
                        ->where('p.is_content_ready', true)
                        ->select([
                            'p.id', 'p.name as product_name', 'p.slug',  'p.description', 'p.price', 'p.discount_percentage',
                            'p.discount_start_at', 'p.discount_end_at', 'p.seo', 'p.location_detail', 'p.map',
                            'p.quota', 'p.image', 'p.youtube_video_id', 'p.is_open_enrollment',
                            'p.show_start_at', 'p.show_end_at', 'p.course_start_at', 'p.course_end_at', 'p.jobs', 'p.career',
                            'c.name as category_classification_name', 'lm.name as learning_method_name', 'l.name as location_name',
                            'p.seo_title', 'p.meta_description', 'p.banner', 'p.crm_interest_name', 'p.is_learning_material_showed',
                            'p.is_tryout', 'p.is_review_shown', 'p.selected_bundle_id',
                            'p.direct_link_url', 'b.name as bundle_name', 'b.price as bundle_price', 'p.is_lead_form_active', 'p.learning_method_id'
                        ])
                        ->first();

            if(!$product) {
                return null;
            }

            self::productPrice($product, 'category_classification_name');
            self::productDiscount($product);
            self::productImage($product);
            self::youtubeURL($product);
            self::quotaText($product);
            self::setProductType($product);
            self::productPurchase($product);
            self::productBannerImage($product);

            if ($product->is_review_shown) {
                $product->rating_review = self::ratingReview($product->id);
            }

            $product->tryout_url = route('tryout.instruction', [$product->slug]);

            $product->industries = DB::table('industries as i')
                                ->join('industry_product as ip', function ($query) {
                                    $query->on('ip.industry_id', '=', 'i.id');
                                })
                                ->where('ip.product_id', $product->id)
                                ->select(['i.name'])
                                ->get();

            $product->topics = DB::table('topics as t')
                                ->join('product_topic as pt', function ($query) {
                                    $query->on('pt.topic_id', '=', 't.id');
                                })
                                ->where('pt.product_id', $product->id)
                                ->select(['t.name'])
                                ->get();

            $product->topic_list = [];
            foreach($product->topics as $topic) {
                $product->topic_list[] = $topic->name;
            }

            $product->topic_list = implode(', ', $product->topic_list);

            $product->providers = DB::table('providers as p')
                                ->join('product_provider as pp', function ($query) {
                                    $query->on('pp.provider_id', '=', 'p.id');
                                })
                                ->where('pp.product_id', $product->id)
                                ->select([
                                    'p.name', 'p.description', 'p.logo', 'p.tagline'
                                ])
                                ->get();

            $product->provider_list = [];
            foreach($product->providers as $provider) {
                Provider::logoFullURL($provider);
                $product->provider_list[] = $provider->name;
            }

            $product->provider_list = implode(', ', $product->provider_list);

            $product->instructors = DB::table('instructors as i')
                                    ->join('instructor_product as ip', function ($query) {
                                        $query->on('ip.instructor_id', '=', 'i.id');
                                    })
                                    ->where('ip.product_id', $product->id)
                                    ->select([
                                        'i.name', 'i.title', 'i.description', 'i.profile_picture'
                                    ])
                                    ->get();

            $categories = DB::table('categories as c')
                            ->join('category_product as cp', function($query) {
                                $query->on('cp.category_id', '=', 'c.id');
                            })
                            ->where('cp.product_id', $product->id)
                            ->select(['c.name'])
                            ->get();

            $product->category_lists = [];
            foreach($categories as $category) {
                $product->category_lists[] = $category->name;
            }

            $product->category_lists = implode(', ', $product->category_lists);

            foreach($product->instructors as $instructor) {
                Instructor::profilePictureFullURL($instructor);
            }

            return $product;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function userCourses($user, $filter = []) {
        $courses = DB::table('class_attendees AS ca')
                    ->leftJoin('products AS p', function($query) {
                        $query->on('p.slug', '=', 'ca.slug');
                    })
                    ->leftJoin('learning_methods as lm', function ($query) {
                        $query->on('lm.id', '=', 'p.learning_method_id');
                    })
                    ->where('ca.user_id', $user->id)
                    ->select([
                        'ca.lms_klass_id AS klass_id', 'ca.lms_course_name AS course_name',
                        'ca.slug', 'ca.lms_custom_url as custom_url_lms', 'ca.certificate_published_at',
                        'p.is_tryout', 'p.id AS product_id', 'p.image', 'ca.attendance_completion_percentage',
                        'p.is_review_shown', 'p.learning_method_id', 'lm.name as learning_method'
                    ]);

        if($filter && !empty($filter[self::CATEGORY])) {
            $courses = $courses->join('category_product as cp', function($query) {
                            $query->on('cp.product_id', '=', 'p.id');
                        })
                        ->join('categories as c', function($query) {
                            $query->on('c.id', '=', 'cp.category_id');
                        })
                        ->where('c.name', $filter[self::CATEGORY]);
        }
        $courses = $courses->groupBy('p.id')->get();

        if($courses->isEmpty()) {
            return [];
        }

        $product_ids = $courses->pluck('product_id');
        $providers = DB::table('providers AS p')
                    ->leftJoin('product_provider AS pp', function($query) {
                        $query->on('p.id', '=', 'pp.provider_id');
                    })
                    ->whereIn('pp.product_id', $product_ids)
                    ->select(['p.name', 'pp.product_id'])
                    ->get();

        $provider_list = [];
        foreach($providers as $provider) {
            if(!isset($provider_list[$provider->product_id])) {
                $provider_list[$provider->product_id] = [];
            }
            array_push($provider_list[$provider->product_id], $provider->name);
        }

        foreach($courses as $course) {
            $slug = $course->slug;
            $course->is_certificate_available = false;
            $course->certificate_url = route('certificate.stream', [$slug]);
            $course->review_url = route('user.product.review', [$slug]);
            $course->tryout_url = route('tryout.instruction', [$slug]);
            $course->full_course_thumbnail_url = ($course->image ? asset_cdn($course->image) : asset_cdn('pintaria/default-image-thumbnail.jpg'));
            $course->masuk_kelas_url = ($course->custom_url_lms ? $course->custom_url_lms : lmsLearningActivityUrl($course->klass_id));
            $course->masuk_kelas_url = route('masuk.kelas') . '?masuk_kelas=' . $course->masuk_kelas_url;
            $course->route_url = ($course->product_id ? route('product.index', [$slug]) : $course->masuk_kelas_url);

            $course->is_reviewable = false;
            $review = RatingReview::userCannotReview($course->product_id, $user->email)->first(['id']);
            if(
                ($course->product_id) && (!$review) &&
                ($course->attendance_completion_percentage >= RatingReview::MINIMUM_COURSE_COMPLETION_TO_RATE)
            ) {
                $course->is_reviewable = true;
            }

            if($course->certificate_published_at && !$course->is_tryout) {
                $course->is_certificate_available = true;
            }

            if ($course->learning_method == self::OFFLINE_COURSE) {
                $course->attendee_card_url = route('stream.kartu.peserta', ['slug' => $slug]);
            }

            $review = RatingReview::getRatingReviewSummary($course->product_id);
            $course->rating = [
                'total_reviewer' => $review->total_reviewer,
                'avg_rating' => (int) $review->avg_rating,
            ];

            $course->provider_list = null;
            if(isset($provider_list[$course->product_id])) {
                $course->provider_list = implode(',', $provider_list[$course->product_id]);
            }
        }

        return $courses;
    }

    public static function getProductSearch($keyword)
    {
        $products = Product::search($keyword)->where('is_content_ready',true)->get();
        $result = array();
        $i = 0;
        if (!$products->isEmpty()){
            foreach ($products as $product) {
                $result[$i]['name'] = $product->name;
                $result[$i]['url'] = url($product->slug);
                $i++;
            }
        } else {
            $category_classification = \App\CategoryClassification::search($keyword)->first();
            if (!empty($category_classification)) {
                $products = \App\Product::where('is_content_ready',true)->whereHas('categoryClassificationId', function($query) use($keyword) {
                    $query->where('name','like', '%' . $keyword . '%');
                })->get();
                foreach ($products as $product) {
                    $result[$i]['name'] = $product->name;
                    $result[$i]['url'] = url($product->slug);
                    $i++;
                }
            }

            $category = \App\Category::search($keyword)->first();
            if (!empty($category)) {
                $products = \App\Product::where('is_content_ready',true)->whereHas('category', function($query) use($keyword) {
                    $query->where('name','like', '%' . $keyword . '%');
                })->get();
                foreach ($products as $product) {
                    $result[$i]['name'] = $product->name;
                    $result[$i]['url'] = url($product->slug);
                    $i++;
                }
            }

            $industry = \App\Industry::search($keyword)->first();
            if (!empty($industry)) {
                $products = \App\Product::where('is_content_ready',true)->whereHas('industries', function($query) use($keyword) {
                    $query->where('name','like', '%' . $keyword . '%')->orderBy('sort','asc');
                })->get();
                foreach ($products as $product) {
                    $result[$i]['name'] = $product->name;
                    $result[$i]['url'] = url($product->slug);
                    $i++;
                }
            }

            $profession = \App\Profession::search($keyword)->first();
            if (!empty($profession)) {
                $products = \App\Product::where('is_content_ready',true)->whereHas('professions', function($query) use($keyword) {
                    $query->where('name','like', '%' . $keyword . '%')->orderBy('sort','asc');
                })->get();
                foreach ($products as $product) {
                    $result[$i]['name'] = $product->name;
                    $result[$i]['url'] = url($product->slug);
                    $i++;
                }
            }
        }
        return $result;
    }

    public static function getRelatedProductIds($product_id)
    {
        return self::whereId($product_id)
            ->firstOrFail()
            ->related_review_products()
            ->pluck('related_product_id')
            ->toArray();
    }

}
