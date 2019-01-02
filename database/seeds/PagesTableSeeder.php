<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {

        $page = Page::firstOrNew([
            'slug' => 'hello-world',
        ]);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 0,
                'title'     => 'Hello World',
                'excerpt'   => 'Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.',
                'body'      => '<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>
                    <p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>',
                'image'            => 'pages/AAgCCnqHfLlRub9syUdw.jpg',
                'meta_description' => 'Yar Meta Description',
                'meta_keywords'    => 'Keyword1, Keyword2',
                'status'           => 'ACTIVE',
            ])->save();
        }
        
        $page = Page::firstOrNew([
            'slug' => 'hubungi-kami',
        ]);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 0,
                'title'     => 'Hubungi Kami',
                'excerpt'   => 'Anda menyelenggarakan program pendidikan atau pelatihan dan ingin menjangkau lebih banyak orang melalui e-learning? Hubungi kami untuk mendiskusikan kemungkinan kerjasama!',
                'body'      => 'Anda menyelenggarakan program pendidikan atau pelatihan dan ingin menjangkau lebih banyak orang melalui e-learning? Hubungi kami untuk mendiskusikan kemungkinan kerjasama!<br><br>

                    PT. Haruka Evolusi Digital Utama<br><br>

                    Office8, Level 18A<br>
                    Jl. Jenderal Sudirman Kav. 52-53 (access from Jl. Senopati Raya No. 8B)<br>
                    Sudirman Central Business District (SCBD)<br>
                    Jakarta Selatan - 12190<br>
                    info@pintaria.com',
                'image'            => '',
                'meta_description' => 'Anda menyelenggarakan program pendidikan atau pelatihan dan ingin menjangkau lebih banyak orang melalui e-learning? Hubungi kami untuk mendiskusikan kemungkinan kerjasama!',
                'meta_keywords'    => 'Hubungi kami',
                'status'           => 'ACTIVE',
            ])->save();
        }

        $page = Page::firstOrNew([
            'slug' => 'tentang-kami',
        ]);

        if (!$page->exists) {
            $page->fill([
                'author_id' => 0,
                'title'     => 'Tentang Kami',
                'excerpt'   => 'Tingkat pendidikan yang tinggi merupakan salah satu faktor penting dalam menentukan kemajuan suatu bangsa, termasuk bangsa Indonesia. Semua lapisan masyarakat, tanpa terkecuali, membutuhkan pendidikan dan pengetahuan yang cukup agar bangsa Indonesia semakin berkembang dan jauh dari kata kebodohan. HarukaEDU sebagai penyedia platform <i>online learning</i> di Indonesia menyadari akan kebutuhan ini dan untuk menjalankan perannya di dunia pendidikan secara maksimal, maka HarukaEDU meluncurkan Pintaria, sebuah portal pendidikan (edukasi) untuk bangsa Indonesia.',
                'body'      => '<h2>Cerita Di Balik Pintaria</h2>
                Tingkat pendidikan yang tinggi merupakan salah satu faktor penting dalam menentukan kemajuan suatu bangsa, termasuk bangsa Indonesia. Semua lapisan masyarakat, tanpa terkecuali, membutuhkan pendidikan dan pengetahuan yang cukup agar bangsa Indonesia semakin berkembang dan jauh dari kata kebodohan. HarukaEDU sebagai penyedia platform <i>online learning</i> di Indonesia menyadari akan kebutuhan ini dan untuk menjalankan perannya di dunia pendidikan secara maksimal, maka HarukaEDU meluncurkan Pintaria, sebuah portal pendidikan (edukasi) untuk bangsa Indonesia. <br><br>

                <h2>Pintaria Untuk Pendidikan Indonesia</h2>
                Pintaria adalah sebuah situs yang menawarkan produk-produk pendidikan dan pelatihan / kursus yang berkualitas dengan berbagai macam kategori yang ditujukan untuk masyarakat yang ingin meningkatkan pengetahuan dan keahlian.
                <br/><br/>
                Dengan mengakses Pintaria kamu akan mendapatkan:
                <ul>
                <li>Pengetahuan baru melalui video pembelajaran "Tambah Pintar Dalam 60 Detik" dan pelatihan / kursus online gratis</li>
                <li> Informasi program kuliah <i>online</i> (<i>blended learning</i>) yang diselenggarakan oleh perguruan tinggi terakreditasi</li>
                <li>Informasi program pelatihan / kursus yang akan memberikan keahlian praktikal yang berguna bagi pengembangan karir dan usaha mendapatkan pekerjaan</li>
                <li>Berita-berita terbaru di dunia pendidikan</li>
                </ul>
                Selamat menambah pengetahuan di Pintaria, Belajar Jadi Lebih Menyenangkan!',
                'image'            => '',
                'meta_description' => 'Tingkat pendidikan yang tinggi merupakan salah satu faktor penting dalam menentukan kemajuan suatu bangsa, termasuk bangsa Indonesia. Semua lapisan masyarakat, tanpa terkecuali, membutuhkan pendidikan dan pengetahuan yang cukup agar bangsa Indonesia semakin berkembang dan jauh dari kata kebodohan. HarukaEDU sebagai penyedia platform <i>online learning</i> di Indonesia menyadari akan kebutuhan ini dan untuk menjalankan perannya di dunia pendidikan secara maksimal, maka HarukaEDU meluncurkan Pintaria, sebuah portal pendidikan (edukasi) untuk bangsa Indonesia.',
                'meta_keywords'    => 'Tentang kami',
                'status'           => 'ACTIVE',
            ])->save();
        }


        $page = Page::firstOrNew([
            'slug' => 'perjanjian-pengguna',
        ]);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 0,
                'title'     => 'Perjanjian Pengguna',
                'excerpt'   => 'Pintaria adalah sebuah situs yang memberikan informasi produk-produk pendidikan dan pelatihan yang berkualitas dan ditujukan untuk masyarakat yang ingin meningkatkan pengetahuan',
                'body'      => 'Pintaria adalah sebuah situs yang memberikan informasi produk-produk pendidikan dan pelatihan yang berkualitas dan ditujukan untuk masyarakat yang ingin meningkatkan pengetahuan dan keahlian (selanjutnya disebut sebagai <b>“Situs”</b> atau <b>“Pintaria”</b>). <br><br>

            Syarat dan ketentuan sebagaimana tertera di bawah ini selanjutnya cukup disebut sebagai <b>"Perjanjian"</b>. Jika Anda tidak menyetujui Perjanjian ini, maka Anda dilarang untuk menggunakan Situs ini. Penggunaan Situs ini oleh Anda merupakan bentuk persetujuan Anda atas Perjanjian ini, di mana persetujuan tersebut tidak perlu dibuktikan lebih lanjut dengan hal apapun juga.<br><br>


            <b>1. Akun Pengguna</b><br><br>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">1.1.</span> Ketentuan umum mengenai Akun Pengguna:</div>
            <div style="padding-left:40px;">
                <ol>
                    <li>Anda wajib untuk membuat Akun Pengguna pada Situs untuk menggunakan layanan yang diberikan oleh Situs;</li>
                    <li>Akun Pengguna dibuat dengan mengikuti proses pendaftaran atau pembukaan akun pada Situs atau dengan cara lain yang ditentukan oleh Situs dari waktu ke waktu;</li>
                    <li>Anda harus menggunakan Akun Pengguna Anda dan kata sandi yang Anda tentukan untuk masuk pada Situs, mengakses layanan yang disediakan, mengelola informasi pribadi, dan melakukan hal lainnya pada Situs;</li>
                    <li>Melalui Perjanjian ini Anda menyatakan setuju dan berjanji untuk menjaga kerahasiaan dan keamanan Akun Pengguna dan/atau kata sandi yang digunakan untuk mengakses Akun Pengguna Anda;</li>
                    <li>Dengan ini Anda menyatakan dan menjamin bahwa semua informasi yang diberikan selama proses pendaftaran Akun Pengguna pada Situs adalah benar, tepat dan dapat dipertanggungjawabkan untuk setiap detilnya;</li>
                    <li>Anda dengan ini setuju dan bersedia untuk memberikan semua jenis dokumen identifikasi diri yang diminta oleh Situs untuk tujuan melakukan verifikasi atas identitas Anda;</li>
                    <li>Dengan membuat Akun Pengguna, Anda dengan ini menyatakan dan memberikan jaminan kepada Situs bahwa Anda telah berusia 21 (dua puluh satu) tahun, dan karenanya dapat membuat Perjanjian yang mengikat secara sah sesuai dengan hukum yang berlaku;</li>
                    <li>Ketentuan sebagaimana dimaksud dalam butir (g) di atas berlaku juga dalam hal pihak selaku pemilik Akun Pengguna memberikan kewenangan kepada pihak lain;</li>
                    <li>Apabila Anda membuat Akun Pengguna dan menggunakan layanan yang disediakan oleh Situs sebagai perwakilan dari suatu perusahaan, maka perusahaan terkait akan langsung terikat kepada Perjanjian ini. Perusahaan wajib bertanggung jawab atas semua tindakan perwakilannya tersebut.</li>
                </ol>
            </div>
            <br>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">1.2.</span> Penggunaan Akun Pengguna dalam Situs</div><br>
            <div style="padding-left:40px;">Anda setuju untuk menggunakan Akun Pengguna dalam Situs hanya untuk tujuan penggunaan layanan semata, dan bukan untuk tujuan yang lain. Anda dengan ini menjamin bahwa dalam mengakses Situs dan layanan yang disediakan, Anda tidak akan melakukan hal-hal yang termasuk namun tidak terbatas pada tindakan:<br/>
                <ol>
                    <li>menjual atau meminjamkan Akun Pengguna kepada pihak lain, kecuali sebagaimana dinyatakan dalam Pasal 1.1 butir (i) Perjanjian ini;</li>
                    <li>menggunakan Akun Pengguna untuk melakukan promosi layanan pihak pesaing Pintaria tanpa persetujuan tertulis terlebih dulu dari Pintaria;</li>
                    <li>menggunakan Akun Pengguna untuk melakukan tindakan melanggar hukum, berbuat curang, dan/atau menyebarluaskan surat elektronik dan/atau konten lainnya yang bersifat menyinggung, melecehkan, memfitnah, mencemarkan nama baik, mengganggu ketenangan, mengancam, memicu bahaya, vulgar, menimbulkan pertentangan SARA (Suku, Agama, Ras dan Antar-golongan), dan/atau hal-hal lainnya yang tidak pantas dan tidak sesuai dengan norma kesusilaan, dan/atau melanggar hukum dan peraturan perundang-undangan Indonesia;</li>
                    <li>menggunakan Akun Pengguna untuk memata-matai atau melecehkan orang lain dan atau meniru sebagai orang lain dengan cara apapun;</li>
                    <li>menggunakan Akun Pengguna untuk melanggar hak cipta, merek dagang, merek jasa, hak paten, hak desain industri, dan/atau Hak atas Kekayaan Intelektual lainnya dari pihak lain tanpa hak;</li>
                    <li>menggunakan Akun Pengguna untuk mengirim iklan, surat berantai, pesan yang bersifat spam,dan/atau segala jenis surat elektronik lain yang sekiranya tidak dikehendaki penerima;</li>
                    <li>memalsukan atau mengubah header atau informasi alamat yang terkandung dalam surat elektronik atau bentuk komunikasi manapun yang digunakan untuk korespondensi sehubungan dengan Situs atau terkait dengan penggunaan Layanan;</li>
                    <li>menggunakan Akun Pengguna untuk mengirim atau menyebarluaskan virus, spyware, malware atau file lainnya yang berpotensi bahaya, mengganggu ataupun merusak;</li>
                    <li>menggunakan Akun Penggunanya dengan cara-cara yang dapat menimbulkan kerusakan dan kerugian bagi Pintaria, dan/atau menghalangi Pengguna lain untuk mengakses Situs dengan sengaja atau secara lalai menggunakan Akun Penggunanya, sehingga menimbulkan penurunan performa Pintaria atau jasa bagi Pengguna lainnya;</li>
                    <li>menyalin, memproduksi ulang, mempublikasikan, menyebarluaskan secara utuh materi yang disajikan situs ini, baik berupa berita, informasi, data, gambar, foto dan logo, dengan cara apapun atau melalui media apapun, kecuali untuk digunakan sendiri dan tidak bersifat komersial;</li>
                    <li>setiap penggunaan selain yang telah diperkenankan harus mendapatkan persetujuan tertulis dari Pintaria. Situs ini tidak boleh digunakan untuk tujuan-tujuan yang melanggar hukum, norma dan hak-hak asasi manusia.</li>
                </ol>
            </div><br/>

            <b>2. Pembayaran dan Metodenya</b><br><br>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">2.1.</span> Ketika Anda memilih untuk menggunakan situs ini maka Anda setuju dan bersedia melakukan pembayaran dengan ketentuan sebagai berikut:</div>
            <div style="padding-left:40px;">
                <ol>
                    <li>Jumlah pembayaran akan ditentukan berdasarkan produk pilihan Anda;</li>
                    <li>Anda setuju untuk menanggung segala jenis pungutan pemerintah sehubungan dengan transaksi dalam situs Pintaria sesuai dengan peraturan yang berlaku;</li>
                    <li>Sistem pembayaran yang diterima oleh Pintaria hanya dengan penggunaan transfer bank dan kartu kredit dengan mengikuti metode transaksi yang ditetapkan;</li>
                    <li>Seluruh pembayaran yang telah Anda lakukan tidak dapat dikembalikan.</li>
                </ol>
            </div><br/>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">2.2.</span> Metode transaksi adalah sebagai berikut:</div>
            <div style="padding-left:40px;">
                <ol>
                    <li>Anda mencari produk pendidikan atau pelatihan yang Anda minati di Pintaria;</li>
                    <li>Setelah Anda menemukan produk yang Anda minati, Anda dapat melihat informasi lengkap mengenai produk tersebut, termasuk informasi biaya;</li>
                    <li>Setelah Anda login di Pintaria dengan menggunakan akun Anda, Anda dapat membeli suatu produk atau mengikuti program pendidikan atau pelatihan yang berbayar dengan menekan tombol Ikut Kelas yang akan mengarahkan Anda ke formulir Konfirmasi Pembayaran (dalam bentuk pop-up);</li>
                    <li>Pada formulir Konfirmasi Pembayaran, Anda diwajibkan memberikan informasi tambahan yang diminta (jika ada) dan memastikan bahwa produk yang Anda beli dan harga yang harus Anda bayarkan sudah benar sebelum menekan tombol Bayar;</li>
                    <li>Setelah Anda menekan tombol Bayar, Anda akan diarahkan kepada formulir Rincian Belanja dimana Anda dapat memeriksa kembali detil pesanan dan informasi Anda. Tekan tombol Lanjut, dan Anda akan diarahkan ke formulir Pilih Pembayaran;</li>
                    <li>Ikuti instruksi pembayaran yang ditampilkan;</li>
                    <li>
                        Pembayaran dengan kartu kredit:<br/>
                        <ol>
                            <li>Jika Anda membayar dengan menggunakan kartu kredit, transaksi pembayaran Anda akan diproses dan Anda akan mendapatkan konfirmasi status transaksi secara real time;</li>
                            <li>Jika transaksi pembayaran Anda berhasil, Anda akan diarahkan kepada halaman Kelas Saya dan dapat mulai mengikuti kelas Anda;</li>
                            <li>Jika transaksi pembayaran Anda gagal, Anda akan diminta untuk mengulang proses pembayaran.</li>
                        </ol>
                    </li>
                    <li>
                        Pembayaran dengan menggunakan transfer bank melalui ATM atau Internet Banking:<br>
                        <ol>
                            <li>Jika Anda membayar dengan menggunakan transfer bank melalui ATM atau Internet Banking, Anda akan mendapatkan instruksi lengkap untuk menyelesaikan proses pembayaran;</li>
                            <li>Setelah transaksi pembayaran Anda diproses, Anda akan menerima konfirmasi status transaksi pembayaran melalui e-mail.</li>
                            <li>Jika transaksi pembayaran Anda berhasil, Anda dapat mengunjungi halaman Kelas Saya dan dapat mulai mengikuti kelas Anda;</li>
                            <li>Jika transaksi pembayaran Anda gagal, silahkan mengulang proses pembelian dan pembayaran produk dari awal.</li>
                        </ol>
                    </li>
                </ol>
            </div><br>

            <b>3. Penghentian Layanan</b><br><br>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">3.1.</span>Tanpa mengesampingkan hak Pintaria yang timbul berdasarkan Perjanjian ini, Pintaria dapat menangguhkan atau menghentikan Akun Pengguna dan hak penggunaan Layanan Anda setiap saat, dengan atau tanpa pemberitahuan terlebih dahulu kepada pemilik Akun, berdasarkan pertimbangan Pintaria semata, termasuk namun tidak terbatas apabila:</div>
            <div style="padding-left:40px;">
                <ol>
                    <li>Pintaria berasumsi bahwa Anda telah melanggar salah satu kewajiban terhadap Pintaria seperti yang ditentukan berdasarkan Perjanjian ini dan/atau melanggar salah satu ketentuan dalam Perjanjian ini;</li>
                    <li>Pintaria mengasumsikan bahwa Anda menggunakan Akun Pengguna dengan tidak dengan itikad baik;</li>
                    <li>Anda menggunakan Akun Pengguna atau Layanan sebagai sarana untuk melakukan tindakan illegal atau penipuan, atau dengan cara yang menurut kebijakan Pintaria dianggap bersifat menyerang (ofensif), menyinggung, melanggar hukum, melecehkan, memfitnah, mencemarkan nama baik, menggangu ketenangan, menghina, mengancam, membahayakan, vulgar, cabul, tidak pantas, dan/atau menimbulkan pertentangan SARA (Suku, Agama, dan antar golongan);</li>
                    <li>Menurut pendapat dan pertimbangan Pintaria, pemberian akses penggunaan Layanan kepada Anda akan mengakibatkan beban yang berlebihan pada server atau layanan lain yang dimiliki Pintaria; </li>
                    <li>Menurut pendapat dan pertimbangan Pintaria, Anda melakukan tindakan yang melawan hukum dan/atau melakukan tindakan yang merugikan Pintaria.</li>
                </ol>
            </div><br>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">3.2.</span> Dalam hal Pintaria memutuskan untuk menghentikan Akun Pengguna dan hak penggunaan Layanan Anda, maka dengan demikian Perjanjian ini berakhir, dan Situs tidak memiliki kewajiban atau tanggung jawab kepada Anda dan Situs tidak akan mengembalikan setiap jumlah yang telah Anda bayar, sejauh yang diperbolehkan oleh hukum yang berlaku. Bagian ini akan diberlakukan sejauh yang diperbolehkan oleh hukum yang berlaku. Anda dapat mengakhiri Perjanjian setiap saat. Selanjutnya, Pintaria dan Anda sepakat untuk mengesampingkan ketentuan Pasal 1266 KUHPerdata dan pasal 1267 KUHPerdata mengenai Pengakhiran Perjanjian.</div><br>
            
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">3.3.</span> Anda setuju bahwa:</div>
            <div style="padding-left:40px;">
                <ol>
                    <li>Pintaria dapat menangguhkan Layanan sesuai dengan ketentuan yang tercantum di Pasal 3.1 Perjanjian setiap saat dengan pertimbangan-pertimbangan tertentu;</li>
                    <li>Penghentian Layanan dapat diterapkan bagi beberapa Layanan dan/atau untuk seluruh Layanan, dalam suatu periode tertentu maupun tanpa batas waktu; dan</li>
                    <li>Pintaria memiliki pertimbangan untuk mengaktifkan kembali Akun Pengguna dan Layanan bagi Anda sehubungan dengan penghentian yang Pintaria lakukan.</li>
                </ol>
            </div><br>

            <b>4. Kerahasiaan</b><br><br>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">4.1.</span> Pintaria dapat meminta informasi pribadi Anda termasuk namun tidak terbatas pada nama, informasi kontak dan/atau informasi keuangan Anda. Semua Informasi pribadi akan ditangani, dipergunakan, dijaga dan dirahasiakan sesuai dengan ketentuan hukum yang berlaku;</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">4.2.</span>Anda setuju untuk menggunakan informasi pribadi milik pihak lainnya yang didapatkan dari Situs atau penggunaan Layanan Pintaria, hanya untuk tujuan berinteraksi dengan mereka sehubungan dengan Layanan, terkecuali telah ada kesepakatan terpisah antara para pihak terkait;</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">4.3.</span>Anda dengan ini menyatakan menjamin kepada Pintaria dan rekanan Pintaria untuk mematuhi semua hukum dan peraturan perundang-undangan yang berlaku terkait kerahasiaan;</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">4.4.</span>Kewajiban untuk menjaga kerahasiaan Informasi Rahasia dari setiap pihak dalam Perjanjian ini adalah selama 3 (tiga) tahun terhitung sejak tanggal diungkapkannya Informasi Rahasia tersebut oleh pemiliknya;</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">4.5.</span>Anda bertanggung jawab terhadap segala resiko dan akibat yang timbul dari kesalahan dan/ atau kelalaian dalam memenuhi ketentuan Pasal ini.</div>
            <br>

            <b>5. Batasan Tanggung Jawab</b><br><br>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">5.1.</span> Anda dengan ini menyatakan memahami dan mengakui bahwa Pintaria dan rekanan Pintaria tidak pernah membuat jaminan bahwa Layanan yang disediakan akan bebas dari kesalahan;</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">5.2.</span> Anda dengan ini menyatakan setuju bahwa Pintaria dan rekanan Pintaria tidak akan bertanggung jawab atas semua kerugian baik langsung maupun tidak langsung yang terkait dengan segala kegagalan, atau penundaan penyediaan Layanan, ataupun sehubungan dengan pemenuhan kewajiban Pintaria berdasarkan Perjanjian ini, dimana kegagalan dan/atau penundaan yang terjadi merupakan akibat langsung atau tidak langsung dari:</div>
            <div style="padding-left:40px;">
                <ol>
                    <li>Peristiwa force majeure termasuk namun tidak terbatas pada: kebakaran, gempa bumi, badai, banjir, angin topan, cuaca buruk atau bencana alam lainnya, perang, aksi terorisme, peledakan, sabotase, kecelakaan kerja, aksi mogok buruh, dan/atau kebijakan Pemerintah;</li>
                    <li>Kegagalan telekomunikasi, kegagalan hardware dan/atau kegagalan perangkat lunak yang disediakan oleh Pihak Ketiga untuk berfungsi sesuai dengan spesifikasinya;</li>
                    <li>Kenaikan permintaan yang signifikan dibebankan pada Layanan di atas permintaan normal, yang mengakibatkan perangkat lunak dan perangkat keras Pintaria gagal berfungsi sebagaimana biasanya;</li>
                    <li>Kegagalan Pihak Ketiga (termasuk namun tak terbatas pada bank dan/atau lembaga keuangan lainnya) untuk memenuhi kewajiban sehubungan dengan transaksi atau pengembalian yang diatur dalam Perjanjian ini, atau</li>
                    <li>Keadaan atau peristiwa lain yang serupa dengan yang telah disebutkan di atas,yang berada di luar kendali Pintaria.</li>
                </ol>
            </div><br/>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">5.3.</span> Anda dengan ini mengakui dan menyetujui bahwa Pintaria dan rekanan Pintaria tidak memiliki kewajiban atau tanggung jawab untuk setiap resiko, kerugian, biaya dan/atau pengeluaran yang berasal dari:</div>
            <div style="padding-left:40px;">
                <ol>
                    <li>Setiap peristiwa yang disebutkan dalam Pasal 5.2 Perjanjian ini, atau</li>
                    <li>Penggunaan atau akses yang tidak sah dengan menggunakan Akun Pengguna atau Akun Pintaria.</li>
                </ol>
            </div><br/>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">5.4.</span> Anda dengan ini mengakui dan menyetujui bahwa Pintaria dan rekanan Pintaria tidak pernah dan tidak akan pernah membuat pernyataan atau jaminan tersirat dalam kaitannya dengan Layanan maupun produk dan/atau jasa lainnya yang disediakan dalam Situs berdasarkan Perjanjian ini, selain dari jaminan yang secara tegas tercantum dalam Perjanjian ini. Sesuai dengan Pasal 5.7 Perjanjian ini, apapun istilah yang secara tersirat terdapat dalam Perjanjian ini, termasuk namun tak terbatas pada kondisi atau garansi, dengan ini dikecualikan.</div><br>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">5.5.</span> Anda dengan ini menyatakan setuju bahwa Pintaria dan rekanan Pintaria tidak akan bertanggung jawab pada Pihak Ketiga untuk segala jenis kerusakan, kerugian, atau kehilangan tidak langsung, khusus, insidental, atau konsekuensial termasuk namun tidak terbatas pada kehilangan keuntungan, kontrak, pendapatan, data yang timbul dari atau sehubungan dengan penyediaan Layanan atau produk dan/atau jasa lainnya yang diatur berdasarkan Perjanjian ini.</div><br>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">5.6.</span> Anda dengan ini memahami dan setuju bahwa penggantian untuk kerugian langsung yang diakibatkan oleh kesalahan Pintaria, hanyalah terkait dengan nilai pembayaran yang telah Anda bayarkan dikurangi semua biaya pemrosesan dan transaksi yang terjadi.</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">5.7.</span> Semua Syarat dan Ketentuan dari Perjanjian ini,yang membatasi atau mengecualikan istilah, ketentuan atau syarat apapun, baik yang tersurat maupun tersirat, serta segala tanggung jawab Pintaria, akan berlaku sejauh yang diijinkan oleh hukum. Dan tiap pengesampingan atau pelepasan terhadap suatu pelanggaran Anda bukan ditafsirkan sebagai pelepasan terhadap pelanggaran berikutnya oleh Anda termasuk juga pelepasan terhadap suatu upaya hukumnya.</div><br/>

            <b>6. Pembatasan, Pengecualian, dan Pelepasan Tertentu</b><br><br>

            <span style="padding-left:15px; display:inline-block;">
                Anda bertanggung jawab atas pembuatan, penyimpanan, dan pencadangan seluruh catatan Anda.Perjanjian ini dan pendaftaran atau penggunaan Situs tidak dapat dikonstruksikan untuk menimbulkan tanggung jawab Situs ini dan pengelolanya untuk menyimpan, membuat cadangan, memelihara, atau memberikan akses atas informasi atau data apapun dari waktu ke waktu.<br><br>
                Situs telah melakukan upaya teknis yang wajar untuk memberikan pengamanan atas data Anda dari risiko kehilangan atau akses, penggunaan, perubahan, dan pengungkapan oleh pihak yang tidak berwenang. Namun, kami tidak dapat menjamin bahwa pihak ketiga yang tidak berwenang tidak akan mampu melewati pengamanan tersebut atau menggunakan informasi pribadi Anda untuk maksud yang tidak sepantasnya. Anda mengetahui bahwa Anda memberikan informasi pribadi atau informasi terkait pihak yang Anda wakili, dengan risiko Anda sendiri.<br><br>
                Situs tidak bertanggung jawab, dan Anda setuju untuk tidak menuntut pertanggungjawaban Situs atau pengelolanya, untuk kerusakan atau kerugian apapun yang diakibatkan dari atau sehubungan dengan Perjanjian ini, termasuk namun tidak terbatas pada:
            </span>
            <div style="padding-left:15px;">
                <ol>
                    <li>Penggunaan atau tidak dapat digunakannya Situs oleh Anda;</li>
                    <li>Penundaan atau gangguan pada Situs;</li>
                    <li>Virus atau perangkat lunak merusak lainnya yang didapatkan dengan mengakses atau terhubung dengan Situs;</li>
                    <li>Kesalahan, kerusakan, kekeliruan, atau ketidakakuratan jenis apapun pada Situs;</li>
                    <li>Kerusakan pada perangkat keras Anda dari penggunaan Situs;</li>
                    <li>Skorsing atau tindakan lain yang dilakukan terhadap akun Anda; atau</li>
                    <li>Kebergantungan Anda pada kualitas, akurasi, atau kehandalan Situs dan fitur-fitur di dalamnya.</li>
                </ol>
            </div><br/>

            <b>7. Hukum yang Berlaku dan Jurisdiksi</b><br><br>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">7.1</span> Perjanjian ini diatur dan ditafsirkan berdasarkan hukum Negara Republik Indonesia.</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">7.2</span> Sengketa yang timbul dari atau berkaitan dengan Perjanjian ini atau pelaksanaannya, termasuk keberlakuan atau keabsahan Perjanjian ini termasuk Bagian ini, ruang lingkup, arti, penyusunan, intepretasi atau pelaksanaannya, sedapat mungkin dapat diselesaikan secara damai melalui musyawarah dan diskusi antara Para Pihak.</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">7.3</span> Apabila penyelesaian secara damai gagal, sengketa, kontroversi atau konflik tersebut akan diselesaikan melalui Badan Arbitrase Nasional Indonesia.</div><br/>
            
            <b>8. Lain-lain</b><br><br>

            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">8.1</span> Perjanjian ini (beserta seluruh dokumen yang disebut di sini atau dibuat secara serentak oleh Para Pihak sehubungan dengan Perjanjian ini) merupakan keseluruhan kesepakatan antara Para Pihak dan mengesampingkan segala kesepakatan yang ada sebelumnya atau pengaturan antara mereka sehubungan dengan hal yang menjadi pokok Perjanjian, dengan ini dinyatakan pula bahwa tidak ada perubahan atas Perjanjian ini yang akan berlaku efektif kecuali bila dibuat secara tertulis dan ditandatangani oleh wakil yang sah dari Para Pihak.</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">8.2</span> Apabila kapanpun terdapat ketentuan dari Perjanjian ini yang terbukti menjadi ilegal, tidak sah, maupun tidak dapat dilaksanakan, legalitas, keabsahan, pelaksanaan dari ketentuan yang lain tidak akan dalam hal apapun terpengaruh atau terkurangi karenanya, dan Para Pihak akan segera membuat perubahan yang, beserta ketentuan lainnya yang masih tersisa, akan menimbulkan kewajiban dan hak Para Pihak mendekati serupa dengan ketentuan yang telah dinyatakan ilegal, tidak sah dan tidak dapat dilaksanakan tersebut.</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">8.3</span> Tidak ada kegagalan untuk melaksanakan atau penundaan pelaksanaan Perjanjian ini, suatu hak, kuasa atau perbaikan oleh salah satu pihak sebagaimana berdasarkan hukum yang berlaku atau Perjanjian ini, yang dapat mengakibatkan adanya pengesampingan atas hak, kuasa atau perbaikan berdasarkan hukum atau dalam Perjanjian ini, atau mengurangi hak, kuasa atau perbaikan tersebut. Tidak ada satu atau sebagian pelaksanaan hak, kuasa atau perbaikan dapat menghindari atau mengurangi pelaksanaan atau pelaksanaan lanjutan dari hak, kuasa atau perbaikan tersebut berdasarkan hukum atau Perjanjian ini.</div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">8.4</span> Syarat-syarat di atas dapat berubah sewaktu-waktu apabila diperlukan, Anda disarankan untuk memeriksa halaman ini secara berkala agar perubahannya dapat Anda ketahui. </div><br/>
            <div style="margin-left:15px;padding-left:25px;position:relative"><span class="numbering">8.5</span> Dengan tetap mengakses atau menggunakan situs ini setelah adanya perubahan, berarti Anda menyetujui syarat-syarat yang telah diubah oleh Pintaria. </div><br/>',
                'image'            => '',
                'meta_description' => 'Pintaria adalah sebuah situs yang memberikan informasi produk-produk pendidikan dan pelatihan yang berkualitas dan ditujukan untuk masyarakat yang ingin meningkatkan pengetahuan',
                'meta_keywords'    => 'Perjanjian Pengguna',
                'status'           => 'ACTIVE',
            ])->save();
        }

        $page = Page::firstOrNew([
            'slug' => 'kebijakan-privasi',
        ]);
        if (!$page->exists) {
            $page->fill([
                'author_id' => 0,
                'title'     => 'Kebijakan Privasi',
                'excerpt'   => 'Kami menyadari bahwa privasi Anda adalah penting.  Pintaria dapat meminta informasi pribadi Anda termasuk namun tidak terbatas pada nama, informasi kontak dan/atau informasi keuangan Anda. Semua Informasi pribadi akan ditangani, dipergunakan, dijaga dan dirahasiakan sesuai dengan ketentuan hukum yang berlaku. Detil kebijakan kerahasiaan dapat dibaca pada dokumen Perjanjian Pengguna',
                'body'      => 'Kami menyadari bahwa privasi Anda adalah penting.  Pintaria dapat meminta informasi pribadi Anda termasuk namun tidak terbatas pada nama, informasi kontak dan/atau informasi keuangan Anda. Semua Informasi pribadi akan ditangani, dipergunakan, dijaga dan dirahasiakan sesuai dengan ketentuan hukum yang berlaku. Detil kebijakan kerahasiaan dapat dibaca pada dokumen <a href="'.url('/perjanjian-pengguna').'">Perjanjian Pengguna</a>.
                    <br/><br/>
                    Pintaria berusaha untuk mempertahankan standar tertinggi kesopanan, keadilan dan integritas dalam semua operasi kami. Demikian juga, kami berdedikasi untuk melindungi para pelanggan kami, konsumen dan privasi pengunjung online di situs kami.  ',
                'image'            => '',
                'meta_description' => 'Kami menyadari bahwa privasi Anda adalah penting.  Pintaria dapat meminta informasi pribadi Anda termasuk namun tidak terbatas pada nama, informasi kontak dan/atau informasi keuangan Anda. Semua Informasi pribadi akan ditangani, dipergunakan, dijaga dan dirahasiakan sesuai dengan ketentuan hukum yang berlaku. Detil kebijakan kerahasiaan dapat dibaca pada dokumen Perjanjian Pengguna',
                'meta_keywords'    => 'Kebijakan Privasi',
                'status'           => 'ACTIVE',
            ])->save();
        }

    }
}
