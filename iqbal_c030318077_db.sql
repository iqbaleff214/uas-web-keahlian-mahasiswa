CREATE DATABASE IF NOT EXISTS `iqbal_c030318077_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `iqbal_c030318077_db`;

CREATE TABLE IF NOT EXISTS `keahlian` (
  `keahlian_id` int(11) NOT NULL AUTO_INCREMENT,
  `keahlian` varchar(50) NOT NULL,
  `bidang` varchar(50) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`keahlian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `keahlian` DISABLE KEYS */;
INSERT INTO `keahlian` (`keahlian_id`, `keahlian`, `bidang`, `keterangan`) VALUES
	(6, 'Jaringan Komputer', 'Network Adminstrator', ''),
	(7, 'Jaringan Komputer', 'Network Analyst', ''),
	(8, 'Keamanan Jaringan', 'Network Security', ''),
	(9, 'Keamanan Komputer', 'Penetration Tester', ''),
	(10, 'Basis Data', 'Database Adminstrator', ''),
	(11, 'Pemrograman', 'Fullstack Developer', ''),
	(12, 'Pemrograman', 'Software Engineer', ''),
	(13, 'Basis Data', 'Database Engineer', ''),
	(14, 'Jaringan Komputer', 'Network Engineer', ''),
	(15, 'Keamanan Jaringan', 'Bug Hunter', 'Mencari celah keamanan');
/*!40000 ALTER TABLE `keahlian` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `mahasiswa_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `keahlian_id` int(11) DEFAULT NULL,
  `program_studi` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  PRIMARY KEY (`mahasiswa_id`),
  KEY `KEAHLIAN` (`keahlian_id`),
  CONSTRAINT `KEAHLIAN` FOREIGN KEY (`keahlian_id`) REFERENCES `keahlian` (`keahlian_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` (`mahasiswa_id`, `nama`, `nim`, `keahlian_id`, `program_studi`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `alamat`, `no_hp`) VALUES
	(2, 'M. Iqbal Effendi', 'C030318077', 11, 'Teknik Informatika', 'Martapura', '2000-04-21', 'Laki-laki', 'Islam', 'Jl. Padat Karya Komp. Perdana Mandiri', '082159142175'),
	(4, 'Muhamad Khairi', 'C030318078', 10, 'Teknik Informatika', 'Banjarmasin', '2000-01-10', 'Laki-laki', 'Islam', 'Pekapuran Raya', '082159142175'),
	(5, 'Najriyani', 'C030318089', 7, 'Teknik Informatika', 'Tanah Laut', '2000-11-12', 'Laki-laki', 'Islam', 'Takisung', '082159142175'),
	(6, 'Nafila Fayruz', 'C030318088', 12, 'Teknik Informatika', 'Banjarmasin', '2001-01-26', 'Perempuan', 'Islam', 'Semangat Dalam', '082159142175'),
	(7, 'Novanti Sukma Permana', 'C030318091', 6, 'Teknik Informatika', 'Banjarmasin', '1999-11-28', 'Laki-laki', 'Islam', 'Liang Anggang', '082159142175'),
	(8, 'Henny Oktapiyana', 'C030318073', 10, 'Teknik Informatika', 'Anjir Pasar', '1999-08-25', 'Perempuan', 'Islam', 'Anjir Pasar', '082159142174'),
	(9, 'Rifky Ridha Syafikri', 'C030318092', 9, 'Teknik Informatika', 'Durian Gantang', '2000-01-15', 'Laki-laki', 'Islam', 'Durian Gantang', '082152342933'),
	(10, 'M.Sya’bul Huda', 'C030318079', 6, 'Teknik Informatika', 'Timbun Tulang', '2001-04-11', 'Laki-laki', 'Islam', 'Cempaka', '08215914175');
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `akun` (
  `akun_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` longtext NOT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`akun_id`),
  KEY `MAHASISWA` (`mahasiswa_id`),
  CONSTRAINT `MAHASISWA` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`mahasiswa_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
INSERT INTO `akun` (`akun_id`, `username`, `password`, `mahasiswa_id`) VALUES
	(1, 'admin', '$2y$10$S3LI/vcATwxEjhZgZgpGqu2efnCWtNm13ZcfHwsvpa8HWM3LjuhiW', NULL);
/*!40000 ALTER TABLE `akun` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
