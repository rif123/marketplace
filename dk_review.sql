/*
 Navicat Premium Data Transfer

 Source Server         : LocalAppache
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : shop

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 07/20/2017 00:40:46 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `dk_review`
-- ----------------------------
DROP TABLE IF EXISTS `dk_review`;
CREATE TABLE `dk_review` (
  `id_review` int(11) NOT NULL AUTO_INCREMENT,
  `name_review` varchar(255) DEFAULT NULL,
  `email_review` varchar(100) DEFAULT NULL,
  `website_review` varchar(100) DEFAULT NULL,
  `comment_review` text,
  `id_product` int(11) DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id_review`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `dk_review`
-- ----------------------------
BEGIN;
INSERT INTO `dk_review` VALUES ('1', 'AKbar', 'akbar@gmail.com', 'www.facebook.com', 'INI barang nya bagus', '3', '1', '2017-07-20 00:25:04');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
