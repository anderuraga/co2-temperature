
/* Nombre de la BBDD es 'sensores' */

/* Solo existe una tabla para recoger los datos */

CREATE TABLE `tabla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chipId` varchar(45) NOT NULL,
  `co2` float NOT NULL,
  `temp` float NOT NULL,
  `fecha` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4


/* Ejecutar etas lineas si queremos datos de prueba */  