-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: amadeus
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `composers`
--

DROP TABLE IF EXISTS `composers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `composers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `relevance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `composers`
--

LOCK TABLES `composers` WRITE;
/*!40000 ALTER TABLE `composers` DISABLE KEYS */;
/*!40000 ALTER TABLE `composers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compositions`
--

DROP TABLE IF EXISTS `compositions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compositions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `composer_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `composer_id` (`composer_id`),
  CONSTRAINT `compositions_ibfk_1` FOREIGN KEY (`composer_id`) REFERENCES `composers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compositions`
--

LOCK TABLES `compositions` WRITE;
/*!40000 ALTER TABLE `compositions` DISABLE KEYS */;
/*!40000 ALTER TABLE `compositions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons_composers`
--

DROP TABLE IF EXISTS `lessons_composers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons_composers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `composer_id` int(11) NOT NULL,
  `lesson` text COLLATE utf8_bin NOT NULL,
  `relevance` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `composer_id` (`composer_id`),
  CONSTRAINT `lessons_composers_ibfk_1` FOREIGN KEY (`composer_id`) REFERENCES `composers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons_composers`
--

LOCK TABLES `lessons_composers` WRITE;
/*!40000 ALTER TABLE `lessons_composers` DISABLE KEYS */;
/*!40000 ALTER TABLE `lessons_composers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons_compositions`
--

DROP TABLE IF EXISTS `lessons_compositions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons_compositions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `composition_id` int(11) NOT NULL,
  `lesson` text COLLATE utf8_bin NOT NULL,
  `relevance` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `composition_id` (`composition_id`),
  CONSTRAINT `lessons_compositions_ibfk_1` FOREIGN KEY (`composition_id`) REFERENCES `compositions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons_compositions`
--

LOCK TABLES `lessons_compositions` WRITE;
/*!40000 ALTER TABLE `lessons_compositions` DISABLE KEYS */;
/*!40000 ALTER TABLE `lessons_compositions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `composition_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `composition_id` (`composition_id`),
  CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`composition_id`) REFERENCES `compositions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-09 21:36:52
