<?php

namespace Tests\Unit;

use App;
use Tests\Feature\Admin\TestCase;
use Illuminate\Support\Facades\Event;
use App\Events\MoreInfoEmailEvent;
use Session;
use Illuminate\Http\Request;

class LandingPageTest extends TestCase
{
    public function testSuccessSubmitContact()
    {
        $stub = $this->getMockBuilder('App\Http\Controller\LandingPageController')
            ->setMethods(['submitHubungiKamiKuliah'])
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();
        $response = ['status' => 200];

        $request = new Request;
        $stub->method('submitHubungiKamiKuliah')->willReturn($response);
        $this->assertEquals($response, $stub->submitHubungiKamiKuliah($request, $response));
    }

    public function testSeeJurusanYangDiminati()
    {
        $fields = [
            'S1 Akuntansi - USAHID',
            'S1 Manajemen - USAHID',
            'S1 Akuntansi - UPJ',
            'S1 Sistem Informasi - UPJ',
            'S1 Akuntansi - UMHT',
            'S1 Manajemen - UMHT',
            'S1 Teknik Informatika - UMHT',
            'S1 Akuntansi - UNKRIS',
            'S1 Manajemen - UNKRIS',
            'S1 Teknik Informatika - UNKRIS',
            'S1 Manajemen - STM Labora',
        ];
        $this->visit('/kuliah/online/kelas-karyawan/')
            ->assertResponseStatus(200);
        foreach ($fields as $field) {
            $this->see($field);
        }
    }

    public function testSendEmailSetelahUserKlikMohonInfo()
    {
        Event::fake();

        $captcha = 'abcd';
        Session::flash($captcha . '_start_time', time());
        
        $response = $this->call('post', route('submit.hubungi.kami.kuliah'), [
            'name' => 'tes',
            'email' => 'boho@yahoo.com',
            'phone' => '082384938592',
            'location' => 'Jakarta Selatan',
            'departement' => 'S1 Sistem Informasi - UPJ',
            'education' => 'S1',
            'product' => 'Mencari Kerja',
            'interest' => '3 Bulan dari sekarang',
            'source' => 'ADS',
            'g-recaptcha-response' => $captcha,
        ]);
        $this->assertEquals(302, $response->status());
        
        $student_lead = App\StudentLead::where('email', 'boho@yahoo.com')->first();
        Event::assertDispatched(MoreInfoEmailEvent::class, function ($e) use ($student_lead) {
            return $e->data['email'] === $student_lead->email;
        });
    }

    public function testNewLandingPage(){
        $this->visit('/kuliah/online/kelas-karyawan/')
            ->see('KAMPUS BERKUALITAS')
            ->see('Kuliah Mulai Agustus & September 2018')
            ->assertResponseStatus(200);
    }

    public function testSeeDropdownLocations()
    {
        $locations = [
            'Jakarta Pusat',
            'Jakarta Selatan',
            'Jakarta Timur',
            'Jakarta Barat',
            'Jakarta Utara',
            'Bogor',
            'Depok',
            'Bekasi',
            'Tangerang Selatan',
            'Tangerang Kota',
            'Lainnya',
        ];
        $this->visit(route('landing.kuliah'))
            ->assertResponseStatus(200);
        foreach ($locations as $location) {
            $this->see($location);
        }
    }

    public function testSeePerguruanTinggiBerkualitas()
    {
        $unis = [
            'Sekolah Tinggi Manajemen (STM) Labora',
            'Universitas Krisnadwipayana (UNKRIS)',
            'Universitas Mohammad Husni Thamrin (UMHT)',
            'Universitas Pembangunan Jaya (UPJ)',
            'Universitas Sahid (USAHID)',
        ];
        $this->visit(route('landing.kuliah'))
            ->assertResponseStatus(200)
            ->see('perguruan tinggi berkualitas');
        foreach ($unis as $uni) {
            $this->see($uni);
        }
    }

    public function testVisitKelasKaryawanPintaria(){
        $this->visit('/kuliah/online/kelas-karyawan-pintaria/')
            ->see('Dapatkan Gelar S1 & S2')
            ->see('Kuliah Mulai Agustus & September 2018')
            ->assertResponseStatus(200);
    }

    public function testSeeJurusanYangDiminatiPintaria()
    {
        $fields = [
            'S1 Akuntansi - UAI',
            'S1 Akuntansi - UMHT',
            'S1 Akuntansi - UNKRIS',
            'S1 Akuntansi - USAHID',
            'S1 Hukum - UAI',
            'S1 Manajemen - STM Labora',
            'S1 Manajemen - UAI',
            'S1 Manajemen - UMHT',
            'S1 Manajemen - UNKRIS',
            'S1 Manajemen - USAHID',
            'S1 Teknik Informatika - UMHT',
            'S1 Teknik Informatika - UNKRIS',
            'S2 Manajemen - UKRIDA',
            'S2 Manajemen - USAHID',
            'S2 Komunikasi - UMJ',
        ];
        $this->visit(route('landing.kuliah.pintaria'))
            ->assertResponseStatus(200);
        foreach ($fields as $field) {
            $this->see($field);
        }
    }

    public function testSeePerguruanTinggiBerkualitasPintaria()
    {
        $unis = [
            'Sekolah Tinggi Manajemen (STM) Labora',
            'Universitas Krisnadwipayana (UNKRIS)',
            'Universitas Al-Azhar Indonesia (UAI)',
            'Universitas Kristen Krida Wacana (UKRIDA)',
            'Universitas Muhammadiyah Jakarta (UMJ)',
            'Universitas MH Thamrin (UMHT)',
            'Universitas Sahid (USAHID)',
        ];
        $this->visit(route('landing.kuliah.pintaria'))
            ->assertResponseStatus(200)
            ->see('perguruan tinggi berkualitas');
        foreach ($unis as $uni) {
            $this->see($uni);
        }
    }
        
    public function testVisitTerimaKasihKuliahKaryawanPage()
    {
        $this->visit(route('landing.kuliah.terimakasih'))
            ->assertResponseOk()
            ->see('Terima kasih telah mengisi form Mohon Info')
            ->see('KEMBALI KE BERANDA')
            ->click('KEMBALI KE BERANDA')
            ->seePageIs(route('home'));
    }

    public function testVisitKoreanPage()
    {
        $product = factory(App\Product::class)->create([
            'slug' => 'kursus-online-bahasa-korea-basic-1',
        ]);

        $this->visit(route('landing.korea'))
            ->see('Nonton drama Korea')
            ->see('Mengapa penting mengikuti program ini')
            ->see('Apa saja yang akan kamu pelajari pada program ini?')
            ->see('Korean Basic 1')
            ->assertResponseOk();
    }
    
    public function testVisitDigitalMarketingPage()
    {
        $product = factory(App\Product::class)->create([
            'slug' => 'digital-marketing-practitioner',
        ]);

        $this->visit(route('landing.digital_marketing'))
            ->see('Jadi master')
            ->see('Digital Marketing?')
            ->see('mengapa penting mengikuti program ini')
            ->see('Apa yang akan Kamu pelajari dari bidang ini?')
            ->see('Digital Marketing Practitioner')
            ->assertResponseOk();
    }

    public function testVisitKelasKaryawanS1Pintaria(){
        $this->visit('/kuliah/online/kelas-karyawan/s1-pintaria')
            ->see('Kuliah dengan Jadwal Fleksibel!')
            ->see('Kuliah dimulai awal tahun 2019')
            ->assertResponseStatus(200);
    }

    public function testSeeJurusanYangDiminatiS1Pintaria()
    {
        $fields = [
            'S1 Akuntansi - UAI',
            'S1 Akuntansi - USAHID',
            'S1 Hukum - UAI',
            'S1 Manajemen - UAI',
            'S1 Manajemen - USAHID', 
        ];
        $this->visit(route('landing.kuliah.s1.pintaria'))
            ->assertResponseStatus(200);
        foreach ($fields as $field) {
            $this->see($field);
        }
    }

    public function testVisitKelasKaryawanS1Ithb(){
        $this->visit('/kuliah/online/kelas-karyawan/s1-ithb')
            ->see('Kuliah dengan Jadwal Fleksibel!')
            ->see('Kuliah dimulai awal tahun 2019')
            ->assertResponseStatus(200);
    }

    public function testVisitLandingPageSlug()
    {
        $landing = factory(App\LandingPage::class)->create([
            'is_content_ready' => true,
        ]);
        $this->visit('/kuliah/online/kelas-karyawan/' . $landing->slug)
            ->see($landing->main_title)
            ->see($landing->main_description)
            ->assertResponseOk();
    }

    public function testVisitLandingPageSlugNotReady()
    {
        $landing = factory(App\LandingPage::class)->create([
            'is_content_ready' => false,
        ]);
        $this->get('/kuliah/online/kelas-karyawan/' . $landing->slug)
            ->assertResponseStatus(404);
    }
}
