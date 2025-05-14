-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-05-2025 a las 15:37:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fechaCaptura` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_producto`, `id_categoria`, `id_imagen`, `id_usuario`, `nombre`, `descripcion`, `cantidad`, `precio`, `fechaCaptura`) VALUES
(2, 3, 2, 1, 'Cerveza Paceña Roja 330 ml', 'Cerveza hecha por CBN en presentación única por carnavales', 10, 10, '2025-03-17'),
(3, 1, 3, 1, 'Cerveza Huari 440 ml', 'Cerveza Huari presentación en lata con tono dorado', 24, 11, '2025-03-17'),
(4, 1, 4, 1, 'Cerveza Burguesa 473 ml', 'Cerveza en lata con mayor cantidad diseñada para el disfrute del público por carnavales', 42, 10, '2025-03-17'),
(5, 1, 5, 1, 'Cerveza Amstel Lager 473 ml', 'Cerveza en Lata de origen español con un sabor clásico y fabricada con ingredientes de alta calidad', 30, 10, '2025-03-17'),
(6, 1, 6, 1, 'Cerveza Paceña Botella 710 ml', 'Cerveza tradicional en presentación botella de vidrio para un público amante de lo tradicional', 120, 16, '2025-03-17'),
(7, 1, 7, 1, 'Cerveza Corona 355 ml', 'Cerveza en botella con una presentación moderna de alta calidad diseñada para un público joven ', 24, 12, '2025-03-17'),
(8, 1, 8, 1, 'Cerveza Huari Botella 710 ml', 'Cerveza en botella con sabor tradicional. Diseñada para mayor capacidad del producto', 240, 18, '2025-03-17'),
(9, 3, 9, 1, 'Whisky Johnnie Walker Gold Label 750 ml', 'Whisky añejado 10 años de alta calidad', 2, 700, '2025-03-17'),
(10, 3, 10, 1, 'Whiscky Johnnie Walker Black Label 750 ml', 'Whisky de alta calidad presentación elegante y distintiva.', 3, 380, '2025-03-17'),
(11, 3, 11, 1, 'Whisky Jhonnie Walker Red Label 750 ml', 'Whisky de calidad.', 5, 150, '2025-03-17'),
(14, 3, 14, 1, 'Whisky Johnnie Walker Double Black 750 ml', 'Whisky añejado en presentación llamativa con mayor cantidad', 20, 400, '2025-03-17'),
(15, 3, 15, 1, 'Whisky Jack Daniel S 750 ml', 'Whisky de alta calidad para un público amante de sabores tradicionales', 1, 250, '2025-03-17'),
(16, 3, 16, 1, 'Whisky Jack Daniels Tennesee Honey 750 ml', 'Presentación sabor a miel', 1, 280, '2025-03-17'),
(18, 3, 18, 1, 'Whisky Chanceler Golden Label 1 L', 'Whisky Chanceler versión premium con sabor tradicional', 22, 60, '2025-03-17'),
(19, 3, 19, 1, 'Whisky Añejo Doble V 1 L', 'Whisky Añejo presentación elegante', 3, 50, '2025-03-17'),
(20, 6, 20, 1, 'Pepsi', '600 ml', 55, 6.5, '2025-03-20'),
(26, 0, 26, 1, '456&&//**/-/', 'bgkjrhgk5ehu', 56, 32, '2025-04-07'),
(27, 0, 27, 1, '456&&//**/-/', 'bgkjrhgk5ehu', 56, 32, '2025-04-07'),
(39, 15, 39, 2, 'gfdiogf', 'ki23234', 99, 567.9, '2025-04-09'),
(40, 2, 40, 2, 'tres plumas', 'es rico', 54, 10.5, '2025-04-09'),
(41, 16, 41, 2, 'pepsi', 'rica', 50, 13, '2025-04-09'),
(42, 16, 42, 2, 'Pepsi', 'nfeifnin', 51, 58, '2025-04-09'),
(43, 16, 43, 2, 'Cocaquina', 'moireofkjvoif', 45, 155, '2025-04-09'),
(44, 17, 44, 2, 'Lices', 'Economico pequeo nnnnnnnnnnnnnnnnnnnnnnnn nnnnnnnn', 0, 7899, '2025-04-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombreCategoria` varchar(150) DEFAULT NULL,
  `fechaCaptura` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `id_usuario`, `nombreCategoria`, `fechaCaptura`) VALUES
(1, 1, 'Cerveza', '2025-03-17'),
(2, 1, 'Vodka', '2025-03-17'),
(3, 1, 'Whisky', '2025-03-17'),
(4, 1, 'Cigarrillos', '2025-03-17'),
(5, 1, 'Ron', '2025-03-17'),
(6, 1, 'Gaseosas', '2025-03-17'),
(7, 1, 'Vinos', '2025-03-17'),
(8, 1, 'Otros', '2025-03-17'),
(13, 2, 'Oporto', '2025-04-08'),
(15, 2, 'khnhu', '2025-04-09'),
(17, 2, 'papitas', '2025-04-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `apellido` varchar(200) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefono` varchar(200) DEFAULT NULL,
  `rfc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `id_usuario`, `nombre`, `apellido`, `direccion`, `email`, `telefono`, `rfc`) VALUES
(2, 1, 'Brenda', 'Castro', 'Satelite', 'brenda@gmail.com', '70084542', 'Casada'),
(28, 2, 'joan', 'laporta', 'av cuba', 'Laporta225@gmail.com', '77710998', 'VIP'),
(31, 2, 'Brenda', 'Castro', 'Brendacastro', 'Brenda@gmail.comm', '65568062', 'estudiante'),
(32, 2, 'brenda', 'casro', 'av argentina', 'brenf@gmail.com', '95959595', 'gningiud55'),
(33, 2, 'Mario', 'sil', 'calle 4', 'ad@gmail.com', '22365921', '1233');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_imagen` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(500) DEFAULT NULL,
  `ruta` varchar(500) DEFAULT NULL,
  `fechaSubida` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_imagen`, `id_categoria`, `nombre`, `ruta`, `fechaSubida`) VALUES
(2, 1, 'cerveza paceña lata.jpg', '../../archivos/cerveza paceña lata.jpg', '2025-03-17'),
(3, 1, 'cerveza huari lata.jpg', '../../archivos/cerveza huari lata.jpg', '2025-03-17'),
(4, 1, 'cerveza burguesa lata.jpg', '../../archivos/cerveza burguesa lata.jpg', '2025-03-17'),
(5, 1, 'cerveza amstel lager lata.jpg', '../../archivos/cerveza amstel lager lata.jpg', '2025-03-17'),
(6, 1, 'cerveza paceña botella.jpg', '../../archivos/cerveza paceña botella.jpg', '2025-03-17'),
(7, 1, 'cerveza corona botella.jpg', '../../archivos/cerveza corona botella.jpg', '2025-03-17'),
(8, 1, 'cerveza huari botella.jpg', '../../archivos/cerveza huari botella.jpg', '2025-03-17'),
(9, 3, 'whisky johnnie walker gold label.jpg', '../../archivos/whisky johnnie walker gold label.jpg', '2025-03-17'),
(10, 3, 'whisky johnnie walker black label.jpg', '../../archivos/whisky johnnie walker black label.jpg', '2025-03-17'),
(11, 3, 'whisky johnnie walker red label.jpg', '../../archivos/whisky johnnie walker red label.jpg', '2025-03-17'),
(14, 3, 'whisky johnnie walker double black 2.jpg', '../../archivos/whisky johnnie walker double black 2.jpg', '2025-03-17'),
(15, 3, 'whisky jack daniels.jpg', '../../archivos/whisky jack daniels.jpg', '2025-03-17'),
(16, 3, 'whisky jack daniels honey.jpg', '../../archivos/whisky jack daniels honey.jpg', '2025-03-17'),
(18, 3, 'whisky chanceler.jpg', '../../archivos/whisky chanceler.jpg', '2025-03-17'),
(19, 3, 'whisky doble v.jpg', '../../archivos/whisky doble v.jpg', '2025-03-17'),
(20, 6, 'Pepsi.webp', '../../archivos/Pepsi.webp', '2025-03-20'),
(26, 0, 'Captura de pantalla 2025-04-02 232941.png', '../../archivos/Captura de pantalla 2025-04-02 232941.png', '2025-04-07'),
(27, 0, 'Captura de pantalla 2025-04-02 232941.png', '../../archivos/Captura de pantalla 2025-04-02 232941.png', '2025-04-07'),
(39, 15, 'cerveza amstel lager lata.jpg', '../../archivos/cerveza amstel lager lata.jpg', '2025-04-09'),
(40, 2, 'whisky johnnie walker red label.jpg', '../../archivos/whisky johnnie walker red label.jpg', '2025-04-09'),
(41, 16, 'coca.jpg', '../../archivos/coca.jpg', '2025-04-09'),
(42, 16, 'Pepsi.webp', '../../archivos/Pepsi.webp', '2025-04-09'),
(43, 16, 'cerveza burguesa lata.jpg', '../../archivos/cerveza burguesa lata.jpg', '2025-04-09'),
(44, 17, 'Pepsi.webp', '../../archivos/Pepsi.webp', '2025-04-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` tinytext DEFAULT NULL,
  `fechaCaptura` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `password`, `fechaCaptura`) VALUES
(2, 'admin', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2025-04-07'),
(3, 'Brenda', 'Chipana', 'BrendaC', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2025-04-07'),
(4, 'johan', 'barrionuevo', 'JC055', '1261c906fa68de728f685ef0fd7e63b365799017', '2025-04-10'),
(5, 'juan nnnnnnnnnnnnnnnnnnnnnnnnn', 'nmmmmmmmmmmmm mmmmmmm', 'ana 1222', '9c1c01dc3ac1445a500251fc34a15d3e75a849df', '2025-04-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `fechaCompra` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_cliente`, `id_producto`, `id_usuario`, `precio`, `fechaCompra`) VALUES
(1, 0, 20, 1, 12, '2025-03-20'),
(1, 0, 20, 1, 12, '2025-03-20'),
(1, 0, 20, 1, 12, '2025-03-20'),
(1, 0, 20, 1, 12, '2025-03-20'),
(1, 0, 20, 1, 12, '2025-03-20'),
(1, 0, 20, 1, 12, '2025-03-20'),
(1, 0, 20, 1, 12, '2025-03-20'),
(1, 1, 20, 1, 12, '2025-03-20'),
(2, 1, 20, 1, 12, '2025-03-20'),
(3, 1, 20, 1, 12, '2025-03-20'),
(4, 1, 20, 1, 12, '2025-03-20'),
(4, 1, 20, 1, 12, '2025-03-20'),
(5, 1, 2, 1, 10, '2025-03-20'),
(6, 2, 3, 2, 11, '2025-04-07'),
(7, 2, 2, 2, 10, '2025-04-08'),
(7, 2, 2, 2, 10, '2025-04-08'),
(7, 2, 2, 2, 10, '2025-04-08'),
(7, 2, 2, 2, 10, '2025-04-08'),
(7, 2, 2, 2, 10, '2025-04-08'),
(7, 2, 2, 2, 10, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(8, 0, 3, 2, 11, '2025-04-08'),
(9, 0, 3, 2, 11, '2025-04-09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
