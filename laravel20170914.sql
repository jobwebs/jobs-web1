/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : laravel

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-09-14 21:00:29
*/
SET sql_mode="";
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jobs_admininfo`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_admininfo`;
CREATE TABLE `jobs_admininfo` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `permission` varchar(10) NOT NULL DEFAULT 'null',
  `role` int(1) NOT NULL DEFAULT '0' COMMENT '角色（1: 超级管理员; 0:普通管理员）',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_admininfo
-- ----------------------------
INSERT INTO `jobs_admininfo` VALUES ('1', '17', 'null', '0', '2017-09-12 22:16:45', '2017-09-12 14:16:45', '2017-09-12 14:16:45');

-- ----------------------------
-- Table structure for `jobs_adverts`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_adverts`;
CREATE TABLE `jobs_adverts` (
  `adid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `eid` int(10) unsigned DEFAULT NULL COMMENT '企业用户id',
  `uid` int(10) unsigned NOT NULL COMMENT '发布管理员id',
  `title` varchar(50) NOT NULL,
  `content` varchar(300) NOT NULL,
  `picture` varchar(300) DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT '0' COMMENT '0：大图广告1：小图广告2：文字广告',
  `location` varchar(5) NOT NULL DEFAULT '0' COMMENT '广告位置序号',
  `homepage` varchar(100) DEFAULT NULL COMMENT '公司主页',
  `validity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '广告有效期截止时间',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`adid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_adverts
-- ----------------------------
INSERT INTO `jobs_adverts` VALUES ('2', '2', '1', 'ad2', 'content1', null, '0', '2', null, '2017-09-30 09:26:42', '2017-09-02 09:27:22', '0000-00-00 00:00:00');
INSERT INTO `jobs_adverts` VALUES ('3', '3', '1', 'ad3', 'content1', null, '0', '3', null, '2017-09-30 09:26:42', '2017-09-02 09:27:22', '0000-00-00 00:00:00');
INSERT INTO `jobs_adverts` VALUES ('4', '4', '1', 'ad4', 'content1', null, '0', '4', null, '2017-09-30 09:26:42', '2017-09-02 09:27:23', '0000-00-00 00:00:00');
INSERT INTO `jobs_adverts` VALUES ('5', '5', '1', 'ad5', 'content1', null, '0', '5', null, '2017-09-30 09:26:42', '2017-09-02 09:27:24', '0000-00-00 00:00:00');
INSERT INTO `jobs_adverts` VALUES ('6', '6', '1', 'ad6', 'content1', null, '0', '6', null, '2017-09-30 09:26:42', '2017-09-02 09:27:25', '0000-00-00 00:00:00');
INSERT INTO `jobs_adverts` VALUES ('7', '7', '1', 'ad7', 'content1', null, '0', '7', null, '2017-08-31 09:30:23', '2017-09-02 09:30:29', '0000-00-00 00:00:00');
INSERT INTO `jobs_adverts` VALUES ('8', '8', '1', 'ad8', 'content1', null, '1', '1', null, '2017-09-30 09:26:42', '2017-09-02 09:27:26', '0000-00-00 00:00:00');
INSERT INTO `jobs_adverts` VALUES ('9', '9', '1', 'ad9', 'content1', null, '1', '2', null, '2017-09-30 09:26:42', '2017-09-02 09:27:27', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `jobs_backup`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_backup`;
CREATE TABLE `jobs_backup` (
  `did` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `eid` int(10) NOT NULL,
  `position_title` varchar(50) DEFAULT NULL,
  `work_nature` varchar(10) DEFAULT NULL COMMENT '工作性质（兼职|实习|全职）',
  `occupation` varchar(10) DEFAULT NULL COMMENT '期望职业',
  `industry` varchar(50) DEFAULT NULL COMMENT '行业',
  `region` varchar(50) DEFAULT NULL COMMENT '地区',
  `salary` double DEFAULT NULL,
  `skill` varchar(200) DEFAULT NULL COMMENT '个人技能',
  `extra` varchar(500) DEFAULT NULL COMMENT '个人说明',
  `education1` varchar(500) DEFAULT NULL,
  `education2` varchar(500) DEFAULT NULL,
  `education3` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_backup
-- ----------------------------
INSERT INTO `jobs_backup` VALUES ('1', '2', '0', null, '', '', '', '', '0', null, null, null, null, null, '2017-09-03 22:53:39', '0000-00-00 00:00:00');
INSERT INTO `jobs_backup` VALUES ('2', '15', '1', '123', '全职', '研发工程师', null, '上海市', '3000', '', null, '1@3234@24234@2', '2@43243@4124@3', '3@343423@2342@4', '2017-09-13 14:24:22', '2017-09-13 14:24:22');

-- ----------------------------
-- Table structure for `jobs_delivered`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_delivered`;
CREATE TABLE `jobs_delivered` (
  `deid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(10) unsigned NOT NULL COMMENT '关联backup表',
  `pid` int(10) DEFAULT NULL COMMENT 'position_id',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '投递状态（投递成功、已查看、已录用、未录用、失效）01234',
  `fbinfo` varchar(1000) DEFAULT NULL COMMENT '反馈信息',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`deid`),
  UNIQUE KEY `did` (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_delivered
-- ----------------------------
INSERT INTO `jobs_delivered` VALUES ('1', '1', null, '1', null, '2017-09-03 22:52:21', '2017-09-03 22:52:21');
INSERT INTO `jobs_delivered` VALUES ('2', '3', '1', '0', null, '2017-09-13 14:35:32', '2017-09-13 14:35:32');

-- ----------------------------
-- Table structure for `jobs_education`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_education`;
CREATE TABLE `jobs_education` (
  `eduid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `school` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `major` varchar(50) DEFAULT NULL COMMENT '学院',
  `degree` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eduid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_education
-- ----------------------------
INSERT INTO `jobs_education` VALUES ('1', '15', '1', '3234', '24234', '2', '2017-09-13 22:14:43', '2017-09-13 22:14:43');
INSERT INTO `jobs_education` VALUES ('2', '15', '2', '43243', '4124', '3', '2017-09-13 22:14:54', '2017-09-13 22:14:54');
INSERT INTO `jobs_education` VALUES ('3', '15', '3', '343423', '2342', '4', '2017-09-13 22:15:04', '2017-09-13 22:15:04');

-- ----------------------------
-- Table structure for `jobs_enprinfo`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_enprinfo`;
CREATE TABLE `jobs_enprinfo` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `ename` varchar(50) NOT NULL COMMENT '公司名称',
  `elogo` varchar(200) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL COMMENT '公司邮箱',
  `etel` varchar(20) DEFAULT NULL COMMENT '公司电话',
  `ebrief` varchar(1000) DEFAULT NULL COMMENT '公司简介',
  `escale` int(1) DEFAULT '1' COMMENT '公司规模(0: 10人以下；1:10～50人；2:50～100人；3:100～500人；4:500～1000人；5:1000人以上)',
  `enature` varchar(10) NOT NULL COMMENT '公司性质（国营、私营、集体、股份制…）企业类型',
  `industry` int(10) NOT NULL COMMENT '所属行业',
  `home_page` varchar(100) DEFAULT NULL COMMENT '公司主页',
  `address` varchar(100) DEFAULT NULL COMMENT '公司地址',
  `ecertifi` varchar(200) DEFAULT NULL COMMENT '营业执照图片',
  `lcertifi` varchar(200) DEFAULT NULL COMMENT '法人身份证照片',
  `is_verification` int(1) NOT NULL DEFAULT '0' COMMENT '审核状态\n0: 待审核，\n1: 审核通过，\n2: 审核拒绝',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_enprinfo
-- ----------------------------
INSERT INTO `jobs_enprinfo` VALUES ('1', '1', '智享互联', '', null, null, '', '1', '', '0', '', '', '2017-09-03-09-50-58-59abd082077d9ecertifi.jpg', '2017-09-03-09-50-58-59abd082077d9lcertifi.jpg', '0', '2017-08-17 21:56:06', '2017-09-03 09:50:58');
INSERT INTO `jobs_enprinfo` VALUES ('2', '11', '川大智胜', null, '123456@qq.com', '15152101890', null, null, '拉阿拉', '1', '1241241221', '阿斯蒂芬空间阿里斯顿发链接爱丽丝', null, null, '1', '2017-09-06 14:12:38', '2017-09-06 14:12:38');

-- ----------------------------
-- Table structure for `jobs_industry`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_industry`;
CREATE TABLE `jobs_industry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '行业名称',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最近修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_industry
-- ----------------------------
INSERT INTO `jobs_industry` VALUES ('1', 'IT', '2017-09-03 20:29:19', '0000-00-00 00:00:00');
INSERT INTO `jobs_industry` VALUES ('2', '化工', '2017-09-03 20:29:35', '0000-00-00 00:00:00');
INSERT INTO `jobs_industry` VALUES ('3', '新能源', '2017-09-03 20:29:41', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `jobs_intention`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_intention`;
CREATE TABLE `jobs_intention` (
  `inid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL COMMENT '一个rid对应一个inid',
  `uid` int(10) unsigned NOT NULL,
  `work_nature` int(1) DEFAULT '2' COMMENT '工作性质（兼职|实习|全职）012',
  `occupation` int(10) DEFAULT NULL COMMENT '期望职业，这里应为职业id，指向jobs_occupation表中的id',
  `industry` int(10) DEFAULT NULL COMMENT '期望行业，这里应为行业id，指向jobs_industry表中的id',
  `region` int(10) DEFAULT NULL COMMENT '期望工作地区，这里应为地区id，指向jobs_region表中的id',
  `salary` double DEFAULT NULL COMMENT '期望薪资',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`inid`),
  UNIQUE KEY `rid` (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of jobs_intention
-- ----------------------------
INSERT INTO `jobs_intention` VALUES ('1', '3', '10', '1', '12311', '1', '2', '2000', '2017-09-08 16:21:08', '2017-09-08 16:21:08');
INSERT INTO `jobs_intention` VALUES ('2', '4', '15', '2', '23', '2', '2', '3000', '2017-09-13 21:51:57', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `jobs_message`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_message`;
CREATE TABLE `jobs_message` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int(10) unsigned NOT NULL,
  `to_id` int(10) unsigned NOT NULL,
  `content` varchar(1000) NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0' COMMENT '是否已读（0:未读；1:已读）',
  `is_delete` int(1) NOT NULL DEFAULT '0' COMMENT '是否删除（0:未删除，1:删除）。',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of jobs_message
-- ----------------------------
INSERT INTO `jobs_message` VALUES ('1', '1', '1', '你好，你已经被录用', '0', '0', '2017-09-04 21:12:46');
INSERT INTO `jobs_message` VALUES ('2', '3', '1', '你好呀', '1', '0', '2017-08-20 00:22:02');
INSERT INTO `jobs_message` VALUES ('3', '15', '1', 'this is 1', '0', '0', '2017-09-13 19:47:32');
INSERT INTO `jobs_message` VALUES ('4', '2', '15', 'this is 2', '0', '0', '2017-09-13 19:47:45');
INSERT INTO `jobs_message` VALUES ('5', '1', '15', '', '0', '0', '2017-09-13 20:24:41');
INSERT INTO `jobs_message` VALUES ('6', '15', '2', '', '0', '0', '2017-09-13 20:24:51');
INSERT INTO `jobs_message` VALUES ('16', '15', '1', '这是我的简历，请注意查收！', '0', '0', '2017-09-13 22:36:14');

-- ----------------------------
-- Table structure for `jobs_news`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_news`;
CREATE TABLE `jobs_news` (
  `nid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '作者id',
  `quote` varchar(200) DEFAULT NULL,
  `content` longtext NOT NULL,
  `picture` varchar(1000) DEFAULT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_news
-- ----------------------------
INSERT INTO `jobs_news` VALUES ('1', '你好', 'nih', '2', '新华社', '浸提是个好日子', 'www.baidu.com', '防守打法的', '5', '2017-09-03 10:48:28', '0000-00-00 00:00:00');
INSERT INTO `jobs_news` VALUES ('2', '发发发', 'hello', '3', '中心社', 'lol大赛国企', '的方式辅导是', '水电费', '11', '2017-09-12 22:58:33', '2017-09-12 14:58:33');
INSERT INTO `jobs_news` VALUES ('3', '鼎折3', '好机会', '2', '凤华网', '四川大学', '胜多负少的范德萨', '今天', '7', '2017-09-14 00:34:01', '2017-09-13 16:34:01');
INSERT INTO `jobs_news` VALUES ('4', '东京新闻', '东京', '2', '搜狐', '日本', 'www.html.picture', '日本', '49', '2017-09-14 00:36:20', '2017-09-13 16:36:20');
INSERT INTO `jobs_news` VALUES ('5', '东京', '123', '2', '搜狐', '321国企', '聚会胡', '呼呼', '14', '2017-09-12 22:58:37', '2017-09-12 14:58:37');

-- ----------------------------
-- Table structure for `jobs_newsreview`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_newsreview`;
CREATE TABLE `jobs_newsreview` (
  `rid` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `nid` int(11) NOT NULL COMMENT '对应新闻id',
  `uid` int(11) NOT NULL COMMENT '发表评论用户id',
  `content` longtext NOT NULL COMMENT '评论内容',
  `is_valid` int(1) NOT NULL DEFAULT '1' COMMENT '是否合法，1是  0不是',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发表评论时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '评论修改时间',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_newsreview
-- ----------------------------
INSERT INTO `jobs_newsreview` VALUES ('1', '4', '2', '乱写的新闻吧', '1', '2017-09-03 15:04:53', '0000-00-00 00:00:00');
INSERT INTO `jobs_newsreview` VALUES ('2', '4', '1', '所发生地方', '1', '2017-09-03 15:05:14', '0000-00-00 00:00:00');
INSERT INTO `jobs_newsreview` VALUES ('26', '4', '1', '我是测试评论数据', '1', '2017-09-03 16:06:41', '2017-09-03 16:07:16');
INSERT INTO `jobs_newsreview` VALUES ('27', '4', '2', '算法的的辅导', '1', '2017-09-03 16:07:22', '2017-09-03 16:07:35');
INSERT INTO `jobs_newsreview` VALUES ('28', '4', '1', '我是测试评论数据3', '1', '2017-09-03 08:08:21', '2017-09-03 16:08:40');
INSERT INTO `jobs_newsreview` VALUES ('29', '3', '15', 'rerwe', '1', '2017-09-13 16:34:00', '2017-09-13 16:34:00');

-- ----------------------------
-- Table structure for `jobs_occupation`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_occupation`;
CREATE TABLE `jobs_occupation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `industry_id` int(10) NOT NULL COMMENT '职业所属行业的id，外键，对应jobs_industry表中的id\n\n例如：“算法工程师”这个职业的 industry_id 就应该为“计算机”这个行业的id',
  `name` varchar(40) NOT NULL COMMENT '职业名称',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_occupation
-- ----------------------------
INSERT INTO `jobs_occupation` VALUES ('1', '1', '算法工程师', '2017-09-03 20:30:01', '0000-00-00 00:00:00');
INSERT INTO `jobs_occupation` VALUES ('2', '1', '架构师', '2017-09-03 20:30:11', '0000-00-00 00:00:00');
INSERT INTO `jobs_occupation` VALUES ('23', '1', '研发工程师', '2017-09-13 22:06:57', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `jobs_personinfo`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_personinfo`;
CREATE TABLE `jobs_personinfo` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `pname` varchar(50) NOT NULL COMMENT '个人的姓名',
  `photo` varchar(200) DEFAULT NULL,
  `birthday` varchar(20) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `register_way` int(1) NOT NULL COMMENT '注册方式\n电话：0\n邮箱：1',
  `work_year` varchar(10) DEFAULT NULL COMMENT '开始工作的年份',
  `register_place` varchar(200) DEFAULT NULL COMMENT '户口所在地',
  `residence` varchar(200) DEFAULT NULL COMMENT '现在居住地',
  `tel` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `is_marry` int(1) DEFAULT '0' COMMENT '婚姻（0未知；1:未婚；2:已婚；）',
  `political` int(1) DEFAULT NULL COMMENT '政治面貌\n0:少先队\n1:共青团团员\n2:共产党党员\n3:其他党派\n4:无党派人士\n5:群众',
  `self_evalu` varchar(200) NOT NULL COMMENT '自我介绍，评价',
  `education` int(1) NOT NULL DEFAULT '0' COMMENT '最高学历\n0:未知\n1:高中以下\n2:高中\n3:大学及以上',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of jobs_personinfo
-- ----------------------------
INSERT INTO `jobs_personinfo` VALUES ('1', '1', '', '123', '323', '3232', '323', '2323', '323', '323', null, '0', null, '', '0', '2017-09-04 21:14:53', '0000-00-00 00:00:00');
INSERT INTO `jobs_personinfo` VALUES ('2', '11', 'lishuai', null, '2015-10-10', '男', '1', '10', '太原', '阿斯蒂芬空间阿里斯顿发链接爱丽丝', '15152101336', '1', '1', '发生地方撒打发', '1', '2017-09-06 14:57:53', '2017-09-06 14:57:53');

-- ----------------------------
-- Table structure for `jobs_position`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_position`;
CREATE TABLE `jobs_position` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eid` int(10) unsigned NOT NULL COMMENT '企业id，jobs_enprinfo表的id',
  `title` varchar(50) NOT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `pdescribe` varchar(500) NOT NULL,
  `salary` double NOT NULL COMMENT '为负数，表示面议',
  `region` int(10) NOT NULL COMMENT '工作地区，这里应为地区id，指向jobs_region表中的id',
  `work_nature` int(1) DEFAULT '2' COMMENT '工作性质（兼职|实习|全职）012',
  `occupation` int(10) NOT NULL COMMENT '职业，这里应为职业id，指向jobs_occupation表中的id',
  `industry` int(10) DEFAULT NULL COMMENT '行业，这里应为行业id，指向jobs_industry表中的id',
  `experience` varchar(500) NOT NULL COMMENT '要求工作经验',
  `education` varchar(50) NOT NULL COMMENT '学历要求',
  `total_num` int(5) DEFAULT NULL COMMENT '招聘人数',
  `max_age` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '年龄要求(0表示没有要求)',
  `vaildity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '招聘有效截止期',
  `position_status` int(1) NOT NULL DEFAULT '1' COMMENT '职位状态\n1:正常\n2:已过有效期\n3:被管理员下架',
  `is_urgency` int(1) DEFAULT '0' COMMENT '职位是否急聘：1是，0不是',
  `view_count` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_position
-- ----------------------------
INSERT INTO `jobs_position` VALUES ('1', '1', '123', '金辉', '百万年薪', '20000', '1', '1', '1', '1', '外企工作经验', '研究生', '200', '40', '2017-09-30 10:00:47', '1', '0', '3', '2017-09-03 09:46:15', '2017-09-03 20:48:01');
INSERT INTO `jobs_position` VALUES ('2', '3', '今天', '金石数据', 'IT行业', '200000', '1', '2', '1', '1', '国企', '本科生', '10', '30', '2017-09-30 09:46:04', '1', '1', '2', '2017-09-03 09:46:51', '2017-09-03 20:48:26');
INSERT INTO `jobs_position` VALUES ('3', '1', '', null, '', '0', '2', '0', '0', '0', '', '', null, '0', '2017-09-30 09:46:04', '1', '0', '5', '2017-09-02 10:00:50', '2017-09-14 20:12:09');
INSERT INTO `jobs_position` VALUES ('4', '2', '', null, '', '0', '3', '0', '0', '0', '', '', null, '0', '2017-09-30 09:46:04', '1', '0', '6', '2017-09-02 10:00:51', '2017-09-14 20:12:11');
INSERT INTO `jobs_position` VALUES ('5', '2', '业', null, '', '0', '4', '0', '0', '0', '', '', null, '0', '2017-09-30 09:46:04', '1', '0', '8', '2017-09-02 10:00:52', '2017-09-14 20:47:32');
INSERT INTO `jobs_position` VALUES ('6', '2', '', null, '', '0', '5', '0', '0', '0', '', '', null, '0', '2017-09-30 09:46:04', '1', '0', '9', '2017-09-02 10:00:53', '2017-09-14 20:12:14');
INSERT INTO `jobs_position` VALUES ('7', '2', '', null, '', '0', '6', '0', '0', '0', '', '', null, '0', '2017-09-30 09:46:04', '1', '0', '10', '2017-09-02 10:00:54', '2017-09-14 20:12:15');
INSERT INTO `jobs_position` VALUES ('8', '2', '', null, '', '0', '7', '0', '0', '0', '', '', null, '0', '2017-09-30 09:46:04', '1', '0', '11', '2017-09-02 10:00:56', '2017-09-14 20:12:17');
INSERT INTO `jobs_position` VALUES ('9', '2', '', null, '', '0', '8', '0', '0', '0', '', '', null, '0', '2017-09-30 09:46:04', '1', '0', '21', '2017-09-02 10:00:58', '2017-09-14 20:12:19');
INSERT INTO `jobs_position` VALUES ('10', '2', '', null, '', '0', '10', '0', '0', '0', '', '', null, '0', '2017-09-30 09:46:04', '1', '0', '22', '2017-09-02 10:01:00', '2017-09-14 20:12:22');
INSERT INTO `jobs_position` VALUES ('11', '2', '', null, '', '0', '9', '0', '0', '0', '', '', null, '0', '2017-09-30 09:46:04', '1', '0', '23', '2017-09-02 10:01:01', '2017-09-14 20:12:23');
INSERT INTO `jobs_position` VALUES ('12', '2', '', null, '', '0', '11', '0', '0', '0', '', '', null, '0', '2017-09-30 09:46:04', '1', '0', '24', '2017-09-02 10:07:17', '2017-09-14 20:12:26');

-- ----------------------------
-- Table structure for `jobs_region`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_region`;
CREATE TABLE `jobs_region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '地区名（省／市／区县）',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '上级地区的id\n\n例如：\n“中国”的id为1；那么“四川省”的parent_id就等于1；\n“四川省”的id为10；那么“成都市”的parent_id就等于10；\n“中国”的parent_id就等于0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_region
-- ----------------------------
INSERT INTO `jobs_region` VALUES ('1', '中国', '0', '2017-09-03 20:26:15', '0000-00-00 00:00:00');
INSERT INTO `jobs_region` VALUES ('2', '上海市', '1', '2017-09-03 20:26:27', '0000-00-00 00:00:00');
INSERT INTO `jobs_region` VALUES ('3', '四川省', '1', '2017-09-03 20:26:38', '0000-00-00 00:00:00');
INSERT INTO `jobs_region` VALUES ('4', '江苏省', '1', '2017-09-03 20:27:03', '0000-00-00 00:00:00');
INSERT INTO `jobs_region` VALUES ('5', '成都市', '3', '2017-09-03 20:27:15', '0000-00-00 00:00:00');
INSERT INTO `jobs_region` VALUES ('6', '苏州市', '4', '2017-09-03 20:27:26', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `jobs_resumes`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_resumes`;
CREATE TABLE `jobs_resumes` (
  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `is_english` int(1) DEFAULT '0' COMMENT '是英文简历0:不是1:是',
  `resume_name` varchar(50) DEFAULT NULL,
  `inid` int(10) unsigned DEFAULT NULL,
  `skill` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `extra` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='简历表，为用户创建和编辑维护的简历，其中还应该包括更加丰富的字段，需要和客户确定。';

-- ----------------------------
-- Records of jobs_resumes
-- ----------------------------
INSERT INTO `jobs_resumes` VALUES ('1', '11', '0', null, '0', '', null, '2017-09-08 07:54:00', '2017-09-08 07:54:00');
INSERT INTO `jobs_resumes` VALUES ('2', '11', '0', null, '0', '', null, '2017-09-08 07:54:18', '2017-09-08 07:54:18');
INSERT INTO `jobs_resumes` VALUES ('3', '11', '0', null, '0', '', null, '2017-09-08 07:55:10', '2017-09-08 07:55:10');
INSERT INTO `jobs_resumes` VALUES ('4', '0', '0', null, '0', '', null, '2017-09-08 08:38:58', '2017-09-08 08:38:58');
INSERT INTO `jobs_resumes` VALUES ('5', '0', '0', null, '0', '', null, '2017-09-08 08:39:15', '2017-09-08 08:39:15');
INSERT INTO `jobs_resumes` VALUES ('6', '0', '0', null, '0', '', null, '2017-09-08 08:40:50', '2017-09-08 08:40:50');
INSERT INTO `jobs_resumes` VALUES ('7', '0', '0', null, '0', '', null, '2017-09-08 08:43:48', '2017-09-08 08:43:48');
INSERT INTO `jobs_resumes` VALUES ('8', '12', '0', null, '0', '', null, '2017-09-08 09:08:07', '2017-09-08 09:08:07');

-- ----------------------------
-- Table structure for `jobs_tempemail`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_tempemail`;
CREATE TABLE `jobs_tempemail` (
  `tmid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL COMMENT '邮箱验证码（随机）',
  `deadline` datetime DEFAULT NULL COMMENT '过期时间',
  PRIMARY KEY (`tmid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_tempemail
-- ----------------------------
INSERT INTO `jobs_tempemail` VALUES ('1', '1', '45y3spyf0hez8xinspijo92rghyfclu7', '2017-08-24 16:58:50');

-- ----------------------------
-- Table structure for `jobs_users`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_users`;
CREATE TABLE `jobs_users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) unsigned NOT NULL COMMENT '类型（1:普通用户，2:企业用户，3:管理员）',
  `remember_token` varchar(100) DEFAULT NULL,
  `tel_vertify` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '电话验证\n0:未验证\n1:已通过验证',
  `email_vertify` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '邮箱验证\n0:未验证\n1:已通过验证',
  `status` int(1) DEFAULT NULL COMMENT '用户状态，是否禁用0:正常1:被禁用',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `tel` (`tel`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_users
-- ----------------------------
INSERT INTO `jobs_users` VALUES ('1', 'huhu', '24242', '242342', 'gfgreeg', '1', null, '0', '1', '0', '2017-09-04 20:35:25', '2017-09-12 22:42:49');
INSERT INTO `jobs_users` VALUES ('2', 'va', 'e23423', '34234', 'ffwfw', '1', null, '0', '1', '1', '2017-09-04 20:35:26', '2017-09-12 22:42:52');
INSERT INTO `jobs_users` VALUES ('3', 'fds', 'fsdf', 'fsdfs', 'gsfdfsd', '3', null, '1', '0', '0', '2017-09-04 20:37:12', '2017-09-12 22:42:54');
INSERT INTO `jobs_users` VALUES ('5', 'fsdf', '15198807787', null, '$2y$10$VagjEfIjeFJ9VH7dWmCdHO8JdoPqtwK.VIyheUXy.LFY5M50dd6Yy', '1', null, '0', '0', null, '2017-09-05 16:33:59', '2017-09-12 22:42:55');
INSERT INTO `jobs_users` VALUES ('9', 'vf', null, '7551717@qq.com', '$2y$10$r2.6yfxqjdkRu40vaPJ8i.Mc9zAQVvvpdUwvA3gcqLWt304zL7x1K', '1', null, '0', '0', null, '2017-09-05 16:44:40', '2017-09-12 22:42:56');
INSERT INTO `jobs_users` VALUES ('10', 'ff', null, '7551711d7@qq.com', '$2y$10$D3xielCvsjsbp1So.utftOAaZOqbVNKplmswXZFtL2Pfunpft9ZvO', '1', null, '0', '0', null, '2017-09-06 09:50:53', '2017-09-12 22:42:57');
INSERT INTO `jobs_users` VALUES ('11', 'gtg', '15152101366', null, '$2y$10$QQe3PA3ljRDkICTDNNrSMOVkn2INk/owUWpV4VeMOFoHFtF2VmO/G', '2', '0bEBHejkJWdD3BovGtKwgAAGPM0pjZmwEKvgHR2enYTf8TlCovb4ppljzsPc', '0', '0', null, '2017-09-06 13:20:04', '2017-09-12 22:42:58');
INSERT INTO `jobs_users` VALUES ('12', 'tgrg', '15152101367', null, '$2y$10$wMOpBVIfAa0a1MagOFkaJO7yldxLtvvenKBW3BiPZ7FjOrmDT6/7.', '2', null, '0', '0', null, '2017-09-08 06:50:54', '2017-09-12 22:42:59');
INSERT INTO `jobs_users` VALUES ('13', 'grg', '15152101566', null, '$2y$10$1tTGnUjxMy9zm9LnTdAjw.0O8CIv0jysXp9TKzZ5FadZ80xBOiTRO', '2', null, '0', '0', null, '2017-09-08 06:59:16', '2017-09-12 22:43:00');
INSERT INTO `jobs_users` VALUES ('14', 'gtg', '15152111566', null, '$2y$10$ipAIDyQb1TWG6NLR7wWppOTh5ag/LmbD4s3seK4W6DkKp.lxRhw7m', '2', null, '0', '0', null, '2017-09-08 07:02:56', '2017-09-12 22:43:00');
INSERT INTO `jobs_users` VALUES ('15', 'gtgt', '15370103305', null, '$2y$10$SgSuSsRcE9XOSm9DzQySGuVAkaAi24rj55Qvh3YHPGfUWPkPlLto.', '1', 'h6dQluhCwPsy45bMQT4WcqhJK5RseUWRQxXtUo0WTWiVQg2vQYzs15OMaT5O', '0', '0', null, '2017-09-12 12:31:14', '2017-09-14 00:35:55');
INSERT INTO `jobs_users` VALUES ('16', 'admin', null, null, '$2y$10$aTZ1dy13.bfhDAMsz1uUMuXdE81IR3V2VuBEzWBAuVIetOthgZ.s.', '3', null, '0', '0', null, '2017-09-12 14:12:32', '2017-09-12 14:12:32');
INSERT INTO `jobs_users` VALUES ('17', 'admin123\'', null, null, '$2y$10$ExtGZG0qO4bwgTQieiYk0uJsm5.UZytIVNtmalHxcgTIbU3Qv6k7W', '3', null, '0', '0', null, '2017-09-12 14:16:45', '2017-09-12 14:16:45');

-- ----------------------------
-- Table structure for `jobs_webinfo`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_webinfo`;
CREATE TABLE `jobs_webinfo` (
  `wid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '管理员id',
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `class` varchar(50) NOT NULL COMMENT '网站信息名称\n用来描述改信息是什么，例如：网站简介（web_desc），网站的官微(weibo_234)',
  `content` varchar(1000) NOT NULL COMMENT '网站信息内容',
  `work_time` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_webinfo
-- ----------------------------
INSERT INTO `jobs_webinfo` VALUES ('1', '1', null, null, null, '12344', '还很低啊', null, '2017-08-20 12:35:34', '0000-00-00 00:00:00');
INSERT INTO `jobs_webinfo` VALUES ('2', '2', null, null, null, '234', 'hihi还偶i', null, '2017-08-20 12:35:38', '0000-00-00 00:00:00');
