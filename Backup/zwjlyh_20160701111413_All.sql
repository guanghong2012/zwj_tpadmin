/* This file is created by MySQLReback 2016-07-01 11:14:13 */
 /* 创建表结构 `lyh_admin`  */
 DROP TABLE IF EXISTS `lyh_admin`;/* MySQLReback Separation */ CREATE TABLE `lyh_admin` (
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lyh_admin` */
 INSERT INTO `lyh_admin` VALUES ('1','admin','3c086f596b4aee58e1d71b3626fefc87','1','0','1','1467339177','0.0.0.0');/* MySQLReback Separation */
 /* 创建表结构 `lyh_adv`  */
 DROP TABLE IF EXISTS `lyh_adv`;/* MySQLReback Separation */ CREATE TABLE `lyh_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '广告名称',
  `code` varchar(50) DEFAULT NULL COMMENT '广告标识',
  `image` varchar(100) DEFAULT NULL COMMENT '广告图片',
  `width` int(11) DEFAULT NULL COMMENT '广告长度',
  `height` int(11) DEFAULT NULL COMMENT '广告高度',
  `type` tinyint(3) DEFAULT NULL COMMENT '广告类型',
  `url` varchar(50) DEFAULT NULL COMMENT '广告链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lyh_adv` */
 INSERT INTO `lyh_adv` VALUES ('4','深圳工业总会','creatego','Adv/2016/06/12/575d128130b90.jpg','550','600','0',null);/* MySQLReback Separation */
 /* 创建表结构 `lyh_conf`  */
 DROP TABLE IF EXISTS `lyh_conf`;/* MySQLReback Separation */ CREATE TABLE `lyh_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '配置名称',
  `value` varchar(50) DEFAULT NULL COMMENT '配置值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lyh_conf` */
 INSERT INTO `lyh_conf` VALUES ('1','WATER_ALPHA','80%'),('2','WATER_POSITION','9'),('3','WATER','1'),('4','IMG_SIXE','102400'),('5','IMG_TYPE','jpg,png'),('6','THUMB','1'),('7','THUMB_WIDTH','200'),('8','THUMB_HEIGHT','200'),('9','THUMB_TYPE','1'),('10','WATER_IMG','Conf/2015/11/03/5638187f4fe3d.png'),('13','SITE_NAME','测试'),('14','SEO_KEYWORD',null),('15','SEO_DESCRIPTION',null),('16','SITE_LICENSE',null),('17','LOGO','Conf/2015/11/03/563829b63d7fc.png'),('18','MAIL_HOST','smtp.sina.com'),('19','MAIL_SMTPAUTH','true'),('20','MAIL_FROMNAME','测试发件'),('21','MAIL_USERNAME','lyhzwj@sina.com'),('22','MAIL_FROM','lyhzwj@sina.com'),('23','MAIL_PASSWORD','lyhzwj'),('24','MAIL_CHARSET','utf-8'),('25','MAIL_ISHTML','true'),('26','MOBILE','1');/* MySQLReback Separation */
 /* 创建表结构 `lyh_image`  */
 DROP TABLE IF EXISTS `lyh_image`;/* MySQLReback Separation */ CREATE TABLE `lyh_image` (
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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lyh_image` */
 INSERT INTO `lyh_image` VALUES ('57','Admin','0','Conf','WATER_IMG','1774','Conf/2015/11/03/5638187f4fe3d.png','0','1'),('63','Admin','0','Adv','image','6490','Adv/2016/05/03/57285d1597436.jpg','1','0'),('64','Admin','0','Adv','image','4639','Adv/2016/05/03/57285d2a4a749.jpg','1','0');/* MySQLReback Separation */
 /* 创建表结构 `lyh_log`  */
 DROP TABLE IF EXISTS `lyh_log`;/* MySQLReback Separation */ CREATE TABLE `lyh_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_info` text NOT NULL COMMENT '日志描述内容',
  `log_time` int(11) NOT NULL COMMENT '发生时间',
  `log_admin` int(11) NOT NULL COMMENT ' 操作的管理员ID',
  `log_ip` varchar(255) NOT NULL COMMENT '操作者IP',
  `log_status` tinyint(1) NOT NULL COMMENT '操作结果 1:操作成功 0:操作失败',
  `module` varchar(255) NOT NULL COMMENT '操作的模块module',
  `action` varchar(255) NOT NULL COMMENT '操作的命令action',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=228 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lyh_log` */
 INSERT INTO `lyh_log` VALUES ('97','admin登陆成功！','1463134307','1','0.0.0.0','1','Index','login'),('98','admin登陆成功！','1464836357','1','0.0.0.0','1','Index','login'),('99','admin登陆成功！','1464915749','1','0.0.0.0','1','Index','login'),('100','表Adv增加ID为1的记录！','1464922420','1','0.0.0.0','1','Adv','add'),('101','表Adv增加ID为2的记录！','1464922542','1','0.0.0.0','1','Adv','add'),('102','表Adv增加ID为3的记录！','1464922595','1','0.0.0.0','1','Adv','add'),('103','删除表Adv的ID为1的记录！','1464940428','1','0.0.0.0','1','Adv','delete'),('104','删除表Role的ID为5的记录！','1464940445','1','0.0.0.0','1','Role','delete'),('105','表Adv增加ID为4的记录！','1464940839','1','0.0.0.0','1','Adv','add'),('106','表Menu增加ID为17的记录！','1464945975','1','0.0.0.0','1','Menu','add'),('107','表Menu增加ID为18的记录！','1464946032','1','0.0.0.0','1','Menu','add'),('108','admin登陆成功！','1465176764','1','0.0.0.0','1','Index','login'),('109','表Adv增加ID为1的记录！','1465180105','1','0.0.0.0','1','Adv','add'),('110','删除表Adv的ID为1的记录！','1465180670','1','0.0.0.0','1','Adv','delete'),('111','表Menu编辑ID为8的记录！','1465201811','1','0.0.0.0','1','Menu','edit'),('112','表Menu编辑ID为8的记录！','1465201913','1','0.0.0.0','1','Menu','edit'),('113','表Menu编辑ID为12的记录！','1465201930','1','0.0.0.0','1','Menu','edit'),('114','admin登陆成功！','1465269604','1','0.0.0.0','1','Index','login'),('115','表Menu增加ID为19的记录！','1465279026','1','0.0.0.0','1','Menu','add'),('116','表Menu增加ID为20的记录！','1465279118','1','0.0.0.0','1','Menu','add'),('117','表Menu编辑ID为18的记录！','1465279135','1','0.0.0.0','1','Menu','edit'),('118','修改表Menu的sort字段值！','1465279514','1','0.0.0.0','1','Menu','ajax_edit'),('119','修改表Menu的sort字段值！','1465279524','1','0.0.0.0','1','Menu','ajax_edit'),('120','修改表Menu的sort字段值！','1465279606','1','0.0.0.0','1','Menu','ajax_edit'),('121','修改表Menu的sort字段值！','1465279639','1','0.0.0.0','1','Menu','ajax_edit'),('122','表Menu编辑ID为2的记录！','1465279662','1','0.0.0.0','1','Menu','edit'),('123','修改表Menu的sort字段值！','1465279676','1','0.0.0.0','1','Menu','ajax_edit'),('124','修改表Menu的sort字段值！','1465279763','1','0.0.0.0','1','Menu','ajax_edit'),('125','修改表Menu的sort字段值！','1465279779','1','0.0.0.0','1','Menu','ajax_edit'),('126','修改表Menu的trim字段值！','1465280616','1','0.0.0.0','1','Menu','ajax_edit'),('127','修改表Menu的trim字段值！','1465280635','1','0.0.0.0','1','Menu','ajax_edit'),('128','修改表Menu的num字段值！','1465280751','1','0.0.0.0','1','Menu','ajax_edit'),('129','修改表Menu的num字段值！','1465280765','1','0.0.0.0','1','Menu','ajax_edit'),('130','修改表Menu的num字段值！','1465280789','1','0.0.0.0','1','Menu','ajax_edit'),('131','表Menu编辑ID为20的记录！','1465280938','1','0.0.0.0','1','Menu','edit'),('132','admin登陆成功！','1465285210','1','0.0.0.0','1','Index','login'),('133','admin登陆成功！','1465353547','1','0.0.0.0','1','Index','login'),('134','表Menu增加ID为21的记录！','1465353607','1','0.0.0.0','1','Menu','add'),('135','表Menu增加ID为22的记录！','1465353639','1','0.0.0.0','1','Menu','add'),('136','表Menu增加ID为23的记录！','1465357630','1','0.0.0.0','1','Menu','add'),('137','下载备份数据zwjlyh_20160608141313_868957097.sql！','1465372417','1','0.0.0.0','1','Data','downloadBak'),('138','删除备份数据zwjlyh_20160607161710_883752402.sql！','1465372507','1','0.0.0.0','1','Data','deletebak'),('139','删除备份数据zwjlyh_20160607161711_527318506.sql！','1465372512','1','0.0.0.0','1','Data','deletebak'),('140','删除备份数据zwjlyh_20160607161727_332229565.sql！','1465372516','1','0.0.0.0','1','Data','deletebak'),('141','删除备份数据zwjlyh_20160607161733_928767817.sql！','1465372521','1','0.0.0.0','1','Data','deletebak'),('142','删除备份数据zwjlyh_20160607162031_466687836.sql！','1465372525','1','0.0.0.0','1','Data','deletebak'),('143','删除备份数据zwjlyh_20160607162036_590882258.sql！','1465372530','1','0.0.0.0','1','Data','deletebak'),('144','删除备份数据zwjlyh_20160607162121_247510490.sql！','1465372534','1','0.0.0.0','1','Data','deletebak'),('145','删除备份数据zwjlyh_20160608141151_881115893.sql！','1465372539','1','0.0.0.0','1','Data','deletebak'),('146','表Adv增加ID为1的记录！','1465372639','1','0.0.0.0','1','Adv','add'),('147','备份lyh_adv表！','1465372720','1','0.0.0.0','1','Data','backtables'),('148','删除表Adv的ID为1的记录！','1465372855','1','0.0.0.0','1','Adv','delete'),('149','删除备份数据zwjlyh_20160608141313_868957097.sql！','1465373555','1','0.0.0.0','1','Data','deletebak'),('150','还原备份数据zwjlyh_20160608155840_9528.sql！','1465373695','1','0.0.0.0','1','Data','recover'),('151','删除表Adv的ID为1的记录！','1465373710','1','0.0.0.0','1','Adv','delete');/* MySQLReback Separation */
 /* 插入数据 `lyh_log` */
 INSERT INTO `lyh_log` VALUES ('152','表Adv增加ID为2的记录！','1465373879','1','0.0.0.0','1','Adv','add');/* MySQLReback Separation */
 /* 插入数据 `lyh_log` */
 INSERT INTO `lyh_log` VALUES ('153','备份lyh_adv表！','1465373899','1','0.0.0.0','1','Data','backtables'),('154','删除表Adv的ID为2的记录！','1465373913','1','0.0.0.0','1','Adv','delete'),('155','还原备份数据zwjlyh_20160608161819_5284.sql！','1465374060','1','0.0.0.0','1','Data','recover'),('156','删除表Adv的ID为2的记录！','1465374836','1','0.0.0.0','1','Adv','delete'),('157','删除备份数据zwjlyh_20160608155840_9528.sql！','1465375624','1','0.0.0.0','1','Data','deletebak'),('158','删除备份数据zwjlyh_20160608161819_5284.sql！','1465375629','1','0.0.0.0','1','Data','deletebak'),('159','表Adv增加ID为3的记录！','1465376044','1','0.0.0.0','1','Adv','add'),('160','备份lyh_adv表！','1465376058','1','0.0.0.0','1','Data','backtables'),('161','表Adv编辑ID为3的记录！','1465376079','1','0.0.0.0','1','Adv','edit'),('162','表Adv增加ID为4的记录！','1465376197','1','0.0.0.0','1','Adv','add'),('163','删除备份数据zwjlyh_20160608165418_1887.sql！','1465376288','1','0.0.0.0','1','Data','deletebak'),('164','表Adv增加ID为4的记录！','1465376371','1','0.0.0.0','1','Adv','add'),('165','备份lyh_adv表！','1465376419','1','0.0.0.0','1','Data','backtables'),('166','表Adv编辑ID为4的记录！','1465376469','1','0.0.0.0','1','Adv','edit'),('167','还原备份数据zwjlyh_20160608170019_8365.sql！','1465377761','1','0.0.0.0','1','Data','recover'),('168','备份整个数据库！','1465377862','1','0.0.0.0','1','Data','backall'),('169','备份整个数据库！','1465377962','1','0.0.0.0','1','Data','backall'),('170','备份整个数据库！','1465377991','1','0.0.0.0','1','Data','backall'),('171','备份整个数据库！','1465378008','1','0.0.0.0','1','Data','backall'),('172','还原备份数据zwjlyh_20160608172731_6408.sql！','1465378082','1','0.0.0.0','1','Data','recover'),('173','表Adv编辑ID为4的记录！','1465378204','1','0.0.0.0','1','Adv','edit'),('174','还原备份数据zwjlyh_20160608170019_8365.sql！','1465378230','1','0.0.0.0','1','Data','recover'),('175','备份lyh_table表！','1465378400','1','0.0.0.0','1','Data','backtables'),('176','还原备份数据zwjlyh_20160608173320_7447.sql！','1465378420','1','0.0.0.0','1','Data','recover'),('177','备份lyh_table表！','1465378484','1','0.0.0.0','1','Data','backtables'),('178','还原备份数据zwjlyh_20160608173444_3690.sql！','1465378497','1','0.0.0.0','1','Data','recover'),('179','还原备份数据zwjlyh_20160608173444_3690.sql！','1465378628','1','0.0.0.0','1','Data','recover'),('180','还原备份数据zwjlyh_20160608173444_3690.sql！','1465378698','1','0.0.0.0','1','Data','recover'),('181','备份lyh_table表！','1465378776','1','0.0.0.0','1','Data','backtables'),('182','还原备份数据zwjlyh_20160608173936_8393.sql！','1465378823','1','0.0.0.0','1','Data','recover'),('183','还原备份数据zwjlyh_20160608173936_8393.sql！','1465379672','1','0.0.0.0','1','Data','recover'),('184','admin登陆成功！','1465694783','1','0.0.0.0','1','Index','login'),('185','还原备份数据zwjlyh_20160608173936_8393.sql！','1465695078','1','0.0.0.0','1','Data','recover'),('186','备份lyh_table表！','1465695118','1','0.0.0.0','1','Data','backtables'),('187','还原备份数据zwjlyh_20160612093158_1613.sql！','1465695162','1','0.0.0.0','1','Data','recover'),('188','删除备份数据zwjlyh_20160608170019_8365.sql！','1465695244','1','0.0.0.0','1','Data','deletebak'),('189','删除备份数据zwjlyh_20160608172422_6658.sql！','1465695248','1','0.0.0.0','1','Data','deletebak'),('190','删除备份数据zwjlyh_20160608172602_7827.sql！','1465695253','1','0.0.0.0','1','Data','deletebak'),('191','删除备份数据zwjlyh_20160608172631_9771.sql！','1465695258','1','0.0.0.0','1','Data','deletebak'),('192','删除备份数据zwjlyh_20160608172648_6028.sql！','1465695262','1','0.0.0.0','1','Data','deletebak'),('193','删除备份数据zwjlyh_20160608172731_6408.sql！','1465695266','1','0.0.0.0','1','Data','deletebak'),('194','删除备份数据zwjlyh_20160608173320_7447.sql！','1465695271','1','0.0.0.0','1','Data','deletebak'),('195','删除备份数据zwjlyh_20160608173444_3690.sql！','1465695276','1','0.0.0.0','1','Data','deletebak'),('196','删除备份数据zwjlyh_20160608173936_8393.sql！','1465695280','1','0.0.0.0','1','Data','deletebak'),('197','删除备份数据zwjlyh_20160612093158_1613.sql！','1465695286','1','0.0.0.0','1','Data','deletebak'),('198','备份整个数据库！','1465695325','1','0.0.0.0','1','Data','backall'),('199','备份lyh_menu表！','1465698187','1','0.0.0.0','1','Data','backtables'),('200','删除备份数据zwjlyh_20160612093525_5636.sql！','1465700202','1','0.0.0.0','0','Data','deletebak'),('201','删除备份数据zwjlyh_8888.sql！','1465700218','1','0.0.0.0','1','Data','deletebak'),('202','备份lyh_table表！','1465701416','1','0.0.0.0','1','Data','backtables'),('203','备份整个数据库！','1465701445','1','0.0.0.0','1','Data','backall'),('204','备份lyh_conf,lyh_table表！','1465701480','1','0.0.0.0','1','Data','backtables');/* MySQLReback Separation */
 /* 插入数据 `lyh_log` */
 INSERT INTO `lyh_log` VALUES ('205','还原备份数据zwjlyh_20160612111800_lyh_conf,lyh_table.sql！','1465701493','1','0.0.0.0','1','Data','recover');/* MySQLReback Separation */
 /* 插入数据 `lyh_log` */
 INSERT INTO `lyh_log` VALUES ('206','删除备份数据zwjlyh_20160612111800_lyh_conf,lyh_table.sql！','1465701808','1','0.0.0.0','1','Data','deletebak'),('207','删除备份数据zwjlyh_20160612111656_lyh_table.sql！','1465701815','1','0.0.0.0','1','Data','deletebak'),('208','备份lyh_table表！','1465701830','1','0.0.0.0','1','Data','backtables'),('209','还原备份数据zwjlyh_20160612112637_conf,image,log.sql！','1465702094','1','0.0.0.0','1','Data','recover'),('210','表Adv编辑ID为4的记录！','1465713496','1','0.0.0.0','1','Adv','edit'),('211','表Adv编辑ID为4的记录！','1465717385','1','0.0.0.0','1','Adv','edit'),('212','表Adv编辑ID为4的记录！','1465717512','1','0.0.0.0','1','Adv','edit'),('213','admin退出登陆！','1465722717','1','0.0.0.0','1','Index','logout'),('214','admin登陆成功！','1465722770','1','0.0.0.0','1','Index','login'),('215','删除备份数据zwjlyh_20160612102307_2336.sql！','1465724965','1','0.0.0.0','1','Data','deletebak'),('216','删除备份数据zwjlyh_20160612111725_All.sql！','1465724969','1','0.0.0.0','1','Data','deletebak'),('217','删除备份数据zwjlyh_20160612112350_table.sql！','1465724974','1','0.0.0.0','1','Data','deletebak'),('218','删除备份数据zwjlyh_20160612112637_conf,image,log.sql！','1465724978','1','0.0.0.0','1','Data','deletebak'),('219','备份整个数据库！','1465724986','1','0.0.0.0','1','Data','backall'),('220','admin登陆成功！','1465799096','1','0.0.0.0','1','Index','login'),('221','表Menu增加ID为24的记录！','1467190088','1','0.0.0.0','1','Menu','add'),('222','表Menu增加ID为25的记录！','1467190125','1','0.0.0.0','1','Menu','add'),('223','表Menu编辑ID为25的记录！','1467190152','1','0.0.0.0','1','Menu','edit'),('224','删除备份数据zwjlyh_20160612174946_All.sql！','1467193641','1','0.0.0.0','1','Data','deletebak'),('225','备份整个数据库！','1467193653','1','0.0.0.0','1','Data','backall'),('226','admin登陆成功！','1467339177','1','0.0.0.0','1','Index','login'),('227','删除备份数据zwjlyh_20160629174733_All.sql！','1467342842','1','0.0.0.0','1','Data','deletebak');/* MySQLReback Separation */
 /* 创建表结构 `lyh_menu`  */
 DROP TABLE IF EXISTS `lyh_menu`;/* MySQLReback Separation */ CREATE TABLE `lyh_menu` (
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lyh_menu` */
 INSERT INTO `lyh_menu` VALUES ('1','0','全局',null,null,null,'1','1',null,'home','0'),('2','1','菜单管理','Menu','index',null,'20','1',null,null,'0'),('3','2','菜单列表','Menu','index',null,'1','1',null,null,'0'),('4','1','权限管理','Role','index',null,'2','1',null,null,'0'),('5','4','权限列表','Role','index',null,'0','1',null,null,'0'),('7','0','系统',null,null,null,'3','1',null,'cost','0'),('8','7','系统设置','Conf','index',null,'0','1',null,null,'0'),('9','8','系统配置','Conf','index',null,'1','1',null,null,'0'),('10','8','图片配置','Conf','image',null,'2','1',null,null,'0'),('11','8','邮箱设置','Conf','mail',null,'3','1',null,null,'0'),('12','7','广告管理','adv','index',null,'0','1',null,null,'1'),('13','12','广告列表','adv','index',null,'0','1',null,null,'0'),('14','1','管理员管理','Admin','index',null,'1','1',null,null,'0'),('15','14','管理员列表','Admin','index',null,'0','1',null,null,'0'),('16','14','回收站','Admin','delete_index',null,'0','1',null,null,'0'),('18','19','日记列表','Log','index',null,'20','1',null,null,'0'),('19','1','后台管理','index','index',null,'0','1',null,null,'0'),('20','19','后台首页','index','home',null,'10','1',null,null,'0'),('21','1','数据备份','Data','index',null,'0','1',null,null,'0'),('22','21','备份列表','Data','index',null,'0','1',null,null,'0'),('23','21','备份数据','Data','tablist',null,'10','1',null,null,'0'),('24','1','会员管理','User','index',null,'10','1',null,null,'1'),('25','24','会员列表','User','index',null,'0','1',null,null,'0');/* MySQLReback Separation */
 /* 创建表结构 `lyh_operate`  */
 DROP TABLE IF EXISTS `lyh_operate`;/* MySQLReback Separation */ CREATE TABLE `lyh_operate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sort` tinyint(4) DEFAULT '0',
  `url` varchar(200) NOT NULL,
  `show` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lyh_operate` */
 INSERT INTO `lyh_operate` VALUES ('2','adv','编辑','10','javascript:edit($id);','1'),('3','adv','删除','30','http://localhost/zwj/admin.php/adv/delete/id/$id.html','1'),('4','user','编辑','10','edit($id)','1'),('5','user','删除','20','foreverdel($id)','1');/* MySQLReback Separation */
 /* 创建表结构 `lyh_role`  */
 DROP TABLE IF EXISTS `lyh_role`;/* MySQLReback Separation */ CREATE TABLE `lyh_role` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `remark` text NOT NULL,
  `is_effect` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否放入回收站',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lyh_role` */
 INSERT INTO `lyh_role` VALUES ('1','超级管理员','超级管理员','1','0'),('4','高级管理员',null,'1','0');/* MySQLReback Separation */
 /* 创建表结构 `lyh_role_menu`  */
 DROP TABLE IF EXISTS `lyh_role_menu`;/* MySQLReback Separation */ CREATE TABLE `lyh_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lyh_role_menu` */
 INSERT INTO `lyh_role_menu` VALUES ('1','8'),('1','9'),('1','10'),('1','11');/* MySQLReback Separation */
 /* 创建表结构 `lyh_table`  */
 DROP TABLE IF EXISTS `lyh_table`;/* MySQLReback Separation */ CREATE TABLE `lyh_table` (
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `lyh_table` */
 INSERT INTO `lyh_table` VALUES ('3','adv','广告名称','name',null,'10','1','1','1','0',null,'1',null,null,'0'),('4','adv','广告标识','code','用于查询广告，单广告不可重复，轮播广告可重复','20','1','0','0','0',null,'1',null,null,'0'),('6','adv','广告长度','width',null,'40','0','0','0','0',null,'2',null,null,'0'),('7','adv','广告高度','height',null,'50','0','0','0','0',null,'2',null,null,'0'),('8','adv','广告类型','type',null,'60','1','0','0','0',null,'9','0=单广告|1=轮播广告',null,'0'),('9','adv','广告图片','image',null,'30','1','0','0','0',null,'6',null,null,'0'),('10','adv','广告链接','url',null,'100','0','0','0','0',null,'1',null,null,'0'),('11','user','用户名','username',null,'10','1','1','1','1',null,'1',null,null,'0'),('12','user','登陆密码','password',null,'20','0','1','0','0',null,'1',null,null,'0'),('13','user','真实姓名','realname',null,'30','0','0','0','0',null,'1',null,null,'0'),('14','user','用户昵称','nickname',null,'40','0','0','0','0',null,'1',null,null,'0'),('15','user','手机号码','mobile',null,'50','1','0','1','1',null,'12',null,null,'0'),('16','user','电子邮箱','email',null,'60','1','0','1','0',null,'1',null,null,'0'),('17','user','账户余额','money',null,'70','1','1','0','0','readonly','14',null,'0','1'),('18','user','账户积分','integral',null,'80','1','1','0','0','readonly','2',null,'0','1'),('19','user','状态','is_effect',null,'90','0','0','0','0',null,'9','1=启用|2=禁用',null,'0'),('20','user','创建时间','create_time',null,'100','1','1','0','0',null,'15',null,null,'1'),('21','user','最近登陆','log_time',null,'110','1','1','0','0',null,'15',null,null,'1'),('22','user','登陆IP','log_ip',null,'120','0','0','0','0',null,'1',null,null,'1');/* MySQLReback Separation */
 /* 创建表结构 `lyh_user`  */
 DROP TABLE IF EXISTS `lyh_user`;/* MySQLReback Separation */ CREATE TABLE `lyh_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '登陆密码',
  `realname` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `nickname` varchar(50) DEFAULT NULL COMMENT '用户昵称',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号码',
  `email` varchar(50) DEFAULT NULL COMMENT '电子邮箱',
  `money` double(10,2) NOT NULL COMMENT '账户余额',
  `integral` int(11) NOT NULL COMMENT '账户积分',
  `is_effect` tinyint(3) DEFAULT NULL COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `log_time` int(11) NOT NULL COMMENT '最近登陆',
  `log_ip` varchar(50) DEFAULT NULL COMMENT '登陆IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* MySQLReback Separation */