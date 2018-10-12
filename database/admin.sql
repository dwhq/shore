-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: store
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'首页','fa-bar-chart-o','/',NULL,'2018-09-25 12:30:17'),(2,0,6,'系统管理','fa-tasks',NULL,NULL,'2018-10-12 11:01:58'),(3,2,7,'管理员','fa-users','auth/users',NULL,'2018-10-12 11:01:58'),(4,2,8,'角色','fa-user','auth/roles',NULL,'2018-10-12 11:01:58'),(5,2,9,'权限','fa-ban','auth/permissions',NULL,'2018-10-12 11:01:58'),(6,2,10,'菜单','fa-bars','auth/menu',NULL,'2018-10-12 11:01:58'),(7,2,11,'操作日志','fa-history','auth/logs',NULL,'2018-10-12 11:01:58'),(8,0,2,'用户管理','fa-user','/users','2018-09-25 12:47:58','2018-09-25 15:15:18'),(9,0,3,'商品管理','fa-cubes','/products','2018-09-25 15:14:04','2018-09-25 15:15:18'),(10,0,4,'订单管理','fa-rmb','/orders','2018-10-09 17:11:07','2018-10-09 17:12:36'),(11,0,5,'优惠券管理','fa-tags','/coupon_codes','2018-10-12 11:01:47','2018-10-12 11:01:58');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL),(6,'用户管理','users','','/users*','2018-09-25 13:34:35','2018-09-25 13:34:35'),(7,'商品管理','products','','/products*','2018-10-12 16:40:42','2018-10-12 16:40:42'),(8,'订单管理','orders','','/orders*','2018-10-12 16:41:18','2018-10-12 16:41:18'),(9,'优惠券管理','coupon_codes','','/coupon_codes*','2018-10-12 16:41:53','2018-10-12 16:41:53');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL),(2,3,NULL,NULL),(2,4,NULL,NULL),(2,6,NULL,NULL),(3,2,NULL,NULL),(3,3,NULL,NULL),(3,4,NULL,NULL),(3,6,NULL,NULL),(3,7,NULL,NULL),(3,8,NULL,NULL),(3,9,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL),(3,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2018-09-25 11:46:39','2018-09-25 11:46:39'),(2,'财务','caiwu','2018-09-25 13:36:38','2018-09-25 13:36:38'),(3,'运营','operator','2018-10-12 16:43:06','2018-10-12 16:43:06');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$GF5zV3W2mfpVkDKcN.XaNOHvdVix233IqOQqwbmS4FCaQ1UBqHaeW','Administrator',NULL,'AyqB4epAb9yzmON7HEDWeJVxc42cYmg6o73AWLGgNeBIt8mrm0aEG3UpCatp','2018-09-25 11:46:39','2018-09-25 11:46:39'),(2,'caiwu','$2y$10$9zLhVO9tGLATHmXVk874g.w.yvoDbd58pwRJ1nfvqdm0gtycWJy2O','财务','images/88178.jpg','AsliQpmUPjiLM7DQv2b9jZ9wzsQUhfKNR03DY0ZlICMcIosi9XOC9ttRvHQY','2018-09-25 13:37:53','2018-10-12 16:46:35');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-12  8:59:01
