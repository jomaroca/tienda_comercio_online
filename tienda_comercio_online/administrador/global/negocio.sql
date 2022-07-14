-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2022 a las 17:21:25
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `negocio`
--
CREATE DATABASE IF NOT EXISTS `negocio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `negocio`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `ID` int(11) NOT NULL,
  `Id_venta` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Precio` decimal(20,2) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Precio` decimal(20,2) NOT NULL,
  `Descripcion` text NOT NULL,
  `Imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `Nombre`, `Precio`, `Descripcion`, `Imagen`) VALUES
(1, 'Learn PHP 7', '25.00', 'This new book on PHP 7 introduces writing solid, secure, object-oriented code in the new PHP 7: you will create a complete three-tier application using a natural process of building and testing modules within each tier. This practical approach teaches you about app development and introduces PHP features when they are actually needed rather than providing you with abstract theory and contrived examples.', '9781484217290.jpg'),
(2, 'ASP.NET MVC 5 ', '30.50', 'MVC 5 is the newest update to the popular Microsoft technology that enables you to build dynamic, data-driven websites. Like previous versions, this guide shows you step-by-step techniques on using MVC to best advantage, with plenty of practical tutorials to illustrate the concepts. It covers controllers, views, and models; forms and HTML helpers; data annotation and validation; membership, authorization, and security.', '51u-ERS1W8L._SX396_BO1,204,203,200_.jpg'),
(3, 'Learning Vue.js 2', '29.95', 'Learn how to propagate DOM changes across the website without writing extensive jQuery callbacks code.\r\nLearn how to achieve reactivity and easily compose views with Vue.js and understand what it does behind the scenes.\r\nExplore the core features of Vue.js with small examples, learn how to build dynamic content into preexisting web applications, and build Vue.js applications from scratch.\r\n', '9781786469946.jpg'),
(4, 'Laravel 8', '25.50', 'There are many proven code rich recipes for working with Laravel. Each recipe includes practical advice, tips, and tricks for working with jQuery, AJAX, JSON, API, data persistence, complex application structure, modular PHP, testing, deployment and more. Think about this book as a collection of all premium Laravel tutorials or the successor to the popular Learning Laravel 5 book. Laravel also includes tested code that you can download and reuse in your own applications. You’ll save time, learn more about Laravel and other related technologies in the process.', '41R3f1PUlEL.jpg'),
(5, 'Clean JavaScript', '29.95', 'JavaScript has become one of the most used languages in the world, it is found in critical infrastructures of very important companies (Facebook, Netflix or Uber use it). For this reason, the need to write code of higher quality and readability has become indispensable. As developers, we usually write code without the explicit intention that it will be understood by another person, since we usually focus simply on implementing a solution that works and solves the problem. Most of the time, trying to understand someone else\'s code or even the one we wrote ourselves just a few weeks ago can become a really difficult task.', '1657117814_41D1h-no8LL._SX404_BO1,204,203,200_.jpg'),
(6, 'Core Java', '40.00', 'The 1 Java Guide for Serious Programmers: Fully Updated through Java 17 Core Java, Volume I: Fundamentals, Twelfth Edition, is the definitive guide to writing robust, maintainable code. Whatever version of Java you are using up to and including Java 17 this book will help you achieve a deep and practical understanding of the language and APIs. With hundreds of realistic examples, Cay S. Horstmann reveals the most powerful and effective ways to get the job done. This book is written for readers with prior programming experience who are looking for in-depth coverage of the Java language and platform. You\'ll learn about all language features in detail, including the recent improvements in Java 17. The applied chapters and code examples cover the most up to date capabilities of the vast Java library.', '1657118168_91G5VFAUKVL._AC_UL320_.jpg'),
(7, 'Expert Angular', '25.50', 'Angular is a mature technology, and you\'ll likely have applications built with earlier versions. This book starts by showing you best practices and approaches to migrating your existing Angular applications so that you can be immediately up-to-date. You will take an in-depth look at components and see how to control the user journey in your applications by implementing routing and navigation. You will learn how to work with asynchronous programming by using Observables. To easily build applications that look great, you will learn all about template syntax and how to beautify applications with Material Design. Mastering forms and data binding will further speed up your application development time. Learning about managing services and animations will help you to progressively enhance your applications. Next you\'ll use native directives to integrate Bootstrap with Angular.', '1657118766_41X6GletI3L._SX404_BO1,204,203,200_.jpg'),
(8, 'Learning Node.js', '30.50', 'Learning Node.js Development is a practical, project-based book that provides you with all you need to get started as a Node.js developer. Node is a ubiquitous technology on the modern web, and an essential part of any web developers\' toolkit. If you are looking to create real-world Node applications, or you want to switch careers or launch a side project to generate some extra income, then you\'re in the right place. This book has been written around a single goal—turning you into a professional Node developer capable of developing, testing, and deploying real-world production applications. Learning Node.js Development is built from the ground up around the latest version of Node.js (version 9.x.x). You\'ll be learning all the cutting-edge features available only in the latest software versions.', '1657118957_41NGBmeH1uL._SX403_BO1,204,203,200_.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID` int(11) NOT NULL,
  `ClaveTransaccion` varchar(250) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Nombre` varchar(250) NOT NULL,
  `Direccion` varchar(250) NOT NULL,
  `Correo` varchar(250) NOT NULL,
  `Total` decimal(60,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Id_venta` (`Id_venta`),
  ADD KEY `Id_producto` (`Id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`Id_producto`) REFERENCES `productos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`Id_venta`) REFERENCES `ventas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
