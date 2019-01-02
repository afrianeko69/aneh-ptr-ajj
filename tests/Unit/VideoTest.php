<?php

namespace Tests\Unit;

use App\Video;
use Tests\TestCase;

class VideoTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function testViewVideoPage() {
        $videos = factory(Video::class, 3)->create();

        $this->visit(route('video'))
            ->see('Tambah Pintar Dalam 60 Detik')
            ->see('Lihat beragam video singkat yang dapat menambah wawasan kamu')
            ->see($videos[0]->title)
            ->assertResponseStatus(200);
    }
}
