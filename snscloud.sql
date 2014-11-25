-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: snscloud
-- ------------------------------------------------------
-- Server version	5.5.38-0+wheezy1

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
-- Table structure for table `sns_access`
--

DROP TABLE IF EXISTS `sns_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_access` (
  `role_id` smallint(6) unsigned NOT NULL COMMENT '用户组的id',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '节点的id',
  `level` tinyint(1) NOT NULL COMMENT '节点的等级',
  `module` varchar(50) DEFAULT NULL,
  `pid` int(11) NOT NULL COMMENT '节点的父id',
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='授权表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_access`
--

LOCK TABLES `sns_access` WRITE;
/*!40000 ALTER TABLE `sns_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_access` ENABLE KEYS */;
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
  `zone_id` int(11) NOT NULL DEFAULT '0' COMMENT '区域ID',
  `company_id` int(11) DEFAULT '0' COMMENT '单位ID',
  `desc` varchar(255) DEFAULT NULL COMMENT '圈子描述',
  PRIMARY KEY (`circleid`),
  KEY `fk_sns_circle_sns_member1_idx` (`userid`),
  CONSTRAINT `fk_sns_circle_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle`
--

LOCK TABLES `sns_circle` WRITE;
/*!40000 ALTER TABLE `sns_circle` DISABLE KEYS */;
INSERT INTO `sns_circle` VALUES (50,0,'王国辉',1,NULL,NULL,'1416141375_0123.JPG',1,1,0,'1415947080',0,1,''),(51,0,'CircleB',1,NULL,NULL,'1416141178_6326.jpg',0,0,0,'1416141196',0,0,'fdsafds'),(52,0,'小汽车',1,NULL,NULL,'1416145542_0370.jpg',1,1,0,'1416145568',0,4,'调调'),(53,0,'小汽车2',1,NULL,NULL,'1416145599_5445.jpg',1,1,0,'1416145620',0,1,'范德萨'),(54,0,'AAAA',1,NULL,NULL,'1416145702_5543.jpg',1,1,0,'1416145725',0,3,'范德萨发'),(55,0,'BBBBB',1,NULL,NULL,'1416145745_9972.jpg',1,1,0,'1416145763',0,4,'范德萨范德萨');
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
  PRIMARY KEY (`ccloudid`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle_cloudfile_manage`
--

LOCK TABLES `sns_circle_cloudfile_manage` WRITE;
/*!40000 ALTER TABLE `sns_circle_cloudfile_manage` DISABLE KEYS */;
INSERT INTO `sns_circle_cloudfile_manage` VALUES (140,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','圈主分享','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/圈主分享/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/圈主分享/',684,1,'','folder',1,0,1,1,0,'0 B',0,'1415947080','1415947080','1415947080'),(141,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','通知公告','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知公告/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知公告/',685,1,'','folder',1,0,1,1,0,'0 B',0,'1415947080','1415947080','1415947080'),(142,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','作业上传','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/',686,1,'','folder',1,0,1,1,0,'0 B',0,'1415947080','1415947080','1415947080'),(143,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','通知文件','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/',687,1,'','folder',1,0,1,1,764134,'0 B',0,'1415947080','1416137376','1415947080'),(144,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/','fd039245d688d43faa1d06647d1ed21b0ff43beb.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/fd039245d688d43faa1d06647d1ed21b0ff43beb.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/fd039245d688d43faa1d06647d1ed21b0ff43beb.jpg',688,1,'jpg','file',1,0,1,1,135907,'135907 B',1,'1415947101','1416113596','1415947101'),(145,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/','fd039245d688d43faa1d06647d1ed21b0ff43beb副本.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/fd039245d688d43faa1d06647d1ed21b0ff43beb副本.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/fd039245d688d43faa1d06647d1ed21b0ff43beb副本.jpg',689,1,'jpg','file',1,0,1,1,135907,'135907 B',1,'1415947107','1416113596','1415947107'),(147,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','789.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/789.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1293081727802493600sgyprc.jpg',691,1,'jpg','file',1,0,1,1,184555,'184555 B',0,'1415947466','1415994578','1415947466'),(149,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','5665.JPG','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/5665.JPG','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/IMG_1014.JPG',693,1,'jpg','file',1,0,1,1,439682,'439682 B',1,'1415947653','1416115553','1415947653'),(150,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','啊.css','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/啊.css','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/啊.css',694,1,'css','file',1,0,1,1,0,'0 B',0,'1415947765','1415947765','1415947765'),(151,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','我.txt','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/我.txt','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/我.txt',695,1,'txt','file',1,0,1,1,0,'0 B',0,'1415947826','1415947826','1415947826'),(152,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','好看','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/',696,1,'','folder',1,0,1,1,352356,'0 B',0,'1415947835','1416118151','1415947835'),(153,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','8888.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/8888.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/u=1267552447,2850713388&fm=21&gp=0.jpg',697,1,'jpg','file',1,0,1,1,10360,'10360 B',0,'1415950840','1415974946','1415950840'),(154,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','1.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/u=4185435809,4139567692&fm=21&gp=0.jpg',698,1,'jpg','file',1,0,1,1,8518,'8518 B',0,'1415950860','1415953377','1415950860'),(155,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/','meinv.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/meinv.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/meinv.jpg',699,1,'jpg','file',1,0,1,1,7556,'7556 B',1,'1415950885','1415994998','1415950885'),(156,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/','GitHub.appref-ms','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/GitHub.appref-ms','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/GitHub.appref-ms',700,1,'appref-ms','file',1,0,1,1,308,'308 B',1,'1415952417','1415952435','1415952417'),(157,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','666.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/666.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/xbzs_014.jpg',701,1,'jpg','file',1,0,1,1,724203,'724203 B',0,'1415981293','1415994597','1415981293'),(158,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','66.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/66.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/Webshots011.jpg',702,1,'jpg','file',1,0,1,1,293874,'293874 B',0,'1415981553','1415994585','1415981553'),(166,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/','573601058f8e4f9b09fa9302.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/573601058f8e4f9b09fa9302.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/573601058f8e4f9b09fa9302.jpg',712,1,'jpg','file',1,0,1,1,298092,'149046 B',0,'1415995659','1415995659','1415995659'),(170,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/','2014-11-16—提交微课程作业','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/221/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/221/',716,1,NULL,'folder',1,0,1,1,0,' B',0,'1416114735','1416114735','1416114735'),(171,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/','111111.JPG','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/111111.JPG','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/111111.JPG',717,1,'jpg','file',1,0,1,1,352356,'176178 B',0,'1416118151','1416118151','1416118151'),(172,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/','2014-11-16—提交微课程作业','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/222/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/222/',718,1,NULL,'folder',1,0,1,1,0,' B',0,'1416130844','1416130844','1416130844'),(173,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','好看副本','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看副本/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看副本/',719,1,'','folder',1,0,1,1,352356,'0 B',0,'1416137265','1416137265','1416137265'),(174,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/','1副本.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/1副本.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/1副本.jpg',720,1,'jpg','file',1,0,1,1,8518,'8518 B',0,'1416137273','1416137273','1416137273'),(175,'/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/','tt.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/tt.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/Desert.jpg',721,1,'jpg','file',1,0,1,1,466042,'233021 B',0,'1416137376','1416137403','1416137376'),(176,'/home/jianlongli/SNSCloud/data/c_51/private/','圈主分享','/home/jianlongli/SNSCloud/data/c_51/private/圈主分享/','/home/jianlongli/SNSCloud/data/c_51/private/圈主分享/',722,1,'','folder',1,0,1,1,0,'0 B',0,'1416141196','1416141196','1416141196'),(177,'/home/jianlongli/SNSCloud/data/c_51/private/','通知公告','/home/jianlongli/SNSCloud/data/c_51/private/通知公告/','/home/jianlongli/SNSCloud/data/c_51/private/通知公告/',723,1,'','folder',1,0,1,1,0,'0 B',0,'1416141196','1416141196','1416141196'),(178,'/home/jianlongli/SNSCloud/data/c_51/private/','作业上传','/home/jianlongli/SNSCloud/data/c_51/private/作业上传/','/home/jianlongli/SNSCloud/data/c_51/private/作业上传/',724,1,'','folder',1,0,1,1,0,'0 B',0,'1416141196','1416141196','1416141196'),(179,'/home/jianlongli/SNSCloud/data/c_51/private/','通知文件','/home/jianlongli/SNSCloud/data/c_51/private/通知文件/','/home/jianlongli/SNSCloud/data/c_51/private/通知文件/',725,1,'','folder',1,0,1,1,0,'0 B',0,'1416141196','1416141196','1416141196'),(180,'/home/jianlongli/SNSCloud/data/c_50/private/','新建文件夹','/home/jianlongli/SNSCloud/data/c_50/private/新建文件夹/','/home/jianlongli/SNSCloud/data/c_50/private/新建文件夹/',726,1,'','folder',1,0,1,1,0,'0 B',0,'1416142354','1416142354','1416142354'),(181,'/home/jianlongli/SNSCloud/data/c_50/private/','2.txt','/home/jianlongli/SNSCloud/data/c_50/private/2.txt','/home/jianlongli/SNSCloud/data/c_50/private/newfile.txt',727,1,'txt','file',1,0,1,1,0,'0 B',0,'1416142358','1416190703','1416142358'),(182,'/home/jianlongli/SNSCloud/data/c_51/private/','u=1989088287,1387873866&fm=21&gp=0.jpg','/home/jianlongli/SNSCloud/data/c_51/private/u=1989088287,1387873866&fm=21&gp=0.jpg','/home/jianlongli/SNSCloud/data/c_51/private/u=1989088287,1387873866&fm=21&gp=0.jpg',728,1,'jpg','file',1,0,1,1,16404,'8202 B',0,'1416145517','1416145517','1416145517'),(183,'/home/jianlongli/SNSCloud/data/c_52/private/','圈主分享','/home/jianlongli/SNSCloud/data/c_52/private/圈主分享/','/home/jianlongli/SNSCloud/data/c_52/private/圈主分享/',729,1,'','folder',1,0,1,1,0,'0 B',0,'1416145568','1416145568','1416145568'),(184,'/home/jianlongli/SNSCloud/data/c_52/private/','通知公告','/home/jianlongli/SNSCloud/data/c_52/private/通知公告/','/home/jianlongli/SNSCloud/data/c_52/private/通知公告/',730,1,'','folder',1,0,1,1,0,'0 B',0,'1416145568','1416145568','1416145568'),(185,'/home/jianlongli/SNSCloud/data/c_52/private/','作业上传','/home/jianlongli/SNSCloud/data/c_52/private/作业上传/','/home/jianlongli/SNSCloud/data/c_52/private/作业上传/',731,1,'','folder',1,0,1,1,0,'0 B',0,'1416145568','1416145568','1416145568'),(186,'/home/jianlongli/SNSCloud/data/c_52/private/','通知文件','/home/jianlongli/SNSCloud/data/c_52/private/通知文件/','/home/jianlongli/SNSCloud/data/c_52/private/通知文件/',732,1,'','folder',1,0,1,1,0,'0 B',0,'1416145568','1416145568','1416145568'),(187,'/home/jianlongli/SNSCloud/data/c_53/private/','圈主分享','/home/jianlongli/SNSCloud/data/c_53/private/圈主分享/','/home/jianlongli/SNSCloud/data/c_53/private/圈主分享/',733,1,'','folder',1,0,1,1,0,'0 B',0,'1416145620','1416145620','1416145620'),(188,'/home/jianlongli/SNSCloud/data/c_53/private/','通知公告','/home/jianlongli/SNSCloud/data/c_53/private/通知公告/','/home/jianlongli/SNSCloud/data/c_53/private/通知公告/',734,1,'','folder',1,0,1,1,0,'0 B',0,'1416145620','1416145620','1416145620'),(189,'/home/jianlongli/SNSCloud/data/c_53/private/','作业上传','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/',735,1,'','folder',1,0,1,1,0,'0 B',0,'1416145620','1416145620','1416145620'),(190,'/home/jianlongli/SNSCloud/data/c_53/private/','通知文件','/home/jianlongli/SNSCloud/data/c_53/private/通知文件/','/home/jianlongli/SNSCloud/data/c_53/private/通知文件/',736,1,'','folder',1,0,1,1,0,'0 B',0,'1416145620','1416145620','1416145620'),(191,'/home/jianlongli/SNSCloud/data/c_54/private/','圈主分享','/home/jianlongli/SNSCloud/data/c_54/private/圈主分享/','/home/jianlongli/SNSCloud/data/c_54/private/圈主分享/',737,1,'','folder',1,0,1,1,0,'0 B',0,'1416145725','1416145725','1416145725'),(192,'/home/jianlongli/SNSCloud/data/c_54/private/','通知公告','/home/jianlongli/SNSCloud/data/c_54/private/通知公告/','/home/jianlongli/SNSCloud/data/c_54/private/通知公告/',738,1,'','folder',1,0,1,1,0,'0 B',0,'1416145725','1416145725','1416145725'),(193,'/home/jianlongli/SNSCloud/data/c_54/private/','作业上传','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/',739,1,'','folder',1,0,1,1,0,'0 B',0,'1416145725','1416145725','1416145725'),(194,'/home/jianlongli/SNSCloud/data/c_54/private/','通知文件','/home/jianlongli/SNSCloud/data/c_54/private/通知文件/','/home/jianlongli/SNSCloud/data/c_54/private/通知文件/',740,1,'','folder',1,0,1,1,0,'0 B',0,'1416145725','1416145725','1416145725'),(195,'/home/jianlongli/SNSCloud/data/c_55/private/','圈主分享','/home/jianlongli/SNSCloud/data/c_55/private/圈主分享/','/home/jianlongli/SNSCloud/data/c_55/private/圈主分享/',741,1,'','folder',1,0,1,1,0,'0 B',0,'1416145763','1416145763','1416145763'),(196,'/home/jianlongli/SNSCloud/data/c_55/private/','通知公告','/home/jianlongli/SNSCloud/data/c_55/private/通知公告/','/home/jianlongli/SNSCloud/data/c_55/private/通知公告/',742,1,'','folder',1,0,1,1,0,'0 B',0,'1416145763','1416145763','1416145763'),(197,'/home/jianlongli/SNSCloud/data/c_55/private/','作业上传','/home/jianlongli/SNSCloud/data/c_55/private/作业上传/','/home/jianlongli/SNSCloud/data/c_55/private/作业上传/',743,1,'','folder',1,0,1,1,0,'0 B',0,'1416145763','1416145763','1416145763'),(198,'/home/jianlongli/SNSCloud/data/c_55/private/','通知文件','/home/jianlongli/SNSCloud/data/c_55/private/通知文件/','/home/jianlongli/SNSCloud/data/c_55/private/通知文件/',744,1,'','folder',1,0,1,1,0,'0 B',0,'1416145763','1416145763','1416145763'),(199,'/home/jianlongli/SNSCloud/data/c_55/private/','u=3168940508,2777398221&fm=23&gp=0.jpg','/home/jianlongli/SNSCloud/data/c_55/private/u=3168940508,2777398221&fm=23&gp=0.jpg','/home/jianlongli/SNSCloud/data/c_55/private/u=3168940508,2777398221&fm=23&gp=0.jpg',745,1,'jpg','file',1,0,1,1,22088,'11044 B',0,'1416145805','1416145805','1416145805'),(200,'/home/jianlongli/SNSCloud/data/c_55/private/','u=2212153206,3709472511&fm=23&gp=0.jpg','/home/jianlongli/SNSCloud/data/c_55/private/u=2212153206,3709472511&fm=23&gp=0.jpg','/home/jianlongli/SNSCloud/data/c_55/private/u=2212153206,3709472511&fm=23&gp=0.jpg',746,1,'jpg','file',1,0,1,1,29736,'14868 B',0,'1416145817','1416145817','1416145817'),(201,'/home/jianlongli/SNSCloud/data/c_55/private/','u=47152479,1925326072&fm=23&gp=0.jpg','/home/jianlongli/SNSCloud/data/c_55/private/u=47152479,1925326072&fm=23&gp=0.jpg','/home/jianlongli/SNSCloud/data/c_55/private/u=47152479,1925326072&fm=23&gp=0.jpg',747,1,'jpg','file',1,0,1,1,35854,'17927 B',0,'1416145817','1416145817','1416145817'),(202,'/home/jianlongli/SNSCloud/data/c_55/private/','u=3605270022,3248072682&fm=23&gp=0.jpg','/home/jianlongli/SNSCloud/data/c_55/private/u=3605270022,3248072682&fm=23&gp=0.jpg','/home/jianlongli/SNSCloud/data/c_55/private/u=3605270022,3248072682&fm=23&gp=0.jpg',748,1,'jpg','file',1,0,1,1,27298,'13649 B',0,'1416145817','1416145817','1416145817'),(203,'/home/jianlongli/SNSCloud/data/c_55/private/','李建栋-Php工程师（社区技术部）2014年11月24日入职.docx','/home/jianlongli/SNSCloud/data/c_55/private/李建栋-Php工程师（社区技术部）2014年11月24日入职.docx','/home/jianlongli/SNSCloud/data/c_55/private/李建栋-Php工程师（社区技术部）2014年11月24日入职.docx',749,1,'docx','file',1,0,1,1,309380,'154690 B',1,'1416145820','1416145829','1416145820'),(204,'/home/jianlongli/SNSCloud/data/c_54/private/作业上传/','2014-11-17—提交微课程作业','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/223/','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/223/',751,1,NULL,'folder',1,0,1,1,0,' B',0,'1416190628','1416190628','1416190628'),(205,'/home/jianlongli/SNSCloud/data/c_54/private/作业上传/','2014-11-17—提交微课程作业','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/224/','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/224/',752,1,NULL,'folder',1,0,1,1,0,' B',0,'1416190630','1416190630','1416190630'),(206,'/home/jianlongli/SNSCloud/data/c_54/private/作业上传/','2014-11-17—提交微课程作业','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/225/','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/225/',753,1,NULL,'folder',1,0,1,1,0,' B',0,'1416190631','1416190631','1416190631'),(207,'/home/jianlongli/SNSCloud/data/c_54/private/作业上传/','2014-11-17—提交微课程作业','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/226/','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/226/',754,1,NULL,'folder',1,0,1,1,0,' B',0,'1416190634','1416190634','1416190634'),(208,'/home/jianlongli/SNSCloud/data/c_50/private/','','/home/jianlongli/SNSCloud/data/c_50/private/','/home/jianlongli/SNSCloud/data/c_50/private/',755,1,'','folder',1,0,1,1,0,'0 B',0,'1416190695','1416190695','1416190695'),(209,'/home/jianlongli/SNSCloud/data/c_50/private/','Jellyfish.jpg','/home/jianlongli/SNSCloud/data/c_50/private/Jellyfish.jpg','/home/jianlongli/SNSCloud/data/c_50/private/Jellyfish.jpg',756,1,'jpg','file',1,0,1,1,389544,'194772 B',0,'1416190718','1416190718','1416190718'),(210,'/home/jianlongli/SNSCloud/data/c_53/private/作业上传/','2014-11-17—提交微课程作业','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/231/','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/231/',758,1,NULL,'folder',1,0,1,1,0,' B',0,'1416190813','1416190813','1416190813'),(211,'/home/jianlongli/SNSCloud/data/c_53/private/作业上传/','2014-11-17—提交微课程作业','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/232/','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/232/',759,1,NULL,'folder',1,0,1,1,0,' B',0,'1416190814','1416190814','1416190814'),(212,'/home/jianlongli/SNSCloud/data/c_53/private/作业上传/','2014-11-17—提交微课程作业','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/233/','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/233/',760,1,NULL,'folder',1,0,1,1,0,' B',0,'1416190815','1416190815','1416190815'),(213,'/home/jianlongli/SNSCloud/data/c_53/private/作业上传/','2014-11-17—提交微课程作业','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/234/','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/234/',761,1,NULL,'folder',1,0,1,1,0,' B',0,'1416190816','1416190816','1416190816'),(214,'/home/jianlongli/SNSCloud/data/c_50/private/作业上传/','2014-11-17—提交微课程作业','/home/jianlongli/SNSCloud/data/c_50/private/作业上传/235/','/home/jianlongli/SNSCloud/data/c_50/private/作业上传/235/',762,1,NULL,'folder',1,0,1,1,0,' B',0,'1416191037','1416191037','1416191037');
/*!40000 ALTER TABLE `sns_circle_cloudfile_manage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_circle_copy`
--

DROP TABLE IF EXISTS `sns_circle_copy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_circle_copy` (
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
  `zone_id` int(11) NOT NULL DEFAULT '0' COMMENT '区域ID',
  `company_id` int(11) DEFAULT '0' COMMENT '单位ID',
  PRIMARY KEY (`circleid`),
  KEY `fk_sns_circle_sns_member1_idx` (`userid`),
  CONSTRAINT `sns_circle_copy_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle_copy`
--

LOCK TABLES `sns_circle_copy` WRITE;
/*!40000 ALTER TABLE `sns_circle_copy` DISABLE KEYS */;
INSERT INTO `sns_circle_copy` VALUES (23,0,'哇哇哇',1,NULL,NULL,'1414830261_4064.jpg',1,0,0,'1414830266',0,0),(24,0,'搜索',1,NULL,NULL,'1414830761_4752.jpg',0,1,0,'1414830771',0,0),(25,0,'啊啊',1,NULL,NULL,'1414830787_0504.jpg',0,0,0,'1414830797',0,0),(26,0,'撒',1,NULL,NULL,'1414830901_2167.jpg',1,1,0,'1414830906',0,0),(27,0,'111',1,NULL,NULL,'1414832201_3991.jpg',0,1,0,'1414832206',0,0),(28,0,'11',1,NULL,NULL,'1414977633_5734.jpg',1,0,0,'1414977637',0,0),(29,0,'12',1,NULL,NULL,'1415064315_4650.jpg',0,1,0,'1415064320',0,0),(30,0,'fsda',1,NULL,NULL,'1415070205_3533.jpg',1,0,0,'1415070208',0,0),(31,0,'fds',1,NULL,NULL,'1415070347_5206.jpg',1,0,0,'1415070349',0,0),(32,0,'fsda',1,NULL,NULL,'1415070505_4639.jpg',1,0,0,'1415070508',0,0),(33,0,'富士达',1,NULL,NULL,'1415075282_0994.jpg',1,0,0,'1415075289',0,0),(34,0,'11111111',1,NULL,NULL,'1415075309_9922.jpg',0,1,0,'1415075314',0,0),(35,0,'321',1,NULL,NULL,'1415075586_2892.jpg',1,0,0,'1415075589',0,0),(36,0,'31',1,NULL,NULL,'1415075625_3356.jpg',0,1,0,'1415075628',0,0),(37,0,'12345',1,NULL,NULL,'1415075805_0993.jpg',0,1,0,'1415075809',0,0),(38,0,'32',1,NULL,NULL,'1415076242_6458.jpg',0,1,0,'1415076247',0,0),(39,0,'111111111111111',1,NULL,NULL,'1415076258_8994.jpg',1,0,0,'1415076264',0,0),(41,0,'吉他家族',1,NULL,NULL,'1415158241_2613.jpg',0,1,0,'1415158263',0,0),(42,0,'wanggh',1,NULL,NULL,'1415239725_5151.jpg',0,1,0,'1415239919',0,4),(43,0,'哇哇哇',1,NULL,NULL,'1415244134_2225.jpg',1,0,0,'1415244136',0,4);
/*!40000 ALTER TABLE `sns_circle_copy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_circle_member`
--

DROP TABLE IF EXISTS `sns_circle_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_circle_member` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `circle_id` int(11) DEFAULT NULL COMMENT '圈子ID',
  `member_id` int(11) DEFAULT NULL COMMENT '用户ID ',
  `type` int(11) DEFAULT '0' COMMENT '权限(0:成员;1:管理员;2:创建者;)',
  `time` int(11) DEFAULT NULL COMMENT '入表时间戳',
  `status` int(11) DEFAULT '0' COMMENT '状态(0:正常;1:移除;)',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle_member`
--

LOCK TABLES `sns_circle_member` WRITE;
/*!40000 ALTER TABLE `sns_circle_member` DISABLE KEYS */;
INSERT INTO `sns_circle_member` VALUES (1,41,1,2,1415158263,0),(3,41,2,1,1415158263,0),(4,41,11,0,1415158263,0),(5,41,12,0,1415158263,0),(6,41,13,0,1415158263,0),(7,42,1,2,1415239919,0),(8,42,2,1,1415239919,0),(9,42,4,1,1415239919,0),(10,42,13,0,1415239919,0),(11,43,1,2,1415244136,0),(12,43,3,1,1415244136,0),(13,43,4,1,1415244136,0),(14,43,5,1,1415244136,0),(15,43,6,1,1415244136,0),(16,43,7,1,1415244136,0),(17,43,8,1,1415244136,0),(18,43,9,1,1415244136,0),(19,43,10,1,1415244136,0),(20,43,11,1,1415244136,0),(21,43,12,1,1415244136,0),(22,43,13,1,1415244136,0),(23,43,2,0,1415244136,0),(24,44,1,2,1415764453,0),(25,44,9,1,1415764453,0),(26,44,33,0,1415764453,0),(27,45,1,2,1415764518,0),(28,45,9,1,1415764518,0),(29,45,26,0,1415764518,0),(30,45,27,0,1415764518,0),(31,45,30,0,1415764518,0),(32,46,1,2,1415860716,0),(33,46,8,1,1415860716,0),(34,46,25,0,1415860716,0),(35,46,26,0,1415860716,0),(36,46,27,0,1415860716,0),(37,47,1,2,1415861992,0),(38,47,2,1,1415861992,0),(39,47,24,0,1415861992,0),(40,47,25,0,1415861992,0),(41,48,1,2,1415862603,0),(42,48,2,1,1415862603,0),(43,48,4,0,1415862603,0),(44,49,1,2,1415930750,0),(45,49,2,1,1415930750,0),(46,49,9,0,1415930750,0),(47,49,24,0,1415930750,0),(48,49,25,0,1415930750,0),(49,50,1,2,1415947081,0),(50,50,9,1,1415947081,0),(51,50,27,0,1415947081,0),(52,50,30,0,1415947081,0),(53,50,33,0,1415947081,0),(59,51,1,2,1416141196,0),(60,51,9,1,1416141196,0),(61,51,2,0,1416141196,0),(62,51,4,0,1416141196,0),(63,51,5,0,1416141196,0),(64,51,6,0,1416141196,0),(65,51,7,0,1416141196,0),(66,51,8,0,1416141196,0),(67,51,24,0,1416141196,0),(68,51,25,0,1416141196,0),(69,51,26,0,1416141196,0),(70,51,27,0,1416141196,0),(71,51,30,0,1416141196,0),(72,51,33,0,1416141196,0),(73,51,9,3,1416141233,0),(75,50,1,3,1416142748,0),(78,50,2,0,1416143436,0),(79,50,4,0,1416143436,0),(80,50,5,3,1416143446,0),(81,52,1,2,1416145568,0),(82,52,8,1,1416145568,0),(83,52,9,1,1416145568,0),(84,52,4,0,1416145568,0),(85,52,7,0,1416145568,0),(86,52,25,0,1416145568,0),(87,53,1,2,1416145620,0),(88,53,25,1,1416145620,0),(89,53,27,1,1416145620,0),(90,53,5,0,1416145620,0),(91,53,6,0,1416145620,0),(92,53,7,0,1416145620,0),(93,54,1,2,1416145725,0),(94,54,4,1,1416145725,0),(95,54,24,1,1416145725,0),(96,54,8,0,1416145725,0),(97,54,26,0,1416145725,0),(98,55,1,2,1416145763,0),(99,55,9,1,1416145763,0),(100,55,24,1,1416145763,0),(101,55,8,0,1416145763,0),(102,55,25,0,1416145763,0),(104,55,1,3,1416179973,0);
/*!40000 ALTER TABLE `sns_circle_member` ENABLE KEYS */;
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
  CONSTRAINT `fk_sns_circle_operation_records_sns_circle1` FOREIGN KEY (`circleid`) REFERENCES `sns_circle` (`circleid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_circle_operation_records_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `dirid` int(11) DEFAULT NULL COMMENT '文件夹id',
  PRIMARY KEY (`workid`),
  KEY `fk_sns_circle_work_sns_member1_idx` (`userid`),
  KEY `fk_sns_circle_work_sns_circle1_idx` (`circleid`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle_work`
--

LOCK TABLES `sns_circle_work` WRITE;
/*!40000 ALTER TABLE `sns_circle_work` DISABLE KEYS */;
INSERT INTO `sns_circle_work` VALUES (221,1,50,'Zz','1416201125','1417065128','Zz~','1416114735',170),(222,1,50,'ssfa','1416303632','1417081235','fsdaf','1416130844',172),(223,1,54,'gggg','1416190634','1416449836','ggg','1416190628',NULL),(224,1,54,'gggg','1416190634','1416449836','ggg','1416190630',NULL),(225,1,54,'gggg','1416190634','1416449836','ggg','1416190631',NULL),(226,1,54,'gggg','1416190634','1416449836','ggg','1416190634',NULL),(227,1,54,'gggg','1416190634','1416449836','ggg','1416190640',NULL),(228,1,54,'gggg','1416190634','1416449836','ggg','1416190641',NULL),(229,1,54,'gggg','1416190634','1416449836','ggg','1416190642',NULL),(230,1,54,'gggg','1416190634','1416449836','ggg','1416190642',NULL),(231,1,53,'gg','1416277226','1416450030','hhhh','1416190813',NULL),(232,1,53,'gg','1416277226','1416450030','hhhh','1416190814',NULL),(233,1,53,'gg','1416277226','1416450030','hhhh','1416190815',NULL),(234,1,53,'gg','1416277226','1416450030','hhhh','1416190816',NULL),(235,1,50,'9999999999','1416191048','1416277450','kkkkkk','1416191037',214);
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
  `name` varchar(255) DEFAULT NULL COMMENT '文件名称',
  `size` int(10) unsigned DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL COMMENT '类型',
  `localpath` varchar(255) DEFAULT NULL COMMENT '本地路径',
  `url` varchar(255) DEFAULT NULL COMMENT '访问路径',
  `created` varchar(13) DEFAULT NULL COMMENT '发布时间',
  `ccloudid` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`commitid`),
  KEY `fk_sns_circle_work_commit_sns_member1_idx` (`userid`),
  KEY `fk_sns_circle_work_commit_sns_circle_work1_idx` (`workid`)
) ENGINE=InnoDB AUTO_INCREMENT=466 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_circle_work_commit`
--

LOCK TABLES `sns_circle_work_commit` WRITE;
/*!40000 ALTER TABLE `sns_circle_work_commit` DISABLE KEYS */;
INSERT INTO `sns_circle_work_commit` VALUES (404,1,221,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(405,9,221,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(406,27,221,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(407,30,221,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(408,33,221,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(409,1,222,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(410,9,222,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(411,27,222,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(412,30,222,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(413,33,222,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(414,1,223,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(415,4,223,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(416,24,223,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(417,8,223,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(418,26,223,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(419,1,224,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(420,4,224,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(421,24,224,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(422,8,224,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(423,26,224,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(424,1,225,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(425,4,225,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(426,24,225,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(427,8,225,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(428,26,225,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(429,1,226,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(430,4,226,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(431,24,226,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(432,8,226,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(433,26,226,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(434,1,231,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(435,25,231,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(436,27,231,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(437,5,231,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(438,6,231,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(439,7,231,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(440,1,232,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(441,25,232,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(442,27,232,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(443,5,232,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(444,6,232,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(445,7,232,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(446,1,233,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(447,25,233,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(448,27,233,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(449,5,233,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(450,6,233,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(451,7,233,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(452,1,234,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(453,25,234,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(454,27,234,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(455,5,234,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(456,6,234,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(457,7,234,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(458,1,235,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(459,9,235,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(460,27,235,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(461,30,235,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(462,33,235,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(463,2,235,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(464,4,235,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(465,5,235,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=769 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_cmm_localfile_manage`
--

LOCK TABLES `sns_cmm_localfile_manage` WRITE;
/*!40000 ALTER TABLE `sns_cmm_localfile_manage` DISABLE KEYS */;
INSERT INTO `sns_cmm_localfile_manage` VALUES (684,1,'圈主分享','圈主分享',0,'folder','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/',0,'1415947080','1415947080'),(685,1,'通知公告','通知公告',0,'folder','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/',0,'1415947080','1415947080'),(686,1,'作业上传','作业上传',0,'folder','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/',0,'1415947080','1415947080'),(687,1,'通知文件','通知文件',0,'folder','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/',0,'1415947080','1415947080'),(688,1,'fd039245d688d43faa1d06647d1ed21b0ff43beb.jpg','fd039245d688d43faa1d06647d1ed21b0ff43beb.jpg',135907,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/1415947101.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/1415947101.jpg',0,'1415947101','1415947101'),(689,1,'fd039245d688d43faa1d06647d1ed21b0ff43beb副本.jpg','fd039245d688d43faa1d06647d1ed21b0ff43beb副本.jpg',135907,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/1415947101.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/1415947101.jpg',0,'1415947107','1415947107'),(691,1,'1293081727802493600sgyprc.jpg','1293081727802493600sgyprc.jpg',184555,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947466.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947466.jpg',0,'1415947466','1415947466'),(693,1,'IMG_1014.JPG','IMG_1014.JPG',439682,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947653.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947653.jpg',0,'1415947653','1415947653'),(694,1,'啊.css','啊.css',0,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947765.css','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947765.css',0,'1415947765','1415947765'),(695,1,'我.txt','我.txt',0,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947826.txt','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947826.txt',0,'1415947826','1415947826'),(696,1,'好看','好看',0,'folder','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947835','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947835',0,'1415947835','1415947835'),(697,1,'u=1267552447,2850713388&fm=21&gp=0.jpg','u=1267552447,2850713388&fm=21&gp=0.jpg',10360,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415950840.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415950840.jpg',0,'1415950840','1415950840'),(698,1,'u=4185435809,4139567692&fm=21&gp=0.jpg','u=4185435809,4139567692&fm=21&gp=0.jpg',8518,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415950860.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415950860.jpg',0,'1415950860','1415950860'),(699,1,'meinv.jpg','meinv.jpg',7556,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/1415950885.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/1415950885.jpg',0,'1415950885','1415950885'),(700,1,'GitHub.appref-ms','GitHub.appref-ms',308,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/1415952417.appref-ms','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/1415952417.appref-ms',0,'1415952417','1415952417'),(701,1,'xbzs_014.jpg','xbzs_014.jpg',724203,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415981293.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415981293.jpg',0,'1415981293','1415981293'),(702,1,'Webshots011.jpg','Webshots011.jpg',293874,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415981553.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415981553.jpg',0,'1415981553','1415981553'),(712,1,'573601058f8e4f9b09fa9302.jpg','573601058f8e4f9b09fa9302.jpg',149046,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/1415995659.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/1415995659.jpg',0,'1415995659','1415995659'),(713,1,'2014-11-16—提交微课程作业','2014-11-16—提交微课程作业',0,'folder','/home/zz/SNSCloud_v3/data/work/218/','/home/zz/SNSCloud_v3/data/work/218/',0,'1416113725','1416113725'),(714,1,'2014-11-16—提交微课程作业','2014-11-16—提交微课程作业',0,'folder','/home/zz/SNSCloud_v3/data/work/219/','/home/zz/SNSCloud_v3/data/work/219/',0,'1416113942','1416113942'),(715,1,'2014-11-16—提交微课程作业','2014-11-16—提交微课程作业',0,'folder','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/上传作业/220/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/上传作业/220/',0,'1416114191','1416114191'),(716,1,'2014-11-16—提交微课程作业','2014-11-16—提交微课程作业',0,'folder','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/221/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/221/',0,'1416114735','1416114735'),(717,1,'111111.JPG','111111.JPG',176178,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/1416118151.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/好看/1416118151.jpg',0,'1416118151','1416118151'),(718,1,'2014-11-16—提交微课程作业','2014-11-16—提交微课程作业',0,'folder','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/222/','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/作业上传/222/',0,'1416130844','1416130844'),(719,1,'好看副本','好看副本',0,'folder','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947835','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415947835',0,'1416137265','1416137265'),(720,1,'1副本.jpg','1副本.jpg',8518,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415950860.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/1415950860.jpg',0,'1416137273','1416137273'),(721,1,'Desert.jpg','Desert.jpg',233021,'file','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/1416137376.jpg','/home/guohuiwang/snscloud/trunk/SNSCloud/data/c_50/private/通知文件/1416137376.jpg',0,'1416137376','1416137376'),(722,1,'圈主分享','圈主分享',0,'folder','/home/jianlongli/SNSCloud/data/c_51/private/','/home/jianlongli/SNSCloud/data/c_51/private/',0,'1416141196','1416141196'),(723,1,'通知公告','通知公告',0,'folder','/home/jianlongli/SNSCloud/data/c_51/private/','/home/jianlongli/SNSCloud/data/c_51/private/',0,'1416141196','1416141196'),(724,1,'作业上传','作业上传',0,'folder','/home/jianlongli/SNSCloud/data/c_51/private/','/home/jianlongli/SNSCloud/data/c_51/private/',0,'1416141196','1416141196'),(725,1,'通知文件','通知文件',0,'folder','/home/jianlongli/SNSCloud/data/c_51/private/','/home/jianlongli/SNSCloud/data/c_51/private/',0,'1416141196','1416141196'),(726,1,'新建文件夹','新建文件夹',0,'folder','/home/jianlongli/SNSCloud/data/c_50/private/1416142354','/home/jianlongli/SNSCloud/data/c_50/private/1416142354',0,'1416142354','1416142354'),(727,1,'newfile.txt','newfile.txt',0,'file','/home/jianlongli/SNSCloud/data/c_50/private/1416142358.txt','/home/jianlongli/SNSCloud/data/c_50/private/1416142358.txt',0,'1416142358','1416142358'),(728,1,'u=1989088287,1387873866&fm=21&gp=0.jpg','u=1989088287,1387873866&fm=21&gp=0.jpg',8202,'file','/home/jianlongli/SNSCloud/data/c_51/private/1416145517.jpg','/home/jianlongli/SNSCloud/data/c_51/private/1416145517.jpg',0,'1416145517','1416145517'),(729,1,'圈主分享','圈主分享',0,'folder','/home/jianlongli/SNSCloud/data/c_52/private/','/home/jianlongli/SNSCloud/data/c_52/private/',0,'1416145568','1416145568'),(730,1,'通知公告','通知公告',0,'folder','/home/jianlongli/SNSCloud/data/c_52/private/','/home/jianlongli/SNSCloud/data/c_52/private/',0,'1416145568','1416145568'),(731,1,'作业上传','作业上传',0,'folder','/home/jianlongli/SNSCloud/data/c_52/private/','/home/jianlongli/SNSCloud/data/c_52/private/',0,'1416145568','1416145568'),(732,1,'通知文件','通知文件',0,'folder','/home/jianlongli/SNSCloud/data/c_52/private/','/home/jianlongli/SNSCloud/data/c_52/private/',0,'1416145568','1416145568'),(733,1,'圈主分享','圈主分享',0,'folder','/home/jianlongli/SNSCloud/data/c_53/private/','/home/jianlongli/SNSCloud/data/c_53/private/',0,'1416145620','1416145620'),(734,1,'通知公告','通知公告',0,'folder','/home/jianlongli/SNSCloud/data/c_53/private/','/home/jianlongli/SNSCloud/data/c_53/private/',0,'1416145620','1416145620'),(735,1,'作业上传','作业上传',0,'folder','/home/jianlongli/SNSCloud/data/c_53/private/','/home/jianlongli/SNSCloud/data/c_53/private/',0,'1416145620','1416145620'),(736,1,'通知文件','通知文件',0,'folder','/home/jianlongli/SNSCloud/data/c_53/private/','/home/jianlongli/SNSCloud/data/c_53/private/',0,'1416145620','1416145620'),(737,1,'圈主分享','圈主分享',0,'folder','/home/jianlongli/SNSCloud/data/c_54/private/','/home/jianlongli/SNSCloud/data/c_54/private/',0,'1416145725','1416145725'),(738,1,'通知公告','通知公告',0,'folder','/home/jianlongli/SNSCloud/data/c_54/private/','/home/jianlongli/SNSCloud/data/c_54/private/',0,'1416145725','1416145725'),(739,1,'作业上传','作业上传',0,'folder','/home/jianlongli/SNSCloud/data/c_54/private/','/home/jianlongli/SNSCloud/data/c_54/private/',0,'1416145725','1416145725'),(740,1,'通知文件','通知文件',0,'folder','/home/jianlongli/SNSCloud/data/c_54/private/','/home/jianlongli/SNSCloud/data/c_54/private/',0,'1416145725','1416145725'),(741,1,'圈主分享','圈主分享',0,'folder','/home/jianlongli/SNSCloud/data/c_55/private/','/home/jianlongli/SNSCloud/data/c_55/private/',0,'1416145763','1416145763'),(742,1,'通知公告','通知公告',0,'folder','/home/jianlongli/SNSCloud/data/c_55/private/','/home/jianlongli/SNSCloud/data/c_55/private/',0,'1416145763','1416145763'),(743,1,'作业上传','作业上传',0,'folder','/home/jianlongli/SNSCloud/data/c_55/private/','/home/jianlongli/SNSCloud/data/c_55/private/',0,'1416145763','1416145763'),(744,1,'通知文件','通知文件',0,'folder','/home/jianlongli/SNSCloud/data/c_55/private/','/home/jianlongli/SNSCloud/data/c_55/private/',0,'1416145763','1416145763'),(745,1,'u=3168940508,2777398221&fm=23&gp=0.jpg','u=3168940508,2777398221&fm=23&gp=0.jpg',11044,'file','/home/jianlongli/SNSCloud/data/c_55/private/1416145805.jpg','/home/jianlongli/SNSCloud/data/c_55/private/1416145805.jpg',0,'1416145805','1416145805'),(746,1,'u=2212153206,3709472511&fm=23&gp=0.jpg','u=2212153206,3709472511&fm=23&gp=0.jpg',14868,'file','/home/jianlongli/SNSCloud/data/c_55/private/1416145817.jpg','/home/jianlongli/SNSCloud/data/c_55/private/1416145817.jpg',0,'1416145817','1416145817'),(747,1,'u=47152479,1925326072&fm=23&gp=0.jpg','u=47152479,1925326072&fm=23&gp=0.jpg',17927,'file','/home/jianlongli/SNSCloud/data/c_55/private/1416145817.jpg','/home/jianlongli/SNSCloud/data/c_55/private/1416145817.jpg',0,'1416145817','1416145817'),(748,1,'u=3605270022,3248072682&fm=23&gp=0.jpg','u=3605270022,3248072682&fm=23&gp=0.jpg',13649,'file','/home/jianlongli/SNSCloud/data/c_55/private/1416145817.jpg','/home/jianlongli/SNSCloud/data/c_55/private/1416145817.jpg',0,'1416145817','1416145817'),(749,1,'李建栋-Php工程师（社区技术部）2014年11月24日入职.docx','李建栋-Php工程师（社区技术部）2014年11月24日入职.docx',154690,'file','/home/jianlongli/SNSCloud/data/c_55/private/1416145820.docx','/home/jianlongli/SNSCloud/data/c_55/private/1416145820.docx',0,'1416145820','1416145820'),(750,1,'u=2212153206,3709472511&fm=23&gp=0.jpg','u=2212153206,3709472511&fm=23&gp=0.jpg',14868,'file','/home/jianlongli/SNSCloud/data/1/private/1416190250.jpg','/home/jianlongli/SNSCloud/data/1/private/1416190250.jpg',0,'1416190250','1416190250'),(751,1,'2014-11-17—提交微课程作业','2014-11-17—提交微课程作业',0,'folder','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/223/','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/223/',0,'1416190628','1416190628'),(752,1,'2014-11-17—提交微课程作业','2014-11-17—提交微课程作业',0,'folder','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/224/','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/224/',0,'1416190630','1416190630'),(753,1,'2014-11-17—提交微课程作业','2014-11-17—提交微课程作业',0,'folder','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/225/','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/225/',0,'1416190631','1416190631'),(754,1,'2014-11-17—提交微课程作业','2014-11-17—提交微课程作业',0,'folder','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/226/','/home/jianlongli/SNSCloud/data/c_54/private/作业上传/226/',0,'1416190634','1416190634'),(755,1,'','',0,'folder','/home/jianlongli/SNSCloud/data/c_50/private/1416190695','/home/jianlongli/SNSCloud/data/c_50/private/1416190695',0,'1416190695','1416190695'),(756,1,'Jellyfish.jpg','Jellyfish.jpg',194772,'file','/home/jianlongli/SNSCloud/data/c_50/private/1416190718.jpg','/home/jianlongli/SNSCloud/data/c_50/private/1416190718.jpg',0,'1416190718','1416190718'),(757,1,'','',0,'folder','/home/jianlongli/SNSCloud/data/1/private//1416190737','/home/jianlongli/SNSCloud/data/1/private//1416190737',0,'1416190737','1416190737'),(758,1,'2014-11-17—提交微课程作业','2014-11-17—提交微课程作业',0,'folder','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/231/','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/231/',0,'1416190813','1416190813'),(759,1,'2014-11-17—提交微课程作业','2014-11-17—提交微课程作业',0,'folder','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/232/','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/232/',0,'1416190814','1416190814'),(760,1,'2014-11-17—提交微课程作业','2014-11-17—提交微课程作业',0,'folder','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/233/','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/233/',0,'1416190815','1416190815'),(761,1,'2014-11-17—提交微课程作业','2014-11-17—提交微课程作业',0,'folder','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/234/','/home/jianlongli/SNSCloud/data/c_53/private/作业上传/234/',0,'1416190816','1416190816'),(762,1,'2014-11-17—提交微课程作业','2014-11-17—提交微课程作业',0,'folder','/home/jianlongli/SNSCloud/data/c_50/private/作业上传/235/','/home/jianlongli/SNSCloud/data/c_50/private/作业上传/235/',0,'1416191037','1416191037'),(763,34,'我的G盘','我的G盘',0,'folder','/home/jianlongli/SNSCloud/data/34/private','/home/jianlongli/SNSCloud/data/34/private',0,'1416191336','1416191336'),(764,34,'我收到的分享','我收到的分享',0,'folder','/home/jianlongli/SNSCloud/data/34/public','/home/jianlongli/SNSCloud/data/34/public',0,'1416191336','1416191336'),(765,35,'我的G盘','我的G盘',0,'folder','/home/jianlongli/SNSCloud/data/35/private','/home/jianlongli/SNSCloud/data/35/private',0,'1416191694','1416191694'),(766,35,'我收到的分享','我收到的分享',0,'folder','/home/jianlongli/SNSCloud/data/35/public','/home/jianlongli/SNSCloud/data/35/public',0,'1416191694','1416191694'),(767,36,'我的G盘','我的G盘',0,'folder','/home/jianlongli/SNSCloud/data/36/private','/home/jianlongli/SNSCloud/data/36/private',0,'1416192057','1416192057'),(768,36,'我收到的分享','我收到的分享',0,'folder','/home/jianlongli/SNSCloud/data/36/public','/home/jianlongli/SNSCloud/data/36/public',0,'1416192057','1416192057');
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
) ENGINE=InnoDB AUTO_INCREMENT=703 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_cmm_logs`
--

LOCK TABLES `sns_cmm_logs` WRITE;
/*!40000 ALTER TABLE `sns_cmm_logs` DISABLE KEYS */;
INSERT INTO `sns_cmm_logs` VALUES (394,1,NULL,'新建文件夹新建文件夹','392','192.168.0.210',NULL,'1410318944'),(395,1,NULL,'新建文件夹新建文件夹(0)','393','192.168.0.210',NULL,'1410318945'),(396,1,NULL,'新建文件newfile.txt','394','192.168.0.210',NULL,'1410318947'),(397,1,NULL,'新建文件夹新建文件夹(1)','395','192.168.0.210',NULL,'1410318948'),(398,1,NULL,'修改文件名新建文件夹为TEST','392','192.168.0.210',NULL,'1410318954'),(399,1,NULL,'修改文件名新建文件夹(0)为TEST1','393','192.168.0.210',NULL,'1410318959'),(400,1,NULL,'修改文件名新建文件夹(1)为TEST2','395','192.168.0.210',NULL,'1410318962'),(401,1,NULL,'新建文件夹新建文件夹','396','192.168.0.210',NULL,'1410338038'),(402,1,NULL,'新建文件夹新建文件夹(0)','397','192.168.0.210',NULL,'1410338045'),(403,1,NULL,'新建文件newfile.txt','398','192.168.0.210',NULL,'1410338047'),(404,1,NULL,'新建文件夹新建文件夹','399','192.168.0.210',NULL,'1410340068'),(405,1,NULL,'新建文件夹新建文件夹(0)','400','192.168.0.210',NULL,'1410340072'),(406,1,NULL,'新建文件夹新建文件夹','401','192.168.0.210',NULL,'1410340081'),(407,1,NULL,'新建文件newfile.txt','402','192.168.0.210',NULL,'1410340083'),(408,1,NULL,'新建文件newfile.txt',NULL,'192.168.0.210',NULL,'1410340087'),(409,1,NULL,'新建文件newfile(0).txt','403','192.168.0.210',NULL,'1410340098'),(410,1,NULL,'新建文件newfile.txt','404','192.168.0.210',NULL,'1410340102'),(411,1,NULL,'新建文件newfile(0).txt','405','192.168.0.210',NULL,'1410340110'),(412,1,NULL,'新建文件newfile.txt','406','192.168.0.210',NULL,'1410340115'),(413,1,NULL,'新建文件newfile(0).txt','407','192.168.0.210',NULL,'1410340117'),(414,1,NULL,'新建文件newfile(1).txt','408','192.168.0.210',NULL,'1410340120'),(415,1,NULL,'新建文件newfile.txt','409','192.168.0.210',NULL,'1410340136'),(416,1,NULL,'新建文件newfile(2).txt','410','192.168.0.210',NULL,'1410340148'),(417,1,NULL,'新建文件newfile(1).txt',NULL,'192.168.0.210',NULL,'1410340350'),(418,1,NULL,'新建文件newfile(1).txt',NULL,'192.168.0.210',NULL,'1410340355'),(419,1,NULL,'新建文件newfile(3).txt','411','192.168.0.210',NULL,'1410340362'),(420,1,NULL,'新建文件newfile(1).txt',NULL,'192.168.0.210',NULL,'1410340366'),(421,1,NULL,'新建文件newfile(1).txt',NULL,'192.168.0.210',NULL,'1410340375'),(422,1,NULL,'新建文件夹新建文件夹','412','192.168.0.210',NULL,'1410340444'),(423,1,NULL,'新建文件夹新建文件夹(1)','413','192.168.0.210',NULL,'1410340450'),(424,1,NULL,'新建文件newfile.txt','414','192.168.0.210',NULL,'1410340453'),(425,1,NULL,'新建文件newfile(0).txt','415','192.168.0.210',NULL,'1410340455'),(426,1,NULL,'新建文件newfile(1).txt','416','192.168.0.210',NULL,'1410340460'),(427,1,NULL,'新建文件newfile(4).txt','417','192.168.0.210',NULL,'1410340464'),(428,1,NULL,'新建文件夹新建文件夹','418','192.168.0.210',NULL,'1410340469'),(429,1,NULL,'新建文件newfile(1).txt',NULL,'192.168.0.210',NULL,'1410340503'),(430,1,NULL,'新建文件newfile(2).txt','419','192.168.0.210',NULL,'1410340577'),(431,1,NULL,'新建文件夹新建文件夹','420','192.168.0.210',NULL,'1410340589'),(432,1,NULL,'新建文件newfile(5).txt','421','192.168.0.210',NULL,'1410340593'),(433,1,NULL,'新建文件newfile(3).txt','422','192.168.0.210',NULL,'1410340596'),(434,1,NULL,'新建文件夹新建文件夹(2)','423','192.168.0.210',NULL,'1410340605'),(435,1,NULL,'新建文件newfile.txt','424','192.168.0.210',NULL,'1410340607'),(436,1,NULL,'新建文件newfile(6).txt','425','192.168.0.210',NULL,'1410340612'),(437,1,NULL,'新建文件夹新建文件夹(3)','426','192.168.0.210',NULL,'1410340615'),(438,1,NULL,'新建文件newfile(7).txt','427','192.168.0.210',NULL,'1410340620'),(439,1,NULL,'上传文件美家SSL VPN用户指南.doc','428','192.168.0.210',NULL,'1410425222'),(440,1,NULL,'上传文件touxiang.jpg','429','192.168.0.210',NULL,'1410770656'),(441,1,NULL,'新建文件夹新建文件夹',NULL,'192.168.0.210',NULL,'1411030179'),(442,1,NULL,'新建文件newfile(0).txt','430','192.168.0.210',NULL,'1411030186'),(443,1,NULL,'新建文件夹新建文件夹',NULL,'192.168.0.210',NULL,'1411030190'),(444,1,NULL,'新建文件夹新建文件夹','431','192.168.0.201',NULL,'1411366266'),(445,1,NULL,'新建文件newfile.txt','432','192.168.0.201',NULL,'1411366267'),(446,1,NULL,'新建文件newfile.txt','433','192.168.0.201',NULL,'1411366269'),(447,1,NULL,'新建文件newfile(0).txt','434','192.168.0.201',NULL,'1411366475'),(448,1,NULL,'新建文件tt.txt','435','192.168.0.201',NULL,'1411366753'),(449,1,NULL,'新建文件夹新建文件夹(0)','436','192.168.0.210',NULL,'1412733536'),(450,1,NULL,'新建文件newfile.txt','437','192.168.0.210',NULL,'1412733731'),(451,1,NULL,'修改文件名newfile(0).txt为newfile(01).txt','434','192.168.0.210',NULL,'1412756650'),(452,1,NULL,'修改文件名newfile.txt为newfile11.txt','433','192.168.0.210',NULL,'1412756972'),(453,1,NULL,'新建文件newfile02.txt','438','192.168.0.210',NULL,'1412756986'),(454,1,NULL,'新建文件newfile22.txt','439','192.168.0.210',NULL,'1412756992'),(455,1,NULL,'新建文件jackie.txt','440','125.39.30.9',NULL,'1412931808'),(456,1,NULL,'新建文件.txt','441','125.39.30.9',NULL,'1412931808'),(457,1,NULL,'新建文件夹jackie','442','127.0.0.1',NULL,'1413116453'),(458,9,NULL,'新建文件夹','443','127.0.0.1',NULL,'1413117423'),(459,9,NULL,'新建文件夹','444','127.0.0.1',NULL,'1413117423'),(460,9,NULL,'上传文件IMG_0533.JPG','445','127.0.0.1',NULL,'1413117513'),(461,1,NULL,'新建文件newfile.txt','446','127.0.0.1',NULL,'1413340878'),(462,13,NULL,'新建文件夹','447','221.217.54.4',NULL,'1414159924'),(463,13,NULL,'新建文件夹','448','221.217.54.4',NULL,'1414159924'),(464,1,NULL,'新建文件夹',NULL,'106.39.255.22',NULL,'1414639434'),(465,1,NULL,'粘贴文件：newfile22.txt为newfile22副本.txt','439','106.39.255.22',NULL,'1414639441'),(466,1,NULL,'新建文件夹111','450','106.39.255.22',NULL,'1414639444'),(467,1,NULL,'粘贴文件：111为111副本','450','106.39.255.22',NULL,'1414639461'),(468,1,NULL,'上传文件微平台1.jpg','452','106.39.255.22',NULL,'1414639462'),(469,1,NULL,'上传文件微信截图1.doc','453','106.39.255.22',NULL,'1414639462'),(470,1,NULL,'上传文件高碑店中心小学微平台.doc','454','106.39.255.22',NULL,'1414639462'),(471,1,NULL,'粘贴文件：111副本为111副本副本','451','106.39.255.22',NULL,'1414639479'),(472,1,NULL,'上传文件项目审批表（高碑店）.doc','456','106.39.255.22',NULL,'1414639481'),(473,1,NULL,'新建文件夹123','457','106.39.255.22',NULL,'1414639534'),(474,1,NULL,'上传文件微信截图1.doc','458','106.39.255.22',NULL,'1414639547'),(475,1,NULL,'粘贴文件：微信截图1.doc为微信截图1副本.doc','458','106.39.255.22',NULL,'1414639683'),(476,1,NULL,'粘贴文件：123为123副本','457','106.39.255.22',NULL,'1414639699'),(477,1,NULL,'上传文件4560595_163009280134_2.jpg','462','111.204.59.2',NULL,'1414983040'),(478,1,NULL,'新建文件夹',NULL,'111.204.59.2',NULL,'1414983061'),(479,1,NULL,'上传文件4560595_163009280134_2(1).jpg','463','111.204.59.2',NULL,'1414983081'),(480,1,NULL,'新建文件newfile.txt','464','60.10.96.9',NULL,'1415064560'),(481,1,NULL,'新建文件夹新建文件夹','465','60.10.96.9',NULL,'1415064563'),(482,NULL,NULL,'新建文件newfile.txt',NULL,'180.153.214.1',NULL,'1415065167'),(483,NULL,NULL,'新建文件夹??',NULL,'180.153.201.1',NULL,'1415065176'),(484,1,NULL,'上传文件9a789c84jw1ei8lfrqp6zj203t03t742.jpg','466','60.10.96.9',NULL,'1415326176'),(485,1,NULL,'新建文件夹1233333','467','58.135.96.253',NULL,'1415706152'),(486,NULL,NULL,'新建文件夹22',NULL,'180.153.206.2',NULL,'1415706216'),(487,1,NULL,'新建文件qqqqqq.txt','468','58.135.96.253',NULL,'1415706224'),(488,1,NULL,'新建文件夹we','469','58.135.96.253',NULL,'1415706337'),(489,1,NULL,'新建文件夹s','470','125.39.20.13',NULL,'1415706353'),(490,1,NULL,'新建文件ssss.txt','471','125.39.20.13',NULL,'1415706382'),(491,1,NULL,'新建文件aaa.txt','472','125.39.20.13',NULL,'1415706400'),(492,NULL,NULL,'新建文件qqqqqq.txt',NULL,'180.153.211.1',NULL,'1415706542'),(493,NULL,NULL,'新建文件夹1233333',NULL,'180.153.206.3',NULL,'1415706562'),(494,NULL,NULL,'新建文件aaa.txt',NULL,'180.153.205.2',NULL,'1415706617'),(495,NULL,NULL,'新建文件ssss.txt',NULL,'112.64.235.86',NULL,'1415706720'),(496,NULL,NULL,'新建文件夹we',NULL,'101.226.33.20',NULL,'1415706864'),(497,NULL,NULL,'新建文件',NULL,'180.153.201.2',NULL,'1415707111'),(498,NULL,NULL,'新建文件夹??',NULL,'180.153.163.1',NULL,'1415707585'),(499,NULL,NULL,'新建文件夹s',NULL,'112.64.235.24',NULL,'1415708405'),(500,1,NULL,'新建文件newfile.txt','473','125.39.20.13',NULL,'1415709293'),(501,1,NULL,'新建文件111111.txt','474','125.39.20.13',NULL,'1415709437'),(502,1,NULL,'新建文件wgh.txt','475','125.39.20.13',NULL,'1415709968'),(503,1,NULL,'新建文件aaaaaaa.txt',NULL,'125.39.20.13',NULL,'1415710207'),(504,1,NULL,'新建文件wgh.txt',NULL,'125.39.20.13',NULL,'1415710337'),(505,1,NULL,'新建文件wwwwwwww.txt',NULL,'125.39.20.13',NULL,'1415710468'),(506,1,NULL,'新建文件.txt',NULL,'125.39.20.13',NULL,'1415710725'),(507,1,NULL,'新建文件???.txt',NULL,'125.39.20.13',NULL,'1415710741'),(508,1,NULL,'新建文件aaaddd.txt',NULL,'125.39.20.13',NULL,'1415710982'),(509,1,NULL,'新建文件232323.txt',NULL,'125.39.20.13',NULL,'1415711075'),(510,1,NULL,'新建文件1234321.txt',NULL,'125.39.20.13',NULL,'1415711136'),(511,1,NULL,'新建文件fdsafdsa.txt',NULL,'125.39.20.13',NULL,'1415711244'),(512,1,NULL,'新建文件2332323232323fdsd.txt','524','125.39.20.13',NULL,'1415711270'),(513,1,NULL,'新建文件232311111111111111.txt','11','125.39.20.13',NULL,'1415711415'),(514,1,NULL,'新建文件lijianlong.txt','12','58.135.96.253',NULL,'1415754128'),(515,1,NULL,'新建文件wgg.txt','13','58.135.96.253',NULL,'1415755733'),(516,1,NULL,'新建文件11111111.txt','14','58.135.96.253',NULL,'1415755815'),(517,1,NULL,'新建文件3333.txt','15','58.135.96.253',NULL,'1415755961'),(518,1,NULL,'新建文件55555.txt','16','58.135.96.253',NULL,'1415755997'),(519,1,NULL,'新建文件123.txt','17','58.135.96.253',NULL,'1415758142'),(520,1,NULL,'新建文件wangguohui.txt','18','58.135.96.253',NULL,'1415758283'),(521,1,NULL,'新建文件123.txt','19','58.135.96.253',NULL,'1415758393'),(522,1,NULL,'新建文件fsda.txt','20','58.135.96.253',NULL,'1415758415'),(523,1,NULL,'新建文件333.txt','21','58.135.96.253',NULL,'1415758442'),(524,1,NULL,'新建文件wwww.txt','22','58.135.96.253',NULL,'1415758490'),(525,1,NULL,'新建文件qwert.txt','23','58.135.96.253',NULL,'1415758651'),(526,1,NULL,'新建文件夹新建文件夹',NULL,'58.135.96.253',NULL,'1415759868'),(527,1,NULL,'新建文件夹33',NULL,'58.135.96.253',NULL,'1415759876'),(528,1,NULL,'新建文件2.txt','26','58.135.96.253',NULL,'1415759900'),(529,1,NULL,'新建文件789.txt','27','58.135.96.253',NULL,'1415760056'),(530,1,NULL,'新建文件12222.txt','28','58.135.96.253',NULL,'1415760369'),(531,1,NULL,'新建文件222.txt','29','58.135.96.253',NULL,'1415760686'),(532,1,NULL,'新建文件夹222',NULL,'58.135.96.253',NULL,'1415760691'),(533,1,NULL,'新建文件夹1',NULL,'58.135.96.253',NULL,'1415760808'),(534,1,NULL,'新建文件1.txt','32','58.135.96.253',NULL,'1415760821'),(535,1,NULL,'新建文件2.txt','33','58.135.96.253',NULL,'1415760829'),(536,1,NULL,'新建文件newfile.txt','38','58.135.96.253',NULL,'1415764772'),(537,1,NULL,'新建文件夹7410',NULL,'58.135.96.253',NULL,'1415768350'),(538,1,NULL,'新建文件14.txt','40','58.135.96.253',NULL,'1415768354'),(539,1,NULL,'新建文件夹2',NULL,'58.135.96.253',NULL,'1415847421'),(540,1,NULL,'新建文件3.txt','42','58.135.96.253',NULL,'1415847424'),(541,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg','476','58.135.96.253',NULL,'1415850084'),(542,1,NULL,'上传文件9a789c84jw1ei8lfpv3kfj203t03twea.jpg','477','58.135.96.253',NULL,'1415851346'),(543,1,NULL,'上传文件9a789c84jw1ei8lfpv3kfj203t03twea(1).jpg','478','58.135.96.253',NULL,'1415851551'),(544,1,NULL,'上传文件9a789c84jw1ei8lfn2bwoj203t03t743.jpg','479','58.135.96.253',NULL,'1415851726'),(545,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2(1).jpg','480','58.135.96.253',NULL,'1415851829'),(546,1,NULL,'上传文件9a789c84jw1ei8lfqgoc7j203t03ta9w.jpg','481','58.135.96.253',NULL,'1415851850'),(547,1,NULL,'上传文件9a789c84jw1ei8lfpv3kfj203t03twea(2).jpg','43','58.135.96.253',NULL,'1415852511'),(548,1,NULL,'上传文件9a789c84jw1ei8lfqgoc7j203t03ta9w(1).jpg','44','58.135.96.253',NULL,'1415852825'),(549,1,NULL,'上传文件9a789c84jw1ei8lfqgoc7j203t03ta9w(1).jpg',NULL,'58.135.96.253',NULL,'1415852997'),(550,1,NULL,'上传文件2014-08-01 142906.jpg','45','58.135.96.253',NULL,'1415853004'),(551,1,NULL,'上传文件u=2480630092,903555759&fm=23&gp=0.jpg','46','58.135.96.253',NULL,'1415853016'),(552,1,NULL,'上传文件u=1244919793,2738276886&fm=21&gp=0.jpg','47','58.135.96.253',NULL,'1415853155'),(553,1,NULL,'上传文件u=618901619,451241923&fm=21&gp=0.jpg','48','58.135.96.253',NULL,'1415853164'),(554,1,NULL,'上传文件u=602268829,4092577061&fm=21&gp=0.jpg','49','58.135.96.253',NULL,'1415853278'),(555,1,NULL,'上传文件9a789c84jw1ei8lfnoyg5j203t03tt8j.jpg','50','58.135.96.253',NULL,'1415853339'),(556,1,NULL,'上传文件IMG_0990.JPG','51','58.135.96.253',NULL,'1415853428'),(557,1,NULL,'上传文件1293081727802493600sgyprc.jpg','52','58.135.96.253',NULL,'1415853456'),(558,1,NULL,'上传文件9a789c84jw1ei8lfn2bwoj203t03t743(1).jpg','53','58.135.96.253',NULL,'1415853748'),(559,1,NULL,'上传文件big_load.gif','54','58.135.96.253',NULL,'1415853775'),(560,1,NULL,'上传文件u=1267552447,2850713388&fm=21&gp=0.jpg','55','58.135.96.253',NULL,'1415853810'),(561,1,NULL,'上传文件IMG_0989.JPG','56','58.135.96.253',NULL,'1415853881'),(562,1,NULL,'上传文件u=1244919793,2738276886&fm=21&gp=0.jpg',NULL,'58.135.96.253',NULL,'1415853967'),(563,1,NULL,'上传文件IMG_1023.JPG','57','58.135.96.253',NULL,'1415854979'),(564,1,NULL,'上传文件IMG_1024.JPG','58','58.135.96.253',NULL,'1415855040'),(565,1,NULL,'上传文件meinv.jpg','59','58.135.96.253',NULL,'1415855116'),(566,1,NULL,'上传文件IMG_1014.JPG','60','58.135.96.253',NULL,'1415855259'),(567,1,NULL,'上传文件u=3266555805,2793575685&fm=21&gp=0.jpg','61','58.135.96.253',NULL,'1415857451'),(568,1,NULL,'上传文件u=1861648481,3545943421&fm=21&gp=0.jpg','62','58.135.96.253',NULL,'1415857493'),(569,1,NULL,'上传文件IMG_1026.JPG','63','58.135.96.253',NULL,'1415857506'),(570,1,NULL,'上传文件IMG_1028.JPG','64','58.135.96.253',NULL,'1415857526'),(571,1,NULL,'上传文件u=2480630092,903555759&fm=23&gp=0.jpg',NULL,'58.135.96.253',NULL,'1415857583'),(572,1,NULL,'上传文件IMG_1024.JPG',NULL,'58.135.96.253',NULL,'1415857618'),(573,1,NULL,'上传文件9a789c84jw1ei8lfqgoc7j203t03ta9w.jpg','65','58.135.96.253',NULL,'1415858578'),(574,1,NULL,'上传文件9a789c84jw1ei8lfr32ooj203t03ta9y.jpg','66','58.135.96.253',NULL,'1415858762'),(575,1,NULL,'新建文件newfile.txt','67','58.135.96.253',NULL,'1415859530'),(576,1,NULL,'新建文件2.txt','68','58.135.96.253',NULL,'1415859542'),(577,1,NULL,'新建文件夹新建文件夹',NULL,'58.135.96.253',NULL,'1415859575'),(578,1,NULL,'新建文件夹新建文件夹',NULL,'58.135.96.253',NULL,'1415859672'),(579,1,NULL,'新建文件新建文件夹','70','58.135.96.253',NULL,'1415859674'),(580,1,NULL,'新建文件嗖嗖嗖.txt','71','58.135.96.253',NULL,'1415859679'),(581,1,NULL,'上传文件IMG_1014.JPG','72','58.135.96.253',NULL,'1415859686'),(582,1,NULL,'上传文件u=2480630092,903555759&fm=23&gp=0.jpg','73','58.135.96.253',NULL,'1415859865'),(583,1,NULL,'上传文件9a789c84jw1ei8lfn2bwoj203t03t743.jpg','74','58.135.96.253',NULL,'1415860025'),(584,1,NULL,'上传文件9a789c84jw1ei8lflumptj203t03tjr9.jpg','75','58.135.96.253',NULL,'1415860053'),(585,1,NULL,'上传文件9a789c84jw1ei8lfmfheyj203t03tjra.jpg','76','58.135.96.253',NULL,'1415860117'),(586,1,NULL,'上传文件9a789c84jw1ei8lfn2bwoj203t03t743.jpg',NULL,'58.135.96.253',NULL,'1415860125'),(587,1,NULL,'上传文件IMG_1014.JPG',NULL,'58.135.96.253',NULL,'1415860130'),(588,1,NULL,'上传文件9a789c84jw1ei8lfrqp6zj203t03t742.jpg','77','58.135.96.253',NULL,'1415860147'),(589,1,NULL,'上传文件9a789c84jw1ei8lfpv3kfj203t03twea.jpg','78','58.135.96.253',NULL,'1415860223'),(590,1,NULL,'上传文件9a789c84jw1ei8lfmfheyj203t03tjra.jpg',NULL,'58.135.96.253',NULL,'1415860288'),(591,1,NULL,'上传文件9a789c84jw1ei8lfpv3kfj203t03twea(2).jpg',NULL,'58.135.96.253',NULL,'1415860491'),(592,1,NULL,'上传文件9a789c84jw1ei8lflumptj203t03tjr9.jpg','83','58.135.96.253',NULL,'1415860774'),(593,1,NULL,'上传文件9a789c84jw1ei8lflumptj203t03tjr9.jpg','84','58.135.96.253',NULL,'1415860982'),(594,1,NULL,'上传文件9a789c84jw1ei8lfrqp6zj203t03t742.jpg','85','58.135.96.253',NULL,'1415861295'),(595,1,NULL,'上传文件9a789c84jw1ei8lfqgoc7j203t03ta9w.jpg','86','58.135.96.253',NULL,'1415861479'),(596,1,NULL,'上传文件9a789c84jw1ei8lfn2bwoj203t03t743.jpg','87','58.135.96.253',NULL,'1415861594'),(597,1,NULL,'上传文件1293081727802493600sgyprc.jpg','88','58.135.96.253',NULL,'1415861714'),(598,1,NULL,'上传文件9a789c84jw1ei8lfqgoc7j203t03ta9w.jpg',NULL,'58.135.96.253',NULL,'1415861792'),(599,1,NULL,'上传文件9a789c84jw1ei8lfmfheyj203t03tjra.jpg','93','58.135.96.253',NULL,'1415862067'),(600,1,NULL,'上传文件9a789c84jw1ei8lflumptj203t03tjr9.jpg','94','58.135.96.253',NULL,'1415862295'),(601,1,NULL,'上传文件9a789c84jw1ei8lfn2bwoj203t03t743.jpg','95','123.126.112.4',NULL,'1415862462'),(602,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg','100','125.39.30.9',NULL,'1415862639'),(603,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg',NULL,'125.39.30.9',NULL,'1415863933'),(604,1,NULL,'上传文件77e99298gw1em1jbkngizg20b408a16i.gif','101','125.39.30.9',NULL,'1415863942'),(605,1,NULL,'上传文件u=618901619,451241923&fm=21&gp=0.jpg','102','125.39.30.9',NULL,'1415863974'),(606,1,NULL,'上传文件2014-08-03 103304.jpg','103','125.39.30.9',NULL,'1415864144'),(607,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg','482','125.39.30.9',NULL,'1415864897'),(608,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本.jpg','100','125.39.30.9',NULL,'1415866018'),(609,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本.jpg','100','125.39.30.9',NULL,'1415866612'),(610,1,NULL,'粘贴文件：77e99298gw1em1jbkngizg20b408a16i.gif为77e99298gw1em1jbkngizg20b408a16i副本.gif','101','125.39.30.9',NULL,'1415866716'),(611,1,NULL,'粘贴文件：77e99298gw1em1jbkngizg20b408a16i.gif为77e99298gw1em1jbkngizg20b408a16i副本.gif','101','58.135.96.253',NULL,'1415925670'),(612,1,NULL,'粘贴文件：2014-08-03 103304.jpg为2014-08-03 103304副本.jpg','103','125.39.30.9',NULL,'1415929926'),(613,1,NULL,'上传文件html图.jpg','109','125.39.30.9',NULL,'1415930008'),(614,1,NULL,'粘贴文件：html图.jpg为html图副本.jpg','109','125.39.30.9',NULL,'1415930056'),(615,1,NULL,'粘贴文件：html图.jpg为html图副本.jpg','109','125.39.30.9',NULL,'1415930515'),(616,1,NULL,'上传文件9a789c84jw1ei8lflumptj203t03tjr9.jpg','116','125.39.30.9',NULL,'1415930787'),(617,1,NULL,'粘贴文件：9a789c84jw1ei8lflumptj203t03tjr9.jpg为9a789c84jw1ei8lflumptj203t03tjr9副本.jpg','116','125.39.30.9',NULL,'1415930856'),(618,1,NULL,'粘贴文件：9a789c84jw1ei8lflumptj203t03tjr9.jpg为9a789c84jw1ei8lflumptj203t03tjr9副本.jpg','116','125.39.30.9',NULL,'1415932128'),(619,1,NULL,'粘贴文件：9a789c84jw1ei8lflumptj203t03tjr9.jpg为9a789c84jw1ei8lflumptj203t03tjr9副本.jpg','116','125.39.30.9',NULL,'1415932324'),(620,1,NULL,'粘贴文件：9a789c84jw1ei8lflumptj203t03tjr9.jpg为9a789c84jw1ei8lflumptj203t03tjr9副本.jpg','116','125.39.30.9',NULL,'1415932410'),(621,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg','121','111.202.8.141',NULL,'1415936339'),(622,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本.jpg','121','111.202.8.141',NULL,'1415936345'),(623,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本(1).jpg','121','111.202.8.141',NULL,'1415936455'),(624,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg',NULL,'111.202.8.141',NULL,'1415937126'),(625,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg',NULL,'111.202.8.141',NULL,'1415937309'),(626,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg',NULL,'111.202.8.141',NULL,'1415937338'),(627,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg',NULL,'111.202.8.141',NULL,'1415937658'),(628,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg',NULL,'111.202.8.141',NULL,'1415937698'),(629,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg',NULL,'111.202.8.141',NULL,'1415937790'),(630,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg',NULL,'111.202.8.141',NULL,'1415937846'),(631,1,NULL,'上传文件9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg','125','111.202.8.141',NULL,'1415938453'),(632,1,NULL,'粘贴文件：9a789c84jw1ei8lflumptj203t03tjr9副本.jpg为9a789c84jw1ei8lflumptj203t03tjr9副本.jpg(2)','120','111.202.8.141',NULL,'1415938583'),(633,1,NULL,'修改文件名9a789c84jw1ei8lflumptj203t03tjr9.jpg为111.jpg','116','111.202.8.141',NULL,'1415939299'),(634,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本.jpg','121','111.202.8.141',NULL,'1415940795'),(635,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2副本.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本副本.jpg','122','111.202.8.141',NULL,'1415940936'),(636,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2副本.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本副本.jpg','122','111.202.8.141',NULL,'1415941160'),(637,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本(2).jpg','121','111.202.8.141',NULL,'1415941167'),(638,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本(1).jpg','121','111.202.8.141',NULL,'1415941222'),(639,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2副本(1).jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本(1)副本.jpg','123','111.202.8.141',NULL,'1415941339'),(640,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本(2).jpg','121','111.202.8.141',NULL,'1415941446'),(641,1,NULL,'粘贴文件：111.jpg为111副本.jpg','116','111.202.8.141',NULL,'1415945598'),(642,1,NULL,'粘贴文件：9a789c84jw1ei8lfpdp3pj203t03tmx2.jpg为9a789c84jw1ei8lfpdp3pj203t03tmx2副本(3).jpg','121','111.202.8.141',NULL,'1415945598'),(643,1,NULL,'粘贴文件：通知公告为通知公告副本','120','111.202.8.141',NULL,'1415945945'),(644,1,NULL,'粘贴文件：9a789c84jw1ei8lflumptj203t03tjr9副本.jpg为9a789c84jw1ei8lflumptj203t03tjr9副本副本.jpg','120','111.202.8.141',NULL,'1415946010'),(645,1,NULL,'上传文件fd039245d688d43faa1d06647d1ed21b0ff43beb.jpg','137','111.202.8.141',NULL,'1415946323'),(646,1,NULL,'粘贴文件：通知文件为通知文件副本','137','111.202.8.141',NULL,'1415946530'),(647,1,NULL,'粘贴文件：作业上传为作业上传副本','114','111.202.8.141',NULL,'1415946863'),(648,1,NULL,'上传文件fd039245d688d43faa1d06647d1ed21b0ff43beb.jpg','144','111.202.8.141',NULL,'1415947101'),(649,1,NULL,'粘贴文件：fd039245d688d43faa1d06647d1ed21b0ff43beb.jpg为fd039245d688d43faa1d06647d1ed21b0ff43beb副本.jpg','144','111.202.8.141',NULL,'1415947107'),(650,1,NULL,'粘贴文件：作业上传为作业上传副本','142','111.202.8.141',NULL,'1415947132'),(651,1,NULL,'上传文件1293081727802493600sgyprc.jpg','147','111.202.8.141',NULL,'1415947466'),(652,1,NULL,'粘贴文件：作业上传为作业上传副本(1)','142','111.202.8.141',NULL,'1415947491'),(653,1,NULL,'上传文件IMG_1014.JPG','149','111.202.8.141',NULL,'1415947653'),(654,1,NULL,'新建文件啊.css','150','111.202.8.141',NULL,'1415947765'),(655,1,NULL,'新建文件我.txt','151','111.202.8.141',NULL,'1415947826'),(656,1,NULL,'新建文件夹好看',NULL,'111.202.8.141',NULL,'1415947835'),(657,1,NULL,'上传文件u=1267552447,2850713388&fm=21&gp=0.jpg','153','111.202.8.141',NULL,'1415950840'),(658,1,NULL,'上传文件u=4185435809,4139567692&fm=21&gp=0.jpg','154','111.202.8.141',NULL,'1415950860'),(659,1,NULL,'上传文件meinv.jpg','155','111.202.8.141',NULL,'1415950885'),(660,1,NULL,'上传文件GitHub.appref-ms','156','111.202.8.141',NULL,'1415952417'),(661,1,NULL,'修改文件名u=4185435809,4139567692&fm=21&gp=0.jpg为1.jpg','154','111.202.8.141',NULL,'1415953377'),(662,1,NULL,'修改文件名u=1267552447,2850713388&fm=21&gp=0.jpg为8888.jpg','153','114.113.123.3',NULL,'1415974946'),(663,1,NULL,'上传文件xbzs_014.jpg','157','114.113.123.3',NULL,'1415981293'),(664,1,NULL,'上传文件Webshots011.jpg','158','114.113.123.3',NULL,'1415981553'),(665,1,NULL,'修改文件名1293081727802493600sgyprc.jpg为789.jpg','147','114.113.123.3',NULL,'1415994579'),(666,1,NULL,'修改文件名IMG_1014.JPG为5665.JPG','149','114.113.123.3',NULL,'1415994582'),(667,1,NULL,'修改文件名Webshots011.jpg为66.jpg','158','114.113.123.3',NULL,'1415994585'),(668,1,NULL,'修改文件名xbzs_014.jpg为666.jpg','157','114.113.123.3',NULL,'1415994597'),(669,1,NULL,'上传文件c0157304aedf986794ca6b5e.jpg','159','114.113.123.3',NULL,'1415995029'),(670,1,NULL,'上传文件Webshots002.jpg','160','114.113.123.3',NULL,'1415995149'),(671,1,NULL,'上传文件19132114-1-63E8.jpg','161','114.113.123.3',NULL,'1415995400'),(672,1,NULL,'上传文件20110510095242384.jpg','162','114.113.123.3',NULL,'1415995485'),(673,1,NULL,'上传文件19132114-1-63E8.jpg','163','114.113.123.3',NULL,'1415995517'),(674,1,NULL,'上传文件19132114-1-63E8.jpg',NULL,'114.113.123.3',NULL,'1415995548'),(675,1,NULL,'上传文件19132114-1-63E8.jpg',NULL,'114.113.123.3',NULL,'1415995560'),(676,1,NULL,'上传文件Webshots014.jpg','164','114.113.123.3',NULL,'1415995569'),(677,1,NULL,'上传文件5bd39c2749c414f74723e8c8.jpg','165','114.113.123.3',NULL,'1415995624'),(678,1,NULL,'上传文件573601058f8e4f9b09fa9302.jpg','166','114.113.123.3',NULL,'1415995659'),(679,1,NULL,'上传文件111111.JPG','171','123.117.45.87',NULL,'1416118151'),(680,1,NULL,'粘贴文件：好看为好看副本','152','123.117.45.87',NULL,'1416137265'),(681,1,NULL,'粘贴文件：1.jpg为1副本.jpg','154','123.117.45.87',NULL,'1416137273'),(682,1,NULL,'上传文件Desert.jpg','175','123.117.45.87',NULL,'1416137376'),(683,1,NULL,'修改文件名Desert.jpg为tt.jpg','175','123.117.45.87',NULL,'1416137403'),(684,1,NULL,'新建文件夹新建文件夹',NULL,'123.117.42.8',NULL,'1416142354'),(685,1,NULL,'新建文件newfile.txt','181','123.117.42.8',NULL,'1416142358'),(686,1,NULL,'上传文件u=1989088287,1387873866&fm=21&gp=0.jpg','182','123.117.42.8',NULL,'1416145517'),(687,1,NULL,'上传文件u=3168940508,2777398221&fm=23&gp=0.jpg','199','123.117.42.8',NULL,'1416145805'),(688,1,NULL,'上传文件u=2212153206,3709472511&fm=23&gp=0.jpg','200','123.117.42.8',NULL,'1416145817'),(689,1,NULL,'上传文件u=47152479,1925326072&fm=23&gp=0.jpg','201','123.117.42.8',NULL,'1416145817'),(690,1,NULL,'上传文件u=3605270022,3248072682&fm=23&gp=0.jpg','202','123.117.42.8',NULL,'1416145817'),(691,1,NULL,'上传文件李建栋-Php工程师（社区技术部）2014年11月24日入职.docx','203','123.117.42.8',NULL,'1416145820'),(692,1,NULL,'上传文件u=2212153206,3709472511&fm=23&gp=0.jpg','1','123.117.39.25',NULL,'1416190250'),(693,1,NULL,'新建文件夹',NULL,'125.39.9.83',NULL,'1416190695'),(694,1,NULL,'修改文件名newfile.txt为2.txt','181','125.39.9.83',NULL,'1416190703'),(695,1,NULL,'上传文件Jellyfish.jpg','209','125.39.9.83',NULL,'1416190718'),(696,1,NULL,'新建文件夹','2','125.39.9.83',NULL,'1416190737'),(697,34,NULL,'新建文件夹','3','125.39.9.83',NULL,'1416191336'),(698,34,NULL,'新建文件夹','4','125.39.9.83',NULL,'1416191336'),(699,35,NULL,'新建文件夹','5','125.39.9.83',NULL,'1416191694'),(700,35,NULL,'新建文件夹','6','125.39.9.83',NULL,'1416191694'),(701,36,NULL,'新建文件夹','7','125.39.9.83',NULL,'1416192057'),(702,36,NULL,'新建文件夹','8','125.39.9.83',NULL,'1416192057');
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
-- Table structure for table `sns_company`
--

DROP TABLE IF EXISTS `sns_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `disid` int(11) DEFAULT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_company`
--

LOCK TABLES `sns_company` WRITE;
/*!40000 ALTER TABLE `sns_company` DISABLE KEYS */;
INSERT INTO `sns_company` VALUES (1,'companyA','1234567890',1,0),(2,'companyB','1234567232',2,0),(3,'companyC','1234567232',3,0),(4,'companyD','3453333',1,1413848214);
/*!40000 ALTER TABLE `sns_company` ENABLE KEYS */;
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
  CONSTRAINT `fk_sns_discussion_comment_sns_ discussion_topic1` FOREIGN KEY (`topicid`) REFERENCES `sns_discussion_topic` (`topicid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_discussion_comment_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_discussion_comment`
--

LOCK TABLES `sns_discussion_comment` WRITE;
/*!40000 ALTER TABLE `sns_discussion_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_discussion_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_discussion_topic`
--

DROP TABLE IF EXISTS `sns_discussion_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_discussion_topic` (
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
  `circleId` int(11) DEFAULT '0' COMMENT '圈子ID',
  PRIMARY KEY (`topicid`),
  KEY `fk_sns_ discussion_topic_sns_member1_idx` (`userid`),
  CONSTRAINT `fk_sns_ discussion_topic_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_discussion_topic`
--

LOCK TABLES `sns_discussion_topic` WRITE;
/*!40000 ALTER TABLE `sns_discussion_topic` DISABLE KEYS */;
INSERT INTO `sns_discussion_topic` VALUES (15,1,'12345','guyguyghuy',NULL,NULL,NULL,NULL,NULL,0,'1416122568',50),(16,1,'fsdaf','sdaf',NULL,NULL,NULL,NULL,NULL,0,'1416122855',50),(17,1,'11111','12222',NULL,NULL,NULL,NULL,NULL,0,'1416138639',50),(18,1,'ffffff','ffffffffff',NULL,NULL,NULL,NULL,NULL,0,'1416190655',54),(19,1,'dddddddd','ddddaddfdsaf',NULL,NULL,NULL,NULL,NULL,0,'1416191117',50),(21,1,'fdsa','fdsafdsa',NULL,NULL,NULL,NULL,NULL,0,'1416191181',55);
/*!40000 ALTER TABLE `sns_discussion_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_district`
--

DROP TABLE IF EXISTS `sns_district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_district`
--

LOCK TABLES `sns_district` WRITE;
/*!40000 ALTER TABLE `sns_district` DISABLE KEYS */;
INSERT INTO `sns_district` VALUES (1,'北京昌平区',0),(2,'北京十三中',0),(3,'河北石家庄',0);
/*!40000 ALTER TABLE `sns_district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_filename_extension`
--

DROP TABLE IF EXISTS `sns_filename_extension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_filename_extension` (
  `extid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '扩展名id',
  `name` varchar(45) NOT NULL COMMENT '扩展名称',
  `category` varchar(45) DEFAULT NULL COMMENT '扩展名归属类',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`extid`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='文件扩展名表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_filename_extension`
--

LOCK TABLES `sns_filename_extension` WRITE;
/*!40000 ALTER TABLE `sns_filename_extension` DISABLE KEYS */;
INSERT INTO `sns_filename_extension` VALUES (1,'pps','document',NULL),(2,'mdb','document',NULL),(3,'log','document',NULL),(4,'htm','document',NULL),(5,'rtf','document',NULL),(6,'eml','document',NULL),(7,'jsp','document',NULL),(8,'cpp','document',NULL),(9,'ini','document',NULL),(10,'class','document',NULL),(11,'chm','document',NULL),(12,'xls','document',NULL),(13,'ppt','document',NULL),(14,'css','document',NULL),(15,'csv','document',NULL),(16,'vsd','document',NULL),(17,'xml','document',NULL),(18,'php','document',NULL),(19,'html','document',NULL),(20,'asp','document',NULL),(21,'docx','document',NULL),(22,'doc','document',NULL),(23,'txt','document',NULL),(24,'xlsx','document',NULL),(25,'pdf','document',NULL),(26,'wps','document',NULL),(27,'et','document',NULL),(28,'dps','document',NULL),(29,'flc','video',NULL),(30,'mpg','video',NULL),(31,'mkv','video',NULL),(32,'3gp','video',NULL),(33,'mp4','video',NULL),(34,'mov','video',NULL),(35,'flv','video',NULL),(36,'swf','video',NULL),(37,'rmvb','video',NULL),(38,'rm','video',NULL),(39,'avi','video',NULL),(40,'mp3','music',NULL),(41,'dmv','music',NULL),(42,'amr','music',NULL),(43,'flac','music',NULL),(44,'mid','music',NULL),(45,'wav','music',NULL),(46,'bmp','picture',NULL),(47,'jpg','picture',NULL),(48,'jpeg','picture',NULL),(49,'gif','picture',NULL),(51,'png','picture',NULL);
/*!40000 ALTER TABLE `sns_filename_extension` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_g_cloudfile_manage`
--

LOCK TABLES `sns_g_cloudfile_manage` WRITE;
/*!40000 ALTER TABLE `sns_g_cloudfile_manage` DISABLE KEYS */;
INSERT INTO `sns_g_cloudfile_manage` VALUES (1,'http://182.92.185.228:8197/index','u=2212153206,3709472511&fm=23&gp=0.jpg','http://182.92.185.228:8197/indexu=2212153206,3709472511&fm=23&gp=0.jpg','http://182.92.185.228:8197/indexu=2212153206,3709472511&fm=23&gp=0.jpg',750,1,'jpg','file',1,0,1,1,14868,'14868 B',0,'1416190250','1416190250','1416190250'),(2,'/home/jianlongli/SNSCloud/data/1/private/','','/home/jianlongli/SNSCloud/data/1/private/','/home/jianlongli/SNSCloud/data/1/private/',757,1,'','folder',1,0,1,1,0,'0 B',0,'1416190737','1416190737','1416190737'),(3,'','我的G盘','/home/jianlongli/SNSCloud/data/34/private/','/home/jianlongli/SNSCloud/data/34/private/',763,34,'','folder',1,0,1,1,0,'0 B',0,'1416191336','1416191336','1416191336'),(4,'','我收到的分享','/home/jianlongli/SNSCloud/data/34/public/','/home/jianlongli/SNSCloud/data/34/public/',764,34,'','folder',1,0,1,1,0,'0 B',0,'1416191336','1416191336','1416191336'),(5,'','我的G盘','/home/jianlongli/SNSCloud/data/35/private/','/home/jianlongli/SNSCloud/data/35/private/',765,35,'','folder',1,0,1,1,0,'0 B',0,'1416191694','1416191694','1416191694'),(6,'','我收到的分享','/home/jianlongli/SNSCloud/data/35/public/','/home/jianlongli/SNSCloud/data/35/public/',766,35,'','folder',1,0,1,1,0,'0 B',0,'1416191694','1416191694','1416191694'),(7,'','我的G盘','/home/jianlongli/SNSCloud/data/36/private/','/home/jianlongli/SNSCloud/data/36/private/',767,36,'','folder',1,0,1,1,0,'0 B',0,'1416192057','1416192057','1416192057'),(8,'','我收到的分享','/home/jianlongli/SNSCloud/data/36/public/','/home/jianlongli/SNSCloud/data/36/public/',768,36,'','folder',1,0,1,1,0,'0 B',0,'1416192057','1416192057','1416192057');
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_member`
--

LOCK TABLES `sns_member` WRITE;
/*!40000 ALTER TABLE `sns_member` DISABLE KEYS */;
INSERT INTO `sns_member` VALUES (1,'wangbiao','111111','wangbiao@pktcn.com','wangbiao',NULL,'3123123','32224',0,NULL,NULL,1,18,'',NULL,NULL,NULL,0,'1415235854'),(2,'tester','tester','tester@pktcn.com','tester',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408004928'),(4,'tester2','123123','test2@admin.com','tester2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408073502'),(5,'tester3','123123','test3@admin.com','tester3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408073585'),(6,'tester4','123123','test4@admin.com','tester4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408074024'),(7,'tester5','123123','tester5@admin.com','tester5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408074085'),(8,'tester6','123123','tester6@admin.com','tester6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1408074167'),(9,'jackie','jackie','jianlong_li@yeah.net',NULL,'','15011233456','',0,'','',1,19,'上地西里',0,0,'',0,'1413633084'),(24,'tttt','aaaaaa','tttttt@aa.com','吞吞吐吐',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1415014080'),(25,'tttt2','aaaaaa','tttttt2@aa.com','吞吞吐吐',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1415014087'),(26,'tttt3','aaaaaa','tttttt3@aa.com','吞吞吐吐',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1415014098'),(27,'tttt4','aaaaaa','tttttt4@aa.com','吞吞吐吐',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1415014107'),(30,'tttt7','aaaaaa','tttttt7@aa.com','吞吞吐吐',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1415014130'),(33,'tttt10','aaaaaa','tttttt10@aa.com','吞吞吐吐',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1415014151'),(34,'swswsw','swswsw','sw@163.com','sw',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1416191336'),(35,'susan1','111111','susany2003@163.com','袁',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1416191694'),(36,'susany1','111111','11@11.c','袁素屏',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1416192057');
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
  KEY `fk_sns_member_group_sns_group1_idx` (`groupid`) USING BTREE,
  KEY `fk_sns_member_group_sns_member1_idx` (`userid`) USING BTREE,
  CONSTRAINT `sns_member_group_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `sns_group` (`groupid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sns_member_group_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户-角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_member_role`
--

LOCK TABLES `sns_member_role` WRITE;
/*!40000 ALTER TABLE `sns_member_role` DISABLE KEYS */;
INSERT INTO `sns_member_role` VALUES (1,1,1),(2,2,2),(3,7,2),(4,8,2),(5,9,2),(6,13,2);
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
-- Table structure for table `sns_node`
--

DROP TABLE IF EXISTS `sns_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '节点名称',
  `title` varchar(50) DEFAULT NULL COMMENT '节点标题',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` smallint(6) unsigned DEFAULT NULL COMMENT '排序',
  `pid` smallint(6) unsigned NOT NULL COMMENT '节点父级id',
  `level` tinyint(1) unsigned NOT NULL COMMENT '等级',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='节点表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_node`
--

LOCK TABLES `sns_node` WRITE;
/*!40000 ALTER TABLE `sns_node` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_notice`
--

DROP TABLE IF EXISTS `sns_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_notice` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `circle_id` int(11) NOT NULL COMMENT '圈子ID',
  `user_id` int(11) NOT NULL COMMENT '发布者ID',
  `notice_title` varchar(200) NOT NULL COMMENT '通知名称',
  `receive_people` tinyint(4) NOT NULL COMMENT '接收人 0 圈内所有人 1 指定人（sns_notice_people）',
  `back` tinyint(4) NOT NULL COMMENT '是否回执 0 否 1 是',
  `content` text NOT NULL COMMENT '通知内容',
  `notice_fujian` varchar(100) NOT NULL COMMENT '通知附件地址',
  `fujian_name` varchar(100) NOT NULL COMMENT '附件名称',
  `add_time` datetime NOT NULL COMMENT '发布时间',
  `is_delete` tinyint(4) NOT NULL COMMENT '是否删除0否 1是',
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='发布通知表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_notice`
--

LOCK TABLES `sns_notice` WRITE;
/*!40000 ALTER TABLE `sns_notice` DISABLE KEYS */;
INSERT INTO `sns_notice` VALUES (1,5,9,'APEC 会议',0,1,'APEC 会议APEC 会议APEC 会议','file/1415180470.docx','G盘BUG.docx','2014-11-05 17:41:10',1),(5,5,9,'dfsa',1,1,'fdsafas','no file','no file','2014-11-05 18:07:48',0),(6,5,9,'dfsa',0,1,'fdsafas','no file','no file','2014-11-05 18:10:54',1),(7,5,9,'dfsa',0,1,'fdsafas','no file','no file','2014-11-05 18:10:57',0),(8,5,9,'eree',1,1,'eee','no file','no file','2014-11-06 10:04:16',0),(9,5,9,'eree',1,1,'eee','no file','no file','2014-11-06 10:05:02',0),(10,5,9,'ss',0,1,'sss','no file','no file','2014-11-06 10:05:24',0),(11,5,9,'ss',0,1,'sss','no file','no file','2014-11-06 10:10:23',0),(12,5,9,'通知家长开会',1,1,'通知家长开会通知家长开会通知家长开会通知家长开会','file/1415239946.docx','数字校园接口和单点登录配置.docx','2014-11-06 10:12:26',0),(13,5,9,'www',0,1,'wwww','no file','no file','2014-11-06 13:27:05',1),(14,5,9,'www',0,1,'wwww','no file','no file','2014-11-06 13:29:19',1),(15,5,9,'fdas',0,1,'dasf','no file','no file','2014-11-06 13:35:18',0),(16,5,9,'fdas',0,1,'dasf','no file','no file','2014-11-06 13:44:42',0),(17,5,9,'fdas',1,1,'dasf','no file','no file','2014-11-06 13:44:44',0),(18,5,9,'fdas',0,0,'dasf','no file','no file','2014-11-06 13:45:10',1),(19,5,9,'fdas',1,1,'dasf','no file','no file','2014-11-06 13:45:33',1),(20,5,1,'aaa',0,1,'fsdafdsaf','no file','no file','2014-11-16 08:19:28',0),(21,5,1,'afdsa ',0,1,'fdsafdsa','no file','no file','2014-11-16 08:19:57',0),(22,5,1,'fdsa 123',0,1,'fdsafsda','no file','no file','2014-11-16 13:26:41',0),(23,5,1,'this is notice',0,1,'fdsafdsaf','no file','no file','2014-11-16 21:43:17',0),(24,5,1,'dddd',0,1,'fdsfdfdffdf','file/1416190559.doc','关于领取营业执照后进行信息公示的提示.doc','2014-11-17 10:15:59',0);
/*!40000 ALTER TABLE `sns_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_notice_member`
--

DROP TABLE IF EXISTS `sns_notice_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_notice_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_id` int(11) NOT NULL COMMENT '通知ID',
  `circle_id` int(11) NOT NULL COMMENT '圈子ID',
  `member_id` int(11) NOT NULL COMMENT '人员ID',
  `back` tinyint(4) NOT NULL COMMENT '是否回执0否 1是',
  `isread` tinyint(4) NOT NULL COMMENT '是否已读0否1是',
  `read_time` datetime NOT NULL COMMENT '阅读时间',
  `back_content` text NOT NULL COMMENT '回执内容',
  `back_fujianname` varchar(100) NOT NULL COMMENT '回执附件名称',
  `back_fujian` varchar(100) NOT NULL COMMENT '回执附件地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='通知人员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_notice_member`
--

LOCK TABLES `sns_notice_member` WRITE;
/*!40000 ALTER TABLE `sns_notice_member` DISABLE KEYS */;
INSERT INTO `sns_notice_member` VALUES (1,1,5,1,1,0,'0000-00-00 00:00:00','','',''),(2,1,5,2,1,0,'0000-00-00 00:00:00','','',''),(3,1,5,3,1,0,'0000-00-00 00:00:00','','',''),(4,1,5,4,1,0,'0000-00-00 00:00:00','','',''),(5,1,5,5,1,0,'0000-00-00 00:00:00','','',''),(6,1,5,7,1,0,'0000-00-00 00:00:00','','',''),(7,1,5,8,1,0,'0000-00-00 00:00:00','','',''),(8,1,5,9,1,0,'0000-00-00 00:00:00','','',''),(9,2,5,1,1,0,'0000-00-00 00:00:00','','',''),(10,2,5,2,1,0,'0000-00-00 00:00:00','','',''),(11,2,5,3,1,0,'0000-00-00 00:00:00','','',''),(12,2,5,4,1,0,'0000-00-00 00:00:00','','',''),(13,2,5,5,1,0,'0000-00-00 00:00:00','','',''),(14,2,5,7,1,0,'0000-00-00 00:00:00','','',''),(15,2,5,8,1,0,'0000-00-00 00:00:00','','',''),(16,2,5,9,1,0,'0000-00-00 00:00:00','','',''),(17,3,5,1,1,0,'0000-00-00 00:00:00','','',''),(18,3,5,2,1,0,'0000-00-00 00:00:00','','',''),(19,3,5,3,1,0,'0000-00-00 00:00:00','','',''),(20,3,5,4,1,0,'0000-00-00 00:00:00','','',''),(21,3,5,5,1,0,'0000-00-00 00:00:00','','',''),(22,3,5,7,1,0,'0000-00-00 00:00:00','','',''),(23,3,5,8,1,0,'0000-00-00 00:00:00','','',''),(24,3,5,9,1,0,'0000-00-00 00:00:00','','',''),(25,4,5,1,1,0,'0000-00-00 00:00:00','','',''),(26,4,5,2,1,0,'0000-00-00 00:00:00','','',''),(27,4,5,3,1,0,'0000-00-00 00:00:00','','',''),(28,4,5,4,1,0,'0000-00-00 00:00:00','','',''),(29,4,5,5,1,0,'0000-00-00 00:00:00','','',''),(30,4,5,7,1,0,'0000-00-00 00:00:00','','',''),(31,4,5,8,1,0,'0000-00-00 00:00:00','','',''),(32,4,5,9,1,0,'0000-00-00 00:00:00','','',''),(33,5,5,1,1,0,'0000-00-00 00:00:00','','',''),(34,5,5,2,1,0,'0000-00-00 00:00:00','','',''),(35,5,5,3,1,0,'0000-00-00 00:00:00','','',''),(36,5,5,4,1,0,'0000-00-00 00:00:00','','',''),(37,5,5,5,1,0,'0000-00-00 00:00:00','','',''),(38,5,5,7,1,0,'0000-00-00 00:00:00','','',''),(39,5,5,8,1,0,'0000-00-00 00:00:00','','',''),(40,5,5,9,1,0,'0000-00-00 00:00:00','','',''),(41,6,5,1,1,0,'0000-00-00 00:00:00','','',''),(42,6,5,2,1,0,'0000-00-00 00:00:00','','',''),(43,6,5,3,1,0,'0000-00-00 00:00:00','','',''),(44,6,5,4,1,0,'0000-00-00 00:00:00','','',''),(45,6,5,5,1,0,'0000-00-00 00:00:00','','',''),(46,6,5,7,1,0,'0000-00-00 00:00:00','','',''),(47,6,5,8,1,0,'0000-00-00 00:00:00','','',''),(48,6,5,9,1,0,'0000-00-00 00:00:00','','',''),(49,7,5,1,1,0,'0000-00-00 00:00:00','','',''),(50,7,5,2,1,0,'0000-00-00 00:00:00','','',''),(51,7,5,3,1,0,'0000-00-00 00:00:00','','',''),(52,7,5,4,1,0,'0000-00-00 00:00:00','','',''),(53,7,5,5,1,0,'0000-00-00 00:00:00','','',''),(54,7,5,7,1,0,'0000-00-00 00:00:00','','',''),(55,7,5,8,1,0,'0000-00-00 00:00:00','','',''),(56,7,5,9,1,0,'0000-00-00 00:00:00','','',''),(59,13,5,1,1,0,'0000-00-00 00:00:00','','',''),(60,13,5,2,1,0,'0000-00-00 00:00:00','','',''),(61,13,5,3,1,0,'0000-00-00 00:00:00','','',''),(62,13,5,4,1,0,'0000-00-00 00:00:00','','',''),(63,13,5,5,1,0,'0000-00-00 00:00:00','','',''),(64,13,5,7,1,0,'0000-00-00 00:00:00','','',''),(65,13,5,8,1,0,'0000-00-00 00:00:00','','',''),(66,13,5,9,1,0,'0000-00-00 00:00:00','','',''),(67,14,5,1,1,0,'0000-00-00 00:00:00','','',''),(68,14,5,2,1,0,'0000-00-00 00:00:00','','',''),(69,14,5,3,1,0,'0000-00-00 00:00:00','','',''),(70,14,5,4,1,0,'0000-00-00 00:00:00','','',''),(71,14,5,5,1,0,'0000-00-00 00:00:00','','',''),(72,14,5,7,1,0,'0000-00-00 00:00:00','','',''),(73,14,5,8,1,0,'0000-00-00 00:00:00','','',''),(74,14,5,9,1,0,'0000-00-00 00:00:00','','',''),(83,16,5,1,1,0,'0000-00-00 00:00:00','','',''),(84,16,5,2,1,0,'0000-00-00 00:00:00','','',''),(85,16,5,3,1,0,'0000-00-00 00:00:00','','',''),(86,16,5,4,1,0,'0000-00-00 00:00:00','','',''),(87,16,5,5,1,0,'0000-00-00 00:00:00','','',''),(88,16,5,7,1,0,'0000-00-00 00:00:00','','',''),(89,16,5,8,1,0,'0000-00-00 00:00:00','','',''),(90,16,5,9,1,0,'0000-00-00 00:00:00','','',''),(115,19,5,1,1,0,'0000-00-00 00:00:00','','',''),(116,19,5,2,1,0,'0000-00-00 00:00:00','','',''),(130,10,5,1,1,0,'0000-00-00 00:00:00','','',''),(131,10,5,2,1,0,'0000-00-00 00:00:00','','',''),(132,10,5,3,1,0,'0000-00-00 00:00:00','','',''),(133,10,5,4,1,0,'0000-00-00 00:00:00','','',''),(134,10,5,5,1,0,'0000-00-00 00:00:00','','',''),(135,10,5,7,1,0,'0000-00-00 00:00:00','','',''),(136,10,5,8,1,0,'0000-00-00 00:00:00','','',''),(137,10,5,9,1,0,'0000-00-00 00:00:00','','',''),(165,17,5,1,1,0,'0000-00-00 00:00:00','','',''),(166,17,5,2,1,0,'0000-00-00 00:00:00','','',''),(167,17,5,3,1,0,'0000-00-00 00:00:00','','',''),(168,17,5,4,1,0,'0000-00-00 00:00:00','','',''),(169,17,5,5,1,0,'0000-00-00 00:00:00','','',''),(170,17,5,7,1,0,'0000-00-00 00:00:00','','',''),(171,17,5,8,1,0,'0000-00-00 00:00:00','','',''),(172,15,5,1,1,0,'0000-00-00 00:00:00','','',''),(173,15,5,2,1,0,'0000-00-00 00:00:00','','',''),(174,15,5,3,1,0,'0000-00-00 00:00:00','','',''),(175,15,5,4,1,0,'0000-00-00 00:00:00','','',''),(176,15,5,5,1,0,'0000-00-00 00:00:00','','',''),(177,15,5,7,1,0,'0000-00-00 00:00:00','','',''),(178,15,5,8,1,0,'0000-00-00 00:00:00','','',''),(179,15,5,9,1,0,'0000-00-00 00:00:00','','',''),(180,12,5,1,1,0,'0000-00-00 00:00:00','','aa','file/1415180470.docx'),(181,12,5,2,1,0,'0000-00-00 00:00:00','','bb','file/1415180470.docx'),(182,12,5,3,1,0,'0000-00-00 00:00:00','','cc','file/1415180470.docx'),(183,12,5,9,1,0,'0000-00-00 00:00:00','','',''),(200,18,5,1,0,0,'0000-00-00 00:00:00','','',''),(201,18,5,2,0,0,'0000-00-00 00:00:00','','',''),(202,18,5,3,0,0,'0000-00-00 00:00:00','','',''),(203,18,5,4,0,0,'0000-00-00 00:00:00','','',''),(204,18,5,5,0,0,'0000-00-00 00:00:00','','',''),(205,18,5,7,0,0,'0000-00-00 00:00:00','','',''),(206,18,5,8,0,0,'0000-00-00 00:00:00','','',''),(207,18,5,9,0,0,'0000-00-00 00:00:00','','','');
/*!40000 ALTER TABLE `sns_notice_member` ENABLE KEYS */;
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
  CONSTRAINT `fk_sns_play_records_sns_file_manage1` FOREIGN KEY (`fileid`) REFERENCES `sns_cmm_localfile_manage` (`fileid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_play_records_sns_member1` FOREIGN KEY (`userid`) REFERENCES `sns_member` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `sns_regional`
--

DROP TABLE IF EXISTS `sns_regional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_regional` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '区域名称',
  `pid` int(11) unsigned DEFAULT '0' COMMENT '父id',
  `cid` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE,
  KEY `cid` (`cid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='区域表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_regional`
--

LOCK TABLES `sns_regional` WRITE;
/*!40000 ALTER TABLE `sns_regional` DISABLE KEYS */;
INSERT INTO `sns_regional` VALUES (1,'市直属单位',0,1),(2,'迎泽区',0,1),(3,'全国省市',0,1);
/*!40000 ALTER TABLE `sns_regional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_regional_company`
--

DROP TABLE IF EXISTS `sns_regional_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_regional_company` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned DEFAULT NULL COMMENT '单位id',
  `regional_id` int(11) unsigned DEFAULT NULL COMMENT '区域id',
  PRIMARY KEY (`id`),
  KEY `regional_id` (`regional_id`) USING BTREE,
  KEY `company_id` (`company_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='区域单位的关系';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_regional_company`
--

LOCK TABLES `sns_regional_company` WRITE;
/*!40000 ALTER TABLE `sns_regional_company` DISABLE KEYS */;
INSERT INTO `sns_regional_company` VALUES (1,1,1),(2,2,2),(4,4,3),(5,1,1),(6,2,2),(7,3,3),(8,4,3);
/*!40000 ALTER TABLE `sns_regional_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_role`
--

DROP TABLE IF EXISTS `sns_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '组名称',
  `pid` smallint(6) DEFAULT NULL COMMENT '组父级id',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户组';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_role`
--

LOCK TABLES `sns_role` WRITE;
/*!40000 ALTER TABLE `sns_role` DISABLE KEYS */;
INSERT INTO `sns_role` VALUES (1,'admin',NULL,1,NULL),(2,'圈主',NULL,1,NULL),(3,'专家',NULL,1,NULL);
/*!40000 ALTER TABLE `sns_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_role_operation_func`
--

DROP TABLE IF EXISTS `sns_role_operation_func`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_role_operation_func` (
  `rofid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色',
  `roleid` int(11) unsigned NOT NULL COMMENT '角色id',
  `ofid` int(11) unsigned NOT NULL COMMENT '操作',
  PRIMARY KEY (`rofid`),
  KEY `fk_sns_ role_operation_func_sns_role1_idx` (`roleid`),
  KEY `fk_sns_ role_operation_func_sns_operation_func1_idx` (`ofid`),
  CONSTRAINT `fk_sns_ role_operation_func_sns_operation_func1` FOREIGN KEY (`ofid`) REFERENCES `sns_operation_func` (`ofid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sns_ role_operation_func_sns_role1` FOREIGN KEY (`roleid`) REFERENCES `sns_role` (`roleid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色-�';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_role_operation_func`
--

LOCK TABLES `sns_role_operation_func` WRITE;
/*!40000 ALTER TABLE `sns_role_operation_func` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_role_operation_func` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sns_role_user`
--

DROP TABLE IF EXISTS `sns_role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_role_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` mediumint(9) unsigned DEFAULT NULL COMMENT '组id',
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='用户和组的关系';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_role_user`
--

LOCK TABLES `sns_role_user` WRITE;
/*!40000 ALTER TABLE `sns_role_user` DISABLE KEYS */;
INSERT INTO `sns_role_user` VALUES (1,1,1),(2,2,2),(3,3,3),(4,3,4),(5,3,5),(6,3,6),(7,3,7),(8,3,8),(9,3,9),(16,2,24),(17,2,25),(18,2,26),(19,2,27),(21,2,29),(22,2,30),(24,2,32),(25,2,33),(26,NULL,NULL),(27,NULL,NULL),(28,NULL,NULL);
/*!40000 ALTER TABLE `sns_role_user` ENABLE KEYS */;
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

--
-- Table structure for table `sns_user_identity`
--

DROP TABLE IF EXISTS `sns_user_identity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sns_user_identity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '身份名称',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户身份';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sns_user_identity`
--

LOCK TABLES `sns_user_identity` WRITE;
/*!40000 ALTER TABLE `sns_user_identity` DISABLE KEYS */;
/*!40000 ALTER TABLE `sns_user_identity` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-17 11:57:33
