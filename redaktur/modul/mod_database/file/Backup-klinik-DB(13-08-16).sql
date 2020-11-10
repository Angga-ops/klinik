--Backup SQL DUMP Database
--Script By ShowCheap ()
--Copyright (c) 2016
--File ini di backup pada tanggal 13-08-2016 10:38:37

DROP TABLE IF EXISTS agenda;
CREATE TABLE `agenda` (
  `id_agenda` int(5) NOT NULL AUTO_INCREMENT,
  `tema` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tema_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_agenda` text COLLATE latin1_general_ci NOT NULL,
  `tempat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pengirim` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tgl_posting` date NOT NULL,
  `jam` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO agenda VALUES("64","Elton John Greatest Hits Tour","elton-john-greatest-hits-tour","November ini,&nbsp; Indonesia akan disuguhkan salah satu konser megah dari legenda musik dunia yaitu Elton John. Penampilan Elton John yang pertama kalinya di Indonesia akan berlangsung pada 17 November 2012, di&nbsp; Sentul International Convention Center, Bogor yang lokasinya tidak begitu jauh dari Jakarta.<br />
<br />
Konser Elton John ini merupakan bagian dari tur dunianya yang bertajuk &ldquo;Greatest Hits Tour&rdquo; dan akan dimulai pada awal November dari Latvia sampai ke Australia. Elton John akan membawa band lamanya yang terdiri dari Davey Johnstone, Nigel Olsson, Robert Birch, Kim Bullard dan John Mahon, dan empat backing vocal yaitu Rose&nbsp; Batu (Sly dan The Family Stone), Lisa Bank, Tata Vega, dan Jean Witherspoon.
","Sentul International Convention Center","","510070sc-elton.jpg","2012-11-17","2012-11-17","2012-08-20","--","26","admin");
INSERT INTO agenda VALUES("62","Maroon Live in Jakarta 2012","maroon-live-in-jakarta-2012","Maroon 5 akan kembali menghibur penggemar Jakarta mereka dengan sebuah konser pada 5 Oktober 2012 di Istora Senayan, Jakarta. Ini akan menjadi penampilan kedua mereka di tanah air setelah tampil pada konser sold out 27 April 2011 lalu. Grup musik beraliran pop rock yang berasal dari Los Angeles, California Amerika Serikat. Rencananya menggelar konsernya pada 5 Oktober 2012, di Istora Senayan, Jakarta. Java Musikindo selaku promotor telah mengumumkan pembagian kelas serta harga tiket konser. Band yang digawangi oleh Adam Levine (vokal/gitar), Jesse Carmichael (keyboard/gitar),Mickey Madden (bass), James Valentine (gitar), Matt Flynn (drum) ini menggelar konser di Jakarta sebagai bagian dari promo album barunya, Overexposed, yang dirilis Juni lalu.
","Istora Senayan Jakarta","","209930maroon_live_in_jakarta_2012.jpg","2012-10-05","2012-10-05","2012-08-19","","23","admin");
INSERT INTO agenda VALUES("63","Festival Musik Bambu Nusantara 2012","festival-musik-bambu-nusantara-2012","Bambu Nusantara ke-6 tahun ini akan digelar di Jakarta Convention Center (JCC), di Jalan Jenderal Gatot Subroto, Jakarta, pada 1 - 2 September 2012. Acara tersebut akan menghadirkan beraneka kreasi berbahan bambu dan tampilnya beragam seni dari bambu. Selain suguhan musik etnik berpadu dengan musik modern, dalam Acara ini juga akan turut diisi dengan pameran, seminar, merchandise, kuliner, dan fashion yang dipadu padankan dengan karya berbahan bambu.<br />
","Jakarta Convention Center (JCC), Jakarta","","85235BambuNusantara2012.jpg","2012-09-01","2012-09-02","2012-08-20","09.00 - 21.00 Wib","25","admin");
DROP TABLE IF EXISTS album;
CREATE TABLE `album` (
  `id_album` int(5) NOT NULL AUTO_INCREMENT,
  `jdl_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `album_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `gbr_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `hits_album` int(5) NOT NULL DEFAULT '1',
  `tgl_posting` date NOT NULL,
  `jam` time NOT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO album VALUES("30","Konser Kantata Barock 2011","konser-kantata-barock-2011","Para macan tua yang digawangi Iwan Fals, Setiawan Djody dan Sawung Jabo di Stadion Gelora Bung Karno, Jakarta,
Jumat (30/12) malam. Kantata kembali membawakan lagu-lagu legendarisnya
setelah 21 tahun vakum dari dunia musik.
<div style=\"overflow: hidden; color: #000000; background-color: #ffffff; text-align: left; text-decoration: none; border: medium none\">
<br />
</div>
","4520kantata_barock.jpg","Y","36","2012-08-20","09:12:06","Senin","admin");
INSERT INTO album VALUES("31","Festival Seni Terbesar di Dunia","festival-seni-terbesar-di-dunia","","13festival_seni.jpg","Y","37","2012-08-20","09:40:01","Senin","admin");
INSERT INTO album VALUES("28","Murah Meriah di Pasar Asemka","murah-meriah-di-pasar-asemka","Pasar Asemka, Jakarta, merupakan pasar grosir yang banyak menyediakan berbagai aksesoris seperti kalung, cincin, Souvenir pernakahan, dan lainnya. Di Pasara Asemka anda akan dimanjakan dengan beragam barang yang dibandrol dengan harga murah meriah dan biasanya dijual grosiran. 
","18asemka.jpg","Y","170","2012-08-18","23:14:05","Sabtu","admin");
INSERT INTO album VALUES("29","Karpet Raksasa dari Bunga","karpet-raksasa-dari-bunga","Belgia sedang memperingati peristiwa tahunan &quot;La Fete De La Fleur&quot; atau pesta bunga di bulan Agustus. Ahli bunga merancang karpet raksasa dari bunga di depan Grand Place di Brussel. Karpet ini dibuat menggunakan 700 ribu bunga.
","92bungaraksasa2.jpg","Y","25","2012-08-19","03:02:27","Minggu","admin");
DROP TABLE IF EXISTS background;
CREATE TABLE `background` (
  `id_background` int(5) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_background`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
INSERT INTO background VALUES("1","main-body-bg.jpg");
DROP TABLE IF EXISTS banner;
CREATE TABLE `banner` (
  `id_banner` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO banner VALUES("14","Beta UFO Indonesia","","betaufo.jpg","2011-06-22");
DROP TABLE IF EXISTS berita;
CREATE TABLE `berita` (
  `id_berita` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(5) NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `sub_judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `youtube` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `judul_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `headline` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `utama` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `isi_berita` text COLLATE latin1_general_ci NOT NULL,
  `keterangan_gambar` text COLLATE latin1_general_ci NOT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  `tag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM AUTO_INCREMENT=655 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO berita VALUES("644","41","admin","\"Banjir Jakarta\" Paling Dicari di Google","Jakarta Darurat Banjir","","banjir-jakarta-paling-dicari-di-google","N","Y","N","<p>
Jakarta - Banjir yang mengguyur Jakarta beberapa hari lalu membuat sejumlah lokasi di ibukota banjir. Internet, jadi media yang digunakan warga Jakarta untuk mencari tahu informasi terkini seputar banjir. &nbsp;
</p>
<p>
Dalam laporan Pencarian Terhangat Google Indonesia sepanjang 11 - 17 Januari 2013, kata kunci &quot;Banjir di Jakarta&quot; adalah yang paling banyak dimasukkan dalam mesin pencari Google.
</p>
<p>
Tak hanya mesin pencari, beberapa platform milik Google juga digunakan untuk memberi informasi seputar banjir. Ada Google Crisis Response, yang menyajikan informasi lokasi-lokasi banjir di Jakarta. Bahkan, layanan ini juga memperlihatkan kondisi lalu lintas yang macet akibat banjir.
</p>
<p>
Di dalam Google Crisis Response juga terdapat beberapa nomor telepon penting dari lembaga pemerintah DKI Jakarta maupun swadaya masyarakat, yang dapat dihubungi oleh warga untuk mendapat bantuan dan evakuasi.
</p>
<p>
Selain layanan Google, jejaring sosial Twitter juga banyak digunakan untuk mencari informasi terkini. Beberapa akun Twitter yang memberi informasi banjir antara lain @TMCPoldaMetro dan @LewatMana.
</p>
<p>
Situs web pemberi informasi lalu lintas LewatMana.com juga laris dikunjungi dalam sepekan ini. LewatMana memperlihatkan kondisi lalu lintas dan gambar dari CCTV. Ia menduduki peringkat 10 Pencarian Terhangat Google Indonesia pada 11 - 17 Januari 2013.
</p>
<p>
Dalam sepekan ini, warga juga ingin tahu soal perkiraan cuaca dengan memasukkan kata kunci BMKG di mesin pencari Google. BMKG (Badan Meteorologi Klimatologi dan Geofisika) masuk ke posisi 9 sebagai topik yang paling dicari di Google Indonesia pekan ini. (Sumber: kompas.com)
</p>
","","Senin","2013-01-21","09:46:27","25banjir-jakarta.jpg","5","nasional");
INSERT INTO berita VALUES("645","48","admin","Korban dan Pelaku Pemerkosaan Saling Menikmati?","Seleksi Calon Hakim Agung","","korban-dan-pelaku-pemerkosaan-saling-menikmati","N","N","Y","<p>
Calon hakim agung Muhammad Daming Sanusi menyatakan, hukuman mati tidak layak diberlakukan bagi pelaku pemerkosaan. Penjelasannya soal ini mengundang tawa sejumlah anggota Komisi III saat berlangsung fit and proper test hakim agung di Komisi III DPR pada Senin (14/1/2013) ini.
</p>
<p>
&quot;Bagaimana menurut Anda, apabila kasus perkosaan ini dibuat menjadi hukuman mati?&quot; tanya anggota Komisi III dari Fraksi PAN, Andi Azhar, ketika itu kepada Daming.
</p>
<p>
Daming menjawab, &quot;Yang diperkosa dengan yang memerkosa ini sama-sama menikmati. Jadi, harus pikir-pikir terhadap hukuman mati.&quot;
</p>
<p>
Jawaban Daming ini pun langsung mengundang tawa, tetapi tidak sedikit yang mencibir pernyataannya. Dijumpai seusai menjalani fit and proper test, Daming berdalih bahwa pernyataannya itu hanya untuk mencairkan suasana.
</p>
<p>
&quot;Kita tadi terlalu tegang, jadi supaya tidak terlalu tegang,&quot; imbuhnya.
</p>
<p>
Menurut Daming, hukuman mati harus dipertimbangkan baik-baik. Ia beralasan, dirinya belum memberikan jawaban tegas apakah ia mendukung atau tidak penerapan hukuman mati bagi pelaku pemerkosaan. &quot;Tentu kita harus pertimbangkan baik-baik kasus tertentu, seperti narkoba, korupsi, saya setuju. Tapi untuk kasus pemerkosan, harus dipertimbangkan dulu. Tadi saya belum memberikan jawaban yang tegas,&quot; kata Daming.
</p>
<p>
Menanggapi pernyataan itu, anggota Komisi III lain dari Fraksi Partai Demokrat, Himmatul Aliya Setiawati, menilai candaan Daming sangat tidak pantas.
</p>
<p>
&quot;Saya kira candaannya tidak pas. Saya setuju ada hukuman mati ya,&quot; ucap Aliya.
</p>
<p>
Meski menganggap tak pantas, ia menilai jawaban Daming sudah memenuhi kriteria yang diharapkan dari seorang hakim agung. &quot;Dari Fraksi Gerindra menyatakan tidak akan memilih, tapi kalau saya sih soal memilih kita lihat nilai-nilai keseluruhannya,&quot; tutur Aliya. (Sumber: kompas.com
</p>
","","Senin","2013-01-21","15:59:46","31palu-hakim.jpg","0","hukum");
INSERT INTO berita VALUES("622","31","admin","Orang yang Beriman Kondisi Fisik dan Mentalnya Lebih Sehat","","","orang-yang-beriman-kondisi-fisik-dan-mentalnya-lebih-sehat","N","N","N","Orang yang beriman disayang Tuhan, mungkin itulah sebabnya kemudian orang yang beriman juga memiliki kondisi kesehatan yang baik. Nyatanya, berbagai penelitian menunjukkan bahwa orang-orang yang memiliki keyakinan dan keimanan yang teguh juga memiliki kondisi fisik yang lebih prima.<br />
<br />
&quot;Keyakinan terhadap agama bisa mengurangi stres, depresi, dan meningkatkan kualitas hidup,&quot; kata Dr Harold G. Koenig, profesor psikiatri dan ilmu perilaku di Duke University Medical Center seperti dilansir Medpagetoday.com, Minggu (19/8/2012).<br />
<br />
Data sebuah penelitian yang dimuat American Journal of Health Promotion tahun 2005 menyimpulkan bahwa orang yang banyak berdoa lebih banyak mendapat manfaat kesehatan dengan cara menerapkan perilaku yang sehat, menjalankan antisipasi terhadap penyakit dan lebih puas terhadap pelayanan kesehatan.<br />
<br />
Sebuah penelitian tahun 2006 yang dimuat British Medical Journal juga menemukan bahwa kehadiran dalam sebuah acara keagamaan ternyata berkaitan dengan penurunan risiko penyakit menular.<br />
<br />
Menurut Koenig, adanya keyakinan beragama dan kegiatan spiritual berhubungan dengan risiko penyakit atau gangguan kesehatan yang lebih rendah, misalnya stres, penyakit kardiovaskular, tekanan darah, reaktivitas kardiovaskular, gangguan metabolisme serta dapat menjamin keberhasilan operasi jantung. Namun di sisi lain, Koenig juga memperingatkan bahwa cara kerja Tuhan ini tidak dapat diukur dengan cara dan metode apapun.<br />
<br />
&quot;Saya percaya bahwa doa efektif, tapi tidak berfungsi secara ilmiah dan tidak dapat diprediksi. Tidak ada alasan ilmiah atau teologis atas setiap efek dari keyakinan yang dapat dipelajari atau didokumentasi, seolah-olah Tuhan adalah bagian dari alam semesta yang dapat diprediksi. Ilmu pengetahuan tidak dirancang untuk membuktikan hal-hal yang supranatural,&quot; kata Koenig.<br />
<br />
Selain itu, keyakinan terhadap agama juga telah dikaitkan dengan umur panjang, perkembangan penyakit kognitif yang lebih lambat dan penuaan yang sehat. Senada dengan Koenig, dr Robert A. Hummer, profesor sosiologi di University of Texas di Austin yang berfokus pada hubungan antara agama dan rendahnya risiko kematian juga memiliki pendapat yang sama.<br />
<br />
Hummer merujuk sebuah penelitian yang melacak beberapa orang berusia 51 - 61 tahun selama 8 tahun untuk mendokumentasikan tingkat ketahanan hidupnya. Penelitian tersebut menemukan bahwa peserta yang tidak menghadiri acara keagamaan sama sekali memiliki kemungkinan 64 persen lebih tinggi mengalami kematian dibandingkan orang yang sering beribadah.
","","Senin","2012-08-20","08:51:08","19shalat.jpg","13","kesehatan");
INSERT INTO berita VALUES("623","41","admin","Mau jadi Megapolitan atau Megapelitan?","","","mau-jadi-megapolitan-atau-megapelitan","N","N","N","Jakarta - Peneliti bidang perkotaan Yayat Supriatna menilai konsep megapolitan dengan Jakarta sebagai pusatnya sudah semestinya diterapkan.<br />
<br />
Namun, sebagai inti kawasan dengan dukungan kekuatan pendanaan yang lebih besar, pemerintah Jakarta terkesan enggan berbagi madu dengan wilayah-wilayah pendukungnya.<br />
<br />
Yayat lantas menyindir sikap pemerintah Jakarta yang dipandangnya terlampau pelit terhadap pemerintah di daerah pendukung.<br />
<br />
&quot;Sebenarnya mau jadi megapolitan atau megapelitan. Kalau untuk mengatasi banjir di Jakarta lalu dengan pembangunan waduk di hilir, Kabupaten Bogor, kenapa cuma kasih dana hibah Rp 5 miliar?&quot; sindir Yayat saat menjadi pembicara dalam seminar manajemen perkotaan di Kampus Pascasarjana Universitas Mercu Buana.<br />
<br />
Jumlah tersebut menurut Yayat terlalu kecil untuk mengongkosi pembangunan waduk untuk menyalurkan air Sungai Ciliwung.<br />
<br />
Dana yang dimiliki Pemprov DKI sendiri jauh lebih besar, selain memiliki kemampuan untuk memperoleh sumber dana tambahan.<br />
<br />
&quot;Apalagi kerugian yang diakibatkan oleh banjir di Jakarta jauh lebih besar dari nilai Rp 5 miliar,&quot; imbuh Yayat.<br />
<br />
Peneliti dari Universitas Trisakti ini menyebutkan, harus ada kompensasi yang dikeluarkan Jakarta untuk mengatasi persoalan-persoalan kota jika ingin bekerja sama dengan daerah pendukung. Untuk itu, sangat tidak beralasan bila pemerintah Jakarta terlalu irit dalam soal kompensasi antarwilayah.<br />
<br />
&quot;Wajar jika Pemerintah Bogor, misalnya, tidak siap membangun waduk. Ya, karena kompensasinya terlalu kecil,&quot; tandas Yayat.<br />
<br />
Ia berharap, pemerintah Jakarta pada periode mendatang lebih mampu membangun sinergi dengan wilayah sekitarnya dan tidak arogan sebagai Ibu Kota negara.<br />
<br />
&quot;Jakarta tidak bisa menyelesaikan problem-problemnya sendirian. Jakarta butuh bantuan dari kawasan penyangga baik untuk atasi banjir, transportasi, pemukiman hingga sumber daya manusianya,&quot; pungkas Yayat.<br />
","","Selasa","2012-10-02","10:02:51","91banjir_jakarta.jpg","12","metropolitan");
INSERT INTO berita VALUES("624","41","admin","Tuntut THR, Ratusan Pekerja Transjakarta Mogok","","","tuntut-thr-ratusan-pekerja-transjakarta-mogok","N","N","N","Jakarta - Ratusan pekerja bus koridor I (Blok M-Kota) dan X (Cililitan-Tanjung Priok) mogok bekerja. pramudi, teknisi, dan petugas keamanan menuntut kenaikan upah dan pembayaran Tunjangan Hari Raya (THR). Mereka di depan Pool Pinang Ranti, Jalan Raya Pondok Gede, Pinang Ranti, Makassar, Jakarta Timur, sambil berorasi membentangkan spanduk bertemakan agar PT Jakarta Expres Trans (JET) membayar THR.<br />
<br />
Menurut&nbsp; pramudi Bus TransJakarta Koridor I, Maya, pihaknya terpaksa melakukan mogok operasi karena pihak perusahaan tidak membayarkan kewajibannya memberikan THR.<br />
<br />
&quot;Sementara, anak-anak sudah menunggu di rumah ingin jalan-jalan ke mal untuk beli baju Lebaran,&quot; ujarnya kepada wartawan, Senin (13/08/2012).<br />
<br />
Sedangkan Abdul Chakim berharap, selain memberikan THR perusahaan PT JET juga menaikan upah. Pasalnya, untuk Pramudi yang di bawah manajeman PT JET upahnya bervariasi mulai dari Rp2,4 juta-Rp2,8 juta. Sedangkan pramudi yang berada di bawah manajemen gajinya mencapai Rp5,3 juta.<br />
<br />
&quot;THR kami segera terbayar dan gaji kami dinaikkan sejajar dengan pramudi dari koridor lainnya,&quot; imbuhnya.<br />
<br />
Hingga bubar aksi berjalan berdamai, pihak perusahaan berjanji akan membayarka THR dan menaikan upah para pekerja bus Transjakarta.
","","Senin","2012-08-20","10:14:24","95demo_karyawan-transjakarta.jpg","8","metropolitan");
INSERT INTO berita VALUES("625","41","admin","Effendi Ghazali: Putaran Kedua Pilkada DKI Ketat","","","effendi-ghazali-putaran-kedua-pilkada-dki-ketat","N","Y","N","Jakata - Pengamat politik dari Universitas Indonesia, Effendi Ghazali, mengungkapkan pada putaran kedua pemilihan kepala daerah (Pilkada) pada September mendatang, akan terjadi persaingan ketat antara pasangan Joko Widodo-Basuki T Purnaka dengan pasangan Fauzi Bowo-Nachrowi Ramli.<br />
<br />
&ldquo;Kami telah mengadakan survey internal, dan hasilnya, akan terjadi persaingan ketat antara Pak Jokowi dan Pak Fauzi Bowo. Tidak seperti hasil sebelumnya yang memang jauh jarak perolehannya,&rdquo; ujarnya ditemui di acara open house yang diadakan Gubernur Fauzi Bowo, di rumah dinasnya Jalan Taman Suropati No. 7, Jakarta Pusat, Minggu (19/08/2012).<br />
<br />
Meski demikian, Effendi urung menyebutkan nilai dari survey yang dilakukan oleh pihaknya, mengingat masih ada margin eror yang besar dari 450 responden yang dilakukan survey. &ldquo;Siapa yang lebih unggul, belum bisa saya kasih tahu sekarang, karena survey kami agak besar margin errornya,&rdquo; jelasnya.<br />
<br />
Menyinggung maraknya penggunaan isu SARA yang terjadi selama bulan ramadhan kemarin, Effendi angkat bicara. Menurutnya, penggunaan isu SARA yang dilakukan oleh pihak-pihak tertentu sudah menimbulkan dampak yang besar, baik di kalangan masyarakat bawah maupun untuk calon pasangan. &ldquo;Itu jelas ada dampaknya. Bahkan pengaruhnya cukup besar untuk pilkada putaran kedua nanti,&rdquo; tandasnya.
","Joko Widodo (kiri), Fauzi Bowo (kanan)
","Jumat","2012-09-14","10:42:25","53joko_foke.jpg","18","metropolitan");
INSERT INTO berita VALUES("621","31","admin","Manfaat Berenang untuk Bayi","","","manfaat-berenang-untuk-bayi","N","N","N","Mengajarkan bayi berenang sejak tahun pertama memiliki banyak manfaat. Tak hanya bermanfaat untuk bayi, berenang juga bisa meningkatkan bonding antara orangtua-anak.<br />
<br />
Sayangnya, masih banyak orangtua yang memandang sebelah mata kegiatan berenang untuk bayi. Atau mungkin, mereka terlalu khawatir dan menganggap terlalu dini. Padahal, mengajarkan berenang se-dini mungkin kepada anak, memberikan lebih banyak manfaat.<br />
<br />
Survei yang diadakan Water Babies menunjukkan 40 persen orangtua di Inggris mengaku tak pernah memperkirakan adanya manfaat positif dari mengajarkan berenang pada bayi. Padahal kecelakaan ketiga tertinggi pada anak di Inggris disebabkan karena anak tenggelam. Mengajarkan berenang sejak dini pada anak, justru mampu meningkatkan kepercayaan diri anak di dalam air, dan membuatnya bisa melindungi diri.<br />
<br />
<strong>Bonding</strong><br />
Berenang bersama bayi menjadi momen yang&nbsp; menyenangkan untuk anak dan orangtua. Selain mendebarkan, berenang bersama bayi juga meningkatkan bonding orangtua-anak.<br />
<br />
<strong>Perkembangan fisik dan mental</strong><br />
Aktivitas berenang melatih perkembangan fisik dan mental anak. Anak tak hanya tumbuh lebih bugar dan kuat, namun juga membantu anak untuk lebih bernafsu makan dan lebih nyenyak tidur.<br />
<br />
<strong>Belajar life-skill</strong><br />
Nyatanya, renang bukan hanya olahraga fisik. Melalui renang, bayi juga bisa belajar life-skill, termasuk kemampuan untuk bertahan dan menjaga diri.<br />
<br />
Menurut survei, 90 persen ayah dan ibu setuju bahwa menjadi tanggungjawab mereka untuk menjamin anak-anaknya memiliki life-skill. Artinya, adalah tugas orangtua untuk mendidik dan membimbing anak untukmemiliki life-skill seperti kemampuan berenang, bersepeda, memahami etika di meja makan. Namun, lebih dari sepertiganya mengaku komitmen untuk menumbuhkan life-skill ini terkalahkan karena kesibukan pekerjaan.<br />
<br />
Paul Thompson, salah satu pendiri Water Babies mengatakan, &quot;Mengajarkan anak mengenai keamanan tingkat dasar di dalam air dan kepercayaan diri di dalam air bisa menyelamatkan jiwanya. Melalui pelatihan yang progresif, bayi bisa belajar keterampilan pertahanan diri sejak dini, seperti berenang mendekati benda padat saat berada di dalam air, dan lain sebagainya.&quot;<br />
<br />
<strong>Usia berapa mulai berenang?</strong><br />
Kebanyakan orangtua, para responden survei Water Babies, mengatakan anak-anak sebaiknya mulai belajar beranang mulai usia tiga. Namun faktanya, anak-anak bisa belajar berenang lebih dini lagi.<br />
<br />
Bayi pada tahun pertama mengalami perkembangan otak yang tinggi, setiap gerakan akan merangsang perkembangan otak, menguatkan saraf dan membuat kerja otak semakin efisien.<br />
<br />
&quot;Bayi usia dua hari pernah belajar berenang bersama kami. Tahun pertama kehidupan bayi sangat krusial terutama dalam perkembangannya. Olahraga rutin turut punya andil besar dalam mendukung tumbuh kembangnya. Air memungkinkan otot bayi bergerak bebas. Latihan di air, cocok untuk anak-anak,&quot; tandas Thompson.<br />
","","Senin","2012-08-20","08:42:51","76smackdown_baby_swim.jpg","11","kesehatan");
INSERT INTO berita VALUES("620","31","admin","Kandungan Khasiat Buah Naga","","","kandungan-khasiat-buah-naga","N","N","N","Buah naga mempunyai khasiat yang bermanfaat bagi kesehatan manusia diantaranya sebagai penyeimbang kadar gula darah, pelindung kesehatan mulut, pencegah kanker usus, mengurangi kolesterol, pencegah pendarahan dan mengobati keluhan keputihan.<br />
<br />
Buah naga biasanya dikonsumsi dalam bentuk buah segar sebagai penghilang dahaga, karena buah naga mengandung kadar air tinggi sekitar 90 % dari berat buah. Rasanya cukup manis karena mengandung kadar gula mencapai 13-18 briks. Buah naga juga dapat disajikan dalam bentuk jus, sari buah, manisan maupu selai atau beragam bentuk penyajian sesuai selera anda.<br />
<br />
Secara umum,pakar sependapat dan mengakui buah naga kaya dengan potasium, ferum, protein, serat, sodium dan kalsium yang baik untuk kesihatan berbanding buah-buahan lain yang diimport.<br />
<br />
Menurut AL Leong dari Johncola Pitaya Food R&amp;D, organisasi yang meneliti buah naga merah , buah kaktus madu itu cukup kaya dengan berbagai zat vitamin dan mineral yang sangat membantu meningkatkan daya tahan dan bermanfaat bagi metabolisme dalam tubuh manusia.<br />
<br />
&ldquo;Penelitian menunjukkan buah naga merah ini sangat baik untuk sistem peredaran darah, juga memberikan efek mengurangi tekanan emosi dan menetralkan toksik dalam darah.&ldquo;Penelitian juga menunjukkan buah ini bisa mencegah kanker usus, selain mencegah kandungan kolesterol yang tinggi dalam darah dan menurunkan kadar lemak dalam tubuh,&rdquo; katanya.<br />
<br />
Secara keseluruhan, setiap buah naga merah mengandungi protein yang mampu meningkatkan metabolisme tubuh dan menjaga kesehatan jantung; serat (mencegah kanker usus, kencing manis dan diet); karotin (kesehatan mata, menguatkan otak dan mencegah masuknya penyakit), kalsium (menguatkan tulang).<br />
<br />
Buah naga juga mengandungi zat besi untuk menambah darah; vitamin B1 (mencegah demam badan); vitamin B2 (menambah selera); vitamin B3 (menurunkan kadar kolesterol) dan vitamin C (menambah kelicinan, kehalusan kulit serta mencegah jerawat).<br />
<br />
<strong>Berikut ini kandungan nutrisi lengkap buah naga :</strong><br />
<br />
Kadar Gula : 13-18 briks<br />
Air : 90 %<br />
Karbohidrat : 11,5 g<br />
Asam : 0,139 g<br />
Protein : 0,53 g<br />
Serat : 0,71 g<br />
Kalsium : 134,5 mg<br />
Fosfor : 8,7 mg<br />
Magnesium : 60,4 mg<br />
Vitamin C : 9,4 mg
","","Sabtu","2012-11-17","08:20:50","76buah_naga.jpg","9","kesehatan");
INSERT INTO berita VALUES("619","31","admin","4 Alasan Kenapa Memaafkan Penting Bagi Kesehatan","","","4-alasan-kenapa-memaafkan-penting-bagi-kesehatan","N","N","N","Jakarta - Memaafkan bukan berarti melupakan, tapi memberi kesempatan kepada diri sendiri untuk menghapus rasa kesal dan dendam terhadap orang lain. Dengan demikian, rasa marah dan tekanan yang mengganggu emosi pun dapat diredakan. Akibatnya, pikiran jadi lebih tenang dan jauh dari stres. Sejatinya, tak hanya itu saja manfaat kesehatan dari memaafkan orang lain.<br />
<br />
Secara ilmiah, memaafkan kesalahan orang lain dapat bermanfaat baik bagi kesehatan fisik maupun mental. Secara sosial, memaafkan orang lain merupakan wujud kebesaran jiwa dan perilaku yang dianggap baik. Ada banyak manfaat kesehatan dari memaafkan orang lain seperti dilansir Mayo Clinic dan Telegraph, Minggu (19/8/2012) antara lain:<br />
<br />
<strong>1. Terhindar dari Penyakit Tekanan Darah Tinggi</strong><br />
Para peneliti dari University of California, San Diego menemukan bahwa orang-orang yang bisa melepaskan kemarahannya dan memaafkan kesalahan orang lain cenderung lebih rendah risikonya mengalami lonjakan tekanan darah.<br />
<br />
Peneliti meminta lebih dari 200 relawan untuk memikirkan saat temannya menyinggung perasaan. Setengah dari kelompok diperintahkan untuk berpikir mengapa hal tersebut bisa membuatnya marah, sedangkan yang lainnya didorong untuk memaafkan kesalahan tersebut. Peneliti menemukan bahwa orang yang marah mengalami peningkatan tekanan darah lebih besar dibanding orang yang pemaaf.<br />
<strong><br />
2. Terhindar dari Risiko Penyalahgunaan Obat dan Alkohol</strong><br />
Sejumlah penelitian telah membuktikan bahwa rasa benci, dendam dan permusuhan dapat memicu tekanan darah tinggi. Stres muncul ketika perasaan kecewa atau tersakiti. Memaafkan adalah sebuah proses perdamaian dengan diri sendiri. Seseorang yang memberi maaf justru akan merasa lebih rileks untuk menerima kondisinya.<br />
<br />
Dengan kondisi mental yang lebih rileks, seseorang juga akan terhindar dari risiko penyalahgunaan alkohol dan obat terlarang. Risiko tersebut umumnya dihadapi oleh para pendendam yang membutuhkan jalan pintas untuk lepas dari beban emosi negatifnya.<br />
<br />
<strong>3. Menurunkan Risiko Serangan Jantung</strong><br />
Para ilmuwan membuktikan bahwa permintaan maaf yang ditujukan pada seseorang bisa meningkatkan kesehatan jantungnya. Orang yang mengalami perlakuan kasar akan mengalami peningkatan tekanan darah yang dapat memicu serangan jantung atau stroke. Namun ketika mendengarkan kata &#39;maaf&#39;, tekanan darah akan menurun kembali.<br />
<br />
Tekanan darah yang diukur dalam penelitian adalah tekanan darah diastolik, yaitu tekanan dalam darah antara detak jantung atau tekanan dalam arteri-arteri ketika jantung istirahat setelah kontraksi. Jika terlalu tinggi atau terjadi untuk waktu yang lama, dapat meningkatkan kemungkinan stroke atau serangan jantung.<br />
<br />
<strong>4. Jauh dari Stres dan Depresi</strong><br />
Sebuah penelitian yang dimuat Personality and Social Psychology Bulletin menemukan bahwa memafkan secara positif dapat mengurangi gejala depresi. Tak hanya itu, memaafkan akan mengembalikan pikiran positif, dan memperbaiki hubungan. Selain itu, memaafkan juga berkaitan dengan perilaku positif lain seperti sifat dermawan, murah hati dan tidak mudah tertekan.<br />
","","Sabtu","2012-11-17","08:14:51","7health.jpg","12","kesehatan");
INSERT INTO berita VALUES("617","23","admin","\"Expendables 2\" Impian Jean Claude Van Damme","","http://www.youtube.com/embed/7rkdTcQLwZ4","expendables-2-impian-jean-claude-van-damme","N","N","N","Peran dalam Expendables 2 telah lama diinginkan oleh Jean-Claude Van Damme. Pasalnya aktor laga yang satu ini punya impian untuk bermain bersama Arnold Schwarzenegger, Sylvester Stallone dan Bruce Willis.<br />
<br />
Van Damme yang memerankan si jahat Jean Vilain dalam Expendables 2 mengungkap kepada PostMedia bahwa kesempatan yang didapat untuk bermain bersama kedua aktor idamannya itu sangatlah berharga.<br />
<br />
&quot;Aku selalu berharap untuk bisa membuat film bersama salah satu dari mereka. Kini aku bermain film bersama keduanya,&quot; ungkapnya. Ahli bela diri asal Belgia ini juga mengaku kagum dengan dedikasi Stallone dalam membuat film laga spektakuler ini (Expendables).<br />
<br />
&quot;Aku melihat pria dengan usia lebih dari 60 dan ia masih bisa menikmati apa yang ia lakukan. Aku bahagia kembali, ia (Stallone) membuatku cinta kepada film lagi,&quot; komentarnya.<br />
<br />
Seperti filmnya yang pertama, The Expendables 2 sudah pasti menyajikan baku hantam, adegan tembak-menembak yang intens, serta ledakan di mana-mana. Itulah alasan mengapa The Expendables 2 dibuat, supaya adrenalin penonton terpacu.
","Jean-Claude Van Damme.
","Senin","2012-08-20","05:47:30","76jean-claude-van-damme-the-expendables-2.jpg","12","film,hiburan");
INSERT INTO berita VALUES("616","23","admin","Nyanyikan Anti Putin, Personel Pussy Riot Dibui","","","nyanyikan-anti-putin-personel-pussy-riot-dibui","N","N","N","Rusia - Pengadilan Rusia memvonis penjara dua tahun personel band Pussy Riot karena menyanyikan lagu anti Presiden Vladimir Putin.<br />
<br />
Pengadilan menetapkan tiga anggota band itu bersalah melakukan &#39;hooliganisme&#39; dengan motivasi agama.<br />
&nbsp;<br />
Hakim Marina Syrova mengatakan para anggota band &quot;secara berhati-hati merencanakan&quot; nyanyian mereka tanggal 21 Februari lalu di dalam katedral di Moskow. &quot;Tolokonnikova, Alyokhina dan Samutsevich melakukan &quot;hooliganisme&quot; -- dengan kata lain pelanggaran berat ketertiban umum,&quot; kata Syrova.<br />
<br />
&quot;Pengadilan menyatakan mereka bersalah. Pengadilan meraih putusan berdasarkan kesaksian terdakwa sendiri dan bukti lain,&quot; tambahnya.<br />
<br />
Jaksa menuntut hukuman tiga tahun penjara atas tiga anggota band itu.<br />
<br />
Para pendukung band itu melakukan protes di sejumlah tempat di Moskow.&nbsp; Keamanan ketat pun diterapkan dan sejumlah jalan ditutup.<br />
<br />
Pussy Riot mengecam kasus tersebut yang mereka katakan diorganisir Putin.<br />
<br />
<strong>Buat Marah Gereja</strong><br />
<br />
Sejumah selebriti termasuk bintang pop Amerika, Madonna, menyerukan agar mereka dibebaskan.<br />
<br />
Ketiga anggota band itu mengatakan &quot;doa punk&quot; mereka adalah tindak politik untuk memprotes gereja ortodoks Rusia yang mendukung Presiden Putin.<br />
<br />
Dalam penampilan seronok mereka di dekat altar mereka meminta Bunda Maria untuk &quot;menggeser Putin&quot;.<br />
<br />
Nyanyian mereka membuat marah gereja Ortodoks dan ketua gereka Kirill menyebutkan penampilan itu sama saja dengan penghujatan agama. Namun sejumlah warga Rusia menganggap kasus itu sebagai upaya pemerintah membungkam kritikan.
","<span class=\"judul judul_artikel2011\">Pussy Riot. </span>
","Senin","2012-08-20","05:30:13","46Pussy-Riot.jpg","9","hiburan,musik");
INSERT INTO berita VALUES("615","23","admin","Foto Panas Beredar Lagi, Nikita Mirzani Syok","","","foto-panas-beredar-lagi-nikita-mirzani-syok","N","N","Y","Jakarta - Nama Nikita Mirzani memang sedang naik daun belakangan ini. Dengan keberaniannya dalam menampilkan lekuk tubuhnya di beberapa film yang diperaninya, dirinya pun sempat didaulat dengan predikat sebagai salah satu artis hot tanah air.<br />
<br />
Namun, keberaniannya tersebut ternyata harus seiring dengan pil pahit yang ditelannya. Beberapa waktu lalu, foto topless dirinya sempat beredar luas di dunia maya. Dan kini, kembali foto-foto yang memperlihatkan kenekatannya di depan kamera dipertontonkan.<br />
<br />
Dalam foto-foto ini, Nikita hanya menutupi payudaranya dengan jari ataupun rambutnya, tanpa mengenakan sehelai baju pun. Saat dikonfirmasi, Nikita mengaku syok.<br />
<br />
&quot;Gue syok. Gak tahu mau ngomong apa lagi. Itu foto emang udah lama banget,&quot; tuturnya, Rabu (15/8).<br />
<br />
Artis yang sempat mengisi program Kakek Kakek Narsis di Trans TV ini belum mau memberikan konfirmasi lebih. Dirinya masih mencari ketenangan atas musibah yang menimpanya untuk ke sekian kali.<br />
<br />
&quot;Gak bisa mikir. Mau ngomong apa. Kasih nafas dulu, kasih gue ketenangan. Ya Tuhan, ada aja musibah menimpa hidup gue. Pokoknya maaf gak bisa ngomong banyak,&quot; tukasnya.
","Nikita Mirzani 
","Senin","2012-08-20","05:24:44","11NikitaMirzani.jpg","5","hiburan,selebritis");
INSERT INTO berita VALUES("613","19","admin","Lenovo Yakin Kalahkan Microsoft Surface","","","lenovo-yakin-kalahkan-microsoft-surface","N","N","N","Jakarta - Microsoft akan menjual tablet produksi sendiri yang bernama Surface. Beberapa mitra produsen PC kabarnya tak senang dengan kehadiran Surface yang dianggap sebagai pesaing. Namun Lenovo percaya diri tablet buatannya akan mampu mengalahkan Surface.<br />
<br />
&quot;Microsoft memang kuat di software, namun saya tidak percaya mereka bisa menyediakan hardware terbaik di dunia. Sedangkan Lenovo bisa,&quot; klaim CEO Lenovo, Yang Yuanqing.<br />
<br />
&quot;Meskipun kami tidak suka Microsoft membuat hardware, namun meskipun mereka memulai bisnis hardware ini, kami pikir itu hanya berarti satu kompetitor bertambah lagi,&quot; imbuhnya, yang TerasJakarta kutip dari ComputerWorld, Minggu (19/8/2012).<br />
<br />
Sebelumnya, kehadiran Microsoft Surface mendapat perlawanan dari Acer. Vendor komputer asal Taiwan itu menyatakan bahwa kedatangan Surface akan berdampak negatif bagi ekosistem industri PC.<br />
<br />
Di masa lalu, Microsoft memang selalu bermitra dengan vendor PC untuk membuat komputer berbasis sistem operasi Windows. Namun untuk Windows 8, mereka memutuskan membuat tablet PC sendiri.<br />
<br />
Bahkan, ada kabar yang beredar bahwa Surface akan dijual hanya USD 199. Jika benar, bisa jadi Surface sukses besar mengingat harganya yang sangat terjangkau. Kabarnya, Surface akan dipasarkan sekitar bulan Oktober mendatang, bersamaan dengan perkenalan resmi OS Windows 8.
","","Senin","2012-08-20","04:53:44","43Microsoft-Surface.jpg","7","teknologi");
INSERT INTO berita VALUES("614","19","admin","Zuckerberg akan Berhenti Pimpin Facebook?","Buntut Anjloknya di Bursa Saham","","zuckerberg-akan-berhenti-pimpin-facebook","N","N","Y","Jakarta - Harga saham Facebook terus terjun bebas. Rekor harga terendah terjadi baru-baru ini senilai USD 19,06 dari harga awalnya USD 38. Buruknya performa saham Facebook ini memunculkan spekulasi bahwa Mark Zuckerberg tidak seharusnya terus memimpin Facebook sebagai CEO.<br />
<br />
Seorang analis industri menilai bahwa Zuckerberg yang dikenal dengan dandanan kasualnya bisa fokus pada urusan teknologi di Facebook. Sedangkan bisnis Facebook dipegang oleh orang yang benar-benar kompeten.<br />
<br />
&quot;Saya pikir ada rasa kurang percaya terhadap kemampuannya untuk menjalankan korporasi,&quot; kata Andre Stoltman, pengacara sekuritas di New York yang TerasJakarta kutip dari ComputerWorld, Minggu (19/8/2012).<br />
<br />
&quot;Zuckerberg, dipandang dari sisi manapun memang adalah orang yang jenius. Akan tetapi Anda seharusnya memiliki chief executive yang dewasa dan lebih berpengalaman dalam menjalankan perusahaan tersebut,&quot; imbuhnya.<br />
<br />
Namun demikian, Zuckerberg tetap punya dukungan untuk terus memimpin Facebook. Patrik Moorhead, analis di Moor Insights &amp; Strategy, menyatakan masih terlalu awal untuk membicarakan kemungkinan pergantian CEO Facebook.<br />
<br />
&quot;Dia telah menyediakan visi yang diperlukan Facebook untuk menjadi sebesar sekarang dan mereka tetap akan membutuhkan dia sebagai pemandu. Zuckerberg harus tetap ada di posisi top sekarang,&quot; kata Patrik.<br />
<br />
Karten Weide selaku analis di IDC menyatakan pula bahwa Zuckerberg tidak akan memberi kesempatan pada orang lain untuk memimpin perusahaan yang didirikannya itu.<br />
<br />
&quot;Mark Zuckerberg tidak akan lengser dalam waktu dekat. Dia adalah pria dalam sebuah misi, yaitu ingin memaksa dunia, jika perlu, agar lebih terbuka. Dan sebagai pria dalam sebuah misi, dia tidak mengutamakan soal bisnis,&quot; demikian pendapat Karten.<br />
","<font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#000000\">Mark Zuckerberg</font>
","Jumat","2012-11-02","04:59:50","22Mark-Zuckerberg.jpg","25","teknologi");
INSERT INTO berita VALUES("610","2","admin","Max Biaggi Bantah ke Ducati Musim Depan ","","","max-biaggi-bantah-ke-ducati-musim-depan-","N","N","Y","Roma- Mantan pembalap MotoGP Max Biaggi tengah menikmati kariernya di World Super Bike (WSBK). Terlebih, pencapaiannya di musim ini cukup membuatnya bahagia.<br />
<br />
Biaggi masih memimpin di puncak klasemen WSBK musim ini dengan 272 poin. Hasil ini membuatnya semakin bersemangat untuk menorehkan lagi prestasi juara seperti yang ditorehkannya pada 2010.<br />
<br />
Situasi seperti itu, semakin membuat The Roman Emperor, julukan Biaggi, nyaman membela timnya Aprilia. Makanya, saat disinggung masalah isu kepindahannya ke Ducati musim depan, Biaggi buru-buru membantah. Dia menegaskan ingin mengakhiri kariernya bersama Aprilia.<br />
<br />
Setelah empat tahun melanglang buana di ajang MotoGP dengan prestasi terbaik menjadi runner-up pada musim pertamanya bersama Yamaha, Biaggi memutuskan hengkang pada 2005. Dua tahun berikutnya, pembalap kelahiran Juni 1971 ini terjun ke arena WSBK.<br />
<br />
Sebelum berlabuh di Aprilia, Biaggi lebih dulu bergabung dengan Suzuki di tahun pertamanya, dan setahun berikutnya ke Ducati sebelum akhirnya melompat ke Aprilia pada 2009.
","Max Biaggi.
","Minggu","2012-08-19","05:13:20","6max_biaggi.jpg","10","olahraga");
INSERT INTO berita VALUES("611","2","admin","Duel Swiss di Semifinal Cincinnati Masters","Tenis Cincinnati Masters 2012","","duel-swiss-di-semifinal-cincinnati-masters","N","N","N","Cincinnati - Dua petenis asal Swiss berhasil mengempaskan lawan-lawannya dan akan bertemu di semifinal Cincinnati Masters. Stanislas Wawrinka sukses membungkam petenis Kanada, Milos Raonic, sementara Roger Federer berhasil menumbangkan Mardy Fish.<br />
&nbsp;<br />
Wawrinka mengalahkan Raonic dengan pertarungan sengit. Bahkan sebelumnya, petenis 27 tahun tersebut sempat tertinggal di set pertama. Pada set awal tersebut, Wawrinka takluk 2-6.<br />
&nbsp;<br />
Namun pada set kedua, Wawrinka mampu mengendalikan permainan, dia mampu mengembalikan dengan baik pukulan keras dari Raonic. Hingga akhirnya sukses merebut set kedua ini dengan skor 7-6.<br />
&nbsp;<br />
Setelah berhasil menyamakan keadaan, Wawrinka terus mendominasi dan mengakhiri perlawanan Raonic dengan skor akhir di set ketiga 6-4. &ldquo;Saya bermain hebat setelah menjalani dua bulan yang menyulitkan,&rdquo; ujar Wawrinka, seperti disitat Yahoo Sports, Sabtu (18/8/2012).<br />
&nbsp;<br />
Nantinya di babak semifinal, Wawrinka bakal menghadapi rekan senegaranya, Federer yang menghentikan langkah Fish dengan skor 6-3 7-6. Dengan gugurnya Fish atas Federer, maka tak ada satu pun petenis Amerika yang berpeluang menjadi juara di kandang sendiri.<br />
","Stanislas Wawrinka.
","Minggu","2012-08-19","05:22:25","46Stanislas-Wawrinka.jpg","8","olahraga");
INSERT INTO berita VALUES("612","19","admin","Google Pakai Motorola untuk Gugat Apple","","","google-pakai-motorola-untuk-gugat-apple","N","N","N","Jakarta - Perang gugatan antara para produsen smartphone belum menunjukkan tanda berakhir. Yang terbaru, Motorola menuding Apple melanggar tujuh patennya.<br />
<br />
Vendor ponsel yang diakuisisi Google pun meminta pihak berwewenang untuk memblokir impor iPhone, iPad dan komputer Mac. Perangkat-perangkat tersebut diminta dilarang beredar di Amerika Serikat.<br />
<br />
Komplain Motorola didaftarkan ke lembaga International Trade Comission (ITC). Paten yang dipermasalahkan terkait location reminders, notifikasi email, pemutar video dan sebagainya.<br />
<br />
&quot;Kami ingin menyelesaikan persoalan paten tersebut, namun ketidakmauan Apple untuk melisensinya membuat kami tidak punya pilihan selain mempertahankan inovasi kami,&quot; demikian pernyataan Motorola yang TerasJakarta kutip dari DigitalTrends, Minggu (19/8/2012).<br />
<br />
Hal ini dinilai sebagai perang antara Google dan Apple, dengan Google menggunakan paten Motorola untuk menyerang Apple. Terlebih lagi, Apple banyak memperkarakan vendor Android seperti Samsung dan juga Motorola sendiri.
","","Senin","2012-08-20","04:49:48","7google_motorola.jpg","9","teknologi");
INSERT INTO berita VALUES("608","39","admin","Bos Amazon Temukan Mesin Apollo 11","","http://www.youtube.com/embed/mxMiN9iYlkQ","bos-amazon-temukan-mesin-apollo-11","N","N","N","Jeff Bezos, pendiri retailer online terbesar Amazon, mengumumkan bahwa ia dan timnya telah menemukan 5 mesin Apollo 11 yang jatuh pada tahun 1969 di Samudera Atlantik.<br />
<br />
Kini, Jeff Bezos merencanakan untuk mengangkat satu atau dua dari mesin tersebut ke permukaan untuk kemudian dipamerkan di Museum Penerbangan di kampung halamannya, Seattle. Sebelumnya, Jeff Bezos akan meminta izin terlebih dahulu kepada Nasa selaku pemilik dari Apollo 11.<br />
<br />
Seluruh biaya yang diperlukan dalam ekspedisi dan pengangkatan mesin Apollo 11 akan ditanggung oleh Jeff Bezos sendiri. Sementara itu, Nasa menyatakan akan menunggu kabar lebih lanjut tentang penemuan oleh tim Jeff Bezos tersebut.<br />
<br />
Mesin berkekuatan 32 juta tenaga kuda (hp) yang mampu membakar 6.000 pon kerosin dan oksigen cair per detik tersebut telah membawa Apollo 11 mendarat dengan sukses di bulan pada tahun 1969. Namun dalam perjalanan kembali ke bumi, mesin tersebut terbakar hingga terjatuh di Samudera Atlantik dan belum ditemukan hingga akhirnya Jeff Bezos mengumumkan berita ini.
","","Senin","2012-11-19","04:51:31","16JeffBezos.jpg","49","internasional");
INSERT INTO berita VALUES("609","2","admin","Liverpool Ucapkan Selamat Hari Kemerdekaan RI","","","liverpool-ucapkan-selamat-hari-kemerdekaan-ri","N","N","N","Liverpool - Melalui situs resmi klub, Liverpool mengucapkan selamat hari kemerdekaan kepada semua pendukung The Reds di Indonesia. Dalam halaman khusus, Liverpool merilis pernyataan resmi memakai dua bahasa, Indonesia dan Inggris.<br />
<br />
&quot;Kepada semua pendukung The Reds di Indonesia,<br />
<br />
Izinkan kami mengucapkan Selamat Hari Kemerdekaan bagi semua pendukung Liverpool FC se-Indonesia. Sebagai rasa terima kasih kami akan dukungan yang luar biasa kepada LFC, tahun ini kembali lagi kami membuat laman khusus, hanya untuk Anda!<br />
<br />
DIRGAHAYU KE-67 REPUBLIK INDONESIA!&quot;<br />
<br />
Dalam kesempatan itu juga Liverpool membeberkan beberapa program klub di Indonesia. Termasuk diantaranya mendirikan beberapa akademi sepak bola untuk menjaring pemain berbakat di Indonesia.<br />
<br />
Liverpool juga berencana mencari pemain Indonesia berbakat yang bakal masuk dalam skuad Indo elite LFCIA saat The Reds mengunjungi tanah air tahun 2013 mendatang.
","Banner khusus dalam situs resmi Liverpool untuk Indonesia &copy; LFC
","Minggu","2012-08-19","05:07:05","36banner_dirgahayuRI.jpg","8","bola,olahraga");
INSERT INTO berita VALUES("598","40","admin","Laksa Betawi yang Menggugah Selera","","","laksa-betawi-yang-menggugah-selera","N","N","N","Makanan khas betawi yang satu ini memang sudah agak jarang bisa ditemui. Namun bukan berarti punah. Di beberapa lokasi tertentu, anda masih bisa menemukan Laksa betawi. Bagi anda yang belum mengetahui apa itu Laksa Betawi, Laksa betawi adalah Penganan berjenis mie yang diberi bumbu. Laksa Betawi memiliki kuah berwarna kekuningan. Campuran udang rebon yang ada dalam kuah laksa, membuat rasanya menjadi segar dan di padu aroma khas udang.<br />
<br />
Selain itu, Makanan ini menggunakan Ketupat. Isi dari ketupat laksa betawi adalah irisan ketupat, telur, kemangi, tauge. kucai, bihun, perkedel, dan bawang goreng, serta kuahnya yang kental dengan taburan udang kering. Namun ada yang bilang bahwa Bihun dan perkedel hanya variasi tambahan dari laksa, bukan bawaan asli nya.<br />
<br />
Cara lain untuk menikmati Laksa adalah menggunakan Semur betawi. Paduan rasa manis pada semur, tentu nya akan menambah rasa gurih di lidah. Namun hal ini bukan suatu keharusan. Tergantung selera masing-masing.<br />
<br />
Cara mengolah Laksa Betawi<br />
<br />
Mengolah laksa betawi susah-susah gampang. Bumbunya sederhana, terdiri dari kunyit, lengkuas, sereh, daun salam, daun jeruk, jahe, jintan, lada, temu kunci, serta dua kilogram udang rebon. Semua bumbu dihaluskan dengan lumpang lalu ditumis dan dicampur dengan santan cair.<br />
<br />
Bumbu baru ditambahkan dengan santan kental. Proses ini dilakukan sampai tiga kali. Sejak dahulu hingga sekarang. Dengan proses yang agak rumit, tidak aneh kalau makanan ini jadi agak langka. Orang maunya langsung jadi tanpa memikirkan cara pembuatannya.<br />
<br />
","","Kamis","2012-10-25","02:13:20","87laksa-betawi_yang_menggugah_selera.jpg","8","kuliner");
INSERT INTO berita VALUES("599","40","admin","Semur, Aslinya dari Belanda","","","semur-aslinya-dari-belanda","N","N","N","Jangan merasa tidak terima jika dikatakan bahwa semur adalah hidangan Belanda. Sebab, di balik semur memang ada riwayat nusantara, bukti bagaimana silang budaya terjadi antara Indonesia dan Eropa, demikian menurut ahli kajian budaya Dr phil Lily Tjahjandari.<br />
<br />
Percaya tidak, Indonesia ternyata sudah meramu berbagai makanan dengan berbagai jenis rempah sejak abad pertama. Hal ini terjadi karena posisi Indonesia terletak di tengah jalur perdagangan dunia.<br />
<br />
Kekayaan rempah Indonesia ini lalu mengundang berbagai bangsa untuk datang dan mengeksplorasi citarasa rempah. Diawali dengan kedatangan pedagang India pada abad 1-7, dan diikuti oleh pedagang China dan Arab. Perdagangan rempah kemudian membuka jalan ekspansi masif bangsa Eropa pada abad 16-19. Mereka menjelajah wilayah Indonesia untuk menemukan rempah-rempah, dan memulai terjadinya interaksi budaya kuliner antara Eropa dan Indonesia.<br />
<br />
&quot;Sebelumnya, penguat rasa makanan Eropa hanya terbatas pada tomat, ceri, bawang bombai, madu, atau wine,&quot; ungkap Lily, yang juga Manajer Penelitian dan Pengabdian Masyarakat Fakultas Ilmu Pengetahuan Budaya Universitas Indonesia. Orang Eropa lalu mendapatkan inspirasi untuk menggunakan berbagai rempah Asia untuk mengolah makanan Eropa.<br />
<br />
Nah, ketika keahlian meramu bumbu khas Indonesia seperti lada, kayu manis, jahe, kemiri, cengkeh itu berpadu dengan teknik memasak bangsa Eropa, hadirlah hidangan unik seperti semur. Semur sendiri asalnya dari bahasa Belanda, smoor, yang artinya masakan daging yang direbus dengan tomat dan bawang secara perlahan.<br />
<br />
&quot;Ketika itu, orang Eropa yang bisa memasak dengan rempah-rempah dianggap sebagai kalangan aristokrat. Hidangan semur ini diterima dengan baik oleh lidah kaum priyayi Belanda, dan menjadi menu rijsttafel,&quot; kata Lily, saat talkshow bertema &quot;Semur, Turun-Temurun Menghangatkan Hati Keluarga Indonesia&quot; di Restoran Warung Daun, Kebayoran Baru, Jakarta Selatan, beberapa waktu lalu.<br />
<br />
Rijstaffel merupakan konsep penyajian makanan lengkap ala restoran di Eropa, yang diawali dengan hidangan pembuka, hidangan utama, dan hidangan penutup. Namun hidangan yang disajikan bukan hidangan Eropa, melainkan menu Indonesia dimana nasi sebagai makanan utama dinikmati dengan lauk-pauk.<br />
<br />
Sebenarnya, semur itu sendiri bukan makanan asli Belanda. Semur, menurut pakar kuliner Chef Ragil Imam Wibowo, merupakan persepsi bangsa Indonesia dari hidangan tradisional Belanda yang bernama hachee. Hachee merupakan hidangan daging rebus yang dipotong-potong, kadang-kadang juga menggunakan ikan, burung, dan sayuran. Bumbu dasarnya adalah bawang dan rasa asam (biasanya didapat dari cuka atau wine). Cengkeh dan daun salam lalu ditambahkan ke dalam kuah kaldunya yang kental.<br />
<br />
Hachee kelak menjadi trigger untuk hidangan semur. Dalam versi Indonesia, semur ini menggunakan bumbu bawang merah, bawang putih, dengan tambahan berbagai rempah lain untuk menguatkan rasa, seperti ketumbar, pala, lada, cengkeh, dan kayu manis. Semur lalu menjadi istimewa karena menggunakan kecap sebagai penguat rasa manis yang legit, dan memberi warna coklat yang menggugah selera.<br />
<br />
&quot;Kecap itu idenya ketika orang Indonesia berimajinasi bagaimana membuat warna coklatnya. Pada hachee, warna coklat didapat dari brownstock, yaitu kaldu dari tulang sapi yang dibakar. Orang Indonesia lalu mencari, apa yang kira-kira bisa memberi warna dan rasa yang diinginkan,&quot; ujar Chef Ragil dalam acara yang sama.<br />
<br />
Semur kemudian melekat menjadi tradisi bangsa Indonesia., dan menjadi menu favorit setiap keluarga Indonesia. Menu ini hadir dengan inovasi bumbu dan topping yang beraneka ragam. Jika awalnya semur identik dengan daging sapi, Anda bisa menemukan semur daging kambing, ayam, telur, tahu, tempe, terong, dan bahkan ikan. Dan semuanya lezat!<br />
<br />
<br />
","","Minggu","2012-11-11","02:17:45","16semur_asli-dari-belanda.jpg","8","kuliner");
INSERT INTO berita VALUES("600","40","admin","Ikan Asin Bukan Makanan Orang Miskin","","","ikan-asin-bukan-makanan-orang-miskin","N","N","N","Ikan asin tergolong makanan yang populer, karena mudah sekali ditemukan di pasar. Harganya yang murah membuat ikan asin kerap disantap oleh masyarakat dengan ekonomi lemah.<br />
<br />
&quot;Tak heran kalau, ikan asin akhirnya menjadi simbol rakyat miskin atau wong cilik,&quot; tukas sejarawan JJ Rizal, saat diskusi &quot;Kuliner Nusantara dan Kebudayaan,&quot; di Fakultas Ilmu Budaya, Universitas Indonesia, Depok.<br />
<br />
Karena terlanjur suka dan terbiasa, masyarakat Indonesia dari kelas sosial yang lebih rendah sampai kini masih sering menyantap ikan asin. Selain murah dan enak, ikan asin juga praktis karena tahan lama.<br />
<br />
Namun menurut Rizal, simbol ikan asin sebagai makanan wong cilik ini sebaiknya tidak perlu ditonjolkan. Secara tak langsung, hal itu akan menyebabkan jurang pemisah antara masyarakat kaya dan miskin semakin tajam. &quot;Harus ada upaya dari pemerintah untuk menghilangkan simbol ikan asin adalah makanan wong cilik,&quot; tegasnya.<br />
<br />
Upaya ini perlu dilakukan, karena dalam kenyataannya ikan asin bukan monopoli rakyat miskin saja.<br />
<br />
&quot;Banyak juga kok orang kaya dan pejabat negara yang makan ikan asin, cuma mereka tidak ngaku saja. Hanya jaga gengsi. Padahal tidak ada yang salah dengan makan ikan asin. Seharusnya malah mereka merakyat dan lebih prihatin, bukan malah ikut-ikutan untuk makan mewah,&quot; tambah Rizal.<br />
<br />
Cukup ditemani sayur asem, sambal superpedas, dan kerupuk, ikan asin memang sudah menjelma menjadi lauk yang &quot;mewah&quot;. Bagaimana dengan Anda? Apakah ikan asin juga menjadi bagian dari hidangan Anda sehari-hari?<br />
","","Selasa","2012-10-09","02:27:57","75ikan-asin-bukan-makanan-orang-miskin.jpg","11","kuliner");
INSERT INTO berita VALUES("601","40","admin","Es Teler, Sejarahmu Dulu dan Kini","","","es-teler-sejarahmu-dulu-dan-kini","N","N","N","Es Teler adalah minuman es berisi potongan buah alpukat, kelapa muda, nangka matang, dan santan kelapa encer dengan pemanis berupa sirup. Es yang dipakai bisa berupa es serut atau es batu.<br />
<br />
Variasi lain es teler berisi cincau, kolang-kaling, dan pacar china, potongan buah apel, pepaya, sawo, melon, roti, dan agar-agar, hingga es teler menjadi sulit dibedakan dengan es campur.<br />
<br />
Es Teler adalah jenis Kuliner yang murni &quot;Fresh from Nature&quot;, Tanpa diolah, hanya dipotong dan dibersihkan, lalu di beri kuah rasa sesuai selera dan di minum/makan dingin. Sehingga kandungan Gizi yang terdapat dalam buah yang dipakai otomatis masih baik. Es Teler --&gt; recomended deh sebagai makanan penutup dibanding makanan penutup olahan.<br />
<strong><br />
Sejarah Es Teler</strong><br />
<br />
Es teler diciptakan Tukiman Darmowijono, pedagang es campur dengan gerobak di Jalan Semarang Jakarta Pusat pada tahun 1980-an. Es campur kreasi Tukiman begitu enak sehingga anak-anak muda yang meminumnya mengaku keenakan seperti &quot;teler&quot; akibat mengkonsumsi narkoba. Es kelapa muda bercampur alpukat yang dijual Tukiman di Jalan Semarang kemudian dikenal sebagai &quot;es teler.&quot;<br />
<br />
Kepopuleran es yang bikin teler makin mencuat berkat promosi dari mulut ke mulut dan liputan media massa. Pembeli yang datang bermobil menimbulkan antrian parkir mobil yang dirasakan penduduk Jalan Semarang dan sekitarnya sebagai pengganggu ketenangan. Es teler Tukiman harus pindah ke Jalan Pegangsaan Barat dan kemudian ke dalam kompleks bioskop Megaria. Kedai es teler Tukiman di kompleks bioskop Megaria sekarang bernama kedai ayam bakar dan es teler Sari Mulia Asli.<br />
<br />
Waralaba nasional Es Teler 77 Juara Indonesia didirikan Sukyatno Nugroho, setelah sang mertua bernama Ny Murniati Widjaja menjuarai lomba es teler nasional di tahun 1982. Gerai Es Teler 77 yang pertama terdapat di pertokoan Duta Merlin, Harmoni, Jakarta Pusat. Di gerai Es Teler 77 juga tersedia berbagai makanan pendamping seperti mi bakso dan nasi goreng. Di luar negeri, gerai Es Teler 77 terdapat di Australia, Malaysia, dan Singapura.<br />
","","Jumat","2012-11-02","02:33:43","16es-teler-sejarahmu-dulu-dan-kini.jpg","20","kuliner");
INSERT INTO berita VALUES("602","2","admin","La Nyalla Kembalikan Riedl Jadi Pelatih Timnas","","","la-nyalla-kembalikan-riedl-jadi-pelatih-timnas","Y","N","N","Jakarta - Jakarta - Setelah membentuk Timnas, PSSI versi KLB pimpinan La Nyalla Mahmud Matalitti menunjuk Alfred Riedl sebagai pelatihnya.<br />
<br />
Pria asal Austria itu sebelumnya pernah menukangi Timnas, namun dipecat pada 13 Juli 2011 akibat kisruh ditubuh PSSI. Dengan penunjukan itu, berarti Riedl akan kembali jadi peramu permainan skuad &#39;Pasukan Garuda&#39; jelang Piala AFF di Malaysia, November mendatang. <br />
<br />
Menurut Acting Sekjen PSSI Tigor Shalom Boboy,&nbsp; Riedl ditunjuk oleh Direktur Teknik Timnas Benny Dollo yang sebelumnya diberi mandat oleh PSSI&nbsp; Rabu (8/8/2012) lalu. <br />
<br />
&quot;Benny Dollo telah memberikan rekomendasinya terkait posisi pelatih kepala tim nasional senior kepada Exco PSSI melalui Ketua Umum La Nyalla Mahmud Mattalitti. Posisi pelatih kepala tim nasional senior yg direkomendasikan oleh Benny Dollo selaku Direktur Teknik adalah Alfred Riedl,&quot; ujar Tigor melalui rilis yang diterima INILAH.COM, Kamis (16/8/2012).<br />
<br />
Tigor mengungkapkan bahwa Riedl sudah menyatakan kesediaannya terhadap penunjukannya sebagai pelatih kepala tim nasional senior. Pria 62 tahun itu akan&nbsp; tiba di Indonesia pada akhir Agustus 2012.<br />
<br />
Setelah itu, Riedl akan langsung menyusun nama-nama siapa saja yang akan masuk dalam tim besutannya.<br />
<br />
&quot;Susunan Managemen dan Official serta pemain Tim Nasional akan diumumkan pasca lebaran menunggu konfirmasi pelatih kepala Alfred Riedl,&quot; tukas Tigor.<br />
<br />
Sebelumnya, pihak PSSI KLB pimpinan La Nyalla menyatakan membentuk Timnas sendiri setelah mandegnya pertemuan Joint Committee PSSI. Menurut pihak La Nyalla, seharusnya pembentukan Timnas dibahas di komite bersama tersebut melibatkan dua belah pihak, antara kubu Djohar Arifin dengan pihaknya.<br />
<br />
Piala AFF akan diselenggarakan 22 November hingga 22 Desember 2012 dengan tuan rumah Malaysia dan Thailand. Indonesia akan bermain di Grup B yang bertempat di Malaysia bersama Malaysia, Singapura dan Runner Up babak penyisihan.
","","Minggu","2012-08-19","03:19:23","84alfred-riedl6.jpg","12","bola,olahraga");
INSERT INTO berita VALUES("603","19","admin","4 Teknologi yang Bakal Bertahan Sampai 2030","","","4-teknologi-yang-bakal-bertahan-sampai-2030","Y","Y","N","Perkembangan teknologi telah mengantarkan berbagai perangkat yang lebih kecil, cepat dan tangguh ke dalam genggaman tangan. Ada juga yang telah ditinggalkan atau digantikan teknologi lain, seperti sebuah floppy disk. &nbsp;<br />
Selain teknologi yang ditiggalkan, ada juga beberapa teknologi yang diprediksi akan tetap bertahan sampai puluhan tahun ke depan. Seperti dilansir Live Science, Sabtu (18/8/2012), berikut empat teknologi yang diprediksi akan bertahan sampai 2030.<br />
<br />
<strong>1. Papan Ketik QWERTY</strong><br />
Teknologi untuk melakukan input telah semakin banyak, ada voice recognition, handwriting recognition dan gesture control. Ini diperkiraka akan semakin akurat dan populer dalam dua dekade ke depan. Namun, sampai nanti ditemukan cara input teks menggunakan kendali pikiran, metode mengetik akan tetap sebuah metode menyusun teks yang paling akurat.<br />
Kehadiran papan ketik di tablet dan telefon genggam memang semakin terancam, namun layout QWERTY yang sejak dulu digunakan akan terus hidup.<br />
<br />
<strong>2. PC</strong><br />
Beberapa orang berpendapat kita sedang memasuki zaman pasca PC. Pasalnya kini orang semakin sering menghabiskan waktu menggunakan smartphone dan tablet ketimbang menggunakan komputer desktop tradisional berbasis Windows atau Mac.<br />
Namun di sisi lain, ketika sudah waktunya menggarap pekerjaan yang benar-benar serius, terutama yang melibatkan multitasking, PC masih merupakan perangkat yang&nbsp; paling bisa diandalkan.<br />
&nbsp;<br />
Pada 2030, ukuran serta bentuk PC mungkin akan berubah. Beberapa orang bahkan berpendapat bahwa dengan adanya prosesor berotak empat, telefon genggam dan tablet menjelma menjadi PC. Tetap saja, apapun faktor yang mempengaruhi, pengguna yang fokus pada produktivitas akan membutuhkan sebuah komputer utama dengan kemampuan proses yang tinggi dan sanggup multitasking.<br />
&nbsp;<br />
<strong>3. USB Ports</strong><br />
Sekarang telah lebih dari 15 tahun sejak USB pertama kali diperkenalkan dan kita akan sulit membayangkan hidup tanpa USB. Ini hampir menjadi sebuah standar untuk membuat Anda bisa menransfer data dan menghubungkan dengan berbagai hal seperti papan ketik atau harddisk eksternal. Beberapa orang berpendapat bahwa standar seperti Thunderbolt dari Intel akan menandingi USB, tapi mereka tidak memiliki dasar instalasi untuk menandingi USB. Standar ini diprediksi akan semakin berkembang ke depannya.<br />
<strong><br />
4. Uang Tunai</strong><br />
Ada beberapa perdebatan mengenai apakah kartu kredit dan debit akan sepenuhnya digantikan oleh sistem pembayaran mobile dalam beberapa tahun ke depan. Walau bagaimanapun, uang tunai tampaknya akan tetap dibawa meski pada 2030.<br />
&nbsp;<br />
Pasalnya di era informasi ini, membayar dengan uang tunai adalah cara terbaik untuk membuat pembelian yang Anda lakukan tetap anonim dan pribadi. Selain itu, uang kertas memiliki perlindungan terbaik dalam melawan pencuri indentitas karena orang yang menerima pembayaran tidak harus mengetahui nama Anda.
","","Sabtu","2012-11-17","03:27:34","5technology-gadgets.jpg","11","teknologi");
INSERT INTO berita VALUES("604","39","admin","Usai China, Indonesia Tuan Rumah Miss World 2013","","","usai-china-indonesia-tuan-rumah-miss-world-2013","Y","N","N","Masyarakat Indonesia pantas bahagia dua kali lipat saat penyelenggaraan final Miss World 2012. Bukan saja prestasi Ines Putri yang masuk dalam jajaran 15 besar, tetapi Indonesia juga diumumkan menjadi lokasi penyelenggaraan Miss World 2013.<br />
&nbsp;<br />
Ajang Miss World 2012 di Ordos, Mongolia, China, berlangsung sukses. Diikuti 116 finalis dari seantero dunia, Miss World yang diselenggarakan ke-62 tahun ini akhirnya mendaulat Wenxia Yu sebagai Miss World 2012.<br />
<br />
Selama setahun, wakil dari Republik Rakyat China ini akan berkeliling dunia dan menjalankan misi sosial dalam program yang dikemas secara baik bernama Beauty with a Purpose.<br />
<br />
Adapun masa tugas terakhir dari pemilik tinggi badan 177 sentimeter ini akan dilakukan saat penyelenggaraan Miss World 2013 di Indonesia. Dan, kepastian soal lokasi penyelenggaraan Miss World dilakukan secara simbolis saat malam final Miss World 2012. Saat itu, Nana Putra, Managing Director MNC Group menerima bendera Miss World.<br />
<br />
Rencananya, Miss World 2013 diselenggarakan September dengan mengambil lokasi karantina di Bali. Sementara itu, Jakarta sebagai Ibu Kota Indonesia dipilih menjadi lokasi malam final Miss World 2013.<br />
<br />
&ldquo;Jakarta akan menjadi tuan rumah malam final Miss World 2013. Namun tepatnya di mana lokasi tersebut, kami belum bisa memastikan,&rdquo; tutur Kanti Mirdiati kepada Okezone di Blacksteer Lounge, Belleza Shopping Arcades, Permata Hijau, Jakarta, belum lama ini.<br />
<br />
Project Director Miss Indonesia &amp; Managing Director RCTI ini pun menjelaskan alasan Jakarta dipilih sebagai lokasi malam final Miss World 2013.<br />
<br />
&ldquo;Ini merupakan bagian dari upaya memperkenalkan Jakarta dan Indonesia sendiri ke mata dunia. Kebanyakan orang luar negeri tahu Bali, tapi tidak tahu kalau Bali ada di Indonesia. Mereka mengira bahwa Bali itu sebuah negara,&rdquo; ucap wanita ramah ini.
","","Minggu","2012-08-19","03:37:05","85missworld.jpg","14","internasional");
INSERT INTO berita VALUES("605","39","admin","Memalukan! Bu Guru di AS Bercinta dengan 4 Muridnya ","Didakwa Penyimpangan Seks","","memalukan-bu-guru-di-as-bercinta-dengan-4-muridnya-","Y","N","N","Texas - Memalukan! Seorang guru SMA di Amerika Serikat diadili karena berhubungan seks dengan empat muridnya sementara murid kelima merekam aksi mesum tersebut.<br />
<br />
Wanita bernama Brittni Colleps tersebut dikenai sejumlah dakwaan, termasuk seks menyimpang dan hubungan tidak pantas antara pendidik dan pelajar.<br />
<br />
Wanita berumur 28 tahun itu tadinya merupakan guru Bahasa Inggris di SMA Fort Worth, Texas. Di persidangan yang digelar hari ini seperti dilansir MyFoxDFW.com, Kamis (16/8/2012), terungkap bahwa terdakwa yang telah memiliki tiga anak itu, menggunakan pesan-pesan SMS untuk mendekati kelima pelajar putra tersebut.<br />
<br />
Salah seorang remaja mengaku, dia dan Colleps berkirim 100 SMS dalam satu hari saat musim semi pada tahun 2010. Pesan-pesan itu kemudian kian menjadi-jadi sehingga akhirnya mereka sepakat untuk bertemu guna bercinta.<br />
<br />
&quot;Dia (Colleps) bilang dia mendambakan... bahwa saya punya sesuatu yang dia inginkan,&quot; kata remaja tersebut.<br />
<br />
Diungkapkan remaja laki-laki tersebut, dalam satu kesempatan, empat remaja berhubungan intim dengan bu guru yang telah dipecat tersebut. Para remaja tersebut sebenarnya sudah bisa digolongkan dewasa, namun hukum melindungi para pelajar dari hubungan dengan seseorang yang jabatannya lebih tinggi, dalam hal ini guru.<br />
<br />
Seorang remaja lainnya merekam adegan seks tersebut dengan video telepon genggamnya. Video tersebut diputar di persidangan.<br />
<br />
Jika terbukti bersalah, Colleps terancam hukuman penjara maksimum 20 tahun. Suaminya, Christopher Colleps, seorang tentara AS, telah menegaskan bahwa dirinya akan terus mendukung istrinya dan bahwa mereka akan tetap mempertahankan rumah tangga mereka.
","Brittni Colleps (foto:abc)
","Minggu","2012-08-19","04:20:50","97abc_brittni_colleps.jpg","23","internasional");
INSERT INTO berita VALUES("606","42","admin","Astagfirullah, Festival Wine Digelar di Halaman Masjid ","","","astagfirullah-festival-wine-digelar-di-halaman-masjid-","N","N","N","Beer El-Sabe - Kelompok Muslim menyatakan kemarahannya atas rencana penyelenggaraan Festival Wine di kota Beer el-Sabe, Israel. Kemarahan karena, penyelenggaraan akan dilaksanakan di halaman luar sebuah bangunan bekas masjid kuno di wilayah tersebut.<br />
<br />
Menurut laporan media Israel, Gerakan Islam di Israel mengatakan festival ini merupakan &quot;dosa tak termaafkan&quot;. Festival juga dianggap sebagai pukulan keras bagi umat Muslim di sana Sebab menurut kelompok Muslim tersebut, publisitas festival anggur merupakan penghinaan terhadap sensitivitas Muslim. Seperti diketahui Islam melarang konsumsi alkohol.<br />
<br />
Festival &quot;Salut Wine dan Beer Festival&quot; ke enam ini rencananya akan diselenggarakan di pelataran sebuah bangunan bekas masjid di Beer el-Sabe, pada 5-6 September. Festival akan menampilkan minuman beralkohol dari sekitar 30 pabrik dan perkebunan anggur di seluruh negeri.<br />
<br />
Pusat Hukum untuk Hak Minoritas Arab di Israel, Kamis (16/8) lalu, mengirimkan surat pada Jaksa Agung, Menteri Kebudayaan dan Olahraga Israel serta Kotamadya Beer el-Sabe. Mereka menuntut agar festival Wine di wilayah tersebut dibatalkan. &quot; Penggunaan pelataran Masjid untuk festival minuman beralkohol adalah sesuatu yang sensitif. Sebab Islam melarang konsumsi alkohol dan tak sesuai dengan penggunaan masjid untuk beribadah,&quot; tulis organisasi tersebut dalam surat ke Jaksa Aram Mahameed.<br />
<br />
Surat juga menambahkan, Festival Wine melanggar keputusan Mahkamah Agung Israel yang keluar Juni 2011 lalu. Dalam keputusan tersebut memerintahkan masjid untuk diubah menjadi museum sejarah dan kebudayaan Islam.<br />
<br />
Masjid yang dibangun pada Era Usmani pada 1906 ini sempat menjadi tempat ibadah hingga 1948. Kemudian berubah menjadi penjara dan pengadilan hingga 1952. Lalu dari 1953-1991 dibuka sebagai Museum Tanah Negeb. Pada 2002 sempat ada sebuah petisi yang meminta masjid untuk dibuka kembali sebagai tempat ibadah.
","","Minggu","2012-08-19","04:32:25","42festival_wine.jpg","20","dunia-islam");
INSERT INTO berita VALUES("607","39","admin","Moskow Larang Parade Gay Selama 100 Tahun","","","moskow-larang-parade-gay-selama-100-tahun","Y","Y","N","<p>
Pengadilan di Moskow mengukuhkan keputusan untuk melarang parade homoseksual untuk seratus tahun ke depan.<br />
<br />
Langkah ini dilakukan menyusul upaya pegiat hak homoseksual Rusia, Nikolay Alexeyev untuk membatalkan keputusan pemerintah kota melarang parade.<br />
<br />
Ia meminta hak melakukan parade selama 100 tahun ke depan.<br />
<br />
Alexeyev juga menentang larangan kota St Petersburgh untuk menyebarkan &quot;propaganda homoseksual.&quot;
</p>
<p>
Mahkamah hak asasi Eropa telah  meminta pemerintah Rusia untuk membayar kerugian kepada Alexeyev.
</p>
<p>
Alexeyev mengatakan Jumat (17/08) ia akan kembali ke Mahkamah Eropa untuk meminta agar menetapkan bahwa larangan itu tidak adil.
</p>
<p>
Pemerintah kota Moskow menyatakan parade gay akan menimbulkan risiko gangguan ketertiban umum.
</p>
<p>
Pemkot juga mengatakan sebagian besar warga Moskow menentang kegiatan itu.
</p>
<p>
Bulan September lalu, Dewan Eropa -pengawasan 
HAM di Eropa- akan meneliti tanggapan Rusia atas keputusan Mahkamah 
Eropa sebelumnya tentang hak gay, menurut media Rusia.
</p>
<p>
Bulan Oktober 2010, Mahkamah Eropa mengatakan Rusia melakukan diskriminasi terhadap Alexeyev karena orientasi seksualnya.
</p>
<p>
Mahkamah saat itu menangani larangan Moskow atas parade gay antara tahun 2006-2008.
</p>
","Nikolay Alexeye. 
","Sabtu","2012-11-17","04:43:57","7Nikolay-Alexeyev.jpg","20","internasional");
INSERT INTO berita VALUES("597","44","admin","Pasar Tiban Kalibata Selalu Ramai Pengunjung","","","pasar-tiban-kalibata-selalu-ramai-pengunjung","Y","Y","N","Jakarta - Pasar tiban, atau pasar musiman, istilah untuk menjelaskan pasar yang musiman, tidak punya tempat menetap. Ada juga istilah pasar malam, pasar tumpah atau pasar kaget. Biasanya pasar ini mengambil waktu tertentu misalnya: bulan puasa, atau hari tertentu yang libur. Pasar tiban di Kalibata &lsquo;buka&rsquo; tiap hari minggu.<br />
<br />
Bermacam-macam barang dijajakan, mulai dari pakaian, mainan anak-anak, sepatu, tas, tanaman hias, jajan pasar, peralatan rumah tanggga, sprei, parfum, buku dan majalah bekas, pigura, dll. Semua dengan harga murah. Pasar ini mengambil tempat sepanjang jalan dari menuju Stasiun Kalibata sampai depan STEKPI, samping periumahan DPR RI Kalibata.<br />
<br />
Pasar ini awalnya tidak begitu ramai. Waktu itu setiap hari minggu di danau Taman Makam pahlawan (TMP) Kalibata banyak orang yang melakukan olah raga pagi. Muda-mudi paling banyak. Hukum ekonomi berjalan, di mana ada keramaian selalu ada yang menggunakan peluang. Maka ada orang jualan bubur ayam, lontong sayur, ketoprak dan lainnya. Mengambil tempat sempit di depan gerbang parkir TMP.<br />
<br />
Lama-lama ada yang berjualan pakaian, mainan, poster, dan lainnya. Semakin banyak yang berjualan dan mengambil tempat di sepanjang jalan depan TMP. Di sini mulai ada masalah, kemacetan. Mungkin karena pengunjung semakin banyak, membuat kemacetan, pasar &lsquo;dipindah&rsquo; ke dalam. Hingga sekarang. Sebenarnya tidak tahu dipindah atau pindah sendiri, mungkin pihak berwenang berprinsip, yang penting tidak mebuat jalan macet.<br />
<br />
Jadilah seperti sekarang, pasar tiban menjadi hiburan sendiri untuk warga Kalibata, Pancoran, Pasar minggu dan sekitarnya. Tempatnya yang relatif jauh dari jalan raya, masih hijau, memang enak buat jalan-jalan. Setelah lelah jalan-jalan melihat-lihat barang, tersedia berbagai warung yang meyediakan berbagai menu, tinggal pilih: Nasi uduk, lontong sayur, nasi rames, mendowan, bubur ayam, pecel lele, warung Padang, warung Sunda. Juga minuman, ada es tebu, Es Teh, es buah.<br />
<br />
Penasaran, sempatkan hari muingggu ke Kalibata. Tersedia angkutan dari berbagai arah: Dari Blok M, naik Kopaja 57, Dari Cililitan kopaja 57/ Metrimini 64, dari Kampung melayu dan Pasar Minggu naik M16, dari Manggarai naik Metromini 62. Jangan lupa ajak keluarga, sekalian makan bersama di hari Minggu.<br />
","","Minggu","2012-08-19","01:54:07","15pasar_tiban_kalibata.jpg","17","wisata");
INSERT INTO berita VALUES("627","40","admin","Nikmatnya Bubur Ayam Cikini","","","nikmatnya-bubur-ayam-cikini","N","N","N","Jakarta - Jika Anda pecinta kuliner Bubur, pasti sudah mengenal Bubur Cikini H. Sulaiman. Bubur yang satu ini memang terbilang populer di Jakarta. Kabarnya bubur ini didirikan sejak tahun 1980-an. Bisa bertahan sampai sekarang tentu merupakan jaminan tersendiri. Kualitas rasa adalah modal utama sebuah usaha kuliner selalu diterima konsumen. Bubur Cikini H. Sulaiman memiliki hal tersebut.<br />
<br />
Dahulu Bubur Cikini H. Sulaiman bisa dijumpai di tenda kaki lima. Jam operasional juga dimulai sekitar jam 6 sore hari. Namun kini Bubur Cikini H. Sulaiman telah memiliki tempat permanen yang lebih nyaman. Jam operasional juga berubah. Kini Bubur Cikini juga bisa dinikmati di pagi hari. Bagi yang suka menu bubur untuk sarapan, jangan sampai melewatkan Bubur Cikini.<br />
<br />
Soal menu, Bubur Cikini H. Sulaiman tentu menyajikan menu bubur sebagai sajian utama. Menu yang bisa dicicipi antara lain Bubur Ayam Biasa, Bubur Ayam Telur, Nasi Goreng Ayam, Nasi Goreng Otokwok, Mie Goreng/Rebus, Telur Goreng, Empal Gentong Nasi/Lontong, Ati Ampela, aneka minuman dan masih banyak lagi lainnya. Jika Ingin menikmati empal Gentong Nasi/Lontong harus datang di hari Sabtu atau Minggu sebab menu tersebut tidak tersedia setiap harinya.<br />
<br />
Soal harga memang fluktuatif. Bisa berubah kapanpun. Tetapi sebagai deskripsi harga, seporsi Bubur Ayam Biasa bisa dinikmati dengan harga Rp.13.000 per porsi, menu Bubur Telur juga di harga yang sama. Untuk Nasi Goreng Ayam bisa dinikmati dengan membayar Rp.15.000, sedangkan Nasi Goreng Otokwok bisa dinikmati dengan harga Rp,17.000. Bagi yang menyukai menu Empal Gentong Nasi/Lontong bisa dicicipi dengan membayar Rp.20.000 per porsi. Cukup murah!
","","Selasa","2012-08-21","13:55:20","32bubur_ayam_cikini.jpg","20","kuliner");
INSERT INTO berita VALUES("628","40","admin","Soto Betawi H. Husein","","","soto-betawi-h-husein","N","N","N","Indonesia sangat kaya akan khazanah kuliner. Masing-masing wilayah mempunyai makanan yang khas. Meskipun sama jenisnya, namun rasa dan racikannya berbeda.<br />
Sama seperti daerah-daerah lain di Indonesia, masyarakat Betawi juga mempunyai makanan khas yaitu soto Betawi. Salah satu yang terkenal adalah soto Betawi Haji Husein yang ada di kawasan Minangkabau, Manggarai, Jakarta Selatan. Di tempat seluas 5 x 10 meter, Bang Husein, 57; panggilan akrabnya, membuka usahanya dari pukul 07.00 WIB hingga dagangannya habis. Usaha ini telah dirintisnya sejak tahun 1989. Sebelum membuka usaha sendiri, ia terlebih dahulu belajar dari pamannya sejak tahun 1970-an.<br />
<br />
Saya sudah mulai ikut usaha sejak Kelas 4 SD. Waktu itu ikut Uwak (panggilan paman-Red) jualan sate, tongseng, sama soto, kata Bang Husein. Bapak empat orang anak ini mengaku memilih soto karena lebih praktis, selain itu ia ingin melestarikan makanan asli Betawi.<br />
Yang membedakan soto Betawi Haji Husein dengan soto di daerah lainnya adalah proses pengolahan isi sotonya. Olahan daging sapi yang berupa daging, jeroan, dan kikil terlebih dahulu direbus; baru kemudian digoreng. Yang hampir sama biasanya soto Makassar, cuma biasanya dagingnya direbus saja, nggak digoreng, ujar pria kelahiran Jakarta ini.<br />
Dalam sehari Bang Husein biasa menyediakan 50 Kg olahan daging sapi yang terdiri dari daging, jeroan, dan kikil. Mulai pukul 03.00 WIB ia merebus semuanya hingga pukul 06.00 WIB. Menurutnya proses merebus membutuhkan waktu yang cukup lama. Bumbu yang digunakan untuk kuah sotonya hanya terdiri dari rempah-rempah biasa yang banyak dijual di pasar. Bahan-bahan itu kemudian diracik sedemikian rupa sehingga mempunyai rasa yang khas. Kuah soto Betawi umumnya kental karena menggunakan santan. Dalam sehari ia bisa menghabiskan berpuluh butir kelapa tua untuk diolah menjadi santan.<br />
<br />
Setiap hari warungnya selalu ramai dikunjungi orang. Biasanya mereka datang pada saat jam istirahat makan siang. Penikmat soto Haji Husein berasal dari berbagai kalangan. Mulai dari yang berkantong tipis sampai yang berkantong tebal. Demikian lakunya, tidak jarang pelanggannya harus antre menunggu pelanggan lain yang sedang makan.<br />
Tempatnya yang terletak persis di pinggir jalan terkadang tidak muat menampung sepeda motor dan mobil yang dikendarai para pelanggannya. Tak jarang pula orang-orang kantoran datang jauh-jauh hanya untuk merasakan kenikmatan sotonya.<br />
<br />
Melihat banyaknya pengunjung yang datang, bisa dipastikan rasanya pastilah menggugah selera. Dalam sehari Bang Husein mengaku bisa menghabiskan lebih kurang 100 porsi. Untuk satu porsinya ia hargai Rp16.000, itu sudah termasuk nasi. Omzet per-bulannya bisa mencapai lebih kurang Rp20 juta. Ke-12 orang karyawan kini membantunya melayani pelanggan setiap hari. Waktu awal buka mah cuma berdua. Sekarang pegawainya nggak pernah berubah, ungkapnya. Di antara karyawannya ada dua anak lelakinya yang ikut membantu.<br />
Usaha ini merupakan usaha keluarga turun-temurun. Bang Husein merupakan generasi keempat. Sebelum di tempatnya saat ini ia sempat merasakan berjualan keliling menggunakan pikulan.<br />
<br />
Uang Rp400.000 menjadi modal awal usahanya. Dulu uang segitu besar, bisa buat beli semua, katanya. Usaha ini dijalaninya mulai dari bawah sekali. Bahan-bahan sotonya didapatkan dengan cara mengutang. Ia juga harus membayar sewa tempat.<br />
Saat ini dengan omzet besar ia tidak perlu lagi mengutang. Bahkan sejak tahun 2000 tempatnyapun sudah menjadi milik pribadi. Asal ada kemauan, semua pasti bisa. Yang penting jangan pernah bosan kalau usaha, ujarnya. Untuk mempertahankan cita-rasa agar tidak berubah, Bang Husein selalu memerhatikan takaran komposisinya. Hal inilah yang menjadi salah satu daya tarik pengunjung untuk kembali karena rasa tidak berubah-ubah.<br />
<br />
Meski sudah menjadi pemilik, kakek dua orang cucu ini masih melayani sendiri para pelanggannya. Ia tidak canggung berbaur dengan karyawan lainnya. Ini juga menjadi salah satu trik untuk menarik pelanggannya. Terkadang para pelanggan yang seumurnya apabila dilayani olehnya akan merasa senang. Menurut mereka liat muka kita aja udah enak, makanan nomer dua, katanya sambil tertawa. Pertemuan seperti ini seperti sebuah nostalgia baginya.<br />
Semua jerih payahnya telah membuahkan hasil yang cukup membanggakan baginya. Dari hasilnya berjualan ia sudah bisa pergi haji dan membiayai anak-anaknya sekolah. Ia juga sudah memberangkatkan dua karyawannya untuk menunaikan ibadah haji. Soto Betawi Bang Husein buka dari Senin sampai Minggu. Khusus hari Jumat ia sengaja tidak membuka warungnya untuk ibadah sholat Jumat. Pada bulan Ramadhan ia juga menutup usahanya sebulan penuh.<br />
<br />
Inilah Bang Husein, usahanya dijalani secara seimbang dengan ibadah. Ia juga tidak sungkan membagi rahasia dapurnya. Rezeki mah ada aja, udah ada yang ngatur. Selain usaha juga jangan lupa berdoa, ujarnya.
","","Selasa","2012-08-21","14:35:48","16Soto-Betawi.jpg","11","kuliner");
INSERT INTO berita VALUES("629","31","admin","Cokelat Hitam Turunkan Tekanan Darah","","","cokelat-hitam-turunkan-tekanan-darah","N","N","N","Cokelat hitam sudah lama diketahui manfaatnya bagi kesehatan. Hasil analisa terhadap 20 studi menunjukkan, konsumsi cokelat hitam setiap hari akan menurunkan tekanan darah.<br />
<br />
Penelitian yang dilakukan The Cochrane Group melaporkan, zat aktif dalam cokelat bermanfaat untuk membuat pembuluh darah lebih rileks. Akibatnya, tekanan darah pun turun.<br />
<br />
Zat aktif yang punya efek positif tersebut adalah flavonol, yang di dalam tubuh akan menghasilkan zat kimia oksida nitrat dan membuat pembuluh darah lemas sehingga darah lebih lancar bersirkulasi.<br />
<br />
Analisis yang dibuat tersebut mengombinasikan beberapa penelitian sebelumnya untuk mengetahui ada tidaknya efek cokelat bagi tekanan darah. Cokelat hitam yang dikonsumsi partisipan dalam penelitian itu cukup banyak, antara 3 gram sampai 105 gram setiap hari.<br />
<br />
Namun penurunan tekanan darah yang dihasilkan tidak terlalu besar, hanya 2-3 mmHg. Akan tetapi penelitian hanya dilakukan selama dua minggu sehingga tidak diketahui dampaknya dalam jangka panjang.<br />
<br />
&quot;Meski kami belum mendapat bukti adanya efek jangka panjang penurunan tekanan darah, tetapi penurunan sedikit dalam jangka pendek ini mungkin dalam jangka panjang bisa berkontribusi pada penurunan risiko penyakit jantung,&quot; kata Karin Ried, dari National Institute of Integrative Medicine di Melbourne, Australia.<br />
<br />
Tekanan darah tinggi cukup banyak diderita dan diperkirakan menjadi penyebab terbanyak stroke dan penyakit jantung.<br />
<br />
Bila Anda ingin mendapatkan manfaat dari cokelat hitam, sebaiknya pastikan produk yang dibeli mengandung cokelat dalam jumlah tinggi karena kebanyakan produk di pasaran lebih banyak kandungan gula dan lemaknya.<br />
<br />
Selain cokelat, kacang, aprikot, blackberries, dan apel juga mengandung flavonol meski kadarnya lebih rendah daripada cokelat.
","","Selasa","2012-08-21","14:48:52","78chocolate-negro-corazon.jpg","18","kesehatan");
INSERT INTO berita VALUES("630","19","admin","Bos Yahoo Bajak 2 Karyawan Google","","","bos-yahoo-bajak-2-karyawan-google","N","N","N","Marissa Mayer, sang CEO Yahoo kembali memperkuat &#39;pasukannya&#39;. Pernah 
bernaung di bawah bendera Google, Mayer pun membajak dua karyawan dari 
kantor terdahulunya tersebut.<br />
<br />
Wanita yang diangkat menjadi CEO perusahaan internet pada bulan Juli lalu ini telah mempekerjakan mantan<em> Product Marketing Manager</em> Google yang bernama Andrew Schulte. Ia kini menjadi kepala staff di tubuh Yahoo.<br />
<br />
Schulte
bergabung dengan Google pada tahun 2007. Ia sempat menangani kampanye 
marketing Google+. Penegasan kepindahan dirinya ia tuliskan di akun 
Twitter maupun profil LinkedInnya.<br />
<br />
Sebelum Schulte, Mayer sudah membajak Anne Espiritu di mana duluanya bekerja sebagai<em> consumer technology PR </em>di Google, demikian dikutip dari <em>Cnet</em>, Senin (20/8/2012).<br />
<br />
Mayer memang tengah sibuk menata struktur manajemen Yahoo. Perusahaan ini kabarnya juga tengah berburu <em>Chief Operating Officer </em>(COO) dengan pengalaman di bidang manajemen finansial dan restrukturisasi perusahaan.
","","Selasa","2012-08-21","14:58:08","82yahoodlm.jpg","11","teknologi");
INSERT INTO berita VALUES("631","19","admin","Sharp Tak Lagi Produksi TV?","","","sharp-tak-lagi-produksi-tv","N","N","N","Tokyo - Sharp kabarnya mempertimbangkan untuk lebih fokus memproduksi panel LCD (liquid crsytal display) sehingga perlu menjual sejumlah unit bisnisnya. Perusahaan asal Jepang ini berencana untuk tak lagi merakit TV.<br />
<br />
Sharp seperti dilaporkan surat kabar setempat Nikkei, disebut-sebut akan melepas unit bisnis mesin fotokopi dan pendingin ruangan (AC) agar lebih fokus dalam persaingan pasar LCD.<br />
<br />
Namun seperti dilansir Reuters dan dikutip detikINET, Sabtu (18/8/2012), Sharp melalui juru bicaranya menolak laporan tersebut. &quot;Kami mempelajari berbagai pengukuran, namun tidak ada fakta yang mendukung laporan surat kabar Nikke mengenai kemungkinan penjualan operasional utama Sharp,&quot; ujar juru bicara tersebut.<br />
<br />
Performa perusahaan elektronik ini memang tidak menggembirakan awal bulan ini, dengan harga saham yang merosot pada titik terendahnya dalam 40 tahun terakhir.<br />
<br />
Nikkei menyebutkan, sebagai bagian dari upaya pemulihan, Sharp juga akan melakukan spinoff pabriknya di pusat Jepang, yang membuat panel LCD untuk smartphone dan tablet, termasuk untuk komponen iPhone dan iPad Apple.<br />
<br />
&quot;Sharp mungkin saja menerima suntikan investasi dari pabrikan lain dan menjalankan operasional pabrik bersama-sama, seperti yang dilakukan Hon Hai roPrecision asal Taiwan di pabrik Sakai yang berlokasi di prefecture Osaka,&quot; tulis Nikkei.<br />
<br />
Saham Sharp turun 1,14% menjadi 173 yen pada penutupan perdagangan Jumat.
","","Selasa","2012-08-21","15:01:36","68sharptv.jpg","19","teknologi");
INSERT INTO berita VALUES("632","19","admin","Kemungkinan Kodak Batal Jual Paten","","","kemungkinan-kodak-batal-jual-paten","N","N","N","New York - Kodak berencana menjual sebagian dari paten-patennya guna melindungi perusahaannya dari kebangkrutan. Namun belakangan, sang pionir di dunia fotografi ini menimbang ulang rencana tersebut.<br />
<br />
Dilaporkan bahwa Kodak bisa jadi hanya menjual sebagian paten digital imaging yang hendak dilepas, atau malah tidak menjualnya satupun, demikian seperti dikutip detikINET dari AllThingsD, Senin (20/8/2012).<br />
<br />
Kabar ini menyusul pemberitaan sebelumnya yang mengatakan bahwa Kodak telah menunda pengumuman hasil penjualan patennya. &quot;Kodak belum mencapai kepastian atau persetujuan untuk menjual portofolio paten digital imagingnya, &quot;ujar Kodak dalam sebuah pernyataan.<br />
<br />
Suara resmi tersebut menyugestikan bahwa lelang paten yang sudah berjalan tidak berjalan sesuai harapan perusahaan yang berbasis di Rochester, New York, Amerika Serikat ini.<br />
<br />
Sebuah sumber yang mengetahui hal itu mengatakan bahwa tawaran yang datang untuk portofolio ini hanya berada di bawah angka USD 2 miliar.<br />
<br />
Sebelumnya, Wall Street Journal pernah melaporkan bahwa tawaran awal datang dari dua konsorsium, di mana dipimpin oleh perusahaan raksasa, Google dan Apple.<br />
<br />
Seperti diketahui, Kodak berjuang keras menyelematkan &#39;nyawa&#39; perusahaan. Selain menjual sebagian dari 1.100 patennya, Kodak juga telah keluar dari bisnis kamera dan beralih ke digital printing serta penciptaan aplikasi-aplikasi baru di bidang tersebut.
","","Selasa","2012-08-21","15:07:45","74kodakdlm.jpg","14","teknologi");
INSERT INTO berita VALUES("633","31","admin","Depresi? Cek Cara Bicaranya","","","depresi-cek-cara-bicaranya","N","N","N","Jakarta, Beberapa orang pandai menyembunyikan perasaan, dari luar tampak baik-baik saja meski hatinya menangis tercabik-cabik. Para ilmuwan baru-baru ini berhasil menentukan dengan tepat tingkat keparahan depresi berdasarkan cara berbicara.<br />
<br />
Dalam penelitian yang diklaim sebagai yang terbesar di dunia tersebut, para ilmuwan menemukan bahwa cara berbicara susah dipalsukan ketika seseorang sedang depresi. Perubahan cara bicara itu bisa dipakai untuk mengukur tingkat keparahan depresi yang dialami.<br />
<br />
Adam Vogel, kepala Speech Neuroscience Unit di University of Melbourne mengatakan bahwa cara berbicara adalah penanda kesehatan otak yang sangat kuat. Berbagai perubahan yang terjadi pada cara berbicara bisa menunjukkan seberapa bagus otak bekerja.<br />
<br />
&quot;Cara berbicara orang yang sedang depresi berubah dan dipengaruhi oleh terapi yang diberikan, menjadi lebih cepat dengan jeda yang lebih pendek,&quot; kata Vogel dalam laporannya di jurnal Biological Psychiatry seperti dikutip dari Medindia, Selasa (21/8/2012).<br />
<br />
Dalam penelitian tersebut, Vogel melakukan pengamatan terhadap 105 pasien yang sedang menjalani terapi untuk menyembuhkan depresi. Beberapa hal yang diamati antara lain waktu, nada dan intonasi bicara yang kemudian dibandingkan dengan hasil pemeriksaan psikologis.<br />
<br />
Para pasien diminta melakukan panggilan telepon ke sebuah mesin penjawab otomatis. Ada yang diminta berbicara apa saja, mengungkapkan perasaan dan sebagian hanya diminta untuk membaca teks supaya tidak perlu repot-reopot memikirkan mau bicara tentang apa.<br />
<br />
&quot;Temuan ini memungkinkan para psikolog jadi lebih fleksibel dalam memeriksa pasien dari jarak jauh, hanya dengan mendengarkan pola dan cara berbicara meski dari lokasi yang sangat jauh atau di kampung-kampung,&quot; kata James Mundt dari Centre for Psychological Consultation di Wisconsin.<br />
","","Selasa","2012-08-21","15:13:07","8akitmentalts.jpg","12","kesehatan");
INSERT INTO berita VALUES("634","31","admin","Makanan Sehari-hari Penyumbang Kegemukan","","","makanan-seharihari-penyumbang-kegemukan","N","N","N","Jakarta - Salah satu faktor yang banyak bikin orang jadi gemuk adalah mengonsumsi makanan yang berlebihan dan salah. Untuk itu ketahui makanan apa saja yang ditemui sehari-hari dan bisa bikin gemuk.<br />
<br />
&quot;Yang paling banyak bikin gemuk adalah makanan dengan kandungan gula murni dan tepung,&quot; ujar dr Pauline Endang, SpGK dari FKUI, Rabu (15/8/2012).<br />
<br />
dr Pauline menjelaskan banyak orang yang kadang tidak suka nasi tapi ia suka mengemil. Namun sayangnya cemilan ini makanan yang manis dengan kadar gula tinggi, kadang ada telur dan menteganya sehingga kalori tinggi.<br />
<br />
&quot;Makanan-makanan ini tidak bikin kenyang, jadi orang yang mengonsumsi bawaannya ia ingin makan terus apalagi jika ditambah dengan makan gorengan yang kandungan lemaknya tinggi,&quot; ungkapnya.<br />
<br />
Hal senada juga diungkapkan oleh ahli gizi dr Inge Permadhi, MS, SpGK bahwa makanan tinggi kalori, tinggi gula dan tinggi lemak bisa menyebabkan seseorang mengalami kegemukan.<br />
<br />
&quot;Misalnya makanan berminyak, daging yang ada gajih, mentega, margarin, makanan-makanan ini rasanya enak dan gurih sehingga bikin orang ketagihan,&quot; ujar dr Inge dari Departemen Ilmu Gizi FKUI.<br />
<br />
Berikut ini beberapa makanan yang diketahui bisa menyumbang kegemukan yaitu:<br />
<br />
1. Gorengan, mengandung banyak lemak dan juga kolesterol<br />
2. Martabak, mengandung tinggi gula dan lemak<br />
3. Cake, mengandung tinggi gula dan lemak<br />
4. Minuman manis, mengandung tinggi gula dan kalori<br />
5. Minuman soda, menyebabkan timbunan lemak visceral di perut<br />
6. Kerupuk, mengandung karbohidrat dan kadar lemak yang tinggi<br />
7. Es krim,mengandung tinggi gula dan lemak<br />
8. Daging yang masih ada gajihnya<br />
9. Fast food atau makanan cepat saji, kandungan lemak dan kalorinya tinggi tapi cenderung minim nutrisi<br />
10. Keripik, kandungan lemak dan gula dari keripik ini membuat jumlah kalorinya tinggi serta ditambah dengan tinggi garam<br />
11. Sereal manis, mengandung karbohidrat yang tinggi dan ditambah dengan gula yang bisa memicu penimbunan lemak<br />
12. Krim-krim penambah minuman (Whipped cream), mengandung kadar lemak yang tinggi<br />
<br />
&quot;Kandungan dari bahan makanan ini bila asupannya melebihi kebutuhan tubuh maka akan diubah dan disimpan di dalam sel lemak dan tentu saja membuat seseorang jadi gemuk,&quot; ujar Dr Marini Siregar, MGizi, SpGK dari RS Premier Jatinegara.<br />
<br />
Dr Marini menyarankan agar tidak menjadi gemuk yang terpenting adalah keseimbangan antara apa yang dimakan dengan aktivitas fisik yang dilakukan. Jika termasuk orang yang aktivitas fisiknya rendah, asupan makanannya harus disesuaikan tidak boleh terlalu banyak.<br />
<br />
&quot;Jangan lupa mengonsumsi air yang cukup agar metabolisme dalam tubuh berjalan dengan baik, serta sayuran dan buah yang mengandung serat tinggi akan membuat kita merasa lebih kenyang sehingga mengurangi asupan makanan yang lain dan tidak akan terjadi kegemukan,&quot; ujar Dr Marini.
","","Selasa","2012-08-21","15:23:01","41gorengants2.jpg","15","kesehatan");
INSERT INTO berita VALUES("635","39","admin","Foto Bugil Pangeran Harry Beredar","","","foto-bugil-pangeran-harry-beredar","N","N","N","Las Vegas - Pangeran Harry dari Inggris kembali membuat sensasi. Kali ini TMZ, sebuah situs hiburan Amerika Serikat, merilis foto-foto bugil adik Pangeran William itu, Selasa (21/8/2012).<br />
<br />
Menurut TMZ, foto itu diambil ketika putra kedua Pangeran Charles itu berpesta dengan teman-temannya di kamar hotelnya di Las Vegas, Jumat (18/8/2012).<br />
<br />
Mengutip sumbernya, TMZ melaporkan, Harry dan teman-temannya turun ke bar hotel dan bertemu sejumlah perempuan, yang kemudian diundangnya ke kamar suite-nya di hotel itu.<br />
<br />
Suasana pun menjadi liar karena anak-anak muda itu mengadakan permainan biliar. Dalam aturan permainan itu, yang kalah harus melepas pakaian, sampai akhirnya semua peserta bugil.<br />
<br />
Beberapa orang yang hadir di pesta itu memotret kehebohan pesta tersebut. Dalam salah satu foto, tampak Harry dalam keadaan telanjang bulat dengan kedua tangan menutupi alat vitalnya. Sementara itu, foto lainnya menunjukkan Harry memeluk seorang perempuan yang juga terlihat bugil.<br />
<br />
Kepada TMZ, Keluarga Kerajaan Inggris mengatakan, &quot;Kami tidak berkomentar tentang foto-foto itu saat ini.&quot; 
","","Kamis","2012-08-23","01:39:51","92pangeran_harry.jpg","23","internasional");
INSERT INTO berita VALUES("636","2","admin","Hukuman Ganda Korea Diperingan, Greysia/Meiliana Tunggu Nasib","Buntut Pertandingan \"Sabun\" di Olimpiade London","","hukuman-ganda-korea-diperingan-greysiameiliana-tunggu-nasib","N","N","N","Seoul - Otoritas bulutangkis Korea Selatan, Rabu (22/8) mengurangi hukuman untuk 
empat pemain yang diduga sengaja kalah pada pertandingan di Olimpiade 
London, dari dua tahun menjadi enam bulan setelah terjadi proses 
banding.<br />
&nbsp;&nbsp;&nbsp; &nbsp;<br />
Jung Kyung-Eun, Kim Ha-Na, Ha Jung-Eun, dan Kim 
Min-Jung dilarang berpartisipasi di kompetisi-kompetisi domestik dan 
internasional selama enam bulan, demikian disampaikan oleh Asosiasi 
Bulutangkis Korea, Rabu.<br />
&nbsp;&nbsp; &nbsp;<br />
Keempat atlet itu berkata mereka 
hanya mengikuti perintah pelatih Sung Han-Kook, dan asisten Kim 
Moon-Soo. Sebelumnya, hukuman seumur hidup mereka telah dikurangi 
menjadi dua tahun.<br />
&nbsp;&nbsp; &nbsp;<br />
Delapan pebulutangkis ganda putri, dari 
Korea Selatan, Indonesia, dan China didiskualifikasi dari Olimpiade 
karena sengaja mengalah agar dapat mengamankan posisi yang lebih 
menguntungkan di babak berikutnya.<br />
&nbsp;&nbsp; &nbsp;<br />
Skandal ini membuat bintang bulutangkis China, Yu Yang, pensiun dari bulutangkis.<br />
&nbsp;&nbsp; &nbsp;<br />
Presiden
Federasi Bulutangkis Dunia, Kang Young-Joong, telah menepis rumor bahwa
publikasi yang buruk dari olahraga ini dapat membahayakan masa depan 
bulutangkis di Olimpiade.<br />
&nbsp;&nbsp; &nbsp;<br />
Korea Selatan mendapat satu medali 
perunggu dari cabang olahraga bulutangkis di London - itu merupakan 
penampilan terburuk sepanjang partisipasi mereka di Olimpiade.<br />
<br />
Sementara
di Indonesia, PBSI akhirnya memutuskan akan menjatuhkan sanksi kepada 
dua pemain ganda putri andalannya, Greysia Polii dan Meiliana Jauhari. 
Seperti diketahui, Greysia/Meiliana harus didiskualifkasi dari Olimpiade
London 2012 karena diduga sengaja mengalah pada penyisihan grup untuk 
menghindari lawan berat di babak perempat final.<br />
&nbsp;<br />
Badminton World
Federation (BWF) memutuskan Greysia/Meiliana dan lawannya, Ha Jung 
Eun/Kim Min Jung dari Korea didiskualifikasi dari turnamen paling 
bergengsi tersebut. Pasangan terkuat dunia asal China, Wang Xiaoli/Yu 
Yang dan Kim Ha Na/Jung Kyung Eun dari Korea juga terkena 
diskualifikasi.<br />
<br />
&ldquo;Kami tak mau dipengaruhi oleh keputusan yang 
diambil oleh Korea atau China, karena setiap organisasi memiliki 
kebijakan masing-masing. Walaupun demikian, kami menghargai IOC dan BWF 
yang telah memutuskan bahwa Greysia/Meiliana bersalah, hal ini tidak 
boleh terulang lagi kedepannya. PBSI akan memberikan sanksi, namun belum
bisa diumumkan bentuk sankisnya seperti apa&rdquo; ujar Sekjen PBSI, Yacob 
Rusdianto di Pelatnas Cipayung, Selasa (21/8) sepersti dikutip situs 
PBSI.<br />
&nbsp;<br />
Saat ini PBSI masih dalam proses diskusi mengenai sanksi 
yang akan diberikan kepada Greysia/Meiliana dan belum ada keputusan 
serta pemberitahuan resmi kepada keduanya. Namun ia mengaku telah 
beberapa kali mengadakan pertemuan kekeluargaan bersama kedua pemain 
untuk membicarakan masalah ini dan kemungkinan-kemungkinan yang akan 
terjadi.
","Suasana pertandingan memalukan itu.
","Kamis","2012-08-23","01:47:26","45bulutangkis_sabun.jpg","10","olahraga");
INSERT INTO berita VALUES("637","2","admin","Zeelenberg: Lorenzo Akan Bangkit di Brno","MotoGP","","zeelenberg-lorenzo-akan-bangkit-di-brno","N","N","N","London - Setelah harus bekerja keras merebut posisi kedua di Indianapolis,  
Manajer tim Yamaha, Wilco Zeelenberg, yakin pebalap Jorge Lorenzo akan  
bangkit di MotoGP seri Ceko.
<p>
Lorenzo diyakini dapat tampil sebagai
pemenang untuk menjaga posisi tertinggi di klasemen sementara.         
&quot;Sirkuit Indianapolis menyulitkan kami saat start. Namun, Sirkuit 
Brno memiliki lintasan yang halus dan cepat. Saya yakin kami dapat 
tampil lebih baik di sana,&quot; kata Zeelenberg, London, Rabu (22/8/2012) di
London.
</p>
<p>
Lorenzo menang di Brno pada musim 2010 tetapi finis 
keempat di musim 2011. Lorenzo akan berusaha merebut kemenangan keenam 
pada musim ini di Brno.
</p>
Kemenangan ini penting bagi Lorenzo untuk 
memastikan langkahnya menjadi juara dunia di musim ini. Jika sampai 
kalah dari Dani Pedrosa, gelar juara dunia harus ditentukan sampai lomba
di akhir musim
","Pebalap Yamaha, Jorge Lorenzo, dengan motor Jupiter Z1 di paddock Yamaha. 
","Kamis","2012-08-23","01:52:27","48JorgeLorenzo.jpg","12","olahraga");
INSERT INTO berita VALUES("638","2","admin","Tyson Peringatkan \"Rapper\" 50 Cent","","","tyson-peringatkan-rapper-50-cent","N","N","N","New York - Mantan juara dunia tinju kelas berat Mike Tyson memperingatkan rapper 50 Cent yang kini bertindak sebagai promotor tinju.<br />
<br />
Rapper yang bernama asli Curtis Jackson ini baru saja mendirikan The Money Team (TMT) Promotions bersama petinju legendaris AS lainnya, Floyd Mayweather Jr. TMT bergerak di bidang pertandingan tinju profesional.<br />
<br />
Saat mendirikan perusahaan ini, 50 Cent bermaksud melakukan perubahan mendasar pada olahraga tinju profesional di AS.<br />
<br />
Namun, Tyson yang pernah malang melintang di dunia tinju antara 1985 hingga 2005 ini memperingatkan 50 Cent tentang &quot;kotornya&quot; dunia tinju profesional.<br />
<br />
&quot;Anda harus tahu tentang dunia tinju. Ini merupakan bisnis yang legal, tetapi tidak semua berjalan terbuka,&quot; kata Tyson. &quot;Memang seharusnya bisnis ini dikelola pemerintah.&quot;<br />
<br />
&quot;50 (Cent) adalah seorang bintang rap, penghibur, dan enterpreneur. Namun, ia sama sekali tidak mengerti dunia tinju,&quot; lanjut juara dunia tinju kelas berat 1986-1990 ini.<br />
<br />
Menurut Tyson, pengetahuan tentang tinju diperoleh 50 Cent hanya versi dari Floyd Mayweather.&nbsp; &quot;Begitu dia berkecimpung di dunia ini, ia harus tahu bahwa kawan bisa menjadi lawan,&quot; kata Tyson. &quot;Mereka hanya inginkan uang Anda dan ingin terus menguasai dunia ini.&quot;<br />
<br />
50 Cent mendapatkan izin promotornya di New York pada Juli lalu, dan mendapat izin usahanya di Nevada. Saat ini mereka telah mengikat beberapa petinju potensial, seperti petinju kelas bulu Yuriorkis Gamboa dari Kuba dan Billy Dib dari Australia.
","Mike Tyson
","Kamis","2012-08-23","01:56:01","24mike_tyson.jpg","21","olahraga");
INSERT INTO berita VALUES("639","23","admin","Hilman Hariwijaya dan Eko Patrio akan Re-cycle Film \"Lupus\"","","","hilman-hariwijaya-dan-eko-patrio-akan-recycle-film-lupus","N","N","N","Jakarta - Kabar gembira bagi Anda pecinta novel maupun serial Lupus. Pasalnya, tokoh fiksi rekaan Hilman Wijaya ini akan segera diangkat ke layar lebar oleh rumah produksi eKomando Production.<br />
<br />
&quot;Nanti mau produksi film Lupus, kita re-cycle. Kita mudain lagi,&quot; ujar Eko, pemilik eKomando Production, saat ditemui di kawasan dr Saharjo, Jakarta, Kamis (16/8/2012).<br />
<br />
Film Lupus diangkat kembali ke layar lebar bukan tanpa alasan. Menurut Eko, tokoh Lupus merupakan anak muda yang konyol tetapi inspiratif. Setiap seri Lupus selalu mengangkat unsur persahabatan. Tak ada nuansa politis atau hal lainnya.<br />
<br />
&quot;Di Lupus ada persahabatan yang abadi, bahu-membahu. Tidak pernah berkaitan dengan masalah politik dan sebagainya. Di sini pure banget yang diangkat pertemanan,&quot; tambah Eko.<br />
<br />
Saat ini skenario sudah rampung dibuat oleh penulisnya, Hilman Hariwijaya. Meski demikian, tokoh Lupus hingga saat ini belum ditentukan. Rencananya, Lupus mulai tayang di bioskop pada Februari 2013, bertepatan dengan Hari Valentine.
","","Kamis","2012-08-23","02:21:00","40film_lupus.jpg","3","film,hiburan");
INSERT INTO berita VALUES("640","23","admin","Marvel Umumkan Jadwal Rilis \"The Avengers 2\"","","","marvel-umumkan-jadwal-rilis-the-avengers-2","N","N","N","Los Angeles - The Avengers is back. Setelah memastikan Joss Whedon bakal kembali berada di balik layar, Marvel juga mengumumkan jadwal penayangan perdana The Avengers 2.<br />
<br />
Rencanannya, film kumpulan para superhero ini akan dirilis pada tanggal 1 Mei 2015 mendatang setelah mereka menanyangkan film-film terkaitnya seperti Iron 3, Captain America 2 dan Thor 2.<br />
<br />
Meski belum memiliki judul, Marvel dan Disney sudah siap untuk kembali memproduksi film terlaris ketiga box office sepanjang masa. &quot;Walt Disney telah mengumumkan tanggal perilisan sekuel dari film blockbuster superhero terbesar dan film terlaris ketiga sepanjang masa, The Avengers,&quot; tulisnya dalam rilis yang dilansir Digital Spy.<br />
<br />
&quot;Josh Whedon akan kembali menulis naskah dan menyutradarai sekuel Avengers ini dan akan dirilis pada 1 Mei 2015,&quot; tambah Marvel.<br />
<br />
Menyusul pengumuman tersebut, bisa dipastikan bahwa para bintang The Avengers seperti Robert Downey Jr, Chris Hemsworth dan Chris Evens akan kembali tampil untuk memeriahkan film tersebut.
","The Avengers
","Kamis","2012-08-23","02:33:21","88the_avenger.jpg","15","film,hiburan");
INSERT INTO berita VALUES("641","23","admin","Film Dirilis, Dewi Lestari Deg-degan","","http://www.youtube.com/embed/QgDWRe1TNRg","film-dirilis-dewi-lestari-degdegan","N","N","N","Jakarta -&nbsp; Penulis novel laris &quot;Perahu Kertas&quot;, Dewi Lestari, mengaku tegang menjelang penayangan perdana film Perahu Kertas di bioskop hari ini. &quot;Sangat deg-degan,&quot; kata penulis dengan nama pena Dee itu usai jumpa pembaca novel Perahu Kertas di Gramedia Matraman, Jakarta, Kamis. Film yang diangkat dari novel setebal 456 halaman itu sudah tayang khusus untuk media dan undangan Rabu (8/8/2012) lalu. <br />
<br />
&quot;Kalau yang kemarin kan baru wartawan dan undangan, tetapi kalau sekarang yang dihadapi real judgment (penilaian nyata), sekarang penonton yang menilai. Lama film tayang di bioskop kan ditentukan dari penonton,&quot; kata Dee.<br />
<br />
Film&nbsp; Perahu Kertas disutradarai oleh Hanung Bramantyo. Artis muda Maudy Ayunda dan Adipati Dolken yang pernah beradu akting di film&nbsp; Malaikat Tanpa Sayap menjadi pemeran utama film tersebut.<br />
<br />
Meskipun ada beberapa adegan film yang berbeda dengan kisah dalam novel namun Dee mengatakan hampir 80 persen jalan cerita film Perahu Kertas&nbsp; sama dengan novel.<br />
<br />
&quot;Kalau ada yang protes itu risiko ya, pasti ada dan buat saya itu wajar. Komparasi pasti terjadi. Tetapi sebagai film, Perahu Kertas solid,&quot; kata ibu dua anak itu.
","Dewi Lestari.
","Kamis","2012-08-23","02:40:30","65dee.jpg","32","film,hiburan");
INSERT INTO berita VALUES("642","39","admin","Ahmadinejad: Israel, Tumor yang Harus Dihancurkan","","","ahmadinejad-israel-tumor-yang-harus-dihancurkan","Y","N","N","Teheran - Israel adalah &quot;tumor kanker&quot; yang akan segera dihancurkan, kata Presiden Iran, Mahmoud Ahmadinejad, Jumat (17/8/2012), kepada para demonstran yang melakukan protes tahunan terhadap eksistensi negara Yahudi itu.<br />
<br />
&quot;Rezim Zionis dan warga Zionis adalah satu tumor kanker. Kendatipun satu sel dari mereka dikeluarkan dalam satu inci tanah (Palestina), pada masa depan sejarah ini (bagi eksistensi Israel) akan terulang kembali,&quot; katanya dalam satu pidato di Teheran untuk memperingati Hari Quds Iran yang disiarkan langsung televisi negara itu.<br />
<br />
&quot;Negara-negara dari kawasan ini akan segera mengusir kaum Zionis perampas tanah Palestina.... Sebuah Timur Tengah baru pasti dibentuk. Dengan bantuan Allah dan negara-negara kawasan ini, Timur Tengah baru tidak akan ditemukan lagi orang-orang Amerika dan Zionis,&quot; katanya.<br />
<br />
Peringatan itu dilakukan pada saat ketegangan meningkat antara Israel dan Iran menyangkut program nuklir Iran yang disengketakan itu.<br />
<br />
Israel pekan-pekan belakangan ini meningkatkan ancaman-ancamannya untuk menghancurkan fasilitas-fasilitas nuklir Iran guna mencegah Teheran mampu memproduksi senjata-senjata atom. Iran yang terkena sanksi-sanksi Barat membantah tuduhan itu dan menegaskan bahwa program nuklirnya hanya untuk tujuan damai. Militernya memperingatkan akan menghancurkan Israel jika diserang.<br />
<br />
Televisi Pemerintah Iran menunjukkan, massa berpawai di bawah sinar matahari yang menyengat di Teheran dan kota-kota lain negara itu untuk memperingati Hari Quds (Jerusalem) yang bertujuan membebaskan kota Jerusalem, yanga akan dijadikan ibu kota negara Palestina masa depan (Israel juga bersikeras untuk menjadikan Jerusalem sebagai ibu kotanya).<br />
<br />
Para pengunjuk rasa membawa bendera-bendera Palestina dan foro-foto pemimpin tertinggi Iran, Ayatollah Ali Khamenei, dan spanduk bertuliskan &quot;Ganyang Israel&quot; dan &quot;Ganyang Amerika&quot;. Satu kelompok orang di Teheran terlihat membakar satu bendera Israel.<br />
<br />
Unjuk rasa itu telah menjadi kegiatan tahunan selama Ramadhan di Iran sejak Revolusi Islam tahun 1979. Para pengunjuk rasa menegaskan antipati Iran terhadap Israel dan sekutunya Amerika Serikat serta mendukung perjuangan rakyat Palestina, yang Khamenei sebut &quot;satu tugas agama.&quot;<br />
<br />
Pemimpin tertinggi itu, Rabu, menyebut Israel sebagai &quot;hasil pertumbuhan Zionis gadungan dan palsu&quot; di Timur Tengah yang &quot;akan dilenyapkan&quot;.<br />
<br />
Pemimpin Pengawal Revolusi yang berpengaruh, Jenderal Mohammed Ali Jafari, mengemukakan kepada kantor berita Fars, ketika menghadiri unjuk rasa di Teheran itu, bahwa &quot;negara Iran sekarang berada di garis depan perlawanan regional anti-Israel dalam menunjukkan kebenciannya pada Israel.&quot; Ia menambahkan, Iran tetap mempertahankan sikap tegas itu.<br />
<br />
Ahmadinejad dalam pidatonya menyatakan, Zionis menimbulkan perang dunia pertama dan kedua, dan &quot;menguasai masalah-masalah dunia, sejak saat itu mereka menguasai Pemerintah AS.&quot; 
","Mahmud Ahmadinejad.
","Kamis","2012-08-23","02:49:25","9ahmadinejad.jpg","37","internasional");
INSERT INTO berita VALUES("643","42","admin","Fatima Nabil, Presenter TV Berjilbab Pertama di Mesir","","","fatima-nabil-presenter-tv-berjilbab-pertama-di-mesir","N","N","N","<p>
Kairo - Fatima
Nabil mencatat sejarah. Ia menjadi presenter pertama yang berjilbab 
yang muncul di televisi milik pemerintah Mesir. Dalam balutan jilbab 
berwarna krem, dan jas hitam Fatima membacakan buletin berita siang, 
Minggu 2 September 2012.&nbsp;
</p>
<p>
&quot;Akhirnya revolusi juga terjadi di 
televisi milik pemerintah,&quot; kata Nabil. Ia berharap kemunculannya ini 
diikuti tak hanya presenter berita tapi juga presenter cuaca dan 
lainnya.
</p>
<p>
&quot;Saat ini, standar bukan tergantung pada 
jilbab, yang sebenarnya merupakan pilihan pribadi setiap perempuan. Tapi
lebih pada profesionalitas dan intelektual,&quot; ujarnya.
</p>
<p>
Sejak televisi pemerintah ini berdiri tahun 1960, dibawah rejim Presiden
Hosni Mubarok, perempuan yang mengenakan jilbab dilarang menjadi 
presenter. Aturan ini sempat ditentang sejumlah aktivis hak asasi dan 
kelompok liberal, namun kandas.
</p>
<p>
Pemerintah baru yang 
dipimpin Presiden Mohammed Mursi, mencabut aturan ini. Menteri Informasi
Baru Saleh Abdel-Makshoud mengatakan sudah banyak perempuan berjilbab 
yang muncul sebagai presenter di channel-channel televisi Arab dan 
internasional. Jadi perubahan ini tak menjadi masalah apalagi saat ini 
hampir 70% perempuan Mesir mengenakan jilbab.
</p>
<p>
Petinggi stasiun televisi tersebut mengatakan munculnya Nabila bisa 
membangkitkan semangat perempuan lain yang ingin tetap mempertahankan 
jilbab mereka tanpa harus takut kehilangan pekerjaan. (Sumber: Tempo.co)
</p>
","Fatima Nabil
","Kamis","2012-11-22","10:07:13","89fatima.jpg","11","internasional");
INSERT INTO berita VALUES("650","22","admin","Roy Suryo Menpora, SBY Dipertanyakan","","","roy-suryo-menpora-sby-dipertanyakan","Y","N","N","<p>
Pengamat politik dari Charta Politika, Yunarto Wijaya mempertanyakan dasar keputusan SBY menunjuk Roy Suryo sebagai Menpora. Apalagi, kata Yunarto, ada pernyataan SBY yang menegaskan Roy cakap untuk mengemban tugas sebagai Menpora.
</p>
<p>
Menurut Yunarto, Roy selama ini lebih dikenal sebagai pakar foto digital dan video serta dosen di sebuah perguruan tinggi negeri. &quot;Namun, belum terdengar kiprahnya di bidang kepemudaan dan olahraga,&quot; kata Yunarto. Sementara, tugas Menpora yang berat dan masa tugasnya relatif singkat idealnya mengutamakan figur yang kompetensinya teruji di bidang kepemudaan dan olahraga.
</p>
<p>
Karena itu, Yunarto menduga penunjukan Roy bukan karena kompetensi, melainkan representasi politik. &quot;Ditunjuknya kader Partai Demokrat Roy Suryo sebagai Menpora menunjukkan faktor politisnya sangat kuat,&quot; katanya. (sumber: republika.co.id)<br />
</p>
","Roy Suryo saat dilantik jadi Menpora","Jumat","2013-01-25","00:01:04","60roy-suryo.jpg","1","politik");
INSERT INTO berita VALUES("651","21","admin","Banjir Jakarta, Kerugian Ekonomi Capai Rp 1 Triliun","Jakarta Darurat Banjir","http://www.youtube.com/embed/RQMbr4DBqXk","banjir-jakarta-kerugian-ekonomi-capai-rp-1-triliun","N","N","Y","<p>
Ketua Asosiasi Pengusaha Indonesia Sofjan Wanandi mengatakan, banjir yang melanda Jakarta sepekan ini telah menimbulkan kerugian ekonomi yang cukup tinggi. Biaya bencana yang ditanggung untuk sekadar menyediakan makan&nbsp; bagi para pengungsi pun mencapai Rp 1 miliar lebih. 
</p>
<p>
Hal itu disampaikan Sofjan, saat ditemui di area bencana banjir di Penjaringan, Jakarta Utara, Minggu (20/1/2013).
</p>
<p>
Sofjan menegaskan, tak bergeraknya roda ekonomi di Jakarta akibat bencana banjir menyebabkan kerugian lebih dari Rp 1 triliun. Aktivitas perdagangan menjadi tidak berjalan, dan kawasan Industri Pulogadung juga ikut lumpuh karena tak memperoleh suplai listrik akibat gardu listrik terendam banjir. 
</p>
<p>
Negara importir pun, katanya, mulai mempertanyakan kapan Jakarta bisa pulih, karena ini sangat terkait dengan kegiatan ekspor komoditas keluar negeri dari seluruh daerah di Indonesia yang bertumpu di Jakarta.
</p>
<p>
&rdquo;Importir itu mulai bertanya-tanya, kapan banjir di Jakarta bisa surut. Kendati mereka saat ini memahami Jakarta sedang dilanda bencana,&rdquo; kata Sofjan. (sumber: kompas.com)
</p>
","Banjir di daerah Pluit","Jumat","2013-01-25","00:06:15","44banjir-lagi.jpg","1","ekonomi");
INSERT INTO berita VALUES("652","22","admin","Hary Tanoe Mundur dari Partai Nasdem","","","hary-tanoe-mundur-dari-partai-nasdem","N","Y","N","<p>
Ketua Dewan Pakar DPP Partai Nasional Demokrat (Nasdem) Hary Tanoesoedibjo menyatakan mundur dari keanggotaan Partai Nasdem. Hal itu disampaikannya secara resmi dalam jumpa pers, Senin (21/1/2013), di Jakarta.
</p>
<p>
&quot;Saya menyatakan mundur dalam kapasitas saya sebagai Ketua Dewan Pakar. Mulai hari ini, saya bukan lagi anggota dari Partai Nasdem. Keputusan ini saya lakukan dengan berat hati,&quot; kata Hary.
</p>
<p>
Ia menyatakan, sejak bergabung dengan Partai Nasdem pada 9 Oktober 2011, Hary merasa telah melakukan upaya terbaik, baik energi, pikiran, dana, maupun risiko, untuk berpartisipasi membesarkan Partai Nasdem. &quot;Target utamanya lolos verifikasi dan lolos sebagai partai peserta pemilu. Saya merupakan bagian yang ikut meloloskan Nasdem,&quot; kata bos MNC Grup ini.
</p>
<p>
&quot;Keputusan saya ini tidak mengenakkan, tapi pada satu titik saya harus memutuskan ini. Aktivitas politik harus tetap dijalankan. Destiny keterlibatan saya di politik adalah menjadi bagian dari perubahan untuk bangsa Indonesia menjadi lebih baik. Saya ingin ikut andil secara nyata, langsung. Karena bagaimanapun politik menjadi satu bagian ideologi dan bagian dari masa depan kita,&quot; papar Hary.
</p>
<p>
Perpecahan di tubuh Nasdem mulai merebak ketika beredar kabar adanya faksi di dalam partai itu. Dikabarkan, Surya Paloh yang akan menjadi ketua umum partai itu berseberangan dengan faksi Hary Tanoe. Beberapa waktu lalu, kelompok Surya Paloh memecat Sekjen Garda Pemuda Nasional Demokrat (GPND), Saiful Haq.
</p>
<p>
Tentang alasannya mundur, Hary mengatakan karena ada perbedaan pendapat dengan Ketua Majelis Tinggi Partai Nasdem Surya Paloh (sumber: kompas.com) 
</p>
","Hary Tanoe saat memberikan keterangan pers","Jumat","2013-01-25","00:58:26","90hari-tanoesoedibjo.jpg","0","politik");
INSERT INTO berita VALUES("653","41","admin","Ketika \"Ciyus\" Terucap dari Mulut Jokowi","","","ketika-ciyus-terucap-dari-mulut-jokowi","N","Y","N","<p>
Kata <em>ciyus</em> atau serius sering terdengar diucapkan anak-anak 
zaman sekarang yang sering dijuluki anak baru gede (ABG). Nah, ketika 
bahasa gaul itu diucapkan oleh Joko Widodo, para pewarta yang bertugas 
meliput kegiatan Gubernur DKI Jakarta itu tak bisa menahan tawa karena 
nadanya yang sedikit medok.
</p>
<p>
Terhitung sudah dua kali Jokowi 
melontarkan kata itu kepada wartawan.    Pertama, saat Jumat (18/1/2013)
malam lalu, ketika Jokowi meninjau perbaikan Tanggul Kanal Banjir Barat
(KBB) di Latuharhary, Jakarta Pusat. Seharian raut muka Jokowi begitu 
serius dan tegang karena pengerjaan tanggul yang masih belum selesai, 
ditambah hujan deras yang terus mengguyur Ibu Kota. Pendek kata, Jokowi 
tampak sangat suntuk dan senyum khasnya pun tak terpancar dari dirinya.
</p>
<p>
Saat
itu, Jokowi menghampiri wartawan yang sudah menunggunya di luar rel 
kereta api yang terputus. Lantas para wartawan berniat mencairkan 
suasana dengan melontarkan pertanyaan-pertanyaan konyol kepada Jokowi, 
seperti &quot;Apabila tanggul selesai, ditandai oleh pemotongan pita di Sency
(Senayan City)?&quot;. Mendengar pertanyaan itu, senyum yang hilang dari 
Jokowi akhirnya muncul kembali.
</p>
<p>
Seraya mengernyitkan dahinya, 
Jokowi bertanya, &quot;Apa itu Sency?&quot;   Wartawan pun langsung menjelaskan 
kalau Sency itu adalah kependekan dari Senayan City. Mengetahui hal 
tersebut, Jokowi pun tertawa dan mengatakan kalau berbicara hendaknya 
jangan disingkat-singkat. &quot;Oh, <em>kirain </em>saya sensitif itu maksudnya. <em>Mbok</em>, jangan disingkat-singkat, <em>tho</em>,&quot; kata Jokowi.
</p>
<p>
Pembicaraan itu pula yang membuat Jokowi melontarkan kata <em>ciyus</em> dan <em>miapah</em> kepada wartawan. &quot;Kalau <em>ciyus miapah </em>itu apa? Ha-ha-ha,&quot; kata Jokowi yang membuat suasana lokasi tersebut yang awalnya tegang menjadi ramai. 
</p>
<p>
Kata <em>ciyus </em>kembali
diucapkan Jokowi, Selasa (22/1/2013) kemarin, saat berbincang dengan 
wartawan di Balaikota DKI. Bahasa gaul itu keluar kembali setelah ia 
ditanya terkait kinerjanya 100 hari. 
</p>
<p>
Saat itu, Jokowi ditanya 
masalah Jakarta apa yang membuat Jokowi pusing. Jokowi pun menjawab  tak
ada persoalan yang membuatnya pusing karena ia telah menghadapi  
masalah itu sejak ia memimpin Solo selama delapan tahun. Namun, ada satu
masa Jokowi mengaku tidak memiliki semangat. &quot;Yaitu kalau pas B sama 
pas T. Apa  itu? Pokoknya pas B sama pas T. <em>Ciyuss</em>,&quot; canda Jokowi yang mengundang  tawa para wartawan. (sumber: kompas.com)
</p>
","","Jumat","2013-01-25","01:11:01","42jokowi.jpg","0","metropolitan");
INSERT INTO berita VALUES("654","31","admin","Bahaya Mendiagnosis Penyakit Lewat Internet","","","bahaya-mendiagnosis-penyakit-lewat-internet","N","Y","N","<p>
Apakah Anda mengunjungi &quot;dokter Google&quot; lebih sering dari dokter di 
klinik? Anda tidak sendiri. Dalam sebuah survei tahun lalu di Amerika 
diketahui bahwa 35 persen responden mencocokkan gejala penyakitnya di 
internet dan mendiagnosis dirinya sendiri.
</p>
<p>
Masih menurut survei 
yang dilakukan The Pew Research Center&#39;s Internet &amp; American Life 
Project itu, sekitar 41 responden mengatakan diagnosis sendiri itu 
ternyata dikonfirmasi kebenarannya oleh dokter. 
</p>
<p>
Tetapi, sekitar 
satu dari tiga responden mengaku tidak pernah pergi ke dokter untuk 
mencari opini kedua. Malahan, 18 persen responden mengatakan bahwa upaya
mendiagnosis sendiri itu ternyata salah ketika ditanyakan ke dokter. 
</p>
<p>
Meski
survei yang melibatkan 3.000 responden itu sebenarnya dilakukan untuk 
mengetahui siapa yang mencari informasi kesehatan secara <em>online</em>, tetapi para profesional medis merasa khawatir dengan tren itu.
</p>
<p>
&quot;Rata-rata
tiap orang mengunjungi empat situs lalu memutuskan ia menderita kanker 
dan akan segera meninggal. Padahal, di internet banyak informasi yang 
keliru,&quot; kata Rahul K Khare, dokter unit gawat darurat dari Northwestern
Memorial Hospital.
</p>
<p>
Menurut Khare, ia sering menemukan pasien 
yang hidupnya menjadi penuh kecemasan karena mereka merasa menderita 
penyakit berat setelah mencocokkan gejala yang dirasakannya dengan 
informasi di internet. (sumber: kompas.com)
</p>
","","Jumat","2013-01-25","01:18:13","60keluarga.jpg","0","kesehatan");
DROP TABLE IF EXISTS download;
CREATE TABLE `download` (
  `id_download` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_file` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `hits` int(3) NOT NULL,
  PRIMARY KEY (`id_download`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO download VALUES("3","Membuat Shopping Cart dengan PHP","shopping cart.pdf","2009-02-17","16");
INSERT INTO download VALUES("5","Skrip Captcha","captcha.rar","2009-02-06","15");
INSERT INTO download VALUES("1","Kalender Tahun 2009","kalender2009.rar","2009-02-06","19");
INSERT INTO download VALUES("8","Wallpaper PHP","PHP_weapon.jpg","2009-10-28","37");
INSERT INTO download VALUES("9","Slide  Pemrograman VBA Excell","Excell_VBA.ppt","2009-11-03","24");
DROP TABLE IF EXISTS gallery;
CREATE TABLE `gallery` (
  `id_gallery` int(5) NOT NULL AUTO_INCREMENT,
  `id_album` int(5) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `jdl_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gallery_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `gbr_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_gallery`)
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO gallery VALUES("240","30","admin","Doa Bersama","doa-bersama","Para personil Kantata tengah melakukan doa bersama sebelum pementasan.
","38kantata1.jpg");
INSERT INTO gallery VALUES("239","30","admin","Semangat Kantata","semangat-kantata","Semangat para macan-macan tua Kantata, seolah mmemberi penyadaran baru dan bagai api yang tak pernah padam.
","7kantata2.jpg");
INSERT INTO gallery VALUES("238","30","admin","Lautan Penonton","lautan-penonton","Lebih kurang dari 50.000 penonton yang memadati Stadion Gelora Bung Karno menyaksikan aksi Kantata Barock.
","7kantata3.jpg");
INSERT INTO gallery VALUES("237","30","admin","Mengenang WS. Rendra","mengenang-ws-rendra","Konser didedikasikan buat salah satu anggota Kantata Takwa, WS. Rendra. Suasana kemeriahan para artis pendukung.
","44kantata4.jpg");
INSERT INTO gallery VALUES("236","30","admin","Iwan Fals","iwan-fals","Iwan Fals yang tergabung dalam Kantata Barock bersama Setiawan Djodi dan Sawong Jabo menghibur penggemarnya di GBK.
","85kantata5.jpg");
INSERT INTO gallery VALUES("235","30","admin","Iwan dan Oemar Bakrie","iwan-dan-oemar-bakrie","Aksi penonton yang mirip dengan Iwan Fals dan sang guru Oemar Bakrie
","95kantata6.jpg");
INSERT INTO gallery VALUES("234","30","admin","Bento...Bento..!!","bentobento","Bento...Bento...Bentok...!! ....Asyikkk... begitu teriak Setiawan Djody dan Sawung Jabo yang ikuti ribuan penonton.
","32kantata7.jpg");
INSERT INTO gallery VALUES("232","29","admin","Karpet Raksasa dari Bunga 008","karpet-raksasa-dari-bunga-008","","45bungaraksasa8.jpg");
INSERT INTO gallery VALUES("233","30","admin","Sujud Syukur","sujud-syukur","Seluruh awak Kantata Barock melakukan sujud syukur di penghujung acara.<br />
","32kantata8.jpg");
INSERT INTO gallery VALUES("231","29","admin","Karpet Raksasa dari Bunga 007","karpet-raksasa-dari-bunga-007","","89bungaraksasa7.jpg");
INSERT INTO gallery VALUES("230","29","admin","Karpet Raksasa dari Bunga 006","karpet-raksasa-dari-bunga-006","","17bungaraksasa6.JPG");
INSERT INTO gallery VALUES("229","29","admin","Karpet Raksasa dari Bunga 005","karpet-raksasa-dari-bunga-005","","74bungaraksasa5.JPG");
INSERT INTO gallery VALUES("228","29","admin","Karpet Raksasa dari Bunga 004","karpet-raksasa-dari-bunga-004","","22bungaraksasa4.JPG");
INSERT INTO gallery VALUES("227","29","admin","Karpet Raksasa dari Bunga 003","karpet-raksasa-dari-bunga-003","","78bungaraksasa3.JPG");
INSERT INTO gallery VALUES("225","29","admin","Karpet Raksasa dari Bunga 001","karpet-raksasa-dari-bunga-001","","17bungaraksasa1.JPG");
INSERT INTO gallery VALUES("226","29","admin","Karpet Raksasa dari Bunga 002","karpet-raksasa-dari-bunga-002","","22bungaraksasa2.JPG");
INSERT INTO gallery VALUES("224","28","admin","Favorit","favorit","Mainan adalah barang favorit yang senantiasa diburu para pembeli. Selain murah, pilihannya pun berbagai jenis.
","34asemka10.jpg");
INSERT INTO gallery VALUES("223","28","admin","Suasana Pasar Asemka","suasana-pasar-asemka","Pasar Asemka, Jakarta, merupakan pasar grosir yang banyak menyediakan berbagai aksesoris seperti kalung, cincin, Souvenir pernakahan, dan lainnya. Di Pasara Asemka anda akan dimanjakan dengan beragam barang yang dibandrol dengan harga murah meriah dan biasanya dijual grosiran.<br />
","6asemka9.jpg");
INSERT INTO gallery VALUES("222","28","admin","Petasan","petasan","Petasan aneka jenis juga dijajakan di Pasar Asemka, Jakarta.
","2asemka8.jpg");
INSERT INTO gallery VALUES("221","28","admin","Merah Marun","merah-marun","Salah satu suvenir pernikahan nan cantik yang dijual di Pasar Asemka, Jakarta.
","82asemka4.jpg");
INSERT INTO gallery VALUES("220","28","admin","Menata Cincin","menata-cincin","Seorang pedagang cincin aksesoris sedang merapihkan letak cincin agar lebih menarik di Pasar Asemka, Jakarta.
","21asemka7.jpeg");
INSERT INTO gallery VALUES("219","28","admin","Suvenir","suvenir","Aneka Souvenir Pernikahan yang dijual di Pasar Asemka, Jakarta.
","41asemka1.jpg");
INSERT INTO gallery VALUES("218","28","admin","Seorang Wanita Pedagang","seorang-wanita-pedagang","Seorang wanita sedang menunggu kios aksesorisnya.
","7asemka6.jpeg");
INSERT INTO gallery VALUES("217","28","admin","Suasana Pasar","suasana-pasar","Suasana di Pasar Asemka yang senantiasa ramai. Dan pengunjung bebas memilih berbagai jenis aksesoris.
","22asemka5.jpeg");
INSERT INTO gallery VALUES("216","28","admin","Pedagang","pedagang","Seorang pedagang sedang membungkus souvenir penikahan yang akan dijual ataupun pesanan dari pelanggangnnya.
","84asemka2.jpg");
DROP TABLE IF EXISTS halamanstatis;
CREATE TABLE `halamanstatis` (
  `id_halaman` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `judul_seo` varchar(100) NOT NULL,
  `isi_halaman` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  `jam` time NOT NULL,
  `hari` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_halaman`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
INSERT INTO halamanstatis VALUES("18","Tentang Kami","tentang-kami","Website ini dipersembahkan untuk rakyat sulawesi barat","2012-03-08","webdesign.jpg","admin","739","20:08:00","Kamis");
DROP TABLE IF EXISTS header;
CREATE TABLE `header` (
  `id_header` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_header`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO header VALUES("31","Header3","","header3.jpg","2011-04-06");
INSERT INTO header VALUES("32","Header2","","header1.jpg","2011-04-06");
INSERT INTO header VALUES("33","Header1","","header2.jpg","2011-04-06");
DROP TABLE IF EXISTS hubungi;
CREATE TABLE `hubungi` (
  `id_hubungi` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `dibaca` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_hubungi`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO hubungi VALUES("30","wesiyadi","wesiyadi@digiporch.com","pasang iklan baris gratis","silahkan pasang iklan baris anda di gratis pasang tanpa perlu daftar

trims.","2012-06-25","00:00:00","Y");
DROP TABLE IF EXISTS identitas;
CREATE TABLE `identitas` (
  `id_identitas` int(5) NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `favicon` varchar(50) NOT NULL,
  PRIMARY KEY (`id_identitas`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
INSERT INTO identitas VALUES("1","Sulbarku.co - Siturs Berita Sulawesi Barat","Jl. Godean","footerLogo-black.png");
DROP TABLE IF EXISTS iklanatas;
CREATE TABLE `iklanatas` (
  `id_iklanatas` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_iklanatas`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO iklanatas VALUES("35","","admin","#","promoiklan.gif","2012-08-12");
DROP TABLE IF EXISTS iklantengah;
CREATE TABLE `iklantengah` (
  `id_iklantengah` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_iklantengah`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO iklantengah VALUES("26","Lembaga Amil Zakat dan Pemberdayaan  DOMPET SOSIAL INSAN MULIA","","#","dsim_lbanner.jpg","2011-06-26");
INSERT INTO iklantengah VALUES("30","ingin punya website?","","hal-jasa-pembuatan-website.html","webDesignBanner.jpg","2012-01-08");
INSERT INTO iklantengah VALUES("31","Contoh Iklan","","#","179748contoh_iklan002.jpg","2012-03-10");
DROP TABLE IF EXISTS katajelek;
CREATE TABLE `katajelek` (
  `id_jelek` int(11) NOT NULL AUTO_INCREMENT,
  `kata` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `ganti` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_jelek`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO katajelek VALUES("4","sex","","s**");
INSERT INTO katajelek VALUES("2","bajingan","","b*******");
INSERT INTO katajelek VALUES("3","bangsat","","b******");
DROP TABLE IF EXISTS kategori;
CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO kategori VALUES("19","Teknologi","","teknologi","Y");
INSERT INTO kategori VALUES("2","Olahraga","","olahraga","Y");
INSERT INTO kategori VALUES("21","Ekonomi","","ekonomi","N");
INSERT INTO kategori VALUES("22","Politik","","politik","N");
INSERT INTO kategori VALUES("23","Hiburan","","hiburan","Y");
INSERT INTO kategori VALUES("31","Kesehatan ","","kesehatan-","Y");
INSERT INTO kategori VALUES("36","Komunitas","","komunitas","N");
INSERT INTO kategori VALUES("34","Seni & Budaya","","seni--budaya","N");
INSERT INTO kategori VALUES("37","Sekitar Kita","","sekitar-kita","N");
INSERT INTO kategori VALUES("39","Internasional","","internasional","Y");
INSERT INTO kategori VALUES("40","Kuliner","","kuliner","Y");
INSERT INTO kategori VALUES("41","Metropolitan","","metropolitan","N");
INSERT INTO kategori VALUES("42","Dunia Islam","","dunia-islam","N");
INSERT INTO kategori VALUES("44","Wisata","","wisata","N");
INSERT INTO kategori VALUES("46","Daerah","","daerah","N");
INSERT INTO kategori VALUES("47","Gaya Hidup","","gaya-hidup","N");
INSERT INTO kategori VALUES("48","Hukum","","hukum","N");
INSERT INTO kategori VALUES("52","Sejarah Indonesia","admin","sejarah-indonesia","N");
INSERT INTO kategori VALUES("53","Tokoh","admin","tokoh","N");
DROP TABLE IF EXISTS keuangan;
CREATE TABLE `keuangan` (
  `id_keuangan` int(5) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(12) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `biaya_gji` double NOT NULL,
  `biaya_mkn` double NOT NULL,
  `biaya_lstrik` double NOT NULL,
  `biaya_air` double NOT NULL,
  `biaya_telepon` double NOT NULL,
  `biaya_ftocopy` double NOT NULL,
  `biaya_perlengkpn` double NOT NULL,
  `biaya_trnsport` double NOT NULL,
  `biaya_lain1` double NOT NULL,
  `biaya_lain2` double NOT NULL,
  `biaya_lain3` double NOT NULL,
  PRIMARY KEY (`id_keuangan`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
INSERT INTO keuangan VALUES("5","Pilih Bulan","2016","100000","10000","0","0","0","0","0","0","0","0","0");
DROP TABLE IF EXISTS komentar;
CREATE TABLE `komentar` (
  `id_komentar` int(5) NOT NULL AUTO_INCREMENT,
  `id_berita` int(5) NOT NULL,
  `nama_komentar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_komentar` text COLLATE latin1_general_ci NOT NULL,
  `tgl` date NOT NULL,
  `jam_komentar` time NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_komentar`)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO komentar VALUES("84","622","asyiqah",""," 	nice  story	   ","2012-01-05","00:15:45","Y","");
INSERT INTO komentar VALUES("91","623","ridha","komputerkampus.com"," makin  parah  aja  nih  ...
mudah2n  bisa  berbenah  negeri  ku  yg  q  banggakan   ","2012-03-08","20:06:07","Y","");
DROP TABLE IF EXISTS komentarvid;
CREATE TABLE `komentarvid` (
  `id_komentar` int(5) NOT NULL AUTO_INCREMENT,
  `id_video` int(5) NOT NULL,
  `nama_komentar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_komentar` text COLLATE latin1_general_ci NOT NULL,
  `tgl` date NOT NULL,
  `jam_komentar` time NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_komentar`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
DROP TABLE IF EXISTS logo;
CREATE TABLE `logo` (
  `id_logo` int(5) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_logo`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO logo VALUES("15","logo1.jpg");
DROP TABLE IF EXISTS member;
CREATE TABLE `member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS menu;
CREATE TABLE `menu` (
  `id_menu` int(5) NOT NULL AUTO_INCREMENT,
  `id_parent` int(5) NOT NULL DEFAULT '0',
  `nama_menu` varchar(30) NOT NULL,
  `link` varchar(100) NOT NULL,
  `aktif` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya',
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
INSERT INTO menu VALUES("9","8","Hukum","kategori-48-hukum.html","Ya");
INSERT INTO menu VALUES("8","0","Nasional","#","Ya");
INSERT INTO menu VALUES("7","0","Home","index.php","Ya");
INSERT INTO menu VALUES("11","8","Politik","kategori-22-politik.html","Ya");
INSERT INTO menu VALUES("12","8","Ekonomi","kategori-21-ekonomi.html","Ya");
INSERT INTO menu VALUES("13","0","Internasional","kategori-39-internasional.html","Ya");
INSERT INTO menu VALUES("14","0","Teknologi","kategori-19-teknologi.html","Ya");
INSERT INTO menu VALUES("18","0","Olahraga","kategori-2-olahraga.html","Ya");
INSERT INTO menu VALUES("19","0","Hiburan","kategori-23-hiburan.html","Ya");
INSERT INTO menu VALUES("20","0","Metropolitan","kategori-41-metropolitan.html","Ya");
INSERT INTO menu VALUES("21","0","Dunia Islam","kategori-42-dunia-islam.html","Ya");
INSERT INTO menu VALUES("22","39","Kuliner","kategori-40-kuliner.html","Ya");
INSERT INTO menu VALUES("23","0","Video","semua-playlist.html","Ya");
INSERT INTO menu VALUES("40","39","Kesehatan","kategori-31-kesehatan.html","Ya");
INSERT INTO menu VALUES("39","0","+ Lainnya","","Ya");
DROP TABLE IF EXISTS mod_alamat;
CREATE TABLE `mod_alamat` (
  `id_alamat` int(5) NOT NULL AUTO_INCREMENT,
  `alamat` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_alamat`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
INSERT INTO mod_alamat VALUES("1","<p>
Jl. Kalibata Selatan II/2B
</p>
<p>
Jakarta 12740 
</p>
<p>
Indonesia 
</p>
<p>
Telp. 021.32972759
</p>
<p>
Email: <a href=\"mailto:rizal_fzl@yahoo.com\">rizal_fzl@yahoo.com</a> 
</p>
");
DROP TABLE IF EXISTS mod_ym;
CREATE TABLE `mod_ym` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO mod_ym VALUES("1","Rizal Faizal","rizal_fzl");
DROP TABLE IF EXISTS modul;
CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('user','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO modul VALUES("2","Manajemen User","","?module=user","","","Y","user","Y","22","");
INSERT INTO modul VALUES("18"," Berita","","?module=berita","","","Y","user","Y","5","semua-berita.html");
INSERT INTO modul VALUES("19","Iklan Utama","","?module=banner","","","N","user","N","9","");
INSERT INTO modul VALUES("10","Manajemen Modul","","?module=modul","","","Y","user","Y","23","");
INSERT INTO modul VALUES("31","Kategori Berita ","","?module=kategori","","","Y","user","Y","6","");
INSERT INTO modul VALUES("33","Jajak Pendapat","","?module=poling","","","Y","user","Y","18","");
INSERT INTO modul VALUES("34","Tag Berita","","?module=tag","","","Y","user","Y","7","");
INSERT INTO modul VALUES("35","Komentar Berita","","?module=komentar","","","Y","user","Y","8","");
INSERT INTO modul VALUES("41","Agenda Jakarta","","?module=agenda","","","Y","user","Y","17","semua-agenda.html");
INSERT INTO modul VALUES("43","Berita Foto","","?module=album","","","Y","user","Y","11","");
INSERT INTO modul VALUES("44","Galeri Berita Foto","","?module=galerifoto","","","Y","user","Y","12","");
INSERT INTO modul VALUES("45","Template Web","","?module=templates","","","Y","user","Y","16","");
INSERT INTO modul VALUES("46","Sensor Kata","","?module=katajelek","","","Y","user","Y","10","");
INSERT INTO modul VALUES("61","Identitas Website","","?module=identitas","","","Y","user","Y","1","");
INSERT INTO modul VALUES("57","Menu Utama","","?module=menuutama","","","Y","user","Y","2","");
INSERT INTO modul VALUES("58","Sub Menu","","?module=submenu","","","Y","user","Y","3","");
INSERT INTO modul VALUES("59","Halaman Baru","","?module=halamanstatis","","","Y","user","Y","4","");
INSERT INTO modul VALUES("62","Video","","?module=video","","","Y","user","Y","13","");
INSERT INTO modul VALUES("63","Playlist Video","","?module=playlist","","","Y","user","Y","14","");
INSERT INTO modul VALUES("64","Tag Video","","?module=tagvid","","","Y","user","Y","15","");
INSERT INTO modul VALUES("65","Komentar Video","","?module=komentarvid","","","Y","user","Y","15","");
INSERT INTO modul VALUES("66","Logo Website","","?module=logo","","","Y","user","Y","15","");
INSERT INTO modul VALUES("67","Iklan Layanan","","?module=iklanatas","","","Y","user","Y","19","");
INSERT INTO modul VALUES("68","Iklan Depan","","?module=iklantengah","","","Y","user","Y","20","");
INSERT INTO modul VALUES("69","Iklan Kiri","","?module=pasangiklan","","","Y","user","Y","21","");
INSERT INTO modul VALUES("70","Hubungi Kami","","?module=hubungi","","","Y","user","Y","24","");
DROP TABLE IF EXISTS pasangiklan;
CREATE TABLE `pasangiklan` (
  `id_pasangiklan` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_pasangiklan`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO pasangiklan VALUES("26","PT. PELANGI SAMUDERA INTERNATIONAL","admin","http://www.","psim.jpg","2011-09-29");
DROP TABLE IF EXISTS playlist;
CREATE TABLE `playlist` (
  `id_playlist` int(5) NOT NULL AUTO_INCREMENT,
  `jdl_playlist` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `playlist_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gbr_playlist` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_playlist`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO playlist VALUES("50","POP","","pop","299267pop.jpg","Y");
INSERT INTO playlist VALUES("49","OLD SCHOOL","","old-school","89854oldschool.jpg","Y");
INSERT INTO playlist VALUES("51","JAZZ","","jazz","935169jazz.jpg","Y");
INSERT INTO playlist VALUES("52","ROCK","","rock","50347Rock.jpg","Y");
INSERT INTO playlist VALUES("55","DANGDUT","","dangdut","689891dangdut.jpg","Y");
INSERT INTO playlist VALUES("54","DANCE","","dance","986101dance.jpg","Y");
INSERT INTO playlist VALUES("56","WISATA INDONESIA","admin","wisata-indonesia","575958indonesiana.jpg","Y");
INSERT INTO playlist VALUES("57","Serba Serbi","admin","serba-serbi","733489serbaserbi.jpg","Y");
DROP TABLE IF EXISTS poling;
CREATE TABLE `poling` (
  `id_poling` int(5) NOT NULL AUTO_INCREMENT,
  `pilihan` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `rating` int(5) NOT NULL DEFAULT '0',
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_poling`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO poling VALUES("18","Siapakah Calon Gubernur dan Wakil Gubernur DKI Favorit Anda?","Pertanyaan","admin","0","Y");
INSERT INTO poling VALUES("26","Joko Widodo-Basuki Tjahaja Purnama","Jawaban","admin","9","Y");
INSERT INTO poling VALUES("25","Fauzi Bowo-Nachrowi Ramli","Jawaban","admin","3","Y");
DROP TABLE IF EXISTS sekilasinfo;
CREATE TABLE `sekilasinfo` (
  `id_sekilas` int(5) NOT NULL AUTO_INCREMENT,
  `info` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_sekilas`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO sekilasinfo VALUES("1","Anak yang mengalami gangguan tidur, cenderung memakai obat2an dan alkohol berlebih saat dewasa.","2010-04-11","","Y");
INSERT INTO sekilasinfo VALUES("2","WHO merilis, 30 persen anak-anak di dunia kecanduan menonton televisi dan bermain komputer.","0000-00-00","","Y");
INSERT INTO sekilasinfo VALUES("3","Menurut peneliti di Detroit, orang yang selalu tersenyum lebar cenderung hidup lebih lama.","2010-04-11","","Y");
INSERT INTO sekilasinfo VALUES("4","Menurut United Stated Trade Representatives, 25% obat yang beredar di Indonesia adalah palsu.","2010-04-11","","Y");
DROP TABLE IF EXISTS statistik;
CREATE TABLE `statistik` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '1',
  `online` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
INSERT INTO statistik VALUES("127.0.0.2","2009-09-11","1","1252681630");
INSERT INTO statistik VALUES("127.0.0.1","2013-01-22","1","1358865974");
INSERT INTO statistik VALUES("127.0.0.1","2013-01-23","14","1358913313");
INSERT INTO statistik VALUES("127.0.0.1","2013-01-24","34","1359046647");
INSERT INTO statistik VALUES("127.0.0.1","2013-01-25","21","1359051663");
INSERT INTO statistik VALUES("::1","2016-06-25","50","1466870202");
INSERT INTO statistik VALUES("::1","2016-07-02","6","1467451170");
INSERT INTO statistik VALUES("::1","2016-07-03","8","1467559606");
INSERT INTO statistik VALUES("::1","2016-07-04","2","1467585940");
INSERT INTO statistik VALUES("::1","2016-07-25","2","1469412295");
INSERT INTO statistik VALUES("::1","2016-08-09","5","1470733139");
INSERT INTO statistik VALUES("::1","2016-08-10","3","1470810385");
INSERT INTO statistik VALUES("::1","2016-08-11","6","1470906989");
INSERT INTO statistik VALUES("::1","2016-08-12","4","1470986737");
DROP TABLE IF EXISTS tag;
CREATE TABLE `tag` (
  `id_tag` int(5) NOT NULL AUTO_INCREMENT,
  `nama_tag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tag_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `count` int(5) NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO tag VALUES("30","Pendidikan","","pendidikan","7");
INSERT INTO tag VALUES("29","Ekonomi","","ekonomi","7");
INSERT INTO tag VALUES("22","Hiburan","","hiburan","16");
INSERT INTO tag VALUES("28","Teknologi","","teknologi","8");
INSERT INTO tag VALUES("27","Metropolitan","","metropolitan","29");
INSERT INTO tag VALUES("26","Nasional","","nasional","38");
INSERT INTO tag VALUES("25","Kesehatan","","kesehatan","14");
INSERT INTO tag VALUES("24","Olahraga","","olahraga","10");
INSERT INTO tag VALUES("23","Dunia Islam","","dunia-islam","40");
INSERT INTO tag VALUES("21","Kuliner","","kuliner","17");
INSERT INTO tag VALUES("20","Komunitas","","komunitas","2");
INSERT INTO tag VALUES("31","Politik","","politik","15");
INSERT INTO tag VALUES("32","Seni & Budaya","","seni--budaya","4");
INSERT INTO tag VALUES("33","Sekitar Kita","","sekitar-kita","9");
INSERT INTO tag VALUES("34","Wisata","","wisata","4");
INSERT INTO tag VALUES("35","Gaya Hidup","","gaya-hidup","4");
INSERT INTO tag VALUES("36","Hukum","","hukum","13");
INSERT INTO tag VALUES("37","Film","","film","24");
INSERT INTO tag VALUES("38","Musik","","musik","11");
INSERT INTO tag VALUES("39","Daerah","","daerah","23");
INSERT INTO tag VALUES("40","Internasional","","internasional","22");
INSERT INTO tag VALUES("41","Bola","","bola","19");
INSERT INTO tag VALUES("42","Televisi","","televisi","2");
INSERT INTO tag VALUES("43","Selebritis","","selebritis","5");
INSERT INTO tag VALUES("44","Tragedi Tugu Tani","","tragedi-tugu-tani","3");
INSERT INTO tag VALUES("45","Pilkada DKI","","pilkada-dki","0");
INSERT INTO tag VALUES("46","Tokoh","","tokoh","0");
INSERT INTO tag VALUES("47","Piala Eropa","","piala-eropa","23");
INSERT INTO tag VALUES("48","Sejarah Indonesia","admin","sejarah-indonesia","18");
DROP TABLE IF EXISTS tagvid;
CREATE TABLE `tagvid` (
  `id_tag` int(5) NOT NULL AUTO_INCREMENT,
  `nama_tag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tag_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `count` int(5) NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
DROP TABLE IF EXISTS templates;
CREATE TABLE `templates` (
  `id_templates` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `pembuat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `folder` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_templates`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO templates VALUES("12","Biru","admin","Rizal Faizal","layout/biru","N");
INSERT INTO templates VALUES("13","Merah","admin","Rizal Faizal","layout/merah","Y");
INSERT INTO templates VALUES("16","Hijau","admin","Rizal Faizal","layout/hijau","N");
DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO users VALUES("admin","21232f297a57a5a743894a0e4a801fc3","syahli","sya4li@yahoo.co.id","","","admin","N","q173s8hs1jl04st35169ccl8o7");
DROP TABLE IF EXISTS users_modul;
CREATE TABLE `users_modul` (
  `id_umod` int(11) NOT NULL AUTO_INCREMENT,
  `id_session` varchar(100) NOT NULL,
  `id_modul` int(11) NOT NULL,
  PRIMARY KEY (`id_umod`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
INSERT INTO users_modul VALUES("88","5bi6b98a7r02hvh15dsog2vfo2","44");
INSERT INTO users_modul VALUES("87","5bi6b98a7r02hvh15dsog2vfo2","43");
INSERT INTO users_modul VALUES("102","5bi6b98a7r02hvh15dsog2vfo2","34");
INSERT INTO users_modul VALUES("80","5bi6b98a7r02hvh15dsog2vfo2","18");
INSERT INTO users_modul VALUES("101","5bi6b98a7r02hvh15dsog2vfo2","2");
DROP TABLE IF EXISTS video;
CREATE TABLE `video` (
  `id_video` int(5) NOT NULL AUTO_INCREMENT,
  `id_playlist` int(5) NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `jdl_video` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `video_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `gbr_video` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `video` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `youtube` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dilihat` int(7) NOT NULL DEFAULT '1',
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `tagvid` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_video`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
INSERT INTO video VALUES("147","49","admin","Taylor Dayne-Tell It To My Heart","taylor-daynetell-it-to-my-heart","I feel the night explode<br />
When we&#39;re together<br />
Emotion overload<br />
In the heat of pleasure<br />
<br />
Take me I&#39;m yours<br />
Into your arms<br />
Never let me go<br />
Tonight I really need to know<br />
<br />
Tell it to my heart<br />
Tell me I&#39;m the only one<br />
Is this really love or just a game?<br />
Tell it to my heart<br />
I can feel my body rock<br />
Every time you call my name<br />
<br />
The passion&#39;s so complete<br />
It&#39;s never ending<br />
As long as I receive<br />
The message you&#39;re sending<br />
<br />
Body to body<br />
Soul to soul<br />
Always feel you near<br />
So say the words I long to hear<br />
<br />
Tell it to my heart<br />
Tell me I&#39;m the only one<br />
Is this really love or just a game?<br />
Tell it to my heart<br />
I can feel my body rock<br />
Every time you call my name<br />
<br />
Love, love on the run<br />
Breakin&#39; us down<br />
Though we keep holdin&#39; on<br />
I don&#39;t want to lose<br />
No, I can&#39;t let you go<br />
<br />
Tell it to my heart<br />
Tell me I&#39;m the only one<br />
Is this really love or just a game?<br />
Tell it to my heart<br />
I can feel my body rock<br />
Every time you call my name<br />
<br />
Tell it to my heart<br />
Tell me from the start<br />
Tell it to my heart<br />
Tell it to my heart<br />
Tell me from the start<br />
Tell it to my heart<br />
Never make it stop<br />
Oh, take it to the heart<br />
<br />
Tell it to my heart<br />
Tell me I&#39;m the only one<br />
Is this really love or just a game?<br />
Tell it to my heart<br />
I can feel my body rock<br />
Every time you call my name<br />
Tell it to my heart<br />
Tell me I&#39;m the only one<br />
Is this really love or just a game?<br />
Tell it to my heart
","831329taylor_dayne.jpg","","http://www.youtube.com/embed/Ud6sU3AclT4","15","Sabtu","2012-02-04","12:11:28","");
INSERT INTO video VALUES("148","50","admin","Shania Twain-Youre Still The One ","shania-twainyoure-still-the-one-","When I first saw you, I saw love<br />
And the first time you touched me, I felt love<br />
And after all this time, you&#39;re still the one I love<br />
<br />
Looks like we made it<br />
Look how far we&#39;ve come my baby<br />
We mighta took the long way<br />
We knew we&#39;d get there someday<br />
<br />
They said, &quot;I bet they&#39;ll never make it&quot;<br />
But just look at us holding on<br />
We&#39;re still together still going strong<br />
<br />
(You&#39;re still the one)<br />
You&#39;re still the one I run to<br />
The one that I belong to<br />
You&#39;re still the one I want for life<br />
<br />
(You&#39;re still the one)<br />
You&#39;re still the one that I love<br />
The only one I dream of<br />
You&#39;re still the one I kiss good night<br />
<br />
Ain&#39;t nothin&#39; better<br />
We beat the odds together<br />
I&#39;m glad we didn&#39;t listen<br />
Look at what we would be missin&#39;<br />
<br />
They said, &quot;I bet they&#39;ll never make it&quot;<br />
But just look at us holding on<br />
We&#39;re still together still going strong<br />
<br />
(You&#39;re still the one)<br />
You&#39;re still the one I run to<br />
The one that I belong to<br />
You&#39;re still the one I want for life<br />
<br />
(You&#39;re still the one)<br />
You&#39;re still the one that I love<br />
The only one I dream of<br />
You&#39;re still the one I kiss good night<br />
You&#39;re still the one<br />
<br />
(You&#39;re still the one)<br />
You&#39;re still the one I run to<br />
The one that I belong to<br />
You&#39;re still the one I want for life<br />
<br />
(You&#39;re still the one)<br />
You&#39;re still the one that I love<br />
The only one I dream of<br />
You&#39;re still the one I kiss good night<br />
<br />
I&#39;m so glad we made it<br />
Look how far we&#39;ve come my baby
","854shania_twain.jpg","","http://www.youtube.com/embed/KNZH-emehxA","26","Sabtu","2012-02-04","12:31:16","");
INSERT INTO video VALUES("146","49","admin","New Kids On The Block-Step by Step","new-kids-on-the-blockstep-by-step","Step by step, ooh baby<br />
Gonna get to you girl<br />
Step by step, girl<br />
<br />
Step by step, ooh baby<br />
Gonna get to you girl<br />
Step by step, ooh baby<br />
Really want you in my world<br />
<br />
Step, hey girl<br />
In your eyes, I see a picture of me all the time<br />
Step and girl<br />
When you smile, you&#39;ve got to know that you drive me wild<br />
<br />
Step by step, ooh baby<br />
You&#39;re always on my mind<br />
Step by step, ooh girl<br />
I really think it&#39;s just a matter of time<br />
<br />
Step by step, ooh baby<br />
Gonna get to you girl<br />
Step by step, ooh baby<br />
Really want you in my world<br />
<br />
Step, hey girl<br />
Can&#39;t you see, I&#39;ve got to have you all just for me<br />
Step and girl<br />
Yes, it&#39;s true, no one else will ever do<br />
<br />
Step by step, ooh baby<br />
You&#39;re always on my mind<br />
Step by step, ooh girl<br />
I really think it&#39;s just a matter of time<br />
<br />
Step by step, ooh baby<br />
Really want you in my world<br />
Step by step, ooh baby<br />
Gonna get to you girl<br />
<br />
Step, step, step, step by step<br />
Step one<br />
We can have lots of fun<br />
Step two<br />
There&#39;s so much we can do<br />
Step three<br />
It&#39;s just you and me<br />
Step four<br />
I can give you more<br />
Step five<br />
Don&#39;t you know that the time is right<br />
<br />
Step by step<br />
Don&#39;t you know I need you<br />
Step by step<br />
Yes, I do, girl<br />
<br />
Step by step, ooh baby<br />
You&#39;re always on my mind<br />
Step by step, ooh girl<br />
I really think it&#39;s just a matter of time<br />
<br />
Step by step, ooh baby<br />
Gonna get to you girl<br />
Step by step, ooh baby<br />
Really want you in my world<br />
<br />
Step by step, ooh baby<br />
Gonna get to you girl<br />
Step by step, ooh girl<br />
Really want you in my world<br />
<br />
Step by step, ooh baby<br />
Gonna get to you girl<br />
Step by step, ooh baby<br />
","532379nkotb.jpg","","http://www.youtube.com/embed/ES_kxPkgm9U","12","Sabtu","2012-02-04","11:39:50","");
INSERT INTO video VALUES("145","49","admin","Debbie Gibson - Electric Youth ","debbie-gibson--electric-youth-","Zappin&#39; it to you, the pressure&#39;s everywhere<br />
Goin&#39; right through you<br />
The fever&#39;s in the air, oh, yeah, it&#39;s there<br />
Don&#39;t underestimate the power of a lifetime ahead<br />
<br />
Electric youth, feel the power<br />
You see the energy comin&#39; up, coming on strong<br />
The future only belongs to the future itself<br />
And the future is electric youth<br />
It&#39;s true you can&#39;t fight it, live by it<br />
The next generation, it&#39;s electric<br />
<br />
We&#39;ve got the most time to make the world go round<br />
Oh, can you spare a dime?<br />
Place your bet on our sound, come back to town<br />
Don&#39;t lose sight of potential mastermind<br />
Remember when you were young<br />
<br />
Electric youth, feel the power<br />
You see the energy comin&#39; up, coming on strong<br />
The future only belongs in the hands of itself<br />
And the future is electric youth<br />
It&#39;s true you can&#39;t fight it, live by it<br />
The next generation, it&#39;s electric<br />
<br />
We do what comes naturally<br />
You see now, wait for the possibility<br />
Don&#39;t you see a strong resemblance to yourself?<br />
Don&#39;t you think what we say is important?<br />
Whatever it may be, the fun is gonna start with me<br />
I&#39;m bringing it back<br />
<br />
Electric youth, feel the power<br />
You see the energy comin&#39; up, coming on strong<br />
The future only belongs to the future itself<br />
And the future is, electric youth<br />
It&#39;s true you can&#39;t fight it, live by it<br />
The next generation, it&#39;s electrifying<br />
<br />
Electric youth, feel the power<br />
You see the energy comin&#39; up, coming on strong<br />
The future only belongs in the hands of itself<br />
And the future is electric youth<br />
It&#39;s true you can&#39;t fight it, live by it<br />
The next generation, it&#39;s electric<br />
It&#39;s electric, it&#39;s electric<br />
<br />
Electric youth, feel the power<br />
You see the energy comin&#39; up, coming on strong<br />
The future only belongs to the future itself<br />
And the future is electric youth<br />
It&#39;s true you can&#39;t fight it, live by it<br />
The next generation<br />
<br />
Inflation, flirtation<br />
Relaxation, elation<br />
Generation of<br />
An electric youth
","952941debbie-gibson.jpg","","http://www.youtube.com/embed/QW9-VGcNZ5M","23","Sabtu","2012-02-04","11:03:09","");
INSERT INTO video VALUES("143","49","admin","A Shoulder To Cry On-Tommy Page","a-shoulder-to-cry-ontommy-page","Life is full of lots of up and downs,<br />
And the distance feels further when you&#39;re headed for the ground,<br />
And there is nothing more painful than to let you&#39;re feelings take<br />
you down,<br />
It&#39;s so hard to know the way you feel inside,<br />
When there&#39;s many thoughts and feelings that you hide,<br />
But you might feel better if you let me walk with you<br />
by your side,<br />
<br />
And when you need a shoulder to cry on,<br />
When you need a friend to rely on,<br />
When the whole world is gone,<br />
You won&#39;t be alone, cause I&#39;ll be there,<br />
I&#39;ll be your shoulder to cry on,<br />
I&#39;ll be there,<br />
I&#39;ll be a friend to rely on,<br />
When the whole world is gone,<br />
you won&#39;t be alone, cause I&#39;ll be there.<br />
<br />
All of the times when everything is wrong<br />
And you&#39;re feeling like<br />
There&#39;s no use going on<br />
You can&#39;t give it up<br />
I hope you work it out and carry on<br />
Side by side,<br />
With you till the end<br />
I&#39;ll always be the one to firmly hold your hand<br />
no matter what is said or done<br />
our love will always continue on<br />
<br />
Everyone needs a shoulder to cry on<br />
everyone needs a friend to rely on<br />
When the whole world is gone<br />
you won&#39;t be alone cause I&#39;ll be there<br />
I&#39;ll be your shoulder to cry on<br />
I&#39;ll be there<br />
I&#39;ll be the one you rely on<br />
when the whole world&#39;s gone<br />
you won&#39;t be alone<br />
cause I&#39;ll be there!<br />
<br />
And when the whole world is gone<br />
You&#39;ll always have my shoulder to cry on.... 
","437103tommy_page.jpg","","http://www.youtube.com/embed/UgpQ0H7xwkI","44","Sabtu","2012-02-04","10:34:29","");
INSERT INTO video VALUES("142","49","admin","Like A Prayer - Madonna","like-a-prayer--madonna","Life is a mystery<br />
Everyone must stand alone<br />
I hear you call my name<br />
And it feels like home<br />
<br />
When you call my name it&#39;s like a little prayer<br />
I&#39;m down on my knees, I wanna take you there<br />
In the midnight hour I can feel your power<br />
Just like a prayer you know I&#39;ll take you there<br />
<br />
I hear your voice<br />
It&#39;s like an angel sighing<br />
I have no choice, I hear your voice<br />
Feels like flying<br />
<br />
I close my eyes<br />
Oh God I think I&#39;m falling<br />
Out of the sky, I close my eyes<br />
Heaven help me<br />
<br />
When you call my name it&#39;s like a little prayer<br />
I&#39;m down on my knees, I wanna take you there<br />
In the midnight hour I can feel your power<br />
Just like a prayer you know I&#39;ll take you there<br />
<br />
Like a child<br />
You whisper softly to me<br />
You&#39;re in control just like a child<br />
Now I&#39;m dancing<br />
<br />
It&#39;s like a dream<br />
No end and no beginning<br />
You&#39;re here with me it&#39;s like a dream<br />
Let the choir sing<br />
<br />
When you call my name it&#39;s like a little prayer<br />
I&#39;m down on my knees, I wanna take you there<br />
In the midnight hour I can feel your power<br />
Just like a prayer you know I&#39;ll take you there<br />
<br />
When you call my name it&#39;s like a little prayer<br />
I&#39;m down on my knees, I wanna take you there<br />
In the midnight hour I can feel your power<br />
Just like a prayer you know I&#39;ll take you there<br />
<br />
Life is a mystery<br />
Everyone must stand alone<br />
I hear you call my name<br />
And it feels like home<br />
<br />
Just like a prayer, your voice can take me there<br />
Just like a muse to me, you are a mystery<br />
Just like a dream, you are not what you seem<br />
Just like a prayer, no choice your voice can take me there<br />
<br />
Just like a prayer, I&#39;ll take you there<br />
It&#39;s like a dream to me<br />
Just like a prayer, I&#39;ll take you there<br />
It&#39;s like a dream to me<br />
<br />
Just like a prayer, I&#39;ll take you there<br />
It&#39;s like a dream to me<br />
Just like a prayer, I&#39;ll take you there<br />
It&#39;s like a dream to me<br />
<br />
Just like a prayer, your voice can take me there<br />
Just like a muse to me, you are a mystery<br />
Just like a dream, you are not what you seem<br />
Just like a prayer, no choice your voice can take me there<br />
<br />
Just like a prayer, your voice can take me there<br />
Just like a muse to me, you are a mystery<br />
Just like a dream, you are not what you seem<br />
Just like a prayer, no choice your voice can take me there<br />
Your voice can take me there<br />
Like a prayer<br />
<br />
Just like a prayer<br />
Just like a prayer, your voice can take me there<br />
Just like a prayer<br />
Just like a prayer, your voice can take me there
","581115madonna-like-a-prayer.jpg","","http://www.youtube.com/embed/cSVbwwsLPqw","11","Sabtu","2012-02-04","10:23:49","");
INSERT INTO video VALUES("144","49","admin","Milli Vanilli-Baby Dont Forget My Number","milli-vanillibaby-dont-forget-my-number","Babe, don&#39;t be shy<br />
When you&#39;re holding my hand<br />
&#39;Cause this time goes back<br />
You got to understand it&#39;s you<br />
<br />
Ba, ba, ba, baby in your eyes<br />
I see it so clearly that our love, it&#39;s so strong<br />
And you never go wrong<br />
I got the best for you so I&#39;m waiting down<br />
<br />
If you need someone<br />
Baby, call my line<br />
Call me anytime<br />
I&#39;ll be there for you, you, you<br />
<br />
I&#39;ve been searching high, high, high<br />
I&#39;ve been searching low<br />
<br />
Ba, ba, ba, ba, baby<br />
Don&#39;t forget my number<br />
Baby, don&#39;t be stronger than a thunder<br />
Ba, ba, ba, ba, baby<br />
Don&#39;t forget my number<br />
Love will see you through<br />
<br />
I&#39;ve been searching high<br />
I&#39;ve been searching low<br />
<br />
I want to spend spend my life with you<br />
Ba, ba, ba, ba, ba, ba, ba, ba<br />
My desper youth<br />
Ba, ba, ba, ba, ba, ba, ba, ba<br />
Love will see you through<br />
<br />
Ba, ba, baby in your eyes<br />
I see it so clearly
","447998milli-vanilli.jpg","","http://www.youtube.com/embed/saPp0jr7Go0","28","Sabtu","2012-02-04","10:44:56","");
INSERT INTO video VALUES("140","49","admin","Forever Young - Alphaville","forever-young--alphaville","Lets dance in style, lets dance for a while.<br />
Heaven can wait were only watching the skies.<br />
Hoping for the best but expecting the worst.<br />
Are you gonna drop the bomb or not?<br />
<br />
Let us die young or let us live forever.<br />
We dont have the power but we never say never.<br />
Sitting in a sandpit, life is a short trip.<br />
The music&#39;s for the sad men.<br />
<br />
Can you imagine when this race is won.<br />
Turn our golden faces into the sun.<br />
Praising our leaders were getting in tune.<br />
The musics played by the madmen.<br />
<br />
Forever young, I want to be forever young.<br />
Do you really want to live forever? forever and ever.<br />
<br />
Forever young, I want to be forever young.<br />
Do you really want to live forever? for ever young.<br />
<br />
Some are like water, some are like the heat.<br />
Some are a melody and some are the beat.<br />
Sooner or later they all will be gone.<br />
Why dont they stay young?<br />
<br />
Its so hard to get old without a cause.<br />
I dont want to perish like a fading horse.<br />
Youth is like diamonds in the sun.<br />
And diamonds are forever.<br />
<br />
So many adventures couldnt happen today.<br />
So many songs we forgot to play.<br />
So many dreams are swinging out of the blue.<br />
We let them come true.<br />
<br />
Forever young, I want to be forever young.<br />
Do you really want to live forever? forever and ever.<br />
<br />
Forever young, I want to be forever young.<br />
Do you really want to live forever? forever and ever.<br />
<br />
Forever young, I want to be forever young.<br />
Do you really want to live forever? forever.
","976013alphaville-forever-young.jpg","","http://www.youtube.com/embed/t1TcDHrkQYg","27","Sabtu","2012-02-04","09:03:23","");
INSERT INTO video VALUES("149","50","admin","Meja - All About The Money","meja--all-about-the-money","Some times I find another world inside my mind
When I realize all the crazy things we do
It makes me feel ashamed to be alive
I wanna run away and hide
It&#39;s all about the money, it&#39;s all about the dum dum
And I don&#39;t think it&#39;s funny to see us fade away
It&#39;s all about the money, it&#39;s all about the
I think we got it all wrong anyway
Strange ways of showing how much we really care
When in face we don&#39;t seem to care at all
This pretty world is getting out of hand
So how come we fail to understand?
It&#39;s all about the money, it&#39;s all about the dum dum
And I don&#39;t think it&#39;s funny to see us fade away
It&#39;s all about the money, it&#39;s all about the
I think we got it all wrong anyway
","793426meja.jpg","","http://www.youtube.com/embed/YcXMhwF4EtQ","100","Sabtu","2012-02-04","13:04:19","");
INSERT INTO video VALUES("156","56","admin","Borobudur","borobudur","Borobudur adalah nama sebuah candi Buddha yang terletak di Borobudur, Magelang, Jawa Tengah, Indonesia. Lokasi candi adalah kurang lebih 100 km di sebelah barat daya Semarang, 86 km di sebelah barat Surakarta, dan 40 km di sebelah barat laut Yogyakarta. Candi berbentuk stupa ini didirikan oleh para penganut agama Buddha Mahayana sekitar tahun 800-an Masehi pada masa pemerintahan wangsa Syailendra. Monumen ini terdiri atas enam teras berbentuk bujur sangkar yang diatasnya terdapat tiga pelataran melingkar, pada dindingnya dihiasi dengan 2.672 panel relief dan aslinya terdapat 504 arca Buddha.[1] Stupa utama terbesar teletak di tengah sekaligus memahkotai bangunan ini, dikelilingi oleh tiga barisan melingkar 72 stupa berlubang yang didalamnya terdapat arca buddha tengah duduk bersila dalam posisi teratai sempurna dengan mudra (sikap tangan) Dharmachakra mudra (memutar roda dharma).<br />
","523559borobudur-temple.jpg","","http://www.youtube.com/embed/ldHd8Z5ZV-c","6","Kamis","2012-11-22","23:33:29","");
