<?php

namespace Tests\Unit;

use App;
use Artisan;
use Tests\Feature\Admin\TestCase;

class PostTest extends TestCase
{
    private $post;
    public function setUp()
    {
        parent::setUp();
        $this->post = factory(App\Post::class)->create();
    }

    public function testIndex()
    {
        $this->visit('/blog')
            ->see('Artikel Terbaru')
            ->assertResponseStatus(200);
    }

    public function testNotFoundBlog()
    {
        $response = $this->call('GET', '/blog/asdfasdfasdf');
        $this->assertEquals(404, $response->status());
    }

    public function testShow()
    {
         $this->visit('/blog/'.$this->post->slug)
         ->see($this->post->title)
         ->assertResponseStatus(200);
    }

    public function testSeeTagsPage()
    {
        Artisan::call('db:seed', ['--class' => 'PostTagsTableSeeder']);
        $this->visit('blog/tag/job-opening')
            ->see('Job opening')
            ->assertResponseStatus(200);
    }

    public function testGetPostWithTag(){
        $post_tag = factory(App\PostTag::class)->create();
        $url_post_tag = str_replace(' ', '-', $post_tag->name);

        $posts = factory(App\Post::class, 3)->create()->each(function($u) use($post_tag) {
            $u->post_tag()->save($post_tag);
        });

        $this->visit(route('tag', [ $url_post_tag ]))
            ->see($posts[0]->title)
            ->assertResponseStatus(200);
    }
}
