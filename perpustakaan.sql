-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2025 at 04:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `deskripsi`, `stok`, `cover`) VALUES
(6, 4, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Harper', '2014', 'Buku sejarah yang mengulas evolusi manusia dari zaman purba hingga modern.', 10, 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTYY7n0e-GylssxKw9s-5EYUo65I3liFsIGEVo5ynV3PZngtaCV'),
(7, 3, 'Atomic Habits', 'James Clear', 'Avery', '2018', 'Buku tentang membangun kebiasaan baik dan menghentikan kebiasaan buruk.', 10, ''),
(8, 3, 'To Kill a Mockingbird', 'Harper Lee', 'J.B. Lippincott', '1960', 'Novel klasik yang membahas isu rasisme dan keadilan di Amerika.', 10, ''),
(9, 5, '1984', 'George Orwell', 'Secker & Warburg', '1949', 'Novel distopia yang menggambarkan pemerintahan totalitarian.', 10, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1327144697i/3744438.jpg'),
(10, 2, 'Becoming', 'Michelle Obama', 'Crown', '2018', 'Memoar perjalanan hidup mantan Ibu Negara Amerika Serikat.', 10, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1528206996i/38746485.jpg'),
(11, 2, 'The Subtle Art of Not Giving a F*ck', 'Mark Manson', 'HarperOne', '2016', 'Buku pengembangan diri dengan pendekatan realistis dan berani.', 10, 'https://ebooks.gramedia.com/ebook-covers/34319/image_highres/ID_HCO2016MTH09TSAONGAF.jpeg'),
(12, 5, 'The Alchemist', 'Paulo Coelho', 'HarperOne', '1988', 'Novel tentang petualangan seorang gembala mencari harta karun.', 10, 'https://ebooks.gramedia.com/ebook-covers/29408/big_covers/ID_HCO2015MTH12TALC.jpeg'),
(13, 3, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 'Warner Books', '1997', 'Buku tentang pentingnya literasi finansial.', 10, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ3Ffmy_08oqaMLmBVWiOfB-xU97hwWCUGiyQ&s'),
(14, 4, 'The Catcher in the Rye', 'J.D. Salinger', 'Little, Brown', '1951', 'Kisah seorang remaja yang mencari makna hidup di tengah kegelisahan.', 10, 'https://upload.wikimedia.org/wikipedia/id/3/32/Rye_catcher.jpg'),
(15, 5, 'Educated', 'Tara Westover', 'Random House', '2018', 'Memoar tentang perjuangan mendapatkan pendidikan formal.', 10, 'https://cdn.gramedia.com/uploads/products/65decde8c5.jpg'),
(16, 1, 'Thinking, Fast and Slow', 'Daniel Kahneman', 'Farrar, Straus', '2011', 'Penelitian psikologi tentang cara berpikir cepat (intuitif) dan lambat (analitis).', 10, 'https://m.media-amazon.com/images/I/71f6DceqZAL.jpg'),
(18, 7, 'Chasing the Blue Flames', 'Saufina', 'Gramedia Pustaka Utama', '2020', 'Buku ini menceritakan kisah Lulu yang berusaha move on dari Damar. Ketika Lulu memiliki kesempatan kembali ke masa lalu, ia dihadapkan pada pilihan untuk menghindari pertemuan dengan Damar demi menghindari patah hati di masa depan. \r\n', 10, 'Chasing the Blue Flames.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(5, 'Biografi'),
(7, 'Fantasi'),
(4, 'Fiksi'),
(6, 'Filsafat'),
(1, 'Non-Fiksi'),
(3, 'Pengembangan Diri'),
(8, 'Romansa'),
(2, 'Sejarah');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `tanggal_peminjaman` varchar(255) DEFAULT NULL,
  `tanggal_pengembalian` varchar(255) DEFAULT NULL,
  `status_peminjaman` enum('dipinjam','dikembalikan','disetujui','ditolak','proses') DEFAULT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`, `denda`) VALUES
(15, 8, 13, '2025-01-26', '2025-01-30', 'dikembalikan', 0),
(20, 4, 7, '2025-02-10', '2025-02-12', 'dikembalikan', 2000),
(21, 4, 18, '2025-02-13', '2025-02-14', 'dikembalikan', 0),
(22, 4, 18, '2025-02-13', '2025-02-14', 'dikembalikan', 0),
(23, 4, 6, '2025-02-13', '2025-02-15', 'dikembalikan', 0),
(24, 4, 18, '2025-02-13', '2025-02-14', 'dikembalikan', 0),
(25, 4, 8, '2025-02-14', '2025-02-15', 'dikembalikan', 0),
(26, 4, 8, '2025-02-14', '2025-02-15', 'dikembalikan', 0),
(27, 4, 6, '2025-02-13', '2025-02-14', 'dikembalikan', 0),
(28, 4, 10, '2025-02-14', '2025-02-15', 'dikembalikan', 0),
(29, 4, 6, '2025-02-12', '2025-02-13', 'dikembalikan', 1000),
(30, 4, 6, '2025-02-14', '2025-02-15', 'dikembalikan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_user`, `id_buku`, `ulasan`, `rating`) VALUES
(1, 1, 16, 'Bukunya sangat inspiratif dan penuh wawasan.', 10),
(2, 1, 6, 'Buku sejarah yang menarik dan mudah dipahami.', 9),
(3, 1, 10, 'Memoar Michelle Obama sangat menyentuh hati.', 10),
(4, 1, 12, 'Novel ini menggugah semangat untuk mengejar mimpi.', 9),
(5, 1, 13, 'Sangat membantu memahami keuangan secara mendalam.', 8),
(6, 1, 15, 'Perjuangan Tara Westover benar-benar menginspirasi.', 10),
(7, 4, 6, 'Buku yang cukup bagus dan sangat informatif.', 8),
(8, 4, 7, 'Panduan membangun kebiasaan yang luar biasa.', 9),
(9, 4, 8, 'Novel yang penuh dengan pesan moral penting.', 9),
(10, 4, 9, 'Distopia klasik yang sangat relevan.', 8),
(11, 4, 11, 'Buku yang berani dan sangat realistis.', 9),
(12, 4, 14, 'Kisah remaja yang relatable dan mendalam.', 8),
(13, 6, 6, 'Evolusi manusia dijelaskan dengan sangat baik.', 9),
(14, 6, 8, 'Salah satu novel terbaik yang pernah saya baca.', 10),
(15, 6, 10, 'Memoar yang penuh inspirasi dan kejujuran.', 9),
(16, 6, 11, 'Pendekatan yang unik dalam pengembangan diri.', 8),
(17, 6, 12, 'Petualangan yang penuh dengan pelajaran hidup.', 9),
(18, 6, 15, 'Kisah perjuangan hidup yang luar biasa.', 10),
(19, 7, 7, 'Panduan ini sangat membantu saya mengubah kebiasaan.', 10),
(20, 7, 9, 'Novel yang memberikan wawasan baru tentang politik.', 8),
(21, 7, 12, 'Ceritanya sangat memotivasi dan penuh makna.', 9),
(22, 7, 13, 'Pandangan baru tentang literasi keuangan.', 8),
(23, 7, 14, 'Penggambaran tokoh yang kuat dan menggugah.', 8),
(24, 7, 16, 'Topik yang mendalam, meskipun sedikit berat.', 7),
(25, 8, 6, 'Membuka wawasan tentang sejarah manusia.', 9),
(26, 8, 7, 'Saya mulai menerapkan tips dari buku ini.', 10),
(27, 8, 8, 'Novel yang mengajarkan banyak nilai kehidupan.', 9),
(28, 8, 9, 'Menggambarkan ancaman totalitarianisme dengan baik.', 8),
(29, 8, 10, 'Memoar ini membuat saya lebih menghargai hidup.', 10),
(30, 8, 15, 'Ceritanya sangat menyentuh dan inspiratif.', 10),
(31, 9, 7, 'Sangat bermanfaat untuk meningkatkan produktivitas.', 9),
(32, 9, 8, 'Kisah klasik yang tak lekang oleh waktu.', 10),
(33, 9, 10, 'Buku ini sangat inspiratif dan informatif.', 9),
(34, 9, 11, 'Membantu saya berpikir lebih realistis.', 8),
(35, 9, 13, 'Banyak wawasan penting tentang manajemen keuangan.', 8),
(36, 9, 16, 'Sangat bermanfaat untuk pengembangan diri.', 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(255) DEFAULT NULL,
  `level` enum('admin','peminjam') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `email`, `alamat`, `no_telepon`, `level`) VALUES
(1, 'Tonni', 'toni', 'ac43724f16e9241d990427ab7c8f4228', 'toni@example.com', 'Bandung', '085773403029', 'admin'),
(4, 'Budiono Siregar', 'budi', 'ac43724f16e9241d990427ab7c8f4228', 'budiono@example.com', 'Bandung', '085773402727', 'peminjam'),
(5, 'Mirana Nur Alifah', 'mirana', 'ac43724f16e9241d990427ab7c8f4228', 'mirana@example.com', 'Garut', '085773403040', 'peminjam'),
(6, 'Siti Aisyah', 'aisyah', 'ac43724f16e9241d990427ab7c8f4228', 'aisyah@example.com', 'Jakarta', '081234567890', 'peminjam'),
(7, 'Rahmat Hidayat', 'rahmat', 'ac43724f16e9241d990427ab7c8f4228', 'rahmat@example.com', 'Surabaya', '082345678901', 'peminjam'),
(8, 'Dewi Kartika', 'dewi', 'ac43724f16e9241d990427ab7c8f4228', 'dewi@example.com', 'Yogyakarta', '083456789012', 'peminjam'),
(9, 'ahha', 'ahha', 'ac43724f16e9241d990427ab7c8f4228', 'ahha@gmail', 'Bandung', '085888666677', 'peminjam'),
(10, 'Sujono', 'onoosujono', 'fcea920f7412b5da7be0cf42b8c93759', 'jonoSujono@gmail.com', 'Surabaya', '081354254875', 'admin'),
(11, 'Tejo', 'tejoparejo', 'fcea920f7412b5da7be0cf42b8c93759', 'mangtejo@gmail.com', 'Purwakarta', '081354254874', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `kategori` (`kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
