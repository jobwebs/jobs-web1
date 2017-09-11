-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-09-08 19:44:45
-- 服务器版本： 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jobs`
--

-- --------------------------------------------------------

--
-- 表的结构 `jobs_admininfo`
--

CREATE TABLE `jobs_admininfo` (
  `aid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `permission` varchar(10) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0' COMMENT '角色（1: 超级管理员; 0:普通管理员）',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `jobs_adverts`
--

CREATE TABLE `jobs_adverts` (
  `adid` int(10) UNSIGNED NOT NULL COMMENT '广告id',
  `eid` int(10) UNSIGNED DEFAULT NULL COMMENT '企业用户id',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '发布管理员id',
  `title` varchar(50) NOT NULL,
  `content` varchar(300) NOT NULL,
  `picture` varchar(300) DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT '0' COMMENT '0：大图广告1：小图广告2：文字广告',
  `location` varchar(5) NOT NULL DEFAULT '0' COMMENT '广告位置序号',
  `homepage` varchar(100) DEFAULT NULL COMMENT '公司主页',
  `validity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '广告有效期截止时间',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_adverts`
--

INSERT INTO `jobs_adverts` (`adid`, `eid`, `uid`, `title`, `content`, `picture`, `type`, `location`, `homepage`, `validity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ad1', 'content1', NULL, '0', '1', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:21', '0000-00-00 00:00:00'),
(2, 2, 1, 'ad2', 'content1', NULL, '0', '2', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:22', '0000-00-00 00:00:00'),
(3, 3, 1, 'ad3', 'content1', NULL, '0', '3', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:22', '0000-00-00 00:00:00'),
(4, 4, 1, 'ad4', 'content1', NULL, '0', '4', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:23', '0000-00-00 00:00:00'),
(5, 5, 1, 'ad5', 'content1', NULL, '0', '5', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:24', '0000-00-00 00:00:00'),
(6, 6, 1, 'ad6', 'content1', NULL, '0', '6', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:25', '0000-00-00 00:00:00'),
(7, 7, 1, 'ad7', 'content1', NULL, '0', '7', NULL, '2017-08-31 01:30:23', '2017-09-02 01:30:29', '0000-00-00 00:00:00'),
(8, 8, 1, 'ad8', 'content1', NULL, '1', '1', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:26', '0000-00-00 00:00:00'),
(9, 9, 1, 'ad9', 'content1', NULL, '1', '2', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:27', '0000-00-00 00:00:00'),
(10, 10, 1, 'ad10', 'content1', NULL, '1', '3', NULL, '2017-09-30 01:26:42', '2017-09-02 01:27:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_backup`
--

CREATE TABLE `jobs_backup` (
  `did` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `rid` int(10) UNSIGNED NOT NULL COMMENT '觉得可以不要',
  `pid` int(10) UNSIGNED NOT NULL COMMENT '军哥要关联',
  `inid` int(10) UNSIGNED NOT NULL COMMENT '觉得可以不要',
  `work_narure` varchar(10) NOT NULL COMMENT '工作性质（兼职|实习|全职）',
  `occupation` varchar(10) NOT NULL COMMENT '期望职业',
  `industry` varchar(50) NOT NULL COMMENT '行业',
  `region` varchar(50) NOT NULL COMMENT '地区',
  `salary` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_backup`
--

INSERT INTO `jobs_backup` (`did`, `uid`, `rid`, `pid`, `inid`, `work_narure`, `occupation`, `industry`, `region`, `salary`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 0, 0, '', '', '', '', 0, '2017-09-03 14:53:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_delivered`
--

CREATE TABLE `jobs_delivered` (
  `deid` int(10) UNSIGNED NOT NULL,
  `did` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '投递状态（投递成功、已查看、已录用、未录用、失效）',
  `fbinfo` varchar(1000) DEFAULT NULL COMMENT '反馈信息',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_delivered`
--

INSERT INTO `jobs_delivered` (`deid`, `did`, `pid`, `status`, `fbinfo`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, NULL, '2017-09-03 14:52:21', '2017-09-03 14:52:21');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_education`
--

CREATE TABLE `jobs_education` (
  `eduid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) NOT NULL,
  `school` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `major` varchar(50) NOT NULL,
  `degree` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `jobs_enprinfo`
--

CREATE TABLE `jobs_enprinfo` (
  `eid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_enprinfo`
--

INSERT INTO `jobs_enprinfo` (`eid`, `uid`, `ename`, `elogo`, `email`, `etel`, `ebrief`, `escale`, `enature`, `industry`, `home_page`, `address`, `ecertifi`, `lcertifi`, `is_verification`, `created_at`, `updated_at`) VALUES
(1, 1, '智享互联', '', NULL, NULL, '', 1, '', 0, '', '', '2017-09-03-09-50-58-59abd082077d9ecertifi.jpg', '2017-09-03-09-50-58-59abd082077d9lcertifi.jpg', 0, '2017-08-17 13:56:06', '2017-09-03 01:50:58'),
(2, 11, '川大智胜', NULL, '123456@qq.com', '15152101890', NULL, NULL, '拉阿拉', 1, '1241241221', '阿斯蒂芬空间阿里斯顿发链接爱丽丝', NULL, NULL, 1, '2017-09-06 06:12:38', '2017-09-06 06:12:38');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_industry`
--

CREATE TABLE `jobs_industry` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '行业名称',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最近修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_industry`
--

INSERT INTO `jobs_industry` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'IT', '2017-09-03 12:29:19', '0000-00-00 00:00:00'),
(2, '化工', '2017-09-03 12:29:35', '0000-00-00 00:00:00'),
(3, '新能源', '2017-09-03 12:29:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_intention`
--

CREATE TABLE `jobs_intention` (
  `inid` int(10) UNSIGNED NOT NULL,
  `rid` int(10) NOT NULL COMMENT '一个rid对应一个inid',
  `uid` int(10) UNSIGNED NOT NULL,
  `work_nature` int(1) DEFAULT NULL COMMENT '工作性质（兼职|实习|全职）',
  `occupation` int(10) DEFAULT NULL COMMENT '期望职业，这里应为职业id，指向jobs_occupation表中的id',
  `industry` int(10) DEFAULT NULL COMMENT '期望行业，这里应为行业id，指向jobs_industry表中的id',
  `region` int(10) DEFAULT NULL COMMENT '期望工作地区，这里应为地区id，指向jobs_region表中的id',
  `salary` double DEFAULT NULL COMMENT '期望薪资',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `jobs_intention`
--

INSERT INTO `jobs_intention` (`inid`, `rid`, `uid`, `work_nature`, `occupation`, `industry`, `region`, `salary`, `created_at`, `updated_at`) VALUES
(1, 3, 10, 1, 12311, 1, 2, 2000, '2017-09-08 08:21:08', '2017-09-08 08:21:08');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_message`
--

CREATE TABLE `jobs_message` (
  `mid` int(10) UNSIGNED NOT NULL,
  `from_id` int(10) UNSIGNED NOT NULL,
  `to_id` int(10) UNSIGNED NOT NULL,
  `content` varchar(1000) NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0' COMMENT '是否已读（0:未读；1:已读）',
  `is_delete` int(1) NOT NULL DEFAULT '0' COMMENT '是否删除（0:未删除，1:删除）。',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `jobs_message`
--

INSERT INTO `jobs_message` (`mid`, `from_id`, `to_id`, `content`, `is_read`, `is_delete`, `created_at`) VALUES
(1, 1, 1, '你好，你已经被录用', 0, 0, '2017-09-04 13:12:46'),
(2, 3, 1, '你好呀', 1, 0, '2017-08-19 16:22:02');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_news`
--

CREATE TABLE `jobs_news` (
  `nid` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `uid` int(10) UNSIGNED NOT NULL COMMENT '作者id',
  `quote` varchar(200) DEFAULT NULL,
  `content` longtext NOT NULL,
  `picture` varchar(1000) DEFAULT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_news`
--

INSERT INTO `jobs_news` (`nid`, `title`, `subtitle`, `uid`, `quote`, `content`, `picture`, `tag`, `view_count`, `created_at`, `updated_at`) VALUES
(1, '你好', 'nih', 2, '新华社', '浸提是个好日子', 'www.baidu.com', '防守打法的', 5, '2017-09-03 02:48:28', '0000-00-00 00:00:00'),
(2, '发发发', 'hello', 3, '中心社', 'lol大赛国企', '的方式辅导是', '水电费', 10, '2017-09-03 02:48:31', '0000-00-00 00:00:00'),
(3, '鼎折3', '好机会', 2, '凤华网', '四川大学', '胜多负少的范德萨', '今天', 4, '2017-09-03 02:48:33', '0000-00-00 00:00:00'),
(4, '东京新闻', '东京', 2, '搜狐', '日本', 'www.html.picture', '日本', 24, '2017-09-04 16:34:22', '2017-09-04 08:34:22'),
(5, '东京', '123', 2, '搜狐', '321国企', '聚会胡', '呼呼', 13, '2017-09-03 02:48:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_newsreview`
--

CREATE TABLE `jobs_newsreview` (
  `rid` int(11) NOT NULL COMMENT '评论id',
  `nid` int(11) NOT NULL COMMENT '对应新闻id',
  `uid` int(11) NOT NULL COMMENT '发表评论用户id',
  `content` longtext NOT NULL COMMENT '评论内容',
  `is_valid` int(1) NOT NULL DEFAULT '1' COMMENT '是否合法，1是  0不是',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发表评论时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '评论修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_newsreview`
--

INSERT INTO `jobs_newsreview` (`rid`, `nid`, `uid`, `content`, `is_valid`, `created_at`, `updated_at`) VALUES
(1, 4, 2, '乱写的新闻吧', 1, '2017-09-03 07:04:53', '0000-00-00 00:00:00'),
(2, 4, 1, '所发生地方', 1, '2017-09-03 07:05:14', '0000-00-00 00:00:00'),
(26, 4, 1, '我是测试评论数据', 1, '2017-09-03 08:06:41', '2017-09-03 08:07:16'),
(27, 4, 2, '算法的的辅导', 1, '2017-09-03 08:07:22', '2017-09-03 08:07:35'),
(28, 4, 1, '我是测试评论数据3', 1, '2017-09-03 00:08:21', '2017-09-03 08:08:40');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_occupation`
--

CREATE TABLE `jobs_occupation` (
  `id` int(10) UNSIGNED NOT NULL,
  `industry_id` int(10) NOT NULL COMMENT '职业所属行业的id，外键，对应jobs_industry表中的id\n\n例如：“算法工程师”这个职业的 industry_id 就应该为“计算机”这个行业的id',
  `name` varchar(40) NOT NULL COMMENT '职业名称',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_occupation`
--

INSERT INTO `jobs_occupation` (`id`, `industry_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, '算法工程师', '2017-09-03 12:30:01', '0000-00-00 00:00:00'),
(2, 1, '架构师', '2017-09-03 12:30:11', '0000-00-00 00:00:00'),
(3, 1, '研发工程师', '2017-09-03 12:30:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_personinfo`
--

CREATE TABLE `jobs_personinfo` (
  `pid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `jobs_personinfo`
--

INSERT INTO `jobs_personinfo` (`pid`, `uid`, `pname`, `photo`, `birthday`, `sex`, `register_way`, `work_year`, `register_place`, `residence`, `tel`, `is_marry`, `political`, `self_evalu`, `education`, `created_at`, `updated_at`) VALUES
(1, 1, '', '123', '323', '3232', 323, '2323', '323', '323', NULL, 0, NULL, '', 0, '2017-09-04 13:14:53', '0000-00-00 00:00:00'),
(2, 11, 'lishuai', NULL, '2015-10-10', '男', 1, '10', '太原', '阿斯蒂芬空间阿里斯顿发链接爱丽丝', '15152101336', 1, 1, '发生地方撒打发', 1, '2017-09-06 06:57:53', '2017-09-06 06:57:53');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_position`
--

CREATE TABLE `jobs_position` (
  `pid` int(10) UNSIGNED NOT NULL,
  `eid` int(10) UNSIGNED NOT NULL COMMENT '企业id，jobs_enprinfo表的id',
  `title` varchar(50) NOT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `describe` varchar(500) NOT NULL,
  `salary` double NOT NULL COMMENT '为负数，表示面议',
  `region` int(10) NOT NULL COMMENT '工作地区，这里应为地区id，指向jobs_region表中的id',
  `work_nature` int(1) DEFAULT NULL COMMENT '工作性质（兼职|实习|全职）',
  `occupation` int(10) NOT NULL COMMENT '职业，这里应为职业id，指向jobs_occupation表中的id',
  `industry` int(10) DEFAULT NULL COMMENT '行业，这里应为行业id，指向jobs_industry表中的id',
  `experience` varchar(500) NOT NULL COMMENT '要求工作经验',
  `education` varchar(50) NOT NULL COMMENT '学历要求',
  `total_num` int(5) DEFAULT NULL COMMENT '招聘人数',
  `max_age` int(2) UNSIGNED NOT NULL DEFAULT '0' COMMENT '年龄要求(0表示没有要求)',
  `vaildity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '招聘有效截止期',
  `position_status` int(1) NOT NULL DEFAULT '1' COMMENT '职位状态\n1:正常\n2:已过有效期\n3:被管理员下架',
  `is_urgency` int(1) DEFAULT '0' COMMENT '职位是否急聘：1是，0不是',
  `view_count` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_position`
--

INSERT INTO `jobs_position` (`pid`, `eid`, `title`, `tag`, `describe`, `salary`, `region`, `work_nature`, `occupation`, `industry`, `experience`, `education`, `total_num`, `max_age`, `vaildity`, `position_status`, `is_urgency`, `view_count`, `created_at`, `updated_at`) VALUES
(1, 1, '123', '金辉', '百万年薪', 20000, 1, 1, 1, 1, '外企工作经验', '研究生', 200, 40, '2017-09-30 02:00:47', 1, 0, 3, '2017-09-03 01:46:15', '2017-09-03 12:48:01'),
(2, 3, '今天', '金石数据', 'IT行业', 200000, 1, 2, 1, 1, '国企', '本科生', 10, 30, '2017-09-30 01:46:04', 1, 1, 2, '2017-09-03 01:46:51', '2017-09-03 12:48:26'),
(3, 1, '', NULL, '', 0, 0, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 5, '2017-09-02 02:00:50', '2017-09-03 12:48:30'),
(4, 2, '', NULL, '', 0, 0, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 6, '2017-09-02 02:00:51', '2017-09-03 12:51:37'),
(5, 2, '', NULL, '', 0, 0, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 8, '2017-09-02 02:00:52', '2017-09-03 12:51:37'),
(6, 2, '', NULL, '', 0, 0, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 9, '2017-09-02 02:00:53', '2017-09-03 12:51:38'),
(7, 2, '', NULL, '', 0, 0, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 10, '2017-09-02 02:00:54', '2017-09-03 12:51:38'),
(8, 2, '', NULL, '', 0, 0, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 11, '2017-09-02 02:00:56', '2017-09-03 12:51:39'),
(9, 2, '', NULL, '', 0, 0, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 21, '2017-09-02 02:00:58', '2017-09-03 12:51:39'),
(10, 2, '', NULL, '', 0, 0, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 22, '2017-09-02 02:01:00', '2017-09-03 12:51:40'),
(11, 2, '', NULL, '', 0, 0, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 23, '2017-09-02 02:01:01', '2017-09-03 12:51:40'),
(12, 2, '', NULL, '', 0, 0, 0, 0, 0, '', '', NULL, 0, '2017-09-30 01:46:04', 1, 0, 24, '2017-09-02 02:07:17', '2017-09-03 12:51:42');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_region`
--

CREATE TABLE `jobs_region` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '地区名（省／市／区县）',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '上级地区的id\n\n例如：\n“中国”的id为1；那么“四川省”的parent_id就等于1；\n“四川省”的id为10；那么“成都市”的parent_id就等于10；\n“中国”的parent_id就等于0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_region`
--

INSERT INTO `jobs_region` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, '中国', 0, '2017-09-03 12:26:15', '0000-00-00 00:00:00'),
(2, '上海市', 1, '2017-09-03 12:26:27', '0000-00-00 00:00:00'),
(3, '四川省', 1, '2017-09-03 12:26:38', '0000-00-00 00:00:00'),
(4, '江苏省', 1, '2017-09-03 12:27:03', '0000-00-00 00:00:00'),
(5, '成都市', 3, '2017-09-03 12:27:15', '0000-00-00 00:00:00'),
(6, '苏州市', 4, '2017-09-03 12:27:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_resumes`
--

CREATE TABLE `jobs_resumes` (
  `rid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `is_english` int(1) DEFAULT '0' COMMENT '是英文简历0:不是1:是',
  `resume_name` varchar(50) DEFAULT NULL,
  `inid` int(10) UNSIGNED DEFAULT NULL,
  `skill` varchar(200) CHARACTER SET utf8 NOT NULL,
  `extra` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='简历表，为用户创建和编辑维护的简历，其中还应该包括更加丰富的字段，需要和客户确定。';

--
-- 转存表中的数据 `jobs_resumes`
--

INSERT INTO `jobs_resumes` (`rid`, `uid`, `is_english`, `resume_name`, `inid`, `skill`, `extra`, `created_at`, `updated_at`) VALUES
(1, 11, 0, NULL, NULL, '', NULL, '2017-09-07 23:54:00', '2017-09-07 23:54:00'),
(2, 11, 0, NULL, NULL, '', NULL, '2017-09-07 23:54:18', '2017-09-07 23:54:18'),
(3, 11, 0, NULL, NULL, '', NULL, '2017-09-07 23:55:10', '2017-09-07 23:55:10'),
(4, 0, 0, NULL, NULL, '', NULL, '2017-09-08 00:38:58', '2017-09-08 00:38:58'),
(5, 0, 0, NULL, NULL, '', NULL, '2017-09-08 00:39:15', '2017-09-08 00:39:15'),
(6, 0, 0, NULL, NULL, '', NULL, '2017-09-08 00:40:50', '2017-09-08 00:40:50'),
(7, 0, 0, NULL, NULL, '', NULL, '2017-09-08 00:43:48', '2017-09-08 00:43:48'),
(8, 12, 0, NULL, NULL, '', NULL, '2017-09-08 01:08:07', '2017-09-08 01:08:07');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_tempemail`
--

CREATE TABLE `jobs_tempemail` (
  `tmid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL COMMENT '邮箱验证码（随机）',
  `deadline` datetime DEFAULT NULL COMMENT '过期时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_tempemail`
--

INSERT INTO `jobs_tempemail` (`tmid`, `uid`, `code`, `deadline`) VALUES
(1, 1, '45y3spyf0hez8xinspijo92rghyfclu7', '2017-08-24 16:58:50');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_users`
--

CREATE TABLE `jobs_users` (
  `uid` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) UNSIGNED NOT NULL COMMENT '类型（1:普通用户，2:企业用户，3:管理员）',
  `remember_token` varchar(100) DEFAULT NULL,
  `tel_vertify` int(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '电话验证\n0:未验证\n1:已通过验证',
  `email_vertify` int(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '邮箱验证\n0:未验证\n1:已通过验证',
  `status` int(1) DEFAULT NULL COMMENT '用户状态，是否禁用0:正常1:被禁用',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_users`
--

INSERT INTO `jobs_users` (`uid`, `username`, `tel`, `mail`, `password`, `type`, `remember_token`, `tel_vertify`, `email_vertify`, `status`, `created_at`, `updated_at`) VALUES
(1, '23', '24242', '242342', 'gfgreeg', 1, NULL, 0, 1, 0, '2017-09-04 12:35:25', '2017-09-04 12:37:33'),
(2, '12', 'e23423', '34234', 'ffwfw', 1, NULL, 0, 1, 1, '2017-09-04 12:35:26', '2017-09-04 13:09:06'),
(3, '233', 'fsdf', 'fsdfs', 'gsfdfsd', 3, NULL, 1, 0, 0, '2017-09-04 12:37:12', '2017-09-04 12:37:30'),
(5, NULL, '15198807787', NULL, '$2y$10$VagjEfIjeFJ9VH7dWmCdHO8JdoPqtwK.VIyheUXy.LFY5M50dd6Yy', 1, NULL, 0, 0, NULL, '2017-09-05 08:33:59', '2017-09-05 08:33:59'),
(9, NULL, NULL, '7551717@qq.com', '$2y$10$r2.6yfxqjdkRu40vaPJ8i.Mc9zAQVvvpdUwvA3gcqLWt304zL7x1K', 1, NULL, 0, 0, NULL, '2017-09-05 08:44:40', '2017-09-05 08:44:40'),
(10, NULL, NULL, '7551711d7@qq.com', '$2y$10$D3xielCvsjsbp1So.utftOAaZOqbVNKplmswXZFtL2Pfunpft9ZvO', 1, NULL, 0, 0, NULL, '2017-09-06 01:50:53', '2017-09-06 01:50:53'),
(11, NULL, '15152101366', NULL, '$2y$10$QQe3PA3ljRDkICTDNNrSMOVkn2INk/owUWpV4VeMOFoHFtF2VmO/G', 2, '0bEBHejkJWdD3BovGtKwgAAGPM0pjZmwEKvgHR2enYTf8TlCovb4ppljzsPc', 0, 0, NULL, '2017-09-06 05:20:04', '2017-09-08 08:03:23'),
(12, NULL, '15152101367', NULL, '$2y$10$wMOpBVIfAa0a1MagOFkaJO7yldxLtvvenKBW3BiPZ7FjOrmDT6/7.', 2, NULL, 0, 0, NULL, '2017-09-07 22:50:54', '2017-09-07 22:50:54'),
(13, NULL, '15152101566', NULL, '$2y$10$1tTGnUjxMy9zm9LnTdAjw.0O8CIv0jysXp9TKzZ5FadZ80xBOiTRO', 2, NULL, 0, 0, NULL, '2017-09-07 22:59:16', '2017-09-07 22:59:16'),
(14, NULL, '15152111566', NULL, '$2y$10$ipAIDyQb1TWG6NLR7wWppOTh5ag/LmbD4s3seK4W6DkKp.lxRhw7m', 2, NULL, 0, 0, NULL, '2017-09-07 23:02:56', '2017-09-07 23:02:56');

-- --------------------------------------------------------

--
-- 表的结构 `jobs_webinfo`
--

CREATE TABLE `jobs_webinfo` (
  `wid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL COMMENT '管理员id',
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `class` varchar(50) NOT NULL COMMENT '网站信息名称\n用来描述改信息是什么，例如：网站简介（web_desc），网站的官微(weibo_234)',
  `content` varchar(1000) NOT NULL COMMENT '网站信息内容',
  `work_time` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jobs_webinfo`
--

INSERT INTO `jobs_webinfo` (`wid`, `uid`, `tel`, `email`, `address`, `class`, `content`, `work_time`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, '12344', '还很低啊', NULL, '2017-08-20 04:35:34', '0000-00-00 00:00:00'),
(2, 2, NULL, NULL, NULL, '234', 'hihi还偶i', NULL, '2017-08-20 04:35:38', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs_admininfo`
--
ALTER TABLE `jobs_admininfo`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `jobs_adverts`
--
ALTER TABLE `jobs_adverts`
  ADD PRIMARY KEY (`adid`);

--
-- Indexes for table `jobs_backup`
--
ALTER TABLE `jobs_backup`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `jobs_delivered`
--
ALTER TABLE `jobs_delivered`
  ADD PRIMARY KEY (`deid`),
  ADD UNIQUE KEY `did` (`did`);

--
-- Indexes for table `jobs_education`
--
ALTER TABLE `jobs_education`
  ADD PRIMARY KEY (`eduid`);

--
-- Indexes for table `jobs_enprinfo`
--
ALTER TABLE `jobs_enprinfo`
  ADD PRIMARY KEY (`eid`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `jobs_industry`
--
ALTER TABLE `jobs_industry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_intention`
--
ALTER TABLE `jobs_intention`
  ADD PRIMARY KEY (`inid`),
  ADD UNIQUE KEY `rid` (`rid`);

--
-- Indexes for table `jobs_message`
--
ALTER TABLE `jobs_message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `jobs_news`
--
ALTER TABLE `jobs_news`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `jobs_newsreview`
--
ALTER TABLE `jobs_newsreview`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `jobs_occupation`
--
ALTER TABLE `jobs_occupation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_personinfo`
--
ALTER TABLE `jobs_personinfo`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `jobs_position`
--
ALTER TABLE `jobs_position`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `jobs_region`
--
ALTER TABLE `jobs_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_resumes`
--
ALTER TABLE `jobs_resumes`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `jobs_tempemail`
--
ALTER TABLE `jobs_tempemail`
  ADD PRIMARY KEY (`tmid`);

--
-- Indexes for table `jobs_users`
--
ALTER TABLE `jobs_users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `jobs_webinfo`
--
ALTER TABLE `jobs_webinfo`
  ADD PRIMARY KEY (`wid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `jobs_admininfo`
--
ALTER TABLE `jobs_admininfo`
  MODIFY `aid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `jobs_adverts`
--
ALTER TABLE `jobs_adverts`
  MODIFY `adid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '广告id', AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `jobs_backup`
--
ALTER TABLE `jobs_backup`
  MODIFY `did` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `jobs_delivered`
--
ALTER TABLE `jobs_delivered`
  MODIFY `deid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `jobs_education`
--
ALTER TABLE `jobs_education`
  MODIFY `eduid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `jobs_enprinfo`
--
ALTER TABLE `jobs_enprinfo`
  MODIFY `eid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `jobs_industry`
--
ALTER TABLE `jobs_industry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `jobs_intention`
--
ALTER TABLE `jobs_intention`
  MODIFY `inid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `jobs_message`
--
ALTER TABLE `jobs_message`
  MODIFY `mid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `jobs_news`
--
ALTER TABLE `jobs_news`
  MODIFY `nid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `jobs_newsreview`
--
ALTER TABLE `jobs_newsreview`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论id', AUTO_INCREMENT=29;
--
-- 使用表AUTO_INCREMENT `jobs_occupation`
--
ALTER TABLE `jobs_occupation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `jobs_personinfo`
--
ALTER TABLE `jobs_personinfo`
  MODIFY `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `jobs_position`
--
ALTER TABLE `jobs_position`
  MODIFY `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `jobs_region`
--
ALTER TABLE `jobs_region`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `jobs_resumes`
--
ALTER TABLE `jobs_resumes`
  MODIFY `rid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `jobs_tempemail`
--
ALTER TABLE `jobs_tempemail`
  MODIFY `tmid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `jobs_users`
--
ALTER TABLE `jobs_users`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `jobs_webinfo`
--
ALTER TABLE `jobs_webinfo`
  MODIFY `wid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
