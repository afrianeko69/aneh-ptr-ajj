<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'profile_picture' => 'pintaria/users/profile_picture_object.jpeg',
        'home_number' => $faker->randomNumber,
        'phone_number' => $faker->randomNumber,
        'address' => $faker->realText,
        'join_at' => date('Y-m-d H:i:s'),
        'registered_from' => 'http://pintaria.dev',
        'has_access_thank_you_page' => 0,
        'provider_id' => $faker->randomNumber,
        'provider' => 'pintaria-auth',
    ];
});

$factory->define(App\Provider::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->realText,
        'logo' => 'pintaria/users/profile_picture_object.jpeg'
    ];
});

$factory->define(App\Instructor::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'title' => $faker->title,
        'email' => $faker->email,
        'description' => $faker->realText,
        'profile_picture' => 'pintaria/users/profile_picture_object.jpeg',
        'signature' => null,
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->slug,
        'description' => $faker->realText,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        'price' => rand(100000, 2000000),
        'seo' => $faker->realText,
        'category_classification_id' => $faker->randomNumber,
        'learning_method_id' => $faker->randomNumber,
        'location_id' => $faker->randomNumber,
        'quota' => rand(1000, 10000),
        'image' => 'pintaria/users/profile_picture_object.jpeg',
        'crm_interest_name' => $faker->sentence,
        'is_open_enrollment' => true,
        'is_content_ready' => true,
        'is_learning_material_showed' => true,
        'is_tryout' => 0,
        'is_lead_form_active' => true,
        'instruction' => $faker->realText,
        'excerpt' => $faker->realText,
        'is_review_shown' => 1,
    ];
});

$factory->define(App\LearningMethod::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Location::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(TCG\Voyager\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => (rand(0, 1) == 1) ? 'kursus' : 'kuliah',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Industry::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Topic::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Affiliate::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'domain_url' => $faker->url,
        'logo' => 'pintaria/users/profile_picture_object.jpeg',
        'logged_in_domain_url' => $faker->url,
        'oauth_client_id' => 1,
        'oauth_secret' => 1,
        'site_title' => $faker->name,
        'favicon' => 'pintaria/users/profile_picture_object.jpeg',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Page::class, function (Faker\Generator $faker) {
    return [
        'affiliate_id' => 0,
        'author_id' => 0,
        'title' => $faker->name,
        'excerpt' => $faker->realText,
        'body' => $faker->realText,
        'image' => 'pintaria/users/profile_picture_object.jpeg',
        'slug' => 'hubungi-kami',
        'meta_description' => $faker->realText,
        'meta_keywords' => $faker->realText,
        'status' => 'ACTIVE',
        'title_tag' => $faker->name,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'author_id' => $faker->randomNumber,
        'title' => $faker->name,
        'excerpt' => $faker->realText,
        'body' => $faker->realText,
        'image' => 'pintaria/users/profile_picture_object.jpeg',
        'slug' => $faker->slug,
        'meta_description' => $faker->realText,
        'meta_keywords' => $faker->realText,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Bundle::class, function (Faker\Generator $faker) {
    $now = date('Y-m-d H:i:s');

    return [
        'name' => $faker->name,
        'price' => rand(100000, 2000000),
        'start_at' => date('Y-m-d H:i:s', strtotime($now . '-2 days')),
        'end_at' => date('Y-m-d H:i:s', strtotime($now . '+5 days')),
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->randomNumber,
        'user_id' => 1,
        'order_number' => uniqid(),
        'invoice_number' => uniqid(),
        'amount' => 1500000,
        'quantity' => 1,
        'currency' => 'IDR',
        'tax_type' => 'Tax Exempt',
        'status' => 'pending',
        'account_code' => 111111111,
        'bundle_id' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\OrderDetail::class, function (Faker\Generator $faker) {
    return [
        'order_id' => 1,
        'course_id' => 255,
        'product_slug' => $faker->slug,
        'quantity' => 1,
    ];
});

$factory->define(App\BundleProduct::class, function(Faker\Generator $faker) {
    return [
        'bundle_id' => 1,
        'product_id' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Promotion::class, function(Faker\Generator $faker) {
    $random = rand(0,1);
    $now = date('Y-m-d H:i:s');
    return [
        'promo_code' => $faker->regexify('[A-Z0-9]{5}'),
        'description' => $faker->text,
        'discount_type' => ($random == 1 ? 'Amount' : 'Percentage'),
        'discount_value' => ($random == 1) ? rand(10000, 50000) : rand(1, 99),
        'start_at' => date('Y-m-d H:i:s', strtotime($now . '-2 days')),
        'end_at' => date('Y-m-d H:i:s', strtotime($now . '+5 days')),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\RatingReview::class, function(Faker\Generator $faker) {
    return [
        'reviewer_name' => $faker->name,
        'reviewer_email' => $faker->unique()->safeEmail,
        'product_id' => 1,
        'review' => $faker->text,
        'rating' => rand(0, 5),
        'status' => 'Pending',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Newsletter::class, function(Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'submitted_url' => 'http://pintaria.dev',
        'is_registered_to_sendgrid' => 0,
    ];
});

$factory->define(App\PostTag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\CategoryClassification::class, function (Faker\Generator $faker) {
    return [
        'name' => (rand(0, 1) == 1) ? 'kursus' : 'kuliah',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Profession::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'sort' => rand(0, 5),
        'icon' => 'pintaria/users/profile_picture_object.jpeg',
        'banner' => 'pintaria/users/profile_picture_object.jpeg',
        'description' => $faker->realText,
        'excerpt' => $faker->realText,
        'pay' => $faker->realText,
        'task' => $faker->realText,
        'knowledge' => $faker->realText,
        'skill' => $faker->realText,
        'is_content_ready' => true,
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'thumbnail_image' => 'pintaria/users/profile_picture_object.jpeg',
        'image' => 'pintaria/users/profile_picture_object.jpeg',
        'category_sort' => rand(0, 5),
        'icon_category' => 'pintaria/users/profile_picture_object.jpeg',
    ];
});

$factory->define(App\UserReferralCode::class, function(Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'referral_code' => $faker->regexify('[A-Z0-9]{8}'),
        'is_default' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\StudentLead::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'url' => 'http://pintaria.com',
        'reference_name' => $faker->name,
        'reference_email' => $faker->email,
        'phone' => $faker->randomNumber,
        'location' => 'Jakarta',
        'product' => 'Mencari Kerja',
        'interest' => '3 Bulan dari sekarang',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Testimony::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'title' => $faker->name,
        'photo' => null,
        'testimony' => $faker->realText,
        'sort' => $faker->randomNumber,
        'youtube_video_id' => null,
    ];
});

$factory->define(App\ProductTryout::class, function(Faker\Generator $faker) {
    return [
        'product_id' => $faker->randomNumber,
        'button_name' => $faker->name,
        'embed_link' => $faker->url,
        'sort' => $faker->randomNumber,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Video::class, function(Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->realText,
        'image' => 'pintaria/users/profile_picture_object.jpeg',
        'youtube_id' => 'abd',
    ];
});

$factory->define(App\Content::class, function(Faker\Generator $faker) {
    return [
        'affiliate_id' => 0,
        'key' => 'apa-itu-pintaria',
        'title' => $faker->name,
        'description' => $faker->realText,
    ];
});

$factory->define(App\ClassAttendee::class, function(Faker\Generator $faker) {
    return [
        'lms_klass_id' => $faker->randomNumber,
        'lms_course_id' => $faker->randomNumber,
        'user_id' => $faker->randomNumber,
        'lms_course_name' => $faker->name,
        'slug' => $faker->slug,
        'attendance_completion_percentage' => 0,
        'lms_custom_url' => null,
        'certificate_number' => null,
        'certificate_published_at' => null,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});
$factory->define(App\PaymentNotification::class, function(Faker\Generator $faker) {
    return [
        'masked_card' => $faker->creditCardNumber,
        'approval_code' => $faker->word,
        'bank' => $faker->word,
        'eci' => $faker->randomDigitNotNull,
        'transaction_time' =>  date('Y-m-d H:i:s'),
        'gross_amount' => 1000000,
        'order_id' => 1,
        'payment_type' => 'bank_transfer',
        'signature_key' => $faker->realText,
        'status_code' => 201,
        'transaction_id' => 1,
        'transaction_status' => 'pending',
        'fraud_status' => 'accept',
        'status_message' => 'Veritrans payment notification',
    ];
});

$factory->define(App\UserReferralCode::class, function(Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'referral_code' => $faker->regexify('[A-Z0-9]{8}'),
        'is_default' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Banner::class, function (Faker\Generator $faker) {
    return [
        'product_id' => 1,
        'name' => $faker->name,
        'description' => $faker->realText,
        'image' => 'pintaria/users/profile_picture_object.jpeg',
        'sort' => 0,
        'url' => $faker->url,
        'image_large' => 'pintaria/users/profile_picture_object.jpeg',
        'image_small' => 'pintaria/users/profile_picture_object.jpeg',
    ];
});

$factory->define(App\UserParticipant::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomNumber,
        'product_id' => $faker->randomNumber,
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->randomNumber,
        'company' => $faker->name,
    ];
});

$factory->define(App\UserParticipantDiscount::class, function (Faker\Generator $faker) {
    $now = date('Y-m-d H:i:s');
    return [
        'participant_number' => $faker->randomNumber,
        'product_id' => $faker->randomNumber,
        'discounted_price' => rand(100000, 2000000),
        'is_same_provider' => rand(0, 1),
        'start_at' => date('Y-m-d H:i:s', strtotime($now . '-2 days')),
        'end_at' => date('Y-m-d H:i:s', strtotime($now . '+5 days')),
    ];
});

$factory->define(App\ProductSchedule::class, function (Faker\Generator $faker) {
    return [
        'product_id' => rand(1, 100),
        'date' => $faker->date,
        'start_at' => $faker->time,
        'end_at' => $faker->time,
    ];
});

$factory->define(App\LandingPage::class, function (Faker\Generator $faker) {
    return [
        'slug' => $faker->slug,
        'title' => $faker->title,
        'main_title' => $faker->title,
        'main_description' => $faker->realText,
        'is_content_ready' => true,
    ];
});
