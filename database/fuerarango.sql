-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2020 a las 20:28:13
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fuerarango`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `excluyentes`
--

CREATE TABLE `excluyentes` (
  `idExcluyente` int(11) NOT NULL,
  `idDePractica` smallint(6) NOT NULL,
  `idDeExcluida` smallint(6) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `internaciones`
--

CREATE TABLE `internaciones` (
  `id` int(11) NOT NULL,
  `idDePaciente` mediumint(9) NOT NULL,
  `fechaIngreso` datetime NOT NULL,
  `fechaEgreso` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `internaciones`
--

INSERT INTO `internaciones` (`id`, `idDePaciente`, `fechaIngreso`, `fechaEgreso`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-01-19 11:40:00', '2020-01-29 08:30:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 1, '2020-01-31 07:30:00', '2020-01-31 10:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 2, '2020-02-01 12:30:00', '2020-02-02 13:30:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `idPaciente` mediumint(9) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `beneficio` varchar(255) NOT NULL,
  `dni` int(8) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`idPaciente`, `nombre`, `beneficio`, `dni`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'BRUN CHRISTIAN', '15087892010600', 5372796, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'ALVAREZ ANA MARIA', '15501025950200', 9984183, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'SAGARDOY CARLOS ALBERTO', '15042175200700', 7637845, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practicas`
--

CREATE TABLE `practicas` (
  `idPractica` smallint(6) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cantMaxDiaria` tinyint(4) NOT NULL,
  `cantMaxMen` smallint(6) NOT NULL,
  `cantMaxAnu` smallint(6) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `practicas`
--

INSERT INTO `practicas` (`idPractica`, `codigo`, `descripcion`, `cantMaxDiaria`, `cantMaxMen`, `cantMaxAnu`, `activo`, `created_at`, `updated_at`) VALUES
(2, '770171', 'COAGULOGRAMA', 2, 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '770193', 'CREATININA CLEARENCE DE DEPURACION', 1, 2, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '770349', 'FISICO QUIMICO, EXAMEN. LIQUIDOS EXUDADOS, TRASUDADOS. INCLUYE: ASPECTO, CARACTERES, CLORUROS, PROTEINAS, RIVOLTA Y GLUCOSA', 6, 6, 6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, '770187', 'COPROCULTIVO', 1, 2, 0, 1, '2020-03-26 18:31:35', '2020-03-26 18:31:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practicas_realizadas`
--

CREATE TABLE `practicas_realizadas` (
  `idPractRealizada` int(11) NOT NULL,
  `idDeInterna` int(11) NOT NULL,
  `idDePractica` smallint(6) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `excluyentes`
--
ALTER TABLE `excluyentes`
  ADD KEY `fk_excluyentes_practicas_excluida` (`idDeExcluida`),
  ADD KEY `fk_excluyentes_practicas_practica` (`idDePractica`);

--
-- Indices de la tabla `internaciones`
--
ALTER TABLE `internaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDePaciente` (`idDePaciente`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`idPaciente`);

--
-- Indices de la tabla `practicas`
--
ALTER TABLE `practicas`
  ADD PRIMARY KEY (`idPractica`);

--
-- Indices de la tabla `practicas_realizadas`
--
ALTER TABLE `practicas_realizadas`
  ADD PRIMARY KEY (`idPractRealizada`),
  ADD KEY `idDePractica` (`idDePractica`),
  ADD KEY `idDeInterna` (`idDeInterna`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `internaciones`
--
ALTER TABLE `internaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `idPaciente` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `practicas`
--
ALTER TABLE `practicas`
  MODIFY `idPractica` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `practicas_realizadas`
--
ALTER TABLE `practicas_realizadas`
  MODIFY `idPractRealizada` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `excluyentes`
--
ALTER TABLE `excluyentes`
  ADD CONSTRAINT `fk_excluyentes_practicas_excluida` FOREIGN KEY (`idDeExcluida`) REFERENCES `practicas` (`idPractica`),
  ADD CONSTRAINT `fk_excluyentes_practicas_practica` FOREIGN KEY (`idDePractica`) REFERENCES `practicas` (`idPractica`);

--
-- Filtros para la tabla `internaciones`
--
ALTER TABLE `internaciones`
  ADD CONSTRAINT `internaciones_ibfk_1` FOREIGN KEY (`idDePaciente`) REFERENCES `pacientes` (`idPaciente`);

--
-- Filtros para la tabla `practicas_realizadas`
--
ALTER TABLE `practicas_realizadas`
  ADD CONSTRAINT `practicas_realizadas_ibfk_1` FOREIGN KEY (`idDePractica`) REFERENCES `practicas` (`idPractica`),
  ADD CONSTRAINT `practicas_realizadas_ibfk_2` FOREIGN KEY (`idDeInterna`) REFERENCES `internaciones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
