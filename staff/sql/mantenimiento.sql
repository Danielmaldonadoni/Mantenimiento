create database mantenimiento;
use mantenimiento;

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE usuarios (
  `id_usuario` int(11) auto_increment,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  CONSTRAINT pk1 PRIMARY KEY(id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`) VALUES
(1, 'Bruno--', 'domitmantenimiento'),
(2, 'bcastillo', 'mantenimiento2016'),
(3, 'Jesus', '13245');


--
-- Estructura de tabla para la tabla `supervisores`
--

CREATE TABLE `supervisores` (
  id_supervisor int(11) auto_increment,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `iniciales` varchar(5) NOT NULL,
  CONSTRAINT pk2 PRIMARY KEY(id_supervisor)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `supervisores`
--

INSERT INTO `supervisores` (id_supervisor, `usuario`, `password`, `nombre`, `iniciales`) VALUES
(1, 'jgarcia', 'jgarcia1', 'Jorge Garcia', 'JG'),
(2, 'emedina', 'emedina1', 'Ernesto medina', 'EM');





CREATE TABLE personal (
  `id_personal` int(11) auto_increment,
  `nombre` varchar(60) DEFAULT NULL,
  `apellidos` varchar(60) DEFAULT NULL,
  CONSTRAINT pk3 PRIMARY KEY(id_personal)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `nombre`, `apellidos`) VALUES
(143, 'VICENTE MORALES', 'FLORES'),
(147, 'LUIS FERNANDO', 'PADILLA'),
(148, 'FER MAYA', 'MAYA'),
(149, 'PROVEEDOR EXT.', 'EXTERNO');

CREATE TABLE reportes (
  `id_reporte` int(11) auto_increment,
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
  CONSTRAINT pk4 PRIMARY KEY(id_reporte),
  CONSTRAINT fk1 FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE rubros (
  id_rubro int(11) AUTO_INCREMENT,
  `rubro` varchar(100) DEFAULT NULL,
  CONSTRAINT pk5 PRIMARY KEY(id_rubro)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla bitacora
--
CREATE TABLE bitacora (
  `id_bitacora` int(11) auto_increment,
  `id_usuario` int(11) DEFAULT NULL,
  `id_reporte` int(11) DEFAULT NULL,
  id_rubro int,
  `descripcion` varchar(100) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `entregado_a_tiempo` varchar(100) NOT NULL,
  `comentarios` varchar(250) NOT NULL,
  CONSTRAINT pk6 PRIMARY KEY(id_bitacora),
  CONSTRAINT fk2 FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario) ON UPDATE CASCADE,
  CONSTRAINT fk3 FOREIGN KEY(id_reporte) REFERENCES reportes(id_reporte) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_rubro FOREIGN KEY(id_rubro) REFERENCES rubros(id_rubro) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal`
--

CREATE TABLE `temporal` (
  `id_temporal` int(11) auto_increment,
  `id_usuario` int(11) DEFAULT NULL,
  `id_reporte` int(11) DEFAULT NULL,
  id_rubro int ,
  `descripcion` varchar(100) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `entregado_a_tiempo` varchar(100) NOT NULL,
  `comentarios` varchar(250) NOT NULL,
  CONSTRAINT pk_temporal PRIMARY KEY(id_temporal)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

CREATE TABLE `encuesta_calificacion_servicio` (
  `id_encuesta` int(11) auto_increment,
  `id_reporte` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `calidad` int(11) NOT NULL,
  `velocidad` int(11) NOT NULL,
  `promedio` double NOT NULL,
  `comentarios` varchar(100) NOT NULL,
  CONSTRAINT pk7 PRIMARY KEY(id_encuesta),
  CONSTRAINT FK4 FOREIGN KEY(id_reporte) REFERENCES reportes(id_reporte) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `ultimas_modificaciones` (
  `id_ultima_modificacion` int AUTO_INCREMENT,
  `id_reporte` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  CONSTRAINT pk8 PRIMARY KEY(id_ultima_modificacion),
  CONSTRAINT fk5 FOREIGN KEY(id_reporte) REFERENCES reportes(id_reporte) ON UPDATE CASCADE
) ENGINE=InnoDB;



CREATE TABLE `tiendas` (
  `id_tienda` int(11) NOT NULL DEFAULT '0',
  `tienda` varchar(50) DEFAULT NULL,
  `nombre` varchar(80) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `supervisor` varchar(30) NOT NULL,
  `iniciales` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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