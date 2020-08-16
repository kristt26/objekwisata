-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2020 pada 15.03
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jk` enum('Pria','Wanita') DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` enum('Aktif','Pending') DEFAULT 'Pending',
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`idadmin`, `nama`, `alamat`, `jk`, `email`, `status`, `iduser`) VALUES
(1, 'admin', '-', 'Pria', 'kristt26@gmail.com', 'Aktif', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukutamu`
--

CREATE TABLE `bukutamu` (
  `idbukutamu` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `tgl_masuk` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `location` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `bukutamu`
--

INSERT INTO `bukutamu` (`idbukutamu`, `nama`, `email`, `pesan`, `tgl_masuk`, `location`) VALUES
(1, 'Ajenkris Y. Kungkung', 'kristt26@gmail.com', 'Hadir', '2020-08-16 06:58:58', '{\"ip\":\"185.56.138.218\",\"city\":\"Amsterdam\",\"region\":\"North Holland\",\"country\":\"NL\",\"loc\":\"52.3740,4.8897\",\"org\":\"AS60558 PHOENIX NAP, LLC.\",\"postal\":\"1012\",\"timezone\":\"Europe/Amsterdam\"}'),
(2, 'Candra', 'candra@mail.com', 'hadir', '2020-08-16 06:59:39', '{\"ip\":\"185.56.138.218\",\"city\":\"Amsterdam\",\"region\":\"North Holland\",\"country\":\"NL\",\"loc\":\"52.3740,4.8897\",\"org\":\"AS60558 PHOENIX NAP, LLC.\",\"postal\":\"1012\",\"timezone\":\"Europe/Amsterdam\"}'),
(3, 'Aldrich', 'aldrc@mail.com', 'hadir', '2020-08-16 08:10:18', '{\"ip\":\"180.243.32.238\",\"city\":\"Jayapura\",\"region\":\"Papua\",\"country\":\"ID\",\"loc\":\"-2.5337,140.7181\",\"org\":\"AS7713 PT Telekomunikasi Indonesia\",\"timezone\":\"Asia/Jayapura\"}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `tgl_posting` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idwisata` int(11) NOT NULL,
  `stringtext` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`idevent`, `nama`, `alamat`, `isi`, `tgl_mulai`, `tgl_selesai`, `tgl_posting`, `idwisata`, `stringtext`, `foto`) VALUES
(1, 'Testing event', 'Bukti Jokowi', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>Testing</strong>&nbsp;saja mungkinkah kita</p>\r\n\r\n<blockquote>\r\n<p>berteteasdfasdf</p>\r\n</blockquote>\r\n\r\n<p>sdfasdfasdf</p>\r\n\r\n<p>sdfasdfasd</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\">sfasdfsadfa</div>\r\n', '2020-08-01', '2020-08-31', '2020-08-15 15:00:00', 1, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>Testing</strong>&nbsp;saja mungkinkah kita</p>\r\n\r\n<blockquote>\r\n<p>berteteasdfasdf</p>\r\n</blockquote>\r\n\r\n<p>sdfasdfasdf</p>\r\n\r\n<p>sdfasdfasd</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\">sfasdfsadfa</div>\r\n', 'rh3mLCDJ2ihV6cD.jpg'),
(2, 'Festival Teluk Humbolt', 'Bibir Pantai Hamadi', '<p>Wali kota&nbsp; mengatakan, pihaknya sudah membahas bersama Koordinator Seksi Upacara Panitia Besar PON&nbsp; 2020 di GOR Waringin, Kota Jayapura, Kamis (12/03/2020).</p>\r\n\r\n<p>Menurutnya, PB PON memutuskan&nbsp; FTH ke-12 tahun 2020 disatukan dengan upacara pembukaan (open ceremony) dan upacara penutupan (close ceremony) PPN 2020 di Stadion Papua Bangkit, Kampung Harapan, Distrik Sentani Timur, Kabupaten Jayapura pada tangal 20 Oktober hingga 2 November 2020.</p>\r\n\r\n<p>Setelah itu, ujar wali kota,&nbsp; FTH akan kembali digelar pada tahun&ndash;tahun mendatang. Pasalnya, FTH sudah menjadi agenda wisata nasional dan menjadi salah satu pariwisata unggulan yang unik di Provinsi Papua.</p>\r\n\r\n<p>Diketahui, Pemkot Jayapura menggelar FTH&nbsp; tiap awal Agustus di bibir pantai wisata Hamadi. FTH menampilkan kekayaan budaya masyarakat adat&nbsp; di wilayah Port Numbay.</p>\r\n\r\n<p>Masing-masing tari tadisional, suling tambur, lomba masak menu tradisional, lomba anyam rambut dan hias pinang. Lalu ada wisata peninggalan Perang Dunia II, panorama pantai Hamadi dan pantai lainnya di Teluk Humboldt</p>\r\n', '2019-10-20', '2019-11-02', '2019-09-16 15:00:00', 15, 'Wali kota&nbsp; mengatakan, pihaknya sudah membahas bersama Koordinator Seksi Upacara Panitia Besar PON&nbsp; 2020 di GOR Waringin, Kota Jayapura, Kamis (12/03/2020).\r\n\r\nMenurutnya, PB PON memutuskan&nbsp; FTH ke-12 tahun 2020 disatukan dengan upacara pem', '5HLbP0wPcH0o1oy.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_wisata`
--

CREATE TABLE `kategori_wisata` (
  `idkategori_wisata` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `icon` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori_wisata`
--

INSERT INTO `kategori_wisata` (`idkategori_wisata`, `nama`, `icon`) VALUES
(1, 'Pegunungan', 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'),
(2, 'Laut', 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'),
(3, 'Wisata Kuliner', 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'),
(4, 'Tempat Ibadah', 'https://maps.google.com/mapfiles/ms/icons/yellow-dot.png'),
(5, 'Pusat Oleh-oleh', 'https://maps.google.com/mapfiles/ms/icons/pink-dot.png'),
(6, 'Tempat Penginapan', 'https://maps.google.com/mapfiles/ms/icons/purple-dot.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `marking`
--

CREATE TABLE `marking` (
  `idmarking` int(11) NOT NULL,
  `long` varchar(45) DEFAULT NULL,
  `lat` varchar(45) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `modifier` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idwisata` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  `status` enum('true','false','proses') DEFAULT 'proses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `marking`
--

INSERT INTO `marking` (`idmarking`, `long`, `lat`, `created`, `modifier`, `idwisata`, `iduser`, `status`) VALUES
(1, '140.68847179412842', '-2.588480699999666', '2020-08-15', '2020-08-14 15:00:00', 1, 2, 'true'),
(2, '140.70918917655945', '-2.578829204157304', '2020-08-15', '2020-08-14 15:00:00', 15, 2, 'true'),
(3, '140.70707023143768', '-2.5976364236566334', '2020-08-15', '2020-08-16 12:16:12', 16, 2, 'true'),
(9, '140.71168899536133', '-2.4877714647144837', '2020-08-16', NULL, 22, 2, 'true');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `idmember` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jk` enum('Pria','Wanita') DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` enum('Aktif','Pending') DEFAULT 'Pending',
  `iduser` int(11) NOT NULL,
  `oauth_uid` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`idmember`, `nama`, `alamat`, `jk`, `email`, `status`, `iduser`, `oauth_uid`, `picture`, `created`) VALUES
(21, 'Ajenkris Yanto Kungkung', NULL, NULL, 'kristt26@gmail.com', 'Aktif', 26, '107803677827793000991', 'https://lh3.googleusercontent.com/a-/AOh14Ghc1iUV51Rr-hs3MA6nuofEw7jJ2uyHT-3aSAys', '2020-08-15 16:46:54'),
(31, 'Deni Malik', 'easfasd', 'Pria', 'kristt26@gmail.com', 'Pending', 36, '', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Pending') DEFAULT NULL,
  `jenis` enum('admin','member') NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `status`, `jenis`) VALUES
(2, 'admin', 'ac20a86151bb896d10e636a0a91696fa', 'Aktif', 'admin'),
(26, 'kristt26@gmail.com', 'cc7e80973b23fe209776073cfb214cd0', 'Aktif', 'member'),
(36, 'deni', 'aa08769cdcb26674c6706093503ff0a3', 'Pending', 'member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_uid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `idwisata` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `keterangan` text NOT NULL,
  `biayaparkir` double NOT NULL DEFAULT 0,
  `biayapondok` varchar(45) NOT NULL DEFAULT '',
  `idkategori_wisata` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`idwisata`, `nama`, `alamat`, `keterangan`, `biayaparkir`, `biayapondok`, `idkategori_wisata`, `foto`) VALUES
(1, 'Bukit Jokowi', 'Skyland, Entrop, Jayapura Sel., Kota Jayapura, Papua, Indonesia', 'Tempat itu dulunya gersang, hanya ditumbuhi rerumputan, tapi kini menjadi salah satu tempat favorit warga Kota Jayapura untuk menikmati keindahan alam serta merasakan sejuknya tiupan angin.\n\nTempat itu bernama Bukit Jokowi, berada di sekitar pebukitan Skyland, pebukitan yang menjadi penghubung Kota Jayapura dan Kota Abepura, dan berhadapan langsung dengan Samudera Pasific dan Teluk Youtefa.\n\nDitempuh sekitar 30 menit dari pusat Kota Jayapura dan 15 menit dari Kota Pelajar Abepura.\n\nDari atas Bukit Jokowi terhampar pemandangan indah, Teluk Youtefa yang didalamnya terhadap dua kampung, Tobati dan Enggros, serta di kejauhan tampak kumpulan bangunan berwarna biru yang adalah PLTU (Pembangkit Listrik Tenaga Uap).\n\nDari atas bukit ini juga kita melihat pembangunan jembatan yang menghubungkan Kota Jayapura dan Distrik Muara Tami sepanjang 733 meter, juga ada ruas jalan layang sepanjang 3,5 kilometer dari Pantai Hamadi sampai ke Vihara di Skyland yang merupakan bagian dari rencana pembagunan ring road.\n\n‘’Dulu tempat ini semuanya bernama Skyland karena berada di Bukit Skyland, tetapi sejak dikunjungi Pak Jokowi tempat ini langsung dinamai Bukit Jokowi,’’ jelas Marice Tanasale Korwa, Ibu penjual kelapa muda di Bukit Jokowi.\n\nPada tahun 2014 saat Presiden Joko Widodo pertama kali melakukan kunjungan ke Papua, dan memilih tempat tersebut untuk berdiri di memantau lokasi pembangunan ring road di Teluk Youtefa serta pembangunan jembatan menghubungkan Kota Jayapura dan wilayah Koya melewati Teluk Youtefa.\n\n‘’Saat itu Pak Presiden akan memantau pembangunan ring road dan jembatan di Teluk Youtefa dan tempat yang paling strategis ya di sini, makanya sebelum Pak Jokowi berdiri di tempat ini, petugas meratakannya karena dulunya tempat ini berupa gundukan hanya sedikit yang rata, kemudian gundukan itu diratakan dan jadilah tempat ini, dan namanya pun menjadi Bukit Jokowi,’’ cerita Marice.\n\nSaat Presiden Jokowi memasuki lokasi yang luasnya sekitar 200 meter persegi, dilakukan upacara adat dengan melakukan injak piring. ‘’Sesuai dengan adat Biak, jika memasuki suatu tempat tamu disambut dengan adat injak piring,’’ kenangnya.\n\nSepeninggal Presiden Jokowi, tempat itu pun kemudian ramai dikunjungi warga, yang datang sekedar duduk-duduk menikmati keindahan alam di Teluk Youtefa.\n\n‘’Karena ramai maka kami keluarga melihat bagus untuk menjual kelapa muda bagi pengunjung, dan kami pun mulai membangun pondok honai dan menyiapkan bangku tempat duduk, dan sejak itu kami mendapatkan rejeki dari tempat ini', 20000, '0', 1, 'eba43da81b319bbe722f85a2080c8eda.jpg'),
(15, 'Pantai Hamadi', 'Jl. Hamadi Pante, Tobati, Jayapura Sel., Kota Jayapura, Papua, Indonesia', 'Pada tahun 1944, saat Jayapura masih bernama Hollandia, pasukan sekutu membangun basis pusat komando di wilayah ini. Di bawah komando panglima tertinggi sekutu, Jenderal Douglas McArthur, Jayapura menjadi saksi bagaimana persiapan pasukan sekutu menghadapi pasukan Jepang yang menguasai sebagian besar wilayah Pasifik. Salah satu wilayah yang cukup penting adalah pesisir pantai Hollandia yang kini dikenal sebagai Pantai Hamadi.\n\nSejarah di atas adalah latar belakang yang menjadikan Pantai Hamadi menjadi menarik dan berbeda dari beberapa pantai lain di kota Jayapura. Dahulu, saat pasukan sekutu memasuki wilayah Jayapura, pantai ini menjadi pertahanan pasukan sekutu terhadap serangan Jepang. Oleh sebab itu, bila kita mengunjungi pantai Hamadi saat ini, sisa benteng pertahanan terbentang dengan panjang kira-kira 2 kilometer terdapat disana.\n\nBenteng ini menjadi saksi sejarah bagaimana pasukan sekutu mempertahankan basis pusat komandonya di wilayah pasifik. Keberadaan benteng ini adalah salah satu strategi pertahanan pasukan sekutu yang juga menjadi satu rangkaian dengan pantai Base-G di kota Jayapura. Walaupun kondisinya sudah tidak utuh lagi, namun sisa tembok benteng menjadikan pantai Hamadi sebagai obyek bersejarah yang menarik untuk dikunjungi.\n\nSelain nilai sejarahnya, pantai ini sekarang juga menjadi obyek wisata yang ramai dikunjungi wisatawan lokal dan luar Jayapura. Mereka biasanya menghabiskan waktu liburan Sabtu-Minggu di tempat ini bersama keluarga maupun teman-teman. Berenang, berolahraga, atau hanya sekedar bercengkrama menjadi aktifitas mereka sambil menikmati indahnya pemandangan sekitar. Pantai Hamadi sangat cocok untuk bersantai di kala sore hari sambil menunggu datangnya malam di kota Jayapura.\n\nWilayah yang masih berada di pusat kota Jayapura menjadikan Pantai Hamadi mudah untuk dijangkau dan dekat dengan pusat kegiatan masyarakat Jayapura. Hal ini pula yang membuat Pantai Hamadi menjadi obyek wisata terkenal di ibukota propinsi Papua ini. Pantai yang membentang luas, pasir berwarna keemasan dan cerita sejarah di balik Hamadi, sangat cukup membuat pantai ini semakin mempesona.', 100000, '300000', 2, '2d8db2cc900095c61ac17aab3af67817.jpg'),
(16, 'Tugu Pekabaran Injil di tanah papua', 'Engros, Abepura, Kota Jayapura, Papua, Indonesia', 'Konon, penduduk asli Jayapura tidak berasal dari kota Jayapura yang kita ketahui sekarang. Ini berarti ada wilayah lain di luar Jayapura yang menjadi tempat asal leluhur penduduk Jayapura masa kini. Cerita ini bukanlah isapan jempol semata, tempat itu ada dan berada tidak jauh dari pusat kota Jayapura. Dengan waktu tempuh sekitar 20 menit menggunakan kendaraan bermotor menuju arah kota Abepura, terdapat sebuah teluk dengan pulau di tengahnya menjadi saksi asal usul nenek moyang penduduk asli Jayapura. Teluk ini adalah Teluk Youtefa dan pulau itu bernama Pulau Debi.\n\nBila kita ingin menuju pulau Debi yang berarti pulau cantik ini, kita harus menggunakan perahu motor yang berangkat dari pelabuhan kecil di pasar Youtefa. Perjalanan menelusuri asal usul penduduk Jayapura pun dimulai dengan membayar sewa perahu motor sebesar Rp10.000. Perjalanan ini memakan waktu yang tidak lama, hanya sekitar 10 menit saja dan kita akan sampai di pelabuhan kecil pulau Debi.\n\nSesuai namanya, pulau kecil ini terlihat sangat cantik dan mempesona. Rumpun pepohonan kelapa menegaskan suasana lautan yang begitu tenang dan asri. Semilir angin pun tak terhindarkan menyejukkan hati. Kemudian, kita akan disambut oleh sebuah tugu peringatan pekabaran injil di tanah Tabi Papua. Tugu megah ini dibangun karena memang pulau Debi adalah saksi awal bagaimana para misionaris Kristen menyebarkan ajaran kasih Yesus di wilayah Jayapura dan sekitarnya. Para misionaris ini adalah misionaris yang sebelumnya sudah mengajarkan kekritenan di wilayah Mansinam, Manokwari. Mereka menjejakkan kaki di pulau Debi untuk pertama kalinya dan memulai misi kasih-Nya.\n\nTidak jauh dari tugu, terdapat sebuah lapangan pasir kecil yang biasa digunakan anak-anak dari warga setempat untuk bermain bola. Uniknya, pada saat air pasang, lapangan ini akan hilang terendam air laut. Lapangan ini akan kembali terlihat pada saat air surut. Kondisi alam menarik ini adalah salah satu daya tarik wisata yang dimiliki Pulau Debi.\n\nSelain kekayaan alam dan kisah pekabaran injil, pulau Debi juga masih menyimpan cerita-cerita sejarah yang menarik. Sesuai tujuan awal kita untuk menelusuri jejak nenek moyang masyarakat Jayapura, kita juga harus tahu bahwa pulau Debi merupakan pusat kegiatan dua kampung tertua di wilayah Tanah Tabi Jayapura. Kampung ini bernama Tobati dan Enggros. Tobati terletak agak jauh dan menempel pada wilayah pantai Hamadi, Jayapura. Sedangkan, kampung kedua yaitu Kampung Enggros berada di tengah laut teluk Youtefa dan terhubung langsung dengan si cantik Pulau Debi melalui sebuah jembatan kayu.\n\nMenurut cerita beberapa tetua adat setempat, sebelum ada kota Jayapura, pusat peradaban di wilayah tanah Tabi Papua hanya terpusat di sekitar pulau Debi, serta Kampung Tobati dan Enggros saja. Setelah masuknya ajaran Kristen dan peradaban berkembang, masyarakat pun memperluas wilayah tinggalnya hingga ke wilayah daratan dan dimulailah peradaban di kota Jayapura. Walaupun masyarakat asli Enggros sudah tersebar luas, namun hingga kini mereka dikenal memiliki karakter dan tradisi yang agak berbeda dengan masyarakat Papua daratan.\n\nKampung Enggros, adalah kampung unik yang terletak di tengah lautan. Kampung ini seolah terapung di atas wilayah perairan teluk Youtefa. Walaupun letaknya berada di laut, semua fasilitas di kampung ini cukup memadai. Mulai dari pos polisi, klinik, kantor kepala desa, gereja, hingga sarana air bersih dan listrik pun lengkap dimiliki kampung ini. Pemerintah pusat propinsi Papua tampaknya cukup memperhatikan kampung ini, hal ini terjadi karena kampung ini dianggap sebagai awal mula terbentuknya kota Jayapura, ibukota Papua. Bahkan, sekarang pemerintah sedang membina kampung Enggros untuk menjadi kampung wisata yang tentu saja dapat menarik wisatawan dari dalam dan luar negeri.\n\nDi kampung tradisional yang begitu tenang ini, kita dapat menikmati panorama sebuah kampung terapung. Jalan yang berupa dermaga kayu menyebar luas menghubungkan bangunan satu dengan lainnya. Rumah-rumah kayu khas penduduk pesisir Papua pun menjadi sajian utama pariwisata kampung ini. Jangan kuatir pula dengan terik matahari yang menyengat, karena beberapa bagian jalan di kampung Enggros sudah dilengkapi dengan atap, sehingga hujan atau panas matahari tidak akan menjadi kendala.\n\nBila kita semakin masuk menjelajah ke tengah kampung, kita akan menemukan banyak sekali tambak ikan yang menjadi salah satu tradisi warga Enggros. Mereka umumnya mengembangbiakkan ikan bandeng dan bobara yang cukup populer di Papua. Aktifitas warga lainnya adalah bercocok tanam. Kondisi kampung yang berada di tengah lautan tanpa tanah pun tidak menyurutkan semangat warga Enggros untuk membudidayakan tanaman-tanaman hias di kampung mereka. Warga menanam tanaman tersebut di dalam pot-pot kecil yang diletakkan di depan halaman rumah masing-masing. Budidaya tambak dan tanaman hias ini adalah beberapa upaya pemerintah yang dilakukan sehubungan dengan pembinaan Enggros sebagai kampung wisata di masa mendatang.\n\nWarga Kampung Enggros terkenal ramah dan bijak dalam kehidupan. Berbeda dengan masyarakat wilayah lain yang dikenal pemabuk dan berwatak keras, warga Enggros sangat mengedepankan nilai-nilai kesopanan dan saling menghormati antar warga. Bahkan, ada sebuah hukum tidak tertulis yang menyebutkan bahwa berbicara keras dan memainkan radio atau televisi dengan suara keras sangat dilarang di kampung ini. Begitu juga dengan sikap kasar yang umumnya dilakukan kaum pria terhadap wanita pun sangat ditentang. Bila pelanggaran terjadi, hukuman yang diberlakukan adalah hukuman sosial berupa pengucilan atau dipermalukan di muka umum. Hal ini sangat positif, mengingat kampung ini akan diarahkan menjadi kampung wisata.\n\nKampung Enggros dan Pulau Debi sangatlah mempesona. Keramahan penduduknya, keindahan alam, serta nilai-nilai yang terkandung di dalam kehidupan kampung ini telah memberikan pelajaran berharga bagi kita yang mungkin sudah teracuni oleh negatifnya kehidupan modern. Ternyata, penelusuran asal usul nenek moyang masyarakat Jayapura pun berbuah manis dan menobatkan Kampung Enggros dan Pulau Debi sebagai tempat wisata yang sangat layak dikunjungi saat berada di Jayapura, propinsi Papua, Indonesia. [@phosphone/IndonesiaKaya]', 0, '0', 4, '162705943deaa146c298bb41e401ff3e.jpg'),
(22, 'Pantai Pasir 6', 'Tj. Ria, Jayapura Utara, Kota Jayapura, Papua, Indonesia', 'Objek wisata yang satu ini mampu membuat wisatawan yang datang terkagum – kagum dengan keindahan alamnya. Pantai dengan panorama alam yang luar biasa ini terletak di distrik Jayapura Utara, Jayapura. Walaupun terletak di wilayah perkotaan, untuk mencapai lokasi pantai ini tidak semudah mencapai objek wisata pantai lainnya yang hanya memerlukan alat transportasi darat.\n\nPasalnya, kamu harus menggunakan perahu motor agar bisa sampai di pantai ini dengan cepat. Pertama – tama, Anda dapat menuju Pantai Dok VIII. Selanjutnya, dari pantai tersebut kamu bisa menyewa perahu motor yang akan mengantarkan kamu ke Pasir Enam. Tarif sewa perahu tergantung dari kapasitas dan hasil negosiasi antara kamu dengan pemilik perahu. Perjalanan dari Pantai Dok VIII memerlukan waktu sekitar 20 sampai 30 menit. Karena perjalanan tersebut melewati Teluk Cenderawasih, jangan heran jika kamu merasakan ombak dan gelombang yang cukup besar dalam perjalanan.\n\nTetapi, pemandangan lautan biru dan keindahan alam lainnya akan membuat perjalanan kamu terasa lebih menyenangkan. kamu sebenarnya juga bisa menggunakan jalur darat untuk sampai di lokasi pantai. Namun aksesnya cukup sulit karena harus berjalan kaki melalui jalan setapak di hutan dan lembah Cyclops. Kemiringan track yang akan dilalui antara 20 sampai 70 derajat. Perjalanan melewati jalur darat ini dapat dimulai dari belakang perumahan Bucen VI kemudian berjalan sekitar 3 km. Sepanjang perjalanan, Kamu akan dimanjakan dengan suasana hutan yang masih alami, bebatuan gunung, air terjun, dan jurang.\n\nRute darat ini cocok untuk wisatawan yang menyukai aktivitas hiking atau menyukai tantangan. Pantai Pasir Enam adalah pantai alami yang memiliki pasir berwarna putih. Suasana di pantai ini sangat cocok bagi wisatawan yang mencari ketenangan. Apalagi latar belakang pantai ini juga berupa kawasan perbukitan. Walaupun garis pantainya tidak terlalu panjang, ombak dan tarikkan ombak di pantai ini cukup besar. Bagi kamu yang belum mahir berenang, sebaiknya jangan berenang di pantai ini karena pantai di pasir 6 ini sangatlah deras arusnya itu di sebab kan karena berbatasan langsung dengan samudra pasifik. Masih banyak aktivitas lain yang dapat dilakukan seperti bersantai sambil menikmati keindahan di tepi pantai dan membakar ikan segar.\n\nNah, buat kamu yang pandai berenang, kamu bisa mencoba snorkling di pantai pasir enam ini. Untuk snorkling di pantai ini peralatan yang harus dibawa sendiri sebelum ke pantai karena di pantai pasir enam tidak ada tempat penyewaan peralatan snorkeling. Daya tarik lainnya dari Pantai Pasir Enam ini adalah keberadaan air tawar yang terdapat pada sungai yang ada di dekat pantai pasir enam ini langsung mengalir ke laut. Air sungai ini sangat jernih dan dapat dijadikan sebagai tempat berenang bagi wisatawan yang kurang mahir berenang. Pada Surga Kecil Di Tanah Papua Pantai Pasir 6 ini kamu juga dapat menggunakan sungai air tawar untuk membilas tubuh setelah berenang di pantai.\n\nini lah Wisata Pantai Pasir 6 yang indah dan mempesona', 0, '0', 2, '14f25e4d90ca5199007f91670ae72df6.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`),
  ADD KEY `fk_admin_user1_idx` (`iduser`);

--
-- Indeks untuk tabel `bukutamu`
--
ALTER TABLE `bukutamu`
  ADD PRIMARY KEY (`idbukutamu`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`),
  ADD KEY `fk_event_wisata1_idx` (`idwisata`);

--
-- Indeks untuk tabel `kategori_wisata`
--
ALTER TABLE `kategori_wisata`
  ADD PRIMARY KEY (`idkategori_wisata`);

--
-- Indeks untuk tabel `marking`
--
ALTER TABLE `marking`
  ADD PRIMARY KEY (`idmarking`),
  ADD KEY `fk_marking_wisata1_idx` (`idwisata`),
  ADD KEY `fk_marking_user1_idx` (`iduser`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idmember`),
  ADD KEY `fk_admin_user1_idx` (`iduser`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `index` (`username`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`idwisata`),
  ADD KEY `fk_wisata_kategori_wisata_idx` (`idkategori_wisata`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bukutamu`
--
ALTER TABLE `bukutamu`
  MODIFY `idbukutamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori_wisata`
--
ALTER TABLE `kategori_wisata`
  MODIFY `idkategori_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `marking`
--
ALTER TABLE `marking`
  MODIFY `idmarking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `idmember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `wisata`
--
ALTER TABLE `wisata`
  MODIFY `idwisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_user100` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_wisata1` FOREIGN KEY (`idwisata`) REFERENCES `wisata` (`idwisata`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `marking`
--
ALTER TABLE `marking`
  ADD CONSTRAINT `fk_marking_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_marking_wisata1` FOREIGN KEY (`idwisata`) REFERENCES `wisata` (`idwisata`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_admin_user10` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD CONSTRAINT `fk_wisata_kategori_wisata` FOREIGN KEY (`idkategori_wisata`) REFERENCES `kategori_wisata` (`idkategori_wisata`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
