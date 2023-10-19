-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2023 a las 19:55:33
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

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
  `cod_art` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `precio` double NOT NULL,
  `cod_tipo` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`cod_art`, `nombre`, `precio`, `cod_tipo`, `activo`) VALUES
(1, 'Coca-Cola', 1.5, 1, 1),
(2, 'Fanta-Loca', 1.25, 1, 1),
(3, 'Café solo', 1, 4, 1),
(4, 'Vinito', 5, 2, 1),
(5, 'Tortillita de patatas CON CEBOLLA', 1.2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `cod_empleado` int(5) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`cod_empleado`, `nombre`, `activo`) VALUES
(1, 'Paco', 1),
(3, 'Esteban', 1),
(4, 'Juan', 1),
(6, 'Noelia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_ticket`
--

CREATE TABLE `lineas_ticket` (
  `cod_linea` int(11) NOT NULL,
  `cod_ticket` int(11) DEFAULT NULL,
  `cod_art` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lineas_ticket`
--

INSERT INTO `lineas_ticket` (`cod_linea`, `cod_ticket`, `cod_art`, `cantidad`, `precio`) VALUES
(1, 1, 4, 2, 5),
(2, 1, 5, 1, 1.2),
(3, 1, 1, 1, 1.5),
(4, 1, 2, 1, 1.25),
(5, 2, 3, 1, 1),
(6, 2, 5, 1, 1.2),
(7, 3, 3, 8, 1),
(8, 3, 1, 4, 1.5),
(9, 3, 2, 4, 1.25),
(10, 3, 5, 4, 1.2);

--
-- Disparadores `lineas_ticket`
--
DELIMITER $$
CREATE TRIGGER `linea_ticket` BEFORE INSERT ON `lineas_ticket` FOR EACH ROW BEGIN
DECLARE next_cod INT;
    SELECT IFNULL(MAX(cod_linea), 0) + 1 INTO next_cod FROM lineas_ticket;
    SET NEW.cod_linea = next_cod;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `cod_ticket` int(11) NOT NULL,
  `cod_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`cod_ticket`, `cod_empleado`, `fecha`, `activo`) VALUES
(1, 1, '2023-10-19', 0),
(2, 1, '2023-10-19', 0),
(3, 6, '2023-10-19', 0);

--
-- Disparadores `tickets`
--
DELIMITER $$
CREATE TRIGGER `aumentar_cod_ticket` BEFORE INSERT ON `tickets` FOR EACH ROW BEGIN
    DECLARE next_cod INT;
    SELECT IFNULL(MAX(cod_ticket), 0) + 1 INTO next_cod FROM tickets;
    SET NEW.cod_ticket = next_cod;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `cod_tipo` int(11) NOT NULL,
  `tipo` varchar(60) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`cod_tipo`, `tipo`, `activo`) VALUES
(1, 'Refrescos', 1),
(2, 'Alcohol', 1),
(3, 'Tapas', 1),
(4, 'café', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`cod_art`),
  ADD KEY `tipo_art` (`cod_tipo`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`cod_empleado`);

--
-- Indices de la tabla `lineas_ticket`
--
ALTER TABLE `lineas_ticket`
  ADD PRIMARY KEY (`cod_linea`),
  ADD KEY `ticket_ref` (`cod_ticket`),
  ADD KEY `art_ref` (`cod_art`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`cod_ticket`),
  ADD KEY `empleado` (`cod_empleado`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`cod_tipo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `tipo_art` FOREIGN KEY (`cod_tipo`) REFERENCES `tipos` (`cod_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineas_ticket`
--
ALTER TABLE `lineas_ticket`
  ADD CONSTRAINT `art_ref` FOREIGN KEY (`cod_art`) REFERENCES `articulos` (`cod_art`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ref` FOREIGN KEY (`cod_ticket`) REFERENCES `tickets` (`cod_ticket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `empleado` FOREIGN KEY (`cod_empleado`) REFERENCES `empleados` (`cod_empleado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
