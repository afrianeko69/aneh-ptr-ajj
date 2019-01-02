<?php

use Illuminate\Database\Seeder;
use App\Industry;
use App\Location;
use App\LearningMethod;
use App\Topic;
use App\Provider;
use App\Instructor;
use App\Product;
use App\Profession;
use App\CategoryClassification;
use Carbon\Carbon;
use TCG\Voyager\Models\Category;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kuliah_category = CategoryClassification::firstOrCreate([
            'name' => 'Kuliah'
        ]);

        $agriculture_industry = Industry::firstOrCreate([
            'name' => 'Agriculture'
        ]);

        $business_industry = Industry::firstOrCreate([
            'name' => 'Business'
        ]);

        $location = Location::firstOrCreate([
            'name' => 'Jakarta'
        ]);

        $learning_method = LearningMethod::firstOrCreate([
            'name' => 'Online'
        ]);

        $topic = Topic::firstOrCreate([
            'name' => 'Teknik'
        ]);

        $provider = Provider::firstOrNew([
            'name' => 'Samator'
        ]);

        $profession = Profession::firstOrCreate([
            'name' => 'Akuntan',
            'sort' => 1
        ]);

        $profession_2 = Profession::firstOrCreate([
            'name' => 'Notaris',
            'sort' => 3
        ]);

        if(!$provider->exists){
            $provider->fill([
                'description' => 'Ini description',
                'logo' => 'tmp/fff.png',
                'tagline' => 'Passion, Purpose, Culture'
            ])->save();
        }

        $instructor = Instructor::firstOrCreate([
            'name' => 'Testing',
            'title' => 'CEO',
            'email' => 'testing@gmail.com',
            'description' => 'Ini description',
            'profile_picture' => 'tmp/fff.png'
        ]);

        $product = Product::firstOrNew([
            'slug' => 'mencari-kerja-2'
        ]);
        
        if(!$product->exists) {
            $product->fill([
                'name' => 'Mencari Kerja',
                'description' => 'Mencari Kerja adalah',
                'price' => 10000000,
                'seo' => 'Mencari kerja merupakan',
                'category_classification_id' => $kuliah_category->id,
                'learning_method_id' => $learning_method->id,
                'location_id' => $location->id,
                'quota' => 1000,
                'image' => 'image/fff.png',
                'youtube_video_id' => '8WuhXsJfXHM',
                'sort' => 1,
                'excerpt' => 'Mencari kerja excerpt'
            ])->save();
        }

        \DB::table('industry_product')->insert([
            'industry_id' => $business_industry->id,
            'product_id' => $product->id
        ]);

        \DB::table('product_topic')->insert([
            'product_id' => $product->id,
            'topic_id' => $topic->id
        ]);

        \DB::table('product_provider')->insert([
            'product_id' => $product->id,
            'provider_id' => $provider->id
        ]);

        \DB::table('instructor_product')->insert([
            'instructor_id' => $instructor->id,
            'product_id' => $product->id
        ]);

        $product2 = Product::firstOrNew([
            'slug' => 'mencari-kerja-3'
        ]);

        if(!$product2->exists) {
            $product2->fill([
                'name' => 'Mencari Kerja 3',
                'description' => 'Mencari Kerja adalah 3',
                'price' => 20000000,
                'seo' => 'Mencari kerja merupakan',
                'category_classification_id' => $kuliah_category->id,
                'learning_method_id' => $learning_method->id,
                'location_id' => $location->id,
                'quota' => 2000,
                'image' => 'image/fff.png',
                'youtube_video_id' => '8WuhXsJfXHM',
                'is_open_enrollment' => 0,
                'discount_percentage' => 25,
                'discount_start_at' => Carbon::yesterday()->toDateTimeString(),
                'discount_end_at' => Carbon::tomorrow()->toDateTimeString(),
                'sort' => 2
            ])->save();
        }

        \DB::table('industry_product')->insert([
            'industry_id' => $business_industry->id,
            'product_id' => $product2->id
        ]);

        \DB::table('product_topic')->insert([
            'product_id' => $product2->id,
            'topic_id' => $topic->id
        ]);

        \DB::table('product_provider')->insert([
            'product_id' => $product2->id,
            'provider_id' => $provider->id
        ]);

        \DB::table('instructor_product')->insert([
            'instructor_id' => $instructor->id,
            'product_id' => $product2->id
        ]);

        $product3 = Product::firstOrNew([
            'slug' => 'data-science-technology-series'
        ]);

        if(!$product3->exists) {
            $product3->fill([
                'name' => 'data science with R data analysis',
                'description' => 'data science with R data analysis',
                'price' => 17500000,
                'seo' => 'Data science merupakan',
                'category_classification_id' => $kuliah_category->id,
                'learning_method_id' => $learning_method->id,
                'location_id' => $location->id,
                'quota' => 2000,
                'image' => 'image/fff.png',
                'youtube_video_id' => '8WuhXsJfXHM',
                'is_open_enrollment' => 1,
                'is_content_ready' => 1,
                'discount_percentage' => 5,
                'discount_start_at' => Carbon::yesterday()->toDateTimeString(),
                'discount_end_at' => Carbon::tomorrow()->toDateTimeString(),
                'sort' => 3
            ])->save();
        }

        $product4 = Product::firstOrNew([
            'slug' => 'dasar-pemrograman'
        ]);

        if(!$product4->exists) {
            $product4->fill([
                'name' => 'Dasar Pemrograman',
                'description' => 'Dasar Pemrograman adalah',
                'price' => 750000,
                'seo' => 'Dasar Pemrograman merupakan',
                'category_classification_id' => $kuliah_category->id,
                'learning_method_id' => $learning_method->id,
                'location_id' => $location->id,
                'quota' => 500,
                'image' => 'image/fff.png',
                'youtube_video_id' => '8WuhXsJfXHM',
                'is_open_enrollment' => 1,
                'is_content_ready' => 1,
                'discount_percentage' => 2,
                'discount_start_at' => Carbon::yesterday()->toDateTimeString(),
                'discount_end_at' => Carbon::tomorrow()->toDateTimeString(),
                'sort' => 4
            ])->save();
        }

        $product5 = Product::firstOrNew([
            'slug' => 'zurich-proteksi-education-program'
        ]);

        if(!$product5->exists) {
            $product5->fill([
                'name' => 'Zurich Proteksi Education Program',
                'description' => 'Zurich Proteksi Education Program adalah',
                'price' => 250000,
                'seo' => 'Zurich Proteksi Education Program merupakan',
                'category_classification_id' => $kuliah_category->id,
                'learning_method_id' => $learning_method->id,
                'location_id' => $location->id,
                'quota' => 100,
                'image' => 'image/fff.png',
                'youtube_video_id' => '8WuhXsJfXHM',
                'is_open_enrollment' => 1,
                'is_content_ready' => 1,
                'sort' => 5
            ])->save();

        }

        $product5->professions()->attach([$profession, $profession_2]);
    }
}
