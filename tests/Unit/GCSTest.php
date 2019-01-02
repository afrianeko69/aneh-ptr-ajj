<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GCSTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function testFailedGetFile() {
        Storage::fake('lmsums_gcs');

        $request = $this->call('GET', route('asset', [
            'avatar.png'
        ]));

        $this->assertEquals(404, $request->status());
    }

    public function testSuccessGetFile() {
        Storage::fake('lmsums_gcs');

        $file = UploadedFile::fake()->image('avatar.png');
        Storage::disk('lmsums_gcs')->put('avatar.png', file_get_contents($file));
        Storage::disk('lmsums_gcs')->assertExists('avatar.png');

        $request = $this->call('GET', route('asset', [
            'avatar.png'
        ]));

        $this->assertEquals(200, $request->status());
    }

    public function testFailedGetPintariaFile() {
        Storage::fake('gcs');

        $request = $this->actingAs($this->affiliate)
                    ->call('GET', route('pintaria.asset', [
                        'avatar.png'
                    ]));

        $this->assertEquals(404, $request->status());
    }

    public function testSuccessGetPintariaFile() {
        Storage::fake('gcs');

        $file = UploadedFile::fake()->image('avatar.png');
        Storage::disk('gcs')->put('avatar.png', file_get_contents($file));
        Storage::disk('gcs')->assertExists('avatar.png');

        $request = $this->actingAs($this->affiliate)
                        ->call('GET', route('pintaria.asset', [
                            'avatar.png'
                        ]));

        $this->assertEquals(200, $request->status());
    }
}
