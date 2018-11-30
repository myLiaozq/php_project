/*
Navicat MySQL Data Transfer

Source Server         : lzq009
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : shoppingcart

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-11-21 11:18:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `goods`
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodstypeid` int(11) NOT NULL COMMENT '商品类型id',
  `goodstypefid` int(11) NOT NULL COMMENT '商品类型父id',
  `goodstypefstr` varchar(33) NOT NULL COMMENT '商品类型所有fid以都好隔开的字符串',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `flag` varchar(33) NOT NULL,
  `marketprice` int(11) NOT NULL COMMENT '市场价',
  `salesprice` int(11) NOT NULL COMMENT '销售价',
  `housenum` int(11) NOT NULL COMMENT '数量',
  `content` varchar(255) NOT NULL COMMENT '详情介绍',
  `picurl` varchar(255) NOT NULL COMMENT '图片保存地址',
  `hits` int(11) NOT NULL COMMENT '点击次数',
  `orderid` int(11) NOT NULL COMMENT '排序用的字段',
  `checkinfo` smallint(1) NOT NULL COMMENT '检验是否合格',
  `delstate` smallint(1) NOT NULL COMMENT '有没有下架',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '2', '2', '0,2,', '华为手机', '', '1000', '800', '1', '华为P10Plus', './images/HUAHUI.jpg', '64', '1', '1', '0');
INSERT INTO `goods` VALUES ('2', '4', '3', '0,3,4,', '羽绒服', '', '1000', '888', '0', '纯鸭绒羽绒服', './images/yurong.jpg', '21', '2', '1', '0');
INSERT INTO `goods` VALUES ('3', '1', '1', '0,1,', '笔记本', '', '3800', '3666', '0', '联想thinkpad笔记本', './images/bijiben.jpg', '17', '3', '1', '0');
INSERT INTO `goods` VALUES ('4', '2', '2', '0,2,', 'iPhoneX', '', '1000', '800', '1', 'iPhoneX', './images/iphoneX.jpg', '29', '1', '1', '0');
INSERT INTO `goods` VALUES ('5', '2', '2', '0,2,', 'oppoR17', '', '1000', '800', '1', 'oppoR17', './images/oppoR17.jpg', '26', '1', '1', '0');
INSERT INTO `goods` VALUES ('6', '4', '3', '0,3,4,', '商务服', '', '1000', '888', '0', '商务服', './images/bussi.jpg', '11', '2', '1', '0');
INSERT INTO `goods` VALUES ('7', '1', '1', '0,1,', '联想笔记本', '', '3800', '3666', '0', '联想笔记本', './images/lenovo.jpg', '13', '3', '1', '0');
INSERT INTO `goods` VALUES ('8', '1', '1', '0,1,', '戴尔', '', '3800', '3666', '0', '戴尔笔记本', './images/dell.jpg', '11', '3', '1', '0');

-- ----------------------------
-- Table structure for `goodstype`
-- ----------------------------
DROP TABLE IF EXISTS `goodstype`;
CREATE TABLE `goodstype` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL COMMENT '父id',
  `classname` varchar(255) NOT NULL COMMENT '商品类型名称',
  `orderid` int(11) NOT NULL COMMENT '排序id',
  `checkinfo` int(11) NOT NULL COMMENT '是否检查过的，1为正常，0不正常',
  `fstr` varchar(33) NOT NULL COMMENT '所有父id以逗号隔开字符串',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goodstype
-- ----------------------------
INSERT INTO `goodstype` VALUES ('1', '1', '电脑', '1', '1', '0,');
INSERT INTO `goodstype` VALUES ('2', '2', '手机', '2', '1', '0,');
INSERT INTO `goodstype` VALUES ('3', '3', '衣服', '3', '0', '0,');
