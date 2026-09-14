CREATE DATABASE  IF NOT EXISTS `sigeru` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sigeru`;
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
-- Dumping data for table `camion`
--

LOCK TABLES `camion` WRITE;
/*!40000 ALTER TABLE `camion` DISABLE KEYS */;
/*!40000 ALTER TABLE `camion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `centroacopio`
--

LOCK TABLES `centroacopio` WRITE;
/*!40000 ALTER TABLE `centroacopio` DISABLE KEYS */;
/*!40000 ALTER TABLE `centroacopio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `contenedor`
--

LOCK TABLES `contenedor` WRITE;
/*!40000 ALTER TABLE `contenedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `contenedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `cuadrillareco`
--

LOCK TABLES `cuadrillareco` WRITE;
/*!40000 ALTER TABLE `cuadrillareco` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuadrillareco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `destino`
--

LOCK TABLES `destino` WRITE;
/*!40000 ALTER TABLE `destino` DISABLE KEYS */;
/*!40000 ALTER TABLE `destino` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `incidencia`
--

LOCK TABLES `incidencia` WRITE;
/*!40000 ALTER TABLE `incidencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `incidencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `maquinariabasica`
--

LOCK TABLES `maquinariabasica` WRITE;
/*!40000 ALTER TABLE `maquinariabasica` DISABLE KEYS */;
INSERT INTO `maquinariabasica` VALUES ('Compactadora010509','Compactadora','101570511012','BC672RB-2','Bomag',2024);
/*!40000 ALTER TABLE `maquinariabasica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rutas`
--

LOCK TABLES `rutas` WRITE;
/*!40000 ALTER TABLE `rutas` DISABLE KEYS */;
/*!40000 ALTER TABLE `rutas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (0,'Admin','Municipal','$2y$10$ldDbQnjVGVYOckrGsVwfXudXYagS3KsIuZVA5347kqH/w7z.CVV86','adminsigeru@gmail.com','admin'),(34891567,'Marta','Abelenda','$2y$10$Ox/Op1pP2i10wNpj.r4acu6tmY4PtvhD5/MvH0pFotx65DO3ZzW9O','geraby@gmail.com','vecino'),(53402673,'Valentina','Gallo',' $2y$10$Sz.ufao4zbQ8l.96.kBK/uZr3e9lvjAv4qcCP6.HDDuXGQEg40s.m','vale0306@gmail.com','empleado');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `utiliza`
--

LOCK TABLES `utiliza` WRITE;
/*!40000 ALTER TABLE `utiliza` DISABLE KEYS */;
/*!40000 ALTER TABLE `utiliza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `vecino`
--

LOCK TABLES `vecino` WRITE;
/*!40000 ALTER TABLE `vecino` DISABLE KEYS */;
/*!40000 ALTER TABLE `vecino` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `vertedero`
--

LOCK TABLES `vertedero` WRITE;
/*!40000 ALTER TABLE `vertedero` DISABLE KEYS */;
/*!40000 ALTER TABLE `vertedero` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-14 18:45:10
