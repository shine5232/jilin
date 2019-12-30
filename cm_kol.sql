/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : cm_kol

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-12-30 23:39:48
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `bf_customer`
-- ----------------------------
DROP TABLE IF EXISTS `bf_customer`;
CREATE TABLE `bf_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '客户id',
  `customer_code` varchar(20) NOT NULL COMMENT '账号',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `company` varchar(200) NOT NULL COMMENT '客户名称',
  `linkman` varchar(20) DEFAULT NULL COMMENT '联系人',
  `phone` varchar(20) DEFAULT NULL COMMENT '手机',
  `address` varchar(100) DEFAULT NULL COMMENT '公司地址',
  `trade_id` int(11) NOT NULL COMMENT '行业id',
  `token` varchar(50) NOT NULL COMMENT '令牌',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `login_date` timestamp NULL DEFAULT NULL COMMENT '最近登录时间',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '有效状态',
  PRIMARY KEY (`customer_id`) USING BTREE,
  KEY `行业` (`trade_id`) USING BTREE,
  CONSTRAINT `行业` FOREIGN KEY (`trade_id`) REFERENCES `sys_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='客户';

-- ----------------------------
-- Records of bf_customer
-- ----------------------------
INSERT INTO bf_customer VALUES ('2', 'zhoujianhui', 'Abc123456', '创梦网络科技有限责任公司', '周建辉', '13205350000', '观海路黄海国际B座', '103', '', '2019-11-14 09:07:30', null, null, '1');
INSERT INTO bf_customer VALUES ('6', 'wangxiaohui', 'Abc123456', '创梦网络科技有限责任公司', '王晓辉', '13205351111', '观海路黄海国际B座', '103', '', '2019-11-14 09:08:19', null, null, '1');
INSERT INTO bf_customer VALUES ('8', 'zhongshuang', 'Abc123456', '创梦网络科技有限责任公司', '仲爽', '13205352222', '观海路黄海国际B座', '103', '', '2019-11-14 09:09:10', null, null, '1');

-- ----------------------------
-- Table structure for `bf_device`
-- ----------------------------
DROP TABLE IF EXISTS `bf_device`;
CREATE TABLE `bf_device` (
  `device_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '设备id',
  `device_name` varchar(50) NOT NULL COMMENT '设备名称',
  `task_id` int(11) DEFAULT NULL COMMENT '任务id',
  `task_kol_id` int(11) DEFAULT NULL COMMENT '大号id',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '有效状态',
  PRIMARY KEY (`device_id`) USING BTREE,
  KEY `task_id` (`task_id`),
  KEY `task_kol_id` (`task_kol_id`),
  CONSTRAINT `bf_device_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `bus_task` (`task_id`),
  CONSTRAINT `bf_device_ibfk_2` FOREIGN KEY (`task_kol_id`) REFERENCES `bus_task_kol` (`task_kol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='手机设备';

-- ----------------------------
-- Records of bf_device
-- ----------------------------
INSERT INTO bf_device VALUES ('5', '小米1号手机', '2', '1', '2019-11-13 15:02:29', null, '1');
INSERT INTO bf_device VALUES ('27', '测试3', '2', '2', '2019-11-19 11:11:19', '', '1');
INSERT INTO bf_device VALUES ('28', '小米2号手机', '2', '1', '2019-11-20 10:27:48', null, '1');

-- ----------------------------
-- Table structure for `bf_widget`
-- ----------------------------
DROP TABLE IF EXISTS `bf_widget`;
CREATE TABLE `bf_widget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `widget_id` varchar(60) NOT NULL COMMENT '控件ID',
  `widget_description` varchar(100) NOT NULL COMMENT '控件描述',
  `app_id` int(11) NOT NULL COMMENT '控件所属app',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '有效状态',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `app_id` (`app_id`),
  CONSTRAINT `bf_widget_ibfk_1` FOREIGN KEY (`app_id`) REFERENCES `sys_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='控件';

-- ----------------------------
-- Records of bf_widget
-- ----------------------------
INSERT INTO bf_widget VALUES ('1', 'btn_close', '360分身大师“五星支持”弹窗中的关闭按钮', '119', null, '1');
INSERT INTO bf_widget VALUES ('2', 'set_icon', '360分身大师右上角设置按钮', '119', null, '1');
INSERT INTO bf_widget VALUES ('3', 'iv_add_open', '360分身大师下方中间“添加分身”按钮', '119', null, '1');
INSERT INTO bf_widget VALUES ('4', 'iv_app_ram', '360分身大师内存使用百分比', '119', null, '1');
INSERT INTO bf_widget VALUES ('5', 'clean_dialog_close_btn', '360分身大师“设置清理应用”弹窗中的关闭按钮', '119', null, '1');
INSERT INTO bf_widget VALUES ('6', 'pkg_grid', '360分身大师中间滚动区域', '119', null, '1');
INSERT INTO bf_widget VALUES ('7', 'text', '360分身大师分身APP图标名称', '119', null, '1');
INSERT INTO bf_widget VALUES ('8', 'dm5', '抖音主页下方“首页”、“我”等', '113', '', '1');
INSERT INTO bf_widget VALUES ('9', 'ba0', '抖音主页上方搜索放大镜', '113', null, '1');
INSERT INTO bf_widget VALUES ('10', 'aia', '抖音主页进入搜索后的输入框', '113', null, '1');
INSERT INTO bf_widget VALUES ('11', 'cx1', '抖音搜索“用户”选项卡下的滚动区域', '113', null, '1');
INSERT INTO bf_widget VALUES ('12', 'e2a', '抖音搜索“用户”选项卡下的子项目的抖音号', '113', null, '1');
INSERT INTO bf_widget VALUES ('14', 'df_', '抖音大V号的粉丝列表滚动区域', '113', null, '1');
INSERT INTO bf_widget VALUES ('15', 'eio', '抖音大V号的粉丝列表中的粉丝昵称', '113', null, '1');
INSERT INTO bf_widget VALUES ('16', 'ekx', '抖音个人中心的“抖音号：xxxxxx”', '113', null, '1');
INSERT INTO bf_widget VALUES ('17', 'kt', '抖音上方返回上一页按钮', '113', null, '1');
INSERT INTO bf_widget VALUES ('18', 'dra', '抖音个人中心右上方的3个点按钮（更多）', '113', null, '1');
INSERT INTO bf_widget VALUES ('19', 'd9f', '抖音“更多”界面中的聊天私信图标', '113', null, '1');
INSERT INTO bf_widget VALUES ('20', 'c4c', '抖音私信聊天界面下方的输入框', '113', null, '1');
INSERT INTO bf_widget VALUES ('21', 'd96', '抖音私信聊天界面下方输入内容后，键盘中的发送图标', '113', null, '1');
INSERT INTO bf_widget VALUES ('22', 'a9x', '抖音个人中心的“获赞”数量', '113', null, '1');
INSERT INTO bf_widget VALUES ('23', 'aq6', '抖音个人中心的“关注”数量', '113', null, '1');
INSERT INTO bf_widget VALUES ('24', 'aq1', '抖音个人中心的“粉丝”数量', '113', null, '1');
INSERT INTO bf_widget VALUES ('25', 'c7s', '抖音个人中心的“昵称”', '113', null, '1');
INSERT INTO bf_widget VALUES ('26', 'egk', '抖音编辑资料中的每项', '113', null, '1');
INSERT INTO bf_widget VALUES ('27', 'ckh', '抖音用户登录界面用户协议勾选', '113', null, '1');
INSERT INTO bf_widget VALUES ('28', 'ei1', '抖音“其他登录方式”', '113', null, '1');
INSERT INTO bf_widget VALUES ('29', 'b4c', '抖音“头条”登录图标', '113', null, '1');
INSERT INTO bf_widget VALUES ('30', 'b4d', '抖音“新浪微博”登录图标', '113', null, '1');
INSERT INTO bf_widget VALUES ('31', 'd69', '今日头条下方“我的”', '117', null, '1');
INSERT INTO bf_widget VALUES ('32', 'cc6', '今日头条“系统设置”', '117', null, '1');
INSERT INTO bf_widget VALUES ('33', 'cza', '今日头条“设置”整个滚动区域', '117', null, '1');
INSERT INTO bf_widget VALUES ('34', 'd28', '今日头条“退出登录”', '117', null, '1');
INSERT INTO bf_widget VALUES ('35', 'd59', '今日头条退出登录时的弹窗“确认退出”', '117', null, '1');
INSERT INTO bf_widget VALUES ('36', 'cbt', '今日头条“登录”按钮', '117', null, '1');
INSERT INTO bf_widget VALUES ('37', 'rs', '今日头条“更多登录”', '117', null, '1');
INSERT INTO bf_widget VALUES ('38', 'bvd', '今日头条“密码登录”', '117', null, '1');
INSERT INTO bf_widget VALUES ('39', 'ecp', '抖音登录页左上角“关闭”', '113', null, '1');
INSERT INTO bf_widget VALUES ('40', 'ebh', '抖音私信发送中的“已送达”', '113', null, '1');
INSERT INTO bf_widget VALUES ('41', 'dh7', '抖音私信发送中的未送达叹号', '113', null, '1');
INSERT INTO bf_widget VALUES ('42', 'c08', '抖音“我”右上角的三条杠图标', '113', null, '1');
INSERT INTO bf_widget VALUES ('43', 'eaq', '抖音“设置”、“退出登录”等条目', '113', null, '1');
INSERT INTO bf_widget VALUES ('44', 'd0q', '抖音“设置”的整个滚动区域', '113', null, '1');
INSERT INTO bf_widget VALUES ('45', 'ru', '抖音退出登录的“退出”按钮', '113', null, '1');
INSERT INTO bf_widget VALUES ('46', 'c9_', '抖音私信“由于对方的隐私设置，你无法发送消息”', '113', null, '1');
INSERT INTO bf_widget VALUES ('47', 'az3', '“和好友一起看头条”弹窗的“好的”按钮', '117', null, '1');
INSERT INTO bf_widget VALUES ('48', 'bv0', '今日头条账号输入“手机号/邮箱”', '117', null, '1');
INSERT INTO bf_widget VALUES ('49', 'bv8', '今日头条账号输入“密码”', '117', null, '1');
INSERT INTO bf_widget VALUES ('50', 'u4', '今日头条“授权并登录”按钮', '117', null, '1');
INSERT INTO bf_widget VALUES ('51', 'eid', '抖音绑定手机号“跳过”', '113', null, '1');
INSERT INTO bf_widget VALUES ('52', '111', '11111', '114', '', '1');
INSERT INTO bf_widget VALUES ('53', '测试', '测试', '113', '', '1');

-- ----------------------------
-- Table structure for `bus_account`
-- ----------------------------
DROP TABLE IF EXISTS `bus_account`;
CREATE TABLE `bus_account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '账号id',
  `task_id` int(11) DEFAULT NULL COMMENT '任务id',
  `app_id` int(11) DEFAULT NULL COMMENT 'APPid',
  `account_code` varchar(100) NOT NULL COMMENT '平台账号',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `is_working` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否工作中',
  `third_party_id` varchar(50) DEFAULT NULL COMMENT '第三方平台的用户id',
  `follows` int(11) NOT NULL DEFAULT '0' COMMENT '关注量',
  `fans` int(11) NOT NULL DEFAULT '0' COMMENT '粉丝量',
  `comments` int(11) NOT NULL DEFAULT '0' COMMENT '评论量（我发出的评论及回复）',
  `replys` int(11) NOT NULL DEFAULT '0' COMMENT '回复量（粉丝给我的回复）',
  `sends` int(11) NOT NULL DEFAULT '0' COMMENT '私信发送量',
  `task_time` timestamp NULL DEFAULT NULL COMMENT '最近任务时间',
  `activate_date` timestamp NULL DEFAULT NULL COMMENT '激活时间',
  `ssid` varchar(20) DEFAULT NULL COMMENT 'WIFI 名称',
  `bssid` varchar(17) DEFAULT NULL COMMENT 'WIFI 路由器MAC地址',
  `wlan_mac` varchar(17) DEFAULT NULL COMMENT 'WLAN MAC地址',
  `serial_no` varchar(16) DEFAULT NULL COMMENT '硬件序列号',
  `brand` varchar(50) DEFAULT 'xiaomi' COMMENT '系统定制商',
  `manufacturer` varchar(50) DEFAULT 'Xiaomi' COMMENT '硬件制造商',
  `device` varchar(50) DEFAULT 'lavender' COMMENT '设备驱动参数',
  `product` varchar(50) DEFAULT 'lavender' COMMENT '整个产品系列名称',
  `board` varchar(50) DEFAULT 'sdm660' COMMENT '主板',
  `radio_version` varchar(255) DEFAULT NULL COMMENT '无线电固件版本',
  `time` bigint(10) DEFAULT NULL COMMENT '出厂时间',
  `model` varchar(50) DEFAULT 'Redmi Note 7' COMMENT '用户可见产品名称',
  `hardware` varchar(50) DEFAULT 'qcom' COMMENT '硬件名称',
  `id` varchar(50) DEFAULT NULL COMMENT '修订版本ID',
  `host` varchar(100) DEFAULT NULL COMMENT 'HOST名',
  `display` varchar(100) DEFAULT NULL COMMENT '显示参数',
  `release` tinyint(2) DEFAULT NULL COMMENT 'Android固件版本',
  `incremental` varchar(60) DEFAULT NULL COMMENT '基带系统版本',
  `sdk` tinyint(2) DEFAULT NULL COMMENT 'SDK版本',
  `sim_serial_number` varchar(20) DEFAULT NULL COMMENT 'SIM卡序列号',
  `get_line1_number` varchar(11) DEFAULT NULL COMMENT '手机号',
  `get_subscriber_id` varchar(15) DEFAULT NULL COMMENT '用户ID号',
  `imei0` varchar(15) DEFAULT NULL COMMENT '国际移动设备识别码（卡1）',
  `imei1` varchar(15) DEFAULT NULL COMMENT '国际移动设备识别码（卡2）',
  `meid` varchar(14) DEFAULT NULL COMMENT '移动设备标识符',
  `android_id` varchar(20) DEFAULT NULL COMMENT 'Android_id',
  `latitude` decimal(6,0) unsigned DEFAULT NULL COMMENT '纬度',
  `longitude` decimal(6,0) unsigned DEFAULT NULL COMMENT '经度',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '有效状态',
  PRIMARY KEY (`account_id`) USING BTREE,
  KEY `task_id` (`task_id`) USING BTREE,
  KEY `app_id` (`app_id`),
  CONSTRAINT `bus_account_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `bus_task` (`task_id`),
  CONSTRAINT `bus_account_ibfk_3` FOREIGN KEY (`app_id`) REFERENCES `sys_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='平台账号';

-- ----------------------------
-- Records of bus_account
-- ----------------------------
INSERT INTO bus_account VALUES ('54', '2', '117', '2884254978@163.com', 'qh962014', '1', null, '0', '0', '0', '0', '2', '2019-11-20 15:19:57', null, 'BU8I350F3S', '96:37:63:EA:E7:A2', '21:44:3D:3A:06:58', 'bgfqjj9s0', 'samsung', 'SAMSUNG', 'GTN', 'GTN', 'GTN091', 'ICSLQZXYZVPUB', '1568864156', 'snqrz5nxf', '3LTV', '9PER.3671', 'MZ-YZ0YY4-76', '9PER.3671', '7', 'V11.1.5.8.FU7MK5K5', '24', '89670570643034139889', '15327274487', '469086046892460', '868256976893685', '868256976893686', '99873631882780', 'zo0m378unt5ce9d1', null, null, '2019-11-15 15:53:22', '身材管理师', '1');
INSERT INTO bus_account VALUES ('55', '5', '117', '1662940585@163.com', 'dk111918', '0', null, '0', '0', '0', '0', '0', null, null, 'I3KBPEDHZ4', '1D:74:59:DE:B0:F8', '42:A1:8C:57:56:A4', 'nigww9ptv', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'X5I5KEREBGWX2', '1566028419', 'Redmi Note 7', 'qcom', 'PKQ1.4240', 'c3-miui-ota-bd52.bj', 'PKQ1.4240', '7', 'V10.3.8.2.PFGCNXM', '24', '89865380295207410491', '17776162229', '463026187283080', '866367945774587', '866367945774588', '99058853586632', '57rdw0j9i14mzxil', null, null, '2019-11-15 15:53:39', '辣妈健身团', '1');
INSERT INTO bus_account VALUES ('56', '5', '117', '2422665210@163.com', 'rr871849', '0', null, '0', '0', '0', '0', '0', '2019-11-19 17:22:56', null, 'EDWZVCMWNA', '58:1B:CF:A8:24:91', 'A7:22:3E:EC:5A:F5', 'o7glilmp5', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'I7BFL80JSKK64', '1568620434', 'Redmi Note 7', 'qcom', 'PKQ1.2539', 'c2-miui-ota-bd88.bj', 'PKQ1.2539', '8', 'V10.2.2.7.PFGCNXM', '26', '89698287524037520387', '18191331810', '464910509814629', '866577483288335', '866577483288336', '99487787903724', 'bucsa1571oe4kcck', null, null, '2019-11-15 15:53:54', '懒人健身计划', '1');
INSERT INTO bus_account VALUES ('57', '5', '117', '2904037434@163.com', 'xi915783', '0', null, '0', '0', '0', '0', '59', '2019-11-19 14:43:50', null, 'G7RMDOV04E', 'C7:10:21:A3:53:D1', '21:82:29:DD:FF:1C', 'yujitx069', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'FSVJWSY295KFV', '1566028452', 'Redmi Note 7', 'qcom', 'PKQ1.5813', 'c2-miui-ota-bd26.bj', 'PKQ1.5813', '9', 'V10.1.5.4.PFGCNXM', '28', '89626212403760397730', '18034156682', '468323567664235', '861049733184782', '861049733184783', '99002022225013', '0u4paxeofv4tj53b', null, null, '2019-11-15 15:54:12', '丹妮', '1');
INSERT INTO bus_account VALUES ('58', '5', '117', '3867474140@163.com', 'io582638', '0', null, '0', '0', '0', '0', '0', null, null, 'U1JDLKTI5P', 'B6:55:FF:4B:AD:C5', 'D1:28:80:86:EE:40', '9k9q71wy5', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'DVAMKSKJDI518', '1563436468', 'Redmi Note 7', 'qcom', 'PKQ1.3252', 'c2-miui-ota-bd17.bj', 'PKQ1.3252', '7', 'V9.3.1.0.PFGCNXM', '24', '89622892108762159243', '17321310776', '469564042984833', '866116561356200', '866116561356201', '99589567860113', 'ermxn0y7klrdus5q', null, null, '2019-11-15 15:54:28', '减肥规划师', '1');
INSERT INTO bus_account VALUES ('59', '5', '117', '3222621892@163.com    ', 'tp232598', '0', null, '0', '0', '0', '0', '5', '2019-11-19 11:07:58', null, 'BMYY7PSEG6', 'F0:4A:8F:81:1B:4B', '89:2E:B9:BA:34:B4', 'ntbxs674q', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'X9BMGIAX31E1H', '1566028481', 'Redmi Note 7', 'qcom', 'PKQ1.9932', 'c2-miui-ota-bd27.bj', 'PKQ1.9932', '7', 'V9.1.8.8.PFGCNXM', '24', '89870885953931965879', '18973314493', '461808730836836', '861534983102450', '861534983102451', '99516533199762', '8vlk09yaxneuqzvc', null, null, '2019-11-15 15:54:41', '丹八岁', '1');
INSERT INTO bus_account VALUES ('60', '5', '117', '1941512344@163.com', 'oa261260', '0', null, '0', '0', '0', '0', '8', '2019-11-19 11:44:19', null, 'W53FMN0TGR', '21:53:A2:E0:4D:5B', '22:3D:7D:68:D6:39', 'td0uyu554', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'SFS3VAHJ16DY8', '1563436548', 'Redmi Note 7', 'qcom', 'PKQ1.2004', 'c9-miui-ota-bd64.bj', 'PKQ1.2004', '8', 'V10.3.4.7.PFGCNXM', '26', '89070062694538427078', '18054709356', '469883865705721', '866449540325380', '866449540325381', '99748670436382', '6nugne2y908oj31w', null, null, '2019-11-15 15:55:48', '丹妮-Daniel', '1');
INSERT INTO bus_account VALUES ('61', '5', '117', '3133521061@163.com', 'cq380171', '0', null, '0', '0', '0', '0', '21', '2019-11-19 12:03:55', null, 'BYVR833LBK', '43:4B:1E:A1:91:D2', 'EB:35:C5:AE:D8:8D', 'apctc24dn', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'E2V96PWUENF88', '1563436570', 'Redmi Note 7', 'qcom', 'PKQ1.7096', 'c2-miui-ota-bd31.bj', 'PKQ1.7096', '9', 'V11.3.1.0.PFGCNXM', '28', '89093003754196596204', '18993667783', '465003488578116', '865556679862676', '865556679862677', '99218348018469', 'qvgu4jh2x45gkfrk', null, null, '2019-11-15 15:56:10', '懒人健身计划', '1');
INSERT INTO bus_account VALUES ('62', '5', '117', '3402590287@163.com', 'up792817', '0', null, '0', '0', '0', '0', '0', null, null, 'Z9Q7TS10NP', '77:83:83:1B:4E:0D', '94:89:A3:A4:40:08', '4mv5uwo1s', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'DLQCQSF7S9OT6', '1566028585', 'Redmi Note 7', 'qcom', 'PKQ1.1348', 'c2-miui-ota-bd95.bj', 'PKQ1.1348', '7', 'V9.3.6.6.PFGCNXM', '24', '89497551335831052288', '15395427774', '463994169060917', '867138920907755', '867138920907756', '99293109513104', '9bpfmsbsrou6zd4s', null, null, '2019-11-15 15:56:25', '减脂规划师', '1');
INSERT INTO bus_account VALUES ('63', '4', '117', '1469868635@163.com', 'dl871118', '0', null, '0', '0', '0', '0', '44', '2019-11-20 10:59:42', null, 'RHPH6N7LYN', 'CE:7B:A7:51:84:9E', 'D3:CD:91:F4:CE:5D', 'szil6zem2', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', '0RBFFSHRC8YX2', '1560904976', 'Redmi Note 7', 'qcom', 'PKQ1.7661', 'c8-miui-ota-bd14.bj', 'PKQ1.7661', '7', 'V10.3.5.0.PFGCNXM', '24', '89449770864444633853', '13313279236', '461747790848068', '869409040795557', '869409040795558', '99670585523831', '6898a3ck366i1vtb', null, null, '2019-11-16 08:38:27', '辣妈健身团', '1');
INSERT INTO bus_account VALUES ('64', null, '117', '1323837379@163.com', 'rg520928', '0', null, '0', '0', '0', '0', '53', '2019-11-19 16:50:14', null, 'THV2S6T7Z4', '8D:21:18:9F:FA:0B', '8F:0A:C4:EF:4C:B5', 'nas6te4d4', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'T3RLDDRYASV6G', '1563496737', 'Redmi Note 7', 'qcom', 'PKQ1.6993', 'c7-miui-ota-bd17.bj', 'PKQ1.6993', '8', 'V10.2.7.5.PFGCNXM', '26', '89176634240927519195', '13344408367', '464569931533407', '864152757972171', '864152757972172', '99996637682515', 'gkbqzq2bm5772raq', null, null, '2019-11-16 08:38:57', '倾城佳丽毁于肥', '1');
INSERT INTO bus_account VALUES ('65', null, '117', '1274051710@163.com', 'op549064', '0', null, '0', '0', '0', '0', '49', '2019-11-20 14:33:39', null, 'QRYJPMPJN0', '06:16:0E:1E:E5:62', '76:69:4C:2A:A8:10', '1c2i0i5of', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'BSUU6LJSPY4C1', '1568680763', 'Redmi Note 7', 'qcom', 'PKQ1.4441', 'c9-miui-ota-bd30.bj', 'PKQ1.4441', '8', 'V10.1.9.1.PFGCNXM', '26', '89635256990619738836', '13370692193', '464459716884114', '861119466979910', '861119466979911', '99273551635617', 'v4j9jr2g1sg6scus', null, null, '2019-11-16 08:39:23', '丹妮-Daniel', '1');
INSERT INTO bus_account VALUES ('66', null, '117', '1248674414@163.com', 'oi664853', '0', null, '0', '0', '0', '0', '0', null, null, 'NJKO5JSSNA', '63:FE:65:DA:80:EC', '15:C7:1C:C5:1C:ED', 'y7saalwkd', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'E44T6HVNZIEFV', '1560904783', 'Redmi Note 7', 'qcom', 'PKQ1.5563', 'c6-miui-ota-bd31.bj', 'PKQ1.5563', '7', 'V10.2.8.9.PFGCNXM', '24', '89624879263994422874', '18131616049', '469599862826526', '868345592521120', '868345592521121', '99017296157088', 'pbpy401jekwwm7eh', null, null, '2019-11-16 08:39:43', '懒人健身', '1');
INSERT INTO bus_account VALUES ('67', null, '117', '3963333978@163.com', 'bm085387', '0', null, '0', '0', '0', '0', '0', null, null, '06ZOFWGJPS', 'C1:F8:F2:32:2B:93', '0F:AB:03:28:57:A6', 'ov0ff7d8z', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'LC7WV44WRIUXV', '1566088803', 'Redmi Note 7', 'qcom', 'PKQ1.9905', 'c8-miui-ota-bd59.bj', 'PKQ1.9905', '8', 'V10.3.4.0.PFGCNXM', '26', '89482083699480746166', '15312708687', '469237127336355', '862406053215831', '862406053215832', '99344901071292', 'te7u7mhu2b0nueyf', null, null, '2019-11-16 08:40:03', '', '0');
INSERT INTO bus_account VALUES ('68', null, '117', '1538008604@163.com', 'ch663537', '0', null, '0', '0', '0', '0', '0', null, null, '30BCC296Z3', 'CB:6F:77:F2:02:37', 'BB:FD:BD:74:65:2A', 'ntpfgwdo9', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'SL454H6RNZASW', '1568680822', 'Redmi Note 7', 'qcom', 'PKQ1.8510', 'c8-miui-ota-bd70.bj', 'PKQ1.8510', '7', 'V10.2.0.4.PFGCNXM', '24', '89908491347242807814', '14961979089', '463353862656377', '869230413298610', '869230413298611', '99438275958673', 'lxdf3wsfz48kk5oy', null, null, '2019-11-16 08:40:22', '', '0');
INSERT INTO bus_account VALUES ('69', null, '117', '2160282460@163.com', 'mu587910', '0', null, '0', '0', '0', '0', '0', null, null, 'G88PDVOX6O', 'C0:84:A5:81:13:AD', 'E3:FF:43:D4:32:63', '6h9p6dyeb', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'K95DGXPDQ4KUM', '1563496840', 'Redmi Note 7', 'qcom', 'PKQ1.2589', 'c4-miui-ota-bd58.bj', 'PKQ1.2589', '9', 'V10.3.1.9.PFGCNXM', '28', '89544285201121295991', '19910226993', '460268727966375', '866888293969043', '866888293969044', '99005692674302', 'fje3xqgck48uu5o9', null, null, '2019-11-16 08:40:40', '', '0');
INSERT INTO bus_account VALUES ('70', null, '117', '2479629502@163.com', 'hs793852', '0', null, '0', '0', '0', '0', '0', null, null, '56UCVDGBBA', 'BF:CF:B2:C4:FA:32', 'AC:15:98:95:3E:03', 'mycinayzw', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'C18TX8GFAZ858', '1566088869', 'Redmi Note 7', 'qcom', 'PKQ1.6552', 'c6-miui-ota-bd22.bj', 'PKQ1.6552', '7', 'V11.2.2.1.PFGCNXM', '24', '89486483152237929974', '18126935988', '466934118793703', '863178323936433', '863178323936434', '99927350048033', 'y18mxv671xvevsjp', null, null, '2019-11-16 08:41:09', '', '0');
INSERT INTO bus_account VALUES ('71', null, '117', '3932082983@163.com', 'dx400964', '0', null, '0', '0', '0', '0', '0', null, null, 'LA8WS6BDUH', '92:79:C1:E6:43:8C', '4D:98:E7:A2:54:43', 'yjm4bpq7e', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', '4QZHYUZD1Z04G', '1563496906', 'Redmi Note 7', 'qcom', 'PKQ1.7692', 'c5-miui-ota-bd54.bj', 'PKQ1.7692', '9', 'V10.2.2.9.PFGCNXM', '28', '89904543744356907980', '13398959970', '466182616897327', '866398097038330', '866398097038331', '99249228376125', 'uw88kfr45ajabo7x', null, null, '2019-11-16 08:41:46', '', '0');
INSERT INTO bus_account VALUES ('72', null, '117', '2801222643@163.com', 'yw857271', '0', null, '0', '0', '0', '0', '0', null, null, 'RMZXW7X804', 'A9:0F:80:F3:10:30', 'BB:17:E4:47:9B:33', '2d31voip6', 'xiaomi', 'Xiaomi', 'lavender', 'lavender', 'sdm660', 'FE6VDW49IGGG3', '1566090313', 'Redmi Note 7', 'qcom', 'PKQ1.9076', 'c9-miui-ota-bd60.bj', 'PKQ1.9076', '7', 'V10.1.0.5.PFGCNXM', '24', '89996888164531184094', '13369437234', '467583062217879', '866785629488455', '866785629488456', '99525184268855', 'aany5n1u61lpo7qg', null, null, '2019-11-16 08:42:06', '', '0');
INSERT INTO bus_account VALUES ('74', null, '117', '1772266452@163.com', 'bg265058', '0', null, '0', '0', '0', '0', '0', null, null, 'HXBGVIAI81', '1C:76:38:73:53:BF', '8F:58:4A:19:56:75', 'ajvza4zl3', 'samsung', 'SAMSUNG', 'GTN', 'GTN', 'GTN091', '9FYDMLGKWBGWB', '1566443914', 'qd57a7b86', '7G37', 'FJGJ.4980', '5I-ALMS1L-85', 'FJGJ.4980', '9', 'V8.2.2.1.4GDNFJTP', '28', '89658046521755406165', '17355835404', '468314755860922', '862331702921191', '862331702921192', '99898476613228', '57pxo5y9u47ywkhu', null, null, '2019-11-20 11:18:34', '', '0');

-- ----------------------------
-- Table structure for `bus_account_log`
-- ----------------------------
DROP TABLE IF EXISTS `bus_account_log`;
CREATE TABLE `bus_account_log` (
  `account_log_id` bigint(11) NOT NULL AUTO_INCREMENT COMMENT '记录id',
  `account_id` int(11) NOT NULL COMMENT '账号id',
  `task_id` int(11) NOT NULL COMMENT '任务id',
  `follows` int(11) NOT NULL DEFAULT '0' COMMENT '关注量',
  `follows_today` int(11) NOT NULL DEFAULT '0' COMMENT '今日新增',
  `fans` int(11) NOT NULL DEFAULT '0' COMMENT '粉丝量',
  `fans_today` int(11) NOT NULL DEFAULT '0' COMMENT '今日新增',
  `comments` int(255) NOT NULL DEFAULT '0' COMMENT '评论量',
  `comments_today` int(11) NOT NULL DEFAULT '0' COMMENT '今日新增',
  `replys` int(255) NOT NULL DEFAULT '0' COMMENT '回复量',
  `replys_today` int(11) NOT NULL DEFAULT '0' COMMENT '今日新增',
  `sends` int(255) NOT NULL DEFAULT '0' COMMENT '私信发送量',
  `sends_today` int(11) NOT NULL DEFAULT '0' COMMENT '今日新增',
  `task_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '任务时间',
  PRIMARY KEY (`account_log_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='平台账号：每日记录';

-- ----------------------------
-- Records of bus_account_log
-- ----------------------------

-- ----------------------------
-- Table structure for `bus_task`
-- ----------------------------
DROP TABLE IF EXISTS `bus_task`;
CREATE TABLE `bus_task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '任务id',
  `task_name` varchar(100) NOT NULL COMMENT '任务名称',
  `describe` varchar(500) NOT NULL COMMENT '描述',
  `customer_id` int(11) NOT NULL COMMENT '客户id',
  `platform_id` int(11) NOT NULL COMMENT '平台id',
  `sex_id` int(11) NOT NULL COMMENT '性别id',
  `is_browse` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开启刷视频',
  `is_follow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开启关注互粉',
  `is_comment` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开启评论',
  `is_send` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开启私信',
  `follows` int(11) NOT NULL DEFAULT '0' COMMENT '关注量',
  `fans` int(11) NOT NULL DEFAULT '0' COMMENT '粉丝量',
  `comments` int(11) NOT NULL DEFAULT '0' COMMENT '评论量（我发出的评论及回复）',
  `replys` int(11) NOT NULL DEFAULT '0' COMMENT '回复量（粉丝给我的回复）',
  `sends` int(11) NOT NULL DEFAULT '0' COMMENT '私信发送量',
  `task_time` timestamp NULL DEFAULT NULL COMMENT '最近任务时间',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '有效状态',
  PRIMARY KEY (`task_id`) USING BTREE,
  KEY `customer_id` (`customer_id`) USING BTREE,
  KEY `platform_id` (`platform_id`) USING BTREE,
  KEY `sex_id` (`sex_id`) USING BTREE,
  CONSTRAINT `bus_task_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `bf_customer` (`customer_id`),
  CONSTRAINT `bus_task_ibfk_2` FOREIGN KEY (`platform_id`) REFERENCES `sys_type` (`type_id`),
  CONSTRAINT `bus_task_ibfk_3` FOREIGN KEY (`sex_id`) REFERENCES `sys_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='任务主表';

-- ----------------------------
-- Records of bus_task
-- ----------------------------
INSERT INTO bus_task VALUES ('2', '采集抖音', '', '2', '100', '110', '0', '0', '0', '0', '0', '0', '0', '0', '254', null, '2019-11-14 09:15:27', null, '1');
INSERT INTO bus_task VALUES ('3', '采集抖音', '', '6', '100', '108', '0', '0', '0', '0', '0', '0', '0', '0', '0', null, '2019-11-14 09:19:51', null, '1');
INSERT INTO bus_task VALUES ('4', '测试', '测试', '2', '100', '109', '0', '0', '0', '0', '0', '0', '0', '0', '0', null, '2019-11-16 15:52:05', '', '1');
INSERT INTO bus_task VALUES ('5', 'dd', 'd', '6', '100', '108', '0', '0', '0', '0', '0', '0', '0', '0', '0', null, '2019-11-18 17:31:40', 'ff ', '1');

-- ----------------------------
-- Table structure for `bus_task_kol`
-- ----------------------------
DROP TABLE IF EXISTS `bus_task_kol`;
CREATE TABLE `bus_task_kol` (
  `task_kol_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '大号id',
  `task_id` int(11) NOT NULL COMMENT '任务id',
  `third_party_id` varchar(100) NOT NULL COMMENT '第三方平台的用户id',
  `nickname` varchar(100) NOT NULL COMMENT '大号的昵称',
  `describe` varchar(500) DEFAULT NULL COMMENT '描述',
  `age` int(11) DEFAULT NULL COMMENT '年龄',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `praises` int(11) DEFAULT NULL COMMENT '获赞',
  `follows` int(11) DEFAULT '0' COMMENT '关注',
  `fans` int(11) DEFAULT '0' COMMENT '粉丝',
  `works` int(11) DEFAULT NULL COMMENT '作品',
  `trends` int(11) DEFAULT NULL COMMENT '动态',
  `likes` int(11) DEFAULT NULL COMMENT '喜欢',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`task_kol_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `bus_task_kol_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `bus_task` (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='任务子表：KOL';

-- ----------------------------
-- Records of bus_task_kol
-- ----------------------------
INSERT INTO bus_task_kol VALUES ('1', '2', 'ke820198', '杜克减肥记', null, null, null, null, '0', '0', null, null, null, '2019-11-14 09:17:21');
INSERT INTO bus_task_kol VALUES ('2', '3', '124660376', '猫宁逆袭记', null, null, null, null, '0', '0', null, null, null, '2019-11-14 09:27:22');

-- ----------------------------
-- Table structure for `bus_task_log`
-- ----------------------------
DROP TABLE IF EXISTS `bus_task_log`;
CREATE TABLE `bus_task_log` (
  `task_log_id` bigint(11) NOT NULL AUTO_INCREMENT COMMENT '记录id',
  `task_id` int(11) NOT NULL COMMENT '任务id',
  `follows` int(11) NOT NULL DEFAULT '0' COMMENT '关注量',
  `follows_today` int(11) NOT NULL DEFAULT '0' COMMENT '今日新增',
  `fans` int(11) NOT NULL DEFAULT '0' COMMENT '粉丝量',
  `fans_today` int(11) NOT NULL DEFAULT '0' COMMENT '今日新增',
  `comments` int(11) NOT NULL DEFAULT '0' COMMENT '评论量',
  `comments_today` int(11) NOT NULL DEFAULT '0' COMMENT '今日新增',
  `replys` int(11) NOT NULL DEFAULT '0' COMMENT '回复量',
  `replys_today` int(11) NOT NULL DEFAULT '0' COMMENT '今日新增',
  `sends` int(11) NOT NULL DEFAULT '0' COMMENT '私信发送量',
  `sends_today` int(11) NOT NULL DEFAULT '0' COMMENT '今日新增',
  `task_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '任务时间',
  PRIMARY KEY (`task_log_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='任务主表：每日记录';

-- ----------------------------
-- Records of bus_task_log
-- ----------------------------
INSERT INTO bus_task_log VALUES ('1', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `bus_task_plot`
-- ----------------------------
DROP TABLE IF EXISTS `bus_task_plot`;
CREATE TABLE `bus_task_plot` (
  `task_plot_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文案id',
  `task_id` int(11) NOT NULL COMMENT '任务id',
  `plot_text` varchar(255) NOT NULL COMMENT '消息内容',
  `plot_type_id` int(11) NOT NULL COMMENT '文案类型id',
  `sends` int(11) NOT NULL DEFAULT '0' COMMENT '发送次数',
  `trans` int(11) NOT NULL DEFAULT '0' COMMENT '转化数量',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '有效状态',
  PRIMARY KEY (`task_plot_id`) USING BTREE,
  KEY `plot_type` (`plot_type_id`) USING BTREE,
  KEY `task_id` (`task_id`) USING BTREE,
  CONSTRAINT `bus_task_plot_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `bus_task` (`task_id`),
  CONSTRAINT `bus_task_plot_ibfk_3` FOREIGN KEY (`plot_type_id`) REFERENCES `sys_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='任务子表：文案';

-- ----------------------------
-- Records of bus_task_plot
-- ----------------------------
INSERT INTO bus_task_plot VALUES ('1', '2', '嗨喽，我是丹妮，很高兴在茫茫人海中遇见了你，如果你也想瘦身，那加我徽❤吧，让我们一起遇见更美的自己', '107', '0', '0', '2019-11-14 09:41:36', null, '1');
INSERT INTO bus_task_plot VALUES ('3', '2', '跟我一样懒，运动量比较少的小伙伴，告诉你一个懒人每月瘦10斤的小秘籍啦，轻松瘦出苗条好身材So easy~~', '107', '0', '0', '2019-11-14 09:41:56', null, '1');

-- ----------------------------
-- Table structure for `bus_task_wechat`
-- ----------------------------
DROP TABLE IF EXISTS `bus_task_wechat`;
CREATE TABLE `bus_task_wechat` (
  `task_wechat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '微信id',
  `task_id` int(11) NOT NULL COMMENT '任务id',
  `wechat_code` varchar(50) NOT NULL COMMENT '微信号',
  `nickname` varchar(50) NOT NULL COMMENT '微信昵称',
  `sends` int(11) NOT NULL DEFAULT '0' COMMENT '发送次数',
  `fans` int(11) NOT NULL DEFAULT '0' COMMENT '粉丝数量',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '有效状态',
  PRIMARY KEY (`task_wechat_id`) USING BTREE,
  KEY `task_id` (`task_id`) USING BTREE,
  CONSTRAINT `bus_task_wechat_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `bus_task` (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='任务子表：微信';

-- ----------------------------
-- Records of bus_task_wechat
-- ----------------------------
INSERT INTO bus_task_wechat VALUES ('1', '2', 'yt2019_daniel', '丹妮-Daniel', '0', '0', '2019-11-14 09:28:58', null, '1');
INSERT INTO bus_task_wechat VALUES ('2', '3', 'DN9786', '丹妮-Daniel', '0', '0', '2019-11-14 09:35:04', null, '1');
INSERT INTO bus_task_wechat VALUES ('3', '2', 'daniel-v1996', '丹妮-Daniel', '0', '0', '2019-11-20 10:06:10', null, '1');

-- ----------------------------
-- Table structure for `sys_brand`
-- ----------------------------
DROP TABLE IF EXISTS `sys_brand`;
CREATE TABLE `sys_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) DEFAULT NULL COMMENT '品牌名称',
  `brand_img` varchar(255) DEFAULT NULL COMMENT '品牌图标',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态',
  `creat_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_brand
-- ----------------------------
INSERT INTO sys_brand VALUES ('1', '奔驰', '20191230\\c66ee9c19585fee15f84430d450244eb.png', '1', '2019-12-30 23:29:26');

-- ----------------------------
-- Table structure for `sys_group`
-- ----------------------------
DROP TABLE IF EXISTS `sys_group`;
CREATE TABLE `sys_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分组id',
  `group_name` varchar(50) NOT NULL COMMENT '分组名称',
  `column_name` varchar(50) NOT NULL COMMENT '被调用列的列名',
  `option_edit` tinyint(1) NOT NULL DEFAULT '1' COMMENT '选项可编辑',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '有效状态',
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='选项分组';

-- ----------------------------
-- Records of sys_group
-- ----------------------------
INSERT INTO sys_group VALUES ('10', '平台', 'platform_id', '1', '', '1');
INSERT INTO sys_group VALUES ('11', '行业', 'trade_id', '1', null, '1');
INSERT INTO sys_group VALUES ('12', '文案类型', 'plot_type_id', '1', null, '1');
INSERT INTO sys_group VALUES ('13', '性别', 'sex_id', '1', null, '1');
INSERT INTO sys_group VALUES ('14', '私信方式', 'letter_way_id', '1', null, '1');
INSERT INTO sys_group VALUES ('15', 'APP控件', 'app_id', '1', null, '1');
INSERT INTO sys_group VALUES ('16', '222', '222', '1', '222', '1');
INSERT INTO sys_group VALUES ('17', '11', '111', '1', '', '1');

-- ----------------------------
-- Table structure for `sys_type`
-- ----------------------------
DROP TABLE IF EXISTS `sys_type`;
CREATE TABLE `sys_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '选项id',
  `type_name` varchar(50) NOT NULL COMMENT '选项名称',
  `group_id` int(11) NOT NULL COMMENT '分组id',
  `sort_index` int(11) NOT NULL COMMENT '排序',
  `help_text` varchar(200) DEFAULT NULL COMMENT '辅助字段',
  `is_default` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否默认值',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '有效状态',
  PRIMARY KEY (`type_id`) USING BTREE,
  KEY `group_id` (`group_id`) USING BTREE,
  CONSTRAINT `sys_type_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `sys_group` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='基础选项';

-- ----------------------------
-- Records of sys_type
-- ----------------------------
INSERT INTO sys_type VALUES ('100', '抖音', '10', '1', '', '1', '', '1');
INSERT INTO sys_type VALUES ('101', '快手', '10', '2', null, '1', null, '1');
INSERT INTO sys_type VALUES ('102', '化妆品', '11', '1', null, '1', null, '1');
INSERT INTO sys_type VALUES ('103', '减肥瘦身', '11', '2', null, '1', null, '1');
INSERT INTO sys_type VALUES ('104', '通用', '12', '1', null, '1', null, '1');
INSERT INTO sys_type VALUES ('105', '评论', '12', '2', null, '1', null, '1');
INSERT INTO sys_type VALUES ('106', '回复', '12', '3', null, '1', null, '1');
INSERT INTO sys_type VALUES ('107', '私信', '12', '4', null, '1', null, '1');
INSERT INTO sys_type VALUES ('108', '不限', '13', '1', null, '1', null, '1');
INSERT INTO sys_type VALUES ('109', '男', '13', '2', null, '1', null, '1');
INSERT INTO sys_type VALUES ('110', '女', '13', '3', null, '1', null, '1');
INSERT INTO sys_type VALUES ('111', '粉丝列表', '14', '1', null, '1', null, '1');
INSERT INTO sys_type VALUES ('112', '评论区', '14', '2', null, '1', null, '1');
INSERT INTO sys_type VALUES ('113', '抖音', '15', '1', null, '1', null, '1');
INSERT INTO sys_type VALUES ('114', '快手', '15', '2', null, '1', null, '1');
INSERT INTO sys_type VALUES ('117', '今日头条', '15', '3', null, '1', null, '1');
INSERT INTO sys_type VALUES ('118', '微博', '15', '4', null, '1', null, '1');
INSERT INTO sys_type VALUES ('119', '360分身大师', '15', '5', null, '1', null, '1');
INSERT INTO sys_type VALUES ('120', '22', '10', '3', '', '1', '', '1');

-- ----------------------------
-- Table structure for `sys_user`
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(20) NOT NULL COMMENT '姓名',
  `user_code` varchar(20) NOT NULL COMMENT '账号',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `token` varchar(50) NOT NULL COMMENT '令牌',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `login_date` timestamp NULL DEFAULT NULL COMMENT '最近登录时间',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '有效状态',
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1018 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员';

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO sys_user VALUES ('1000', '王晓辉', 'wangxh', 'e10adc3949ba59abbe56e057f20f883e', '3619D93C-64D9-4B94-BDAB-E30321750A98', '2019-11-04 10:18:54', '2019-11-11 17:23:34', null, '1');
INSERT INTO sys_user VALUES ('1017', '仲爽', 'zhongs', 'e10adc3949ba59abbe56e057f20f883e', '80ca3300-5371-f667-b2e7-4646110cd001', '2019-11-11 15:55:34', '2019-12-30 23:01:18', '', '1');

-- ----------------------------
-- Table structure for `z_comment_`
-- ----------------------------
DROP TABLE IF EXISTS `z_comment_`;
CREATE TABLE `z_comment_` (
  `comment_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '记录id',
  `account_id` int(11) NOT NULL COMMENT '账号id',
  `task_id` int(11) NOT NULL COMMENT '任务id',
  `task_plot_id` int(11) NOT NULL COMMENT '文案id',
  `video_id` varchar(100) NOT NULL COMMENT '第三方平台的视频id',
  `video_text` varchar(255) DEFAULT NULL COMMENT '视频配文',
  `praises` int(11) DEFAULT NULL COMMENT '获赞',
  `comments` int(11) DEFAULT '0' COMMENT '评论',
  `trans` int(11) DEFAULT '0' COMMENT '转发',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`comment_id`) USING BTREE,
  KEY `account_id` (`account_id`),
  KEY `task_id` (`task_id`),
  KEY `task_plot_id` (`task_plot_id`),
  CONSTRAINT `z_comment__ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `bus_account` (`account_id`),
  CONSTRAINT `z_comment__ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `bus_task` (`task_id`),
  CONSTRAINT `z_comment__ibfk_3` FOREIGN KEY (`task_plot_id`) REFERENCES `bus_task_plot` (`task_plot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论记录';

-- ----------------------------
-- Records of z_comment_
-- ----------------------------

-- ----------------------------
-- Table structure for `z_follow_`
-- ----------------------------
DROP TABLE IF EXISTS `z_follow_`;
CREATE TABLE `z_follow_` (
  `follow_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '记录id',
  `account_id` int(11) NOT NULL COMMENT '账号id',
  `task_id` int(11) NOT NULL COMMENT '任务id',
  `is_success` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否发送成功',
  `third_party_id` varchar(100) NOT NULL COMMENT '第三方平台的用户id',
  `nickname` varchar(100) NOT NULL COMMENT '昵称',
  `describe` varchar(500) DEFAULT NULL COMMENT '描述',
  `age` int(11) DEFAULT NULL COMMENT '年龄',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `praises` int(11) DEFAULT NULL COMMENT '获赞',
  `follows` int(11) DEFAULT '0' COMMENT '关注',
  `fans` int(11) DEFAULT '0' COMMENT '粉丝',
  `works` int(11) DEFAULT NULL COMMENT '作品',
  `trends` int(11) DEFAULT NULL COMMENT '动态',
  `likes` int(11) DEFAULT NULL COMMENT '喜欢',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`follow_id`),
  KEY `account_id` (`account_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `z_follow__ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `bus_account` (`account_id`),
  CONSTRAINT `z_follow__ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `bus_task` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='加粉记录';

-- ----------------------------
-- Records of z_follow_
-- ----------------------------

-- ----------------------------
-- Table structure for `z_letter_`
-- ----------------------------
DROP TABLE IF EXISTS `z_letter_`;
CREATE TABLE `z_letter_` (
  `letter_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '记录id',
  `account_id` int(11) NOT NULL COMMENT '账号id',
  `task_id` int(11) NOT NULL COMMENT '任务id',
  `task_plot_id` int(11) NOT NULL COMMENT '文案id',
  `task_wechat_id` int(11) NOT NULL COMMENT '微信id',
  `letter_way_id` int(11) NOT NULL COMMENT '私信方式id',
  `is_success` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否发送成功',
  `third_party_id` varchar(100) NOT NULL COMMENT '第三方平台的用户id',
  `nickname` varchar(100) NOT NULL COMMENT '昵称',
  `describe` varchar(500) DEFAULT NULL COMMENT '描述',
  `age` int(11) DEFAULT NULL COMMENT '年龄',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `praises` int(11) DEFAULT '0' COMMENT '获赞',
  `follows` int(11) DEFAULT '0' COMMENT '关注',
  `fans` int(11) DEFAULT '0' COMMENT '粉丝',
  `works` int(11) DEFAULT '0' COMMENT '作品',
  `trends` int(11) DEFAULT '0' COMMENT '动态',
  `likes` int(11) DEFAULT '0' COMMENT '喜欢',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`letter_id`) USING BTREE,
  KEY `account_id` (`account_id`) USING BTREE,
  KEY `task_plot_id` (`task_plot_id`) USING BTREE,
  KEY `task_wechat_id` (`task_wechat_id`) USING BTREE,
  KEY `letter_way_id` (`letter_way_id`),
  CONSTRAINT `z_letter__ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `bus_account` (`account_id`),
  CONSTRAINT `z_letter__ibfk_2` FOREIGN KEY (`task_plot_id`) REFERENCES `bus_task_plot` (`task_plot_id`),
  CONSTRAINT `z_letter__ibfk_3` FOREIGN KEY (`task_wechat_id`) REFERENCES `bus_task_wechat` (`task_wechat_id`),
  CONSTRAINT `z_letter__ibfk_4` FOREIGN KEY (`letter_way_id`) REFERENCES `sys_type` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='私信记录';

-- ----------------------------
-- Records of z_letter_
-- ----------------------------

-- ----------------------------
-- Table structure for `z_letter_ke820198`
-- ----------------------------
DROP TABLE IF EXISTS `z_letter_ke820198`;
CREATE TABLE `z_letter_ke820198` (
  `letter_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '记录id',
  `account_id` int(11) NOT NULL COMMENT '账号id',
  `task_id` int(11) NOT NULL COMMENT '任务id',
  `task_plot_id` int(11) NOT NULL COMMENT '文案id',
  `task_wechat_id` int(11) NOT NULL COMMENT '微信id',
  `letter_way_id` int(11) NOT NULL COMMENT '私信方式id',
  `is_success` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否发送成功',
  `third_party_id` varchar(100) NOT NULL COMMENT '第三方平台的用户id',
  `nickname` varchar(100) NOT NULL COMMENT '昵称',
  `describe` varchar(500) DEFAULT NULL COMMENT '描述',
  `age` int(11) DEFAULT NULL COMMENT '年龄',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `praises` int(11) DEFAULT '0' COMMENT '获赞',
  `follows` int(11) DEFAULT '0' COMMENT '关注',
  `fans` int(11) DEFAULT '0' COMMENT '粉丝',
  `works` int(11) DEFAULT '0' COMMENT '作品',
  `trends` int(11) DEFAULT '0' COMMENT '动态',
  `likes` int(11) DEFAULT '0' COMMENT '喜欢',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`letter_id`) USING BTREE,
  KEY `account_id` (`account_id`) USING BTREE,
  KEY `task_plot_id` (`task_plot_id`) USING BTREE,
  KEY `task_wechat_id` (`task_wechat_id`) USING BTREE,
  KEY `letter_way_id` (`letter_way_id`),
  CONSTRAINT `z_letter_ke820198_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `bus_account` (`account_id`),
  CONSTRAINT `z_letter_ke820198_ibfk_2` FOREIGN KEY (`task_plot_id`) REFERENCES `bus_task_plot` (`task_plot_id`),
  CONSTRAINT `z_letter_ke820198_ibfk_3` FOREIGN KEY (`task_wechat_id`) REFERENCES `bus_task_wechat` (`task_wechat_id`),
  CONSTRAINT `z_letter_ke820198_ibfk_4` FOREIGN KEY (`letter_way_id`) REFERENCES `sys_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='私信记录';

-- ----------------------------
-- Records of z_letter_ke820198
-- ----------------------------
INSERT INTO z_letter_ke820198 VALUES ('1', '65', '2', '1', '1', '111', '1', 'dysldg027bvb', '看我七十二变', null, null, null, '11', '12', '1', '1', '11', '106', '2019-11-20 10:00:54');
INSERT INTO z_letter_ke820198 VALUES ('2', '65', '2', '1', '1', '111', '1', '1874139346', '甩甩逆袭日记', null, null, null, '779', '107', '374', '16', '16', '172', '2019-11-20 10:01:28');
INSERT INTO z_letter_ke820198 VALUES ('3', '65', '2', '1', '1', '111', '1', 'dyvaujfxuud5', '用户6064587247005', null, null, null, '0', '3', '1', '0', '0', '6', '2019-11-20 10:02:05');
INSERT INTO z_letter_ke820198 VALUES ('4', '65', '2', '1', '1', '111', '1', '922092303', 'bostan', null, null, null, '0', '258', '12', '0', '0', '993', '2019-11-20 10:02:46');
INSERT INTO z_letter_ke820198 VALUES ('5', '65', '2', '1', '1', '111', '1', '172904968', 'Benny .⚜️', null, null, null, '18', '312', '37', '3', '3', '626', '2019-11-20 10:03:25');
INSERT INTO z_letter_ke820198 VALUES ('6', '65', '2', '1', '1', '111', '1', 'HGG7758258', '小肉肉', null, null, null, '1293', '505', '135', '630', '637', '5347', '2019-11-20 10:04:00');
INSERT INTO z_letter_ke820198 VALUES ('7', '65', '2', '1', '1', '111', '1', '139213366', '한때 일찍이', null, null, null, '0', '240', '6', '0', '0', '145', '2019-11-20 10:04:38');
INSERT INTO z_letter_ke820198 VALUES ('8', '65', '2', '1', '1', '111', '1', '19900309v587', '珊珊小可爱', null, null, null, '82', '812', '254', '18', '18', '5936', '2019-11-20 10:05:12');
INSERT INTO z_letter_ke820198 VALUES ('9', '63', '2', '1', '1', '111', '1', 'dyh014hqttog', '用户1405313179490', null, null, null, '0', '28', '0', '0', '0', '5', '2019-11-20 11:01:02');
INSERT INTO z_letter_ke820198 VALUES ('10', '63', '2', '1', '1', '111', '1', '68470910', 'Agr', null, null, null, '7', '564', '22', '0', '0', '0', '2019-11-20 11:01:35');
INSERT INTO z_letter_ke820198 VALUES ('11', '63', '2', '1', '1', '111', '1', '818320.', '', null, null, null, '17', '114', '260', '0', '0', '3348', '2019-11-20 11:02:09');
INSERT INTO z_letter_ke820198 VALUES ('12', '63', '2', '1', '1', '111', '1', 'dys6j3qcvptt', '用户9603962650550', null, null, null, '0', '9', '1', '0', '0', '389', '2019-11-20 11:02:45');
INSERT INTO z_letter_ke820198 VALUES ('13', '63', '2', '1', '1', '111', '1', '213135604', 'Meteor', null, null, null, '0', '122', '25', '0', '0', '1185', '2019-11-20 11:03:22');
INSERT INTO z_letter_ke820198 VALUES ('14', '63', '2', '1', '1', '111', '1', '339442172', '要瘦啊', null, null, null, '40', '215', '38', '0', '0', '0', '2019-11-20 11:04:04');
INSERT INTO z_letter_ke820198 VALUES ('15', '63', '2', '1', '1', '111', '1', 'dy4hz1nzgq8d', '初晴', null, null, null, '3', '22', '15', '1', '1', '1230', '2019-11-20 11:04:47');
INSERT INTO z_letter_ke820198 VALUES ('16', '63', '2', '1', '1', '111', '1', 'dykw4hjks7hx', 'Ruui', null, null, null, '0', '24', '1', '0', '0', '76', '2019-11-20 11:05:29');
INSERT INTO z_letter_ke820198 VALUES ('17', '63', '2', '1', '1', '111', '1', '96039243', 'G  f', null, null, null, '123', '79', '88', '19', '19', '4360', '2019-11-20 11:06:14');
INSERT INTO z_letter_ke820198 VALUES ('18', '63', '2', '1', '1', '111', '1', 'dyv6vr6sswat', '书单', null, null, null, '10000', '55', '788', '5', '7', '754', '2019-11-20 11:07:36');
INSERT INTO z_letter_ke820198 VALUES ('19', '63', '2', '1', '1', '111', '1', '97781514', '不吃鱼的猫', null, null, null, '0', '84', '15', '0', '0', '2465', '2019-11-20 11:08:12');
INSERT INTO z_letter_ke820198 VALUES ('20', '63', '2', '1', '1', '111', '1', '2179178359', '哪里看见过你', null, null, null, '2263', '2479', '1954', '75', '76', '480', '2019-11-20 11:08:46');
INSERT INTO z_letter_ke820198 VALUES ('21', '63', '2', '1', '1', '111', '1', '837469668', '李玉', null, null, null, '452', '47', '44', '123', '169', '1433', '2019-11-20 11:09:27');
INSERT INTO z_letter_ke820198 VALUES ('22', '63', '2', '1', '1', '111', '1', 'kfj458830681', '萌 ', null, null, null, '219', '317', '47', '62', '84', '719', '2019-11-20 11:10:08');
INSERT INTO z_letter_ke820198 VALUES ('23', '63', '2', '1', '1', '111', '1', '189479082', '-', null, null, null, '0', '206', '13', '0', '0', '1171', '2019-11-20 11:10:48');
INSERT INTO z_letter_ke820198 VALUES ('24', '63', '2', '1', '1', '111', '1', 'nana21599', '❤MH Seng Nan️云南小姐姐❤️', null, null, null, '439', '736', '163', '20', '20', '2168', '2019-11-20 11:11:24');
INSERT INTO z_letter_ke820198 VALUES ('25', '63', '2', '1', '1', '111', '0', '200520049', '逆光 ', null, null, null, '1', '177', '20', '2', '2', '992', '2019-11-20 11:11:59');
INSERT INTO z_letter_ke820198 VALUES ('26', '63', '2', '1', '1', '111', '1', '135471710', 'beginning。', null, null, null, '2', '117', '26', '1', '2', '3434', '2019-11-20 11:12:40');
INSERT INTO z_letter_ke820198 VALUES ('27', '63', '2', '1', '1', '111', '1', 'Lan520888.', '兰兰吖', null, null, null, '313', '94', '120', '33', '33', '3513', '2019-11-20 11:13:19');
INSERT INTO z_letter_ke820198 VALUES ('28', '63', '2', '1', '1', '111', '1', '10834646', 'GW杰', null, null, null, '0', '82', '28', '0', '0', '160', '2019-11-20 11:13:55');
INSERT INTO z_letter_ke820198 VALUES ('29', '63', '2', '1', '1', '111', '1', 'dykulve5gba7', '用户5148263166163', null, null, null, '0', '39', '1', '0', '0', '169', '2019-11-20 11:14:38');
INSERT INTO z_letter_ke820198 VALUES ('30', '63', '2', '1', '1', '111', '1', 'Fanfan1881046', 'MissCake', null, null, null, '37', '25', '9', '20', '21', '92', '2019-11-20 11:15:16');
INSERT INTO z_letter_ke820198 VALUES ('31', '63', '2', '1', '1', '111', '1', 'YangKeE', 'K·', null, null, null, '93', '61', '56', '15', '17', '269', '2019-11-20 11:15:50');
INSERT INTO z_letter_ke820198 VALUES ('32', '63', '2', '1', '1', '111', '1', 'dyrs3downmnu', '柠小檬', null, null, null, '0', '11', '4', '0', '0', '3', '2019-11-20 11:16:28');
INSERT INTO z_letter_ke820198 VALUES ('33', '63', '2', '1', '1', '111', '1', '4419578', '吻痕迹', null, null, null, '0', '5000', '282', '0', '0', '0', '2019-11-20 11:17:11');
INSERT INTO z_letter_ke820198 VALUES ('34', '63', '2', '1', '1', '111', '1', 'dycln7aqdcrc', '用户6419958059456', null, null, null, '26', '90', '9', '19', '19', '1069', '2019-11-20 11:17:43');
INSERT INTO z_letter_ke820198 VALUES ('35', '63', '2', '1', '1', '111', '1', 'dy0snczswr2u', '用户5485879587902', null, null, null, '0', '58', '3', '0', '0', '62', '2019-11-20 11:18:19');
INSERT INTO z_letter_ke820198 VALUES ('36', '63', '2', '1', '1', '111', '1', 'dyg8ijh36khq', '用户5083627149614', null, null, null, '0', '61', '2', '0', '0', '0', '2019-11-20 11:18:55');
INSERT INTO z_letter_ke820198 VALUES ('37', '63', '2', '1', '1', '111', '1', 'dy71kamll9dp', '用户4220201588994', null, null, null, '0', '6', '1', '0', '0', '6', '2019-11-20 11:19:36');
INSERT INTO z_letter_ke820198 VALUES ('38', '63', '2', '1', '1', '111', '1', '1711230627', '小❤️❤️', null, null, null, '2', '5', '4', '0', '0', '0', '2019-11-20 11:20:12');
INSERT INTO z_letter_ke820198 VALUES ('39', '63', '2', '1', '1', '111', '1', 'shx19970325', '一品江南藜麦营养粥', null, null, null, '38', '124', '29', '15', '17', '563', '2019-11-20 11:20:52');
INSERT INTO z_letter_ke820198 VALUES ('40', '63', '2', '1', '1', '111', '1', 'dy15117hhhdh', '用户8752457552343', null, null, null, '0', '8', '0', '0', '0', '24', '2019-11-20 11:21:33');
INSERT INTO z_letter_ke820198 VALUES ('41', '63', '2', '1', '1', '111', '1', '76457996', '♚℡Dreams°凉兮', null, null, null, '278', '185', '154', '45', '45', '247', '2019-11-20 11:22:18');
INSERT INTO z_letter_ke820198 VALUES ('42', '63', '2', '1', '1', '111', '1', 'dy7qz60tbo7r', '艳子姐姐', null, null, null, '83', '198', '24', '13', '13', '56', '2019-11-20 11:22:57');
INSERT INTO z_letter_ke820198 VALUES ('43', '63', '2', '1', '1', '111', '1', '7982351', 'Lulu', null, null, null, '1092', '165', '106', '102', '112', '1100', '2019-11-20 11:23:32');
INSERT INTO z_letter_ke820198 VALUES ('44', '63', '2', '1', '1', '111', '1', 'dy4vyhwk52z6', '精致的小仙女', null, null, null, '249', '1107', '130', '3', '10', '1472', '2019-11-20 11:24:13');
INSERT INTO z_letter_ke820198 VALUES ('45', '63', '2', '1', '1', '111', '1', 'chatyf969369052', '哦', null, null, null, '15', '4', '2', '3', '3', '87', '2019-11-20 11:24:56');
INSERT INTO z_letter_ke820198 VALUES ('46', '63', '2', '1', '1', '111', '1', '200116016', '小明同学', null, null, null, '7', '427', '23', '2', '2', '841', '2019-11-20 11:25:36');
INSERT INTO z_letter_ke820198 VALUES ('47', '63', '2', '1', '1', '111', '1', 'JW19940902', 'A酒窝baby', null, null, null, '0', '53', '2', '0', '0', '0', '2019-11-20 11:26:15');
INSERT INTO z_letter_ke820198 VALUES ('48', '63', '2', '1', '1', '111', '1', 'dyalvxqn1zcz', '用户4841865835333', null, null, null, '0', '28', '1', '0', '0', '30', '2019-11-20 11:26:51');
INSERT INTO z_letter_ke820198 VALUES ('49', '63', '2', '1', '1', '111', '1', 'dy4zdr5mpahb', '用户9267374036795', null, null, null, '0', '60', '3', '0', '0', '56', '2019-11-20 11:27:37');
INSERT INTO z_letter_ke820198 VALUES ('50', '63', '2', '1', '1', '111', '1', 'dy295j1c6619', '莉姐逆袭记✌', null, null, null, '6', '35', '4', '1', '1', '81', '2019-11-20 11:28:17');
INSERT INTO z_letter_ke820198 VALUES ('51', '63', '2', '1', '1', '111', '1', '368200824', '柠檬味的小可爱', null, null, null, '54', '121', '32', '10', '10', '405', '2019-11-20 11:28:50');
INSERT INTO z_letter_ke820198 VALUES ('52', '63', '2', '1', '1', '111', '0', '22212556', 'Alice彡蘑菇不开花', null, null, null, '2608', '243', '222', '219', '224', '0', '2019-11-20 11:29:22');
INSERT INTO z_letter_ke820198 VALUES ('53', '65', '2', '1', '1', '111', '1', 'dy9ge2tk1lue', '肽美养生馆', null, null, null, '0', '35', '2', '0', '0', '5', '2019-11-20 11:49:56');
INSERT INTO z_letter_ke820198 VALUES ('54', '65', '2', '1', '1', '111', '1', '1134033165', '农村小暖男 。', null, null, null, '18', '406', '104', '3', '3', '13904', '2019-11-20 14:34:57');
INSERT INTO z_letter_ke820198 VALUES ('55', '65', '2', '1', '3', '111', '1', '856366254', '', null, null, null, '0', '24', '5', '0', '0', '4', '2019-11-20 14:35:39');
INSERT INTO z_letter_ke820198 VALUES ('56', '65', '2', '3', '1', '111', '1', '869352151', '宝儿', null, null, null, '0', '297', '42', '0', '0', '275', '2019-11-20 14:36:16');
INSERT INTO z_letter_ke820198 VALUES ('57', '65', '2', '1', '1', '111', '1', 'dycxgl7dxotj', '用户4678367021670', null, null, null, '12', '147', '12', '0', '0', '10', '2019-11-20 14:36:59');
INSERT INTO z_letter_ke820198 VALUES ('58', '65', '2', '1', '1', '111', '1', 'dyzg2l920iap', '仔仔growth', null, null, null, '2', '20', '1', '2', '2', '93', '2019-11-20 14:37:37');
INSERT INTO z_letter_ke820198 VALUES ('59', '65', '2', '3', '1', '111', '0', 'dyiq1nhggktt', '初夏の雨 ^_^', null, null, null, '37', '30', '68', '18', '18', '827', '2019-11-20 14:38:05');
INSERT INTO z_letter_ke820198 VALUES ('60', '65', '2', '1', '3', '111', '1', '131739079', '减肥达人雯雯', null, null, null, '97', '127', '36', '15', '16', '275', '2019-11-20 14:38:43');
INSERT INTO z_letter_ke820198 VALUES ('61', '65', '2', '1', '3', '111', '1', '28449373', '仙女很优秀❗️❗️❗️', null, null, null, '198', '42', '135', '9', '11', '0', '2019-11-20 14:39:24');
INSERT INTO z_letter_ke820198 VALUES ('62', '65', '2', '1', '3', '111', '1', 'dydkal6eqfbi', '柠檬', null, null, null, '114', '209', '9', '8', '8', '614', '2019-11-20 14:40:06');
INSERT INTO z_letter_ke820198 VALUES ('63', '65', '2', '3', '1', '111', '1', '774263061', '陪伴是最长情的告白。', null, null, null, '29', '382', '35', '3', '4', '1958', '2019-11-20 14:40:48');
INSERT INTO z_letter_ke820198 VALUES ('64', '65', '2', '1', '3', '111', '1', '277321200', '苗洋', null, null, null, '393', '226', '79', '77', '79', '547', '2019-11-20 14:41:25');
INSERT INTO z_letter_ke820198 VALUES ('65', '65', '2', '3', '3', '111', '1', 'dyov9cyejold', 'hope8886', null, null, null, '0', '1', '1', '0', '0', '1', '2019-11-20 14:42:00');
INSERT INTO z_letter_ke820198 VALUES ('66', '65', '2', '1', '3', '111', '1', 'V277818107', '谦伴浮生…', null, null, null, '28', '150', '32', '15', '15', '141', '2019-11-20 14:42:36');
INSERT INTO z_letter_ke820198 VALUES ('67', '65', '2', '3', '3', '111', '1', 'D20030903', '墊脚♡', null, null, null, '6', '6', '2', '3', '3', '0', '2019-11-20 14:43:17');
INSERT INTO z_letter_ke820198 VALUES ('68', '65', '2', '1', '3', '111', '1', 'Q9806270', '小乔减肥', null, null, null, '0', '44', '7', '0', '4', '94', '2019-11-20 14:43:51');
INSERT INTO z_letter_ke820198 VALUES ('69', '65', '2', '1', '1', '111', '1', 'MMS88660', '默沫瘦', null, null, null, '0', '37', '34', '0', '0', '47', '2019-11-20 14:44:31');
INSERT INTO z_letter_ke820198 VALUES ('70', '65', '2', '3', '3', '111', '1', '1902324110', '吃了苦中苦才能开路虎', null, null, null, '31', '708', '26', '3', '3', '6729', '2019-11-20 14:45:27');
INSERT INTO z_letter_ke820198 VALUES ('71', '65', '2', '1', '3', '111', '1', 'dykxa2uqtzhm', '宝宝368', null, null, null, '2', '51', '5', '0', '43', '133', '2019-11-20 14:46:09');
INSERT INTO z_letter_ke820198 VALUES ('72', '65', '2', '3', '1', '111', '1', 'dyi9o9mk87uk', '三少奶奶', null, null, null, '2', '19', '2', '1', '2', '6', '2019-11-20 14:46:48');
INSERT INTO z_letter_ke820198 VALUES ('73', '65', '2', '3', '3', '111', '1', 'dyn8z8zd6n4k', '桃瘦瘦', null, null, null, '0', '53', '3', '0', '0', '77', '2019-11-20 14:47:31');
INSERT INTO z_letter_ke820198 VALUES ('74', '65', '2', '1', '1', '111', '1', 'tm3179', '偷月亮的猫', null, null, null, '0', '49', '1', '0', '0', '0', '2019-11-20 14:48:11');
INSERT INTO z_letter_ke820198 VALUES ('75', '65', '2', '3', '1', '111', '1', 'dh3971', '蛋黄酥', null, null, null, '0', '40', '2', '0', '0', '0', '2019-11-20 14:48:53');
INSERT INTO z_letter_ke820198 VALUES ('76', '65', '2', '3', '1', '111', '1', 'mh2731', '麻花姐', null, null, null, '0', '34', '2', '0', '0', '0', '2019-11-20 14:49:42');
INSERT INTO z_letter_ke820198 VALUES ('77', '65', '2', '3', '3', '111', '1', 'da7709', '欣欣', null, null, null, '7', '93', '15', '0', '83', '601', '2019-11-20 14:50:24');
INSERT INTO z_letter_ke820198 VALUES ('78', '65', '2', '1', '1', '111', '1', 'da8713', '小甜心', null, null, null, '1', '98', '12', '0', '69', '608', '2019-11-20 14:51:04');
INSERT INTO z_letter_ke820198 VALUES ('79', '65', '2', '3', '3', '111', '1', 'zx2115', '小芬芬', null, null, null, '5', '122', '42', '0', '89', '581', '2019-11-20 14:51:39');
INSERT INTO z_letter_ke820198 VALUES ('80', '65', '2', '1', '3', '111', '1', 'zx2497', '小芬儿', null, null, null, '10', '96', '34', '0', '94', '681', '2019-11-20 14:52:15');
INSERT INTO z_letter_ke820198 VALUES ('81', '65', '2', '1', '1', '111', '1', 'zx8469', '嘉佳', null, null, null, '3', '105', '31', '0', '84', '553', '2019-11-20 14:52:53');
INSERT INTO z_letter_ke820198 VALUES ('82', '65', '2', '3', '3', '111', '1', 'zx1273', '月月', null, null, null, '4', '98', '36', '0', '78', '667', '2019-11-20 14:53:33');
INSERT INTO z_letter_ke820198 VALUES ('83', '65', '2', '1', '3', '111', '1', 'da3596', '芯芯', null, null, null, '3', '97', '15', '0', '72', '620', '2019-11-20 14:54:18');
INSERT INTO z_letter_ke820198 VALUES ('84', '65', '2', '3', '3', '111', '1', 'da2407', '芳芳', null, null, null, '3', '96', '11', '0', '78', '617', '2019-11-20 14:55:06');
INSERT INTO z_letter_ke820198 VALUES ('85', '65', '2', '3', '1', '111', '1', 'da4970', '伊人', null, null, null, '4', '100', '14', '0', '72', '613', '2019-11-20 14:55:47');
INSERT INTO z_letter_ke820198 VALUES ('86', '65', '2', '3', '1', '111', '1', 'da3587', '小馨', null, null, null, '3', '95', '11', '0', '74', '623', '2019-11-20 14:56:26');
INSERT INTO z_letter_ke820198 VALUES ('87', '65', '2', '3', '3', '111', '1', 'da4357', '柳温暖', null, null, null, '0', '93', '27', '0', '66', '484', '2019-11-20 14:57:04');
INSERT INTO z_letter_ke820198 VALUES ('88', '65', '2', '1', '3', '111', '1', 'da6720', '小怡', null, null, null, '9', '99', '17', '0', '81', '637', '2019-11-20 14:57:42');
INSERT INTO z_letter_ke820198 VALUES ('89', '65', '2', '1', '1', '111', '1', 'da8212', '小甜甜', null, null, null, '0', '105', '16', '0', '79', '623', '2019-11-20 14:58:23');
INSERT INTO z_letter_ke820198 VALUES ('90', '65', '2', '3', '1', '111', '1', 'da3752', '小包子', null, null, null, '4', '98', '17', '0', '77', '629', '2019-11-20 14:59:03');
INSERT INTO z_letter_ke820198 VALUES ('91', '65', '2', '3', '3', '111', '1', 'da2431', '怡怡', null, null, null, '7', '101', '15', '0', '72', '590', '2019-11-20 14:59:43');
INSERT INTO z_letter_ke820198 VALUES ('92', '65', '2', '3', '1', '111', '1', 'dyzrloa7bp3j', '小二', null, null, null, '3', '244', '4', '1', '1', '256', '2019-11-20 15:00:35');
INSERT INTO z_letter_ke820198 VALUES ('93', '65', '2', '1', '1', '111', '1', 'dyr4ttpu4dgr', '用户9919755564727', null, null, null, '0', '115', '16', '0', '0', '100', '2019-11-20 15:01:18');
INSERT INTO z_letter_ke820198 VALUES ('94', '54', '2', '1', '3', '111', '1', '493656603hui', '慧无忧', null, null, null, '1052', '323', '147', '149', '150', '1474', '2019-11-20 15:21:16');
INSERT INTO z_letter_ke820198 VALUES ('95', '54', '2', '3', '1', '111', '1', 'dyrwao1v4oap1', '宇', null, null, null, '24', '82', '0', '7', '9', '140', '2019-11-20 15:21:58');
