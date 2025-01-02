-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: websitem
-- ------------------------------------------------------
-- Server version	8.4.0

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
-- Table structure for table `denemeler`
--

DROP TABLE IF EXISTS `denemeler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `denemeler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kullanici_id` int NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `icerik` text NOT NULL,
  `tarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kullanici_id` (`kullanici_id`),
  CONSTRAINT `denemeler_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `uyeler` (`iduyeler`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denemeler`
--

LOCK TABLES `denemeler` WRITE;
/*!40000 ALTER TABLE `denemeler` DISABLE KEYS */;
INSERT INTO `denemeler` VALUES (14,1,'Hayat ve Edebiyat','Hayatın en önemli gerçeği samimiliktir. Bu itibarla, hayat ile bağı olan edebiyat, mutlaka samimi bir edebiyattır denilebilir. Hayatı en gizli, en karışık yönleriyle anlatmayan, duygularımızı tıpkı hayatta olduğu gibi saf ve derin bir şekilde duyurmayan, elemlerimizi, felaketlerimizi, açık açık yansıtmayan bir edebiyat, hayat ile ilgisiz ve sahte bir edebiyattır. Öyle bir edebiyat, kelimeleri dizip, onları işleyen pek hünerli kuyumcular çıkarabilir. Belki onlar çok süslü, çok göz alıcı şeyler yapabilirler. Fakat, ne yazık ki bütün bu sahte ürünler muntazam kış bahçelerinde yetişen iri yapraklı, parlak renkli çiçeklere benzer. Uzaklığından dolayı bize çok çekici, çok harikulade görünen o meçhul sıcak iklimlerin bu göz kamaştıran ürünleri nasıl açık bir havaya, sert bir rüzgara dayanamazsa, hayat ile ilgisi olmayan böyle bir edebiyat da zamanın sonsuz kasırgaları önünde süpürülüp gitmeye mahkumdur. Halbuki bedii his, hislerimizin en ilahi ve en samimisidir. Akşam rüzgarı ile inleyen bir çam ormanının karanlık hışırtıları ne kadar tabii ise, ruhun güzellik karşısında duyduğu hisler de hayatın en derin ve anlaşılmaz köşelerinden birdenbire fırlayıp çıktığı için, her şeyden çok samimidir. İşte bunun gibi milletler için de “güzel” ve “iyi” telakkilerinden daha “milli” hiçbir şey yoktur. Bir toplumu başkalarından ayırmak isterseniz onun din ve ahlak hakkındaki, güzellik hakkındaki samimi duygularını arayınız. Çünkü bunlar doğrudan doğruya ruhundan koptuğu için hayatının en samimi taraflarıdır.\r\n\r\nYüksek ve hakiki sanat asıl ona derler ki, hayatı bütün genişliği ve bütün samimiliğiyle okuyucuya duyurabilsin. Ancak yapmacığın bittiği yerde sanatın başlayabileceğini, nedense, hala anlayamadık!','2024-06-27 21:08:39'),(15,1,'İyiliğin Anlamı','İyiliğin gerçek anlamını biliyor musunuz?Ben biliyorum.Bence iyilik, insanların karşılık beklemeden yaptıklarıdır.\r\n\r\nİyilik yapanlar her zaman karşılığını alırlar.Hatta bu düşünce atasözlerine bile yansımıştır.Ben iyilik yapanların her zaman karşılığını aldıklarını birçok kez gördüm.Hatta yaşadım bile… Bence iyilik yaparsan hayat sana da gülümser.\r\n\r\nBazı insanlar da yüzlerine iyilikten bir maske takarlar.Fakat bence bir gün o maske, kişinin yüzünden düşecek. Ve maskenin düştüğü an, insanlar kişinin gerçek yüzünü görecekler.\r\n\r\nEğer hayatın size de gülümsemesini istiyorsanız, yapmanız gereken ufak bir şey var.Sizinde çevrenizdeki insanlara gülümsemeniz.','2024-06-27 21:09:46'),(16,1,'Yalnızlık','Yalnız yaşamanın bir tek amacı vardır sanıyorum; o da daha başıboş, daha rahat yaşamak. Fakat her zaman, buna hangi yoldan varacağımızı pek bilmiyoruz. Çok kez insan dünya işlerini bıraktığını sanır; oysaki bu işlerin yolunu değiştirmekten başka bir şey yapmamıştır. Bir aileyi yönetmek bir devleti yönetmekten hiç de kolay değildir. Ruh nerde bunalırsa bunalsın, hep aynı ruhtur; ev işlerinin az önemli olmaları, daha az yorucu olmalarını gerektirmez. Bundan başka, saraydan ve pazardan el çekmekle hayatımızın baş kaygılarından kurtulmuş olmuyoruz.','2024-06-27 21:10:48');
/*!40000 ALTER TABLE `denemeler` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-28  0:14:21
