-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2024 a las 13:00:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_reserva`
--

CREATE TABLE `detalles_reserva` (
  `id_detalle_reserva` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_reserva`
--

INSERT INTO `detalles_reserva` (`id_detalle_reserva`, `id_reserva`, `id_servicio`, `cantidad`, `estado`) VALUES
(1, 1, 2, NULL, 1),
(2, 2, 2, NULL, 1),
(3, 3, 3, NULL, 1),
(4, 4, 3, NULL, 1),
(5, 5, 6, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_administrador` int(11) DEFAULT NULL,
  `fecha_reserva` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` enum('pendiente','ejecutada','cancelada') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_usuario`, `id_administrador`, `fecha_reserva`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(1, 6, 0, '2024-09-21 17:27:18', '2024-09-26', NULL, 'ejecutada'),
(2, 2, 5, '2024-09-21 17:29:31', '2024-10-11', NULL, 'pendiente'),
(3, 6, 0, '2024-09-21 22:02:22', '2024-09-30', NULL, 'cancelada'),
(4, 6, 0, '2024-09-22 15:18:52', '2024-09-22', NULL, 'pendiente'),
(5, 6, 0, '2024-09-22 17:25:31', '2024-09-23', NULL, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `descripcion`, `precio`) VALUES
(1, 'Mesa 1', NULL),
(2, 'Mesa 2', NULL),
(3, 'Mesa 3', NULL),
(4, 'Mesa 4', NULL),
(5, 'Mesa 5', NULL),
(6, 'Mesa Especial LINKTIC', NULL),
(7, 'Mesa Familiar #1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `tipo` char(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `correo`, `tipo`, `nombre`, `contrasena`) VALUES
(1, 'raybelis@lvltic.com', 'cliente', 'Raybelis Medina', '$2y$10$u3WEbXw8SGK/P23bARj5cu7q6pSHl2E00Tn1P8zOqvoG/QY7fb8/W'),
(2, 'haziel@lvltic.com', 'cliente', 'Haziel Medina', '$2y$10$zTfypMKoEi/ZaJF8Qtweaedf3txS.tXrDxJ.x9KmDYOKIqgT6gTE.'),
(3, 'marbelys@lvltic.com', 'administrador', 'Marbelys Rojas', '$2y$10$ppn6f8FnrM30l7Ot.5X6T.ifN0ILF9Lnb4ePG8npcAcXLuD4QSR56'),
(4, 'raymond@lvltic.com', 'administrador', 'Raymond Medina', '$2y$10$9Zt6WPF2Gfd3a61vCT/iOedquYyvqsCo.iW3hyA7gRnckC9BBNbFG'),
(5, 'admini@lvltic.com', 'administrador', 'Administrador', '$2y$10$f7m8IWHIwHqWWrdVZDxs4.UmBXKlxKfK0DqAtMYfmoVnuem9OkRIK'),
(6, 'antonia@lvltic.com', 'cliente', 'Antonia SAnchez', '$2y$10$obNrI3Qw/1ds0NUaWJZepObqq1ufJWJIvUNfxpTbc4DpOxmpwCpOK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalles_reserva`
--
ALTER TABLE `detalles_reserva`
  ADD PRIMARY KEY (`id_detalle_reserva`),
  ADD KEY `id_reserva` (`id_reserva`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_reserva`
--
ALTER TABLE `detalles_reserva`
  MODIFY `id_detalle_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_reserva`
--
ALTER TABLE `detalles_reserva`
  ADD CONSTRAINT `detalles_reserva_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id_reserva`),
  ADD CONSTRAINT `detalles_reserva_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
