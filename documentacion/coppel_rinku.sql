# SQL-Front 5.1  (Build 4.16)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;


# Host: localhost    Database: coppel_rinku
# ------------------------------------------------------
# Server version 5.0.51b-community-nt-log

DROP DATABASE IF EXISTS `coppel_rinku`;
CREATE DATABASE `coppel_rinku` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `coppel_rinku`;

#
# Source for table cortes
#

DROP TABLE IF EXISTS `cortes`;
CREATE TABLE `cortes` (
  `idcorte` int(11) unsigned NOT NULL auto_increment,
  `idempleado` tinyint(3) unsigned NOT NULL default '0',
  `expedido` datetime NOT NULL default '0000-00-00 00:00:00',
  `corte` date NOT NULL default '0000-00-00',
  `sueldo_base_hora` decimal(13,2) unsigned NOT NULL default '0.00',
  `jornada_horas_dia` tinyint(3) unsigned NOT NULL default '8',
  `dias_trabajados` int(11) unsigned default NULL,
  `dias_ausentes` int(11) unsigned NOT NULL default '0',
  `importe_base` decimal(10,2) unsigned NOT NULL default '0.00',
  `cantidad_entregas` int(10) unsigned NOT NULL default '0',
  `compensacion` decimal(10,2) unsigned NOT NULL default '0.00',
  `bonos_entregas` decimal(10,2) unsigned NOT NULL default '0.00',
  `sueldo_bruto` decimal(10,2) unsigned NOT NULL default '0.00',
  `vales_despensa` decimal(10,2) unsigned NOT NULL default '0.00',
  `ISR` decimal(10,2) NOT NULL default '0.00',
  `sueldo_neto` decimal(10,2) unsigned NOT NULL default '0.00',
  PRIMARY KEY  (`idcorte`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

#
# Dumping data for table cortes
#

INSERT INTO `cortes` VALUES (86,35,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (87,36,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (88,37,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,0,290,11.6,26.1,263.9);
INSERT INTO `cortes` VALUES (89,38,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,40,330,13.2,29.7,300.3);
INSERT INTO `cortes` VALUES (90,39,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,0,290,11.6,26.1,263.9);
INSERT INTO `cortes` VALUES (91,40,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (92,41,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (93,42,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,40,330,13.2,29.7,300.3);
INSERT INTO `cortes` VALUES (94,43,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,40,330,13.2,29.7,300.3);
INSERT INTO `cortes` VALUES (95,44,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (96,45,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,0,290,11.6,26.1,263.9);
INSERT INTO `cortes` VALUES (97,46,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (98,47,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (99,48,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (100,49,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (101,50,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (102,51,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,0,290,11.6,26.1,263.9);
INSERT INTO `cortes` VALUES (103,52,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,40,330,13.2,29.7,300.3);
INSERT INTO `cortes` VALUES (104,53,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,40,330,13.2,29.7,300.3);
INSERT INTO `cortes` VALUES (105,54,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,40,330,13.2,29.7,300.3);
INSERT INTO `cortes` VALUES (106,55,'2022-10-06 20:34:21','2022-09-30',30,8,1,29,240,10,50,0,290,11.6,26.1,263.9);
INSERT INTO `cortes` VALUES (107,35,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (108,36,'2022-10-06 20:43:43','2022-08-31',30,8,3,28,720,14,70,240,1030,41.2,92.7,937.3);
INSERT INTO `cortes` VALUES (109,37,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (110,38,'2022-10-06 20:43:43','2022-08-31',30,8,1,30,240,5,25,40,305,12.2,27.45,277.55);
INSERT INTO `cortes` VALUES (111,39,'2022-10-06 20:43:43','2022-08-31',30,8,1,30,240,1,5,0,245,9.8,22.05,222.95);
INSERT INTO `cortes` VALUES (112,40,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (113,41,'2022-10-06 20:43:43','2022-08-31',30,8,1,30,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (114,42,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (115,43,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (116,44,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (117,45,'2022-10-06 20:43:43','2022-08-31',30,8,1,30,240,11,55,0,295,11.8,26.55,268.45);
INSERT INTO `cortes` VALUES (118,46,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (119,47,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (120,48,'2022-10-06 20:43:43','2022-08-31',30,8,1,30,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (121,49,'2022-10-06 20:43:43','2022-08-31',30,8,1,30,240,10,50,80,370,14.8,33.3,336.7);
INSERT INTO `cortes` VALUES (122,50,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (123,51,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (124,52,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (125,53,'2022-10-06 20:43:43','2022-08-31',30,8,2,29,480,6,30,80,590,23.6,53.1,536.9);
INSERT INTO `cortes` VALUES (126,54,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);
INSERT INTO `cortes` VALUES (127,55,'2022-10-06 20:43:43','2022-08-31',30,8,0,31,0,0,0,0,0,0,0,0);

#
# Source for table empleados
#

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `idempleado` int(11) unsigned NOT NULL auto_increment,
  `numero_empleado` varchar(6) collate utf8_spanish_ci NOT NULL default '',
  `Nombre` varchar(120) collate utf8_spanish_ci NOT NULL default '',
  `Rol` tinyint(3) unsigned NOT NULL default '0' COMMENT '0-chofer 1-cargador 2-auxiliar',
  `Tipo` tinyint(3) unsigned NOT NULL default '0' COMMENT '0-Interno 1-Externo',
  PRIMARY KEY  (`idempleado`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

#
# Dumping data for table empleados
#

INSERT INTO `empleados` VALUES (35,'001','Marcos Kitaoka Castro',0,0);
INSERT INTO `empleados` VALUES (36,'002','Bernard Baltezar Gonzalez',0,0);
INSERT INTO `empleados` VALUES (37,'003','Keitraro Kitaoka PÃ©rez',2,0);
INSERT INTO `empleados` VALUES (38,'004','Isabel Perez Urias',1,0);
INSERT INTO `empleados` VALUES (39,'005','Ricardo Serrano Fregozo',2,1);
INSERT INTO `empleados` VALUES (40,'006','Moises Tinajeros Rosales',0,1);
INSERT INTO `empleados` VALUES (41,'007','Felipe Antonio Andrade Rosales',0,0);
INSERT INTO `empleados` VALUES (42,'008','Ricardo Palacios Nolasco',1,0);
INSERT INTO `empleados` VALUES (43,'009','Ricardo Rivera Gonzalez',1,1);
INSERT INTO `empleados` VALUES (44,'010','Rafel Lizarraga Tirado',0,0);
INSERT INTO `empleados` VALUES (45,'011','Eduardo Huerta Gonzalez',2,0);
INSERT INTO `empleados` VALUES (46,'012','Emiliano Guzman Santos',0,1);
INSERT INTO `empleados` VALUES (47,'013','Manuel Ignacio Andrade',0,0);
INSERT INTO `empleados` VALUES (48,'014','JosÃ© Manuel Villanueva Araujo',0,1);
INSERT INTO `empleados` VALUES (49,'015','Miguel LopÃ©z Lozano',0,1);
INSERT INTO `empleados` VALUES (50,'016','Maria SanchÃ©z Camacho',0,0);
INSERT INTO `empleados` VALUES (51,'017','Kiyoko Kitaoka Castro',2,0);
INSERT INTO `empleados` VALUES (52,'018','Ivan Alberto Cruz Osuna',1,0);
INSERT INTO `empleados` VALUES (53,'019','Eduardo Lozano Quintana',1,1);
INSERT INTO `empleados` VALUES (54,'020','Ana Yudith Contreras Marcial',1,0);
INSERT INTO `empleados` VALUES (55,'021','Roberto Ruedaflores Aramburo',2,0);

#
# Source for table movimientos
#

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE `movimientos` (
  `idmovimiento` int(11) unsigned NOT NULL auto_increment,
  `idempleado` int(11) unsigned NOT NULL default '0',
  `Expedido` datetime NOT NULL default '0000-00-00 00:00:00',
  `Fecha` date default '0000-00-00',
  `cantidad_entrega` int(11) unsigned NOT NULL default '1',
  `cubre_turno` tinyint(3) unsigned NOT NULL default '0' COMMENT '0-no 1-Chofer 2-Cargador',
  `corte` int(11) unsigned NOT NULL default '0' COMMENT '0-No aplicado 1-Aplicado',
  PRIMARY KEY  (`idmovimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

#
# Dumping data for table movimientos
#

INSERT INTO `movimientos` VALUES (13,35,'2022-10-06 19:24:25','2022-10-01',5,0,0);
INSERT INTO `movimientos` VALUES (14,36,'2022-10-06 19:26:13','2022-10-01',3,0,0);
INSERT INTO `movimientos` VALUES (15,37,'2022-10-06 19:26:25','2022-10-01',8,0,0);
INSERT INTO `movimientos` VALUES (16,38,'2022-10-06 19:27:39','2022-10-01',7,0,0);
INSERT INTO `movimientos` VALUES (17,39,'2022-10-06 19:28:18','2022-10-01',9,1,0);
INSERT INTO `movimientos` VALUES (18,40,'2022-10-06 19:29:02','2022-10-01',2,0,0);
INSERT INTO `movimientos` VALUES (19,41,'2022-10-06 19:29:09','2022-10-01',1,0,0);
INSERT INTO `movimientos` VALUES (20,42,'2022-10-06 19:29:14','2022-10-01',10,0,0);
INSERT INTO `movimientos` VALUES (21,43,'2022-10-06 19:29:26','2022-10-01',1,0,0);
INSERT INTO `movimientos` VALUES (22,44,'2022-10-06 19:29:30','2022-10-01',4,0,0);
INSERT INTO `movimientos` VALUES (23,45,'2022-10-06 19:29:37','2022-10-01',9,2,0);
INSERT INTO `movimientos` VALUES (24,46,'2022-10-06 19:29:58','2022-10-01',3,0,0);
INSERT INTO `movimientos` VALUES (25,47,'2022-10-06 19:30:02','2022-10-01',10,0,0);
INSERT INTO `movimientos` VALUES (26,48,'2022-10-06 19:30:08','2022-10-01',8,0,0);
INSERT INTO `movimientos` VALUES (27,49,'2022-10-06 19:30:18','2022-10-01',4,0,0);
INSERT INTO `movimientos` VALUES (28,50,'2022-10-06 19:30:23','2022-10-01',9,0,0);
INSERT INTO `movimientos` VALUES (29,51,'2022-10-06 19:30:27','2022-10-01',3,0,0);
INSERT INTO `movimientos` VALUES (30,52,'2022-10-06 19:30:31','2022-10-01',5,0,0);
INSERT INTO `movimientos` VALUES (31,53,'2022-10-06 19:30:35','2022-10-01',10,0,0);
INSERT INTO `movimientos` VALUES (32,54,'2022-10-06 19:30:39','2022-10-01',8,0,0);
INSERT INTO `movimientos` VALUES (33,55,'2022-10-06 19:30:49','2022-10-01',9,1,0);
INSERT INTO `movimientos` VALUES (34,35,'2022-10-06 19:47:57','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (35,36,'2022-10-06 19:48:09','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (36,37,'2022-10-06 19:48:34','2022-10-06',3,1,0);
INSERT INTO `movimientos` VALUES (37,38,'2022-10-06 19:48:41','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (38,39,'2022-10-06 19:48:51','2022-10-06',3,2,0);
INSERT INTO `movimientos` VALUES (39,40,'2022-10-06 19:49:16','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (40,41,'2022-10-06 19:49:33','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (41,42,'2022-10-06 19:49:52','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (42,43,'2022-10-06 19:50:06','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (43,44,'2022-10-06 19:51:02','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (44,45,'2022-10-06 19:51:11','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (45,46,'2022-10-06 19:51:22','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (46,47,'2022-10-06 19:51:30','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (47,48,'2022-10-06 19:51:40','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (48,49,'2022-10-06 19:51:50','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (49,50,'2022-10-06 19:51:58','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (50,51,'2022-10-06 19:52:07','2022-10-06',4,2,0);
INSERT INTO `movimientos` VALUES (51,52,'2022-10-06 19:52:25','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (52,53,'2022-10-06 19:52:32','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (53,54,'2022-10-06 19:52:38','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (54,55,'2022-10-06 19:52:48','2022-10-06',3,0,0);
INSERT INTO `movimientos` VALUES (55,35,'2022-10-06 20:06:21','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (56,36,'2022-10-06 20:06:28','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (57,37,'2022-10-06 20:06:35','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (58,38,'2022-10-06 20:06:40','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (59,39,'2022-10-06 20:06:51','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (60,40,'2022-10-06 20:07:01','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (61,41,'2022-10-06 20:07:11','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (62,42,'2022-10-06 20:07:26','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (63,44,'2022-10-06 20:07:29','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (64,45,'2022-10-06 20:07:34','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (65,46,'2022-10-06 20:07:38','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (66,47,'2022-10-06 20:07:41','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (67,48,'2022-10-06 20:07:46','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (68,49,'2022-10-06 20:07:50','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (69,50,'2022-10-06 20:07:53','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (70,51,'2022-10-06 20:07:57','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (71,52,'2022-10-06 20:08:00','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (72,53,'2022-10-06 20:08:02','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (73,54,'2022-10-06 20:08:06','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (74,55,'2022-10-06 20:08:10','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (75,43,'2022-10-06 20:08:37','2022-09-01',10,0,1);
INSERT INTO `movimientos` VALUES (76,36,'2022-10-06 20:42:19','2022-08-01',10,0,1);
INSERT INTO `movimientos` VALUES (77,41,'2022-10-06 20:42:23','2022-08-01',10,0,1);
INSERT INTO `movimientos` VALUES (78,45,'2022-10-06 20:42:26','2022-08-01',10,0,1);
INSERT INTO `movimientos` VALUES (79,48,'2022-10-06 20:42:28','2022-08-01',10,0,1);
INSERT INTO `movimientos` VALUES (80,49,'2022-10-06 20:42:31','2022-08-01',10,0,1);
INSERT INTO `movimientos` VALUES (81,36,'2022-10-06 20:42:37','2022-08-02',1,0,1);
INSERT INTO `movimientos` VALUES (82,36,'2022-10-06 20:42:45','2022-08-17',3,0,1);
INSERT INTO `movimientos` VALUES (83,45,'2022-10-06 20:42:52','2022-08-01',1,0,1);
INSERT INTO `movimientos` VALUES (84,39,'2022-10-06 20:42:57','2022-08-01',1,0,1);
INSERT INTO `movimientos` VALUES (85,38,'2022-10-06 20:43:03','2022-08-01',5,0,1);
INSERT INTO `movimientos` VALUES (86,53,'2022-10-06 20:43:08','2022-08-01',1,0,1);
INSERT INTO `movimientos` VALUES (87,53,'2022-10-06 20:43:14','2022-08-18',4,0,1);
INSERT INTO `movimientos` VALUES (88,53,'2022-10-06 20:43:20','2022-08-18',1,0,1);

#
# Source for procedure crear_nomina
#

DROP PROCEDURE IF EXISTS `crear_nomina`;
CREATE DEFINER=`root`@`localhost` PROCEDURE `crear_nomina`(`parametro_fecha` date)
BEGIN

INSERT INTO cortes 
SELECT NULL,
A.idempleado,
now(),
parametro_fecha,
30,
8,
A.dias_trabajados,
A.dias_ausente,
(A.dias_trabajados*8*30) AS importe_base,
A.entregas,
(A.entregas*5) AS compensacion,
A.bonos,
((A.dias_trabajados*8*30) + (A.entregas*5) + A.bonos) AS sueldo_bruto,
(((A.dias_trabajados*8*30) + (A.entregas*5) + A.bonos)*0.04) AS vales,
IF(((A.dias_trabajados*8*30) + (A.entregas*5) + A.bonos)>16000, ((A.dias_trabajados*8*30) + (A.entregas*5) + A.bonos)*0.12,((A.dias_trabajados*8*30) + (A.entregas*5) + A.bonos)*0.09) AS ISR,
IF(((A.dias_trabajados*8*30) + (A.entregas*5) + A.bonos)>16000, 
((A.dias_trabajados*8*30) + (A.entregas*5) + A.bonos) - (((A.dias_trabajados*8*30) + (A.entregas*5) + A.bonos)*0.12),
((A.dias_trabajados*8*30) + (A.entregas*5) + A.bonos) - (((A.dias_trabajados*8*30) + (A.entregas*5) + A.bonos)*0.09)) AS sueldo_neto
FROM(
  SELECT a.idempleado,
  IFNULL((SELECT COUNT(DISTINCT b.Fecha) FROM movimientos b WHERE a.idempleado=b.idempleado AND Fecha LIKE CONCAT(SUBSTRING(parametro_fecha,1,8),"%") GROUP BY b.idempleado),0) AS dias_trabajados,  
  (DAY(LAST_DAY(parametro_fecha)) - (IFNULL((SELECT COUNT(DISTINCT b.Fecha) FROM movimientos b WHERE a.idempleado=b.idempleado AND Fecha LIKE CONCAT(SUBSTRING(parametro_fecha,1,8),"%") GROUP BY b.idempleado),0))) AS dias_ausente,  
  IFNULL((SELECT SUM(cantidad_entrega) FROM movimientos b WHERE a.idempleado=b.idempleado AND Fecha LIKE CONCAT(SUBSTRING(parametro_fecha,1,8),"%")),0) AS entregas,  
  CASE a.rol 
     WHEN 0 THEN (IFNULL((SELECT COUNT(DISTINCT b.Fecha) FROM movimientos b WHERE a.idempleado=b.idempleado AND Fecha LIKE CONCAT(SUBSTRING(parametro_fecha,1,8),"%") GROUP BY b.idempleado),0)*8*10)
     WHEN 1 THEN (IFNULL((SELECT COUNT(DISTINCT b.Fecha) FROM movimientos b WHERE a.idempleado=b.idempleado AND Fecha LIKE CONCAT(SUBSTRING(parametro_fecha,1,8),"%") GROUP BY b.idempleado),0)*8*5)     
     WHEN 2 THEN (IFNULL((SELECT IF(b.cubre_turno=1,COUNT(DISTINCT b.Fecha)*10,COUNT(DISTINCT b.Fecha)*5) FROM movimientos b WHERE a.idempleado=b.idempleado AND Fecha LIKE CONCAT(SUBSTRING(parametro_fecha,1,8),"%") AND b.cubre_turno!=0 GROUP BY b.idempleado),0)*8)
  END AS bonos
  FROM empleados a
) AS A;

UPDATE movimientos SET corte=1 WHERE Fecha LIKE CONCAT(SUBSTRING(parametro_fecha,1,8),"%");




	END;


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
