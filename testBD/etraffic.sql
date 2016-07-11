-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2016 a las 22:12:04
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `etraffic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calle`
--

CREATE TABLE IF NOT EXISTS `calle` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=381 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `calle`
--

INSERT INTO `calle` (`id`, `nombre`) VALUES
(349, '1'),
(359, '11'),
(361, '13'),
(363, '15'),
(365, '17'),
(367, '19'),
(369, '21'),
(371, '23'),
(373, '25'),
(375, '27'),
(377, '29'),
(351, '3'),
(379, '31'),
(380, '41'),
(378, '43'),
(376, '45'),
(374, '47'),
(372, '49'),
(353, '5'),
(370, '51'),
(368, '53'),
(366, '55'),
(364, '57'),
(362, '59'),
(360, '61'),
(358, '63'),
(356, '65'),
(354, '67'),
(352, '69'),
(355, '7'),
(350, '71'),
(357, '9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calles_intersecciones`
--

CREATE TABLE IF NOT EXISTS `calles_intersecciones` (
  `calle_id` int(11) NOT NULL,
  `interseccion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `calles_intersecciones`
--

INSERT INTO `calles_intersecciones` (`calle_id`, `interseccion_id`) VALUES
(349, 180),
(350, 180),
(351, 181),
(352, 181),
(353, 182),
(354, 182),
(355, 183),
(356, 183),
(357, 184),
(358, 184),
(359, 185),
(360, 185),
(361, 186),
(362, 186),
(363, 187),
(364, 187),
(365, 188),
(366, 188),
(367, 189),
(368, 189),
(369, 190),
(370, 190),
(371, 191),
(372, 191),
(373, 192),
(374, 192),
(375, 193),
(376, 193),
(377, 194),
(378, 194),
(379, 195),
(380, 195);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interseccion`
--

CREATE TABLE IF NOT EXISTS `interseccion` (
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `interseccion`
--

INSERT INTO `interseccion` (`id`) VALUES
(180),
(181),
(182),
(183),
(184),
(185),
(186),
(187),
(188),
(189),
(190),
(191),
(192),
(193),
(194),
(195);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semaforo`
--

CREATE TABLE IF NOT EXISTS `semaforo` (
`id` int(11) NOT NULL,
  `frecuencia` int(11) NOT NULL,
  `interseccion_id` int(11) DEFAULT NULL,
  `calle_id` int(11) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `semaforo`
--

INSERT INTO `semaforo` (`id`, `frecuencia`, `interseccion_id`, `calle_id`, `url`) VALUES
(33, 5, 180, 349, 'http://localhost/SemaphoreSimulator/web/semaforo/json/103'),
(34, 2, 181, 351, 'http://localhost/SemaphoreSimulator/web/semaforo/json/104'),
(35, 2, 182, 353, 'http://localhost/SemaphoreSimulator/web/semaforo/json/105'),
(36, 18, 183, 355, 'http://localhost/SemaphoreSimulator/web/semaforo/json/106'),
(37, 4, 184, 357, 'http://localhost/SemaphoreSimulator/web/semaforo/json/107'),
(38, 5, 185, 359, 'http://localhost/SemaphoreSimulator/web/semaforo/json/108'),
(39, 6, 186, 361, 'http://localhost/SemaphoreSimulator/web/semaforo/json/109'),
(40, 1, 187, 363, 'http://localhost/SemaphoreSimulator/web/semaforo/json/110'),
(41, 8, 188, 365, 'http://localhost/SemaphoreSimulator/web/semaforo/json/111'),
(42, 8, 189, 367, 'http://localhost/SemaphoreSimulator/web/semaforo/json/112'),
(43, 4, 190, 369, 'http://localhost/SemaphoreSimulator/web/semaforo/json/113'),
(44, 1, 191, 371, 'http://localhost/SemaphoreSimulator/web/semaforo/json/114'),
(45, 5, 192, 373, 'http://localhost/SemaphoreSimulator/web/semaforo/json/115'),
(46, 6, 193, 375, 'http://localhost/SemaphoreSimulator/web/semaforo/json/116'),
(47, 14, 194, 377, 'http://localhost/SemaphoreSimulator/web/semaforo/json/117'),
(48, 4, 195, 379, 'http://localhost/SemaphoreSimulator/web/semaforo/json/118');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calle`
--
ALTER TABLE `calle`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_2E77E9DE3A909126` (`nombre`);

--
-- Indices de la tabla `calles_intersecciones`
--
ALTER TABLE `calles_intersecciones`
 ADD PRIMARY KEY (`calle_id`,`interseccion_id`), ADD KEY `IDX_EB8DE66AA08B711E` (`calle_id`), ADD KEY `IDX_EB8DE66A51FB44B6` (`interseccion_id`);

--
-- Indices de la tabla `interseccion`
--
ALTER TABLE `interseccion`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `semaforo`
--
ALTER TABLE `semaforo`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_13892B5EF47645AE` (`url`), ADD KEY `IDX_13892B5E51FB44B6` (`interseccion_id`), ADD KEY `IDX_13892B5EA08B711E` (`calle_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calle`
--
ALTER TABLE `calle`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=381;
--
-- AUTO_INCREMENT de la tabla `interseccion`
--
ALTER TABLE `interseccion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=196;
--
-- AUTO_INCREMENT de la tabla `semaforo`
--
ALTER TABLE `semaforo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calles_intersecciones`
--
ALTER TABLE `calles_intersecciones`
ADD CONSTRAINT `FK_EB8DE66A51FB44B6` FOREIGN KEY (`interseccion_id`) REFERENCES `interseccion` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_EB8DE66AA08B711E` FOREIGN KEY (`calle_id`) REFERENCES `calle` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `semaforo`
--
ALTER TABLE `semaforo`
ADD CONSTRAINT `FK_13892B5E51FB44B6` FOREIGN KEY (`interseccion_id`) REFERENCES `interseccion` (`id`),
ADD CONSTRAINT `FK_13892B5EA08B711E` FOREIGN KEY (`calle_id`) REFERENCES `calle` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
