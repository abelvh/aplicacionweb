-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2015 at 09:45 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id_cliente` int(11) NOT NULL,
  `telefono` int(9) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `nif` varchar(9) DEFAULT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `clave` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `telefono`, `nombre`, `nif`, `direccion`, `clave`, `email`) VALUES
(0, 0, 'Administrador', '0', '0', 'abc123.', 'administrador@pizzeria.com'),
(1, 984523674, 'Antonio', '3333', 'Postas,10', '3333', 'antoniols@gmail.com'),
(2, 954712654, 'Domenico', '1123', 'Valeras,22', '1234', 'domen43@gmail.com'),
(3, 987563214, 'Juan', '2222', 'Rey,22', '2222', 'juands@gmail.com'),
(4, 4, 'alba', '4', '4', 'abc123.', 'alvaalcalde@gmail.com'),
(5, 0, 'jhkjh', 'jknj', 'jnjkn', 'jnjk', 'holamundo@gmail.com'),
(6, 0, 'jhl', 'dafda', 'dfa', 'dff', 'dsafsa@gmail.com'),
(7, 11111, 'manuekl', '353535', 'por alla', '123abc.', 'manu@manu.es');

-- --------------------------------------------------------

--
-- Table structure for table `ingredientes`
--

CREATE TABLE IF NOT EXISTS `ingredientes` (
  `nombreIng` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL DEFAULT '',
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredientes`
--

INSERT INTO `ingredientes` (`nombreIng`, `descripcion`, `imagen`) VALUES
('Aceitunas', 'Verdes y negras', 'acei.png'),
('Cebolla', 'De la abuela Carmen', 'ceb.png'),
('ChampiÃ±ones', 'de los montes', 'champi.png'),
('edgsdg', 'dgad', 'queso.png'),
('Mozzarela', 'Italiana', 'moz.png'),
('Pepinillo', 'de los montes', 'pepino.png'),
('PiÃ±a', 'Americana', 'pi.png'),
('Pimientos', 'de los montes', 'hort.png'),
('Queso', 'De Arzua', 'queso.png');

-- --------------------------------------------------------

--
-- Table structure for table `masas`
--

CREATE TABLE IF NOT EXISTS `masas` (
`idMasa` tinyint(4) NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `masas`
--

INSERT INTO `masas` (`idMasa`, `descripcion`, `precio`) VALUES
(1, 'fdsfhsh', '12.00'),
(3, 'Masa rellena de queso', '11.00'),
(33, 'm1', '99.99'),
(34, 'm2', '88.00');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
`idPedido` int(4) NOT NULL,
  `idMasa` tinyint(4) NOT NULL DEFAULT '1',
  `numIng` tinyint(4) NOT NULL DEFAULT '4',
  `ingredientes` varchar(100) DEFAULT NULL,
  `tamano` decimal(3,2) NOT NULL DEFAULT '1.00',
  `unidades` tinyint(4) NOT NULL DEFAULT '1',
  `entrega` varchar(50) NOT NULL,
  `formaPago` varchar(30) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `hora` time NOT NULL DEFAULT '10:00:00',
  `id_cliente` int(11) DEFAULT NULL,
  `total` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla de pedidos' AUTO_INCREMENT=129 ;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idMasa`, `numIng`, `ingredientes`, `tamano`, `unidades`, `entrega`, `formaPago`, `fecha`, `hora`, `id_cliente`, `total`) VALUES
(107, 3, 2, 'bacon,cebolla', '0.50', 4, 'Valeras,22', 'efectivo', '11/06/2015', '21:00:00', 2, '44'),
(108, 1, 6, 'bacon,cebolla,jamon,mozarella,pimiento,tomate', '0.75', 4, 'En el local', 'efectivo', '12/04/2015', '20:30:00', 3, '40'),
(109, 3, 1, 'atun', '0.50', 1, 'En el local', 'efectivo', '12/08/2014', '00:00:00', 4, '11'),
(110, 3, 1, 'aceitunas', '0.75', 5, '4', 'tarjeta', '12/05/2015', '00:00:00', 4, '55'),
(111, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '14/12/2015', '00:00:00', 4, '55'),
(112, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '14/12/2015', '00:00:00', 4, '55'),
(113, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '55'),
(114, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '55'),
(115, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '55'),
(116, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '55'),
(117, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '55'),
(118, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '55'),
(119, 1, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '50'),
(120, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '55'),
(121, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '55'),
(122, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 5, '55'),
(123, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '55'),
(124, 3, 1, 'aceitunas', '0.50', 5, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '55'),
(125, 3, 1, 'aceitunas', '0.50', 3, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '33'),
(126, 3, 1, 'queso', '0.50', 2, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '22'),
(127, 3, 3, 'aceitunas,cebolla,champiÃƒÂ±ones', '1.00', 2, 'En el local', 'efectivo', '12/12/2015', '00:00:00', 4, '22'),
(128, 3, 1, 'aceitunas', '1.00', 1, 'En el local', 'efectivo', '02/06/2015', '12:00:00', 7, '11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `ingredientes`
--
ALTER TABLE `ingredientes`
 ADD PRIMARY KEY (`nombreIng`);

--
-- Indexes for table `masas`
--
ALTER TABLE `masas`
 ADD PRIMARY KEY (`idMasa`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
 ADD PRIMARY KEY (`idPedido`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `masas`
--
ALTER TABLE `masas`
MODIFY `idMasa` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
MODIFY `idPedido` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=129;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
