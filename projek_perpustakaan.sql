-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 29 Jan 2025 pada 15.54
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sinopsis` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stok_buku` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `pengarang`, `penerbit`, `genre`, `gambar`, `sinopsis`, `stok_buku`) VALUES
(10, 'Once Upon A Time', 'Sutisna', 'Bookstocks', 'Thriller, Mystery, Action', 'th (1).jpg', 'Angkasa Raya ditemukan tewas mengenaskan dengan mata dan bagian tubuh atas yang terjahit. Bunga gardenia putih juga dijahit pada jempol kanannya. Hanya ada satu petunjuk yang ditinggalkan pelaku, sebuah surat yang bercerita tentang dongeng Serigala dan Gadis Berjubah Merah.\r\nDunia Leya jungkir balik setelah dirinya menceburkan diri ke dalam kubangan gelap permainan sang pembunuh bersama Glenn, si misterius yang konon pernah tinggal di rumah sakit jiwa.\r\nTak ada jalan keluar, ia juga menjadi sasaran.', 24),
(11, 'Harry Potter', 'J. K. Rowling', 'Bookstocks', 'Action, Fantasy, Adventure', '1734314114_unduhan.jpg', 'Harry Potter adalah seri tujuh novel fantasi yang dikarang oleh penulis Inggris J. K. Rowling. Novel ini mengisahkan tentang petualangan seorang penyihir remaja bernama Harry Potter dan sahabatnya, Ron Weasley dan Hermione Granger, yang merupakan pelajar di Sekolah Sihir Hogwarts.', 88),
(12, 'Alice In Wonderland', 'Lewis Carrol', 'Bookstocks', 'Action, Fantasy, Adventure', '1734944033_images (3).jpg', 'Seorang gadis muda bernama Alice adalah tokoh utama dalam Alice in Wonderland. Ia tertidur dan bermimpi bahwa ia mengikuti seekor Kelinci Putih ke dalam lubang kelinci . Ia mengalami banyak petualangan yang menakjubkan, sering kali aneh. Alice sering kali berubah ukuran secara tak terduga, tumbuh setinggi rumah dan menyusut hingga tiga inci.', 40),
(13, 'Dongeng Seru Dunia Binatang', 'Sutisna', 'Indonesiabooks', 'Fantasy, Slice Of Life, Adventure', '1734248436_OIP (1).jpg', 'Dongeng kali ini, menceritakan tentang kesombongan kancil sebagai binatang hutan. Kisah bermula dari Kancil yang merasa jika dirinya adalah hewan paling cerdik dan pandai di hutan. Saking yakinnya, si kancil sampai menyombongkan hal tersebut di hadapan binatang lainnya.', 20),
(14, 'Dilan 1990', 'Pidi Baiq', 'Indonesiabooks', 'Romance, Action, Slice Of Life', '1734311260_OIP.jpg', 'Cerita dimulai dengan kepindahan Milea dari Jakarta ke Bandung. Di sana, dia bertemu dengan Dilan, seorang remaja yang dikenal dengan kepribadiannya yang unik dan cara pendekatannya yang berbeda dari kebanyakan laki-laki pada umumnya.\r\n\r\nDilan bukanlah remaja biasa. Dia adalah seorang anggota geng motor yang terkenal di sekolahnya. Meskipun demikian, Dilan memiliki sisi romantis yang jarang ditemui pada remaja seusianya.\r\n\r\nSikap Dilan yang penuh kejutan, sering kali membawa Milea ke dalam situasi yang gak terduga dan lucu. Sebagai contoh, Dilan pernah mengirimkan kado yang tidak biasa kepada Milea, seperti buku teka-teki silang dengan pesan yang membuat Milea tertawa.\r\n\r\nSeiring berjalannya waktu, hubungan mereka semakin dekat dan romantis. Dilan, dengan segala keunikannya, berhasil mencuri hati Milea. Namun, hubungan mereka tidak selalu berjalan mulus. \r\n\r\nMereka harus menghadapi berbagai konflik, baik dari internal geng motor maupun dari lingkungan sekolah yang sering kali memandang negatif hubungan mereka. Di tengah semua tantangan tersebut, Dilan dan Milea belajar banyak tentang cinta, masa muda, dan keberanian.', 0),
(15, 'In The Dark', 'Sutisna', 'Bookstocks', 'Action, Slice Of Life', '1734313677_OIP (3).jpg', ' Murphy adalah seorang wanita berusia dua puluhan yang keras kepala, suka minum alkohol, dan tidak puas. Dia juga buta. Hidupnya hancur ketika dia menemukan apa yang dia yakini sebagai tubuh tak bernyawa dari sahabat karibnya di gang luar apartemennya.', 0),
(16, 'You Cannot Take My Life', 'Sutisna', 'Bookstocks', 'Action, Fantasy, Adventure', '1734313759_th.jpg', 'Bercerita tentang pemuda bernama Resky, dia menghadapi malaikat yang ingin mencabut nyawanya tetapi tidak bisa karena Resky dapat melihat malaikat tersebut. Setiap kali malaikat itu mendekat, Resky pergi menjauh untuk menghindari malaikat itu. Tantangan apa saja yang akan dialami Resky kedepannya?.', 0),
(17, 'The Sum Of All Things', 'Nicole Brooks', 'Americanbook', 'Romance, Slice Of Life', '1734314048_unduhan (1).jpg', 'Mengisahkan perjalanan dua perempuan, Wren, seorang tunawisma pecandu yang hamil tak terduga, dan Alex, wanita karier yang mencari makna hidup setelah meninggalkan pekerjaannya. Ketika Alex menawarkan Wren tempat tinggal, hidup mereka berubah secara drastis. Novel ini mengeksplorasi tema gender, kekerasan terhadap perempuan, kecanduan, dan tunawisma, dengan sentuhan paranormal, memberikan pandangan mendalam tentang pengalaman perempuan dalam masyarakat modern.', 0),
(18, 'Senja', 'Maimunah S. S', 'Indonesiabooks', 'Slice Of Life', '1734929343_unduhan (2).jpg', 'Senja adalah kisah tentang Aksara, seorang penulis muda yang kehilangan semangat hidup setelah gagal menerbitkan novelnya, dan Senja, seorang pelukis misterius yang selalu hadir di taman kota saat matahari terbenam. Dalam pertemuan tak terduga, keduanya berbagi cerita, mimpi, dan luka yang tersembunyi di balik senyuman. Bersama, mereka belajar bahwa hidup, seperti senja, tak hanya tentang keindahan di ujung hari, tetapi juga keberanian untuk memulai kembali setelah kegelapan.', 0),
(19, 'Fortress of Blood', 'Jester Kings', 'Bookstocks', 'Action, Fantasy, Adventure', '1734929671_OIP (8).jpg', 'Fortress of Blood adalah kisah kelam tentang sekelompok penjelajah yang terjebak di dalam sebuah benteng misterius yang dipenuhi rahasia dan kutukan kuno. Saat malam tiba, benteng itu berubah menjadi perangkap mematikan, dengan bayangan-bayangan gelap yang mengintai dan suara-suara dari masa lalu yang menuntut balas. Dipimpin oleh seorang pemimpin yang menyembunyikan masa lalunya, kelompok ini harus berjuang melawan kegelapan di luar dan di dalam diri mereka, sambil mengungkap misteri benteng yang menuntut pengorbanan darah untuk kebebasan.', 0),
(20, 'The Path To Nowhere', 'Bill Murray', 'Americanbook', 'Fantasy, Slice Of Life, Adventure', '1734934155_download (5).jpg', 'The Path to Nowhere adalah kisah tentang seorang pengembara bernama Elira yang tersesat di hutan tak berujung, di mana waktu dan arah kehilangan maknanya. Setiap langkah membawanya ke tempat yang berbeda, penuh teka-teki dan bayangan dari masa lalunya yang menghantui. Saat ia bertemu dengan jiwa-jiwa lain yang juga terjebak, Elira menyadari bahwa perjalanan ini bukan hanya tentang menemukan jalan keluar, tetapi tentang menghadapi ketakutan terdalam dan mencari tujuan di tengah kehampaan.', 0),
(21, 'Walk Into The Shadow', 'Mary June', 'Manybookss', 'Horror, Thriller, Mystery, Action', '1734934295_download (7).jpg', 'Walk into the Shadow adalah kisah tentang Kael, seorang pria yang terobsesi menemukan adiknya yang hilang setelah diseret oleh sosok misterius ke dalam dunia gelap yang disebut The Shadow. Dalam perjalanannya, Kael harus melintasi batas antara kenyataan dan ilusi, menghadapi makhluk-makhluk yang terlahir dari kegelapan dan menghadapi rahasia kelam yang mengintai dalam dirinya sendiri. Langkah demi langkah, ia menyadari bahwa untuk menyelamatkan adiknya, ia harus berani menghadapi bayangannya sendiri dan memilih antara cahaya atau menjadi bagian dari kegelapan.', 0),
(22, 'Never Ending Sky', 'Murata Mukahashi', 'Nigounikkai', 'Action, Fantasy, Adventure', '1734934391_download (4).jpg', 'Never Ending Sky mengisahkan Alara, seorang gadis muda yang menemukan portal misterius ke dunia di atas awan, di mana langit tak pernah berakhir dan kerajaan terapung berdiri megah. Namun, dunia itu ternyata terancam oleh kehancuran akibat konflik antara penguasa langit dan makhluk angin yang memberontak. Dibantu oleh seekor burung legendaris yang bisa berbicara, Alara memulai perjalanan berbahaya untuk memulihkan keseimbangan dunia tersebut, sekaligus menemukan rahasia besar tentang asal-usulnya yang terkait erat dengan langit abadi itu. Novel ini mengangkat tema keberanian, pengorbanan, dan pencarian jati diri dalam balutan petualangan yang epik.', 0),
(23, 'Lukisan Senja', 'Tomi Agus', 'Indonesiabooks', 'Romance, Comedy', '1734934488_download.jpg', 'Lukisan Senja adalah kisah tentang Arga, seorang pelukis yang kehilangan penglihatannya akibat kecelakaan tragis, dan Rana, seorang wanita muda penuh rahasia yang menjadi pendampingnya. Rana membantu Arga melukis kembali senja yang pernah menjadi inspirasinya, meski Arga hanya bisa membayangkannya dalam ingatan. Seiring waktu, Arga mulai menyadari bahwa keindahan sejati senja tidak hanya ada di kanvas, tetapi dalam keberanian Rana yang menyembunyikan rasa sakitnya sendiri. Di tengah warna-warna senja yang tak terlihat, mereka menemukan cinta dan harapan untuk melampaui batasan hidup.', 0),
(24, 'Soul', 'Shaq O Real', 'Bookstocks', 'Drama, Fantasy', '1734934894_download (1).jpg', 'Soul adalah kisah yang mengikuti perjalanan seorang musisi muda bernama Elliot, yang meninggal secara mendadak sebelum mencapai impiannya. Namun, arwahnya tersesat di dunia antara, tempat di mana jiwa-jiwa baru belajar tentang kehidupan sebelum turun ke bumi. Dengan bantuan sebuah jiwa muda yang enggan dilahirkan, Elliot harus menerima kenyataan hidupnya dan menemukan kembali apa yang benar-benar berarti baginya. Cerita ini menggambarkan tema tentang makna hidup, pencarian jati diri, dan hubungan manusia dengan dunia di sekitarnya.', 0),
(25, 'Hide and Seek', 'John Wick', 'Constatinetal', 'Horror, Psychology', '1734934943_download (2).jpg', 'Hide and Seek berkisah tentang sekelompok teman lama yang kembali berkumpul di sebuah rumah terpencil untuk mengenang masa kecil mereka. Saat memutuskan bermain petak umpet seperti dulu, mereka tanpa sadar membangkitkan entitas misterius yang membuat permainan itu menjadi nyata dan mematikan. Satu per satu, mereka dihadapkan pada rahasia kelam yang selama ini disembunyikan, sementara mereka harus bertahan hidup dari bayangan yang terus mengintai. Cerita ini menyoroti tema rasa bersalah, trauma, dan konsekuensi dari tindakan masa lalu.', 0),
(26, 'Sin Eater', 'Tonny Junior', 'Americanbook', 'Fantasy', '1734935051_images (1).jpg', 'Sin Eater adalah novel bergenre fantasi gelap yang mengikuti kehidupan Elise, seorang gadis muda yang dipilih sebagai pemakan dosa dalam masyarakatnya, seseorang yang bertugas menyerap dosa orang lain dengan memakan makanan ritual di atas mayat. Dihantui oleh dosa yang bukan miliknya, Elise mulai mempertanyakan tradisi tersebut ketika ia menemukan rahasia kelam di balik praktik ini. Saat ia mencoba melarikan diri dari takdirnya, Elise dihadapkan pada pilihan sulit: melawan sistem yang menindasnya atau menyerah pada peran yang telah ditentukan untuknya. Cerita ini menggambarkan tema pengorbanan, pemberontakan, dan pencarian kebebasan di dunia yang penuh misteri dan kekuasaan gelap.', 0),
(27, 'The Tide', 'Schwartz Xusiai', 'Constatinetal', 'Fantasy, Adventure', '1734935119_download (6).jpg', 'The Tide adalah kisah petualangan fantasi yang mengikuti sekelompok pelaut yang terdampar di sebuah pulau terpencil setelah kapal mereka dihantam ombak raksasa. Mereka segera menyadari bahwa pulau itu terikat pada siklus pasang surut magis yang membuka jalan menuju reruntuhan kuno setiap kali air surut. Namun, saat mereka mulai menjelajahi reruntuhan, mereka harus menghadapi makhluk laut yang bangkit bersama air pasang dan melindungi rahasia pulau tersebut. Cerita ini mengangkat tema keberanian, persahabatan, dan perjuangan melawan kekuatan alam yang tak terkendali.', 0),
(28, 'A Love And Beyond', 'Stephen George', 'Constatinetal', 'Romance, Comedy, Supranatural', '1734935231_OIP (7).jpg', 'A Love and Beyond mengisahkan Adrian, seorang arkeolog muda yang menemukan surat cinta kuno di reruntuhan sebuah kuil. Surat itu membawa pesan dari masa lalu yang misterius, menghubungkannya dengan Aurora, seorang wanita yang telah lama meninggal tetapi rohnya terjebak di antara dunia. Saat Adrian semakin terlibat dengan pesan-pesan Aurora, ia harus memilih antara mengejar cinta yang melampaui waktu atau melepaskan masa lalu untuk menyelamatkan dirinya dari kutukan kuil tersebut. Cerita ini menyoroti tema cinta abadi, pengorbanan, dan misteri kehidupan setelah kematian.', 0),
(29, 'A Young Wizard', 'Michael Mayers', 'Constatinetal', 'Fantasy, Adventure', '1734943694_download (3).jpg', 'A Young Wizard adalah kisah yang mengikuti perjalanan Arlen, seorang pemuda yang menemukan dirinya memiliki kekuatan sihir setelah tanpa sengaja menyelamatkan desanya dari serangan makhluk gelap. Dibimbing oleh seorang penyihir tua, Arlen mulai mempelajari seni sihir sambil menghadapi keraguan dari orang-orang di sekitarnya. Namun, ketika ancaman gelap yang lebih besar muncul, Arlen harus berjuang melampaui keterbatasannya untuk menjadi penyihir sejati dan melindungi dunia dari kehancuran. Cerita ini mengangkat tema keberanian, pengorbanan, dan perjalanan menuju kedewasaan.', 0),
(30, 'Camino Island', 'Josh Nier', 'Constatinetal', 'Crime, Mystery', '1734943989_images (2).jpg', 'Camino Island adalah novel yang menceritakan tentang pencurian lima manuskrip langka karya F. Scott Fitzgerald dari perpustakaan universitas ternama. Setelah pencurian itu, manuskrip tersebut diduga jatuh ke tangan Bruce Cable, seorang pemilik toko buku di Camino Island yang dikenal memiliki jaringan rahasia di dunia kolektor buku antik. Ketegangan meningkat ketika Mercer Mann, seorang penulis muda yang tengah berjuang dengan kariernya, direkrut untuk menyelidiki Bruce dengan imbalan besar. Saat Mercer masuk lebih dalam ke dunia Cable, ia menemukan rahasia gelap yang menghubungkan buku langka, kejahatan, dan moralitas yang dipertanyakan. Novel ini menyajikan perpaduan antara intrik, seni, dan bahaya yang menguji batas kesetiaan dan kebenaran.', 0),
(31, 'Spirit demon', 'Nancy Yuki', 'Constatinetal', 'Fantasy, Action', '1734944084_images (4).jpg', 'Spirit Demon adalah novel yang mengikuti kisah Kaiden, seorang pemuda yang tanpa sengaja terikat dengan roh iblis kuno saat mencoba melindungi desanya dari serangan pasukan bayangan. Terjebak di antara dua dunia, Kaiden harus belajar mengendalikan kekuatan iblis di dalam dirinya sambil mempertahankan kemanusiaannya. Dalam perjalanan untuk menghentikan perang besar yang akan menghancurkan dunia, ia bertemu sekutu yang meragukan dan musuh yang menyimpan rahasia tentang asal-usul kekuatan gelapnya. Cerita ini mengeksplorasi tema dualitas, pengorbanan, dan perjuangan melawan nasib yang telah ditentukan.', 0),
(32, 'Lost Stars', 'Mary June', 'Constatinetal', 'Fiction, Fantasy, Adventure', '1734944160_images (5).jpg', 'Lost Stars adalah novel yang mengikuti perjalanan Ava, seorang pilot muda yang tergabung dalam misi pencarian planet baru bagi umat manusia setelah Bumi mulai tidak layak huni. Saat kapalnya terdampar di galaksi asing, Ava menemukan sebuah dunia yang penuh dengan bintang mati dan peninggalan peradaban kuno. Bersama timnya, ia mencoba memecahkan misteri kehancuran peradaban tersebut, yang ternyata memiliki kaitan erat dengan nasib manusia di masa depan. Dalam petualangan ini, Ava dihadapkan pada pilihan sulit antara menyelamatkan umat manusia atau menjaga keseimbangan alam semesta. Novel ini mengangkat tema keberanian, harapan, dan penemuan makna di tengah kehampaan.', 0),
(33, 'Alone', 'Josh Nier', 'Nigounikkai', 'Thriller, Mystery, Action, Psychology', '1734944200_images (6).jpg', 'Alone adalah novel bergenre thriller psikologis yang mengikuti kisah Sarah, seorang wanita yang terjebak dalam rumahnya sendiri setelah kecelakaan yang membuatnya kehilangan ingatan. Ketika segala sesuatu mulai terasa aneh dan mengancam, Sarah menyadari bahwa dia tidak sendirian. Ada seseorang yang mengawasi dan mengendalikan hidupnya, namun siapa dan mengapa, ia tidak tahu. Dalam pencariannya untuk menemukan kebenaran, Sarah harus menghadapi kenyataan kelam tentang masa lalunya dan rahasia yang tersembunyi di balik kecelakaan tersebut. Cerita ini mengangkat tema isolasi, identitas, dan ketakutan yang muncul saat seseorang terperangkap dalam pikirannya sendiri.', 0),
(35, 'Rise of the six', 'Sutisna', 'Constatinetal', 'Action, Fantasy, Adventure', '1737341926_baru 3.jpeg', 'Bercerita tentang peperangan masa depan', 0),
(41, 'Black Rifle', 'Maimunah S. S', 'Nigounikkai', 'Action', '1737606054_baru 2.jpeg', 'Pertempuran antara dua kubu yang memperebutkan kekuasaan wilayah new york', 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int NOT NULL,
  `id_buku` int NOT NULL,
  `id_user` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_deadline` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `denda` int DEFAULT NULL,
  `status_peminjaman` varchar(255) NOT NULL DEFAULT 'Belum Dikembalikan',
  `status_bayar` varchar(255) NOT NULL DEFAULT 'Belum Dibayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_buku`, `id_user`, `tanggal_pinjam`, `tanggal_deadline`, `tanggal_kembali`, `denda`, `status_peminjaman`, `status_bayar`) VALUES
(38, 10, 17, '2025-01-01', '2025-01-08', NULL, NULL, 'Belum Dikembalikan', 'Belum Dibayar'),
(39, 10, 17, '2025-01-09', '2025-01-22', NULL, NULL, 'Belum Dikembalikan', 'Belum Dibayar'),
(40, 11, 17, '2025-01-10', '2025-01-24', NULL, NULL, 'Belum Dikembalikan', 'Belum Dibayar'),
(41, 10, 18, '2025-01-02', '2025-01-14', NULL, NULL, 'Belum Dikembalikan', 'Belum Dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `email`, `no_hp`, `password`, `status`) VALUES
(17, 'Admin', 'admin@gmail.com', '032738', '$2y$10$3nCK9Y9eUGJUuFR3bZhYe.2e7THnMxF7NXy77w79yaPFJ8srtvz/q', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `no_hp`, `password`) VALUES
(17, 'Aleef', 'aleef@gmail.com', '8129893', '$2y$10$EO0130kVZc/v112FKuWMm.zbZjQwfLz5NTMBRoAGKR1FkOYghoplG'),
(18, 'user', 'user@gmail.com', '12345', '$2y$10$Fz8CFESg98sKkMbe5Uj95eVi13ShUCMtx.C660mTLxBWSgK7cEr.W');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
