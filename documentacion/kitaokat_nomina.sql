# Host: www.kitaokatech.com  (Version 5.7.23-23)
# Date: 2022-10-06 13:34:50
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "cortes"
#

DROP TABLE IF EXISTS `cortes`;
CREATE TABLE `cortes` (
  `idcorte` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idempleado` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `expedido` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `corte` date NOT NULL DEFAULT '0000-00-00',
  `sueldo_base_hora` decimal(13,2) unsigned NOT NULL DEFAULT '0.00',
  `jornada_horas_dia` tinyint(3) unsigned NOT NULL DEFAULT '8',
  `dias_trabajados` int(11) unsigned DEFAULT NULL,
  `dias_ausentes` int(11) unsigned NOT NULL DEFAULT '0',
  `importe_base` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `cantidad_entregas` int(10) unsigned NOT NULL DEFAULT '0',
  `compensacion` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `bonos_entregas` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `sueldo_bruto` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `vales_despensa` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `ISR` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sueldo_neto` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`idcorte`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

#
# Structure for table "empleados"
#

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE `empleados` (
  `idempleado` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `numero_empleado` varchar(6) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Rol` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0-chofer 1-cargador 2-auxiliar',
  `Tipo` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0-Interno 1-Externo',
  PRIMARY KEY (`idempleado`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

#
# Structure for table "movimientos"
#

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE `movimientos` (
  `idmovimiento` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idempleado` int(11) unsigned NOT NULL DEFAULT '0',
  `Expedido` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Fecha` date DEFAULT '0000-00-00',
  `cantidad_entrega` int(11) unsigned NOT NULL DEFAULT '1',
  `cubre_turno` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0-no 1-Chofer 2-Cargador',
  `corte` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '0-No aplicado 1-Aplicado',
  PRIMARY KEY (`idmovimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

#
# Procedure "crear_nomina"
#

DROP PROCEDURE IF EXISTS `crear_nomina`;
CREATE PROCEDURE `crear_nomina`(`parametro_fecha` date)
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
