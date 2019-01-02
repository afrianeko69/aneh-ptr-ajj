<?php

namespace Tests\Unit;

use App;
use Artisan;
use Tests\TestCase;

class PageTest extends TestCase
{
    public function setUp() {
        parent::setUp();
    }

    public function testTentangKami()
    {
        $this->visit('/')
             ->click('Tentang Kami')
             ->seePageIs('/tentang-kami');
    }

    public function testPerjanjianPengguna()
    {
        $this->visit('/')
             ->click('Perjanjian Pengguna')
             ->seePageIs('/perjanjian-pengguna');
    }

    public function testKebijakanPrivasi()
    {
        $this->visit('/')
             ->click('Kebijakan Privasi')
             ->seePageIs('/kebijakan-privasi');
    }

    public function testHubungiKami() {
        $this->visit(route('hubungi.kami'))
            ->assertResponseStatus(200);
    }

    private function affiliateData($type) {
        $affiliate = factory(App\Affiliate::class)->create([
            'domain_url' => 'pintaria.dev',
            'logged_in_domain_url' => 'pintaria.dev',
        ]);

        $user = factory(App\User::class)->create([
            'affiliate_id' => $affiliate->id
        ]);

        factory(App\Page::class)->create([
            'affiliate_id' => $affiliate->id,
            'author_id' => $user->id,
            'slug' => $type,
        ]);

        return [
            'user' => $user,
            'affiliate' => $affiliate,
        ];
    }

    public function testAffiliateTentangKami() {
        $affiliate_data = $this->affiliateData('tentang-kami');

        $this->actingAs($affiliate_data['user'])
            ->visit(route('tentang.kami'))
            ->assertResponseStatus(200);
    }

    public function testAffiliatePerjanjianPengguna() {
        $affiliate_data = $this->affiliateData('perjanjian-pengguna');

        $this->actingAs($affiliate_data['user'])
            ->visit(route('perjanjian.pengguna'))
            ->assertResponseStatus(200);
    }

    public function testAffiliateKebijakanPrivasi() {
        $affiliate_data = $this->affiliateData('kebijakan-privasi');

        $this->actingAs($affiliate_data['user'])
            ->visit(route('kebijakan.privasi'))
            ->assertResponseStatus(200);
    }

    public function testHubungiKamiAffiliate() {
        $affiliate_data = $this->affiliateData('hubungi-kami');

        $this->actingAs($affiliate_data['user'])
            ->visit(route('hubungi.kami'))
            ->assertResponseStatus(200);
    }

    public function testSeePlaceholderGlobalSearch()
    {
        $affiliate_data = $this->affiliateData('tentang-kami');
        Artisan::call('db:seed', ['--class' => 'ContentsTableSeeder']);

        $this->actingAs($affiliate_data['user'])
            ->visit(route('tentang.kami'))
            ->see('Coba ketik "Data Science"')
            ->assertResponseStatus(200);
    }
}
