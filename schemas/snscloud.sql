CREATE DATABASE  IF NOT EXISTS `snscloud` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `snscloud`;
-- MySQL dump 10.13  Distrib 5.6.17, for osx10.6 (i386)
--
-- Host: 192.168.0.211    Database: snscloud
-- ------------------------------------------------------
-- Server version	5.1.73

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
-- Table structure for table `sns_ discussion_topic`
--

DROP TABLE IF EXISTS `sns_ discussion_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_ discussion_topic` (
  `topicid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '话题id',
  `userid` int(11) unsigned NOT NULL COMMENT '发布者id',
  `title` varchar(100) NOT NULL COMMENT '话题标题',
  `description` varchar(255) DEFAULT NULL COMMENT '话题描述',
  `attachment` varchar(100) DEFAULT NULL COMMENT '附件名',
  `size` int(11) DEFAULT NULL COMMENT '附件大小',
  `type` varchar(15) DEFAULT NULL COMMENT '附件类型',
  `localpath` varchar(255) DEFAULT NULL COMMENT '附件本地路径',
  `url` varchar(255) DEFAULT NULL COMMENT '附件访问路径',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态（0显示，1禁止）',
  `created` varchar(13) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`topicid`),
  KEY `fk_sns_ discussion_topic_sns_member1_idx` (`userid`),
  CONSTRAINT `fk_sns_ discussion_topic_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_ discussion_topic`
--

LOCK TABLES `sns_ discussion_topic` WRITE;
/*!40000 ALTER TABLE `sns_ discussion_topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_ discussion_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_ filename_extension`
--

DROP TABLE IF EXISTS `sns_ filename_extension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_ filename_extension` (
  `extid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '扩展名id',
  `name` varchar(45) NOT NULL COMMENT '扩展名称',
  `category` varchar(45) DEFAULT NULL COMMENT '扩展名归属类',
  PRIMARY KEY (`extid`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='文件扩展名表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_ filename_extension`
--

LOCK TABLES `sns_ filename_extension` WRITE;
/*!40000 ALTER TABLE `sns_ filename_extension` DISABLE KEYS */;
INSERT INTO `sns_ filename_extension` VALUES (1,'vob','video'),(2,'ifo','video'),(3,'mpg','video'),(4,'mpeg','video'),(5,'dat','video'),(6,'mp4','video'),(7,'3gp','video'),(8,'mov','video'),(9,'rm','video'),(10,'ram','video'),(11,'rmvb','video'),(12,'wmv','video'),(13,'wav','music'),(14,'wma','music'),(15,'ra','music'),(16,'ogg','music'),(17,'mpc','music'),(18,'m4a','music'),(19,'aac','music'),(20,'mpa','music'),(21,'mp2','music'),(22,'m1a','music'),(23,'m2a','music'),(24,'mp3','music'),(25,'mid','music'),(26,'midi','music'),(27,'rmi','music'),(28,'mka','music'),(29,'ac3','music'),(30,'asf','video'),(31,'avi','video'),(32,'asx','video');
/*!40000 ALTER TABLE `sns_ filename_extension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_ role_operation_func`
--

DROP TABLE IF EXISTS `sns_ role_operation_func`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_ role_operation_func` (
  `rofid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色',
  `roleid` int(11) unsigned NOT NULL COMMENT '角色id',
  `ofid` int(11) unsigned NOT NULL COMMENT '操作',
  PRIMARY KEY (`rofid`),
  KEY `fk_sns_ role_operation_func_sns_role1_idx` (`roleid`),
  KEY `fk_sns_ role_operation_func_sns_operation_func1_idx` (`ofid`),
  CONSTRAINT `fk_sns_ role_operation_func_sns_role1` FOREIGN KEY (`roleid`) REFERENCES `sns_role` (`roleid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_ role_operation_func_sns_operation_func1` FOREIGN KEY (`ofid`) REFERENCES `sns_operation_func` (`ofid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COMMENT='角色-�';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_ role_operation_func`
--

LOCK TABLES `sns_ role_operation_func` WRITE;
/*!40000 ALTER TABLE `sns_ role_operation_func` DISABLE KEYS */;
INSERT INTO `sns_ role_operation_func` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,1,7),(8,1,8),(9,1,9),(10,1,10),(11,1,11),(12,1,12),(13,1,13),(14,1,14),(15,1,15),(16,1,16),(17,1,17),(18,1,18),(19,1,19),(20,1,20),(21,1,21),(22,1,22),(23,1,23),(24,1,24),(25,1,25),(26,1,26),(27,1,27),(28,1,28),(29,1,29),(30,1,30),(31,1,31),(32,1,32),(33,1,33),(34,1,34),(35,1,35),(36,1,36),(37,1,37),(38,1,38),(39,1,39),(40,1,40),(41,2,1),(42,2,2),(43,2,3),(44,2,4),(45,2,5),(46,2,6),(47,2,7),(48,2,8),(49,2,9),(50,2,10),(51,2,11),(52,2,12),(53,2,13),(54,2,14),(55,2,15),(56,2,16),(57,2,17),(58,2,18),(59,2,19),(60,2,20);
/*!40000 ALTER TABLE `sns_ role_operation_func` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_article_category`
--

DROP TABLE IF EXISTS `sns_article_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_article_category` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` varchar(45) NOT NULL COMMENT '分类名称',
  `parentids` varchar(255) DEFAULT NULL COMMENT '上级分类id',
  `childids` varchar(45) DEFAULT NULL COMMENT '下级分类id',
  `created` varchar(13) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_article_category`
--

LOCK TABLES `sns_article_category` WRITE;
/*!40000 ALTER TABLE `sns_article_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_article_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_circle`
--

DROP TABLE IF EXISTS `sns_circle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_circle` (
  `circleid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '圈子id',
  `groupid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL COMMENT '圈子名称',
  `userid` int(11) unsigned NOT NULL COMMENT '圈主用户id',
  `parentids` varchar(255) DEFAULT NULL COMMENT '上级圈子id',
  `childids` varchar(255) DEFAULT NULL COMMENT '下级圈子id',
  `logo` varchar(255) DEFAULT NULL COMMENT '圈子logo',
  `istopic` tinyint(1) unsigned DEFAULT '0' COMMENT '发布话题（0运行，1禁止）',
  `iscomment` tinyint(1) unsigned DEFAULT '0' COMMENT '回复话题（0允许，1禁止）',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态（0待审，1通过，2禁用）',
  `created` varchar(13) NOT NULL COMMENT '创建日期',
  PRIMARY KEY (`circleid`),
  KEY `fk_sns_circle_sns_member1_idx` (`userid`),
  CONSTRAINT `fk_sns_circle_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle`
--

LOCK TABLES `sns_circle` WRITE;
/*!40000 ALTER TABLE `sns_circle` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_circle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_circle_cloudfile_manage`
--

DROP TABLE IF EXISTS `sns_circle_cloudfile_manage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_circle_cloudfile_manage` (
  `ccloudid` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT '云盘id',
  `parenturl` varchar(255) DEFAULT NULL COMMENT '上级路径',
  `name` varchar(100) NOT NULL COMMENT '文件名',
  `url` varchar(255) NOT NULL COMMENT 'G盘路径',
  `oldurl` varchar(255) NOT NULL COMMENT '原始路径',
  `fileid` bigint(8) unsigned NOT NULL COMMENT '文件id',
  `userid` int(11) unsigned NOT NULL COMMENT '分享者id',
  `ext` varchar(45) DEFAULT NULL COMMENT '扩展名',
  `type` varchar(45) DEFAULT NULL COMMENT '类型',
  `accesstimes` int(10) unsigned DEFAULT '0' COMMENT '查看次数',
  `isencryption` tinyint(1) unsigned DEFAULT '0' COMMENT '加密（0否，1是）',
  `isreadable` tinyint(1) unsigned DEFAULT '1' COMMENT '可读性（1可读，0不可读）',
  `iswriteable` tinyint(1) unsigned DEFAULT '1' COMMENT '可写性（1可写，0不可写）',
  `size` int(11) DEFAULT NULL COMMENT '文件大小',
  `sizefriendly` varchar(45) DEFAULT NULL COMMENT '文件大小（带单位）',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态（0显示，1隐藏）',
  `lastaccesstime` varchar(13) NOT NULL COMMENT '最后访问时间',
  `modifytime` varchar(13) DEFAULT NULL COMMENT '修改时间',
  `createtime` varchar(13) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`ccloudid`),
  KEY `fk_sns_circle_cloudfile_manage_sns_cmm_localfile_manage1_idx` (`fileid`),
  CONSTRAINT `fk_sns_circle_cloudfile_manage_sns_cmm_localfile_manage1` FOREIGN KEY (`fileid`) REFERENCES `sns_cmm_localfile_manage` (`fileid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle_cloudfile_manage`
--

LOCK TABLES `sns_circle_cloudfile_manage` WRITE;
/*!40000 ALTER TABLE `sns_circle_cloudfile_manage` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_circle_cloudfile_manage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_circle_operation_records`
--

DROP TABLE IF EXISTS `sns_circle_operation_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_circle_operation_records` (
  `corid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '操作id',
  `userid` int(11) unsigned NOT NULL COMMENT '操作用户id',
  `circleid` int(11) unsigned NOT NULL COMMENT '圈子id',
  `name` varchar(100) NOT NULL COMMENT '文件名称',
  `operationid` int(11) unsigned NOT NULL COMMENT '操作id',
  `created` varchar(13) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`corid`),
  KEY `fk_sns_circle_operation_records_sns_member1_idx` (`userid`),
  KEY `fk_sns_circle_operation_records_sns_circle1_idx` (`circleid`),
  CONSTRAINT `fk_sns_circle_operation_records_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_circle_operation_records_sns_circle1` FOREIGN KEY (`circleid`) REFERENCES `sns_circle` (`circleid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle_operation_records`
--

LOCK TABLES `sns_circle_operation_records` WRITE;
/*!40000 ALTER TABLE `sns_circle_operation_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_circle_operation_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_circle_work`
--

DROP TABLE IF EXISTS `sns_circle_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_circle_work` (
  `workid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '作业id',
  `userid` int(11) unsigned NOT NULL COMMENT '发布者id',
  `circleid` int(11) unsigned NOT NULL COMMENT '圈子id',
  `title` varchar(45) NOT NULL COMMENT '作业题目',
  `starttime` varchar(13) NOT NULL COMMENT '开始时间',
  `endtime` varchar(13) NOT NULL COMMENT '结束时间',
  `description` varchar(255) DEFAULT NULL COMMENT '作业描述',
  `created` varchar(13) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`workid`),
  KEY `fk_sns_circle_work_sns_member1_idx` (`userid`),
  KEY `fk_sns_circle_work_sns_circle1_idx` (`circleid`),
  CONSTRAINT `fk_sns_circle_work_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_circle_work_sns_circle1` FOREIGN KEY (`circleid`) REFERENCES `sns_circle` (`circleid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle_work`
--

LOCK TABLES `sns_circle_work` WRITE;
/*!40000 ALTER TABLE `sns_circle_work` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_circle_work` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_circle_work_commit`
--

DROP TABLE IF EXISTS `sns_circle_work_commit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_circle_work_commit` (
  `commitid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '提交id',
  `userid` int(11) unsigned NOT NULL COMMENT '提交者id',
  `workid` bigint(8) unsigned NOT NULL COMMENT '作业id',
  `name` varchar(255) NOT NULL COMMENT '文件名称',
  `size` int(10) unsigned NOT NULL,
  `type` varchar(15) NOT NULL COMMENT '类型',
  `localpath` varchar(255) NOT NULL COMMENT '本地路径',
  `url` varchar(255) DEFAULT NULL COMMENT '访问路径',
  `created` varchar(13) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`commitid`),
  KEY `fk_sns_circle_work_commit_sns_member1_idx` (`userid`),
  KEY `fk_sns_circle_work_commit_sns_circle_work1_idx` (`workid`),
  CONSTRAINT `fk_sns_circle_work_commit_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_circle_work_commit_sns_circle_work1` FOREIGN KEY (`workid`) REFERENCES `sns_circle_work` (`workid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle_work_commit`
--

LOCK TABLES `sns_circle_work_commit` WRITE;
/*!40000 ALTER TABLE `sns_circle_work_commit` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_circle_work_commit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_cmm_localfile_manage`
--

DROP TABLE IF EXISTS `sns_cmm_localfile_manage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_cmm_localfile_manage` (
  `fileid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件id',
  `userid` int(11) unsigned NOT NULL COMMENT '上传者id',
  `name` varchar(255) NOT NULL COMMENT '文件名称',
  `tags` varchar(255) DEFAULT NULL COMMENT '标签',
  `size` int(10) unsigned NOT NULL COMMENT '大小',
  `type` varchar(15) NOT NULL COMMENT '类型',
  `local` varchar(255) NOT NULL COMMENT '原路径（复制用）',
  `url` varchar(255) NOT NULL COMMENT '访问路径',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态（0显示，1隐藏）',
  `modifytime` varchar(13) NOT NULL COMMENT '修改日期',
  `createtime` varchar(13) NOT NULL COMMENT '创建日期',
  PRIMARY KEY (`fileid`),
  KEY `fk_sns_file_manage_sns_member1_idx` (`userid`),
  CONSTRAINT `fk_sns_file_manage_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=466 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_cmm_localfile_manage`
--

LOCK TABLES `sns_cmm_localfile_manage` WRITE;
/*!40000 ALTER TABLE `sns_cmm_localfile_manage` DISABLE KEYS */;
INSERT INTO `sns_cmm_localfile_manage` VALUES (1,1,'我的G盘','我的G盘',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private/','/mnt/hgfs/www/SNSCloud/data/1/private/',0,'1408699280','1408699280'),(2,1,'我收到的分享','我收到的分享',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/public/','/mnt/hgfs/www/SNSCloud/data/1/public/',0,'1408699280','1408699280'),(423,1,'新建文件夹','新建文件夹',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410318944','/mnt/hgfs/www/SNSCloud/data/1/private//1410318944',0,'1410318944','1410318944'),(424,1,'新建文件夹(0)','新建文件夹(0)',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410318945','/mnt/hgfs/www/SNSCloud/data/1/private//1410318945',0,'1410318945','1410318945'),(425,1,'newfile.txt','newfile.txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410318947.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410318947.txt',0,'1410318947','1410318947'),(426,1,'新建文件夹(1)','新建文件夹(1)',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410318948','/mnt/hgfs/www/SNSCloud/data/1/private//1410318948',0,'1410318948','1410318948'),(427,1,'新建文件夹','新建文件夹',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410338038','/mnt/hgfs/www/SNSCloud/data/1/private//1410338038',0,'1410338038','1410338038'),(428,1,'新建文件夹(0)','新建文件夹(0)',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410338045','/mnt/hgfs/www/SNSCloud/data/1/private//1410338045',0,'1410338045','1410338045'),(429,1,'newfile.txt','newfile.txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410338047.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410338047.txt',0,'1410338047','1410338047'),(430,1,'新建文件夹','新建文件夹',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410340068','/mnt/hgfs/www/SNSCloud/data/1/private//1410340068',0,'1410340068','1410340068'),(431,1,'新建文件夹(0)','新建文件夹(0)',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410340072','/mnt/hgfs/www/SNSCloud/data/1/private//1410340072',0,'1410340072','1410340072'),(432,1,'新建文件夹','新建文件夹',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410340081','/mnt/hgfs/www/SNSCloud/data/1/private//1410340081',0,'1410340081','1410340081'),(433,1,'newfile.txt','newfile.txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340083.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340083.txt',0,'1410340083','1410340083'),(434,1,'newfile.txt','newfile.txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340087.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340087.txt',0,'1410340087','1410340087'),(435,1,'newfile(0).txt','newfile(0).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340098.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340098.txt',0,'1410340098','1410340098'),(436,1,'newfile.txt','newfile.txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340102.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340102.txt',0,'1410340102','1410340102'),(437,1,'newfile(0).txt','newfile(0).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340110.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340110.txt',0,'1410340110','1410340110'),(438,1,'newfile.txt','newfile.txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340115.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340115.txt',0,'1410340115','1410340115'),(439,1,'newfile(0).txt','newfile(0).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340117.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340117.txt',0,'1410340117','1410340117'),(440,1,'newfile(1).txt','newfile(1).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340120.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340120.txt',0,'1410340120','1410340120'),(441,1,'newfile.txt','newfile.txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340136.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340136.txt',0,'1410340136','1410340136'),(442,1,'newfile(2).txt','newfile(2).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340148.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340148.txt',0,'1410340148','1410340148'),(443,1,'newfile(1).txt','newfile(1).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340350.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340350.txt',0,'1410340350','1410340350'),(444,1,'newfile(1).txt','newfile(1).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340355.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340355.txt',0,'1410340355','1410340355'),(445,1,'newfile(3).txt','newfile(3).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340362.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340362.txt',0,'1410340362','1410340362'),(446,1,'newfile(1).txt','newfile(1).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340366.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340366.txt',0,'1410340366','1410340366'),(447,1,'newfile(1).txt','newfile(1).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340375.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340375.txt',0,'1410340375','1410340375'),(448,1,'新建文件夹','新建文件夹',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410340444','/mnt/hgfs/www/SNSCloud/data/1/private//1410340444',0,'1410340444','1410340444'),(449,1,'新建文件夹(1)','新建文件夹(1)',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410340450','/mnt/hgfs/www/SNSCloud/data/1/private//1410340450',0,'1410340450','1410340450'),(450,1,'newfile.txt','newfile.txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340453.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340453.txt',0,'1410340453','1410340453'),(451,1,'newfile(0).txt','newfile(0).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340455.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340455.txt',0,'1410340455','1410340455'),(452,1,'newfile(1).txt','newfile(1).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340460.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340460.txt',0,'1410340460','1410340460'),(453,1,'newfile(4).txt','newfile(4).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340464.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340464.txt',0,'1410340464','1410340464'),(454,1,'新建文件夹','新建文件夹',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410340469','/mnt/hgfs/www/SNSCloud/data/1/private//1410340469',0,'1410340469','1410340469'),(455,1,'newfile(1).txt','newfile(1).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340503.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340503.txt',0,'1410340503','1410340503'),(456,1,'newfile(2).txt','newfile(2).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340577.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340577.txt',0,'1410340577','1410340577'),(457,1,'新建文件夹','新建文件夹',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410340589','/mnt/hgfs/www/SNSCloud/data/1/private//1410340589',0,'1410340589','1410340589'),(458,1,'newfile(5).txt','newfile(5).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340593.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340593.txt',0,'1410340593','1410340593'),(459,1,'newfile(3).txt','newfile(3).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340596.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340596.txt',0,'1410340596','1410340596'),(460,1,'新建文件夹(2)','新建文件夹(2)',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410340605','/mnt/hgfs/www/SNSCloud/data/1/private//1410340605',0,'1410340605','1410340605'),(461,1,'newfile.txt','newfile.txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340607.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340607.txt',0,'1410340607','1410340607'),(462,1,'newfile(6).txt','newfile(6).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340612.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340612.txt',0,'1410340612','1410340612'),(463,1,'新建文件夹(3)','新建文件夹(3)',0,'folder','/mnt/hgfs/www/SNSCloud/data/1/private//1410340615','/mnt/hgfs/www/SNSCloud/data/1/private//1410340615',0,'1410340615','1410340615'),(464,1,'newfile(7).txt','newfile(7).txt',0,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410340620.txt','/mnt/hgfs/www/SNSCloud/data/1/private/1410340620.txt',0,'1410340620','1410340620'),(465,1,'美家SSL VPN用户指南.doc','美家SSL VPN用户指南.doc',532992,'file','/mnt/hgfs/www/SNSCloud/data/1/private/1410425222.doc','/mnt/hgfs/www/SNSCloud/data/1/private/1410425222.doc',0,'1410425222','1410425222');
/*!40000 ALTER TABLE `sns_cmm_localfile_manage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_cmm_logs`
--

DROP TABLE IF EXISTS `sns_cmm_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_cmm_logs` (
  `logid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志',
  `userid` int(11) DEFAULT NULL COMMENT '用户id',
  `operationid` int(11) DEFAULT NULL COMMENT '操作id',
  `description` varchar(255) DEFAULT NULL COMMENT '日志描述',
  `gcloudid` varchar(45) DEFAULT NULL COMMENT '文件id',
  `ipaddress` varchar(13) NOT NULL COMMENT '创建时间',
  `sql` varchar(255) DEFAULT NULL COMMENT 'sql语句',
  `createtime` varchar(13) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB AUTO_INCREMENT=440 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_cmm_logs`
--

LOCK TABLES `sns_cmm_logs` WRITE;
/*!40000 ALTER TABLE `sns_cmm_logs` DISABLE KEYS */;
INSERT INTO `sns_cmm_logs` VALUES (394,1,NULL,'新建文件夹新建文件夹','392','192.168.0.210',NULL,'1410318944'),(395,1,NULL,'新建文件夹新建文件夹(0)','393','192.168.0.210',NULL,'1410318945'),(396,1,NULL,'新建文件newfile.txt','394','192.168.0.210',NULL,'1410318947'),(397,1,NULL,'新建文件夹新建文件夹(1)','395','192.168.0.210',NULL,'1410318948'),(398,1,NULL,'修改文件名新建文件夹为TEST','392','192.168.0.210',NULL,'1410318954'),(399,1,NULL,'修改文件名新建文件夹(0)为TEST1','393','192.168.0.210',NULL,'1410318959'),(400,1,NULL,'修改文件名新建文件夹(1)为TEST2','395','192.168.0.210',NULL,'1410318962'),(401,1,NULL,'新建文件夹新建文件夹','396','192.168.0.210',NULL,'1410338038'),(402,1,NULL,'新建文件夹新建文件夹(0)','397','192.168.0.210',NULL,'1410338045'),(403,1,NULL,'新建文件newfile.txt','398','192.168.0.210',NULL,'1410338047'),(404,1,NULL,'新建文件夹新建文件夹','399','192.168.0.210',NULL,'1410340068'),(405,1,NULL,'新建文件夹新建文件夹(0)','400','192.168.0.210',NULL,'1410340072'),(406,1,NULL,'新建文件夹新建文件夹','401','192.168.0.210',NULL,'1410340081'),(407,1,NULL,'新建文件newfile.txt','402','192.168.0.210',NULL,'1410340083'),(408,1,NULL,'新建文件newfile.txt',NULL,'192.168.0.210',NULL,'1410340087'),(409,1,NULL,'新建文件newfile(0).txt','403','192.168.0.210',NULL,'1410340098'),(410,1,NULL,'新建文件newfile.txt','404','192.168.0.210',NULL,'1410340102'),(411,1,NULL,'新建文件newfile(0).txt','405','192.168.0.210',NULL,'1410340110'),(412,1,NULL,'新建文件newfile.txt','406','192.168.0.210',NULL,'1410340115'),(413,1,NULL,'新建文件newfile(0).txt','407','192.168.0.210',NULL,'1410340117'),(414,1,NULL,'新建文件newfile(1).txt','408','192.168.0.210',NULL,'1410340120'),(415,1,NULL,'新建文件newfile.txt','409','192.168.0.210',NULL,'1410340136'),(416,1,NULL,'新建文件newfile(2).txt','410','192.168.0.210',NULL,'1410340148'),(417,1,NULL,'新建文件newfile(1).txt',NULL,'192.168.0.210',NULL,'1410340350'),(418,1,NULL,'新建文件newfile(1).txt',NULL,'192.168.0.210',NULL,'1410340355'),(419,1,NULL,'新建文件newfile(3).txt','411','192.168.0.210',NULL,'1410340362'),(420,1,NULL,'新建文件newfile(1).txt',NULL,'192.168.0.210',NULL,'1410340366'),(421,1,NULL,'新建文件newfile(1).txt',NULL,'192.168.0.210',NULL,'1410340375'),(422,1,NULL,'新建文件夹新建文件夹','412','192.168.0.210',NULL,'1410340444'),(423,1,NULL,'新建文件夹新建文件夹(1)','413','192.168.0.210',NULL,'1410340450'),(424,1,NULL,'新建文件newfile.txt','414','192.168.0.210',NULL,'1410340453'),(425,1,NULL,'新建文件newfile(0).txt','415','192.168.0.210',NULL,'1410340455'),(426,1,NULL,'新建文件newfile(1).txt','416','192.168.0.210',NULL,'1410340460'),(427,1,NULL,'新建文件newfile(4).txt','417','192.168.0.210',NULL,'1410340464'),(428,1,NULL,'新建文件夹新建文件夹','418','192.168.0.210',NULL,'1410340469'),(429,1,NULL,'新建文件newfile(1).txt',NULL,'192.168.0.210',NULL,'1410340503'),(430,1,NULL,'新建文件newfile(2).txt','419','192.168.0.210',NULL,'1410340577'),(431,1,NULL,'新建文件夹新建文件夹','420','192.168.0.210',NULL,'1410340589'),(432,1,NULL,'新建文件newfile(5).txt','421','192.168.0.210',NULL,'1410340593'),(433,1,NULL,'新建文件newfile(3).txt','422','192.168.0.210',NULL,'1410340596'),(434,1,NULL,'新建文件夹新建文件夹(2)','423','192.168.0.210',NULL,'1410340605'),(435,1,NULL,'新建文件newfile.txt','424','192.168.0.210',NULL,'1410340607'),(436,1,NULL,'新建文件newfile(6).txt','425','192.168.0.210',NULL,'1410340612'),(437,1,NULL,'新建文件夹新建文件夹(3)','426','192.168.0.210',NULL,'1410340615'),(438,1,NULL,'新建文件newfile(7).txt','427','192.168.0.210',NULL,'1410340620'),(439,1,NULL,'上传文件美家SSL VPN用户指南.doc','428','192.168.0.210',NULL,'1410425222');
/*!40000 ALTER TABLE `sns_cmm_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_cmm_share`
--

DROP TABLE IF EXISTS `sns_cmm_share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_cmm_share` (
  `shareid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '分享id',
  `gcloudid` bigint(8) unsigned NOT NULL COMMENT 'G盘云文件id',
  `ccloudid` bigint(19) unsigned NOT NULL COMMENT '圈子云文件id',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `useredid` int(11) DEFAULT NULL COMMENT '被分享者id',
  `fileurl` varchar(255) NOT NULL COMMENT '文件路径',
  `sharelink` varchar(255) DEFAULT NULL COMMENT '分享链接',
  `isencryption` tinyint(1) unsigned DEFAULT '0' COMMENT '是否加密（0否，1是）',
  `password` varchar(45) DEFAULT NULL COMMENT '加密密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态（0分享，1关闭）',
  `createtime` varchar(13) NOT NULL COMMENT '分享时间',
  PRIMARY KEY (`shareid`),
  KEY `fk_sns_cmm_share_sns_circle_cloudfile_manage1_idx` (`ccloudid`),
  KEY `fk_sns_cmm_share_sns_g_cloudfile_manage1_idx` (`gcloudid`),
  CONSTRAINT `fk_sns_cmm_share_sns_circle_cloudfile_manage1` FOREIGN KEY (`ccloudid`) REFERENCES `sns_circle_cloudfile_manage` (`ccloudid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_cmm_share_sns_g_cloudfile_manage1` FOREIGN KEY (`gcloudid`) REFERENCES `sns_g_cloudfile_manage` (`gcloudid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_cmm_share`
--

LOCK TABLES `sns_cmm_share` WRITE;
/*!40000 ALTER TABLE `sns_cmm_share` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_cmm_share` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_discussion_comment`
--

DROP TABLE IF EXISTS `sns_discussion_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_discussion_comment` (
  `commentid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '回复id',
  `topicid` bigint(8) unsigned NOT NULL COMMENT '话题id',
  `userid` int(11) unsigned NOT NULL COMMENT '回复者id',
  `content` varchar(255) NOT NULL COMMENT '回复内容',
  `attachment` varchar(100) DEFAULT NULL COMMENT '附件名',
  `size` int(10) unsigned DEFAULT NULL COMMENT '附件大小',
  `type` varchar(15) DEFAULT NULL COMMENT '附件类型',
  `localpath` varchar(255) DEFAULT NULL COMMENT '本地路径',
  `url` varchar(255) DEFAULT NULL COMMENT '访问路径',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态（0发布，1禁止）',
  `created` varchar(13) NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`commentid`),
  KEY `fk_sns_discussion_comment_sns_member1_idx` (`userid`),
  KEY `fk_sns_discussion_comment_sns_ discussion_topic1_idx` (`topicid`),
  CONSTRAINT `fk_sns_discussion_comment_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_discussion_comment_sns_ discussion_topic1` FOREIGN KEY (`topicid`) REFERENCES `sns_ discussion_topic` (`topicid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_discussion_comment`
--

LOCK TABLES `sns_discussion_comment` WRITE;
/*!40000 ALTER TABLE `sns_discussion_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_discussion_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_function`
--

DROP TABLE IF EXISTS `sns_function`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_function` (
  `functionid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '功能id',
  `name` varchar(45) NOT NULL COMMENT '功能名称',
  `moduleid` int(11) unsigned NOT NULL COMMENT '模块id',
  PRIMARY KEY (`functionid`),
  KEY `fk_sns_function_sns_module1_idx` (`moduleid`),
  CONSTRAINT `fk_sns_function_sns_module1` FOREIGN KEY (`moduleid`) REFERENCES `sns_module` (`moduleid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_function`
--

LOCK TABLES `sns_function` WRITE;
/*!40000 ALTER TABLE `sns_function` DISABLE KEYS */;
INSERT INTO `sns_function` VALUES (1,'打开文件夹',1),(2,'复制文件夹',1),(3,'剪切文件夹',1),(4,'删除文件夹',1),(5,'重命名文件夹',1),(6,'移动文件夹',1),(7,'文件夹加密',1),(8,'共享文件夹',1),(9,'文件夹属性',1),(10,'打开文件',1),(11,'编辑文件',1),(12,'复制文件',1),(13,'剪切文件',1),(14,'移动文件',1),(15,'删除文件',1),(16,'重命名文件',1),(17,'文件加密',1),(18,'下载文件',1),(19,'分享文件',1),(20,'文件属性',1),(21,'打开文件夹',2),(22,'复制文件夹',2),(23,'剪切文件夹',2),(24,'删除文件夹',2),(25,'重命名文件夹',2),(26,'移动文件夹',2),(27,'文件夹加密',2),(28,'共享文件夹',2),(29,'文件夹属性',2),(30,'打开文件',2),(31,'编辑文件',2),(32,'复制文件',2),(33,'剪切文件',2),(34,'移动文件',2),(35,'删除文件',2),(36,'重命名文件',2),(37,'文件加密',2),(38,'下载文件',2),(39,'分享文件',2),(40,'文件属性',2);
/*!40000 ALTER TABLE `sns_function` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_g_cloudfile_manage`
--

DROP TABLE IF EXISTS `sns_g_cloudfile_manage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_g_cloudfile_manage` (
  `gcloudid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '云文件id',
  `parenturl` varchar(255) DEFAULT NULL COMMENT '上级路径',
  `name` varchar(100) NOT NULL COMMENT '文件名',
  `url` varchar(255) NOT NULL COMMENT '访问路径',
  `oldurl` varchar(255) NOT NULL COMMENT '原始路径',
  `fileid` bigint(8) unsigned NOT NULL COMMENT '文件id',
  `userid` int(11) unsigned NOT NULL COMMENT '修改者id',
  `ext` varchar(45) DEFAULT NULL COMMENT '扩展名',
  `type` varchar(45) DEFAULT NULL COMMENT '类型',
  `accesstimes` int(10) unsigned DEFAULT '0' COMMENT '查看次数',
  `isencryption` tinyint(1) unsigned DEFAULT '0' COMMENT '加密（0否，1是）',
  `isreadable` tinyint(1) unsigned DEFAULT '1' COMMENT '可读性（1可读，0不可读）',
  `iswriteable` tinyint(1) unsigned DEFAULT '1' COMMENT '可写性（1可写，0不可写）',
  `size` int(11) DEFAULT NULL COMMENT '文件大小',
  `sizefriendly` varchar(45) DEFAULT NULL COMMENT '文件大小（带单位）',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态（0显示，1隐藏）',
  `lastaccesstime` varchar(13) NOT NULL COMMENT '最后访问时间',
  `modifytime` varchar(13) DEFAULT NULL COMMENT '修改时间',
  `createtime` varchar(13) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`gcloudid`),
  KEY `fk_sns_cmm_cloudfile_manage_sns_cmm_localfile_manage1_idx` (`fileid`),
  KEY `fk_sns_cmm_cloudfile_manage_sns_member1_idx` (`userid`),
  CONSTRAINT `fk_sns_cmm_cloudfile_manage_sns_cmm_localfile_manage1` FOREIGN KEY (`fileid`) REFERENCES `sns_cmm_localfile_manage` (`fileid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_cmm_cloudfile_manage_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=429 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_g_cloudfile_manage`
--

LOCK TABLES `sns_g_cloudfile_manage` WRITE;
/*!40000 ALTER TABLE `sns_g_cloudfile_manage` DISABLE KEYS */;
INSERT INTO `sns_g_cloudfile_manage` VALUES (1,'','我的G盘','/mnt/hgfs/www/SNSCloud/data/1/private/','/mnt/hgfs/www/SNSCloud/data/1/private/',1,1,'','folder',1,0,1,1,1109504,'0 B',0,'1408699274','1410425222','1408699274'),(2,'','我收到的分享','/mnt/hgfs/www/SNSCloud/data/1/public/','/mnt/hgfs/www/SNSCloud/data/1/public/',2,1,'','folder',1,0,1,1,0,'0 B',0,'1408699274','1408699274','1408699274'),(392,'/mnt/hgfs/www/SNSCloud/data/1/private/','TEST','/mnt/hgfs/www/SNSCloud/data/1/private/TEST/','/mnt/hgfs/www/SNSCloud/data/1/private/新建文件夹/',423,1,'','folder',1,0,1,1,0,'0 B',0,'1410318944','1410318954','1410318944'),(393,'/mnt/hgfs/www/SNSCloud/data/1/private/','TEST1','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','/mnt/hgfs/www/SNSCloud/data/1/private/新建文件夹(0)/',424,1,'','folder',1,0,1,1,0,'0 B',0,'1410318945','1410318959','1410318945'),(394,'/mnt/hgfs/www/SNSCloud/data/1/private/','newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/newfile.txt',425,1,'txt','file',1,0,1,1,0,'0 B',0,'1410318947','1410318947','1410318947'),(395,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','TEST2','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/TEST2/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/',426,1,'','folder',1,0,1,1,0,'0 B',0,'1410318948','1410424664','1410318948'),(396,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST/','新建文件夹','/mnt/hgfs/www/SNSCloud/data/1/private/TEST/新建文件夹/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST/新建文件夹/',427,1,'','folder',1,0,1,1,0,'0 B',0,'1410338038','1410338038','1410338038'),(397,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST/','新建文件夹(0)','/mnt/hgfs/www/SNSCloud/data/1/private/TEST/新建文件夹(0)/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST/新建文件夹(0)/',428,1,'','folder',1,0,1,1,0,'0 B',0,'1410338045','1410338045','1410338045'),(398,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST/','newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST/newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST/newfile.txt',429,1,'txt','file',1,0,1,1,0,'0 B',0,'1410338047','1410338047','1410338047'),(399,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','新建文件夹','/mnt/hgfs/www/SNSCloud/data/1/private/新建文件夹/','/mnt/hgfs/www/SNSCloud/data/1/private/新建文件夹/',430,1,'','folder',1,0,1,1,0,'0 B',0,'1410340068','1410340068','1410340068'),(400,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','新建文件夹(0)','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/',431,1,'','folder',1,0,1,1,0,'0 B',0,'1410340072','1410340072','1410340072'),(401,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/TEST2/','新建文件夹','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/TEST2/新建文件夹/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/TEST2/新建文件夹/',432,1,'','folder',1,0,1,1,0,'0 B',0,'1410340081','1410424664','1410340081'),(402,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/TEST2/','newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/TEST2/newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/TEST2/newfile.txt',433,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340083','1410424664','1410340083'),(403,'/mnt/hgfs/www/SNSCloud/data/1/private/','newfile(0).txt','/mnt/hgfs/www/SNSCloud/data/1/private/newfile(0).txt','/mnt/hgfs/www/SNSCloud/data/1/private/newfile(0).txt',435,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340098','1410340098','1410340098'),(404,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile.txt',436,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340102','1410340102','1410340102'),(405,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','newfile(0).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(0).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(0).txt',437,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340110','1410340110','1410340110'),(406,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/','newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/newfile.txt',438,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340115','1410340115','1410340115'),(407,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/','newfile(0).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/newfile(0).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/newfile(0).txt',439,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340117','1410340117','1410340117'),(408,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','newfile(1).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/newfile(1).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/newfile(1).txt',440,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340120','1410340120','1410340120'),(409,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/新建文件夹(0)/','newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/新建文件夹(0)/newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/新建文件夹(0)/newfile.txt',441,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340136','1410340136','1410340136'),(410,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','newfile(2).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/新建文件夹(0)/newfile(2).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/新建文件夹(0)/newfile(2).txt',442,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340148','1410340148','1410340148'),(411,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','newfile(3).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(3).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(3).txt',445,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340362','1410340362','1410340362'),(412,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/','新建文件夹','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/新建文件夹/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(0)/新建文件夹/',448,1,'','folder',1,0,1,1,0,'0 B',0,'1410340444','1410340444','1410340444'),(413,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','新建文件夹(1)','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/',449,1,'','folder',1,0,1,1,0,'0 B',0,'1410340450','1410340450','1410340450'),(414,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/','newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/newfile.txt',450,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340453','1410340453','1410340453'),(415,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/','newfile(0).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/newfile(0).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/newfile(0).txt',451,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340455','1410340455','1410340455'),(416,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/','newfile(1).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/newfile(1).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/newfile(1).txt',452,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340460','1410340460','1410340460'),(417,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','newfile(4).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(4).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(4).txt',453,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340464','1410340464','1410340464'),(418,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹/','新建文件夹','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹/新建文件夹/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹/新建文件夹/',454,1,'','folder',1,0,1,1,0,'0 B',0,'1410340469','1410340469','1410340469'),(419,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/','newfile(2).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/newfile(2).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/newfile(2).txt',456,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340577','1410340577','1410340577'),(420,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/','新建文件夹','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/新建文件夹/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/新建文件夹/',457,1,'','folder',1,0,1,1,0,'0 B',0,'1410340589','1410340589','1410340589'),(421,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','newfile(5).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(5).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(5).txt',458,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340593','1410340593','1410340593'),(422,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/','newfile(3).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/newfile(3).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(1)/newfile(3).txt',459,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340596','1410340596','1410340596'),(423,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','新建文件夹(2)','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(2)/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(2)/',460,1,'','folder',1,0,1,1,0,'0 B',0,'1410340605','1410340605','1410340605'),(424,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(2)/','newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(2)/newfile.txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(2)/newfile.txt',461,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340607','1410340607','1410340607'),(425,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','newfile(6).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(6).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(6).txt',462,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340612','1410340612','1410340612'),(426,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','新建文件夹(3)','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(3)/','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/新建文件夹(3)/',463,1,'','folder',1,0,1,1,0,'0 B',0,'1410340615','1410340615','1410340615'),(427,'/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/','newfile(7).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(7).txt','/mnt/hgfs/www/SNSCloud/data/1/private/TEST1/newfile(7).txt',464,1,'txt','file',1,0,1,1,0,'0 B',0,'1410340620','1410340620','1410340620'),(428,'/mnt/hgfs/www/SNSCloud/data/1/private/','美家SSL VPN用户指南.doc','/mnt/hgfs/www/SNSCloud/data/1/private/美家SSL VPN用户指南.doc','/mnt/hgfs/www/SNSCloud/data/1/private/美家SSL VPN用户指南.doc',465,1,'doc','file',1,0,1,1,532992,'532992 B',0,'1410425222','1410425222','1410425222');
/*!40000 ALTER TABLE `sns_g_cloudfile_manage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_g_operation_records`
--

DROP TABLE IF EXISTS `sns_g_operation_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_g_operation_records` (
  `gorid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '操作id',
  `cloudid` bigint(8) unsigned NOT NULL COMMENT '云文件id',
  `operationid` int(11) unsigned NOT NULL COMMENT '操作id',
  `createtime` varchar(13) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`gorid`),
  KEY `fk_sns_g_operation_records_sns_cmm_cloudfile_manage1_idx` (`cloudid`),
  CONSTRAINT `fk_sns_g_operation_records_sns_cmm_cloudfile_manage1` FOREIGN KEY (`cloudid`) REFERENCES `sns_g_cloudfile_manage` (`gcloudid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_g_operation_records`
--

LOCK TABLES `sns_g_operation_records` WRITE;
/*!40000 ALTER TABLE `sns_g_operation_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_g_operation_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_group`
--

DROP TABLE IF EXISTS `sns_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_group` (
  `groupid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '组权限id',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `created` varchar(13) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_group`
--

LOCK TABLES `sns_group` WRITE;
/*!40000 ALTER TABLE `sns_group` DISABLE KEYS */;
INSERT INTO `sns_group` VALUES (1,'语文组','1408004544'),(2,'化学组','1408004574');
/*!40000 ALTER TABLE `sns_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_group_role`
--

DROP TABLE IF EXISTS `sns_group_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_group_role` (
  `grid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '组角色id',
  `groupid` int(11) unsigned NOT NULL COMMENT '组id',
  `roleid` int(11) unsigned NOT NULL COMMENT '角色id',
  PRIMARY KEY (`grid`),
  KEY `fk_sns_group_role_sns_group1_idx` (`groupid`),
  KEY `fk_sns_group_role_sns_role1_idx` (`roleid`),
  CONSTRAINT `fk_sns_group_role_sns_group1` FOREIGN KEY (`groupid`) REFERENCES `sns_group` (`groupid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_group_role_sns_role1` FOREIGN KEY (`roleid`) REFERENCES `sns_role` (`roleid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='组角色';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_group_role`
--

LOCK TABLES `sns_group_role` WRITE;
/*!40000 ALTER TABLE `sns_group_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_group_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_member`
--

DROP TABLE IF EXISTS `sns_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_member` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(45) NOT NULL COMMENT '用户名',
  `password` varchar(61) NOT NULL COMMENT '密码',
  `email` varchar(100) NOT NULL COMMENT '邮箱',
  `name` varchar(45) DEFAULT NULL COMMENT '真实姓名',
  `idnumber` varchar(45) DEFAULT NULL COMMENT '身份证号码',
  `phone` varchar(45) DEFAULT NULL COMMENT '电话',
  `birthday` varchar(15) DEFAULT NULL COMMENT '生日',
  `sex` tinyint(1) unsigned DEFAULT '0' COMMENT '姓名（0女，1男）',
  `question` varchar(100) DEFAULT NULL COMMENT '密码提示问题',
  `answer` varchar(100) DEFAULT NULL COMMENT '密码提示答案',
  `provinceid` int(11) DEFAULT NULL COMMENT '省份id',
  `cityid` int(11) DEFAULT NULL COMMENT '城市id',
  `county` varchar(45) DEFAULT NULL COMMENT '区县id',
  `classid` int(11) unsigned DEFAULT NULL COMMENT '年级id',
  `disciplineid` int(11) unsigned DEFAULT NULL COMMENT '学科id',
  `spacesize` varchar(45) DEFAULT NULL COMMENT '空间大小',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态（0正常，1禁用）',
  `created` varchar(13) NOT NULL COMMENT '注册日期',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_member`
--

LOCK TABLES `sns_member` WRITE;
/*!40000 ALTER TABLE `sns_member` DISABLE KEYS */;
INSERT INTO `sns_member` VALUES (1,'wangbiao','wangbiao','wangbiao@pktcn.com','wangbiao',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408004860'),(2,'tester','tester','tester@pktcn.com','tester',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408004928'),(3,'tester1','123123','test1@admin.com','tester1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408073045'),(4,'tester2','123123','test2@admin.com','tester2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408073502'),(5,'tester3','123123','test3@admin.com','tester3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408073585'),(6,'tester4','123123','test4@admin.com','tester4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408074024'),(7,'tester5','123123','tester5@admin.com','tester5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408074085'),(8,'tester6','123123','tester6@admin.com','tester6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408074167');
/*!40000 ALTER TABLE `sns_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_member_group`
--

DROP TABLE IF EXISTS `sns_member_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_member_group` (
  `mgid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id',
  `groupid` int(11) unsigned NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`mgid`),
  KEY `fk_sns_member_group_sns_group1_idx` (`groupid`),
  KEY `fk_sns_member_group_sns_member1_idx` (`userid`),
  CONSTRAINT `fk_sns_member_group_sns_group1` FOREIGN KEY (`groupid`) REFERENCES `sns_group` (`groupid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_member_group_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_member_group`
--

LOCK TABLES `sns_member_group` WRITE;
/*!40000 ALTER TABLE `sns_member_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_member_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_member_role`
--

DROP TABLE IF EXISTS `sns_member_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_member_role` (
  `mrid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户角色id',
  `userid` int(11) unsigned NOT NULL COMMENT '用户id',
  `roleid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`mrid`),
  KEY `fk_sns_member_role_sns_member1_idx` (`userid`),
  KEY `fk_sns_member_role_sns_role1_idx` (`roleid`),
  CONSTRAINT `fk_sns_member_role_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_member_role_sns_role1` FOREIGN KEY (`roleid`) REFERENCES `sns_role` (`roleid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户-角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_member_role`
--

LOCK TABLES `sns_member_role` WRITE;
/*!40000 ALTER TABLE `sns_member_role` DISABLE KEYS */;
INSERT INTO `sns_member_role` VALUES (1,1,1),(2,2,2),(3,7,2),(4,8,2);
/*!40000 ALTER TABLE `sns_member_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_module`
--

DROP TABLE IF EXISTS `sns_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_module` (
  `moduleid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '模块id',
  `name` varchar(45) NOT NULL COMMENT '模块名称',
  `description` varchar(45) DEFAULT NULL COMMENT '模块描述',
  PRIMARY KEY (`moduleid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='模块表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_module`
--

LOCK TABLES `sns_module` WRITE;
/*!40000 ALTER TABLE `sns_module` DISABLE KEYS */;
INSERT INTO `sns_module` VALUES (1,'G盘','G盘模块'),(2,'圈子','圈子模块');
/*!40000 ALTER TABLE `sns_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_operation`
--

DROP TABLE IF EXISTS `sns_operation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_operation` (
  `operationid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '操作id',
  `operation` varchar(100) NOT NULL COMMENT '操作',
  `description` varchar(100) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`operationid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='操作表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_operation`
--

LOCK TABLES `sns_operation` WRITE;
/*!40000 ALTER TABLE `sns_operation` DISABLE KEYS */;
INSERT INTO `sns_operation` VALUES (1,'打开',''),(2,'编辑',''),(3,'复制',''),(4,'剪切',''),(5,'移动',''),(6,'删除',''),(7,'重命名',''),(8,'加密',''),(9,'下载',''),(10,'分享',''),(11,'属性','');
/*!40000 ALTER TABLE `sns_operation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_operation_func`
--

DROP TABLE IF EXISTS `sns_operation_func`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_operation_func` (
  `ofid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '操作-功能id',
  `operationid` int(11) unsigned NOT NULL COMMENT '操作id',
  `functionid` int(11) unsigned NOT NULL COMMENT '功�',
  PRIMARY KEY (`ofid`),
  KEY `fk_sns_operation_func_sns_operation1_idx` (`operationid`),
  KEY `fk_sns_operation_func_sns_function1_idx` (`functionid`),
  CONSTRAINT `fk_sns_operation_func_sns_function1` FOREIGN KEY (`functionid`) REFERENCES `sns_function` (`functionid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_operation_func_sns_operation1` FOREIGN KEY (`operationid`) REFERENCES `sns_operation` (`operationid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='操作-功能表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_operation_func`
--

LOCK TABLES `sns_operation_func` WRITE;
/*!40000 ALTER TABLE `sns_operation_func` DISABLE KEYS */;
INSERT INTO `sns_operation_func` VALUES (1,1,1),(2,3,2),(3,4,3),(4,6,4),(5,7,5),(6,5,6),(7,8,7),(8,10,8),(9,11,9),(10,1,10),(11,2,11),(12,3,12),(13,4,13),(14,5,14),(15,6,15),(16,7,16),(17,8,17),(18,9,18),(19,10,19),(20,11,20),(21,1,21),(22,3,22),(23,4,23),(24,6,24),(25,7,25),(26,5,26),(27,8,27),(28,10,28),(29,11,29),(30,1,30),(31,2,31),(32,3,32),(33,4,33),(34,5,34),(35,6,35),(36,7,36),(37,8,37),(38,9,38),(39,10,39),(40,11,40);
/*!40000 ALTER TABLE `sns_operation_func` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_opinion`
--

DROP TABLE IF EXISTS `sns_opinion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_opinion` (
  `opinionid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '意见id',
  `userid` int(11) DEFAULT NULL COMMENT '用户id',
  `email` varchar(100) NOT NULL COMMENT '邮箱地址',
  `content` varchar(255) NOT NULL COMMENT '意见内容',
  `created` varchar(13) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`opinionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='意见反馈表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_opinion`
--

LOCK TABLES `sns_opinion` WRITE;
/*!40000 ALTER TABLE `sns_opinion` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_opinion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_play_comment`
--

DROP TABLE IF EXISTS `sns_play_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_play_comment` (
  `commentid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `userid` int(11) unsigned NOT NULL COMMENT '评论者id',
  `playid` bigint(8) unsigned NOT NULL COMMENT '播放id',
  `userided` int(11) unsigned DEFAULT NULL COMMENT '被评论者id',
  `playtime` varchar(45) DEFAULT NULL COMMENT '评论时间点',
  `content` tinytext NOT NULL COMMENT '评论内容',
  `created` varchar(13) NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`commentid`),
  KEY `fk_sns_play_comment_sns_member1_idx` (`userid`),
  KEY `fk_sns_play_comment_sns_play_records1_idx` (`playid`),
  CONSTRAINT `fk_sns_play_comment_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_play_comment_sns_play_records1` FOREIGN KEY (`playid`) REFERENCES `sns_play_records` (`playid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_play_comment`
--

LOCK TABLES `sns_play_comment` WRITE;
/*!40000 ALTER TABLE `sns_play_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_play_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_play_records`
--

DROP TABLE IF EXISTS `sns_play_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_play_records` (
  `playid` bigint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '播放id',
  `userid` int(11) unsigned NOT NULL,
  `fileid` bigint(8) unsigned NOT NULL COMMENT '文件id',
  `starttime` varchar(45) DEFAULT NULL COMMENT '开始计时',
  `endtime` varchar(45) DEFAULT NULL COMMENT '结束时间',
  `bestlessons` int(11) DEFAULT '0' COMMENT '最近授课',
  `bestslice` int(11) DEFAULT '0' COMMENT '最佳切片',
  `bestproduce` int(11) DEFAULT '0' COMMENT '最佳录制',
  `created` varchar(13) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`playid`),
  KEY `fk_sns_play_records_sns_member1_idx` (`userid`),
  KEY `fk_sns_play_records_sns_file_manage1_idx` (`fileid`),
  CONSTRAINT `fk_sns_play_records_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_play_records_sns_file_manage1` FOREIGN KEY (`fileid`) REFERENCES `sns_cmm_localfile_manage` (`fileid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_play_records`
--

LOCK TABLES `sns_play_records` WRITE;
/*!40000 ALTER TABLE `sns_play_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_play_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_role`
--

DROP TABLE IF EXISTS `sns_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_role` (
  `roleid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `name` varchar(100) NOT NULL COMMENT '角色名',
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_role`
--

LOCK TABLES `sns_role` WRITE;
/*!40000 ALTER TABLE `sns_role` DISABLE KEYS */;
INSERT INTO `sns_role` VALUES (1,'admin'),(2,'普通用户');
/*!40000 ALTER TABLE `sns_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_setting`
--

DROP TABLE IF EXISTS `sns_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_setting` (
  `userid` int(11) DEFAULT NULL,
  `caseanalysis` tinyint(1) unsigned DEFAULT '0' COMMENT '课例分析',
  `e-journal` tinyint(1) unsigned DEFAULT '0' COMMENT '电子期刊',
  `rating` tinyint(1) unsigned DEFAULT '0' COMMENT '评比流程',
  `resourcecloud` tinyint(1) unsigned DEFAULT '0' COMMENT '资源运平台',
  `microcase` tinyint(1) unsigned DEFAULT '0' COMMENT '微颗课例分析平台',
  `journalplatform` tinyint(1) DEFAULT NULL COMMENT '电子期刊平台'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_setting`
--

LOCK TABLES `sns_setting` WRITE;
/*!40000 ALTER TABLE `sns_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_setting` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-11 17:38:46
