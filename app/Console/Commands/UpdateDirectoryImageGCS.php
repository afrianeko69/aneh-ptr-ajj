<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Affiliate;
use App\Banner;
use App\Instructor;
use App\Page;
use App\Post;
use App\Product;
use App\Provider;
use App\Setting;
use App\User;
use App\Video;

class UpdateDirectoryImageGCS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:db-update-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will update from old url to new';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = 'pintaria/';

        $affiliates = Affiliate::all();
        $subfolder = 'affiliates/';
        foreach ($affiliates as $key => $value) {
            $affiliate = Affiliate::find($value->id);

            if (!empty($affiliate->logo)){
                $affiliate->logo = str_replace( $subfolder, $path.$subfolder, $affiliate->logo);
            }
            if (!empty($affiliate->favicon)) {
                $affiliate->favicon = str_replace( $subfolder, $path.$subfolder, $affiliate->favicon);
            }

            $affiliate->update();
        }

        $banners = Banner::all();
        $subfolder = 'banners/';
        foreach ($banners as $key => $value) {
            $banner = Banner::find($value->id);

            if (!empty($banner->image)) {
                $banner->image = str_replace( $subfolder, $path.$subfolder, $banner->image);
            }
            if (!empty($banner->image_large)) {
                $banner->image_large = str_replace( $subfolder, $path.$subfolder, $banner->image_large);
            }
            if (!empty($banner->image_large)) {
                $banner->image_small = str_replace( $subfolder, $path.$subfolder, $banner->image_small);
            }

            $banner->update();
        }
        
        $instructors = Instructor::all();
        $subfolder = 'instructors/';
        foreach ($instructors as $key => $value) {
            $instructor = Instructor::find($value->id);

            if (!empty($instructor->profile_picture)) {
                $instructor->profile_picture = str_replace( $subfolder, $path.$subfolder, $instructor->profile_picture);
            }

            $instructor->update();
        }

        $pages = Page::all();
        $subfolder = 'pages/';
        foreach ($pages as $key => $value) {
            $page = Page::find($value->id);

            if (!empty($page->image)) {
                $page->image = str_replace( $subfolder, $path.$subfolder, $page->image);
            }

            $page->update();
        }

        $posts = Post::all();
        $subfolder = 'posts/';
        foreach ($posts as $key => $value) {
            $post = Post::find($value->id);

            if (!empty($post->image)) {
                $post->image = str_replace( $subfolder, $path.$subfolder, $post->image);
            }

            $post->update();
        }

        $products = Product::all();
        $subfolder = 'products/';
        foreach ($products as $key => $value) {
            $product = Product::find($value->id);

            if (!empty($product->image)) {
                $product->image = str_replace( $subfolder, $path.$subfolder, $product->image);
            }

            $product->update();
        }

        $providers = Provider::all();
        $subfolder = 'providers/';
        foreach ($providers as $key => $value) {
            $provider = Provider::find($value->id);

            if (!empty($provider->logo)) {
                $provider->logo = str_replace( $subfolder, $path.$subfolder, $provider->logo);
            }

            $provider->update();
        }

        $setting = Setting::where('key', 'admin_icon_image')->first();
        $subfolder = 'settings/';

        if (!empty($setting->value)) {
            $setting->value = str_replace( $subfolder, $path.$subfolder, $setting->value);
        }

        $setting->update();

        $users = User::all();
        $subfolder = 'users/';
        foreach ($users as $key => $value) {
            $user = User::find($value->id);

            if (!empty($user->avatar)) {
                $user->avatar = str_replace( $subfolder, $path.$subfolder, $user->avatar);
            }

            $user->update();
        }
        
        $videos = Video::all();
        $subfolder = 'videos/';
        foreach ($videos as $key => $value) {
            $video = Video::find($value->id);

            if (!empty($video->image)) {
                $video->image = str_replace( $subfolder, $path.$subfolder, $video->image);
            }

            $video->update();
        }
    }
}
