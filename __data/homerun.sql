/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50153
Source Host           : localhost:3306
Source Database       : homerun

Target Server Type    : MYSQL
Target Server Version : 50153
File Encoding         : 65001

Date: 2011-08-07 11:37:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pricestories`
-- ----------------------------
DROP TABLE IF EXISTS `pricestories`;
CREATE TABLE `pricestories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` text,
  `order` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pricestories
-- ----------------------------
INSERT INTO `pricestories` VALUES ('1', 'Amy used one man to move 1 sofa, 2 chairs, 1 bed, 1 TV with cabinet and 3 boxes within Leicester City for &pound;30.', '1');
INSERT INTO `pricestories` VALUES ('2', 'John used 1 man to move 10 boxes and 30 black bags from Leicester to Leeds for &pound;125.', '2');
INSERT INTO `pricestories` VALUES ('3', 'Sanjay and Emma used 2 men to move 1 bed, 1 wardrobe, 1 fridge, 1 freezer, 1 washers, 1 sofa, 1 chest of draws, 1 bookcase, 1 TV and cabinet and 10 boxes within Leicester City for &pound60.', '3');
INSERT INTO `pricestories` VALUES ('4', ' Joan used 2 men to move a 3 piece suite within Leicester and paid &pound;30.', '4');
INSERT INTO `pricestories` VALUES ('5', 'Ian used 1 man to move 1 bed, 2 chairs, 1 fridge and 50 boxes from Loughborough to Aberdeen and paid &pound;580.', '5');
INSERT INTO `pricestories` VALUES ('6', 'Harvey used 1 man to move 1 sofa, 1 wardrobe, 1 bed, 1 fridgefreezer, 1 washing machine, 1 bike and 10 boxes from Leicester to Brighton and paid &pound;190.', '6');

-- ----------------------------
-- Table structure for `quoteitems`
-- ----------------------------
DROP TABLE IF EXISTS `quoteitems`;
CREATE TABLE `quoteitems` (
  `id` bigint(32) NOT NULL AUTO_INCREMENT,
  `email_label` varchar(30) DEFAULT NULL,
  `label` varchar(30) DEFAULT NULL,
  `body` text,
  `order` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of quoteitems
-- ----------------------------
INSERT INTO `quoteitems` VALUES ('1', 'Huge', 'HUGE\r\nhouse hold\r\nITEMS', 'Electric beds, larger wardrobes, american fridge freezers and larger sofas. (Items that would have to be tilted to fit through a door way)', '1');
INSERT INTO `quoteitems` VALUES ('2', 'Large', 'LARGE\r\nhouse hold\r\nITEMS', 'Standard wardrobes, fridge freezers,  tall cabinets, dining tables and sofa beds. (Items that would easily go through a door way)', '2');
INSERT INTO `quoteitems` VALUES ('3', 'Medium', 'MEDIUM\r\nhouse hold\r\nITEMS', 'Coffee tables, draws, washer, stand alone fridge, arm chairs. (Simular in size to a washing machine)', '3');
INSERT INTO `quoteitems` VALUES ('4', 'Small', 'SMALL\r\nhouse hold\r\nITEMS', 'Bedside tables, small draws and toy box. (Items that would fit on a tea crate)', '4');
INSERT INTO `quoteitems` VALUES ('5', 'Boxes', 'Boxes, Black bags and Cases', null, '5');
INSERT INTO `quoteitems` VALUES ('6', 'Unboxed', 'Unboxed stuff', 'Ironing board, pictures and mirrors etc.', '6');
