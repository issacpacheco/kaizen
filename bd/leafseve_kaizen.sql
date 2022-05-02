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

 Date: 29/04/2022 16:28:24
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
-- Records of administrador
-- ----------------------------
INSERT INTO `administrador` VALUES (1, 'administrador', '1234', 'Administrador', 1);

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
-- Records of clasificacion
-- ----------------------------
INSERT INTO `clasificacion` VALUES (1, 'Reducción de costos y gastos', '');
INSERT INTO `clasificacion` VALUES (2, 'Mejoras en los procesos', '');
INSERT INTO `clasificacion` VALUES (3, 'Clima laboral', '');
INSERT INTO `clasificacion` VALUES (4, 'Satisfacción del cliente interno/externo', '');
INSERT INTO `clasificacion` VALUES (5, 'Imagen de la Estación', '');

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
-- Records of criterios
-- ----------------------------
INSERT INTO `criterios` VALUES (1, '¿Se apega a los temas de las mejoras?', '', 2);
INSERT INTO `criterios` VALUES (2, '¿La implementación es individual? ', '', 2);
INSERT INTO `criterios` VALUES (3, '¿Su implementación no perjudica otras áreas?', '', 2);
INSERT INTO `criterios` VALUES (4, '¿Su implementación está en manos de quien lo propone?', '', 2);
INSERT INTO `criterios` VALUES (5, '¿Su implementación no excede de 1 mes?', '', 2);
INSERT INTO `criterios` VALUES (6, '¿La idea es de implementación fácil y rápida?', '', 2);
INSERT INTO `criterios` VALUES (7, '¿Requiere la aprobación de otras áreas? (Si la respuesta es SI, escribir también el nombre del área)', '', 1);
INSERT INTO `criterios` VALUES (8, '¿El beneficio es MAYOR que la inversión? (Si aplica escribir el monto estimado de la INVERSIÓN y el monto estimado del BENEFICIO)', '', 1);

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
-- Records of equipos
-- ----------------------------
INSERT INTO `equipos` VALUES (1, 'Aguilas', 'Christhian Sosa', 2);

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
-- Records of evaluacion
-- ----------------------------
INSERT INTO `evaluacion` VALUES (1, 1, 2, 1, '', 1, '2022-01-14');
INSERT INTO `evaluacion` VALUES (2, 2, 2, 1, '', 1, '2022-01-15');
INSERT INTO `evaluacion` VALUES (3, 3, 2, 1, '', 1, '2022-01-15');
INSERT INTO `evaluacion` VALUES (4, 4, 2, 1, '', 1, '2022-01-18');
INSERT INTO `evaluacion` VALUES (5, 5, 2, 2, 'hola mundo', 0, '2022-04-20');

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
-- Records of evaluacion_criterios
-- ----------------------------
INSERT INTO `evaluacion_criterios` VALUES (1, 1, 1, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (2, 1, 2, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (3, 1, 3, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (4, 1, 4, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (5, 1, 5, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (6, 1, 6, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (7, 1, 7, '');
INSERT INTO `evaluacion_criterios` VALUES (8, 1, 8, '');
INSERT INTO `evaluacion_criterios` VALUES (9, 2, 1, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (10, 2, 2, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (11, 2, 3, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (12, 2, 4, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (13, 2, 5, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (14, 2, 6, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (15, 2, 7, '');
INSERT INTO `evaluacion_criterios` VALUES (16, 2, 8, '');
INSERT INTO `evaluacion_criterios` VALUES (17, 3, 1, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (18, 3, 2, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (19, 3, 3, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (20, 3, 4, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (21, 3, 5, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (22, 3, 6, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (23, 3, 7, '');
INSERT INTO `evaluacion_criterios` VALUES (24, 3, 8, '');
INSERT INTO `evaluacion_criterios` VALUES (25, 4, 1, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (26, 4, 2, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (27, 4, 3, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (28, 4, 4, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (29, 4, 5, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (30, 4, 6, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (31, 4, 7, '');
INSERT INTO `evaluacion_criterios` VALUES (32, 4, 8, '');
INSERT INTO `evaluacion_criterios` VALUES (33, 5, 1, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (34, 5, 2, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (35, 5, 3, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (36, 5, 4, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (37, 5, 5, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (38, 5, 6, 'Sí');
INSERT INTO `evaluacion_criterios` VALUES (39, 5, 7, 'hola mundo');
INSERT INTO `evaluacion_criterios` VALUES (40, 5, 8, 'hola mundo');

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
-- Records of ideas
-- ----------------------------
INSERT INTO `ideas` VALUES (1, 1, 3, 'Prueba', 12, 2021, 1, '', 1, '0000-00-00', 'fs', 'fsdf', 'fsd', NULL, NULL, NULL, NULL);
INSERT INTO `ideas` VALUES (2, 1, 3, 'Idea Enero 2022', 1, 2022, 1, '', 1, '0000-00-00', 'dqwdqw', 'eqweqw', 'eqwe', NULL, NULL, NULL, NULL);
INSERT INTO `ideas` VALUES (3, 1, 3, 'Prueba diciembre 2021', 12, 2021, 2, 'Sistemas', 2, '0000-00-00', 'sadas', 'das', 'dasd', NULL, NULL, NULL, NULL);
INSERT INTO `ideas` VALUES (4, 1, 3, 'Prueba diciembre 2021', 12, 2021, 1, '', 1, '0000-00-00', '', '', '', NULL, NULL, NULL, NULL);
INSERT INTO `ideas` VALUES (5, 1, 3, 'ONE SMART', 4, 2022, 1, '', 1, '0000-00-00', 'HOLA MUNDO', 'HOLA MUNDO', 'HOLA MUNDO', 3, 2754, 3337, 1);

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
-- Records of nivel_usuarios
-- ----------------------------
INSERT INTO `nivel_usuarios` VALUES (1, 'Administrador');
INSERT INTO `nivel_usuarios` VALUES (2, 'Promotor');
INSERT INTO `nivel_usuarios` VALUES (3, 'Generador');

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
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES (1, 'producto 1', 'producto 1 de prueba', 200, 1, 'producto1.png');
INSERT INTO `productos` VALUES (2, 'producto 2', 'producto 2 de prueba', 500, 1, 'producto1.png');

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
-- Records of ranking
-- ----------------------------
INSERT INTO `ranking` VALUES (1, 1, 1, 'Christhian Sosa', 'Dr. Emmet Brown', 12, 2021);
INSERT INTO `ranking` VALUES (2, 2, 2, '', '', 1, 2022);
INSERT INTO `ranking` VALUES (3, 5, 3, 'sad', 'asd', 4, 2022);

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

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 0, 'administrador', '12345', 'Velia', 1);
INSERT INTO `usuarios` VALUES (2, 1, 'promotor1', '1', '', 2);
INSERT INTO `usuarios` VALUES (3, 1, 'user1', '1', 'pruebas de usuario', 3);

SET FOREIGN_KEY_CHECKS = 1;
