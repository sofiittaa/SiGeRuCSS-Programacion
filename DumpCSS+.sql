-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sigeru
-- ------------------------------------------------------
-- Server version	9.4.0

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
-- Table structure for table `adminmunicipal`
--

DROP TABLE IF EXISTS `adminmunicipal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adminmunicipal` (
  `cedula` int NOT NULL,
  PRIMARY KEY (`cedula`),
  CONSTRAINT `fk_admin_empleado` FOREIGN KEY (`cedula`) REFERENCES `empleado` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `camion`
--

DROP TABLE IF EXISTS `camion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `camion` (
  `matricula` varchar(10) NOT NULL,
  `capacidad` varchar(10) DEFAULT NULL,
  `idCuad` int DEFAULT NULL,
  `idRuta` int DEFAULT NULL,
  PRIMARY KEY (`matricula`),
  UNIQUE KEY `idCuad` (`idCuad`),
  KEY `fk_camion_ruta` (`idRuta`),
  CONSTRAINT `fk_camion_cuadrilla` FOREIGN KEY (`idCuad`) REFERENCES `cuadrillareco` (`idCuad`),
  CONSTRAINT `fk_camion_ruta` FOREIGN KEY (`idRuta`) REFERENCES `rutas` (`idRuta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `centroacopio`
--

DROP TABLE IF EXISTS `centroacopio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `centroacopio` (
  `RUTdes` int NOT NULL,
  PRIMARY KEY (`RUTdes`),
  CONSTRAINT `fk_centroAcopio_destino` FOREIGN KEY (`RUTdes`) REFERENCES `destino` (`RUTdes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contenedor`
--

DROP TABLE IF EXISTS `contenedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contenedor` (
  `idCont` int NOT NULL AUTO_INCREMENT,
  `zona` varchar(100) DEFAULT NULL,
  `capacidad` varchar(10) DEFAULT NULL,
  `idRuta` int DEFAULT NULL,
  `idEst` int DEFAULT NULL,
  PRIMARY KEY (`idCont`),
  KEY `fk_contenedor_ruta` (`idRuta`),
  KEY `fk_contenedor_estado` (`idEst`),
  CONSTRAINT `fk_contenedor_estado` FOREIGN KEY (`idEst`) REFERENCES `estado` (`idEst`),
  CONSTRAINT `fk_contenedor_ruta` FOREIGN KEY (`idRuta`) REFERENCES `rutas` (`idRuta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cuadrillareco`
--

DROP TABLE IF EXISTS `cuadrillareco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuadrillareco` (
  `idCuad` int NOT NULL AUTO_INCREMENT,
  `zonaCuad` varchar(30) DEFAULT NULL,
  `horaCuad` time DEFAULT NULL,
  PRIMARY KEY (`idCuad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `destino`
--

DROP TABLE IF EXISTS `destino`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `destino` (
  `RUTdes` int NOT NULL,
  `nomDes` varchar(50) DEFAULT NULL,
  `capDes` varchar(10) DEFAULT NULL,
  `horAperDes` time DEFAULT NULL,
  `horCierDes` time DEFAULT NULL,
  `zonaDes` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`RUTdes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleado` (
  `cedula` int NOT NULL,
  `idCuad` int DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `fk_empleado_cuadrilla` (`idCuad`),
  CONSTRAINT `fk_empleado_cuadrilla` FOREIGN KEY (`idCuad`) REFERENCES `cuadrillareco` (`idCuad`),
  CONSTRAINT `fk_empleado_usuario` FOREIGN KEY (`cedula`) REFERENCES `usuario` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `idEst` int NOT NULL AUTO_INCREMENT,
  `tipoEst` varchar(30) DEFAULT NULL,
  `nomEst` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idEst`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `incidencia`
--

DROP TABLE IF EXISTS `incidencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incidencia` (
  `idInci` int NOT NULL AUTO_INCREMENT,
  `fchaCreaInci` date DEFAULT NULL,
  `fchaCierInci` date DEFAULT NULL,
  `estInci` varchar(15) DEFAULT NULL,
  `descInci` varchar(120) DEFAULT NULL,
  `cedula` int DEFAULT NULL,
  `idCont` int DEFAULT NULL,
  PRIMARY KEY (`idInci`),
  KEY `fk_incidencia_usuario` (`cedula`),
  KEY `fk_incidencia_contenedor` (`idCont`),
  CONSTRAINT `fk_incidencia_contenedor` FOREIGN KEY (`idCont`) REFERENCES `contenedor` (`idCont`),
  CONSTRAINT `fk_incidencia_usuario` FOREIGN KEY (`cedula`) REFERENCES `usuario` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rutas`
--

DROP TABLE IF EXISTS `rutas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rutas` (
  `idRuta` int NOT NULL AUTO_INCREMENT,
  `RUTdes` int DEFAULT NULL,
  `zonaRuta` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idRuta`),
  KEY `fk_ruta_destino` (`RUTdes`),
  CONSTRAINT `fk_ruta_destino` FOREIGN KEY (`RUTdes`) REFERENCES `destino` (`RUTdes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `cedula` int NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `zonaUsu` varchar(30) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vecino`
--

DROP TABLE IF EXISTS `vecino`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vecino` (
  `cedula` int NOT NULL,
  PRIMARY KEY (`cedula`),
  CONSTRAINT `fk_vecino_usuario` FOREIGN KEY (`cedula`) REFERENCES `usuario` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vertedero`
--

DROP TABLE IF EXISTS `vertedero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vertedero` (
  `RUTdes` int NOT NULL,
  PRIMARY KEY (`RUTdes`),
  CONSTRAINT `fk_vertedero_destino` FOREIGN KEY (`RUTdes`) REFERENCES `destino` (`RUTdes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-26 21:48:05
