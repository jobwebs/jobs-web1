/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : laravel

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-03 14:55:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jobs_admininfo`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_admininfo`;
CREATE TABLE `jobs_admininfo` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `permission` varchar(10) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0' COMMENT '角色（1: 超级管理员; 0:普通管理员）',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_admininfo
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_adverts`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_adverts`;
CREATE TABLE `jobs_adverts` (
  `adid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(300) NOT NULL,
  `picture` varchar(300) NOT NULL,
  `type` varchar(10) NOT NULL,
  `location` varchar(5) NOT NULL,
  `homepage` varchar(100) NOT NULL,
  `validity` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`adid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_adverts
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_backup`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_backup`;
CREATE TABLE `jobs_backup` (
  `did` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL COMMENT '觉得可以不要',
  `pid` int(10) unsigned NOT NULL COMMENT '军哥要关联',
  `inid` int(10) unsigned NOT NULL COMMENT '觉得可以不要',
  `work_narure` varchar(10) NOT NULL COMMENT '工作性质（兼职|实习|全职）',
  `occupation` varchar(10) NOT NULL COMMENT '期望职业',
  `industry` varchar(50) NOT NULL COMMENT '行业',
  `region` varchar(50) NOT NULL COMMENT '地区',
  `salary` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_backup
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_delivered`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_delivered`;
CREATE TABLE `jobs_delivered` (
  `deid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '投递状态（投递成功、已查看、已录用、未录用、失效）',
  `fbinfo` varchar(1000) DEFAULT NULL COMMENT '反馈信息',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`deid`),
  UNIQUE KEY `did` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_delivered
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_enprinfo`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_enprinfo`;
CREATE TABLE `jobs_enprinfo` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `ename` varchar(50) NOT NULL COMMENT '公司名称',
  `ebrief` varchar(1000) NOT NULL COMMENT '公司简介',
  `escale` int(1) NOT NULL DEFAULT '1' COMMENT '公司规模(0: 10人以下；1:10～50人；2:50～100人；3:100～500人；4:500～1000人；5:1000人以上)',
  `enature` varchar(10) NOT NULL COMMENT '公司性质（国营、私营、集体、股份制…）',
  `industry` int(10) NOT NULL,
  `home_page` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `ecertifi` varchar(200) NOT NULL COMMENT '营业执照图片',
  `lcertifi` varchar(200) NOT NULL COMMENT '法人身份证照片',
  `is_verification` int(1) NOT NULL DEFAULT '0' COMMENT '审核状态\n0: 待审核，\n1: 审核通过，\n2: 审核拒绝',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`eid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_enprinfo
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_industry
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_intention`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_intention`;
CREATE TABLE `jobs_intention` (
  `inid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `work_nature` int(1) DEFAULT NULL COMMENT '工作性质（兼职|实习|全职）',
  `occupation` int(10) DEFAULT NULL COMMENT '期望职业，这里应为职业id，指向jobs_occupation表中的id',
  `industry` int(10) DEFAULT NULL COMMENT '期望行业，这里应为行业id，指向jobs_industry表中的id',
  `region` int(10) DEFAULT NULL COMMENT '期望工作地区，这里应为地区id，指向jobs_region表中的id',
  `salary` double DEFAULT NULL COMMENT '期望薪资',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`inid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of jobs_intention
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of jobs_message
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_news`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_news`;
CREATE TABLE `jobs_news` (
  `nid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `subtitile` varchar(100) DEFAULT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '作者id',
  `quote` varchar(200) DEFAULT NULL,
  `content` longtext NOT NULL,
  `picture` varchar(1000) DEFAULT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_news
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_occupation
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_personinfo`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_personinfo`;
CREATE TABLE `jobs_personinfo` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of jobs_personinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_positon`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_positon`;
CREATE TABLE `jobs_positon` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eid` int(10) unsigned NOT NULL COMMENT '企业id，jobs_enprinfo表的id',
  `title` varchar(50) NOT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `describe` varchar(500) NOT NULL,
  `salary` double NOT NULL COMMENT '为负数，表示面议',
  `region` int(10) NOT NULL COMMENT '工作地区，这里应为地区id，指向jobs_region表中的id',
  `work_nature` int(1) NOT NULL COMMENT '工作性质（兼职|实习|全职）',
  `occupation` int(10) NOT NULL COMMENT '职业，这里应为职业id，指向jobs_occupation表中的id',
  `industry` int(10) NOT NULL COMMENT '行业，这里应为行业id，指向jobs_industry表中的id',
  `experience` varchar(500) NOT NULL COMMENT '要求工作经验',
  `education` varchar(50) NOT NULL COMMENT '学历要求',
  `total_num` int(5) DEFAULT NULL COMMENT '招聘人数',
  `max_age` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '年龄要求(0表示没有要求)',
  `vaildity` varchar(30) NOT NULL COMMENT '招聘有效截止期',
  `position_status` int(1) NOT NULL DEFAULT '1' COMMENT '职位状态\n1:正常\n2:已过有效期\n3:被管理员下架',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_positon
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_region`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_region`;
CREATE TABLE `jobs_region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '地区名（省／市／区县）',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '上级地区的id\n\n例如：\n“中国”的id为1；那么“四川省”的parent_id就等于1；\n“四川省”的id为10；那么“成都市”的parent_id就等于10；\n“中国”的parent_id就等于0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_region
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_resumes`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_resumes`;
CREATE TABLE `jobs_resumes` (
  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `is_english` int(1) NOT NULL DEFAULT '0' COMMENT '是英文简历\n0:不是\n1:是',
  `resume_name` varchar(50) NOT NULL,
  `inid` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='简历表，为用户创建和编辑维护的简历，其中还应该包括更加丰富的字段，需要和客户确定。';

-- ----------------------------
-- Records of jobs_resumes
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_users`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_users`;
CREATE TABLE `jobs_users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) unsigned NOT NULL COMMENT '类型（1:普通用户，2:企业用户，3:管理员）',
  `token` varchar(60) NOT NULL COMMENT '登录token，用于判断用户登录状态',
  `tel_vertify` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '电话验证\n0:未验证\n1:已通过验证',
  `email_vertify` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '邮箱验证\n0:未验证\n1:已通过验证',
  `status` int(1) NOT NULL COMMENT '用户状态，是否禁用\n0:正常\n1:被禁用',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `token` (`token`),
  UNIQUE KEY `tel` (`tel`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_users
-- ----------------------------

-- ----------------------------
-- Table structure for `jobs_webinfo`
-- ----------------------------
DROP TABLE IF EXISTS `jobs_webinfo`;
CREATE TABLE `jobs_webinfo` (
  `wid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '管理员id',
  `class` varchar(50) NOT NULL COMMENT '网站信息名称\n用来描述改信息是什么，例如：网站简介（web_desc），网站的官微(weibo_234)',
  `content` varchar(1000) NOT NULL COMMENT '网站信息内容',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jobs_webinfo
-- ----------------------------
