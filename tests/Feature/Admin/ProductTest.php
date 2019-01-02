<?php

namespace Tests\Feature\Admin;

use Tests\Feature\Admin\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App;

class ProductTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSeeProductPage()
    {
        $this->actingAs($this->user)
            ->visit('/admin')
            ->see('Products')
            ->click('Products')
            ->seePageIs('/admin/products')
            ->assertResponseStatus(200);
    }

    public function testSeeIsReviewShown()
    {
        $this->actingAs($this->user)
            ->visit('/admin/products')
            ->see('Add New')
            ->click('Add New')
            ->seePageIs('/admin/products/create')
            ->see('Is Review Active? (If not active, Ulasan is hidden on the Product Detail and Kelas Saya)')
            ->see('Review Not Active')
            ->see('Review Active')
            ->assertResponseStatus(200);
    }
    
    public function testSeeBundleEnrollment()
    {
        $this->actingAs($this->user)
            ->visit('admin/products')
            ->see('Add New')
            ->click('Add New')
            ->seePageIs('/admin/products/create')
            ->see('Is Open Enrollment (Button on Product Detail Page: OE - Beli Sekarang, OBE - Beli Paket, NOE - Saya Berminat, DL - Info Selengkapnya)')
            ->see('Open Bundle Enrollment')
            ->see('Bundle Enrollment')
            ->assertResponseStatus(200);
    }

    public function testSeeIsLeadFormActive()
    {
        $this->actingAs($this->user)
            ->visit('/admin/products')
            ->see('Add New')
            ->click('Add New')
            ->seePageIs('/admin/products/create')
            ->see('Is Lead Form Active? (If not active, Mohon Info Form is hidden on the Product Detail and Produk option on Homepage Mohon Info Form)')
            ->see('Lead Form Not Active')
            ->see('Lead Form Active')
            ->assertResponseStatus(200);
    }

    public function testSeeTrainingCode()
    {
        $this->actingAs($this->user)
            ->visit('/admin/products/create')
            ->see('Training Code')
            ->assertResponseStatus(200);
    }

    public function testSeeKartuPesertaButton()
    {
        $learning_method = factory(App\LearningMethod::class)->create([
            'name' => 'Tatap Muka',
        ]);
        $classification = factory(App\CategoryClassification::class)->create([
            'name' => 'Training',
        ]);
        $product = factory(App\Product::class)->create([
            'learning_method_id' => $learning_method->id,
            'category_classification_id' => $classification->id,
        ]);
        $this->actingAs($this->user)
            ->visit('/admin/products')
            ->see('Kartu Peserta')
            ->assertResponseStatus(200);
    }

    public function testSeeMultipleParticipantDiscounts()
    {
        $this->actingAs($this->user)
            ->visit('/admin/products/create')
            ->see('Multiple Participants Discount')
            ->assertResponseStatus(200);
    }

    public function testSeeCertificateButton()
    {
        $learning_method = factory(App\LearningMethod::class)->create([
            'name' => 'E-learning',
        ]);
        $classification = factory(App\CategoryClassification::class)->create([
            'name' => 'Training',
        ]);
        $product = factory(App\Product::class)->create([
            'learning_method_id' => $learning_method->id,
            'category_classification_id' => $classification->id,
        ]);
        $this->actingAs($this->user)
            ->visit('/admin/products')
            ->see('E-Certificate')
            ->assertResponseStatus(200);
    }

    public function testNotSeeCertificateButton()
    {
        $learning_method = factory(App\LearningMethod::class)->create();
        $classification = factory(App\CategoryClassification::class)->create([
            'name' => 'Kuliah',
        ]);
        $product = factory(App\Product::class)->create([
            'learning_method_id' => $learning_method->id,
            'category_classification_id' => $classification->id,
        ]);
        $this->actingAs($this->user)
            ->visit('/admin/products')
            ->dontSee('E-Certificate')
            ->assertResponseStatus(200);
    }

    public function testSeeRelatedReview()
    {
        $this->actingAs($this->user)
            ->visit('/admin/products/create')
            ->see('Show reviews from other products?')
            ->see('Add New Product')
            ->assertResponseStatus(200);
    }
}
