-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: teste_formulario
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idade` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rua` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (24,'teste3','$2y$10$O7XNNv34ol56Ev784ncOO.j8Hu5fme18IYRmPyfz7bJnIR703uH/K','Teste Teste','37','54777535','Rua Nova Palmeira','Santana','Camaragibe','PE'),(25,'teste4','$2y$10$9MC9qxwepYHZil6LZ4OnIOoa0ZOZJZsobDfgxJSSWHKxS24G7pM3S','Teste Quatro','89','56304917','Avenida José de Sá Maniçoba','Centro','Petrolina','PE'),(23,'teste2','$2y$10$oonQHB/.OdZytlMToa5yfe82I6xYYtrbhOG/UkX1xduJLIjoJroZa','Teste Eeee','19','21765750','Rua da Tranquilidade da Vila Almirante','Realengo','Rio de Janeiro','RJ'),(22,'teste1','$2y$10$jkDl.AF4PW3BbP6JiBQYMu1Qk7a5jlJjhEkFBP4e0ZQ6jM21sFspW','Teste da Silv','17','01001000','Praça da Sé','Sé','São Paulo','SP'),(20,'zeus','$2y$10$T6zr3z9f6Yu8kv76ZMWdt.IZFrXoiLTgjG5JSoHU9SY2lAlhxD6Aq','Zeus Rodrigues Molina','20','03616040','Rua Cirene Jorge Ribeiro','Vila Salete','São Paulo','SP'),(26,'teste5','$2y$10$tYd7F/79p3jzJwZhjP7aZ.dvO/uYsEhBSqAdLduiYPb6kFsD3BWtu','Teste Cinco','78','53401390','Rua Centro de Abastecimento Tiradentes','Centro','Paulista','PE');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-08 11:05:32
