SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Database structure for create database
-- ----------------------------

DROP DATABASE IF EXISTS `api_test`;
CREATE DATABASE `api_test`;

USE `api_test`;
-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `internal_code` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES (11, 'RRHH_0001', 'Personal', 'Administra el personal de su empresa');
INSERT INTO `modules` VALUES (12, 'HHRR', 'Modulo de marcacion', 'The best pillow for amazing programmers.');
INSERT INTO `modules` VALUES (13, 'HHRR_003', 'Modulo de Personas', 'The new Module');
INSERT INTO `modules` VALUES (15, 'HHRR_003', 'Modulo de Personas', 'The new Module 1');

-- ----------------------------
-- Records of users
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
