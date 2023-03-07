-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2023 a las 16:56:42
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
-- Base de datos: `agency1`
--

CREATE DATABASE IF NOT EXISTS agency;

USE agency;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cpu_category`
--

CREATE TABLE `cpu_category` (
  `id_category` tinyint(4) NOT NULL,
  `category` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cpu_category`
--

INSERT INTO `cpu_category` (`id_category`, `category`) VALUES
(1, 'Laptops'),
(2, 'Monitores'),
(3, 'Tablets');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cpu_comment`
--

CREATE TABLE `cpu_comment` (
  `id_comment` smallint(6) NOT NULL,
  `id_product` smallint(6) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `name` varchar(20) NOT NULL,
  `score` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cpu_product`
--

CREATE TABLE `cpu_product` (
  `id_product` smallint(6) NOT NULL,
  `id_subcategory` tinyint(4) NOT NULL,
  `model` varchar(60) NOT NULL,
  `specification` varchar(300) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(30) NOT NULL,
  `registration_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  `likes` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cpu_subcategory`
--

CREATE TABLE `cpu_subcategory` (
  `id_subcategory` tinyint(4) NOT NULL,
  `id_category` tinyint(4) NOT NULL,
  `subcategory` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cpu_subcategory`
--

INSERT INTO `cpu_subcategory` (`id_subcategory`, `id_category`, `subcategory`) VALUES
(1, 1, 'HP'),
(2, 1, 'DELL'),
(3, 1, 'Lenovo'),
(4, 1, 'ASUS'),
(5, 2, 'LG'),
(6, 2, 'Samsung'),
(9, 2, 'ACER'),
(10, 2, 'Q-TOUCH'),
(11, 3, 'TECLAST'),
(12, 3, 'GHIA'),
(13, 3, 'VORAGO'),
(14, 3, 'Xiaoxin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cpu_category`
--
ALTER TABLE `cpu_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `cpu_comment`
--
ALTER TABLE `cpu_comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `comment - product` (`id_product`);

--
-- Indices de la tabla `cpu_product`
--
ALTER TABLE `cpu_product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `product - category` (`id_subcategory`);

--
-- Indices de la tabla `cpu_subcategory`
--
ALTER TABLE `cpu_subcategory`
  ADD PRIMARY KEY (`id_subcategory`),
  ADD KEY `subcategory - category` (`id_category`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cpu_category`
--
ALTER TABLE `cpu_category`
  MODIFY `id_category` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cpu_comment`
--
ALTER TABLE `cpu_comment`
  MODIFY `id_comment` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cpu_product`
--
ALTER TABLE `cpu_product`
  MODIFY `id_product` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cpu_subcategory`
--
ALTER TABLE `cpu_subcategory`
  MODIFY `id_subcategory` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cpu_comment`
--
ALTER TABLE `cpu_comment`
  ADD CONSTRAINT `comment - product` FOREIGN KEY (`id_product`) REFERENCES `cpu_product` (`id_product`);

--
-- Filtros para la tabla `cpu_subcategory`
--
ALTER TABLE `cpu_subcategory`
  ADD CONSTRAINT `subcategory - category` FOREIGN KEY (`id_category`) REFERENCES `cpu_category` (`id_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
