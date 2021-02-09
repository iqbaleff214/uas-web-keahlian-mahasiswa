CREATE DATABASE IF NOT EXISTS `iqbal_c030318077_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `iqbal_c030318077_db`;

CREATE TABLE IF NOT EXISTS `keahlian` (
  `keahlian_id` int(11) NOT NULL AUTO_INCREMENT,
  `keahlian` varchar(50) NOT NULL,
  `bidang` varchar(50) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`keahlian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

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
