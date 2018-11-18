/*
Navicat MySQL Data Transfer

Source Server         : lzq
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : myblog

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-11-18 23:43:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) NOT NULL,
  `cid` int(10) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '文章标题',
  `keywords` varchar(255) NOT NULL COMMENT '文章关键字',
  `desc` varchar(255) NOT NULL,
  `pv` int(10) NOT NULL COMMENT '文章阅读量',
  `add_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_cid` (`cid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '1', 'PHP编程', '基础教学', '非常不错的教材', '1', '1');

-- ----------------------------
-- Table structure for `contents`
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` int(10) NOT NULL,
  `aid` int(10) NOT NULL,
  `contents` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contents
-- ----------------------------
