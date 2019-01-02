<?php

namespace Tests\Unit;

use App;
use App\ClassAttendee;
use App\Instructor;
use App\Product;
use App\Provider;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CertificateTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function testCertificatePage() {
        Storage::fake('gcs');

        $user = factory(App\User::class)->create();
        $product = factory(Product::class)->create();
        $class_attendee = factory(ClassAttendee::class)->create([
            'user_id' => $user->id,
            'slug' => $product->slug,
            'certificate_number' => 'abc-235-2/1/2018',
            'certificate_published_at' => date('Y-m-d H:i:s'),
        ]);

        $instructor_no_signature = factory(Instructor::class)->create();
        $product->instructors()->attach($instructor_no_signature);
        $instructor_image_not_found = factory(Instructor::class)->create([
            'signature' => 'abc.png',
        ]);
        $product->instructors()->attach($instructor_image_not_found);

        $signature = UploadedFile::fake()->image('signature.png');
        Storage::disk('gcs')->put('pintaria/signature.png', file_get_contents($signature));
        Storage::disk('gcs')->assertExists('pintaria/signature.png');

        $instructor = factory(Instructor::class)->create([
            'signature' => $signature,
        ]);
        $product->instructors()->attach($instructor);

        $logo = UploadedFile::fake()->image('logo.png');
        Storage::disk('gcs')->put('logo.png', file_get_contents($logo));
        Storage::disk('gcs')->assertExists('logo.png');
        $providers = factory(Provider::class, 3)->create([
            'logo' => $logo,
        ]);
        $product->providers()->attach($providers);

        // $this->actingAs($user)
        //     ->visit(route('certificate.stream', [$product->slug]))
        //     ->assertResponseStatus(200);
    }
}
