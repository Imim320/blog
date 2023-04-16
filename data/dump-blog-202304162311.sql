-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.19-MariaDB

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `imgLink` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'Asus ROG Phone 7 Ultimate to najlepszy gamingowy smartfon. Kropka','https://spidersweb.pl/_next/image?url=https%3A%2F%2Focs-pl.oktawave.com%2Fv1%2FAUTH_2887234e-384a-4873-8bc5-405211db13a2%2Fspidersweb%2F2023%2F04%2Frog-phone-14.jpg&w=1200&q=75','Ziutek','https://spidersweb.pl/2023/04/asus-rog-phone-7-ultimate-test-opinie.html','Asus ROG Phone 7 Ultimate to gamingowy smartfon, który jest dużym krokiem naprzód w porównaniu do poprzednika. Jeżeli chcesz mieć telefon do grania na najwyższym poziomie, to możesz brać go w ciemno. Rynek nie ma nic lepszego do zaoferowania. W zasadzie mógłbym już skończyć recenzję, bo jej wynik zdradziłem w tytule i trudno tutaj dodać coś więcej. Nie ma lepszego telefonu do grania, niezależnie czy chcemy to robić w gry mobilne, czy używać smartfonu do strumieniowania gry z chmury. Nie grzeje się, jest piekielnie szybki, wydajny a do tego jakość obrazu jest rewelacyjna. Jednak jakoś tak się przyjęło, że jednozdaniowe recenzje nie są mile widziane przez czytelników, więc czas na opis moich wrażeń z kilku tygodni spędzonych z Asusem ROG Phone 7 Ultimate. '),(2,'Naukowcy przepuścili światło lasera przez szczeliny w czasie. „To było coś, czego nie mogliśmy wyjaśnić”','https://spidersweb.pl/_next/image?url=https%3A%2F%2Focs-pl.oktawave.com%2Fv1%2FAUTH_2887234e-384a-4873-8bc5-405211db13a2%2Fspidersweb%2F2021%2F09%2Flasery.jpg&w=1200&q=75','Gutek','wykop.pl','Naukowcy odtworzyli klasyczny eksperyment podwójnej szczeliny przy użyciu laserów. Nie byłoby w tym nic nadzwyczajnego, gdyby nie to, że szczeliny istniały tym razem nie w przestrzeni, a w czasie. Dzięki temu naukowcom udało się pokazać, że światło może przenikać również przez szczeliny w czasie. Nowy eksperyment to nawiązanie do demonstracji sprzed ponad dwóch stuleci, w której strumień światła przechodzi przez dwie szczeliny na płaszczyźnie. Na skutek tego, powstaje wzór dyfrakcji (czyli ugięcia się światła wokół krawędzi otworu), gdzie „górki” i „dołki” fali świetlnej dodają się lub wzajemnie znoszą. Teraz, w nowej wersji tego eksperymentu, badaczom udało się stworzyć podobny wzór w czasie.');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8_polish_ci NOT NULL,
  `content` text CHARACTER SET utf32 COLLATE utf32_polish_ci NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_id` (`article_id`),
  CONSTRAINT `fk_article_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,'Anonimowy','pierwszy',1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mateusz.foremniak98@gmail.com','qwerty1234');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'blog'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-16 23:11:48
