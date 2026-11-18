-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: docker_practice
-- ------------------------------------------------------
-- Server version	26.10.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!50503 SET NAMES utf8 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;

SET @@SESSION.SQL_LOG_BIN = 0;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `clientes` (
    `Id` int NOT NULL AUTO_INCREMENT,
    `Nombre` varchar(50),
    `Apellido` varchar(50),
    `Correo` varchar(100),
    `Telefono` varchar(30),
    `Direccion` varchar(225),
    `Ciudad` varchar(100),
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB AUTO_INCREMENT = 52 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */
;
INSERT INTO
    `clientes`
VALUES (
        1,
        'Carlos',
        'Rodriguez',
        'carlos@gmail.com',
        '8095551234',
        'Calle Duarte 15',
        'Bonao'
    ),
    (
        2,
        'Maria',
        'Perez',
        'maria@gmail.com',
        '8095551235',
        'Calle Mella 20',
        'Bonao'
    ),
    (
        3,
        'Juan',
        'Martinez',
        'juan@gmail.com',
        '8095551236',
        'Calle Duarte 30',
        'Santiago'
    ),
    (
        4,
        'Ana',
        'Garcia',
        'ana@gmail.com',
        '8095551237',
        'Av. Independencia 10',
        'Santo Domingo'
    ),
    (
        5,
        'Pedro',
        'Sanchez',
        'pedro@gmail.com',
        '8095551238',
        'Calle Principal 5',
        'Santo Domingo'
    ),
    (
        6,
        'Laura',
        'Fernandez',
        'laura@gmail.com',
        '8095551239',
        'Calle Las Flores 8',
        'Moca'
    ),
    (
        7,
        'Jose',
        'Ramirez',
        'jose@gmail.com',
        '8095551240',
        'Av. Libertad 12',
        'Bonao'
    ),
    (
        8,
        'Carmen',
        'Torres',
        'carmen@gmail.com',
        '8095551241',
        'Calle Central 25',
        'Puerto Plata'
    ),
    (
        9,
        'Miguel',
        'Diaz',
        'miguel@gmail.com',
        '8095551242',
        'Calle El Sol 14',
        'Santiago'
    ),
    (
        10,
        'Lucia',
        'Hernandez',
        'lucia@gmail.com',
        '8095551243',
        'Calle Restauracion 9',
        'La Vega'
    );
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */
;
UNLOCK TABLES;

SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;

-- Dump completed on 2026-11-16 20:32:34