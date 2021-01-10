-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2021 at 03:34 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telefonos`
--

-- --------------------------------------------------------

--
-- Table structure for table `atributos`
--

CREATE TABLE `atributos` (
  `id` int(11) NOT NULL,
  `Marca` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `noserie` varchar(10) DEFAULT NULL,
  `costo` float NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `rutaimagen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `carrito`
--

CREATE TABLE `carrito` (
  `Id` int(16) NOT NULL,
  `token` varchar(45) NOT NULL,
  `id_atributo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `userId` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `paswword` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`userId`, `usuario`, `paswword`, `estado`) VALUES
(1, 'usuario1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(2, 'usuario2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(3, 'usuario3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(4, 'usuario4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(5, 'usuario5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(6, 'usuario6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(7, 'usuario7@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo'),
(8, 'usuario8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo'),
(9, 'usuario9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Inactivo'),
(10, 'anhel@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(11, 'anhel@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(12, 'anhel456@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo'),
(21, 'angelgarcia@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_token`
--

CREATE TABLE `usuarios_token` (
  `TokenId` int(11) NOT NULL,
  `userId` varchar(45) DEFAULT NULL,
  `token` varchar(45) DEFAULT NULL,
  `estado` varchar(45) CHARACTER SET armscii8 DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios_token`
--

INSERT INTO `usuarios_token` (`TokenId`, `userId`, `token`, `estado`, `fecha`) VALUES
(1, '1', '8b3d895e327b8e3f8c7d8ee5650fe6dd', 'Activo', '2020-11-19 00:16:00'),
(2, '2', 'c6e126ac7f94054475297ec3cdd9df0a', 'Activo', '2020-11-19 00:19:00'),
(3, '1', 'd1f4b3def0bfa62de13b8bf1a5a6b67c', 'Activo', '2020-12-10 02:41:00'),
(4, '1', '01f76e15238a2aedc1222e6acd1901e8', 'Activo', '2020-12-10 03:09:00'),
(5, '1', '5d9ed2b7e5b16b21ddd82d05dc514e2d', 'Activo', '2020-12-10 03:12:00'),
(6, '1', '491d19c3798950f322089b8b995d14e1', 'Activo', '2020-12-10 03:13:00'),
(7, '1', 'e7bd748cf61fe273cad8b3773561c93c', 'Activo', '2020-12-10 03:19:00'),
(8, '1', '721a51fb1d6a71fd726db1954a855f6a', 'Activo', '2020-12-10 03:24:00'),
(9, '1', '5de513bb5d1adee1f7dd0c1dd2d6010a', 'Activo', '2020-12-16 01:02:00'),
(10, '1', '5ef4a46c6d725b95ac469c1c1bbc5a76', 'Activo', '2020-12-16 01:03:00'),
(11, '1', '44c8c7a7434da3208a358327351b25e0', 'Activo', '2020-12-16 01:09:00'),
(12, '1', '5de020c8cd93186916c9b2c03b386943', 'Activo', '2020-12-16 01:12:00'),
(13, '1', 'cf37e3b551fa69a6961b0924ac2e789e', 'Activo', '2020-12-16 01:39:00'),
(14, '1', 'cb8811e754a830d2b34a07f1a0909472', 'Activo', '2020-12-16 01:40:00'),
(15, '1', '835db1c1414ed8e23571136fdc87b2c3', 'Activo', '2021-01-06 22:03:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atributos`
--
ALTER TABLE `atributos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Token` (`token`),
  ADD KEY `Id_Prod` (`id_atributo`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `usuarios_token`
--
ALTER TABLE `usuarios_token`
  ADD PRIMARY KEY (`TokenId`),
  ADD UNIQUE KEY `token` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atributos`
--
ALTER TABLE `atributos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carrito`
--
ALTER TABLE `carrito`
  MODIFY `Id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `usuarios_token`
--
ALTER TABLE `usuarios_token`
  MODIFY `TokenId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `Id_Prod` FOREIGN KEY (`id_atributo`) REFERENCES `atributos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
