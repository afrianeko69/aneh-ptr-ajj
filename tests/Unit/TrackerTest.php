<?php

namespace Tests\Unit;

use App;
use Artisan;
use Tests\TestCase;
use Illuminate\Http\Request;
use Crypt;

class TrackerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testIndex()
    {
        $args = ['utm_source' => 'facebook', 'utm_campaign' => 'S1 S2 GDN 2018'];
        $this->call('GET', '/', $args, $args);
        $this->seePageIs('/');
        
        $this->seeCookie('utm_source', 'facebook');
        $this->seeCookie('utm_campaign', 'S1 S2 GDN 2018');
        $this->assertEquals(200, $this->response->status());
     }


    public function testTracker()
    {
        $args = ['utm_source' => 'facebook', 'utm_campaign' => 'S1 S2 GDN 2018'];
        $this->call('GET', '/', $args, $args);
        $this->seePageIs('/');

        $post = ['object_name' => 'product', 'object_id' => rand(0,9)];
        $this->call('POST', route('home.tracker'), $post, $args);
        $this->assertEquals(200, $this->response->status());
    }
}
