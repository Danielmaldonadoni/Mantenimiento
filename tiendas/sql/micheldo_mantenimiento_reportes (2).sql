create database mantenimiento;
use mantenimiento;

--
-- Estructura de tabla para la tabla `calificacion_cerrados`
--

CREATE TABLE IF NOT EXISTS `encuesta_calificacion_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reporte` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `calidad` int(11) NOT NULL,
  `velocidad` int(11) NOT NULL,
  `promedio` double NOT NULL,
  `comentarios` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT;

--
-- Volcado de datos para la tabla `calificacion_cerrados`
--

INSERT INTO `calificacion_cerrados` (`id`, `id_reporte`, `calif1`, `calif2`, `calif3`, `promedio`, `comentarios`) VALUES
(1, 15, 4, 4, 2, 3.33333333333, 'Sin comentarios'),
(2, 17, 10, 8, 6, 8, 'Sin comentarios'),
(3, 14, 8, 8, 6, 7.33333333333, 'Sin comentarios'),
(4, 9, 6, 6, 4, 5.33333333333, 'Sin comentarios'),
(5, 10, 8, 6, 6, 6.66666666667, 'Sin comentarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `id_personal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `apellidos` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_personal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=149 ;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `nombre`, `apellidos`) VALUES
(143, 'VICENTE MORALES', 'FLORES'),
(147, 'LUIS FERNANDO', 'PADILLA'),
(148, 'FER MAYA', 'MAYA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE IF NOT EXISTS `reportes` (
  `id_reporte` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `titulo` varchar(150) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `tienda` varchar(70) DEFAULT NULL,
  `personal` varchar(80) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaTermino` date DEFAULT NULL,
  `id_ultima_modificacion` int(11) DEFAULT NULL,
  `estado` varchar(50) NOT NULL COMMENT '1 programado ,2 pendiente ,3 realizado',
  `calificado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_reporte`,`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id_reporte`, `id_usuario`, `titulo`, `descripcion`, `tienda`, `personal`, `fechaInicio`, `fechaTermino`, `id_ultima_modificacion`, `estado`, `calificado`) VALUES
(9, 2, 'Prueba', 'Breve prueba', '(T24) Aeropuerto Nal.', 'Daniel', '2016-12-19', '2016-12-20', 1, '3', 1),
(10, 2, 'IMAGEN OUTLET T49', 'Trabajos designados para cambio a tienda OUTLET y mayor exhibición.', '(T49) Galerias', 'VICENTE , LUIS FERNANDO', '2016-12-12', '2016-12-19', 2, '3', 1),
(11, 2, 'Mantenimiento Integral T55', 'Trabajos de mantenimiento correctivo y algunos solicitados', '(T55) Puebla', 'VICENTE , LUIS FERNANDO, FERNADO', '2016-12-05', '2016-12-08', 3, '1', 0),
(12, 2, 'Reparación de cortina y pendientes T22', 'Revisión continua a los aspectos que provocaron la falla en la cortina automática e iluminación', '(T22) Perisur', 'VICENTE , LUIS FERNANDO', '2017-01-03', '2017-01-13', 4, '1', 0),
(13, 2, 'Iluminación T01', 'Reparación de instalación eléctrica e iluminación en bodega y piso de venta', '(T01) Centro', 'LUIS FERNANDO', '2017-01-04', '2017-01-04', 5, '1', 0),
(14, 2, 'Iluminación T05', 'Reparación eléctrica de iluminación de bodega', '(T05) Z. Rosa', 'LUIS FERNANDO', '2017-01-04', '2017-01-04', 6, '3', 1),
(15, 2, 'Cerradura de puerta T41', 'Compostura de cerrojo completo secundario en puerta de acceso', '(T41) Lindavista', 'VICENTE MORALES, LUIS FERNANDO', '2017-01-05', '2017-01-11', 7, '3', 1),
(16, 2, 'Humedad, probador y pendientes T51', 'Reparación de filtraciones en muros en bodega, Retiro de probador e iluminación', '(T51) Cuicuilco', 'VICENTE MORALES, FER MAYA', '2017-01-06', '2017-01-10', 8, '3', 0),
(17, 2, 'Puerta de Acceso T56', 'Trabajos a la cerradura de la puerta de cristal de acceso a la tienda', '(T56) P. Norte', 'VICENTE MORALES, LUIS FERNANDO', '2017-01-06', '2017-01-06', 9, '3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE IF NOT EXISTS `rubros` (
  `id_rubro` int(11) NOT NULL AUTO_INCREMENT,
  `rubro` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rubro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`id_rubro`, `rubro`) VALUES
(1, 'Eléctricidad'),
(2, 'Iluminación'),
(3, 'Pintura'),
(4, 'Aire Acondicionado'),
(5, 'Plomería'),
(6, 'Protección Civil'),
(7, 'Cortina Eléctrica'),
(8, 'Mobiliario/Marmol'),
(9, 'Cancelería'),
(10, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_rubros`
--

CREATE TABLE IF NOT EXISTS `sub_rubros` (
  `id_bitacora` int(11) DEFAULT NULL,
  `id_sub_rubro` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_sub_rubro`),
  KEY `id_bitacora` (`id_bitacora`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `sub_rubros`
--

INSERT INTO `sub_rubros` (`id_bitacora`, `id_sub_rubro`, `descripcion`, `calificacion`, `status`) VALUES
(13, 1, 'Pintura vinilica blanca general', 0, 'REALIZADO'),
(20, 2, 'ColocaciÃ³n de 3 letreros vinilicos de "OUTLET" letra HervÃ©tica en fachadasÂ ', 0, 'REALIZADO'),
(20, 3, 'ColocaciÃ³n de 4 muebles de repisa con chapa de Ã©bano para exhibiciÃ³n sobre la', 0, 'REALIZADO'),
(20, 4, 'Arreglo y retapizado de 2 sillones doblesÂ ', 0, 'REALIZADO'),
(23, 5, 'Pintura vinilica blanca en plafÃ³n de Ã¡rea de caja, muros, marcos y plafÃ³n pri', 0, 'REALIZADO'),
(23, 6, 'Pintura de laca en mamparas de exhibiciÃ³nÂ ', 0, 'REALIZADO'),
(23, 7, 'ReparaciÃ³n de muro de tablaroca de baÃ±o', 0, 'PENDIENTE'),
(28, 8, 'Resane, reparaciÃ³n y Abrillantado de repisas de marmol en muebles y pirÃ¡mide', 0, 'REALIZADO'),
(28, 9, 'Resane de placas de mÃ¡rmol en piso', 0, 'REALIZADO'),
(28, 10, 'Resane y pintura de detalles de muebles de caja, contracaja, cinturoneros y mueb', 0, 'REALIZADO'),
(28, 11, 'Manija en puerta metÃ¡lica (acceso de empleados)', 0, 'PENDIENTE'),
(28, 12, 'Pulido de piso', 0, 'PROGRAMADO'),
(28, 13, 'Cambio de orificios para tubulares de repisas en mampara de caballeros (la mampa', 0, 'PENDIENTE'),
(30, 14, 'Soldadura de un punto en barandalde escalera', 0, 'PENDIENTE'),
(30, 15, 'Cambio de alfombra', 0, 'PROGRAMADO'),
(30, 16, 'Retapizado de cojÃ­n en sillÃ³n', 0, 'PROGRAMADO'),
(30, 17, 'ColocaciÃ³n de base rÃ­jida en bodega (donde se encontraba la pirÃ¡mide)', 0, 'PROGRAMADO'),
(33, 18, 'ReparaciÃ³n de plafÃ³n vencido detrÃ¡s de faldÃ³n de muro de dama', 0, 'PENDIENTE'),
(34, 19, 'Cambio de ductos de ventilaciÃ³n conectados a sistema de aire de la plaza', 0, 'PENDIENTE'),
(50, 20, 'Cambio de 2 chapas en puertas interiores', 0, 'PENDIENTE'),
(70, 21, 'ReparaciÃ³n y colocaciÃ³n de balero con cerrojo en chapa inferior de puerta de c', 0, 'REALIZADO'),
(80, 22, 'Retiro de Probador de piso de ventas', 0, 'REALIZADO'),
(80, 23, 'Retiro de firme y salitre en muros por filtraciones de agua en bodega. Colado de', 0, 'REALIZADO'),
(90, 24, 'Cambio y colocaciÃ³n de nuevas carretillas, ajuste de rieles y colocaciÃ³n de se', 0, 'REALIZADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervisores`
--

CREATE TABLE IF NOT EXISTS `supervisores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `iniciales` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `supervisores`
--

INSERT INTO `supervisores` (`id`, `usuario`, `password`, `nombre`, `iniciales`) VALUES
(1, 'jgarcia', 'jgarcia1', 'Jorge Garcia', 'JG'),
(2, 'emedina', 'emedina1', 'Ernesto medina', 'EM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal`
--

CREATE TABLE IF NOT EXISTS `temporal` (
  `id_temporal` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_reporte` int(11) DEFAULT NULL,
  `rubro` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `entregado_a_tiempo` varchar(100) NOT NULL,
  `comentarios` varchar(250) NOT NULL,
  PRIMARY KEY (`id_temporal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Volcado de datos para la tabla `temporal`
--

INSERT INTO `temporal` (`id_temporal`, `id_usuario`, `id_reporte`, `rubro`, `descripcion`, `calificacion`, `status`, `entregado_a_tiempo`, `comentarios`) VALUES
(1, 2, 9, 'Eléctricidad', 'Prueba', 0, 'PENDIENTE', '', ''),
(2, 2, 10, 'Eléctricidad', 'Cambio de 2 fuentes 12amp en muebles de exhibición', 0, 'REALIZADO', 'Si', ''),
(3, 2, 10, 'Iluminación', 'Cambio de 13 focos dicroicos en piso de venta', 0, 'REALIZADO', 'Si', ''),
(4, 2, 10, 'Iluminación', 'Cambio de 4 lámpara de 60w en bodega', 0, 'REALIZADO', 'Si', ''),
(5, 2, 10, 'Iluminación', 'Cambio de 3 balastras para lámparas T18 en bodega', 0, 'REALIZADO', 'Si', ''),
(6, 2, 10, 'Eléctricidad', 'Puenteo de 2 cargas en mueble de caja', 0, 'REALIZADO', 'Si', ''),
(7, 2, 10, 'Pintura', 'Pintura vinilica blanca general', 0, 'REALIZADO', 'Si', ''),
(8, 2, 10, 'Otros', 'Colocación de 3 letreros vinilicos de "OUTLET" letra Hervética en fachadasÂ ', 0, 'REALIZADO', 'Si', ''),
(9, 2, 10, 'Otros', 'Colocación de 4 muebles de repisa con chapa de ébano para exhibición sobre las bases alfombradas ', 0, 'REALIZADO', 'Si', ''),
(10, 2, 10, 'Otros', 'Arreglo y retapizado de 2 sillones doblesÂ ', 0, 'REALIZADO', 'Si', ''),
(11, 2, 11, 'Eléctricidad', 'Limpieza de tablero, limpieza de pastillas y lineas principales', 9, 'REALIZADO', 'Si', 'realizado'),
(12, 2, 11, 'Eléctricidad', 'Ajuste de conectores principales en interruptor primario', 9, 'REALIZADO', 'Si', 'realizado'),
(13, 2, 11, 'Eléctricidad', 'Cambio de 2 fuentes de 12amp, en muebles fijos en piso de venta', 89, 'REALIZADO', 'Si', ''),
(14, 2, 11, 'Iluminación', 'Cambio de 16 focos dicroicos luz cálida en piso de venta', 10, 'REALIZADO', 'Si', 'pendiente envíen repuestos de focos'),
(15, 2, 11, 'Iluminación', 'Cambio de 5 lámparas T14 luz cálida en piso de venta', 8, 'REALIZADO', 'Si', 'pendiente envíen repuestos de lamparas}'),
(16, 2, 11, 'Iluminación', 'Cambio de 6 lámparas de 12leds luz cálida en piso de venta', 8, 'REALIZADO', 'Si', 'pendiente envíen repuesto de lamparas'),
(17, 2, 11, 'Iluminación', 'Colocación de 7 tiras de led en repisas de muros en piso de venta', 8, 'REALIZADO', 'Si', 'realizado}'),
(18, 2, 11, 'Iluminación', 'Colocación y ajuste de tiras led en pirámide principal y mostrador de caja', 8, 'REALIZADO', 'Si', 'solo en piramide'),
(19, 2, 11, 'Iluminación', 'Cambio de 13 balastras para foco dicroico MR16', 1, 'REALIZADO', 'No', 'no fue notificado el cambio de dichas balastras'),
(20, 2, 11, 'Iluminación', 'Cambio de 2 balastros para lámparas 60wÂ ', 10, 'REALIZADO', 'Si', 'realizado'),
(21, 2, 11, 'Pintura', 'Pintura vinilica blanca en plafón de área de caja, muros, marcos y plafón principal', 8, 'REALIZADO', 'Si', 'solo fue en algunas áreas del plafón'),
(22, 2, 11, 'Pintura', 'Pintura de laca en mamparas de exhibiciónÂ ', 1, 'REALIZADO', 'No', 'este trabajo no fue realizado'),
(23, 2, 11, 'Plomería', 'Cambio de Cespol de lavamanos de baño', 7, 'REALIZADO', 'Si', 'Aun existe fuga de agua'),
(24, 2, 11, 'Plomería', 'Colocación de sistema Duo en WC', 9, 'REALIZADO', 'Si', 'realizado'),
(25, 2, 11, 'Plomería', 'Limpieza de extractor eléctrico de baño', 10, 'REALIZADO', 'Si', 'realizado'),
(26, 2, 11, 'Protección Civil', 'Colocación de tiras antiderrapantes en escalera de bodega', 10, 'REALIZADO', 'Si', 'realizado.'),
(27, 2, 11, 'Protección Civil', 'Revisión de detector de humo', 1, 'REALIZADO', 'No', 'no hay detector de humo en tienda'),
(28, 2, 11, 'Mobiliario/Marmol', 'Resane, reparación y Abrillantado de repisas de marmol en muebles y pirámide', 10, 'REALIZADO', 'Si', 'realizado'),
(29, 2, 11, 'Mobiliario/Marmol', 'Resane de placas de mármol en piso', 9, 'REALIZADO', 'Si', 'realizado'),
(30, 2, 11, 'Mobiliario/Marmol', 'Resane y pintura de detalles de muebles de caja, contracaja, cinturoneros y muebles fijos', 7, 'REALIZADO', 'Si', 'realizado'),
(31, 2, 11, 'Mobiliario/Marmol', 'Manija en puerta metálica (acceso de empleados)', 0, 'PENDIENTE', '', ''),
(32, 2, 11, 'Otros', 'Soldadura de un punto en barandalde escalera', 0, 'PENDIENTE', '', ''),
(33, 2, 11, 'Otros', 'Cambio de alfombra', 0, 'PROGRAMADO', '', ''),
(34, 2, 11, 'Mobiliario/Marmol', 'Pulido de piso', 0, 'PROGRAMADO', '', ''),
(35, 2, 11, 'Cancelería', 'Cambio de espejo maltratado en puerta de baño (no roto)', 0, 'PENDIENTE', '', ''),
(36, 2, 11, 'Cancelería', 'Aceitado de bisagras y nivelado de puerta de baño', 10, 'REALIZADO', 'Si', 'realizado'),
(37, 2, 11, 'Mobiliario/Marmol', 'Cambio de orificios para tubulares de repisas en mampara de caballeros (la mampara está inclinada y', 0, 'PENDIENTE', '', ''),
(38, 2, 11, 'Otros', 'Retapizado de cojín en sillón', 0, 'PROGRAMADO', '', ''),
(39, 2, 11, 'Pintura', 'Reparación de muro de tablaroca de baño', 0, 'PENDIENTE', '', ''),
(40, 2, 11, 'Eléctricidad', 'Encamizado de cableado', 0, 'PENDIENTE', '', ''),
(41, 2, 11, 'Eléctricidad', 'Colocar contacto en PB de bodega', 0, 'PENDIENTE', '', ''),
(42, 2, 11, 'Otros', 'Colocación de base ríjida en bodega (donde se encontraba la pirámide)', 0, 'PROGRAMADO', '', ''),
(43, 2, 12, 'Aire Acondicionado', 'Cambio de ductos de ventilación conectados a sistema de aire de la plaza', 0, 'PENDIENTE', '', ''),
(44, 2, 12, 'Iluminación', 'Colocación de 3 lámparas de 30W en bodega', 0, 'REALIZADO', '', ''),
(45, 2, 12, 'Eléctricidad', 'Cambio de 2 fuentes trifásicas en muro de dama', 0, 'REALIZADO', 'Si', ''),
(46, 2, 12, 'Pintura', 'Reparación de plafón vencido detrás de faldón de muro de dama', 0, 'PENDIENTE', '', ''),
(47, 2, 12, 'Cortina Eléctrica', 'Reparación de motor y colocación de automatizador en conexión', 0, 'REALIZADO', 'No', ''),
(48, 2, 12, 'Cortina Eléctrica', 'Reparación de duelas metálicas y engranesÂ ', 0, 'PENDIENTE', '', ''),
(49, 2, 13, 'Eléctricidad', 'Reparación de 3 pastillas en tablero pral.', 5, 'REALIZADO', 'No', 'INCOMPLETO'),
(50, 2, 13, 'Iluminación', 'Reparación de drivers alternos de 3 lámparas tipo faro de 12 leds', 5, 'REALIZADO', 'No', 'INCOMPLETO'),
(51, 2, 13, 'Iluminación', 'Cambio de 6 focos dicroicos MR16 y una lámpara de riel de 12V', 5, 'REALIZADO', 'No', 'INCOMPLETO'),
(52, 2, 13, 'Iluminación', 'Cambio y colocación de 4 balastras de 2X60 y 10 lámparas de 60W', 0, 'PENDIENTE', '', ''),
(53, 2, 13, 'Iluminación', 'Cambio y colocación de 8 focos centrales tipo faro en piso de venta', 0, 'PENDIENTE', '', ''),
(54, 2, 13, 'Otros', 'Cambio de 2 chapas en puertas interiores', 0, 'PENDIENTE', '', ''),
(55, 2, 14, 'Iluminación', 'Reparación de 5 lámparas de 60W en bodega y de 3 drivers', 9, 'REALIZADO', '', ''),
(56, 2, 14, 'Eléctricidad', 'Reparación de pastillas en tablero pral.Â ', 0, 'REALIZADO', '', ''),
(57, 2, 15, 'Otros', 'Reparación y colocación de balero con cerrojo en chapa inferior de puerta de cristalÂ ', 0, 'REALIZADO', '', ''),
(58, 2, 15, 'Iluminación', 'Cambio y colocación de tiras de LedÂ ', 0, 'PENDIENTE', '', ''),
(59, 2, 15, 'Iluminación', 'Cambio y colocación de focos dicroicos MR16 y lámparas centrales en piso de venta', 0, 'PENDIENTE', '', ''),
(60, 2, 16, 'Eléctricidad', 'Cambio y colocación de 2 drivers de 12V, y 2 fuentes de 20amp', 0, 'REALIZADO', 'Si', ''),
(61, 2, 16, 'Otros', 'Retiro de Probador de piso de ventas', 0, 'REALIZADO', 'Si', ''),
(62, 2, 16, 'Otros', 'Retiro de firme y salitre en muros por filtraciones de agua en bodega. Colado de escalón y repeyado', 0, 'REALIZADO', 'Si', ''),
(64, 2, 16, 'Iluminación', 'Cambio y colocación de 10 bases de lámparas de riel con 16 focos dicroicos MR16 en piso de vent', 0, 'REALIZADO', 'Si', ''),
(65, 2, 16, 'Iluminación', 'Cambio de 2 bases de foco dicroico en iso de venta', 0, 'REALIZADO', 'Si', ''),
(66, 2, 16, 'Iluminación', 'Cambio y colocación de 1 balastra 2X30 y 3 lámaparas de 60W en bodega', 0, 'REALIZADO', 'Si', ''),
(67, 2, 17, 'Otros', 'Cambio y colocación de nuevas carretillas, ajuste de rieles y colocación de seguro retráctil en c', 8, 'REALIZADO', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE IF NOT EXISTS `tiendas` (
  `id_tienda` int(11) NOT NULL DEFAULT '0',
  `tienda` varchar(50) DEFAULT NULL,
  `nombre` varchar(80) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `supervisor` varchar(30) NOT NULL,
  `iniciales` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiendas`
--

INSERT INTO `tiendas` (`id_tienda`, `tienda`, `nombre`, `usuario`, `password`, `supervisor`, `iniciales`) VALUES
(1, '(T01) Centro', 'Centro', 'T001', 'fuvag3yU', 'Jorge Garcia', 'JG'),
(2, '(T05) Z. Rosa', 'Z. Rosa', 'T005', 'prutr6fU', 'Ernesto Medina', 'EM'),
(3, '(T22) Perisur', 'Perisur', 'T022', 'rEfeJa7a', 'Jorge Garcia', 'JG'),
(4, '(T24) Aeropuerto Nal.', 'Aeropuerto Nal.', 'T024', 'n3VAButr', 'Jorge Garcia', 'JG'),
(5, '(T38) Coyoacan', 'Coyoacan', 'T038', 'cr5Xukef', 'Jorge Garcia', 'JG'),
(6, '(T41) Lindavista', 'Lindavista', 'T041', 'Dru4rUcH', 'Jorge Garcia', 'JG'),
(7, '(T42) P. Polanco', 'P. Polanco', 'T042', 'xatreP4v', 'Ernesto Medina', 'EM'),
(8, '(T43) Coapa', 'Coapa', 'T043', 'Trefruc2', 'Jorge Garcia', 'JG'),
(9, '(T45) Satelite', 'Satelite', 'T045', 'travap6E', 'Ernesto Medina', 'EM'),
(10, '(T46) Santa fe', 'Santa fe', 'T046', 'vAqewu2h', 'Ernesto Medina', 'EM'),
(11, '(T49) Galerias', 'Galerias', 'T049', 'Gutug8sW', 'Ernesto Medina', 'EM'),
(12, '(T51) Cuicuilco', 'Cuicuilco', 'T051', 'TreS6bru', 'Jorge Garcia', 'JG'),
(13, '(T52) Metepec', 'Metepec', 'T052', 'cabedaF8', 'Ernesto Medina', 'EM'),
(14, '(T53) Lerma ', 'Lerma ', 'T053', 'tHUfas6e', 'Ernesto Medina', 'EM'),
(15, '(T54) Universidad', 'Universidad', 'T054', 'Nes2espe', 'Jorge Garcia', 'JG'),
(16, '(T55) Puebla', 'Puebla', 'T055', 'Warag6sp', 'Ernesto Medina', 'EM'),
(17, '(T56) P. Norte', 'P. Norte', 'T056', '4uthebrA', 'Ernesto Medina', 'EM'),
(18, '(T57) Delta', 'Delta', 'T057', 'Ku4aphAz', 'Jorge Garcia', 'JG'),
(19, '(T58) Las Americas', 'Las Americas', 'T058', 'kepa3Uge', 'Ernesto Medina', 'EM'),
(20, '(T59) Aeropuerto Intl.', 'Aeropuerto Intl.', 'T059', 'hasWUtr6', 'Jorge Garcia', 'JG'),
(21, '(T60) Tepeyac', 'Tepeyac', 'T060', 'jawewrU7', 'Jorge Garcia', 'JG'),
(22, '(T61) P. Lindavista', 'P. Lindavista', 'T061', 'bare6rUj', 'Jorge Garcia', 'JG'),
(23, '(T62) La Cuspide', 'La Cuspide', 'T062', '6uchAstu', 'Jorge Garcia', 'JG'),
(24, '(T63) Tezontle', 'Tezontle', 'T063', 'dr5dajaS', 'Ernesto Medina', 'EM'),
(25, '(T64) P. Oriente', 'P. Oriente', 'T064', 'q5mefAMe', 'Ernesto Medina', 'EM'),
(26, '(T65) Acapulco', 'Acapulco', 'T065', 'th5pEzaw', 'Jorge Garcia', 'JG'),
(27, '(T66) Cancun', 'Cancun', 'T066', 'Gephabe5', 'Ernesto Medina', 'EM'),
(28, '(T69) Via Vallejo', 'Via Vallejo', 'T069', 'c5UreZaw', 'Jorge Garcia', 'JG'),
(29, '(T71) P. Toreo', 'P. Toreo', 'T071', 't8esUxut', 'Ernesto Medina', 'EM'),
(30, '(T73) Cd. Jardin', 'Cd. Jardin', 'T073', 'chuBru8u', 'Ernesto Medina', 'EM'),
(31, '(T75) Plaza del Sol (Gdl)', 'Plaza del Sol (Gdl)', 'T075', '4Aqakacr', 'Jorge Garcia', 'JG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajospendientes`
--

CREATE TABLE IF NOT EXISTS `trabajospendientes` (
  `idTrabajoPendiente` varchar(100) NOT NULL DEFAULT '',
  `descripcion` varchar(250) DEFAULT NULL,
  `fechaTermino` date DEFAULT NULL,
  PRIMARY KEY (`idTrabajoPendiente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ultimas_modificaciones`
--

CREATE TABLE IF NOT EXISTS `ultimas_modificaciones` (
  `id_ultima_modificacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_reporte` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_ultima_modificacion`),
  KEY `id_reporte` (`id_reporte`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `ultimas_modificaciones`
--

INSERT INTO `ultimas_modificaciones` (`id_ultima_modificacion`, `id_reporte`, `fecha`) VALUES
(1, 9, '2016-12-19'),
(2, 10, '2016-12-19'),
(3, 11, '2016-12-19'),
(4, 12, '2017-01-09'),
(5, 13, '2017-01-09'),
(6, 14, '2017-01-09'),
(7, 15, '2017-01-09'),
(8, 16, '2017-01-10'),
(9, 17, '2017-01-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`) VALUES
(1, 'Bruno--', 'domitmantenimiento'),
(2, 'bcastillo', 'mantenimiento2016'),
(3, 'Jesus', '13245');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
