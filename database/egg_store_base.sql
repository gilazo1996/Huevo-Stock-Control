-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-08-2022 a las 08:31:28
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `egg_store_base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin_access', '3', 1661523717),
('god_access', '1', 1661492322),
('user_access', '2', 1661492379);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1661177219, 1661177219),
('/cliente/*', 2, NULL, NULL, NULL, 1661526898, 1661526898),
('/cliente/index', 2, NULL, NULL, NULL, 1661679170, 1661679170),
('/producto/*', 2, NULL, NULL, NULL, 1661526898, 1661526898),
('/producto/index', 2, NULL, NULL, NULL, 1661679180, 1661679180),
('/proveedor/*', 2, NULL, NULL, NULL, 1661526898, 1661526898),
('/proveedor/index', 2, NULL, NULL, NULL, 1661679187, 1661679187),
('/site/*', 2, NULL, NULL, NULL, 1661526898, 1661526898),
('/site/index', 2, NULL, NULL, NULL, 1661679198, 1661679198),
('/user/*', 2, NULL, NULL, NULL, 1661526899, 1661526899),
('/user/index', 2, NULL, NULL, NULL, 1661679231, 1661679231),
('admin_access', 1, 'Acceso solamente a las vistas del CRUD de usuarios y su respectiva organizacion', NULL, NULL, 1661182083, 1661182083),
('god_access', 1, '	Acceso a todas las vistas, asi como el alta, baja y modificacion de todas ellas, incluyendo las de roles, permisos y que tipo de rutas tienen asignado segun el tipo de usuario a crear.', NULL, NULL, 1661181997, 1661181997),
('permiso_admin', 2, 'Puede acceder a todas las vistas de CRUD y ejecutar todas las actividades y modificaciones del mismo.', NULL, NULL, 1661526637, 1661526637),
('permiso_god', 2, 'Puede acceder a todas las vistas y ejecutar todas las actividades y modificaciones posibles de la aplicacion.', NULL, NULL, 1661491438, 1661491438),
('permiso_user', 2, 'Puede acceder a todas las vistas de index y tiene reestringido ejecutar todas las actividades y modificaciones posibles de la aplicacion.', NULL, NULL, 1661678978, 1661678978),
('user_access', 1, 'Acceso a solo las vistas de index de los datos correspondientes al mismo.', NULL, NULL, 1661182155, 1661182155);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin_access', '/cliente/*'),
('admin_access', '/producto/*'),
('admin_access', '/proveedor/*'),
('admin_access', '/site/*'),
('admin_access', '/user/*'),
('admin_access', 'permiso_admin'),
('god_access', '/*'),
('god_access', 'permiso_god'),
('permiso_admin', '/cliente/*'),
('permiso_admin', '/producto/*'),
('permiso_admin', '/proveedor/*'),
('permiso_admin', '/site/*'),
('permiso_admin', '/user/*'),
('permiso_god', '/*'),
('permiso_user', '/cliente/index'),
('permiso_user', '/producto/index'),
('permiso_user', '/proveedor/index'),
('permiso_user', '/user/index'),
('user_access', '/cliente/index'),
('user_access', '/producto/index'),
('user_access', '/proveedor/index'),
('user_access', '/user/index'),
('user_access', 'permiso_user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni` int(8) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `domicilio` varchar(150) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `num_telefono` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `dni`, `nombre`, `apellido`, `domicilio`, `email`, `num_telefono`) VALUES
(1, 40439502, 'Alfonso', 'Grispino', 'Las Heras 2027', 'alfogris_1958@hotmail.com', 1127834388),
(2, 30981283, 'Roberto', 'Fonseca', 'Chivilcoy 3060', 'robertman_fons@gmail.com', 1164832458),
(3, 33567219, 'Apolinaria', 'Lechttermann', 'Sheldon 129', 'lechmann93_apol@gmail.com', 1567883241);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cliente` bigint(20) UNSIGNED NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `subtotal` int(11) NOT NULL,
  `region` varchar(100) NOT NULL,
  `vendedor` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1660105463),
('m130524_201442_init', 1660105470),
('m140506_102106_rbac_init', 1661063856),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1661063856),
('m180523_151638_rbac_updates_indexes_without_prefix', 1661063857),
('m190124_110200_add_verification_token_column_to_user_table', 1660105470),
('m200409_110543_rbac_update_mssql_trigger', 1661063857);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_proveedor` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,0) UNSIGNED DEFAULT NULL,
  `descuento` int(90) UNSIGNED DEFAULT NULL,
  `categoria` varchar(70) DEFAULT NULL,
  `unidades` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `id_proveedor`, `nombre`, `precio`, `descuento`, `categoria`, `unidades`) VALUES
(1, 1, 'arroz la marisel', '150', 20, 'cereales', 45),
(2, 1, 'queso fontina la paulina', '100', 25, 'quesos', 50),
(3, 2, 'huevos colorados rangers', '25', 15, 'avicola', 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_prov` varchar(130) NOT NULL,
  `contacto_prov` varchar(150) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `domicilio` varchar(150) NOT NULL,
  `num_telefono` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre_prov`, `contacto_prov`, `email`, `domicilio`, `num_telefono`) VALUES
(1, 'Chema Industries', 'Gilardino Perez', 'chema_industries@arg.com', 'Minerva 3001', 1190125374),
(2, 'Granja Loren', 'Benicio Di Lortto', 'dilortto.benihill@outlook.com', 'Farina 2018', 1123885463),
(3, 'Peipo SA', 'Maximiliano Romanedino', 'peipo.snack.fun@arg.com', 'Coronel Sandler 1390', 1170723422);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, '40429104', 'luZ-AYRfOo44MF5X91WIgpHFM-DIYYtc', '$2y$13$B7jYPVB09WW/Z4ltHoqVTeisLofbMuJte78M4YZV3qr9o2bLTKoFW', NULL, 'gaston_roa@live.com', 10, 1661484847, 1661464800, NULL),
(2, '27170139', 'NKugKQpiMXivz2i4HDDdmXrI1Gx6dc6z', '$2y$13$Od1yz9V3W8I.HSdd7u.tnepmLGFoPWKxgeGcR4BzWHZQMYmmocxbq', NULL, 'gilazo1996@gmail.com', 10, 1661491810, 1661464800, NULL),
(3, '20202022', 'wGFxA-9GnoPA4lZVv4PCuZMXJpC5t6wF', '$2y$13$7Y8qmfz9teHGB9rBv6ORGuBjUJNXy1AxXzUt6vIEcIjFzK1e5MY82', NULL, 'gerr2014android@gmail.com', 10, 1661523203, 1661523203, 'YR0mTT2arjZsJn0GW8KuWj3lGbcD9tyg_1661523203');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_factura` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_contado` decimal(10,0) DEFAULT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id`) REFERENCES `venta` (`id_factura`) ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
