<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\KategoriDaerah;
use App\Models\KategoriProduk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBerita::create([
            'nama' => 'Seni dan Budaya',
            'slug' => 'seni-dan-budaya'
        ]);

        KategoriBerita::create([
            'nama' => 'Alam dan Wisata',
            'slug' => 'alam-dan-wisata'
        ]);

        KategoriBerita::create([
            'nama' => 'Sosial dan Masyarakat',
            'slug' => 'sosial-dan-masyarakat'
        ]);

        Berita::create([
            'judul' => 'Desa Kamasan Klungkung Dikembangkan Menjadi Desa Wisata',
            'slug' => 'desa-kamasan-klungkung-dikembangkan-menjadi-desa-wisata',
            'foto' => 'image.jpg',
            'id_kategori_berita' => 1,
            'id_user' => 1,
            'deskripsi' => '<p>Kamasan, salah satu desa di kabupaten Klungkung memiliki nilai historis cikal bakal perkembangan seni lukis tradisional di Bali, kini dikembangkan menjadi desa wisata.</p><p>"Bupati Klungkung I Nyoman Suwirta telah melihat dari dekat fasilitas pendukung desa wisata itu, terutama kamar yang bisa disewakan kepada tamu dan dimiliki masing-masing rumah tangga", kata kepala Dinas Pariwisata Kabupaten Klungkung I Nengah Sukasta, di Semarapura, Rabu.</p><p>Bupati Suwirta dalam kunjungannya ke Desa Kamasan, Selasa (19/9), juga melihat usaha mikro kecil dan menengah (UMKM) berkaitan dengan seni kerajinan serta seni lukisan yang ditekuni sebagian besar masyarakat Desa Kamasan. Kunjungan itu dilakukan untuk mengetahui kesiapan Desa Wisata Kamasan dalam melakukan percepatan pelaksanaan Desa Wisata dan City Tour Kota Semarapura, ibu kota Kabupaten Klungkung.</p><p>Bupatu Suwirta mengecek satu per satu fasilitas terutama kamar, agar nantinya bisa memenuhi persyaratan untuk tamu menginap di desa wisata, terutama pendingin ruangan (AC) harus ada dalam kamar agar tamu bisa merasa nyaman. menurutnya, upaya itu memerlukan dukungan, dan masyarakat maupun Dinas Pariwisata perlu selalu saling berkoordinasi.</p><p>Bupati Suwirta menugaskan Dinas Pariwisata dan jajarannya untuk melakukan pendataan dan menyiapkan fasilitas yang diperlukan dengan baik.</p><p>"Segera kumpulkan masyarakat untuk melakukan pendataan dan menyiapkan fasilitas kamar, UMKM maupun fasilitas yang lainnya agar nantinya tamu yang berkunjung bisa merasakan nyaman," ujar Bupati Suwirta.</p><p>Ia mengharapkan masyarakat lebih produktif untuk bersama-sama melakukan persiapan dengan baik, agar Desa Wisata Kamasan segera direalisasikan. Peluncuran desa wisata tersebut sekaligus kesiapan menerima wisatawan diharapkan pada 20 Oktober mendatang. Potensi Desa Wisata Kamasan terutama lukisan wayang, perak serta lingkungan yang bersih dan tertata baik. Semua desa di Kabupaten Klungkung, termasuk di Nusa Penida, sebuah pulau yang terpisah dengan daratan Bali, diharapkan dapat menggali potensi yang ada untuk dikembangkan sebagai upaya mengangkat tingkat kesejahteraan masyarakat, ujar Bupati Suwirta. (WDY)</p>',
        ]);

        Berita::create([
            'judul' => 'Lukisan Wayang Kamasan Klungkung Satu-Satunya Wbtb Asal Bali Yang Berpeluang Diusulkan Ke UNESCO',
            'slug' => 'lukisan-wayang-kamasan-klungkung-satu-satunya-wbtb-asal-bali-yang-berpeluang-diusulkan-ke-unesco',
            'foto' => 'image.jpg',
            'id_kategori_berita' => 1,
            'id_user' => 1,
            'deskripsi' => '<p>Lukisan Klasik Wayang Kamasan berpeluang untuk diusulkan pemerintah pusat sebagai Warisan BudayaTak Benda ( WBTB) Dunia asal Indonesia. Seni lukis khas Desa Kamasan, Klungkung ini, tengah bersaing dengan 9 WBTB dari daerah lainnya di Indonesia, untuk dapat diusulkan sebagai WBTB Dunia ke Unesco (Scientific and Cultural Organization).</p><p>Kepala Dinas Kebudayaan Klungkung, Ida Bagus Jumpung Oka Wedhana menjelaskan, Lukisan Wayang Klasik Kamasan sudah ditetapkan sebagai WBTB Nasional sejak tahun 2015 lalu. Pada tahun 2018, dari pemerintah pusat sempat mengusulkan Wayang Kamasan untuk WBTB Dunia asal Indonesia ke Unesco. Namun ketika itu seni lukis yang sudah ada sejak abad ke-14 ini, belum ditetapkan senagai WBTB Dunia oleh Unesco.</p><p>"Tahun ini pemerintah pusat kembali akan mengusulkan Lukisan Klasik Wayang Kamasan untuk menjadi WBTB Dunia dari Indonesia oleh Unesco. Kemarin sudah dilakukan pemaparan langsung oleh Bupati Klungkung, I Nyoman Suwirta saat rapat bersama Kementerian Pendidikan, Kebudayaan, Riset dan Teknologi (Kemendikbudristek) Republik Indonesia secara virtual terkait hal ini," ujar Ida Bagus Jumpung Oka Wedhana saat ditemui di kantornya, Rabu 16 Februari 2022 kemarin.</p><p>Ia menuturkan, penetapan warisan budaya dunia oleh Unesco dilakukan 2 tahun sekali. Tahun ini, Lukisan Klasik Wayang Kamasan harus bersaing dengan 9 WBTB dari berbagai daerah lainnya di Indonesia untuk diusulkan ke Unesco, antara lain Rendang, Babiola, Ulos, Pempek, Tempe, Jamu, Tenun, Reog, dan kulintang. " Nanti setiap negara hanya mengusulkan satu WBTB untuk diusulkan ke Unesco. Semoga saja Lukisan Klasik Wayang Kamasan yang terpilih, karena ini satu-satunya WBTB asal Bali untuk tahun ini yang berpeluang diusulkan ke Unesco," ungkap Ida Bagus Jumpung, didampingi Kabid Cagar Budaya, I Wayan Sudharma.</p><p>Pihaknya pun sangat berharap Lukisan Klasik Wayang Kamasan dapat ditetapkan warisan budaya dunia oleh Unesco. Dengan pengakuan dan Hak Paten dari Unesco, berimbas pada terangkatnya nilai ekonomis lukisan dan dampaknya juga dapat meningkatkan kesejahteraan para seniman Lukisan Klasik Wayang Kamasan. "Sama seperti Subak yang dapat pengakuan dan hak paten sebagai warisan budaya oleh Unesco, bisa jadi kebanggaan bagi masyarakat. Semoga nanti Lukisan Klasik Wayang Kamasan juga bisa ditetapkan sebagai Warisan Budaya dunia," harapnya.</p><p>Seni Luisan Klasik Wayang Kamasan, merupakan seni lukis yang berkembang dari Desa Kamasan Klungkung. Seni lukis ini diyakini sudah berkembang pada jaman Kerajaan Gelgel pada abad ke-14. Saat ini lukisan Wayang Kamasan masih bisa ditemui pada ornamen di plavon Kerta Gosa. Pewarnaan</p><p><strong>Maestro Seni Lukisan Wayang Kamasan Tingggal 10 Orang</strong></p><p>Saat ini maestro seni Lukisan Klasik Wayang Kamasan masih tersisa 10 orang, di antaranya Mangku Malendra dan&nbsp;Mangku Nengah Muriati. Meski demikian, para pelukis muda banyak bermunculan untuk melestarikan seni lukis ini.</p><p>Kabid Cagar Budaya di Dinas Kebudayaan Klungkung, Wayan Sudharma menjelaskan, satu ciri khas Lukisan Klasik Kamasan adalah motifnya, dan mengambil cerita pewayangan. Biasanya diambil dari epos MahaBrata, Ramayan, Cerita Tantri, maupun diambil dari Kitab Sutasoma dan lainnya.</p><p>"Para pelukis di Kamasan berkomitmen mempertahankan ciri khas lukisannya. Namun cerita yang diangkat berkembang dengan tidak menghilangkan pakem lukisan yang sudah menjadi warisan leluhurnya," jelas Sudharma.</p><p>Perkembangan yang dimaksud, misalnya melukis dengan mengutip dari kajian lontar, maupun tentang sastra agama.&nbsp;"Namun tetap mengutakan roh dari Lukisan Kamasan. Yakni mengedepankan cerita, dibandingkan estetika, maupun seni karena gaya ini yang membikin Lukisan Kamasan terkenal, selain memang tampilan yang terlihat klasik," jelas Sudharma.</p>',
        ]);

        Berita::create([
            'judul' => 'Pariwisata Bali: Makin Fokus Kembangkan Desa Wisata, Ini Targetnya Untuk Kamasan Klungkung',
            'slug' => 'pariwisata-bali:-makin-fokus-kembangkan-desa-wisata,-ini-targetnya-untuk-kamasan-klungkung',
            'foto' => 'image.jpg',
            'id_kategori_berita' => 1,
            'id_user' => 1,
            'deskripsi' => '<p>Pengembangan desa wisata makin hangat diperbincangkan. Di Bali, potensi desa wisata di Kamasan layak untuk mendapat perhatian lebih. Bupati Klungkung, I Nyoman Suwirta, mendorong pengembangan potensi desa tersebut dengan memberikan saran, evaluasi dan semangat kepada perangkat desa setempat.</p><p>"Apa yang sudah ada kita akan inventarisir, lalu secepatnya kita akan melakukan langkah-langkah kecil yang mampu mem-branding dan membangkitkan Desa Wisata Kamasan," kata Bupati Suwirta dalam keterangan tertulis Humas Pemkab setempat, Rabu (16/3).</p><p>Didampingi Kadis Pariwisata Kabupaten Klungkung, Anak Agung Gde Putra Wedana, saat berkunjung ke Kamasan (15/3), Suwirta meninjau homestay, tempat makan, Rumah BUMN, hingga Wayang Klasik Kamasan. Saat itu juga, Bupati Suwirta langsung menugaskan Perbekel Desa Kamasan, I Gede Putra Artawan, untuk mengimbau warga setempat agar bersama-sama selalu menjaga kebersihan lingkungan.</p><p>Pengelolaan sampah yang dimaksud adalah bagaimana cara memilah sampah dari masing-masing rumah. "Kebersihan lingkungan menjadi prioritas utama dalam mengembangkan desa wisata, jadi mari bersama-sama jaga kebersihan dengan sebaik-baiknya agar tamu yang nanti berkunjung kesini bisa merasakan kenyamanan," harapnya.</p><p>Terkait promosi Wayang Klasik Kamasan, Bupati Suwirta berharap konsep marketing agar terus dilakukan dengan sebaik-baiknya. Dari anak-anak muda hingga dewasa agar ikut membantu mempromosikan lewat media sosial (medsos). "Dari kita lihat Wayang Klasik Kamasan tidak perlu diragukan lagi. Nah, tinggal sekarang membranding ini," katanya.</p><p>Dalam waktu dekat ini, Klungkung akan mengadakan Festival Semarapura. Melalui kegiatan ini, Wayang Klasik diharapkan bisa turut dipromosikan. “Mungkin 75 persen itu lewat digital dan 25 persen langsung. Semoga langkah ini nantinya terus bisa berjalan dengan lancar,” lanjutnya.</p>',
        ]);

        Berita::create([
            'judul' => 'Kisah Wayan Pande Sumantra, Maestro Wayang Klasik Kamasan',
            'slug' => 'kisah-wayan-pande-sumantra,-maestro-wayang-klasik-kamasan',
            'foto' => 'image.jpg',
            'id_kategori_berita' => 1,
            'id_user' => 1,
            'deskripsi' => '<p>Lukisan wayang Kamasan mengalami masa keemasan pada abad ke-16 di bawah pemerintahan Kerajaan Gelgel.</p><p>Seorang pelukis wayang klasik Kamasan, Wayan Pande Sumantra tak pernah menyurutkan talentanya membuat karya seni di tengah pandemi COVID-19, dan berharap melalui kegiatan nasional dan internasional di Pulau Dewata, mampu membangkitkan pelaku usaha mikro kecil dan menengah (UMKM). "Saya berharap melalui kegiatan nasional dan internasional, seperti ajang Presidensi G20 dan putaran kedua BRI Liga 1 di Bali sejak bulan Januari 2022 lalu menjadi angin segar dan harapan bagi roda pergerakan pelaku usaha di Bali, khususnya UMKM untuk membangkitkan perekonomian akibat pandemi," kata pemilik Sanggar Sinar Pande, Wayan Pande Sumantra di Klungkung, Bali, Senin.</p><p>Wayan Sumantra bersama istrinya Made Sinarwati sejak tahun 1997 hingga sekarang memproduksi kerajinan khas daerah Desa Kamasan, Klungkung khususnya kerajinan yang bercorak lukisan tradisional wayang Kamasan. Pria kelahiran 56 tahun lalu menjelaskan, jenis produknya kerajinan, antara lain alat-alat upacara, kipas, tas, sandal, kap lampu tidur, kipas wayang berbahan kayu, keben (tepat sesaji) bermotif wayang kamasan, kipas wayang kain, gantungan kunci dan produk lainnya dengan tetap bertema lukisan Wayang Kamasan yang layak dijadikan sovenir.</p><p>Wayan Sumantra punya obsesi dan misi mulia untuk menunjang keberlangsungan sanggarnya, saat ini sanggar miliknya membimbing 35 anak usia dini secara sukarela tanpa memungut biaya apa pun untuk belajar melukis dan mewarnai di rumah yang ia jadikan sanggar itu. Ia mengatakan keberadaan sanggar ini bertujuan untuk pelestarian seni lukis tradisional wayang Kamasan. "Kami ingin mencetak generasi penerus seni lukisan wayang Kamasan. Semua anak-anak belajar disini gratis. Saya bersyukur ada anak-anak mau belajar seni lukis tersebut," katanya.</p><p>Wayan Sumantra menuturkan sejak pandemi COVID-19 pendapatannya jauh menurun. Dulu ada saja pesanan untuk membuat souvenir. Bahkan sebelum pandemi kunjungan ke sanggarnya cukup ramai. "Jadi yang berkunjung dari berbagai kalangan, siswa, mahasiswa, wisatawan maupun kolektor seni lukis. Namun sekarang sejak pandemi belum ada," ucapnya.</p><p>Karya kerajinan Wayan Sumantra terus berkembang dimulai dari hanya menjual produk lukisan Wayang Kamasan bertema cerita perwayangan seperti Mahabharata, Ramayana, dan Dewa Dewi. Dikatakannya wayang Kamasan ini banyak disukai kolektor, optimistis ke depannya. Keberadaan wayang Kamasan sudah ada dari zaman kerajaan di Puri Gelgel, kami menampilkan cerita pewayangan untuk memetik filsafat kehidupan dari cerita yang digambarkan.</p><p>Wayan Sumantra menuturkan sudah menekuni kesenian Wayang Kamasan sejak usia sekolah dasar dengan belajar secara otodidak dari pamannya, demi membantu orang tua. "Saya sejak kelas 4 SD diajarkan paman saya yang merupakan maestro Wayang Kamasan alamarhum I Nyoman Mandra. Saya melukis, usia SMP saya sudah bisa menjual sketsa lukisan ke ibu-ibu rumah tangga di lingkungan tempat saya tinggal," katanya seperti dilansir Antara.</p><p>Maestro pelukis Kamasan</p><p>Sejak Nyoman Mandra, pamannya yang juga maestro pelukis klasik wayang Kamasan meninggal, Wayan Sumantra semangat untuk mendirikan sanggar, karena seni lukisan tak boleh hilang dari peradaban zaman. Seni lukis tradisional ini harus ada generasi penerusnya dan dilestarikan sebagai warisan budaya leluhur. "Wayang Kamasan sudah ada dari zaman dulu, bahkan zaman kerajaan Klungkung sudah ada. Saya sebagai generasi penerus melanjutkan agar tetap lestari. Saya kerap diundang Dinas Kebudayaan dalam hal pelestarian dan pengenalan budaya wayang Kamasan melalui pameran khusus, satu-satunya di Bali bahkan dunia hanya di sini," ucapnya.</p><p>Ia mengatakan dalam pelestarian seni lukis Kamasan, kalau bukan kita, siapa lagi yang memperjuangkan, salah satunya dengan cara membuat sanggar lukis agar bisa menarik anak-anak di desa belajar seni lukis tersebut," kata dia. Menyinggung lukisan Kamasan, kata dia, lukisannya sudah tersebar di Tanah Air, bahkan ke sejumlah negara di dunia, seperti, Asia, Eropa dan Amerika Serikat.</p><p>Untuk pemasaran produk kerajinan, tidak hanya terbatas di pasar lokal saja, Pande juga merambah pasar nasional Indonesia bahkan sampai ke mancanegara seperti Eropa dan Amerika. Wayan Sumantra mengaku pihaknya aktif mengikuti pameran-pameran yang diadakan oleh kabupaten dan Provinsi Bali melalui Pesta Kesenian Bali (PKB) serta mengikuti pameran ke beberapa kota seperti di Istana Negara Jakarta, Taman Mini Indonesia Indah dan Kota Bandung serta pameran menjelajah ke luar negeri ke Belanda dan Kanada.</p><p>Karya seni Wayan Sumantra dijual mulai dari ratusan ribu rupiah hingga puluhan juta rupiah berdasarkan varian jenis karya, bahan kayu dan kain, besar kecilnya lukisan, penokohan, hingga tingkat kerumitan pekerjaan.</p><p>Daftarkan WBTB</p><p>Bahkan, keberadaan lukisan klasik Wayang Kamasan diusulkan oleh pemerintah pusat sebagai Warisan Budaya Tak Benda (WBTB) pada Intangible Cultural Heritage (ICH) United Nations Educational Scientific and Cultural Organization (Unesco). Pendaftaran WBTB pada ICH Unesco dilaksanakan dua tahun sekali. Dan satu negara hanya bisa mengusulkan satu WBTB. Seni lukis klasik Wayang Kamasan merupakan seni lukis yang berkembang dari Desa Kamasan Kabupaten Klungkung.</p><p>Seni lukis ini diyakini sudah berkembang pada zaman Kerajaan Gelgel pada abad ke-14. Saat ini lukisan Wayang Kamasan masih bisa ditemui pada ornamen di plafon bangunan peninggalan, yakni di Bale pertemuan Kerta Gosa.</p><p>Sejarah seni lukis di Bali bermula di sebuah desa bernama Kamasan di Kabupaten Klungkung. Pada abad ke-14 sampai abad ke-18, Bali berada di bawah kekuasaan raja-raja keturunan Sri Krisna Kepakisan dari Kerajaan Majapahit. Adalah salah satu raja Kepakisan, yaitu Sri Waturenggong, yang pada suatu hari di abad 15 dihadiahi sekotak wayang oleh Kerajaan Majapahit.</p><p>Karena terpesona dengan keindahan wayang-wayang tersebut, sang raja kemudian memerintahkan para pelukis istana melukisnya secara massal untuk disebarluaskan ke seluruh Bali agar masyarakat pun dapat ikut mengagumi keindahan wayang-wayang tersebut.</p><p>Sehingga terobsesinya dengan lukisan wayang Kamasan, langit-langit Gedung Kertha Gosa yang menjadi pusat pemerintahan Kerajaan Gelgel di Klungkung pun diperintahkan untuk dilukis mural wayang Kamasan dengan kisah-kisah legendaris, seperti perjalanan Bhima ke Swarga Loka atau kisah Ni Diah Tantri yang diambil dari Wayang Tantri, wayang tradisional Bali. Lukisan klasik wayang Kamasan menggunakan pewarna alami, seperti warna cokelat muda dari batu gamping, hitam dari jelaga lampu minyak, dan putih dari tulang babi atau tanduk rusa yang dihancurkan menjadi bubuk.</p><p>Sementara bahan kanvas yang digunakan adalah kain kasar. Kain ini kemudian dicelup dalam bubuk bubur beras dan dijemur di bawah sinar matahari guna menutup dan meratakan permukaannya. Setelah kering, permukaannya digosok agar lebih halus, barulah dapat dimulai proses melukis dengan membagi seluruh kanvas menjadi beberapa bidang untuk menempatkan setiap gambar wayang dan unsur lainnya. Karena memiliki cerita yang jelas, lukisan ini pun terlihat unik dan indah.</p><p>Lukisan wayang Kamasan mengalami masa keemasan pada abad ke-16 di bawah pemerintahan Kerajaan Gelgel. Ketika itu cerita yang banyak dilukis diambil dari epik Ramayana dan Mahabharata, dengan membuat tak ada bagian kanvas yang kosong.</p>',
        ]);

        Berita::create([
            'judul' => 'Bupati Suwirta Ajak Generasi Muda Dan Masyarakat Promosi Lukisan Klasik Wayang Kamasan',
            'slug' => 'bupati-suwirta-ajak-generasi-muda-dan-masyarakat-promosi-lukisan-klasik-wayang-kamasan',
            'foto' => 'image.jpg',
            'id_kategori_berita' => 1,
            'id_user' => 1,
            'deskripsi' => '<p>"Mari aktif melakukan promosi mengenai Lukisan Klasik Wayang Kamasan," ajak Bupati Klungkung I Nyoman Suwirta didampingi Ketua TP PKK Kabupaten Klungkung Ny. Ayu Suwirta kepada ST Adi Manggala dan Masyarakat Desa Kamasan saat menghadiri HUT ST Adi Manggala ke-43 bertempat di Banjar Sangging Desa Kamasan Klungkung, Minggu (19/3).</p><p>"Kebesaran Lukisan Klasik Wayang Kamasan, tidak cukup hanya dijadikan slogan, tarian dan lagu tetapi harus menjadi suatu kebanggaan dan dapat mensejahterakan masyarakat Desa Kamasan,” ujar Bupati Suwirta. Selain memperingati HUT ST, dalam Acara tersebut juga diisi dengan Pelantikan dan Pengukuhan Pengurus ST Adi Manggala; Pelantikan Kelian Banjar dan Peresmian Banjar Sangging.</p><p>Dalam puncak perayaan HUT ST Adi Manggala, diisi dengan berbagai hiburan diantaranya menampilkan kesenian kontemporer kolaborasi antara ST Adi Manggala dengan PKK Desa Kamasan berjudul Sangging Mahodara yang mengisahkan tentang cikal bakal lukisan wayang kamasan dan hiburan musik. Turut hadir pada kegiatan tersebut, Camat Klungkung I Putu Arnawa dan undangan terkait lainnya.</p>',
        ]);

        Berita::create([
            'judul' => 'Sumantra Bagikan Ilmu Melukis Wayang Kamasan Secara Gratis',
            'slug' => 'sumantra-bagikan-ilmu-melukis-wayang-kamasan-secara-gratis',
            'foto' => 'image.jpg',
            'id_kategori_berita' => 1,
            'id_user' => 1,
            'deskripsi' => '<p>Besar di lingkungan seni, tepatnya di Desa Kamasan, Klungkung, Bali membuat naluri seni, I Wayan Pande Sumantra terasah dengan sendirinya. Bergelut soal seni khususnya seni Wayang Lukis Kamasan sejak kecil, membuatnya tersentuh untuk mengembangkan seni asal gumi Serombotan itu ke generasi muda.</p><p>“Sanggar ‘Sinar Pande’ seni lukis Wayang Kamasan sudah ada sejak tahun 2019. Anak-anak belajar di sana di luar jam dan hari mereka sekolah agar tidak terganggu. Waktu lesnya hanya hari Sabtu dan Minggu setiap jam 15.00 Wita saja,” terang Sumantra saat ditemui pada gelaran parade Melukis Wayang Kamasan di Balai Budaya Ida I Dewa Agung Jambe, Rabu (17/5/2023) siang.</p><p>Sumantra menyebutkan, ia memanfaatkan teras di rumah sederhananya untuk mengajar anak-anak yang tertarik melukis Wayang Kamasan. Ia menyebutkan, para siswanya tak hanya berasal dari Desa Kamasan saja, namun juga dari desa lainnya baik itu dari TK hingga anak SMA. Bahkan, sanggarnya itu sering disambangi oleh para mahasiswa-mahasiswi dari berbagai wilayah.</p><p>“Bukan hanya siswa di Klungkung saja, banyak mahasiswa luar Bali berkunjung untuk penelitian atau belajar melukis,” bebernya. Kini dirinya membimbing sebanyak 25 anak usia dini secara sukarela alias gratis untuk belajar melukis dan mewarnai di rumah yang dijadikan sanggar itu. Anak didiknya itu diajarkan mengenal warna pakem pewayangan. Mulai dari warna kuning, merah, biru, coklat, dan hitam.</p><p>“Biasanya warna kuning dan merah, biru, hijau, hitam dan coklat. Wayang Kamasan itu ada pakem pewarnaannya. Sudah jelas dan tidak boleh merubah dari pakem Wayang Kamasan, tidak bisa melenceng dari pakem, goresan dan warna harus pasti,” imbuhnya.</p><p>Ia juga menjelaskan di sanggarnya pun sudah diberikan fasilitas lengkap agar dapat di pakai oleh siswanya, seperti meja, kertas sketsa, dan berbagai jenis warna. Namun sayangnya untuk saat ini, pihaknya tidak bisa menambah siswa lagi. Sebab, kapasitas di rumahnya saat ini tidak mencukupi.</p><p>“Saat ini belum bisa menambah siswa, karena sanggar saya di rumah dan itu sudah penuh. Kalau ada yang ingin bergabung saya masih cari solusi, saya berharap kalau bisa dijembatani mungkin dari pihak sekolah atau dinas terkait,” pungkasnya.</p>',
        ]);

        KategoriDaerah::create([
            'nama' => 'Wisata Alam',
            'slug' => 'wisata-alam'
        ]);

        KategoriDaerah::create([
            'nama' => 'Wisata Buatan',
            'slug' => 'wisata-buatan'
        ]);

        KategoriDaerah::create([
            'nama' => 'Wisata Budaya',
            'slug' => 'wisata-budaya'
        ]);

        KategoriProduk::create([
            'nama' => 'Budaya',
            'slug' => 'budaya'
        ]);

        KategoriProduk::create([
            'nama' => 'Kuliner',
            'slug' => 'kuliner'
        ]);

        KategoriProduk::create([
            'nama' => 'Pariwisata',
            'slug' => 'pariwisata'
        ]);

        KategoriProduk::create([
            'nama' => 'Seni Kerajinan',
            'slug' => 'seni-kerajinan'
        ]);
    }
}
