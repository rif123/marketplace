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

 Date: 07/20/2017 00:40:35 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `dk_wishlist`
-- ----------------------------
DROP TABLE IF EXISTS `dk_wishlist`;
CREATE TABLE `dk_wishlist` (
  `id_whislist` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_prod` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_whislist`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `dk_wishlist`
-- ----------------------------
BEGIN;
INSERT INTO `dk_wishlist` VALUES ('1', '1', '1', '2017-07-20 00:40:23', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
