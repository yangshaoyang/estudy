-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: estudy
-- ------------------------------------------------------
-- Server version	5.5.47

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `adname` varchar(25) NOT NULL COMMENT '管理员昵称',
  `adpassword` char(32) NOT NULL COMMENT '管理员密码',
  `ademail` varchar(30) NOT NULL COMMENT '管理员邮箱',
  `adphonenum` char(11) NOT NULL COMMENT '管理员联系电话',
  PRIMARY KEY (`adminid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `articleid` int(11) NOT NULL AUTO_INCREMENT,
  `articletitle` char(50) NOT NULL COMMENT '帖子题目',
  `articleauthor` char(10) NOT NULL,
  `articlecontent` text NOT NULL,
  `articletime` date NOT NULL COMMENT '帖子发布时间',
  `managetime` int(11) NOT NULL COMMENT '帖子管理时间',
  PRIMARY KEY (`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='励志帖子表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_comment`
--

DROP TABLE IF EXISTS `article_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_comment` (
  `article_commentid` int(11) NOT NULL AUTO_INCREMENT,
  `articleid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `article_comment` varchar(150) NOT NULL COMMENT '帖子评论',
  `createtime` int(11) NOT NULL COMMENT '发表评论时间',
  `article_answerid` int(11) NOT NULL COMMENT '回复评论id',
  PRIMARY KEY (`article_commentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='帖子评论信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_comment`
--

LOCK TABLES `article_comment` WRITE;
/*!40000 ALTER TABLE `article_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum` (
  `forumid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '论坛标题',
  `content` text NOT NULL COMMENT '论坛内容',
  `posttime` date NOT NULL COMMENT '提交时间',
  PRIMARY KEY (`forumid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='论坛表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum`
--

LOCK TABLES `forum` WRITE;
/*!40000 ALTER TABLE `forum` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_comment`
--

DROP TABLE IF EXISTS `forum_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_comment` (
  `forum_commentid` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `forumid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `forum_comment` varchar(150) NOT NULL COMMENT '评论内容',
  `createtime` int(11) NOT NULL COMMENT '评论提交时间',
  `forum_answerid` int(11) NOT NULL COMMENT '回复评论id',
  PRIMARY KEY (`forum_commentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='论坛评论表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_comment`
--

LOCK TABLES `forum_comment` WRITE;
/*!40000 ALTER TABLE `forum_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `match`
--

DROP TABLE IF EXISTS `match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `match` (
  `matchid` int(11) NOT NULL AUTO_INCREMENT,
  `matchname` varchar(255) NOT NULL COMMENT '比赛名称',
  `mkeyword` varchar(40) NOT NULL COMMENT '比赛关键词',
  `matchtime` date NOT NULL COMMENT '比赛时间',
  `mrequest` varchar(100) NOT NULL COMMENT '比赛要求',
  `fee` int(11) NOT NULL COMMENT '比赛费用',
  `mcontent` text NOT NULL COMMENT '比赛详情内容',
  `match_url` varchar(255) NOT NULL COMMENT '比赛官网地址',
  `mthumb` varchar(255) NOT NULL COMMENT '相关图片缩略图',
  PRIMARY KEY (`matchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='比赛表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `match`
--

LOCK TABLES `match` WRITE;
/*!40000 ALTER TABLE `match` DISABLE KEYS */;
/*!40000 ALTER TABLE `match` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `forumid` int(11) NOT NULL,
  `reportreasons` varchar(150) NOT NULL COMMENT '举报理由',
  PRIMARY KEY (`reportid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='举报表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `textual`
--

DROP TABLE IF EXISTS `textual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `textual` (
  `textualid` int(11) NOT NULL AUTO_INCREMENT,
  `textualname` varchar(25) NOT NULL COMMENT '考证名',
  `tkeyword` varchar(40) NOT NULL COMMENT '考证关键词',
  `trequest` varchar(100) NOT NULL COMMENT '考证要求',
  `tfee` int(11) NOT NULL COMMENT '考证费用',
  `tcontent` text NOT NULL COMMENT '相关内容',
  `textualtime` date NOT NULL COMMENT '考证考试时间',
  `textual_url` varchar(255) NOT NULL COMMENT '考证报名官网地址',
  `thumb` varchar(255) NOT NULL COMMENT '相关图片缩略图',
  PRIMARY KEY (`textualid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='考证表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `textual`
--

LOCK TABLES `textual` WRITE;
/*!40000 ALTER TABLE `textual` DISABLE KEYS */;
/*!40000 ALTER TABLE `textual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_match`
--

DROP TABLE IF EXISTS `user_match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_match` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `matchid` int(11) NOT NULL COMMENT '比赛id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户比赛信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_match`
--

LOCK TABLES `user_match` WRITE;
/*!40000 ALTER TABLE `user_match` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_match` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_textual`
--

DROP TABLE IF EXISTS `user_textual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_textual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `textualid` int(11) NOT NULL COMMENT '考证id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户考证信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_textual`
--

LOCK TABLES `user_textual` WRITE;
/*!40000 ALTER TABLE `user_textual` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_textual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL COMMENT '用户昵称',
  `password` char(32) NOT NULL COMMENT '用户密码',
  `email` varchar(30) NOT NULL COMMENT '用户邮箱',
  `sex` char(2) NOT NULL COMMENT '用户性别',
  `type` int(11) NOT NULL COMMENT '用户类型',
  `city` varchar(20) NOT NULL COMMENT '用户所在城市',
  `colleage` varchar(30) NOT NULL COMMENT '用户所在学校',
  `major` varchar(100) NOT NULL COMMENT '用户所学专业',
  `hobby` char(255) NOT NULL COMMENT '用户偏爱领域',
  `signature` varchar(255) NOT NULL COMMENT '个性签名',
  `avatar_url` int(255) NOT NULL COMMENT '用户头像所存路径',
  `state` int(11) NOT NULL COMMENT '用户状态',
  `token` varchar(50) NOT NULL,
  `token_exptime` int(10) NOT NULL COMMENT 'token过期时间',
  `status` tinyint(1) NOT NULL COMMENT '激活状态',
  `regtime` int(10) NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wraning_messages`
--

DROP TABLE IF EXISTS `wraning_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wraning_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `messages_content` text NOT NULL COMMENT '消息内容',
  `manage_time` date NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='警告信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wraning_messages`
--

LOCK TABLES `wraning_messages` WRITE;
/*!40000 ALTER TABLE `wraning_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `wraning_messages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-24 16:54:36
