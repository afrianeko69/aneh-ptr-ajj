<?php

use Illuminate\Database\Seeder;
use App\PostTag;
use App\Post;

class PostTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostTag::create([
            'name' => 'Berita'
        ]);

        PostTag::create([
            'name' => 'e-Learning'
        ]);

        PostTag::create([
            'name' => 'Event'
        ]);

        $tagPost = PostTag::create([
            'name' => 'Job Opening'
        ]);

        $post = Post::create([
            'title'            => 'Post Tag Title',
            'author_id'        => 0,
            'seo_title'        => null,
            'excerpt'          => 'This is the excerpt for the Lorem Ipsum Post',
            'body'             => '<p>This is the body of the lorem ipsum post</p>',
            'image'            => 'posts/nlje9NZQ7bTMYOUG4lF1.jpg',
            'slug'             => 'post-tag-title',
            'meta_description' => 'This is the meta description',
            'meta_keywords'    => 'keyword1, keyword2, keyword3',
            'status'           => 'PUBLISHED',
            'featured'         => 0,
        ]);

        \DB::table('post_post_tag')->insert([
            'post_id' => $post->id,
            'post_tag_id' => $tagPost->id
        ]);
    }
}
