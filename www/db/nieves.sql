-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-12-2020 a las 09:03:13
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nieves`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contienen`
--

CREATE TABLE `contienen` (
  `id_contiene` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_plato` int(11) NOT NULL,
  `n_linea` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `total` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contienen`
--

INSERT INTO `contienen` (`id_contiene`, `id_pedido`, `id_plato`, `n_linea`, `cantidad`, `precio`, `total`) VALUES
(1, 1, 1, 1, 1, 4, '0.00'),
(2, 1, 2, 2, 2, 4.5, '0.00'),
(3, 1, 3, 3, 1, 8.5, '0.00'),
(4, 2, 1, 1, 1, 4, '4.00'),
(5, 2, 2, 2, 2, 4.5, '9.00'),
(6, 2, 3, 3, 1, 8.5, '8.50'),
(7, 2, 4, 4, 1, 5.5, '5.50'),
(8, 4, 1, 1, 1, 4, '4.00'),
(9, 4, 2, 2, 1, 4.5, '4.50'),
(10, 5, 1, 1, 1, 4, '4.00'),
(11, 5, 2, 2, 1, 4.5, '4.50'),
(12, 5, 4, 3, 1, 5.5, '5.50'),
(13, 6, 2, 1, 1, 4.5, '4.50'),
(14, 6, 1, 2, 1, 4, '4.00'),
(15, 7, 2, 1, 1, 4.5, '4.50'),
(16, 7, 1, 2, 1, 4, '4.00'),
(17, 8, 1, 1, 1, 4, '4.00'),
(18, 8, 2, 2, 1, 4.5, '4.50'),
(19, 8, 3, 3, 1, 8.5, '8.50'),
(20, 8, 2, 4, 2, 4.5, '9.00');

--
-- Disparadores `contienen`
--
DELIMITER $$
CREATE TRIGGER `total` BEFORE INSERT ON `contienen` FOR EACH ROW BEGIN SET new.total = new.precio * new.cantidad; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `f_pedido` datetime DEFAULT NULL,
  `f_entrega` date DEFAULT NULL,
  `h_entrega` time NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `total` decimal(5,2) NOT NULL,
  `recoger_llevar` varchar(100) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `f_pedido`, `f_entrega`, `h_entrega`, `id_usuario`, `total`, `recoger_llevar`) VALUES
(1, '2020-12-27 09:23:30', '2020-12-27', '15:15:00', 4, '21.50', 'recoger'),
(2, '2020-12-27 09:26:11', '2020-12-28', '12:00:00', 1, '27.00', 'llevar'),
(3, '2020-12-27 09:30:10', '2020-12-27', '15:30:00', 5, '0.00', 'recoger'),
(4, '2020-12-27 09:30:27', '2020-12-29', '17:00:00', 5, '8.50', 'llevar'),
(5, '2020-12-28 09:05:17', '2020-12-30', '12:00:00', 5, '14.00', 'recoger'),
(6, '2020-12-28 10:18:56', '0000-00-00', '12:00:00', 5, '8.50', 'llevar'),
(7, '2020-12-28 15:53:55', '2020-12-28', '16:30:00', 4, '8.50', 'llevar'),
(8, '2020-12-28 16:55:23', '2020-12-30', '12:00:00', 5, '26.00', 'recoger');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id_plato` int(11) NOT NULL,
  `plato` varchar(127) DEFAULT 'NULL',
  `foto` varchar(127) DEFAULT 'NULL',
  `descripcion` text DEFAULT NULL,
  `pvp` float DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id_plato`, `plato`, `foto`, `descripcion`, `pvp`) VALUES
(1, 'Ensalada', '../assets/img/desktop/ensalada.jpg', 'Ensalada verde con aguacate, brotes tiernos, tomate cherry, zanahoria y aliño césar', 4),
(2, 'Espaguetis', '../assets/img/desktop/espaguetis.jpg', 'Espaguetis con salsa boloñesa y carne picada de ternera.', 4.5),
(3, 'Entrecot', '../assets/img/desktop/entrecot.jpg', 'Entrecot de ternera a la parrilla con verduritas y patatas fritas', 8.5),
(4, 'Pechugas rebozadas', '../assets/img/desktop/rebozado.jpg', 'Pechugas de pollo rebozadas con patatas fritas', 5.5),
(5, 'Calamares', '../assets/img/desktop/calamares.jpg', 'Calamares con nuestra receta casera de salsa americana.', 6.5),
(6, 'Ensaladilla','../assets/img/desktop/ensaladilla.jpg', 'Ensaladilla rusa con mayonesa casera, zanahoria, huevo, guisantes, judías verdes y pimiento rojo.', 4.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(31) DEFAULT 'NULL'
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Gerente'),
(2, 'Dependiente'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(127) NOT NULL,
  `clave` varchar(255) DEFAULT 'NULL',
  `nombre` varchar(127) DEFAULT 'NULL',
  `apellidos` varchar(127) DEFAULT 'NULL',
  `direccion` varchar(127) DEFAULT 'NULL',
  `cp` int(11) DEFAULT NULL,
  `poblacion` varchar(127) DEFAULT 'NULL',
  `provincia` varchar(63) DEFAULT '''Baleares''',
  `tlf` varchar(31) DEFAULT 'NULL',
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `clave`, `nombre`, `apellidos`, `direccion`, `cp`, `poblacion`, `provincia`, `tlf`, `id_rol`) VALUES
(1, 'ana@casero.com', '$2y$10$z6oBl2e.mrJ8OhLcJpNaSeFoB9xH49.GA.UO/V1VAkRqSnyLvx1RO', 'Ana', 'Marín del Moral', 'C/ Aucanada 20, bajos', 7141, 'Marratxí', '\'Baleares\'', '666552211', 1),
(2, 'miguel@casero.com', '$2y$10$6HFalRbfiucOgQvBsLop9ei2UW96YFZz104k8toO8pOBLA1BvgcEO', 'Miguel', 'Bolívar García', 'C/ Formentera 15, bajo B', 7008, 'Palma de Mallorca', '\'Baleares\'', '699551133', 2),
(3, 'belen@gmail.com', '$2y$10$fUqp7YYH3Od43Z6fYdx8qeUEQ/2S2xRf4ygnLXV8Z4pdPGM42xZaC', 'Belén ', 'Nieto Garrido', 'C/ Puig Major 38, bajo', 7005, 'Palma de Mallorca', '\'Baleares\'', '688447755', 3),
(4, 'luis@gmail.com', '$2y$10$qckg/9kbr9P7.oB7465akeIFmE11Sfc4iX8CUew5AZic1BqiueBSy', 'Luis', 'Antunez Riera', 'C/ Rosa 5, bajo B', 7006, 'Palma de Mallorca', '\'Baleares\'', '677448855', 3),
(5, 'daniela@gmail.com', '$2y$10$dYEBk/z7sr20Y3sscUW5muIuvTaaMfm.KmkgDIuzxQ1aw5dpwFiwS', 'Daniela', 'Gómez Nieto', 'c/ cid 58, 4º piso pta 3', 7004, 'Palma de Mallorca', '\'Baleares\'', '6114455', 3),
(10, 'marianela@gmail.com', '$2y$10$QbaZ/bILRE/T4MnRg9BN0OFcpiG6A0TLxD1evDW13DCPqt4x9fV9G', 'Marianela', 'Borrego lópez', 'C/ Baleares 22, bajo A', 7008, 'Palma de Mallorca', '\'Baleares\'', '644887755', 3),
(11, 'carmen@gmail.com', '$2y$10$dGj6BepY0ZiXOPhIiIhW7uAnl.VBtQJca1iXYaysprLWWTKbRGqqu', 'Carmen', 'Bolívar Nieto', 'C/ Rocinante 20, 2º piso, pta 2', 7004, 'Palma de Mallorca', '\'Baleares\'', '6448855', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contienen`
--
ALTER TABLE `contienen`
  ADD PRIMARY KEY (`id_contiene`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_plato` (`id_plato`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id_plato`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contienen`
--
ALTER TABLE `contienen`
  MODIFY `id_contiene` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id_plato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contienen`
--
ALTER TABLE `contienen`
  ADD CONSTRAINT `contienen_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `contienen_ibfk_2` FOREIGN KEY (`id_plato`) REFERENCES `platos` (`id_plato`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
