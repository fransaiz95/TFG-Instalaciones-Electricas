-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.36-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla weblectric.arc
CREATE TABLE IF NOT EXISTS `arc` (
  `idArc` int(11) NOT NULL DEFAULT '0',
  `idRegion1` decimal(5,0) DEFAULT NULL,
  `idRegion2` decimal(5,0) DEFAULT NULL,
  `distance` decimal(5,0) DEFAULT NULL,
  PRIMARY KEY (`idArc`),
  KEY `FK_arc_region` (`idRegion1`),
  KEY `FK_arc_region_2` (`idRegion2`),
  CONSTRAINT `FK_arc_region` FOREIGN KEY (`idRegion1`) REFERENCES `region` (`idRegion`),
  CONSTRAINT `FK_arc_region_2` FOREIGN KEY (`idRegion2`) REFERENCES `region` (`idRegion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.arc: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `arc` DISABLE KEYS */;
/*!40000 ALTER TABLE `arc` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.arc_typeline
CREATE TABLE IF NOT EXISTS `arc_typeline` (
  `idArc` int(11) NOT NULL DEFAULT '0',
  `idTypeLine` int(11) NOT NULL DEFAULT '0',
  `numLines` decimal(3,0) DEFAULT NULL,
  PRIMARY KEY (`idArc`,`idTypeLine`),
  KEY `idArc` (`idArc`),
  KEY `FK_arc_typeline_typeline` (`idTypeLine`),
  CONSTRAINT `FK_arc_typeline_arc` FOREIGN KEY (`idArc`) REFERENCES `arc` (`idArc`),
  CONSTRAINT `FK_arc_typeline_typeline` FOREIGN KEY (`idTypeLine`) REFERENCES `typeline` (`idTypeLine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.arc_typeline: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `arc_typeline` DISABLE KEYS */;
/*!40000 ALTER TABLE `arc_typeline` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.country
CREATE TABLE IF NOT EXISTS `country` (
  `idCountry` char(3) NOT NULL DEFAULT '0',
  `name` char(100) DEFAULT NULL,
  PRIMARY KEY (`idCountry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.country: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT IGNORE INTO `country` (`idCountry`, `name`) VALUES
	('1', '0');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.fuel
CREATE TABLE IF NOT EXISTS `fuel` (
  `idFuel` char(10) NOT NULL DEFAULT '0',
  `fueCos` decimal(8,2) DEFAULT NULL,
  `production` decimal(12,0) DEFAULT NULL,
  PRIMARY KEY (`idFuel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.fuel: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `fuel` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.fuel_technology
CREATE TABLE IF NOT EXISTS `fuel_technology` (
  `idFuel` char(10) NOT NULL DEFAULT '0',
  `idTechnology` char(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idFuel`,`idTechnology`),
  KEY `idFuel` (`idFuel`),
  KEY `FK_fuel_technology_technology` (`idTechnology`),
  CONSTRAINT `FK_fuel_technology_fuel` FOREIGN KEY (`idFuel`) REFERENCES `fuel` (`idFuel`),
  CONSTRAINT `FK_fuel_technology_technology` FOREIGN KEY (`idTechnology`) REFERENCES `technology` (`idTechnology`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.fuel_technology: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `fuel_technology` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_technology` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.rangedemand
CREATE TABLE IF NOT EXISTS `rangedemand` (
  `idRegion` decimal(5,0) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) DEFAULT NULL,
  `demand` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idRegion`,`start`),
  KEY `idRegion` (`idRegion`),
  CONSTRAINT `FK_rangedemand_region` FOREIGN KEY (`idRegion`) REFERENCES `region` (`idRegion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.rangedemand: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `rangedemand` DISABLE KEYS */;
/*!40000 ALTER TABLE `rangedemand` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.rangemeteo
CREATE TABLE IF NOT EXISTS `rangemeteo` (
  `idRegion` decimal(5,0) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) DEFAULT NULL,
  `temp` decimal(5,2) DEFAULT NULL,
  `wind` decimal(5,2) DEFAULT NULL,
  `hum` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`idRegion`,`start`),
  KEY `idRegion` (`idRegion`),
  CONSTRAINT `FK_rangemeteo_region` FOREIGN KEY (`idRegion`) REFERENCES `region` (`idRegion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.rangemeteo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `rangemeteo` DISABLE KEYS */;
/*!40000 ALTER TABLE `rangemeteo` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.rangerenowable
CREATE TABLE IF NOT EXISTS `rangerenowable` (
  `idRegion` decimal(5,0) NOT NULL,
  `idTechnology` char(50) NOT NULL,
  `start` int(11) NOT NULL,
  `GenAva` decimal(7,4) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRegion`,`idTechnology`,`start`),
  KEY `idRegion` (`idRegion`),
  KEY `idTechnology` (`idTechnology`),
  CONSTRAINT `FK_rangerenowable_region` FOREIGN KEY (`idRegion`) REFERENCES `region` (`idRegion`),
  CONSTRAINT `FK_rangerenowable_technology` FOREIGN KEY (`idTechnology`) REFERENCES `technology` (`idTechnology`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.rangerenowable: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `rangerenowable` DISABLE KEYS */;
/*!40000 ALTER TABLE `rangerenowable` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.region
CREATE TABLE IF NOT EXISTS `region` (
  `idRegion` decimal(5,0) NOT NULL DEFAULT '0',
  `idCountry` char(3) DEFAULT NULL,
  `name` char(100) DEFAULT NULL,
  `DemFor` decimal(7,4) DEFAULT NULL,
  `RenFor` decimal(7,4) DEFAULT NULL,
  PRIMARY KEY (`idRegion`),
  KEY `FK_region_country` (`idCountry`),
  CONSTRAINT `FK_region_country` FOREIGN KEY (`idCountry`) REFERENCES `country` (`idCountry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.region: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
/*!40000 ALTER TABLE `region` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.region_technology
CREATE TABLE IF NOT EXISTS `region_technology` (
  `idRegion` decimal(5,0) NOT NULL DEFAULT '0',
  `idTechnology` char(10) NOT NULL DEFAULT '0',
  `power` decimal(12,2) DEFAULT NULL,
  `capAva` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`idRegion`,`idTechnology`),
  KEY `idRegion` (`idRegion`),
  KEY `FK_region_technology_technology` (`idTechnology`),
  CONSTRAINT `FK_region_technology_region` FOREIGN KEY (`idRegion`) REFERENCES `region` (`idRegion`),
  CONSTRAINT `FK_region_technology_technology` FOREIGN KEY (`idTechnology`) REFERENCES `technology` (`idTechnology`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.region_technology: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `region_technology` DISABLE KEYS */;
/*!40000 ALTER TABLE `region_technology` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.technology
CREATE TABLE IF NOT EXISTS `technology` (
  `idTechnology` char(10) NOT NULL DEFAULT '0',
  `name` char(50) DEFAULT NULL,
  `renowable` tinyint(4) DEFAULT NULL,
  `WatWit` decimal(15,0) DEFAULT NULL,
  `GencoPri` decimal(7,4) DEFAULT NULL,
  `Cap` decimal(10,0) DEFAULT NULL,
  `NewCapCos` decimal(15,0) DEFAULT NULL,
  `ManCos` decimal(12,2) DEFAULT NULL,
  `ManCosNewCap` decimal(10,0) DEFAULT NULL,
  `GenCos` decimal(7,4) DEFAULT NULL,
  `GenCosNewCap` decimal(7,4) DEFAULT NULL,
  `Lifetime` decimal(3,0) DEFAULT NULL,
  `GHGEmi` decimal(7,4) DEFAULT NULL,
  `InvCapEmp` decimal(5,2) DEFAULT NULL,
  `ManCapEmp` decimal(5,2) DEFAULT NULL,
  `DecCamEmp` decimal(5,2) DEFAULT NULL,
  `OMCapEmp` decimal(5,2) DEFAULT NULL,
  `FueCapEmp` decimal(5,2) DEFAULT NULL,
  `WatCon` decimal(15,0) DEFAULT NULL,
  PRIMARY KEY (`idTechnology`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.technology: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `technology` DISABLE KEYS */;
/*!40000 ALTER TABLE `technology` ENABLE KEYS */;

-- Volcando estructura para tabla weblectric.typeline
CREATE TABLE IF NOT EXISTS `typeline` (
  `idTypeLine` int(11) NOT NULL DEFAULT '0',
  `LinCap` decimal(9,2) DEFAULT NULL,
  `NewLinCos` decimal(12,2) DEFAULT NULL,
  `ManLinCos` double(12,2) DEFAULT NULL,
  `FloCos` double(7,2) DEFAULT NULL,
  `NewLimEmp` double(7,2) DEFAULT NULL,
  `ManLimEmp` double(7,2) DEFAULT NULL,
  `FloEmp` double(7,2) DEFAULT NULL,
  `EffLin` double(5,4) DEFAULT NULL,
  PRIMARY KEY (`idTypeLine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla weblectric.typeline: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `typeline` DISABLE KEYS */;
/*!40000 ALTER TABLE `typeline` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
