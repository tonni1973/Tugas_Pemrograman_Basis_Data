-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2025 at 10:42 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `id_buku` int NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_terbit` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `deskripsi`) VALUES
(6, 4, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Harper', '2014', 'Buku sejarah yang mengulas evolusi manusia dari zaman purba hingga modern.'),
(7, 3, 'Atomic Habits', 'James Clear', 'Avery', '2018', 'Buku tentang membangun kebiasaan baik dan menghentikan kebiasaan buruk.'),
(8, 3, 'To Kill a Mockingbird', 'Harper Lee', 'J.B. Lippincott', '1960', 'Novel klasik yang membahas isu rasisme dan keadilan di Amerika.'),
(9, 5, '1984', 'George Orwell', 'Secker & Warburg', '1949', 'Novel distopia yang menggambarkan pemerintahan totalitarian.'),
(10, 2, 'Becoming', 'Michelle Obama', 'Crown', '2018', 'Memoar perjalanan hidup mantan Ibu Negara Amerika Serikat.'),
(11, 2, 'The Subtle Art of Not Giving a F*ck', 'Mark Manson', 'HarperOne', '2016', 'Buku pengembangan diri dengan pendekatan realistis dan berani.'),
(12, 5, 'The Alchemist', 'Paulo Coelho', 'HarperOne', '1988', 'Novel tentang petualangan seorang gembala mencari harta karun.'),
(13, 3, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 'Warner Books', '1997', 'Buku tentang pentingnya literasi finansial.'),
(14, 4, 'The Catcher in the Rye', 'J.D. Salinger', 'Little, Brown', '1951', 'Kisah seorang remaja yang mencari makna hidup di tengah kegelisahan.'),
(15, 5, 'Educated', 'Tara Westover', 'Random House', '2018', 'Memoar tentang perjuangan mendapatkan pendidikan formal.'),
(16, 1, 'Thinking, Fast and Slow', 'Daniel Kahneman', 'Farrar, Straus', '2011', 'Penelitian psikologi tentang cara berpikir cepat (intuitif) dan lambat (analitis).');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Non-Fiksi'),
(2, 'Sejarah'),
(3, 'Pengembangan Diri'),
(4, 'Fiksi'),
(5, 'Biografi'),
(6, 'Filsafat');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_buku` int DEFAULT NULL,
  `tanggal_peminjaman` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_pengembalian` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_peminjaman` enum('dipinjam','dikembalikan') COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`) VALUES
(1, 4, 6, '2025-01-13', '2025-01-15', 'dikembalikan'),
(2, 4, 14, '2025-01-14', '2025-01-17', 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_buku` int DEFAULT NULL,
  `ulasan` text COLLATE utf8mb4_general_ci,
  `rating` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_user`, `id_buku`, `ulasan`, `rating`) VALUES
(1, 1, 16, 'Bukunya Bagus', 10),
(2, 4, 6, 'Buku yang cukup bagus', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `no_telepon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` enum('admin','peminjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `email`, `alamat`, `no_telepon`, `level`) VALUES
(1, 'Tonni Ramdani', 'toni', 'ac43724f16e9241d990427ab7c8f4228', 'toni@example.com', 'Bandung', '085778181248', 'admin'),
(4, 'Budiono Siregar', 'budi', 'ac43724f16e9241d990427ab7c8f4228', 'budiono@example.com', 'Bandung', '085556666677', 'peminjam');

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
  ADD PRIMARY KEY (`id_kategori`);

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
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
