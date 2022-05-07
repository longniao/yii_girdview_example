-- MySQL dump 10.13  Distrib 8.0.29, for macos11.6 (x86_64)
--
-- Host: localhost    Database: yii2basic
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `code` char(3) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
  `t_status` enum('ok','hold') CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT 'ok',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'Afghanistan','af','ok'),(2,'Åland','ax','ok'),(3,'Albania','al','ok'),(4,'Algeria','dz','ok'),(5,'American Samoa','as','ok'),(6,'Andorra','ad','ok'),(7,'Angola','ao','hold'),(8,'Anguilla','ai','ok'),(9,'Antarctica','aq','ok'),(10,'Antigua and Barbuda','ag','ok'),(11,'Argentina','ar','ok'),(12,'Armenia','am','ok'),(13,'Aruba','aw','ok'),(14,'Ascension Island','ac','hold'),(15,'Australia','au','ok'),(16,'Austria','at','ok'),(17,'Azerbaijan','az','ok'),(18,'Bahamas','bs','ok'),(19,'Bahrain','bh','ok'),(20,'Bangladesh','bd','ok'),(21,'Barbados','bb','ok'),(22,'Basque Country','eu','hold'),(23,'Belarus','by','ok'),(24,'Belgium','be','ok'),(25,'Belize','bz','ok'),(26,'Benin','bj','ok'),(27,'Bermuda','bm','ok'),(28,'Bhutan','bt','ok'),(29,'Bolivia','bo','ok'),(30,'Bonaire','bq','ok'),(31,'Bosnia and Herzegovina','ba','ok'),(32,'Botswana','bw','ok'),(33,'Bouvet Island','bv','ok'),(34,'Brazil','br','ok'),(35,'British Indian Ocean Territory','io','ok'),(36,'British Virgin Islands','vg','ok'),(37,'Brunei','bn','ok'),(38,'Bulgaria','bg','ok'),(39,'Burkina Faso','bf','ok'),(40,'Burma (officially: Myanmar)','mm','ok'),(41,'Burundi','bi','ok');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-07 14:00:16
