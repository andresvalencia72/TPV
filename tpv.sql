-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2023 a las 14:01:49
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `cod_articulo` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `cod_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`cod_articulo`, `nombre`, `precio`, `cod_categoria`) VALUES
(1, 'Café Colombiano', 1.5, 1),
(2, 'Café Capuccino', 1.5, 1),
(3, 'Café Corto', 1.4, 1),
(4, 'Cerveza maou', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `cod_empleado` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`cod_empleado`, `nombre`, `activo`) VALUES
(0, 'juan', 0),
(1, 'Carlo', 1),
(2, 'maria', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_tickets`
--

CREATE TABLE `lineas_tickets` (
  `cod_linea` int(11) NOT NULL,
  `cod_ticket` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `cod_ticket` int(11) NOT NULL,
  `cod_empleado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `cod_tipo` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`cod_tipo`, `tipo`, `activo`) VALUES
(1, 'cafés', 1),
(2, 'cervezas', 1),
(3, 'refrescos', 1),
(4, 'pinchos', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`cod_articulo`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`cod_empleado`);

--
-- Indices de la tabla `lineas_tickets`
--
ALTER TABLE `lineas_tickets`
  ADD PRIMARY KEY (`cod_linea`),
  ADD KEY `cod_ticket` (`cod_ticket`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`cod_ticket`),
  ADD KEY `cod_empleado` (`cod_empleado`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`cod_tipo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_tickets`
--
ALTER TABLE `lineas_tickets`
  ADD CONSTRAINT `lineas_tickets_ibfk_1` FOREIGN KEY (`cod_ticket`) REFERENCES `tickets` (`cod_ticket`);

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`cod_empleado`) REFERENCES `empleados` (`cod_empleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
