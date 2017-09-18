-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	5.7.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `jobs_admininfo`
--

DROP TABLE IF EXISTS `jobs_admininfo`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_admininfo` (
  `aid`        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`        INT(10) UNSIGNED NOT NULL,
  `permission` VARCHAR(10)      NOT NULL DEFAULT 'null',
  `role`       INT(1)           NOT NULL DEFAULT '0'
  COMMENT '角色（1: 超级管理员; 0:普通管理员）',
  `last_login` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`aid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_admininfo`
--

LOCK TABLES `jobs_admininfo` WRITE;
/*!40000 ALTER TABLE `jobs_admininfo`
  DISABLE KEYS */;
INSERT INTO `jobs_admininfo`
VALUES (1, 17, 'null', 0, '2017-09-12 14:16:45', '2017-09-12 06:16:45', '2017-09-12 06:16:45');
/*!40000 ALTER TABLE `jobs_admininfo`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_adverts`
--

DROP TABLE IF EXISTS `jobs_adverts`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_adverts` (
  `adid`       INT(10) UNSIGNED NOT NULL AUTO_INCREMENT
  COMMENT '广告id',
  `eid`        INT(10) UNSIGNED          DEFAULT NULL
  COMMENT '企业用户id',
  `uid`        INT(10) UNSIGNED NOT NULL
  COMMENT '发布管理员id',
  `title`      VARCHAR(50)      NOT NULL,
  `content`    VARCHAR(300)     NOT NULL,
  `picture`    VARCHAR(300)              DEFAULT NULL,
  `type`       VARCHAR(10)      NOT NULL DEFAULT '0'
  COMMENT '0：大图广告1：小图广告2：文字广告',
  `location`   VARCHAR(5)       NOT NULL DEFAULT '0'
  COMMENT '广告位置序号',
  `homepage`   VARCHAR(100)              DEFAULT NULL
  COMMENT '公司主页',
  `validity`   TIMESTAMP        NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
  COMMENT '广告有效期截止时间',
  `created_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP        NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`adid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 10
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_adverts`
--

LOCK TABLES `jobs_adverts` WRITE;
/*!40000 ALTER TABLE `jobs_adverts`
  DISABLE KEYS */;
INSERT INTO `jobs_adverts` VALUES
  (2, 2, 1, 'ad2', 'content1', NULL, '0', '2', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:22',
   '0000-00-00 00:00:00'),
  (3, 3, 1, 'ad3', 'content1', NULL, '0', '3', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:22',
   '0000-00-00 00:00:00'),
  (4, 4, 1, 'ad4', 'content1', NULL, '0', '4', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:23',
   '0000-00-00 00:00:00'),
  (5, 5, 1, 'ad5', 'content1', NULL, '0', '5', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:24',
   '0000-00-00 00:00:00'),
  (6, 6, 1, 'ad6', 'content1', NULL, '0', '6', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:25',
   '0000-00-00 00:00:00'),
  (7, 7, 1, 'ad7', 'content1', NULL, '0', '7', NULL, '2017-08-31 01:30:23', '2017-09-02 01:30:29',
   '0000-00-00 00:00:00'),
  (8, 8, 1, 'ad8', 'content1', NULL, '1', '1', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:26',
   '0000-00-00 00:00:00'),
  (9, 9, 1, 'ad9', 'content1', NULL, '1', '2', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:27',
   '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `jobs_adverts`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_backup`
--

DROP TABLE IF EXISTS `jobs_backup`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_backup` (
  `did`            INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`            INT(10) UNSIGNED NOT NULL,
  `eid`            INT(10)          NOT NULL,
  `position_title` VARCHAR(50)               DEFAULT NULL,
  `work_nature`    VARCHAR(10)               DEFAULT NULL
  COMMENT '工作性质（兼职|实习|全职）',
  `occupation`     VARCHAR(10)               DEFAULT NULL
  COMMENT '期望职业',
  `industry`       VARCHAR(50)               DEFAULT NULL
  COMMENT '行业',
  `region`         VARCHAR(50)               DEFAULT NULL
  COMMENT '地区',
  `salary`         DOUBLE                    DEFAULT NULL,
  `skill`          VARCHAR(200)              DEFAULT NULL
  COMMENT '个人技能',
  `extra`          VARCHAR(500)              DEFAULT NULL
  COMMENT '个人说明',
  `education1`     VARCHAR(500)              DEFAULT NULL,
  `education2`     VARCHAR(500)              DEFAULT NULL,
  `education3`     VARCHAR(500)              DEFAULT NULL,
  `created_at`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at`     TIMESTAMP        NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`did`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_backup`
--

LOCK TABLES `jobs_backup` WRITE;
/*!40000 ALTER TABLE `jobs_backup`
  DISABLE KEYS */;
INSERT INTO `jobs_backup`
VALUES (1, 2, 0, NULL, '', '', '', '', 0, NULL, NULL, NULL, NULL, NULL, '2017-09-03 14:53:39', '0000-00-00 00:00:00'),
  (2, 15, 1, '123', '全职', '研发工程师', NULL, '上海市', 3000, '', NULL, '1@3234@24234@2', '2@43243@4124@3', '3@343423@2342@4',
   '2017-09-13 06:24:22', '2017-09-13 06:24:22');
/*!40000 ALTER TABLE `jobs_backup`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_delivered`
--

DROP TABLE IF EXISTS `jobs_delivered`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_delivered` (
  `deid`       INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `did`        INT(10) UNSIGNED NOT NULL
  COMMENT '关联backup表',
  `pid`        INT(10)                   DEFAULT NULL
  COMMENT 'position_id',
  `status`     INT(1)           NOT NULL DEFAULT '0'
  COMMENT '投递状态（投递成功、已查看、已录用、未录用、失效）01234',
  `fbinfo`     VARCHAR(1000)             DEFAULT NULL
  COMMENT '反馈信息',
  `created_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`deid`),
  UNIQUE KEY `did` (`did`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_delivered`
--

LOCK TABLES `jobs_delivered` WRITE;
/*!40000 ALTER TABLE `jobs_delivered`
  DISABLE KEYS */;
INSERT INTO `jobs_delivered` VALUES (1, 1, NULL, 1, NULL, '2017-09-03 14:52:21', '2017-09-03 14:52:21'),
  (2, 3, 1, 0, NULL, '2017-09-13 06:35:32', '2017-09-13 06:35:32'),
  (3, 2, 5, 0, NULL, '2017-09-14 13:46:26', '2017-09-14 13:46:26');
/*!40000 ALTER TABLE `jobs_delivered`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_education`
--

DROP TABLE IF EXISTS `jobs_education`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_education` (
  `eduid`      INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`        INT(10)          NOT NULL,
  `school`     VARCHAR(100)     NOT NULL,
  `date`       VARCHAR(50)      NOT NULL,
  `major`      VARCHAR(50)               DEFAULT NULL
  COMMENT '学院',
  `degree`     VARCHAR(30)      NOT NULL,
  `created_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eduid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 6
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_education`
--

LOCK TABLES `jobs_education` WRITE;
/*!40000 ALTER TABLE `jobs_education`
  DISABLE KEYS */;
INSERT INTO `jobs_education` VALUES (1, 15, '1', '3234', '24234', '2', '2017-09-13 14:14:43', '2017-09-13 14:14:43'),
  (2, 15, '2', '43243', '4124', '3', '2017-09-13 14:14:54', '2017-09-13 14:14:54'),
  (3, 15, '3', '343423', '2342', '4', '2017-09-13 14:15:04', '2017-09-13 14:15:04'),
  (4, 19, '南京理工大学', '2012-9', '计算机网络工程', '1', '2017-09-17 01:07:43', '2017-09-17 01:07:43'),
  (5, 19, '四川大学', '2016-9', '计算机网络工程', '2', '2017-09-17 01:08:02', '2017-09-17 01:08:02');
/*!40000 ALTER TABLE `jobs_education`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_enprinfo`
--

DROP TABLE IF EXISTS `jobs_enprinfo`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_enprinfo` (
  `eid`             INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`             INT(10) UNSIGNED NOT NULL,
  `ename`           VARCHAR(50)               DEFAULT NULL
  COMMENT '公司名称',
  `elogo`           VARCHAR(200)              DEFAULT NULL,
  `email`           VARCHAR(50)               DEFAULT NULL
  COMMENT '公司邮箱',
  `etel`            VARCHAR(20)               DEFAULT NULL
  COMMENT '公司电话',
  `ebrief`          VARCHAR(1000)             DEFAULT NULL
  COMMENT '公司简介',
  `escale`          INT(1)                    DEFAULT '1'
  COMMENT '公司规模(0: 10人以下；1:10～50人；2:50～100人；3:100～500人；4:500～1000人；5:1000人以上)',
  `enature`         INT(1)           NOT NULL DEFAULT '0'
  COMMENT '公司性质（0未知、1国营、2私营、3集体、4股份制…）企业类型',
  `industry`        INT(10)                   DEFAULT NULL
  COMMENT '所属行业',
  `home_page`       VARCHAR(100)              DEFAULT NULL
  COMMENT '公司主页',
  `address`         VARCHAR(100)              DEFAULT NULL
  COMMENT '公司地址',
  `ecertifi`        VARCHAR(200)              DEFAULT NULL
  COMMENT '营业执照图片',
  `lcertifi`        VARCHAR(200)              DEFAULT NULL
  COMMENT '法人身份证照片',
  `is_verification` INT(1)           NOT NULL DEFAULT '0'
  COMMENT '审核状态\n0: 待审核，\n1: 审核通过，\n2: 审核拒绝',
  `created_at`      TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`      TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eid`),
  UNIQUE KEY `uid` (`uid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_enprinfo`
--

LOCK TABLES `jobs_enprinfo` WRITE;
/*!40000 ALTER TABLE `jobs_enprinfo`
  DISABLE KEYS */;
INSERT INTO `jobs_enprinfo` VALUES
  (1, 1, '智享互联', '', NULL, NULL, '', 1, 0, 0, '', '', '2017-09-03-09-50-58-59abd082077d9ecertifi.jpg',
   '2017-09-03-09-50-58-59abd082077d9lcertifi.jpg', 0, '2017-08-17 13:56:06', '2017-09-17 17:06:50'),
  (2, 11, '川大智胜', NULL, '123456@qq.com', '15152101890', NULL, NULL, 0, 1, 'http://www.baidu.com', '阿斯蒂芬空间阿里斯顿发链接爱丽丝',
   NULL, NULL, 1, '2017-09-06 06:12:38', '2017-09-17 17:10:28');
/*!40000 ALTER TABLE `jobs_enprinfo`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_industry`
--

DROP TABLE IF EXISTS `jobs_industry`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_industry` (
  `id`         INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(100)     NOT NULL
  COMMENT '行业名称',
  `created_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  COMMENT '创建时间',
  `updated_at` TIMESTAMP        NOT NULL DEFAULT '0000-00-00 00:00:00'
  COMMENT '最近修改时间',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_industry`
--

LOCK TABLES `jobs_industry` WRITE;
/*!40000 ALTER TABLE `jobs_industry`
  DISABLE KEYS */;
INSERT INTO `jobs_industry`
VALUES (1, 'IT', '2017-09-03 12:29:19', '0000-00-00 00:00:00'), (2, '化工', '2017-09-03 12:29:35', '0000-00-00 00:00:00'),
  (3, '新能源', '2017-09-03 12:29:41', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `jobs_industry`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_intention`
--

DROP TABLE IF EXISTS `jobs_intention`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_intention` (
  `inid`        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rid`         INT(10)          NOT NULL
  COMMENT '一个rid对应一个inid',
  `uid`         INT(10) UNSIGNED NOT NULL,
  `work_nature` INT(1)                    DEFAULT '2'
  COMMENT '工作性质（兼职|实习|全职）012',
  `occupation`  INT(10)                   DEFAULT NULL
  COMMENT '期望职业，这里应为职业id，指向jobs_occupation表中的id',
  `industry`    INT(10)                   DEFAULT NULL
  COMMENT '期望行业，这里应为行业id，指向jobs_industry表中的id',
  `region`      INT(10)                   DEFAULT NULL
  COMMENT '期望工作地区，这里应为地区id，指向jobs_region表中的id',
  `salary`      DOUBLE                    DEFAULT NULL
  COMMENT '期望薪资',
  `created_at`  TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP        NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`inid`),
  UNIQUE KEY `rid` (`rid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_intention`
--

LOCK TABLES `jobs_intention` WRITE;
/*!40000 ALTER TABLE `jobs_intention`
  DISABLE KEYS */;
INSERT INTO `jobs_intention` VALUES (1, 3, 10, 1, 12311, 1, 2, 2000, '2017-09-08 08:21:08', '2017-09-08 08:21:08'),
  (2, 4, 15, 2, 23, 2, 2, 3000, '2017-09-13 13:51:57', '0000-00-00 00:00:00'),
  (3, 9, 19, 2, 1, 1, 5, 2000, '2017-09-17 01:07:09', '2017-09-17 01:07:09');
/*!40000 ALTER TABLE `jobs_intention`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_message`
--

DROP TABLE IF EXISTS `jobs_message`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_message` (
  `mid`        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_id`    INT(10) UNSIGNED NOT NULL,
  `to_id`      INT(10) UNSIGNED NOT NULL,
  `content`    VARCHAR(1000)    NOT NULL,
  `is_read`    INT(1)           NOT NULL DEFAULT '0'
  COMMENT '是否已读（0:未读；1:已读）',
  `is_delete`  INT(1)           NOT NULL DEFAULT '0'
  COMMENT '是否删除（0:未删除，1:删除）。',
  `created_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 20
  DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_message`
--

LOCK TABLES `jobs_message` WRITE;
/*!40000 ALTER TABLE `jobs_message`
  DISABLE KEYS */;
INSERT INTO `jobs_message`
VALUES (1, 20, 11, '11111', 1, 0, '2017-09-17 17:12:06'), (3, 11, 20, '33333333', 0, 1, '2017-09-17 16:02:34'),
  (17, 20, 19, '你好', 0, 1, '2017-09-17 16:03:24'), (18, 19, 20, '你在吗？', 0, 1, '2017-09-17 16:03:24'),
  (19, 20, 11, 'hello', 0, 1, '2017-09-17 16:02:34');
/*!40000 ALTER TABLE `jobs_message`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_news`
--

DROP TABLE IF EXISTS `jobs_news`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_news` (
  `nid`        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`      VARCHAR(100)     NOT NULL,
  `subtitle`   VARCHAR(100)              DEFAULT NULL,
  `uid`        INT(10) UNSIGNED NOT NULL
  COMMENT '作者id',
  `quote`      VARCHAR(200)              DEFAULT NULL,
  `content`    LONGTEXT         NOT NULL,
  `picture`    VARCHAR(1000)             DEFAULT NULL,
  `tag`        VARCHAR(100)              DEFAULT NULL,
  `view_count` INT(11)          NOT NULL DEFAULT '0'
  COMMENT '浏览量',
  `created_at` TIMESTAMP        NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 6
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_news`
--

LOCK TABLES `jobs_news` WRITE;
/*!40000 ALTER TABLE `jobs_news`
  DISABLE KEYS */;
INSERT INTO `jobs_news`
VALUES (1, '你好', 'nih', 2, '新华社', '浸提是个好日子', 'www.baidu.com', '防守打法的', 6, '2017-09-16 13:35:20', '2017-09-16 05:35:20'),
  (2, '发发发', 'hello', 3, '中心社', 'lol大赛国企', '的方式辅导是', '水电费', 13, '2017-09-17 10:43:06', '2017-09-17 02:43:06'),
  (3, '鼎折3', '好机会', 2, '凤华网', '四川大学', '胜多负少的范德萨', '今天', 7, '2017-09-13 16:34:01', '2017-09-13 08:34:01'),
  (4, '东京新闻', '东京', 2, '搜狐', '日本', 'www.html.picture', '日本', 53, '2017-09-16 13:35:36', '2017-09-16 05:35:36'),
  (5, '东京', '123', 2, '搜狐', '321国企', '聚会胡', '呼呼', 16, '2017-09-17 10:10:04', '2017-09-17 02:10:04');
/*!40000 ALTER TABLE `jobs_news`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_newsreview`
--

DROP TABLE IF EXISTS `jobs_newsreview`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_newsreview` (
  `rid`        INT(11)   NOT NULL AUTO_INCREMENT
  COMMENT '评论id',
  `nid`        INT(11)   NOT NULL
  COMMENT '对应新闻id',
  `uid`        INT(11)   NOT NULL
  COMMENT '发表评论用户id',
  `content`    LONGTEXT  NOT NULL
  COMMENT '评论内容',
  `is_valid`   INT(1)    NOT NULL DEFAULT '1'
  COMMENT '是否合法，1是  0不是',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
  COMMENT '发表评论时间',
  `updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
  COMMENT '评论修改时间',
  PRIMARY KEY (`rid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 30
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_newsreview`
--

LOCK TABLES `jobs_newsreview` WRITE;
/*!40000 ALTER TABLE `jobs_newsreview`
  DISABLE KEYS */;
INSERT INTO `jobs_newsreview` VALUES (1, 4, 2, '乱写的新闻吧', 1, '2017-09-03 07:04:53', '0000-00-00 00:00:00'),
  (2, 4, 1, '所发生地方', 1, '2017-09-03 07:05:14', '0000-00-00 00:00:00'),
  (26, 4, 1, '我是测试评论数据', 1, '2017-09-03 08:06:41', '2017-09-03 08:07:16'),
  (27, 4, 2, '算法的的辅导', 1, '2017-09-03 08:07:22', '2017-09-03 08:07:35'),
  (28, 4, 1, '我是测试评论数据3', 1, '2017-09-03 00:08:21', '2017-09-03 08:08:40'),
  (29, 3, 15, 'rerwe', 1, '2017-09-13 08:34:00', '2017-09-13 08:34:00');
/*!40000 ALTER TABLE `jobs_newsreview`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_occupation`
--

DROP TABLE IF EXISTS `jobs_occupation`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_occupation` (
  `id`          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `industry_id` INT(10)          NOT NULL
  COMMENT '职业所属行业的id，外键，对应jobs_industry表中的id\n\n例如：“算法工程师”这个职业的 industry_id 就应该为“计算机”这个行业的id',
  `name`        VARCHAR(40)      NOT NULL
  COMMENT '职业名称',
  `created_at`  TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  COMMENT '创建时间',
  `updated_at`  TIMESTAMP        NOT NULL DEFAULT '0000-00-00 00:00:00'
  COMMENT '最后修改时间',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 24
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_occupation`
--

LOCK TABLES `jobs_occupation` WRITE;
/*!40000 ALTER TABLE `jobs_occupation`
  DISABLE KEYS */;
INSERT INTO `jobs_occupation` VALUES (1, 1, '算法工程师', '2017-09-03 12:30:01', '0000-00-00 00:00:00'),
  (2, 1, '架构师', '2017-09-03 12:30:11', '0000-00-00 00:00:00'),
  (23, 1, '研发工程师', '2017-09-13 14:06:57', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `jobs_occupation`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_personinfo`
--

DROP TABLE IF EXISTS `jobs_personinfo`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_personinfo` (
  `pid`            INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`            INT(10) UNSIGNED NOT NULL,
  `pname`          VARCHAR(50)               DEFAULT NULL
  COMMENT '个人的姓名',
  `photo`          VARCHAR(200)              DEFAULT NULL,
  `birthday`       VARCHAR(20)               DEFAULT NULL,
  `sex`            VARCHAR(10)               DEFAULT NULL,
  `register_way`   INT(1)           NOT NULL
  COMMENT '注册方式\n电话：0\n邮箱：1',
  `work_year`      VARCHAR(10)               DEFAULT NULL
  COMMENT '开始工作的年份',
  `register_place` VARCHAR(200)              DEFAULT NULL
  COMMENT '户口所在地',
  `residence`      VARCHAR(200)              DEFAULT NULL
  COMMENT '现在居住地',
  `tel`            VARCHAR(20)               DEFAULT NULL
  COMMENT '联系电话',
  `email`          VARCHAR(100)              DEFAULT NULL,
  `is_marry`       INT(1)                    DEFAULT '0'
  COMMENT '婚姻（0未知；1:未婚；2:已婚；）',
  `political`      INT(1)                    DEFAULT NULL
  COMMENT '政治面貌\n0:少先队\n1:共青团团员\n2:共产党党员\n3:其他党派\n4:无党派人士\n5:群众',
  `self_evalu`     VARCHAR(200)              DEFAULT NULL
  COMMENT '自我介绍，评价',
  `education`      INT(1)           NOT NULL DEFAULT '9'
  COMMENT '最高学历\n9:未知\n1:高中以下\n2:高中\n3:大学及以上',
  `created_at`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `uid` (`uid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 5
  DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_personinfo`
--

LOCK TABLES `jobs_personinfo` WRITE;
/*!40000 ALTER TABLE `jobs_personinfo`
  DISABLE KEYS */;
INSERT INTO `jobs_personinfo` VALUES
  (1, 1, '', '123', '323', '3232', 323, '2323', '323', '323', NULL, NULL, 0, NULL, '', 0, '2017-09-04 13:14:53',
   '0000-00-00 00:00:00'),
  (2, 11, 'lishuai', NULL, '2015-10-10', '男', 1, '10', '太原', '阿斯蒂芬空间阿里斯顿发链接爱丽丝', '15152101336', NULL, 1, 1, '发生地方撒打发',
   1, '2017-09-06 06:57:53', '2017-09-06 06:57:53'),
  (3, 20, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 9, '2017-09-17 06:28:28',
   '2017-09-17 06:28:28'),
  (4, 19, 'jkjun0527', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 9, '2017-09-17 06:28:28',
   '2017-09-17 15:51:54');
/*!40000 ALTER TABLE `jobs_personinfo`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_position`
--

DROP TABLE IF EXISTS `jobs_position`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_position` (
  `pid`             INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `eid`             INT(10) UNSIGNED NOT NULL
  COMMENT '企业id，jobs_enprinfo表的id',
  `title`           VARCHAR(50)      NOT NULL,
  `tag`             VARCHAR(50)               DEFAULT NULL,
  `pdescribe`       VARCHAR(500)     NOT NULL,
  `salary`          DOUBLE           NOT NULL
  COMMENT '为负数，表示面议',
  `region`          INT(10)          NOT NULL
  COMMENT '工作地区，这里应为地区id，指向jobs_region表中的id',
  `work_nature`     INT(1)                    DEFAULT '2'
  COMMENT '工作性质（兼职|实习|全职）012',
  `occupation`      INT(10)          NOT NULL
  COMMENT '职业，这里应为职业id，指向jobs_occupation表中的id',
  `industry`        INT(10)                   DEFAULT NULL
  COMMENT '行业，这里应为行业id，指向jobs_industry表中的id',
  `experience`      VARCHAR(500)     NOT NULL
  COMMENT '要求工作经验',
  `education`       VARCHAR(50)      NOT NULL
  COMMENT '学历要求',
  `total_num`       INT(5)                    DEFAULT NULL
  COMMENT '招聘人数',
  `max_age`         INT(2) UNSIGNED  NOT NULL DEFAULT '0'
  COMMENT '年龄要求(0表示没有要求)',
  `vaildity`        TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP
  COMMENT '招聘有效截止期',
  `position_status` INT(1)           NOT NULL DEFAULT '1'
  COMMENT '职位状态\n1:正常\n2:已过有效期\n3:被管理员下架',
  `is_urgency`      INT(1)                    DEFAULT '0'
  COMMENT '职位是否急聘：1是，0不是',
  `view_count`      INT(11)                   DEFAULT '0'
  COMMENT '浏览次数',
  `created_at`      TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`      TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 13
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_position`
--

LOCK TABLES `jobs_position` WRITE;
/*!40000 ALTER TABLE `jobs_position`
  DISABLE KEYS */;
INSERT INTO `jobs_position` VALUES
  (1, 1, '123', '金辉', '百万年薪', 20000, 1, 1, 1, 1, '外企工作经验', '研究生', 200, 40, '2017-09-30 02:00:47', 1, 0, 8,
   '2017-09-03 01:46:15', '2017-09-17 00:48:37'),
  (2, 2, '今天', '金石数据', 'IT行业', 200000, 1, 2, 1, 1, '国企', '本科生', 10, 30, '2017-09-30 01:46:04', 1, 1, 20, '2017-09-03 01:46:51', '2017-09-18 01:52:31'),
  (3, 1, '', NULL, '', 0, 2, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 14, '2017-09-02 02:00:50', '2017-09-17 00:48:27'),
  (4, 2, '', NULL, '', 0, 3, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 8, '2017-09-02 02:00:51', '2017-09-17 09:28:36'),
  (5, 2, '业', '高薪|白领', '', 2000, 4, 0, 0, 0, '', '', 45, 0, '2017-09-30 01:46:04', 1, 0, 22, '2017-09-02 02:00:52', '2017-09-17 09:29:00'),
  (6, 2, '', NULL, '', 0, 5, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 10, '2017-09-02 02:00:53', '2017-09-17 09:29:08'),
  (7, 2, '', NULL, '', 0, 6, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 10, '2017-09-02 02:00:54', '2017-09-14 12:12:15'),
  (8, 2, '', NULL, '', 0, 7, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 11, '2017-09-02 02:00:56', '2017-09-14 12:12:17'),
  (9, 2, '', NULL, '', 0, 8, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 21, '2017-09-02 02:00:58', '2017-09-17 17:14:15'),
  (10, 2, '', NULL, '', 0, 10, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 22, '2017-09-02 02:01:00', '2017-09-17 17:14:46'),
  (11, 2, '', NULL, '', 0, 9, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 23, '2017-09-02 02:01:01', '2017-09-17 17:14:46'),
  (12, 2, '', NULL, '', 0, 11, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 24, '2017-09-02 02:07:17',
   '2017-09-14 14:28:10');
/*!40000 ALTER TABLE `jobs_position`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_region`
--

DROP TABLE IF EXISTS `jobs_region`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_region` (
  `id`         INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(50)      NOT NULL
  COMMENT '地区名（省／市／区县）',
  `parent_id`  INT(10)          NOT NULL DEFAULT '0'
  COMMENT '上级地区的id\n\n例如：\n“中国”的id为1；那么“四川省”的parent_id就等于1；\n“四川省”的id为10；那么“成都市”的parent_id就等于10；\n“中国”的parent_id就等于0',
  `created_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  COMMENT '创建时间',
  `updated_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP
  COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 7
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_region`
--

LOCK TABLES `jobs_region` WRITE;
/*!40000 ALTER TABLE `jobs_region`
  DISABLE KEYS */;
INSERT INTO `jobs_region` VALUES (1, '中国', 0, '2017-09-03 12:26:15', '0000-00-00 00:00:00'),
  (2, '上海市', 1, '2017-09-03 12:26:27', '0000-00-00 00:00:00'),
  (3, '四川省', 1, '2017-09-03 12:26:38', '0000-00-00 00:00:00'),
  (4, '江苏省', 1, '2017-09-03 12:27:03', '0000-00-00 00:00:00'),
  (5, '成都市', 3, '2017-09-03 12:27:15', '0000-00-00 00:00:00'),
  (6, '苏州市', 4, '2017-09-03 12:27:26', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `jobs_region`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_resumes`
--

DROP TABLE IF EXISTS `jobs_resumes`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_resumes` (
  `rid`         INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`         INT(10) UNSIGNED NOT NULL,
  `is_english`  INT(1)                    DEFAULT '0'
  COMMENT '是英文简历0:不是1:是',
  `resume_name` VARCHAR(50)               DEFAULT NULL,
  `inid`        INT(10) UNSIGNED          DEFAULT NULL,
  `skill`       VARCHAR(200)
                CHARACTER SET utf8        DEFAULT NULL,
  `extra`       VARCHAR(500)
                CHARACTER SET utf8        DEFAULT NULL,
  `created_at`  TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at`  TIMESTAMP        NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 10
  DEFAULT CHARSET = utf8mb4
  COMMENT = '简历表，为用户创建和编辑维护的简历，其中还应该包括更加丰富的字段，需要和客户确定。';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_resumes`
--

LOCK TABLES `jobs_resumes` WRITE;
/*!40000 ALTER TABLE `jobs_resumes`
  DISABLE KEYS */;
INSERT INTO `jobs_resumes` VALUES (1, 11, 0, NULL, 0, '', NULL, '2017-09-07 23:54:00', '2017-09-07 23:54:00'),
  (2, 11, 0, NULL, 0, '', NULL, '2017-09-07 23:54:18', '2017-09-07 23:54:18'),
  (3, 11, 0, NULL, 0, '', NULL, '2017-09-07 23:55:10', '2017-09-07 23:55:10'),
  (4, 0, 0, NULL, 0, '', NULL, '2017-09-08 00:38:58', '2017-09-08 00:38:58'),
  (5, 0, 0, NULL, 0, '', NULL, '2017-09-08 00:39:15', '2017-09-08 00:39:15'),
  (6, 0, 0, NULL, 0, '', NULL, '2017-09-08 00:40:50', '2017-09-08 00:40:50'),
  (7, 0, 0, NULL, 0, '', NULL, '2017-09-08 00:43:48', '2017-09-08 00:43:48'),
  (8, 12, 0, NULL, 0, '', NULL, '2017-09-08 01:08:07', '2017-09-08 01:08:07'),
  (9, 19, 0, '简历1', 3, '|@|英语四级|500|@|PHP|熟练掌握', '法萨芬萨芬撒', '2017-09-17 09:09:45', '2017-09-17 01:09:45');
/*!40000 ALTER TABLE `jobs_resumes`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_tempemail`
--

DROP TABLE IF EXISTS `jobs_tempemail`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_tempemail` (
  `tmid`     INT(11) NOT NULL AUTO_INCREMENT,
  `uid`      INT(11)          DEFAULT NULL,
  `type`     INT(1)           DEFAULT '0'
  COMMENT '验证码类型，0：注册验证 1：忘记密码验证',
  `code`     VARCHAR(32)      DEFAULT NULL
  COMMENT '邮箱验证码（随机）',
  `deadline` DATETIME         DEFAULT NULL
  COMMENT '过期时间',
  PRIMARY KEY (`tmid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 5
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_tempemail`
--

LOCK TABLES `jobs_tempemail` WRITE;
/*!40000 ALTER TABLE `jobs_tempemail`
  DISABLE KEYS */;
INSERT INTO `jobs_tempemail` VALUES (1, 1, 0, '45y3spyf0hez8xinspijo92rghyfclu7', '2017-08-24 16:58:50'),
  (3, 19, 0, 'kt27olivwdmv8t2n8lmrcxyngp2305ur', '2017-09-24 04:13:25'),
  (4, 20, 0, 'm3r8kr7r3abtbbt8rlepdgwh1v32jjev', '2017-09-24 15:28:24');
/*!40000 ALTER TABLE `jobs_tempemail`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_users`
--

DROP TABLE IF EXISTS `jobs_users`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_users` (
  `uid`            INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username`       VARCHAR(20)               DEFAULT NULL,
  `tel`            VARCHAR(15)               DEFAULT NULL,
  `mail`           VARCHAR(100)              DEFAULT NULL,
  `password`       VARCHAR(60)      NOT NULL,
  `type`           INT(1) UNSIGNED  NOT NULL
  COMMENT '类型（1:普通用户，2:企业用户，3:管理员）',
  `remember_token` VARCHAR(100)              DEFAULT NULL,
  `tel_vertify`    INT(1) UNSIGNED  NOT NULL DEFAULT '0'
  COMMENT '电话验证\n0:未验证\n1:已通过验证',
  `email_vertify`  INT(1) UNSIGNED  NOT NULL DEFAULT '0'
  COMMENT '邮箱验证\n0:未验证\n1:已通过验证',
  `status`         INT(1)           NOT NULL DEFAULT '0'
  COMMENT '用户状态，是否禁用0:正常1:被禁用',
  `created_at`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `tel` (`tel`),
  UNIQUE KEY `mail` (`mail`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 21
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_users`
--

LOCK TABLES `jobs_users` WRITE;
/*!40000 ALTER TABLE `jobs_users`
  DISABLE KEYS */;
INSERT INTO `jobs_users`
VALUES (1, 'huhu', '24242', '242342', 'gfgreeg', 1, NULL, 0, 1, 0, '2017-09-04 12:35:25', '2017-09-12 14:42:49'),
  (2, 'va', 'e23423', '34234', 'ffwfw', 1, NULL, 0, 1, 1, '2017-09-04 12:35:26', '2017-09-12 14:42:52'),
  (3, 'fds', 'fsdf', 'fsdfs', 'gsfdfsd', 3, NULL, 1, 0, 0, '2017-09-04 12:37:12', '2017-09-12 14:42:54'),
  (5, 'fsdf', '15198807787', NULL, '$2y$10$VagjEfIjeFJ9VH7dWmCdHO8JdoPqtwK.VIyheUXy.LFY5M50dd6Yy', 1, NULL, 0, 0, 0, '2017-09-05 08:33:59', '2017-09-12 14:42:55'),
  (9, 'vf', NULL, '7551717@qq.com', '$2y$10$r2.6yfxqjdkRu40vaPJ8i.Mc9zAQVvvpdUwvA3gcqLWt304zL7x1K', 1, NULL, 0, 0, 0, '2017-09-05 08:44:40', '2017-09-12 14:42:56'),
  (10, 'ff', NULL, '7551711d7@qq.com', '$2y$10$D3xielCvsjsbp1So.utftOAaZOqbVNKplmswXZFtL2Pfunpft9ZvO', 1, NULL, 0, 0, 0, '2017-09-06 01:50:53', '2017-09-12 14:42:57'),
  (11, 'gtg', '13258382770', NULL, '$2y$10$/xWzAE6lvDrdye0jVPvII.SRQgJHz1F5R76Xy4QxuJQdVQZ8CgyBC', 2, 'j5xOPhpSYOdrDruGAxjeuAEyZMmUYpjebGRhch9zNeomALeiKbe1YTk2z46O', 1, 0, 0, '2017-09-06 05:20:04', '2017-09-17 17:19:48'),
  (12, 'tgrg', '15152101367', NULL, '$2y$10$wMOpBVIfAa0a1MagOFkaJO7yldxLtvvenKBW3BiPZ7FjOrmDT6/7.', 2, NULL, 0, 0, 0, '2017-09-07 22:50:54', '2017-09-12 14:42:59'),
  (13, 'grg', '15152101566', NULL, '$2y$10$1tTGnUjxMy9zm9LnTdAjw.0O8CIv0jysXp9TKzZ5FadZ80xBOiTRO', 2, NULL, 0, 0, 0, '2017-09-07 22:59:16', '2017-09-12 14:43:00'),
  (14, 'gtg', '15152111566', NULL, '$2y$10$ipAIDyQb1TWG6NLR7wWppOTh5ag/LmbD4s3seK4W6DkKp.lxRhw7m', 2, NULL, 0, 0, 0, '2017-09-07 23:02:56', '2017-09-12 14:43:00'),
  (16, 'admin', NULL, NULL, '$2y$10$aTZ1dy13.bfhDAMsz1uUMuXdE81IR3V2VuBEzWBAuVIetOthgZ.s.', 3, NULL, 0, 0, 0, '2017-09-12 06:12:32', '2017-09-12 06:12:32'),
  (17, 'admin123\'', NULL, NULL, '$2y$10$ExtGZG0qO4bwgTQieiYk0uJsm5.UZytIVNtmalHxcgTIbU3Qv6k7W', 3, NULL, 0, 0, 0,
       '2017-09-12 06:16:45', '2017-09-12 06:16:45'),
  (19, 'jkjun0527', NULL, 'jkjun0527@foxmail.com', '$2y$10$PHxq/rgQ6Pk7nTlALV2vl.43/TJRSeKciRylF5vahq/2jXz904CIK', 1,
       NULL, 0, 1, 0, '2017-09-16 20:13:14', '2017-09-16 20:20:04'),
  (20, 'sealiu0217', NULL, 'sealiu0217@gmail.com', '$2y$10$/xWzAE6lvDrdye0jVPvII.SRQgJHz1F5R76Xy4QxuJQdVQZ8CgyBC', 1,
       'mYvnIt5yBwo7IjgF4kGmGSEQdhWO8h9OOHuwD8GRWrgURYa3J2RiBx94B232', 0, 1, 0, '2017-09-17 06:28:28',
   '2017-09-17 16:27:31');
/*!40000 ALTER TABLE `jobs_users`
  ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs_webinfo`
--

DROP TABLE IF EXISTS `jobs_webinfo`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs_webinfo` (
  `wid`        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`        INT(10) UNSIGNED NOT NULL
  COMMENT '管理员id',
  `tel`        VARCHAR(20)               DEFAULT NULL,
  `email`      VARCHAR(50)               DEFAULT NULL,
  `address`    VARCHAR(1000)             DEFAULT NULL,
  `class`      VARCHAR(50)      NOT NULL
  COMMENT '网站信息名称\n用来描述改信息是什么，例如：网站简介（web_desc），网站的官微(weibo_234)',
  `content`    VARCHAR(1000)    NOT NULL
  COMMENT '网站信息内容',
  `work_time`  VARCHAR(1000)             DEFAULT NULL,
  `created_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`wid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs_webinfo`
--

LOCK TABLES `jobs_webinfo` WRITE;
/*!40000 ALTER TABLE `jobs_webinfo`
  DISABLE KEYS */;
INSERT INTO `jobs_webinfo`
VALUES (1, 1, NULL, NULL, NULL, '12344', '还很低啊', NULL, '2017-08-20 04:35:34', '0000-00-00 00:00:00'),
  (2, 2, NULL, NULL, NULL, '234', 'hihi还偶i', NULL, '2017-08-20 04:35:38', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `jobs_webinfo`
  ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2017-09-18 18:05:00
