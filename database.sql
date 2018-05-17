-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: Auth
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userEmail` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `userEmail_UNIQUE` (`userEmail`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,'masha','masha@mail.ru','41a28dfb93e9ce1cfd8e14d24c1ad121','ydn4i8zn67hFR9ztZHfidE1dda2iaHtz'),(12,'sasha','sasha@mail.ru','f61644564d348340e9e900b16e829701','HSSKy3aQADdY2kdFf7AftK8KGb7QbHzi'),(13,'vasya','vasya@mail.ru','16c8568e63b854766b23dd1428ac7fbb','A427EzK8DY5eQ7AF4eKbYA8iQnfdThND'),(14,'denis','denis@mail.ru','f4d9cb01413678faba51045930dcf4ae','2NZ3K8dZZBSERDi94h4DfyR8eDB1S28N'),(16,'pasha','pasha@mail.ru','0d232316b522fb351046fcb4a40612fc','H5D4hY6DhiGaS6YRA93QdaGhsAHhe5hs'),(17,'levneedscoffee','david@mail.ru','af54a43e566ae433a560e41f4a6337ba','zzrkdEsE6fEaSSZ2zs8N4h5d4Ys4RBbF'),(18,'lera','lera@mail.ru','e14f2a5ec389ec9670ce9e90c66b484e','9KneRrtQQThf75EHFnt6KbKe8D6YZsNF'),(19,'vera','vera@mail.ru','458be61496a9b3c8ec0f641ddfefa50f','h9EHK2ZrHHnz88BffBYaD8ZFYnNhHzy9'),(20,'leva','leva@mail.ru','4ded9c56b3922e390a0a3a470d9adb79','e12ek5AiZZ43QATBFThH3KbAGYf9saZ2');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-17 12:12:29
