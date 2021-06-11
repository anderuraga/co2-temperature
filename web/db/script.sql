
/* Nombre de la BBDD es 'sensores' */

USE `sensores`;

/* Solo existe una tabla para recoger los datos */

CREATE TABLE `tabla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chipId` varchar(45) NOT NULL,
  `co2` float NOT NULL,
  `temp` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4


/* Ejecutar etas lineas si queremos datos de prueba */  

INSERT INTO `tabla` (chipId, co2, temp) VALUES ('MOCK1', 600, 23), ('MOCK1', 600, 23),('MOCK1', 604, 22),('MOCK1', 630, 22),('MOCK1', 602, 25) ;