/*
 Navicat Premium Data Transfer

 Source Server         : pay
 Source Server Type    : MySQL
 Source Server Version : 50645
 Source Host           : 120.76.245.239
 Source Database       : pay

 Target Server Type    : MySQL
 Target Server Version : 50645
 File Encoding         : utf-8

 Date: 05/31/2020 15:47:34 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `f2f_order`
-- ----------------------------
DROP TABLE IF EXISTS `f2f_order`;
CREATE TABLE `f2f_order` (
  `id` int(50) NOT NULL AUTO_INCREMENT COMMENT '自增ID主键',
  `order_no` varchar(255) NOT NULL  COMMENT '订单ID',
  `mark` varchar(50) NOT NULL COMMENT '备注',
  `mount` decimal(10,2) NOT NULL COMMENT '订单金额',
  `notify_time` datetime NOT NULL COMMENT '订单验证时间',
  `trade_no` varchar(30) NOT NULL COMMENT '支付宝订单号',
  `buyer_logon_id` varchar(30) NOT NULL COMMENT '付款账号',
  `status` tinyint(10) NOT NULL COMMENT '订单状态',
  `created_at` datetime NOT NULL  COMMENT '订单创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=488 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
