-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2017 a las 04:09:34
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ruleta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bet`
--

CREATE TABLE `bet` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `game_id` bigint(20) NOT NULL,
  `colour` varchar(50) NOT NULL,
  `bet_cash` decimal(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bet`
--

INSERT INTO `bet` (`id`, `user_id`, `game_id`, `colour`, `bet_cash`) VALUES
(11, 2, 1, 'green', '3681.00'),
(12, 2, 1, 'green', '4000.00'),
(13, 2, 1, 'black', '3680.00'),
(14, 2, 1, 'green', '3974.40'),
(15, 2, 2, 'red', '3656.45'),
(16, 2, 3, 'red', '3364.93'),
(17, 2, 4, 'green', '3637.13'),
(18, 2, 5, 'black', '3342.16'),
(19, 2, 6, 'green', '3609.53'),
(20, 2, 7, 'red', '3321.77'),
(21, 2, 8, 'green', '3586.51'),
(22, 2, 9, 'black', '3299.59'),
(23, 2, 10, 'black', '3035.62'),
(24, 2, 11, 'red', '3279.47'),
(25, 2, 12, 'green', '3016.11'),
(26, 2, 13, 'red', '2775.82'),
(27, 2, 14, 'red', '2554.76'),
(28, 2, 15, 'red', '2758.14'),
(29, 2, 16, 'green', '2978.79'),
(30, 2, 17, 'green', '2740.49'),
(31, 2, 18, 'green', '2575.25'),
(32, 2, 19, 'black', '2352.23'),
(33, 2, 20, 'red', '2159.05'),
(34, 2, 21, 'red', '1962.32'),
(35, 2, 22, 'red', '1798.34'),
(36, 2, 23, 'black', '1654.47'),
(37, 2, 24, 'red', '1530.11'),
(38, 2, 25, 'black', '1644.52'),
(39, 2, 26, 'black', '1514.96');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `game`
--

CREATE TABLE `game` (
  `id` bigint(20) NOT NULL,
  `result_colour` varchar(50) DEFAULT NULL,
  `date` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `game`
--

INSERT INTO `game` (`id`, `result_colour`, `date`, `user_id`) VALUES
(1, 'black', '2017-10-08 11:11:41', 2),
(2, 'black', '2017-10-10 20:23:06', 2),
(3, 'black', '2017-10-10 20:23:41', 2),
(4, 'black', '2017-10-10 20:24:47', 2),
(5, 'black', '2017-10-10 20:29:56', 2),
(6, 'black', '2017-10-10 20:30:04', 2),
(7, 'black', '2017-10-10 20:30:54', 2),
(8, 'black', '2017-10-10 20:31:16', 2),
(9, 'black', '2017-10-10 20:31:23', 2),
(10, 'black', '2017-10-10 20:31:37', 2),
(11, 'black', '2017-10-10 20:31:48', 2),
(12, 'black', '2017-10-10 20:31:59', 2),
(13, 'black', '2017-10-10 20:32:04', 2),
(14, 'black', '2017-10-10 20:32:19', 2),
(15, 'black', '2017-10-10 20:37:27', 2),
(16, 'black', '2017-10-10 20:38:05', 2),
(17, 'black', '2017-10-10 20:40:40', 2),
(18, 'black', '2017-10-10 20:41:32', 2),
(19, 'black', '2017-10-10 20:41:50', 2),
(20, 'black', '2017-10-10 20:41:58', 2),
(21, 'black', '2017-10-10 20:42:05', 2),
(22, 'black', '2017-10-10 20:42:11', 2),
(23, 'black', '2017-10-10 20:42:19', 2),
(24, 'black', '2017-10-10 20:42:27', 2),
(25, 'black', '2017-10-10 20:49:43', 2),
(26, 'black', '2017-10-10 20:50:47', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `cash` decimal(16,2) NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `cash`, `status`) VALUES
(1, 'caremico', '$2y$10$gL0ncYR3/UyFdXqutd/3vuQbxu5xr7zmkZlxd6BUQ6cOwNXC1Dwo2', '9200.00', b'1'),
(2, 'starchaser', '$2y$10$1ihERPXClMdgeK8jGsRDd.z9Ky3T1LdXf.aX2Rrszc82/McsFL4Tu', '20401.98', b'1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bet`
--
ALTER TABLE `bet`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bet`
--
ALTER TABLE `bet`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `game`
--
ALTER TABLE `game`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
