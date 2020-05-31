/*
 Navicat Premium Data Transfer

 Source Server         : tools
 Source Server Type    : MySQL
 Source Server Version : 50645
 Source Host           : 120.76.245.239
 Source Database       : tools

 Target Server Type    : MySQL
 Target Server Version : 50645
 File Encoding         : utf-8

 Date: 05/31/2020 15:02:36 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `f2f_order`
-- ----------------------------
DROP TABLE IF EXISTS `f2f_order`;
CREATE TABLE `f2f_order` (
  `id` varchar(50) NOT NULL COMMENT '订单号',
  `mark` varchar(50) NOT NULL COMMENT '备注',
  `mount` varchar(20) NOT NULL COMMENT '订单金额',
  `notify_time` varchar(20) NOT NULL COMMENT '订单验证时间',
  `trade_no` varchar(30) NOT NULL COMMENT '支付宝订单号',
  `buyer_logon_id` varchar(30) NOT NULL COMMENT '付款账号',
  `status` varchar(10) NOT NULL COMMENT '订单状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
