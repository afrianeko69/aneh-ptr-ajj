<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'posts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'posts',
                'display_name_singular' => 'Post',
                'display_name_plural'   => 'Posts',
                'icon'                  => 'voyager-news',
                'model_name'            => 'TCG\\Voyager\\Models\\Post',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'pages');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'pages',
                'display_name_singular' => 'Page',
                'display_name_plural'   => 'Pages',
                'icon'                  => 'voyager-file-text',
                'model_name'            => 'TCG\\Voyager\\Models\\Page',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => 'User',
                'display_name_plural'   => 'Users',
                'icon'                  => 'voyager-person',
                'model_name'            => 'TCG\\Voyager\\Models\\User',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('name', 'categories');
        if (!$dataType->exists) {
            $dataType->fill([
                'slug'                  => 'categories',
                'display_name_singular' => 'Category',
                'display_name_plural'   => 'Categories',
                'icon'                  => 'voyager-categories',
                'model_name'            => 'TCG\\Voyager\\Models\\Category',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural'   => 'Menus',
                'icon'                  => 'voyager-list',
                'model_name'            => 'TCG\\Voyager\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural'   => 'Roles',
                'icon'                  => 'voyager-lock',
                'model_name'            => 'TCG\\Voyager\\Models\\Role',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'providers');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'providers',
                'display_name_singular' => 'Provider',
                'display_name_plural'   => 'Providers',
                'icon'                  => 'voyager-people',
                'model_name'            => 'App\Provider',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'instructors');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'instructors',
                'display_name_singular' => 'Instructor',
                'display_name_plural'   => 'Instructors',
                'icon'                  => 'voyager-pirate',
                'model_name'            => 'App\Instructor',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'locations');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'locations',
                'display_name_singular' => 'Location',
                'display_name_plural'   => 'Locations',
                'icon'                  => 'voyager-location',
                'model_name'            => 'App\Location',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'learning-methods');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'learning_methods',
                'display_name_singular' => 'Learning Method',
                'display_name_plural'   => 'Learning Methods',
                'icon'                  => 'voyager-study',
                'model_name'            => 'App\LearningMethod',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'industries');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'industries',
                'display_name_singular' => 'Industry',
                'display_name_plural'   => 'Industries',
                'icon'                  => 'voyager-shop',
                'model_name'            => 'App\Industry',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'banners');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'banners',
                'display_name_singular' => 'Banner',
                'display_name_plural'   => 'banners',
                'icon'                  => 'voyager-image',
                'model_name'            => 'App\Banner',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
        
        $dataType = $this->dataType('slug', 'contents');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'contents',
                'display_name_singular' => 'Content',
                'display_name_plural'   => 'Contents',
                'icon'                  => 'voyager-news',
                'model_name'            => 'App\Content',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'topics');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'topics',
                'display_name_singular' => 'Topic',
                'display_name_plural'   => 'Topics',
                'icon'                  => 'voyager-news',
                'model_name'            => 'App\Topic',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'products');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'products',
                'display_name_singular' => 'Product',
                'display_name_plural'   => 'Products',
                'icon'                  => 'voyager-list',
                'model_name'            => 'App\Product',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'affiliates');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'affiliates',
                'display_name_singular' => 'Affiliate',
                'display_name_plural'   => 'Affiliates',
                'icon'                  => 'voyager-people',
                'model_name'            => 'App\Affiliate',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'videos');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'videos',
                'display_name_singular' => 'Video',
                'display_name_plural'   => 'Videos',
                'icon'                  => 'voyager-video',
                'model_name'            => 'App\Video',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'bundles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'bundles',
                'display_name_singular' => 'Bundle',
                'display_name_plural'   => 'Bundles',
                'icon'                  => 'voyager-treasure',
                'model_name'            => 'App\Bundle',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'pages');
        if ($dataType->exists) {
            $dataType->update([
                'model_name' => 'App\Page',
                'controller' => 'App\\Http\\Controllers\\Voyager\\PageController',
            ]);
        }

        $dataType = $this->dataType('slug', 'promo');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'promotions',
                'display_name_singular' => 'Promotion',
                'display_name_plural'   => 'Promotions',
                'icon'                  => 'voyager-key',
                'model_name'            => 'App\Promotion',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'posts');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\PostController',
            ]);
        }

        $dataType = $this->dataType('slug', 'users');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\UserController',
            ]);
        }

        $dataType = $this->dataType('slug', 'providers');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\ProviderController',
            ]);
        }

        $dataType = $this->dataType('slug', 'instructors');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\InstructorController',
            ]);
        }

        $dataType = $this->dataType('slug', 'banners');
        if ($dataType->exists) {
            $dataType->update([
                'display_name_plural'   => 'Banners',
                'controller'            => 'App\\Http\\Controllers\\Voyager\\BannerController',
            ]);
        }

        $dataType = $this->dataType('slug', 'products');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\ProductController',
            ]);
        }

        $dataType = $this->dataType('slug', 'affiliates');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\AffiliateController',
            ]);
        }

        $dataType = $this->dataType('slug', 'videos');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\VideoController',
            ]);
        }

        $dataType = $this->dataType('slug', 'rating-reviews');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'rating_reviews',
                'display_name_singular' => 'Rating Review',
                'display_name_plural'   => 'Rating Reviews',
                'icon'                  => 'voyager-pen',
                'model_name'            => 'App\RatingReview',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'rating-reviews');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\RatingReviewController',
            ]);
        }

        $dataType = $this->dataType('slug', 'post-tags');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'post_tags',
                'display_name_singular' => 'Post Tag',
                'display_name_plural'   => 'Post Tags',
                'icon'                  => 'voyager-list',
                'model_name'            => 'App\PostTag',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'categories-classification');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'categories_classification',
                'display_name_singular' => 'Category Classification',
                'display_name_plural'   => 'Category Classifications',
                'icon'                  => 'voyager-categories',
                'model_name'            => 'App\CategoryClassification',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'professions');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'professions',
                'display_name_singular' => 'Profession',
                'display_name_plural'   => 'Professions',
                'icon'                  => 'voyager-ship',
                'model_name'            => 'App\Profession',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'professions');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\ProfessionController',
            ]);
        }

        $dataType = $this->dataType('slug', 'industries');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\IndustryController',
            ]);
        }

        $dataType = $this->dataType('name', 'categories');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\CategoryController',
            ]);
        }

        $dataType = $this->dataType('slug', 'testimonies');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'testimonies',
                'display_name_singular' => 'Testimony',
                'display_name_plural'   => 'Testimonies',
                'icon'                  => 'voyager-ship',
                'model_name'            => 'App\Testimony',
                'controller'            => 'App\\Http\\Controllers\\Voyager\\TestimonyController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'bundles');
        if ($dataType->exists) {
            $dataType->update([
                'controller'            => 'App\\Http\\Controllers\\Voyager\\BundleController',
            ]);
        }

        $dataType = $this->dataType('slug', 'news');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'news',
                'display_name_singular' => 'News',
                'display_name_plural'   => 'News',
                'icon'                  => 'voyager-ship',
                'model_name'            => 'App\News',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'user-participant-discounts');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'user_participant_discounts',
                'display_name_singular' => 'User Participant Discount',
                'display_name_plural'   => 'User Participant Discounts',
                'icon'                  => 'voyager-ship',
                'model_name'            => 'App\UserParticipantDiscount',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'landing-pages');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'landing_pages',
                'display_name_singular' => 'Landing Page',
                'display_name_plural'   => 'Landing Pages',
                'icon'                  => 'voyager-html5',
                'model_name'            => 'App\LandingPage',
                'controller'            => 'App\\Http\\Controllers\\Voyager\\LandingPageController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
