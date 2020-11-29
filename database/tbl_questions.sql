/*
Navicat MySQL Data Transfer

Source Server         : Sedoc
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : form_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-11-29 19:57:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_questions`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_questions`;
CREATE TABLE `tbl_questions` (
  `ques_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ques_name` varchar(255) DEFAULT NULL,
  `ques_body` varchar(255) DEFAULT NULL,
  `ques_skills` varchar(255) DEFAULT NULL,
  `get_user_id` int(11) DEFAULT NULL,
  `ques_created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ques_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_questions
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_users`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_name` varchar(20) DEFAULT NULL,
  `l_name` varchar(20) DEFAULT NULL,
  `b_day` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
