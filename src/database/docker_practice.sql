-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               26.10.0 - MySQL Community Server - GPL
-- Server OS:                    Linux
-- HeidiSQL Version:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for docker_practice
CREATE DATABASE IF NOT EXISTS `docker_practice` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `docker_practice`;

-- Dumping structure for table docker_practice.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Apellido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Correo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Direccion` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Ciudad` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table docker_practice.clientes: ~13 rows (approximately)
INSERT INTO `clientes` (`Id`, `Nombre`, `Apellido`, `Correo`, `Telefono`, `Direccion`, `Ciudad`) VALUES
	(5, 'Laura', 'Fernandez', 'laura@gmail.com', '8095551239', 'Calle Principal 5', 'Santo Domingo'),
	(6, 'Jose', 'Ramirez', 'jose@gmail.com', '8095551240', 'Calle Las Flores 8', 'Moca'),
	(7, 'Carmen', 'Torres', 'carmen@gmail.com', '8095551241', 'Av. Libertad 12', 'Bonao'),
	(8, 'Miguel', 'Diaz', 'miguel@gmail.com', '8095551242', 'Calle Central 25', 'Puerto Plata'),
	(9, 'Lucia', 'Hernandez', 'lucia@gmail.com', '8095551243', 'Calle El Sol 14', 'Santiago'),
	(10, 'Carlos', 'Rodriguez', 'carlos@gmail.com', '8095551234', 'Calle Restauracion 9', 'La Vega'),
	(58, 'yariel', 'taveras ', 'yariel@gmail.com', '7658345656', 'en mi casa', 'en la tuya '),
	(60, 'Anabel', 'acosta', 'anabel@gmail.com', '34635465', 'Villavicencio', 'colombia '),
	(61, 'andres ', 'plasencia ', 'andres@gmail.com', '09876543246', 'en una casa verde ', 'santiago '),
	(62, 'andrea ', 'castaner', 'andrea@gmail.com', '4643686476', 'miami', 'new york'),
	(156, 'andres ', 'acosta', 'federico@gmail.com', '987651325', 'Villavicencio', 'banao '),
	(205, 'antonio', 'federico', 'federico@gmail.com', '987651325', 'home', 'banao'),
	(207, 'joel', 'batista', 'joelbatista@gmail.com', '809-809-8789', 'juma #08', 'Bonao');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
