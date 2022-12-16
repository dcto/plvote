/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : plvote

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 16/12/2022 19:27:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for pl_ballots
-- ----------------------------
DROP TABLE IF EXISTS `pl_ballots`;
CREATE TABLE `pl_ballots` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL COMMENT '投票人ID',
  `election_id` int unsigned NOT NULL COMMENT '选举场ID',
  `candidate_id` int unsigned DEFAULT NULL COMMENT '候选人ID',
  `vote_ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '投票IP',
  `vote_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '投票时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ballots_election_id_user_id_unique` (`election_id`,`user_id`),
  KEY `ballots_user_id_index` (`user_id`),
  KEY `ballots_candidate_id_index` (`candidate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pl_ballots
-- ----------------------------
BEGIN;
INSERT INTO `pl_ballots` (`id`, `user_id`, `election_id`, `candidate_id`, `vote_ip`, `vote_time`) VALUES (4, 1, 1, 1, '127.0.0.1', '2022-12-16 15:14:20');
COMMIT;

-- ----------------------------
-- Table structure for pl_candidate
-- ----------------------------
DROP TABLE IF EXISTS `pl_candidate`;
CREATE TABLE `pl_candidate` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '候选人ID',
  `election_id` int unsigned NOT NULL DEFAULT '0' COMMENT '选举场次ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '候选人名称',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `candidate_election_id_index` (`election_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pl_candidate
-- ----------------------------
BEGIN;
INSERT INTO `pl_candidate` (`id`, `election_id`, `name`, `created_at`, `updated_at`) VALUES (1, 1, '陶先生', '2022-12-14 18:54:18', '2022-12-14 18:54:18');
INSERT INTO `pl_candidate` (`id`, `election_id`, `name`, `created_at`, `updated_at`) VALUES (3, 1, '叶先生', '2022-12-16 13:29:22', '2022-12-16 13:29:22');
COMMIT;

-- ----------------------------
-- Table structure for pl_election
-- ----------------------------
DROP TABLE IF EXISTS `pl_election`;
CREATE TABLE `pl_election` (
  `id` int unsigned NOT NULL COMMENT '选举场次ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '投票选举名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态: 1=投票开始; 0=投票停止',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `election_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pl_election
-- ----------------------------
BEGIN;
INSERT INTO `pl_election` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (1, '立法會選舉', 1, '2022-12-14 18:17:50', '2022-12-16 15:48:19');
INSERT INTO `pl_election` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (2, '鄉郊代表選舉', 1, '2022-12-14 18:17:55', NULL);
COMMIT;

-- ----------------------------
-- Table structure for pl_user
-- ----------------------------
DROP TABLE IF EXISTS `pl_user`;
CREATE TABLE `pl_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT '投票人ID',
  `hkid` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '香港身份证ID',
  `email` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Email',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登记时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pl_user
-- ----------------------------
BEGIN;
INSERT INTO `pl_user` (`id`, `hkid`, `email`, `created_at`, `updated_at`) VALUES (1, 'Z780608(7)', 'test@plvote.com', '2022-12-15 16:15:25', '2022-12-15 16:15:25');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
