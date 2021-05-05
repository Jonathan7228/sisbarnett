-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2017 a las 04:02:24
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_sisbarnett`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `intId` int(10) UNSIGNED NOT NULL,
  `txtTypePerson` varchar(20) NOT NULL,
  `txtTypeDocument` varchar(10) NOT NULL,
  `txtDocument` varchar(20) NOT NULL,
  `txtFirtsName` varchar(100) NOT NULL,
  `txtSecondName` varchar(100) NOT NULL,
  `txtLastName` varchar(100) NOT NULL,
  `txtSecondLastName` varchar(100) NOT NULL,
  `txtaddress` varchar(100) NOT NULL,
  `txtCity` varchar(100) NOT NULL,
  `txtPhone` varchar(20) NOT NULL,
  `txtCelPhone` varchar(20) NOT NULL,
  `txtEmail` varchar(100) NOT NULL,
  `txtObservation` text NOT NULL,
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intState` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `intId` int(10) UNSIGNED NOT NULL,
  `intIdProduct` int(10) UNSIGNED NOT NULL,
  `intQuantity` int(10) NOT NULL,
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_logcustomer`
--

CREATE TABLE `tbl_logcustomer` (
  `intId` int(10) UNSIGNED NOT NULL,
  `txtDocumentUser` varchar(50) NOT NULL,
  `txtNameUser` varchar(100) NOT NULL,
  `txtDocumentCustomer` varchar(50) NOT NULL,
  `txtFirtsName` varchar(100) NOT NULL,
  `txtSecondName` varchar(100) NOT NULL,
  `txtLastName` varchar(100) NOT NULL,
  `txtSecondLastName` varchar(100) NOT NULL,
  `txtDescription` varchar(100) NOT NULL,
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_loginventory`
--

CREATE TABLE `tbl_loginventory` (
  `intId` int(10) UNSIGNED NOT NULL,
  `txtDocumentUser` varchar(50) NOT NULL,
  `txtNameUser` varchar(100) NOT NULL,
  `txtCodProduct` varchar(100) NOT NULL,
  `txtDescriptionProduct` varchar(100) NOT NULL,
  `intQuantity` int(10) NOT NULL,
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_logorder`
--

CREATE TABLE `tbl_logorder` (
  `intId` int(10) UNSIGNED NOT NULL,
  `txtDocumentUser` varchar(50) NOT NULL,
  `txtNameUser` varchar(100) NOT NULL,
  `intIdOrder` int(10) UNSIGNED NOT NULL,
  `txtDescription` varchar(100) NOT NULL,
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_logproduct`
--

CREATE TABLE `tbl_logproduct` (
  `intId` int(10) UNSIGNED NOT NULL,
  `txtDocumentUser` varchar(50) NOT NULL,
  `txtNameUser` varchar(100) NOT NULL,
  `txtCod` varchar(50) NOT NULL,
  `txtNameProduct` varchar(100) NOT NULL,
  `dbValue` double NOT NULL,
  `txtDescription` varchar(100) NOT NULL,
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `intId` int(10) UNSIGNED NOT NULL,
  `intIdUser` int(10) UNSIGNED NOT NULL,
  `txtModule` varchar(50) NOT NULL,
  `txtAction` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL,
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_loguser`
--

CREATE TABLE `tbl_loguser` (
  `intId` int(10) UNSIGNED NOT NULL,
  `txtDocumentUser` varchar(50) NOT NULL,
  `txtNameUser` varchar(100) NOT NULL,
  `txtDocument` varchar(50) NOT NULL,
  `txtName` varchar(100) NOT NULL,
  `txtDescription` varchar(100) NOT NULL,
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_loguser`
--

INSERT INTO `tbl_loguser` (`intId`, `txtDocumentUser`, `txtNameUser`, `txtDocument`, `txtName`, `txtDescription`, `tmpDate`) VALUES
(1, '1037588710', 'JONATHAN BEDOYA MOSCOSO', '123456789', 'FRACTTAL', 'CREACION USUARIO', '2017-12-15 02:14:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_order`
--

CREATE TABLE `tbl_order` (
  `intId` int(10) UNSIGNED NOT NULL,
  `intIdCustomer` int(10) UNSIGNED NOT NULL,
  `dbTotal` double NOT NULL,
  `txtObservation` text NOT NULL,
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intState` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_product`
--

CREATE TABLE `tbl_product` (
  `intId` int(10) UNSIGNED NOT NULL,
  `txtCod` varchar(100) NOT NULL,
  `txtDescription` varchar(100) NOT NULL,
  `dbValue` double NOT NULL,
  `txtObservation` text NOT NULL,
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intState` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_products_order`
--

CREATE TABLE `tbl_products_order` (
  `intId` int(10) UNSIGNED NOT NULL,
  `intIdOrder` int(10) UNSIGNED NOT NULL,
  `intIdProduct` int(10) UNSIGNED NOT NULL,
  `intQuantity` double NOT NULL,
  `dbSubtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_temp_prod_order`
--

CREATE TABLE `tbl_temp_prod_order` (
  `intId` int(10) UNSIGNED NOT NULL,
  `intIdCustomer` int(11) NOT NULL,
  `intIdProduct` int(11) NOT NULL,
  `tmpDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_users`
--

CREATE TABLE `tbl_users` (
  `intId` int(10) UNSIGNED NOT NULL,
  `intProfile` int(1) NOT NULL,
  `txtDocument` varchar(20) NOT NULL,
  `txtName` varchar(100) NOT NULL,
  `txtPassword` varchar(100) NOT NULL,
  `intStatus` int(1) NOT NULL DEFAULT '1',
  `tmpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_users`
--

INSERT INTO `tbl_users` (`intId`, `intProfile`, `txtDocument`, `txtName`, `txtPassword`, `intStatus`, `tmpDate`) VALUES
(1, 1, '1037588710', 'JONATHAN BEDOYA MOSCOSO', '99ce4a08446039df1756068f8a5fe585', 1, '2015-09-17 22:03:28'),
(2, 1, '123456789', 'FRACTTAL', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2017-12-15 02:14:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_logcustomer`
--
ALTER TABLE `tbl_logcustomer`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_loginventory`
--
ALTER TABLE `tbl_loginventory`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_logorder`
--
ALTER TABLE `tbl_logorder`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_logproduct`
--
ALTER TABLE `tbl_logproduct`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_loguser`
--
ALTER TABLE `tbl_loguser`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_products_order`
--
ALTER TABLE `tbl_products_order`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_temp_prod_order`
--
ALTER TABLE `tbl_temp_prod_order`
  ADD PRIMARY KEY (`intId`);

--
-- Indices de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`intId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_logcustomer`
--
ALTER TABLE `tbl_logcustomer`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_loginventory`
--
ALTER TABLE `tbl_loginventory`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_logorder`
--
ALTER TABLE `tbl_logorder`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_logproduct`
--
ALTER TABLE `tbl_logproduct`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_loguser`
--
ALTER TABLE `tbl_loguser`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_products_order`
--
ALTER TABLE `tbl_products_order`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_temp_prod_order`
--
ALTER TABLE `tbl_temp_prod_order`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `intId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
