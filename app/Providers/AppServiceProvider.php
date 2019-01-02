<?php

namespace App\Providers;

use App\Affiliate;
use App\Category;
use App\Content;
use App\News;
use App\Post;
use App\PostTag;
use App\Profession;
use App\StudentLead;
use App\User;
use App\Video;
use Cache;
use Exception;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use FeedReader;
use Request;
use Validator;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('shared.*', function($view)
        {
            $blogs = Post::orderBy('id','desc')->limit(2)->get();
            $newsletter = Content::where('key',Content::NEWSLETTER)->first();
            $view->with(compact('blogs','newsletter'));
        });
        
        View::composer('layouts.pintaria*.partials.post.sidebar', function($view)
        {
            $recentPost = Post::where('status', Post::STATUS_PUBLISHED)->orderBy('id','desc')->limit(3)->get();

            $posts = Post::pluck('id');
            $tags = PostTag::whereHas('posts', function($query) use ($posts)
            {
                $query->whereIn('posts.id', $posts);
            })->get();

            $newsletter = Content::where('key',Content::NEWSLETTER)->first();
            $latest_videos = Video::orderBy('id','DESC')->limit(3)->get();
            $view->with(compact('recentPost', 'tags', 'newsletter', 'latest_videos'));
        });

        View::composer('layouts.pintaria*.partials.news.sidebar', function($view)
        {
            $recentNews = News::where('status', News::STATUS_PUBLISHED)->orderBy('id','desc')->limit(3)->get();
            $view->with(compact('recentNews'));
        });

        View::composer('layouts.*', function($view)
        {
            $data['affiliate_logo'] = !empty(Request::get('app_affiliate_logo')) ? Request::get('app_affiliate_logo') : '';
            $data['affiliate_name'] = !empty(Request::get('app_affiliate_name')) ? Request::get('app_affiliate_name') : '';
            $data['affiliate_favicon'] = !empty(Request::get('app_affiliate_favicon')) ? Request::get('app_affiliate_favicon') : '';

            $data['affiliate_site_title'] = !empty(Request::get('app_affiliate_site_title')) ? Request::get('app_affiliate_site_title') : '';
            
            $data['affiliate_domain_url'] = !empty(Request::get('app_affiliate_domain_url')) ? Request::get('app_affiliate_domain_url') : '';

            $data['professions'] = Profession::orderBy('sort', 'asc')->limit(4)->select(['name', 'icon'])->get();

            $data['program_categories'] = Category::orderBy('category_sort', 'asc')->limit(4)->select(['name', 'icon_category'])->get();

            $data['search_placeholder'] = Content::where('key',Content::SEARCH_PLACEHOLDER)->first();

            $view->with($data);
        });

        Validator::extend('uniqueEmailAndProduct', function ($attribute, $value, $parameters, $validator) {
            $count = StudentLead::where('email', $value)->where('product', $parameters[0])->count();
            return $count === 0;
        });
        Validator::extend('uniqueEmailAndDepartment', function ($attribute, $value, $parameters, $validator) {
            $count = StudentLead::where('email', $value)->where('departement', $parameters[0])->count();
            return $count === 0;
        });

        $this->bootPintariaAuthSocialite();
    }

    private function bootPintariaAuthSocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'pintaria-auth',
            function ($app) use ($socialite) {
                $config = $app['config']['services.pintaria'];

                if(Request::get('app_affiliate_oauth_client_id') && Request::get('app_affiliate_oauth_secret')){
                    $config['client_id'] = Request::get('app_affiliate_oauth_client_id');
                    $config['client_secret'] = Request::get('app_affiliate_oauth_secret');
                    $config['redirect'] = Request::get('app_affiliate_full_logged_in_domain_url') . 'oauth/callback';
                }
                return $socialite->buildProvider(PintariaAuthProvider::class, $config);
            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
            $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
        }
    }
}
