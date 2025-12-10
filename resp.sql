-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: teatro_pleasantville
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asientos`
--

DROP TABLE IF EXISTS `asientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asientos` (
  `id_asiento` int NOT NULL AUTO_INCREMENT,
  `fila` char(1) NOT NULL,
  `numero` int NOT NULL,
  PRIMARY KEY (`id_asiento`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asientos`
--

LOCK TABLES `asientos` WRITE;
/*!40000 ALTER TABLE `asientos` DISABLE KEYS */;
INSERT INTO `asientos` VALUES (1,'A',1),(2,'A',2),(3,'A',3),(4,'A',4),(5,'A',5),(6,'A',6),(7,'A',7),(8,'A',8),(9,'A',9),(10,'A',10),(11,'B',1),(12,'B',2),(13,'B',3),(14,'B',4),(15,'B',5),(16,'B',6),(17,'B',7),(18,'B',8),(19,'B',9),(20,'B',10),(21,'C',1),(22,'C',2),(23,'C',3),(24,'C',4),(25,'C',5),(26,'C',6),(27,'C',7),(28,'C',8),(29,'C',9),(30,'C',10),(31,'D',1),(32,'D',2),(33,'D',3),(34,'D',4),(35,'D',5),(36,'D',6),(37,'D',7),(38,'D',8),(39,'D',9),(40,'D',10);
/*!40000 ALTER TABLE `asientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boletos`
--

DROP TABLE IF EXISTS `boletos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `boletos` (
  `id_boleto` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_asiento` int NOT NULL,
  `id_obra` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_compra` date NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_boleto`),
  UNIQUE KEY `id_obra` (`id_obra`,`id_asiento`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_asiento` (`id_asiento`),
  CONSTRAINT `boletos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `boletos_ibfk_2` FOREIGN KEY (`id_asiento`) REFERENCES `asientos` (`id_asiento`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `boletos_ibfk_3` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id_obra`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boletos`
--

LOCK TABLES `boletos` WRITE;
/*!40000 ALTER TABLE `boletos` DISABLE KEYS */;
INSERT INTO `boletos` VALUES (3,3,3,1,150.00,'2025-01-10','Pagado'),(5,5,4,1,150.00,'2025-01-10','Pagado'),(6,6,6,1,150.00,'2025-01-11','Pagado'),(7,7,3,4,150.00,'2025-01-11','Pagado'),(8,8,8,1,150.00,'2025-01-11','Pagado'),(9,9,9,1,150.00,'2025-01-11','Pagado'),(10,10,10,1,150.00,'2025-01-11','Pagado'),(11,1,11,1,150.00,'2025-01-12','Pagado'),(12,2,12,1,150.00,'2025-01-12','Pagado'),(13,3,13,1,150.00,'2025-01-12','Pagado'),(14,4,14,1,150.00,'2025-01-12','Pagado'),(15,5,15,1,150.00,'2025-01-12','Pagado'),(16,6,16,1,150.00,'2025-01-12','Pagado'),(17,7,17,1,150.00,'2025-01-13','Pagado'),(18,8,18,1,150.00,'2025-01-13','Pagado'),(19,9,19,1,150.00,'2025-01-13','Pagado'),(20,10,20,1,150.00,'2025-01-13','Pagado'),(21,1,21,1,150.00,'2025-01-14','Pagado'),(22,2,22,1,150.00,'2025-01-14','Pagado'),(23,3,23,1,150.00,'2025-01-14','Pagado'),(24,4,24,1,150.00,'2025-01-14','Pagado'),(25,5,25,1,150.00,'2025-01-14','Pagado'),(26,6,26,1,150.00,'2025-01-15','Pagado'),(27,7,27,1,150.00,'2025-01-15','Pagado'),(28,8,28,1,150.00,'2025-01-15','Pagado'),(29,9,29,1,150.00,'2025-01-15','Pagado'),(30,10,30,1,150.00,'2025-01-15','Pagado'),(31,1,31,1,150.00,'2025-01-16','Pagado'),(32,2,32,1,150.00,'2025-01-16','Pagado'),(33,3,33,1,150.00,'2025-01-16','Pagado'),(34,4,34,1,150.00,'2025-01-16','Pagado'),(35,5,35,1,150.00,'2025-01-16','Pagado'),(36,6,36,1,150.00,'2025-01-17','Pagado'),(37,7,37,1,150.00,'2025-01-17','Cancelado'),(42,1,4,4,2312.00,'2025-12-07','Pagado'),(43,4,2,2,1232.23,'2025-12-07','Pagado'),(45,4,5,4,1232.23,'2025-12-07','Pagado'),(46,5,1,3,1232.23,'2025-12-07','Pagado'),(47,9,6,2,7777.00,'2025-12-07','Pagado'),(51,3,5,2,300.00,'2025-12-08','Pagado'),(61,9,1,6,300.00,'2025-12-08','Pagado'),(65,1,1,1,300.00,'2025-12-08','Pagado'),(66,4,5,3,300.00,'2025-12-08','Pagado'),(67,1,15,5,300.00,'2025-12-08','Pagado'),(84,6,3,2,300.00,'2025-12-08','Pagado'),(97,1,9,2,300.00,'2025-12-08','Pagado'),(99,3,3,3,300.00,'2025-12-08','Pagado'),(103,3,1,2,300.00,'2025-12-08','Pagado');
/*!40000 ALTER TABLE `boletos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finanzas`
--

DROP TABLE IF EXISTS `finanzas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `finanzas` (
  `id_finanza` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `concepto` varchar(100) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `id_obra` int DEFAULT NULL,
  PRIMARY KEY (`id_finanza`),
  KEY `id_obra` (`id_obra`),
  CONSTRAINT `finanzas_ibfk_1` FOREIGN KEY (`id_obra`) REFERENCES `obras` (`id_obra`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finanzas`
--

LOCK TABLES `finanzas` WRITE;
/*!40000 ALTER TABLE `finanzas` DISABLE KEYS */;
INSERT INTO `finanzas` VALUES (1,'2025-01-05','Gasto','Pago de cliente por obra pendiente',12500.00,3),(2,'2025-01-07','Ingreso','Compra de materiales eléctricos',3200.50,1),(3,'2025-01-10','Gasto','Pago de transporte de materiales',12250.00,1),(5,'2025-01-15','Gasto','Herramientas menores',650.75,15),(6,'2025-01-19','Gasto','Pago de cliente por obra pendiente',2100.00,3),(7,'2025-01-23','Gasto','Pago de suplementos',7200.00,NULL),(8,'2025-01-25','Gasto','Renta del local/almacén',4500.00,4),(9,'2025-01-28','Ingreso','Pago final por instalación',9000.00,4),(18,'2025-11-12','Gasto','Pago a miembros obra',23012.23,5),(19,'2025-11-20','Gasto','El dia triste',23012.23,NULL),(20,'2025-11-13','Ingreso','Pagos mes pasado',12.21,2),(21,'2025-11-11','Gasto','Sas',23012.23,NULL),(22,'2025-11-05','Ingreso','Pago a miembros obra',23012.23,4),(23,'2025-11-20','Ingreso','Pagos ayer',23012.23,2),(24,'2025-11-05','Ingreso','El dia triste',12.21,2),(25,'2025-12-18','Ingreso','Pagos mes pasado',255012.23,4);
/*!40000 ALTER TABLE `finanzas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `miembros`
--

DROP TABLE IF EXISTS `miembros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `miembros` (
  `id_miembro` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `numero_casa` varchar(10) DEFAULT NULL,
  `calle` varchar(25) DEFAULT NULL,
  `colonia` varchar(25) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `estado_membresia` varchar(20) DEFAULT NULL,
  `fecha_pago_cuota` date DEFAULT NULL,
  PRIMARY KEY (`id_miembro`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miembros`
--

LOCK TABLES `miembros` WRITE;
/*!40000 ALTER TABLE `miembros` DISABLE KEYS */;
INSERT INTO `miembros` VALUES (1,'Laura','García','Mendoza','5551234876','laura.gm@gmail.com','24','Hidalgo','Centro','06010','2023-01-15','Activa','2025-02-01'),(3,'Ana','López','Santos','5559012234','ana.lopez@hotmail.com','55','Reforma','Roma Norte','06700','2024-04-10','Pendiente',NULL),(5,'Danielaaa','Torres','Ríos','5556678234','daniela.tr@gmail.com','302','Amsterdam','Condesa','61404','2023-06-18','Sin pagar',NULL),(7,'Sofía','Cruz','Delgado','5552219087','sofia.cd@outlook.com','15A','Nuevo León','Hipódromo','06100','2024-02-14','Pendiente',NULL),(8,'Ricardo','Vega','Luna','5559982341','ricardo.vl@gmail.com','210','Patriotismo','San Pedro','03800','2022-05-30','Activa','2025-02-05'),(9,'Marianaa','Flores','Campos','5553412209','mariana.fc@gmail.com','9','Toluca','Portales','3303','2023-09-12','Sin pagar',NULL),(14,'Sam','Casas','Juan','1','sam@g','2','1','JOs','1',NULL,'Sin pagar',NULL),(22,'Juan','Pérez','López','5512345678','juan.prueba@email.com','123','Av. Siempre Viva','Centro','98000',NULL,'Pagada','2025-01-15'),(23,'Juan','Pérez','López','5512345678','juan.prueba@email.com','123','Av. Siempre Viva','Centro','98000',NULL,'Pagada','2025-01-15'),(24,'Juan','Pérez','López','5512345678','juan.prueba@email.com','123','Av. Siempre Viva','Centro','98000',NULL,'Pagada','2025-01-15'),(25,'Juan','Pérez','López','5512345678','juan.prueba@email.com','123','Av. Siempre Viva','Centro','0',NULL,'Pagada','2025-01-15'),(26,'Juan','Pérez','López','551234567811','juan.prueba@email.com','123','Av. Siempre Viva','Centro','0',NULL,'Pagada','2025-01-15'),(28,'Juan','Pérez','López','5512345678','juan.prueba@email.com','123','Av. Siempre Viva','Centro','98000',NULL,'Pagada','2025-01-15'),(32,'Sam','Pérez','Juan','5512345678','juan.prueba@email.com','123','Av. Siempre Viva','Centro','12345',NULL,'Pagada',NULL),(34,'Juan','21','12','1234567890','ed@gmail.com','0','','sa','0',NULL,'Sin pagar',NULL),(35,'Maria','Gomez','Ruiz','1111111111','maria.gomez@ej.com','1111','ndependencia','Lomas','90000',NULL,'Sin pagar',NULL),(38,'2','3','4','1111111111','123@gm.com','1','ho','sa','12',NULL,'Pagada','2025-12-17'),(40,'sam','1','','4844949491','sam@gmail.com','1','sam','sa','99',NULL,'Activo','2025-12-12'),(41,'sam','1','','4844949491','sam@gmail.com','1','sam','sa','99',NULL,'Activo','2025-12-12'),(42,'sam','1','hola','4844949491','sam@gmail.com','1','sam','sa','99',NULL,'Activo','2025-12-12');
/*!40000 ALTER TABLE `miembros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obras`
--

DROP TABLE IF EXISTS `obras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obras` (
  `id_obra` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `num_actos` int DEFAULT NULL,
  `anio_presentacion` year DEFAULT NULL,
  `temporada` varchar(20) DEFAULT NULL,
  `productor` int DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_obra`),
  KEY `productor` (`productor`),
  CONSTRAINT `obras_ibfk_1` FOREIGN KEY (`productor`) REFERENCES `miembros` (`id_miembro`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obras`
--

LOCK TABLES `obras` WRITE;
/*!40000 ALTER TABLE `obras` DISABLE KEYS */;
INSERT INTO `obras` VALUES (1,'La Casa de Bernarda Alba','Federico Perez','Drama',3,2023,'Otoño',NULL,'Cerro'),(2,'Yo y ella','William Shakespeare','Comedia',5,2024,'Primavera',NULL,'Una comedia fantástica llena de enredos amorosos y magia.'),(3,'El Fantasma de la Ópera','Gaston Leroux','Musical',2,2022,'Invierno',NULL,'Cerro y fiesta'),(4,'Romeo y Julieta','William Shakespeare','Drama',5,2023,'Verano',NULL,'La clásica tragedia de dos amantes enfrentados por sus familias.'),(5,'La Cantante Calva','Eugène Ionesco','Teatro del absurdo',1,2021,'Primavera',NULL,'Una obra emblemática del absurdo que desafía la lógica y el lenguaje.'),(6,'Esperando a Godot','Samuel Beckett','Drama',2,2019,'Otoño',NULL,'Dos personajes esperan en vano a un misterioso Godot.'),(7,'El Lago de los Cisnes','Tchaikovsky','Ballet',4,2020,'Invierno',NULL,'Un ballet clásico lleno de simbolismo, belleza y tragedia.'),(8,'Hamilton','Lin-Manuel Miranda','Musical',2,2023,'Verano',NULL,'Un musical innovador que mezcla historia y rap.'),(15,'El perro y el gato','El torres','Comedia',0,2025,'Primavera',NULL,'1'),(22,'El perro y el gato','Samuel Diaz','Drama',2,2025,'Primavera',NULL,'El fuher'),(23,'OB','SS','Drama',1,2025,'Primavera',NULL,'sa');
/*!40000 ALTER TABLE `obras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'usuario1','pass1','cliente','Juan Pérez','juan@example.com'),(2,'usuario2','pass2','cliente','María López','maria@example.com'),(3,'usuario3','pass3','cliente','Carlos Ruiz','carlos@example.com'),(4,'usuario4','pass4','cliente','Ana Torres','ana@example.com'),(5,'usuario5','pass5','cliente','Luis Gómez','luis@example.com'),(6,'usuario6','pass6','cliente','Diana Silva','diana@example.com'),(7,'usuario7','pass7','cliente','Pedro Ríos','pedro@example.com'),(8,'usuario8','pass8','cliente','Elena Cruz','elena@example.com'),(9,'usuario9','pass9','cliente','Sofía Aguilar','sofia@example.com'),(10,'usuario10','pass10','cliente','Miguel Navarro','miguel@example.com'),(11,'probando123','0a4f8b93faad504007df78c9acb6f93ea6cc8c53',NULL,'Juan Prueba','juan@test.com'),(12,'sam','f16bed56189e249fe4ca8ed10a1ecae60e8ceac0',NULL,'sam','sam@gmail.com'),(13,'sam2','f16bed56189e249fe4ca8ed10a1ecae60e8ceac0',NULL,'sam2','sam@gm.com');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_boletos_detalle`
--

DROP TABLE IF EXISTS `vista_boletos_detalle`;
/*!50001 DROP VIEW IF EXISTS `vista_boletos_detalle`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_boletos_detalle` AS SELECT 
 1 AS `id_boleto`,
 1 AS `id_usuario`,
 1 AS `email`,
 1 AS `id_asiento`,
 1 AS `fila`,
 1 AS `numero_asiento`,
 1 AS `id_obra`,
 1 AS `nombre_obra`,
 1 AS `autor`,
 1 AS `precio`,
 1 AS `fecha_compra`,
 1 AS `estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'teatro_pleasantville'
--

--
-- Dumping routines for database 'teatro_pleasantville'
--
/*!50003 DROP FUNCTION IF EXISTS `fn_calcular_ganancia_obra` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_calcular_ganancia_obra`(p_id_obra INT) RETURNS decimal(10,2)
    READS SQL DATA
    DETERMINISTIC
BEGIN
    DECLARE v_total DECIMAL(10,2);

    SELECT SUM(precio) INTO v_total
    FROM boletos
    WHERE id_obra = p_id_obra AND estado != 'Cancelado';

    RETURN v_total;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_vender_boleto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_vender_boleto`(
    IN p_id_usuario INT,
    IN p_id_asiento INT,
    IN p_id_obra INT,
    IN p_precio DECIMAL(10,2)
)
BEGIN
    DECLARE msg TEXT;
    DECLARE codigo CHAR(5);

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        GET DIAGNOSTICS CONDITION 1
            codigo = RETURNED_SQLSTATE, msg = MESSAGE_TEXT;
        ROLLBACK;
        SELECT CONCAT('Error BD: ', msg) AS mensaje;
    END;

    START TRANSACTION;

    INSERT INTO boletos (id_usuario, id_asiento, id_obra, precio, fecha_compra, estado)
    VALUES (p_id_usuario, p_id_asiento, p_id_obra, p_precio, CURDATE(), 'Pagado');

    COMMIT;
    
    SELECT 'Exito' AS mensaje;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vista_boletos_detalle`
--

/*!50001 DROP VIEW IF EXISTS `vista_boletos_detalle`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_boletos_detalle` AS select `b`.`id_boleto` AS `id_boleto`,`u`.`id_usuario` AS `id_usuario`,`u`.`email` AS `email`,`a`.`id_asiento` AS `id_asiento`,`a`.`fila` AS `fila`,`a`.`numero` AS `numero_asiento`,`o`.`id_obra` AS `id_obra`,`o`.`titulo` AS `nombre_obra`,`o`.`autor` AS `autor`,`b`.`precio` AS `precio`,`b`.`fecha_compra` AS `fecha_compra`,`b`.`estado` AS `estado` from (((`boletos` `b` join `usuarios` `u` on((`b`.`id_usuario` = `u`.`id_usuario`))) join `asientos` `a` on((`b`.`id_asiento` = `a`.`id_asiento`))) join `obras` `o` on((`b`.`id_obra` = `o`.`id_obra`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-09 23:24:47
