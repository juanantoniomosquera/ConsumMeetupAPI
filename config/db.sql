-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-02-2018 a las 18:00:45
-- Versión del servidor: 5.5.59
-- Versión de PHP: 5.4.45-0+deb7u12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `meetup`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rsvps`
--

CREATE TABLE IF NOT EXISTS `rsvps` (
  `rsvp_id` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `event_id` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `event_name` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `event_time` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `event_url` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `guests` int(10) NOT NULL,
  `group_id` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `group_name` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `group_city` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `group_country` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `group_lon` decimal(10,2) NOT NULL,
  `group_lat` decimal(10,2) NOT NULL,
  `member_id` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `member_name` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`rsvp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
