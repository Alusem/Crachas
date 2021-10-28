CREATE DATABASE  IF NOT EXISTS `crachas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `crachas`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: crachas
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `configuracoes`
--

DROP TABLE IF EXISTS `configuracoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuracoes` (
  `idconfiguracoes` int NOT NULL AUTO_INCREMENT,
  `background` longblob,
  `background2` longblob,
  PRIMARY KEY (`idconfiguracoes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracoes`
--

LOCK TABLES `configuracoes` WRITE;
/*!40000 ALTER TABLE `configuracoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `configuracoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crachas`
--

DROP TABLE IF EXISTS `crachas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `crachas` (
  `idCrachas` int NOT NULL AUTO_INCREMENT,
  `idEmpresa` int NOT NULL,
  `filial` varchar(255) DEFAULT NULL,
  `nomeCompleto` varchar(255) NOT NULL,
  `apelido` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `numeroRG` varchar(255) NOT NULL,
  `orgaoExpeditor` varchar(255) NOT NULL,
  `numeroCPF` varchar(255) NOT NULL,
  `dataAdimssao` date NOT NULL,
  `codigoMatricula` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idCrachas`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crachas`
--

LOCK TABLES `crachas` WRITE;
/*!40000 ALTER TABLE `crachas` DISABLE KEYS */;
INSERT INTO `crachas` VALUES (2,1,'São Luis','Alan Silva Espindola de Moraes','Alan Moraes','CEO','024395492003-0','SSP/MA','045.131.163-90','2014-03-06','0001','../IMG/Fotos_Funcionarios/Funcionarios606b0712a4e8f0303339c678ab8219bf.jpg'),(3,2,'São Luis','Samuel Cardoso Araujo','Samuel Cardoso','CAIXA','038023662009-0','SSP/MA','604.572.813-08','2021-04-01','2115513','../IMG/Fotos_Funcionarios/Funcionarios9ff247f7ce939a04140a4d1f3d311c73jfif'),(7,17,'São Luis','CLIENTE TESTE','CLIENTE','TESTE','656523285232-3','SSP/MA','836.360.010-51','2021-08-19','2115521',NULL),(8,1,'São Luis','Italo Gustavo','Italo Gustavo','CIO','656523285232-4','SSP/MA','852.981.280-84','2021-02-19','2113512','../IMG/Fotos_Funcionarios/Funcionarios9315124b1ab632c6f11187db3142a591jfif'),(10,1,'São Luis','Carlos Winiger','Carlos Winiger','CONSULTOR DE VENDAS','656523285122-8','SSP/MA','548.626.240-06','2021-02-21','2115123','../IMG/Fotos_Funcionarios/Funcionariosfff711e92fadca8b83992e1525ec2c24.jpg');
/*!40000 ALTER TABLE `crachas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas` (
  `idEmpresas` int NOT NULL AUTO_INCREMENT,
  `empresa` varchar(255) DEFAULT NULL,
  `background` varchar(255) DEFAULT NULL,
  `background2` varchar(255) DEFAULT NULL,
  `emp_preview_foto_altura` int DEFAULT NULL,
  `emp_preview_foto_largura` int DEFAULT NULL,
  `emp_impressao_foto_altura` int DEFAULT NULL,
  `emp_impressao_foto_largura` int DEFAULT NULL,
  PRIMARY KEY (`idEmpresas`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'QUERY','../IMG/QUERY/Frentefc264d5b8056cb4dd2bb3832920415ef.png','../IMG/QUERY/Versofc264d5b8056cb4dd2bb3832920415ef.png',300,231,245,181),(2,'ROQUE','../IMG/ROQUE/Frente323360da7083d3e58569be04196abee0.png','../IMG/ROQUE/Verso323360da7083d3e58569be04196abee0.png',266,198,214,160),(17,'CARRARA',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-28 17:31:52
