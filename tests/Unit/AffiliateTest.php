<?php

namespace Tests\Unit;

use App;
use App\Content;
use App\Affiliate;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AffiliateTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testViewAdministratorPage() {
        $this->visit(route('affiliate.index'))
            ->assertResponseStatus(200);
    }

    public function testAccessAffiliateAdminPageNotAuthorized() {
        $this->visit(route('affiliate.settings'))
            ->assertResponseStatus(200);
    }

    public function testLogoutAffiliate() {
        $this->actingAs($this->affiliate)
            ->visit(route('affiliate.logout'))
            ->assertResponseStatus(200)
            ->seePageIs(route('affiliate.index'));
    }

    public function testLoginAffiliateFailed() {
        $this->post(route('affiliate.login'), [
            'email' => 'abc@gmail.com',
            'password' => 123456
        ])
        ->assertResponseStatus(302)
        ->assertSessionHas('message-error', 'Maaf Email / Password anda salah.');
    }

    public function testLoginAffiliateSuccess() {
        $this->post(route('affiliate.login'), [
            'email' => $this->affiliate->email,
            'password' => 123456
        ])
        ->assertResponseStatus(302);
    }

    public function testUpdateSettingsAffiliate() {
        Storage::fake('gcs');

        $this->actingAs($this->affiliate)
            ->post(route('affiliate.updateSettings'), [
                'logo' => UploadedFile::fake()->image('avatar.png'),
                'favicon' => UploadedFile::fake()->image('favicon.png'),
            ])
            ->assertResponseStatus(302);

        $affiliate = Affiliate::first();

        Storage::disk('gcs')->assertExists($affiliate->logo);
        Storage::disk('gcs')->assertExists($affiliate->favicon);
    }

    public function testImportAffiliateContent() {
        $this->actingAs($this->affiliate)
            ->get(route('settings.import'))
            ->assertResponseStatus(302)
            ->assertSessionHas('message-success', 'Anda telah sukses diimportkan Page dan Content Anda ');
    }

    public function testSeeSettingsPage()
    {
        $this->actingAs($this->affiliate)
            ->visit('/administration/settings')
            ->assertResponseStatus(200);
    }
    
    public function testAffiliatePage()
    {
        $this->actingAs($this->affiliate)
            ->visit('/administration/pages')
            ->assertResponseStatus(200);
    }

    public function testViewEditPages() {
        $affiliate = $this->affiliateData();

        $page = factory(App\Page::class)->create([
            'affiliate_id' => $affiliate['affiliate']->id,
            'author_id' => $affiliate['user']->id,
        ]);

        $this->actingAs($affiliate['user'])
            ->visit(route('pages.edit', [$page]))
            ->assertResponseStatus(200);
    }

    public function testUpdatePages() {
        $affiliate = $this->affiliateData();

        $page = factory(App\Page::class)->create([
            'affiliate_id' => $affiliate['affiliate']->id,
            'author_id' => $affiliate['user']->id,
        ]);

        $request = $this->actingAs($affiliate['user'])
                        ->call('PUT', route('pages.update', [$page]), [
                            'title' => 'tes',
                            'body' => 'abc'
                    ]);

        $this->assertEquals(302, $request->status());
        $this->assertEquals('Halaman Anda telah tersimpan.', session()->get('message-success'));
    }

    public function testContentPage()
    {
        $this->actingAs($this->affiliate)
            ->visit('/administration/content')
            ->assertResponseStatus(200);
    }

    private function affiliateData() {
        $affiliate = factory(Affiliate::class)->create([
            'domain_url' => 'pintaria.dev',
            'logged_in_domain_url' => 'pintaria.dev',
        ]);

        $user = factory(App\User::class)->create([
            'affiliate_id' => $affiliate->id
        ]);

        return [
            'user' => $user,
            'affiliate' => $affiliate,
        ];
    }

    public function testViewEditContent() {
        $affiliate = $this->affiliateData();

        $content = factory(Content::class)->create([
            'affiliate_id' => $affiliate['affiliate']->id,
        ]);

        $this->actingAs($affiliate['user'])
            ->visit(route('content.edit', [$content]))
            ->assertResponseStatus(200);
    }

    public function testUpdateContent() {
        $affiliate = $this->affiliateData();

        $content = factory(Content::class)->create([
            'affiliate_id' => $affiliate['affiliate']->id,
        ]);

        $request = $this->actingAs($affiliate['user'])
                        ->call('PUT', route('content.update', [$content]), [
                            'title' => 'tes',
                            'description' => 'abc'
                    ]);

        $this->assertEquals(302, $request->status());
        $this->assertEquals('Halaman Anda telah tersimpan.', session()->get('message-success'));
    }

    public function testProductPage()
    {
        $this->actingAs($this->affiliate)
            ->visit('/administration/affiliate-product')
            ->assertResponseStatus(200);
    }

    public function testUpdateProduct() {
        $affiliate = $this->affiliateData();

        $products = factory(App\Product::class, 3)->create();
        $affiliate['affiliate']->products()->sync($products);

        $request = $this->actingAs($affiliate['user'])
                        ->call('POST', route('affiliate-product.update'), [
                            'product_id' => $products->pluck('id'),
                    ]);

        $this->assertEquals(302, $request->status());
        $this->assertEquals('Produk Anda telah tersimpan.', session()->get('message-success'));
    }
}
