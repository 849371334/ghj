/*
Navicat MySQL Data Transfer

Source Server         : ghj
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : wechat

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-06-06 14:51:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wc_account
-- ----------------------------
DROP TABLE IF EXISTS `wc_account`;
CREATE TABLE `wc_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id，与user表相连',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '微信类型',
  `encodingaeskey` char(43) NOT NULL DEFAULT '' COMMENT '加密方式43位随机字符',
  `appsecret` char(32) NOT NULL DEFAULT '' COMMENT '见名称（系统获取）',
  `config_token` char(10) NOT NULL DEFAULT '' COMMENT '见名称（可随机生成）',
  `account` varchar(30) NOT NULL DEFAULT '' COMMENT '微信账户',
  `name` varchar(10) NOT NULL DEFAULT '' COMMENT '微信名称',
  `origina` varchar(20) NOT NULL DEFAULT '' COMMENT '原始id',
  `appid` varchar(20) NOT NULL DEFAULT '' COMMENT '见名称',
  `head_url` varchar(30) NOT NULL DEFAULT '' COMMENT '头像',
  `desc` varchar(50) NOT NULL DEFAULT '' COMMENT '描述',
  `reply` varchar(50) NOT NULL DEFAULT '' COMMENT '引导素材',
  `qcode` varchar(50) NOT NULL DEFAULT '' COMMENT '上传二维码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wc_account
-- ----------------------------
INSERT INTO `wc_account` VALUES ('15', '14', '0', '', '7', '1', '1', '555', '333', '', '', '333', '333', '33');
INSERT INTO `wc_account` VALUES ('18', '1', '1', '', '6', '', '6', '6', '6', '6', 'uploads/4117.jpg', '6', '', 'uploads/000_27499.jpg');
INSERT INTO `wc_account` VALUES ('20', '14', '4', '', '56', '', '56', '5656', '5656', '56', 'uploads/000_27499.jpg', '565', '', 'uploads/t018b20055f1fc01ad8.jpg');
INSERT INTO `wc_account` VALUES ('22', '1', '1', '', '', '', '', '华为商城 ', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for wc_account_limit
-- ----------------------------
DROP TABLE IF EXISTS `wc_account_limit`;
CREATE TABLE `wc_account_limit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '组id,与group表关联',
  `account_limit` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数量，-1为不限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='微信账户数量限制';

-- ----------------------------
-- Records of wc_account_limit
-- ----------------------------
INSERT INTO `wc_account_limit` VALUES ('1', '11', '2');
INSERT INTO `wc_account_limit` VALUES ('2', '0', '1');

-- ----------------------------
-- Table structure for wc_chatlog
-- ----------------------------
DROP TABLE IF EXISTS `wc_chatlog`;
CREATE TABLE `wc_chatlog` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) DEFAULT '0' COMMENT '用户id',
  `public_id` int(5) DEFAULT '0' COMMENT '公众号id',
  `record` varchar(120) DEFAULT '' COMMENT '聊天记录',
  `r_time` int(11) DEFAULT '0' COMMENT '记录时间',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `record_3` (`record`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wc_chatlog
-- ----------------------------
INSERT INTO `wc_chatlog` VALUES ('14', '1', '1', '了什么发生', '1493568000');
INSERT INTO `wc_chatlog` VALUES ('13', '1', '1', '发生了什么发生', '1493654400');
INSERT INTO `wc_chatlog` VALUES ('12', '1', '1', '不明白发生了什么', '1490976000');
INSERT INTO `wc_chatlog` VALUES ('11', '1', '1', '发生了什么,恩,好好', '1492185600');
INSERT INTO `wc_chatlog` VALUES ('6', '1', '1', 'abc', '1493568000');
INSERT INTO `wc_chatlog` VALUES ('7', '1', '1', 'def', '1493654400');
INSERT INTO `wc_chatlog` VALUES ('8', '1', '1', 'abcdefg', '1490976000');
INSERT INTO `wc_chatlog` VALUES ('16', '1', '1', 'abc', '1493568000');
INSERT INTO `wc_chatlog` VALUES ('10', '1', '1', 'abcd', '1493568000');
INSERT INTO `wc_chatlog` VALUES ('15', '1', '1', '啊嗷嗷啊', '1493654400');
INSERT INTO `wc_chatlog` VALUES ('17', '1', '1', 'def', '1493654400');

-- ----------------------------
-- Table structure for wc_combo
-- ----------------------------
DROP TABLE IF EXISTS `wc_combo`;
CREATE TABLE `wc_combo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '套餐名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_combo
-- ----------------------------

-- ----------------------------
-- Table structure for wc_conf
-- ----------------------------
DROP TABLE IF EXISTS `wc_conf`;
CREATE TABLE `wc_conf` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acct_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联用户表',
  `open_id` varchar(255) NOT NULL DEFAULT '' COMMENT '微信fromuser',
  PRIMARY KEY (`id`,`acct_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_conf
-- ----------------------------

-- ----------------------------
-- Table structure for wc_customer
-- ----------------------------
DROP TABLE IF EXISTS `wc_customer`;
CREATE TABLE `wc_customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wechat_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信公众号id',
  `kf_id` int(11) NOT NULL DEFAULT '0' COMMENT '客服id',
  `accepted_case` int(11) NOT NULL DEFAULT '0' COMMENT '客服当前正在接待的会话数',
  `status` tinyint(3) DEFAULT '0' COMMENT '客服状态',
  `kf_nick` char(10) DEFAULT NULL COMMENT '客服昵称',
  `kf_account` char(30) DEFAULT NULL COMMENT '完整客服账号信息',
  `kf_headimgurl` varchar(60) DEFAULT NULL COMMENT '客服头像',
  `kf_wx` varchar(60) DEFAULT NULL COMMENT '客服微信',
  PRIMARY KEY (`id`,`wechat_id`,`kf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_customer
-- ----------------------------
INSERT INTO `wc_customer` VALUES ('1', '1', '1', '11111111', '1', '111111111', '11111111', '11111111111', '11111111');

-- ----------------------------
-- Table structure for wc_customer_session
-- ----------------------------
DROP TABLE IF EXISTS `wc_customer_session`;
CREATE TABLE `wc_customer_session` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wechat_id` int(11) NOT NULL DEFAULT '0' COMMENT '公众号id',
  `time` int(11) NOT NULL DEFAULT '0' COMMENT '发送时间',
  `opercode` tinyint(4) NOT NULL DEFAULT '0' COMMENT '会话状态',
  `kf_account` char(20) NOT NULL DEFAULT '' COMMENT '客服账号',
  `openid` char(30) NOT NULL DEFAULT '' COMMENT '用户openid',
  `text` varchar(120) NOT NULL DEFAULT '' COMMENT '发送内容',
  PRIMARY KEY (`id`,`wechat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_customer_session
-- ----------------------------

-- ----------------------------
-- Table structure for wc_custom_menu
-- ----------------------------
DROP TABLE IF EXISTS `wc_custom_menu`;
CREATE TABLE `wc_custom_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '系统配置表id',
  `acct_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属微信号',
  `data` text NOT NULL COMMENT 'serilize内容 \r\n序列化数据，后期考虑nosql',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_custom_menu
-- ----------------------------

-- ----------------------------
-- Table structure for wc_fans
-- ----------------------------
DROP TABLE IF EXISTS `wc_fans`;
CREATE TABLE `wc_fans` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(10) DEFAULT '0',
  `group_num` int(11) DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_fans
-- ----------------------------
INSERT INTO `wc_fans` VALUES ('3', '33', '0');
INSERT INTO `wc_fans` VALUES ('5', 'test1', '0');
INSERT INTO `wc_fans` VALUES ('6', 'er ', '0');
INSERT INTO `wc_fans` VALUES ('7', '12', '0');

-- ----------------------------
-- Table structure for wc_keyword
-- ----------------------------
DROP TABLE IF EXISTS `wc_keyword`;
CREATE TABLE `wc_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '命中次数',
  `key_name` char(30) NOT NULL DEFAULT '' COMMENT '关键字命中',
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_keyword
-- ----------------------------

-- ----------------------------
-- Table structure for wc_key_log
-- ----------------------------
DROP TABLE IF EXISTS `wc_key_log`;
CREATE TABLE `wc_key_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '关键字命中日志表',
  `user_id` int(11) NOT NULL COMMENT '用户id  ',
  `key_id` int(11) NOT NULL DEFAULT '0' COMMENT '关键字命中的id',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '命中次数',
  `time` int(11) NOT NULL DEFAULT '0' COMMENT '命中时间',
  `key_name` char(30) NOT NULL DEFAULT '' COMMENT '关键字名称',
  PRIMARY KEY (`id`,`key_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_key_log
-- ----------------------------

-- ----------------------------
-- Table structure for wc_media
-- ----------------------------
DROP TABLE IF EXISTS `wc_media`;
CREATE TABLE `wc_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL DEFAULT '0',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '媒体文件上传后，获取时的唯一标识',
  `is_show` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否显示封面，1为显示，0为不显示',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '图文消息题',
  `file_name` varchar(100) NOT NULL DEFAULT '' COMMENT '媒体文件上传时间戳',
  `digest` varchar(50) NOT NULL DEFAULT '' COMMENT '图文消息的描述',
  `link` varchar(50) NOT NULL DEFAULT '' COMMENT '点击图文消息跳转链接',
  `file` varchar(50) NOT NULL DEFAULT '' COMMENT '图片链接',
  `name` varchar(50) NOT NULL DEFAULT '0',
  `content` varchar(180) NOT NULL DEFAULT '0' COMMENT '内容',
  PRIMARY KEY (`id`,`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_media
-- ----------------------------
INSERT INTO `wc_media` VALUES ('10', '0', '0', '0', '0', '0', '0', '', '0', 'uploads/', 'bn', '0');
INSERT INTO `wc_media` VALUES ('11', '0', '0', '0', '0', '0', '0', '[em_2][em_3]', '0', 'uploads/000_27499.jpg', '1', '0');
INSERT INTO `wc_media` VALUES ('12', '0', '0', '0', '0', '0', 'D:/phpstudy/WWW/dashixun/yii2/frontend/web/SWF/file/serverData', '0', '0', '0', '111', '0');
INSERT INTO `wc_media` VALUES ('13', '0', '0', '0', '0', '1111', 'D:/phpstudy/WWW/dashixun/yii2/frontend/web/SWF/file/serverData', '0', '0', '0', '1111', '0');
INSERT INTO `wc_media` VALUES ('14', '0', '0', '0', '0', '0', '0', '', '0', 'uploads/', '', '0');
INSERT INTO `wc_media` VALUES ('15', '0', '0', '0', '0', '0', '0', '[em_2]', '0', 'uploads/4117.jpg', '111111111', '0');

-- ----------------------------
-- Table structure for wc_qrcode
-- ----------------------------
DROP TABLE IF EXISTS `wc_qrcode`;
CREATE TABLE `wc_qrcode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `scene_id` int(11) NOT NULL DEFAULT '0' COMMENT '场景值ID，临时二维码时为32位非0整型，永久二维码时最大值为100000（目前参数只支持1--100000）',
  `end_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '二维码有效时间',
  `scan_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扫描量',
  `wechat_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '二维码类型，0临时，1永久',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `key_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '关键字名称',
  `scene_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '场景名称',
  `qrcode_url` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '二维码路径',
  `ticket` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '二维码ticket',
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of wc_qrcode
-- ----------------------------
INSERT INTO `wc_qrcode` VALUES ('3', '1', '1', '1495167003', '1495165892', '0', '1', '0', '1', '1', '87', '1', 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=', 'gQFl7zwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyUzBBR1lzdzhjdWoxNWJNdTFwMW8AAgT0ax5ZAwRXBAAA');
INSERT INTO `wc_qrcode` VALUES ('2', '1', '6', '1497757791', '1495165791', '0', '1', '0', '1', '1', '56', '6', 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=', 'gQHv7zwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyV3VuQVp4dzhjdWoxdWZVNU5wMVIAAgSPax5ZAwQAjScA');
INSERT INTO `wc_qrcode` VALUES ('4', '1', '2', '1495167058', '1495165947', '0', '1', '0', '1', '1', '87', '2', 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=', 'gQFX7zwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyYUtIQVprdzhjdWoxNjNNdU5wMTIAAgQsbB5ZAwRXBAAA');

-- ----------------------------
-- Table structure for wc_system_config
-- ----------------------------
DROP TABLE IF EXISTS `wc_system_config`;
CREATE TABLE `wc_system_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统配置表id',
  `acct_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属微信号id',
  `key` varchar(10) NOT NULL DEFAULT '' COMMENT '系统配置的列',
  `data` text COMMENT 'serilize内容\r\n序列化数据，后期考虑nosql',
  `is_record` tinyint(1) DEFAULT '0' COMMENT '是否开启聊天记录',
  `rec_time` int(4) DEFAULT '0' COMMENT '聊天记录保存时间',
  PRIMARY KEY (`id`,`acct_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_system_config
-- ----------------------------
INSERT INTO `wc_system_config` VALUES ('1', '1', '1', '111', '1', '20');

-- ----------------------------
-- Table structure for wc_system_menu
-- ----------------------------
DROP TABLE IF EXISTS `wc_system_menu`;
CREATE TABLE `wc_system_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '系统菜单id',
  `menu_name` int(11) NOT NULL DEFAULT '0' COMMENT '组ID  与grop表关联',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '本表上级id',
  `plugin_id` int(11) NOT NULL DEFAULT '0' COMMENT '插件ID  哪个插件安装',
  `acct_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信ID   系统链接时为0',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型  0 顶端 1左则',
  `menu_url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接 相对路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_system_menu
-- ----------------------------

-- ----------------------------
-- Table structure for wc_system_reply_base
-- ----------------------------
DROP TABLE IF EXISTS `wc_system_reply_base`;
CREATE TABLE `wc_system_reply_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acct_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属微信号   0是所有人的',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0关注时\r\n1，未命中时\r\n2，等于关键词\r\n3，包含关键词\r\n4，匹配正则',
  `keywords` varchar(255) NOT NULL DEFAULT ' ' COMMENT '关键词或表达式',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_system_reply_base
-- ----------------------------

-- ----------------------------
-- Table structure for wc_system_reply_content
-- ----------------------------
DROP TABLE IF EXISTS `wc_system_reply_content`;
CREATE TABLE `wc_system_reply_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '关联主表',
  `reply_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 字符串\r\n1，图文\r\n2，包含关键词\r\n3，匹配正则',
  `reply` varchar(180) NOT NULL COMMENT '回复内容\r\n如果是图文音乐等，则是反序列化后得到结构',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_system_reply_content
-- ----------------------------

-- ----------------------------
-- Table structure for wc_tickek_count
-- ----------------------------
DROP TABLE IF EXISTS `wc_tickek_count`;
CREATE TABLE `wc_tickek_count` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二维码表id',
  `time` int(11) NOT NULL DEFAULT '0' COMMENT '关注时间',
  `fid` varchar(30) NOT NULL DEFAULT '' COMMENT '粉丝id',
  PRIMARY KEY (`id`,`ticket_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_tickek_count
-- ----------------------------

-- ----------------------------
-- Table structure for wc_user
-- ----------------------------
DROP TABLE IF EXISTS `wc_user`;
CREATE TABLE `wc_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '组ID',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `time` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `password` bigint(20) NOT NULL DEFAULT '0' COMMENT '密码',
  `digit` char(5) NOT NULL COMMENT '验证随机数',
  `username` char(6) NOT NULL DEFAULT '' COMMENT '用户名',
  `mobile` char(11) NOT NULL DEFAULT '',
  `ip_address` char(15) NOT NULL DEFAULT '0',
  `end_ip` char(15) NOT NULL DEFAULT '0',
  `email` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wc_user
-- ----------------------------
INSERT INTO `wc_user` VALUES ('1', '0', '1496478445', '0', '0', '1096519509759695686', '', 'admin', '', '0', '127.0.0.1', '');
INSERT INTO `wc_user` VALUES ('2', '0', '1495163652', '0', '0', '1096519509759695686', '', 'admin1', '', '0', '127.0.0.1', '');
INSERT INTO `wc_user` VALUES ('14', '0', '1496666882', '1495598028', '0', '1096519509759695686', '', '郭慧杰', '15710069474', '0', '192.168.1.111', 'ghj849371334@163.com');
INSERT INTO `wc_user` VALUES ('15', '0', '1495675721', '1495675696', '0', '469615024429532406', '', '风格化', '15710069474', '0', '192.168.1.106', '849371334@qq.com');
INSERT INTO `wc_user` VALUES ('16', '0', '0', '1495945580', '0', '469615024429532406', '', '测试吧啊', '15710069474', '0', '0', '849371334@qq.com');

-- ----------------------------
-- Table structure for wc_userapi
-- ----------------------------
DROP TABLE IF EXISTS `wc_userapi`;
CREATE TABLE `wc_userapi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` int(11) NOT NULL COMMENT '微信公众号id',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态',
  `istop` tinyint(4) DEFAULT '0' COMMENT '是否置顶',
  `priority` tinyint(4) DEFAULT NULL COMMENT '优先级',
  `apitype` tinyint(4) DEFAULT '0' COMMENT '接口类型  1代表远程地址    2代表本地+名称',
  `cachetime` tinyint(4) DEFAULT '0' COMMENT '缓存时间',
  `reply_rule` varchar(15) DEFAULT '0' COMMENT '回复规则名称',
  `keywords` varchar(10) DEFAULT NULL COMMENT '触法关键字',
  `advanced_click` varchar(100) DEFAULT NULL COMMENT '高级触法 |，',
  `apiurl` varchar(100) DEFAULT '0' COMMENT '远程地址',
  `wetoken` varchar(60) DEFAULT '0' COMMENT '远程token',
  `default` varchar(15) DEFAULT NULL COMMENT '默认回复',
  `apilocal` varchar(16) DEFAULT NULL COMMENT '本地接口控制器',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wc_userapi
-- ----------------------------
INSERT INTO `wc_userapi` VALUES ('1', '10', '1', '0', null, '2', '5', 'weather', 'w', null, '', '', 'dd', 'translate');
INSERT INTO `wc_userapi` VALUES ('2', '10', '1', '0', null, '2', '3', 'calendar', 'c', null, '', '', 'dd', 'calendar');
INSERT INTO `wc_userapi` VALUES ('3', '7', '1', '0', null, '2', '11', '111', '111', null, '', '', '11', 'baike.php');
INSERT INTO `wc_userapi` VALUES ('4', '7', '1', '0', null, '2', '0', '11', '22', null, '', '', '22', 'calendar.php');
INSERT INTO `wc_userapi` VALUES ('5', '16', '1', '0', null, '2', '55', '11', '11', null, '', '', '11', 'news.php');
INSERT INTO `wc_userapi` VALUES ('6', '1', '1', '0', null, '2', '127', '请问  ', '请问', null, '', '', '请问', 'calendar');

-- ----------------------------
-- Table structure for wc_userconf
-- ----------------------------
DROP TABLE IF EXISTS `wc_userconf`;
CREATE TABLE `wc_userconf` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wx_id` int(11) NOT NULL,
  `welcome` varchar(30) DEFAULT NULL COMMENT '欢迎回复界面',
  `default` varchar(30) DEFAULT NULL COMMENT '默认回复界面',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wc_userconf
-- ----------------------------
INSERT INTO `wc_userconf` VALUES ('1', '7', '1', '1');
INSERT INTO `wc_userconf` VALUES ('2', '1', '4545', '4545');

-- ----------------------------
-- Table structure for wc_user_combo
-- ----------------------------
DROP TABLE IF EXISTS `wc_user_combo`;
CREATE TABLE `wc_user_combo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `combo_id` int(11) NOT NULL DEFAULT '0' COMMENT '套餐id',
  PRIMARY KEY (`id`,`user_id`,`combo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_user_combo
-- ----------------------------

-- ----------------------------
-- Table structure for wc_user_group
-- ----------------------------
DROP TABLE IF EXISTS `wc_user_group`;
CREATE TABLE `wc_user_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `group_name` varchar(10) NOT NULL DEFAULT '' COMMENT '组名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wc_user_group
-- ----------------------------
INSERT INTO `wc_user_group` VALUES ('0', '普通用户组');
INSERT INTO `wc_user_group` VALUES ('11', '黄金会员组');
INSERT INTO `wc_user_group` VALUES ('12', '主管理员');

-- ----------------------------
-- Table structure for wc_user_group_permission
-- ----------------------------
DROP TABLE IF EXISTS `wc_user_group_permission`;
CREATE TABLE `wc_user_group_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '权限ID',
  `gid` int(10) unsigned NOT NULL DEFAULT '11' COMMENT '组ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=sjis COMMENT='角色权限关联表';

-- ----------------------------
-- Records of wc_user_group_permission
-- ----------------------------
INSERT INTO `wc_user_group_permission` VALUES ('137', '1', '12');
INSERT INTO `wc_user_group_permission` VALUES ('138', '2', '12');
INSERT INTO `wc_user_group_permission` VALUES ('139', '3', '12');
INSERT INTO `wc_user_group_permission` VALUES ('140', '4', '12');
INSERT INTO `wc_user_group_permission` VALUES ('141', '5', '12');
INSERT INTO `wc_user_group_permission` VALUES ('142', '6', '12');
INSERT INTO `wc_user_group_permission` VALUES ('143', '7', '12');
INSERT INTO `wc_user_group_permission` VALUES ('144', '8', '12');
INSERT INTO `wc_user_group_permission` VALUES ('145', '9', '12');
INSERT INTO `wc_user_group_permission` VALUES ('146', '10', '12');
INSERT INTO `wc_user_group_permission` VALUES ('147', '11', '12');
INSERT INTO `wc_user_group_permission` VALUES ('148', '12', '12');
INSERT INTO `wc_user_group_permission` VALUES ('149', '13', '12');
INSERT INTO `wc_user_group_permission` VALUES ('150', '14', '12');
INSERT INTO `wc_user_group_permission` VALUES ('151', '15', '12');
INSERT INTO `wc_user_group_permission` VALUES ('152', '16', '12');
INSERT INTO `wc_user_group_permission` VALUES ('153', '17', '12');
INSERT INTO `wc_user_group_permission` VALUES ('154', '18', '12');
INSERT INTO `wc_user_group_permission` VALUES ('155', '19', '12');
INSERT INTO `wc_user_group_permission` VALUES ('156', '20', '12');
INSERT INTO `wc_user_group_permission` VALUES ('157', '21', '12');
INSERT INTO `wc_user_group_permission` VALUES ('158', '22', '12');
INSERT INTO `wc_user_group_permission` VALUES ('159', '23', '12');
INSERT INTO `wc_user_group_permission` VALUES ('160', '24', '12');
INSERT INTO `wc_user_group_permission` VALUES ('161', '25', '12');
INSERT INTO `wc_user_group_permission` VALUES ('162', '26', '12');
INSERT INTO `wc_user_group_permission` VALUES ('163', '27', '12');
INSERT INTO `wc_user_group_permission` VALUES ('164', '28', '12');
INSERT INTO `wc_user_group_permission` VALUES ('165', '29', '12');
INSERT INTO `wc_user_group_permission` VALUES ('166', '30', '12');
INSERT INTO `wc_user_group_permission` VALUES ('167', '31', '12');
INSERT INTO `wc_user_group_permission` VALUES ('168', '32', '12');
INSERT INTO `wc_user_group_permission` VALUES ('169', '33', '12');
INSERT INTO `wc_user_group_permission` VALUES ('170', '34', '12');
INSERT INTO `wc_user_group_permission` VALUES ('171', '35', '12');
INSERT INTO `wc_user_group_permission` VALUES ('172', '36', '12');
INSERT INTO `wc_user_group_permission` VALUES ('173', '37', '12');
INSERT INTO `wc_user_group_permission` VALUES ('174', '38', '12');
INSERT INTO `wc_user_group_permission` VALUES ('175', '39', '12');
INSERT INTO `wc_user_group_permission` VALUES ('176', '40', '12');
INSERT INTO `wc_user_group_permission` VALUES ('177', '41', '12');
INSERT INTO `wc_user_group_permission` VALUES ('178', '42', '12');
INSERT INTO `wc_user_group_permission` VALUES ('179', '43', '12');
INSERT INTO `wc_user_group_permission` VALUES ('180', '44', '12');
INSERT INTO `wc_user_group_permission` VALUES ('181', '45', '12');
INSERT INTO `wc_user_group_permission` VALUES ('182', '46', '12');
INSERT INTO `wc_user_group_permission` VALUES ('183', '47', '12');
INSERT INTO `wc_user_group_permission` VALUES ('184', '48', '12');
INSERT INTO `wc_user_group_permission` VALUES ('185', '49', '12');
INSERT INTO `wc_user_group_permission` VALUES ('186', '50', '12');
INSERT INTO `wc_user_group_permission` VALUES ('187', '51', '12');
INSERT INTO `wc_user_group_permission` VALUES ('188', '52', '12');
INSERT INTO `wc_user_group_permission` VALUES ('189', '53', '12');
INSERT INTO `wc_user_group_permission` VALUES ('190', '54', '12');
INSERT INTO `wc_user_group_permission` VALUES ('191', '55', '12');
INSERT INTO `wc_user_group_permission` VALUES ('192', '56', '12');
INSERT INTO `wc_user_group_permission` VALUES ('193', '57', '12');
INSERT INTO `wc_user_group_permission` VALUES ('194', '58', '12');
INSERT INTO `wc_user_group_permission` VALUES ('195', '59', '12');
INSERT INTO `wc_user_group_permission` VALUES ('196', '60', '12');
INSERT INTO `wc_user_group_permission` VALUES ('197', '61', '12');
INSERT INTO `wc_user_group_permission` VALUES ('198', '62', '12');
INSERT INTO `wc_user_group_permission` VALUES ('199', '63', '12');
INSERT INTO `wc_user_group_permission` VALUES ('200', '64', '12');
INSERT INTO `wc_user_group_permission` VALUES ('201', '65', '12');
INSERT INTO `wc_user_group_permission` VALUES ('202', '66', '12');
INSERT INTO `wc_user_group_permission` VALUES ('203', '67', '12');
INSERT INTO `wc_user_group_permission` VALUES ('204', '68', '12');
INSERT INTO `wc_user_group_permission` VALUES ('205', '69', '12');
INSERT INTO `wc_user_group_permission` VALUES ('206', '70', '12');
INSERT INTO `wc_user_group_permission` VALUES ('207', '41', '0');
INSERT INTO `wc_user_group_permission` VALUES ('208', '42', '0');
INSERT INTO `wc_user_group_permission` VALUES ('209', '43', '0');
INSERT INTO `wc_user_group_permission` VALUES ('210', '44', '0');
INSERT INTO `wc_user_group_permission` VALUES ('211', '45', '0');
INSERT INTO `wc_user_group_permission` VALUES ('212', '46', '0');
INSERT INTO `wc_user_group_permission` VALUES ('213', '47', '0');
INSERT INTO `wc_user_group_permission` VALUES ('214', '48', '0');
INSERT INTO `wc_user_group_permission` VALUES ('215', '49', '0');
INSERT INTO `wc_user_group_permission` VALUES ('216', '50', '0');
INSERT INTO `wc_user_group_permission` VALUES ('217', '51', '0');
INSERT INTO `wc_user_group_permission` VALUES ('218', '52', '0');
INSERT INTO `wc_user_group_permission` VALUES ('219', '53', '0');
INSERT INTO `wc_user_group_permission` VALUES ('220', '65', '0');

-- ----------------------------
-- Table structure for wc_user_group_rule
-- ----------------------------
DROP TABLE IF EXISTS `wc_user_group_rule`;
CREATE TABLE `wc_user_group_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则ID',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `gid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=sjis COMMENT='用户角色规则表';

-- ----------------------------
-- Records of wc_user_group_rule
-- ----------------------------
INSERT INTO `wc_user_group_rule` VALUES ('1', '1', '12');
INSERT INTO `wc_user_group_rule` VALUES ('9', '2', '12');
INSERT INTO `wc_user_group_rule` VALUES ('15', '14', '11');

-- ----------------------------
-- Table structure for wc_user_info
-- ----------------------------
DROP TABLE IF EXISTS `wc_user_info`;
CREATE TABLE `wc_user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '本站用户信息表ID',
  `acct_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属微信号',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID  与用户表关联',
  `point` int(11) NOT NULL COMMENT '积分  其它插件以此为主',
  `id_card` bigint(20) NOT NULL DEFAULT '0' COMMENT '身份证号码   -数最后一位是x',
  `balance` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '钱数 其它插件以此为主',
  `real_name` varchar(5) NOT NULL DEFAULT ' ' COMMENT '真实姓名 外国人使用中名',
  `nick_name` varchar(10) NOT NULL DEFAULT ' ' COMMENT '用户的昵称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_user_info
-- ----------------------------

-- ----------------------------
-- Table structure for wc_user_media
-- ----------------------------
DROP TABLE IF EXISTS `wc_user_media`;
CREATE TABLE `wc_user_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `media_id` int(11) NOT NULL DEFAULT '0' COMMENT '媒体id',
  `wechat_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信公众号id',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `edit_time` int(11) NOT NULL DEFAULT '0',
  `keyword` varchar(10) NOT NULL DEFAULT '' COMMENT '关键字',
  `author` varchar(10) NOT NULL DEFAULT '' COMMENT '作者',
  `is_material` varchar(20) NOT NULL COMMENT '素材',
  `media_url` varchar(30) NOT NULL DEFAULT '' COMMENT '素材路径',
  PRIMARY KEY (`id`,`wechat_id`,`media_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_user_media
-- ----------------------------
INSERT INTO `wc_user_media` VALUES ('10', '10', '0', '0', '0', 'jh', '0', '0', '0');
INSERT INTO `wc_user_media` VALUES ('11', '11', '0', '0', '0', '1', '0', '0', '0');
INSERT INTO `wc_user_media` VALUES ('12', '12', '0', '0', '0', '111', '0', '0', '0');
INSERT INTO `wc_user_media` VALUES ('13', '13', '0', '0', '0', '111', '0', '0', '0');
INSERT INTO `wc_user_media` VALUES ('14', '14', '0', '0', '0', '', '0', '0', '0');
INSERT INTO `wc_user_media` VALUES ('15', '15', '0', '0', '0', '1', '0', '0', '0');

-- ----------------------------
-- Table structure for wc_user_oauth
-- ----------------------------
DROP TABLE IF EXISTS `wc_user_oauth`;
CREATE TABLE `wc_user_oauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '微信绑定表id',
  `acct_id` int(11) NOT NULL DEFAULT '0' COMMENT '微信id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id 关联用户表',
  `open_id` varchar(32) NOT NULL DEFAULT ' ' COMMENT 'openid   也就是 微信fromuser',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_user_oauth
-- ----------------------------

-- ----------------------------
-- Table structure for wc_user_permission
-- ----------------------------
DROP TABLE IF EXISTS `wc_user_permission`;
CREATE TABLE `wc_user_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则ID',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '权限名称路径或是动作',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of wc_user_permission
-- ----------------------------
INSERT INTO `wc_user_permission` VALUES ('2', 'group/add_do');
INSERT INTO `wc_user_permission` VALUES ('4', 'group/add');
INSERT INTO `wc_user_permission` VALUES ('5', 'group/show');
INSERT INTO `wc_user_permission` VALUES ('6', 'group/delete2');
INSERT INTO `wc_user_permission` VALUES ('7', 'group/update2');
INSERT INTO `wc_user_permission` VALUES ('8', 'group/ update_limit');
INSERT INTO `wc_user_permission` VALUES ('9', 'group/node');
INSERT INTO `wc_user_permission` VALUES ('10', 'group/node2');
INSERT INTO `wc_user_permission` VALUES ('11', 'permission/add');
INSERT INTO `wc_user_permission` VALUES ('12', 'permission/add_do');
INSERT INTO `wc_user_permission` VALUES ('13', 'permission/show');
INSERT INTO `wc_user_permission` VALUES ('14', 'permission/delete2');
INSERT INTO `wc_user_permission` VALUES ('15', 'rule/add');
INSERT INTO `wc_user_permission` VALUES ('16', 'rule/add_do');
INSERT INTO `wc_user_permission` VALUES ('17', 'rule/show');
INSERT INTO `wc_user_permission` VALUES ('18', 'rule/delete2');
INSERT INTO `wc_user_permission` VALUES ('19', 'rule/update1');
INSERT INTO `wc_user_permission` VALUES ('20', 'rule/update_limit');
INSERT INTO `wc_user_permission` VALUES ('21', 'wsite/test');
INSERT INTO `wc_user_permission` VALUES ('22', 'wsite/site_add');
INSERT INTO `wc_user_permission` VALUES ('23', 'wsite/article_list');
INSERT INTO `wc_user_permission` VALUES ('24', 'wsite/cate_list');
INSERT INTO `wc_user_permission` VALUES ('25', 'make/fans');
INSERT INTO `wc_user_permission` VALUES ('26', 'make/fans_group');
INSERT INTO `wc_user_permission` VALUES ('27', 'make/group_add');
INSERT INTO `wc_user_permission` VALUES ('28', 'make/group_list');
INSERT INTO `wc_user_permission` VALUES ('29', 'make/fans_list');
INSERT INTO `wc_user_permission` VALUES ('30', 'make/vip_list');
INSERT INTO `wc_user_permission` VALUES ('31', 'make/vip_add');
INSERT INTO `wc_user_permission` VALUES ('32', 'make/vip_group_add');
INSERT INTO `wc_user_permission` VALUES ('33', 'make/vip_group_list');
INSERT INTO `wc_user_permission` VALUES ('34', 'make/vip_points');
INSERT INTO `wc_user_permission` VALUES ('35', 'make/vip_status');
INSERT INTO `wc_user_permission` VALUES ('36', 'make/vip_notice');
INSERT INTO `wc_user_permission` VALUES ('37', 'make/vip_deal');
INSERT INTO `wc_user_permission` VALUES ('38', 'make/wechat_matter');
INSERT INTO `wc_user_permission` VALUES ('39', 'make/notice_msg');
INSERT INTO `wc_user_permission` VALUES ('40', 'make/notice_news');
INSERT INTO `wc_user_permission` VALUES ('41', 'user/news');
INSERT INTO `wc_user_permission` VALUES ('42', 'user/img');
INSERT INTO `wc_user_permission` VALUES ('43', 'user/voice');
INSERT INTO `wc_user_permission` VALUES ('44', 'user/video');
INSERT INTO `wc_user_permission` VALUES ('45', 'reply/upload');
INSERT INTO `wc_user_permission` VALUES ('46', 'reply/music');
INSERT INTO `wc_user_permission` VALUES ('47', 'reply/voice');
INSERT INTO `wc_user_permission` VALUES ('48', 'reply/video');
INSERT INTO `wc_user_permission` VALUES ('49', 'wechat/wx');
INSERT INTO `wc_user_permission` VALUES ('50', 'userreply/news');
INSERT INTO `wc_user_permission` VALUES ('51', 'userreply/img');
INSERT INTO `wc_user_permission` VALUES ('52', 'userreply/voice');
INSERT INTO `wc_user_permission` VALUES ('53', 'userreply/video');
INSERT INTO `wc_user_permission` VALUES ('54', 'setting/service');
INSERT INTO `wc_user_permission` VALUES ('55', 'setting/weather');
INSERT INTO `wc_user_permission` VALUES ('56', 'setting/translate');
INSERT INTO `wc_user_permission` VALUES ('57', 'setting/calendar');
INSERT INTO `wc_user_permission` VALUES ('58', 'setting/news');
INSERT INTO `wc_user_permission` VALUES ('59', 'setting/express');
INSERT INTO `wc_user_permission` VALUES ('60', 'statistics/chatlog');
INSERT INTO `wc_user_permission` VALUES ('61', 'statistics/chatlogDel ');
INSERT INTO `wc_user_permission` VALUES ('62', 'statistics/parameter');
INSERT INTO `wc_user_permission` VALUES ('63', 'statistics/keywords');
INSERT INTO `wc_user_permission` VALUES ('64', 'statistics/keywordsDel');
INSERT INTO `wc_user_permission` VALUES ('65', 'user/test');

-- ----------------------------
-- Table structure for wc_vip
-- ----------------------------
DROP TABLE IF EXISTS `wc_vip`;
CREATE TABLE `wc_vip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `title` varchar(10) NOT NULL DEFAULT '' COMMENT '组名称',
  `credit` int(11) DEFAULT NULL,
  `num` int(8) DEFAULT NULL,
  `vip_id` int(8) DEFAULT '1' COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wc_vip
-- ----------------------------
INSERT INTO `wc_vip` VALUES ('1', '青铜', '110', '1', '1');
INSERT INTO `wc_vip` VALUES ('2', '白银', '220', '1', '1');
INSERT INTO `wc_vip` VALUES ('3', '黄金', '330', '1', '1');
INSERT INTO `wc_vip` VALUES ('4', '白金', '440', '1', '1');
INSERT INTO `wc_vip` VALUES ('5', '钻石', '550', '1', '1');
INSERT INTO `wc_vip` VALUES ('6', '大师', '660', '1', '1');
INSERT INTO `wc_vip` VALUES ('7', '宗师', '770', '1', '1');
INSERT INTO `wc_vip` VALUES ('8', '500强', '880', '1', '1');
INSERT INTO `wc_vip` VALUES ('9', 'test', '111', '2', '1');
INSERT INTO `wc_vip` VALUES ('10', 'test2', '111', '2', '1');

-- ----------------------------
-- Table structure for wc_vip_config
-- ----------------------------
DROP TABLE IF EXISTS `wc_vip_config`;
CREATE TABLE `wc_vip_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(20) DEFAULT '' COMMENT '用户id',
  `field` varchar(20) DEFAULT '' COMMENT '字段',
  `title` varchar(20) DEFAULT '' COMMENT '标题',
  `is_enable` tinyint(2) DEFAULT NULL,
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wc_vip_config
-- ----------------------------
INSERT INTO `wc_vip_config` VALUES ('1', '1', 'msn', 'MSN', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('2', '1', '	alipay', '支付宝帐号', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('3', '1', 'weight', '体重', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('4', '1', 'height', '身高', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('5', '1', '	bloodtype', '血型', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('6', '1', 'lookingfor', '交友目的', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('7', '1', 'affectivestatus', '情感状态', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('8', '1', 'revenue', '年收入', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('9', '1', 'position', '职位', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('10', '1', 'occupation', '职业', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('11', '1', '	education', '学历	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('12', '1', 'company', '公司', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('13', '1', 'graduateschool', '毕业学校	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('14', '1', 'resideprovince', '居住地址	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('15', '1', 'nationality', '国籍', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('16', '1', 'zipcode', '邮编	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('17', '1', 'address', '邮寄地址	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('18', '1', 'grade', '班级	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('19', '1', 'studentid', '学号	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('20', '1', 'idcard', '证件号码	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('21', '1', 'telephone', '固定电话	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('22', '1', 'zodiac', '生肖', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('23', '1', 'constellation', '星座', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('24', '1', 'birthyear', '出生生日	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('25', '1', 'mobile', '手机号码	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('26', '1', 'qq', 'QQ号	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('27', '1', 'gender', '性别', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('28', '1', 'bio', '自我介绍	', '1', '0');
INSERT INTO `wc_vip_config` VALUES ('29', '1', 'interest', '兴趣爱好	', '1', '0');

-- ----------------------------
-- Table structure for wc_vip_user
-- ----------------------------
DROP TABLE IF EXISTS `wc_vip_user`;
CREATE TABLE `wc_vip_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '会员自增ID',
  `credit1` int(11) DEFAULT NULL COMMENT '会员积分',
  `mobile` char(11) DEFAULT NULL COMMENT '会员手机号',
  `realname` varchar(5) DEFAULT NULL COMMENT '会员名字',
  `email` varchar(30) DEFAULT NULL COMMENT '会员邮箱',
  `groupid` int(11) DEFAULT NULL,
  `password` bigint(20) DEFAULT NULL COMMENT '会员密码',
  `credit2` decimal(10,0) DEFAULT NULL COMMENT '会员余额',
  `vip_id` int(5) DEFAULT '0' COMMENT '用户id',
  `nickname` varchar(15) DEFAULT '未完善' COMMENT '昵称',
  `re_time` date NOT NULL DEFAULT '0000-00-00' COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_vip_user
-- ----------------------------
INSERT INTO `wc_vip_user` VALUES ('1', '2200', '13834741025', '楪祈', '1@qq.com', '1', '1096519509759695686', '10000', '1', '夜刀神十香', '2017-05-01');
INSERT INTO `wc_vip_user` VALUES ('2', '300', '13834741026', '张三', '2@qq.com', '2', '1096519509759695686', '20100', '1', '玩了', '2017-05-02');
INSERT INTO `wc_vip_user` VALUES ('3', '400', '13834741027', '李四', '3@qq.com', '3', '1096519509759695686', '30000', '1', '未完善', '2017-04-02');
INSERT INTO `wc_vip_user` VALUES ('4', '400', '13834741028', '王五', '4@qq.com', '4', '1096519509759695686', '40000', '1', '未完善', '2017-03-27');
INSERT INTO `wc_vip_user` VALUES ('5', '500', '13834741029', '赵六', '5@qq.com', '5', '1096519509759695686', '50100', '1', '未完善', '2017-04-30');
INSERT INTO `wc_vip_user` VALUES ('6', '600', '13834741029', '宋七', '6@qq.com', '6', '1096519509759695686', '60000', '1', '未完善', '2017-02-26');
INSERT INTO `wc_vip_user` VALUES ('7', '700', '13834741030', '王八', '7@qq.com', '7', '1096519509759695686', '70000', '1', '未完善', '2017-01-16');
INSERT INTO `wc_vip_user` VALUES ('8', '800', '13834741031', '郝九', '8@qq.com', '8', '1096519509759695686', '80000', '1', '未完善', '2017-01-18');
INSERT INTO `wc_vip_user` VALUES ('9', '110', '18310067378', '迟十', 'aa@qq.com', '8', '1096519509759695686', '9999', '1', '未完善', '2017-04-12');
INSERT INTO `wc_vip_user` VALUES ('10', '110', '15234803614', '苏紫轩', 'aa@qq.com', '8', '1096519509759695686', '1200', '1', '未完善', '2017-05-11');

-- ----------------------------
-- Table structure for wc_vip_value
-- ----------------------------
DROP TABLE IF EXISTS `wc_vip_value`;
CREATE TABLE `wc_vip_value` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `uid` int(5) DEFAULT '0' COMMENT '管理用户id',
  `hid` int(5) DEFAULT '0' COMMENT '会员用户id',
  `cid` int(5) DEFAULT '0' COMMENT '配置id',
  `word` varchar(30) DEFAULT '' COMMENT '信息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wc_vip_value
-- ----------------------------
INSERT INTO `wc_vip_value` VALUES ('1', '1', '1', '1', '9586@msn');
INSERT INTO `wc_vip_value` VALUES ('2', '1', '1', '2', '支付宝');
INSERT INTO `wc_vip_value` VALUES ('3', '1', '1', '3', '5kg');
INSERT INTO `wc_vip_value` VALUES ('4', '1', '1', '4', '180cm');
INSERT INTO `wc_vip_value` VALUES ('5', '1', '1', '5', 'o');
INSERT INTO `wc_vip_value` VALUES ('6', '1', '1', '6', '结婚');
INSERT INTO `wc_vip_value` VALUES ('7', '1', '1', '7', '单身');
INSERT INTO `wc_vip_value` VALUES ('8', '1', '1', '8', '1000000');
INSERT INTO `wc_vip_value` VALUES ('9', '1', '1', '9', 'ceo');
INSERT INTO `wc_vip_value` VALUES ('10', '1', '1', '10', '董事长');
INSERT INTO `wc_vip_value` VALUES ('11', '1', '1', '11', '博士');
INSERT INTO `wc_vip_value` VALUES ('12', '1', '1', '12', '京华一诺');
INSERT INTO `wc_vip_value` VALUES ('13', '1', '1', '13', '清华');
INSERT INTO `wc_vip_value` VALUES ('14', '1', '1', '29', '打球啊');
INSERT INTO `wc_vip_value` VALUES ('15', '1', '2', '29', '里阿尼去啊');
INSERT INTO `wc_vip_value` VALUES ('16', '1', '9', '29', '约炮');

-- ----------------------------
-- Table structure for wc_wechat_conf
-- ----------------------------
DROP TABLE IF EXISTS `wc_wechat_conf`;
CREATE TABLE `wc_wechat_conf` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '微信平台配置表id',
  `state` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否启用微信号登陆授权\r\n默认0\r\n1是允许',
  `appid` varchar(60) NOT NULL,
  `appsecret` varchar(60) NOT NULL DEFAULT '',
  `login_url` varchar(80) NOT NULL COMMENT '登陆授权的发起页域名',
  `begin_url` varchar(80) NOT NULL COMMENT '发起授权页的体验URL',
  `node_url` varchar(80) NOT NULL COMMENT '授权事件接收URl',
  `show_url` varchar(80) NOT NULL DEFAULT '',
  `message` varchar(120) NOT NULL COMMENT '公众号消息与事件接收Url',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of wc_wechat_conf
-- ----------------------------
