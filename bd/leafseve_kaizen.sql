-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-04-2022 a las 10:03:22
-- Versión del servidor: 5.7.37
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `leafseve_kaizen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(10) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nivel` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `usuario`, `pass`, `nombre`, `nivel`) VALUES
(1, 'administrador', '1234', 'Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `id` int(10) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Reducción de costos y gastos', ''),
(2, 'Mejoras en los procesos', ''),
(3, 'Clima laboral', ''),
(4, 'Satisfacción del cliente interno/externo', ''),
(5, 'Imagen de la Estación', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterios`
--

CREATE TABLE `criterios` (
  `id` int(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo_respuesta` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `criterios`
--

INSERT INTO `criterios` (`id`, `nombre`, `descripcion`, `tipo_respuesta`) VALUES
(1, '¿Se apega a los temas de las mejoras?', '', 2),
(2, '¿La implementación es individual? ', '', 2),
(3, '¿Su implementación no perjudica otras áreas?', '', 2),
(4, '¿Su implementación está en manos de quien lo propone?', '', 2),
(5, '¿Su implementación no excede de 1 mes?', '', 2),
(6, '¿La idea es de implementación fácil y rápida?', '', 2),
(7, '¿Requiere la aprobación de otras áreas? (Si la respuesta es SI, escribir también el nombre del área)', '', 1),
(8, '¿El beneficio es MAYOR que la inversión? (Si aplica escribir el monto estimado de la INVERSIÓN y el monto estimado del BENEFICIO)', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `promotor` varchar(255) NOT NULL,
  `tipo` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `nombre`, `promotor`, `tipo`) VALUES
(1, 'Aguilas', 'Christhian Sosa', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `id` int(10) NOT NULL,
  `id_idea` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_clasificacion` int(10) NOT NULL,
  `retroalimentacion` text NOT NULL,
  `status` int(10) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`id`, `id_idea`, `id_usuario`, `id_clasificacion`, `retroalimentacion`, `status`, `fecha`) VALUES
(1, 1, 2, 1, '', 1, '2022-01-14'),
(2, 2, 2, 1, '', 1, '2022-01-15'),
(3, 3, 2, 1, '', 1, '2022-01-15'),
(4, 4, 2, 1, '', 1, '2022-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_criterios`
--

CREATE TABLE `evaluacion_criterios` (
  `id` int(10) NOT NULL,
  `id_idea` int(10) NOT NULL,
  `id_criterio` int(10) NOT NULL,
  `respuesta` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluacion_criterios`
--

INSERT INTO `evaluacion_criterios` (`id`, `id_idea`, `id_criterio`, `respuesta`) VALUES
(1, 1, 1, 'Sí'),
(2, 1, 2, 'Sí'),
(3, 1, 3, 'Sí'),
(4, 1, 4, 'Sí'),
(5, 1, 5, 'Sí'),
(6, 1, 6, 'Sí'),
(7, 1, 7, ''),
(8, 1, 8, ''),
(9, 2, 1, 'Sí'),
(10, 2, 2, 'Sí'),
(11, 2, 3, 'Sí'),
(12, 2, 4, 'Sí'),
(13, 2, 5, 'Sí'),
(14, 2, 6, 'Sí'),
(15, 2, 7, ''),
(16, 2, 8, ''),
(17, 3, 1, 'Sí'),
(18, 3, 2, 'Sí'),
(19, 3, 3, 'Sí'),
(20, 3, 4, 'Sí'),
(21, 3, 5, 'Sí'),
(22, 3, 6, 'Sí'),
(23, 3, 7, ''),
(24, 3, 8, ''),
(25, 4, 1, 'Sí'),
(26, 4, 2, 'Sí'),
(27, 4, 3, 'Sí'),
(28, 4, 4, 'Sí'),
(29, 4, 5, 'Sí'),
(30, 4, 6, 'Sí'),
(31, 4, 7, ''),
(32, 4, 8, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ideas`
--

CREATE TABLE `ideas` (
  `id` int(10) NOT NULL,
  `id_equipo` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `mes` int(10) NOT NULL,
  `anio` int(10) NOT NULL,
  `idea_nueva` int(10) NOT NULL,
  `departamento` varchar(255) NOT NULL,
  `status` int(10) NOT NULL,
  `fecha_implementacion` date NOT NULL,
  `problematica` text NOT NULL,
  `idea_propuesta` text NOT NULL,
  `resultado` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ideas`
--

INSERT INTO `ideas` (`id`, `id_equipo`, `id_usuario`, `nombre`, `mes`, `anio`, `idea_nueva`, `departamento`, `status`, `fecha_implementacion`, `problematica`, `idea_propuesta`, `resultado`) VALUES
(1, 1, 3, 'Prueba', 12, 2021, 1, '', 1, '0000-00-00', 'fs', 'fsdf', 'fsd'),
(2, 1, 3, 'Idea Enero 2022', 1, 2022, 1, '', 1, '0000-00-00', 'dqwdqw', 'eqweqw', 'eqwe'),
(3, 1, 3, 'Prueba diciembre 2021', 12, 2021, 2, 'Sistemas', 2, '0000-00-00', 'sadas', 'das', 'dasd'),
(4, 1, 3, 'Prueba diciembre 2021', 12, 2021, 1, '', 1, '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_usuarios`
--

CREATE TABLE `nivel_usuarios` (
  `id` int(10) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel_usuarios`
--

INSERT INTO `nivel_usuarios` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Promotor'),
(3, 'Generador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ranking`
--

CREATE TABLE `ranking` (
  `id` int(10) NOT NULL,
  `id_idea` int(10) NOT NULL,
  `ranking` int(10) NOT NULL,
  `promotor` varchar(255) NOT NULL,
  `generador` varchar(255) NOT NULL,
  `mes` int(10) NOT NULL,
  `anio` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ranking`
--

INSERT INTO `ranking` (`id`, `id_idea`, `ranking`, `promotor`, `generador`, `mes`, `anio`) VALUES
(1, 1, 1, 'Christhian Sosa', 'Dr. Emmet Brown', 12, 2021),
(2, 2, 2, '', '', 1, 2022);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `id_equipo` int(10) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nivel` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_equipo`, `usuario`, `pass`, `nombre`, `nivel`) VALUES
(1, 0, 'administrador', '12345', 'Velia', 1),
(2, 1, 'promotor1', '1', '', 2),
(3, 1, 'user1', '1', '', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `criterios`
--
ALTER TABLE `criterios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluacion_criterios`
--
ALTER TABLE `evaluacion_criterios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nivel_usuarios`
--
ALTER TABLE `nivel_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `criterios`
--
ALTER TABLE `criterios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `evaluacion_criterios`
--
ALTER TABLE `evaluacion_criterios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `ideas`
--
ALTER TABLE `ideas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `nivel_usuarios`
--
ALTER TABLE `nivel_usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ranking`
--
ALTER TABLE `ranking`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
