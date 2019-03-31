-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2019 a las 17:40:55
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `memes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_contenido` int(11) NOT NULL,
  `comentario` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_usuario`, `id_contenido`, `comentario`) VALUES
(74, 13, 42, 'fdf'),
(75, 13, 42, 'sdfsdf'),
(76, 13, 42, 'holaaa'),
(77, 13, 42, 'asasd'),
(78, 13, 42, 'asddd'),
(79, 13, 43, 'sadasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id_contenido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT ' ',
  `votos_positivos` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `votos_negativos` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `reportes` int(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`id_contenido`, `id_usuario`, `titulo`, `imagen`, `votos_positivos`, `votos_negativos`, `categoria`, `reportes`) VALUES
(1, 13, 'imagen1', 'asd.jpg', '2', '2', 'random', 0),
(31, 13, '654', '1552561949-ee.jpg', '1', '0', 'deporte', 0),
(39, 13, 'asdsad', '1552575031-asd.jpg', '1', '0', 'random', 0),
(40, 13, 'asdsd', '1552575036-ee.jpg', '0', '0', 'deporte', 1),
(41, 13, 'kk', '1552575041-s.jpg', '1', '0', 'ot', 1),
(42, 13, 'imagen5', '1553088084-d.jpg', '1', '0', 'random', 0),
(43, 13, 'aaaaaaaaaaa', 'download.jpg', '1', '0', 'deporte', 0),
(44, 13, 'asd', '1553099433-images.jpg', '0', '0', 'deporte', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

CREATE TABLE `gestion` (
  `id_contenido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `aVotado` int(11) NOT NULL DEFAULT '0',
  `aReportado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `gestion`
--

INSERT INTO `gestion` (`id_contenido`, `id_usuario`, `aVotado`, `aReportado`) VALUES
(1, 13, 1, 0),
(2, 13, 0, 0),
(3, 13, 0, 0),
(4, 13, 1, 0),
(5, 13, 1, 0),
(25, 0, 0, 1),
(26, 0, 0, 1),
(31, 13, 1, 0),
(39, 13, 1, 0),
(40, 0, 0, 1),
(41, 0, 0, 1),
(41, 13, 1, 0),
(42, 13, 1, 0),
(43, 13, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `pas` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tipoUsr` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `email`, `pas`, `tipoUsr`) VALUES
(1, 'sergio', 'Berná Morcillo', 'sergiobernamorcillo@gmail.com', 'sergio', 'usuario'),
(13, 'asd', 'asd', 'asd', 'asd', 'admin'),
(26, '3', '3', '3', '3', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `comentarios_ibfk_1` (`id_contenido`),
  ADD KEY `comentarios_ibfk_2` (`id_usuario`);

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id_contenido`) USING BTREE;

--
-- Indices de la tabla `gestion`
--
ALTER TABLE `gestion`
  ADD PRIMARY KEY (`id_contenido`,`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id_contenido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_contenido`) REFERENCES `contenido` (`id_contenido`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
