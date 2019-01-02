<?php

use Illuminate\Database\Seeder;
use App\Content;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = Content::firstOrNew([
            'key' => 'apa-itu-pintaria',
        ]);
        if (!$content->exists) {
            $content->fill([
                'key'           => 'apa-itu-pintaria',
                'title'         => 'APA ITU PINTARIA?',
                'description'   => 'PINTARIA ADALAH SEBUAH SITUS YANG MENAWARKAN PRODUK-PRODUK PENDIDIKAN DAN PELATIHAN YANG BERKUALITAS DENGAN BERBAGAI MACAM KATEGORI YANG DITUJUKAN UNTUK MASYARAKAT YANG INGIN MENINGKATKAN PENGETAHUAN DAN KEAHLIAN.'
            ])->save();
        }

        $content = Content::firstOrNew([
            'key' => 'tambah-pintar-dalam-60-detik',
        ]);
        if (!$content->exists) {
            $content->fill([
                'key'           => 'tambah-pintar-dalam-60-detik',
                'title'         => 'TAMBAH PINTAR DALAM 60 DETIK',
                'description'   => ''
            ])->save();
        }

        $content = Content::firstOrNew([
            'key' => 'punya-waktu-lebih-banyak',
        ]);
        if (!$content->exists) {
            $content->fill([
                'key'           => 'punya-waktu-lebih-banyak',
                'title'         => 'PUNYA WAKTU LEBIH BANYAK?',
                'description'   => ''
            ])->save();
        }

        $content = Content::firstOrNew([
            'key' => 'jadilah-partner-kami',
        ]);
        if (!$content->exists) {
            $content->fill([
                'key'           => 'jadilah-partner-kami',
                'title'         => 'JADILAH PARTNER KAMI!',
                'description'   => 'Anda menyelenggarakan program pendidikan atau kursus/pelatihan dan ingin menjangkau lebih banyak orang melalui e-learning? Hubungi kami untuk mendiskusikan kemungkinan kerjasama!'
            ])->save();
        }

        $content = Content::firstOrNew([
            'key' => 'ingin-informasi-lebih-lengkap',
        ]);
        if (!$content->exists) {
            $content->fill([
                'key'           => 'ingin-informasi-lebih-lengkap',
                'title'         => 'INGIN INFORMASI LEBIH LENGKAP?',
                'description'   => 'Anda ingin mendapatkan informasi lengkap seputar program kuliah atau kursus/pelatihan? Silahkan lengkapi formulir di bawah ini dan kami akan menghubungi Anda kembali.'
            ])->save();
        }

        $content = Content::firstOrNew([
            'key' => 'berlangganan-newsletter',
        ]);
        if (!$content->exists) {
            $content->fill([
                'key'           => 'berlangganan-newsletter',
                'title'         => 'BERLANGGANAN NEWSLETTER',
                'description'   => 'Dapatkan informasi terkini mengenai program kuliah dan kursus/pelatihan serta promosi yang kami tawarkan.'
            ])->save();
        }

        $content = Content::firstOrNew([
            'key' => 'homepage-seo-description',
        ]);
        if (!$content->exists) {
            $content->fill([
                'key'           => 'homepage-seo-description',
                'title'         => '',
                'description'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed elit diam nonummy nibh euismod tincidunt ut laoreet dolore magna aluam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci et tation diam nisl ut aliquip ex ea commodo consequat euismod tincidunt ut laoreet dolore magna aluam.

                    Lorem ipsum dolor sit amet, consectetuer euismod tincidunt ut laoreet dolore magna aluam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci et tation diam nisl ut aliquip ex ea commodo consequat euismod tincidunt ut laoreet dolore magna aluam.

                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed elit diam nonummy nibh euismod tincidunt ut laoreet dolore.'
            ])->save();
        }

        $content = Content::firstOrNew([
            'key' => 'search-placeholder',
        ]);
        if (!$content->exists) {
            $content->fill([
                'key'           => 'search-placeholder',
                'title'         => 'SEARCH PLACEHOLDER',
                'description'   => 'Coba ketik "Data Science"'
            ])->save();
        }
    }
}
