/*
 Navicat Premium Data Transfer

 Source Server         : cert
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : leafseve_kaizen

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 22/04/2022 16:17:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for administrador
-- ----------------------------
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE `administrador`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nivel` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for clasificacion
-- ----------------------------
DROP TABLE IF EXISTS `clasificacion`;
CREATE TABLE `clasificacion`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for criterios
-- ----------------------------
DROP TABLE IF EXISTS `criterios`;
CREATE TABLE `criterios`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipo_respuesta` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for equipos
-- ----------------------------
DROP TABLE IF EXISTS `equipos`;
CREATE TABLE `equipos`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promotor` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipo` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for evaluacion
-- ----------------------------
DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE `evaluacion`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_idea` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_clasificacion` int(10) NOT NULL,
  `retroalimentacion` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int(10) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for evaluacion_criterios
-- ----------------------------
DROP TABLE IF EXISTS `evaluacion_criterios`;
CREATE TABLE `evaluacion_criterios`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_idea` int(10) NOT NULL,
  `id_criterio` int(10) NOT NULL,
  `respuesta` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ideas
-- ----------------------------
DROP TABLE IF EXISTS `ideas`;
CREATE TABLE `ideas`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_equipo` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mes` int(10) NOT NULL,
  `anio` int(10) NOT NULL,
  `idea_nueva` int(10) NOT NULL,
  `departamento` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int(10) NOT NULL,
  `fecha_implementacion` date NOT NULL,
  `problematica` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idea_propuesta` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `resultado` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_colaborador` int(11) NULL DEFAULT NULL,
  `inversion` int(11) NULL DEFAULT NULL,
  `beneficio` int(11) NULL DEFAULT NULL,
  `estatus_participacion` int(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for nivel_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `nivel_usuarios`;
CREATE TABLE `nivel_usuarios`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `costo` int(11) NULL DEFAULT NULL,
  `estatus` int(11) NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ranking
-- ----------------------------
DROP TABLE IF EXISTS `ranking`;
CREATE TABLE `ranking`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_idea` int(10) NOT NULL,
  `ranking` int(10) NOT NULL,
  `promotor` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `generador` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mes` int(10) NOT NULL,
  `anio` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_equipo` int(10) NOT NULL,
  `usuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nivel` int(10) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
