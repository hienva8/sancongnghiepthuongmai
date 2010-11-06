-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.27-community-nt-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema industry
--

CREATE DATABASE IF NOT EXISTS industry;
USE industry;

--
-- Definition of table `advertise`
--

DROP TABLE IF EXISTS `advertise`;
CREATE TABLE `advertise` (
  `id_advertise` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(60) default NULL,
  `notes` varchar(200) default NULL,
  `notes_EN` varchar(200) default NULL,
  `file_image` varchar(60) default NULL,
  `url` varchar(60) default NULL,
  `day_update` datetime default NULL,
  `day_start` datetime default NULL,
  `day_end` datetime default NULL,
  `day_remain` varchar(10) default NULL,
  `width` int(10) unsigned default NULL,
  `height` int(10) unsigned default NULL,
  `position` varchar(20) default NULL,
  `fileflash` varchar(60) default NULL,
  `sort` int(10) unsigned default NULL,
  `visible` tinyint(3) default '0',
  PRIMARY KEY  (`id_advertise`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertise`
--

/*!40000 ALTER TABLE `advertise` DISABLE KEYS */;
INSERT INTO `advertise` (`id_advertise`,`title`,`notes`,`notes_EN`,`file_image`,`url`,`day_update`,`day_start`,`day_end`,`day_remain`,`width`,`height`,`position`,`fileflash`,`sort`,`visible`) VALUES 
 (1,'hinh test','test hinh 2','test alo','4.jpg',NULL,'2010-08-07 00:00:00','2010-08-08 00:00:00','2020-08-11 00:00:00','3656',190,NULL,'left','',1,1),
 (2,'Quáº£ng cÃ¡o 2','Quáº£ng cÃ¡o 2','Quáº£ng cÃ¡o 2','PressureWashersCatBanner_2.jpg',NULL,'2010-08-07 14:52:33','2010-08-05 00:00:00','2011-08-26 00:00:00','386',350,NULL,'ask','banner.swf',2,1),
 (12,'Du lich da lat',NULL,NULL,'dulich_nuocngoai.gif',NULL,'2010-09-15 05:00:16','2010-09-15 00:00:00','2011-09-30 00:00:00','380',150,NULL,'ask','',11,1),
 (5,'Quang cao left','Quang cao left','Quang cao left','',NULL,'2010-08-08 02:53:14','2010-08-08 00:00:00','2011-09-27 00:00:00','415',190,NULL,'left','Thap HN.swf',4,0),
 (6,'HÃ¬nh left','Left picture',NULL,'1246244209_social-networking.jpg',NULL,'2010-08-08 02:55:54','2010-08-08 00:00:00','2020-08-31 00:00:00','3676',190,NULL,'left','',5,1),
 (11,'quang cao chao mua','quáº£ng cÃ¡o chÃ o mua','to buy','slide2_1.jpg',NULL,'2010-08-21 08:52:55','2010-08-21 00:00:00','2020-08-21 00:00:00','3653',220,NULL,'buy','',10,1),
 (7,'slide 1','CÃ´ng Ty ThÆ°Æ¡ng Máº¡i &  Äáº§u TÆ° Song PhÃ¡t 360','Company business SongPhat 360','slide4.jpg','http://songphat360.com','2010-08-08 13:18:56','2010-08-08 00:00:00','2020-08-31 00:00:00','3676',535,NULL,'mid1','',6,1),
 (8,'tieu Ä‘á» slide 1','ghi chÃº tieu Ä‘á» slide 1','notest title 1','slide1.jpg',NULL,'2010-08-08 13:38:57','2010-08-08 00:00:00','2020-08-31 00:00:00','3676',535,NULL,'mid1','',7,1),
 (9,'tieu Ä‘á» slide 2','tieu Ä‘á» slide 2','Title slide 2','slide2.jpg',NULL,'2010-08-08 14:15:40','2010-08-08 00:00:00','2020-08-08 00:00:00','3653',535,NULL,'mid1','',8,1),
 (10,'tieu Ä‘á» slide 3','tieu Ä‘á» slide 3','Title slide 3','slide3.jpg',NULL,'2010-08-08 14:16:46','2010-08-08 00:00:00','2020-08-08 00:00:00','3653',535,NULL,'mid1','',9,1);
/*!40000 ALTER TABLE `advertise` ENABLE KEYS */;


--
-- Definition of table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id_answer` int(10) unsigned NOT NULL auto_increment,
  `answer_id_question` int(10) unsigned default NULL,
  `answer_id_member` int(10) unsigned default NULL,
  `answer_content` text,
  `answer_day_update` datetime default NULL,
  `answer_visible` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`id_answer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `answer`
--

/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` (`id_answer`,`answer_id_question`,`answer_id_member`,`answer_content`,`answer_day_update`,`answer_visible`) VALUES 
 (1,4,2,'MÃ¡y em cá»© vÃ o Fifa Online Ä‘áº¿n Ä‘oáº¡n nháº¥n phÃ­m báº¥t ká»³, em nháº¥n chuá»™t vÃ  mÃ n hÃ¬nh Ä‘á»©ng luÃ´n á»Ÿ Ä‘Ã³, khÃ´ng cháº¡y ná»¯a. Em Ä‘Ã£ copy báº£n má»›i vá» vÃ  cÃ i mÃ  tÃ¬nh tráº¡ng váº«n váº­y.\r\n\r\nXin chá»‰ giÃºp em cÃ¡ch kháº¯c phá»¥c.','2010-09-15 03:24:00',1),
 (2,5,2,'Ã¹ em ping Ä‘áº¿n cÃ¡c trang web váº«n Ä‘Æ°á»£c. Em Ä‘Ã£ thá»­ dÃ¹ng nhiá»u cÃ¡ch nhÆ° Ä‘áº·t Ä‘á»‹a chá»‰ IP, DNS, clear cache , restore default IE, dÃ¹ng trÃ¬nh duyá»‡t khÃ¡c, kiá»ƒm tra card máº¡ng, kiá»ƒm tra Proxy cá»§a server nhÆ°ng khÃ´ng tháº¥y cÃ³ hiá»‡n tÆ°á»£ng gÃ¬ báº¥t thÆ°á»ng vÃ¬ cÃ¡c mÃ¡y trong cÆ¡ quan Ä‘iá»u vÃ o Web Ä‘Æ°á»£c ngoáº¡i trá»« mÃ¡y nÃ y em chÆ°a dÃ¡m ','2010-09-15 03:53:42',1),
 (3,6,1,'tráº£ lá»i cho liÃªn há»‡ cá»§a tui','2010-09-18 09:45:54',1),
 (4,6,2,'hspq07 tra loi cho lien há»‡','2010-09-18 09:49:51',1);
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;


--
-- Definition of table `auction`
--

DROP TABLE IF EXISTS `auction`;
CREATE TABLE `auction` (
  `id_auction` int(10) unsigned NOT NULL auto_increment,
  `auction_title` varchar(150) default NULL,
  `auction_title_EN` varchar(150) default NULL,
  `auction_content` text,
  `auction_content_EN` text,
  `auction_day_update` datetime default NULL,
  `auction_visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_auction`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auction`
--

/*!40000 ALTER TABLE `auction` DISABLE KEYS */;
INSERT INTO `auction` (`id_auction`,`auction_title`,`auction_title_EN`,`auction_content`,`auction_content_EN`,`auction_day_update`,`auction_visible`) VALUES 
 (1,'BÃ¡n Ä‘áº¥u giÃ¡ vÃ o ngÃ y (30/07/2010)','Auction (30/07/2010','ChÃºng tÃ´i sáº½ tá»• chá»©c Ä‘áº¥u giÃ¡ vÃ o (30/07/2010)\r\n<br>Ná»™i dung:....\r\n<br>HÃ¬nh thá»©c...','We will hold an auction on (07/30/2010)\r\nContent <br> :....\r\n<br> mode ..','2010-07-27 19:44:35',1);
/*!40000 ALTER TABLE `auction` ENABLE KEYS */;


--
-- Definition of table `business_form`
--

DROP TABLE IF EXISTS `business_form`;
CREATE TABLE `business_form` (
  `id_business_form` int(10) unsigned NOT NULL auto_increment,
  `bf_name` varchar(100) default NULL,
  `bf_name_EN` varchar(100) default NULL,
  `bf_sort` int(10) unsigned default NULL,
  `bf_visible` tinyint(3) unsigned default NULL,
  PRIMARY KEY  (`id_business_form`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='hình thức kinh doanh';

--
-- Dumping data for table `business_form`
--

/*!40000 ALTER TABLE `business_form` DISABLE KEYS */;
INSERT INTO `business_form` (`id_business_form`,`bf_name`,`bf_name_EN`,`bf_sort`,`bf_visible`) VALUES 
 (1,'Xuáº¥t kháº©u','export rates',1,1),
 (2,'Nháº­p kháº©u','Import ratio',2,1),
 (3,'Dá»‹ch vá»¥','Services',3,1),
 (4,'KhÃ¡c','Orther',4,1);
/*!40000 ALTER TABLE `business_form` ENABLE KEYS */;


--
-- Definition of table `business_form_company`
--

DROP TABLE IF EXISTS `business_form_company`;
CREATE TABLE `business_form_company` (
  `id_business_form_company` int(10) unsigned NOT NULL auto_increment,
  `id_company` int(10) unsigned default NULL,
  `id_business_form` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_business_form_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='bang quan he n - n của business_form voi company';

--
-- Dumping data for table `business_form_company`
--

/*!40000 ALTER TABLE `business_form_company` DISABLE KEYS */;
INSERT INTO `business_form_company` (`id_business_form_company`,`id_company`,`id_business_form`) VALUES 
 (1,1,1),
 (2,1,2),
 (3,1,3),
 (4,2,1),
 (5,2,2);
/*!40000 ALTER TABLE `business_form_company` ENABLE KEYS */;


--
-- Definition of table `business_history`
--

DROP TABLE IF EXISTS `business_history`;
CREATE TABLE `business_history` (
  `id_business_history` int(10) unsigned NOT NULL auto_increment,
  `id_member` int(10) unsigned default NULL,
  `title` varchar(200) default NULL,
  `title_EN` varchar(200) default NULL,
  `short_describe` varchar(255) default NULL,
  `short_describe_EN` varchar(255) default NULL,
  `content` text,
  `content_EN` text,
  `image_illustrate` varchar(30) default NULL,
  `day_update` datetime default NULL,
  `sort` int(10) unsigned default NULL,
  `visible` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`id_business_history`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_history`
--

/*!40000 ALTER TABLE `business_history` DISABLE KEYS */;
INSERT INTO `business_history` (`id_business_history`,`id_member`,`title`,`title_EN`,`short_describe`,`short_describe_EN`,`content`,`content_EN`,`image_illustrate`,`day_update`,`sort`,`visible`) VALUES 
 (1,1,'Sá»± nghiá»‡p nhÃ  kinh doanh HSPQ07','The business of HSPQ07','TÃ´i sinh ra vÃ  lá»›n lÃªn táº¡i vÃ¹ng Ä‘áº¥t PhÃº QuÃ½ nghÃ¨o, nÆ¡i Ä‘Ã£ vun Ä‘áº¯p cho tÃ´i má»™t Ã½ chÃ­... lÃ m giÃ u.','How is the business of HSPQ07 ... ','... ???','How is the business of HSPQ07 ... conotent','alone.jpg','2010-08-06 21:32:31',1,1),
 (2,1,'26 Tá»· phÃº Kwek Leng Beng: KhÃ´ng cÃ³ giá»›i háº¡n cho thÃ nh cÃ´ng',NULL,'May\r\n26\r\nTá»· phÃº Kwek Leng Beng: KhÃ´ng cÃ³ giá»›i háº¡n cho thÃ nh cÃ´ng\r\nBy CÃ´ng Ty Truyá»n ThÃ´ng Sá»‘ iGO\r\nSá»± nháº¡y bÃ©n trong kinh doanh, khiáº¿u tháº©m má»¹ trá»i phÃº káº¿t há»£p vá»›i kháº£ nÄƒng Ä‘iá»u hÃ nh dá»‹ch vá»¥ vÃ  má»™t phong ',NULL,'May\r\n26\r\nTá»· phÃº Kwek Leng Beng: KhÃ´ng cÃ³ giá»›i háº¡n cho thÃ nh cÃ´ng\r\nBy CÃ´ng Ty Truyá»n ThÃ´ng Sá»‘ iGO\r\nSá»± nháº¡y bÃ©n trong kinh doanh, khiáº¿u tháº©m má»¹ trá»i phÃº káº¿t há»£p vá»›i kháº£ nÄƒng Ä‘iá»u hÃ nh dá»‹ch vá»¥ vÃ  má»™t phong cÃ¡ch hoÃ n háº£o Ä‘Ã£ biáº¿n Ã´ng thÃ nh huyá»n thoáº¡i trong lÄ©nh vá»±c kinh doanh báº¥t Ä‘á»™ng sáº£n, trá»Ÿ thÃ nh niá»m kiÃªu hÃ£nh cá»§a ngÆ°á»i dÃ¢n Singapore trÆ°á»›c tháº¿ giá»›i.\r\n\r\nÄÃ³ lÃ  tá»· phÃº Kwek Leng Beng, Ã´ng chá»§ cá»§a chuá»—i nhá»¯ng doanh nghiá»‡p khÃ¡ch sáº¡n, báº¥t Ä‘á»™ng sáº£n hÃ ng Ä‘áº§u Singapore vÃ  tháº¿ giá»›i.\r\n\r\nNá»•i danh vá»›i ká»³ tÃ­ch Ä‘Ã¡nh báº¡i 19 Ä‘á»‘i thá»§ táº§m cá»¡ quá»‘c táº¿ Ä‘á»ƒ giÃ nh quyá»n kiá»ƒm soÃ¡t khÃ¡ch sáº¡n Seoul Hilton cá»§a Táº­p Ä‘oÃ n Daewoo vÃ  vá»›i lá»i tuyÃªn bá»‘ Ä‘Ã£ trá»Ÿ thÃ nh hiá»‡n thá»±c khi sáºµn sÃ ng mua cáº£ khÃ¡ch sáº¡n siÃªu sang táº¡i trung tÃ¢m Manhattan cá»§a â€œÃ´ng trÃ¹mâ€ Donald Trump, Kwek Leng Beng lÃ  má»™t trong sá»‘ Ã­t nhá»¯ng doanh nhÃ¢n thÃ nh cÃ´ng trÃªn cáº£ â€œsÃ¢n nhÃ â€ vÃ  â€œsÃ¢n khÃ¡châ€.\r\n\r\nTá»›i thá»i Ä‘iá»ƒm nÄƒm 2007, vá»›i viá»‡c náº¯m giá»¯ nhá»¯ng doanh nghiá»‡p chá»§ chá»‘t trong lÄ©nh vá»±c kinh doanh khÃ¡ch sáº¡n vÃ  báº¥t Ä‘á»™ng sáº£n Millennium & Copthorne vÃ  City Developments Limited (CDL), khá»‘i tÃ i sáº£n cÃ¡ nhÃ¢n cá»§a Kwek Leng Beng Ä‘Ã£ lÃªn tá»›i con sá»‘ 4,3 tá»· USD.\r\n\r\nHiá»‡u quáº£ cÃ´ng viá»‡c chá»©ng minh táº¥t cáº£\r\n\r\nTá»‘t nghiá»‡p trÆ°á»ng khoa luáº­t cá»§a TrÆ°á»ng ÄH London vÃ  sau Ä‘Ã³ lÃ  lÃ m nhÃ¢n viÃªn quáº£n lÃ½ hÃ nh chÃ­nh cho cÃ´ng ty gia Ä‘Ã¬nh, Kwek váº«n luÃ´n muá»‘n cáº£i cÃ¡ch hÃ nh chÃ­nh cho cÃ´ng ty vÃ¬ á»Ÿ thá»i Ä‘iá»ƒm Ä‘Ã³, cÃ¡c cÃ´ng ty cá»§a ngÆ°á»i Hoa nhÆ° cha Ã´ng cÅ©ng hoáº¡t Ä‘á»™ng ráº¥t tá»‘t, vÃ  chá»‰ cáº§n hoÃ n chá»‰nh cÆ¡ cáº¥u sáº½ Ä‘áº£m báº£o sá»± váº­n hÃ nh hiá»‡u quáº£ cho cÃ´ng ty.\r\n\r\nTháº¿ nhÆ°ng cha Ã´ng thÃ¬ khÃ´ng thá»ƒ chia sáº» suy nghÄ© áº¥y: â€œTa khÃ´ng quan tÃ¢m liá»‡u cÃ´ng tÃ¡c quáº£n trá»‹ hay tÃ¡i cÆ¡ cáº¥u há»‡ thá»‘ng cÃ³ tá»‘t hay khÃ´ng, Ä‘Æ¡n giáº£n lÃ  náº¿u con khÃ´ng bÃ¡n Ä‘Æ°á»£c hÃ ng thÃ¬ con khÃ´ng cÃ³ thu nháº­p, vÃ  náº¿u con khÃ´ng cÃ³ thu nháº­p thÃ¬ con sáº½ cháº¿tâ€.\r\n\r\nXuáº¥t phÃ¡t tá»« mÃ¢u thuáº«n vá»›i cha vá» quan Ä‘iá»ƒm kinh doanh, cÃ³ thá»i gian, Kwek Ä‘Ã£ bá» sang Penang lÃ m viá»‡c, tuy nhiÃªn, cuá»‘i cÃ¹ng Kwek cÅ©ng bá»‹ thuyáº¿t phá»¥c quay trá»Ÿ láº¡i khi báº¡n bÃ¨ cá»§a cha sang Penang tÃ¬m Ã´ng vá». Nhá»› láº¡i ká»· niá»‡m nÃ y, Kwek nhÃºn vai: â€œTÃ´i khÃ´ng pháº£i lÃ  ngÆ°á»i bÆ°á»›ng bá»‰nh hay ngoan cá»‘, khÃ´ng pháº£i loáº¡i ngÆ°á»i luÃ´n muá»‘n chá»©ng tá» mÃ¬nh Ä‘Ãºng ngay cáº£ khi mÃ¬nh Ä‘Ã£ saiâ€.\r\n\r\nKá»ƒ tá»« khi báº¯t Ä‘áº§u sá»± nghiá»‡p vá»›i sá»‘ tÃ i sáº£n khÃ´ng nhá» thá»«a káº¿ tá»« cha - Ã´ng Kwek Hong Png, Kwek Leng Beng ngÃ y nay Ä‘Ã£ nhÃ¢n sá»‘ tÃ i sáº£n Ä‘Ã³ lÃªn nhiá»u láº§n.\r\n\r\nGiá»‘ng nhÆ° cÃ¡c cÃ¢u chuyá»‡n cá»• Ä‘iá»ƒn cá»§a nhá»¯ng ngÆ°á»i Trung Quá»‘c khÃ¡c vá» sá»± lÃ m giÃ u tá»« hai bÃ n tay tráº¯ng, Ã´ng Kwek Hong Png rá»i tá»‰nh PhÃºc Kiáº¿n vá»›i ba anh em trai, khÃ´ng má»™t xu dÃ­nh tÃºi tá»›i Singapore Ä‘á»ƒ gÃ¢y dá»±ng sá»± nghiá»‡p vÃ o nÄƒm 1928. Ká»ƒ tá»« Ä‘Ã³, cÃ¢u chuyá»‡n thÃ nh cÃ´ng cá»§a Táº­p Ä‘oÃ n Hong Leong dáº§n hÃ¬nh thÃ nh. Giá» Ä‘Ã¢y, trong khi Kwek Beng Leng cÃ³ Ä‘Æ°á»£c sá»± nghiá»‡p chÃ³i lá»i táº¡i Singapore thÃ¬ ngÆ°á»i anh em há» cá»§a Ã´ng - Tan Sri Quek Leng Chan - cÅ©ng Ä‘ang gáº·t hÃ¡i thÃ nh cÃ´ng á»Ÿ Malaysia.\r\n\r\nÄá»ƒ Ä‘Æ°á»£c vinh danh trong danh sÃ¡ch nhá»¯ng ngÆ°á»i giÃ u nháº¥t tháº¿ giá»›i do táº¡p chÃ­ Forbes bÃ¬nh chá»n cho tá»›i khi qua Ä‘á»i vÃ o nÄƒm 1994, Ã´ng Kwek Hong Png Ä‘Ã£ khá»Ÿi nghiá»‡p vá»›i viá»‡c Ä‘Ãªm Ä‘Ãªm pháº£i ngá»§ trÃªn sÃ n cá»­a hÃ ng cá»§a má»™t ngÆ°á»i há» hÃ ng tá»« nÄƒm 16 tuá»•i. KhÃ´ng ai khÃ¡c, cha chÃ­nh lÃ  ngÆ°á»i gÃ¢y áº£nh hÆ°á»Ÿng rÃµ nÃ©t vÃ  máº¡nh máº½ nháº¥t Ä‘á»‘i vá»›i Kwek, giÃºp Ã´ng trá»Ÿ thÃ nh má»™t nhÃ  lÃ£nh Ä‘áº¡o tÃ i ba ngÃ y nay.\r\n\r\nÃ”ng Hong Png váº«n coi con trai cáº£ cá»§a mÃ¬nh, Kwek Leng Beng, lÃ  â€œquÃ¡ sÃ¡ch vá»Ÿ vÃ  ngÃ¢y thÆ¡â€. CÃ³ láº½ con Ä‘Æ°á»ng tá»›i thÃ nh cÃ´ng quÃ¡ váº¥t váº£ cá»§a nhÃ  sÃ¡ng láº­p táº­p Ä‘oÃ n Hong Leong (vÃ o nÄƒm 1945) Ä‘Ã£ khiáº¿n Ã´ng tin nhiá»u hÆ¡n vÃ o tÃ­nh thá»±c táº¿ hÆ¡n lÃ  lÃ½ thuyáº¿t.\r\n\r\nLuÃ´n láº¥y cha lÃ m táº¥m gÆ°Æ¡ng há»c há»i, Kwek sá»›m táº¡o Ä‘Æ°á»£c lÃ²ng tin cá»§a cha vÃ  Ä‘Æ°á»£c Ã´ng giao cho quáº£n lÃ½ khÃ¡ch sáº¡n Kingâ€™s Hotel quy mÃ´ lá»›n tá»« nÄƒm 1970, trong khi Ä‘Ã³ Ã´ng Hong Png chá»‰ quáº£n lÃ½ khÃ¡ch sáº¡n nhá» hÆ¡n lÃ  Orchid Hotel á»Ÿ Ä‘Æ°á»ng Dunearn. Kwek Leng Beng táº­p trung kinh doanh tá»›i má»©c, vÃ o tháº­p niÃªn 1970, Ã´ng thÆ°á»ng xuyÃªn ngá»“i á»Ÿ hÃ nh lang khÃ¡ch sáº¡n cá»§a mÃ¬nh á»Ÿ Havelock vÃ  cáº§u nguyá»‡n khÃ¡ch hÃ ng sáº½ dá»«ng bÆ°á»›c vÃ  Ä‘áº·t phÃ²ng. â€œKhi há» tá»›i, tÃ´i vui má»«ng vÃ´ háº¡nâ€, Kwek nhá»› láº¡i.\r\n\r\nThÃ´n tÃ­nh Ä‘á»ƒ phÃ¡t triá»ƒn\r\n\r\nLÃ  má»™t nhÃ  tÃ i phiá»‡t vÃ´ cÃ¹ng tham vá»ng, Kwek hiá»‡n váº«n Ä‘ang tiáº¿p tá»¥c nháº¯m tá»›i viá»‡c mua láº¡i cÃ¡c khÃ¡ch sáº¡n khÃ¡c trÃªn tháº¿ giá»›i nhÆ° má»™t pháº§n trong káº¿ hoáº¡ch bÃ nh trÆ°á»›ng cá»§a mÃ¬nh.\r\n\r\nHáº³n nhiá»u ngÆ°á»i váº«n chÆ°a quÃªn sá»± kiá»‡n Kwek Ä‘áº·t váº¥n Ä‘á» mua New Yorkâ€™s The Plaza cá»§a trÃ¹m Donald Trump, phÃ³ng viÃªn Má»¹ Ä‘áº·t cÃ¢u há»i liá»‡u cÃ³ pháº£i Ã´ng Ä‘á»‹nh mua khoáº£ng 49% cá»• pháº§n cá»§a toÃ  nhÃ  náº±m táº¡i trung tÃ¢m Manhattan giÃ u cÃ³ nÃ y hay khÃ´ng; khÃ´ng máº¥t má»™t giÃ¢y suy nghÄ©, Kwek tráº£ lá»i ráº±ng Ã´ng sáº½ mua toÃ n bá»™ khÃ¡ch sáº¡n.\r\n\r\nVÃ o nÄƒm 1995, Kwek cÃ¹ng vá»›i HoÃ ng tá»­ Aráº­p Alwaleed mua láº¡i khÃ¡ch sáº¡n New Yorkâ€™s The Plaza tá»« â€œtrÃ¹mâ€ tÃ i phiá»‡t báº¥t Ä‘á»™ng sáº£n Donald Trump vá»›i giÃ¡ 325 triá»‡u USD. Khoáº£ng 10 nÄƒm sau, khÃ¡ch sáº¡n nÃ y Ä‘Æ°á»£c bÃ¡n láº¡i vá»›i giÃ¡ 675 triá»‡u USD.\r\n\r\nNÄƒm 1999, Kwek Ä‘Ã¡nh báº¡i 19 Ä‘á»‘i thá»§ táº§m cá»¡ quá»‘c táº¿ trong cuá»™c Ä‘áº¥u giÃ¡ khÃ¡ch sáº¡n Seoul Hilton á»Ÿ má»©c 357 triá»‡u USD cá»§a Táº­p Ä‘oÃ n Daewoo. Äáº·c biá»‡t sÃ nh sá»i Ä‘á»‘i vá»›i cÃ¡c mÃ³n hÃ ng xa xá»‰, tá»« trang phá»¥c cho tá»›i khÃ¡ch sáº¡n, nhÃ  á»Ÿ cho tá»›i Ã´ tÃ´, Kwek thá»±c sá»± tinh tÆ°á»ng khi xÃ¡c Ä‘á»‹nh tiá»m nÄƒng phÃ¡t triá»ƒn cho máº·t hÃ ng kinh doanh cá»§a mÃ¬nh lÃ  khÃ¡ch sáº¡n cao cáº¥p. VÃ  chá»‰ trong nÄƒm 2000, Hong Leong Ä‘Ã£ sá»Ÿ há»¯u khoáº£ng 300 cÃ´ng ty, 12 trong sá»‘ Ä‘Ã³ cÃ³ tÃªn trÃªn TTCK táº¡i chÃ¢u Ã, chÃ¢u Ã‚u vÃ  Báº¯c Má»¹ vá»›i hoáº¡t Ä‘á»™ng kinh doanh chÃ­nh lÃ  báº¥t Ä‘á»™ng sáº£n vÃ  chuá»—i khÃ¡ch sáº¡n.\r\n\r\nTuy nhiÃªn, khÃ´ng vÃ¬ tháº¿ mÃ  Kwek bá» qua thá»‹ trÆ°á»ng tháº¥p cáº¥p hÆ¡n: â€œTrÃªn tháº¿ giá»›i ngÃ y nay, cÃ¡c nhÃ  Ä‘áº§u tÆ° chá»‰ thÃ­ch xÃ¢y dá»±ng khÃ¡ch sáº¡n nÄƒm sao. KhÃ´ng cÃ³ nhÃ  Ä‘áº§u tÆ° nÃ o quan tÃ¢m tá»›i khÃ¡ch du lá»‹ch vá»›i nhá»¯ng dá»‹ch vá»¥ giÃ¡ ráº». ChÃºng tÃ´i sáº½ tham gia vÃ o thá»‹ trÆ°á»ng nÃ y vÃ  cháº¯c cháº¯n sáº½ gáº·t hÃ¡i Ä‘Æ°á»£c khÃ´ng Ã­t thÃ nh cÃ´ngâ€.\r\n\r\nTriáº¿t lÃ½ lÃ m viá»‡c chÄƒm chá»‰ vÃ  cÃ³ tÃ¢m\r\n\r\nRáº¥t tháº³ng tháº¯n, quan Ä‘iá»ƒm cá»§a nhÃ  tÃ i phiá»‡t, cÅ©ng lÃ  má»™t trong ba ngÆ°á»i giÃ u nháº¥t Singapore lÃ : â€œBáº¥t ká»³ Ä‘iá»u gÃ¬ chÃºng tÃ´i lÃ m cÅ©ng cÃ³ thá»ƒ thÃ nh lá»£i nhuáº­n, nhÆ°ng khÃ´ng pháº£i lá»£i nhuáº­n lÃ  táº¥t cáº£; nÃ³ quan trá»ng Ä‘áº¥y, nhÆ°ng báº¡n cÃ²n cáº§n pháº£i cÃ³ tÃ¢m ná»¯aâ€.\r\n\r\nVá» tÃ­nh cÃ¡ch, nhÃ  tÃ i phiá»‡t Kwek lÃ  ngÆ°á»i tá»± tin vÃ  vÃ´ cÃ¹ng cá»©ng ráº¯n: â€œTÃ´i Ä‘Ã£ náº¿m Ä‘á»§ Ä‘áº¯ng cay vÃ  tÃ´i khÃ´ng ngáº¡i Ä‘á»‘i Ä‘áº§u vá»›i cÃ¡c cÃ´ng ty lá»›nâ€. Kwek cÃ²n cho ráº±ng thÃ nh cÃ´ng chÃ­nh lÃ  sá»‘ng theo triáº¿t lÃ½ theo Ä‘uá»•i vÃ  hÃ i lÃ²ng vá»›i nhá»¯ng thÃ nh tá»±u Ä‘áº¡t Ä‘Æ°á»£c, khÃ´ng nháº¥t thiáº¿t pháº£i láº¥y sá»± giÃ u cÃ³ lÃ m má»¥c tiÃªu.\r\n\r\nÄiá»u hÃ nh cÃ´ng ty vá»›i má»©c ká»· luáº­t cao, trung thÃ nh vá»›i triáº¿t lÃ½ kinh doanh, kiÃªn Ä‘á»‹nh vá»›i nhá»¯ng má»¥c tiÃªu vÃ  káº¿t há»£p hoÃ n háº£o giá»¯a Ã½ tÆ°á»Ÿng vÃ  hÃ nh Ä‘á»™ng, trong nhá»¯ng tháº­p ká»· qua, báº¥t cháº¥p nhá»¯ng yáº¿u tá»‘ khÃ³ khÄƒn do tÃ¬nh tráº¡ng cung vÆ°á»£t cáº§u vÃ  nhá»¯ng biáº¿n Ä‘á»™ng vá» sá»‘ lÆ°á»£ng khÃ¡ch du lá»‹ch, Kwek váº«n gáº·t hÃ¡i liÃªn tiáº¿p thÃ nh cÃ´ng trong ngÃ nh kinh doanh khÃ¡ch sáº¡n.\r\n\r\nChá»‰ tá»« 6 khÃ¡ch sáº¡n cá»§a gia Ä‘Ã¬nh trong nÄƒm 1989, tÃ­nh Ä‘áº¿n thá»i Ä‘iá»ƒm thÃ¡ng 8/2007, Kwek cÃ³ trong tay khoáº£ng 114 khÃ¡ch sáº¡n táº¡i 18 quá»‘c gia trÃªn 4 chÃ¢u lá»¥c. Theo Kwek, â€œÄ‘á»ƒ lá»±a chá»n con Ä‘Æ°á»ng phÃ¡t triá»ƒn sá»± nghiá»‡p sáº½ cÃ³ nhiá»u cÃ¡ch, nhÆ°ng dÃ¹ cÃ´ng viá»‡c lÃ  gÃ¬ Ä‘i chÄƒng ná»¯a thÃ¬ cÅ©ng cáº§n pháº£i cÃ³ niá»m Ä‘am mÃª, táº§m nhÃ¬n chiáº¿n lÆ°á»£c vÃ  tham vá»ng. CÃ³ thá»ƒ báº¡n khÃ´ng Ä‘áº¡t Ä‘Æ°á»£c táº¥t cáº£ nhá»¯ng gÃ¬ mong muá»‘n, nhÆ°ng náº¿u kiÃªn trÃ¬, báº¡n váº«n sáº½ thÃ nh cÃ´ng pháº§n nÃ oâ€.\r\n\r\nCÅ©ng vá»›i triáº¿t lÃ½ kinh doanh Ä‘á» cao tÃ­nh thá»±c táº¿, Kwek Ä‘áº·c biá»‡t tin ráº±ng thÃ nh cÃ´ng khÃ´ng Ä‘áº¿n vá»›i nhá»¯ng ngÆ°á»i nÃ o khÃ´ng lÃ m viá»‡c chÄƒm chá»‰. Äá»u Ä‘áº·n dáº­y tá»« 5h sÃ¡ng, Ã´ng chá»§ Táº­p Ä‘oÃ n Hong Leong lÃ m viá»‡c 12 giá» má»—i ngÃ y, sÃ¡u ngÃ y má»—i tuáº§n vÃ  sá»‘ng vá»›i phÆ°Æ¡ng chÃ¢m â€œLÃ m viá»‡c chÄƒm chá»‰, thay vÃ¬ nÃ³i hÃ£y báº¯t tay vÃ o lÃ mâ€. â€œKhÃ´ng pháº£i lÃ  tÃ´i Ä‘ang phÃ n nÃ n vÃ¬ pháº£i lÃ m viá»‡c nhiá»u. TÃ´i khÃ´ng há» sá»£ pháº£i lÃ m viá»‡c cáº­t lá»±c mÃ  Ä‘iá»u tÃ´i sá»£ lÃ  bá»‹ hiá»ƒu nháº§mâ€, Kwek tÃ¢m sá»±.\r\n\r\n(Theo VnEconomy)\r\nUp?\r\nMay\r\n26\r\nTop 10 ngÆ°á»i giÃ u nháº¥t má»i thá»i Ä‘áº¡i\r\nBy CÃ´ng Ty Truyá»n ThÃ´ng Sá»‘ iGO\r\nKhi nháº¯c Ä‘áº¿n sá»‘ tÃ i sáº£n mÃ  10 ngÆ°á»i Ä‘Ã n Ã´ng nÃ y sá»Ÿ há»¯u (táº¡i thá»i ká»³ Ä‘á»‰nh cao nháº¥t cá»§a há» vÃ  giÃ¡ trá»‹ tÃ i sáº£n cá»§a há» Ä‘Ã£ Ä‘Æ°á»£c quy ra USD táº¡i thá»i Ä‘iá»ƒm nÄƒm 2007) thÃ¬ ai cÅ©ng pháº£i kinh ngáº¡c, cho dÃ¹ trong sá»‘ há» Ä‘Ã£ cÃ³ ngÆ°á»i cháº¿t hoáº·c sá»‘ng á»Ÿ cÃ¡ch xa thá»i dáº¡i cá»§a chÃºng ta hÃ ng trÄƒm nÄƒm. Váº­y há» lÃ  ai vÃ  táº¡i sao há» láº¡i giÃ u Ä‘áº¿n má»©c váº­y?\r\n\r\n10. Carlos Slim Helu (1940 - )\r\n60 tá»· USD\r\n\r\nCarlos Slim Helu chi phá»‘i toÃ n bá»™ há»‡ thá»‘ng viá»…n thÃ´ng cá»§a Mexico. Tháº¿ nhÆ°ng Ã´ng khÃ´ng bá»‹ nhÃ¬n nháº­n nhÆ° má»™t Ã´ng trÃ¹m ghÃª gá»›m, Ä‘áº§y quyá»n lá»±c cá»§a Ä‘áº¥t nÆ°á»›c nÃ y, máº·c dÃ¹ áº£nh hÆ°á»Ÿng cá»§a Ã´ng lÃ  ráº¥t lá»›n. KhÃ´ng chá»‰ giá»›i tráº» mÃ  cáº£ cÃ¡c táº§ng lá»›p ngÆ°á»i dÃ¢n khÃ¡c nhÃ¬n nháº­n Carlos Slim lÃ  hÃ¬nh áº£nh, tháº§n tÆ°á»£ng cá»§a há». NÄƒm 2006, Helu Ä‘Ã£ thu vá» 19 tá»· USD, má»©c thu nháº­p hÃ ng nÄƒm lá»›n nháº¥t mÃ  má»™t tá»· phÃº kiáº¿m Ä‘Æ°á»£c trong 10 nÄƒm qua. Slim sá»Ÿ há»¯u má»i thá»© á»Ÿ Mexico. HÆ¡n 200 cÃ´ng ty dÆ°á»›i quyá»n quáº£n lÃ½ cá»§a Ã´ng, tá»« viá»…n thÃ´ng cho Ä‘áº¿n váº­n táº£i, tá»« thuá»‘c lÃ¡ cho Ä‘áº¿n Ä‘á»“ uá»‘ng. Carlos Slim tá»« chá»‘i danh hiá»‡u â€œngÆ°á»i Ä‘Ã n Ã´ng giÃ u nháº¥t tháº¿ giá»›i. Cho dÃ¹ Ã´ng cÃ³ cháº¥p nháº­n danh hiá»‡u nÃ y hay khÃ´ng thÃ¬ Ã´ng váº«n Ä‘Æ°á»£c coi lÃ  má»™t trong nhá»¯ng ngÆ°á»i giÃ u nháº¥t tháº¿ giá»›i má»i thá»i Ä‘áº¡i.\r\n\r\n\r\n9. Warren Buffett (1930 - )\r\n62 tá»· USD\r\n\r\nWarren Edward Buffet lÃ  má»™t nhÃ  Ä‘áº§u tÆ° chá»©ng khoÃ¡n, doanh nhÃ¢n vÃ  má»™t nhÃ  nhÃ¢n Ä‘áº¡o ngÆ°á»i Má»¹. Warren Buffet Ä‘Ã£ tÃ­ch cÃ³p Ä‘Æ°á»£c má»™t gia sáº£n khá»•ng lá»“ nhá» vÃ o nhá»¯ng Ä‘áº§u tÆ° khÃ´n ngoan thÃ´ng qua cÃ´ng ty máº¹ Berkshire Hathaway, nÆ¡i mÃ  Ã´ng lÃ  cá»• Ä‘Ã´ng lá»›n nháº¥t vÃ  cÅ©ng lÃ  giÃ¡m Ä‘á»‘c Ä‘iá»u hÃ nh. Vá»›i tÃ i sáº£n Æ°á»›c tÃ­nh khoáº£ng 62 tá»‰ Ä‘Ã´ la Má»¹, Ã´ng lÃ  ngÆ°á»i nháº¥t tháº¿ giá»›i, vÆ°á»£t qua Bill Gates, ngÆ°á»i 13 nÄƒm liÃªn tá»¥c giÃ u nháº¥t tháº¿ giá»›i.\r\n\r\n\r\n8. Sam Walton (1918 - 1992)\r\n62,1 tá»· USD\r\n\r\nSam Walton lÃ  ngÆ°á»i sÃ¡ng láº­p ra hai hÃ£ng bÃ¡n láº½ ná»•i tiáº¿ng lÃ  Wal-Mart vÃ  Samâ€™s Club. Sam Walton qua Ä‘á»i vÃ o nÄƒm 1992. Sá»± ra Ä‘i cá»§a Walton quÃ¡ sá»›m vÃ  Ã´ng khÃ´ng thá»ƒ nhÃ¬n tháº¥y Ä‘Æ°á»£c tiá»m nÄƒng, sá»± phÃ¡t triá»ƒn tháº§n ká»³ cá»§a Ä‘áº¿ cháº¿ Wal-Mart mÃ  Ã´ng Ä‘Ã£ gÃ¢y dá»±ng nÃªn, máº·c dÃ¹ Ã´ng Ä‘Ã£ gáº·t hÃ¡i Ä‘Æ°á»£c ráº¥t nhiá»u thÃ nh cÃ´ng trong thá»i ká»³ Ã´ng sá»‘ng. Gia Ä‘Ã¬nh Walton cá»§a Ã´ng lÃ  má»™t trong nhá»¯ng gia Ä‘Ã¬nh giÃ u cÃ³ vÃ  ná»•i tiáº¿ng nháº¥t tháº¿ giá»›i.\r\n\r\n\r\n7. Marshall Field (1834 - 1906)\r\n63,7 tá»· USD\r\n\r\nMarshall Field lÃ  ngÆ°á»i sang láº­p ra Marshall Field and Company, chuá»—i cá»­a hÃ ng bÃ¡ch hoÃ¡ cÃ³ trá»¥ sá»Ÿ á»Ÿ Chicago. Ã”ng lÃ  ngÆ°á»i Ä‘Ã£ Ä‘Æ°a ra triáº¿t lÃ½ â€œkhÃ¡ch hÃ ng luÃ´n luÃ´n Ä‘Ãºngâ€ vÃ  sau bao nhiÃªu nÄƒm triáº¿t lÃ½ cá»§a Ã´ng váº«n nhÆ° lÃ  má»™t chÃ¢n lÃ½ Ä‘á»‘i vá»›i nhiá»u doanh nghiá»‡p. Báº±ng chá»©ng lÃ  háº§u háº¿t khÃ¡ch hÃ ng cá»§a Ã´ng khÃ´ng bao giá» tráº£ láº¡i hÃ ng Ä‘Ã£ mua sau khi thá»i háº¡n báº£o hÃ nh Ä‘Ã£ háº¿t. ChÃ­nh sá»± hiá»ƒu biáº¿t cá»§a Ã´ng vá» dá»‹ch vá»¥ khÃ¡ch hÃ ng Ä‘Ã£ táº¡o nÃªn sá»± thÃ nh cÃ´ng vÃ  giÃ u cÃ³ cá»§a Ã´ng. NgoÃ i ra, Field cÃ²n lÃ m giÃ u nhá» vÃ o Ä‘áº§u tÆ° báº¥t Ä‘á»™ng sáº£n. Nhá»¯ng cá»­a hÃ ng, cá»­a hiá»‡u cá»§a Ã´ng Ä‘Ã£ giÃºp Ã´ng trá»Ÿ nÃªn ná»•i tiáº¿ng vÃ  Ä‘Æ°á»£c nhiá»u ngÆ°á»i biáº¿t Ä‘áº¿n.\r\n\r\n\r\n6. Frederick Weyerhaeuser (1834 - 1914)\r\n76,5 tá»· USD\r\n\r\nÃ”ng Ä‘Æ°á»£c má»‡nh danh lÃ  â€œÃ”ng Vua Gá»—â€œ. Nguá»“n gá»— cá»§a Frederick Weyerhaeuser sau Cuá»™c Ná»™i Chiáº¿n lÃ  ráº¥t Ä‘Ã¡ng ká»ƒ vÃ  nhu cáº§u vá» gá»— tÄƒng lÃªn ráº¥t nhiá»u táº¡i thá»i Ä‘iá»ƒm Ä‘Ã³. ChÃ­nh vÃ¬ nhá»¯ng lÃ½ do Ä‘Ã³ nÃªn Weyerhaeuser Ä‘Ã£ giÃ u lÃªn nhanh chÃ³ng. Weyerhaeuser Ä‘Ã£ táº¡o nÃªn nhiá»u sá»± thay Ä‘á»•i á»Ÿ Midwest, má»Ÿ ra nhiá»u cÆ¡ há»™i lÃ m nÃ´ng nghiá»‡p á»Ÿ nhiá»u khu vá»±c.\r\n\r\n\r\n5. John Jacob Astor (1763 - 1848)\r\n116,6 tá»· USD\r\n\r\nÃ”ng lÃ  triá»‡u phÃº Ä‘áº§u tiÃªn cá»§a nÆ°á»›c Má»¹. Astor giÃ u lÃªn nhá» viá»‡c kinh doanh lÃ´ng thÃº. Dáº§n dáº§n, Ã´ng Ä‘a dáº¡ng hoÃ¡ cÃ´ng viá»‡c kinh doanh, tháº­m chÃ­ Ã´ng cÃ²n bÃ¡n thuá»‘c phiá»‡n vÃ  Ã´ng cÅ©ng thÃ nh cÃ´ng trong lÄ©nh vá»±c nÃ y. Tuy nhiÃªn, nhiá»u nÄƒm sau Ä‘Ã³, Ã´ng Ä‘Ã£ tá»« bá» cÃ´ng viá»‡c kinh doanh lÃ´ng thÃº vÃ  chuyá»ƒn sang kinh doanh báº¥t Ä‘á»™ng sáº£n á»Ÿ New York.\r\n\r\n\r\n4. Bill Gates (1955 - )\r\n124 tá»· USD\r\n\r\nCho dÃ¹ tÃ i sáº£n hiá»‡n táº¡i cá»§a Bill Gates lÃ  58 tá»· USD, giáº£m xuá»‘ng so vá»›i thá»i ká»³ Ä‘á»‰nh cao cÃ¡ch Ä‘Ã¢y gáº§n 10 nÄƒm cá»§a mÃ¬nh nhÆ°ng Ã´ng váº«n náº±m trong danh sÃ¡ch nhá»¯ng ngÆ°á»i giÃ u nháº¥t má»i thá»i Ä‘áº¡i. Ã”ng chá»§ cá»§a hang pháº§n má»m Microsoft nÃ y Ä‘ang muá»‘n dÃ nh nhiá»u thá»i gian hÆ¡n vÃ o quá»¹ tÃ i trá»£ Bill vÃ  Melinda Gates.\r\n\r\n\r\n3. Cornelius Vanderbilt (1794 - 1877)\r\n178,4 tá»· USD\r\n\r\nÃ”ng vua trong ngÃ nh Ä‘Æ°á»ng sáº¯t vÃ  tÃ u thuá»·. Vanderbilt Ä‘Ã£ thÃ nh cÃ´ng vÃ  háº¡ gá»¥c Ä‘á»•i thá»§ báº±ng cÃ¡ch háº¡ giÃ¡ hÃ ng hoÃ¡, dá»‹ch vá»¥ cá»§a Ä‘á»‘i thá»§ tá»›i má»©c lá»— vá»‘n. ÄÃ¢y lÃ  cÃ¡ch lÃ m Äƒn tÃ n nháº«n Ä‘iá»ƒn hÃ¬nh cá»§a Ã´ng vÃ  Ã´ng Ä‘Ã£ lÃ m giÃ u nhá» vÃ o cÃ¡ch thá»©c nÃ y. NgÆ°á»i ta cho ráº±ng Ã´ng lÃ  má»™t doanh nhÃ¢n hay â€œchÆ¡i báº©nâ€ nhÆ°ng pháº£i thá»«a nháº­n ráº±ng Ã´ng lÃ  má»™t ngÆ°á»i ráº¥t cÃ³ Ä‘áº§u Ã³c tÃ­nh toÃ¡n.\r\n\r\n\r\n2. Andrew Carnegie (1835 - 1919)\r\n297,8 tá»· USD\r\n\r\nVÃ o nhá»¯ng nÄƒm cuá»‘i tháº¿ ká»· 19, thÃ©p lÃ  má»™t ngÃ nh kinh doanh mang láº¡i nhiá»u lá»£i nhuáº­n lÃºc báº¥y giá». ChÃ­nh thÃ©p Ä‘Ã£ khiáº¿n cho ngÆ°á»i Ä‘Ã n Ã´ng nÃ y trá»Ÿ nÃªn giÃ u cÃ³. Carnegie lÃ  ngÆ°á»i sÃ¡ng láº­p ra CÃ´ng ty ThÃ©p Carnegie vÃ  Ä‘Æ°á»£c má»‡nh danh lÃ  â€œVua ThÃ©pâ€. Ã”ng lÃ  má»™t nhÃ  háº£o tÃ¢m Ä‘áº§y lÃ²ng nhÃ¢n Ã¡i, Ã´ng Ä‘Ã£ dÃ nh háº§u háº¿t cuá»™c Ä‘á»i cá»§a mÃ¬nh Ä‘á»ƒ lÃ m cÃ´ng tÃ¡c tá»« thiá»‡n. Máº·c dÃ¹ ngÆ°á»i Ä‘Ã n Ã´ng nÃ y xuáº¥t thÃ¢n tá»« cáº£nh tháº¥p kÃ©m trong xÃ£ há»™i nhÆ°ng khÃ´ng vÃ¬ tháº¿ mÃ  Ã´ng chá»‹u thua sá»‘ pháº­n, Carnegie Ä‘Ã£ lÃ m viá»‡c chÄƒm chá»‰ vÃ  váº¥t váº£ suá»‘t thá»i thÆ¡ áº¥u cá»§a mÃ¬nh.\r\n\r\n\r\n1. John D. Rockefeller (1839 - 1937)\r\n323,4 tá»· USD\r\n\r\nÃ”ng lÃ  ngÆ°á»i sÃ¡ng láº­p ra Standard Oil vÃ o nÄƒm 1870, khÃ´ng lÃ¢u sau ngÃ y ra Ä‘á»i, cÃ´ng ty cá»§a Ã´ng Ä‘Ã£ thá»‘ng trá»‹ vÃ  Ä‘á»™c quyá»n ngÃ nh cÃ´ng nghiá»‡p dáº§u. Ã”ng Ä‘Ã³ng má»™t vai trÃ² quan trá»ng trong ngÃ nh cÃ´ng nghiá»‡p dáº§u má» thá»i sÆ¡ khai. Trong suá»‘t thá»i gian 40 nÄƒm, Rockefeller Ä‘Ã£ xÃ¢y dá»±ng Standard Oil thÃ nh cÃ´ng ty lá»›n nháº¥t vÃ  cÃ³ lá»£i nhuáº­n cao nháº¥t trÃªn tháº¿ giá»›i. Ã”ng Ä‘Ã£ tá»«ng cÃ³ thá»i lÃ  ngÆ°á»i giÃ u nháº¥t tháº¿ giá»›i. Tá»· phÃº Ä‘áº§u tiÃªn cá»§a nÆ°á»›c Má»¹ nÃ y lÃ  má»™t nhÃ  háº£o tÃ¢m, Ä‘Ã³ng gÃ³p ráº¥t nhiá»u vÃ o cho giÃ¡o dá»¥c, y táº¿ vÃ  khoa há»c.\r\n\r\n(Theo AskMen)\r\nUp?\r\nMay\r\n26\r\nâ€œTrÃ¹mâ€ khai khoÃ¡ng Ä‘i lÃªn tá»« tay tráº¯ng\r\nBy CÃ´ng Ty Truyá»n ThÃ´ng Sá»‘ iGO\r\nÃ”ng Ä‘Æ°á»£c coi lÃ  â€œÃ´ng trÃ¹mâ€ trong lÄ©nh vá»±c khai khoÃ¡ng cá»§a tháº¿ giá»›i vá»›i khá»‘i tÃ i sáº£n cÃ¡ nhÃ¢n Æ°á»›c tÃ­nh lÃªn tá»›i 1,5 tá»· USD; lÃ  nhÃ¢n váº­t Ä‘á»©ng thá»© 317 trong báº£ng xáº¿p háº¡ng tá»· phÃº cá»§a tháº¿ giá»›i cá»§a Táº¡p chÃ­ Forbes; lÃ  tháº§n tÆ°á»£ng cá»§a nhiá»u ngÆ°á»i, Ä‘áº·c biá»‡t lÃ  giá»›i tráº».\r\n\r\nÄÃ³ lÃ  Robert M.Friedland - ngÆ°á»i Ä‘Ã£ tráº£i qua nhá»¯ng bÆ°á»›c thÄƒng tráº§m hiáº¿m tháº¥y cá»§a cuá»™c Ä‘á»i, tá»« má»™t tÃ¹ nhÃ¢n mÃ£n háº¡n vá»›i hai bÃ n tay tráº¯ng nhÆ°ng báº±ng sá»± káº¿t há»£p hoÃ n háº£o giá»¯a Ã½ chÃ­ bá»n bá»‰ sáº¯t Ä‘Ã¡ vá»›i bá»™ Ã³c kinh doanh sÃ¡ng táº¡o, Ä‘Ã£ vÆ°Æ¡n lÃªn vÃ  thÃ nh cÃ´ng rá»±c rá»¡ trong lÄ©nh vá»±c khai khoÃ¡ng.\r\n\r\nÄiá»u táº¡o ra sá»± khÃ¡c biá»‡t giá»¯a Robert M. Friedland vá»›i nhá»¯ng ngÆ°á»i bÃ¬nh thÆ°á»ng chÃ­nh lÃ  kháº£ nÄƒng dÃ¡m nghÄ©, dÃ¡m lÃ m cÃ¹ng nhá»¯ng tham vá»ng lá»›n ngay tá»« khi cÃ²n tráº». Nhá» sá»›m Ä‘Æ°á»£c tráº£i nghiá»‡m tá»« cuá»™c sá»‘ng thá»±c táº¿, tá»›i Ä‘áº§u tháº­p niÃªn 80, Robert M.Friedland chÃ­nh thá»©c Ä‘áº·t chÃ¢n vÃ o lÄ©nh vá»±c khai thÃ¡c, kinh doanh khoÃ¡ng sáº£n vÃ  kháº³ng Ä‘á»‹nh kháº£ nÄƒng táº¡i cÃ¡c khu má» phÃ­a TÃ¢y Báº¯c nÆ°á»›c Má»¹.\r\n\r\nSau khi thÃ nh láº­p doanh nghiá»‡p khai khoÃ¡ng Ivanhoe Mines Ltd, Robert M.Friedland má»Ÿ rá»™ng thá»‹ trÆ°á»ng khai thÃ¡c ra nhiá»u quá»‘c gia vÃ  khu vá»±c trÃªn tháº¿ giá»›i. Hiá»‡n nay, vá»›i cÃ¡c cÃ´ng ty Ä‘áº§u má»‘i Ä‘áº·t táº¡i Vancouver, Canada vÃ  chi nhÃ¡nh Ivanhoe Energy, Ivanhoe Corporation hoáº¡t Ä‘á»™ng trong lÄ©nh vá»±c khai thÃ¡c dáº§u khÃ­, hÃ³a dáº§u, gas, khÃ­ Ä‘á»‘t, kim cÆ°Æ¡ng, vÃ ng... trÃªn pháº¡m vi nhiá»u quá»‘c gia khu vá»±c chÃ¢u Má»¹, chÃ¢u Phi vÃ  chÃ¢u Ã. Trong Ä‘Ã³, Ivanhoe Mines Ltd. lÃ  má»™t tÃªn tuá»•i lá»›n trong lÄ©nh vá»±c khai khoÃ¡ng cá»§a tháº¿ giá»›i.\r\n\r\nThay Ä‘á»•i Ä‘á»ƒ thÃ­ch á»©ng vÃ  nÃ¢ng táº§m chiáº¿n lÆ°á»£c\r\n\r\nBÆ°á»›c vÃ o nÄƒm 2008, cÃ¹ng vá»›i nhá»¯ng biáº¿n Ä‘á»™ng trÃªn thá»‹ trÆ°á»ng dáº§u vÃ  vÃ ng báº¡c tháº¿ giá»›i, Ivanhoe Mines Ltd. thuá»™c quyá»n Ä‘iá»u hÃ nh cá»§a nhÃ  tá»· phÃº ngÆ°á»i Má»¹, cÅ©ng Ä‘Ã£ cÃ³ nhá»¯ng Ä‘á»™ng thÃ¡i Ä‘iá»u chá»‰nh vá» chiáº¿n lÆ°á»£c. Má»¥c Ä‘Ã­ch lÃ  Ä‘á»ƒ mang láº¡i cho Ivanhoe Mines Ltd. nhá»¯ng triá»ƒn vá»ng phÃ¡t triá»ƒn má»›i vÃ  cÅ©ng Ä‘á»ƒ thá»ƒ hiá»‡n rÃµ nhá»¯ng tham vá»ng ngÃ y má»™t lá»›n cá»§a Ä‘Æ°Æ¡ng kim Chá»§ tá»‹ch Robert M.Friedland.\r\n\r\nNgÃ y 18/3 vá»«a qua, thÃ´ng tin vá» sá»± kiá»‡n Robert M.Friedland Ä‘Æ°á»£c báº§u vÃ o vá»‹ trÃ­ chá»§ tá»‹ch cá»§a má»™t trong nhá»¯ng chi nhÃ¡nh lá»›n nháº¥t cá»§a Táº­p Ä‘oÃ n Ivanhoe Mines Ltd., Ä‘Ã£ Ä‘Æ°á»£c Ä‘Äƒng táº£i trÃªn cÃ¡c tá» bÃ¡o lá»›n cá»§a nhiá»u quá»‘c gia trÃªn tháº¿ giá»›i. Äiá»u nÃ y cho tháº¥y kháº£ nÄƒng vÃ  táº§m áº£nh hÆ°á»Ÿng máº¡nh máº½ cá»§a Robert M. Friedland táº¡i táº­p Ä‘oÃ n khai khoÃ¡ng hÃ ng Ä‘áº§u tháº¿ giá»›i do Ã´ng sÃ¡ng láº­p vÃ  Ä‘iá»u hÃ nh.\r\n\r\nNÄƒm 1988, sau khi thÃ nh láº­p Ivanhoe Mines Ltd., Robert M. Friedland Ä‘Ã£ náº¯m giá»¯ vá»‹ trÃ­ Chá»§ tá»‹ch Táº­p Ä‘oÃ n kiÃªm Chá»§ tá»‹ch chi nhÃ¡nh Ivanhoe Capital Corporation vÃ  cuá»‘i cÃ¹ng lÃ  Chi nhÃ¡nh Ivanhoe Energy Inc. Vá»›i hoáº¡t Ä‘á»™ng chá»§ yáº¿u lÃ  khai thÃ¡c dáº§u vÃ  khÃ­ Ä‘á»‘t táº¡i vá»‹nh San Joaquin cá»§a California, vá»‹nh Sacramento Gas, vá»‹nh Permian Basin cá»§a Texas vÃ  tá»‰nh Há»“ Báº¯c vÃ  Tá»© XuyÃªn cá»§a Trung Quá»‘c, Ivanhoe Energy Inc. lÃ  má»™t doanh nghiá»‡p lá»›n trong lÄ©nh vá»±c khai thÃ¡c dáº§u khÃ­ vÃ  Ä‘Æ°á»£c trang bá»‹ nhiá»u loáº¡i trang thiáº¿t bá»‹ cÃ´ng nghá»‡ hÃ³a dáº§u hiá»‡n Ä‘áº¡i nhÆ° cÃ´ng nghá»‡ khai thÃ¡c dáº§u náº·ng hay cÃ´ng nghá»‡ sáº£n xuáº¥t nhá»±a tá»•ng há»£p tá»« khÃ­ gas.\r\n\r\nTheo dá»± bÃ¡o cá»§a nhiá»u chuyÃªn gia trong lÄ©nh vá»±c khai thÃ¡c nÄƒng lÆ°á»£ng thÃ¬ viá»‡c tiáº¿p quáº£n ngÃ´i vá»‹ chá»§ tá»‹ch sáº½ lÃ  bÆ°á»›c khá»Ÿi Ä‘áº§u cho nhá»¯ng tÃ­nh toÃ¡n chiáº¿n lÆ°á»£c cá»§a Robert M.Friedland nháº±m Ä‘áº©y máº¡nh cÃ¡c dá»± Ã¡n khai thÃ¡c dáº§u trong thá»i gian tá»›i vÃ  tiáº¿n hÃ nh má»™t loáº¡t cÃ¡c chÆ°Æ¡ng trÃ¬nh cáº£i tá»•, bá»• sung cÃ´ng nghá»‡ má»›i, liÃªn káº¿t vÃ  tÄƒng cÆ°á»ng há»‡ thá»‘ng quáº£n lÃ­ cá»§a doanh nghiá»‡p.\r\n\r\nNgÃ y 31/3/2008, theo cÃ´ng bá»‘ cá»§a Gene Wusaty, GiÃ¡m Ä‘á»‘c Ä‘iá»u hÃ nh cá»§a SouthGobi Energy Resorces - má»™t chi nhÃ¡nh chá»§ chá»‘t cá»§a Ivanhoe Mines Ltd. Ä‘áº·t táº¡i MÃ´ng Cá»•, doanh nghiá»‡p tiáº¿p tá»¥c Ä‘Æ°á»£c Bá»™ trÆ°á»Ÿng Bá»™ CÃ´ng nghiá»‡p vÃ  ThÆ°Æ¡ng máº¡i MÃ´ng Cá»• cáº¥p giáº¥y phÃ©p cho dá»± Ã¡n khai thÃ¡c khoÃ¡ng sáº£n táº¡i khu má» Ovoot Tolgoi náº±m á»Ÿ phÃ­a Nam nÆ°á»›c nÃ y. LÃ  má»™t trong nhá»¯ng dá»± Ã¡n trá»ng Ä‘iá»ƒm cá»§a Ivanhoe Mines Ltd., cÃ¡ch biÃªn giá»›i Trung Quá»‘c 45 km, dá»± Ã¡n Ovoot Tolgoi báº¯t Ä‘áº§u Ä‘Æ°á»£c khá»Ÿi Ä‘á»™ng tá»« thÃ¡ng 5/2007 vÃ  sau gáº§n 1 nÄƒm giáº£i quyáº¿t váº¥n Ä‘á» vá» mÃ´i trÆ°á»ng Ä‘Ã£ Ä‘Æ°á»£c cáº¥p phÃ©p hoáº¡t Ä‘á»™ng.\r\n\r\nTrÃªn cÆ¡ sá»Ÿ táº­n dá»¥ng nhá»¯ng tháº¿ máº¡nh vá» nguá»“n nhÃ¢n lá»±c dá»“i dÃ o cá»§a Ä‘á»‹a phÆ°Æ¡ng káº¿t há»£p vá»›i cÃ¡c chÆ°Æ¡ng trÃ¬nh liÃªn káº¿t há»— trá»£ cÃ¡c loáº¡i thiáº¿t bá»‹ cÃ´ng nghá»‡ hiá»‡n Ä‘áº¡i má»›i cá»§a cÃ¡c doanh nghiá»‡p SouthGobi Region, Mineral Resorces vÃ  Petrolium Aurthority, khi dá»± Ã¡n Ovoot Tolgoi chÃ­nh thá»©c Ä‘i vÃ o hoáº¡t Ä‘á»™ng, SouthGobi Energy Resorces cÃ³ thá»ƒ Ä‘á»“ng loáº¡t triá»ƒn khai cÃ¡c hoáº¡t Ä‘á»™ng khai thÃ¡c vÃ ng, sáº£n xuáº¥t Ä‘iá»‡n nÄƒng cung cáº¥p cho thá»‹ trÆ°á»ng MÃ´ng Cá»• vÃ  Trung Quá»‘c.\r\n\r\nGáº§n Ä‘Ã¢y nháº¥t, ngÃ y 10/4/2008, Ivanhoe Mines Ltd. tiáº¿p tá»¥c cÃ´ng bá»‘ thÃ´ng tin vá» chÆ°Æ¡ng trÃ¬nh há»£p tÃ¡c lá»›n vá»›i Táº­p Ä‘oÃ n vÃ ng báº¡c quá»‘c gia Trung Quá»‘c China National Gold Group. Theo Ä‘Ã³, Ivanhoe Mines Ltd. sáº½ bÃ¡n 42% cá»• pháº§n Ä‘ang náº¯m giá»¯ táº¡i chi nhÃ¡nh Jin Shan Gold Mines cho China National Gold Group vÃ  tiáº¿n hÃ nh má»™t chÆ°Æ¡ng trÃ¬nh liÃªn káº¿t khai thÃ¡c thá»‹ trÆ°á»ng Trung Quá»‘c.\r\n\r\nNgay tá»« nÄƒm 2002, sau khi náº±m hoÃ n toÃ n dÆ°á»›i sá»± kiá»ƒm soÃ¡t cá»§a Ivanhoe Mines Ltd., Jin Shan Gold Mines Ä‘Ã£ trá»Ÿ thÃ nh má»™t mÅ©i nhá»n quan trá»ng náº±m trong chiáº¿n lÆ°á»£c khuáº¿ch trÆ°Æ¡ng vÃ  má»Ÿ rá»™ng hoáº¡t Ä‘á»™ng táº¡i thá»‹ trÆ°á»ng Trung Quá»‘c cá»§a Robert M.Friedland. Vá»›i tham vá»ng tá»« Trung Quá»‘c vÆ°Æ¡n ra thá»‹ trÆ°á»ng khu vá»±c chÃ¢u Ã-TBD, chiáº¿n lÆ°á»£c liÃªn káº¿t vá»›i China National Gold Group vá»«a Ä‘áº£m báº£o nÃ¢ng cao Ä‘Æ°á»£c tiá»m lá»±c tÃ i chÃ­nh, vá»«a cÃ³ Ä‘Æ°á»£c sá»± bá»• sung quan trá»ng vá» cÃ´ng nghá»‡ vÃ  sá»± há»— trá»£ cáº§n thiáº¿t vá» chÃ­nh sÃ¡ch cho Ivanhoe Mines Ltd. trong thá»i gian tá»›i.\r\n\r\nÄÃ¡nh giÃ¡ vá» chÆ°Æ¡ng trÃ¬nh há»£p tÃ¡c nÃ y, Robert M.Friedland ráº¥t láº¡c quan tuyÃªn bá»‘: â€œÄÃ¢y lÃ  bÆ°á»›c khá»Ÿi Ä‘áº§u quan trá»ng cho chÆ°Æ¡ng trÃ¬nh há»£p tÃ¡c chung cá»§a hai doanh nghiá»‡p Ä‘á»ƒ hÆ°á»›ng tá»›i chiáº¿n lÆ°á»£c khai thÃ¡c thá»‹ trÆ°á»ng vÃ ng báº¡c Trung Quá»‘c trong tÆ°Æ¡ng lai dÃ i, tá»«ng bÆ°á»›c tiáº¿n tá»›i má»¥c tiÃªu xÃ¢y dá»±ng má»™t trung tÃ¢m sáº£n xuáº¥t vÃ ng báº¡c cá»§a khu vá»±c vÃ  tháº¿ giá»›iâ€.\r\n\r\nVÆ°á»£t lÃªn nhá»¯ng láº§m lá»¡ cá»§a tuá»•i tráº»\r\n\r\nÄá»©ng trÃªn Ä‘á»‰nh cao cá»§a tiá»n tÃ i, danh vá»ng vÃ  lÃ  má»™t trong sá»‘ Ã­t nhá»¯ng doanh nhÃ¢n cá»§a Má»¹ thÃ nh cÃ´ng tá»« lÄ©nh vá»±c khai khoÃ¡ng, Robert M. Friedland cÅ©ng lÃ  má»™t trong sá»‘ Ã­t nhá»¯ng doanh nhÃ¢n cá»§a tháº¿ giá»›i Ä‘i lÃªn tá»« nhá»¯ng sai láº§m cá»§a tuá»•i tráº».\r\n\r\nSinh nÄƒm 1951 táº¡i Chicago vÃ  lá»›n lÃªn táº¡i Boston trong má»™t gia Ä‘Ã¬nh cÃ³ bá»‘ lÃ  má»™t kiáº¿n trÃºc sÆ° ngÆ°á»i Äá»©c nháº­p cÆ°, khi cÃ²n lÃ  há»c sinh cá»§a trÆ°á»ng trung há»c Bowdoin College táº¡i Brunswick, Robert M. Friedland Ä‘Ã£ bá»™c lá»™ nhá»¯ng tá»‘ cháº¥t thÃ´ng minh hÆ¡n ngÆ°á»i vá»›i káº¿t quáº£ há»c táº­p ráº¥t cao vÃ  lÃ  má»™t trong nhá»¯ng há»c sinh tÃ­ch cá»±c nháº¥t trong phong trÃ o pháº£n Ä‘á»‘i cuá»™c chiáº¿n tranh cá»§a Má»¹ táº¡i Viá»‡t Nam.\r\n\r\nTá»‘t nghiá»‡p trung há»c, Robert M. Friedland thi Ä‘á»— vÃ o TrÆ°á»ng Reed College táº¡i Oregon (Má»¹) vÃ  sau Ä‘Ã³ tá»›i áº¤n Äá»™ nghiÃªn cá»©u Ä‘áº¡o Pháº­t. Khoáº£ng thá»i gian sá»‘ng vÃ  nghiÃªn cá»©u táº¡i áº¤n Äá»™ tuy khÃ´ng dÃ i nhÆ°ng nhá»¯ng chuyáº¿n Ä‘i nghiÃªn cá»©u, kháº£o sÃ¡t trong chÆ°Æ¡ng trÃ¬nh há»c Ä‘Ã£ lÃ m cho Robert M. Friedland hiá»ƒu hÆ¡n vá» nhá»¯ng khÃ³ nhá»c cá»§a cuá»™c sá»‘ng. CÅ©ng báº¯t Ä‘áº§u tá»« Ä‘Ã¢y, nhá»¯ng tham vá»ng vá» má»™t tÆ°Æ¡ng lai kinh doanh Ä‘Ã£ hÃ¬nh thÃ nh trong Ä‘áº§u Robert M. Friedland vÃ  cáº­u quyáº¿t tÃ¢m báº±ng má»i giÃ¡ sáº½ thá»±c hiá»‡n cho báº±ng Ä‘Æ°á»£c.\r\n\r\nVÃ o nÄƒm 1970, ká»· niá»‡m Ä‘Ã¡ng buá»“n nháº¥t trong cuá»™c Ä‘á»i Robert M. Friedland Ä‘Ã£ xáº£y ra khi cáº­u bá»‹ báº¯t giam 6 thÃ¡ng táº¡i nhÃ  tÃ¹ Volkswagen. Khi Ä‘Ã³ má»›i trÃ²n 19 tuá»•i vÃ  lÃ  sinh viÃªn nÄƒm thá»© hai cá»§a TrÆ°á»ng Reed College, do ham kiáº¿m tiá»n, Robert M. Friedland Ä‘Ã£ cÃ¹ng má»™t ngÆ°á»i báº¡n cÃ¹ng lá»›p buÃ´n 80.000 viÃªn thuá»‘c gÃ¢y áº£o giÃ¡c LSD, má»™t loáº¡i thuá»‘c bá»‹ ChÃ­nh phá»§ Má»¹ cáº¥m. Sau khi bá»‹ FBI báº¯t giá»¯, Robert M.Friedland Ä‘Ã£ bá»‹ tÃ²a káº¿t Ã¡n 6 thÃ¡ng tÃ¹ giam táº¡i nhÃ  tÃ¹ Volkswagen. Káº¿t thÃºc thá»i gian cáº£i táº¡o, Robert M.Friedland tiáº¿p tá»¥c theo há»c Ä‘áº¡i há»c vÃ  tá»‘t nghiá»‡p vá»›i báº£n luáº­n vÄƒn â€œMÃ´ hÃ¬nh xÃ£ há»™i chá»§ nghÄ©a dÃ¢n chá»§ vÃ  nhÃ¢n vÄƒn táº¡i Tanzaniaâ€.\r\n\r\nVá»›i hai bÃ n tay tráº¯ng, Robert M.Friedland Ä‘Ã£ tá»›i khu má» khai thÃ¡c vÃ ng táº¡i phÃ­a TÃ¢y Báº¯c nÆ°á»›c Má»¹, khu vá»±c cÃ³ phong trÃ o khai thÃ¡c vÃ ng ráº¥t ráº§m rá»™ trong thá»i Ä‘iá»ƒm Ä‘Ã³. Máº·c dÃ¹ chá»‰ lÃ  má»™t â€œtÃ¢n binhâ€ trong Ä‘á»™i quÃ¢n tÃ¬m vÃ ng song Robert M. Friedland láº¡i cÃ³ Ä‘Æ°á»£c bá»™ Ã³c tÆ° duy sÃ¡ng táº¡o vÃ  kháº£ nÄƒng phÃ¡t hiá»‡n cÆ¡ há»™i kinh doanh vÆ°á»£t trá»™i so vá»›i nhá»¯ng ngÆ°á»i xung quanh. Trong khi má»i ngÆ°á»i Ä‘á»• xÃ´ Ä‘i tÃ¬m vÃ ng thÃ¬ Robert M. Friedland láº¡i nghÄ© tá»›i viá»‡c vay tiá»n Ä‘á»ƒ mua láº¡i khu má» vÃ ng Oregon bá»‹ bá» hoang cá»§a CÃ´ng ty Galactic Ä‘á»ƒ cáº£i táº¡o vÃ  Ä‘Æ°a vÃ o khai thÃ¡c.\r\n\r\nDá»“n táº¥t cáº£ cÃ¡c nguá»“n vá»‘n Ä‘i vay Ä‘Æ°á»£c tá»« ngÆ°á»i thÃ¢n, há» hÃ ng, Robert M. Friedland cho nháº­p vá» má»™t sá»‘ loáº¡i trang thiáº¿t bá»‹ cÃ´ng nghá»‡ khai khoÃ¡ng khÃ¡ hiá»‡n Ä‘áº¡i, thuÃª nhÃ¢n cÃ´ng vÃ  báº¯t tay vÃ o khai thÃ¡c. Nhá» nhá»¯ng bÆ°á»›c Ä‘áº§u tÆ° Ä‘Ãºng hÆ°á»›ng, hoáº¡t Ä‘á»™ng cá»§a doanh nghiá»‡p ngÃ y cÃ ng trá»Ÿ nÃªn hiá»‡u quáº£. Tá»›i nÄƒm 1984, Robert M. Friedland tiáº¿p tá»¥c mua vá» khu má» Summitville vÃ  Ä‘á»•i tÃªn CÃ´ng ty Galactic trÆ°á»›c Ä‘Ã¢y thÃ nh doanh nghiá»‡p khai khoÃ¡ng Galactic Resources Limited cÃ³ chá»©c nÄƒng vá»«a khai thÃ¡c vÃ ng vá»«a sáº£n xuáº¥t hÃ³a cháº¥t.\r\n\r\nTÃ­nh trong khoáº£ng thá»i gian tá»« nÄƒm 1984 tá»›i nÄƒm 1992, tá»•ng sáº£n lÆ°á»£ng vÃ ng mÃ  Galactic Resources Limited khai thÃ¡c vÃ  cung cáº¥p Ä‘Æ°á»£c cho thá»‹ trÆ°á»ng Ä‘Ã£ tÆ°Æ¡ng Ä‘Æ°Æ¡ng vá»›i 81 triá»‡u USD. Tuy nhiÃªn, do Ä‘Ã³ng gáº§n khu vá»±c sÃ´ng Alamosa vÃ  sÃ´ng Terrace Reservoir nÃªn hoáº¡t Ä‘á»™ng cá»§a Galactic Resources Limited Ä‘Ã£ tÃ¡c Ä‘á»™ng vÃ  há»§y hoáº¡i nghiÃªm trá»ng mÃ´i trÆ°á»ng sá»‘ng cÃ¹ng nhiá»u loÃ i sinh váº­t. Do Ä‘Ã³, tá»›i nÄƒm 1992, ChÃ­nh phá»§ Ä‘Ã£ buá»™c Robert M. Friedland pháº£i tuyÃªn bá»‘ giáº£i thá»ƒ Galactic Resources Limited vÃ  bá»“i thÆ°á»ng khoáº£n tiá»n hÃ ng triá»‡u USD cho viá»‡c tÃ¡i táº¡o mÃ´i trÆ°á»ng sá»‘ng tá»± nhiÃªn.\r\n\r\nXÃ¢y dá»±ng táº­p Ä‘oÃ n khai khoÃ¡ng Ivanhoe Mines\r\n\r\nSau khi giáº£i thá»ƒ Galactic Resources Ltd, Robert M. Friedland tiáº¿p tá»¥c tiáº¿n hÃ nh chÆ°Æ¡ng trÃ¬nh Ä‘áº§u tÆ° vÃ o dá»± Ã¡n khai thÃ¡c kim cÆ°Æ¡ng cá»§a doanh nghiá»‡p Rutherford Ventures Corp thuá»™c quyá»n sá»Ÿ há»¯u cá»§a Jean Boulle táº¡i cÃ¡c khu má» á»Ÿ má»™t sá»‘ quá»‘c gia thuá»™c khu vá»±c chÃ¢u Phi nhÆ° Zaire, Sierra Leone, Namibia... vÃ  thu Ä‘Æ°á»£c thÃªm má»™t sá»‘ thÃ nh cÃ´ng Ä‘Ã¡ng ká»ƒ. Tá»›i nÄƒm 1996, nháº±m Ä‘áº©y máº¡nh cÃ¡c dá»± Ã¡n khai khoÃ¡ng táº¡i cÃ¡c khu vá»±c cÃ³ trá»¯ lÆ°á»£ng lá»›n trÃªn tháº¿ giá»›i, Robert M.Friedland Ä‘Ã£ thÃ nh láº­p CÃ´ng ty khai khoÃ¡ng Ivanhoe Mines Ltd Ä‘áº·t trá»¥ sá»Ÿ chÃ­nh táº¡i Toronto, Canada.\r\n\r\nBáº±ng kinh nghiá»‡m vÃ  kháº£ nÄƒng phÃ¡n Ä‘oÃ¡n chÃ­nh xÃ¡c cá»§a mÃ¬nh, Robert M. Friedland láº§n lÆ°á»£t tÃ¬m ra nhá»¯ng khu má» Ä‘Ã¡ng giÃ¡ táº¡i cÃ¡c quá»‘c gia chÃ¢u Ã, chÃ¢u Phi vÃ  chÃ¢u Má»¹. ThÃ´ng qua cÃ¡c chÆ°Æ¡ng trÃ¬nh thu hÃºt vá»‘n Ä‘áº§u tÆ° cá»§a cÃ¡c doanh nghiá»‡p Ä‘á»‹a phÆ°Æ¡ng nhÆ° Royal Plastics, Shanghai Land, China Disabled Persons Federation, Rio Tinto Zinc, Voisey Bay..., Robert M. Friedland Ä‘Ã£ táº¡o cho Ivanhoe Mines Ltd nhá»¯ng nguá»“n vá»‘n bá»• sung Ä‘Ã¡ng ká»ƒ, Ä‘á»“ng thá»i cÃ³ thá»ƒ Ä‘Æ°a cÃ¡c dá»± Ã¡n trá»ng Ä‘iá»ƒm Ä‘i vÃ o hoáº¡t Ä‘á»™ng á»•n Ä‘á»‹nh ngay tá»« giai Ä‘oáº¡n Ä‘áº§u.\r\n\r\nNgoÃ i kháº£ nÄƒng huy Ä‘á»™ng vá»‘n vÃ  phÃ¡n Ä‘oÃ¡n chÃ­nh xÃ¡c cÃ¡c nguá»“n khoÃ¡ng sáº£n, Robert M.Friedland cÃ²n Ä‘Æ°á»£c coi lÃ  â€œNgÆ°á»i tiÃªn phong trong á»©ng dá»¥ng cÃ´ng nghá»‡ hiá»‡n Ä‘áº¡i vÃ o lÄ©nh vá»±c khai khoÃ¡ngâ€. Trong khi pháº§n lá»›n cÃ¡c doanh nghiá»‡p khai khoÃ¡ng khÃ¡c váº«n chá»§ yáº¿u chá»‰ sá»­ dá»¥ng nhá»¯ng trang thiáº¿t bá»‹ thÃ´ sÆ¡ vÃ  chá»‰ táº­p trung vÃ o khai thÃ¡c má»™t loáº¡i khoÃ¡ng sáº£n nháº¥t Ä‘á»‹nh thÃ¬ Robert M.Friedland Ä‘Ã£ cÃ³ trong tay nhá»¯ng loáº¡i trang thiáº¿t bá»‹ khai thÃ¡c tiÃªn tiáº¿n trá»‹ giÃ¡ hÃ ng triá»‡u USD. ÄÃ¢y chÃ­nh lÃ  â€œchÃ¬a khÃ³aâ€ giÃºp Ivanhoe Mines Ltd. vá»«a khai thÃ¡c má»™t cÃ¡ch hiá»‡u quáº£ nhá»¯ng loáº¡i khoÃ¡ng sáº£n chÃ­nh nhÆ° vÃ ng, kim cÆ°Æ¡ng, dáº§u má», vá»«a táº­n dá»¥ng khai thÃ¡c Ä‘Æ°á»£c thÃªm nhiá»u loáº¡i khoÃ¡ng sáº£n nhÆ° Ä‘á»“ng, nhá»±a dáº»o vÃ  hÃ³a cháº¥t.\r\n\r\nSau hÆ¡n 3 tháº­p ká»· hoáº¡t Ä‘á»™ng liÃªn tá»¥c trong lÄ©nh vá»±c khai khoÃ¡ng, Robert M.Friedland Ä‘Ã£ xÃ¢y dá»±ng thÃ nh cÃ´ng táº­p Ä‘oÃ n khai khoÃ¡ng khá»•ng lá»“ Ivanhoe Mines Ltd. vá»›i hÃ ng trÄƒm chi nhÃ¡nh lá»›n nhá» hoáº¡t Ä‘á»™ng táº¡i nhiá»u quá»‘c gia thuá»™c cÃ¡c chÃ¢u lá»¥c khÃ¡c nhau nhÆ° Trung Quá»‘c, MÃ´ng Cá»•, Australia, Má»¹, Canada, Kazakhstan, ChilÃª, Namibia...\r\n\r\nBÃªn cáº¡nh cÃ¡c hoáº¡t Ä‘á»™ng khai thÃ¡c khoÃ¡ng sáº£n, Ivanhoe Mines Ltd. cÃ²n má»Ÿ rá»™ng hoáº¡t Ä‘á»™ng sang lÄ©nh vá»±c Ä‘áº§u tÆ° tÃ i chÃ­nh, báº¥t Ä‘á»™ng sáº£n vÃ  sáº£n xuáº¥t cÃ¡c loáº¡i Ä‘á»“ trang sá»©c vÃ ng báº¡c vÃ  kim cÆ°Æ¡ng. NgoÃ i vá»‹ trÃ­ Ä‘á»©ng Ä‘áº§u táº­p Ä‘oÃ n Ivanhoe Mines Ltd., hiá»‡n nay Robert M. Friedland cÅ©ng Ä‘ang náº¯m giá»¯ nhiá»u vá»‹ trÃ­ chá»§ chá»‘t trong cÃ¡c táº­p Ä‘oÃ n cÃ´ng nghiá»‡p khÃ¡c nhÆ° African Minerals, Tocqueville Gold, Scudder Gold & Precious Metals...\r\n\r\n(Theo VnEconomy)',NULL,'',NULL,2,1),
 (3,1,'TGÄ Rino Mastrotto Viá»‡t Nam - Kinh doanh báº±ng sá»± Ä‘am mÃª vÃ  sÃ¡ng táº¡o',NULL,'TGÄ Rino Mastrotto Viá»‡t Nam - Kinh doanh báº±ng sá»± Ä‘am mÃª vÃ  sÃ¡ng táº¡o\r\nTHá»¨ NÄ‚M, 04 THÃNG 2 2010 11:48   \r\nCÃ³ Ä‘Æ°á»£c thÃ nh cÃ´ng ngÃ y hÃ´m nay lÃ  do kiáº¿n thá»©c, sá»± chÃ¢n thÃ nh, khiÃªm tá»‘n vÃ  sá»± cá»‘ gáº¯ng cá»§a tÃ´i mang',NULL,'TGÄ Rino Mastrotto Viá»‡t Nam - Kinh doanh báº±ng sá»± Ä‘am mÃª vÃ  sÃ¡ng táº¡o\r\nTHá»¨ NÄ‚M, 04 THÃNG 2 2010 11:48   \r\nCÃ³ Ä‘Æ°á»£c thÃ nh cÃ´ng ngÃ y hÃ´m nay lÃ  do kiáº¿n thá»©c, sá»± chÃ¢n thÃ nh, khiÃªm tá»‘n vÃ  sá»± cá»‘ gáº¯ng cá»§a tÃ´i mang láº¡i, nhÆ°ng táº¥t nhiÃªn lÃ  khÃ´ng thá»ƒ thiáº¿u sá»± may máº¯n.\r\n\r\nBa nÄƒm vá» trÆ°á»›c, khi Ä‘áº¿n Viá»‡t Nam tÃ¬m hiá»ƒu cÃ´ng viá»‡c, Michele Ä‘Ã£ khÃ´ng hÃ¬nh dung mÃ¬nh sáº½ sá»›m quay láº¡i vÃ  trá»Ÿ thÃ nh má»™t doanh nhÃ¢n thÃ nh Ä‘áº¡t cá»§a quá»‘c gia thÃ¢n thiá»‡n nÃ y. CÃ¢u chuyá»‡n kinh doanh cá»§a anh lÃ  má»™t chuá»—i nhá»¯ng Ä‘iá»u thÃº vá»‹. Sá»± thÃº vá»‹ áº¥y khÃ´ng pháº£i Ä‘áº¿n tá»« cÃ´ng viá»‡c mÃ  tá»« chÃ­nh báº£n thÃ¢n anh, má»™t ngÆ°á»i chÄƒm chá»‰ vÃ  Ä‘áº§y tinh tháº§n láº¡c quan.\r\n\r\nHá»c, há»c ná»¯a vÃ  há»c mÃ£i, chÃ­nh lÃ  Ä‘iá»u mÃ  Michele luÃ´n náº±m lÃ²ng. Äá»ƒ trá»Ÿ thÃ nh má»™t chuyÃªn gia cá»§a má»™t táº­p Ä‘oÃ n hÃ ng Ä‘áº§u ngÃ nh da vÃ  lÃ  má»™t doanh nhÃ¢n thÃ nh Ä‘áº¡t, anh Ä‘Ã£ pháº£i khÃ´ng ngá»«ng há»c há»i, trau dá»“i kiáº¿n thá»©c. Anh sinh ra trong má»™t gia Ä‘Ã¬nh cÃ³ truyá»n thá»‘ng kinh doanh táº¡i thÃ nh phá»‘ Matera vá»›i nhá»¯ng tÃ²a nhÃ  Ä‘Æ°á»£c xÃ¢y báº±ng Ä‘Ã¡ tráº¯ng tuyá»‡t Ä‘áº¹p, vÃ  lÃ  má»™t thÃ nh phá»‘ cá»• ná»•i tiáº¿ng cá»§a Ã - thÃ nh phá»‘ Sassi, Ä‘Æ°á»£c Unesco cÃ´ng nháº­n lÃ  Di sáº£n tháº¿ giá»›i. Khi cÃ²n nhá», Michele lÃ  cáº­u bÃ© ráº¥t thÃ´ng minh vÃ  nhanh nháº¹n, Michele ráº¥t yÃªu bÃ³ng Ä‘Ã¡ vÃ  cÃ³ Æ°á»›c mÆ¡ sáº½ trá»Ÿ thÃ nh má»™t cáº§u thá»§ ná»•i tiáº¿ng. Tuy nhiÃªn, cha cá»§a Michele lÃ  má»™t doanh nhÃ¢n Ä‘Ã£ hÆ°á»›ng con trai theo ngÃ nh kinh táº¿ mÃ  Ã´ng cho ráº±ng sáº½ phÃ¹ há»£p vá»›i tÆ°Æ¡ng lai cá»§a con mÃ¬nh hÆ¡n. Anh Ä‘Ã£ há»c kinh táº¿ á»Ÿ Ä‘áº¡i há»c Luiss, táº¡i Rome. Sau khi tá»‘t nghiá»‡p, anh vá» lÃ m viá»‡c táº¡i má»™t cÆ¡ sá»Ÿ lÃ m sofa báº±ng da cá»§a Ã, á»Ÿ Ä‘Ã¢y anh báº¯t Ä‘áº§u nghiÃªn cá»©u vÃ  hiá»ƒu biáº¿t vá» ngÃ nh da.\r\n\r\nNgá»“i bÃªn chiáº¿c bÃ n gá»— trong  vÄƒn phÃ²ng cá»§a mÃ¬nh á»Ÿ táº§ng 18, má»™t khu cÄƒn há»™ cao cáº¥p náº±m ngay khu trung tÃ¢m InterContinental Asiana Saigon Residences, thÃ nh phá»‘ Há»“ ChÃ­ Minh, vá»›i cÆ°Æ¡ng vá»‹ Tá»•ng giÃ¡m Ä‘á»‘c, anh vá»«a chá»‰ lÃªn báº£n Ä‘á»“ Ä‘áº§y mÃ u sáº¯c vá»«a giá»›i thiá»‡u cÃ´ng ty anh Ä‘Ã£ cÃ³ máº·t ráº£i rÃ¡c á»Ÿ 6 nÆ°á»›c khÃ¡c nhau vÃ  nÃ³i: â€œTáº­p Ä‘oÃ n Rino Mastrotto luÃ´n tá»± hÃ o vá» nghá»‡ thuáº­t truyá»n thá»‘ng vÃ  táº§m nhÃ¬n chiáº¿n lÆ°á»£c trong tÆ°Æ¡ng laiâ€. Michele nÄƒm nay Ä‘Ã£ bÆ°á»›c vÃ o tuá»•i 40, nhÆ°ng anh tháº­t tráº» trung trong chiáº¿c quáº§n jeans vÃ  chiáº¿c Ã¡o mÃ u xanh nháº¡t khÃ´ng cravat. Gáº·p anh, báº¡n ráº¥t dá»… cÃ³ thiá»‡n cáº£m bá»Ÿi sá»± chan hÃ²a vÃ  thÃ¢n thiá»‡n.\r\n\r\nTrÆ°á»›c khi vÃ o cÃ¢u chuyá»‡n, anh cÃ³ thá»ƒ giá»›i thiá»‡u sÆ¡ lÆ°á»£c vá» táº­p Ä‘oÃ n Rino Mastrotto Ä‘Æ°á»£c khÃ´ng?\r\n\r\nTáº­p Ä‘oÃ n Mastrotto ra Ä‘á»i tá»« giá»¯a tháº¿ ká»· trÆ°á»›c vÃ  phÃ¡t triá»ƒn trong nhá»¯ng nÄƒm qua, trá»Ÿ thÃ nh má»™t thÆ°Æ¡ng hiá»‡u xuáº¥t thÃ¢n tá»« má»™t cÃ´ng ty gia Ä‘Ã¬nh vá»›i cÃ¡c máº·t hÃ ng tháº¿ máº¡nh lÃ  tÃºi xÃ¡ch da, quáº§n Ã¡o da, gháº¿ da cao cáº¥p, cÃ¡c Ä‘á»“ da dÃ nh cho ngÃ nh xe hÆ¡i vÃ  ngÃ nh ná»™i tháº¥t. ThÆ°Æ¡ng hiá»‡u nÃ y Ä‘Ã£ cÃ³ máº·t á»Ÿ Ã tá»« nhá»¯ng nÄƒm 1960, nhá»¯ng máº·t hÃ ng Ä‘Æ°á»£c táº¡o ra tá»« nguyÃªn liá»‡u da cá»§a táº­p Ä‘oÃ n Rino Mastrotto tá»« lÃ¢u Ä‘Ã£ Ä‘Æ°á»£c ngÆ°á»i tiÃªu dÃ¹ng ráº¥t Æ°a chuá»™ng. Vá»›i tinh tháº§n cáº§u tiáº¿n, luÃ´n Ä‘á»•i má»›i ká»¹ thuáº­t vÃ  nÃ¢ng cao cháº¥t lÆ°á»£ng, thÆ°Æ¡ng hiá»‡u Mastrotto Rose ngÃ y cÃ ng kháº³ng Ä‘á»‹nh uy tÃ­n vÃ  phÃ¡t triá»ƒn. Äáº¿n nÄƒm 1998, táº­p Ä‘oÃ n Rino Masstrotto Ä‘Ã£ cÃ³ máº·t á»Ÿ Brazil, TÃ¢y Ban Nha, Ãšc, Trung Quá»‘c vÃ  Ä‘áº¿n nay Ä‘Ã£ cÃ³ máº·t á»Ÿ 6 quá»‘c gia, trong Ä‘Ã³ cÃ³ Viá»‡t Nam. Nhá»¯ng chá»§ng loáº¡i hÃ ng cá»§a táº­p Ä‘oÃ n Rino Masstrotto Ä‘Æ°á»£c cÃ¡c nhÃ  thiáº¿t káº¿ ná»•i tiáº¿ng cá»§a cÃ¡c hÃ£ng thá»i trang Prada, Gucci vÃ  nhÃ  thiáº¿t káº¿ ná»™i tháº¥t xe hÆ¡i ráº¥t Æ°a chuá»™ng vÃ  tin dÃ¹ng.\r\n\r\nTriáº¿t lÃ½ kinh doanh cá»§a Rino Mastrotto lÃ  gÃ¬?\r\n\r\nTinh tháº§n cá»§a táº­p Ä‘oÃ n Rino Mastrotto lÃ  luÃ´n tÃ¬m cÃ¡ch Ä‘á»ƒ há»— trá»£ vÃ  tÃ´n trá»ng thiÃªn nhiÃªn. Vá»›i táº§m nhÃ¬n nÃ y, táº­p Ä‘oÃ n chÃºng tÃ´i Ä‘Ã£ bá» ra nhiá»u nÄƒm nghiÃªn cá»©u vÃ  Ä‘Ã£ tÃ¬m ra Ä‘Æ°á»£c giáº£i phÃ¡p phÃ¡t triá»ƒn quy trÃ¬nh sáº£n xuáº¥t, giáº£m Ä‘Æ°á»£c tÃ¡c háº¡i Ä‘áº¿n mÃ´i trÆ°á»ng. Táº­p Ä‘oÃ n Rino Mastrotto luÃ´n tá»± hÃ o lÃ  má»™t cÃ´ng ty kiá»ƒu máº«u cá»§a tinh tháº§n nÃ y.\r\n\r\nAnh lÃ m nghá» nÃ y Ä‘Æ°á»£c bao lÃ¢u rá»“i. Äiá»u quan trá»ng nháº¥t cá»§a nghá» nÃ y lÃ  gÃ¬?\r\n\r\nTÃ´i báº¯t Ä‘áº§u cÃ´ng viá»‡c nÃ y Ä‘Ã£ Ä‘Æ°á»£c 20 nÄƒm. Äiá»u quan trá»ng nháº¥t cá»§a nghá» nÃ y lÃ  luÃ´n tÃ¬m tÃ²i vÃ  phÃ¡t minh ra nhá»¯ng cháº¥t liá»‡u má»›i theo Ä‘Ãºng xu hÆ°á»›ng cá»§a thá»i Ä‘áº¡i. Pháº£i lÃ m cÃ´ng viá»‡c vá»›i sá»± chuyÃªn nghiá»‡p cÃ¹ng vá»›i nhá»¯ng phong cÃ¡ch má»›i, hÆ°á»›ng Ä‘i má»›i vÃ  má»¥c tiÃªu chÃ­nh lÃ  mang Ä‘áº¿n ngÃ y cÃ ng nhiá»u Ä‘iá»u má»›i máº» cho khÃ¡ch hÃ ng. LÃ m nghá» nÃ y cáº§n pháº£i chÃº Ã½ láº¯ng nghe sá»± pháº£n há»“i cá»§a khÃ¡ch hÃ ng, Ä‘Ã¢y cÅ©ng chÃ­nh lÃ  má»™t cÃ¡ch thÃºc Ä‘áº©y tá»‘t nháº¥t cho cÃ´ng viá»‡c. VÃ¬ tháº¿, chÃºng tÃ´i luÃ´n pháº£i chÃº tÃ¢m Ä‘áº¿n viá»‡c chÄƒm sÃ³c khÃ¡ch hÃ ng ngay cáº£ nhá»¯ng yÃªu cáº§u vÃ´ cÃ¹ng khÃ³ khÄƒn, chÃºng tÃ´i cÅ©ng khÃ´ng thá»ƒ lÆ¡ lÃ .\r\n\r\nCÃ´ng viá»‡c cá»§a anh cÃ³ váº» náº·ng vá» tÃ­nh khuynh hÆ°á»›ng vÃ  thá»i trang quÃ¡ chÄƒng?\r\n\r\nCÃ³ láº½ tháº¿, vÃ  cÅ©ng bá»Ÿi má»™t Ä‘iá»u quan trá»ng tÃ´i lÃ  ngÆ°á»i khÃ´ng thÃ­ch trÃ´ng cáº­y mÃ£i vÃ o doanh thu cá»§a má»™t vÃ i sáº£n pháº©m, tÃ´i khÃ´ng dÃ nh nhiá»u thá»i gian nhÆ° váº­y Ä‘á»ƒ gáº·t hÃ¡i má»™t káº¿t quáº£ khiÃªm tá»‘n. KhÃ´ng riÃªng gÃ¬ nghá» cá»§a tÃ´i mÃ  táº¥t cáº£ cÃ¡c ngÃ nh nghá» khÃ¡c náº¿u báº¡n Ä‘Ã£ báº¯t tay vÃ o kinh doanh, thÃ¬ báº¡n nÃªn cÃ³ niá»m Ä‘am mÃª vÃ  sÃ¡ng táº¡o, báº¡n pháº£i luÃ´n Ä‘áº·t Ã¡p lá»±c cho cÃ´ng viá»‡c theo tinh tháº§n nÃ y, vÃ  báº¡n Ä‘á»«ng khoan nhÆ°á»£ng vá»›i má»¥c tiÃªu cá»§a mÃ¬nh.\r\n\r\nAnh Ä‘Ã¡nh giÃ¡ gÃ¬ vá» thá»‹ trÆ°á»ng Viá»‡t Nam?\r\n\r\nÄÃ¢y lÃ  má»™t thá»‹ trÆ°á»ng má»Ÿ vÃ  phÃ¡t triá»ƒn tá»«ng ngÃ y. Vá»›i nhá»¯ng chÃ­nh sÃ¡ch thuáº­n lá»£i, Viá»‡t Nam ngÃ y cÃ ng cÃ³ nhiá»u nhÃ  Ä‘áº§u tÆ°, nhá»¯ng táº­p Ä‘oÃ n lá»›n tham gia vÃ o thá»‹ trÆ°á»ng. Äiá»u nÃ y giÃºp cho táº¥t cáº£ má»i ngÆ°á»i tham gia Ä‘á»u cÃ³ lá»£i vÃ¬ há» Ä‘ang Ä‘Æ°á»£c lÃ m viá»‡c á»Ÿ má»™t thá»‹ trÆ°á»ng nÄƒng Ä‘á»™ng. Äiá»u Ä‘áº·c biá»‡t lÃ  nhÃ¢n lá»±c á»Ÿ Viá»‡t Nam ráº¥t tá»‘t, há» chÄƒm chá»‰ vÃ  cÃ³ Ã³c sÃ¡ng táº¡o. á»ž thá»‹ trÆ°á»ng nÃ y, náº¿u báº¡n cÃ³ Ã½ tÆ°á»Ÿng vÃ  Ä‘am mÃª kinh doanh thÃ¬ cháº¯c cháº¯n báº¡n sáº½ cÃ³ cÆ¡ há»™i thá»±c hiá»‡n Ã½ tÆ°á»Ÿng Ä‘Ã³ vÃ  kháº£ nÄƒng thÃ nh cÃ´ng lÃ  ráº¥t cao. Vá»›i tÆ° cÃ¡ch lÃ  thÃ nh viÃªn cá»§a Icham, PhÃ²ng ThÆ°Æ¡ng máº¡i vÃ  CÃ´ng nghiá»‡p Ã táº¡i Viá»‡t Nam, tÃ´i mong muá»‘n Ä‘Ã³ng gÃ³p pháº§n mÃ¬nh vÃ o viá»‡c cáº£i thiá»‡n quan há»‡ kinh doanh giá»¯a hai nÆ°á»›c.\r\n\r\nTáº­p Ä‘oÃ n Rino Mastrotto hiá»‡n nay Ä‘Ã£ cÃ³ máº·t á»Ÿ nhiá»u nÆ°á»›c, Ä‘Ã¢u lÃ  thá»‹ trÆ°á»ng lá»›n nháº¥t? VÃ  Ä‘Ã¢u lÃ  thá»‹ trÆ°á»ng tiá»m nÄƒng nháº¥t?\r\n\r\nThá»‹ trÆ°á»ng Malaysia, ThÃ¡i Lan, Australia, Há»“ng KÃ´ng vÃ  Trung Quá»‘c lÃ  nhá»¯ng thá»‹ trÆ°á»ng lá»›n. ÄÃ¢y lÃ  nhá»¯ng thá»‹ trÆ°á»ng Ä‘Ã£ phÃ¡t triá»ƒn á»•n Ä‘á»‹nh, nhÆ°ng chÃºng tÃ´i khÃ´ng chá»‰ chÄƒm chÃºt cho nhá»¯ng thá»‹ trÆ°á»ng lá»›n, chÃºng tÃ´i cÃ²n ráº¥t quan tÃ¢m Ä‘áº¿n nhá»¯ng thá»‹ trÆ°á»ng nhá» vÃ  tiá»m nÄƒng, bá»Ÿi nhá»¯ng thá»‹ trÆ°á»ng lá»›n nhÆ° cÃ¡i cÃ¢y Ä‘Ã£ qua nhiá»u mÃ¹a hÃ¡i quáº£, khÃ´ng cÃ²n nhá»¯ng sá»©c báº­t vÃ  bÆ°á»›c Ä‘i Ä‘á»™t phÃ¡. Trong khi nhá»¯ng thá»‹ trÆ°á»ng nhá» vÃ  tiá»m nÄƒng nhÆ° Viá»‡t Nam luÃ´n cÃ³ nhá»¯ng báº¥t ngá» vá» sá»©c báº­t náº¿u ta cÃ³ nhá»¯ng cÃº hÃ­ch Ä‘Ãºng lÃºc.\r\n\r\nTáº­p Ä‘oÃ n Rino Matrotto lÃ  má»™t thÆ°Æ¡ng hiá»‡u tÃªn tuá»•i. Váº­y theo anh, khÃ³ khÄƒn nháº¥t trong viá»‡c xÃ¢y dá»±ng thÆ°Æ¡ng hiá»‡u lÃ  gÃ¬?\r\n\r\ná»ž báº¥t cá»© Ä‘Ã¢u trÃªn tháº¿ giá»›i, cÃ¡c doanh nghiá»‡p Ä‘á»u cÃ³ chung má»™t má»¥c Ä‘Ã­ch lÃ  tÄƒng thá»‹ pháº§n vÃ  lá»£i nhuáº­n. Äiá»u nÃ y chá»‰ Ä‘Æ°á»£c thá»±c hiá»‡n khi há» tháº¯ng cuá»™c trong viá»‡c giÃ nh Ä‘Æ°á»£c tÃ¢m trÃ­ khÃ¡ch hÃ ng vÃ  cÃ¡c cÃ´ng ty thÃ nh cÃ´ng Ä‘á»u Ä‘Ã£ náº¿m tráº£i nhá»¯ng kinh nghiá»‡m cay Ä‘áº¯ng vá» Ä‘iá»u nÃ y. Bá»Ÿi váº­y, chá»‰ cÃ³ thÃ nh cÃ´ng trong viá»‡c chiáº¿m vá»‹ trÃ­ trong tÃ¢m trÃ­ khÃ¡ch hÃ ng vÃ  táº¡o ra báº£n sáº¯c riÃªng cho hÃ¬nh áº£nh thÆ°Æ¡ng hiá»‡u má»›i cÃ³ cÆ¡ há»™i phÃ¡t triá»ƒn vÃ  tÄƒng lá»£i nhuáº­n cho doanh nghiá»‡p.\r\n\r\nKhÃ´ng dá»… gÃ¬ Ä‘á»ƒ xÃ¢y dá»±ng má»™t thÆ°Æ¡ng hiá»‡u. NÃ³ bao gá»“m nhiá»u thá»© mÃ  chÃºng ta pháº£i hÃ ng ngÃ y, hÃ ng giá» lao tÃ¢m khá»• tá»©, nÃ³ lÃ  ná»— lá»±c cá»§a toÃ n thá»ƒ cÃ´ng ty vÃ  Ä‘Ã´i khi nÃ³ bao gá»“m cáº£ nhá»¯ng kinh nghiá»‡m mÃ  khÃ¡ch hÃ ng Ä‘Ã£ cÃ³ vá»›i cÃ´ng ty. Äá»ƒ thÆ°Æ¡ng hiá»‡u Rino Mastrotto cÃ³ dáº¥u áº¥n trÃªn thá»‹ trÆ°á»ng nhÆ° ngÃ y hÃ´m nay, chÃºng tÃ´i Ä‘Ã£ ná»— lá»±c khÃ´ng ngá»«ng vÃ  chÆ°a bao giá» nhÆ°á»£ng bá»™ vá»›i nhá»¯ng khÃ³ khÄƒn cáº£n bÆ°á»›c.\r\n\r\nTrong kinh doanh, vÄƒn hÃ³a kinh doanh lÃ  má»™t Ä‘iá»u tiÃªn quyáº¿t, nhÆ°ng vÄƒn hÃ³a kinh doanh á»Ÿ má»—i nÆ¡i láº¡i cÃ³ nhá»¯ng Ä‘áº·c Ä‘iá»ƒm khÃ¡c nhau. Váº­y, nhá»¯ng thÃ¡ch thá»©c vÃ  khÃ³ khÄƒn anh pháº£i Ä‘á»‘i máº·t á»Ÿ Ä‘Ã¢y lÃ  gÃ¬?\r\n\r\nTÃ´i nghÄ©, khÃ´ng chá»‰ á»Ÿ Viá»‡t Nam mÃ  á»Ÿ báº¥t cá»© nÆ°á»›c nÃ o cÅ©ng váº­y. ÄÃ³ lÃ  má»™t thá»±c táº¿ mÃ  báº¥t cá»© táº­p Ä‘oÃ n Ä‘a quá»‘c gia nÃ o cÅ©ng pháº£i náº¯m Ä‘Æ°á»£c Ä‘á»ƒ thÃ­ch á»©ng vÃ  phÃ¡t triá»ƒn á»Ÿ thá»‹ trÆ°á»ng áº¥y. á»ž Viá»‡t Nam khi tÃ´i má»›i Ä‘áº¿n, Ä‘iá»u lo láº¯ng nháº¥t cá»§a tÃ´i lÃ  ngÃ´n ngá»¯, nhÆ°ng tÃ´i Ä‘Ã£ nhanh chÃ³ng nháº­n ra má»™t Ä‘iá»u ráº±ng, Ä‘Ã³ khÃ´ng pháº£i lÃ  thá»© quan trá»ng nháº¥t, Ä‘iá»u quan trá»ng lÃ  pháº£i má»Ÿ lÃ²ng vÃ  há»£p tÃ¡c. NgÆ°á»i Viá»‡t Nam cÅ©ng cÃ³ ráº¥t nhiá»u nÃ©t tÆ°Æ¡ng Ä‘á»“ng vá»›i ngÆ°á»i Ã, há» chÄƒm chá»‰, minh báº¡ch vÃ  sáºµn sÃ ng há»£p tÃ¡c. Báº¡n hÃ£y tin tÆ°á»Ÿng há», hÃ£y má»Ÿ lÃ²ng tháº­t sá»± vá»›i miá»n Ä‘áº¥t nÃ y thÃ¬ cháº¯c cháº¯n báº¡n sáº½ thÃ nh cÃ´ng.\r\n\r\nTrong thÃ nh cÃ´ng cá»§a anh cÃ³ bao nhiÃªu pháº§n trÄƒm lÃ  may máº¯n, bao nhiÃªu pháº§n trÄƒm lÃ  ná»— lá»±c?\r\n\r\nTÃ´i khÃ´ng biáº¿t chÃ­nh xÃ¡c lÃ  bao nhiÃªu pháº§n trÄƒm cho tá»«ng thá»©, nhÆ°ng tÃ´i cháº¯c cháº¯n má»™t Ä‘iá»u lÃ  tÃ´i Ä‘Ã£ ráº¥t ná»— lá»±c. ÄÃºng lÃ  cÃ³ Ä‘Æ°á»£c nhá»¯ng thÃ nh cÃ´ng ngÃ y hÃ´m nay lÃ  do kiáº¿n thá»©c, sá»± chÃ¢n thÃ nh, khiÃªm tá»‘n vÃ  sá»± cá»‘ gáº¯ng cá»§a tÃ´i mang láº¡i, nhÆ°ng táº¥t nhiÃªn lÃ  khÃ´ng thá»ƒ thiáº¿u sá»± may máº¯n. (CÆ°á»i)\r\n\r\nAnh Ä‘Ã£ bao giá» gáº·p tháº¥t báº¡i? VÃ  anh Ä‘Ã£ vÆ°á»£t qua nhá»¯ng khÃ³ khÄƒn áº¥y nhÆ° tháº¿ nÃ o?\r\n\r\nTrÃªn bÆ°á»›c Ä‘Æ°á»ng Ä‘á»i, Ä‘á»ƒ cÃ³ Ä‘Æ°á»£c nhá»¯ng thÃ nh cÃ´ng trong sá»± nghiá»‡p, má»—i ngÆ°á»i chÃºng ta Ä‘á»u pháº£i tráº£i qua má»™t quÃ¡ trÃ¬nh lÃ m viá»‡c miá»‡t mÃ i. Trong quÃ¡ trÃ¬nh áº¥y, chÃºng ta khÃ´ng khá»i váº¥p pháº£i nhá»¯ng sai láº§m, nhá»¯ng tháº¥t báº¡i. Váº¥n Ä‘á» lÃ  sau nhá»¯ng tháº¥t báº¡i áº¥y, ngÆ°á»i ta nhÃ¬n nháº­n ra Ä‘iá»u gÃ¬ má»›i lÃ  quan trá»ng. Tá»« nhá»¯ng tháº¥t báº¡i áº¥y, náº¿u biáº¿t nhÃ¬n nháº­n vÃ  nghiÃªm kháº¯c vá»›i báº£n thÃ¢n thÃ¬ giáº£m bá»›t Ä‘Æ°á»£c nhá»¯ng thiá»‡t háº¡i vÃ  sá»›m gáº·t hÃ¡i Ä‘Æ°á»£c nhiá»u thÃ nh cÃ´ng hÆ¡n.\r\n\r\nTrong kinh doanh, ai lÃ  ngÆ°á»i áº£nh hÆ°á»Ÿng Ä‘áº¿n anh nhiá»u nháº¥t?\r\n\r\nÄÃ³ lÃ  cha cá»§a tÃ´i. Ã´ng áº¥y lÃ  má»™t ngÆ°á»i cha máº«u má»±c. NÄƒm nay cha tÃ´i Ä‘Ã£ 81 tuá»•i nhÆ°ng Ã´ng váº«n quáº£n lÃ½ cÃ´ng ty, váº«n cáº§n máº«n vá»›i cÃ´ng viá»‡c mÃ  Ã´ng Ä‘Ã£ cÃ³ cÃ¡ch Ä‘Ã¢y 60 nÄƒm. Cha tÃ´i cho ráº±ng: â€œNáº¿u ta lÃ m viá»‡c cáº§n máº«n thÃ¬ nghá» nghiá»‡p khÃ´ng bao giá» phá»¥ ta. Trong kinh doanh cÅ©ng váº­y, náº¿u ta chÄƒm chá»‰ vÃ  cÃ³ Ã³c sÃ¡ng táº¡o thÃ¬ cháº¯c cháº¯n sáº½ thÃ nh cÃ´ngâ€. Cha tÃ´i Ä‘Ã£ nÃªu táº¥m gÆ°Æ¡ng sÃ¡ng cho anh em chÃºng tÃ´i. Cha tÃ´i quan niá»‡m: â€œKinh doanh khÃ´ng cÃ³ sá»± háº¡n cháº¿ vá» thá»i gian vÃ  tuá»•i tÃ¡câ€¦ Viá»‡c kinh doanh dá»±a vÃ o niá»m tin vÃ  nguá»“n cáº£m há»©ng. Nhá»¯ng ngÆ°á»i tham gia kinh doanh nhiá»u khi chá»‰ lÃ  vÃ¬ mong muá»‘n lÃ m cho tháº¿ giá»›i tá»‘t Ä‘áº¹p hÆ¡nâ€.\r\n\r\nAnh chÄƒm sÃ³c gia Ä‘Ã¬nh mÃ¬nh nhÆ° tháº¿ nÃ o?\r\n\r\nTÃ´i chÆ°a láº­p gia Ä‘Ã¬nh riÃªng nÃªn ngoÃ i viá»‡c táº­p trung cho kinh doanh, tÃ´i cÃ²n dÃ nh khÃ¡ nhiá»u thá»i gian cho viá»‡c Ä‘i láº¡i thÄƒm gia Ä‘Ã¬nh. TÃ´i thÆ°á»ng vá» nhÃ  vÃ o nhá»¯ng dá»‹p lá»…. NÆ¡i Ä‘Ã³ cÃ³ cha máº¹ tÃ´i, cÃ¡c em tÃ´i vÃ  nhá»¯ng ngÆ°á»i thÃ¢n.\r\n\r\nAnh giáº£i trÃ­ ra sao?\r\n\r\nNhÆ° báº¡n biáº¿t Ä‘áº¥y, tÃ´i lÃ  ngÆ°á»i ráº¥t mÃª bÃ³ng Ä‘Ã¡ nhÆ°ng khÃ´ng thá»ƒ vá»«a lÃ  doanh nhÃ¢n vá»«a lÃ  cáº§u thá»§ Ä‘Æ°á»£c. (CÆ°á»i). TÃ´i cÃ³ ráº¥t Ã­t thá»i gian cho viá»‡c thÆ°á»Ÿng thá»©c cuá»™c sá»‘ng theo nghÄ©a cÃ³ thá»ƒ lÃ m báº¥t cá»© thá»© gÃ¬ mÃ¬nh thÃ­ch. Tuy nhiÃªn, nhá»¯ng lÃºc ráº£nh rá»—i hiáº¿m hoi, tÃ´i dÃ nh nhiá»u cho viá»‡c Ä‘á»c sÃ¡ch, nghe nháº¡c cá»• Ä‘iá»ƒnâ€¦ TÃ´i cÅ©ng chÆ¡i golf nhÆ°ng khÃ´ng thÆ°á»ng xuyÃªn láº¯m vÃ¬ thá»i gian cÃ³ háº¡n.\r\n\r\nCáº£m Æ¡n anh, ráº¥t vui Ä‘Æ°á»£c gáº·p anh vÃ  trÃ² chuyá»‡n cÃ¹ng anh.\r\n\r\nThá»±c hiá»‡n: Ngá»c HÃ¢n',NULL,'Michele-Rino-Mastrotto.jpg',NULL,3,1);
/*!40000 ALTER TABLE `business_history` ENABLE KEYS */;


--
-- Definition of table `capital_revenue`
--

DROP TABLE IF EXISTS `capital_revenue`;
CREATE TABLE `capital_revenue` (
  `id_capital_revenue` int(10) unsigned NOT NULL auto_increment,
  `cr_content` varchar(100) default NULL,
  `cr_content_EN` varchar(100) default NULL,
  `sort` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_capital_revenue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Bảng tỉ lệ xuất nhập khẩu';

--
-- Dumping data for table `capital_revenue`
--

/*!40000 ALTER TABLE `capital_revenue` DISABLE KEYS */;
INSERT INTO `capital_revenue` (`id_capital_revenue`,`cr_content`,`cr_content_EN`,`sort`) VALUES 
 (1,'DÆ°á»›i 50 triá»‡u (VNÄ)','Under 10,000 (USD)',1),
 (2,'50 - 100 triá»‡u (VNÄ)','10,000 - 50,000 (USD)',2),
 (3,'100 - 500 triá»‡u (VNÄ)','50,000 - 100,000 (USD)',3),
 (4,'500 triá»‡u (VNÄ) - 1 tá»‰ (VNÄ)','100,000 - 500,000 (USD)',4),
 (5,'1 - 5 tá»‰ (VNÄ)','500,000 - 1 million (USD)',5),
 (6,'5 - 10 tá»‰ (VNÄ)','1 - 5 million (USD)',6),
 (7,'5 - 10 tá»‰ (VNÄ)','5 - 10 million (USD)',7),
 (8,'10 - 20 tá»‰ (VNÄ)','10 - 50 million (USD)',8),
 (9,'20 -30 tá»‰ (VNÄ)','50 - 100 million (USD)',9),
 (10,'30 - 40 tá»‰ (VNÄ)','100 - 500 million (USD)',10),
 (11,'40 - 50 tá»‰ (VNÄ)','500 million - 1 Billion (USD)',11),
 (12,'TrÃªn 50 tá»‰ (VNÄ)','1 - 5 Billion (USD)',12),
 (13,NULL,'5 - 10 Billion (USD)',13),
 (14,NULL,'10 - 20 Billion (USD)',14),
 (15,NULL,'20 - 30 Billion (USD)',15),
 (16,NULL,'30 - 40 Billion (USD)',16),
 (17,NULL,'40 - 50 Billion (USD)',17),
 (18,NULL,'Over 50 Billion (USD)',18);
/*!40000 ALTER TABLE `capital_revenue` ENABLE KEYS */;


--
-- Definition of table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id_company` int(10) unsigned NOT NULL auto_increment,
  `company_id_country` int(10) unsigned default NULL,
  `company_id_industry` int(10) unsigned default NULL,
  `company_name` varchar(200) default NULL,
  `company_name_EN` varchar(200) default NULL,
  `company_postcode` int(10) unsigned default NULL,
  `company_logo` varchar(60) default NULL,
  `company_address` varchar(200) default NULL,
  `company_address_EN` varchar(200) default NULL,
  `company_tell` varchar(20) default NULL,
  `company_mobile` varchar(20) default NULL,
  `company_email` varchar(60) default NULL,
  `company_fax` varchar(20) default NULL,
  `company_website` varchar(60) default NULL,
  `company_name_represent` varchar(60) default NULL,
  `company_mansex_represent` varchar(10) default NULL,
  `company_manstatus_represent` varchar(30) default NULL,
  `company_manstatus_represent_EN` varchar(200) default NULL,
  `company_number_employees` varchar(45) default NULL,
  `company_number_employees_EN` varchar(45) default NULL,
  `company_year_foundation` varchar(10) default NULL,
  `company_authorized_capital` varchar(50) default NULL,
  `company_yearly_revenue` varchar(50) default NULL,
  `company_export_rates` varchar(30) default NULL,
  `company_import_ratio` varchar(30) default NULL,
  `company_main_product` varchar(255) default NULL,
  `company_main_product_EN` varchar(255) default NULL,
  `company_main_markets_orther` varchar(255) default NULL,
  `company_shortinfo` varchar(255) default NULL,
  `company_shortinfo_EN` varchar(255) default NULL,
  `company_info` text,
  `company_info_EN` text,
  `company_potential` tinyint(3) unsigned default NULL COMMENT 'cong ty tiem nang',
  `company_day_update` datetime default NULL,
  `company_id_member` int(10) unsigned default NULL,
  `company_visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_company`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` (`id_company`,`company_id_country`,`company_id_industry`,`company_name`,`company_name_EN`,`company_postcode`,`company_logo`,`company_address`,`company_address_EN`,`company_tell`,`company_mobile`,`company_email`,`company_fax`,`company_website`,`company_name_represent`,`company_mansex_represent`,`company_manstatus_represent`,`company_manstatus_represent_EN`,`company_number_employees`,`company_number_employees_EN`,`company_year_foundation`,`company_authorized_capital`,`company_yearly_revenue`,`company_export_rates`,`company_import_ratio`,`company_main_product`,`company_main_product_EN`,`company_main_markets_orther`,`company_shortinfo`,`company_shortinfo_EN`,`company_info`,`company_info_EN`,`company_potential`,`company_day_update`,`company_id_member`,`company_visible`) VALUES 
 (1,1,1,'Cong ty cua admin','company name',84,'1.jpg','458/76 LÃ½ ThÃ¡i Tá»•,P.10,Q.10 HCM','adress ','0623769431','01675584174','12110515@yahoo.com','123456789','vnTrade360.com','Tho','Mr','Tá»•ng GiÃ¡m Ä‘á»‘c','Tá»•ng GiÃ¡m Ä‘á»‘c','DÆ°á»›i 50 nhÃ¢n viÃªn',NULL,'1994','12','12','10','2','MÃ¡y PhÃ¡t Äiá»‡n','main product','Europe','CÃ´ng Ty chuyÃªn xuáº¥t nháº­p kháº©u hÃ ng Ä‘áº§u VN','short describe','Welcome ................. CÃ´ng Ty chuyÃªn xuáº¥t nháº­p kháº©u hÃ ng Ä‘áº§u VN    ','Content introduce company  ',1,'2010-08-30 10:42:02',1,1),
 (3,2,1,'cÃ´ng ty doanh nghiá»‡p vip',NULL,84,'2.jpg','PhÃº QuÃ½ BÃ¬nh Thuáº­n',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Mr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Giá»›i thiá»‡u cÃ´ng ty ',NULL,NULL,'2010-09-25 03:08:58',9,1);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;


--
-- Definition of table `contact_department`
--

DROP TABLE IF EXISTS `contact_department`;
CREATE TABLE `contact_department` (
  `id_contact_department` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(60) default NULL,
  `name_EN` varchar(60) default NULL,
  `type` varchar(10) default NULL,
  `day_update` datetime default NULL,
  `sort` int(10) unsigned default NULL,
  `visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_contact_department`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_department`
--

/*!40000 ALTER TABLE `contact_department` DISABLE KEYS */;
INSERT INTO `contact_department` (`id_contact_department`,`name`,`name_EN`,`type`,`day_update`,`sort`,`visible`) VALUES 
 (1,'Bá»™ pháº­n kinh doanh','Business department',NULL,'2010-08-07 01:35:40',1,1),
 (2,'Bá»™ pháº­n kÄ© thuáº­t','Technical department','member','2010-08-07 01:36:55',2,1);
/*!40000 ALTER TABLE `contact_department` ENABLE KEYS */;


--
-- Definition of table `contact_information`
--

DROP TABLE IF EXISTS `contact_information`;
CREATE TABLE `contact_information` (
  `id_contact_information` int(10) unsigned NOT NULL auto_increment,
  `ct_info_fullname` varchar(60) default NULL,
  `ct_info_company` varchar(200) default NULL,
  `ct_info_department` int(10) unsigned default NULL,
  `ct_info_position` int(10) unsigned default NULL,
  `ct_info_email` varchar(60) default NULL,
  `ct_info_address` varchar(200) default NULL,
  `ct_info_tel` varchar(20) default NULL,
  `ct_info_mobile` varchar(20) default NULL,
  `ct_info_fax` varchar(20) default NULL,
  `ct_info_id_member` int(10) unsigned default NULL,
  `ct_info_website` varchar(50) default NULL,
  PRIMARY KEY  (`id_contact_information`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `contact_information`
--

/*!40000 ALTER TABLE `contact_information` DISABLE KEYS */;
INSERT INTO `contact_information` (`id_contact_information`,`ct_info_fullname`,`ct_info_company`,`ct_info_department`,`ct_info_position`,`ct_info_email`,`ct_info_address`,`ct_info_tel`,`ct_info_mobile`,`ct_info_fax`,`ct_info_id_member`,`ct_info_website`) VALUES 
 (1,'LÃª Ä‘á»©c Thá»','SOng PhÃ¡t 360',2,1,'1211051@yahoo.com','PhÃº QUÃ½ BÃ¬nh Thuáº­n','0623769431','01675584174','123456789',2,'http://songphat360.com'),
 (2,'test tieng anh',NULL,NULL,NULL,'hspq07@gmail.com','phu quy','01675584174','01675584174','123456789136',4,'http://songphat360.com.vn');
/*!40000 ALTER TABLE `contact_information` ENABLE KEYS */;


--
-- Definition of table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id_country` int(10) unsigned NOT NULL auto_increment,
  `country_name` varchar(60) default NULL,
  `country_name_EN` varchar(60) default NULL,
  `country_image_illustrate` varchar(30) default NULL,
  `day_update` datetime default NULL,
  `sort` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_country`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` (`id_country`,`country_name`,`country_name_EN`,`country_image_illustrate`,`day_update`,`sort`) VALUES 
 (1,'Viá»‡t Nam','Vietnames','vietnam.png','2010-07-28 18:18:21',1),
 (2,'Nháº­t','Japan','japan.png','2010-08-14 01:04:27',2);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;


--
-- Definition of table `customer_contact`
--

DROP TABLE IF EXISTS `customer_contact`;
CREATE TABLE `customer_contact` (
  `id_customer_contact` int(10) unsigned NOT NULL auto_increment,
  `id_contact_department` int(10) unsigned default NULL,
  `id_country` int(10) unsigned default NULL,
  `company_name` varchar(200) default NULL,
  `company_address` varchar(255) default NULL,
  `member_name` varchar(60) default NULL,
  `email` varchar(20) default NULL,
  `tel` varchar(20) default NULL,
  `fax` varchar(20) default NULL,
  `address` varchar(200) default NULL,
  `title` varchar(255) default NULL,
  `content` text,
  `day_update` datetime default NULL,
  PRIMARY KEY  (`id_customer_contact`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='khách hàng hoặc thành viên liên hệ Ban Quản Trị';

--
-- Dumping data for table `customer_contact`
--

/*!40000 ALTER TABLE `customer_contact` DISABLE KEYS */;
INSERT INTO `customer_contact` (`id_customer_contact`,`id_contact_department`,`id_country`,`company_name`,`company_address`,`member_name`,`email`,`tel`,`fax`,`address`,`title`,`content`,`day_update`) VALUES 
 (1,2,1,'cong ty tradekey','1234456','le duc tho','hspq07@gmail.com','01675584174','123456789136','phu quy','van Ä‘á» liÃªn há»‡','ná»™i dung lien há»‡','2010-09-13 11:01:00'),
 (2,2,1,'cong ty tradekey','1234456','le duc tho','hspq07@gmail.com','01675584174','123456789136','phu quy',NULL,'Noi dung liÃªn há»‡ Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡Noi dung liÃªn há»‡','2010-09-13 11:18:09'),
 (3,2,1,'cong ty tradekey','1234456','le duc tho','hspq07@gmail.com','01675584174','123456789136','phu quy','sdfasdf','fasf','2010-09-13 11:19:31'),
 (4,2,1,'cong ty tradekey','1234456','le duc tho','hspq07@gmail.com','01675584174','123456789136','phu quy',NULL,'ná»™i dung lien há»‡','2010-09-17 22:21:40'),
 (5,2,1,'cong ty tradekey','1234456','le duc tho','hspq07@gmail.com','01675584174','123456789136','phu quy',NULL,'ná»™i dung lien há»‡','2010-09-17 22:22:10'),
 (6,2,1,'cong ty tradekey 121','Ä‘á»‹a chá»‰ cÃ´ng ty','le duc tho','hspq07@gmail.com','01675584174','123456789136','phu quy',NULL,NULL,'2010-09-17 22:31:02'),
 (7,2,1,'cong ty tradekey 121','Ä‘á»‹a chá»‰ cÃ´ng ty','le duc tho','hspq07@gmail.com','01675584174','123456789136','phu quy',NULL,NULL,'2010-09-17 22:32:47'),
 (8,2,1,'cong ty tradekey','1234456','le duc tho','hspq07@gmail.com','01675584174',NULL,'phu quy',NULL,'asdffasf','2010-09-17 22:39:30'),
 (9,2,1,'cong ty tradekey','1234456','le duc tho','hspq07@gmail.com','01675584174','tieu de moi','phu quy',NULL,'noi dung tieu de moi','2010-09-17 22:46:59'),
 (10,2,2,'tÃªn cÃ´ng ty nao Ä‘Ã³','Ä‘á»‹a chá»‰ cÃ´ng ty nÃ o Ä‘Ã³','Nguyá»…n vÄƒn A','ngvana@yahoo.com','01675584...','váº¥n Ä‘á»ƒ nguyen v','Ä‘á»‹a chá»‰ cá»§a nguyá»…n vÄƒn A',NULL,'Ná»™i dung cÃ¹ng tiÃªu Ä‘á» cá»§a nguyá»…n vÄƒn A muá»‘n nÃ³i','2010-09-18 09:27:09');
/*!40000 ALTER TABLE `customer_contact` ENABLE KEYS */;


--
-- Definition of table `employees_num`
--

DROP TABLE IF EXISTS `employees_num`;
CREATE TABLE `employees_num` (
  `id_employees_num` int(10) unsigned NOT NULL auto_increment,
  `emp_content` varchar(45) default NULL,
  `emp_content_EN` varchar(45) default NULL,
  `emp_sort` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_employees_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees_num`
--

/*!40000 ALTER TABLE `employees_num` DISABLE KEYS */;
/*!40000 ALTER TABLE `employees_num` ENABLE KEYS */;


--
-- Definition of table `footer`
--

DROP TABLE IF EXISTS `footer`;
CREATE TABLE `footer` (
  `id_footer` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(60) default NULL,
  `content` text,
  `content_EN` text,
  `visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_footer`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `footer`
--

/*!40000 ALTER TABLE `footer` DISABLE KEYS */;
INSERT INTO `footer` (`id_footer`,`title`,`content`,`content_EN`,`visible`) VALUES 
 (1,'VnTrade360','Â© 2010 VnTrade360.com\r\nGiáº¥y phÃ©p hoáº¡t Ä‘á»™ng sá»‘: 196/GP-BC do Bá»™ VHTT cáº¥p 12/11/2010.<br />\r\nwww.VnTrade360.comcÃ³ trÃ¡ch nhiá»‡m chuyá»ƒn táº£i thÃ´ng tin. KhÃ´ng chá»‹u báº¥t ká»³ trÃ¡ch nhiá»‡m nÃ o tá»« cÃ¡c tin nÃ y. Xem chi tiáº¿t','Â© 2010 VnTrade360.com\r\nGiáº¥y phÃ©p hoáº¡t Ä‘á»™ng sá»‘: 196/GP-BC do Bá»™ VHTT cáº¥p 12/11/2010.<br />\r\nwww.VnTrade360.comcÃ³ trÃ¡ch nhiá»‡m chuyá»ƒn táº£i thÃ´ng tin. KhÃ´ng chá»‹u báº¥t ká»³ trÃ¡ch nhiá»‡m nÃ o tá»« cÃ¡c tin nÃ y. Xem chi tiáº¿t',1);
/*!40000 ALTER TABLE `footer` ENABLE KEYS */;


--
-- Definition of table `help`
--

DROP TABLE IF EXISTS `help`;
CREATE TABLE `help` (
  `id_help` int(10) unsigned NOT NULL auto_increment,
  `help_title` varchar(200) default NULL,
  `help_title_EN` varchar(200) default NULL,
  `help_short_describe` varchar(255) default NULL,
  `help_short_describe_EN` varchar(255) default NULL,
  `help_content` text,
  `help_content_EN` text,
  `help_help_day_update` datetime default NULL,
  `help_help_position` varchar(100) default NULL,
  `help_sort` int(10) unsigned default NULL,
  `help_visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_help`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `help`
--

/*!40000 ALTER TABLE `help` DISABLE KEYS */;
INSERT INTO `help` (`id_help`,`help_title`,`help_title_EN`,`help_short_describe`,`help_short_describe_EN`,`help_content`,`help_content_EN`,`help_help_day_update`,`help_help_position`,`help_sort`,`help_visible`) VALUES 
 (1,'tiÃªu Ä‘á» trá»£ giÃºp 1','Title help 1','MÃ´ táº£ ngáº¯n cá»§a trá»£ giÃºp 1','Describe for title 1','Ná»™i dung cá»§a tiÃªu Ä‘á» 1','Content of title 1','2010-08-15 10:33:52',NULL,1,1);
/*!40000 ALTER TABLE `help` ENABLE KEYS */;


--
-- Definition of table `hitcount`
--

DROP TABLE IF EXISTS `hitcount`;
CREATE TABLE `hitcount` (
  `id_hitcount` int(10) unsigned NOT NULL auto_increment,
  `totalvisitors_web` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_hitcount`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitcount`
--

/*!40000 ALTER TABLE `hitcount` DISABLE KEYS */;
/*!40000 ALTER TABLE `hitcount` ENABLE KEYS */;


--
-- Definition of table `images_library`
--

DROP TABLE IF EXISTS `images_library`;
CREATE TABLE `images_library` (
  `id_images_library` int(10) unsigned NOT NULL auto_increment,
  `id_products` int(10) unsigned default NULL,
  `il_image` varchar(50) default NULL,
  `li_day_update` datetime default NULL,
  PRIMARY KEY  (`id_images_library`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Thư viện hình ảnh chi tiết sản phẩm';

--
-- Dumping data for table `images_library`
--

/*!40000 ALTER TABLE `images_library` DISABLE KEYS */;
INSERT INTO `images_library` (`id_images_library`,`id_products`,`il_image`,`li_day_update`) VALUES 
 (8,1,'1.jpg','2010-08-20 22:28:25'),
 (9,7,'12.jpg','2010-08-25 15:40:40'),
 (10,7,'13.gif','2010-08-25 15:41:05'),
 (12,3,'4.jpg','2010-08-25 15:44:30');
/*!40000 ALTER TABLE `images_library` ENABLE KEYS */;


--
-- Definition of table `import_export`
--

DROP TABLE IF EXISTS `import_export`;
CREATE TABLE `import_export` (
  `id_import_export` int(10) unsigned NOT NULL auto_increment,
  `content` varchar(100) default NULL,
  `content_EN` varchar(100) default NULL,
  `sort` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_import_export`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tỉ lệ xuất nhập khẩu của công ty';

--
-- Dumping data for table `import_export`
--

/*!40000 ALTER TABLE `import_export` DISABLE KEYS */;
INSERT INTO `import_export` (`id_import_export`,`content`,`content_EN`,`sort`) VALUES 
 (1,'0% - 10%','0% - 10%',1),
 (2,'10% - 20%','10% - 20%',2),
 (3,'20% - 30%','20% - 30%',3),
 (4,'30% - 40%','30% - 40%',4),
 (5,'40% - 50%','40% - 50%',5),
 (6,'50% - 60%','50% - 60%',6),
 (7,'60% - 70%','60% - 70%',7),
 (8,'70% - 80%','70% - 80%',8),
 (9,'80% - 90%','80% - 90%',9),
 (10,'90% -100%','90% -100%',10);
/*!40000 ALTER TABLE `import_export` ENABLE KEYS */;


--
-- Definition of table `inbox`
--

DROP TABLE IF EXISTS `inbox`;
CREATE TABLE `inbox` (
  `id_inbox` int(10) unsigned NOT NULL auto_increment,
  `inbox_recipient` int(10) unsigned default NULL COMMENT 'Bộ phẩn liên hệ',
  `box_contact_department` int(10) unsigned default NULL COMMENT 'có thể là member hoặc khách hàng,..',
  `inbox_name_product` varchar(150) default NULL COMMENT 'Tiêu đề sản phẩm(id_products)',
  `inbox_name_service` varchar(150) default NULL,
  `inbox_sender` int(10) unsigned default NULL COMMENT 'là công ty của 1 thành viên nào đó(thông qua id_member)',
  `inbox_email` varchar(60) default NULL,
  `inbox_address` varchar(200) default NULL,
  `inbox_tel` varchar(20) default NULL,
  `inbox_subject` varchar(255) default NULL,
  `inbox_content` text,
  `inbox_day_update` datetime default NULL,
  `inbox_sent` tinyint(3) unsigned default '0' COMMENT 'Thư đã gửi',
  `inbox_recycle_bin` tinyint(3) unsigned default '0' COMMENT 'Thùng rác trong hộp thư thành viên',
  PRIMARY KEY  USING BTREE (`id_inbox`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inbox`
--

/*!40000 ALTER TABLE `inbox` DISABLE KEYS */;
INSERT INTO `inbox` (`id_inbox`,`inbox_recipient`,`box_contact_department`,`inbox_name_product`,`inbox_name_service`,`inbox_sender`,`inbox_email`,`inbox_address`,`inbox_tel`,`inbox_subject`,`inbox_content`,`inbox_day_update`,`inbox_sent`,`inbox_recycle_bin`) VALUES 
 (1,2,1,'TÃªn sáº£n pháº©m',NULL,1,'hspq07@gmail.com','dia chi','123456','Chá»§ Ä‘á» gá»­i','Alo testÆ° váº¥n thay Ä‘á»•i Ä‘Äƒng kÃ½ kinh doanh \r\n\r\nTÆ° váº¥n thÃ nh láº­p chi nhÃ¡nh, vÄƒn phÃ²ng Ä‘áº¡i diá»‡n \r\n\r\nTÆ° váº¥n giáº£i thá»ƒ, phÃ¡ sáº£n, mua - bÃ¡n doanh nghiá»‡p \r\n\r\nTÆ° váº¥n cÃ¡c váº¥n Ä‘á» khÃ¡c liÃªn quan Ä‘áº¿n doanh nghiá»‡p \r\n\r\nTÆ° váº¥n Thuáº¿ - Káº¿ toÃ¡n \r\n\r\nTÆ° váº¥n vá» chÃ­nh sÃ¡ch thuáº¿ \r\n\r\nTÆ° váº¥n thá»±c hiá»‡n Dá»‹chvá»¥ - Thiáº¿t láº­p há»“ sÆ¡ thuáº¿ ban Ä‘áº§u \r\n\r\nTÆ° váº¥n thá»±c hiá»‡n Dá»‹chvá»¥ - BÃ¡o cÃ¡o thuáº¿ hÃ ng thÃ¡ng \r\n\r\nTÆ° váº¥n thá»±c hiá»‡n Dá»‹chvá»¥ - Viáº¿t sá»• sÃ¡ch káº¿ toÃ¡n vÃ  Quyáº¿t toÃ¡n thuáº¿ \r\n\r\nTÆ° váº¥n xÃ¢y dá»±ng cÃ¡c mÃ´ hÃ¬nh káº¿ tÃ³an, tá»• chá»©c vÃ  Ä‘iá»u hÃ nh bá»™ mÃ¡y káº¿ toÃ¡Æ° váº¥n thay Ä‘á»•i Ä‘Äƒng kÃ½ kinh doanh \r\n\r\nTÆ° váº¥n thÃ nh láº­p chi nhÃ¡nh, vÄƒn phÃ²ng Ä‘áº¡i diá»‡n \r\n\r\nTÆ° váº¥n giáº£i thá»ƒ, phÃ¡ sáº£n, mua - bÃ¡n doanh nghiá»‡p \r\n\r\nTÆ° váº¥n cÃ¡c váº¥n Ä‘á» khÃ¡c liÃªn quan Ä‘áº¿n doanh nghiá»‡p \r\n\r\nTÆ° váº¥n Thuáº¿ - Káº¿ toÃ¡n \r\n\r\nTÆ° váº¥n vá» chÃ­nh sÃ¡ch thuáº¿ \r\n\r\nTÆ° váº¥n thá»±c hiá»‡n Dá»‹chvá»¥ - Thiáº¿t láº­p há»“ sÆ¡ thuáº¿ ban Ä‘áº§u \r\n\r\nTÆ° váº¥n thá»±c hiá»‡n Dá»‹chvá»¥ - BÃ¡o cÃ¡o thuáº¿ hÃ ng thÃ¡ng \r\n\r\nTÆ° váº¥n thá»±c hiá»‡n Dá»‹chvá»¥ - Viáº¿t sá»• sÃ¡ch káº¿ toÃ¡n vÃ  Quyáº¿t toÃ¡n thuáº¿ \r\n\r\nTÆ° váº¥n xÃ¢y dá»±ng cÃ¡c mÃ´ hÃ¬nh káº¿ tÃ³an, tá»• chá»©c vÃ  Ä‘iá»u hÃ nh bá»™ mÃ¡y káº¿ toÃ¡Æ° váº¥n thay Ä‘á»•i Ä‘Äƒng kÃ½ kinh doanh \r\n\r\nTÆ° váº¥n thÃ nh láº­p chi nhÃ¡nh, vÄƒn phÃ²ng Ä‘áº¡i diá»‡n \r\n\r\nTÆ° váº¥n giáº£i thá»ƒ, phÃ¡ sáº£n, mua - bÃ¡n doanh nghiá»‡p \r\n\r\nTÆ° váº¥n cÃ¡c váº¥n Ä‘á» khÃ¡c liÃªn quan Ä‘áº¿n doanh nghiá»‡p \r\n\r\nTÆ° váº¥n Thuáº¿ - Káº¿ toÃ¡n \r\n\r\nTÆ° váº¥n vá» chÃ­nh sÃ¡ch thuáº¿ \r\n\r\nTÆ° váº¥n thá»±c hiá»‡n Dá»‹chvá»¥ - Thiáº¿t láº­p há»“ sÆ¡ thuáº¿ ban Ä‘áº§u \r\n\r\nTÆ° váº¥n thá»±c hiá»‡n Dá»‹chvá»¥ - BÃ¡o cÃ¡o thuáº¿ hÃ ng thÃ¡ng \r\n\r\nTÆ° váº¥n thá»±c hiá»‡n Dá»‹chvá»¥ - Viáº¿t sá»• sÃ¡ch káº¿ toÃ¡n vÃ  Quyáº¿t toÃ¡n thuáº¿ \r\n\r\nTÆ° váº¥n xÃ¢y dá»±ng cÃ¡c mÃ´ hÃ¬nh káº¿ tÃ³an, tá»• chá»©c vÃ  Ä‘iá»u hÃ nh bá»™ mÃ¡y káº¿ toÃ¡','2010-08-16 00:38:37',1,0),
 (2,1,1,'san pham 1',NULL,2,'hspq07@gmail.com','phu quy','01675584174',NULL,NULL,'2010-09-01 16:00:52',0,0),
 (3,4,2,'san pham 12',NULL,2,'hspq07@gmail.com','phu quy','01675584174','chu de lien he','noi dunglien he','2010-09-01 16:02:16',1,0),
 (4,4,1,NULL,NULL,2,'hspq07@gmail.com','phu quy','01675584174','chu de lien he','aaaa','2010-09-01 16:21:34',1,1),
 (5,4,1,'khong co san pahm',NULL,2,'hspq07@gmail.com','phu quy','01675584174','test choi','noi dung test chÆ¡i cho vui','2010-09-01 17:05:23',1,1),
 (6,2,1,NULL,NULL,5,'hspq07@gmail.com','phu quy','01675584174',NULL,'noi dung','2010-09-19 20:23:36',1,1),
 (7,1,1,NULL,NULL,5,'hspq07@gmail.com','phu quy','01675584174','chu de lien he','noi dung','2010-09-19 20:29:59',0,0),
 (8,2,1,NULL,NULL,NULL,'alo@yahoo.com','123456','1234568','tiue d','noi dung','2010-09-19 21:03:24',1,0),
 (9,1,1,NULL,NULL,NULL,'hspq07@gmail.com','phu quy','01675584174','chu de lien he','sadfsdf','2010-09-19 21:07:20',0,0),
 (10,1,1,NULL,NULL,4,'hspq07@gmail.com','phu quy','01675584174','chu de lien he','sadfas','2010-09-19 21:08:29',1,0),
 (30,2,1,NULL,NULL,2,'hspq07@gmail.com','phu quy','01675584174','ná»™i dung chá»§ Ä‘á» gá»­i thÆ° tin nháº¥n te klasfjasjdfl;aksfdl;kasd;lfkl;askdf;laksdfjaslkdfjasdfasdfsfd','sadfsadfasdf','2010-09-21 00:38:50',1,1),
 (29,NULL,NULL,NULL,NULL,2,'hspq07@gmail.com',NULL,NULL,'sdfsd','fsdfsfaf',NULL,1,1),
 (28,NULL,NULL,NULL,NULL,4,'hspq07@gmail.com',NULL,NULL,'asdasd','sdfsfsdfsfsf',NULL,1,0);
/*!40000 ALTER TABLE `inbox` ENABLE KEYS */;


--
-- Definition of table `industry`
--

DROP TABLE IF EXISTS `industry`;
CREATE TABLE `industry` (
  `id_industry` int(10) unsigned NOT NULL auto_increment,
  `industry_name` varchar(100) default NULL,
  `industry_name_EN` varchar(100) default NULL,
  `day_update` datetime default NULL,
  `sort` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_industry`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `industry`
--

/*!40000 ALTER TABLE `industry` DISABLE KEYS */;
INSERT INTO `industry` (`id_industry`,`industry_name`,`industry_name_EN`,`day_update`,`sort`) VALUES 
 (1,'CÃ´ng nghiá»‡p luyá»‡n kim','Luyen kim industry','2010-08-06 03:08:19',1),
 (2,'HÃ³a cháº¥t','Chemical','2010-09-25 02:55:55',2),
 (3,'Váº­t liá»‡u xÃ¢y dá»±ng','building materials','2010-09-25 02:56:30',3),
 (4,'Cháº¿ táº¡o mÃ¡y','manufacturing','2010-09-25 02:56:30',4),
 (5,'NÄƒng lÆ°á»£ng','Electronic','2010-09-25 02:56:30',5);
/*!40000 ALTER TABLE `industry` ENABLE KEYS */;


--
-- Definition of table `intro`
--

DROP TABLE IF EXISTS `intro`;
CREATE TABLE `intro` (
  `id_intro` int(10) unsigned NOT NULL auto_increment,
  `intro_content` text,
  `intro_content_EN` text,
  `intro_day_update` datetime default NULL,
  `intro_visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_intro`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `intro`
--

/*!40000 ALTER TABLE `intro` DISABLE KEYS */;
INSERT INTO `intro` (`id_intro`,`intro_content`,`intro_content_EN`,`intro_day_update`,`intro_visible`) VALUES 
 (1,'\r\n<div><span style=\"font-size: 13px; font-weight: bold; \">I. THÃ€NH Láº¬P</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">CÃ´ng ty TNHH&nbsp;&nbsp;VnTrade360&nbsp;Ä‘Æ°á»£c thÃ nh láº­p theo sá»‘ 4102042305 do Sá»Ÿ Káº¿ hoáº¡ch vÃ  Äáº§u tÆ° TP. Há»“ ChÃ­ Minh cáº¥p ngÃ y : 23/08/2006 bá»• sung ngÃ y 03/07/2008.&nbsp;</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Website www.&nbsp;VnTrade360.com thuá»™c quyá»n quáº£n lÃ½ cá»§a CÃ´ng ty&nbsp;VnTrade360, Ä‘Æ°á»£c Cá»¥c bÃ¡o chÃ­ thuá»™c Bá»™ VÄƒn hÃ³a thÃ´ng tin nay lÃ  Bá»™ ThÃ´ng tin vÃ  truyá»n thÃ´ng cáº¥p ph&eacute;p theo sá»‘ 04/GP â€“ BCngÃ y 08/01/2007&nbsp;</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">ChÃºng tÃ´i lÃ :</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Há»™i viÃªn chÃ­nh thá»©c cá»§a PhÃ²ng ThÆ°Æ¡ng máº¡i vÃ  CÃ´ng nghiá»‡p Viá»‡t Nam (VCCI)</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Há»™i viÃªn Hiá»‡p há»™i thÆ°Æ¡ng máº¡i Ä‘iá»‡n tá»­ Viá»‡t Nam (VECOM )</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Há»™i viÃªn Há»™i doanh nghiá»‡p TP. Há»“ ChÃ­ Minh</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Há»™i viÃªn Há»™i doanh nghiá»‡p tráº» TP. Há»“ ChÃ­ Minh</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small; font-weight: bold; \">II. CHá»¨C NÄ‚NG WEBSITE : WWW.&nbsp;VnTrade360.COM</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Website www.&nbsp;VnTrade360.com : ÄÃ³ng vai trÃ² nhÆ° má»™t sÃ n giao dá»‹ch thÆ°Æ¡ng máº¡i Ä‘iá»‡n tá»­ B2B, lÃ  nÆ¡i há»™i tá»¥, gáº·p gá»¡ cá»§a ngÆ°á»i bÃ¡n vÃ  ngÆ°á»i mua Ä‘á»ƒ tÃ¬m kiáº¿m cÆ¡ há»™i giao thÆ°Æ¡ng, tÃ¬m hiá»ƒu Ä‘á»‘i tÃ¡c,â€¦website Ä‘Æ°á»£c xÃ¢y dá»±ng trÃªn hai ngÃ´n ngá»¯. Tiáº¿ng Anh Ä‘á»ƒ phá»¥c vá»¥ cho cÃ¡c doanh nghiá»‡p chÃ o bÃ¡n sáº£n pháº©m, dá»‹ch vá»¥ tá»›i thá»‹ trÆ°á»ng nÆ°á»›c ngoÃ i. Tiáº¿ng Viá»‡t lÃ  Ä‘á»ƒ phá»¥c vá»¥ cho cÃ¡c doanh nghiá»‡p chÃ o bÃ¡n sáº£n pháº©m, dá»‹ch vá»¥ tá»›i thá»‹ trÆ°á»ng ná»™i Ä‘á»‹a</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">1. SiÃªu thá»‹ sáº£n pháº©m hÃ ng hÃ³a, dá»‹ch vá»¥ Ä‘a dáº¡ng: &nbsp;CÃ¡c loáº¡i sáº£n pháº©m hÃ ng hoÃ¡, dá»‹ch vá»¥ bÃ y bÃ¡n trÃªn&nbsp;&nbsp;VnTrade360.com Ä‘Æ°á»£c sáº¯p xáº¿p thÃ nh cÃ¡c ngÃ nh nghá» má»™t cÃ¡ch khoa há»c, giÃºp ngÆ°á»i mua dá»… dÃ ng tÃ¬m kiáº¿m sáº£n pháº©m, dá»‹ch vá»¥ Ä‘Ãºng nhÆ° mong muá»‘n .</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">2. Danh báº¡ doanh nghiá»‡p theo ngÃ nh nghá»: CÃ¡c doanh nghiá»‡p lÃ  thÃ nh viÃªn cá»§a&nbsp;&nbsp;VnTrade360.com Ä‘Æ°á»£c sáº¯p xáº¿p theo ngÃ nh nghá» hoáº¡t Ä‘á»™ng, giÃºp ngÆ°á»i mua cÃ³ thá»ƒ lá»±a chá»n Ä‘á»‘i tÃ¡c Æ°ng Ã½ nháº¥t. Dá»¯ liá»‡u cá»§a doanh nghiá»‡p trÃªn&nbsp;&nbsp;VnTrade360.com Ä‘Æ°á»£c Ä‘Ã¡nh giÃ¡ lÃ  Ä‘áº§y Ä‘á»§ vÃ  chuáº©n má»±c, lÃ  cÆ¡ sá»Ÿ Ä‘á»ƒ ngÆ°á»i mua vÃ  ngÆ°á»i bÃ¡n xÃ¢y dá»±ng lÃ²ng tin.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">3. Tin mua hÃ ng phong phÃº: &nbsp;CÃ¡c nhu cáº§u mua sáº£n pháº©m, dá»‹ch vá»¥ trong vÃ  ngoÃ i nÆ°á»›c Ä‘Æ°á»£c táº­p trung táº¡i&nbsp;&nbsp;VnTrade360.com theo cÃ¡c ngÃ nh nghá», táº¡o thuáº­n lá»£i cho ngÆ°á»i bÃ¡n tÃ¬m kiáº¿m Ä‘á»‘i tÃ¡c. CÃ¡c doanh nghiá»‡p sáº£n xuáº¥t, cung cáº¥p dá»‹ch vá»¥ hÃ£y truy cáº­p vÃ  tÃ¬m kiáº¿m cho mÃ¬nh má»™t cÆ¡ há»™i há»£p tÃ¡c vá»›i cÃ¡c Ä‘á»‘i tÃ¡c tiá»m nÄƒng.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">4. Tin bÃ¡n hÃ ng phong phÃº: CÃ¡c nhu cáº§u bÃ¡n sáº£n pháº©m, dá»‹ch vá»¥ trong vÃ  ngoÃ i nÆ°á»›c Ä‘Æ°á»£c táº­p trung táº¡i&nbsp;&nbsp;VnTrade360.com theo cÃ¡c ngÃ nh nghá», táº¡o thuáº­n lá»£i cho ngÆ°á»i mua tÃ¬m kiáº¿m Ä‘á»‘i tÃ¡c.&nbsp;</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">5. CÆ¡ há»™i kinh doanh: &nbsp;CÃ¡c nhu cáº§u nhÆ° há»£p tÃ¡c Ä‘á»ƒ má»Ÿ rá»™ng sáº£n xuáº¥t, Ä‘áº§u tÆ°, má»Ÿ Ä‘áº¡i lÃ½, vÄƒn phÃ²ng Ä‘áº¡i diá»‡n,â€¦cá»§a cÃ¡c doanh nghiá»‡p trong vÃ  ngoÃ i nÆ°á»›c.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">6. ThÃ´ng tin luáº­t</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">CÃ¡c vÄƒn báº£n luáº­t</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">CÃ¡c vÄƒn báº£n hÆ°á»›ng dáº«n thi hÃ nh</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Máº«u há»£p Ä‘á»“ng thÃ´ng tin dá»¥ng</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">CÃ´ng ty vÃ  vÄƒn phÃ²ng luáº­t</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Doanh nghiá»‡p cáº§n biáº¿t</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Tin tá»©c &amp; Sá»± kiá»‡n</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">7. ThÃ´ng tin thÆ°Æ¡ng máº¡i</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Tin tá»©c thÆ°Æ¡ng máº¡i: Cáº£nh bÃ¡o, khuyáº¿n cÃ¡o cá»§a thÆ°Æ¡ng vá»¥ Viá»‡t Nam táº¡i cÃ¡c quá»‘c gia, tin thá»‹ trÆ°á»ng,â€¦</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Lá»‹ch há»™i chá»£ triá»ƒn lÃ£m</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Danh sÃ¡ch tham tÃ¡n thÆ°Æ¡ng máº¡i cá»§a Viá»‡t Nam táº¡i nÆ°á»›c ngoÃ i</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">CÃ¡c tá»• chá»©c xÃºc tiáº¿n thÆ°Æ¡ng máº¡i táº¡i Viá»‡t Nam vÃ  nÆ°á»›c ngoÃ i</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Danh sÃ¡ch cÃ¡c ngÃ¢n hÃ ng thÆ°Æ¡ng máº¡i cá»§a Viá»‡t Nam vÃ  nÆ°á»›c ngoÃ i</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Danh sÃ¡ch cÃ¡c cÆ¡ quan giÃ¡m Ä‘á»‹nh</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Danh sÃ¡ch cÃ¡c Ä‘Æ¡n vá»‹ giao nháº­n, xuáº¥t nháº­p kháº©u uá»· thÃ¡c</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">8. ThÃ´ng tin du lá»‹ch</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Danh lam tháº¯ng cáº£nh</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Há»‡ thá»‘ng nhÃ  hÃ ng &amp; khÃ¡ch sáº¡n</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Tour du lá»‹ch</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Äá»‹a Ä‘iá»ƒm mua sáº¯m</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Cáº©m nang du lá»‹ch</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Tin tá»©c &amp; Sá»± kiá»‡n</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">III. PHÆ¯Æ NG THá»¨C HOáº T Äá»˜NG</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">1. Äá»‘i tÃ¡c nÆ°á»›c ngoÃ i</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">ThÃ´ng qua cÃ¡c hoáº¡t Ä‘á»™ng tiáº¿p thá»‹ cá»§a&nbsp;&nbsp;VnTrade360, cÃ¡c Ä‘á»‘i tÃ¡c nÆ°á»›c ngoÃ i ( bao gá»“m cÃ¡c nhÃ  nháº­p kháº©u, mua sá»‰) truy cáº­p vÃ o www.&nbsp;VnTrade360.com Ä‘á»ƒ tÃ¬m kiáº¿m sáº£n pháº©m, hÃ ng hÃ³a suáº¥t xá»© tá»« Viá»‡t Nam. Qua Ä‘Ã³, cÃ¡c doanh nghiá»‡p Viá»‡t Nam cÃ³ cÆ¡ há»™i gáº·p gá»¡ vá»›i Ä‘á»‘i tÃ¡c nÆ°á»›c ngoÃ i Ä‘á»ƒ thá»±c hiá»‡n cÃ¡c há»£p Ä‘á»“ng xuáº¥t kháº©u sáº£n pháº©m cá»§a mÃ¬nh.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">2. Äá»‘i tÃ¡c trong nÆ°á»›c:</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">www.&nbsp;VnTrade360.com cÃ²n lÃ  nÆ¡i gáº·p gá»¡, mua bÃ¡n giá»¯a cÃ¡c doanh nghiá»‡p Viá»‡t Nam vá»›i nhau. Vá»›i pháº§n giao diá»‡n tiáº¿ng Viá»‡t www.vn.&nbsp;VnTrade360.com , giao diá»‡n gian hÃ ng thÃ nh viÃªn Ä‘Ã£ Ä‘Æ°á»£c Ä‘iá»u chá»‰nh cho phÃ¹ há»£p vá»›i Ä‘áº·c Ä‘iá»ƒm cá»§a thá»‹ ná»™i Ä‘á»‹a. Äá»‘i tÃ¡c cá»§a má»™t thÃ nh viÃªn cÃ³ thá»ƒ lÃ  má»™t thÃ nh viÃªn khÃ¡c, hoáº·c cÃ³ thá»ƒ lÃ  khÃ¡ch ngoÃ i thÃ nh viÃªn. Tuy nhiÃªn, viá»‡c tham gia vÃ o&nbsp;&nbsp;VnTrade360.com cÅ©ng cÃ³ tÃ¡c dá»¥ng tá»›i doanh sá»‘ bÃ¡n láº» tá»›i ngÆ°á»i tiÃªu dÃ¹ng, vÃ¬ sáº½ cÃ³ nhiá»u ngÆ°á»i tiÃªu dÃ¹ng biáº¿t tá»›i sáº£n pháº©m, dá»‹ch vá»¥ cá»§a doanh nghiá»‡p.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small; font-weight: bold; \">IV. Lá»¢I ÃCH Cá»¦A THÃ€NH VIÃŠN ÄÄ‚NG KÃ THAM GIA</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">1. CÃ³ thÃªm má»™t kÃªnh tiáº¿p thá»‹, quáº£ng bÃ¡ sáº£n pháº©m, dá»‹ch vá»¥</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Má»—i doanh nghiá»‡p tham gia vÃ o&nbsp;&nbsp;VnTrade360.com Ä‘Æ°á»£c táº¡o 02 gian hÃ ng ( 1 gian báº±ng tiáº¿ng Viá»‡t, phá»¥c vá»¥ quáº£ng bÃ¡ thá»‹ trÆ°á»ng ná»™i Ä‘á»‹a, 1 gian hÃ ng báº±ng tiáº¿ng Anh phá»¥c vá»¥ quáº£ng bÃ¡ thá»‹ trÆ°á»ng quá»‘c táº¿). Trong gian hÃ ng cÃ³ cÃ¡c chá»©c nÄƒng nhÆ° :&nbsp;</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">ThÃ´ng tin giá»›i thiá»‡u doanh nghiá»‡p: Giá»›i thiá»‡u bá»™ thÃ´ng tin cá»§a doanh nghiá»‡p nháº±m thá»ƒ hiá»‡n nÄƒng lá»±c, quy mÃ´ vÃ  kinh nghiÃªm hoáº¡t Ä‘á»™ng cá»§a doanh nghiá»‡p, táº¡o tÃ¢m lÃ½ tin tÆ°á»Ÿng cho cÃ¡c Ä‘á»‘i tÃ¡c.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Danh sÃ¡ch sáº£n pháº©m: Giá»›i thiá»‡u cÃ¡c sáº£n pháº©m tiÃªu biá»ƒu cá»§a doanh nghiá»‡p vá»›i cÃ¡c thÃ´ng tin mÃ´ táº£ Ä‘áº§y Ä‘á»§, hÃ¬nh áº£nh rÃµ rÃ ng.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">ThÃ´ng tin chÃ o bÃ¡n: Giá»›i thiá»‡u cÃ¡c sáº£n pháº©m chÃ o bÃ¡n vá»›i thÃ´ng tin bÃ¡n hÃ ng Ä‘áº·c biá»‡t nhÆ° sáº£n pháº©m má»›i, sáº£n pháº©m khuyáº¿n mÃ£i,â€¦</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">ThÃ´ng tin dá»‹ch vá»¥: Giá»›i thiá»‡u cÃ¡c dá»‹ch vá»¥ hiá»‡n cÃ³ cá»§a doanh nghiá»‡p</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">ThÃ´ng tin chÃ o mua: Giá»›i thiá»‡u cÃ¡c nhu cáº§u mua cá»§a doanh nghiá»‡p phá»¥c vá»¥ cho quÃ¡ trÃ¬nh hoáº¡t Ä‘á»™ng : tin mua nguyÃªn liá»‡u, mua thiáº¿t bá»‹ mÃ¡y mÃ³c,â€¦</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">&nbsp;ThÃ´ng tin tÃ¬m kiáº¿m Ä‘á»‘i tÃ¡c há»£p tÃ¡c kinh doanh: Giá»›i thiá»‡u thÃ´ng tin vá» há»£p tÃ¡c Ä‘á»ƒ phÃ¡t triá»ƒn dá»‹ch vá»¥, sáº£n xuáº¥t cá»§a doanh nghiá»‡p</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">2. Thu tháº­p Ä‘Æ°á»£c nhiá»u thÃ´ng tin thÆ°Æ¡ng máº¡i</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Vá»›i chá»©c nÄƒng lÃ  má»™t trung tÃ¢m thÃ´ng tin,&nbsp;&nbsp;VnTrade360.com cung cáº¥p cho cÃ¡c doanh nghiá»‡p nhiá»u thÃ´ng tin liÃªn quan Ä‘áº¿n hoáº¡t Ä‘á»™ng sáº£n xuáº¥t, knh doanh nhÆ° : Thá»‹ trÆ°á»ng, Ä‘á»‘i tÃ¡c, phÃ¡p lÃ½,â€¦giÃºp cho cÃ¡c doanh nghiá»‡p náº¯m Ä‘Æ°á»£c thÃ´ng tin phong phÃº vá» thá»‹ trÆ°á»ng, tá»« Ä‘Ã³ cÃ³ thá»ƒ xÃ¢y dá»±ng Ä‘Æ°á»£c chiáº¿n lÆ°á»£c sáº£n xuáº¥t, kinh doanh thÃ­ch há»£p vá»›i xu tháº¿ phÃ¡t triá»ƒn cá»§a cá»§a thá»‹ trÆ°á»ng trong nÆ°á»›c, khu vá»±c vÃ  quá»‘c táº¿.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">3. Giáº£m chi phÃ­ sáº£n xuáº¥t: ThÃ´ng qua thÆ°Æ¡ng máº¡i Ä‘iá»‡n tá»­ giÃºp doanh nghiá»‡p tÃ¬m kiáº¿m Ä‘Æ°á»£c cÃ¡c Ä‘á»‘i tÃ¡c cung cáº¥p nguyÃªn liá»‡u vá»›i giÃ¡ cáº£ ráº» hÆ¡n, giÃºp doanh nghiá»‡p giáº£m Ä‘Æ°á»£c chi phÃ­ Ä‘áº§u vÃ o cá»§a sáº£n xuáº¥t.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">4. Giáº£m chi phÃ­ bÃ¡n hÃ ng, tiáº¿p thá»‹ vÃ  giao dá»‹ch</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">TrÆ°á»›c háº¿t, TMÄT giÃºp doanh nghiá»‡p giáº£m Ä‘Æ°á»£c chi phÃ­ thuÃª máº·t báº±ng, Ä‘iá»‡n, nÆ°á»›c, nhÃ¢n cÃ´ng. Báº±ng viá»‡c xÃ¢y dá»±ng gian hÃ ng trÃªn cá»•ng thÃ´ng tin thÆ°Æ¡ng máº¡i Ä‘iá»‡n tá»­, má»™t nhÃ¢n viÃªn bÃ¡n hÃ ng cá»§a doanh nghiá»‡p cÃ³ thá»ƒ giao dá»‹ch Ä‘Æ°á»£c vá»›i ráº¥t nhiá»u khÃ¡ch hÃ ng, catalogue Ä‘iá»‡n tá»­ trÃªn cÃ¡c trang web khÃ´ng nhá»¯ng phong phÃº hÆ¡n mÃ  cÃ²n thÆ°á»ng xuyÃªn Ä‘Æ°á»£c cáº­p nháº­t so vá»›i cÃ¡c catalogue in áº¥n khuÃ´n khá»• giá»›i háº¡n vÃ  luÃ´n luÃ´n lá»—i thá»i.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">5. GiÃºp thiáº¿t láº­p cá»§ng cá»‘ Ä‘á»‘i tÃ¡c&nbsp;</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">TMÄT táº¡o Ä‘iá»u kiá»‡n cho viá»‡c thiáº¿t láº­p vÃ  cá»§ng cá»‘ má»‘i quan há»‡ giá»¯a cÃ¡c Ä‘á»‘i tÃ¡c tham gia vÃ o quÃ¡ trÃ¬nh thÆ°Æ¡ng máº¡i. ThÃ´ng qua máº¡ng, cÃ¡c Ä‘á»‘i tÃ¡c tham gia cÃ³ thá»ƒ giao tiáº¿p trá»±c tiáº¿p vÃ  liÃªn tá»¥c vá»›i nhau nhá» Ä‘Ã³ sá»± há»£p tÃ¡c láº«n sá»± quáº£n lÃ½ Ä‘á»u Ä‘Æ°á»£c tiáº¿n hÃ nh nhanh chÃ³ng vÃ  liÃªn tá»¥c; táº¡o Ä‘iá»u kiá»‡n tÃ¬m kiáº¿m cÃ¡c báº¡n hÃ ng má»›i, cÆ¡ há»™i kinh doanh má»›i trong nÆ°á»›c vÃ  nÆ°á»›c ngoÃ i.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><span style=\"font-weight: bold; \">V. TÃNH NÄ‚NG Cá»¦A WWW.&nbsp;VnTrade360.COM </span>:&nbsp;</span></div>\r\n\r\n<div><span style=\"font-size: small;\">ChÃºng tÃ´i luÃ´n quan tÃ¢m tá»›i viá»‡c táº¡o ra nhiá»u cÆ¡ há»™i Ä‘á»ƒ Ä‘á»‘i tÃ¡c tÃ¬m tháº¥y doanh nghiá»‡p thÃ nh viÃªn cá»§a&nbsp;&nbsp;VnTrade360. Hay nÃ³i cÃ¡ch khÃ¡c, chÃºng tÃ´i táº¡o ra nhiá»u hoáº¡t Ä‘á»™ng Ä‘á»ƒ doanh nghiá»‡p tham gia trÃªn&nbsp;&nbsp;VnTrade360.com cÃ³ nhiá»u cÆ¡ há»™i thÃ nh cÃ´ng.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">CÃ¡c Ä‘iá»ƒm tiáº¿p cáº­n: LÃ  cÃ¡c Ä‘iá»ƒm mÃ  qua Ä‘Ã³, cÃ¡c Ä‘á»‘i tÃ¡c cÃ³ thá»ƒ \"nhÃ¬nâ€ tháº¥y doanh nghiá»‡p. Hiá»‡n nay chÃºng tÃ´i cÃ³ cÃ¡c Ä‘iá»ƒm tiáº¿p cáº­n sau:</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Tin bÃ¡n</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Tin mua</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Tin há»£p tÃ¡c Ä‘áº§u tÆ°</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">&nbsp;Sáº£n pháº©m tiÃªu biá»ƒu</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Doanh nghiá»‡p tiÃªu biá»ƒu</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Quáº£ng cÃ¡o logo</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Quáº£ng cÃ¡o banner</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Video clip cá»§a doanh nghiá»‡p</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">CÃ¢u chuyá»‡n doanh nghiá»‡p: Cung cáº¥p bÃ i PR cá»§a doanh nghiá»‡p</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">TÃ¬m kiáº¿m: PhÆ°Æ¡ng phÃ¡p tÃ¬m kiáº¿m cá»§a&nbsp;&nbsp;VnTrade360.com Ä‘Æ°á»£c dá»±a trÃªn 3 cÆ¡ cháº¿ tÃ¬m kiáº¿m:</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">TÃ¬m kiáº¿m theo ngÃ nh nghá»: Má»—i doanh nghiá»‡p tham gia trÃªn&nbsp;&nbsp;VnTrade360.com sáº½ Ä‘Æ°á»£c quáº£n lÃ½ theo ngÃ nh nghá». CÃ¡c Ä‘á»‘i tÃ¡c dá»… dÃ ng tÃ¬m kiáº¿m tháº¥y nhÃ  cung cáº¥p sáº£n pháº©m, dá»‹ch vá»¥ thÃ´ng qua thao tÃ¡c click chuá»™t vÃ o cÃ¢y ngÃ nh nghá» cÃ³ chá»©a sáº£n pháº©m, dá»‹ch vá»¥ cáº§n tÃ¬m.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">TÃ¬m kiáº¿m theo tá»« khÃ³a: Má»—i doanh nghiá»‡p tham gia trÃªn&nbsp;&nbsp;VnTrade360.com sáº½ cÃ³ tá»« khÃ³a doanh nghiá»‡p. Má»—i sáº£n pháº©m cÃ³ tá»« khÃ³a sáº£n pháº©m. CÃ¡c Ä‘á»‘i tÃ¡c chá»‰ cáº§n nháº­p tá»« khÃ³a loáº¡i sáº£n pháº©m cáº§n mua, káº¿t quáº£ sáº½ hiá»‡n ra nhá»¯ng sáº£n pháº©m cá»§a cÃ¡c doanh nghiá»‡p theo nhÆ° mong muá»‘n cá»§a Ä‘á»‘i tÃ¡c.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">TÃ¬m kiáº¿m nÃ¢ng cao: &nbsp;TÃ¬m kiáº¿m nÃ¢ng cao cho ph&eacute;p Ä‘á»‘i tÃ¡c Ä‘Æ°a vÃ o nhiá»u Ä‘iá»u kiá»‡n tÃ¬m Ä‘á»ƒ háº¡n cháº¿ káº¿t quáº£ tÃ¬m kiáº¿m. Káº¿t quáº£ tÃ¬m kiáº¿m lÃ  cÃ¡c sáº£n pháº©m, cÃ¡c doanh nghiá»‡p thá»a mÃ£n cÃ¡c Ä‘iá»u kiá»‡n tÃ¬m cao hÆ¡n má»©c thÃ´ng thÆ°á»ng.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small; font-weight: bold; \">VI. CÃCH ÄÄ‚NG KÃ THÃ€NH VIÃŠN</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Chá»‰ cáº§n dÃ nh má»™t Ã­t thá»i gian, má»—i doanh nghiá»‡p cÃ³ thá»ƒ táº¡o cho mÃ¬nh má»™t kÃªnh bÃ¡n hÃ ng trÃªn&nbsp;&nbsp;VnTrade360.com báº±ng cÃ¡ch Ä‘Äƒng kÃ½ tÃ i khoáº£n.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">BÆ°á»›c 1: ÄÄƒng kÃ½ ( theo qua trÃ¬nh 3 bÆ°á»›c )</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">BÆ°á»›c 2: Truy cáº­p vÃ o email ( Ä‘Ã£ sá»­ dá»¥ng á»Ÿ bÆ°á»›c 1) Ä‘á»ƒ kÃ­ch hoáº¡t tÃ i khoáº£n</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">BÆ°á»›c 3 : ÄÄƒng nháº­p vÃ o tÃ i khoáº£n Ä‘á»ƒ Ä‘Æ°a xÃ¢y dá»±ng gian hÃ ng hoÃ n chá»‰nh nhÆ°</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Sau khi nháº­n Ä‘Æ°á»£c thÃ´ng tin Ä‘Äƒng kÃ½ tá»« phÃ­a doanh nghiá»‡p, bá»™ pháº­n kiá»ƒm soÃ¡t thÃ´ng tin doanh nghiá»‡p sáº½ kÃ­ch hoáº¡t tÃ i khoáº£n vÃ  sáº½ cá»­ nhÃ¢n viÃªn tÆ° váº¥n cho doanh nghiá»‡p Ä‘Æ°a thÃ´ng tin doanh nghiá»‡p, thÃ´ng tin sáº£n pháº©m sao cho gian hÃ ng hoáº¡t Ä‘á»™ng cÃ³ hiá»‡u quáº£.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small; font-weight: bold; \">VII. CÃC Dá»ŠCH Vá»¤ Cá»¦A&nbsp;&nbsp;VnTrade360</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">1. ThÃ nh viÃªn cÃ³ phÃ­</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">2. Thiáº¿t káº¿ website, cho thuÃª hosting, domain, webmail</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">3. Quáº£ng cÃ¡o Google adwords</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">4. Thiáº¿t káº¿ pháº§n má»m</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small; font-weight: bold; \">VIII. Sá»¨ Má»†NH</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\"><br />\r\n		\r\n		\r\n		\r\n		</span>\r\n		\r\n	\r\n	\r\n	</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">Vá»›i chá»©c nÄƒng lÃ  má»™t Ä‘Æ¡n vá»‹ xÃºc tiáº¿n thÆ°Æ¡ng máº¡i Ä‘iá»‡n tá»­, chÃºng tÃ´i táº¡o ra má»™t kÃªnh má»›i tiáº¿p thá»‹, quáº£ng bÃ¡ sáº£n pháº©m, dá»‹ch vá»¥ cá»§a doanh nghiá»‡p theo phÆ°Æ¡ng thá»©c sá»­ dá»¥ng máº¡ng internet lÃ m ná»n táº£ng. LÃ m tÄƒng sá»©c cáº¡nh tranh vÃ  lá»£i nhuáº­n cho doanh nghiá»‡p trong thá»i ká»³ há»™i nháº­p. HÃ£y tham gia vÃ o&nbsp;&nbsp;VnTrade360.com Ä‘á»ƒ mang láº¡i nhá»¯ng cÆ¡ há»™i cho doanh nghiá»‡p cá»§a mÃ¬nh.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><span style=\"font-size: small;\">&nbsp;VnTrade360&nbsp;ráº¥t vinh háº¡nh Ä‘Æ°á»£c lÃ m sá»© giáº£ thÃ´ng tin Ä‘á»ƒ lÃ m tÄƒng giÃ¡ trá»‹ lá»£i nhuáº­n cho doanh nghiá»‡p.</span></div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<div><br />\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	</div>\r\n	        ','about company         ','2010-07-29 18:16:46',1);
/*!40000 ALTER TABLE `intro` ENABLE KEYS */;


--
-- Definition of table `loguser`
--

DROP TABLE IF EXISTS `loguser`;
CREATE TABLE `loguser` (
  `id_loguser` int(10) unsigned NOT NULL auto_increment,
  `id_member` int(10) unsigned NOT NULL,
  `iploguser` varchar(45) default NULL,
  `datetimein` datetime default NULL,
  `datetimeout` datetime default NULL,
  `sessionloguser` varchar(100) default NULL,
  PRIMARY KEY  (`id_loguser`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loguser`
--

/*!40000 ALTER TABLE `loguser` DISABLE KEYS */;
INSERT INTO `loguser` (`id_loguser`,`id_member`,`iploguser`,`datetimein`,`datetimeout`,`sessionloguser`) VALUES 
 (1,1,'127.0.0.1','2010-08-20 12:47:56','2010-08-20 12:47:56','77cccc65681574ab303233482c39bb8d'),
 (2,1,'127.0.0.1','2010-08-20 12:49:18','2010-08-20 12:49:18','77cccc65681574ab303233482c39bb8d'),
 (3,1,'127.0.0.1','2010-08-20 12:51:38','2010-08-20 12:51:38','77cccc65681574ab303233482c39bb8d'),
 (4,1,'127.0.0.1','2010-08-20 12:51:50','2010-08-20 12:51:50','77cccc65681574ab303233482c39bb8d'),
 (5,1,'127.0.0.1','2010-08-20 12:52:18','2010-08-20 12:52:18','77cccc65681574ab303233482c39bb8d'),
 (6,2,'127.0.0.1','2010-08-20 12:54:10','2010-08-20 12:54:10','77cccc65681574ab303233482c39bb8d'),
 (7,1,'127.0.0.1','2010-08-20 12:56:17','2010-08-20 12:56:17','77cccc65681574ab303233482c39bb8d'),
 (8,1,'127.0.0.1','2010-08-20 13:05:33','2010-08-20 13:05:33','77cccc65681574ab303233482c39bb8d'),
 (9,1,'127.0.0.1','2010-08-20 16:05:15','2010-08-20 16:05:15','77cccc65681574ab303233482c39bb8d'),
 (10,1,'127.0.0.1','2010-08-20 16:11:45','2010-08-20 16:11:45','77cccc65681574ab303233482c39bb8d'),
 (11,0,'127.0.0.1','2010-08-21 02:07:15','2010-08-20 18:35:40','b408d9b3043d1a60d79cbb17ce5a6b3f'),
 (12,0,'127.0.0.1','2010-08-21 08:52:55','2010-08-21 08:36:10','25d842a2c249a650abc1366ef7bbb735'),
 (13,0,'127.0.0.1','2010-08-21 11:07:37','2010-08-21 10:57:03','6833de511792266c9d12ccdf77b1b0c2'),
 (14,1,'127.0.0.1','2010-08-21 15:14:31','2010-08-21 14:31:05','364a5e52a7050bc924dcb16e916fb9cf'),
 (15,1,'127.0.0.1','2010-08-21 16:43:39','2010-08-21 16:35:16','da9d60d9d93ed17bae41cc9e9576ade5'),
 (16,0,'127.0.0.1','2010-08-21 22:21:10','2010-08-21 19:55:10','2ca418f01879e8402206062d9a76b802'),
 (17,2,'127.0.0.1','2010-08-21 22:21:28','2010-08-21 22:21:28','2ca418f01879e8402206062d9a76b802'),
 (18,1,'127.0.0.1','2010-08-21 22:21:55','2010-08-21 22:21:55','2ca418f01879e8402206062d9a76b802'),
 (19,0,'127.0.0.1','2010-08-21 22:27:42','2010-08-21 22:22:42','2ca418f01879e8402206062d9a76b802'),
 (20,1,'127.0.0.1','2010-08-21 22:28:19','2010-08-21 22:28:19','2ca418f01879e8402206062d9a76b802'),
 (21,1,'127.0.0.1','2010-08-21 22:30:30','2010-08-21 22:30:30','2ca418f01879e8402206062d9a76b802'),
 (22,0,'127.0.0.1','2010-08-21 23:42:42','2010-08-21 22:42:20','2ca418f01879e8402206062d9a76b802'),
 (23,1,'127.0.0.1','2010-08-21 23:43:09','2010-08-21 23:43:09','2ca418f01879e8402206062d9a76b802'),
 (24,1,'127.0.0.1','2010-08-22 02:04:19','2010-08-21 23:44:22','2ca418f01879e8402206062d9a76b802'),
 (25,0,'127.0.0.1','2010-08-22 10:35:13','2010-08-22 10:29:57','7126dda8b14cbeb8b6305d31ac996683'),
 (26,0,'127.0.0.1','2010-08-23 01:41:08','2010-08-23 00:46:30','7126dda8b14cbeb8b6305d31ac996683'),
 (27,0,'127.0.0.1','2010-08-23 09:02:34','2010-08-23 09:02:29','5920764ba2116a9160e9cc41bd179541'),
 (28,0,'127.0.0.1','2010-08-23 17:18:38','2010-08-23 15:33:36','412160bdc8a8232c0d02d6434089e572'),
 (29,1,'127.0.0.1','2010-08-24 14:08:19','2010-08-24 14:08:19','d4e077ec255db20c8c9c12e78c61a1dd'),
 (30,0,'127.0.0.1','2010-08-24 19:42:44','2010-08-24 14:08:26','d4e077ec255db20c8c9c12e78c61a1dd'),
 (31,0,'127.0.0.1','2010-08-25 00:13:45','2010-08-25 00:08:45','b608a99964c80a495ffd84ae01644065'),
 (32,0,'127.0.0.1','2010-08-25 09:43:46','2010-08-25 08:34:27','1b14671c2baf14e01c719ed5d4083f7d'),
 (33,0,'127.0.0.1','2010-08-25 17:43:03','2010-08-25 15:36:50','c0963a464a230f659bc87bcea51cc751'),
 (34,0,'127.0.0.1','2010-08-25 20:27:18','2010-08-25 19:33:02','31a02ca840c24bc50b6c472f3a408d46'),
 (35,0,'127.0.0.1','2010-08-25 23:16:29','2010-08-25 23:16:18','66fd97ab3d230bdcf10165740a43be34'),
 (36,1,'127.0.0.1','2010-08-25 23:16:40','2010-08-25 23:16:40','66fd97ab3d230bdcf10165740a43be34'),
 (37,1,'127.0.0.1','2010-08-25 23:18:49','2010-08-25 23:18:49','66fd97ab3d230bdcf10165740a43be34'),
 (38,1,'127.0.0.1','2010-08-25 23:18:53','2010-08-25 23:18:53','66fd97ab3d230bdcf10165740a43be34'),
 (39,3,'127.0.0.1','2010-08-25 23:30:33','2010-08-25 23:30:33','66fd97ab3d230bdcf10165740a43be34'),
 (40,3,'127.0.0.1','2010-08-25 23:30:48','2010-08-25 23:30:48','66fd97ab3d230bdcf10165740a43be34'),
 (41,3,'127.0.0.1','2010-08-25 23:31:03','2010-08-25 23:31:03','66fd97ab3d230bdcf10165740a43be34'),
 (42,3,'127.0.0.1','2010-08-25 23:31:33','2010-08-25 23:31:22','66fd97ab3d230bdcf10165740a43be34'),
 (43,0,'127.0.0.1','2010-08-25 23:31:51','2010-08-25 23:31:48','66fd97ab3d230bdcf10165740a43be34'),
 (44,0,'127.0.0.1','2010-08-25 23:40:10','2010-08-25 23:40:03','66fd97ab3d230bdcf10165740a43be34'),
 (45,0,'127.0.0.1','2010-08-25 23:40:25','2010-08-25 23:40:20','66fd97ab3d230bdcf10165740a43be34'),
 (46,1,'127.0.0.1','2010-08-25 23:47:20','2010-08-25 23:47:20','66fd97ab3d230bdcf10165740a43be34'),
 (47,1,'127.0.0.1','2010-08-25 23:49:35','2010-08-25 23:49:35','66fd97ab3d230bdcf10165740a43be34'),
 (48,0,'127.0.0.1','2010-08-25 23:52:53','2010-08-25 23:52:53','66fd97ab3d230bdcf10165740a43be34'),
 (49,1,'127.0.0.1','2010-08-25 23:53:02','2010-08-25 23:53:02','66fd97ab3d230bdcf10165740a43be34'),
 (50,0,'127.0.0.1','2010-08-26 00:00:05','2010-08-26 00:00:05','66fd97ab3d230bdcf10165740a43be34'),
 (51,1,'127.0.0.1','2010-08-26 00:00:13','2010-08-26 00:00:13','66fd97ab3d230bdcf10165740a43be34'),
 (52,1,'127.0.0.1','2010-08-26 00:02:38','2010-08-26 00:02:38','66fd97ab3d230bdcf10165740a43be34'),
 (53,1,'127.0.0.1','2010-08-26 00:04:29','2010-08-26 00:04:29','66fd97ab3d230bdcf10165740a43be34'),
 (54,1,'127.0.0.1','2010-08-26 00:04:32','2010-08-26 00:04:32','66fd97ab3d230bdcf10165740a43be34'),
 (55,1,'127.0.0.1','2010-08-26 00:04:43','2010-08-26 00:04:43','66fd97ab3d230bdcf10165740a43be34'),
 (56,1,'127.0.0.1','2010-08-26 00:14:42','2010-08-26 00:14:42','66fd97ab3d230bdcf10165740a43be34'),
 (57,1,'127.0.0.1','2010-08-26 00:14:48','2010-08-26 00:14:48','66fd97ab3d230bdcf10165740a43be34'),
 (58,1,'127.0.0.1','2010-08-26 00:29:31','2010-08-26 00:29:31','66fd97ab3d230bdcf10165740a43be34'),
 (59,3,'127.0.0.1','2010-08-26 00:35:57','2010-08-26 00:35:57','66fd97ab3d230bdcf10165740a43be34'),
 (60,4,'127.0.0.1','2010-08-26 00:45:04','2010-08-26 00:45:04','66fd97ab3d230bdcf10165740a43be34'),
 (61,1,'127.0.0.1','2010-08-26 11:33:08','2010-08-26 01:09:23','66fd97ab3d230bdcf10165740a43be34'),
 (62,2,'127.0.0.1','2010-08-26 01:16:17','2010-08-26 01:16:17','66fd97ab3d230bdcf10165740a43be34'),
 (63,3,'127.0.0.1','2010-08-26 01:16:28','2010-08-26 01:16:28','66fd97ab3d230bdcf10165740a43be34'),
 (64,4,'127.0.0.1','2010-08-26 11:31:27','2010-08-26 01:42:08','66fd97ab3d230bdcf10165740a43be34'),
 (65,1,'127.0.0.1','2010-08-26 13:35:44','2010-08-26 13:22:14','9a02ff0ff68066395e679f20845adfe9'),
 (66,1,'127.0.0.1','2010-08-26 13:38:49','2010-08-26 13:38:49','9a02ff0ff68066395e679f20845adfe9'),
 (67,1,'127.0.0.1','2010-08-26 21:13:33','2010-08-26 21:12:17','9a02ff0ff68066395e679f20845adfe9'),
 (68,2,'127.0.0.1','2010-08-26 21:13:47','2010-08-26 21:13:47','9a02ff0ff68066395e679f20845adfe9'),
 (69,2,'127.0.0.1','2010-08-26 22:26:04','2010-08-26 22:26:04','ea8ee783c9da48e8f077d84adc664323'),
 (70,2,'127.0.0.1','2010-08-27 03:47:37','2010-08-27 03:47:37','ea8ee783c9da48e8f077d84adc664323'),
 (71,1,'127.0.0.1','2010-08-28 09:57:24','2010-08-28 09:57:24','3e65620e962cfbf946c7c5724924c9ab'),
 (72,1,'127.0.0.1','2010-08-28 15:27:26','2010-08-28 15:27:26','3e65620e962cfbf946c7c5724924c9ab'),
 (73,1,'127.0.0.1','2010-08-28 16:24:14','2010-08-28 16:24:14','3e65620e962cfbf946c7c5724924c9ab'),
 (74,1,'127.0.0.1','2010-08-28 21:52:53','2010-08-28 19:22:10','0dae47a16c111b9709ceb4496c0ba92e'),
 (75,1,'127.0.0.1','2010-08-29 07:40:49','2010-08-29 07:40:49','403ac34c2051a240f887d18435421d6d'),
 (76,1,'127.0.0.1','2010-08-29 09:50:06','2010-08-29 09:50:06','2b50951595485bfd6211de13fbac9f2b'),
 (77,1,'127.0.0.1','2010-08-29 19:56:26','2010-08-29 17:31:25','392e63b17bd90eac76205756de6ba9f5'),
 (78,2,'127.0.0.1','2010-08-29 19:57:19','2010-08-29 19:57:19','392e63b17bd90eac76205756de6ba9f5'),
 (79,2,'127.0.0.1','2010-08-30 00:22:20','2010-08-30 00:22:20','ab021f0256d9ffaf184cd24fae4b368f'),
 (80,2,'127.0.0.1','2010-08-30 10:21:01','2010-08-30 08:14:55','11fee197920406ee494397074c747f67'),
 (81,1,'127.0.0.1','2010-08-30 11:10:51','2010-08-30 10:22:00','11fee197920406ee494397074c747f67'),
 (82,2,'127.0.0.1','2010-08-30 11:13:47','2010-08-30 11:11:05','11fee197920406ee494397074c747f67'),
 (83,1,'127.0.0.1','2010-08-30 12:30:19','2010-08-30 11:14:00','11fee197920406ee494397074c747f67'),
 (84,1,'127.0.0.1','2010-08-30 12:36:47','2010-08-30 12:36:47','11fee197920406ee494397074c747f67'),
 (85,2,'127.0.0.1','2010-08-30 18:45:11','2010-08-30 18:45:11','2a3941f8daf8ce4b6714788a4841075c'),
 (86,2,'127.0.0.1','2010-08-30 22:04:23','2010-08-30 21:55:23','12659436fe7b1031196d3484ac027d74'),
 (87,2,'127.0.0.1','2010-08-31 07:40:40','2010-08-31 07:40:40','450646c8512f4177ac3f74888ed135da'),
 (88,1,'127.0.0.1','2010-08-31 11:51:47','2010-08-31 11:51:47','3c4317758a71c4753b11a1583631d07c'),
 (89,1,'127.0.0.1','2010-08-31 15:45:06','2010-08-31 15:45:06','0b16037c37cfb333868c085d82c8c705'),
 (90,1,'127.0.0.1','2010-08-31 18:22:52','2010-08-31 18:22:38','0b16037c37cfb333868c085d82c8c705'),
 (91,2,'127.0.0.1','2010-08-31 18:23:04','2010-08-31 18:23:04','0b16037c37cfb333868c085d82c8c705'),
 (92,2,'127.0.0.1','2010-08-31 18:25:36','2010-08-31 18:25:36','f7b1063fed1fe4ffc51d10c8a6fb6b57'),
 (93,2,'127.0.0.1','2010-08-31 18:30:43','2010-08-31 18:30:43','a7e176c1647165611ee6987b5b8d585d'),
 (94,2,'127.0.0.1','2010-08-31 22:38:07','2010-08-31 22:38:07','82a3cb09393d72dcf3dc8208bec58840'),
 (95,2,'127.0.0.1','2010-09-01 02:01:01','2010-09-01 02:01:01','5154287f7e92eb5a90538c2d76e1ffed'),
 (96,2,'127.0.0.1','2010-09-01 10:43:16','2010-09-01 10:43:16','8aab5b4d2603202b582d25b16cdbd548'),
 (97,2,'127.0.0.1','2010-09-01 10:52:01','2010-09-01 10:52:01','f79b58948b90dad8642e91296f321ddf'),
 (98,2,'127.0.0.1','2010-09-01 14:12:14','2010-09-01 14:12:14','1d010f6366748bd2f81c5a11b027c97d'),
 (99,2,'127.0.0.1','2010-09-01 20:02:32','2010-09-01 20:02:32','1d010f6366748bd2f81c5a11b027c97d'),
 (100,1,'192.168.1.34','2010-09-01 21:41:37','2010-09-01 21:41:37','62c78d7ed41096259177b2f53266c80e'),
 (101,1,'127.0.0.1','2010-09-01 22:42:51','2010-09-01 22:42:13','b95ded7c632c474216060bb0e8e1b4e2'),
 (102,2,'127.0.0.1','2010-09-01 22:43:01','2010-09-01 22:43:01','b95ded7c632c474216060bb0e8e1b4e2'),
 (103,1,'127.0.0.1','2010-09-02 18:41:30','2010-09-02 18:41:30','b1cabfc55684846d0b5a75d673be8241'),
 (104,2,'127.0.0.1','2010-09-02 23:39:51','2010-09-02 23:39:51','65288eb2dc3c3fec79914edded6b2fbd'),
 (105,1,'192.168.1.33','2010-09-03 15:37:56','2010-09-03 15:37:56','6b12ea76b7f07f0c60e5307bf30bde00'),
 (106,1,'127.0.0.1','2010-09-03 22:42:48','2010-09-03 22:42:48','df14005315c895dd90ef441d4f2deccd'),
 (107,2,'127.0.0.1','2010-09-04 17:00:26','2010-09-04 16:44:29','e1a54709963f208f32925be1351ceba2'),
 (108,2,'127.0.0.1','2010-09-04 17:00:41','2010-09-04 17:00:41','e1a54709963f208f32925be1351ceba2'),
 (109,1,'127.0.0.1','2010-09-05 09:38:49','2010-09-05 09:38:49','6cbc40c42cb6ad3f46c12f88adf51ddc'),
 (110,2,'127.0.0.1','2010-09-06 07:56:25','2010-09-06 07:56:25','bc06dd36f84e6fcb1097870bcaa17488'),
 (111,1,'127.0.0.1','2010-09-09 09:51:34','2010-09-09 09:51:34','06e6e80a26a82f8d58c9e8f5eb134cb3'),
 (112,1,'127.0.0.1','2010-09-10 22:57:08','2010-09-10 22:57:08','fbf78ef06b35f837fc0e27e1a50f2edc'),
 (113,1,'127.0.0.1','2010-09-11 14:36:00','2010-09-11 10:40:39','6e7c7f78ca0dbcfaae2b1fba672f739a'),
 (114,2,'127.0.0.1','2010-09-11 14:36:19','2010-09-11 14:36:19','6e7c7f78ca0dbcfaae2b1fba672f739a'),
 (115,2,'127.0.0.1','2010-09-11 18:50:04','2010-09-11 18:50:04','e75fd54fa6752013c3c126ac09064634'),
 (116,2,'127.0.0.1','2010-09-12 02:31:57','2010-09-11 20:49:09','dbd6cf2725d02813e64946a8ac7ac5b1'),
 (117,1,'127.0.0.1','2010-09-12 02:32:14','2010-09-12 02:32:14','e75fd54fa6752013c3c126ac09064634'),
 (118,2,'127.0.0.1','2010-09-12 10:01:01','2010-09-12 10:01:01','e8882f00c750a34f412070cb5028c243'),
 (119,2,'127.0.0.1','2010-09-12 11:27:10','2010-09-12 11:27:10','db53b3d71e57855b58205c6fce1ed1e2'),
 (120,2,'127.0.0.1','2010-09-12 22:09:09','2010-09-12 22:09:09','2ab04a77b32f33f9a968afe46f8f8947'),
 (121,2,'127.0.0.1','2010-09-13 08:09:25','2010-09-13 08:09:25','587c7ac33a97e502a51f198091a18e8f'),
 (122,2,'127.0.0.1','2010-09-13 09:14:41','2010-09-13 09:14:41','44a8dd44d50843cd46231bc180bd2ca5'),
 (123,2,'127.0.0.1','2010-09-13 23:46:20','2010-09-13 23:46:20','0d3096c10fd6ed7d75db95f849ca4f1e'),
 (124,2,'127.0.0.1','2010-09-14 21:17:50','2010-09-14 21:12:15','4fe71f1e919ad054067a93101bc8e5b7'),
 (125,2,'127.0.0.1','2010-09-14 22:07:40','2010-09-14 22:07:40','4fe71f1e919ad054067a93101bc8e5b7'),
 (126,2,'127.0.0.1','2010-09-15 22:14:53','2010-09-15 22:14:53','8b90dee3e26363de4f50149b3fc70344'),
 (127,2,'127.0.0.1','2010-09-16 08:36:49','2010-09-16 08:36:49','41056e443da26f870415e1499f526b1b'),
 (128,2,'127.0.0.1','2010-09-16 12:08:50','2010-09-16 11:14:57','4f080b00dc524d7f6c72e91a85cf7746'),
 (129,2,'127.0.0.1','2010-09-16 13:20:10','2010-09-16 13:19:50','4f080b00dc524d7f6c72e91a85cf7746'),
 (130,2,'127.0.0.1','2010-09-16 13:21:22','2010-09-16 13:20:20','4f080b00dc524d7f6c72e91a85cf7746'),
 (131,2,'127.0.0.1','2010-09-16 13:21:39','2010-09-16 13:21:39','4f080b00dc524d7f6c72e91a85cf7746'),
 (132,2,'127.0.0.1','2010-09-17 01:43:33','2010-09-17 01:42:14','c5c28924ec77be1dc228728b959282b8'),
 (133,2,'127.0.0.1','2010-09-17 02:03:53','2010-09-17 01:46:59','c5c28924ec77be1dc228728b959282b8'),
 (134,2,'127.0.0.1','2010-09-17 02:04:04','2010-09-17 02:04:04','c5c28924ec77be1dc228728b959282b8'),
 (135,1,'127.0.0.1','2010-09-17 02:18:13','2010-09-17 02:16:26','c5c28924ec77be1dc228728b959282b8'),
 (136,2,'127.0.0.1','2010-09-17 02:18:26','2010-09-17 02:18:26','c5c28924ec77be1dc228728b959282b8'),
 (137,2,'127.0.0.1','2010-09-17 10:56:26','2010-09-17 10:51:54','61dd1c561d4db285a2db646913c25ffa'),
 (138,4,'127.0.0.1','2010-09-17 13:04:52','2010-09-17 10:57:57','61dd1c561d4db285a2db646913c25ffa'),
 (139,2,'127.0.0.1','2010-09-17 21:16:50','2010-09-17 21:16:50','21e6c6fa59517399528e2eeaaa16a6e2'),
 (140,2,'127.0.0.1','2010-09-17 22:59:13','2010-09-17 22:21:36','0651974dfb2f48902db5d0fc48410b25'),
 (141,2,'127.0.0.1','2010-09-18 11:12:31','2010-09-18 09:47:17','20895f411f45691933b1f5a3e9e37dee'),
 (142,4,'127.0.0.1','2010-09-18 17:36:56','2010-09-18 11:12:51','20895f411f45691933b1f5a3e9e37dee'),
 (143,2,'127.0.0.1','2010-09-18 18:48:51','2010-09-18 18:48:37','20895f411f45691933b1f5a3e9e37dee'),
 (144,4,'127.0.0.1','2010-09-18 22:40:32','2010-09-18 18:49:02','20895f411f45691933b1f5a3e9e37dee'),
 (145,5,'127.0.0.1','2010-09-18 22:40:43','2010-09-18 22:40:43','20895f411f45691933b1f5a3e9e37dee'),
 (146,2,'127.0.0.1','2010-09-19 15:21:00','2010-09-19 15:20:52','89e1346e95d27e47f1e4544cf016d583'),
 (147,5,'127.0.0.1','2010-09-19 20:53:31','2010-09-19 15:21:14','89e1346e95d27e47f1e4544cf016d583'),
 (148,5,'127.0.0.1','2010-09-19 22:11:46','2010-09-19 22:11:38','89e1346e95d27e47f1e4544cf016d583'),
 (149,5,'127.0.0.1','2010-09-19 23:09:06','2010-09-19 22:29:18','89e1346e95d27e47f1e4544cf016d583'),
 (150,1,'127.0.0.1','2010-09-19 23:31:07','2010-09-19 23:09:21','89e1346e95d27e47f1e4544cf016d583'),
 (151,4,'127.0.0.1','2010-09-19 23:39:59','2010-09-19 23:31:19','89e1346e95d27e47f1e4544cf016d583'),
 (152,4,'127.0.0.1','2010-09-19 23:44:01','2010-09-19 23:43:38','89e1346e95d27e47f1e4544cf016d583'),
 (153,4,'127.0.0.1','2010-09-20 00:05:20','2010-09-19 23:44:11','89e1346e95d27e47f1e4544cf016d583'),
 (154,4,'127.0.0.1','2010-09-20 00:59:26','2010-09-20 00:06:06','91f7797dc911adc0453f9f6dd30d6946'),
 (155,2,'127.0.0.1','2010-09-20 01:00:05','2010-09-20 00:59:44','89e1346e95d27e47f1e4544cf016d583'),
 (156,4,'127.0.0.1','2010-09-20 01:10:10','2010-09-20 01:00:22','89e1346e95d27e47f1e4544cf016d583'),
 (157,1,'127.0.0.1','2010-09-20 01:29:22','2010-09-20 01:10:22','89e1346e95d27e47f1e4544cf016d583'),
 (158,4,'127.0.0.1','2010-09-20 05:29:12','2010-09-20 01:29:41','89e1346e95d27e47f1e4544cf016d583'),
 (159,4,'127.0.0.1','2010-09-20 13:04:46','2010-09-20 13:04:22','4e50a173fc70ede12604f95b3fe737cc'),
 (160,4,'127.0.0.1','2010-09-20 21:49:42','2010-09-20 21:25:31','49a20ccde5e1adac07acc3f3bc974e93'),
 (161,2,'127.0.0.1','2010-09-20 21:51:53','2010-09-20 21:49:51','49a20ccde5e1adac07acc3f3bc974e93'),
 (162,4,'127.0.0.1','2010-09-20 23:56:10','2010-09-20 23:42:58','ff8df8742e37c981b4be23b86ca2dd0d'),
 (163,2,'127.0.0.1','2010-09-21 00:28:23','2010-09-20 23:56:31','ff8df8742e37c981b4be23b86ca2dd0d'),
 (164,2,'127.0.0.1','2010-09-21 01:26:17','2010-09-21 00:29:38','7bb6b0a65e8cc698c10a35b2e9848999'),
 (165,2,'127.0.0.1','2010-09-21 02:23:50','2010-09-21 01:27:54','9d058a874f09e428b9a6ba470bb9d375'),
 (166,1,'127.0.0.1','2010-09-22 01:30:38','2010-09-22 01:29:12','10f5f472077af82049fb880620834919'),
 (167,1,'127.0.0.1','2010-09-25 01:18:21','2010-09-24 23:20:35','46ba0864f8e063954905c39d6b390e95'),
 (168,6,'127.0.0.1','2010-09-25 02:07:26','2010-09-25 01:44:15','46ba0864f8e063954905c39d6b390e95'),
 (169,1,'127.0.0.1','2010-09-25 02:29:32','2010-09-25 02:22:44','46ba0864f8e063954905c39d6b390e95'),
 (170,6,'127.0.0.1','2010-09-25 02:53:09','2010-09-25 02:29:47','46ba0864f8e063954905c39d6b390e95'),
 (171,1,'127.0.0.1','2010-09-25 03:05:13','2010-09-25 02:53:27','46ba0864f8e063954905c39d6b390e95'),
 (172,9,'127.0.0.1','2010-09-25 04:17:43','2010-09-25 03:05:30','46ba0864f8e063954905c39d6b390e95');
/*!40000 ALTER TABLE `loguser` ENABLE KEYS */;


--
-- Definition of table `main_markets`
--

DROP TABLE IF EXISTS `main_markets`;
CREATE TABLE `main_markets` (
  `id_main_markets` int(10) unsigned NOT NULL auto_increment,
  `main_market_name` varchar(60) default NULL,
  `main_market_name_EN` varchar(60) default NULL,
  `main_market_sort` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_main_markets`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Thị trường chính của công ty';

--
-- Dumping data for table `main_markets`
--

/*!40000 ALTER TABLE `main_markets` DISABLE KEYS */;
INSERT INTO `main_markets` (`id_main_markets`,`main_market_name`,`main_market_name_EN`,`main_market_sort`) VALUES 
 (1,'Viá»‡t Nam','Viet Nam',1),
 (2,'Nháº­t','Japan',2),
 (3,'Trung Quá»‘c','China',3),
 (4,'ÄÃ´ng Nam Ã','Asean',4),
 (5,'Má»¹','United States',5),
 (6,'ChÃ¢u Ã‚u','European Union',6),
 (7,'áº¤n Ä‘á»™','India',7);
/*!40000 ALTER TABLE `main_markets` ENABLE KEYS */;


--
-- Definition of table `main_markets_company`
--

DROP TABLE IF EXISTS `main_markets_company`;
CREATE TABLE `main_markets_company` (
  `id_main_markets_company` int(10) unsigned NOT NULL auto_increment,
  `id_company` int(10) unsigned default NULL,
  `id_main_markets` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_main_markets_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='quan hệ n-n: bảng main_markets với bảng company';

--
-- Dumping data for table `main_markets_company`
--

/*!40000 ALTER TABLE `main_markets_company` DISABLE KEYS */;
INSERT INTO `main_markets_company` (`id_main_markets_company`,`id_company`,`id_main_markets`) VALUES 
 (1,1,1),
 (2,1,2),
 (3,1,4),
 (4,1,5),
 (5,2,1),
 (6,2,2),
 (7,2,4);
/*!40000 ALTER TABLE `main_markets_company` ENABLE KEYS */;


--
-- Definition of table `main_markets_member`
--

DROP TABLE IF EXISTS `main_markets_member`;
CREATE TABLE `main_markets_member` (
  `id_main_markets_member` int(10) unsigned NOT NULL auto_increment,
  `id_member` int(10) unsigned default NULL,
  `id_main_markets` int(10) unsigned default NULL,
  PRIMARY KEY  USING BTREE (`id_main_markets_member`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='quan hệ n-n: bảng main_markets với bảng member_profile';

--
-- Dumping data for table `main_markets_member`
--

/*!40000 ALTER TABLE `main_markets_member` DISABLE KEYS */;
INSERT INTO `main_markets_member` (`id_main_markets_member`,`id_member`,`id_main_markets`) VALUES 
 (1,1,1),
 (2,1,2),
 (3,1,4),
 (4,1,5),
 (5,2,1),
 (6,2,2),
 (7,2,4),
 (8,3,1);
/*!40000 ALTER TABLE `main_markets_member` ENABLE KEYS */;


--
-- Definition of table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id_member` int(10) unsigned NOT NULL auto_increment,
  `member_id_country` int(10) unsigned default NULL,
  `member_user` varchar(45) default NULL,
  `member_password` varchar(45) default NULL,
  `member_name` varchar(60) default NULL,
  `member_name_EN` varchar(60) default NULL,
  `member_sex` varchar(20) default NULL,
  `member_email` varchar(60) default NULL,
  `member_address` varchar(200) default NULL,
  `member_address_EN` varchar(200) default NULL,
  `member_tell` varchar(20) default NULL,
  `member_fax` varchar(20) default NULL,
  `member_kind` varchar(20) default NULL,
  `member_vip` tinyint(3) unsigned default NULL,
  `member_intro_short` varchar(255) default NULL,
  `member_intro_short_EN` varchar(255) default NULL,
  `member_intro` text,
  `member_intro_EN` text,
  `member_maillisting` tinyint(3) unsigned default NULL,
  `member_day_update` datetime default NULL,
  `member_randomkey` varchar(45) default NULL,
  `member_disabledateuer` datetime default NULL,
  `member_accesslevel` tinyint(3) unsigned default '2',
  `member_loginnumber` tinyint(3) unsigned default NULL,
  `member_active` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` (`id_member`,`member_id_country`,`member_user`,`member_password`,`member_name`,`member_name_EN`,`member_sex`,`member_email`,`member_address`,`member_address_EN`,`member_tell`,`member_fax`,`member_kind`,`member_vip`,`member_intro_short`,`member_intro_short_EN`,`member_intro`,`member_intro_EN`,`member_maillisting`,`member_day_update`,`member_randomkey`,`member_disabledateuer`,`member_accesslevel`,`member_loginnumber`,`member_active`) VALUES 
 (1,2,'admin','21232f297a57a5a743894a0e4a801fc3','le duc tho','Le Duc Tho','Mr','hspq07@gmail.com','phu quy','address','01675584174','123456789','business',NULL,'gioi thiá»‡u ngáº¯n','Short intro','THÃ´ng tin giá»›i thiá»‡u cá»§a tui ','Introductions',1,'2010-08-26 01:08:35','bc3744cb38c6cf6b17e8814a9c2688a3','2010-08-26 01:08:50',1,0,1),
 (2,1,'hspq07','202cb962ac59075b964b07152d234b70','le duc tho','hspq07','Mr','hspq07@gmail.com','phu quy','Hspq07\'s Address','01675584174','123456789136','member',1,NULL,NULL,'\r\n',NULL,1,'2010-08-26 01:14:40','f7d231711d490bcbf845df42c7eb6096','2010-08-26 01:15:01',1,0,1),
 (4,1,'test','c4ca4238a0b923820dcc509a6f75849b','Thanh vien OH','test tieng anh','Mr','hspq07@gmail.com','phu quy',NULL,'01675584174','123456789136','member',NULL,NULL,NULL,NULL,NULL,1,NULL,'b0cbd1803daba2f4be6919b9f773f921',NULL,2,0,1),
 (5,1,'user','202cb962ac59075b964b07152d234b70','ThÃ nh viÃªn user','ten user tieng anh','Mr','hspq07@gmail.com','phu quy',NULL,'01675584174','01675584174','member',NULL,NULL,NULL,NULL,NULL,1,NULL,'ef8f157ca5b0983df9112aaca855ec2b',NULL,2,0,1),
 (6,1,'member','e10adc3949ba59abbe56e057f20f883e','thÃ nh viÃªn thÆ°á»ng',NULL,'Mr','member@yahoo.com','458/76 LÃ½ ThÃ¡i Tá»• P.10, Q.10 HCM',NULL,'01675584174',NULL,'member',NULL,NULL,NULL,NULL,NULL,1,NULL,'4a0d4e0d21df28d99ff95e6bd9ca0acc',NULL,2,0,1),
 (7,1,'business','e10adc3949ba59abbe56e057f20f883e','ThÃ nh viÃªn Doanh Nghiá»‡p',NULL,'Mr','business@yahoo.com','458/76 LÃ½ ThÃ¡i Tá»• P.10, Q.10 HCM',NULL,'01675584174','123456789136','business',NULL,NULL,NULL,NULL,NULL,1,NULL,'6d4c6e964bc0078884cb7b22838b827b',NULL,2,0,1),
 (8,2,'vipmember','e10adc3949ba59abbe56e057f20f883e','ThÃ nh viÃªn VIP',NULL,'Mr','vipmember@yahoo.com','458/76 LÃ½ ThÃ¡i Tá»• P.10, Q.10 HCM',NULL,'01675584174','123456789136','member',NULL,NULL,NULL,NULL,NULL,1,NULL,'7b9dc501afe4ee11c56a4831e20cee71',NULL,2,0,1),
 (9,1,'vipbusiness','e10adc3949ba59abbe56e057f20f883e','Doanh nghiá»‡p VIP',NULL,'Mrs/Miss','vipbussiness@gmail.com','458/76 LÃ½ ThÃ¡i Tá»• P.10, Q.10 HCM',NULL,'01675584174','6789136','business',1,NULL,NULL,NULL,NULL,1,NULL,'0a934ecab584f7a4cd0220a7caeccbcc',NULL,2,0,1);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;


--
-- Definition of table `member_hits`
--

DROP TABLE IF EXISTS `member_hits`;
CREATE TABLE `member_hits` (
  `id_member_hits` int(10) unsigned NOT NULL auto_increment,
  `id_member` int(11) unsigned NOT NULL,
  `totalvisitors_room` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_member_hits`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_hits`
--

/*!40000 ALTER TABLE `member_hits` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_hits` ENABLE KEYS */;


--
-- Definition of table `member_profile`
--

DROP TABLE IF EXISTS `member_profile`;
CREATE TABLE `member_profile` (
  `id_member_profile` int(10) unsigned NOT NULL auto_increment,
  `mbpro_id_member` int(10) unsigned default NULL COMMENT 'cua thanh vien nao',
  `mbpro_id_industry` int(10) unsigned default NULL COMMENT 'Nganh nghe',
  `mbpro_avatar` varchar(60) default NULL COMMENT 'Hinh dai dien',
  `mbpro_year_active` varchar(10) default NULL COMMENT 'Nam hoat dong',
  `mbpro_authorized_capital` varchar(50) default NULL COMMENT 'VOn dau tu',
  `mbpro_authorized_capital_EN` varchar(50) default NULL,
  `mbpro_yearly_revenue` varchar(50) default NULL COMMENT 'Doanh thu hang nam',
  `mbpro_yearly_revenue_EN` varchar(50) default NULL,
  `mbpro_export_rates` varchar(30) default NULL COMMENT 'Ti le xuat khau',
  `mbpro_import_ratio` varchar(30) default NULL COMMENT 'TI le nhap khau',
  `mbpro_main_product` varchar(255) default NULL COMMENT 'san pham chinh',
  `mbpro_main_product_EN` varchar(255) default NULL,
  `mbpro_main_markets_orther` varchar(255) default NULL COMMENT 'Thi truong khac',
  `mbpro_main_markets_orther_EN` varchar(255) default NULL,
  `mbpro_shortinfo` varchar(255) default NULL COMMENT 'Gioi thieu ngan',
  `mbpro_shortinfo_EN` varchar(255) default NULL,
  `mbpro_info` text COMMENT 'Gioi thieu',
  `mbpro_info_EN` text,
  `mbpro_day_update` datetime default NULL COMMENT 'Ngay cap nhat',
  `mbpro_visible` tinyint(3) unsigned default '1' COMMENT 'An hien san pham',
  PRIMARY KEY  (`id_member_profile`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Day la ho so ca nhan';

--
-- Dumping data for table `member_profile`
--

/*!40000 ALTER TABLE `member_profile` DISABLE KEYS */;
INSERT INTO `member_profile` (`id_member_profile`,`mbpro_id_member`,`mbpro_id_industry`,`mbpro_avatar`,`mbpro_year_active`,`mbpro_authorized_capital`,`mbpro_authorized_capital_EN`,`mbpro_yearly_revenue`,`mbpro_yearly_revenue_EN`,`mbpro_export_rates`,`mbpro_import_ratio`,`mbpro_main_product`,`mbpro_main_product_EN`,`mbpro_main_markets_orther`,`mbpro_main_markets_orther_EN`,`mbpro_shortinfo`,`mbpro_shortinfo_EN`,`mbpro_info`,`mbpro_info_EN`,`mbpro_day_update`,`mbpro_visible`) VALUES 
 (3,1,1,'CanhdepVN2.jpg','1990','1','1','2','2','2','8','san pham tieng vit chinh','san pham tieng anh ','thi truong chinh tieng viá»‡t ','thi trÆ°á»ng chÃ­nh tiáº¿ng anh','giá»›i thiá»‡u tiáº¿ng viá»‡t ','giá»›i thiá»‡u tiáº¿ng anh ','Giá»›i thiá»‡u tiáº¿ng viÃª5t','Tiáº¿ng Anh','2010-09-11 14:39:03',1),
 (5,2,1,'SDC12090.JPG','2009','12','1','3','1','1','9','san pháº©m chÃ­nh',NULL,'thá»‹ trÆ°á»ng chÃ­nh khÃ¡c',NULL,'giá»›i thiá»‡u ngáº¯n 255 char',NULL,'aaa','english intro','2010-09-11 17:07:04',1),
 (6,4,1,'17.jpg','1990','1','1','1','3','3','3','san pham tieng vit chinh','san pham tieng anh ','thi truong chinh tieng viá»‡t ','thi trÆ°á»ng chÃ­nh tiáº¿ng anh','giá»›i thiá»‡u tiáº¿ng viá»‡t ','giá»›i thiá»‡u tiáº¿ng anh ','giá»›i thiá»‡u tiáº¿ng viá»‡t ','Giá»›i thiá»‡u tiáº¿ng Anh','2010-09-18 23:04:45',1),
 (7,5,1,'17.jpg','1990','1','1','1','3','3','3','san pham tieng vit chinh','san pham tieng anh ','thi truong chinh tieng viá»‡t ','thi trÆ°á»ng chÃ­nh tiáº¿ng anh','giá»›i thiá»‡u tiáº¿ng viá»‡t ','giá»›i thiá»‡u tiáº¿ng anh ','giá»›i thiá»‡u tiáº¿ng viá»‡t','Giá»›i thiá»‡u tiáº¿ng Anh','2010-09-18 23:08:28',1);
/*!40000 ALTER TABLE `member_profile` ENABLE KEYS */;


--
-- Definition of table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id_menu` int(10) unsigned NOT NULL auto_increment,
  `menu_name` varchar(50) default NULL,
  `menu_name_EN` varchar(50) default NULL,
  `url` varchar(60) default NULL,
  `outlink` varchar(60) default NULL,
  `notes` varchar(100) default NULL,
  `notes_EN` varchar(100) default NULL,
  `target` varchar(10) default NULL,
  `position` varchar(20) default NULL,
  `visible` tinyint(3) unsigned default '1',
  `sort` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id_menu`,`menu_name`,`menu_name_EN`,`url`,`outlink`,`notes`,`notes_EN`,`target`,`position`,`visible`,`sort`) VALUES 
 (1,'Trang chá»§','Home','index.php',NULL,'Trang chá»§','Home','_self','admin',1,1),
 (2,'Quáº£n lÃ½ sáº£n pháº©m','Products manage','#',NULL,NULL,NULL,'_self','admin',0,2),
 (3,'Quáº£n lÃ½ thÃ nh viÃªn','Customer manage','#',NULL,NULL,NULL,'_self','admin',1,3),
 (4,'Quáº£n lÃ½ dá»‹ch vá»¥','Services manage','#',NULL,'CÃ¡c dá»‹ch vá»¥ cá»§a cÃ´ng ty',NULL,'_self','admin',1,4),
 (5,'Quáº£n lÃ½ tin tá»©c','Information manage','#',NULL,NULL,NULL,'_self','admin',0,5),
 (6,'Quáº£n lÃ½ tÃ i liá»‡u','Document manage','#',NULL,NULL,NULL,'_self','admin',1,6),
 (7,'Quáº£n lÃ½ khÃ¡c','Orther manage','#',NULL,NULL,NULL,'_self','admin',1,8),
 (8,'Quáº£n lÃ½ thá»±c Ä‘Æ¡n','Menu manage','#',NULL,NULL,NULL,'_self','admin',1,7),
 (10,'Sáº£n pháº©m','Products','trade/product/index.php',NULL,NULL,NULL,'_self','index_top2',1,10),
 (11,'ChÃ o mua','Sell Offers','trade/buy/index.php',NULL,NULL,NULL,'_self','index_top2',1,11),
 (12,'ChÃ o bÃ¡n','Buy Offers','trade/sell/index.php',NULL,NULL,NULL,'_self','index_top2',1,12),
 (13,'Doanh nghiá»‡p','Companies','trade/business/index.php',NULL,NULL,NULL,'_self','index_top2',1,13),
 (14,'Dá»‹ch vá»¥','Services','trade/service/index.php',NULL,NULL,NULL,'_self','index_top2',1,14),
 (15,'Trang chá»§','Home','index.php',NULL,NULL,NULL,'_self','index_top2',1,9),
 (16,'Äáº¥u giÃ¡','Auction','trade/auction/index.php?mod=auction',NULL,NULL,NULL,'_self','index_top2',0,15),
 (17,'Giá»›i thiá»‡u','introduction','index.php?mod=intro',NULL,NULL,NULL,'_self','index_top1',1,16),
 (18,'LiÃªn há»‡','Contact','index.php?mod=contact',NULL,NULL,NULL,'_self','index_top1',1,17),
 (19,'Há»i - ÄÃ¡p','Question - Answer','index.php?mod=question',NULL,NULL,NULL,'_self','index_top1',1,18),
 (20,'Trá»£ giÃºp','Help','index.php?mod=help',NULL,NULL,NULL,'_self','index_top1',1,19);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


--
-- Definition of table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE `payment_methods` (
  `id_payment_methods` int(10) unsigned NOT NULL auto_increment,
  `methods_name` varchar(200) default NULL,
  `methods_name_EN` varchar(200) default NULL,
  `day_update` datetime default NULL,
  `sort` int(10) unsigned default NULL,
  `visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_payment_methods`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` (`id_payment_methods`,`methods_name`,`methods_name_EN`,`day_update`,`sort`,`visible`) VALUES 
 (1,'Gá»­i qua AMT','Send to ATM','2010-07-29 15:19:36',1,1),
 (2,'VISA','VISA','2010-08-25 09:40:11',2,1),
 (3,'MasterCard','MasterCard','2010-08-25 09:40:29',3,1);
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;


--
-- Definition of table `payment_methods_products`
--

DROP TABLE IF EXISTS `payment_methods_products`;
CREATE TABLE `payment_methods_products` (
  `id_payment_methods_products` int(10) unsigned NOT NULL auto_increment,
  `id_payment_methods` int(10) unsigned default NULL,
  `id_products` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_payment_methods_products`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Quan hệ n-n giữa payment_methods với products';

--
-- Dumping data for table `payment_methods_products`
--

/*!40000 ALTER TABLE `payment_methods_products` DISABLE KEYS */;
INSERT INTO `payment_methods_products` (`id_payment_methods_products`,`id_payment_methods`,`id_products`) VALUES 
 (1,1,1),
 (2,2,2),
 (3,3,3),
 (4,1,4),
 (5,2,4),
 (6,1,5),
 (7,1,6),
 (8,1,7),
 (9,2,8),
 (10,1,9),
 (11,3,9),
 (12,1,10),
 (13,3,11),
 (14,1,12);
/*!40000 ALTER TABLE `payment_methods_products` ENABLE KEYS */;


--
-- Definition of table `position`
--

DROP TABLE IF EXISTS `position`;
CREATE TABLE `position` (
  `id_position` int(10) unsigned NOT NULL auto_increment,
  `position_name` varchar(100) default NULL,
  `position_name_EN` varchar(100) default NULL,
  `sort` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Vị trí chức vụ của thành viên';

--
-- Dumping data for table `position`
--

/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` (`id_position`,`position_name`,`position_name_EN`,`sort`) VALUES 
 (1,'Tá»•ng giÃ¡m Ä‘á»‘c','Tong giam doc',1);
/*!40000 ALTER TABLE `position` ENABLE KEYS */;


--
-- Definition of table `procat`
--

DROP TABLE IF EXISTS `procat`;
CREATE TABLE `procat` (
  `id_procat` int(10) unsigned NOT NULL auto_increment,
  `procat_name` varchar(30) default NULL,
  `procat_name_EN` varchar(30) default NULL,
  `url` varchar(60) default NULL,
  `notes` varchar(30) default NULL,
  `notes_EN` varchar(30) default NULL,
  `day_update` datetime default NULL,
  `sort` int(10) unsigned default NULL,
  `visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_procat`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `procat`
--

/*!40000 ALTER TABLE `procat` DISABLE KEYS */;
INSERT INTO `procat` (`id_procat`,`procat_name`,`procat_name_EN`,`url`,`notes`,`notes_EN`,`day_update`,`sort`,`visible`) VALUES 
 (1,'MÃ¡y phÃ¡t Ä‘iá»‡n','Generators',NULL,NULL,NULL,'2010-07-29 14:12:52',1,1),
 (2,'MÃ¡y mÃ³c ','Machinery',NULL,NULL,NULL,'2010-08-06 19:07:24',3,1),
 (3,'Thiáº¿t bá»‹','Industrial Equipment',NULL,NULL,NULL,'2010-08-06 19:07:24',2,1),
 (4,'HÃ³a cháº¥t','Chemical',NULL,NULL,NULL,'2010-08-06 19:07:24',4,1),
 (5,'Váº­t liá»‡u xÃ¢y dá»±ng','Building Materials',NULL,NULL,NULL,'2010-08-06 19:11:28',5,1),
 (6,'Vá»‡ sinh cÃ´ng nghiá»‡p','Industrial hygiene',NULL,NULL,NULL,'2010-08-06 19:11:28',6,1),
 (7,'Xe táº£i - Ã” tÃ´ - Xe mÃ¡y','Truck - Car - Motorbikes',NULL,NULL,NULL,'2010-08-06 19:11:28',7,1),
 (8,'KhÃ¡c','Orther',NULL,NULL,NULL,'2010-08-06 19:11:28',8,1);
/*!40000 ALTER TABLE `procat` ENABLE KEYS */;


--
-- Definition of table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id_products` int(10) unsigned NOT NULL auto_increment,
  `id_procat` int(10) unsigned default NULL,
  `id_prosubcat1` int(10) unsigned default NULL,
  `id_prosubcat2` int(10) unsigned default NULL,
  `id_prosubcat3` int(10) unsigned default NULL,
  `id_country` int(10) unsigned default NULL,
  `id_member` int(10) unsigned default NULL,
  `product_name` varchar(150) default NULL,
  `product_name_EN` varchar(150) default NULL,
  `product_short_describe` varchar(255) default NULL,
  `product_short_describe_EN` varchar(255) default NULL,
  `product_content` text,
  `product_content_EN` text,
  `product_image_illustrate` varchar(60) default NULL COMMENT 'hinh minh hoa',
  `product_reference_price` varchar(20) default NULL,
  `product_rates` varchar(10) default NULL,
  `product_unit` varchar(20) default NULL COMMENT 'đơn vị tính(cái,cục,kg,..)',
  `product_unit_EN` varchar(50) default NULL,
  `product_type` varchar(10) default NULL COMMENT '3 Loại: product, buy, sell',
  `product_payment_methods_orther` varchar(255) default NULL,
  `product_payment_methods_orther_EN` varchar(255) default NULL,
  `product_showroom` tinyint(3) unsigned default NULL,
  `product_view` int(10) unsigned default '0',
  `product_popular` tinyint(3) default NULL,
  `product_day_update` datetime default NULL,
  `product_visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_products`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id_products`,`id_procat`,`id_prosubcat1`,`id_prosubcat2`,`id_prosubcat3`,`id_country`,`id_member`,`product_name`,`product_name_EN`,`product_short_describe`,`product_short_describe_EN`,`product_content`,`product_content_EN`,`product_image_illustrate`,`product_reference_price`,`product_rates`,`product_unit`,`product_unit_EN`,`product_type`,`product_payment_methods_orther`,`product_payment_methods_orther_EN`,`product_showroom`,`product_view`,`product_popular`,`product_day_update`,`product_visible`) VALUES 
 (1,1,NULL,NULL,NULL,NULL,2,'Sáº£n pháº©m may phat Ä‘iá»‡n 1','may phat dien 1','mÃ´ táº£ ngáº¯n cá»§a mÃ¡y phÃ¡t Ä‘iá»‡n 1','short information of product electronic','Ná»™i dung cá»§a mÃ¡y phÃ¡t Ä‘iá»‡n 1','content of product','1.jpg','1000000000','1','cÃ¡i','Cai','sell','Visa','visa',1,0,1,'2010-09-02 23:45:04',1),
 (2,1,1,NULL,NULL,NULL,2,'may phat Ä‘iá»‡n 2',NULL,'mÃ´ táº£ ngáº¯n cá»§a mÃ¡y phÃ¡t Ä‘iá»‡n 2',NULL,'Ná»™i dung of may phat Ä‘iá»‡n 2',NULL,'2.jpg','2000000000','1','cÃ¡i',NULL,'sell','trá»±c tiáº¿p',NULL,1,0,1,'2010-09-02 23:47:31',1),
 (3,1,1,1,NULL,NULL,2,'may phat Ä‘iá»‡n 3',NULL,'mÃ´ táº£ ngáº¯n cá»§a mÃ¡y phÃ¡t Ä‘iá»‡n 3',NULL,'Ná»™i dung cá»§a mÃ¡y phÃ¡t Ä‘iá»‡n 3',NULL,'3.jpg','2000005','1','cÃ¡i',NULL,'sell','nÃ³i sau',NULL,1,0,1,'2010-09-02 23:49:01',1),
 (4,1,1,1,1,2,2,'sáº£n pháº©m may phat Ä‘iá»‡n 4',NULL,'mÃ´ táº£ ngáº¯n cá»§a mÃ¡y phÃ¡t Ä‘iá»‡n 4',NULL,'Ná»™i dung cá»§a may phÃ¡t Ä‘iá»‡n 4',NULL,'4.jpg','0123456789123','6','cÃ¡i',NULL,'sell','trá»±c tiáº¿p',NULL,1,0,1,'2010-09-02 23:51:19',1),
 (5,3,NULL,NULL,NULL,NULL,2,'Sáº£n pháº©m chÃ o bÃ¡n 1',NULL,'MÃ´ táº£ ngáº¯n cá»§a Sáº£n pháº©m chÃ o bÃ¡n 1',NULL,'Ná»™i dung cá»§a&nbsp;Sáº£n pháº©m chÃ o bÃ¡n 1',NULL,'5.jpg','1000000000','2','táº¥n',NULL,'sell','Visa Viá»‡t Nam',NULL,1,0,1,'2010-09-02 23:52:48',1),
 (6,3,5,NULL,NULL,NULL,2,'Thiáº¿t bá»‹ báº£o há»™ lao Ä‘á»™ng VN',NULL,'MÃ´ táº£ ngáº¯n cá»§a thiáº¿t bá»‹ báº£o há»™ lao Ä‘á»™ng VN',NULL,'Ná»™i dung cá»§a thiáº¿t bá»‹ báº£o há»™ lao Ä‘á»™ng viá»‡t nam',NULL,'baoho.jpg','500','1','cá»¥c',NULL,'sell','táº¡i cá»§a hÃ ng',NULL,0,0,1,'2010-09-02 23:54:23',1),
 (8,3,6,NULL,NULL,NULL,2,'Cáº§n mua thiáº¿t bá»‹ lá»c hÃ ng Viá»‡t Nam cháº¥t lÆ°á»£ng cao',NULL,'Cáº§n mua thiáº¿t bá»‹ lá»c hÃ ng Viá»‡t Nam cháº¥t lÆ°á»£ng...',NULL,'Ná»™i dung cá»§a chÃ o mua thiáº¿t bá»‹ lá»c hÃ ng Viá»‡t Nam cháº¥t lÆ°á»£ng cao',NULL,'19179549_2.jpg','200000','1',NULL,NULL,'buy','Visa Viá»‡t Nam',NULL,1,0,1,'2010-09-03 00:00:13',1),
 (9,2,NULL,NULL,NULL,NULL,1,'Cáº§n bÃ¡n mÃ¡y cÃ´ng trÃ¬nh Loáº¡i CLG816',NULL,'Cáº§n bÃ¡n mÃ¡y cÃ´ng trÃ¬nh Loáº¡i CLG816',NULL,'<span style=\"-webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; font-family: Tahoma, verdana, arial, sans-serif; font-size: 12pt; \">\r\n	<div style=\"background-color: rgb(255, 255, 255); padding-top: 5px; padding-right: 5px; padding-bottom: 5px; padding-left: 5px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: Arial, Verdana, sans-serif; font-size: 12px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; \">\r\n		<div>\r\n			<p><span style=\"font-weight: bold; \">- MÃY PHÃT ÄIá»†N&nbsp; YANMAR 45KVA<br />\r\n					</span></p>\r\n			<p><span style=\"font-weight: bold; \">- MODEL: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; AG-45SS<br />\r\n					</span></p>\r\n			<p><span style=\"font-weight: bold; \">- CÃ”NG SUáº¤T :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 45KVA<br />\r\n					</span></p>\r\n			<p><span style=\"font-weight: bold; \">- NÄ‚M Sáº¢N XUáº¤T:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1998/11<br />\r\n					</span></p>\r\n			<p><span style=\"font-weight: bold; \">- XUáº¤T Xá»¨:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; JAPAN<br />\r\n					</span></p>\r\n			<p><span style=\"font-weight: bold; \">- Sá» GIá»œ ÄÃƒ HOáº T Äá»˜NG: 6385H<br />\r\n					</span></p>\r\n			<p><span style=\"font-weight: bold; \">- Táº¦N Sá»:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 50Hz<br />\r\n					</span></p>\r\n			<p><span style=\"font-weight: bold; \">- Tá»C Äá»˜ QUAY:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1500 VÃ’NG/PHÃšT<br />\r\n					</span></p>\r\n			<p><span style=\"font-weight: bold; \">- ÄIá»†N ÃP Äá»ŠNH Má»¨C:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 110/220V</span></p>\r\n			<p><span style=\"font-weight: bold; \">- NHIÃŠN LIá»†U&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DIEZEL</span></p></div>\r\n		<p>---------------------------------------------------------------------</p>\r\n		<p>&nbsp;</p>\r\n		<h3>Tá»”NG KHO MÃY MÃ“C THIáº¾T Bá»Š CÃ”NG NGHIá»†P - SONG PHAT TRADE AND INVESTMENT CO.,LTD</h3>\r\n		<p>- ChuyÃªn cung cáº¥p cÃ¡c loáº¡i mÃ¡y mÃ³c thiáº¿t bá»‹ ngÃ nh cÃ´ng nghiá»‡p: MÃ¡y phÃ¡t Ä‘iá»‡n, mÃ¡y cÃ´ng cá»¥ NC - CNC, cáº©u trá»¥c, xe cÆ¡ giá»›i, xe nÃ´ng nghiá»‡p, xe cÃ´ng trÃ¬nh,... Vá»›i cÃ¡c thÆ°Æ¡ng hiá»‡u ná»•i tiáº¿ng Ä‘Æ°á»£c nháº­p trá»±c tiáº¿p tá»« Nháº­t Báº£n.</p>\r\n		<p>Má»i chi tiáº¿t quÃ½ khÃ¡ch vui lÃ²ng gh&eacute; thÄƒm website chÃºng tÃ´i:</p>\r\n		<p>- Website: http://songphat360.com</p>\r\n		<p>--------------------------------------------</p>\r\n		<h3>SONG PHAT TRADE AND INVESTMENT CO.,LTD</h3>\r\n		<p>&nbsp;</p>\r\n		<h4><span style=\"font-family: Tahoma; font-weight: bold; \">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-family: Arial; \">THANH TIáº¾N</span></span></h4>\r\n		<p><span style=\"font-family: Tahoma; \">- Business development manager</span></p>\r\n		<p>- HP: 0903.070.753</p>\r\n		<p>- Email: sale@songphat360.com</p>\r\n		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; tienle.business@gmail.com</p>\r\n		<p>&nbsp;</p></div></span> ',NULL,'show_image_in_imgtag.php.jpg','10000','2',NULL,NULL,'sell',NULL,NULL,1,0,NULL,'2010-09-03 15:42:00',1),
 (10,7,NULL,NULL,NULL,2,1,'Xe táº£i Huynhdai HD270',NULL,'Xe táº£i Huynhdai HD270 - cháº¥t lÆ°á»£ng má»›i 100%.  ',NULL,'\r\n<table border=\"0\" style=\"text-align: justify;width: 675px; font-family: Tahoma, verdana, arial, sans-serif; font-size: 11px; \">\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	\r\n	<tbody>\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		<tr>\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			<td colspan=\"2\"><a class=\"button\" href=\"http://www.maycongtrinh.com/component/virtuemart/enquiry/11/19/xe-t%E1%BA%A3i-huynhdai-hd270.html\" style=\"color: rgb(0, 0, 0); text-decoration: none; \">Ask a question about this product</a></td>\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		</tr>\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		<tr>\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			\r\n			<td rowspan=\"1\" colspan=\"2\"><hr style=\"text-align: left;\" />\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				<div style=\"text-align: left;\">Xe táº£i Huynhdai HD270 - cháº¥t lÆ°á»£ng má»›i 100%.</div>\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				<p style=\"text-align: left;\">&nbsp;</p>\r\n				<table border=\"1\" cellspacing=\"3\" cellpadding=\"0\" width=\"93%\" style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 442px; border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-style: outset; border-right-style: outset; border-bottom-style: outset; border-left-style: outset; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n					<tbody>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: rgb(230, 230, 230); padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; background-position: 0% 0%; background-repeat: repeat repeat; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><strong style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">THÃ”NG Sá»</span></strong></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: rgb(230, 230, 230); padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; background-position: 0% 0%; background-repeat: repeat repeat; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><strong style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">HYUNDAI HD270</span></strong></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">CÃ´ng thá»©c bÃ¡nh xe</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">LHD 6 x 4</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td colspan=\"2\" style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><strong style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">KÃ­ch thÆ°á»›c</span></strong></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">KÃ­ch thÆ°á»›c bao (D x R x C) (mm)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">7635 x 2495 x 3030</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">KÃ­ch thÆ°á»›c thÃ¹ng (D x R x C) (mm)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">4840 x 2300 x 905</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Chiá»u dÃ i cÆ¡ sá»Ÿ (mm)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">3290 + 1300</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Vá»‡t bÃ¡nh xe trÆ°á»›c /sau(mm)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">2040/1850</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Khoáº£ng sÃ¡ng gáº§m xe(mm)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">280</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td colspan=\"2\" style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: rgb(230, 230, 230); padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; background-position: 0% 0%; background-repeat: repeat repeat; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><strong style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">ThÃ´ng sá»‘ vá» trá»ng lÆ°á»£ng</span></strong></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Trá»ng lÆ°á»£ng báº£n thÃ¢n (Kg)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">11060</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Trá»ng táº£i (Kg)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">16710</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Trá»ng lÆ°á»£ng toÃ n bá»™ thiáº¿t káº¿ (Kg)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">27900</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td colspan=\"2\" style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: rgb(230, 230, 230); padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; background-position: 0% 0%; background-repeat: repeat repeat; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><strong style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Hiá»‡u nÄƒng</span></strong></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Tá»‘c Ä‘á»™ cá»±c Ä‘áº¡i cá»§a xe (Km/h)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">100</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">TiÃªu chuáº©n khÃ­ tháº£i</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Euro II</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Kháº£ nÄƒng leo dá»‘c lá»›n nháº¥t (<sup style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">0</sup>)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">24,8</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">BÃ¡n kÃ­nh quay vÃ²ng theo váº¿t bÃ¡nh xe trÆ°á»›c phÃ­a ngoÃ i (m)</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">7,5</span></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; height: 0.25in; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td colspan=\"2\" style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: rgb(230, 230, 230); height: 0.25in; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; background-position: 0% 0%; background-repeat: repeat repeat; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><strong style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Äá»™ng cÆ¡</span></strong></p></td>\r\n						</tr>\r\n						<tr style=\"border-style: initial; border-color: initial; font-family: Arial, Helvetica, sans-serif; font-size: 12px; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \"><span style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">Model Ä‘á»™ng cÆ¡</span></p></td>\r\n							<td style=\"border-top-color: rgb(198, 217, 236); border-right-color: rgb(198, 217, 236); border-bottom-color: rgb(198, 217, 236); border-left-color: rgb(198, 217, 236); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: inset; border-right-style: inset; border-bottom-style: inset; border-left-style: inset; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: transparent; padding-top: 1.5pt; padding-right: 1.5pt; padding-bottom: 1.5pt; padding-left: 1.5pt; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">\r\n								<p style=\"border-style: initial; border-color: initial; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; \">HYUNDAI D6CA Diesel, 4 ká»³ 6 xi lanh, bá»‘ trÃ­ tháº³ng hÃ ng, lÃ m mÃ¡t báº±ng nÆ°á»›c</p>\r\n								<div><br />\r\n									</div></td>\r\n						</tr>\r\n					</tbody>\r\n				</table>\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				<h1 style=\"text-align: left;margin-top: 5px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; border-style: initial; border-color: initial; font: normal normal bold 12px/normal Arial; text-transform: uppercase; letter-spacing: 0px; color: rgb(243, 159, 0); border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; padding-top: 5px; padding-right: 5px; padding-bottom: 5px; padding-left: 5px; \">XE Táº¢I HYUNDAI HD270</h1>\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				\r\n				<div style=\"text-align: left;\"><span style=\"-webkit-border-horizontal-spacing: 3px; -webkit-border-vertical-spacing: 3px; font-family: Arial, Helvetica, sans-serif; font-size: 12pt; \"><span style=\"font-family: Tahoma, verdana, arial, sans-serif; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; font-size: 11px; \">\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							\r\n							Mot ngÃ y má»›i</span></span></div>\r\n				\r\n				<div style=\"text-align: left;\">&nbsp;</div></td>\r\n		</tr>\r\n	</tbody>\r\n</table>',NULL,'show_image_in_imgtag.php (1)_1.jpg','20000','2',NULL,NULL,'sell',NULL,NULL,0,0,NULL,'2010-09-03 15:44:15',1),
 (11,7,NULL,NULL,NULL,1,1,'Cáº§n mua Xe chá»Ÿ trá»™n bÃª tÃ´ng 7m3 Ä‘áº¿n 9m3',NULL,'Cáº§n mua Xe chá»Ÿ trá»™n bÃª tÃ´ng 7m3 Ä‘áº¿n 9m3',NULL,'\r\n<p style=\"font-family: Tahoma, verdana, arial, sans-serif; font-size: 11px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; \"><strong><span style=\"font-size: 9pt; color: black; text-decoration: underline; \">THÃ”NG Sá» Ká»¸ THUáº¬T</span></strong></p>\r\n\r\n<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" width=\"507\" class=\"MsoNormalTable\" style=\"width: 379.9pt; font-family: Tahoma, verdana, arial, sans-serif; font-size: 11px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; \">\r\n	\r\n	<tbody>\r\n		\r\n		<tr style=\"height: 15.1pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p>Äá»™ng cÆ¡</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Diesel - D6CA (tiÃªu chuáº©n EURO III)</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 14.3pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Kiá»ƒu Ä‘á»™ng cÆ¡</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">D6CA, 4 ká»³, tÄƒng Ã¡p, 6 xy lanh tháº³ng hÃ ng</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 15.1pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Dung tÃ­ch xi lanh</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">12.920 cc</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 14.3pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Há»™p sá»‘</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Sá»‘ sÃ n 06 sá»‘ tiáº¿n, 01 sá»‘ lÃ¹i</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 14.3pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">CÃ´ng suáº¥t cá»±c Ä‘áº¡i</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">279(375)1.900 KW(Hp)/vÃ²ng/phÃºt</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 15.1pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Dung tÃ­ch bÃ¬nh nhiÃªn liá»‡u</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">200 lÃ­t</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 14.3pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">KÃ­ch thÆ°á»›c tá»•ng thá»ƒ</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">DÃ i x Rá»™ng x Cao: 8.335 x 2.495 x 3.600 mm</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 15.1pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Khoáº£ng sÃ¡ng gáº§m xe</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">280 mm</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 14.3pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Chiá»u dÃ i cÆ¡ sá»Ÿ</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">3.290 + 1.300 mm</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 14.3pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Vá»‡t bÃ¡nh trÆ°á»›c</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">2.040 mm</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 15.1pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Vá»‡t bÃ¡nh sau</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">1.850 mm</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 14.3pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Trá»ng lÆ°Æ¡ng báº£n thÃ¢n</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">11.640 Kg</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 15.1pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Trá»ng táº£i<span class=\"apple-converted-space\">&nbsp;</span></p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">16.130 Kg (thiáº¿t káº¿), 12.200 Kg (tham gia giao thÃ´ng)</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 14.3pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Trá»ng lÆ°á»£ng toÃ n bá»™</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">27.900 Kg (thiáº¿t káº¿), 23.970 Kg (tham gia giao thÃ´ng)</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 14.3pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Tá»‘c Ä‘á»™ tá»‘i Ä‘a (Km/h)</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">100</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 15.1pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Kháº£ nÄƒng leo dá»‘c</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">0,248</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 14.3pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Sá»‘ chá»• ngá»“i</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 14.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">02</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 15.1pt; \">\r\n			\r\n			<td width=\"130\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Thá»ƒ tÃ­ch thÃ¹ng trá»™n (m<sup>3<span class=\"apple-converted-space\">&nbsp;</span></sup>)</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 15.1pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">7</p></td>\r\n		\r\n		</tr>\r\n	\r\n	</tbody>\r\n\r\n</table>\r\n\r\n<p style=\"font-family: Tahoma, verdana, arial, sans-serif; font-size: 11px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; \">&nbsp;&nbsp;<img src=\"file:///C:/DOCUME~1/One/LOCALS~1/Temp/msohtml1/01/clip_image001.gif\" border=\"0\" alt=\"*\" width=\"16\" height=\"16\" /><span style=\"color: black; \">&nbsp;&nbsp;&nbsp;</span><span class=\"apple-converted-space\"><span style=\"color: black; \">&nbsp;</span></span><em><strong><span style=\"color: black; text-decoration: underline; \">Trang thiáº¿t bá»‹ trÃªn xe:</span></strong></em></p>\r\n\r\n<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"MsoNormalTable\" style=\"font-family: Tahoma, verdana, arial, sans-serif; font-size: 11px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; \">\r\n	\r\n	<tbody>\r\n		\r\n		<tr style=\"height: 13pt; \">\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 13pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p>Há»‡&nbsp;Há»‡ thá»‘ng&nbsp;Ä‘iá»u hÃ²a khÃ´ng khÃ­&nbsp;</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 13pt; \">\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 13pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p>Tay Tay lÃ¡i trá»£ lá»±c cÃ³ thá»ƒ Ä‘iá»u chá»‰nh Ä‘á»™ nghiÃªng</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 13.75pt; \">\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 13.75pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">DÃ n Ã¢m thanh: Radio Casete (02 loa)</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 13pt; \">\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 13pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Gháº¿ bá»c simili cao cáº¥p</p></td>\r\n		\r\n		</tr>\r\n	\r\n	</tbody>\r\n\r\n</table>\r\n\r\n<p style=\"font-family: Tahoma, verdana, arial, sans-serif; font-size: 11px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; \">&nbsp;<img src=\"file:///C:/DOCUME~1/One/LOCALS~1/Temp/msohtml1/01/clip_image001.gif\" border=\"0\" alt=\"*\" width=\"16\" height=\"16\" /><span style=\"color: black; \">&nbsp;&nbsp;&nbsp;</span><span class=\"apple-converted-space\"><span style=\"color: black; \">&nbsp;</span></span><em><strong><span style=\"color: black; text-decoration: underline; \">Há»‡ thá»‘ng an tÃ²an:</span></strong></em></p>\r\n\r\n<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" class=\"MsoNormalTable\" style=\"font-family: Tahoma, verdana, arial, sans-serif; font-size: 11px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; \">\r\n	\r\n	<tbody>\r\n		\r\n		<tr style=\"height: 15.3pt; \">\r\n			\r\n			<td rowspan=\"3\" width=\"61\" style=\"width: 45.85pt; height: 15.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p>Phanh</p></td>\r\n			\r\n			<td width=\"102\" valign=\"top\" style=\"width: 76.4pt; height: 15.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Phanh chÃ­nh</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 15.3pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Dáº¡ng báº±ng khÃ­, máº¡ch Ä‘Ã´i</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 7.35pt; \">\r\n			\r\n			<td width=\"102\" valign=\"top\" style=\"width: 76.4pt; height: 7.35pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Phanh tay<span class=\"apple-converted-space\">&nbsp;</span></p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 7.35pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Loáº¡i lÃ² xo, phanh lá»‘c kÃª</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 7.35pt; \">\r\n			\r\n			<td width=\"102\" valign=\"top\" style=\"width: 76.4pt; height: 7.35pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Phanh xáº£</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 7.35pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Báº±ng khÃ­, loáº¡i van buá»›m,váº­n hÃ nh báº±ng cam Ä‘iá»u khiá»ƒn trá»±c tiáº¿p</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 13.75pt; \">\r\n			\r\n			<td colspan=\"2\" width=\"163\" valign=\"top\" style=\"width: 122.25pt; height: 13.75pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Há»‡ thá»‘ng treo</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 13.75pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">NhÃ­p trÆ°á»›c vÃ  sau hÃ¬nh bÃ¡n nguyá»‡t, giáº£m Ä‘á»™ng báº±ng khá»›p ná»‘i</p></td>\r\n		\r\n		</tr>\r\n		\r\n		<tr style=\"height: 13.75pt; \">\r\n			\r\n			<td colspan=\"2\" width=\"163\" valign=\"top\" style=\"width: 122.25pt; height: 13.75pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">Lá»‘p xe (trÆ°á»›c/sau)</p></td>\r\n			\r\n			<td width=\"200\" valign=\"top\" style=\"height: 13.75pt; padding-top: 0in; padding-right: 0in; padding-bottom: 0in; padding-left: 0in; \">\r\n				\r\n				<p class=\"MsoNormal\">11.00 x 20 â€“ 16PR</p></td>\r\n		\r\n		</tr>\r\n	\r\n	</tbody>\r\n\r\n</table><span style=\"font-family: Tahoma, verdana, arial, sans-serif; font-size: 11px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; \"><br />\r\n	\r\n	</span>\r\n\r\n<div style=\"font-family: Tahoma, verdana, arial, sans-serif; font-size: 11px; -webkit-border-horizontal-spacing: 2px; -webkit-border-vertical-spacing: 2px; \">\r\n	\r\n	<p class=\"MsoNormal\">Äá»ƒ phá»¥c vá»¥ quÃ½ khÃ¡ch Ä‘Æ°á»£c chu Ä‘Ã¡o, xin liÃªn há»‡:</p></div> ',NULL,'show_image_in_imgtag.php (2).jpg','1000000000','1',NULL,NULL,'buy','trá»±c tiáº¿p',NULL,1,0,NULL,'2010-09-03 15:49:07',1);
INSERT INTO `products` (`id_products`,`id_procat`,`id_prosubcat1`,`id_prosubcat2`,`id_prosubcat3`,`id_country`,`id_member`,`product_name`,`product_name_EN`,`product_short_describe`,`product_short_describe_EN`,`product_content`,`product_content_EN`,`product_image_illustrate`,`product_reference_price`,`product_rates`,`product_unit`,`product_unit_EN`,`product_type`,`product_payment_methods_orther`,`product_payment_methods_orther_EN`,`product_showroom`,`product_view`,`product_popular`,`product_day_update`,`product_visible`) VALUES 
 (12,4,4,NULL,NULL,NULL,6,'Thuá»‘c tÃ­m - Potassiumi permanganate',NULL,'Sá»­ dá»¥ng Almost all applications of potassium permanganate exploit its oxidizing properties . [ 2 ] As a strong oxidant that does not generate toxic byproducts, KMnO 4 has many niche uses. Háº§u nhÆ° táº¥t cáº£ cÃ¡c á»©ng dá»¥ng cá»§a permanganat kali ',NULL,'<span style=\"font-family: Arial; font-size: 12px; line-height: 16px; \"><span id=\"Uses\" class=\"mw-headline\">Sá»­ dá»¥ng</span></span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Almost all applications of potassium permanganate exploit its&nbsp;<a title=\"TÃ¡c nhÃ¢n Ã´xi hÃ³a\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Oxidizing_agent&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhiFn0ObLNzbSInjR6rr83rNTt-FQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">oxidizing properties</a>&nbsp;.&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-Ullmann-1\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-Ullmann_1-1\">[&nbsp;2&nbsp;]</sup></a>&nbsp;As a strong oxidant that does not generate toxic byproducts, KMnO&nbsp;<sub>4</sub>&nbsp;has many niche uses.</span>&nbsp;Háº§u nhÆ° táº¥t cáº£ cÃ¡c á»©ng dá»¥ng cá»§a permanganat kali khai thÃ¡c&nbsp;<a title=\"TÃ¡c nhÃ¢n Ã´xi hÃ³a\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Oxidizing_agent&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhiFn0ObLNzbSInjR6rr83rNTt-FQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">tÃ i sáº£n</a>&nbsp;cá»§a nÃ³&nbsp;<a title=\"TÃ¡c nhÃ¢n Ã´xi hÃ³a\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Oxidizing_agent&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhiFn0ObLNzbSInjR6rr83rNTt-FQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">Ã´xi hÃ³a.</a><a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-Ullmann-1\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-Ullmann_1-1\">[2]</sup></a>&nbsp;NhÆ° lÃ  má»™t cháº¥t Ã´xi hÃ³a máº¡nh mÃ  khÃ´ng táº¡o ra sáº£n pháº©m phá»¥ Ä‘á»™c háº¡i, KMnO&nbsp;<sub>4</sub>&nbsp;cÃ³ nhiá»u ngÆ°á»i sá»­ dá»¥ng thÃ­ch há»£p.</p>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Potassium permanganate is one of the principal chemicals utilised in the film and television industries to \"age\" props and set dressings.</span>&nbsp;Kali permanganat lÃ  má»™t trong nhá»¯ng hÃ³a cháº¥t utilised chÃ­nh trong bá»™ phim truyá»n hÃ¬nh vÃ  cÃ¡c ngÃ nh cÃ´ng nghiá»‡p Ä‘áº¿n \"tuá»•i\" Ä‘áº¡o cá»¥ vÃ  bÄƒng gáº¡c Ä‘áº·t.&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Its oxidising effects create \"hundred year old\" or \"ancient\" looks on hessian cloth, ropes, timber and glass.&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-2\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-2\">[&nbsp;3&nbsp;]</sup></a>&nbsp;It was used on props and sets in films such as \"Troy\", \"300\" and \"Indiana Jones\".&nbsp;<sup title=\"YÃªu cáº§u nÃ y cáº§n tham kháº£o cÃ¡c nguá»“n tin Ä‘Ã¡ng tin cáº­y tá»« thÃ¡ng 10 nÄƒm 2009\" class=\"Template-Fact\" style=\"white-space: nowrap; \">[&nbsp;<a title=\"Wikipedia: Citation cáº§n thiáº¿t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Wikipedia:Citation_needed&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhi-YBO3fSJoAX9PnjUeEYBAIuR2DQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><span style=\"font-style: italic; \">citation needed</span></a>&nbsp;]</sup></span>&nbsp;Oxy hoÃ¡ táº¡o ra hiá»‡u á»©ng cá»§a nÃ³ \"trÄƒm tuá»•i\" hay \"cá»•\" trÃ´ng hessian trÃªn váº£i, dÃ¢y, gá»— vÃ  thá»§y tinh&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-2\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-2\">[3.]</sup></a>&nbsp;NÃ³ Ä‘Æ°á»£c sá»­ dá»¥ng trÃªn cÃ¡c Ä‘áº¡o cá»¥ vÃ  táº­p há»£p trong cÃ¡c phim nhÆ° \"Troy\", \"300\" vÃ  \"Indiana Jones\"&nbsp;<a title=\"Wikipedia: Citation cáº§n thiáº¿t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Wikipedia:Citation_needed&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhi-YBO3fSJoAX9PnjUeEYBAIuR2DQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup title=\"YÃªu cáº§u nÃ y cáº§n tham kháº£o cÃ¡c nguá»“n tin Ä‘Ã¡ng tin cáº­y tá»« thÃ¡ng 10 nÄƒm 2009\" class=\"Template-Fact\" style=\"white-space: nowrap; \"><span style=\"font-style: italic; \">[sá»­a. cáº§n thiáº¿t]</span></sup></a></p><span style=\"font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \"><span class=\"editsection\">[&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: thuá»‘c táº©y uáº¿ vÃ  xá»­ lÃ½ nÆ°á»›c\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D4&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhg-3ukrk1ZxvLZsZJxtwmfIgH7rrQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">edit</a>&nbsp;]</span>&nbsp;<span id=\"Disinfectant_and_water_treatment\" class=\"mw-headline\">Disinfectant and water treatment</span></span>&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: thuá»‘c táº©y uáº¿ vÃ  xá»­ lÃ½ nÆ°á»›c\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D4&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhg-3ukrk1ZxvLZsZJxtwmfIgH7rrQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><span class=\"editsection\">[Sá»­a]</span></a>&nbsp;<span id=\"Disinfectant_and_water_treatment\" class=\"mw-headline\">khá»­ trÃ¹ng vÃ  xá»­ lÃ½ nÆ°á»›c</span></span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">As an oxidant, potassium permanganate can act as a disinfectant.</span>&nbsp;NhÆ° má»™t cháº¥t Ã´xi hÃ³a, kali permanganat cÃ³ thá»ƒ hÃ nh Ä‘á»™ng nhÆ° má»™t cháº¥t táº©y trÃ¹ng.&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">For example, dilute solutions are used to treat&nbsp;<a title=\"Aphthous lo&eacute;t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Aphthous_ulcer&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgJyZ7XL3o0NBVFEWBmyJkgHYrIjA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">canker sores</a>&nbsp;(ulcers), disinfectant for the hands and treatment for mild&nbsp;<a class=\"mw-redirect\" title=\"Pompholyx\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Pompholyx&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhg1gbfSYageAtKczy_WD_zYUkHSPg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">pompholyx</a>&nbsp;,&nbsp;<a title=\"ViÃªm da\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Dermatitis&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhmRrtJbdNtMzDIhTLKSrEDh2YsnQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">dermatitis</a>&nbsp;,&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-pmid14127384-3\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-pmid14127384_3-0\">[&nbsp;4&nbsp;]</sup></a>&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-pmid1476027-4\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-pmid1476027_4-0\">[&nbsp;5&nbsp;]</sup></a>&nbsp;and&nbsp;<a title=\"Náº¥m\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Fungus&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjw-k44aklCTkQWepFjBh7BfSKyUg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">fungal</a>&nbsp;infections of the hands or feet.&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-pmid12282068-5\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-pmid12282068_5-0\">[&nbsp;6&nbsp;]</sup></a>&nbsp;Potassium permanganate, obtainable at&nbsp;<a title=\"Há»“ bÆ¡i\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Swimming_pool&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhiBGp2nPaNI6vP4FBVXkiYUxcKAhw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">pool</a>supply stores, is used in rural areas to remove&nbsp;<a title=\"Sáº¯t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Iron&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhigCQxKydPYuz_9LXBODwkPtKfDTQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">iron</a>&nbsp;and&nbsp;<a title=\"Hydro sulfua\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Hydrogen_sulfide&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhv_021hBU6yZOoSIWEe70XkNNBBA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">hydrogen sulfide</a>&nbsp;(rotten egg smell) from&nbsp;<a title=\"NÆ°á»›c cÅ©ng\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Water_well&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjoZFHyI-N6frcknz4RmOHAonxtLA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">well</a>&nbsp;and waste water.</span>&nbsp;VÃ­ dá»¥, loÃ£ng giáº£i phÃ¡p Ä‘Æ°á»£c sá»­ dá»¥ng Ä‘á»ƒ Ä‘iá»u trá»‹&nbsp;<a title=\"Aphthous lo&eacute;t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Aphthous_ulcer&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgJyZ7XL3o0NBVFEWBmyJkgHYrIjA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">váº¿t lo&eacute;t tai Æ°Æ¡ng</a>&nbsp;(lo&eacute;t), thuá»‘c táº©y uáº¿ cho bÃ n tay vÃ  Ä‘iá»u trá»‹ cho&nbsp;<a class=\"mw-redirect\" title=\"Pompholyx\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Pompholyx&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhg1gbfSYageAtKczy_WD_zYUkHSPg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">pompholyx</a>&nbsp;nháº¹,&nbsp;<a title=\"ViÃªm da\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Dermatitis&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhmRrtJbdNtMzDIhTLKSrEDh2YsnQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">viÃªm da,</a>&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-pmid14127384-3\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-pmid14127384_3-0\">[4]</sup></a>&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-pmid1476027-4\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-pmid1476027_4-0\">[5]</sup></a>&nbsp;vÃ  nhiá»…m&nbsp;<a title=\"Náº¥m\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Fungus&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjw-k44aklCTkQWepFjBh7BfSKyUg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">náº¥m</a>&nbsp;cá»§a tay hoáº·c chÃ¢n&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-pmid12282068-5\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-pmid12282068_5-0\">[6]</sup></a>&nbsp;Kali permanganat, lÃºc nháº­n Ä‘Æ°á»£c.&nbsp;<a title=\"Há»“ bÆ¡i\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Swimming_pool&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhiBGp2nPaNI6vP4FBVXkiYUxcKAhw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">bá»ƒ</a>&nbsp;cá»­a hÃ ng cung cáº¥p, Ä‘Æ°á»£c sá»­ dá»¥ng á»Ÿ cÃ¡c vÃ¹ng nÃ´ng thÃ´n Ä‘á»ƒ loáº¡i bá»&nbsp;<a title=\"Sáº¯t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Iron&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhigCQxKydPYuz_9LXBODwkPtKfDTQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">cháº¥t sáº¯t</a>&nbsp;vÃ &nbsp;<a title=\"Hydro sulfua\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Hydrogen_sulfide&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhv_021hBU6yZOoSIWEe70XkNNBBA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">sulfua hydro</a>&nbsp;(mÃ¹i trá»©ng thá»‘i) tá»«&nbsp;<a title=\"NÆ°á»›c cÅ©ng\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Water_well&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjoZFHyI-N6frcknz4RmOHAonxtLA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">tá»‘t</a>&nbsp;vÃ  nÆ°á»›c tháº£i.&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Historically it was used to disinfect drinking water.&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-6\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-6\">[&nbsp;7&nbsp;]</sup></a></span>&nbsp;Trong lá»‹ch sá»­ nÃ³ Ä‘Ã£ Ä‘Æ°á»£c sá»­ dá»¥ng Ä‘á»ƒ khá»­ trÃ¹ng nÆ°á»›c uá»‘ng&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-6\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-6\">[7.]</sup></a></p><span style=\"font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \"><span class=\"editsection\">[&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: sá»­ dá»¥ng y sinh\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D5&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhiK5WKTRgILdOgwu5bHnaeDZA94kw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">edit</a>&nbsp;]</span>&nbsp;<span id=\"Biomedical_uses\" class=\"mw-headline\">Biomedical uses</span></span>&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: sá»­ dá»¥ng y sinh\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D5&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhiK5WKTRgILdOgwu5bHnaeDZA94kw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><span class=\"editsection\">[Sá»­a]</span></a>&nbsp;<span id=\"Biomedical_uses\" class=\"mw-headline\">y sinh sá»­ dá»¥ng</span></span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Related to the use of KMnO&nbsp;<sub>4</sub>&nbsp;for water treatment, this salt is often employed as a specialized disinfectant for treating human and animal ailments.</span>&nbsp;LiÃªn quan Ä‘áº¿n viá»‡c sá»­ dá»¥ng KMnO&nbsp;<sub>4</sub>&nbsp;cho xá»­ lÃ½ nÆ°á»›c, muá»‘i nÃ y thÆ°á»ng Ä‘Æ°á»£c lÃ m viá»‡c nhÆ° má»™t thuá»‘c táº©y uáº¿ chuyÃªn dá»¥ng Ä‘á»ƒ Ä‘iá»u trá»‹ bá»‡nh cá»§a con ngÆ°á»i vÃ  Ä‘á»™ng váº­t.&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">In&nbsp;<a title=\"Histology\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Histology&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhitaNwY3Nykzzzx6IhSwgrbaualdw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">histology</a>&nbsp;, it is used to bleach melanin which obscures tissue detail.</span>&nbsp;Trong&nbsp;<a title=\"Histology\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Histology&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhitaNwY3Nykzzzx6IhSwgrbaualdw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">mÃ´ há»c,</a>&nbsp;nÃ³ Ä‘Æ°á»£c dÃ¹ng Ä‘á»ƒ táº©y melanin mÃ  che láº¥p chi tiáº¿t mÃ´.&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Potassium permanganate can also be used to differentiate&nbsp;<a title=\"Amyloid\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Amyloid&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgIK80Svc0-WET5q2wpoCVByiDN0g\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">amyloid</a>&nbsp;AA from other types of amyloid pathologically deposited in body tissues.</span>&nbsp;Permanganat kali cÅ©ng cÃ³ thá»ƒ Ä‘Æ°á»£c sá»­ dá»¥ng Ä‘á»ƒ phÃ¢n biá»‡t AA<a title=\"Amyloid\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Amyloid&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgIK80Svc0-WET5q2wpoCVByiDN0g\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">amyloid</a>&nbsp;tá»« cÃ¡c loáº¡i amyloid pathologically gá»­i táº¡i cÃ¡c mÃ´ cÆ¡ thá»ƒ.&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Incubation of fixed tissue with potassium permanganate will prevent amyloid AA from staining with&nbsp;<a title=\"Congo Ä‘á»\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Congo_red&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhiYuOrR3-v18-neJ2KbwdbxK42mzg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">congo red</a>&nbsp;whereas other types of amyloid are unaffected.&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-7\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-7\">[&nbsp;8&nbsp;]</sup></a>&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-8\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-8\">[&nbsp;9&nbsp;]</sup></a>&nbsp;Permanganate washes were once used to treat&nbsp;<a title=\"Láº­u\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Gonorrhea&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhsINIpLsa57E2NF_57sovbz-h9lQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">gonorrhea</a>&nbsp;and are still used to treat&nbsp;<a title=\"Candida\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Candidiasis&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjVEz2TsmZdSS5bslk8zgFdHfI9fA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">candidiasis</a>&nbsp;.&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-9\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-9\">[&nbsp;10&nbsp;]</sup></a></span>&nbsp;á»¦ mÃ´ cá»‘ Ä‘á»‹nh vá»›i permanganat kali sáº½ ngÄƒn AA amyloid tá»« nhuá»™m vá»›i&nbsp;<a title=\"Congo Ä‘á»\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Congo_red&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhiYuOrR3-v18-neJ2KbwdbxK42mzg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">mÃ u Ä‘á» congo</a>&nbsp;trong khi cÃ¡c loáº¡i amyloid khÃ´ng bá»‹ áº£nh hÆ°á»Ÿng&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-7\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-7\">[8]</sup></a>&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-8\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-8\">[9]</sup></a>&nbsp;permanganat rá»­a Ä‘Æ°á»£c má»™t láº§n Ä‘Æ°á»£c sá»­ dá»¥ng Ä‘á»ƒ Ä‘iá»u trá»‹&nbsp;<a title=\"Láº­u\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Gonorrhea&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhsINIpLsa57E2NF_57sovbz-h9lQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">bá»‡nh láº­u</a>&nbsp;vÃ  váº«n cÃ²n Ä‘Æ°á»£c sá»­ dá»¥ng Ä‘á»ƒ Ä‘iá»u trá»‹&nbsp;<a title=\"Candida\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Candidiasis&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjVEz2TsmZdSS5bslk8zgFdHfI9fA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">candida..</a>&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-9\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-9\">[10]</sup></a></p><span style=\"font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \"><span class=\"editsection\">[&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: há»¯u cÆ¡ tá»•ng há»£p\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D6&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjZFKq7HVzsICZ9yv8WINeWT6jBEw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">edit</a>&nbsp;]</span>&nbsp;<span id=\"Organic_synthesis\" class=\"mw-headline\">Organic synthesis</span></span>&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: há»¯u cÆ¡ tá»•ng há»£p\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D6&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjZFKq7HVzsICZ9yv8WINeWT6jBEw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><span class=\"editsection\">[Sá»­a]</span></a>&nbsp;<span id=\"Organic_synthesis\" class=\"mw-headline\">há»¯u cÆ¡ tá»•ng há»£p</span></span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Aside from its use in water treatment, the other major application of KMnO&nbsp;<sub>4</sub>&nbsp;is as a reagent for the synthesis of organic compounds.<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-10\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-10\">[&nbsp;11&nbsp;]</sup></a>&nbsp;Significant amounts are required for the synthesis of&nbsp;<a title=\"Axit Ascorbic\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Ascorbic_acid&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhil7vflBbazC-Ngxr3H9RryaYn4xw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">ascorbic acid</a>&nbsp;,&nbsp;<a title=\"Chloramphenicol\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Chloramphenicol&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhizrI_CG2n-Uf9kaBrHUNhnsIveEw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">chloramphenicol</a>&nbsp;,&nbsp;<a class=\"mw-redirect\" title=\"Saccharine\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Saccharine&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgszF1T7hWFXraNZ28xNosbflikdg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">saccharine</a>&nbsp;,&nbsp;<a title=\"Isonicotinic axÃ­t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Isonicotinic_acid&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgazQgeUphNjkjrUMZFXaMJGzCibw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">isonicotinic acid</a>&nbsp;, and<a title=\"Pyrazinoic axÃ­t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Pyrazinoic_acid&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhj44OW5rApePrTPoD1SHwcw1q49ug\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">pyrazinoic acid</a>&nbsp;.&nbsp;<sup class=\"reference\" id=\"cite_ref-Ullmann_1-2\"><a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-Ullmann-1\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">[&nbsp;2&nbsp;]</a></sup></span>&nbsp;NgoÃ i viá»‡c sá»­ dá»¥ng nÃ³ trong xá»­ lÃ½ nÆ°á»›c, á»©ng dá»¥ng lá»›n khÃ¡c cá»§a KMnO&nbsp;<sub>4</sub>&nbsp;lÃ  nhÆ° lÃ  má»™t cháº¥t tinh khiáº¿t cho sá»± tá»•ng há»£p cá»§a cÃ¡c há»£p cháº¥t há»¯u cÆ¡&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-10\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-10\">[11.]</sup></a>&nbsp;Sá»‘ tiá»n Ã½ nghÄ©a lÃ  cáº§n thiáº¿t Ä‘á»ƒ tá»•ng há»£p&nbsp;<a title=\"Axit Ascorbic\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Ascorbic_acid&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhil7vflBbazC-Ngxr3H9RryaYn4xw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">axit ascorbic,</a>&nbsp;<a title=\"Chloramphenicol\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Chloramphenicol&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhizrI_CG2n-Uf9kaBrHUNhnsIveEw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">chloramphenicol,</a>&nbsp;<a class=\"mw-redirect\" title=\"Saccharine\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Saccharine&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgszF1T7hWFXraNZ28xNosbflikdg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">saccharine,</a>&nbsp;<a title=\"Isonicotinic axÃ­t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Isonicotinic_acid&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgazQgeUphNjkjrUMZFXaMJGzCibw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">axit isonicotinic,</a>&nbsp;vÃ &nbsp;<a title=\"Pyrazinoic axÃ­t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Pyrazinoic_acid&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhj44OW5rApePrTPoD1SHwcw1q49ug\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">pyrazinoic axÃ­t</a>&nbsp;<sup class=\"reference\" id=\"cite_ref-Ullmann_1-2\"><a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-Ullmann-1\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">[2.]</a></sup></p><span style=\"font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \"><span class=\"editsection\">[&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: HÃ³a há»c\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D7&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjR8VzgDYGvWZaAItNYcsg_tSMtRw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">edit</a>&nbsp;]</span>&nbsp;<span id=\"Chemistry\" class=\"mw-headline\">Chemistry</span></span>&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: HÃ³a há»c\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D7&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjR8VzgDYGvWZaAItNYcsg_tSMtRw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><span class=\"editsection\">[Sá»­a]</span></a>&nbsp;<span id=\"Chemistry\" class=\"mw-headline\">HÃ³a há»c</span></span><span style=\"font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \"><span class=\"editsection\">[&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: phÃ¢n tÃ­ch\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D8&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjR3HKS4GA1BzpDOFlUXaAxFt5VVA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">edit</a>&nbsp;]</span>&nbsp;<span id=\"Analytical\" class=\"mw-headline\">Analytical</span></span>&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: phÃ¢n tÃ­ch\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D8&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjR3HKS4GA1BzpDOFlUXaAxFt5VVA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><span class=\"editsection\">[Sá»­a]</span></a>&nbsp;<span id=\"Analytical\" class=\"mw-headline\">PhÃ¢n TÃ­ch</span></span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Potassium permanganate can be used to quantitatively determine the total oxidisable organic material in an aqueous sample.</span>Permanganat kali cÃ³ thá»ƒ Ä‘Æ°á»£c sá»­ dá»¥ng Ä‘á»ƒ xÃ¡c Ä‘á»‹nh sá»‘ lÆ°á»£ng, cháº¥t liá»‡u tá»•ng oxidisable há»¯u cÆ¡ trong má»™t máº«u dung dá»‹ch nÆ°á»›c.&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">The value determined is known as the&nbsp;<span style=\"font-style: italic; \">permanganate value.</span>&nbsp;In&nbsp;<a title=\"HÃ³a phÃ¢n tÃ­ch\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Analytical_chemistry&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhh_u2AHSQ0X3jyASU7FXgcjQIvV1A\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">analytical chemistry</a>&nbsp;, a standardized&nbsp;<a class=\"mw-redirect\" title=\"Dung dá»‹ch nÆ°á»›c\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Aqueous&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhh8qVbOR9lARFLDqc6jmgML8xv2ew\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">aqueous</a>&nbsp;solution of KMnO&nbsp;<sub>4</sub>&nbsp;is sometimes used as an oxidizing&nbsp;<a title=\"Titration\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Titration&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhj3XVH2MFl6Phyu-Fg6iinTZ1OuKg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">titrant</a>&nbsp;for&nbsp;<a title=\"Redox Titration\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Redox_titration&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgJLAfryM6tMhWKZ_BGbKXmi2YJKA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">redox titrations</a>&nbsp;(&nbsp;<a title=\"Permanganometry\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Permanganometry&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgZGc8BIPcNOcNDFbTDyqTsyEYWsQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">permanganometry</a>&nbsp;).</span>&nbsp;GiÃ¡ trá»‹ xÃ¡c Ä‘á»‹nh Ä‘Æ°á»£c gá»i lÃ &nbsp;<span style=\"font-style: italic; \">giÃ¡ trá»‹ permanganat.</span>Trong&nbsp;<a title=\"HÃ³a phÃ¢n tÃ­ch\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Analytical_chemistry&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhh_u2AHSQ0X3jyASU7FXgcjQIvV1A\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">HÃ³a há»c phÃ¢n tÃ­ch,</a>&nbsp;má»™t tiÃªu chuáº©n hÃ³a&nbsp;<a class=\"mw-redirect\" title=\"Dung dá»‹ch nÆ°á»›c\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Aqueous&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhh8qVbOR9lARFLDqc6jmgML8xv2ew\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">dá»‹ch nÆ°á»›c</a>&nbsp;giáº£i phÃ¡p cá»§a KMnO&nbsp;<sub>4</sub>&nbsp;Ä‘Ã´i khi Ä‘Æ°á»£c sá»­ dá»¥ng nhÆ° má»™t&nbsp;<a title=\"Titration\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Titration&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhj3XVH2MFl6Phyu-Fg6iinTZ1OuKg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">titrant</a>&nbsp;Ã´xi hÃ³a Ä‘á»ƒ<a title=\"Redox Titration\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Redox_titration&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgJLAfryM6tMhWKZ_BGbKXmi2YJKA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">chuáº©n Ä‘á»™ redox</a>&nbsp;<a title=\"Permanganometry\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Permanganometry&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgZGc8BIPcNOcNDFbTDyqTsyEYWsQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">(permanganometry).</a>&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">In a related way, it is used as a&nbsp;<a title=\"Tinh khiáº¿t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Reagent&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhi8q_zEc1-hUiMXCcHwBxAAeT4-Jg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">reagent</a>&nbsp;to determine the&nbsp;<a title=\"Kappa sá»‘\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Kappa_number&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhsvbOe1al6VJeNrhgCgMY0zfc9HA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">Kappa number</a>&nbsp;of wood pulp.</span>&nbsp;Trong má»™t cÃ¡ch thá»©c liÃªn quan, nÃ³ Ä‘Æ°á»£c sá»­ dá»¥ng nhÆ° má»™t&nbsp;<a title=\"Tinh khiáº¿t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Reagent&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhi8q_zEc1-hUiMXCcHwBxAAeT4-Jg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">cháº¥t tinh khiáº¿t</a>&nbsp;Ä‘á»ƒ xÃ¡c Ä‘á»‹nh&nbsp;<a title=\"Kappa sá»‘\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Kappa_number&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhsvbOe1al6VJeNrhgCgMY0zfc9HA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">sá»‘ Kappa</a>&nbsp;cá»§a bá»™t giáº¥y.&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">For the standardization of KMnO&nbsp;<sub>4</sub>&nbsp;solutions, reduction by oxalic acid&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-11\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-11\">[&nbsp;12&nbsp;]</sup></a>&nbsp;is often used.</span>&nbsp;Äá»‘i vá»›i cÃ¡c tiÃªu chuáº©n hoÃ¡ cá»§a KMnO&nbsp;<sub>4</sub>&nbsp;giáº£i phÃ¡p, giáº£m bá»Ÿi acid oxalic<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-11\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-11\">[12]</sup></a>&nbsp;thÆ°á»ng Ä‘Æ°á»£c sá»­ dá»¥ng.</p>\r\n<div class=\"thumb tright\" style=\"font-family: Arial; font-size: 12px; line-height: 16px; \">\r\n	<div class=\"thumbinner\" style=\"width: 222px; \"><a class=\"image\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/File:KMnO4_in_H2O.jpg&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhh2uwwT-dY2t20vy-IuhN5A8sGEMQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><img height=\"525\" width=\"220\" class=\"thumbimage\" src=\"http://upload.wikimedia.org/wikipedia/commons/thumb/4/42/KMnO4_in_H2O.jpg/220px-KMnO4_in_H2O.jpg\" alt=\"\" style=\"border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; \" /></a>\r\n		<div class=\"thumbcaption\">\r\n			<div class=\"magnify\"><a title=\"PhÃ³ng to\" class=\"internal\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/File:KMnO4_in_H2O.jpg&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhh2uwwT-dY2t20vy-IuhN5A8sGEMQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><img height=\"11\" width=\"15\" alt=\"\" src=\"http://bits.wikimedia.org/skins-1.5/common/images/magnify-clip.png\" style=\"border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; \" /></a></div><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">A solution of KMnO&nbsp;<sub>4</sub>&nbsp;in water, in a<a title=\"Volumetric flask\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Volumetric_flask&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgb7jYa1xsPQ9x10Y2rYnFhDBnKAg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">volumetric flask</a></span>&nbsp;Má»™t giáº£i phÃ¡p cá»§a KMnO<sub>4</sub>&nbsp;trong nÆ°á»›c, trong má»™t&nbsp;<a title=\"Volumetric flask\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Volumetric_flask&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgb7jYa1xsPQ9x10Y2rYnFhDBnKAg\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">thá»ƒ tÃ­ch flask</a></div></div></div>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Aqueous, acidic solutions of KMnO&nbsp;<sub>4</sub>&nbsp;are used to collect gaseous&nbsp;<a title=\"Mercury (nguyÃªn tá»‘)\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Mercury_%28element%29&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgg_LR2O0M4mItyNUtlSHk7S5m5OQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">mercury</a>&nbsp;in flue gas during stationary source emissions testing.&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-12\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-12\">[13&nbsp;]</sup></a></span>&nbsp;Dung dá»‹ch nÆ°á»›c, giáº£i phÃ¡p axit cá»§a KMnO&nbsp;<sub>4</sub>&nbsp;Ä‘Æ°á»£c sá»­ dá»¥ng Ä‘á»ƒ thu tháº­p&nbsp;<a title=\"Mercury (nguyÃªn tá»‘)\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Mercury_%28element%29&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgg_LR2O0M4mItyNUtlSHk7S5m5OQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">thá»§y ngÃ¢n</a>&nbsp;dáº¡ng khÃ­ trong khÃ­ khÃ³i trong thá»i gian thá»­ nghiá»‡m mÃ£ nguá»“n phÃ¡t tháº£i vÄƒn phÃ²ng pháº©m&nbsp;<a href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Potassium_permanganate&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhUzCSYUHyA4olHDEt2qWgl25yJ2Q#cite_note-12\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><sup class=\"reference\" id=\"cite_ref-12\">[13.]</sup></a></p><span style=\"font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \"><span class=\"editsection\">[&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: há»¯u cÆ¡\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D9&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjtRKYD74XRVNiCQvXPnMXENijDrA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">edit</a>&nbsp;]</span>&nbsp;<span id=\"Organic\" class=\"mw-headline\">Organic</span></span>&nbsp;<a title=\"Chá»‰nh sá»­a pháº§n: há»¯u cÆ¡\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/w/index.php%3Ftitle%3DPotassium_permanganate%26action%3Dedit%26section%3D9&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjtRKYD74XRVNiCQvXPnMXENijDrA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \"><span class=\"editsection\">[Sá»­a]</span></a>&nbsp;<span id=\"Organic\" class=\"mw-headline\">Organic</span></span>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: Arial; font-size: 12px; line-height: 16px; \"><span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">Dilute solutions of KMnO&nbsp;<sub>4</sub>&nbsp;convert&nbsp;<a title=\"Alkene\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Alkene&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhiiAwcCEp3ABb5lxPpcquozS-rKQA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">alkenes</a>&nbsp;into&nbsp;<a title=\"Diol\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Diol&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgfUOFgrk2uYe8A50MhHx5BpANQYw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">diols</a>&nbsp;(glycols).</span>&nbsp;LoÃ£ng cÃ¡c giáº£i phÃ¡p cá»§a KMnO&nbsp;<sub>4</sub>&nbsp;chuyá»ƒn Ä‘á»•i&nbsp;<a title=\"Alkene\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Alkene&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhiiAwcCEp3ABb5lxPpcquozS-rKQA\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">anken</a>&nbsp;vÃ o&nbsp;<a title=\"Diol\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Diol&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhgfUOFgrk2uYe8A50MhHx5BpANQYw\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">diols</a>(glycols).&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">This behaviour is also used as a&nbsp;<a class=\"mw-redirect\" title=\"Cháº¥t hÃ³a há»c phÃ¢n tÃ­ch\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Qualitative_chemical_analysis&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhRKT6UpZcoO913GlyMYrcQE3EY_w\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">qualitative</a>&nbsp;<a title=\"HÃ³a cháº¥t x&eacute;t nghiá»‡m\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Chemical_test&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjotxYzFT34OpFeSr8-QEJaegkA_g\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">test</a>&nbsp;for the presence of double or triple bonds in a molecule, since the reaction decolourises the permanganate solution; thus it is sometimes referred to as&nbsp;<a title=\"Baeyer cá»§a tinh khiáº¿t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Baeyer%27s_reagent&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhiU-Uvu3jAXouaav_teOzbmk5K49g\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">Baeyer\'s reagent</a>&nbsp;.</span>&nbsp;HÃ nh vi nÃ y cÅ©ng Ä‘Æ°á»£c sá»­ dá»¥ng nhÆ° lÃ  má»™t&nbsp;<a title=\"HÃ³a cháº¥t x&eacute;t nghiá»‡m\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Chemical_test&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhjotxYzFT34OpFeSr8-QEJaegkA_g\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">bÃ i kiá»ƒm tra</a>&nbsp;<a class=\"mw-redirect\" title=\"Cháº¥t hÃ³a há»c phÃ¢n tÃ­ch\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Qualitative_chemical_analysis&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhhRKT6UpZcoO913GlyMYrcQE3EY_w\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">cháº¥t lÆ°á»£ng</a>&nbsp;cho sá»± hiá»‡n diá»‡n cá»§a liÃªn káº¿t Ä‘Ã´i hoáº·c gáº¥p ba trong má»™t phÃ¢n tá»­, vÃ¬ pháº£n á»©ng decolourises giáº£i phÃ¡p permanganat; nhÆ° váº­y, nÃ³ lÃ  Ä‘Ã´i khi Ä‘Æ°á»£c gá»i lÃ &nbsp;<a title=\"Baeyer cá»§a tinh khiáº¿t\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Baeyer%27s_reagent&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhiU-Uvu3jAXouaav_teOzbmk5K49g\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">tinh khiáº¿t Baeyer\'s.</a>&nbsp;<span class=\"google-src-text\" style=\"direction: ltr; text-align: left; \">However,&nbsp;<a title=\"BrÃ´m\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Bromine&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhi-MVPor0oPnS0NIyCxwKjpAjCDAQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">bromine</a>&nbsp;serves better in measuring unsaturation (double or triple bonds) quantitatively, since KMnO&nbsp;<sub>4</sub>&nbsp;, being a very strong oxidizing agent, can react with impurities in a sample.</span>&nbsp;TrÃ¡i phiáº¿u Tuy nhiÃªn,&nbsp;<a title=\"BrÃ´m\" href=\"http://translate.googleusercontent.com/translate_c?hl=vi&amp;sl=en&amp;u=http://en.wikipedia.org/wiki/Bromine&amp;prev=/search%3Fq%3Dpotassium%2Bpermanganate%26num%3D100%26hl%3Dvi%26lr%3D%26client%3Dgmail%26sa%3DG%26rls%3Dgm&amp;rurl=translate.google.com&amp;twu=1&amp;usg=ALkJrhi-MVPor0oPnS0NIyCxwKjpAjCDAQ\" style=\"color: rgb(68, 161, 208); text-decoration: none; \">brÃ´m</a>&nbsp;phá»¥c vá»¥ tá»‘t hÆ¡n trong Ä‘o unsaturation (tÄƒng gáº¥p Ä‘Ã´i hoáº·c gáº¥p ba) sá»‘ lÆ°á»£ng, ká»ƒ tá»« KMnO&nbsp;<sub>4,</sub>&nbsp;lÃ  má»™t tÃ¡c nhÃ¢n oxy hÃ³a ráº¥t máº¡nh, cÃ³ thá»ƒ pháº£n á»©ng vá»›i cÃ¡c táº¡p cháº¥t trong má»™t máº«u.</p>\r\n',NULL,'1700_14902_4792_14840_KMnO4-AD-CN-25kg7_GF_L_L.jpg','330','2','cÃ¡i',NULL,'product',NULL,NULL,1,0,NULL,'2010-09-25 02:35:22',1),
 (13,4,2,NULL,NULL,1,6,'HÃ³a cháº¥t ngÃ nh nhuá»™m',NULL,'HÃ³a cháº¥t ngÃ nh nhuá»™m',NULL,'<span style=\"font-family: Arial; font-size: 12px; line-height: 16px; \">HÃ³a cháº¥t ngÃ nh nhuá»™m</span>\r\n<div align=\"center\" style=\"padding-bottom: 5px; font-family: Arial; font-size: 12px; line-height: 16px; \">&nbsp;</div>\r\n<table cellspacing=\"0\" cellpadding=\"0\" border=\"1\" class=\"MsoTableGrid\" style=\"font: normal normal normal 12px/100% Arial; line-height: 16px; border-top-width: medium; border-right-width: medium; border-bottom-width: medium; border-left-width: medium; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-color: initial; border-collapse: collapse; font-family: Arial; font-size: 12px; \">\r\n	<tbody>\r\n		<tr>\r\n			<td width=\"187\" style=\"font: normal normal normal 12px/100% Arial; line-height: 16px; border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; padding-top: 0in; padding-right: 5.4pt; padding-bottom: 0in; padding-left: 5.4pt; width: 1.95in; background-color: transparent; \">\r\n				<p align=\"center\" class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; text-align: center; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; font-weight: bold; \">NGÃ€NH HÃ€NG</span><span style=\"font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p align=\"center\" class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; text-align: center; \"><span style=\"font-family: \'Times New Roman\'; \">\r\n						<o:p>&nbsp;</o:p></span></p></td>\r\n			<td width=\"206\" style=\"font: normal normal normal 12px/100% Arial; line-height: 16px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: none; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: rgb(236, 233, 216); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: medium; padding-top: 0in; padding-right: 5.4pt; padding-bottom: 0in; padding-left: 5.4pt; width: 2.15in; background-color: transparent; \">\r\n				<p align=\"center\" class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; text-align: center; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; font-weight: bold; \">Sáº¢N PHáº¨M DO CTY TÃ‚N CHÃ‚U Sáº¢N XUáº¤T VÃ€ PHÃ‚N PHá»I</span><span style=\"font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p></td>\r\n			<td width=\"197\" style=\"font: normal normal normal 12px/100% Arial; line-height: 16px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: none; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: rgb(236, 233, 216); border-top-width: 1pt; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: medium; padding-top: 0in; padding-right: 5.4pt; padding-bottom: 0in; padding-left: 5.4pt; width: 2.05in; background-color: transparent; \">\r\n				<p align=\"center\" class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: -5.4pt; margin-bottom: 0pt; margin-left: -5.4pt; text-align: center; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; font-weight: bold; \">Sáº¢N PHáº¨M NHáº¬P KHáº¨U DO CTY TÃ‚N CHÃ‚U PHÃ‚N PHá»I Cá»¦A HÃƒNG TANATEX</span><span style=\"font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p></td>\r\n		</tr>\r\n		<tr style=\"height: 316.75pt; \">\r\n			<td width=\"187\" valign=\"top\" style=\"font: normal normal normal 12px/100% Arial; line-height: 16px; border-top-style: none; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(236, 233, 216); border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-top-width: medium; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: 1pt; padding-top: 0in; padding-right: 5.4pt; padding-bottom: 0in; padding-left: 5.4pt; width: 1.95in; height: 316.75pt; background-color: transparent; \">\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">HÃ³a cháº¥t tiá»n xá»­ lÃ½ : cháº¥t ngáº¥m, giáº·t, táº©y dáº§u, á»•n Ä‘á»‹nh, chá»‘ng nhÄƒn, cÃ ng hÃ³a, táº©y há»“â€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 6pt; text-indent: -6pt; \"><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">HÃ³a cháº¥t trá»£ trong quÃ¡ trÃ¬nh nhuá»™m : cháº¥t phÃ¢n tÃ¡n Ä‘á»u mÃ u cho polyester, cotton, nylonâ€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 6pt; text-indent: -6pt; \"><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">HÃ³a cháº¥t xá»­ lÃ½ sau nhuá»™m : cháº¥t giáº·t khá»­ sau nhuá»™m phÃ¢n tÃ¡n, cháº¥t giáº·t sau nhuá»™m hoáº¡t tÃ­nh, cháº¥t cáº§m mÃ uâ€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">HÃ³a cháº¥t hoÃ n táº¥t : cháº¥t khÃ¡ng tÄ©nh Ä‘iá»‡n, há»“ má»m silicone, há»“ má»m acid b&eacute;o, há»“ má»m Ä‘Ã n há»“i, há»“ cá»©ng, há»“ má»m poly-urethaneâ€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 6pt; text-indent: -6pt; \"><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Quang sáº¯c</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 6pt; text-indent: -6pt; \"><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">HÃ³a cháº¥t in hoa : há»“ in phÃ¢n tÃ¡n, binder trong in pigment</span><span style=\"font-size: 10pt; \">\r\n						<o:p></o:p></span></p></td>\r\n			<td width=\"206\" valign=\"top\" style=\"font: normal normal normal 12px/100% Arial; line-height: 16px; border-top-style: none; border-right-style: solid; border-bottom-style: solid; border-left-style: none; border-top-color: rgb(236, 233, 216); border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: rgb(236, 233, 216); border-top-width: medium; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: medium; padding-top: 0in; padding-right: 5.4pt; padding-bottom: 0in; padding-left: 5.4pt; width: 2.15in; height: 316.75pt; background-color: transparent; \">\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Vetanol N, Vetanol T, Vetanol UND, VA-UR, VA-WE, Stapan FT, Vetanol H, Antifoam NF, Vetanol VNR, &nbsp;â€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Tanapol DL310, Tanapol DL503, Level CO, Stapan L, Disper BSB, Protanol IS, Sandol AD, â€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Clear DPE,&nbsp;\r\n						<st1:place w:st=\"on\">\r\n							<st1:city w:st=\"on\">Vetanol</st1:city>&nbsp;\r\n							<st1:state w:st=\"on\">NF</st1:state></st1:place>,</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Fix 300, Fix 300L, â€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Antistatic, Stapan M240, Stapan M350, Stapan SGR, Stapan NA\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Stapan VBK, Stapan NCT, Stapan UV\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Tanawhite BBA, Tanawhite PET, â€¦\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Tanprint PE06, Tanprint BIN,â€¦\r\n						<o:p></o:p></span></p></td>\r\n			<td width=\"197\" valign=\"top\" style=\"font: normal normal normal 12px/100% Arial; line-height: 16px; border-top-style: none; border-right-style: solid; border-bottom-style: solid; border-left-style: none; border-top-color: rgb(236, 233, 216); border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: rgb(236, 233, 216); border-top-width: medium; border-right-width: 1pt; border-bottom-width: 1pt; border-left-width: medium; padding-top: 0in; padding-right: 5.4pt; padding-bottom: 0in; padding-left: 5.4pt; width: 2.05in; height: 316.75pt; background-color: transparent; \">\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Diadavin UN, Persoftal L</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">&nbsp;</span><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Diadavin EWN, Baysolex AE,â€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Tannex GEO\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Avolan IS, Levegal RL, Levegal FTSK,â€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Tanapol RFH,&nbsp;\r\n						<st1:place w:st=\"on\">\r\n							<st1:city w:st=\"on\">Levapon</st1:city>&nbsp;\r\n							<st1:state w:st=\"on\">SC</st1:state></st1:place>, Levogen WRD-T,â€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Persoftal MAI, Persoftal BK Conc, Baypret USV,â€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Blankophor BA 267/BRU, Blankophor ER330, â€¦</span><span style=\"font-size: 10pt; font-family: \'Times New Roman\'; \">\r\n						<o:p></o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">\r\n						<o:p>&nbsp;</o:p></span></p>\r\n				<p class=\"MsoNormal\" style=\"margin-top: 0in; margin-right: 0in; margin-bottom: 0pt; margin-left: 0in; \"><span style=\"font-size: 10pt; color: rgb(102, 102, 51); font-family: Tahoma; \">Acrfix ML,â€¦</span></p></td>\r\n		</tr>\r\n	</tbody>\r\n</table>',NULL,'947_11621_images_L.jpg','500500','1',NULL,NULL,'product',NULL,NULL,1,0,NULL,'2010-09-25 02:38:45',1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


--
-- Definition of table `prosubcat1`
--

DROP TABLE IF EXISTS `prosubcat1`;
CREATE TABLE `prosubcat1` (
  `id_prosubcat1` int(10) unsigned NOT NULL auto_increment,
  `id_procat` int(10) unsigned NOT NULL,
  `prosubcat1_name` varchar(60) default NULL,
  `prosubcat1_name_EN` varchar(60) default NULL,
  `url` varchar(60) default NULL,
  `notes` varchar(60) default NULL,
  `notes_EN` varchar(60) default NULL,
  `day_update` datetime default NULL,
  `sort` int(10) unsigned default NULL,
  `visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_prosubcat1`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prosubcat1`
--

/*!40000 ALTER TABLE `prosubcat1` DISABLE KEYS */;
INSERT INTO `prosubcat1` (`id_prosubcat1`,`id_procat`,`prosubcat1_name`,`prosubcat1_name_EN`,`url`,`notes`,`notes_EN`,`day_update`,`sort`,`visible`) VALUES 
 (1,1,'MÃ¡y phÃ¡t Ä‘iá»‡n Loáº¡i lá»›n','Size max of Generators',NULL,NULL,NULL,'2010-07-29 14:14:50',1,1),
 (2,4,'CÃ´ng nghiá»‡p - XÃ¢y dá»±ng','Industrial - Building',NULL,NULL,NULL,'2010-08-06 19:17:55',2,1),
 (3,4,'Y táº¿ - DÆ°á»£c','Health - Medicine',NULL,NULL,NULL,'2010-08-06 19:17:55',3,1),
 (4,4,'Dá»¥ng cá»¥ chá»©a Ä‘á»±ng','Containers Tools',NULL,NULL,NULL,'2010-08-06 19:17:55',4,1),
 (5,3,'Báº£o há»™ lao Ä‘á»™ng','Labour Protection',NULL,NULL,NULL,'2010-08-23 00:58:32',5,1),
 (6,3,'Thiáº¿t bá»‹ cÃ´ng trÃ¬nh','works equipment',NULL,NULL,NULL,'2010-08-23 01:04:36',6,1),
 (7,3,'Thiáº¿t bá»‹ lá»c','Filter equipment',NULL,NULL,NULL,'2010-08-23 01:14:19',7,1),
 (8,5,'Xi mÄƒng','cement',NULL,NULL,NULL,'2010-09-24 23:40:04',8,1),
 (9,5,'Gá»‘m - Gá»— - Gáº¡ch - NgÃ³i','Pottery - Wood - Ceramic - Tile',NULL,NULL,NULL,'2010-09-24 23:40:04',9,1),
 (10,5,'Thá»§y tinh - Pha lÃª','Glass - Crystal',NULL,NULL,NULL,'2010-09-24 23:40:04',10,1),
 (11,5,'KhÃ¡c','Other',NULL,NULL,NULL,'2010-09-25 00:10:06',11,1),
 (12,6,'MÃ¡y hÃºt bá»¥i','Vacuum Cleaners',NULL,NULL,NULL,'2010-09-25 00:11:15',12,1),
 (13,6,'MÃ n ngÄƒn PVC','PVC Blinds',NULL,NULL,NULL,'2010-09-25 00:11:15',13,1),
 (14,6,'MÃ¡y chÃ  sÃ n','Machine scrub floors',NULL,NULL,NULL,'2010-09-25 00:11:15',14,1),
 (15,6,'MÃ¡y giáº·c tháº£m','Carpet Washing Machine',NULL,NULL,NULL,'2010-09-25 00:16:45',15,1),
 (16,6,'MÃ¡y phun rá»­a','Washer machine',NULL,NULL,NULL,'2010-09-25 00:16:45',16,1),
 (17,6,'MÃ¡y Ä‘Ã¡nh bÃ³ng','Polishing Machine',NULL,NULL,NULL,'2010-09-25 00:16:45',17,1),
 (18,6,'MÃ¡y giáº·c gháº¿','Machine enemy chair',NULL,NULL,NULL,'2010-09-25 00:19:42',18,1),
 (19,6,'MÃ¡y báº£o dÆ°á»¡ng','Machine maintenance',NULL,NULL,NULL,'2010-09-25 00:19:42',19,1),
 (20,6,'Dá»¥ng cá»¥ vá»‡ sinh khÃ¡c','Other toiletries',NULL,NULL,NULL,'2010-09-25 00:19:42',20,1),
 (21,7,'Xe táº£i','Truck',NULL,NULL,NULL,'2010-09-25 00:27:08',21,1),
 (22,7,'Ã” tÃ´','Car',NULL,NULL,NULL,'2010-09-25 00:27:34',22,1),
 (23,7,'Xe mÃ¡y','motocycle',NULL,NULL,NULL,'2010-09-25 00:29:06',23,1),
 (24,2,'MÃ¡y cÆ¡ giá»›i','Machine motor',NULL,NULL,NULL,'2010-09-25 00:32:51',24,1),
 (25,2,'MÃ¡y cÃ´ng trÃ¬nh','Construction Machines',NULL,NULL,NULL,'2010-09-25 00:32:51',25,1),
 (26,2,'MÃ¡y sáº£n xuáº¥t','produces machine',NULL,NULL,NULL,'2010-09-25 00:32:51',26,1),
 (27,2,'MÃ¡y bÆ¡m - MÃ¡y hÃºt','Pumps - Vacuum',NULL,NULL,NULL,'2010-09-25 00:42:22',27,1),
 (28,2,'MÃ¡y mÃ³c khÃ¡c','Other machine',NULL,NULL,NULL,'2010-09-25 00:42:22',28,1);
/*!40000 ALTER TABLE `prosubcat1` ENABLE KEYS */;


--
-- Definition of table `prosubcat2`
--

DROP TABLE IF EXISTS `prosubcat2`;
CREATE TABLE `prosubcat2` (
  `id_prosubcat2` int(10) unsigned NOT NULL auto_increment,
  `id_procat` int(10) unsigned default NULL,
  `id_prosubcat1` int(10) unsigned default NULL,
  `prosubcat2_name` varchar(60) default NULL,
  `prosubcat2_name_EN` varchar(60) default NULL,
  `url` varchar(60) default NULL,
  `notes` varchar(60) default NULL,
  `notes_EN` varchar(60) default NULL,
  `day_update` datetime default NULL,
  `sort` int(10) unsigned default NULL,
  `visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_prosubcat2`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prosubcat2`
--

/*!40000 ALTER TABLE `prosubcat2` DISABLE KEYS */;
INSERT INTO `prosubcat2` (`id_prosubcat2`,`id_procat`,`id_prosubcat1`,`prosubcat2_name`,`prosubcat2_name_EN`,`url`,`notes`,`notes_EN`,`day_update`,`sort`,`visible`) VALUES 
 (1,1,1,'MÃ¡y phÃ¡t Ä‘iá»‡n loáº¡i 1.1','Generators (type of 1.1)',NULL,NULL,NULL,'2010-07-29 14:40:11',1,1);
/*!40000 ALTER TABLE `prosubcat2` ENABLE KEYS */;


--
-- Definition of table `prosubcat3`
--

DROP TABLE IF EXISTS `prosubcat3`;
CREATE TABLE `prosubcat3` (
  `id_prosubcat3` int(10) unsigned NOT NULL auto_increment,
  `id_procat` int(10) unsigned NOT NULL,
  `id_prosubcat1` int(10) unsigned NOT NULL,
  `id_prosubcat2` int(10) unsigned NOT NULL,
  `prosubcat3_name` varchar(60) default NULL,
  `prosubcat3_name_EN` varchar(60) default NULL,
  `url` varchar(60) default NULL,
  `notes` varchar(60) default NULL,
  `notes_EN` varchar(60) default NULL,
  `day_update` datetime default NULL,
  `sort` int(10) unsigned default NULL,
  `visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_prosubcat3`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prosubcat3`
--

/*!40000 ALTER TABLE `prosubcat3` DISABLE KEYS */;
INSERT INTO `prosubcat3` (`id_prosubcat3`,`id_procat`,`id_prosubcat1`,`id_prosubcat2`,`prosubcat3_name`,`prosubcat3_name_EN`,`url`,`notes`,`notes_EN`,`day_update`,`sort`,`visible`) VALUES 
 (1,1,1,1,'MÃ¡y phÃ¡t Ä‘iá»‡n loáº¡i 1.3','Generator 1.3',NULL,NULL,NULL,'2010-07-29 14:54:46',1,1);
/*!40000 ALTER TABLE `prosubcat3` ENABLE KEYS */;


--
-- Definition of table `prosubcat4`
--

DROP TABLE IF EXISTS `prosubcat4`;
CREATE TABLE `prosubcat4` (
  `id_prosubcat4` int(10) unsigned NOT NULL auto_increment,
  `id_procat` int(11) unsigned NOT NULL,
  `id_prosubcat1` int(11) unsigned NOT NULL,
  `id_prosubcat2` int(11) unsigned NOT NULL,
  `id_prosubcat3` int(11) unsigned NOT NULL,
  `prosubcat4_name` varchar(60) default NULL,
  `prosubcat4_name_EN` varchar(60) default NULL,
  `url` varchar(60) default NULL,
  `notes` varchar(60) default NULL,
  `notes_EN` varchar(60) default NULL,
  `day_update` datetime default NULL,
  `sort` int(10) unsigned default NULL,
  `visible` tinyint(4) unsigned default '1',
  PRIMARY KEY  (`id_prosubcat4`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prosubcat4`
--

/*!40000 ALTER TABLE `prosubcat4` DISABLE KEYS */;
INSERT INTO `prosubcat4` (`id_prosubcat4`,`id_procat`,`id_prosubcat1`,`id_prosubcat2`,`id_prosubcat3`,`prosubcat4_name`,`prosubcat4_name_EN`,`url`,`notes`,`notes_EN`,`day_update`,`sort`,`visible`) VALUES 
 (1,1,1,1,1,'MÃ¡y phÃ¡t Ä‘iá»‡n 1.4','Generator 1.4',NULL,NULL,NULL,'2010-07-29 15:12:40',1,1);
/*!40000 ALTER TABLE `prosubcat4` ENABLE KEYS */;


--
-- Definition of table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id_question` int(10) unsigned NOT NULL auto_increment,
  `question_fullname` varchar(60) default NULL,
  `question_email` varchar(60) default NULL,
  `question_title` varchar(100) default NULL,
  `question_content` text,
  `question_day_update` datetime default NULL,
  `question_visible` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question`
--

/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` (`id_question`,`question_fullname`,`question_email`,`question_title`,`question_content`,`question_day_update`,`question_visible`) VALUES 
 (5,'le duc tho','hspq07@gmail.com','Ping Ä‘Æ°á»£c nhÆ°ng khÃ´ng vÃ o máº¡ng Ä‘Æ°á»£c ','TÃ¬nh hÃ¬nh lÃ  em vá»«a vá»‡ sinh 1 mÃ¡y á»Ÿ cÆ¡ quan xong khi láº¯p rÃ¡p láº¡i thÃ¬ khÃ´ng hiá»ƒu táº¡i sao mÃ¡y khÃ´ng thá»ƒ duyá»‡t Web Ä‘Æ°á»£c dÃ¹ em ping Ä‘áº¿n cÃ¡c trang web váº«n Ä‘Æ°á»£c.\r\n\r\nEm Ä‘Ã£ thá»­ dÃ¹ng nhiá»u cÃ¡ch nhÆ° Ä‘áº·t Ä‘á»‹a chá»‰ IP, DNS, clear cache , restore default IE, dÃ¹ng trÃ¬nh duyá»‡t khÃ¡c, kiá»ƒm tra card máº¡ng, kiá»ƒm tra Proxy cá»§a server nhÆ°ng khÃ´ng tháº¥y cÃ³ hiá»‡n tÆ°á»£ng gÃ¬ báº¥t thÆ°á»ng vÃ¬ cÃ¡c mÃ¡y trong cÆ¡ quan Ä‘iá»u vÃ o Web Ä‘Æ°á»£c ngoáº¡i trá»« mÃ¡y nÃ y em chÆ°a dÃ¡m ghost hay cÃ i Win láº¡i vÃ¬ cÆ¡ quan hiá»‡n Ä‘ang sá»­ dá»¥ng pháº§n má»m chung cho cÃ´ng ty vÃ  mÃ¡y nÃ y Ä‘Ã³ng vai trÃ² cÅ©ng khÃ¡ quan trá»ng vÃ  dá»¯ liá»‡u trÃªn mÃ¡y nÃ y cÅ©ng nhiá»u nÃªn Ghost hay cÃ i Windows láº¡i lÃ  biá»‡n phÃ¡p khÃ´ng kháº£ thi.\r\n\r\nXin chá»‰ giÃºp em cÃ¡ch kháº¯c phá»¥c.','2010-09-15 03:29:58',1),
 (6,'le duc tho','hspq07@gmail.com','tieu de lien he  cá»§a tui','ná»™i dung liÃªn há»‡ cá»§a tui','2010-09-18 09:29:42',1);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;


--
-- Definition of table `question_answer`
--

DROP TABLE IF EXISTS `question_answer`;
CREATE TABLE `question_answer` (
  `id_question_answer` int(10) unsigned NOT NULL auto_increment,
  `qsas_title` varchar(200) default NULL,
  `qsas_humanname_contact` varchar(60) default NULL,
  `qsas_email` varchar(60) default NULL,
  `qsas_tel` varchar(20) default NULL,
  `qsas_address` varchar(200) default NULL,
  `qsas_content` text,
  `qsas_day_update` datetime default NULL,
  `qsas_visible` tinyint(3) unsigned default '0',
  PRIMARY KEY  USING BTREE (`id_question_answer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_answer`
--

/*!40000 ALTER TABLE `question_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `question_answer` ENABLE KEYS */;


--
-- Definition of table `rates`
--

DROP TABLE IF EXISTS `rates`;
CREATE TABLE `rates` (
  `id_rates` int(10) unsigned NOT NULL auto_increment,
  `rates_content` varchar(10) default NULL,
  `rates_sort` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_rates`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tỉ giá(đơn vị tiền tệ để trao đổi giữa các thành viên,doanh ';

--
-- Dumping data for table `rates`
--

/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
INSERT INTO `rates` (`id_rates`,`rates_content`,`rates_sort`) VALUES 
 (1,'VNÄ',1),
 (2,'USD',2),
 (3,'EUR',3),
 (4,'JPY',4),
 (5,'GBP',5),
 (6,'VÃ ng',6);
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;


--
-- Definition of table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id_services` int(10) unsigned NOT NULL auto_increment,
  `id_member` int(11) unsigned default NULL,
  `id_services_categories` int(10) unsigned default NULL,
  `title` varchar(200) default NULL,
  `title_EN` varchar(200) default NULL,
  `image_illustrate` varchar(60) default NULL,
  `short_describe` varchar(255) default NULL,
  `short_describe_EN` varchar(255) default NULL,
  `content` text,
  `content_EN` text,
  `view` int(10) unsigned default NULL,
  `day_update` datetime default NULL,
  `visible` tinyint(3) unsigned default NULL,
  PRIMARY KEY  (`id_services`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id_services`,`id_member`,`id_services_categories`,`title`,`title_EN`,`image_illustrate`,`short_describe`,`short_describe_EN`,`content`,`content_EN`,`view`,`day_update`,`visible`) VALUES 
 (2,1,2,'\"Má»™t NgÃ y LÃ m NÃ´ng DÃ¢n Miá»‡t VÆ°á»n\" táº¡i VÄ©nh Long',NULL,'2693_7_phuquoc_L_1.jpg','Äá»“ng báº±ng sÃ´ng cá»­u long lÃ  má»™t vá»±a lÃºa lá»›n nháº¥t Viá»‡t Nam chÃºng ta. NgÆ°á»i dÃ¢n nÆ¡i Ä‘Ã¢y vá»‘n cáº§n máº«n, chá»‹u thÆ°Æ¡ng, chá»‹u khÃ³ há» miá»‡t mÃ i vá»›i chuyá»‡n Ä‘á»“ng Ã¡ng, ruá»™ng vÆ°á»n; Cá»±c nhá»c tháº¿ nhÆ°ng nhá»¯',NULL,'\"Má»™t NgÃ y LÃ m NÃ´ng DÃ¢n Miá»‡t VÆ°á»n\" táº¡i VÄ©nh Long\r\nThá»i gian: 01 ngÃ y\r\nPhÆ°Æ¡ng tiá»‡n: Xe mÃ¡y láº¡nh\r\n\r\n     Äá»“ng báº±ng sÃ´ng cá»­u long lÃ  má»™t vá»±a lÃºa lá»›n nháº¥t Viá»‡t Nam chÃºng ta. NgÆ°á»i dÃ¢n nÆ¡i Ä‘Ã¢y vá»‘n cáº§n máº«n, chá»‹u thÆ°Æ¡ng, chá»‹u khÃ³ há» miá»‡t mÃ i vá»›i chuyá»‡n Ä‘á»“ng Ã¡ng, ruá»™ng vÆ°á»n; Cá»±c nhá»c tháº¿ nhÆ°ng nhá»¯ng ná»¥ cÆ°á»i hiá»n hoÃ  vÃ  Ä‘Ã´n háº­u luÃ´n hiá»‡n há»¯u trÃªn mÃ´i cá»§a má»—i ngÆ°á»i dÃ¢n nÆ¡i Ä‘Ã¢y.\r\n\r\n    CÅ©ng chÃ­nh táº¡i vÃ¹ng Ä‘áº¥t nÃ y mÃ  nhiá»u loai hÃ¬nh vÄƒn hoÃ¡ nghá»‡ thuáº­t Ä‘áº·c sáº¯c Ä‘Æ°á»£c hÃ¬nh thÃ nh nhÆ°:hÃ² Ä‘á»‘i Ä‘Ã¡p, cÃ¡c Ä‘iá»‡u lÃ½ vÃ  Ä‘áº·c biá»‡t lÃ  cáº£i lÆ°Æ¡ng vá»›i cháº¥t giá»ng Nam Bá»™ mÆ°á»£t mÃ  cá»§a cÃ¡c chÃ ng trai, cÃ´ gÃ¡i trÃªn cÃ¡nh Ä‘á»“ng lÃ m lay Ä‘á»™ng lÃ²ng ngÆ°á»i, sáº½ nÃ­u chÃ¢n du khÃ¡ch khi Ä‘áº¿n nÆ¡i Ä‘Ã¢y.\r\n\r\nNáº¿u ai Ä‘Ã£ tá»«ng má»™t láº§n tiáº¿p xÃºc vá»›i ngÆ°á»i dÃ¢n nÆ¡i Ä‘Ã¢y sáº½ tháº¥y Ä‘Æ°á»£c cÃ¡i thi vá»‹ cá»§a cuá»™c sá»‘ng thÃ´n quÃª. KhÃ´ng cao lÆ°Æ¡ng má»¹ vá»‹-khÃ´ng tá»‰u vá»‹ há»“ng Ä‘Ã o; Ä‘Æ¡n giáº£n chá»‰ lÃ  má»™t con cÃ¡ lÃ³c nÆ°á»›ng trui (vá»«a má»›i tÃ¡t mÆ°Æ¡ng Ä‘em vá») cá»™ng vá»›i cÃ¡c loáº¡i rau quáº£ cÃ³ sáºµn trong vÆ°á»n vá»›i bÃ n tay khÃ©o lÃ©o cá»§a ngÆ°á»i dÃ¢n nÆ¡i Ä‘Ã¢y Ä‘Ã£ táº¡o nÃªn má»™t bÃ n Äƒn Ä‘Æ¡n sÆ¡ má»™c máº¡c  nhÆ°ng tháº¯m Ä‘Æ°á»£m tÃ¬nh lÃ ng nghÄ©a xÃ³m.\r\n\r\n    Vá»›i mong muá»‘n Ä‘Æ°a vÄƒn minh miá»‡t vÆ°á»n Ä‘áº¿n vá»›i má»i ngÆ°á»i dÃ¢n Vá»‹á»‡t Nam nÃ³i riÃªng vÃ  báº¡n bÃ¨ tháº¿ giá»›i nÃ³i chung; CÃ´ng ty du lá»‹ch HÃ²n Ngá»c Viá»…n ÄÃ´ng hy vá»ng vá»›i Ä‘Ã´i nÃ©t má»™c máº¡c chÃ¢n quÃª sáº½ táº¡o ra cho du khÃ¡ch nhá»¯ng khoáº£ng kháº¯c khÃ´ng bao giá» quÃªn.\r\n\r\n    HÃ£y hoÃ  mÃ¬nh vÃ o thiÃªn nhiÃªn Ä‘á»ƒ cáº£m nháº­n nhá»¯ng gÃ¬ mÃ¬nh Ä‘ang cÃ³, Ä‘á»ƒ biáº¿t ráº±ng háº¡nh phÃºc báº¯t Ä‘áº§u tá»« nhá»¯ng Ä‘iá»u bÃ¬nh dá»‹ nháº¥t.\r\n\r\nCHÆ¯Æ NG TRÃŒNH\r\n\r\n06h00: QuÃ½ khÃ¡ch táº­p trung táº¡i CÃ´ng ty Du Lá»‹ch HÃ²n Ngá»c Viá»…n ÄÃ´ng , Khá»Ÿi hÃ nh Ä‘i VÄ©nh Long.\r\n\r\n07h00: Ä‚n sÃ¡ng táº¡i NhÃ  HÃ ng Mekong Rest Stop\r\n\r\n08h30: QuÃ½ khÃ¡ch lÃªn thuyá»n tham quan vÆ°á»£t SÃ´ng Tiá»n ngáº¯m nhÃ¬n CÃ¹ lao An BÃ¬nh vá»›i nhá»¯ng vÆ°á»n cÃ¢y trÃ¡i trÄ©u quáº£, ghÃ© tham quan vÆ°á»n cÃ¢y giá»‘ng TÃ¡m Há»• - QuÃ½ khÃ¡ch thÆ°á»Ÿng thá»©c trÃ¡i cÃ¢y táº¡i vÆ°á»n miá»…n phÃ­.\r\n\r\n10h00: QuÃ½ khÃ¡ch thay Ä‘á»“ bÃ  ba Ä‘á»ƒ tham dá»± chÆ°Æ¡ng trÃ¬nh \"Be mÆ°Æ¡ng tÃ¡t cÃ¡\", QuÃ½ khÃ¡ch tá»± mÃ¬nh báº¯t nhá»¯ng con cÃ¡, con á»‘c ...trong ao vÃ  cháº¿ biáº¿n mÃ³n cÃ¡ nÆ°á»›ng, thÆ°á»Ÿng thá»©c ngay táº¡i vÆ°á»n cÃ¹ng rÆ°á»£u máº­t ong.\r\n\r\n12h00: QuÃ½ khÃ¡ch dÃ¹ng cÆ¡m trÆ°a táº¡i nhÃ  vÆ°á»n - thÆ°á»Ÿng thá»©c ca nháº¡c tÃ i tá»­ Nam Bá»™.\r\n\r\n14h00: QuÃ½ khÃ¡ch tham quan nhÃ  xÆ°a Ã´ng Cai CÆ°á»ng - má»™t gia Ä‘Ã¬nh Ä‘iá»n chá»§ thá»i phong kiáº¿n, xem trÆ°ng bÃ y nÃ´ng cá»¥ cá»• truyá»n, sa bÃ n trá»“ng lÃºa nÆ°á»›c. \r\n\r\n14h30 : Tham quan cÆ¡ sá»Ÿ sáº£n xuáº¥t káº¹o dá»«a - xem quy trÃ¬nh vÃ  cÃ¹ng lÃ m lÃ m káº¹o vá»›i ngÆ°á»i dÃ¢n.\r\n\r\n15h00: QuÃ½ khÃ¡ch xuá»‘ng thuyá»n vá» láº¡i VÄ©nh Long, khá»Ÿi hÃ nh vá» ThÃ nh Phá»‘ Há»“ ChÃ­ Minh.\r\n\r\n18h00: Vá» Ä‘áº¿n ThÃ nh Phá»‘ Há»“ ChÃ­ Minh-Chia tay QuÃ½ khÃ¡ch.\r\n\r\n \r\nNgÃ y khá»Ÿi hÃ nh: Chá»§ Nháº­t HÃ ng Tuáº§n\r\nBáº£ng giÃ¡\r\n\r\nGÃ­a cho ngÆ°á»i lá»›n: 540.000 Äá»“ng/khÃ¡ch (cho nhÃ³m 10 khÃ¡ch trá»Ÿ lÃªn)\r\n\r\nTráº» em tá»« 06-12 tuá»•i: 400.000 Äá»“ng/ khÃ¡ch\r\n\r\n(GÃ­a Ã¡p dá»¥ng trong  nÄƒm 2009)',NULL,NULL,'2010-08-25 08:49:27',1),
 (3,1,2,'PhÃº Quá»‘c Äáº£o Ngá»c',NULL,'2693_7_phuquoc_L.jpg','PhÃº Quá»‘c Äáº£o Ngá»c - Khá»Ÿi hÃ nh hÃ ng ngÃ y\r\nThá»i gian: 3 ngÃ y - 2 Ä‘Ãªm\r\nPhÆ°Æ¡ng tiá»‡n: MÃ¡y Bay',NULL,'PhÃº Quá»‘c Äáº£o Ngá»c - Khá»Ÿi hÃ nh hÃ ng ngÃ y\r\nThá»i gian: 3 ngÃ y - 2 Ä‘Ãªm\r\nPhÆ°Æ¡ng tiá»‡n: MÃ¡y Bay\r\nCHÆ¯Æ NG TRÃŒNH DU Lá»ŠCH PHÃš QUá»C - Äáº£o xanh rá»±c náº¯ng\r\n \r\nTham quan tháº¯ng cáº£nh vÃ  di tÃ­ch lá»‹ch sá»­\r\nTáº¯m biá»ƒn, picnic, cÃ¢u cÃ¡,  táº¯m suá»‘i... ThÆ°á»Ÿng thá»©c cÃ¡c mÃ³n Äƒn Ä‘áº·c sáº£n cá»§a Ä‘áº£o\r\nÂ¨       Khá»Ÿi hÃ nh: háº±ng ngÃ y.\r\nÂ¨       Äi, vá» mÃ¡y bay â€“ Thá»i gian: 3  ngÃ y 2 Ä‘Ãªm.\r\n\r\nNGÃ€Y 1:           TP.HCM â€“ PHÃš QUá»C (Ä‚n trÆ°a, chiá»u)\r\nBuá»•i sÃ¡ng         : Xe Ä‘Æ°a khÃ¡ch ra sÃ¢n bay TÃ¢n SÆ¡n Nháº¥t, Ä‘i PhÃº Quá»‘c. Äáº¿n PhÃº Quá»‘c, xe Ä‘Ã³n vÃ  Ä‘Æ°a khÃ¡ch Ä‘i viáº¿ng chÃ¹a SÃ¹ng HÆ°ng Cá»• Tá»±, tá»± do táº¯m biá»ƒn. QuÃ½ khÃ¡ch nháº­n phÃ²ng.\r\nBuá»•i chiá»u       : ÄoÃ n Ä‘i Báº¯c Äáº£o tham quan khu rá»«ng NguyÃªn Sinh, Ä‘á»n thá» Ã”ng Nguyá»…n Trung Trá»±c, vÆ°á»n tiÃªu Khu TÆ°á»£ng â€“ xá»© sá»Ÿ tiÃªu PhÃº Quá»‘c ná»•i tiáº¿ng, tháº¯ng cáº£nh Dinh Cáº­u.\r\nBuá»•i tá»‘i           : QuÃ½ khÃ¡ch tá»± do hoáº·c cÃ¢u tháº» má»±c vá» Ä‘Ãªm .\r\n                                                                       \r\nNGÃ€Y 2:            PHÃš QUá»C (Ä‚n sÃ¡ng, trÆ°a, chiá»u)\r\nBuá»•i sÃ¡ng        : ÄoÃ n Ä‘i Nam Ä‘áº£o tham quan cÆ¡ sá»Ÿ nuÃ´i cáº¥y Ngá»c Trai cá»§a Ãšc - cÃ¡c trang sá»©c báº±ng ngá»c trai chÃ­nh hiá»‡u Ä‘Æ°á»£c nuÃ´i cáº¥y táº¡i PhÃº Quá»‘c, Cáº£ng An Thá»›i - cÃ³ Ä‘áº·c sáº£n tÃ´m, cÃ¡, má»±c khÃ´, tham quan Di tÃ­ch nhÃ  tÃ¹ PhÃº Quá»‘c, táº¯m biá»ƒn BÃ£i Sao, , nghá»‰ ngÆ¡i báº±ng vÃµng, gháº¿ dÃ¹ táº¡i BÃ£i Sao.\r\nBuá»•i chiá»u       : ÄoÃ n tiáº¿p tá»¥c Ä‘i LÃ ng ChÃ i HÃ m Minh (thÆ°á»Ÿng thá»©c háº£i sáº£n tÆ°Æ¡i sá»‘ng táº¡i Ä‘Ã¢y), suá»‘i Tranh (táº¯m suá»‘i, leo nÃºi, thÄƒm rá»«ng), viáº¿ng chÃ¹a Cao (Am SÆ° MuÃ´n), tham quan má»™t cÆ¡ sá»Ÿ sáº£n xuáº¥t nÆ°á»›c máº¯m PhÃº Quá»‘c xuáº¥t kháº©u, tá»± do táº¯m biá»ƒn táº¡i khÃ¡ch sáº¡n.\r\nBuá»•i tá»‘i           : QuÃ½ khÃ¡ch tá»± do.\r\n                                                                                                                      \r\nNGÃ€Y 3:           PHÃš QUá»C â€“ TP.HCM (Ä‚n sÃ¡ng)\r\nBuá»•i sÃ¡ng        : QuÃ½ khÃ¡ch tá»± do mua sáº¯m táº¡i chá»£ DÆ°Æ¡ng ÄÃ´ng. Sau Ä‘Ã³, xe Ä‘Æ°a Ä‘oÃ n ra sÃ¢n bay PhÃº Quá»‘c khá»Ÿi hÃ nh vá» TP. HCM. Äáº¿n TP.HCM, xe Ä‘Ã³n vÃ  Ä‘Æ°a khÃ¡ch vá» Ä‘iá»ƒm tráº£ khÃ¡ch. Chia tay, táº¡m biá»‡t vÃ  háº¹n ngÃ y tÃ¡i ngá»™\r\nNgÃ y khá»Ÿi hÃ nh: hÃ ng ngÃ y\r\nBáº£ng giÃ¡\r\nGIÃ TOUR  CHO 01 KHÃCH VIÃŠT NAM VÃ€ VIá»†T KIá»€U â€“Vietnam Dong\r\n\r\nNHÃ“M KHACH\r\n\r\nPHá»¤ THU\r\n\r\nTiÃªu chuáº©n\r\n\r\n1-6k\r\n\r\n7-10 k                         \r\n\r\n \r\n\r\n \r\n\r\n11-14k\r\n\r\n \r\n\r\n \r\n\r\nTrÃªn 15 k\r\n\r\n \r\n\r\nphÃ²ng Ä‘Æ¡n\r\n\r\nngá»ai quá»‘c\r\n\r\n4 sao\r\n\r\n2.800.000\r\n2.730.000 \r\n2.650.000 \r\n2.600.000 \r\n1.200.000 \r\n \r\n3 sao\r\n\r\n2.000.000\r\n1.950.000 \r\n1.900.000 \r\n1.820.000 \r\n600.000 \r\n \r\n2 sao\r\n\r\n1.600.000\r\n 1.560.000\r\n1.500.000 \r\n1.450.000 \r\n 400.000\r\n \r\nGIÃ ÃP Dá»¤NG TRONG NÄ‚M 2009, TRá»ª CÃC NGÃ€Y Lá»„ VÃ€ Táº¾T Ã‚M Lá»ŠCH\r\n\r\n \r\n\r\nKHá»žI HÃ€NH HÃ€NG NGÃ€Y - NGÃ€Y KHá»žI HÃ€NH DO QUÃ KHÃCH Tá»° CHá»ŒN\r\n\r\n            BAO Gá»’M:\r\n1.      Váº­n chuyá»ƒn:  Xe Ä‘á»i má»›i cÃ³ mÃ¡y láº¡nh Ä‘Æ°a Ä‘Ã³n sÃ¢n bay vÃ  tham quan\r\n2.      KhÃ¡ch sáº¡n:            1 phÃ²ng/ 2 khÃ¡ch theo Ä‘Ãºng tiÃªu chuáº©n khÃ¡ch mua tour.\r\n3.      Ä‚n uá»‘ng : khÃ¡ch Ä‘Æ°á»£c lo Äƒn tá»« sÃ¡ng ngÃ y Ä‘i Ä‘áº¿n trÆ°a ngÃ y vá» theo chÆ°Æ¡ng trÃ¬nh.\r\n4.      HÆ°á»›ng dáº«n viÃªn: chuyÃªn nghiá»‡p phá»¥c vá»¥ QuÃ½ khÃ¡ch suá»‘t tuyáº¿n.\r\n5.      Tham quan: KhÃ¡ch Ä‘Æ°á»£c bao tiá»n vÃ© vÃ o cá»­a cÃ¡c tháº¯ng cáº£nh.\r\n6.      Báº£o hiá»ƒm: KhÃ¡ch Ä‘Æ°á»£c báº£o hiá»ƒm du lá»‹ch trá»n tour.\r\n7.      QuÃ  táº·ng: NÃ³n du lá»‹ch, nÆ°á»›c suá»‘i â€“khÄƒn láº¡nh phá»¥c vá»¥ trÃªn Ä‘Æ°á»ng.\r\nKHÃ”NG BAO Gá»’M:\r\n1.      VÃ© mÃ¡y bay khá»© há»“i, lá»‡ phÃ­ sÃ¢n bay: 1.660. 000 VND\r\n2.      Ä‚n uá»‘ng ngoÃ i chÆ°Æ¡ng trÃ¬nh, Ä‘iá»‡n thoáº¡i, giáº·t á»§i vÃ  cÃ¡c chi phÃ­ vui chÆ¡i giáº£i trÃ­ cÃ¡ nhÃ¢n khÃ¡c.\r\n \r\n \r\n \r\nVÃ‰ TOUR CHO TRáºº EM\r\n \r\nVÃ‰ MÃY BAY CHO TRáºº EM\r\n \r\n1.      Tráº» em tá»« 12 tuá»•i trá»Ÿ lÃªn mua 01 ve nhÆ° ngÆ°á»i lá»›n.\r\n2.      Tráº» em tá»« 06 Ä‘áº¿n 11 tuá»•i mua Â½ vÃ© tour .\r\n    \r\n1. Tráº» em tá»« 2 tuá»•i Ä‘áº¿n 11 tuá»•i mua 75% vÃ© mÃ¡y bay\r\n2. DÆ°á»›i 2 tuá»•i mua 10% vÃ© mÃ¡y bay cÃ´ng bá»‘.\r\n \r\nLÆ°u Ã½: Tráº» em tá»« 05 tuá»•i trá»Ÿ xuá»‘ng : khÃ´ng tÃ­nh vÃ©, gia Ä‘Ã¬nh tá»± lo. NhÆ°ng 02 ngÆ°á»i lá»›n chá»‰ Ä‘Æ°á»£c kÃ¨m 01 tráº» em, náº¿u tráº» em Ä‘i kÃ¨m nhiá»u hÆ¡n thÃ¬ tá»« tráº» em thá»© 02 trá»Ÿ lÃªn pháº£i mua Â½ vÃ©. (TiÃªu chuáº©n Â½ vÃ©: Ä‘Æ°á»£c 01 suáº¥t Äƒn + 01 gháº¿ ngá»“i xe vÃ  ngá»§ ghÃ©p chung vá»›i gia Ä‘Ã¬nh)\r\n \r\nQUY Äá»ŠNH Vá»€ Há»¦Y TOUR      \r\n \r\nÃ˜       Náº¿u há»§y vÃ© trÆ°á»›c 72h khá»Ÿi hÃ nh , QÃºy khÃ¡ch sáº½ chá»‹u phÃ­ 10% giÃ¡ tour.\r\nÃ˜       Náº¿u há»§y vÃ© trÆ°á»›c 48h khá»Ÿi hÃ nh,  QÃºy khÃ¡ch sáº½ chá»‹u phÃ­ 30% giÃ¡ tour\r\nÃ˜       Náº¿u há»§y vÃ© trÆ°á»›c 24h khá»Ÿi hÃ nh QÃºy khÃ¡ch sáº½ chá»‹u phÃ­  80% giÃ¡ tour.\r\nÃ˜       Náº¿u QÃºy khÃ¡ch bá» tour,  QÃºy khÃ¡ch sáº½ chá»‹u phÃ­  100% giÃ¡ tour.',NULL,NULL,'2010-08-25 09:01:20',1);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;


--
-- Definition of table `services_categories`
--

DROP TABLE IF EXISTS `services_categories`;
CREATE TABLE `services_categories` (
  `id_services_categories` int(10) unsigned NOT NULL auto_increment,
  `svcat_name` varchar(60) default NULL,
  `svcat_name_EN` varchar(60) default NULL,
  `svcat_url` varchar(60) default NULL,
  `svcat_notes` varchar(60) default NULL,
  `svcat_notes_EN` varchar(60) default NULL,
  `svcat_day_update` datetime default NULL,
  `svcat_sort` int(10) unsigned default NULL,
  `svcat_visible` tinyint(3) unsigned default NULL,
  PRIMARY KEY  USING BTREE (`id_services_categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `services_categories`
--

/*!40000 ALTER TABLE `services_categories` DISABLE KEYS */;
INSERT INTO `services_categories` (`id_services_categories`,`svcat_name`,`svcat_name_EN`,`svcat_url`,`svcat_notes`,`svcat_notes_EN`,`svcat_day_update`,`svcat_sort`,`svcat_visible`) VALUES 
 (1,'Photo coppy','Photo coppy',NULL,NULL,NULL,'2010-08-29 22:10:15',1,1),
 (2,'Quáº£ng cÃ¡o','Advertising',NULL,NULL,NULL,'2010-09-05 09:40:11',2,1),
 (3,'Trang trÃ­ ná»™i tháº¥t - XÃ¢y dá»±ng','Interior design - Construction',NULL,NULL,NULL,NULL,3,1);
/*!40000 ALTER TABLE `services_categories` ENABLE KEYS */;


--
-- Definition of table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL auto_increment,
  `default_lang` varchar(32) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_settings`
--

/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` (`id`,`default_lang`) VALUES 
 (1,'vietnam'),
 (2,'english');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;


--
-- Definition of table `submenu`
--

DROP TABLE IF EXISTS `submenu`;
CREATE TABLE `submenu` (
  `id_submenu` int(10) unsigned NOT NULL auto_increment,
  `id_menu` int(11) unsigned NOT NULL,
  `submenu_name` varchar(50) default NULL,
  `submenu_name_EN` varchar(50) default NULL,
  `url` varchar(60) default NULL,
  `outlink` varchar(60) default NULL,
  `notes` varchar(100) default NULL,
  `notes_EN` varchar(100) default NULL,
  `target` varchar(10) default NULL,
  `position` varchar(20) default NULL,
  `visible` tinyint(3) unsigned default '1',
  `sort` int(10) unsigned default NULL,
  PRIMARY KEY  (`id_submenu`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `submenu`
--

/*!40000 ALTER TABLE `submenu` DISABLE KEYS */;
INSERT INTO `submenu` (`id_submenu`,`id_menu`,`submenu_name`,`submenu_name_EN`,`url`,`outlink`,`notes`,`notes_EN`,`target`,`position`,`visible`,`sort`) VALUES 
 (1,8,'Danh má»¥c sáº£n pháº©m cáº¥p 1','Categories product level1','index.php?mod=list_procat',NULL,NULL,NULL,'_self','admin',1,2),
 (2,8,'Danh má»¥c sáº£n pháº©m cáº¥p 2','Sub Categories product level2','index.php?mod=list_prosubcat1',NULL,NULL,NULL,'_self','admin',1,3),
 (3,8,'Danh má»¥c sáº£n pháº©m cáº¥p 3','Sub Categories product level3','index.php?mod=list_prosubcat2',NULL,NULL,NULL,'_self','admin',1,4),
 (4,8,'Danh má»¥c sáº£n pháº©m cáº¥p 4','Sub Categories product level4','index.php?mod=list_prosubcat3',NULL,NULL,NULL,'_self','admin',1,5),
 (32,6,'Tá»· giÃ¡ ngoáº¡i tá»‡','Exchange rate','index.php?mod=list_rates',NULL,'tá»· giÃ¡ tiá»n tá»‡ cá»§a sáº£n pháº©m',NULL,'_self','admin',1,32),
 (6,3,'Sáº£n pháº©m','Product','index.php?mod=list_products',NULL,'Sáº£n pháº©m cá»§a thÃ nh viÃªn','Product of member','_self','admin',1,13),
 (7,8,'Thá»±c Ä‘Æ¡n cáº¥p 1','Menu level 1','index.php?mod=list_menu',NULL,NULL,NULL,'_self','admin',1,7),
 (8,8,'Thá»±c Ä‘Æ¡n cáº¥p 2','Menu level 2','index.php?mod=list_submenu',NULL,NULL,NULL,'_self','admin',1,8),
 (9,3,'ThÃ nh viÃªn','Member','index.php?mod=list_member',NULL,'ThÃ´ng tin thÃ nh viÃªn','Member Information','_self','admin',1,9),
 (10,3,'LiÃªn há»‡ cÃ´ng ty','Contact to company','index.php?mod=list_customer_contact',NULL,'ThÃ nh viÃªn liÃªn há»‡ cÃ´ng ty',NULL,'_self','admin',0,10),
 (37,4,'LiÃªn há»‡','Contact','index.php?mod=list_customer_contact',NULL,NULL,NULL,'_self','admin',1,37),
 (38,3,'Há»“ sÆ¡ cÃ¡ nhÃ¢n','Member profile','index.php?mod=list_member_profile',NULL,NULL,NULL,'_self','admin',1,38),
 (12,1,'CÃ´ng ty','About Company','index.php?mod=list_intro',NULL,'Giá»›i thiá»‡u vá» cÃ´ng ty','Introduce about company','_self','admin',1,1),
 (26,4,'Chuyá»‡n doanh nhÃ¢n','Business history','index.php?mod=list_business_history',NULL,'CÃ¢u chuyá»‡n hay vá» doanh nhÃ¢n','Stories about business','_self','admin',1,26),
 (13,3,'Doanh nghiá»‡p','Business','index.php?mod=list_company',NULL,'ThÃ´ng tin vá» cÃ´ng ty thÃ nh viÃªn','Information about company of member','_self','admin',1,12),
 (14,3,'Dá»‹ch vá»¥','Services','index.php?mod=list_services',NULL,'Dá»‹ch vá»¥ cá»§a thÃ nh viÃªn','Services of member','_self','admin',1,14),
 (15,4,'Äáº¥u giÃ¡','Auction','index.php?mod=list_auction',NULL,'Lá»‹ch Ä‘áº¥u giÃ¡',NULL,'_self','admin',0,15),
 (16,4,'Quáº£ng cÃ¡o','Advertise','index.php?mod=list_advertise',NULL,NULL,NULL,'_self','admin',1,16),
 (17,4,'Há»i - ÄÃ¡p','Question - Answer','index.php?mod=list_question',NULL,'Nhá»¯ng tháº¯c máº¯c cá»§a khÃ¡ch hÃ ng',NULL,'_self','admin',1,17),
 (18,4,'Há»— trá»£ trá»±c tuyáº¿n','Support online','index.php?mod=list_supportonline',NULL,NULL,NULL,'_self','admin',1,18),
 (19,5,'Tin tá»©c ','News','index.php?mod=list_news',NULL,NULL,NULL,'_self','admin',1,19),
 (20,6,'video','video','index.php?mod=list_video',NULL,'video cá»§a thÃ nh viÃªn hoáº·c cÃ´ng ty','video of member or company','_self','admin',0,20),
 (21,6,'PhÆ°Æ¡ng thá»©c thanh toÃ¡n','Payment methods','index.php?mod=list_payment_methods',NULL,NULL,NULL,'_self','admin',1,21),
 (22,4,'Trá»£ giÃºp','Help','index.php?mod=list_help',NULL,'Nhá»¯ng thÃ´ng tin cáº§n thiáº¿t cho thÃ nh viÃªn tham gia',NULL,'_self','admin',1,22),
 (23,7,'QuÃª quÃ¡n','Country','index.php?mod=list_country',NULL,NULL,NULL,'_self','admin',1,23),
 (24,7,'CÃ´ng nghiá»‡p ','Industry','index.php?mod=list_industry',NULL,'CÃ¡c ngÃ nh cÃ´ng nghiá»‡p',NULL,'_self','admin',1,24),
 (25,7,'Footer','Footer','index.php?mod=list_footer',NULL,'ThÃ´ng tin footer cá»§a website','Information in website','_self','admin',1,25),
 (27,4,'Bá»™ pháº­n liÃªn há»‡','Contact department','index.php?mod=list_contact_department',NULL,NULL,NULL,'_self','admin',1,27),
 (28,6,'Loáº¡i hÃ¬nh kinh doanh','Business form type','index.php?mod=list_business_form',NULL,NULL,NULL,'_self','admin',1,28),
 (29,6,'Vá»‘n - Doanh thu','Capital - Revenue','index.php?mod=list_capital_revenue',NULL,'Dá»¯ liá»‡u cho cÃ´ng ty','Information for company','_self','admin',1,29),
 (30,6,'Tá»‰ lá»‡ xuáº¥t - nháº­p','Rate: import - export','index.php?mod=list_import_export',NULL,'Tá»‰ lá»‡ xuáº¥t - nháº­p cá»§a cÃ´ng ty','Rate: import - export of company','_self','admin',1,30),
 (31,7,'Thá»‹ trÆ°á»ng chÃ­nh','Main markets','index.php?mod=list_main_markets',NULL,'Thá»‹ trÆ°á»ng chÃ­nh cá»§a cÃ´ng ty','Main markets of companies','_self','admin',1,31),
 (33,8,'Danh má»¥c dá»‹ch vá»¥','Categories services','index.php?mod=list_services_categories',NULL,NULL,NULL,'_self','admin',1,33),
 (34,3,'Chá»©c vá»¥','Position','index.php?mod=list_position',NULL,NULL,NULL,'_self','admin',1,34),
 (35,3,'ThÃ´ng tin liÃªn há»‡','Contact Information','index.php?mod=list_contact_information',NULL,NULL,NULL,'_self','admin',1,35),
 (36,3,'Há»™p thÆ°','Inbox','index.php?mod=list_inbox',NULL,NULL,NULL,'_self','admin',1,36);
/*!40000 ALTER TABLE `submenu` ENABLE KEYS */;


--
-- Definition of table `supportonline`
--

DROP TABLE IF EXISTS `supportonline`;
CREATE TABLE `supportonline` (
  `id_supportonline` int(10) unsigned NOT NULL auto_increment,
  `id_member` int(10) unsigned default NULL,
  `id_contact_department` int(10) unsigned default NULL,
  `humanname_help` varchar(60) default NULL,
  `humansex_help` varchar(10) default NULL,
  `tel` varchar(20) default NULL,
  `nickname` varchar(30) default NULL,
  `status` varchar(30) default NULL,
  `sort` int(10) unsigned default NULL,
  `visible` tinyint(3) unsigned default '1',
  PRIMARY KEY  (`id_supportonline`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supportonline`
--

/*!40000 ALTER TABLE `supportonline` DISABLE KEYS */;
INSERT INTO `supportonline` (`id_supportonline`,`id_member`,`id_contact_department`,`humanname_help`,`humansex_help`,`tel`,`nickname`,`status`,`sort`,`visible`) VALUES 
 (1,1,2,'HSPQ','Mr','01675584174','12110515','I Love U',1,1),
 (3,3,1,'pE\' Trang','Miss','09876543210','moicuoixinhxan_hihihi','Member of CN07B',3,1),
 (4,NULL,1,'le duc tho','Mr','01675584174','hspq07@gmail.com','status ho tro',4,1),
 (5,NULL,1,'le duc tho','Mr','01675584174','hspq07@gmail.com','status ho tro',5,1),
 (6,NULL,NULL,'le duc tho','Mr','01675584174','hspq07@gmail.com','status ho tro',6,1),
 (15,4,2,'alo test','Mr','01675584174','hspq07@gmail.com','status ho tro',7,1),
 (10,NULL,1,'Ã”ng Support','Mr','01675584174','123456@yahoo.com','status cua Ã´ng há»— trá»£ trÆ',NULL,1);
/*!40000 ALTER TABLE `supportonline` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
