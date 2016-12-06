-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2016 年 12 月 06 日 06:37
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `zwjlyh`
--

-- --------------------------------------------------------

--
-- 表的结构 `lyh_admin`
--

CREATE TABLE IF NOT EXISTS `lyh_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_user` varchar(255) NOT NULL,
  `adm_password` varchar(255) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `role_id` int(11) NOT NULL,
  `login_time` int(11) NOT NULL,
  `login_ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_adm_name` (`adm_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `lyh_admin`
--

INSERT INTO `lyh_admin` (`id`, `adm_user`, `adm_password`, `is_effect`, `is_delete`, `role_id`, `login_time`, `login_ip`) VALUES
(1, 'admin', '3c086f596b4aee58e1d71b3626fefc87', 1, 0, 1, 1481002352, '0.0.0.0');

-- --------------------------------------------------------

--
-- 表的结构 `lyh_adv`
--

CREATE TABLE IF NOT EXISTS `lyh_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '广告名称',
  `code` varchar(50) DEFAULT NULL COMMENT '广告标识',
  `image` varchar(100) DEFAULT NULL COMMENT '广告图片',
  `width` int(11) DEFAULT NULL COMMENT '广告长度',
  `height` int(11) DEFAULT NULL COMMENT '广告高度',
  `type` tinyint(3) DEFAULT NULL COMMENT '广告类型',
  `url` varchar(50) DEFAULT NULL COMMENT '广告链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `lyh_attr_type`
--

CREATE TABLE IF NOT EXISTS `lyh_attr_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '属性名称',
  `type_id` int(11) NOT NULL COMMENT '类型ID',
  `attr_type` tinyint(1) DEFAULT '1' COMMENT '1：唯一 2：单选 3：多选',
  `attr_input` tinyint(1) DEFAULT '1' COMMENT '1：手动录入 2：列表选择 3：多行文本',
  `sort` tinyint(4) DEFAULT '0' COMMENT '排序',
  `attr_content` tinytext COMMENT '可选值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lyh_attr_type`
--

INSERT INTO `lyh_attr_type` (`id`, `name`, `type_id`, `attr_type`, `attr_input`, `sort`, `attr_content`) VALUES
(1, '属性名称', 1, 2, 2, 50, '55\r,66\r,77\r,88'),
(2, '第二属性', 1, 1, 1, 20, '');

-- --------------------------------------------------------

--
-- 表的结构 `lyh_block`
--

CREATE TABLE IF NOT EXISTS `lyh_block` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='插件表' AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `lyh_block`
--

INSERT INTO `lyh_block` (`id`, `name`, `title`, `description`, `status`, `config`, `create_time`) VALUES
(19, 'CeshiBlock', '测试模块', '这是一个临时描述', 1, '{"table":"user","limit":"10","order":{"field":"create_time","sort":"desc"},"where":{"create_time":[["gt",1464763526],["lt",1468046742]]}}', 1467799045);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_cart`
--

CREATE TABLE IF NOT EXISTS `lyh_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '所属用户',
  `goods_id` int(11) DEFAULT NULL COMMENT ' 商品名称',
  `num` int(11) DEFAULT NULL COMMENT '购买数量',
  `price` double(10,2) DEFAULT NULL COMMENT '商品单价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `lyh_conf`
--

CREATE TABLE IF NOT EXISTS `lyh_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '配置名称',
  `value` varchar(50) DEFAULT NULL COMMENT '配置值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `lyh_conf`
--

INSERT INTO `lyh_conf` (`id`, `name`, `value`) VALUES
(1, 'WATER_ALPHA', '80%'),
(2, 'WATER_POSITION', '9'),
(3, 'WATER', '1'),
(4, 'IMG_SIXE', '102400'),
(5, 'IMG_TYPE', 'jpg,png'),
(6, 'THUMB', '1'),
(7, 'THUMB_WIDTH', '200'),
(8, 'THUMB_HEIGHT', '200'),
(9, 'THUMB_TYPE', '1'),
(10, 'WATER_IMG', 'Conf/2015/11/03/5638187f4fe3d.png'),
(13, 'SITE_NAME', '测试'),
(14, 'SEO_KEYWORD', NULL),
(15, 'SEO_DESCRIPTION', NULL),
(16, 'SITE_LICENSE', NULL),
(17, 'LOGO', 'Conf/2015/11/03/563829b63d7fc.png'),
(18, 'MAIL_HOST', 'smtp.sina.com'),
(19, 'MAIL_SMTPAUTH', 'true'),
(20, 'MAIL_FROMNAME', '测试发件'),
(21, 'MAIL_USERNAME', 'lyhzwj@sina.com'),
(22, 'MAIL_FROM', 'lyhzwj@sina.com'),
(23, 'MAIL_PASSWORD', 'lyhzwj'),
(24, 'MAIL_CHARSET', 'utf-8'),
(25, 'MAIL_ISHTML', 'true'),
(26, 'MOBILE', '1');

-- --------------------------------------------------------

--
-- 表的结构 `lyh_goods`
--

CREATE TABLE IF NOT EXISTS `lyh_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '商品名称',
  `cate_id` int(11) NOT NULL COMMENT '商品分类',
  `images` varchar(100) DEFAULT NULL COMMENT '商品图册',
  `price` double(10,2) DEFAULT NULL COMMENT '商品价格',
  `iamount` int(11) DEFAULT NULL COMMENT '商品库存',
  `is_effect` tinyint(3) DEFAULT NULL COMMENT '商品状态',
  `is_delete` int(11) DEFAULT NULL COMMENT '放入回收站',
  `create_time` int(11) DEFAULT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lyh_goods`
--

INSERT INTO `lyh_goods` (`id`, `name`, `cate_id`, `images`, `price`, `iamount`, `is_effect`, `is_delete`, `create_time`) VALUES
(1, '测试商品', 1, '', 100.00, 10, 1, 0, 1469090477),
(2, '再次测试', 1, NULL, 10.00, 10, 1, 0, 1469152547);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_goods_attr`
--

CREATE TABLE IF NOT EXISTS `lyh_goods_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `attr_id` int(11) NOT NULL,
  `attr_value` varchar(255) DEFAULT NULL,
  `attr_price` decimal(8,2) DEFAULT '0.00' COMMENT '属性价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `lyh_goods_attr`
--

INSERT INTO `lyh_goods_attr` (`id`, `goods_id`, `attr_id`, `attr_value`, `attr_price`) VALUES
(1, 1, 1, '55', 10.00),
(2, 1, 1, '88', 15.00),
(3, 1, 2, '第二属性值', 0.00);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_goods_type`
--

CREATE TABLE IF NOT EXISTS `lyh_goods_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `is_effect` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `lyh_goods_type`
--

INSERT INTO `lyh_goods_type` (`id`, `name`, `is_effect`) VALUES
(1, '普通商品', 1);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_good_cate`
--

CREATE TABLE IF NOT EXISTS `lyh_good_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL COMMENT '父级分类',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `is_effect` tinyint(3) DEFAULT NULL COMMENT '分类状态',
  `create_time` int(11) DEFAULT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `lyh_good_cate`
--

INSERT INTO `lyh_good_cate` (`id`, `pid`, `name`, `is_effect`, `create_time`) VALUES
(1, 0, '小说分类', 0, 1469079454),
(2, 1, '武侠小说', 0, 1469079532);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_hooks`
--

CREATE TABLE IF NOT EXISTS `lyh_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `lyh_hooks`
--

INSERT INTO `lyh_hooks` (`id`, `name`, `description`, `type`, `update_time`, `addons`, `status`) VALUES
(19, 'FirstHook', '第一个钩子', 1, 1468205840, 'CeshiBlock', 1);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_image`
--

CREATE TABLE IF NOT EXISTS `lyh_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `size` varchar(20) NOT NULL,
  `file` varchar(100) NOT NULL,
  `repetition` bigint(1) NOT NULL,
  `is_effect` bigint(1) NOT NULL DEFAULT '0' COMMENT '是否已使用 1 已使用 0未使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- 转存表中的数据 `lyh_image`
--

INSERT INTO `lyh_image` (`id`, `model`, `user_id`, `action`, `name`, `size`, `file`, `repetition`, `is_effect`) VALUES
(57, 'Admin', 0, 'Conf', 'WATER_IMG', '1774', 'Conf/2015/11/03/5638187f4fe3d.png', 0, 1),
(63, 'Admin', 0, 'Adv', 'image', '6490', 'Adv/2016/05/03/57285d1597436.jpg', 1, 0),
(64, 'Admin', 0, 'Adv', 'image', '4639', 'Adv/2016/05/03/57285d2a4a749.jpg', 1, 0),
(68, 'Admin', 0, 'Goods', 'images', '1853', 'Goods/2016/07/21/57909d3389afa.jpg', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_log`
--

CREATE TABLE IF NOT EXISTS `lyh_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_info` text NOT NULL COMMENT '日志描述内容',
  `log_time` int(11) NOT NULL COMMENT '发生时间',
  `log_admin` int(11) NOT NULL COMMENT ' 操作的管理员ID',
  `log_ip` varchar(255) NOT NULL COMMENT '操作者IP',
  `log_status` tinyint(1) NOT NULL COMMENT '操作结果 1:操作成功 0:操作失败',
  `module` varchar(255) NOT NULL COMMENT '操作的模块module',
  `action` varchar(255) NOT NULL COMMENT '操作的命令action',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=339 ;

--
-- 转存表中的数据 `lyh_log`
--

INSERT INTO `lyh_log` (`id`, `log_info`, `log_time`, `log_admin`, `log_ip`, `log_status`, `module`, `action`) VALUES
(97, 'admin登陆成功！', 1463134307, 1, '0.0.0.0', 1, 'Index', 'login'),
(98, 'admin登陆成功！', 1464836357, 1, '0.0.0.0', 1, 'Index', 'login'),
(99, 'admin登陆成功！', 1464915749, 1, '0.0.0.0', 1, 'Index', 'login'),
(100, '表Adv增加ID为1的记录！', 1464922420, 1, '0.0.0.0', 1, 'Adv', 'add'),
(101, '表Adv增加ID为2的记录！', 1464922542, 1, '0.0.0.0', 1, 'Adv', 'add'),
(102, '表Adv增加ID为3的记录！', 1464922595, 1, '0.0.0.0', 1, 'Adv', 'add'),
(103, '删除表Adv的ID为1的记录！', 1464940428, 1, '0.0.0.0', 1, 'Adv', 'delete'),
(104, '删除表Role的ID为5的记录！', 1464940445, 1, '0.0.0.0', 1, 'Role', 'delete'),
(105, '表Adv增加ID为4的记录！', 1464940839, 1, '0.0.0.0', 1, 'Adv', 'add'),
(106, '表Menu增加ID为17的记录！', 1464945975, 1, '0.0.0.0', 1, 'Menu', 'add'),
(107, '表Menu增加ID为18的记录！', 1464946032, 1, '0.0.0.0', 1, 'Menu', 'add'),
(108, 'admin登陆成功！', 1465176764, 1, '0.0.0.0', 1, 'Index', 'login'),
(109, '表Adv增加ID为1的记录！', 1465180105, 1, '0.0.0.0', 1, 'Adv', 'add'),
(110, '删除表Adv的ID为1的记录！', 1465180670, 1, '0.0.0.0', 1, 'Adv', 'delete'),
(111, '表Menu编辑ID为8的记录！', 1465201811, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(112, '表Menu编辑ID为8的记录！', 1465201913, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(113, '表Menu编辑ID为12的记录！', 1465201930, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(114, 'admin登陆成功！', 1465269604, 1, '0.0.0.0', 1, 'Index', 'login'),
(115, '表Menu增加ID为19的记录！', 1465279026, 1, '0.0.0.0', 1, 'Menu', 'add'),
(116, '表Menu增加ID为20的记录！', 1465279118, 1, '0.0.0.0', 1, 'Menu', 'add'),
(117, '表Menu编辑ID为18的记录！', 1465279135, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(118, '修改表Menu的sort字段值！', 1465279514, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(119, '修改表Menu的sort字段值！', 1465279524, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(120, '修改表Menu的sort字段值！', 1465279606, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(121, '修改表Menu的sort字段值！', 1465279639, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(122, '表Menu编辑ID为2的记录！', 1465279662, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(123, '修改表Menu的sort字段值！', 1465279676, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(124, '修改表Menu的sort字段值！', 1465279763, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(125, '修改表Menu的sort字段值！', 1465279779, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(126, '修改表Menu的trim字段值！', 1465280616, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(127, '修改表Menu的trim字段值！', 1465280635, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(128, '修改表Menu的num字段值！', 1465280751, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(129, '修改表Menu的num字段值！', 1465280765, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(130, '修改表Menu的num字段值！', 1465280789, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(131, '表Menu编辑ID为20的记录！', 1465280938, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(132, 'admin登陆成功！', 1465285210, 1, '0.0.0.0', 1, 'Index', 'login'),
(133, 'admin登陆成功！', 1465353547, 1, '0.0.0.0', 1, 'Index', 'login'),
(134, '表Menu增加ID为21的记录！', 1465353607, 1, '0.0.0.0', 1, 'Menu', 'add'),
(135, '表Menu增加ID为22的记录！', 1465353639, 1, '0.0.0.0', 1, 'Menu', 'add'),
(136, '表Menu增加ID为23的记录！', 1465357630, 1, '0.0.0.0', 1, 'Menu', 'add'),
(137, '下载备份数据zwjlyh_20160608141313_868957097.sql！', 1465372417, 1, '0.0.0.0', 1, 'Data', 'downloadBak'),
(138, '删除备份数据zwjlyh_20160607161710_883752402.sql！', 1465372507, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(139, '删除备份数据zwjlyh_20160607161711_527318506.sql！', 1465372512, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(140, '删除备份数据zwjlyh_20160607161727_332229565.sql！', 1465372516, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(141, '删除备份数据zwjlyh_20160607161733_928767817.sql！', 1465372521, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(142, '删除备份数据zwjlyh_20160607162031_466687836.sql！', 1465372525, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(143, '删除备份数据zwjlyh_20160607162036_590882258.sql！', 1465372530, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(144, '删除备份数据zwjlyh_20160607162121_247510490.sql！', 1465372534, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(145, '删除备份数据zwjlyh_20160608141151_881115893.sql！', 1465372539, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(146, '表Adv增加ID为1的记录！', 1465372639, 1, '0.0.0.0', 1, 'Adv', 'add'),
(147, '备份lyh_adv表！', 1465372720, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(148, '删除表Adv的ID为1的记录！', 1465372855, 1, '0.0.0.0', 1, 'Adv', 'delete'),
(149, '删除备份数据zwjlyh_20160608141313_868957097.sql！', 1465373555, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(150, '还原备份数据zwjlyh_20160608155840_9528.sql！', 1465373695, 1, '0.0.0.0', 1, 'Data', 'recover'),
(151, '删除表Adv的ID为1的记录！', 1465373710, 1, '0.0.0.0', 1, 'Adv', 'delete'),
(152, '表Adv增加ID为2的记录！', 1465373879, 1, '0.0.0.0', 1, 'Adv', 'add'),
(153, '备份lyh_adv表！', 1465373899, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(154, '删除表Adv的ID为2的记录！', 1465373913, 1, '0.0.0.0', 1, 'Adv', 'delete'),
(155, '还原备份数据zwjlyh_20160608161819_5284.sql！', 1465374060, 1, '0.0.0.0', 1, 'Data', 'recover'),
(156, '删除表Adv的ID为2的记录！', 1465374836, 1, '0.0.0.0', 1, 'Adv', 'delete'),
(157, '删除备份数据zwjlyh_20160608155840_9528.sql！', 1465375624, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(158, '删除备份数据zwjlyh_20160608161819_5284.sql！', 1465375629, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(159, '表Adv增加ID为3的记录！', 1465376044, 1, '0.0.0.0', 1, 'Adv', 'add'),
(160, '备份lyh_adv表！', 1465376058, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(161, '表Adv编辑ID为3的记录！', 1465376079, 1, '0.0.0.0', 1, 'Adv', 'edit'),
(162, '表Adv增加ID为4的记录！', 1465376197, 1, '0.0.0.0', 1, 'Adv', 'add'),
(163, '删除备份数据zwjlyh_20160608165418_1887.sql！', 1465376288, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(164, '表Adv增加ID为4的记录！', 1465376371, 1, '0.0.0.0', 1, 'Adv', 'add'),
(165, '备份lyh_adv表！', 1465376419, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(166, '表Adv编辑ID为4的记录！', 1465376469, 1, '0.0.0.0', 1, 'Adv', 'edit'),
(167, '还原备份数据zwjlyh_20160608170019_8365.sql！', 1465377761, 1, '0.0.0.0', 1, 'Data', 'recover'),
(168, '备份整个数据库！', 1465377862, 1, '0.0.0.0', 1, 'Data', 'backall'),
(169, '备份整个数据库！', 1465377962, 1, '0.0.0.0', 1, 'Data', 'backall'),
(170, '备份整个数据库！', 1465377991, 1, '0.0.0.0', 1, 'Data', 'backall'),
(171, '备份整个数据库！', 1465378008, 1, '0.0.0.0', 1, 'Data', 'backall'),
(172, '还原备份数据zwjlyh_20160608172731_6408.sql！', 1465378082, 1, '0.0.0.0', 1, 'Data', 'recover'),
(173, '表Adv编辑ID为4的记录！', 1465378204, 1, '0.0.0.0', 1, 'Adv', 'edit'),
(174, '还原备份数据zwjlyh_20160608170019_8365.sql！', 1465378230, 1, '0.0.0.0', 1, 'Data', 'recover'),
(175, '备份lyh_table表！', 1465378400, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(176, '还原备份数据zwjlyh_20160608173320_7447.sql！', 1465378420, 1, '0.0.0.0', 1, 'Data', 'recover'),
(177, '备份lyh_table表！', 1465378484, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(178, '还原备份数据zwjlyh_20160608173444_3690.sql！', 1465378497, 1, '0.0.0.0', 1, 'Data', 'recover'),
(179, '还原备份数据zwjlyh_20160608173444_3690.sql！', 1465378628, 1, '0.0.0.0', 1, 'Data', 'recover'),
(180, '还原备份数据zwjlyh_20160608173444_3690.sql！', 1465378698, 1, '0.0.0.0', 1, 'Data', 'recover'),
(181, '备份lyh_table表！', 1465378776, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(182, '还原备份数据zwjlyh_20160608173936_8393.sql！', 1465378823, 1, '0.0.0.0', 1, 'Data', 'recover'),
(183, '还原备份数据zwjlyh_20160608173936_8393.sql！', 1465379672, 1, '0.0.0.0', 1, 'Data', 'recover'),
(184, 'admin登陆成功！', 1465694783, 1, '0.0.0.0', 1, 'Index', 'login'),
(185, '还原备份数据zwjlyh_20160608173936_8393.sql！', 1465695078, 1, '0.0.0.0', 1, 'Data', 'recover'),
(186, '备份lyh_table表！', 1465695118, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(187, '还原备份数据zwjlyh_20160612093158_1613.sql！', 1465695162, 1, '0.0.0.0', 1, 'Data', 'recover'),
(188, '删除备份数据zwjlyh_20160608170019_8365.sql！', 1465695244, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(189, '删除备份数据zwjlyh_20160608172422_6658.sql！', 1465695248, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(190, '删除备份数据zwjlyh_20160608172602_7827.sql！', 1465695253, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(191, '删除备份数据zwjlyh_20160608172631_9771.sql！', 1465695258, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(192, '删除备份数据zwjlyh_20160608172648_6028.sql！', 1465695262, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(193, '删除备份数据zwjlyh_20160608172731_6408.sql！', 1465695266, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(194, '删除备份数据zwjlyh_20160608173320_7447.sql！', 1465695271, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(195, '删除备份数据zwjlyh_20160608173444_3690.sql！', 1465695276, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(196, '删除备份数据zwjlyh_20160608173936_8393.sql！', 1465695280, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(197, '删除备份数据zwjlyh_20160612093158_1613.sql！', 1465695286, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(198, '备份整个数据库！', 1465695325, 1, '0.0.0.0', 1, 'Data', 'backall'),
(199, '备份lyh_menu表！', 1465698187, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(200, '删除备份数据zwjlyh_20160612093525_5636.sql！', 1465700202, 1, '0.0.0.0', 0, 'Data', 'deletebak'),
(201, '删除备份数据zwjlyh_8888.sql！', 1465700218, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(202, '备份lyh_table表！', 1465701416, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(203, '备份整个数据库！', 1465701445, 1, '0.0.0.0', 1, 'Data', 'backall'),
(204, '备份lyh_conf,lyh_table表！', 1465701480, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(205, '还原备份数据zwjlyh_20160612111800_lyh_conf,lyh_table.sql！', 1465701493, 1, '0.0.0.0', 1, 'Data', 'recover'),
(206, '删除备份数据zwjlyh_20160612111800_lyh_conf,lyh_table.sql！', 1465701808, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(207, '删除备份数据zwjlyh_20160612111656_lyh_table.sql！', 1465701815, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(208, '备份lyh_table表！', 1465701830, 1, '0.0.0.0', 1, 'Data', 'backtables'),
(209, '还原备份数据zwjlyh_20160612112637_conf,image,log.sql！', 1465702094, 1, '0.0.0.0', 1, 'Data', 'recover'),
(210, '表Adv编辑ID为4的记录！', 1465713496, 1, '0.0.0.0', 1, 'Adv', 'edit'),
(211, '表Adv编辑ID为4的记录！', 1465717385, 1, '0.0.0.0', 1, 'Adv', 'edit'),
(212, '表Adv编辑ID为4的记录！', 1465717512, 1, '0.0.0.0', 1, 'Adv', 'edit'),
(213, 'admin退出登陆！', 1465722717, 1, '0.0.0.0', 1, 'Index', 'logout'),
(214, 'admin登陆成功！', 1465722770, 1, '0.0.0.0', 1, 'Index', 'login'),
(215, '删除备份数据zwjlyh_20160612102307_2336.sql！', 1465724965, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(216, '删除备份数据zwjlyh_20160612111725_All.sql！', 1465724969, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(217, '删除备份数据zwjlyh_20160612112350_table.sql！', 1465724974, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(218, '删除备份数据zwjlyh_20160612112637_conf,image,log.sql！', 1465724978, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(219, '备份整个数据库！', 1465724986, 1, '0.0.0.0', 1, 'Data', 'backall'),
(220, 'admin登陆成功！', 1465799096, 1, '0.0.0.0', 1, 'Index', 'login'),
(221, '表Menu增加ID为24的记录！', 1467190088, 1, '0.0.0.0', 1, 'Menu', 'add'),
(222, '表Menu增加ID为25的记录！', 1467190125, 1, '0.0.0.0', 1, 'Menu', 'add'),
(223, '表Menu编辑ID为25的记录！', 1467190152, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(224, '删除备份数据zwjlyh_20160612174946_All.sql！', 1467193641, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(225, '备份整个数据库！', 1467193653, 1, '0.0.0.0', 1, 'Data', 'backall'),
(226, 'admin登陆成功！', 1467339177, 1, '0.0.0.0', 1, 'Index', 'login'),
(227, '删除备份数据zwjlyh_20160629174733_All.sql！', 1467342842, 1, '0.0.0.0', 1, 'Data', 'deletebak'),
(228, '备份整个数据库！', 1467342853, 1, '0.0.0.0', 1, 'Data', 'backall'),
(229, '表User增加ID为1的记录！', 1467365168, 1, '0.0.0.0', 1, 'User', 'add'),
(230, 'admin登陆成功！', 1467595514, 1, '0.0.0.0', 1, 'Index', 'login'),
(231, '数据表''''优化完成！', 1467602907, 1, '0.0.0.0', 1, 'Data', 'optimize'),
(232, '数据表''lyh_image''修复完成！', 1467603048, 1, '0.0.0.0', 1, 'Data', 'repair'),
(233, '数据表''lyh_admin,lyh_adv,lyh_conf''优化完成！', 1467603101, 1, '0.0.0.0', 1, 'Data', 'optimize'),
(234, '数据表''lyh_admin,lyh_adv,lyh_conf''修复完成！', 1467603697, 1, '0.0.0.0', 1, 'Data', 'repair'),
(235, 'admin登陆成功！', 1467682419, 1, '0.0.0.0', 1, 'Index', 'login'),
(236, '数据表''lyh_hooks''修复完成！', 1467682500, 1, '0.0.0.0', 1, 'Data', 'repair'),
(237, '数据表''lyh_hooks''优化完成！', 1467682504, 1, '0.0.0.0', 1, 'Data', 'optimize'),
(238, '表Menu增加ID为26的记录！', 1467683213, 1, '0.0.0.0', 1, 'Menu', 'add'),
(239, '表Menu增加ID为27的记录！', 1467683271, 1, '0.0.0.0', 1, 'Menu', 'add'),
(240, '表Menu编辑ID为27的记录！', 1467684589, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(241, '表Menu增加ID为28的记录！', 1467700774, 1, '0.0.0.0', 1, 'Menu', 'add'),
(242, '把表Role的ID为4的记录，启用！', 1467701737, 1, '0.0.0.0', 1, 'Role', 'set_effect'),
(243, '把表Role的ID为1的记录，启用！', 1467701739, 1, '0.0.0.0', 1, 'Role', 'set_effect'),
(244, '把表Role的ID为1的记录，禁用！', 1467701740, 1, '0.0.0.0', 1, 'Role', 'set_effect'),
(245, '把表Role的ID为4的记录，禁用！', 1467701741, 1, '0.0.0.0', 1, 'Role', 'set_effect'),
(246, '把表Role的ID为1的记录，禁用！', 1467701742, 1, '0.0.0.0', 1, 'Role', 'set_effect'),
(247, 'admin登陆成功！', 1467768098, 1, '0.0.0.0', 1, 'Index', 'login'),
(248, 'admin登陆成功！', 1467798336, 1, '0.0.0.0', 1, 'Index', 'login'),
(249, '删除表Block的ID为on,18,15,9,6,5,4,3,2的记录！', 1467798983, 1, '0.0.0.0', 1, 'Block', 'delete'),
(250, '表User增加ID为2的记录！', 1467858045, 1, '0.0.0.0', 1, 'User', 'add'),
(251, '表User增加ID为3的记录！', 1467861345, 1, '0.0.0.0', 1, 'User', 'add'),
(252, '删除表User的ID为2,1的记录！', 1467861359, 1, '0.0.0.0', 1, 'User', 'delete'),
(253, '数据表''lyh_block''优化完成！', 1467884860, 1, '0.0.0.0', 1, 'Data', 'optimize'),
(254, '删除表Block的ID为20的记录！', 1467886102, 1, '0.0.0.0', 1, 'Block', 'delete'),
(255, 'admin登陆成功！', 1467940611, 1, '0.0.0.0', 1, 'Index', 'login'),
(256, 'admin登陆成功！', 1468028018, 1, '0.0.0.0', 1, 'Index', 'login'),
(257, '删除表Block的ID为22的记录！', 1468053532, 1, '0.0.0.0', 1, 'Block', 'delete'),
(258, '删除表Block的ID为23的记录！', 1468055093, 1, '0.0.0.0', 1, 'Block', 'delete'),
(259, 'admin登陆成功！', 1468199856, 1, '0.0.0.0', 1, 'Index', 'login'),
(261, '删除表Log的ID为260的记录！', 1468218690, 1, '0.0.0.0', 1, 'Log', 'delete'),
(262, 'admin登陆成功！', 1468807478, 1, '0.0.0.0', 1, 'Index', 'login'),
(263, '表Menu增加ID为29的记录！', 1468807627, 1, '0.0.0.0', 1, 'Menu', 'add'),
(264, '表Menu编辑ID为29的记录！', 1468808586, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(265, '删除表Record的ID为1的记录！', 1468811125, 1, '0.0.0.0', 1, 'Record', 'delete'),
(266, '表Record增加ID为3的记录！', 1468811228, 1, '0.0.0.0', 1, 'Record', 'add'),
(267, '删除表Record的ID为2的记录！', 1468811246, 1, '0.0.0.0', 1, 'Record', 'delete'),
(268, '表Record增加ID为4的记录！', 1468811276, 1, '0.0.0.0', 1, 'Record', 'add'),
(269, '表Record增加ID为5的记录！', 1468812734, 1, '0.0.0.0', 1, 'Record', 'add'),
(270, '删除表Record的ID为6的记录！', 1468822047, 1, '0.0.0.0', 1, 'Record', 'delete'),
(271, '表Menu增加ID为30的记录！', 1469071304, 1, '0.0.0.0', 1, 'Menu', 'add'),
(272, '表Menu增加ID为31的记录！', 1469071450, 1, '0.0.0.0', 1, 'Menu', 'add'),
(273, '表Menu增加ID为32的记录！', 1469071622, 1, '0.0.0.0', 1, 'Menu', 'add'),
(274, '表Menu编辑ID为32的记录！', 1469071636, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(275, '表Menu编辑ID为32的记录！', 1469072396, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(276, '表Good_cate增加ID为1的记录！', 1469079454, 1, '0.0.0.0', 1, 'Good_cate', 'add'),
(277, '表Good_cate增加ID为2的记录！', 1469079532, 1, '0.0.0.0', 1, 'Good_cate', 'add'),
(278, '表Menu编辑ID为32的记录！', 1469081497, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(279, '表Menu编辑ID为32的记录！', 1469084056, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(280, '表Menu增加ID为33的记录！', 1469086088, 1, '0.0.0.0', 1, 'Menu', 'add'),
(281, '表Menu增加ID为34的记录！', 1469089268, 1, '0.0.0.0', 1, 'Menu', 'add'),
(282, '表Goods增加ID为1的记录！', 1469090477, 1, '0.0.0.0', 1, 'Goods', 'add'),
(283, '表Goods编辑ID为1的记录！', 1469090646, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(284, '表Goods编辑ID为1的记录！', 1469093027, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(285, '表Goods编辑ID为1的记录！', 1469095223, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(286, '表Goods编辑ID为1的记录！', 1469095262, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(287, '表Goods编辑ID为1的记录！', 1469095626, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(288, 'admin登陆成功！', 1469149648, 1, '0.0.0.0', 1, 'Index', 'login'),
(289, '表Goods编辑ID为1的记录！', 1469149698, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(290, '表Goods编辑ID为1的记录！', 1469150423, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(291, '表Goods编辑ID为1的记录！', 1469150840, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(292, '表Goods编辑ID为1的记录！', 1469151484, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(293, '表Goods编辑ID为1的记录！', 1469151759, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(294, '表Goods编辑ID为1的记录！', 1469152129, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(295, '表Goods编辑ID为1的记录！', 1469152240, 1, '0.0.0.0', 1, 'Goods', 'edit'),
(296, '表Goods增加ID为2的记录！', 1469152547, 1, '0.0.0.0', 1, 'Goods', 'add'),
(297, '把表Goods的ID为2的记录，放入回收站！', 1469152601, 1, '0.0.0.0', 1, 'Goods', 'del'),
(298, '表Menu增加ID为35的记录！', 1469152904, 1, '0.0.0.0', 1, 'Menu', 'add'),
(299, '表Menu编辑ID为25的记录！', 1469154168, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(300, '表Menu编辑ID为24的记录！', 1469154184, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(301, '表Menu编辑ID为35的记录！', 1469154207, 1, '0.0.0.0', 1, 'Menu', 'edit'),
(302, '把表Goods的ID为2的记录，恢复成功！', 1469157670, 1, '0.0.0.0', 1, 'Goods', 'restore'),
(303, '表Menu增加ID为36的记录！', 1469167385, 1, '0.0.0.0', 1, 'Menu', 'add'),
(304, '修改表Menu的num字段值！', 1469167401, 1, '0.0.0.0', 1, 'Menu', 'ajax_edit'),
(305, 'admin登陆成功！', 1469238194, 1, '0.0.0.0', 1, 'Index', 'login'),
(306, 'admin登陆成功！', 1469409327, 1, '0.0.0.0', 1, 'Index', 'login'),
(307, 'admin登陆成功！', 1469496529, 1, '0.0.0.0', 1, 'Index', 'login'),
(308, 'admin登陆成功！', 1470031252, 1, '0.0.0.0', 1, 'Index', 'login'),
(309, '删除表Adv的ID为5的记录！', 1470274867, 1, '0.0.0.0', 1, 'Adv', 'delete'),
(310, '删除表Adv的ID为4的记录！', 1470274887, 1, '0.0.0.0', 1, 'Adv', 'delete'),
(311, 'admin登陆成功！', 1470625066, 1, '0.0.0.0', 1, 'Index', 'login'),
(312, '表Menu增加ID为37的记录！', 1470626209, 1, '0.0.0.0', 1, 'Menu', 'add'),
(313, '表GoodsType增加ID为1的记录！', 1470626791, 1, '0.0.0.0', 1, 'GoodsType', 'add'),
(314, '把表GoodsType的ID为1的记录，启用！', 1470626912, 1, '0.0.0.0', 1, 'GoodsType', 'set_effect'),
(315, '把表GoodsType的ID为1的记录，禁用！', 1470626914, 1, '0.0.0.0', 1, 'GoodsType', 'set_effect'),
(316, '把表GoodsType的ID为1的记录，禁用！', 1470626915, 1, '0.0.0.0', 1, 'GoodsType', 'set_effect'),
(317, '把表GoodsType的ID为1的记录，禁用！', 1470626916, 1, '0.0.0.0', 1, 'GoodsType', 'set_effect'),
(318, '把表GoodsType的ID为1的记录，禁用！', 1470626917, 1, '0.0.0.0', 1, 'GoodsType', 'set_effect'),
(319, '把表GoodsType的ID为1的记录，禁用！', 1470626919, 1, '0.0.0.0', 1, 'GoodsType', 'set_effect'),
(320, '把表GoodsType的ID为1的记录，禁用！', 1470626920, 1, '0.0.0.0', 1, 'GoodsType', 'set_effect'),
(321, '把表GoodsType的ID为1的记录，禁用！', 1470626921, 1, '0.0.0.0', 1, 'GoodsType', 'set_effect'),
(322, 'admin登陆成功！', 1470970438, 1, '0.0.0.0', 1, 'Index', 'login'),
(323, '把表GoodsType的ID为1的记录，禁用！', 1470980051, 1, '0.0.0.0', 1, 'GoodsType', 'set_effect'),
(324, '表GoodsType编辑ID为1的记录！', 1470980067, 1, '0.0.0.0', 1, 'GoodsType', 'edit'),
(325, '给商品类型增加属性ID为1的记录！', 1470992320, 1, '0.0.0.0', 1, 'GoodsType', 'attr_add'),
(326, '商品类型编辑属性ID为1的记录！', 1470994338, 1, '0.0.0.0', 1, 'GoodsType', 'attr_edit'),
(327, 'admin登陆成功！', 1471050784, 1, '0.0.0.0', 1, 'Index', 'login'),
(328, 'admin登陆成功！', 1471223748, 1, '0.0.0.0', 1, 'Index', 'login'),
(329, '给商品《测试商品》添加商品属性！', 1471243244, 1, '0.0.0.0', 1, 'Goods', 'attr_save'),
(330, '给商品《测试商品》添加商品属性！', 1471244675, 1, '0.0.0.0', 1, 'Goods', 'attr_save'),
(331, '商品类型增加属性ID为2的记录！', 1471245050, 1, '0.0.0.0', 1, 'GoodsType', 'attr_add'),
(332, '给商品《测试商品》添加商品属性！', 1471245084, 1, '0.0.0.0', 1, 'Goods', 'attr_save'),
(333, '给商品《测试商品》添加商品属性！', 1471245223, 1, '0.0.0.0', 1, 'Goods', 'attr_save'),
(334, '给商品《测试商品》添加商品属性！', 1471245240, 1, '0.0.0.0', 1, 'Goods', 'attr_save'),
(335, 'admin登陆成功！', 1478766635, 1, '0.0.0.0', 1, 'Index', 'login'),
(336, 'admin登陆成功！', 1479195099, 1, '0.0.0.0', 1, 'Index', 'login'),
(337, 'admin登陆成功！', 1480485936, 1, '0.0.0.0', 1, 'Index', 'login'),
(338, 'admin登陆成功！', 1481002352, 1, '0.0.0.0', 1, 'Index', 'login');

-- --------------------------------------------------------

--
-- 表的结构 `lyh_menu`
--

CREATE TABLE IF NOT EXISTS `lyh_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `data` varchar(100) DEFAULT NULL,
  `num` int(4) DEFAULT '1',
  `status` smallint(1) NOT NULL,
  `info` varchar(255) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `table` bigint(1) DEFAULT '0' COMMENT '0不可设计表，1可设计表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `lyh_menu`
--

INSERT INTO `lyh_menu` (`id`, `pid`, `name`, `model`, `action`, `data`, `num`, `status`, `info`, `icon`, `table`) VALUES
(1, 0, '全局', NULL, NULL, NULL, 1, 1, '', 'home', 0),
(2, 1, '菜单管理', 'Menu', 'index', NULL, 20, 1, '', NULL, 0),
(3, 2, '菜单列表', 'Menu', 'index', NULL, 1, 1, '', NULL, 0),
(4, 1, '权限管理', 'Role', 'index', NULL, 2, 1, '', NULL, 0),
(5, 4, '权限列表', 'Role', 'index', NULL, 0, 1, '', NULL, 0),
(7, 0, '系统', NULL, NULL, NULL, 3, 1, '', 'cost', 0),
(8, 7, '系统设置', 'Conf', 'index', NULL, 0, 1, '', NULL, 0),
(9, 8, '系统配置', 'Conf', 'index', NULL, 1, 1, '', NULL, 0),
(10, 8, '图片配置', 'Conf', 'image', NULL, 2, 1, '', NULL, 0),
(11, 8, '邮箱设置', 'Conf', 'mail', NULL, 3, 1, '', NULL, 0),
(12, 7, '广告管理', 'adv', 'index', NULL, 0, 1, '', NULL, 1),
(13, 12, '广告列表', 'adv', 'index', NULL, 0, 1, '', NULL, 0),
(14, 1, '管理员管理', 'Admin', 'index', NULL, 1, 1, '', NULL, 0),
(15, 14, '管理员列表', 'Admin', 'index', NULL, 0, 1, '', NULL, 0),
(16, 14, '回收站', 'Admin', 'delete_index', NULL, 0, 1, '', NULL, 0),
(18, 19, '日记列表', 'Log', 'index', NULL, 20, 1, '', NULL, 0),
(19, 1, '后台管理', 'index', 'index', NULL, 0, 1, '', NULL, 0),
(20, 19, '后台首页', 'index', 'home', NULL, 10, 1, '', NULL, 0),
(21, 1, '数据备份', 'Data', 'index', NULL, 0, 1, '', NULL, 0),
(22, 21, '备份列表', 'Data', 'index', NULL, 0, 1, '', NULL, 0),
(23, 21, '备份数据', 'Data', 'tablist', NULL, 10, 1, '', NULL, 0),
(24, 1, '会员管理', 'User', 'index', '', 10, 1, '', NULL, 0),
(25, 24, '会员列表', 'User', 'index', '', 0, 1, '', NULL, 1),
(26, 7, '扩展管理', '', '', '', 0, 1, '', NULL, 0),
(27, 26, '钩子管理', 'Block', 'hooks', '', 0, 1, '', NULL, 0),
(28, 26, '模块管理', 'Block', 'index', '', 0, 1, '', NULL, 0),
(29, 24, '会员记录', 'Record', 'index', '', 10, 1, '会员的余额和积分的收支记录', NULL, 1),
(30, 0, '商品', '', '', '', 10, 1, '商品管理', 'package', 0),
(31, 30, '分类管理', '', '', '', 10, 1, '', NULL, 0),
(32, 31, '分类列表', 'good_cate', 'index', '', 10, 1, '', NULL, 1),
(33, 30, '商品管理', '', '', '', 20, 1, '', NULL, 0),
(34, 33, '商品列表', 'goods', 'index', 'is_delete=0', 10, 1, '', NULL, 1),
(35, 33, '回收站', 'goods', 'index', 'is_delete=1', 20, 1, '回收站中的商品', NULL, 1),
(36, 33, '购物车', 'cart', 'index', '', 30, 0, '', NULL, 1),
(37, 33, '商品类型', 'GoodsType', 'index', '', 10, 1, '', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_operate`
--

CREATE TABLE IF NOT EXISTS `lyh_operate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sort` tinyint(4) DEFAULT '0',
  `url` varchar(200) NOT NULL,
  `show` bit(1) NOT NULL DEFAULT b'1',
  `menu_id` int(11) DEFAULT '0' COMMENT '菜单ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `lyh_operate`
--

INSERT INTO `lyh_operate` (`id`, `table`, `name`, `sort`, `url`, `show`, `menu_id`) VALUES
(2, 'adv', '编辑', 10, 'javascript:edit($id);', '1', 0),
(3, 'adv', '删除', 30, 'http://localhost/zwj/admin.php/adv/delete/id/$id.html', '1', 0),
(4, 'user', '编辑', 10, 'javascript:edit($id);', '1', 25),
(5, 'user', '删除', 20, 'javascript:foreverdel($id)', '1', 25),
(6, 'record', '删除', 10, 'javascript:foreverdel($id)', '1', 29),
(7, 'good_cate', '编辑', 10, 'javascript:edit($id);', '1', 32),
(8, 'good_cate', '删除', 20, 'javascript:foreverdel($id);', '1', 32),
(9, 'goods', '编辑', 10, 'javascript:edit($id);', '1', 34),
(10, 'goods', '放入回收站', 20, 'javascript:del($id);', '1', 34),
(11, 'goods', '恢复', 10, 'javascript:restore($id);', '1', 35),
(12, 'goods', '彻底删除', 20, 'javascript:foreverdel($id);', '1', 35),
(13, 'goods', '商品属性', 1, 'http://localhost/zwj/admin.php/Goods/attr/goods_id/$id.html', '1', 34);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_record`
--

CREATE TABLE IF NOT EXISTS `lyh_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '所属会员',
  `msg` varchar(255) DEFAULT NULL COMMENT '记录说明',
  `create_time` int(11) DEFAULT NULL COMMENT '记录时间',
  `type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '记录类型',
  `status` tinyint(3) NOT NULL COMMENT '记录状态',
  `price` double(10,2) NOT NULL COMMENT '变更金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `lyh_record`
--

INSERT INTO `lyh_record` (`id`, `user_id`, `msg`, `create_time`, `type`, `status`, `price`) VALUES
(3, 3, '增加余额', 1468811228, 1, 1, 100.00),
(4, 3, '增加积分', 1468811276, 2, 1, 50.00),
(5, 3, '减少余额', 1468812733, 1, 0, 50.00);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_role`
--

CREATE TABLE IF NOT EXISTS `lyh_role` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `remark` text NOT NULL,
  `is_effect` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否放入回收站',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `lyh_role`
--

INSERT INTO `lyh_role` (`id`, `name`, `remark`, `is_effect`, `is_delete`) VALUES
(1, '超级管理员', '超级管理员', 0, 0),
(4, '高级管理员', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_role_menu`
--

CREATE TABLE IF NOT EXISTS `lyh_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lyh_role_menu`
--

INSERT INTO `lyh_role_menu` (`role_id`, `menu_id`) VALUES
(1, 8),
(1, 9),
(1, 10),
(1, 11);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_table`
--

CREATE TABLE IF NOT EXISTS `lyh_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(20) NOT NULL COMMENT '表名',
  `name` varchar(80) NOT NULL,
  `field` varchar(20) DEFAULT NULL COMMENT '字段名',
  `explain` varchar(100) DEFAULT NULL COMMENT '字段说明',
  `sort` tinyint(5) DEFAULT NULL,
  `show` tinyint(1) DEFAULT NULL,
  `notempty` tinyint(1) DEFAULT NULL COMMENT '是否为空',
  `search` tinyint(1) DEFAULT NULL COMMENT '是否可搜索',
  `only` tinyint(1) DEFAULT NULL COMMENT '是否唯一',
  `attr` varchar(100) DEFAULT NULL COMMENT '附加属性',
  `type` tinyint(2) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL COMMENT '数据',
  `default` varchar(50) DEFAULT NULL COMMENT '默认值',
  `hide` tinyint(1) DEFAULT '0' COMMENT '是否隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `lyh_table`
--

INSERT INTO `lyh_table` (`id`, `table`, `name`, `field`, `explain`, `sort`, `show`, `notempty`, `search`, `only`, `attr`, `type`, `data`, `default`, `hide`) VALUES
(3, 'adv', '广告名称', 'name', '', 10, 1, 1, 1, 0, '', 1, NULL, NULL, 0),
(4, 'adv', '广告标识', 'code', '用于查询广告，单广告不可重复，轮播广告可重复', 20, 1, 0, 0, 0, '', 1, NULL, NULL, 0),
(6, 'adv', '广告长度', 'width', '', 40, 0, 0, 0, 0, '', 2, NULL, NULL, 0),
(7, 'adv', '广告高度', 'height', '', 50, 0, 0, 0, 0, '', 2, NULL, NULL, 0),
(8, 'adv', '广告类型', 'type', '', 60, 1, 0, 0, 0, '', 9, '0=单广告|1=轮播广告', NULL, 0),
(9, 'adv', '广告图片', 'image', '', 30, 1, 0, 0, 0, '', 6, NULL, NULL, 0),
(10, 'adv', '广告链接', 'url', '', 100, 0, 0, 0, 0, '', 1, NULL, NULL, 0),
(11, 'user', '用户名', 'username', '', 10, 1, 1, 1, 1, '', 1, NULL, '', 0),
(12, 'user', '登陆密码', 'password', '', 20, 0, 1, 0, 0, '', 3, NULL, '', 0),
(13, 'user', '真实姓名', 'realname', '', 30, 0, 0, 0, 0, '', 1, NULL, '', 0),
(14, 'user', '用户昵称', 'nickname', '', 40, 0, 0, 0, 0, '', 1, NULL, '', 0),
(15, 'user', '手机号码', 'mobile', '', 50, 1, 0, 1, 1, '', 12, NULL, '', 0),
(16, 'user', '电子邮箱', 'email', '', 60, 0, 0, 1, 0, '', 1, NULL, '', 0),
(17, 'user', '账户余额', 'money', '', 70, 1, 0, 0, 0, 'readonly', 14, NULL, '0', 1),
(18, 'user', '账户积分', 'integral', '', 80, 1, 0, 0, 0, 'readonly', 2, NULL, '0', 1),
(19, 'user', '状态', 'is_effect', '', 90, 0, 0, 0, 0, '', 9, '1=启用|2=禁用', '1', 0),
(20, 'user', '创建时间', 'create_time', '', 100, 1, 0, 0, 0, '', 15, NULL, '', 1),
(21, 'user', '最近登陆', 'log_time', '', 110, 1, 0, 0, 0, '', 15, NULL, '', 1),
(22, 'user', '登陆IP', 'log_ip', '', 120, 0, 0, 0, 0, '', 1, NULL, '', 1),
(23, 'record', '所属会员', 'user_id', '', 10, 1, 1, 0, 0, '', 8, 'user|username', '', 0),
(24, 'record', '记录说明', 'msg', '', 20, 1, 0, 0, 0, '', 4, NULL, '', 0),
(25, 'record', '记录时间', 'create_time', '', 60, 1, 0, 1, 0, '', 15, NULL, '', 1),
(26, 'record', '记录类型', 'type', '', 40, 1, 1, 0, 0, '', 9, '1=余额|2=积分', '1', 0),
(27, 'record', '记录状态', 'status', '', 50, 1, 1, 0, 0, '', 9, '0=减少|1=增加', '0', 0),
(28, 'record', '变更金额', 'price', '', 25, 1, 1, 0, 0, '', 14, NULL, '0', 0),
(29, 'good_cate', '父级分类', 'pid', '', 10, 1, 0, 0, 0, '0', 8, 'good_cate|name', '', 0),
(30, 'good_cate', '分类名称', 'name', '', 20, 1, 1, 0, 0, '', 1, NULL, '', 0),
(31, 'good_cate', '分类状态', 'is_effect', '', 30, 1, 0, 1, 0, '1', 9, '0=开启|1=关闭', '', 0),
(32, 'good_cate', '创建日期', 'create_time', '', 40, 1, 0, 0, 0, '', 15, NULL, '', 1),
(33, 'goods', '商品名称', 'name', '', 10, 1, 1, 1, 0, '', 1, NULL, '', 0),
(34, 'goods', '商品分类', 'cate_id', '', 20, 1, 1, 0, 0, '', 8, 'good_cate|name', '', 0),
(35, 'goods', '商品图册', 'images', '', 30, 0, 0, 0, 0, '', 16, NULL, '', 0),
(36, 'goods', '商品价格', 'price', '', 40, 1, 0, 1, 0, '', 14, NULL, '', 0),
(37, 'goods', '商品库存', 'iamount', '', 50, 1, 0, 0, 0, '0', 2, NULL, '', 0),
(38, 'goods', '商品状态', 'is_effect', '', 60, 1, 0, 0, 0, '1', 9, '0=下架|1=上架', '', 0),
(39, 'goods', '放入回收站', 'is_delete', '', 70, 0, 0, 0, 0, '0', 2, NULL, '', 1),
(40, 'goods', '创建日期', 'create_time', '', 80, 0, 0, 1, 0, '', 15, NULL, '', 1),
(41, 'cart', '所属用户', 'user_id', '', 10, 1, 0, 0, 0, '', 8, 'user|username', '', 0),
(42, 'cart', ' 商品名称', 'goods_id', '', 20, 1, 0, 0, 0, '', 8, 'goods|name', '', 0),
(43, 'cart', '购买数量', 'num', '', 30, 1, 0, 0, 0, '1', 2, NULL, '', 0),
(44, 'cart', '商品单价', 'price', '', 40, 1, 0, 0, 0, '0', 14, NULL, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_table_copy`
--

CREATE TABLE IF NOT EXISTS `lyh_table_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(20) NOT NULL COMMENT '表名',
  `name` varchar(80) NOT NULL,
  `field` varchar(20) DEFAULT NULL COMMENT '字段名',
  `explain` varchar(100) DEFAULT NULL COMMENT '字段说明',
  `sort` tinyint(5) DEFAULT NULL,
  `show` tinyint(1) DEFAULT NULL,
  `notempty` tinyint(1) DEFAULT NULL COMMENT '是否为空',
  `search` tinyint(1) DEFAULT NULL COMMENT '是否可搜索',
  `only` tinyint(1) DEFAULT NULL COMMENT '是否唯一',
  `attr` varchar(100) DEFAULT NULL COMMENT '附加属性',
  `type` tinyint(2) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL COMMENT '数据',
  `default` varchar(50) DEFAULT NULL COMMENT '默认值',
  `hide` tinyint(1) DEFAULT '0' COMMENT '是否隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `lyh_table_copy`
--

INSERT INTO `lyh_table_copy` (`id`, `table`, `name`, `field`, `explain`, `sort`, `show`, `notempty`, `search`, `only`, `attr`, `type`, `data`, `default`, `hide`) VALUES
(3, 'adv', '广告名称', 'name', '', 10, 1, 1, 1, 0, '', 1, NULL, NULL, 0),
(4, 'adv', '广告标识', 'code', '用于查询广告，单广告不可重复，轮播广告可重复', 20, 1, 0, 0, 0, '', 1, NULL, NULL, 0),
(6, 'adv', '广告长度', 'width', '', 40, 0, 0, 0, 0, '', 2, NULL, NULL, 0),
(7, 'adv', '广告高度', 'height', '', 50, 0, 0, 0, 0, '', 2, NULL, NULL, 0),
(8, 'adv', '广告类型', 'type', '', 60, 1, 0, 0, 0, '', 9, '0=单广告|1=轮播广告', NULL, 0),
(9, 'adv', '广告图片', 'image', '', 30, 1, 0, 0, 0, '', 6, NULL, NULL, 0),
(10, 'adv', '广告链接', 'url', '', 100, 0, 0, 0, 0, '', 1, NULL, NULL, 0),
(11, 'user', '用户名', 'username', '', 10, 1, 1, 1, 1, '', 1, NULL, '', 0),
(12, 'user', '登陆密码', 'password', '', 20, 0, 1, 0, 0, '', 3, NULL, '', 0),
(13, 'user', '真实姓名', 'realname', '', 30, 0, 0, 0, 0, '', 1, NULL, '', 0),
(14, 'user', '用户昵称', 'nickname', '', 40, 0, 0, 0, 0, '', 1, NULL, '', 0),
(15, 'user', '手机号码', 'mobile', '', 50, 1, 0, 1, 1, '', 12, NULL, '', 0),
(16, 'user', '电子邮箱', 'email', '', 60, 0, 0, 1, 0, '', 1, NULL, '', 0),
(17, 'user', '账户余额', 'money', '', 70, 1, 0, 0, 0, 'readonly', 14, NULL, '0', 1),
(18, 'user', '账户积分', 'integral', '', 80, 1, 0, 0, 0, 'readonly', 2, NULL, '0', 1),
(19, 'user', '状态', 'is_effect', '', 90, 0, 0, 0, 0, '', 9, '1=启用|2=禁用', '1', 0),
(20, 'user', '创建时间', 'create_time', '', 100, 1, 0, 0, 0, '', 15, NULL, '', 1),
(21, 'user', '最近登陆', 'log_time', '', 110, 1, 0, 0, 0, '', 15, NULL, '', 1),
(22, 'user', '登陆IP', 'log_ip', '', 120, 0, 0, 0, 0, '', 1, NULL, '', 1),
(23, 'record', '所属会员', 'user_id', '', 10, 1, 1, 0, 0, '', 8, 'user|username', '', 0),
(24, 'record', '记录说明', 'msg', '', 20, 1, 0, 0, 0, '', 4, NULL, '', 0),
(25, 'record', '记录时间', 'create_time', '', 60, 1, 0, 1, 0, '', 15, NULL, '', 1),
(26, 'record', '记录类型', 'type', '', 40, 1, 1, 0, 0, '', 9, '1=余额|2=积分', '1', 0),
(27, 'record', '记录状态', 'status', '', 50, 1, 1, 0, 0, '', 9, '0=减少|1=增加', '0', 0),
(28, 'record', '变更金额', 'price', '', 25, 1, 1, 0, 0, '', 14, NULL, '0', 0),
(29, 'good_cate', '父级分类', 'pid', '', 10, 1, 0, 0, 0, '0', 8, 'good_cate|name', '', 0),
(30, 'good_cate', '分类名称', 'name', '', 20, 1, 1, 0, 0, '', 1, NULL, '', 0),
(31, 'good_cate', '分类状态', 'is_effect', '', 30, 1, 0, 1, 0, '1', 9, '0=开启|1=关闭', '', 0),
(32, 'good_cate', '创建日期', 'create_time', '', 40, 1, 0, 0, 0, '', 15, NULL, '', 1),
(33, 'goods', '商品名称', 'name', '', 10, 1, 1, 1, 0, '', 1, NULL, '', 0),
(34, 'goods', '商品分类', 'cate_id', '', 20, 1, 1, 0, 0, '', 8, 'good_cate|name', '', 0),
(35, 'goods', '商品图册', 'images', '', 30, 0, 0, 0, 0, '', 16, NULL, '', 0),
(36, 'goods', '商品价格', 'price', '', 40, 1, 0, 1, 0, '', 14, NULL, '', 0),
(37, 'goods', '商品库存', 'iamount', '', 50, 1, 0, 0, 0, '0', 2, NULL, '', 0),
(38, 'goods', '商品状态', 'is_effect', '', 60, 1, 0, 0, 0, '1', 9, '0=下架|1=上架', '', 0),
(39, 'goods', '放入回收站', 'is_delete', '', 70, 0, 0, 0, 0, '0', 2, NULL, '', 1),
(40, 'goods', '创建日期', 'create_time', '', 80, 0, 0, 1, 0, '', 15, NULL, '', 1),
(41, 'cart', '所属用户', 'user_id', '', 10, 1, 0, 0, 0, '', 8, 'user|username', '', 0),
(42, 'cart', ' 商品名称', 'goods_id', '', 20, 1, 0, 0, 0, '', 8, 'goods|name', '', 0),
(43, 'cart', '购买数量', 'num', '', 30, 1, 0, 0, 0, '1', 2, NULL, '', 0),
(44, 'cart', '商品单价', 'price', '', 40, 1, 0, 0, 0, '0', 14, NULL, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `lyh_user`
--

CREATE TABLE IF NOT EXISTS `lyh_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '登陆密码',
  `realname` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `nickname` varchar(50) DEFAULT NULL COMMENT '用户昵称',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号码',
  `email` varchar(50) DEFAULT NULL COMMENT '电子邮箱',
  `money` double(10,2) DEFAULT NULL COMMENT '账户余额',
  `integral` int(11) DEFAULT NULL COMMENT '账户积分',
  `is_effect` tinyint(3) DEFAULT '1' COMMENT '状态',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `log_time` int(11) DEFAULT NULL COMMENT '最近登陆',
  `log_ip` varchar(50) DEFAULT NULL COMMENT '登陆IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `lyh_user`
--

INSERT INTO `lyh_user` (`id`, `username`, `password`, `realname`, `nickname`, `mobile`, `email`, `money`, `integral`, `is_effect`, `create_time`, `log_time`, `log_ip`) VALUES
(3, 'test3', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', 60.00, 50, 1, 1467861345, 1467861345, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
