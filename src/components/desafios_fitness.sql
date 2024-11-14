-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2024 a las 21:42:46
-- Versión del servidor: 11.4.2-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `desafios_fitness`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desafios`
--

CREATE TABLE `desafios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `duracion_dias` int(11) NOT NULL,
  `etapas` int(11) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `desafios`
--

INSERT INTO `desafios` (`id`, `user_id`, `titulo`, `descripcion`, `duracion_dias`, `etapas`, `imagen_url`, `created_at`) VALUES
(1, 1, 'Desafio para Titulares', NULL, 1, 2, 'runing.webp', '2024-11-13 19:58:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desafio_etapas`
--

CREATE TABLE `desafio_etapas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desafio_id` bigint(20) UNSIGNED NOT NULL,
  `titulo_etapa` varchar(255) NOT NULL,
  `descripcion_etapa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `desafio_etapas`
--

INSERT INTO `desafio_etapas` (`id`, `desafio_id`, `titulo_etapa`, `descripcion_etapa`) VALUES
(1, 1, 'Desarrollo', 'holaaa'),
(2, 1, 'Desarrollo', 'holaaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'fire', 'yoyo@gmail.com', '$2y$10$O6RvVUUBz.Okl0nddNcR..rrXC5zuwme6x7K8Q29NobqAplGmLqpS', '2024-11-13 15:02:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `desafios`
--
ALTER TABLE `desafios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `desafio_etapas`
--
ALTER TABLE `desafio_etapas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desafio_id` (`desafio_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `desafios`
--
ALTER TABLE `desafios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `desafio_etapas`
--
ALTER TABLE `desafio_etapas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `desafios`
--
ALTER TABLE `desafios`
  ADD CONSTRAINT `desafios_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `desafio_etapas`
--
ALTER TABLE `desafio_etapas`
  ADD CONSTRAINT `desafio_etapas_ibfk_1` FOREIGN KEY (`desafio_id`) REFERENCES `desafios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
