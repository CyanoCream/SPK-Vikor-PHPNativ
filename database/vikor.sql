/*
SQLyog Ultimate v9.50 
MySQL - 5.5.5-10.1.29-MariaDB : Database - vikor
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`vikor` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `vikor`;

/*Table structure for table `tb_alternatif` */

DROP TABLE IF EXISTS `tb_alternatif`;

CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(35) NOT NULL,
  `nama_alternatif` varchar(55) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_alternatif`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_alternatif` */

insert  into `tb_alternatif`(`kode_alternatif`,`nama_alternatif`,`keterangan`) values ('A01','Arruum Chandra Dewi Nur Wulan',NULL),('A02','Vincentia Reynada Primadhani',NULL),('A03','Yolanda Prayetno Putri',NULL),('A04','Ian Ahmad Fachriza',NULL),('A05','Dewi Sri Rezeki',NULL);

/*Table structure for table `tb_kriteria` */

DROP TABLE IF EXISTS `tb_kriteria`;

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(35) NOT NULL,
  `nama_kriteria` varchar(55) DEFAULT NULL,
  `atribut` varchar(16) DEFAULT NULL,
  `bobot` double DEFAULT NULL,
  PRIMARY KEY (`kode_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kriteria` */

insert  into `tb_kriteria`(`kode_kriteria`,`nama_kriteria`,`atribut`,`bobot`) values ('C01','IPK (Indeks Prestasi Kumulatif)','benefit',0.5),('C02','Jumlah SKS yang telah diambil','benefit',0.2),('C03','Prestasi kegiatan ko/ ekstra kurikuler','benefit',0.15),('C04','Penghasilan Orang Tua','cost',0.15);

/*Table structure for table `tb_rel_alternatif` */

DROP TABLE IF EXISTS `tb_rel_alternatif`;

CREATE TABLE `tb_rel_alternatif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_alternatif` varchar(16) DEFAULT NULL,
  `kode_kriteria` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=latin1;

/*Data for the table `tb_rel_alternatif` */

insert  into `tb_rel_alternatif`(`id`,`kode_alternatif`,`kode_kriteria`,`nilai`) values (204,'A01','C01',4),(205,'A01','C02',131),(206,'A01','C03',4),(207,'A01','C04',2500000),(211,'A02','C01',3.9),(212,'A02','C02',133),(213,'A02','C03',1),(214,'A02','C04',3677300),(218,'A03','C01',3.93),(219,'A03','C02',133),(220,'A03','C03',1),(221,'A03','C04',1400000),(225,'A04','C01',3.89),(226,'A04','C02',129),(227,'A04','C03',1),(228,'A04','C04',5000000),(232,'A05','C01',3.83),(233,'A05','C02',129),(234,'A05','C03',1),(235,'A05','C04',4162800);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`user`,`pass`) values ('admin','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
